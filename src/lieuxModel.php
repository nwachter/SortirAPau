<?php 
function validateLieu($array) { 

        if(isset($array['submit_lieu'])) 
        {
            if(isset($_SESSION['session_id']) ) 
            {    
                //TOUS CHAMPS VIDES
                if(empty($array['lieu_nom']) && !isset($_SESSION['util_id']) && empty($array['lieu_adresse']) && empty($array['lieu_cp']) && empty($array['lieu_ville']) && empty($array['lieu_description']) && $_FILES['lieu_image']['size'] == 0) 
                {
                    $message_erreur = "Veuillez remplir les champs.<br />";
                    $array = array();
                    $_FILES = array();
                }
                //Sinon
                else 
                {
                    $message_erreur = "";

                    //Nom Lieu
                    if(empty($array['lieu_nom']) || !preg_match('~[A-Za-z0-9-_\'.,":@&!?\(\)=%$*;+ ]{8,50}~', $array['lieu_nom']) ) {  
                        $message_erreur .= "Veuillez indiquer le nom du lieu.<br />";      
                    }
                    //Util non connecté
                    if(!isset($_SESSION['util_id']) && !isset($_SESSION['util_pseudo']) ) {
                        $message_erreur .= "Veuillez vous connecter pour poster le formulaire <br>";

                        header('Location: localhost/sign/connexion.php');
                    }        

                    //Adresse lieu
                    if(empty($array['lieu_adresse']) || !preg_match('~[A-Za-z0-9-_\'.,"@&!?\(\)=%$*;+ ]{8,80}~', $array['lieu_adresse']) ) {
                        $message_erreur .= "L'adresse est invalide.<br />";
         
                    }

                    //Code Postal 
                    if(empty($array['lieu_cp'])) {
                        $message_erreur .= "Veuillez indiquer le Code Postal.<br />";  
   
                    }  
                    //Ville
                    if(empty($array['lieu_ville']) ) {
                        $message_erreur .= "Veuillez indiquer la ville. <br />";      
                    }
                    else if(empty($array['lieu_description'] || !preg_match('~[A-Za-z0-9-_\'.,":@&!?\(\)=%$*;+ ]{10,1000}~', $array['lieu_description'])) ) {

                        $message_erreur .= "La description du lieu est trop courte ou contient des caractères invalides. <br>";
                    }  

                    // VERIFICATION IMAGE
                    if ($_FILES['lieu_image']['error']) {                         
                        switch ($_FILES['lieu_image']['error']) {                         
                            case 1: // UPLOAD_ERR_INI_SIZE    
                            $message_erreur .= "Le fichier dépasse la limite autorisée par le serveur !<br>";
                            $erreur++;
                            break;    
                            case 2: // UPLOAD_ERR_FORM_SIZE    
                            $message_erreur .= "Le fichier dépasse la limite autorisée dans le formulaire HTML !<br>";
                            $erreur++;
                            break;    
                            case 3: // UPLOAD_ERR_PARTIAL    
                            $message_erreur .= "L'envoi du fichier a été interrompu pendant le transfert !<br>";    
                            $erreur++;
                            break;
                            case 4: //Pas de fichier envoyé
                            $message_erreur .= "Veuillez téléverser une image.<br>";
                            break;
                            }
                         
                    }

                    if($_FILES['lieu_image']['size'] == 0) { 
                        $message_erreur .= "Veuillez téléverser une image valide.<br />";     
                    }

                        // VERIFICATION EXTENSION

                    $extensions_valides = array( 'jpg' , 'jpeg' , 'png' );
                    $extension_upload = strtolower(  substr(  strrchr($_FILES['lieu_image']['name'], '.')  ,1)  );
                    if(!in_array($extension_upload, $extensions_valides) ) {                    
                    $message_erreur .= "Extension non correcte <br>";
                    }
       
                    if( !empty($array['lieu_nom']) && !empty($array['lieu_adresse']) && !empty($array['lieu_cp']) && preg_match('~[A-Za-z0-9-_\'.,":@&!?\(\)=%$*;+ ]{3,80}~', $array['lieu_ville']) && !empty($array['lieu_description']) && preg_match('~[A-Za-z0-9-_\'.,":@&!?\(\)=%$*;+ ]{10,2000}~', $array['lieu_description']) && $_FILES['lieu_image']['size'] != 0 && in_array($extension_upload, $extensions_valides)
                    ) 
                    {
                        $lieu_nom = $array['lieu_nom'];
                        $lieu_adresse =  $array['lieu_adresse'];
                        $lieu_cp = $array['lieu_cp'];
                        $lieu_ville = $array['lieu_ville'];
                        $lieu_description = $array['lieu_description'];
                        $lieu_image = $_FILES['lieu_image']['tmp_name'];
                        $lieu_valide = 0;

                        $string = $_FILES['lieu_image']['name'];
                        $image_nom = $string;
                        $targetPath = 'image/';
                        $targetFilePath = $targetPath.$image_nom;  
                        $blob = fopen($lieu_image, 'rb');   
                        $image_mime = $_FILES['lieu_image']['type'];

                        $lieu_array = [$lieu_nom, $lieu_adresse, $lieu_cp, $lieu_ville, $lieu_description, $blob, $lieu_valide, $image_mime];
                        echo $message_erreur."<br />";
                        return $lieu_array;
                    }
                    else {

                        echo " <br>Il y a des valeurs fausses !".$message_erreur."<br />";
                        $array = array();
                        $_POST = array();
                        $_FILES = array();
                        return false;
                    }             
                } 
            }
            else 
            {
                $sor_auteur = false;
                $array = array();
                $_POST = array();
                $_FILES = array();
            }
        }

}

function insertLieu($lieu_array) {
    require('configpdo.php');
  
    if(is_array($lieu_array)){
        $stmt = $bdd->prepare("INSERT INTO Lieu (lieu_nom, lieu_adresse, lieu_cp, lieu_ville, lieu_description, lieu_image, lieu_valide, image_mime) VALUES (:lieu_nom, :lieu_adresse, :lieu_cp, :lieu_ville, :lieu_description, :lieu_image, :lieu_valide, :image_mime)"); 

        $stmt->bindParam(':lieu_nom', $lieu_array[0]);
        $stmt->bindParam(':lieu_adresse', $lieu_array[1]);
        $stmt->bindParam(':lieu_cp', $lieu_array[2]);
        $stmt->bindParam(':lieu_ville', $lieu_array[3]);
        $stmt->bindParam(':lieu_description', $lieu_array[4]);
        $stmt->bindParam(':lieu_image', $lieu_array[5], PDO::PARAM_LOB);
        $stmt->bindParam(':lieu_valide', $lieu_array[6]);
        $stmt->bindParam(':image_mime', $lieu_array[7]);
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