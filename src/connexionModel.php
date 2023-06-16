<?php
function verifConnexion($array) {   
        if(!empty($array['util_pseudo']) && !empty($array['util_password']) ) {
            return true;
        }
        else {
            if(empty($array['util_pseudo']) && empty($array['util_password']) )    
            {
                $message_erreur = "Veuillez remplir les champs.<br />";
                $array = array();
            }
            if(empty($array['util_pseudo']))
            {
                $array = array();
            }
            if(empty($array['util_password'])) {
                $array = array();
            }          
            return false;
        }          
}

function sign_up($array) {
    require($_SERVER['DOCUMENT_ROOT'].'/configpdo.php');
    $query = "SELECT * FROM Utilisateur WHERE util_pseudo=:util_pseudo";  
    $stmt = $bdd->prepare($query);
    $stmt->bindParam('util_pseudo', $array['util_pseudo']); 
    $stmt->execute();
    $util_infos = $stmt->fetch();
    $util_pseudo = $array['util_pseudo'];
    $hashed_password = $util_infos['util_password'];    

    if(($array['util_pseudo'] != $util_infos['util_pseudo']) || !password_verify($array['util_password'], $hashed_password) ) {
        $array = array();
        return false;
    }
    else {
        $util_derniereconn = new DateTime();
        $util_derniereconn = toString_datetime($util_derniereconn);  
        $query = "UPDATE Utilisateur SET util_derniereconn=:util_derniereconn WHERE util_pseudo=:util_pseudo";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam('util_pseudo', $array['util_pseudo']);
        $stmt->bindParam('util_derniereconn', $util_derniereconn);        
        if($stmt->execute()) {
            $util_array = [
                'util_id' => $util_infos['util_id'],
                'util_pseudo' => $util_infos['util_pseudo'],
                'util_email' => $util_infos['util_email'],
                'util_password' => $util_infos['util_password'],            
                'util_prenom' => $util_infos['util_prenom'],
                'util_groupe' => $util_infos['util_groupe'],
                'util_derniereconn' => $util_infos['util_derniereconn'],
            ];
            return $util_array; 
        }
    }
}