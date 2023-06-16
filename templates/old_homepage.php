					<!-- Vue -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<!--<meta name="viewport" content="width=device-width, initial-scale=1"> -->

        <link href="style.css" type="text/css" rel="stylesheet" />
        <link href="calendar.css" type="text/css" rel="stylesheet" />
		<link href="slideshow.css" type="text/css" rel="stylesheet" />  

		<!-- Polices -->
		<link href='https://fonts.googleapis.com/css?family=Brawler&subset=latin' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Calligraffitti&subset=latin' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Bentham&subset=latin' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Corben&subset=latin' rel='stylesheet' type='text/css'>	
		<link href='https://fonts.googleapis.com/css?family=Caudex&subset=latin' rel='stylesheet' type='text/css'>	
		<link href='https://fonts.googleapis.com/css?family=Cabin&subset=latin' rel='stylesheet' type='text/css'>				

		<!-- Bootstrap -->
	    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
	</head>

	<body>
		<?php include('nav.php'); ?>
		<?php include('header.php'); ?>	
			
	

		<div class="container_gauche">
			<div>
				<?= $rootUrl ?>
				<?= $rootPath."<br>"?>			
			</div>			

			<div>
				<h2 class="h-manus">Suggestions</h2>
				<?php foreach($suggestions as $suggestion):
					//transformer foreach en for x<2 (index) pour afficher 2 lieux seulement OU faire lieuxSuggestion array
				 ?>
				<article class="suggestion-gauche">	
					<div class="h3-manus"><a href="lieux.php#<?= $suggestion['lieu_ref'] ?>">
					         <?= $suggestion['lieu_nom']; ?></a></div>	        
					<div class="suggestion-img"><?= '<img style="width:250px;" src="data:'.$suggestion['image_mime'].';base64, '.base64_encode($suggestion['lieu_image']).'" />'; ?></div>
					<div><?= $suggestion['lieu_description']; ?></div>
				</article>
				<?php endforeach ?>				           
			</div>

			<div class="css_calendar">
				<div class="month">      
				  <ul>
				    <li class="prev">&#10094;</li>
				    <li class="next">&#10095;</li>
				    <li>
				      July<br>
				      <span style="font-size:18px">2021</span>
				    </li>
				  </ul>
				</div>

				<ul class="weekdays">
				  <li>Mo</li>
				  <li>Tu</li>
				  <li>We</li>
				  <li>Th</li>
				  <li>Fr</li>
				  <li>Sa</li>
				  <li>Su</li>
				</ul>

				<ul class="days">  
				  <li>1</li>
				  <li>2</li>
				  <li>3</li>
				  <li>4</li>
				  <li>5</li>
				  <li>6</li>
				  <li>7</li>
				  <li>8</li>
				  <li>9</li>
				  <li><span class="active">10</span></li>
				  <li>11</li>
				  <li>12</li>
				  <li>13</li>
				  <li>14</li>
				  <li>15</li>
				  <li>16</li>
				  <li>17</li>
				  <li>18</li>
				  <li>19</li>
				  <li>20</li>
				  <li>21</li>
				  <li>22</li>
				  <li>23</li>
				  <li>24</li>
				  <li>25</li>
				  <li>26</li>
				  <li>27</li>
				  <li>28</li>
				  <li>29</li>
				  <li>30</li>
				  <li>31</li>
				</ul>	
			</div>

			<div>
				<h2>Utilisateurs</h2>
				<?php	foreach ($users as $user):	?>				 
				<div>
					<div><?= $user['util_id']." - ".$user['util_pseudo']; ?></div>
				</div>

			<?php endforeach; ?>
			</div>		

		<!-- fin container_gauche -->
		</div>

		<div class="container_accueil">		

			<!--<div>

				 custom tags A CHECKER webcomponents 
				<calendar-lite></calendar-lite> 
			</div>-->

			<div class="introduction div-1"> 
				<p class="covid"><b>COVID-19 :</b>Lors de rencontres dans des lieux clos il est fortement suggéré de porter un masque et d'amener une solution hydroalcoolique.</p>
				<p>Découvrez la ville de Pau à plusieurs, rejoignez une sortie déjà organisée ou organisez-en une à la date et au lieu de votre choix, pour... Sortir A Pau !</p>
			</div>			
	


	<!-- Fin calendrier -->	

	<!-- Debut sorties -->	
		<div class="div-1">	
			<h1 class="h-manus">Sorties du mois</h1>					
		    <div class="container_sorties" onclick="changeColor(this)">		    	
			<?php
			//Lors de clic sur une date calendrier, changer l'affichage et afficher les (10 max) sorties prévues le jour cliqué. OU envoyer vers sorties.php?sor_date=xxxx-xx-xx ? 
			//En dessous, lien vers page sortie "Voir toutes les sorties"  
				        foreach($sorties as $sortie) : 
				        	?>
				            <article class="sortie div-1">
				                <h2><?= $sortie['number']; ?> - <a href="./sortie.php?sor_ref=<?=$sortie['sor_ref']?>"><?= $sortie['sor_intitule']; ?></a></h2>
				            	<div>
				                	<h3><?= htmlspecialchars($sortie['lieu_nom']); ?></h3>
				                	<p><?= htmlspecialchars($sortie['lieu_adresse']).", ".htmlspecialchars($sortie['lieu_cp'])." ".htmlspecialchars($sortie['lieu_ville']); ?>
				                	</p> 
				            	</div>

				                <div><?= "Sortie prévue le : ".$sortie['sor_date']." à ".$sortie['sor_heure']; ?></div>	<br>
				                <div><?=$sortie['nb_participants']?>/<?=$sortie['sor_participants']?></div>		                		                
				                <div><?= nl2br(htmlspecialchars($sortie['sor_resume'])); ?></div><br>		                
				                <div><i><?= htmlspecialchars($sortie['util_pseudo']); ?></i></div><br>
				            </article>				            
				        <?php endforeach ?>		 		
			</div>
		</div>	
			<!-- Fin container_sorties -->


			<div class="accueil_lieux div-1">				
			<?php 		
				foreach($lieux as $lieu) : 
			?>
				<div class="slideshow-container">	        

					<div class="mySlides fade">
					  <div class="lieu_nom"><a href="lieux.php#<?= $lieu['lieu_ref'] ?>">
					        <?= $lieu['lieu_nom']; ?></a></div>					
					  <div class="numbertext"><?= $lieu['number'] ?> / 3</div>
					  <?= '<img style="width:100%" src="data:'.$lieu['image_mime'].';base64, '.base64_encode($lieu['lieu_image']).'"/>'; ?>
					  <div class="text"><?= $lieu['lieu_description']; ?></div>
					</div>

				    <?php endforeach ?>	

					<a class="prev" onclick="plusSlides(-1)">❮</a>
					<a class="next" onclick="plusSlides(1)">❯</a>

					</div><br>

				<div style="text-align:center">
				  <span class="dot" onclick="currentSlide(1)"></span> 
				  <span class="dot" onclick="currentSlide(2)"></span> 
				  <span class="dot" onclick="currentSlide(3)"></span> 
				</div>	

				<!-- FIN SLIDESHOW -->	
				<script type="text/javascript" src="slideshow.js"></script>				
				            
			</div>	


		<div><?php require('calendrier.php') ?>	
	</div>


			<script type="text/javascript" src="script.js" async></script>
			<script type="text/javascript" src="script_tests.js" async></script>

			<script type="text/javascript">

				/*
				Quand hover liste_sorties, zoomer :
				element.children

				Quand hover ( quand key ->), faire défiler sorties vers gauche :
				element.nextElementSibling
				Quand hover (quand key <- ), faire défiler vers droite les sorties :
				element.previousElementSibling*/
			</script>

		</div>	

		<?php include('footer.php'); ?>		
	</body>
</html>