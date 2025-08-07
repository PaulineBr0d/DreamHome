<?php
session_start();
require_once 'config.php';

if (empty($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$propertyTypes = $pdo->query("SELECT id, name FROM propertyType")->fetchAll(PDO::FETCH_ASSOC);
$transactionTypes = $pdo->query("SELECT id, name FROM transactionType")->fetchAll(PDO::FETCH_ASSOC);

$errors = [];
$message = '';
$currentDate = date('Y-m-d H:i:s');

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $property_type = isset($_POST['property_type']) ? trim($_POST['property_type']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $transaction_type = isset($_POST['transaction_type']) ? trim($_POST['transaction_type']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';

    //Validation des données => vérif' des types de transaction et propriété ?
    if ($title === '') $errors[] = "Le titre est obligatoire.";
    if (!is_numeric($price) || $price <= 0) 
    $errors[] = "Le prix doit être un nombre positif.";
    if ($location === '') 
    $errors[] = "La ville est obligatoire.";
    if ($description === '') 
    $errors[] = "La description est obligatoire.";

    if (empty($errors)) {
        $stmt = $pdo->prepare( "INSERT INTO listing (
            title, property_type_id, price, city, transaction_type_id, description, user_id, created_at, updated_at
            ) VALUES (
            :title, :property_type_id, :price, :city, :transaction_type_id, :description, :user_id, :created_at, :updated_at
        )");

        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':property_type_id', $property_type, PDO::PARAM_INT);
        $stmt->bindValue(':price', $price, PDO::PARAM_INT);
        $stmt->bindValue(':city', $location, PDO::PARAM_STR);
        $stmt->bindValue(':transaction_type_id', $transaction_type, PDO::PARAM_INT);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':created_at', $currentDate, PDO::PARAM_STR);
        $stmt->bindValue(':updated_at', $currentDate, PDO::PARAM_STR);
        $stmt->execute();

        $message = "Le bien a été ajouté !";
    } else {
        foreach ($errors as $error) {
            $message .= "<p style='color: red;'>$error</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find My Dream Home</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
    <body>
    <main class="form-connect">
    <form action="" method="post" enctype="multipart/form-data" id="form-add">
    <h4>Nouvel ajout d'un bien</h4>
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" required>
     <div  class="form-alert" id="isTitleValid"></div>
    <label for="property-type">Type :</label>
   <select id="property-type" name="property_type" required>
    <option value="">--Préciser le type de bien svp--</option>
    <?php foreach ($propertyTypes as $type): ?>
        <option value="<?= htmlspecialchars($type['id']) ?>">
            <?= htmlspecialchars($type['name']) ?>
        </option>
    <?php endforeach; ?>
</select>
    <label for="image">Image</label>
    <input type="file" id="image" name="image" accept="image/png, image/jpeg" />
    <label for="price">Prix (en €)</label>
    <input type="number" name="price" id="price"  min="0" required>
    <div  class="form-alert" id="isPriceValid"></div>
    <label for="location">Ville</label>
    <input type="text" name="location" id="location" required>
    <div  class="form-alert" id="isLocationValid"></div>
    <select id="transaction-type" name="transaction_type" required>
     <option value="">--Préciser le type de transaction--</option>
    <?php foreach ($transactionTypes as $type): ?>
        <option value="<?= htmlspecialchars($type['id']) ?>">
            <?= htmlspecialchars($type['name']) ?>
        </option>
    <?php endforeach; ?>
</select>
    <label for="description">Description</label>
    <textarea id="description" name="description" cols="30" rows="10" required></textarea>
     <div  class="form-alert" id="isDescriptionValid"></div>
    <button type="submit">Ajouter</button></form>
    <?php 
        echo "<p>$message</p>";
    ?>
    <div>Retour à l'<a href="/">accueil</a></div>
    </main>
    <script src="../js/script.js"></script>
</body>
</html>