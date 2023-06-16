		<?php $title = "Sortir A Pau - Connexion"; ?>
		<?php ob_start(); ?>

		<?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>		


		<?php if(!empty($message)): ?>
		<div><?= $message ?>
		</div>
		<?php endif; ?>	


		<div>
			<h1>Connexion</h1>
			<!-- Si clic sur Inscrivez-vous, envoie vers inscription.php -->
			<p>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous</a>.</p>
		</div>

		<?php if(isset($message_inscription)): ?>
		<div style="color:red;" id="confirm_inscription">		
		</div>
		<?php endif; ?>

		<div>

			<form class="formulaire" action="connexion.php" method="POST">
				<fieldset>
				<legend>Connexion</legend>
					<label for="conn_pseudo">Pseudo</label>
					<input type="text"  name="util_pseudo" id="conn_pseudo"> <br />
			
					<label for="conn_password">Mot de passe</label>
					<input type="password"  name="util_password" id="conn_password"> <br />					

					<label for="submit_connexion"></label>
					<input type="submit" value="Envoyer" name="submit_connexion" id="submit_connexion">
				</fieldset>			
			</form>			
		</div>
		<script type="text/javascript" src="<?=$_SERVER['DOCUMENT_ROOT']?>/script.js" async></script>

		<?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>	

		<?php $content = ob_get_clean(); ?>

		<?php require($_SERVER['DOCUMENT_ROOT'].'/templates/layout.php') ?>			