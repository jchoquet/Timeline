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

function surnomUser($db, $id) {

  $stmt = $db->prepare("SELECT surnom FROM utilisateur WHERE identifiant=:id");
  $stmt->bindParam(':id', $id);
  $stmt->setFetchMode(PDO::FETCH_OBJ);
  $stmt->execute();
  $stmt = $stmt->fetch();
  return $stmt->surnom;

}

 function getPhotosSesPosts($db, $idprofil) {

      $stmt = $db->prepare("SELECT soiree.annee, soiree.name, photo.idphoto, photo.extension, photo.composteur, soiree.theme, soiree.idsoiree FROM photo INNER JOIN soiree ON photo.idsoiree=soiree.idsoiree WHERE photo.idposteur=:id");
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

              header('location: mes_posts.php');
          }
          else
          {
              $tabPhotos = getPhotosSesPosts($DB, $idprofil);
              $surnom = surnomUser($DB, $idprofil);
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

      <h3 class="page-header">Posts de <?php echo $surnom; ?></h3>
      
        <?php
          if($tabPhotos) 
          {
            carousel($tabPhotos,1);
          }
          else
          {
            echo "<div class='container-fluid'>";
            echo "<p class='nothing'>Cette tanche n'a encore rien posté !<p>";
            echo '</div>';
          }
        ?>
   
 <?php include 'modal.php'; ?>

 <?php include 'footer.php'; ?>