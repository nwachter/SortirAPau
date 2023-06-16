<?php 
    session_cache_expire();
    session_start();
    error_reporting(-1);
    ini_set('display_errors', 'On');     
     
    require_once('variables.php'); 
    require_once('functions.php'); 
    require_once('src/model.php');
    require_once('src/contactModel.php');


    if(isset($_POST['submit'])) {
            $to = "sortirapau64000@ikmail.com";
            $from_email = "sortirapau64000@ikmail.com";
            $subject = $_POST['sujet'];        
            if($loggedIn) {
                $from_user = $_SESSION['util_pseudo'];
                $message = $_POST['message']."<br>Membre ".$from_user." ".$_SESSION['util_email'];
                $mailDetails = [
                    'destinataire' => 'SortirAPau',
                    'expediteur' => $from_user,
                    'email' => $_SESSION['util_email'],
                    'sujet' => $subject,
                    'message' => $message,
                ];                
            }
            else {
                $from_user = 'Anonyme';   
                $message = $_POST['message']."<br>".$from_user." ".$_POST['email'];  
                $mailDetails = [
                    'destinataire' => 'SortirAPau',
                    'expediteur' => $from_user,
                    'email' => $_POST['email'],
                    'sujet' => $subject,
                    'message' => $message,
                ];                           
            } 


        if(verifContact($mailDetails, $ast_array)) {
            if($mail = mail_utf8($to, $from_user, $from_email, $subject, $message)) {
                $message_erreur = "Votre mail a bien été envoyé !<br>";
                $mailEnvoye = true;

            }
            else {
                $message_erreur = "<div>Votre mail n'a pas été envoyé :(, veuillez réessayer.<br>To = $to ; From_user = $from_user ; from_email = $from_email ; subject = $subject ; message = $message <div><br>";
                //$mailEnvoye = false;                     
            }
            
        }
        else $message_erreur = "<div>Certains champs sont invalides.</div>";
                  
    }    
    require('templates/contactView.php');

?>
