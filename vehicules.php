<?php
if(!isset($_SESSION['nav']))
{
    session_start();
    $_SESSION['nav'] = "vehicules";
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
              <a class="nav-link active" id="veh" href="vehicules.php">Véhicules</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="chau" href="chauffeurs.php">Chauffeurs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="rapp" href="rapports.php">Rapports</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<div class="largeContainerMedium">  
    <div class="container" style="border-left: none;">
        <h2>Gestion des véhicules</h2>   
        <form action="gestVehicule.php" method="post">
            <h3>Bonjour <?PHP
                include_once 'dbconnect.php';
                $user = mysql_query("SELECT * FROM users WHERE nomUtilisateur= '".$username."'");
                $user = mysql_fetch_assoc($user);
                echo '<b>',$user['nom'],' ';
                echo $user['prenom'],'</b>,';
                ?></h3>
            <h3><label for="vn">Nom du véhicule :</label></h3>
            <input type="text" name="vn" id="vn" placeholder="Nom du véhicule" required>
            <h3><label for="vm">Marque du véhicule :</label></h3>
            <input type="text" name="vm" id="vm" placeholder="Marque du véhicule" required>
            <h3><label for="vi">Numéro d'immatriculation :</label></h3>
            <input type="text" name="vi" id="vi" placeholder="Numéro d'immatriculation" required>
            <h3><label for="vk">Kilométrage :</label></h3>
            <input type="text" name="vk" id="vk" placeholder="Kilométrage" required>
            <h3><label for="ve">Etat :</label></h3>
            <select name="ve" id="ve" required>
                <option selected disabled>Sélection de l'état</option>
                <option id="dispo" value="dispo">Disponible</option>
                <option id="indispo" value="indispo">Indisponible</option>
                <option id="enpanne" value="enpanne">En panne</option>
            </select>
            <button type="submit" name="submit" id="submit"  style="margin-bottom: 30px;">Ajouter</button>
            <button type="submit" name="delete" id="delete"  class="littleButton">Supprimer</button>
        </form>
        <a class="bottom logout" href="logout.php">Déconnexion</a>
        <a class="bottom new" href="vehicules.php">Nouveau véhicule</a>
    </div>
    
    <div class="container" id="collab" style="max-width:465px;">
        <h2>Véhicules</h2>
        <ul class="liste">
        <?php
        $vehicules=mysql_query("SELECT * FROM vehicule");
        while ($vehicule = mysql_fetch_assoc($vehicules))
        {
            ?>
            <li class="element" title="Cliquez pour modifier la demande..." onclick="VehiculeShow('<?PHP echo $vehicule['nom_veh'];?>','<?PHP echo $vehicule['mrq_veh'];?>','<?PHP echo $vehicule['mat_veh'];?>','<?PHP echo $vehicule['km_veh'];?>','<?PHP echo $vehicule['etat_veh'];?>')">
            <?php
            if($vehicule['etat_veh']=="indispo")
            {
                echo '<b>Nom: </b>' . $vehicule['nom_veh'] . ', <b>Immatriculation: </b> '. $vehicule['mat_veh'] .'<b style="color: orange;float: right;margin-right:4%;"> Indisponible</b></li>';
            }
            else if($vehicule['etat_veh']=="dispo")
            {
                echo '<b>Nom: </b>' . $vehicule['nom_veh'] . ', <b>Immatriculation: </b> '. $vehicule['mat_veh'] .'<b style="color: rgb(39,174,96);float: right;margin-right:4%;"> Disponible</b></li>';
            }
            else
            {
                echo '<b>Nom: </b>' . $vehicule['nom_veh'] . ', <b>Immatriculation: </b> '. $vehicule['mat_veh'] .'<b style="color: red;float: right;margin-right:4%;"> En panne</b></li>';
            }
        }
        ?>
        </ul>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>