<?php
  session_start();

  /* Fonction qui renvoie un tableau contenant les années présentes dans soiree */

  function getAnnee($db){

      $stmt = $db->prepare("SELECT DISTINCT annee FROM soiree ORDER BY annee DESC");
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_NUM);
      $result = $stmt->fetchAll();
      return $result;
  }

  
  /* Fonction qui crée un bouton select à partir d'un tableau */

  function printSelect($tab){

    foreach($tab as $a)
    {
      foreach ($a as $b) 
      {
        echo "<option value='$b'>$b</option>" . PHP_EOL;
      }
    }
  }


  try{


    $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

    $tab=getAnnee($DB);

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

   <!-- JS bouton select -->
   <script src="js/fetch_select.js"></script>

     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="css/bootstrap.css">

   <!-- fichier css menu -->
   <link rel="stylesheet" href="css/menu.css">
   <link rel="stylesheet" href="css/ajout.css">

</head>

<html>
<body>

 <?php include 'header.php'; ?>

  <h1 class="page-header">Participe aux timelines !</h1>

  <div class="container-fluid">

    <form method="post" action="uploadPhoto.php" enctype="multipart/form-data" id="uploadPhoto" class="form-horizontal" >  

      <fieldset class="field-border">
        <legend class="field-border">Choisis une soirée</legend>
          <div class="form-group">
              <label class="control-label col-sm-3" for="annee" > Année : </label>
                  <div class="col-sm-5">
                <select name="annee" id="annee" onchange="fetch_select_theme(this.value);">
                <option>Sélectionne une année</option>
                  <?php printSelect($tab); ?>
                </select>
                </div>
         </div>

        <div class="form-group">
              <label class="control-label col-sm-3" for="theme" > Thème : </label>
                  <div class="col-sm-5">
                <select name="theme" id="theme">
                </select>
                </div>
         </div>
      </fieldset>

      <fieldset class="field-border">
        <legend class="field-border">Remplis les infos</legend>

        <div class="form-group">
        <label class="control-label col-sm-3" for="heure">Heure : </label>
        <div class="col-sm-5 controls bootstrap-timepicker">
            <input type="time" id="heure" name="heure"/>
            <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
        </div>
        </div>

         <div class="form-group">
            <label class="control-label col-sm-3" for="commentaire" > Commentaire : </label>
                <div class="col-sm-5">
              <textarea class="form-control" id="commentaire" name="commentaire" ></textarea>
              </div>
              <div class="col-sm-4 errors" id="comerror"></div> 
       </div>

      </fieldset>

      <fieldset class="field-border">
        <legend class="field-border">Ajoute ta photo !</legend>

           <div class="form-group">
            <label class="control-label col-sm-3" for="avatar" > Photo : </label>
            <div class="col-sm-5">
            <span class="btn btn-default btn-file"> Parcourir <input type="file" id="photo" name="photo" />
             </span>
            </div>
            <div class="col-sm-4 errors" id="photorerror">
            </div>
           </div>

      </fieldset>

      <div class="form-group">
      <div class="col-sm-offset-3 col-sm-6">          
        <button class="btn btn-default btn-block" type="submit" id="submit" name="submit">Ajouter !</button>
      </div>
      </div>

    </form>
  

  </div>


 <?php include 'footer.php'; ?>  