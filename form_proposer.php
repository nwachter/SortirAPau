		<div>		
		<form class="formulaire" id="form_proposer" name="form_proposer" action="lieux.php" enctype="multipart/form-data" method="POST">
			<fieldset>
			<legend>Informations du Lieu</legend>	

				<!-- PRIORITE -->
				<label for="lieu_nom">Nom du Lieu</label>
				<input type="text" name="lieu_nom" id="lieu_nom" minlength="8"><br>			

				<label for="lieu_adresse">Adresse</label>
				<input type="text"  name="lieu_adresse" id="lieu_adresse"> <!-- <br /> -->	

				<label for="lieu_cp">Code Postal</label>
				<input type="number" name="lieu_cp" id="lieu_cp"> <br />

				<label for="sor_heure">Ville</label>
				<input type="text" name="lieu_ville" id="lieu_ville"> <br />				

				<!-- (Ajouter dans la fonction) Auteur du lieu  -->

				<label for="lieu_description">Description</label>
				<input type="text"  name="lieu_description" id="lieu_description"> <br />	
					

		        <label for="lieu_image">Image</label>
		        <input type="file" name="lieu_image" id="lieu_image">
		        <label for="btn_upload"></label>
		        <button type="submit" name="upload" id="btn_upload">Téléverser Photo</button>

				<div class="buttons">
					<label for="btn_submitLieu"></label>
					<input type="submit" value="Envoyer" name="submit_lieu" id="btn_submitLieu">

					<label for="btn_resetLieu"></label>
					<input type="reset" value="Reset" name="reset_lieu" id="btn_resetLieu">

					<label for="btn_affichageLieu"></label>
					<input type="button" value="Affichage Form" name="affichage_lieu" id="btn_affichageLieu" onclick="return affichageForm(this)">
				</div>

			</fieldset>			
		</form>
		</div>