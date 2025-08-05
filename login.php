<?php
$errors = [];
$emailReg = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
$pwdReg = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if (empty($email)) {
        $errors[] = "L'email'est obligatoire.";
    }  elseif (!preg_match($emailReg, $email)) {
        $errors[] = "Format de l'email invalide.";
    }

    if (empty($password)) {
        $errors[] = "Le mot de passe est obligatoire.";
    } elseif (!preg_match($pwdReg, $password)) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
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
    <title>Connexion à Find My Dream Home</title>
    <link rel="stylesheet" href="style.css">
</head>
 <?php include '_header.php';?>
<body>
    <main class="form-connect">
    <form action="/" method="post">
    <h2>Connexion</h2>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Se connecter</button></form> 
    <div>Pas encore de compte ? <a href="/register.php">Inscrivez-vous</div>
    <?php  if (!empty($errors))  : ?>
        <h2>Merci de corriger les erreurs suivantes.</h2>
        <ul>
           <?php foreach ($errors as $error) : ?>
            <li><?= error ?></li>
          <?php endforeach; ?>    
        </ul>    
    <?php endif; ?> 
       </main>
       <?php include '_footer.php';?>
</body>
</html>

