<?php
//SORTIES
function getSortiesSearch($option = NULL) {
    //Sorties
    $optionAll = " AND s.sor_date between now() AND date_add(now(),INTERVAL 999 WEEK)"; // ou 
    if(isset($option)) $statement = selectSortiesSearch($option);
    else $statement = selectSortiesSearch();
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


function selectSortiesSearch($option = NULL) {
    require('configpdo.php');
    $query = "SELECT DISTINCT s.sor_ref, s.sor_lieu, s.sor_auteur, s.sor_intitule, s.sor_date, s.sor_heure, s.sor_resume, s.sor_creation, s.sor_participants, u.util_id, u.util_pseudo, u.util_email, u.util_naissance, l.lieu_ref, l.lieu_nom, l.lieu_adresse, l.lieu_cp, l.lieu_ville, l.lieu_description, l.lieu_image, l.image_mime FROM Sortie s JOIN Utilisateur u ON (s.sor_auteur=u.util_id) JOIN Lieu l on (s.sor_lieu=l.lieu_ref)";

        $query .= " WHERE s.sor_valide=1";

        if(isset($_GET['rech_mc']) && $_GET['rech_mc'] != "" ) {
            $mc = $_GET['rech_mc'];
            $mc = trim($mc);
            $mc = strtolower($mc);
            //preg_replace
            
            $patterns = array('/à/','/é/','/è/','/ï/','/î/','/ô/','/ù/','/û/','/ç/');
            $replacements = array('a','e','e','i','i', 'o', 'u', 'c');
            $mc = preg_replace($patterns, $replacements, $mc);
            echo "MOTS CLES après preg_replace : ".$mc."<br>";
            $mc_array = str_word_count($mc, 1);

            $x = 1;
            if(count($mc_array) == 1) {
                $query .= " AND (s.sor_intitule OR s.sor_resume OR l.lieu_nom LIKE :keyword".$x.")";
            }
            
            else {
                $count = count($mc_array);
                for($x=1 ; $x<=count($mc_array) ; $x++) {
                    if($x==1) {
                        $query .= " AND ((s.sor_intitule OR s.sor_resume OR l.lieu_nom LIKE :keyword".$x.")";

                    }
                    if ($x === count($mc_array)){
                        $query .= " OR (s.sor_intitule OR s.sor_resume OR l.lieu_nom LIKE :keyword".$x."))";
                    }                
                    if ($x > 1 && $x < count($mc_array)) {
                        $query .= " OR (s.sor_intitule OR s.sor_resume OR l.lieu_nom LIKE :keyword".$x.")";
                    }                    
                }
                $x=1; 

            }
        }        

        if(isset($_GET['rech_date']) && $_GET['rech_date'] != "" ) {
            $date = $_GET['rech_date'];
            $query .= " AND s.sor_date=:sor_date";
            //FAIRE DATE FORMAT!!!!!!!!!!!!!!!!!!!!!!!!
        }

        if(isset($_GET['rech_lieu']) && $_GET['rech_lieu'] != "" ) {
            $id_lieu = $_GET['rech_lieu'];
            $query .= " AND s.sor_lieu=:sor_lieu";

        } 

        if(isset($_GET['rech_auteur']) && $_GET['rech_auteur'] != "" ) {
            $auteur = $_GET['rech_auteur'];
            $query .= " AND u.util_pseudo=:util_pseudo";

        }

    if($option != NULL) {
        $query .= $option;
    }

    $stmt = $bdd->prepare($query);

    if(isset($mc_array)) {
        $x = 1;
        foreach ($mc_array as $mot) {
            $cle = 'keyword'.$x;
            $stmt->bindValue($cle, "%$mot%", PDO::PARAM_STR);
            $x++;  
        }        
    }
    if(isset($date)) $stmt->bindParam('sor_date', $date, PDO::PARAM_STR);  
    if(isset($id_lieu)) $stmt->bindParam('sor_lieu', $id_lieu, PDO::PARAM_STR);
    if(isset($auteur)) $stmt->bindParam('util_pseudo', $auteur, PDO::PARAM_STR);

    echo "<br>";
    var_dump($auteur);
echo "<br>";
    var_dump($stmt);
echo "<br>";

    $stmt->execute();     

    if ($stmt != FALSE) {
        return $stmt;
    } else {
        echo "Erreur lors de la suppression " . $bdd->error;
        return false;
    }
}

function select_sorties(string $option = NULL) {
    $valide = ' WHERE sor_valide=1';
    require('config.php');       

    $bdd = $conn;
    $param2 = 'SELECT * FROM Sortie'.$valide. $option;
    $resultat = mysqli_query($bdd, $param2);
    echo 'Il y a '. mysqli_num_rows($resultat) . ' entrée(s) dans la base de données : </br>';
    $donnees = mysqli_fetch_all($resultat, MYSQLI_ASSOC);

    return $donnees;
}

function selectSorties($option = NULL) {
    require('config.php');
    date_default_timezone_set("Europe/Paris");
    $bdd = $conn;    
    $query = "SELECT * FROM `Sortie` s JOIN Utilisateur u on (s.sor_auteur=u.util_id) JOIN Lieu l on (s.sor_lieu=l.lieu_ref) WHERE 1".$option;
    //$query .= $option;
    if(isset($_GET['submit_rech'])) {
        if($_GET['rech_date'] != "" ) {
            $date = $_GET['rech_date'];
            $query .= " AND sor_date = '".$date."'";

        }

        if($_GET['rech_lieu'] != "" ) {
            $id_lieu = $_GET['rech_lieu'];
            $query .= " AND sor_lieu = '".$id_lieu."'";

        } 

        if($_GET['rech_auteur'] != "" ) {
            $id_auteur = $_GET['rech_auteur'];
            $query .= " AND sor_auteur = '".$id_auteur."'";

        }

        if($_GET['rech_mc'] != "" ) {
            $mc = $_GET['rech_mc'];
            $sorties_mc = keywordSearch($mc);   
        }
    }    
    $resultat = mysqli_query($bdd, $query);
    $donnees = mysqli_fetch_all($resultat, MYSQLI_ASSOC);  

    if(isset($_GET['rech_mc']) && ($sorties_mc != null)) {
        $donnees = array_merge($sorties_mc, $donnees);    
    }

    return $donnees;    

}