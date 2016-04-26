<?php
  session_start();
?>

<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8"/>
    <title>TIMELINE</title>

    <!-- pour les moteurs de recherche -->
    <metaname="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <metaname="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />

     <!-- icone du titre de la page -->
   	 <link rel="shortcut icon" href="fonts/icone2.jpg">
     
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
	 		<ul>
	 			<li><a href="admin_add_soiree.php">Ajout d'une soirée</a></li>
	 			<li><a href="admin_del_soiree.php">Suppression d'une soirée</a></li>
	 			<li><a href="admin_del_photo.php">Suppression d'une photo</a></li>
	 		</ul>
	 	</div>
   

 <?php include 'footer.php'; ?>