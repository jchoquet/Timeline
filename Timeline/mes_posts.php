<?php

  session_start();

?>

<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>TIMELINE</title>
    
    <!-- icone du titre de la page -->
    <link rel="shortcut icon" href="fonts/icone2.jpg">
 
    <!-- pour les moteurs de recherche -->
    <meta name="description" lang="fr" content="plateforme de timeline photo pour soirÃ©e et Ã©vÃ¨nement" />
    <meta name="keywords" lang="fr" content="photos, soirÃ©e, timeline, ENSIIE, iiens" />

     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="css/bootstrap.css">
      
     <!-- jquery -->
     <script src="js/jquery_library.js"></script>

     <!-- Latest compiled and minified JavaScript -->
     <script src="js/bootstrap.js"></script>
   

  </head>

  <body>
  <?php include 'header.php'; ?>
  <?php include 'carousel.php'; ?>  

      <h1 class="page-header">Mes Posts</h1>
      
      <div class="container-fluid">

            <?php carousel("pgsql:host=localhost;dbname=projet_web", "SELECT IdPhoto FROM Photo WHERE IdPosteur=$_SESSION['login']); ?>      /* a verifier les arguments!! */

      </div>
	

  </body>
</html>


