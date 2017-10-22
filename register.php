<?php 
session_start();
if(isset($_SESSION['user'])!="")
{
	$user=$_SESSION['user'];
    $type=$_SESSION['type'];
	if($type == 'admin') header("Location: dashboard.php");
    else if($type == 'superieur') header("Location: supervisor.php");
    else header("Location: demande.php");
}?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inscription</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <!--<img src="images/Sonatrach.svg.png">-->
    <div class="largeContainerSmall" >
    <h2>Inscription</h2>
    <form method="post" action="sendRegister.php" required>
        <input type="email" placeholder="E-mail" name="em" required autofocus>
        <input type="password" placeholder="Mot de passe" name="pw" required>
        <input type="text" placeholder="Nom" name="nm" required>
        <input type="text" placeholder="Prénom" name="pn" required>
        <select name="dr" required>
            <option selected disabled value>Direction</option>
            <option value="prod">Production</option>
        </select>
        <select name="dv" required>
            <option selected disabled value>Division</option>
            <option value="SPE">Stratégie, Planification & Économie</option>
            <option value="FIN">Finances</option>
            <option value="RHU">Ressources Humaines</option>
            <option value="BDM">Business Développement Marketing</option>
            <option value="ACT">Activités Centrales</option>
            <option value="JUR">Juridique</option>
            <option value="ISI">Informatique & Système d'Information</option>
            <option value="MLG">Marchés et Logistique</option>
            <option value="HSE">Santé, sécurité & environnement</option>
            <option value="RDT">Recherche & Développement</option>
        </select>
        <select name="ty" required>
            <option selected disabled value>Type d'utilisateur</option>
            <option value="admin">Administrateur</option>
            <option value="superieur">Supérieur</option>
            <option value="simple">Employé</option>
        </select>
        <button name="submit" type="submit"> S'inscrire</button>
        <a class="bottom" href="index.php">S'authentifier</a>
    </form>
    </div>
</body>
</html>