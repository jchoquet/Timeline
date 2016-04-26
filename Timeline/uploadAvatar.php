<?php

session_start();



function validateUpload() {

  $msg="";
  $id=$_SESSION['login'];
  $extensions_valides=array('jpg','jpeg','gif','png');
  $tailleMax= 2097152;

  if ($_FILES['avatar']['error'] > 0){
    $msg="Erreur, retentez l'upload en cliquant sur Mon profil !";
  }
  else
  {

    if ($_FILES['avatar']['size'] > $tailleMax)
    {
      $msg="Fichier trop volumineux (taille maximale : 2MO), retentez l'upload en cliquant sur Mon profil !";
    }
    else
    {
      $extension_upload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
      if ( !in_array($extension_upload,$extensions_valides) ) 
      {
        $msg="Extension incorrecte (jpg, jpeg, gif, png), retentez l'upload en cliquant sur Mon profil !";
      }
      else
      {

        $chemin ="users/avatar/{$id}.{$extension_upload}";
        $resultat= move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
        if($resultat)
        {
          $msg="Votre avatar a bien été modifié !";
        }
        else
        {
          $msg="Erreur, retentez l'upload en cliquant sur Mon profil !";
        }
      }

    }
  } 

  return $msg;
}

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

</head>

<html>
<body>

 <?php include 'header.php'; ?>

    <h3 class="page-header">Mon profil</h3>

    <div class="container-fluid">
        <h2> <?php echo validateUpload(); ?> </h2>
    </div>   

 <?php include 'footer.php'; ?>






