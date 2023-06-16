	<?php 
	$title = (isset($sor_intitule)) ? "Sortir A Pau - Sortie : ".$sor_intitule : "Sortir A Pau - Erreur";
	//$title = "Sortir A Pau - Sortie"; 
	?>
	<?php ob_start(); ?>

    <?php include_once('header.php'); ?>
			
	<div>
		<div><a href="sorties.php">Retour à la liste des sorties</a></div>

	<div class="informations">

		<?php if (isset($aRejointSortie) && !$aRejointSortie): ?>
		<div class="error-msg">Il y a eu une erreur lors de votre ajout à la sortie.
		</div>
		<?php elseif (isset($aRejointSortie) && $aRejointSortie): ?>
		<div class="info-msg">Vous venez bien de rejoindre la sortie!</div>
		<?php endif; ?>

		<div>
			<p id="p_info" style="color:blue; font-weight:900;"></p>
		</div>
	</div>	

	    <div>	           		
		        <?php  foreach($sorties as $sortie): ?>

		            <article>
		            	<div class="details_sortie">
			            	<h1 class="h-manus"><?= $sortie['sor_intitule']; ?></h1>
							<div><?= '<img style="width:300px;" src="data:'.$sortie['image_mime'].';base64, '.base64_encode($sortie['lieu_image']).'" />'; ?></div>			            	
			            	<div>
			                	<h3 class="h3-manus"><?= $sortie['lieu_nom']; ?></h3>
			                	<p><?= $sortie['lieu_adresse'].", ".$sortie['lieu_cp']." ".$sortie['lieu_ville']; ?>
			                	</p> 
			            	</div>

			                <div><?= "Sortie prévue le : ".$sortie['sor_date']." à ".$sortie['sor_heure']; ?></div><br>	                		                
			                <div><?= $sortie['sor_resume']; ?></div>
			                <div><i><?= $sortie['util_pseudo']; ?></i></div>
		                </div>

		                <div class="participants">
		                	<div>Nombre de participants : <span><?= $sortie['nb_participants']; ?></span>/<span><?= $sortie['sor_participants']; ?></span></div> <br>

		                	<div class="participants_names">
		                		<h3>Liste des participants</h3>
		                		<?php foreach($participantsNames as $participantName) { ?>
		                		<p><?= $participantName['util_pseudo'];?>, <?= $participantName['util_age']?> ans</p>
		                	</div>

		                </div> 	                               
		                
		            </article>	            
		            
		        			<?php } ?>	

		        			<?php if($loggedIn && !$estMembreSortie): ?>
		                	<form method="POST" id="form_rejoindre" name="form_rejoindre">
		                		<input type="submit" name="submit_rejoindre" id="submit_rejoindre" value="Rejoindre la Sortie">
		                	</form>	

		                	<?php elseif($loggedIn && $estMembreSortie): ?>
		                	<p class="info-msg">Vous avez déjà rejoint la sortie !</p> 
		                	<?php endif; ?> 

		        <?php endforeach; ?>


	    </div>


	</div>			
	<?php include('footer.php'); ?>	
    <script type="text/javascript" src="script.js" async></script>	
    
	<?php $content = ob_get_clean(); ?>
	<?php require('layout.php') ?>