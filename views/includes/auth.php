<?php
function isLoggedIn() {
    return isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true;
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

function requireRole($roles = []) {
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $roles)) {
        header("Location: ../index.php");
        $_SESSION['error_message'] = "Accès refusé : vous n'avez pas les permissions nécessaires.";
        exit();
    }
}

?>