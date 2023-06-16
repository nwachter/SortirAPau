<?php 
	session_cache_expire();
	session_start(); 
	 
	include_once($_SERVER['DOCUMENT_ROOT'].'/variables.php'); 
	include_once($_SERVER['DOCUMENT_ROOT'].'/functions.php');	
	require($_SERVER['DOCUMENT_ROOT'].'/src/model.php');
	require($_SERVER['DOCUMENT_ROOT'].'/src/administrationModel.php');

	$message = '';

    if (!isset($_SESSION['util_id'])  )
    {
        echo("Accès refusé : Vous n'êtes pas connecté.");
        return;
    }

    if ($_SESSION['util_groupe'] != 1) 
    {
        echo("Accès refusé : Vous n'êtes pas un administrateur.");
        return;
    }

	if(isset($_GET['deconnexion']) ) {
		deconnexion();								
	}


    $users = getUtilisateurs();
    $sortiesAValider = getSorties(" AND sor_valide = 0");
    $sortiesValides = getSorties(" AND sor_valide = 1");
    $lieux = getLieux();
    $groupes = getGroupes();

	if(isset($_POST['submit_groupe']) && isset($_GET['util_id']) && isset($_POST['util_groupe']) ) {
		if(updateGroupe($_GET['util_id'], $_POST['util_groupe'])) {
			$message .= "Utilisateur N°".$_GET['util_id']." modifié ; Nouveau groupe : ".$_POST['util_groupe']."<br>";			
		}								        
	}


	if(isset($_POST['submit_supprimer_sortie']) && isset($_POST['sor_ref']) ) {
		if(supprimer($_POST['sor_ref'])) {
			$message .= "La sortie n°".$_POST['sor_ref']." a bien été modifiée !<br>";

		}
		
	}

	if(isset($_POST['submit_supprimer_util']) && isset($_GET['util_id']) ) {
		if(supprimer_util($_GET['util_id'])) {
			$message .= "L'utilisateur n°".$_GET["util_id"]." a bien été supprimé.<br>";
			
		}	
	}	

	if(isset($_POST['submit_valider_sortie']) && isset($_POST['sor_ref']) ) {
		if(valider($_POST['sor_ref'])) {
			$message .= "La sortie n°".$_POST["sor_ref"]." a bien été validée!<br>";	
		}
		
	}


    require('../templates/administrationView.php');
