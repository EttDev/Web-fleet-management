<?php
session_start();
include_once 'dbconnect.php';
if(isset($_POST['submit']))
{
	$nom = mysql_real_escape_string($_POST['vn']);
	$marque = mysql_real_escape_string($_POST['vm']);
    $mat = mysql_real_escape_string($_POST['vi']);
	$km = mysql_real_escape_string($_POST['vk']);
    $etat = mysql_real_escape_string($_POST['ve']);
	$nom = trim($nom);
    $marque = trim($marque);
    $mat = trim($mat);
	$km = trim($km);
    $etat = trim($etat);
	if(mysql_query("INSERT INTO vehicule (nom_veh,mrq_veh,mat_veh,etat_veh,km_veh) VALUES ('$nom','$marque','$mat','$etat','$km')"))
    {
        ?>
        <script>
            alert('Véhicule ajouté');
            window.location = "index.php";
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
            alert('Ajout impossible');
            window.location = "index.php";
        </script>
        <?php
    }
}

if(isset($_POST['modify']))
{
    $nom = mysql_real_escape_string($_POST['vn']);
	$marque = mysql_real_escape_string($_POST['vm']);
    $mat = mysql_real_escape_string($_POST['vi']);
	$km = mysql_real_escape_string($_POST['vk']);
    $etat = mysql_real_escape_string($_POST['ve']);
	$nom = trim($nom);
    $marque = trim($marque);
    $mat = trim($mat);
	$km = trim($km);
    $etat = trim($etat);
	if(mysql_query("UPDATE vehicule
                    SET nom_veh = '$nom',mrq_veh = '$marque',km_veh = '$km',etat_veh = '$etat'
                    WHERE mat_veh = '$mat'"))
		{
			?>
			<script>
                alert('Véhicule modifié');
                window.location = "index.php";
            </script>
			<?php
		}
		else
		{
			?>
			<script>
                alert('Modification impossible');
                window.location = "index.php";
            </script>
			<?php
		}
}

if(isset($_POST['delete']))
{
    $mat = mysql_real_escape_string($_POST['vi']);
    $mat = trim($mat);
	if(mysql_query("DELETE FROM vehicule WHERE mat_veh = '$mat'"))
		{
			?>
			<script>
                alert('Véhicule supprimé');
                window.location = "index.php";
            </script>
			<?php
		}
		else
		{
			?>
			<script>
                alert('Suppression impossible');
                window.location = "index.php";
            </script>
			<?php
		}
}?>