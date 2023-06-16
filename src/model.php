<?php
//Modèle
error_reporting(E_ALL); 
ini_set('display_errors', 1);	

function getSuggestions($option = NULL) {
	$statement = (isset($option)) ? select('Lieu', $option) : select('Lieu');
	$suggestions = [];

	while($row = $statement->fetch()) {

	    $suggestion = [
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
	    $suggestions[] = $suggestion;
	}
	return $suggestions;
}

function getUtilisateurs($option = NULL) {
	$table = "Utilisateur";
	if(isset($option)) $statement = select($table, $option);
	else $statement = select($table);
	

	$users = [];

	while($row = $statement->fetch()) {
		$age = getAge($row['util_id']);
	    $user = [
	    	'util_id' => $row['util_id'],
	    	'util_pseudo' => $row['util_pseudo'],
	    	'util_email' => $row['util_email'],
	    	'util_prenom' => $row['util_prenom'],
	    	'util_nom' => $row['util_nom'],
	    	'util_telephone' => $row['util_telephone'],
	    	'util_naissance' => $row['util_naissance'],
	    	'util_age' => $age['util_age'],
	    	'util_civilite' => $row['util_civilite'],
	    	'util_inscription' => $row['util_inscription'],
	    	'util_groupe' => $row['util_groupe'],
	    	'util_derniereconn' => $row['util_derniereconn'],
	    ];
	    $users[] = $user;
	}	 		
	return $users;	
}	

function getSortie($option) {

	$statement = selectSortiesPDO($option);

	$sortieDetails = [];
	$number=0;

	$row = $statement->fetch();

	$participants = getParticipants($row['sor_ref']);
	$age = getAge($row['util_id']);
			
	$sortieDetails = [
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

	return $sortieDetails;	
}

function getSorties($option = NULL) {

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


	
function getLieux($option = NULL) {
		//Lieux
 		$statement = (isset($option)) ? select('Lieu', $option) : select('Lieu'); 		
	
		$lieux = [];
		$numLieu = 0;
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
		return $lieux;		
}

function getParticipantsNames($sor_ref = NULL) {
	require($_SERVER['DOCUMENT_ROOT'].'/configpdo.php');

	if($sor_ref == NULL) {
		//Tous les participants de toutes les sorties
		$query = "SELECT u.util_pseudo, u.util_prenom, u.util_naissance, p.util_id, s.sor_ref, s.sor_intitule FROM Utilisateur u JOIN Participants p ON (u.util_id = p.util_id) JOIN Sortie s ON (s.sor_ref = p.sor_ref) ORDER BY s.sor_ref";
        $stmt = $bdd->prepare($query);
        $statement = $stmt->execute();		
	}
	else {
	    //Participants d'une sortie de sor_ref=x
	    $query = "SELECT u.util_pseudo, u.util_prenom, u.util_naissance, p.util_id, s.sor_ref, s.sor_intitule FROM Utilisateur u JOIN Participants p ON (u.util_id = p.util_id) JOIN Sortie s ON (s.sor_ref = p.sor_ref) WHERE s.sor_ref=:sor_ref";
	    $statement = $bdd->prepare($query);
	    $statement->execute(['sor_ref' => $sor_ref]);

	}

	$allParticipantsNames = [];

	while($row = $statement->fetch()) {
		$age = getAge($row['util_id']);
	 	$participantsNames = [
	 		'sor_ref' => $row['sor_ref'], 
	 		'sor_intitule' => $row['sor_intitule'],
			'util_id' => $row['util_id'],
			'util_pseudo' => $row['util_pseudo'],
			'util_prenom' => $row['util_prenom'],
			'util_naissance' => $row['util_naissance'],
			'util_age' => $age['util_age'],				
		 ];
		 $allParticipantsNames[] = $participantsNames;
	}
	return $allParticipantsNames;	
}


function getGroupes() {
	require($_SERVER['DOCUMENT_ROOT'].'/configpdo.php');
	$query = "SELECT groupe_id, groupe_libelle, groupe_description FROM Groupe";

	$statement = $bdd->prepare($query);
	$statement->execute();


	$groupes = [];

	while($row = $statement->fetch()) {
	 	$groupe = [
	 		'groupe_id' => $row['groupe_id'], 
	 		'groupe_libelle' => $row['groupe_libelle'],	
			'groupe_description' => $row['groupe_description'],					
		 ];
		 $groupes[] = $groupe;
	}
	return $groupes;		

}
		