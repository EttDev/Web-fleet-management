<?php
session_start();
if(isset($_POST['submit']))
{
    include_once 'dbconnect.php';
	$username = mysql_real_escape_string($_POST['un']);
	$password = mysql_real_escape_string($_POST['pw']);	
	$username = trim($username);
	$password = trim($password);	
	$user=mysql_query("SELECT * FROM users WHERE nomUtilisateur='$username'");
    $count = mysql_num_rows($user);
	$user=mysql_fetch_array($user);
	if($count == 1 && $user['motDePasse']==md5($password))
	{
		$_SESSION['user'] = $user['nomUtilisateur'];
        $_SESSION['type'] = $user['type_user'];
        header("Location: index.php");
	}
	else
	{
		?>
        <script>
            alert('Nom d"utilisateur ou mot de passe incorrect');
            window.location = "index.php";
        </script>
        <?php
	}
}?>