<?php 
	session_cache_expire();
	session_start(); 	 
	require_once('variables.php'); 
	require_once('functions.php');	

	require_once('src/model.php');
	require_once('src/sortiesModel.php');
	$d = new DateTime();
	$d = toString_datetime($d);
	$suggestions = getSuggestions();
	$users = getUtilisateurs();
	$sorties = getSorties();
	if(isset($_GET['submit_rech'])) $sortiesSearch = getSortiesSearch();
	$lieux = getLieux();

	require_once('templates/sortiesView.php');