<?php 
	session_cache_expire();
	session_start(); 

	try {
	    require_once('configpdo.php');
	    
	} catch(PDOException $e) {
	    echo "Connection failed: " . $e->getMessage();
	}	
	 
	include_once('variables.php'); 
	include_once('functions.php');	
	require_once('classes/Utilisateur.php');

	if(isset($_GET['deconnexion']) ) {
		//deconnexion();								
	}

	//SQL Statements
    $table = "Lieu"; 
	$option = " ORDER BY RAND() LIMIT 1";  
	$statement = select($table, $option);	
	$lieux = [];

	while($row = $statement->fetch()) {
	    $lieu = [
	    	'lieu_ref' => $row['lieu_ref'],
	    	'lieu_nom' => $row['lieu_nom'],
	    	'lieu_adresse' => $row['lieu_adresse'],
	    	'lieu_cp' => $row['lieu_cp'],
	    	'lieu_ville' => $row['lieu_ville'],
	    	'lieu_description' => $row['lieu_description'],	
	    	'lieu_image' => $row['lieu_image'],
            'lieu_valide' => $row['lieu_valide'],	    	
	    	'image_mime' => $row['image_mime'],
	    ];
	    $lieux[] = $lieu;
	}	

	$tableUtil = "Utilisateur"; 
	$statement = select($tableUtil);

	$users = [];

	while($row = $statement->fetch()) {
	    $user = [
	    	'util_id' => $row['util_id'],
	    	'util_pseudo' => $row['util_pseudo'],
	    	'util_email' => $row['util_email'],
	    	'util_prenom' => $row['util_prenom'],
	    	'util_nom' => $row['util_nom'],
	    	'util_telephone' => $row['util_telephone'],
	    	'util_naissance' => $row['util_naissance'],
	    	'util_civilite' => $row['util_civilite'],
	    	'util_inscription' => $row['util_inscription'],
	    	'util_groupe' => $row['util_groupe'],
	    	'util_derniereconn' => $row['util_derniereconn'],
	    ];
	    $users[] = $user;
	}	 		
	
	//Sorties
	$optionSortie = " AND s.sor_date between now() AND date_add(now(),INTERVAL 999 WEEK)"; // ou afficher les 10 prochaines sorties
	$statement = selectSortiesPDO($optionSortie);
	$sorties = [];
	$number=0;

	while($row = $statement->fetch()) {
		$participants = getParticipants($row['sor_ref']);			
	 	$sortie = [
			'sor_ref' => $row['sor_ref'],
			'number' => $number++,
			'sor_lieu' => $row['sor_lieu'],
			'sor_auteur' => $row['sor_auteur'],
			'sor_intitule' => $row['sor_intitule'],
			'sor_date' => $row['sor_date'],
			'sor_heure' => $row['sor_heure'],
			'sor_resume' => $row['sor_resume'],
			'sor_creation' => $row['sor_creation'],
			'nb_participants' => $participants['nb_participants'],
			'sor_participants' => $row['sor_participants'],
			'util_id' => $row['util_id'],
			'util_pseudo' => $row['util_pseudo'],
			'util_id' => $row['util_id'],
			'util_email' => $row['util_email'],
			'lieu_ref' => $row['lieu_ref'],
			'lieu_nom' => $row['lieu_nom'],
			'lieu_adresse' => $row['lieu_adresse'],
			'lieu_cp' => $row['lieu_cp'],
			'lieu_ville' => $row['lieu_ville'],
			'lieu_description' => $row['lieu_description'],	
			'lieu_image' => $row['lieu_image'],		
	 	];
	 	$sorties[] = $sortie;
		}	

		//Lieux
		$tableLieux = "Lieu"; 
		$optionLieux = " ORDER BY RAND() LIMIT 3";  		
	    $statement = select($tableLieux, $optionLieux);
		$numLieu = 0;	
		$lieux = [];

		while($row = $statement->fetch()) {
 		$lieu = [
			'number' => $numLieu++,
			'lieu_ref' => $row['lieu_ref'],
			'lieu_nom' => $row['lieu_nom'],
			'lieu_adresse' => $row['lieu_adresse'],
			'lieu_cp' => $row['lieu_cp'],
			'lieu_ville' => $row['lieu_ville'],
			'lieu_description' => $row['lieu_description'],	
			'lieu_image' => $row['lieu_image'],
			'image_mime' => $row['image_mime'],				
	 	];
	 	$lieux[] = $lieu;
		}				

require('templates/homepage.php');
?>
