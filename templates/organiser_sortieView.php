<?php $title =  "Sortir A Pau - Organiser une Sortie "; ?>
<?php ob_start(); ?>	

    <?php include_once('header.php'); ?>			

		<div class="message_error">
			<p class="p_info" style="color:blue; font-weight:900;">
			</p>
			<p id="messageId" style="color:blue; font-weight:900;">
			</p>
		</div>
		
		<?php if(isset($message)): ?>
	    <div>
	        <p class="boldred">
	   		<?= $message ?>     	
	        </p>
	    </div>
		<?php endif; ?>

		<div>
			<h1>Organiser une sortie</h1>
			<!-- Si clic sur Inscrivez-vous, envoie vers inscription.php -->
			<p>Ici, vous pouvez proposer une sortie à l'un des lieux indiqués sur le site (si vous voulez proposer de nouveaux lieux, veuillez nous contacter par le biais de la page Contact.</p>	
		</div>

		<?php if($loggedIn): 
		 require('form_organiser.php');  ?>
		<?php else: ?>
			<div>
				<p>Veuillez vous connecter pour organiser une sortie.</p>
			</div>
		<?php endif; ?>	
	
		<?php include('footer.php'); ?>		

	<?php $content = ob_get_clean(); ?>

	<?php require('layout.php') ?>    