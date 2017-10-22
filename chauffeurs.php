<?php
if(!isset($_SESSION['nav']))
{
    session_start();
    $_SESSION['nav'] = "chauffeurs";
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
              <a class="nav-link active" id="chau" href="chauffeurs.php">Chauffeurs</a>
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
        <h2>Gestion des chauffeurs</h2>   
        <form action="gestChauffeur.php" method="post">
            <h3>Bonjour <?PHP
                include_once 'dbconnect.php';
                $user = mysql_query("SELECT * FROM users WHERE nomUtilisateur= '".$username."'");
                $user = mysql_fetch_assoc($user);
                echo '<b>',$user['nom'],' ';
                echo $user['prenom'],'</b>,';
                ?></h3>
            <h3><label for="cn">Nom du chauffeur :</label></h3>
            <input type="text" name="cn" id="cn" placeholder="Nom du chauffeur" required>
            <h3><label for="cp">Prénom du chauffeur :</label></h3>
            <input type="text" name="cp" id="cp" placeholder="Prénom du chauffeur" required>
            <h3><label for="cm">Matricule du chauffeur :</label></h3>
            <input type="text" name="cm" id="cm" placeholder="Matricule du chauffeur" required>
            <h3><label for="ce">Etat :</label></h3>
            <select name="ce" id="ce" required>
                <option selected disabled>Sélection de l'état</option>
                <option id="dispo" value="dispo">Disponible</option>
                <option id="indispo" value="indispo">Indisponible</option>
                <option id="congé" value="congé">En congé</option>
            </select>
            <button type="submit" name="submit" id="submit"  style="margin-bottom: 30px;">Ajouter</button>
            <button type="submit" name="delete" id="delete"  class="littleButton">Supprimer</button>
        </form>
        <a class="bottom logout" href="logout.php">Déconnexion</a>
        <a class="bottom new" href="chauffeurs.php">Nouveau chauffeur</a>
    </div>
    
    <div class="container" id="collab" style="max-width:465px;">
        <h2>Chauffeurs</h2>
        <ul class="liste">
        <?php
        $chauffeurs=mysql_query("SELECT * FROM chauffeur");
        while ($chauffeur = mysql_fetch_assoc($chauffeurs))
        {
            ?>
            <li class="element" title="Cliquez pour modifier la demande..." onclick="ChauffeurShow('<?PHP echo $chauffeur['nom_chf'];?>','<?PHP echo $chauffeur['prenom_chf'];?>','<?PHP echo $chauffeur['mat_chf'];?>','<?PHP echo $chauffeur['etat_chf'];?>')">
            <?php
            if($chauffeur['etat_chf']=="indispo")
            {
                echo '<b>Nom: </b>' . $chauffeur['nom_chf'] . ', <b>Prénom: </b> '. $chauffeur['prenom_chf'] .'<b style="color: orange;float: right;margin-right:4%;"> Indisponible</b></li>';
            }
            else if($chauffeur['etat_chf']=="dispo")
            {
                echo '<b>Nom: </b>' . $chauffeur['nom_chf'] . ', <b>Prénom: </b> '. $chauffeur['prenom_chf'] .'<b style="color: rgb(39,174,96);float: right;margin-right:4%;"> Disponible</b></li>';
            }
            else
            {
                echo '<b>Nom: </b>' . $chauffeur['nom_chf'] . ', <b>Prénom: </b> '. $chauffeur['prenom_chf'] .'<b style="color: red;float: right;margin-right:4%;"> En congé</b></li>';
            }
        }
        ?>
        </ul>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>