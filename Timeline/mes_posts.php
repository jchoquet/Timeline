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

   <!-- fichier css perso -->
   <link rel="stylesheet" href="css/menu.css">
   <link rel="stylesheet" href="css/mes_posts.css">
   <link rel="stylesheet" type="text/css" href="css/modal.css">

</head>

  <body>
  <?php include 'header.php'; ?>

      <h3 class="page-header">Mes Posts</h3>
      
        <?php
          if($tabPhotos) 
          {
            carousel2($tabPhotos);
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


        <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
           
                <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12" id="image-content">
                    <!-- Va contenir l'image -->
                </div>
                <div class="col-lg-12 col-sm-12 hidden-xs">
                <div>
                <div id="com-content" class="container-fluid">
                <div class="row">

                <div class="comment-tabs">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="active"><a href="#list-comment" role="tab" data-toggle="tab"><h4>Commentaires</h4></a></li>
                  <li><a href="#add-comment" role="tab" data-toggle="tab"><h4>Ajouter un commentaire</h4></a></li>
                </ul>            
                <div class="tab-content">
                  <div class="tab-pane active" id="list-comment">                
                      <ul class="media-list" style="overflow-y: scroll; max-height: 240px;">
                                 
                      </ul>
                  </div>      
                  <div class="tab-pane" id="add-comment">
                      <form action="#" method="post" class="form-horizontal" id="commentForm" role="form"> 
                          <div class="form-group">
                              <label for="email" class="col-sm-2 control-label">Commentaire</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" name="addComment" id="addComment" rows="5"></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">                    
                                  <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span>Envoyer</button>
                              </div>
                          </div>            
                      </form>
                  </div>
                 
                </div>
                </div>
                </div>
                </div>
                </div>

                </div>

                </div>    
                </div> <!-- close modal body -->

                <div class="modal-footer">
                    <button class='btn btn-primary vote' data-toggle='tooltip' title='Vote pour la photo la plus trash'>Trash<span class='badge'>15</span></button>
                    <button class='btn btn-primary vote' data-toggle='tooltip' title='Vote pour la photo où ça pécho sec'>Love<span class='badge'>15</span></button>
                    <button class='btn btn-primary vote' data-toggle='tooltip' title='Photo de toute beauté'>Like<span class='badge'>15</span></button>
                </div>
          
            </div>

        </div>
    </div>

 <?php include 'footer.php'; ?>

