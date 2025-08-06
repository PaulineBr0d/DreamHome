<?php
session_start();
if (!isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] === true) {
    header("Location: ????.php"); 
    exit();
}
$errors = [];

/*$emailReg = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
$pwdReg = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";*/

// pour test uniquement => utiliser password_hash()
$utilisateur = [
    'email' => 'toto@gmail.com',
    'password' => 'Toto123!' 
];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email)) {
        $errors[] = "L'email'est obligatoire.";
    }  /*elseif (!preg_match($emailReg, $email)) {
        $errors[] = "Format de l'email invalide.";
    }*/

    if (empty($password)) {
        $errors[] = "Le mot de passe est obligatoire.";
    } /*elseif (!preg_match($pwdReg, $password)) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
    }*/

    if (empty($errors)) {
        // if ($email === $utilisateur['email'] && $password === $utilisateur['password']) {
            $_SESSION['email'] = $email;
            $_SESSION['isLoggedIn'] = true;
            header("Location: ????.php");
            exit;
        }    
    }
//}
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
<body class="form-connect">
    <main>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="form-login">
    <h4>Connexion</h4>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <div class="form-alert" id="isEmailValid"></div>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>
    <div  class="form-alert" id="isPassValid"></div>
    <button type="submit">Se connecter</button></form> 
    <div>Pas encore de compte ? <a href="/register.php">Inscrivez-vous</a></div>
    <?php  if (!empty($errors))  : ?>
        <h4>Merci de corriger les erreurs suivantes.</h4>
        <ul class="erreurs">
           <?php foreach ($errors as $error) : ?>
            <li><?= htmlspecialchars($error) ?></li>
          <?php endforeach; ?>    
        </ul>    
    <?php endif; ?> 
       </main>
       <?php include '_footer.php';?>
    <script src="script.js"></script>
</body>
</html>

