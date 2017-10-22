<?php
session_start();
include_once 'dbconnect.php';
if(isset($_POST['vls']))
{
    $id = mysql_real_escape_string($_POST['id']);
    $id = trim($id);
    $idv = mysql_real_escape_string($_POST['cars']);
    $idv = trim($idv);
    $idc = mysql_real_escape_string($_POST['drivers']);
    $idc = trim($idc);
    $date_s = mysql_real_escape_string($_POST['ds']);
    $date_s = trim($date_s);
    $dest = mysql_real_escape_string($_POST['dts']);
    $dest = trim($dest);
    $kms = mysql_real_escape_string($_POST['kms']);
    $kms = trim($kms);
    if($idc != "")
    {
        if(mysql_query("UPDATE vehicule SET etat_veh = 'indispo', km_veh = '$kms' WHERE id_veh = '$idv'") && mysql_query("UPDATE chauffeur SET etat_chf = 'indispo' WHERE id_chf = '$idc'") && mysql_query("UPDATE demande SET etat_dmd = 'En cours' WHERE id_dmd = '$id'") && mysql_query("INSERT INTO reservation(id_dmd,id_veh,id_chf,aller_res,kma_res,dest_res) VALUES('$id','$idv','$idc','$date_s','$kms','$dest')"))
		{
			?>
			<script>
                alert('Sortie effectuée');
                window.location = "index.php";
            </script>
			<?php
		}
		else
		{
			?>
			<script>
                alert('Erreur dans la sortie');
                window.location = "index.php";
            </script>
			<?php
		}
    }
    else
    {
        if(mysql_query("UPDATE vehicule SET etat_veh = 'indispo', km_veh = '$kms' WHERE id_veh = '$idv'") && mysql_query("UPDATE chauffeur SET etat_chf = 'indispo' WHERE id_chf = '$idc'") && mysql_query("UPDATE demande SET etat_dmd = 'En cours' WHERE id_dmd = '$id'") && mysql_query("INSERT INTO reservation(id_dmd,id_veh,aller_res,kma_res,dest_res) VALUES('$id','$idv','$date_s','$kms','$dest')"))
		{
			?>
			<script>
                alert('Sortie effectuée');
                window.location = "index.php";
            </script>
			<?php
		}
		else
		{
			?>
			<script>
                alert('Erreur dans la sortie');
                window.location = "index.php";
            </script>
			<?php
		}
    }
    
}

if(isset($_POST['vle']))
{
    $id = mysql_real_escape_string($_POST['id']);
    $id = trim($id);
    $date_e = mysql_real_escape_string($_POST['de']);
    $date_e = trim($date_e);
    $kme = mysql_real_escape_string($_POST['kme']);
    $kme = trim($kme);
    
    if(mysql_query("UPDATE vehicule SET etat_veh = 'dispo', km_veh = '$kme' WHERE id_veh in (SELECT id_veh FROM reservation WHERE id_dmd='$id')") && mysql_query("UPDATE chauffeur SET etat_chf = 'dispo' WHERE id_chf in (SELECT id_chf FROM reservation WHERE id_dmd='$id')") && mysql_query("UPDATE demande SET etat_dmd = 'Terminée' WHERE id_dmd = '$id'") && mysql_query("UPDATE reservation SET retour_res = '$date_e' ,kmr_res = '$kme' WHERE id_dmd='$id'"))
		{
			?>
			<script>
                alert('Entrée effectuée');
                window.location = "index.php";
            </script>
			<?php
		}
		else
		{
			?>
			<script>
                alert('Erreur dans l"entrée');
                window.location = "index.php";
            </script>
			<?php
		}
}?>