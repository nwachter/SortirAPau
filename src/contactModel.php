<?php
function mail_utf8($to, $from_user, $from_email, $subject = '(Aucun sujet)', $message = '')
   {
      $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
      $subject = "=?UTF-8?B?".base64_encode($subject)."?=";

      $headers = "From: $from_user <$from_email>\r\n".
               "MIME-Version: 1.0" . "\r\n" .
               "Content-type: text/html; charset=UTF-8" . "\r\n";
    echo $subject."<br>".$headers."<br>";          

     return mail($to, $subject, $message, $headers);
   }

function verifContact($array, &$ast_array) {       
    if(empty($array['sujet']) && empty($array['email']) && empty($array['message'])) {
            $message_erreur = "Veuillez remplir les champs.<br />";
        }
    else {
            $message_erreur = "";

            if(empty($array['sujet'])) {
                $message_erreur .= "Le sujet est vide.<br />";
                $ast_array['sujet'] = "*";
                $array = array();          
            }

            if(empty($array['email']) || !filter_var($array['email'], FILTER_VALIDATE_EMAIL)) {
                $message_erreur .= "L'email est invalide.<br />";
                $ast_array['email'] = "*";
                $array = array();          
            }

            if(empty($array['message'])) {
            $message_erreur .= "Le champ message est vide.<br />";  
            $ast_array['message'] = "*";
            $array = array();       
            }

            if(!empty($array['sujet']) && !empty($array['email']) && !empty($array['message']) && filter_var($array['email'], FILTER_VALIDATE_EMAIL)) {
                $ast_array['message'] = "";
                $ast_array['sujet'] = "";
                $ast_array['email'] = "";
        
                return true;
            }
            echo $message_erreur;
            return false;        
        } 
}

