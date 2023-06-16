		<div>		
		<form class="form_organiser" id="form_organiser" name="form_organiser" action="organiser_sortie.php" method="POST" onsubmit="return validateSortie()">
			<fieldset>
			<legend>Organiser une Sortie</legend>	
			<div>
				<label for="sor_lieu">Lieu</label>
				<select name="sor_lieu" id="sor_lieu">
					<?php foreach($lieux as $lieu): ?>
					<option value="<?php echo (int) $lieu['lieu_ref']; ?>" name="<?= "lieu_".$lieu['lieu_ref']; ?>" id="<?= "lieu_".$lieu['lieu_ref']; ?>"><?php echo (int)$lieu['lieu_ref'].' - '.$lieu['lieu_nom'].' ; '.$lieu['lieu_adresse'].' '.$lieu['lieu_cp'].' '.$lieu['lieu_ville']; ?></option>				
					<?php endforeach; ?>

				</select> <span class="form_error_msg" id="error_lieu"></span>	<br />				

				<label for="sor_intitule">Intitulé</label>
				<input type="sor_intitule"  name="sor_intitule" id="sor_intitule" minlength="3" required> <span class="form_error_msg" id="error_intitule"></span>  <br />	

				<label for="sor_date">Date</label>
				<input type="date" name="sor_date" id="sor_date" required> <span class="form_error_msg" id="error_date"></span> <br />

				<label for="sor_heure">Heure</label>
				<input type="time" name="sor_heure" id="sor_heure" step="1" required> <span class="form_error_msg" id="error_heure"></span><br />				

				<label for="sor_resume">Resume</label><span class="form_error_msg" id="error_resume"></span> 

				<textarea name="sor_resume" id="sor_resume" placeholder="Détails de la sortie" required></textarea> <br />

				<label for="sor_participants">Nombre de participants</label>
				<input type="number"  name="sor_participants" id="sor_participants" required> <span class="form_error_msg" id="error_participants"></span> <br />				
					

				<div class="buttons">
					<label for="btn_submitSortie"></label>
					<input type="submit" value="Envoyer" name="submit_sortie" id="btn_submitSortie" onclick="return validateSortie()" > <br/>

					<label for="btn_resetSortie"></label>
					<input type="reset" value="Reset" name="reset_organiser" id="btn_resetSortie"> <br/>

					<label for="btn_affichageSortie"></label>
					<input type="button" value="Affichage Form" name="affichage_organiserSortie" id="btn_affichageOrganiser" onclick="return affichageForm(this)">
				</div>

			</fieldset>			
		</form>
		</div>