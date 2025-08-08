<?php
session_start();
include '../config.php';
include 'includes/auth.php';

isLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $listing_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id || !$listing_id) {
        header("Location: /");
        exit();
    }

    // Vérifie si le favori existe déjà
    $stmt = $pdo->prepare("SELECT id FROM favoris WHERE user_id = :user_id AND listing_id = :listing_id");
    $stmt->execute([
        ':user_id' => $user_id,
        ':listing_id' => $listing_id
    ]);
    $favori = $stmt->fetch();
    
    if ($favori) {
        // Suppression du favori
        $stmt = $pdo->prepare("DELETE FROM favoris WHERE user_id = :user_id AND listing_id = :listing_id");
        $stmt->execute([
            ':user_id' => $user_id,
            ':listing_id' => $listing_id
        ]);
        $message = "Le bien a été retiré des favoris !";
    } else {
        // Ajout du favori
        $stmt = $pdo->prepare("INSERT INTO favoris (user_id, listing_id) VALUES (:user_id, :listing_id)");
        $stmt->execute([
            ':user_id' => $user_id,
            ':listing_id' => $listing_id
        ]);
        $message = "Le bien a été ajouté aux favoris !";
    }

    header("Location: /");
    exit;
}

?>