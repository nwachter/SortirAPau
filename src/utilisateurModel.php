<?php 


function getColumns($table) {
    require('configpdo.php');
    $columns = $bdd->query('SHOW FULL COLUMNS FROM '.$table); 
    return $columns; 	
}

function getUtilisateur($util_pseudo) {
        require('./configpdo.php');
        $query = "SELECT * FROM Utilisateur WHERE util_pseudo=:util_pseudo";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam('util_pseudo', $util_pseudo, PDO::PARAM_STR);
        $stmt->execute();

		$row = $stmt->fetch();
		$age = getAge($row['util_id']);		


		$infos_util = [
	    	'util_id' => $row['util_id'],
	    	'util_pseudo' => $row['util_pseudo'],
	    	'util_password' => $row['util_password'],
	    	'util_email' => $row['util_email'],
	    	'util_prenom' => $row['util_prenom'],
	    	'util_nom' => $row['util_nom'],
	    	'util_telephone' => $row['util_telephone'],
	    	'util_naissance' => $row['util_naissance'],
	    	//'util_age' => $age['util_age'],
	    	'util_civilite' => $row['util_civilite'],
	    	'util_inscription' => $row['util_inscription'],
	    	'util_groupe' => $row['util_groupe'],   					
	    	'util_derniereconn' => $row['util_derniereconn'],			
		];
		
	if($stmt != false) {
		return $infos_util;
	}
    else {
    	echo "Erreur dans la récupération des infos de l'utilisateur : ".$bdd->error;
    	return false;
    }
}

function getSortiesUtil($option = NULL) {

	if(isset($option)) {
		$statement = selectSortiesPDO($option);
	}
	else $statement = selectSortiesPDO();

	$sorties = [];
	$number=0;

	while($row = $statement->fetch()) {
		$participants = getParticipants($row['sor_ref']);
		$age = getAge($row['util_id']);			
	 	$sortie = [
			'sor_ref' => $row['sor_ref'],
			'number' => $number++,
			'sor_lieu' => $row['sor_lieu'],
			'sor_auteur' => $row['sor_auteur'],
			'sor_intitule' => $row['sor_intitule'],
			'sor_date' => $row['sor_date'],
			'sor_heure' => $row['sor_heure'],
			'sor_resume' => $row['sor_resume'],
			'sor_valide' => $row['sor_valide'],			
			'sor_creation' => $row['sor_creation'],
			'nb_participants' => $participants['nb_participants'],
			'sor_participants' => $row['sor_participants'],
			'util_id' => $row['util_id'],
			'util_pseudo' => $row['util_pseudo'],
			'util_id' => $row['util_id'],
			'util_email' => $row['util_email'],
			'util_naissance' => $row['util_naissance'],
			'util_age' => $age['util_age'],
			'lieu_ref' => $row['lieu_ref'],
			'lieu_nom' => $row['lieu_nom'],
			'lieu_adresse' => $row['lieu_adresse'],
			'lieu_cp' => $row['lieu_cp'],
			'lieu_ville' => $row['lieu_ville'],
			'lieu_description' => $row['lieu_description'],	
			'lieu_image' => $row['lieu_image'],
			'image_mime' => $row['image_mime'],		
	 	];
	 	$sorties[] = $sortie;
	}	
	return $sorties;	
}
