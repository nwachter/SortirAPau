<?php

function toString_datetime($object) {
    return $object->format('Y-m-d H:i:s');
}

function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags)
    {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

//Connexion - Deconnexion

function deconnexion() {
    if(isset($_GET['deconnexion']) && $_GET['deconnexion'] == true) {
        session_unset();
        session_destroy();
        $_GET = array();
        $_POST = array();
        return true;
    }
}


function stop_session() {
    if(isset($_SESSION['session_id']) ) {

        if($_SESSION['expire'] == time()) {
            session_unset();
            session_destroy();
            echo "<br>Session terminée<br>";
            return true;
        }
        else {
            return false;
        } 
    }

    else {
        return NULL;
    }  
}


function selectSortiesPDO($option = NULL) {
    require('configpdo.php');
    $query = "SELECT DISTINCT s.sor_ref, s.sor_lieu, s.sor_auteur, s.sor_intitule, s.sor_date, s.sor_heure, s.sor_resume, s.sor_creation, s.sor_valide, s.sor_participants, u.util_id, u.util_pseudo, u.util_email, u.util_naissance, l.lieu_ref, l.lieu_nom, l.lieu_adresse, l.lieu_cp, l.lieu_ville, l.lieu_description, l.lieu_image, l.image_mime FROM Sortie s JOIN Utilisateur u ON (s.sor_auteur=u.util_id) JOIN Lieu l on (s.sor_lieu=l.lieu_ref)";
    if($option != NULL) {
        $query .= $option;
    }
    $stmt = $bdd->prepare($query);
    $stmt->execute();     

    if ($stmt != FALSE) {
        return $stmt;
    } else {
        echo "Erreur dans la récupération des sorties " . $bdd->error;
        return false;
    }
}



function keywordSearch($mc) {
            require('config.php');
            $bdd = $conn;
            $mc = trim($mc);
            $mc = strtolower($mc);
            $mc_array = str_word_count($mc, 1, '&éàèùôïç');
            echo "<br> Tableau de mots clés : ";
            var_dump($mc_array);
            echo "<br>";

            $query_mc = "SELECT * FROM Sortie s JOIN Lieu l on (s.sor_lieu=l.lieu_ref)";
           
            $x = 0;
            foreach($mc_array as $mot) {
                if($x==0) {
                    $query_mc .= " WHERE sor_intitule OR sor_resume OR lieu_nom LIKE '%".$mot."%'";
                }
                else {
                    $query_mc .= " OR sor_intitule OR sor_resume OR lieu_nom LIKE '%".$mot."%'";
                }
                
                $x++;
            }
            echo "<br> Requête après foreach : ".$query_mc."<br>";
            $resultat_mc = mysqli_query($bdd, $query_mc);
            $donnees_mc = mysqli_fetch_all($resultat_mc, MYSQLI_ASSOC); 
            return $donnees_mc;    
}


function getAge($util_id) {
    require('configpdo.php'); 
    $query = "SELECT ROUND((SELECT DATEDIFF((SELECT CURDATE()),(SELECT util_naissance FROM Utilisateur WHERE util_id=:util_id))/365.25),0) as util_age";
    $stmt = $bdd->prepare($query);
    $stmt->execute(['util_id' => $util_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result != FALSE) {
        return $result;
    }
    else return 'Non indiqué.';

}

function getParticipants($sor_ref = NULL) {
    //sor_ref option = pour une sortie spécifique

    require('configpdo.php');
    if($sor_ref == NULL) {
        $query = "SELECT COUNT(p.util_id) AS nb_participants, s.sor_intitule FROM Participants p JOIN Utilisateur u ON p.util_id = u.util_id JOIN Sortie s ON p.sor_ref = s.sor_ref GROUP BY s.sor_ref";  
        $stmt = $bdd->prepare($query);
        $result = $stmt->execute();
    }
    else {
        $query = "SELECT COUNT(p.util_id) AS nb_participants, s.sor_intitule FROM Participants p JOIN Utilisateur u ON p.util_id = u.util_id JOIN Sortie s ON p.sor_ref = s.sor_ref GROUP BY s.sor_ref HAVING s.sor_ref=:sor_ref"; 
        $stmt = $bdd->prepare($query);
        $stmt->execute(['sor_ref' => $sor_ref]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if($result == NULL || $result == 0 || $result == false) {
        return ['nb_participants' => 0];
    }
    else return $result;   

}


//ORGANISER SORTIES

function validateSortie($array) {  
                $message_erreur = "";
                echo "Test";
                if(empty($array['sor_lieu']) && !isset($_SESSION['util_id']) && empty($array['sor_intitule']) && empty($array['sor_date']) && empty($array['sor_heure']) && empty($array['sor_resume']) && empty($array['sor_participants']) ) 
                {
                    echo "Veuillez remplir les champs.<br />";
                    $array = array();
                    return false;
                }
                else 
                {
                    //Lieu
                    if(empty($array['sor_lieu']) ) {  
                        echo "Veuillez indiquer un lieu.<br />"; 
     
                    }
                    //util non connecté
                    if(!isset($_SESSION['util_id'])) {
                        echo "Veuillez vous connecter pour poster le formulaire <br>";
                        header('Location: localhost/sign/connexion.php');
                    }        
                    //Intitule
                    if(empty($array['sor_intitule']) || !preg_match('~[A-Za-z0-9-_\'.,:"@&!?\(\)=%$*;+ ]{8,80}~', $array['sor_intitule']) ) {
                        echo "L'intitulé est invalide.<br />";
         
                    }
                    //Date
                    list($annee, $mois, $jour) = explode('-', $array['sor_date']);           
                    if(empty($array['sor_date'])) {  
                        echo "Veuillez indiquer une date.<br />";  
     
                    }                    
                    else if(!checkdate($mois, $jour, $annee)) {
                        echo "Date incorrecte.<br />";                        
                    }

                    //Heure 
                    if(empty($array['sor_heure'])) {
                        echo "Veuillez indiquer l'heure de la sortie.<br />";       
                    }
  
                    //Resumé
                    if(empty($array['sor_resume']) ) {
                        echo "Vous n'avez pas indiqué les détails de la sortie. <br />";  
                    }
                    else if(!preg_match('~[A-Za-z0-9-_\'.,:"@&!?\(\)=%$*;+ ]{10,2000}~', $array['sor_resume'])) {
                        echo "Le résumé de la sortie est trop court ou contient des caractères invalides <br>";
                    }

                    //Nb de participants
                    if(empty($array['sor_participants'])) {
                        echo "Vous n'avez pas renseigné le nombre de participants<br>";
                    } 
                    else if(!preg_match('~^([1-9][0-9]?|100)$~', $array['sor_participants'])) {
                        echo "Le nombre de participants est invalide (minimum 1, maximum 100)<br>";
                    }                                

                    if( !empty($array['sor_lieu']) && isset($_SESSION['util_id']) && !empty($array['sor_intitule']) && preg_match('~[A-Za-z0-9-_\'.,:"@&!?\(\)=%$*;+ ]{3,80}~', $array['sor_intitule']) && !empty($array['sor_date']) && !empty($array['sor_heure']) && !empty($array['sor_resume']) && preg_match('~[A-Za-z0-9-_\'.,:"@&!?\(\)=%$*;+ ]{8,2000}~', $array['sor_resume']) && !empty($array['sor_participants']) && preg_match('~^([1-9][0-9]?|100)$~', $array['sor_participants'])
                    ) 
                    {
                        $sor_lieu = (int) $array['sor_lieu'];
                        $sor_auteur = (int) $_SESSION['util_id'];
                        $sor_intitule = $array['sor_intitule'];
                        $sor_date = $array['sor_date'];
                        $sor_heure = $array['sor_heure'];
                        $sor_resume = $array['sor_resume'];
                        $sor_valide = 0;
                        $sor_creation = new DateTime();
                        $sor_creation = toString_datetime($sor_creation);
                        $sor_participants = $array['sor_participants'];
                        $sor_array = [$sor_lieu, $sor_auteur, $sor_intitule, $sor_date, $sor_heure, $sor_resume, $sor_valide, $sor_creation, $sor_participants];
                        return $sor_array;
                    }
                    else {
                        echo $message_erreur;
                        var_dump($array);
                        $array = array();
                        $_POST = array();
                        return false;
                    }          
                } 

}

//Zone ADMIN 

function select($table, $option = NULL) {
    require('configpdo.php');
    $donnees = $bdd->query('SELECT * FROM '.$table.$option); 
    $bdd->connection = null;
    return $donnees;
}



function verif_modification_pwd($array) {
    $estCorrect = true;
    $regex_password = '~[A-Za-z0-9-_@\$!\.]{8,20}~'; 
    $message_erreur = "";
   if(isset($array['submit_password']) && isset($_SESSION['util_id'])) 
   {    
        if(!empty($array['ancien_password']) && preg_match($regex_password, $array['ancien_password']) && !empty($array['nouveau_password']) && $array['nouveau_password']==$array['confirm_password'] ) {

            return $estCorrect;
        }
        else {

            if(empty($array['ancien_password']) && empty($array['nouveau_password']) && empty($array['confirm_password']))         
            {
                $message_erreur = "Veuillez remplir les champs.<br />";
                $array = array();
                $estCorrect = false;
            }
            else {  //si 1 ou 2 champs incorrects
                //Ancien password
                if(empty($array['ancien_password']))
                {
                    $message_erreur .= "Veuillez indiquer un ancien mot de passe.<br />";
                    $estCorrect = false;

                }
                    
                //Nouveau Mot de passe  
                if(empty($array['nouveau_password']) || !preg_match($regex_password, $array['ancien_password'])) {
                    $message_erreur .= "Veuillez entrer un nouveau mot de passe valide. Caractères autorisés : [A-Za-z0-9-_@.$!.]. <br>";
                    $estCorrect = false;
                }

                //Confirm Mot de passe  
                if(empty($array['confirm_password'])) {
                    $message_erreur .= "Confirmation invalide <br>";
                    $estCorrect = false;

                }
                //Nouveau mot de passe et confirmation nouveau mot de passe différents
                if($array['nouveau_password']!=$array['confirm_password']) {
                    $message_erreur .= "Le nouveau mot de passe et sa confirmation ne correspondent pas. <br>";
                    $estCorrect = false;

                }            

  
            } 
            $array = array();
            echo $message_erreur;
            return $estCorrect;
        } 
    }  
        
}
//Verification correspondance de l'ancien mdp à celui dans la BDD
function verif_ancien_password($util_id, $ancien_password) {
    if(isset($_SESSION['session_id']) && isset($_SESSION['util_id'])) {
        require('configpdo.php');

        $query = "SELECT util_password FROM Utilisateur WHERE util_id=:util_id";
        $stmt = $bdd->prepare($query);
        $stmt->execute(['util_id' => $util_id]);
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

         if ($resultat != FALSE) {
            echo "<br>L'ancien mdp a été fetch() ! !<br>";
        }         

        $estValide = password_verify($ancien_password, $resultat['util_password']);

        if($estValide) {
            echo "Le mdp dans la BDD et le mdp entré dans le champ \"Ancien PASSWORD\" correspondent.<br>";
        return $estValide;
        }
        else {
            $_POST = array();
            return false;
        }
    }
}


function modifier_password(int $util_id, string $nouveau_password) : bool {

    $nouveau_password = password_hash($nouveau_password, PASSWORD_DEFAULT); 
    require('configpdo.php');
    $query = "UPDATE Utilisateur SET util_password=:nouveau_password WHERE util_id=:util_id";
    $stmt = $bdd->prepare($query);
    $stmt->execute(['util_id' => $util_id, 'nouveau_password' => $nouveau_password]);

     if ($stmt != FALSE) {
        $_POST = array();
        return true;
    } else {
        $_POST = array();
        return false;
    }     
}

function estMembreSortie($util_id, $sor_ref) {
    require('configpdo.php');
    $query = "SELECT * FROM Participants WHERE util_id=:util_id AND sor_ref=:sor_ref";
    $stmt = $bdd->prepare($query);
    $stmt->execute(['util_id' => $util_id, 'sor_ref' => $sor_ref]);
    $result = $stmt->fetch();
    echo " : ESTMEMBRESORTIE".var_dump($result);

    if($result == FALSE) {
        return false;
    }
    else {
        return true;
    }

}

function rejoindreSortie($util_id, $sor_ref) {
    require('configpdo.php');
    $query = "INSERT INTO Participants (util_id, sor_ref) VALUES (:util_id, :sor_ref)";
    $stmt = $bdd->prepare($query); 
    $stmt->bindParam(':util_id', $util_id);
    $stmt->bindParam(':sor_ref', $sor_ref);
    $stmt->execute(); 
    if($stmt!= FALSE) {
        return true;
    }
    else {      
        return false;
    }    
}

?>