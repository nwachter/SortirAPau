		<?php $title = "Sortir A Pau - Administration"; ?>
		<?php ob_start(); ?>

		<?php include($_SERVER['DOCUMENT_ROOT'].'/header.php');//Si pb affichage, remettre dans div admin_container ?>		
		<div id="admin_container">			
			<?php if(isset($message)): ?>
			<div>
				<?= $message ?>	
			</div>
			<?php endif; ?>

			<div class="utilisateurs">
				<h1>Utilisateurs</h1>
				<ul>

				   <!-- Select membres --> 
					<?php foreach($users as $user) { ?>

					<li>
						<div><?= $user['util_id'] ?> - <?= $user['util_pseudo'] ?> ; Groupe : <?= $user['util_groupe'] ?></div>

						<form action="administration.php?util_id=<?= $user['util_id'] ?>" method="POST" id="form_utilisateur">
							<label for="util_groupe"></label>
							<select name="util_groupe" id="util_groupe">

							<?php 	foreach($groupes as $groupe): ?>

								<option value="<?= (int)$groupe['groupe_id']; ?>" name="util_groupe" id="<?php echo $groupe['groupe_id']; ?>"><!--Affichage :--><?php echo (int)$groupe['groupe_id'].' - '.$groupe['groupe_libelle']; ?></option>
							
							<?php endforeach; ?>				

							</select>	<br />

							<label for="submit_groupe"></label>
							<input type="submit" name="submit_groupe" id="submit_groupe" value="Changer de groupe">
							<label for="submit_supprimer_util"></label>
							<input type="submit" name="submit_supprimer_util" id="submit_supprimer_util" value="Supprimer l'utilisateur">							
						</form>		

						<!-- Créer fonction supprimer Membre dans model, mettre code PHP décidant action (if) dans controller <div>
					        <a id="supprimer" href="administration.php?supprimerUser=true&sor_ref=<?= $users['util_id'] ?>">Supprimer</a>
					    </div> -->
						
					</li>
					
				<?php } //fin foreach $users ?>
				</ul>
			</div>

		    <div class="sorties">
		    	<h1>Sorties</h1>

		    		<?php if($sortiesAValider != null): ?>
		    		<h2>Sorties en cours de vérification</h2>

		    		<ul class="sortie_admin">
			        <?php   foreach($sortiesAValider as $sortieAValider) {  ?>
				            	<li>
					                <div>Ref : <?= $sortieAValider['sor_ref'] ?><br> Intitulé : <?= $sortieAValider['sor_intitule']; ?></div>
					            	<div>
					                	<p>Lieu : <?= $sortieAValider['lieu_nom']; ?> <br>
					                	Adresse : <?= $sortieAValider['lieu_adresse'] ?>, <?php $sortieAValider['lieu_cp'] ?> <?=$sortieAValider['lieu_ville'] ?>
					                	</p> 
					            	</div>

					                <div>Date : <?= $sortieAValider['sor_date'] ?> à <?= $sortieAValider['sor_heure'] ?></div>		                		                
					                <div>Informations : <?= $sortieAValider['sor_resume'] ?></div>	                
					                <div>Auteur : <i><?= $sortieAValider['util_pseudo'] ?></i></div>     

					                <div>
					                	<form action="administration.php" method="POST">

					                		<label for="sor_ref"></label>
					                		<input type="hidden" name="sor_ref" id="sor_ref" value="<?=$sortieAValider['sor_ref']?>">

					                		<label for="submit_valider_sortie"></label>
					                		<input type="submit" name="submit_valider_sortie" id="submit_valider_sortie" value="Valider">			

					                		<label for="submit_supprimer_sortie"></label>
					                		<input type="submit" name="submit_supprimer_sortie" id="submit_supprimer_sortie" value="Supprimer">					                		
					                	</form>

					                	<form action="admin_modifier_sortie.php" method="POST">
					                		<label for="sor_ref"></label>
					                		<input type="hidden" name="sor_ref" id="sor_ref" value="<?=$sortieAValider['sor_ref']?>">					                		
					                		<label for="submit_modifier_sortie"></label>
					                		<input type="submit" name="submit_modifier_sortie" id="submit_modifier_sortie" value="Modifier">
					                	</form>

					                </div>
					            </li>    	            
				        <?php } ?>	
				    </ul>  
				    <?php endif; ?>  			        		           	           
				    <br />

				    <?php if($sortiesValides != null): ?>	
				    <h2>Sorties Prévues</h2>
		    		<ul class="sortie_admin">
			        <?php foreach($sortiesValides as $sortieValide) 
				        { ?>

				            	<li class="li_sortie_admin">
					                <div>Ref : <?= $sortieValide['sor_ref'] ?><br> Intitulé : <?= $sortieValide['sor_intitule']; ?></div>
					            	<div>
					                	<div>Lieu : <?= $sortieValide['lieu_nom']; ?> <br>
					                	Adresse : <?= $sortieValide['lieu_adresse'] ?>, <?php $sortieValide['lieu_cp'] ?> <?=$sortieValide['lieu_ville'] ?>
					                	</div> 

					            	</div>

					                <div>Date : <?= $sortieValide['sor_date'] ?> à <?= $sortieValide['sor_heure'] ?></div>		                		                
					                <div>Informations : <?= $sortieValide['sor_resume'] ?></div>		                
					                <div>Auteur : <i><?= $sortieValide['util_pseudo'] ?></i></div>
					                <div>
					                	<form action="administration.php" method="POST">

					                		<label for="sor_ref"></label>
					                		<input type="hidden" name="sor_ref" id="sor_ref" value="<?=$sortieValide['sor_ref']?>">			
					                		<label for="submit_supprimer_sortie"></label>
					                		<input type="submit" name="submit_supprimer_sortie" id="submit_supprimer_sortie" value="Supprimer">					                		
					                	</form>

					                	<form action="admin_modifier_sortie.php" method="POST">
					                		<label for="sor_ref"></label>
					                		<input type="hidden" name="sor_ref" id="sor_ref" value="<?=$sortieValide['sor_ref']?>">

					                		<label for="submit_modifier_sortie"></label>
					                		<input type="submit" name="submit_modifier_sortie" id="submit_modifier_sortie" value="Modifier">
					                	</form>	

					                	<a id="supprimer" href="administration.php?supprimer=true&sor_ref=<?= $sortieValide['sor_ref'] ?>">Supprimer</a>				                	
					                </div>
				            	</li>

				            	<!--</form>-->
				            	<br />
				            
				        <?php } ?>	
				    </ul> 
				    <?php endif; ?>					
								        
				</div> 	

		</div> 

		<?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>	

		<?php $content = ob_get_clean(); ?>

		<?php require($_SERVER['DOCUMENT_ROOT'].'/templates/layout.php') ?>	
