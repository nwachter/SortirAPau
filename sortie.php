<?php 
    session_cache_expire();
    session_start(); 
    require('configpdo.php');    
    include('variables.php'); 
    include('functions.php');   
    require('src/model.php');   

    $getData = $_GET;
    if (!isset($getData['sor_ref']))
    {
        echo('La sortie n\'existe pas');
        return;
    }

    $sorties = getSorties(' AND sor_ref='.$getData['sor_ref']); 
    $sortieDetails = getSortie(' AND sor_ref='.$getData['sor_ref']);  
    $sor_intitule = $sortieDetails['sor_intitule'];

    $participantsNames = getParticipantsNames($getData['sor_ref']);

    if(isset($_SESSION['util_id'])) {
        $estMembreSortie = (estMembreSortie($_SESSION['util_id'], $getData['sor_ref'])) ? true : false;
        if(!$estMembreSortie) {
            if(isset($_POST['submit_rejoindre'])) {
                $aRejointSortie = (rejoindreSortie($_SESSION['util_id'], $getData['sor_ref'])) ? true : false;
                $_POST = array();            
            }
        }
    }
    else $estMembreSortie = false;

    require('templates/sortieView.php');

