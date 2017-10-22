<?php
if(!isset($_SESSION['user'])) header('Location: index.php');
date_default_timezone_set('Africa/Algiers');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gestion des demandes de véhicule</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="largeContainerBig">  
    <div class="container" style="border-left: none;">
        <h2>Demande de véhicule</h2>   
        <form id="contact" action="gestDemande.php" method="post">
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
            <input name="id" id="id">
            <button type="submit" name="submit" id="submit"  style="margin-bottom: 30px;">Envoyer</button>
            <button type="submit" name="delete" id="delete"  class="littleButton">Supprimer</button>
        </form>
        <a class="bottom logout" href="logout.php">Déconnexion</a>
        <a class="bottom new" href="newDemande.php">Nouvelle demande</a>
    </div>
    <div class="container" style="max-width:465px;">
        <h2>Liste des demandes</h2>
        <ul>
        <?php
        $dmds=mysql_query("SELECT * FROM demande where id_usr= '".$user['id_usr']."' ORDER BY CASE etat_dmd 
        WHEN 'En attente' THEN 1 
        WHEN 'Acceptée' THEN 2 
        WHEN 'Refusée' THEN 3 
        END,aller_dmd DESC");
        while ($dmd = mysql_fetch_assoc($dmds))
        {
            ?>
            <li title="Cliquez pour modifier la demande..." onclick="ParamShow('<?PHP echo $dmd['id_dmd'];?>','<?PHP echo $dmd['chf'];?>','<?PHP echo date_format(date_create($dmd['aller_dmd']), 'Y-m-d\TH:i');?>','<?PHP echo date_format(date_create($dmd['retour_dmd']), 'Y-m-d\TH:i');?>','<?PHP echo $dmd['motif_dmd'];?>','<?PHP echo $dmd['etat_dmd'];?>')">
            <?php
            if(($dmd['etat_dmd']=="En attente") || ($dmd['etat_dmd']=="En cours"))
            {
                echo '<b>Aller:</b> ' . date_format(date_create($dmd['aller_dmd']), 'd/m/Y à H:i') . ', <b>Retour:</b> '. date_format(date_create($dmd['retour_dmd']), 'd/m/Y à H:i').',<b style="color: orange ;"> '. $dmd['etat_dmd'] . '</b></li>';
            }
            else if (($dmd['etat_dmd']=="Acceptée") || ($dmd['etat_dmd']=="Terminée"))
            {
                echo '<b>Aller:</b> ' . date_format(date_create($dmd['aller_dmd']), 'd/m/Y à H:i') . ', <b>Retour:</b> '. date_format(date_create($dmd['retour_dmd']), 'd/m/Y à H:i').',<b style="color: rgb(39,174,96) ;"> '. $dmd['etat_dmd'] . '</b></li>';
            }
            else
            {
                echo '<b>Aller:</b> ' . date_format(date_create($dmd['aller_dmd']), 'd/m/Y à H:i') . ', <b>Retour:</b> '. date_format(date_create($dmd['retour_dmd']), 'd/m/Y à H:i').',<b style="color: red ;"> '. $dmd['etat_dmd'] . '</b></li>';
            }
        }
        ?>
        </ul>
    </div>
    <div class="container" id="collab" style="max-width:465px;">
        <h2>Demandes collaborateurs</h2>
        <ul class="liste">
        <?php
        $dmdsCollab=mysql_query("SELECT * FROM demande natural join users where direction= '".$user['direction']."' AND id_usr!= '".$user['id_usr']."' ORDER BY CASE etat_dmd 
        WHEN 'En attente' THEN 1 
        WHEN 'Acceptée' THEN 2 
        WHEN 'Refusée' THEN 3 
        END,aller_dmd DESC");
        while ($dmdCollab = mysql_fetch_assoc($dmdsCollab))
        {
            ?>
            <li class="element" title="Cliquez pour modifier la demande..." onclick="ParamShowCow('<?PHP echo $dmdCollab['id_dmd'];?>','<?PHP echo $dmdCollab['chf'];?>','<?PHP echo date_format(date_create($dmdCollab['aller_dmd']), 'Y-m-d\TH:i');?>','<?PHP echo date_format(date_create($dmdCollab['retour_dmd']), 'Y-m-d\TH:i');?>','<?PHP echo $dmdCollab['motif_dmd'];?>','<?PHP echo $dmdCollab['etat_dmd'];?>')">
            <?php
            if(($dmdCollab['etat_dmd']=="En attente") || ($dmdCollab['etat_dmd']=="En cours"))
            {
                echo '<b>Nom: </b>' . $dmdCollab['nom'] . ', <b>Prénom: </b> '. $dmdCollab['prenom'] .'<b style="color: orange ;float: right;margin-right:2.5%;"> '. $dmdCollab['etat_dmd'] . '</b></li>';
            }
            else if (($dmdCollab['etat_dmd']=="Acceptée") || ($dmdCollab['etat_dmd']=="Terminée"))
            {
                echo '<b>Nom: </b>' . $dmdCollab['nom'] . ', <b>Prénom: </b> '. $dmdCollab['prenom'] .'<b style="color: rgb(39,174,96);float: right;margin-right:4%;"> '. $dmdCollab['etat_dmd'] . '</b></li>';
            }
            else
            {
                echo '<b>Nom: </b>' . $dmdCollab['nom'] . ', <b>Prénom: </b> '. $dmdCollab['prenom'] .'<b style="color: red ;float: right;margin-right:6%;"> '. $dmdCollab['etat_dmd'] . '</b></li>';
            }
        }
        ?>
        </ul>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>