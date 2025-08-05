<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm-password']);
    if (empty($email)) {
        $errors[] = "L'email'est obligatoire.";
    }
    if (empty($password)) {
        $errors[] = "Le mot de passe est obligatoire.";
    }
      if (($password)!=($confirmPassword)) {
        $errors[] = "Les mot de passe doit strictement les mêmes.";
    }

    if (empty($errors)) {
        
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte sur Find My Dream Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="form-connect">
    <form action="/" method="post">
    <h2>Inscription</h2>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>
    <label for="confirm-password">Confirmer le mot de passe</label>
    <input type="password" name="confirm-password" id="confirm-password" required>
    <button type="submit">S'inscrire</button>  
    <div>Déjà inscrit ? <a href="/login.php">Connectez-vous</div>
     <?php  if (!empty($errors))  : ?>
        <h2>Merci de corriger les erreurs suivantes.</h2>
        <ul>
           <?php foreach ($errors as $error) : ?>
            <li><?= error ?></li>
          <?php endforeach; ?>    
        </ul>    
    <?php endif; ?>  
</body>
</html>
