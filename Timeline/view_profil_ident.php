<?php

session_start();
$id = $_SESSION['login'];


function checkIdentifiantUser($db,$id){

  /* On prépare la requête pour éviter les injections SQL */
  
  $stmt = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE identifiant=:id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  return $stmt->fetchColumn();
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
   

   <!-- fichier css perso -->
   <link rel="stylesheet" href="css/menu.css">
   <link rel="stylesheet" href="css/view_profil_ident.css">  
  </head>

<body>

  		<?php include 'header.php'; ?>