<?php
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
if(!mysql_connect("localhost","root",""))
{
	die('Probleme de connexion ! --> '.mysql_error());
}
if(!mysql_select_db("bdsona"))
{
	die('Probleme de base de donnees ! --> '.mysql_error());
}?>