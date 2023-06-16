<?php 
	session_cache_expire();
	session_start(); 
	 
	include_once('../variables.php'); 
	include_once('../functions.php');
	require_once('../classes/Utilisateur.php');

	require('../src/model.php');
	require('../src/modifier_sortieModel.php');

	$message = '';

    if (!$loggedIn)
    {
    	$loggedIn = false;
        echo("Accès refusé : Vous n'êtes pas connecté.");
        return;
    }

    if (!$isAdmin) 
    {
    	$isAdmin = false;
        echo("Accès refusé : Vous n'êtes pas un administrateur.");
        return;
    }

    if (isset($_POST['submit_sortie'])  )
    {
        $submitSortie = true;
    }
    else $submitSortie = false;  

    if (isset($_POST['submit_modifier_sortie']) && isset($_POST['sor_ref']) )
    {
        $sortieAModifier = true;        
    }
    else $sortieAModifier = false;  

    if(isset($_POST['modifier_sortie'])) {
        $modificationSortie = true;
    } 
 

    if (!isset($sortieAModifier))
    {
        echo('La sortie n\'existe pas');
        return;
    }



	if(isset($_GET['deconnexion']) ) {
		deconnexion();								
	}

    $users = getUtilisateurs();
    $sorties = getSorties(' AND sor_ref='.$_POST['sor_ref']);
    $lieux = getLieux();
    $groupes = getGroupes();

    $pagePrecedente = $_SERVER['HTTP_REFERER'];
	if(isset($modificationSortie)) {
		
		if($sor_array = validateModifierSortie($_POST, 1)) {
			if(modifierSortie($_POST['sor_ref'], $sor_array)) {
				$message = "Vous avez bien modifié la sortie n°".$_POST['sor_ref']."<br>";
				$sortieModifiee = true;
			}
			else $mesage .= "<br>La modification de la sortie a échoué. <br>";
		}
		else $message .= "La validation de la sortie a échoué <br>";
	}

    require('../templates/admin_modifier_sortieView.php');
