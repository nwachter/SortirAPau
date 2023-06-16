<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/variables.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/functions.php');
require_once('classes/Utilisateur.php');

require('src/model.php');

session_cache_expire();
session_start(); 
	
if(isset($_GET['deconnexion']) ) {
	//deconnexion();								
}

$suggestions = getSuggestions(" ORDER BY RAND() LIMIT 1");
$users = getUtilisateurs();
$sorties = getSorties(" AND s.sor_date between now() AND date_add(now(),INTERVAL 44 WEEK)");
$lieux = getLieux();

require('templates/homepage.php');