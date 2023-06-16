<?php

function verifInscription($array, &$ast_array) {
    if(isset($array['submit'])) {    //si btn submit activé
        
        if(empty($array['util_pseudo']) && empty($array['util_password']) && empty($array['util_confirm']) && empty($array['util_email']) && empty($array['util_prenom']) && empty($array['util_nom']) && empty($array['util_naissance']) && empty($array['util_civilite']) ) 
        {
            $message_erreur = "Veuillez remplir les champs.<br />";
        }
        else 
        {
            $message_erreur = "";
            //Pseudo
            if(empty($array['util_pseudo']) ) {
                $message_erreur .= "Veuillez indiquer un pseudo.<br />";
                $ast_array['util_pseudo'] = "*";      
            }

            $regex_password = '~[A-Za-z0-9-_@\$!\.]{8,20}~';
            if(empty($array['util_password']) || !preg_match($regex_password, $array['util_password']) ) {  
                $message_erreur .= "Mot de passe invalide (8 Caractères minimum. Caractères autorisés : [A-Za-z0-9-_@.$!.].<br />";
                $ast_array['util_password'] = "*";
                //$array = array();         
            } 

            //Confirmation MDP
            if(empty($array['util_confirm']) ) {  
                $message_erreur .= "Le champ de confirmation de mot de passe est vide.<br />";
                $ast_array['util_confirm'] = "*";
                //$array = array();          
            } 
            else if ( $array['util_confirm'] != $array['util_password'] )  {
                $ast_array['util_confirm'] = "*";
                $message_erreur .= "Les deux mots de passe ne correspondent pas. Mots de passe : ".$array['util_password']." - ".$array['util_confirm']."<br />";
            }          

            //Email
            if(empty($array['util_email']) || !filter_var($array['util_email'], FILTER_VALIDATE_EMAIL)) {
                $message_erreur .= "L'email est invalide.<br />";
                $ast_array['util_email'] = "*";         
            }
            //Prénom
            if(empty($array['util_prenom'])) {
                $message_erreur .= "Le champ prenom n'est pas rempli.<br />";  
                $ast_array['util_prenom'] = "*";     
            }
            //Nom
            if(empty($array['util_nom'])) {
                $message_erreur .= "Le champ nom n'est pas rempli.<br />";  
                $ast_array['util_nom'] = "*";      
            }
            //Téléphone
            if(empty($array['util_telephone']) || !preg_match('~^0[0-9]{9}~', $array['util_telephone']) ) {
                $message_erreur .= "Le champ telephone est invalide.<br />";  
                $ast_array['util_telephone'] = "*";     
            }

            //Date de naissance 
            if(empty($array['util_naissance'])) {
                $message_erreur .= "Vous n'avez pas indiqué votre date de naissance.<br />";  
                $ast_array['util_naissance'] = "*";      
            }  
            //Civilité
            if(empty($array['util_civilite'])) {
                $message_erreur .= "Vous n'avez pas indiqué votre civilité.<br />";  
                $ast_array['util_civilite'] = "*";    
            }                                   

            if(!empty($array['util_pseudo']) && preg_match($regex_password, $array['util_password']) && ($array['util_confirm'] == $array['util_password']) && filter_var($array['util_email'], FILTER_VALIDATE_EMAIL) && !empty($array['util_prenom']) && !empty($array['util_nom']) && preg_match('~^0[0-9]{9}~', $array['util_telephone']) && !empty($array['util_naissance']) && !empty($array['util_civilite'])
            ) 
            {

                $util_pseudo = $array['util_pseudo'];
                $util_password = $array['util_password'];
                $util_password = password_hash($util_password, PASSWORD_DEFAULT);

                $util_email = $array['util_email'];
                $util_prenom = $array['util_prenom'];
                $util_nom = $array['util_nom'];
                $util_telephone = $array['util_telephone'];
                $util_naissance = $array['util_naissance'];
                $util_civilite = $array['util_civilite'];
                $util_inscription = new DateTime();
                $util_inscription = toString_datetime($util_inscription);
                $util_groupe = 2;


                $util_array = array($util_pseudo, $util_password, $util_email, $util_prenom, $util_nom, $util_telephone, $util_naissance, $util_civilite, $util_inscription, $util_groupe);

                    echo $message_erreur."<br />";
                return $util_array;
            }
            else {
                echo $message_erreur;
                $array = array();
                return false;
            }
       
        } 

    }

 }


function insert_utilisateur($array) {
    require($_SERVER['DOCUMENT_ROOT'].'/configpdo.php');    
    
        $query ="INSERT INTO Utilisateur (util_pseudo, util_password, util_email, util_prenom, util_nom, util_telephone, util_naissance, util_civilite, util_inscription, util_groupe) VALUES (:util_pseudo, :util_password, :util_email, :util_prenom, :util_nom, :util_telephone, :util_naissance, :util_civilite, :util_inscription, :util_groupe)";

        $stmt = $bdd->prepare($query);

        $stmt->bindParam('util_pseudo', $array[0]);
        $stmt->bindParam('util_password', $array[1]);
        $stmt->bindParam('util_email', $array[2]);
        $stmt->bindParam('util_prenom', $array[3]);
        $stmt->bindParam('util_nom', $array[4]);
        $stmt->bindParam('util_telephone', $array[5]);
        $stmt->bindParam('util_naissance', $array[6]);
        $stmt->bindParam('util_civilite', $array[7]);
        $stmt->bindParam('util_inscription', $array[8]);
        $stmt->bindParam('util_groupe', $array[9]);        

        $stmt->execute();        

   
    if ($stmt != false) {
        return true;
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
        return false;
    }

}