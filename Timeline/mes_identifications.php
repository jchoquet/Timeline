<?php

  session_start();

  include 'carousel_mes_identifications.php';

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
    <meta name="description" lang="fr" content="plateforme de timeline photo pour soirÃ©e et Ã©vÃ¨nement" />
    <meta name="keywords" lang="fr" content="photos, soirÃ©e, timeline, ENSIIE, iiens" />

     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="css/bootstrap.css">
      
     <!-- jquery -->
     <script src="js/jquery_library.js"></script>

     <!-- Latest compiled and minified JavaScript -->
     <script src="js/bootstrap.js"></script>

     <!-- fichier css perso -->
     <link rel="stylesheet" href="css/menu.css">
     <link rel="stylesheet" href="css/mes_idenifications.css">
     <link rel="stylesheet" href="css/buttonLink.css">

     <script>

        //Code nécessaire pour le carroussel 2
        jQuery(document).ready(function($) {
 
        $('#myCarousel').carousel({
                interval: 10000
        });
 
        $('#carousel-text').html($('#slide-content-0').html());
 
        //Handles the carousel thumbnails
       $('[id^=carousel-selector-]').click( function(){
            var id = this.id.substr(this.id.lastIndexOf("-") + 1);
            var id = parseInt(id);
            $('#myCarousel').carousel(id);
        });
 
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
         });
   </script>



   

  </head>

  <body>
  <?php include 'header.php'; ?>
  <?php include 'carousel.php'; ?>  

      <h3 class="page-header">Mes Identifications</h3>
      
        <?php
          if($tabPhotos) 
          {
            carousel_mes_identifications($tabPhotos);
          }
          else
          {
            echo "<div class='container-fluid'>";
            echo "<p class='nothing'>Tanche ! Tu n'es encore identifié nul part !<p>";
          }
        ?>


 <?php include 'footer.php'; ?>
