<?php 
	session_cache_expire();
	session_start(); 
	error_reporting(E_ALL); 
	ini_set('display_errors', 1);
	 
	include_once('../variables.php'); 
	include_once('../functions.php');	
	require_once('../classes/Utilisateur.php');

	if(isset($_GET['deconnexion']) ) {
		deconnexion();								
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />		
        <title>Administration - Confirmation</title>
        <link href="../style.css" type="text/css" rel="stylesheet" />   
	</head>

	<body>

		<div class="container">
			<?php include('../header.php'); ?>	
			<?php include('../nav.php'); ?>	

			<div><?php superglobales(); ?>
			</div>	

		<?php 
		if(isset($_SESSION['session_id']) && isset($_SESSION['util_id']) && isset($_SESSION['util_groupe']) && $_SESSION['util_groupe'] == 1):	
		?>

			<div>
				<h1>Administration - Confirmation</h1>				
			</div>

			<?php 

			if(isset($_POST['submit_modifier_sortie'])) {
				require('./admin_modifier_sortie.php');
			}
			elseif(isset($_POST['submit_valider_sortie'])) {
				//require...
			}
			elseif(isset($_POST['submit_supprimer_sortie'])) {

			}

			elseif(isset($_POST['submit_util_groupe'])) {

			}
			elseif(isset($_POST['submit_util_supprimer'])) {

			}

			 ?>
				

 
			<?php else:															
				echo "Vous n'avez pas accès à cette page.";
				endif; 								
			 ?>

			
			<?php include('../footer.php'); ?>

		</div>	

		<script type="text/javascript" src="script.js" async></script>
	</body>
</html>