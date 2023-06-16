<?php deconnexion(); ?>
<header>
  <img id="logo" src="<?=$rootUrl?>media/SortirAPau_logo.png" height="70px"/>
</header>

<!-- NAV -->
<nav class="row align-items-start navbar navbar-expand-lg navbar-light bg-light menu"> 
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">        
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../sorties.php">Sorties</a>
        </li>  
        <li class="nav-item">
          <a class="nav-link" href="../organiser_sortie.php">Organiser une sortie</a>
        </li>  
        <li class="nav-item">
          <a class="nav-link" href="../lieux.php">Lieux</a>
        </li>                             
        <li class="nav-item">
          <a class="nav-link" href="../contact.php">Contact</a>
        </li>
        <?php         if(!isset($_SESSION['util_id'])):     ?>
        <li class="nav-item" id="lien_connexion">
          <a class="nav-link" href="../sign/connexion.php">Connexion</a>
        </li>         
        <?php  else: ?>
        <li class="nav-item">
          <a href="../utilisateur.php" class="nav-link"><img src="../media/pastille_util.png" id="pastille_util" placeholder="Pastille Utilisateur"></img>Utilisateur</a>
        </li> 
        <li class="nav-item">
          <a href="../accueil.php?deconnexion=true" class="nav-link">Deconnexion</a>
        </li>         
        <?php endif; ?>
        <?php
          if(isset($_SESSION['session_id']) && $_SESSION['util_groupe'] == 1):   ?> 
        <li class="nav-item" id="lien_administration">
          <a class="nav-link" href="../admin/administration.php">Administration</a>
        </li>  
        <?php endif; ?>          
      </ul>
    </div>
  </div>
</nav>