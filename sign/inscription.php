<?php
	session_cache_expire();
	session_start(); 
	 
	require($_SERVER['DOCUMENT_ROOT'].'/variables.php'); 
	require($_SERVER['DOCUMENT_ROOT'].'/functions.php');
	require($_SERVER['DOCUMENT_ROOT'].'/src/model.php');
	require($_SERVER['DOCUMENT_ROOT'].'/src/inscriptionModel.php');		        
	$message = '';

	$d = new DateTime;
	$d = toString_datetime($d);
	$message .= "Date et heure actuelles : ".$d."<br>";

	if(isset($_POST["submit"])) {

		if($util_array = verifInscription($_POST, $ast_array)) {
		    if(insert_utilisateur($util_array)) {
		    	$message .= "Inscription confirmée ! Bienvenue !";
		    }
		    else $message .= "Erreur lors de l'inscription, veuillez recommencer !";			
		}
		else $message .= "Certains champs sont invalides.";
	}

	require($_SERVER['DOCUMENT_ROOT'].'/templates/inscriptionView.php');
?>