<?php
  session_start();

  /* On traite le cas où user lambda accède à la partie admin */

  $id=$_SESSION['login'];

  if($id != "administrat")
  {
  	header('location: connexion.php');
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
     
	 <!-- jquery -->
	 <script src="js/jquery_library.js"></script>

	 <!-- Latest compiled and minified JavaScript -->
	 <script src="js/bootstrap.js"></script>

	 <!-- JS validation formulaire -->
	 <script src="js/validate_add_concours.js"></script>

   	 <!-- Latest compiled and minified CSS -->
   	 <link rel="stylesheet" href="css/bootstrap.css">
	 <!-- fichier css menu -->
	 <link rel="stylesheet" href="css/menu.css">
	 <link rel="stylesheet" href="css/admin_add_soiree.css">

</head>

<html>
<body>

 <?php include 'header.php'; ?>

	 	<h3 class="page-header"> Gestion administrateur - Ajout d'un concours</h3>

	 	<div id="addSoiree" class="form-horizontal" >

			<div class="form-group">
		        <label class="control-label col-sm-3" for="nom" > nom : </label>
		            <div class="col-sm-5">
		   				<input class="form-control" id="nom" type="text" name="nom"  />
        			</div>
        			<div class="col-sm-4 errors" id="nomerror"></div> 
		   </div>


		   <div class="form-group">
		        <label class="control-label col-sm-3" for="description" > Description : </label>
		            <div class="col-sm-5">
		   				<textarea class="form-control" id="description" name="description"  ></textarea>
        			</div>
        			<div class="col-sm-4 errors" id="descrierror"></div> 
		   </div>

		   <div class="form-group">
		        <label class="control-label col-sm-3" for="mdp" > Mot de passe : </label>
		            <div class="col-sm-5">
		   				<input type="password" class="form-control" id="mdp" name="mdp" />
        			</div>
        			<div class="col-sm-4 errors" id="mdperror"></div> 
		   </div>
		   
		    <div class="form-group">
		      <div class="col-sm-offset-3 col-sm-5">          
		        <button class="btn btn-default btn-block" type="submit" id="submit" name="submit">Ajouter</button>
		        <span class="errors" id="formerror"></span>
        		<span class="correct" id="formcorrect"></span>
		      </div>
		    </div>

		</div>


   

 <?php include 'footer.php'; ?>