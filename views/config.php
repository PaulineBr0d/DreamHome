<?php

$pdo = new PDO('mysql:host=localhost:3306;dbname=dream_home', 'totoro', 'miyazaki', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);