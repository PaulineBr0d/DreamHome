<?php
session_start();
$errors = [];
$message = '';
$submitted = false;

if (!isset($_SESSION["isLoggedIn"])) {
    header("Location: login.php"); 
    exit();
}

if (!isset($_SESSION['listings'])) {
    $_SESSION['listings'] = [];
}

//validation des données
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $submitted = true;

    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $propertyType = isset($_POST['property-type']) ? trim($_POST['property-type']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $transactionType = isset($_POST['transaction-type']) ? trim($_POST['transaction-type']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';

    //à faire image
    if ($title === '') $errors[] = "Le titre est obligatoire.";
    if (!in_array($propertyType, ['house', 'apartment'])) $errors[] = "Type de propriété invalide.";
    if (!is_numeric($price) || $price <= 0) $errors[] = "Le prix doit être un nombre positif.";
    if ($location === '') $errors[] = "La ville est obligatoire.";
    if (!in_array($transactionType, ['sale', 'rent'])) $errors[] = "Type de transaction invalide.";
    if ($description === '') $errors[] = "La description est obligatoire.";

    if (empty($errors)) {
        $_SESSION['listings'][] = [
            'title' => htmlspecialchars($title),
            'property-type' => htmlspecialchars($propertyType),
            'price' => (int)$price,
            'location' => htmlspecialchars($location),
            'transaction' => htmlspecialchars($transactionType),
            'description' => htmlspecialchars($description),
        ];
        
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
    <select id="property-type" name="property-type" required>
    <option value="">--Préciser le type de bien svp--</option>
    <option value="apartment">Appartement</option>
    <option value="house">Maison</option>
    </select>
    <label for="image">Image</label>
    <input type="file" id="image" name="image" accept="image/png, image/jpeg" />
    <label for="price">Prix (en €)</label>
    <input type="number" name="price" id="price"  min="0" required>
    <div  class="form-alert" id="isPriceValid"></div>
    <label for="location">Ville</label>
    <input type="text" name="location" id="location" required>
    <div  class="form-alert" id="isLocationValid"></div>
    <select id="transaction-type" name="transaction-type" required>
    <option value="">--Préciser le type de transaction svp--</option>
    <option value="sale">Vente</option>
    <option value="rent">Location</option>
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