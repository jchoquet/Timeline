<?php

  session_start();

?>

<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8"/>
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
   <link rel="stylesheet" href="css/monprofil.css">

   <!-- fichier JS validation formulaire -->
   <script src="js/validate_modif.js"></script>

</head>

<body>


 <?php include 'header.php'; ?>

    <h1 class="page-header">Mon Profil</h1>

     <div class="container-fluid">

     <!-- formulaire de modification -->
      <form id="modif" class="form-horizontal" role="form">
      
 
        <div class="form-group">
          <label class="control-label col-sm-3" for="surnom" > Modifier mon surnom : </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="surnom" />
              </div>
              <div class="col-sm-4 errors" id="surerror"></div>
          </div>

        <div class="form-group">
        <label class="control-label col-sm-3" for="avatar" > Modifier ma photo : </label>
            <div class="col-sm-5">
            <span class="btn btn-default btn-file"> Parcourir <input type="file" id="avatar" />
             </span>
            </div>
            <div class="col-sm-4 errors" id="avatarerror"></div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-3" for="quote" class >Modifier ma quote : </label>
        <div class="col-sm-5">
          <textarea class="form-control" id="quote"></textarea>
        </div>
        <div class="col-sm-4 errors" id="quoteerror"></div> 
        </div>
        
        
        <div class="form-group">
        <label class="control-label col-sm-3" for="mdp" >Ancien mot de passe : </label>
        <div class="col-sm-5">
          <input class="form-control" type="password" name="Mot de passe" value="" />
        </div>
        <div class="col-sm-4 errors" id="oldMdperror"></div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-3" for="Nmdp" >Nouveau mot de passe : </label>
        <div class="col-sm-5">
          <input class="form-control" id="mdpc" type="password" name="New mot de passe" value="" />
        </div>
        <div class="col-sm-4 errors" id="newMdperror"></div>
        </div>
        

        <div class="form-group">
        <label class="control-label col-sm-3" for="mdpc" >Confirmez nouveau mot de passe : </label>
        <div class="col-sm-5">
          <input class="form-control" id="mdpc" type="password" name="Conf new mot de passe" value=""  />
        </div>
         <div class="col-sm-4 errors" id="cnewMdperror"></div>
        </div>

      <div class="form-group">
      <div class="col-sm-offset-3 col-sm-5">          
        <button class="btn btn-default btn-block" type="submit" id="modifB" name="modifB">Changer !</button>
        <span class="errors" id="formerror"></span>
      </div>
      </div>


  </form>

	</div>


 <?php include 'footer.php'; ?>