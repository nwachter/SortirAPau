		<?php $title = "Sortir A Pau - Modifier Une Sortie"; ?>
		<?php ob_start(); ?>

		<div class="container">
			<?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>	

			</div>	

		<?php if($loggedIn && $isAdmin):	?>
			<?php if(!isset($sortieModifiee)): ?>

			<div>
				<h1>Modifier une sortie</h1>				
			</div>

				<div class="row">
					<h2 class="col-12">Sortie à modifier</h2>
					<div class="col-12">
				<?php      foreach($sorties as $sortie):   ?>
			            <article class="util_sortie">
			            	<h2><div><?= $sortie['sor_intitule']; ?> <span>(<?= $sortie['sor_ref']?>)</span></div></h2>
			            	<div>
			                	<h3><?= $sortie['lieu_nom']; ?></h3>
			                	<p><?= $sortie['lieu_adresse'].", ".$sortie['lieu_cp']." ".$sortie['lieu_ville']; ?>
			                	</p> 
			            	</div>
			                <div><?= "Sortie prévue le : ".$sortie['sor_date']." à ".$sortie['sor_heure']; ?></div>	<br>                
			                <div><?= $sortie['sor_resume']; ?></div><br>		                
			                <div><i><?= $sortie['util_pseudo']; ?></i></div><br>
			            </article>		            
			        <?php endforeach; 	?>
					</div>
				</div>			

			<?php //if(!$submitSortie || !$_POST['submit_sortie']):	 ?>										       

				<div>
					<h2>Formulaire de modification</h2>
					<div>		
					<form class="formulaire" id="form_modifier" name="form_modifier" action="admin_modifier_sortie.php" method="POST" onsubmit="return validateSortie()">
					<fieldset>
					<legend>Modifier une Sortie</legend>	

					    <label for="modifier_sortie"></label>
					    <input type="hidden" name="modifier_sortie" id="modifier_sortie" value="true">		

					    <label for="sor_ref"></label>
					    <input type="hidden" name="sor_ref" id="sor_ref" value="<?=$_POST['sor_ref']?>">					

						<!-- PRIORITE -->
						<label for="sor_lieu">Lieu</label>
						<select name="sor_lieu" id="sor_lieu">
							<?php foreach($lieux as $lieu):?>

							<option value="<?php echo (int) $lieu['lieu_ref']; ?>" name="<?= "lieu_".$lieu['lieu_ref']; ?>" id="<?= "lieu_".$lieu['lieu_ref']; ?>"><?php echo (int)$lieu['lieu_ref'].' - '.$lieu['lieu_nom'].' ; '.$lieu['lieu_adresse'].' '.$lieu['lieu_cp'].' '.$lieu['lieu_ville']; ?></option>				
							<?php endforeach; ?>

						</select> <span id="error_lieu"></span>	<br />				

						<label for="sor_intitule">Intitulé</label>
						<input type="sor_intitule"  name="sor_intitule" id="sor_intitule" minlength="3" required> <span id="error_intitule"></span> <br />	

						<label for="sor_date">Date</label>
						<input type="date" name="sor_date" id="sor_date" required> <span id="error_date"></span> <br />

						<label for="sor_heure">Heure</label>
						<input type="time" name="sor_heure" id="sor_heure" step="1" required> <span id="error_heure"></span><br />				

						<!-- (Ajouter dans la fonction) Auteur de la sortie  -->

						<label for="sor_resume">Resume</label>
						<input type="text"  name="sor_resume" id="sor_resume" required> <span id="error_resume"></span> <br />	

						<label for="sor_participants">Nombre de participants</label>
						<input type="number"  name="sor_participants" id="sor_participants" required> <span id="error_participants"></span> <br />						

						<div class="buttons">
							<label for="btn_submitSortie"></label>
							<input type="submit" value="Envoyer" name="submit_sortie" id="btn_submitSortie" onclick="return validateSortie()" >

							<label for="btn_resetSortie"></label>
							<input type="reset" value="Reset" name="reset_organiser" id="btn_resetSortie">

							<label for="btn_affichageSortie"></label>
							<input type="button" value="Affichage Form" name="affichage_organiserSortie" id="btn_affichageOrganiser" onclick="return affichageForm(this)">
						</div>

					</fieldset>			
					</form>
					</div>
				</div>
			<?php else: echo $message; ?>	
			<?php endif; ?>		

		<?php else:									
			echo "Vous n'avez pas accès à cette page.";
			endif; 								//endif 1
		?>

		<div><a href="<?=$pagePrecedente?>">Revenir à la page précédente</a></div>
			
			<?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>

		</div>	<!-- fin container -->

		<script type="text/javascript" src="script.js" async></script>		

		<?php $content = ob_get_clean(); ?>
		<?php require('layout.php'); ?>