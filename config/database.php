<?php 

function getbdd()
{


	try
	{
	 // On se connecte à MySQL
	 $bdd = new PDO('mysql:dbname=bakacryptos;host=bakacryptos.mysql.db', 'bakacryptos', '314116Ceramiques');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// active les erreurs PDO
	$bdd -> exec("set names utf8"); // pour passer à l'UTF 8
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());// En cas d'erreur, on affiche un message et on arrête tout
	 }

return $bdd;

}




