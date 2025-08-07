<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/auth.php';

isLoggedIn();
requireLogin();
requireRole(['admin', 'user_id']);


$listing_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM listing WHERE id = :id");
$stmt->execute([':id' => $listing_id]);
$listing = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$listing) {
    exit("Annonce introuvable.");
}

?>