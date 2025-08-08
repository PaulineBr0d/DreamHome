<?php
session_start();
include '../config.php';
include 'includes/auth.php';

isLoggedIn();
requireLogin();
requireRole(['admin', 'agent']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $listing_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    // Récupération de l'annonce
    $stmt = $pdo->prepare("SELECT * FROM listing WHERE id = :id");
    $stmt->execute([':id' => $listing_id]);
    $listing = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$listing) {
        exit("Annonce introuvable.");
    }

    // Vérification de permission
    if ($listing['user_id'] != $_SESSION['user_id'] && $_SESSION['role'] !== 'admin') {
        exit("Accès refusé.");
    }

    // Suppression de l'image si elle existe
    if (!empty($listing['image_url'])) {
        $filePath = UPLOAD_DIR . basename($listing['image_url']); 
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    // Suppression de l'annonce
    $stmt = $pdo->prepare("DELETE FROM listing WHERE id = :id");
    $stmt->execute([':id' => $listing_id]);

    // Redirection après suppression
    header("Location: /");
    exit;
}
?>
