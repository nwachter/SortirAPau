<?php

$rootPath = $_SERVER['DOCUMENT_ROOT'];
$rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

$message = '';
$message_erreur = '';

   $loggedIn = (isset($_SESSION['util_pseudo']) && isset($_SESSION['util_groupe']) && isset($_SESSION['util_id']) && isset($_SESSION['session_id']) ) ? true : false;

    if ($loggedIn && $_SESSION['util_groupe'] != 1)  $isAdmin = false;
    elseif($loggedIn && $_SESSION['util_groupe'] == 1) $isAdmin = true;


require($rootPath.'/configpdo.php');


 $ast = "*";
 $ast_array = [                 
    'util_pseudo' => '',
    'util_password' => '',
    'util_confirm' => '',
    'util_email' => '',    
    'util_prenom' => '',
    'util_nom' => '',
    'util_telephone' => '',    
    'util_naissance' => '',
    'util_civilite' => '',
    'sujet' => '',
    'email' => '',
    'message' => '',
    'sor_lieu' => '',
    'sor_auteur' => '',
    'sor_intitule' => '',
    'sor_date' => '',
    'sor_heure' => '',
    'sor_resume' => '',   
 ];

