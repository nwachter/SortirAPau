<?php
function insertSortie($sor_array) {
    require('configpdo.php');
    echo "DEBUT FONCTION MODIFIEE <br>";  
      
    if(is_array($sor_array)){
        $query = "INSERT INTO Sortie (sor_lieu, sor_auteur, sor_intitule, sor_date, sor_heure, sor_resume, sor_valide, sor_creation, sor_participants) VALUES (:sor_lieu, :sor_auteur, :sor_intitule, :sor_date, :sor_heure, :sor_resume, :sor_valide, :sor_creation, :sor_participants)";

        $stmt = $bdd->prepare($query);   

        $stmt->bindParam(':sor_lieu', $sor_array[0], PDO::PARAM_INT);
        $stmt->bindParam(':sor_auteur', $sor_array[1], PDO::PARAM_INT);
        $stmt->bindParam(':sor_intitule', $sor_array[2], PDO::PARAM_STR);
        $stmt->bindParam(':sor_date', $sor_array[3], PDO::PARAM_STR);
        $stmt->bindParam(':sor_heure', $sor_array[4], PDO::PARAM_STR);
        $stmt->bindParam(':sor_resume', $sor_array[5], PDO::PARAM_STR);
        $stmt->bindParam(':sor_valide', $sor_array[6], PDO::PARAM_BOOL);
        $stmt->bindParam(':sor_creation', $sor_array[7], PDO::PARAM_STR);   
        $stmt->bindParam(':sor_participants', $sor_array[8], PDO::PARAM_INT); 

        $stmt->execute();       
    }

    else {
        return false;
    }

    if ($stmt != FALSE) {   
        return true;
    } else {
        return false;
    }

}