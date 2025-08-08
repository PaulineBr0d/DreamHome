 <?php 
session_start();

require_once '../config.php';
$stmt = $pdo->prepare('SELECT 
        lis.*, 
        prt.name AS property_type_name, 
        trt.name AS transaction_type_name
        FROM listing lis
        JOIN propertyType prt ON lis.property_type_id = prt.id
        JOIN transactionType trt ON lis.transaction_type_id = trt.id');
    $stmt->execute();
    $listings = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
<?php include 'includes/_header.php';?>
 <main>
    <h2>Nos annonces d'appartements</h2>
    <section class="container">
        <?php foreach ($listings as $item): ?>
            <?php if ($item['property_type_id'] == 2 ): ?>
                <?php include 'includes/_item.php'; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </section>
</main>
<?php include 'includes/_footer.php';?>
</body>
</html>