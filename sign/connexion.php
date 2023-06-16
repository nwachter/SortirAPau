<?php 
	session_cache_expire(120);
	ini_set('session.gc_maxlifetime', 120);	
	session_set_cookie_params(120); 	
	session_start(); 

	require($_SERVER['DOCUMENT_ROOT'].'/variables.php'); 
	require($_SERVER['DOCUMENT_ROOT'].'/functions.php');
	require($_SERVER['DOCUMENT_ROOT'].'/src/model.php');
	require($_SERVER['DOCUMENT_ROOT'].'/src/connexionModel.php');		        
	$message = '';

			if(!$loggedIn && isset($_POST['submit_connexion']) ) {
				if (verifConnexion($_POST)) {
					if ($infos_util = sign_up($_POST) == false) {
						$connexion = false;
						$message .= "Identifiants invalides : (".$_POST['util_pseudo']."/".$_POST['util_password'].")";
						$_POST = array();

					}
					else {	
					$connexion = true;
					$infos_util = sign_up($_POST);

					$_SESSION['util_id'] = $infos_util['util_id'];
					$_SESSION['util_pseudo'] = $infos_util['util_pseudo'];
					$_SESSION['util_email'] = $infos_util['util_email'];
					$_SESSION['util_prenom'] = $infos_util['util_prenom'];
					$_SESSION['util_groupe'] = $infos_util['util_groupe'];	
					$_SESSION['util_derniereconn'] = $infos_util['util_derniereconn'];					
					$_SESSION['session_id'] = session_id();
					$_SESSION['start'] = time();
        			$_SESSION['expire'] = $_SESSION['start'] + (2*60*60);	

        			$message .= "Bienvenue ".$_SESSION['util_pseudo'].'<br>';

                    setcookie('util_id', $infos_util['util_id'], 	
                    	[ 
                    	'expires' => time()+2*60*60, 
                    	'secure' => true, 
                    	'httponly' => true, 
                    	]); 	
                    setcookie('util_pseudo', $infos_util['util_pseudo'], [ 'expires' => time()+2*60*60, 'secure' => true, 'httponly' => true, ]);  
                    setcookie('util_password', $infos_util['util_password'], [ 'expires' => time()+2*60*60, 'secure' => true, 'httponly' => true, ]);
                    setcookie('util_groupe', $infos_util['util_groupe'], [ 'expires' => time()+2*60*60, 'secure' => true, 'httponly' => true, ]);                    
                    setcookie('util_derniereconn', $infos_util['util_derniereconn'], [ 'expires' => time()+2*60*60, 'secure' => true, 'httponly' => true, ]);                                          	
					$_GET = array();
					}										
					

				}
				else $message = "Les informations que vous avez entrées sont invalides <br>";

			}
			
			elseif ($loggedIn && isset($_POST['submit_connexion']) ) {
				$message .= "Vous êtes déjà connecté ! <br>";
				$_POST = array();
			}

			stop_session();	

			 if (isset($_POST['util_prenom'])) {
				$message_inscription = "Vous êtes bien inscrit, ".$_POST['util_pseudo']." ".$_POST['util_email']."</br>";
			}
			else $message_inscription = "Erreur lors de l'inscription, veuillez recommencer.";

			require($_SERVER['DOCUMENT_ROOT'].'/templates/connexionView.php');
