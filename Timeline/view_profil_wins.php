<?php

session_start();

include 'carousel.php';

$id = $_SESSION['login'];

function checkIdentifiantUser($db,$id){

  /* On prépare la requête pour éviter les injections SQL */
  
  $stmt = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE identifiant=:id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  return $stmt->fetchColumn();
}

function surnomUser($db, $idprofil) {

  $stmt = $db->prepare("SELECT surnom FROM utilisateur WHERE identifiant=:id");
  $stmt->bindParam(':id', $idprofil);
  $stmt->setFetchMode(PDO::FETCH_OBJ);
  $stmt->execute();
  $stmt = $stmt->fetch();
  return $stmt->surnom;

}

function getPhotosSesWins($db, $idprofil) {

      $stmt = $db->prepare("SELECT soiree.annee, soiree.name, photo.idphoto, photo.extension, photo.composteur, concours.nom, soiree.idsoiree, soiree.theme, compteur.nbre_votes FROM concours
         INNER JOIN soiree ON concours.idsoiree = soiree.idsoiree
         INNER JOIN photo ON photo.idphoto = concours.winner
         INNER JOIN compteur ON concours.idconcours = compteur.idconcours AND photo.idphoto = compteur.idphoto
         WHERE photo.idposteur=:id AND NOT encours");
      $stmt->bindParam(':id', $idprofil);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_NUM);
      $result = $stmt->fetchAll();
      return $result;
}

if(isset($_GET['identifiant']))
{
  /* On vérifie que l'identifiant existe avec une requete préparée sinon page d'acceuil logout */

  $idprofil = $_GET['identifiant'];

  try{

        $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
        
        if(checkIdentifiantUser($DB,$idprofil) == 1)
        {

          if($id == $idprofil)
          {

              header('location: mes_wins.php');
          }
          else
          {
              $tabPhotos = getPhotosSesWins($DB, $idprofil);
              $surUser = surnomUser($DB, $idprofil);
          }

        }
        $DB = null;

    }

      catch(PDOException $e){
        echo "Database Error";
      }

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


   <!-- fichier css perso -->
   <link rel="stylesheet" href="css/menu.css">
   <link rel="stylesheet" href="css/mes_posts.css">
   <link rel="stylesheet" type="text/css" href="css/modal.css">

  </head>

<body>

      <?php include 'header.php'; ?>

      <h3 class="page-header">Wins de <?php echo $surUser; ?></h3>
      
        <?php
          if($tabPhotos) 
          {
            carousel($tabPhotos,2);
          }
          else
          {
            echo "<div class='container-fluid'>";
            echo "<p class='nothing'>Cette tanche n'a encore rien gagné !<p>";
            echo '</div>';
          }
        ?>
   
 <?php include 'modal.php'; ?>

 <?php include 'footer.php'; ?>