<?php

  session_start();

  include 'carousel.php';

  try{

      $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

      $tabPhotos = getPhotosMesIdentifications($DB);

      $DB = null;

    }

    catch(PDOException $e){
      echo "Database Error";
    }
?>

<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>TIMELINE</title>
    
    <!-- icone du titre de la page -->
    <link rel="shortcut icon" href="fonts/icone2.jpg">
 
    <!-- pour les moteurs de recherche -->
    <meta name="description" lang="fr" content="plateforme de timeline photo pour soirÃƒÂ©e et ÃƒÂ©vÃƒÂ¨nement" />
    <meta name="keywords" lang="fr" content="photos, soirÃƒÂ©e, timeline, ENSIIE, iiens" />

     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="css/bootstrap.css">
      
     <!-- jquery -->
     <script src="js/jquery_library.js"></script>

     <!-- Latest compiled and minified JavaScript -->
     <script src="js/bootstrap.js"></script>
     
     <!-- fichier js perso -->
     <script src="js/mes_identifications.js"></script>

     <!-- fichier css perso -->
     <link rel="stylesheet" href="css/menu.css">
     <link rel="stylesheet" href="css/mes_idenifications.css">
     <link rel="stylesheet" href="css/buttonLink.css">
 

  </head>

  <body>
  <?php include 'header.php'; ?>
  <?php include 'carousel.php'; ?>  

      <h3 class="page-header">Mes Identifications</h3>
      
        <?php
          if($tabPhotos) 
          {
            carousel2($tabPhotos);
        ?>
          }
          else
          {
            <div class='container-fluid'>
              <p class='nothing'>Tanche ! Tu n'es encore identifiÃ© nul part ! <p>
            </div>
          }


 <?php include 'footer.php'; ?>
