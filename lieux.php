<?php 
	session_cache_expire();
	session_start(); 
	 
	include_once('variables.php'); 
	include_once('functions.php');	
	require_once('classes/Utilisateur.php');

	require('src/model.php');
	require('src/lieuxModel.php');

	if(isset($_GET['deconnexion']) ) {
		deconnexion();								
	}

	$suggestions = getSuggestions(" ORDER BY RAND() LIMIT 3");
	$users = getUtilisateurs();
	$sorties = getSorties(" AND s.sor_date between now() AND date_add(now(),INTERVAL 44 WEEK)");
	$lieux = getLieux(); 

	        if(isset($_POST["submit_lieu"]) && $loggedIn && $isAdmin ) {
				if( ($lieu_array = validateLieu($_POST)) != false) {
					if (insertLieu($lieu_array)) $message = "Le lieu a bien été proposé ! Merci de votre contribution !<br>";
					else $message = "Erreur technique lors de la proposition du lieu, veuillez réessayer.<br>";		
				}
				else $message = "Certains champs sont invalides. <br>";         
	        }
	        else if (isset($_POST['submit_lieu']) && !$loggedIn) {
	            $message = "Vous ne pouvez pas proposer un lieu sans être connecté!<br>";
	            header('Location: localhost/sign/connexion.php');
	        }

	require('templates/lieuxView.php');
