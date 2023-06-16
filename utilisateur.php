<?php 
	session_cache_expire();
	session_start(); 
	error_reporting(E_ALL); 
	ini_set('display_errors', 1);
	 
	require($_SERVER['DOCUMENT_ROOT'].'/variables.php'); 
	require($_SERVER['DOCUMENT_ROOT'].'/functions.php');
	require($_SERVER['DOCUMENT_ROOT'].'/src/model.php');		
	require($_SERVER['DOCUMENT_ROOT'].'/src/utilisateurModel.php');	
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/Utilisateur.php');

    if (!isset($_SESSION['util_id'])  )
    {
        echo("Accès refusé : Vous n'êtes pas connecté.");
        return;
    }	

	if(isset($_GET['deconnexion']) ) {
		deconnexion();								
	}

	if($loggedIn) {
		if(isset($_POST['submit_password']) && verif_modification_pwd($_POST) ) {
			$editPassword = true;
			if(verif_ancien_password($_SESSION['util_id'], $_POST['ancien_password']) ) {
				$oldPasswordIsValid = true;
				modifier_password($_SESSION['util_id'], $_POST['nouveau_password']);
			}
			else {
				$oldPasswordIsValid = false;
				$message = "L'ancien mot de passe ne correspond pas à celui du compte <br>";
			}
		}
		elseif(isset($_POST['submit_password']) && !verif_modification_pwd($_POST)) $message = "Il y a une erreur dans l'une ou plusieurs des saisies.<br>";
		else $message = "Bienvenue, ".$_SESSION['util_pseudo'];
	}
	else {
		echo("Accès refusé : Vous n'êtes pas connecté.");
		return;
	}


	require($rootUrl.'/src/model.php');
	require($rootUrl.'/src/utilisateurModel.php');	

	$columns = getColumns('Utilisateur');
    $users = getUtilisateurs(" WHERE util_pseudo='".$_SESSION['util_pseudo']."'");
    $infos_util = getUtilisateur($_SESSION['util_pseudo']);
	$sortiesValides = getSortiesUtil(" AND sor_valide=1");
	$sortiesAValider = getSortiesUtil(" AND sor_valide=0"); 

    $lieux = getLieux();
    $groupes = getGroupes();
    $util_pseudo = $_SESSION['util_pseudo'];

    $utilisateur = new Utilisateur($util_pseudo);


	require($_SERVER['DOCUMENT_ROOT'].'/templates/utilisateurView.php');

