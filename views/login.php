<?php
session_start();
include '../config.php';
include 'includes/auth.php';

isLoggedIn();

$message ='';
$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email)) {
        $errors[] = "L'email est obligatoire.";
    }  
    if (empty($password)) {
        $errors[] = "Le mot de passe est obligatoire.";
    } 

    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email AND password = :password');
        $stmt->bindValue(':email',$email, PDO::PARAM_STR);
        $stmt->bindValue(':password',$password,PDO::PARAM_STR);
        $stmt-> execute();
        $user = $stmt->fetch();
           
        if ($user) {
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['isLoggedIn'] = true;
            header("Location:  ../index.php");
            exit;
        } else {
            $message = "Identifiants incorrects";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion à Find My Dream Home</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="form-connect">
    <main>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="form-container" method="post" id="form-login">
    <h4>Connexion</h4>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <div class="form-alert" id="isEmailValid"></div>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>
    <div  class="form-alert" id="isPassValid"></div>
    <button type="submit">Se connecter</button></form> 
    <div>Pas encore de compte ? <a href="register.php">Inscrivez-vous</a></div>
    <div>Ou retournez à l'<a href="/">accueil</a></div>
    <?php  if (!empty($errors))  : ?>
        <h4>Merci de corriger les erreurs suivantes.</h4>
        <ul class="erreurs">
           <?php foreach ($errors as $error) : ?>
            <li><?= htmlspecialchars($error) ?></li>
          <?php endforeach; ?>    
        </ul>    
    <?php endif; ?> 
    <?php 
        echo "<p>$message</p>";
    ?>

       </main>
    <script src="../js/script.js"></script>
</body>
</html>

