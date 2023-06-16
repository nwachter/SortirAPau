<?php 
	session_cache_expire();
	session_start(); 
	 
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
		<meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="../style.css" type="text/css" rel="stylesheet" />
        <link href="calendar.css" type="text/css" rel="stylesheet" />
		<link href="slideshow.css" type="text/css" rel="stylesheet" />   

	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> 
		
		<script type="text/javascript" src="script.js" async></script>
	</head>

	<body>
		<div id="container">

			<?php include('../header.php'); ?>	
			<?php include('../nav.php'); ?>		
			<div>
				<?php
					echo "Affiche infos sur session? : <br>";
					echo '$_SESSION Tableau : '.var_dump($_SESSION)."<br>";	
					echo '$_GET Tableau : '.var_dump($_GET)."<br>";
					if(isset($_GET['deconnexion']) ) {
						echo "<br><br> Deconnexion existe, infos : ".$_GET['deconnexion'];							
					}
		
				?>
			</div>

		<?php if(isset($_SESSION['session_id']) && $_SESSION['util_groupe'] == 1) {  ?>

	    <div class="sorties">

		        <?php

		        if(isset($_POST["submit_rech"])) 
		        {
		            echo "isset rech_submit!<br />";
		           	print_r($_GET."<br><br>");

		        	$sorties = selectSorties();

					$x=0;
			        foreach($sorties as $sortie) :
			        	$numSortie = $numSortie+1; 
			        	$auteur = getAuteurSortie($sortie);
			        	$lieu = getLieuSortie($sortie);

			        	?>

			        <h1>Recherche de Sorties</h1>

			        	<h2>Résultats de la Recherche :</h2>

			            <article class="sortie">
			            	<h2><?php echo $numSortie; ?>
			                <div class="sor_infos intitule varphp"><?php echo $sortie['sor_intitule']; ?></div></h2>
			            	<div class="sor_infos lieu">
			                	<h3 class="sor_lieu infos_lieu boldred"><?php echo $sortie['lieu_nom']; ?></h3>
			                	<p class="sor_infos infos_lieu"><?php echo $lieu['lieu_adresse'].", ".$lieu['lieu_cp']." ".$lieu['lieu_ville']; ?>
			                	</p> 

			            	</div>

			                <div class="sor_infos varphp"><?php echo "Sortie prévue le : ".$sortie['sor_date']." à ".$sortie['sor_heure']; ?></div>	<br>		                		                
			                <div class="sor_infos varphp"><?php echo $sortie['sor_resume']; ?></div><br>		                
			                <div class="sor_infos varphp boldred"><i><?php echo $sortie['util_pseudo']; ?></i></div><br>
			            </article>
			            
			        <?php endforeach ?>	
							        		           	           

		        <?php }

		        else {
		            echo "Bouton submit non cliqué (onsubmit bloqué) - Affichage de TOUTES LES SORTIES :<br /> ".print_r($_POST)."<br />"; 
		            ?>


			        <h1>Liste des Sorties</h1>

					
			        <?php 

					$option = ' WHERE lieu_ref=1';
					$sorties = selectSorties($option);

					$x=0;
			        foreach($sorties as $sortie) :
			        	$numSortie = $numSortie+1; 
			        	$auteur = getAuteurSortie($sortie);
			        	$lieu = getLieuSortie($sortie);
			        	?>

			            <article class="sortie">
			            	<h2><?php echo $numSortie; ?>
			                <div class="sor_infos intitule varphp"><?php echo $sortie['sor_intitule']; ?></div></h2>
			            	<div class="sor_infos lieu">
			                	<h3 class="sor_lieu infos_lieu boldred"><?php echo $sortie['lieu_nom']; ?></h3>
			                	<p class="sor_infos infos_lieu"><?php echo $lieu['lieu_adresse'].", ".$lieu['lieu_cp']." ".$lieu['lieu_ville']; ?>
			                	</p> 

			            	</div>

			                <div class="sor_infos varphp"><?php echo "Sortie prévue le : ".$sortie['sor_date']." à ".$sortie['sor_heure']; ?></div>	<br>		                		                
			                <div class="sor_infos varphp"><?php echo $sortie['sor_resume']; ?></div><br>		                
			                <div class="sor_infos varphp boldred"><i><?php echo $sortie['util_pseudo']; ?></i></div><br>
			            </article>
			            
			        <?php endforeach ?>	
							        
			    </div> 	

		        <?php } ?>

	    </div> 

	<?php } else { 
				echo "Vous ne pouvez pas accéder à cette page.";
			}
		?>	

		<?php include('../footer.php'); ?>

	</body>
</html>
