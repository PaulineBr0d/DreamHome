 <?php 
   $listingsHouses = require_once "_listings_houses.php";
   $listingsApartments = require_once "_listings_apartments.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find My Dream Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include '_header.php';?>
    <main>
        <h2>Nos annonces de maisons</h2>
        <section class="container">
        <?php foreach ($listingsHouses as $item) 
            {
             include '_item.php';
            }
        ?>
        </section>
        <h2>Nos annonces d’appartements</h2>
        <section class="container">
         <?php foreach ($listingsApartments as $item)
            {
            include '_item.php';
            }
         ?>
        </section>
    </main>
    <?php include '_footer.php';?>
</body>
</html>