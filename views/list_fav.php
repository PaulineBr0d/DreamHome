<?php
session_start();
require_once dirname(__DIR__) . '/config.php';
require_once 'includes/auth.php';
isLoggedIn();

// Visualisation de la liste des favoris
$listing_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$user_id = $_SESSION['user_id'] ?? null;
$stmt = $pdo->prepare("SELECT lis.*,
                    prt.name AS property_type_name, 
                    trt.name AS transaction_type_name
                    FROM favoris fav 
                    JOIN listing lis ON lis.id = fav.listing_id 
                    JOIN propertyType prt ON lis.property_type_id = prt.id
                    JOIN transactionType trt ON lis.transaction_type_id = trt.id
                    WHERE fav.user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$listing_favs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes favoris</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include 'includes/_header.php';?>
      <main>
        <h2>Ma liste des favoris</h2>
         <section class="container">
            <?php foreach ($listing_favs as $item) : ?>
                <?php include 'includes/_item.php'; ?>
          <?php endforeach; ?>   
        </section>
        </main>
    <?php include 'includes/_footer.php';?>
</body>
</html>