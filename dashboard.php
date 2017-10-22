<?php
if(!isset($_SESSION['user']))
{
    if(!isset($_SESSION['nav']))
    {
        session_start();
        $_SESSION['nav'] = "dashboard";
    }
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
              <a class="nav-link active" id="dem" href="dashboard.php">Demandes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="veh" href="vehicules.php">Véhicules</a>
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
<div class="largeContainerBig">  
    <div class="container" style="border-left: none;">
        <h2>Demande de véhicule</h2>   
        <form action="gestDemande.php" method="post">
            <h3>Bonjour <b><?PHP
                include_once 'dbconnect.php';
                $user = mysql_query("SELECT * FROM users WHERE nomUtilisateur= '".$username."'");
                $user = mysql_fetch_assoc($user);
                echo $user['nom'],' ';
                echo $user['prenom'],',';
                ?></b></h3>
            <h3>voulez-vous un conducteur ?</h3>
            <input type="radio" name="ch" value="yes" id="yes" required>
            <label for="yes">Oui</label>
            <input type="radio" name="ch" value="no" id="no" required>
            <label for="no">Non</label>
            <h3><label for="da">Date et heure de l'aller :</label></h3>
            <input type="datetime-local" name="da" id="da" min="<?php echo date('Y-m-d\TH:i');?>" required>
            <h3><label for="dr">Date et heure du retour :</label></h3>
            <input type="datetime-local" name="dr" id="dr" onfocus="DateMin(dr,da)" required>
            <h3><label for="mt">Motif de la demande :</label></h3>
            <textarea name="mt" id="mt" placeholder="Motif de la demande..." required></textarea>
            <button type="submit" name="submit" id="submit"  style="margin-bottom: 30px;">Envoyer</button>
            <button type="submit" name="delete" id="delete"  class="littleButton">Supprimer</button>
        </form>
        <a class="bottom logout" href="logout.php">Déconnexion</a>
        <a class="bottom new" href="newDemande.php">Nouvelle demande</a>
    </div>
    <div class="container" style="max-width:465px;">
        <h2>Aller</h2>
        <form action="gestReservation.php" method="post">
            <select class="littleSelect" id="cars" name="cars" required disabled>
                <option id="vehicule" selected disabled value>Sélection du véhicule</option>
                <?php
                $cars=mysql_query("SELECT * FROM vehicule");
                while ($car = mysql_fetch_assoc($cars) )
                {
                        echo '<option value="'.$car['id_veh'].'" ';
                    if($car['etat_veh']!="dispo") echo 'disabled';
                    echo ' id="vehicule'.$car['id_veh'].'">' .$car['nom_veh'].' - '.$car['mat_veh'].'</option>';
                }
                ?>
            </select>
            <select class="littleSelect" style="margin-left:4%;" id="drivers" name="drivers" disabled>
                <option id="driver" selected disabled value>Sélection du chauffeur</option>
                <?php
                $drivers=mysql_query("SELECT * FROM chauffeur");
                while ($driver = mysql_fetch_assoc($drivers) )
                {
                        echo '<option value="'.$driver['id_chf'].'" ';
                        if($driver['etat_chf']!="dispo") echo 'disabled';
                        echo ' id="driver'.$driver['id_chf'].'">' .$driver['nom_chf']. ' ' .$driver['prenom_chf'].'</option>';
                }
                ?>
            </select>
            <input type="datetime-local" name="ds" id="ds" min="<?php echo date('Y-m-d\TH:i');?>" required readonly>
            <input type="text" name="dts" id="dts" placeholder="Destination" required readonly>
            <input type="number" min="0" name="kms" id="kms" placeholder="Kilométrage à aller" required readonly>
            <button type="submit" name="vls" id="vls" disabled>Valider</button>
        <h2 style="margin-bottom:20px;">Retour</h2>
            <input type="datetime-local" name="de" id="de" onfocus="DateMin(de,ds)" required readonly>
            <input type="number" id="kme" name="kme" onclick="DateMin(kme,kms)" placeholder="Kilométrage au retour" required readonly>
            <input name="id" id="id">
            <button type="submit" name="vle" id="vle" disabled>Valider</button>
        </form>
    </div>
    <div class="container" id="collab" style="max-width:465px;">
        <h2>Demandes collaborateurs</h2>
        <ul class="liste">
        <?php
        $dmdsCollab=mysql_query("SELECT * FROM reservation r right join demande d natural join users on r.id_dmd=d.id_dmd where etat_dmd in ('Acceptée','En cours','Terminée') ORDER BY aller_dmd DESC");
        while ($dmdCollab = mysql_fetch_assoc($dmdsCollab))
        {
            ?>
            <li class="element" title="Cliquez pour modifier la demande..." onclick="ParamShowWor('<?PHP echo $dmdCollab['id_dmd'];?>','<?PHP echo $dmdCollab['chf'];?>','<?PHP echo date_format(date_create($dmdCollab['aller_dmd']), 'Y-m-d\TH:i');?>','<?PHP echo date_format(date_create($dmdCollab['retour_dmd']), 'Y-m-d\TH:i');?>','<?PHP echo $dmdCollab['motif_dmd'];?>','<?PHP echo $dmdCollab['etat_dmd'];?>'); ReservationShow('<?PHP echo $dmdCollab['id_chf'];?>','<?PHP echo $dmdCollab['id_veh'];?>','<?PHP echo date_format(date_create($dmdCollab['aller_res']), 'Y-m-d\TH:i');?>','<?PHP echo $dmdCollab['kma_res'];?>','<?PHP echo date_format(date_create($dmdCollab['retour_res']), 'Y-m-d\TH:i');?>','<?PHP echo $dmdCollab['kmr_res'];?>','<?PHP echo $dmdCollab['dest_res'];?>')">
            <?php
            if($dmdCollab['etat_dmd']=="En cours")
            {
                echo '<b>Nom: </b>' . $dmdCollab['nom'] . ', <b>Prénom: </b> '. $dmdCollab['prenom'] .'<b style="color: orange;float: right;margin-right:4%;"> '. $dmdCollab['etat_dmd'] . '</b></li>';
            }
            else if($dmdCollab['etat_dmd']=="Acceptée")
            {
                echo '<b>Nom: </b>' . $dmdCollab['nom'] . ', <b>Prénom: </b> '. $dmdCollab['prenom'] .'<b style="color: darkgray;float: right;margin-right:4%;"> En attente</b></li>';
            }
            else
            {
                echo '<b>Nom: </b>' . $dmdCollab['nom'] . ', <b>Prénom: </b> '. $dmdCollab['prenom'] .'<b style="color: rgb(39,174,96);float: right;margin-right:4%;"> '. $dmdCollab['etat_dmd'] . '</b></li>';
            }
        }
        ?>
        </ul>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>