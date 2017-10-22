<?php
session_start();
include_once 'dbconnect.php';
if(isset($_POST['submit']))
{
	$nom = mysql_real_escape_string($_POST['cn']);
	$prenom = mysql_real_escape_string($_POST['cp']);
    $mat = mysql_real_escape_string($_POST['cm']);
    $etat = mysql_real_escape_string($_POST['ce']);
	$nom = trim($nom);
    $prenom = trim($prenom);
    $mat = trim($mat);
    $etat = trim($etat);
	if(mysql_query("INSERT INTO chauffeur (nom_chf,prenom_chf,mat_chf,etat_chf) VALUES ('$nom','$prenom','$mat','$etat')"))
    {
        ?>
        <script>
            alert('Chauffeur ajouté');
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
    $nom = mysql_real_escape_string($_POST['cn']);
	$prenom = mysql_real_escape_string($_POST['cp']);
    $mat = mysql_real_escape_string($_POST['cm']);
    $etat = mysql_real_escape_string($_POST['ce']);
	$nom = trim($nom);
    $prenom = trim($prenom);
    $mat = trim($mat);
    $etat = trim($etat);
	if(mysql_query("UPDATE chauffeur
                    SET nom_chf = '$nom',prenom_chf = '$prenom',etat_chf = '$etat'
                    WHERE mat_chf = '$mat'"))
		{
			?>
			<script>
                alert('Chauffeur modifié');
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
    $mat = mysql_real_escape_string($_POST['cm']);
    $mat = trim($mat);
	if(mysql_query("DELETE FROM chauffeur WHERE mat_chf = '$mat'"))
		{
			?>
			<script>
                alert('Chauffeur supprimé');
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