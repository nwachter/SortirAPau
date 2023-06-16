		<?php $title = "Sortir A Pau - Lieux"; ?>
		<?php ob_start(); ?>

		<?php include('header.php'); ?>	

		<div>

			<h1>Lieux</h1>

			<h2 class="titre_suggestions">Suggestions</h2>
			<div class="liste_suggestions">
				<?php foreach($suggestions as $suggestion): ?>

				<article class="suggestion">	        
					<h3 class="titre"> <?= $suggestion['lieu_nom']; ?>	</h3>
					<?= '<img src="data:<?=$lieu[\'image_mime\']?>;base64, '.base64_encode($suggestion['lieu_image']).'"/>'; ?>
					<div class="description"><?= $suggestion['lieu_description']; ?></div>
				</article>
				<br>
				<?php endforeach ?>				           
			</div>			

			<div class="liste_lieux">	
				<h2 class="title">Liste des lieux d'intérêt sur Pau</h2>	
				<ul class="lieu">
				<?php foreach($lieux as $lieu): ?>
			        	<li><div class="img"><?= '<img src="data:.'.$lieu['image_mime'].'.;base64, '.base64_encode($lieu['lieu_image']).'"/>'; ?></div></li>
			        	<li id="<?= $lieu['lieu_ref'] ?>">
			            <article>
			            	<h3 class="nom"><?= $lieu['number']." - ".$lieu['lieu_nom']; ?></h3>
							<!-- remplacer $lieu['lieu_mime'] par '<img src="data:image/jpeg;base64, ' -->
			                <div class="adresse"><?= $lieu['lieu_adresse'].", ".$lieu['lieu_cp']." ".$lieu['lieu_ville']; ?></div> 
			                <div class="description"><?= $lieu['lieu_description']; ?></div>
			            </article>
			        	</li>
			            
			        <?php endforeach ?>		
				</ul>
			</div>	

		<?php if($loggedIn && $isAdmin): ?>
			<h2 class="title">Admin - Ajouter un lieu</h2>	
		 <?php require('form_proposer.php'); ?>
		<?php endif; ?> 

	</div>

	<?php include('footer.php'); ?>

	<?php $content = ob_get_clean(); ?>
	<?php require('layout.php') ?>