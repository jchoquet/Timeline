<?php

  session_start();

  include 'carousel.php';

  try{

      $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

      $tabPhotos = getPhotosMesPosts($DB);

      $DB = null;

    }

    catch(PDOException $e){
      echo "Database Error";
    }

?>

<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8"/>

    
    <link rel="shortcut icon" href="fonts/icone.ico">
    <title>TIMELINE</title>

    <!-- pour les moteurs de recherche -->
    <meta name="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <meta name="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />


   
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="css/bootstrap.css">


   <!-- jquery -->
   <script src="js/jquery_library.js"></script>

   <!-- Latest compiled and minified JavaScript -->
   <script src="js/bootstrap.js"></script>

   <!-- fichier css perso -->
   <link rel="stylesheet" href="css/menu.css">
   <link rel="stylesheet" href="css/mes_posts.css">

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

      <h3 class="page-header">Mes Posts</h3>
      
        <?php carousel2($tabPhotos); ?>


 <?php include 'footer.php'; ?>

