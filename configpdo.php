<?php
try {	
	$host = "localhost";
	$user = "root";
	$pass = "***********";
	$db = "id19008650_database";

    $bdd = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());

}    
?>