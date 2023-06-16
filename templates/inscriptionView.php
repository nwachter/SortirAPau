<?php $title =  "Sortir A Pau - Inscription "; ?>
<?php ob_start(); ?>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>			

		<div>
			<p id="p_info" style="color:blue; font-weight:900;"></p>
		</div>

	    <p id="affichage_form">
	    </p>
	    <?php if(!empty($message)): ?> 	
	    <div>
	        <p class="boldred">
	        </p>
	    </div>
		<?php endif; ?>

		<div>
			<h1>Inscription</h1>
			<!-- Si clic sur Inscrivez-vous, envoie vers inscription.php -->
			<p>Déjà inscrit ? <a href="../sign/connexion.php">Connectez-vous</a>.</p>
		</div>

		<div>		
		<form class="formulaire" id="form_inscription" name="form_inscription" action="../sign/inscription.php" method="POST" onsubmit="return validateForm()">
			<fieldset>
			<legend>Inscription</legend>

				 <span class="boldred"><?php  echo $ast_array['util_pseudo'];  ?> </span>
				 <label for="util_pseudo">Pseudo</label>
				<input type="text"  name="util_pseudo" id="util_pseudo"> <br />

				<span class="boldred"><?php  echo $ast_array['util_password'];  ?> </span>
				<label for="util_password">Mot de passe</label>
				<input type="password"  name="util_password" id="util_password"> <br />
				
				<span class="boldred"><?php  echo $ast_array['util_confirm'];  ?> </span>
				<label for="util_confirm">Confirmation mdp</label>
				<input type="password"  name="util_confirm" id="util_confirm"> <br />

				<span class="boldred"><?php  echo $ast_array['util_email'];  ?> </span>
				<label for="util_email">Adresse e-mail</label>
				<input type="email"  name="util_email" id="util_email"> <br />				

				<span class="boldred"><?php  echo $ast_array['util_prenom'];  ?> </span>
				<label for="util_prenom">Prénom</label>
				<input type="text"  name="util_prenom" id="util_prenom"> <br />	

				<span class="boldred"><?php  echo $ast_array['util_nom'];  ?> </span>
				<label for="util_nom">Nom</label>
				<input type="text"  name="util_nom" id="util_nom"> <br />	

				<span class="boldred"><?php  echo $ast_array['util_telephone'];  ?> </span>
				<label for="util_telephone">Numéro de téléphone</label>
				<input type="tel"  name="util_telephone" id="util_telephone"> <br />				


				<span class="boldred"><?php  echo $ast_array['util_naissance'];  ?> </span>
				<label for="util_naissance">Date de naissance</label>
				<input type="date" name="util_naissance" id="util_naissance"> <br />						
				
				<span class="boldred"><?php  echo $ast_array['util_civilite'];  ?> </span>
				<label for="util_civilite">Civilite :</label>
				<label for="btn_mme">
				Madame<input type="radio" name="util_civilite" id="btn_mme" value="Mme"></label>				
				<label for="btn_mlle">
				Mademoiselle<input type="radio" name="util_civilite" id="btn_mlle" value="Mlle"></label>
				<label for="btn_mon">
				Monsieur<input type="radio" name="util_civilite" id="btn_mon" value="M."></label> 
				<br />	

				<div class="buttons">
					<label for="btn_submit"></label>
					<input type="submit" value="Envoyer" name="submit">

					<label for="btn_reset"></label>
					<input type="reset" value="Reset" name="reset" id="reset">

					<label for="btn_affichage"></label>
					<input type="button" value="Affichage Form" name="btn_affichage" id="btn_affichage" onclick="return affichageForm()">
				</div>

			</fieldset>			
		</form>
		</div>
		
		<?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>	

		<script type="text/javascript" src="<?=$_SERVER['DOCUMENT_ROOT']?>/script.js" async></script>	
<?php $content = ob_get_clean(); ?>

<?php require($_SERVER['DOCUMENT_ROOT'].'/templates/layout.php') ?>