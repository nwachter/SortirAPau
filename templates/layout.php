<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <!--<meta name="viewport" content="width=device-width, initial-scale=1"> -->      
      <title><?= $title ?></title>
      <link href="../style.css" rel="stylesheet" /> 
      <link href="calendar.css" type="text/css" rel="stylesheet" />
      <link href="slideshow.css" type="text/css" rel="stylesheet" />  

      <!-- Polices -->
      <link href='https://fonts.googleapis.com/css?family=Brawler&subset=latin' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Calligraffitti&subset=latin' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Bentham&subset=latin' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Corben&subset=latin' rel='stylesheet' type='text/css'>  
      <link href='https://fonts.googleapis.com/css?family=Caudex&subset=latin' rel='stylesheet' type='text/css'>  
      <link href='https://fonts.googleapis.com/css?family=Cabin&subset=latin' rel='stylesheet' type='text/css'>     
      <link href='https://fonts.googleapis.com/css?family=Allan&subset=latin' rel='stylesheet' type='text/css'>      
      <link href='https://fonts.googleapis.com/css?family=Cherry+Cream+Soda&subset=latin' rel='stylesheet' type='text/css'>

      <!-- Bootstrap -->
       <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->      
   </head>

   <body class="d-flex flex-column min-vh-100">
      <?= $content ?>
      <script type="text/javascript" src="js/script.js" async></script>
   </body>
</html>