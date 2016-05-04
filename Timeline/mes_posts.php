<?php

  session_start();

  include 'carousel.php';

  try{

      $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

      $tabPhotos = getPhotosMesPosts($DB);
      $pathPhotos = getPathMesPosts($tab);
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

</head>

  <body>
  <?php include 'header.php'; ?>

      <h3 class="page-header">Mes Posts</h3>
      
      <div class="container-fluid">

      <?php carousel($pathPhotos); ?>

      </div>

 <?php include 'footer.php'; ?>

