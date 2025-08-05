<?php
session_start();

if (!isset($_SESSION["isLoggedIn"])) {
    header("Location: login.php"); 
    exit();
}

if (!isset($_SESSION['listings'])) {
    $_SESSION['listings'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_SESSION['listings'][] = [
        'title' => $_POST['title'],
        'type' => $_POST['property-type'],
        'price' => $_POST['price'],
        'location' => $_POST['location'],
    ];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find My Dream Home</title>
    <link rel="stylesheet" href="style.css">
</head>
 <?php include '_header.php';?>
    <body class="form-connect">
    <main>
    <form action="" method="post" enctype="multipart/form-data">
    <h4>Nouvel ajout d'un bien</h4>
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" required>
    <label for="property-type">Type :</label>
    <select id="property-type" name="property-type" required>
    <option value="">--Préciser le type de bien svp--</option>
    <option value="apartment">Appartement</option>
    <option value="house">Maison</option>
    </select>
    <label for="image">Image</label>
    <input type="file" id="image" name="image" accept="image/png, image/jpeg" />
    <label for="price">Prix (en €)</label>
    <input type="number" name="price" id="price" required>
    <label for="location">Ville</label>
    <input type="text" name="location" id="location" required>
    <select id="transaction-type" name="transaction-type" required>
    <option value="">--Préciser le type de transaction svp--</option>
    <option value="sale">Vente</option>
    <option value="rent">Location</option>
    </select>
    <label for="description">Description</label>
    <textarea id="description" name="description" cols="30" rows="10"></textarea>
    <button type="submit">Ajouter</button></form> 
    </main>
       <?php include '_footer.php';?>
</body>
</html>