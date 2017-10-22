<?php
session_start();
include_once 'dbconnect.php';
if(isset($_POST['submit']))
{
    $user = mysql_query("select id_usr from users where nomUtilisateur= '".$_SESSION['user']."'");
    $field = mysql_fetch_assoc($user);
    $user = $field['id_usr'];
	$chauff = mysql_real_escape_string($_POST['ch']);
	$a_date = mysql_real_escape_string($_POST['da']);
    $r_date = mysql_real_escape_string($_POST['dr']);
	$motif = mysql_real_escape_string($_POST['mt']);
	$chauff = trim($chauff);
    $a_date = trim($a_date);
    $r_date = trim($r_date);
	$motif = trim($motif);
    if(($_SESSION['type'] == 'superieur') || ($_SESSION['type'] == 'admin')) {
        $add = mysql_query("INSERT INTO demande(id_usr,chf,aller_dmd,retour_dmd,motif_dmd,etat_dmd) VALUES('$user','$chauff','$a_date','$r_date','$motif','Acceptée')");
    }
    else {
        $add = mysql_query("INSERT INTO demande(id_usr,chf,aller_dmd,retour_dmd,motif_dmd,etat_dmd) VALUES('$user','$chauff','$a_date','$r_date','$motif','En attente')");
    }
	if($add)
    {
        ?>
        <script>
            alert('Demande envoyée');
            window.location = "index.php";
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
            alert('Erreur dans la demande');
            window.location = "index.php";
        </script>
        <?php
    }
}
if(isset($_POST['modify']))
{
    $user = mysql_query("select id_usr from users where nomUtilisateur= '".$_SESSION['user']."'");
    $field = mysql_fetch_assoc($user);
    $user = $field['id_usr'];
	$chauff = mysql_real_escape_string($_POST['ch']);
	$a_date = mysql_real_escape_string($_POST['da']);
    $r_date = mysql_real_escape_string($_POST['dr']);
	$motif = mysql_real_escape_string($_POST['mt']);
    $id = mysql_real_escape_string($_POST['id']);
	$chauff = trim($chauff);
    $a_date = trim($a_date);
    $r_date = trim($r_date);
	$motif = trim($motif);
    $id = trim($id);
	if(mysql_query("UPDATE demande
                    SET id_usr = '$user',chf = '$chauff',aller_dmd = '$a_date',retour_dmd = '$r_date',motif_dmd = '$motif',etat_dmd = 'En attente'
                    WHERE id_dmd = '$id'"))
		{
			?>
			<script>
                alert('Demande modifiée');
                window.location = "index.php";
            </script>
			<?php
		}
		else
		{
			?>
			<script>
                alert('Erreur dans la modification');
                window.location = "index.php";
            </script>
			<?php
		}
}

if(isset($_POST['delete']))
{
    $id = mysql_real_escape_string($_POST['id']);
    $id = trim($id);
	if(mysql_query("DELETE FROM demande WHERE id_dmd = '$id'"))
		{
			?>
			<script>
                alert('Demande supprimée');
                window.location = "index.php";
            </script>
			<?php
		}
		else
		{
			?>
			<script>
                alert('Erreur dans la suppression');
                window.location = "index.php";
            </script>
			<?php
		}
}

if(isset($_POST['accept']))
{
    $id = mysql_real_escape_string($_POST['id']);
    $id = trim($id);
	if(mysql_query("UPDATE demande
                    SET etat_dmd = 'Acceptée'
                    WHERE id_dmd = '$id'"))
		{
			?>
			<script>
                alert('Demande acceptée');
                window.location = "index.php";
            </script>
			<?php
		}
		else
		{
			?>
			<script>
                alert('Erreur dans l"approbation');
                window.location = "index.php";
            </script>
			<?php
		}
}

if(isset($_POST['refuse']))
{
    $id = mysql_real_escape_string($_POST['id']);
    $id = trim($id);
	if(mysql_query("UPDATE demande
                    SET etat_dmd = 'Refusée'
                    WHERE id_dmd = '$id'"))
		{
			?>
			<script>
                alert('Demande refusée');
                window.location = "index.php";
            </script>
			<?php
		}
		else
		{
			?>
			<script>
                alert('Erreur dans le refus');
                window.location = "index.php";
            </script>
			<?php
		}
}?>