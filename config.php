<?php
$host = 'localhost:3306';
$dbname = 'dream_home';
$user = 'totoro';
$pass = 'miyazaki';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connexion échouée : " . $e->getMessage());
}

define('UPLOAD_DIR', __DIR__ . '/upload/'); // pour les opérations sur fichiers
define('UPLOAD_URL', '/upload/');              // pour les URLs côté HTML

?>