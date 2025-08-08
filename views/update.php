<?php
session_start();
include '../config.php';
include 'includes/auth.php';

isLoggedIn();
requireLogin();
requireRole(['admin', 'agent']);


$listing_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$propertyTypes = $pdo->query("SELECT id, name FROM propertyType")->fetchAll(PDO::FETCH_ASSOC);
$transactionTypes = $pdo->query("SELECT id, name FROM transactionType")->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM listing WHERE id = :id");
$stmt->execute([':id' => $listing_id]);
$listing = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$listing) {
    exit("Annonce introuvable.");
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $imagePath = $listing['image_url']; // valeur par défaut (ancienne image)

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $imageTmp = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];
    $imageType = $_FILES['image']['type'];
    $imageName = $_FILES['image']['name'];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    $maxFileSize = 5 * 1024 * 1024;

     if (!in_array($imageType, $allowedTypes)) {
            echo "Type de fichier interdit";
            exit;
        }
    if ($imageSize > $maxFileSize) {
            echo "Taille de fichier trop volumineux";
            exit;
        }
    
        // Supprimer ancienne image 
        if (!empty($listing['image_url'])) {
            $oldPath = __DIR__ . '/../' . $listing['image_url'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // Déplacer nouvelle image
        $extension = pathinfo($imageName, PATHINFO_EXTENSION);
        $newImgName = uniqid('img_', true) . '.' . $extension;
        

        if (!is_dir(UPLOAD_DIR)) {
            mkdir(UPLOAD_DIR, 0755, true);
        }

        $dest = UPLOAD_DIR . $newImgName;

        if (move_uploaded_file($imageTmp, $dest))  {
            $imagePath = UPLOAD_URL . $newImgName;
        } else {
            $errors[] = "Erreur lors de l'envoi de l'image.";
        }
    }

    $new_data = [
        'title' => isset($_POST['title']) ? trim($_POST['title']) : '',
        'property_type_id' => isset($_POST['property_type']) ? trim($_POST['property_type']) : '',
        'price' => isset($_POST['price']) ? trim($_POST['price']) : '',
        'city' => isset($_POST['location']) ? trim($_POST['location']) : '',
        'transaction_type_id' => isset($_POST['transaction_type']) ? trim($_POST['transaction_type']) : '',
        'description' => isset($_POST['description']) ? trim($_POST['description']) : '',
    ];

    //Validation des données 
    if ($new_data['title'] === '') $errors[] = "Le titre est obligatoire.";
    if (!is_numeric($new_data['price']) || $new_data['price'] <= 0) $errors[] = "Le prix doit être un nombre positif.";
    if ($new_data['city'] === '') $errors[] = "La ville est obligatoire.";
    if ($new_data['description'] === '') $errors[] = "La description est obligatoire.";
    if (!in_array($new_data['property_type_id'], array_column($propertyTypes, 'id'))) {
        $errors[] = "Type de bien invalide.";
    }
    if (!in_array($new_data['transaction_type_id'], array_column($transactionTypes, 'id'))) {
        $errors[] = "Type de transaction invalide.";
    }
    

    if (empty($errors)) {
        //Test des données
        $fields_to_update = [];
        $params = [];

        foreach ($new_data as $field => $new_value) {
            $old_value = isset($listing[$field]) ? $listing[$field] : null;

            if ($new_value !== $old_value) {
                $fields_to_update[] = "$field = :$field";
                $params[$field] = $new_value;
            }
    } 
    
    $params['id'] = $listing['ID']; 
    $sql = "UPDATE listing SET " . implode(', ', $fields_to_update) . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        $message = "Annonce mise à jour avec succès.";
        } else {
             $message = "Erreur lors de la mise à jour.";
        }
    } else {
        foreach ($errors as $error) {
            $message .= "<p style='color:red;'>$error</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une annonce</title>
        <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<main class="form-connect" >
<?= $message ?>
<form method="post" class="form-container" enctype="multipart/form-data">
    <h4>Modifier une annonce</h4>
    <?php if (!empty($listing['image_url'])): ?> 
    <img src="../<?= htmlspecialchars($listing['image_url']) ?>" alt="Image actuelle" style="max-width:300px;"><br>
    <?php endif; ?>
    <label for="image">Changer l’image (optionnel)</label>
    <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg, image/webp" />
    <label for="title">Titre :</label>
    <input type="text" name="title" id="title" required value="<?= htmlspecialchars($listing['title']) ?>">
    <label for="property-type">Type de bien :</label>
    <select id="property-type" name="property_type" required>
        <option value="">--Préciser le type de bien svp--</option>
        <?php foreach ($propertyTypes as $type): ?>
            <option value="<?= htmlspecialchars($type['id']) ?>"
                <?= ($listing['property_type_id'] == $type['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($type['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="price">Prix (€) :</label>
    <input type="number" name="price" id="price" required value="<?= htmlspecialchars($listing['price']) ?>">

    <label for="city">Ville :</label>
    <input type="text" name="location" id="location" required value="<?= htmlspecialchars($listing['city']) ?>">
    <label for="transaction-type">Type de transaction :</label>
    <select id="transaction-type" name="transaction_type" required>
        <option value="">--Préciser le type de transaction--</option>
        <?php foreach ($transactionTypes as $type): ?>
            <option value="<?= htmlspecialchars($type['id']) ?>"
                <?= ($listing['transaction_type_id'] == $type['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($type['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>        
    <label for="description">Description :</label>
    <textarea id="description" name="description" cols="30" rows="10" required><?= htmlspecialchars($listing['description']) ?></textarea>
    <button type="submit">Modifier l'annonce</button>
</form>

<div>Retour à l'<a href="/">accueil</a></div>
</main>
</body>
</html>