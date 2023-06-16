<?php $title =  "Sortir A Pau - Contact "; ?>
<?php ob_start(); ?>

    <?php include_once('header.php'); ?>
    <h1>Contactez nous</h1>

    <?php if(isset($message_erreur)) echo $message_erreur; ?>
    <?php if(isset($_POST['submit']) && isset($mailEnvoye)): ?>
            <div class="mail_details">
                <h2>Message envoyé ! Détails du message :</h2>
                <p><span>Expéditeur : </span><?=$mailDetails['expediteur']?></p>
                <p><span>Sujet du message : </span><?=$mailDetails['sujet']?></p>
                <p><span>Contenu du message : </span><?=$mailDetails['message']?></p>
            </div>         
    <?php endif; ?>
  
    <div class="container contact">

        <form action="contact.php" class="small_form" method="POST">
            <div class="form_items_container">
        <?php if($loggedIn): ?>
                <p>Votre pseudo : <?= $_SESSION['util_pseudo'] ?></p>
                <span></span>
                <p>Votre email : <?= $_SESSION['util_email'] ?></p>
                <span></span>
            <?php else: ?>            
                <label for="email" class="form-label"><span class="boldred"><?php  echo $ast_array['email'];  ?> </span>Votre adresse email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help">
        <?php endif; ?>
                <label for="sujet" class="form-label"><span class="boldred"><?php  echo $ast_array['sujet']; ?></span>Sujet du message</label>
                <input type="text" class="form-control" placeholder="Sujet du message à transmettre" id="sujet" name="sujet"></input>      
                <label for="message" class="form-label"><span class="boldred"><?php  echo $ast_array['message']; ?></span>Votre message</label>
                <textarea class="form-control" placeholder="Contenu du message à transmettre aux administrateurs." id="message" name="message"></textarea>
                <input type="submit" name="submit" class="btn btn-primary" />
            <div>    

        </form>
        <br />
    </div>

    <?php include_once('footer.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
