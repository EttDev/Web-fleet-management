<?php
if(!isset($_SESSION['nav']))
{
    session_start();
    $_SESSION['nav'] = "rapports";
    header('Location: index.php');
}
date_default_timezone_set('Africa/Algiers');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gestion des demandes de véhicule</title>
    <link href="bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="topContainer">
        <a class="navbar-brand" href="dashboard.php">Tableau de bord</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" id="dem" href="dashboard.php">Demandes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="veh" href="vehicules.php">Véhicules</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="chau" href="chauffeurs.php">Chauffeurs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="rapp" href="rapports.php">Rapports</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<div class="largeContainerSmall">  
    <div class="container" style="border-left: none;">
        <h2>Export des réservations</h2>
        <form method="post" action="export.php" id="export_reservation">
            <h3>Bonjour <b><?PHP
                include_once 'dbconnect.php';
                $user = mysql_query("SELECT * FROM users WHERE nomUtilisateur= '".$username."'");
                $user = mysql_fetch_assoc($user);
                echo $user['nom'],' ';
                echo $user['prenom'],',';
                ?></b></h3>
            <h3><label for="dMinRes">Date et heure minimales :</label></h3>
            <input title="Date et heure min" type="datetime-local" name="dMinRes" id="dMinRes" required>
            <h3><label for="dMaxRes">Date et heure maximales :</label></h3>
            <input title="Date et heure max" type="datetime-local" name="dMaxRes" id="dMaxRes" onfocus="dateMin(dMaxResd,MinRes)" required>
            <button type="submit" name="submit" id="submit" style="margin-bottom: 30px;">Exporter</button>
        </form>
        <a class="bottom" href="logout.php">Déconnexion</a>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>