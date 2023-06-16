<?php $title = (isset($infos_util)) ? "Sortir A Pau - Utilisateur ".$infos_util['util_pseudo'] : "Sortir A Pau - Erreur"; ?>
<?php ob_start(); ?>

		<div class="container">
			<?php include('./header.php'); ?>

			<h1>Utilisateur</h1>			
			<div class="detail-mdp">
				<div>
					<div><?php  if(isset($message)) echo $message; ?> </div>	
				</div>

				<div>
					<h3 >Détail</h3>
					<table>
						<tr> 
							<?php foreach($columns as $column): ?>
							<th><?= $column['Comment'] ?></th>
							<?php endforeach; ?>							

						</tr>
						<tr>
							<?php					
								foreach($infos_util as $element) {	?>
							<td><?php echo $element; ?></td>
						<?php }  ?>
						</tr>
					</table>
				</div>

				<div>
					<h3>Mot de passe</h3>
			        <form action="utilisateur.php" class="small_form" method="POST">
						<fieldset>
						<legend>Modifier le mot de passe</legend>			        	
			            <div class="form_items_container">
			                <label for="ancien_password">Ancien mot de passe</label>
			                <input type="password" id="ancien_password" name="ancien_password"><br>

			                <label for="nouveau_password">Nouveau mot de passe</label>
			                <input type="password" id="nouveau_password" name="nouveau_password"><br>

			                <label for="confirm_password">Confirmation mot de passe</label>
			                <input type="password" id="confirm_password" name="confirm_password">
				           <!-- <label for="submit_password"></label> -->
				            <input type="submit" name="submit_password" />		
			        	</div>

			            </legend>
			    	    </fieldset>
			        </form>					

				</div>				
		
			</div>

			<?php if(isset($sortiesValides) && $sortiesValides != null): ?>
			<div class="sorties_util">
				<h2>Sorties organisées</h2>

				<?php foreach($sortiesValides as $sortieValide): ?>
				<div class="sorties_util">
		            <article class="art_sortie_util">
		            	<h3><div><?= $sortieValide['sor_intitule']; ?> <span>(<?= $sortieValide['sor_ref']?>)</span></div></h3>
		            	<div>
		                	<h3><?= $sortieValide['lieu_nom']; ?></h3>
		                	<p><?= $sortieValide['lieu_adresse'].", ".$sortieValide['lieu_cp']." ".$sortieValide['lieu_ville']; ?>
		                	</p> 

		            	</div>

		                <div><?= "Sortie prévue le : ".$sortieValide['sor_date']." à ".$sortieValide['sor_heure']; ?></div>	<br>		                		                
		                <div><?= $sortieValide['sor_resume']; ?></div><br>		                
		                <div><i><?= $sortieValide['util_pseudo']; ?></i></div><br>
		                <div><i>Sor_Valide = <?= $sortieValide['sor_valide']; ?></i></div><br>

						<form action="admin/admin_modifier_sortie.php" method="POST" id="form_modifier">

							<label for="sor_ref"></label>
							<input type="hidden" name="sor_ref" id="sor_ref" value="<?=$sortieValide['sor_ref']?>">							
							<label for="submit_modifier"></label>
							<input type="submit" name="submit_modifier" id="submit_modifier" value="Modifier la sortie">
						</form>				                
		            </article>
		        </div>    
		            
		        <?php endforeach;	?>
			</div>
			<?php endif; ?>

			<?php if(isset($sortiesAValider) && $sortiesAValider != null): ?>
			<div class="sorties_util">
				<h2>Sorties en cours de validation</h2>

				<?php foreach($sortiesAValider as $sortieAValider): ?>
					<div class="sortie_util">
		            <article class="art_sortie_util">
		            	<h3><div><?= $sortieAValider['sor_intitule']; ?></div></h3>
		            	<div>
		                	<h3><?= $sortieAValider['lieu_nom']; ?></h3>
		                	<p><?= $sortieAValider['lieu_adresse'].", ".$sortieAValider['lieu_cp']." ".$sortieAValider['lieu_ville']; ?>
		                	</p> 

		            	</div>

		                <div><?= "Sortie prévue le : ".$sortieAValider['sor_date']." à ".$sortieAValider['sor_heure']; ?></div>	<br>		                		                
		                <div><?= $sortieAValider['sor_resume']; ?></div><br>		                
		                <div><i><?= $sortieAValider['util_pseudo']; ?></i></div><br>
		                <div><i>Sor_Valide = <?= $sortieAValider['sor_valide']; ?></i></div><br>

						<form action="admin/admin_modifier_sortie.php" method="POST" id="form_modifier">

							<label for="sor_ref"></label>
							<input type="hidden" name="sor_ref" id="sor_ref" value="<?=$sortieAValider['sor_ref']?>">

							<label for="submit_modifier"></label>
							<input type="submit" name="submit_modifier" id="submit_modifier" value="Modifier la sortie">
						</form>			                
		            </article>
		        	</div>
		            
		        <?php endforeach;	?>
				
			</div>
		<?php endif; ?>
			
		</div>
		<?php include('./footer.php'); ?>	
		<script type="text/javascript" src="script.js" async></script>	

	<?php $content = ob_get_clean(); ?>

	<?php require('layout.php') ?>