<?php
session_start();
if(isset($_POST['submit']))
{
    include_once 'dbconnect.php';
	$email = mysql_real_escape_string($_POST['em']);
    $password = mysql_real_escape_string($_POST['pw']);
	$nom = mysql_real_escape_string($_POST['nm']);
    $prenom = mysql_real_escape_string($_POST['pn']);
	$direction = mysql_real_escape_string($_POST['dr']);
	$division = mysql_real_escape_string($_POST['dv']);
    $type = mysql_real_escape_string($_POST['ty']);
    $email = trim($email);
    $password = trim($password);
	$nom = trim($nom);
    $prenom = trim($prenom);
	$direction = trim($direction);
	$division = trim($division);
    $type = trim($type);
    $password = md5($password);
    
    if(mysql_query("INSERT INTO users(nomUtilisateur,motDePasse,nom,prenom,direction,division,type_user) VALUES('$email','$password','$nom','$prenom','$direction','$division','$type')"))
		{
			?>
			<script>
                alert('Inscription réussie');
                window.location = "index.php";
            </script>
			<?php
		}
		else
		{
			?>
			<script>
                alert("Erreur lors de l'inscription");
                window.location = "index.php";
            </script>
			<?php
		}
}?>