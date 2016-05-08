<?php

  session_start();

  include 'carousel.php';


   function getPhotosMesPosts($db) {

      $id=$_SESSION['login'];
      $stmt = $db->query("SELECT soiree.annee, soiree.name, photo.idphoto, photo.extension, photo.composteur, soiree.theme, soiree.idsoiree FROM photo INNER JOIN soiree ON photo.idsoiree=soiree.idsoiree WHERE photo.idposteur='$id'");
      $stmt->setFetchMode(PDO::FETCH_NUM);
      $result = $stmt->fetchAll();
      return $result;
  }


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

   <!-- Js carousel -->
   <script src="js/carousel.js"></script>
   <script type="text/javascript" src="js/modal.js"></script> 
   <scrip type="text/javascript" src="js/validate_add_comment.js"></script>

   <!-- fichier css perso -->
   <link rel="stylesheet" href="css/menu.css">
   <link rel="stylesheet" href="css/mes_posts.css">
   <link rel="stylesheet" type="text/css" href="css/modal.css">
  <link rel="stylesheet" type="text/css" href="css/buttonLink.css">

</head>

  <body>
  <?php include 'header.php'; ?>

      <h3 class="page-header">Mes Posts</h3>
      
        <?php
          if($tabPhotos) 
          {
            carousel($tabPhotos,1);
          }
          else
          {
            echo "<div class='container-fluid'>";
            echo "<p class='nothing'>Tanche ! Tu n'as encore rien posté !<p>";
            echo '<div class="col-sm-3">';          
            echo '<button class="btn btn-default btn-block" id="button"><a href="ajout.php">Poster une photo</a></button>';
            echo '</div>';
            echo '</div>';
          }
        ?>


   
 <?php include 'modal.php'; ?>

 <?php include 'footer.php'; ?>

