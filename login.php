<?php 
session_start();
if(isset($_SESSION['user']))
{
	$username=$_SESSION['user'];
    $type=$_SESSION['type'];
	if($type == 'admin') 
    {
        if(isset($_SESSION['nav']))
        {
            $nav=$_SESSION['nav'];
            if($nav == 'dashboard') require('dashboard.php');
            else if($nav == 'chauffeurs') require('chauffeurs.php');
            else if($nav == 'vehicules') require('vehicules.php');
            else require('rapports.php');
        }
        else require('dashboard.php');
    }
    else if($type == 'superieur') require('supervisor.php');
    else require('demande.php');
    exit;
}?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Demande de véhicule</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="largeContainerSmall" >
        <h2>Se connecter</h2>
        <form method="post" action="checkLogin.php" required>
            <input type="text" placeholder="Nom d'utilisateur" name="un" required autofocus>
            <input type="password" placeholder="Mot de passe" name="pw" required>
            <button name="submit" style="margin-bottom: 30px;" type="submit"> Connexion </button>
        </form>
        <a class="bottom logout" style="bottom: 10px;" href="register.php">Créer un compte</a>
        <a class="bottom new" style="bottom: 10px;" href="password.php">Mot de passe oublié ?</a>
    </div>
</body>
</html>