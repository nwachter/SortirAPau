		<div>
			<?php
			if(isset($_GET['submit_connexion']) && !isset($_SESSION['user_id'])) {
				if (verifConnexion($_GET)) {
					echo "VerifConnexion True";
					$infos_util = sign_up($_GET);

					$_SESSION['util_id'] = $infos_util['util_id'];
					$_SESSION['util_pseudo'] = $infos_util['util_pseudo'];
					$_SESSION['util_prenom'] = $infos_util['util_prenom'];
					$_SESSION['util_groupe'] = $infos_util['util_groupe'];
					$_SESSION['session_id'] = session_id();
				}
			}	
			?>		
		</div>
		<div>
			<h1>Connexion</h1>
			<p>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous</a>.</p>
		</div>

		<div style="color:red;" id="confirm_inscription">
			<?php if (isset($_GET['util_prenom'])) {
				echo "<b>Données d'inscription".var_dump($_GET)."</br>";
			}
			?>
		</div>

		<div>

			<form class="formulaire" action="/sign/connexion.php" method="GET">
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

		<div id="msg_confirm">
			<?php if (isset($_GET['util_pseudo'])) {
				$util_pseudo = $_GET['util_pseudo'];
				echo "<b>Bienvenue ".$util_pseudo." ";
			}
			?>
		</div>