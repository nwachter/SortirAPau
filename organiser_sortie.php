<?php
	session_cache_expire();
	session_start(); 

    error_reporting(-1);
    ini_set('display_errors', 'On');     
     
    require_once('variables.php'); 
    require_once('functions.php'); 
    require_once('src/model.php');
    require_once('src/organiser_sortieModel.php');

    		$message = "";
    		$lieux = getLieux();

	        $d = new DateTime;
	        $d = toString_datetime($d);	        
	        //$date = toString_datetime($date);
	        $message = "Date et heure actuelles : ".$d."<br>";

	        if(isset($_POST["submit_sortie"]) && $loggedIn ) {
				
				if(($sor_array = validateSortie($_POST)) != false) {
					if(insertSortie($sor_array)) {
					$sortieCree = true;
					$message .= "Vous avez bien crée la sortie !";

					}
				}
				else {
					$message .= "La validation de la sortie a échoué. <br>";
				}         
	        }
	        else if (isset($_POST['submit_sortie']) && !$loggedIn) {
	            $message .= "Vous n'êtes pas connecté !<br>";
	            header('Location: ../sign/connexion.php');
	        }

		require('templates/organiser_sortieView.php');