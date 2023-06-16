	<?php $title = "Sortir A Pau - Sorties"; ?>
	<?php ob_start(); ?>

    <?php include_once('header.php'); ?>			
    	<h2 class="h-manus">Rechercher une sortie</h2>
		<div id="div_rechercher">		
		<form id="form_recherche" name="form_recherche" action="sorties.php" method="GET">

				<div class="barre_rech">

					<div>
						<label for="rech_date"></label>
						<input type="date" class="barre_rech" name="rech_date" id="rech_date" placeholder="Date de la Sortie"> <br />
					</div>

					<div>
						<label for="rech_lieu"></label>
						<select name="rech_lieu" id="rech_lieu" class="barre_rech" style="height: 50px; line-height: 1.5em;">

							<!-- Emplacement organiser_sor_lieux-->
							<option disabled>------------ Lieu ------------</option>
							<?php 	       
						    foreach($lieux as $lieu):
								?>

							<option value="<?= (int) $lieu['lieu_ref']; ?>" name="rech_lieu" id="rech_lieu_<?= $lieu['lieu_ref']; ?>"><?= (int)$lieu['lieu_ref'].' - '.$lieu['lieu_nom'].' ; '.$lieu['lieu_adresse'].' '.$lieu['lieu_cp'].' '.$lieu['lieu_ville']; ?></option>				
							<?php endforeach; ?>

						</select>	<br />
					</div>
							
					<div>
						<label for="rech_auteur"></label>
						<input type="text" class="barre_rech" name="rech_auteur" id="rech_auteur" placeholder="Auteur de la Sortie"> <br />	
				    </div>


					<div>
						<label for="rech_mc"></label>
						<textarea id="rech_mc" class="barre_rech" name="rech_mc" placeholder="Mots-clés" maxlength="200"></textarea>  <br />
					</div>				
						

					<div>
						<label for="submit_rech"></label>
						<input type="submit" class="barre_rech" value="Chercher" name="submit_rech" id="submit_rech">
					</div>

				</div>						    		
		</form>
	</div>

	<div class="informations">
		<div>
			<p id="p_info" style="color:blue; font-weight:900;">
			</p>
		</div>

	</div>	

	    <div>
	        <?php if(isset($_GET['submit_rech'])): ?>	           
	        	<h1>Recherche de Sorties</h1>';
		        <h2>Résultats de la Recherche :</h2>';

		        <?php foreach($sortiesSearch as $sortieSearch): ?>
		            <article class="art-sortie">
		            	<h2><?= $sortieSearch['number']; ?> - <a href="./sortie.php?sor_ref=<?=$sortieSearch['sor_ref']?>"><?= $sortieSearch['sor_intitule']; ?></a></h2>
		            	<div>
		                	<h3><?= $sortieSearch['lieu_nom']; ?></h3>
		                	<p><?= $sortieSearch['lieu_adresse'].", ".$sortieSearch['lieu_cp']." ".$sortieSearch['lieu_ville']; ?>
		                	</p> 
		            	</div>

		                <div><?= "Sortie prévue le : ".$sortieSearch['sor_date']." à ".$sortieSearch['sor_heure']; ?></div>	<br>
		                <div><?= $sortieSearch['sor_resume']; ?></div><br>
		                <div>Nombre de participants : <span><?= $sortieSearch['nb_participants'] ?></span>/<span><?= $sortieSearch['sor_participants']; ?></span></div><br>		                 
		                <div><i><?= $sortieSearch['util_pseudo']; ?></i></div><br>
		            </article>            
		        <?php endforeach; ?>						        		           	           
	        <?php else:  ?>
		        <h1>Liste des Sorties</h1>			
		        <?php   foreach($sorties as $sortie) :?>
		        <div class="art-sortie-wrapper">
		            <article class="art-sortie">
		            	<h2 class="h2-sortie"><?= $sortie['number']; ?> - <a href="./sortie.php?sor_ref=<?=$sortie['sor_ref']?>"><?= $sortie['sor_intitule']; ?></a></h2>
		                <h3><?= $sortie['lieu_nom']; ?></h3>
		                <p><?= $sortie['lieu_adresse'].", ".$sortie['lieu_cp']." ".$sortie['lieu_ville']; ?>
		                </p> 

		                <div><?= "Sortie prévue le : ".$sortie['sor_date']." à ".$sortie['sor_heure']; ?></div><br>	                		                
		                <div><?= $sortie['sor_resume']; ?></div>
		                <div>Nombre de participants : <span><?= $sortie['nb_participants'] ?></span>/<span><?= $sortie['sor_participants']; ?></span></div> <br>	                
		                <div><i><?= $sortie['util_pseudo']; ?></i></div>
		            </article>
		        </div>
		            
		        <?php endforeach ?>	
	        <?php endif; ?>
	    </div>

	</div>			
	<?php include('footer.php'); ?>	
    <script type="text/javascript" src="script.js" async></script>	
	
	<?php $content = ob_get_clean(); ?>
	<?php require('layout.php') ?>