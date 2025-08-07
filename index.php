 <?php 
    session_start();
    require_once 'views/config.php';

        $stmt = $pdo->prepare('SELECT 
            l.*, 
            pt.name AS property_type_name, 
            tt.name AS transaction_type_name
            FROM listing l
            JOIN propertyType pt ON l.property_type_id = pt.id
            JOIN transactionType tt ON l.transaction_type_id = tt.id');
        $stmt->execute();
        $listings = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <?php if ($item['property_type_id'] == 1 ): ?>
                    <?php include 'views/components/_item.php'; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </section>
        <h2>Nos annonces d’appartements</h2>
        <section class="container">
             <?php foreach ($listings as $item): ?>
                <?php if ($item['property_type_id']  == 2): ?>
                    <?php include 'views/components/_item.php'; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        
        </section>
    </main>
    <?php include 'views/components/_footer.php';?>
</body>
</html>