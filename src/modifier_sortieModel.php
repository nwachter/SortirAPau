<?php

function validateModifierSortie($array, $isValide) {

        if(isset($array['submit_sortie'])) 
        {
            if(isset($_SESSION['session_id']) ) 
            {    
                //TOUS CHAMPS VIDES
                if(empty($array['sor_lieu']) && !isset($_SESSION['util_id']) && empty($array['sor_intitule']) && empty($array['sor_date']) && empty($array['sor_heure']) && empty($array['sor_resume']) && empty($array['sor_participants']) ) 
                {
                    $message_erreur = "Veuillez remplir les champs.<br />";
                    $array = array();
                }

                else 
                {
                    $message_erreur = "";
                    //Lieu
                    if(empty($array['sor_lieu']) ) {  
                        $message_erreur .= "Veuillez indiquer un lieu.<br />";
                        $ast_array['sor_lieu'] = "*";       
                    }

                    if(!isset($_SESSION['util_id'])) {
                        $message_erreur .= "Veuillez vous connecter pour poster le formulaire <br>";
                        header('Location: localhost/sign/connexion.php');

                    }        

                    //Intitule
                    if(empty($array['sor_intitule']) || !preg_match('~[A-Za-z0-9-_\'.@&!?\(\)=%$*;+ ]{8,80}~', $array['sor_intitule']) ) {
                        $message_erreur .= "L'intitulé est invalide.<br />";
                        $ast_array['sor_intitule'] = "*";
         
                    }
                    //Date
                    list($annee, $mois, $jour) = explode('-', $array['sor_date']);           
                    if(empty($array['sor_date'])) {  
                        $message_erreur .= "Veuillez indiquer une date.<br />";  
                        $ast_array['sor_date'] = "*";
     
                    }                    
                    else if(!checkdate($mois, $jour, $annee)) {

                        $message_erreur .= "Date incorrecte.<br />";  
                        $ast_array['sor_date'] = "*";                       
                    }

                    //Heure 
                    if(empty($array['sor_heure'])) {
                        $message_erreur .= "Veuillez indiquer l'heure de la sortie.<br />";  
                        
                    }  
                    //Resumé
                    if(empty($array['sor_resume']) ) {
                        $message_erreur .= "Vous n'avez pas indiqué les détails de la sortie. <br />";  
                       
                    }
                    else if(!preg_match('~[A-Za-z0-9-_\'.@&!?\(\)=%$*;+]{15,2000}~', $array['sor_resume'])) {
                       
                        $message_erreur .= "Le résumé de la sortie est trop court ou contient des caractères invalides";
                    }

                    //Nb participants
                    if(empty($array['sor_participants'])) {
                        $message_erreur .= "Vous n'avez pas renseigné le nombre de participants";
                    } 
                    else if(!preg_match('~^([1-9][0-9]?|100)$~', $array['sor_participants'])) {
                        $message_erreur .= "Le nombre de participants est invalide (minimum 1, maximum 100)";
                    }                                  

                    if( !empty($array['sor_lieu']) && isset($_SESSION['util_id']) && !empty($array['sor_intitule']) && preg_match('~[A-Za-z0-9-_\'.@&!?\(\)=%$*;+]{3,80}~', $array['sor_intitule']) && !empty($array['sor_date']) && !empty($array['sor_heure']) && !empty($array['sor_resume']) && preg_match('~[A-Za-z0-9-_\'.@&!?\(\)=%$*;+]{15,2000}~', $array['sor_resume']) && !empty($array['sor_participants']) && preg_match('~^([1-9][0-9]?|100)$~', $array['sor_participants'])
                    ) 
                    {

                        $sor_lieu = (int) $array['sor_lieu'];

                        $sor_auteur = (int) $_SESSION['util_id'];

                        $sor_intitule = $array['sor_intitule'];
                        $sor_date = $array['sor_date'];
                        $sor_heure = $array['sor_heure'];
                        $sor_resume = $array['sor_resume'];             
                        $sor_valide = $isValide;

                        $sor_creation = new DateTime();
                        $sor_creation = toString_datetime($sor_creation);
                        $sor_participants = $array['sor_participants'];
                        $sor_array = [$sor_lieu, $sor_auteur, $sor_intitule, $sor_date, $sor_heure, $sor_resume, $sor_valide, $sor_creation, $sor_participants];
                            echo $message_erreur."<br />";
                        return $sor_array;
                    }
                    else {

                        echo " <br>Il y a des valeurs fausses !".$message_erreur."<br />";                       
                        var_dump($_POST);
                        $array = array();
                        $_POST = array();
                        echo "Tableau vidé.<br>";
                        return false;
                    }
               
                } 

            }
            else {
                $sor_auteur = false;
                $message_erreur = "Veuillez vous connecter pour envoyer le formulaire";
                $array = array();
                $_POST = array();
                header('Location: localhost/sign/connexion.php');
            }
        }

}

function modifierSortie($sor_ref, $sor_array) {     
    if(is_array($sor_array)){       
        require('../configpdo.php');       
        $query = "UPDATE Sortie SET sor_lieu=:sor_lieu, sor_intitule=:sor_intitule, sor_date=:sor_date, sor_heure=:sor_heure, sor_resume=:sor_resume, sor_valide=:sor_valide, sor_participants=:sor_participants WHERE sor_ref=:sor_ref";
        $stmt = $bdd->prepare($query);
        $stmt->execute(['sor_lieu' => $sor_array[0], 'sor_intitule' => $sor_array[2], 'sor_date' => $sor_array[3], 'sor_heure' => $sor_array[4], 'sor_resume' => $sor_array[5], 'sor_valide' => $sor_array[6], 'sor_participants' => $sor_array[8], 'sor_ref' => $sor_ref ]);
    }
    else {
        echo "Le paramètre sor_array n'est pas un array";
    }
   
    if ($stmt != FALSE) {
        $message = "La sortie a bien été modifiée dans la BDD! <br>";
        $_GET['sor_ref'] = $sor_ref;
        $_POST['sortie_modifiee']=true;
        return true;
    } else {
        $message = "Error: Query = " . $query . "<br>" . $bdd->error;
        $_POST = array();
        $_GET['sor_ref'] = $sor_ref;  
        $_POST['sortie_modifiee']=false;       
        return false;
    }

}