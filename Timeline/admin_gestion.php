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
    <metaname="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <metaname="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />
     
	 <!-- jquery -->
	 <script src="js/jquery_library.js"></script>

	 <!-- Latest compiled and minified JavaScript -->
	 <script src="js/bootstrap.js"></script>

   <!-- Latest compiled and minified CSS -->
   	<link rel="stylesheet" href="css/bootstrap.css">
	 <!-- fichier css menu -->
	 <link rel="stylesheet" href="css/menu.css">
	 <link rel="stylesheet" href="css/admin_gestion.css">

</head>

<html>
<body>

 <?php include 'header.php'; ?>

	 	<h3 class="page-header"> Gestion administrateur </h3>

	 	<div class="container-fluid">
    <div class="row">
          <div class="col-xs-12" id="nav">
    	 		<ul>
    	 			<li><span class="glyphicon glyphicon-plus-sign"></span><a href="admin_add_soiree.php">Ajout d'une soirée</a></li>
    	 			<li><span class="glyphicon glyphicon-minus-sign"></span><a href="admin_del_soiree.php">Suppression d'une soirée</a></li>
    	 		</ul>
          <ul>
            <li><span class="glyphicon glyphicon-play"></span><a href="admin_add_concours.php">Lancer un concours</a></li>
            <li><span class="glyphicon glyphicon-stop"></span><a href="admin_stop_concours.php">Stopper un concours</a></li>
          </ul>
          </div>
    </div>
	 	</div>
  

 <?php include 'footer.php'; ?>