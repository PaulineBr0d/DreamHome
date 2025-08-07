 <?php 
     session_start();
    $listings = require_once "views/components/_listings.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find My Dream Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'views/components/_header.php';?>
    <main>
        <h2>Nos annonces de maisons</h2>
        <section class="container">
           <?php foreach ($listings as $item): ?>
                <?php if ($item['property-type'] === 'house'): ?>
                    <?php include 'views/components/_item.php'; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </section>
        <h2>Nos annonces d’appartements</h2>
        <section class="container">
             <?php foreach ($listings as $item): ?>
                <?php if ($item['property-type'] === 'apartment'): ?>
                    <?php include 'views/components/_item.php'; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        
        </section>
    </main>
    <?php include 'views/components/_footer.php';?>
</body>
</html>