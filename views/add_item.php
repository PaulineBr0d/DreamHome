<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/auth.php';

isLoggedIn();
requireLogin();
requireRole(['agent', 'admin']);

$user_id = $_SESSION['user_id'];

$propertyTypes = $pdo->query("SELECT id, name FROM propertyType")->fetchAll(PDO::FETCH_ASSOC);
$transactionTypes = $pdo->query("SELECT id, name FROM transactionType")->fetchAll(PDO::FETCH_ASSOC);

$errors = [];
$message = '';
$currentDate = date('Y-m-d H:i:s');
$imagePath = null;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    //récup' de l'image
    if(isset($_FILES['image']) && ($_FILES['image']['error'] === 0)) {
        $imageTmp = $_FILES['image']["tmp_name"];
        $imageSize = $_FILES['image']["size"];
        $imageType = $_FILES['image']["type"];
        $imageName = $_FILES['image']["name"];

        $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/webp',];
        $maxFileSize = 5 * 1024 * 1024;
        if (!in_array($imageType, $allowedTypes)) {
            echo "Type de fichier interdit";
            exit;
        }
        if ($imageSize > $maxFileSize) {
            echo "Taille de fichier trop volumineux";
            exit;
        }

        $imageExtension = explode('.',$imageName);
        $imageExtension = end($imageExtension);
        $newImageName = uniqid('file_', true) . '.' . $imageExtension;

        $dest = '../upload/' . $newImageName;

        if (!is_dir('../upload/')) {
            mkdir('../upload/', 0755, true);
        }
       
     
        if (move_uploaded_file($imageTmp, $dest)) {
            $imagePath = $dest;
        } else {
            $errors[] = "Erreur lors du déplacement de l'image.";
        }
    }
   
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $property_type = isset($_POST['property_type']) ? trim($_POST['property_type']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $transaction_type = isset($_POST['transaction_type']) ? trim($_POST['transaction_type']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';

    //Validation des données 
    if ($title === '') $errors[] = "Le titre est obligatoire.";
    if (!is_numeric($price) || $price <= 0) 
    $errors[] = "Le prix doit être un nombre positif.";
    if ($location === '') 
    $errors[] = "La ville est obligatoire.";
    if ($description === '') 
    $errors[] = "La description est obligatoire.";
    if (!in_array($property_type, array_column($propertyTypes, 'id'))) {
        $errors[] = "Type de bien invalide.";
    }
    if (!in_array($transaction_type, array_column($transactionTypes, 'id'))) {
        $errors[] = "Type de transaction invalide.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare( "INSERT INTO listing (
            title, property_type_id, price, city, transaction_type_id, description, image_url, user_id, created_at, updated_at
            ) VALUES (
            :title, :property_type_id, :price, :city, :transaction_type_id, :description, :image_url, :user_id, :created_at, :updated_at
        )");

        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':property_type_id', $property_type, PDO::PARAM_INT);
        $stmt->bindValue(':price', $price, PDO::PARAM_INT);
        $stmt->bindValue(':city', $location, PDO::PARAM_STR);
        $stmt->bindValue(':transaction_type_id', $transaction_type, PDO::PARAM_INT);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':image_url', $imagePath, PDO::PARAM_STR);
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
    <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg, image/webp" />
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