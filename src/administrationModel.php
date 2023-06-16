<?php
function supprimer($sor_ref) {

	require('../configpdo.php');

	$stmt = $bdd->prepare("DELETE FROM Sortie WHERE sor_ref=:sor_ref");
	$stmt->execute(['sor_ref' => $sor_ref]);     

	if ($stmt != FALSE) {
	    return true;
	} else {
	    return false;
	}

	//$bdd->close();
}

function supprimer_util($util_id) {

	require('../configpdo.php');

	$stmt = $bdd->prepare("DELETE FROM Utilisateur WHERE util_id=:util_id");
	$stmt->execute(['util_id' => $_GET['util_id']]);     

	if ($stmt != FALSE) {
		return true;
	} else {
	    return false;
	}

	//$bdd->close();
}

function updateGroupe($util_id, $groupe_id) {
    require('../configpdo.php'); 

    $stmt = $bdd->prepare("UPDATE Utilisateur SET util_groupe = ".$groupe_id." WHERE util_id = ".$util_id);
    $stmt->execute(['util_id' => $_GET['util_id'], 'util_groupe' => $_POST['util_groupe']]);
    
     if ($stmt != FALSE) {
        return true;
    } else {
        return false;
    }         
   
}

function valider($sor_ref) {
    require('../configpdo.php');

    $stmt = $bdd->prepare("UPDATE Sortie SET sor_valide = 1 WHERE sor_ref=:sor_ref");
    $stmt->execute(['sor_ref' => $sor_ref]);  

    if ($stmt != FALSE) {
        return true;
    } else {
        return false;
    }

}



