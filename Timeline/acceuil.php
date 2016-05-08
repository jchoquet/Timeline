<?php
  session_start();
  
  include 'carousel.php';
  
  
  function getLastPhotos($db) {

        $stmt = $db->query("SELECT soiree.annee, soiree.name, photo.idphoto, photo.extension, photo.composteur, soiree.theme, photo.date_mel, photo.heure_mel FROM photo INNER JOIN soiree ON photo.idsoiree=soiree.idsoiree ORDER BY photo.idphoto DESC LIMIT 10 ");
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $result = $stmt->fetchAll();
        return $result;
    }

  
   
   try{

      $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

      $tabPhotosAcceuil = getLastPhotos($DB);

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
    <metaname="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <metaname="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />
     
	 <!-- jquery -->
	 <script src="js/jquery_library.js"></script>

	 <!-- Latest compiled and minified JavaScript -->
	 <script src="js/bootstrap.js"></script>

   <!-- Js carousel -->
   <script src="js/carousel.js"></script>
   <script type="text/javascript" src="js/modal.js"></script> 

   <!-- Latest compiled and minified CSS -->
   	<link rel="stylesheet" href="css/bootstrap.css">

	 <!-- fichier css perso -->
	 <link rel="stylesheet" href="css/menu.css">
   <link rel="stylesheet" href="css/mes_posts.css">
   <link rel="stylesheet" href="css/modal.css">
   <link rel="stylesheet" href="css/buttonLink.css">
   
   
</head>

<html>
<body>

 <?php include 'header.php'; ?>

	 	<h3 class="page-header"> Les 10 dernières glorieuses contributions </h3>

        <?php
          if($tabPhotosAcceuil) 
          {
            carousel($tabPhotosAcceuil,3);
          }
          else
          {
            echo "<div class='container-fluid'>";
            echo "<p class='nothing'>Tanche! Soit le premier à poster!<p>";
            echo '<div class="col-sm-3">';          
            echo '<button class="btn btn-default btn-block" id="button"><a href="ajout.php">Poster une photo</a></button>';
            echo '</div>';
            echo '</div>';
          }
        ?>

 <?php include 'footer.php'; ?>

