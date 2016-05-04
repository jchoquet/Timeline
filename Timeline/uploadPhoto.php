<?php

session_start();


/* Fonction qui va déterminer si la photo est au bon format retourne un array(message d'erreur ou OK, extension de la photo)
*/


function validatePhoto() {

  $msg="";
  $id=$_SESSION['login'];
  $extensions_valides=array('jpg','jpeg','gif','png');
  /* Taille max 12 MO */
  $tailleMax=  12582912;

  if ($_FILES['photo']['error'] > 0){
    $msg="Erreur, retentez l'upload en cliquant sur Ajout !";
  }
  else
  {

    if ($_FILES['photo']['size'] > $tailleMax)
    {
      $msg="Fichier trop volumineux (taille maximale : 12MO), retentez l'upload en cliquant sur Ajout !";
    }
    else
    {
      $extension_upload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
      if ( !in_array($extension_upload,$extensions_valides) ) 
      {
        $msg="Extension incorrecte (jpg, jpeg, gif, png), retentez l'upload en cliquant sur Ajout !";
      }
      else
      {

        $msg="OK";
      }

    }
  } 

  $reponse=array($msg, $extension_upload);
  return $reponse;
}

function getIdSoiree($db,$annee,$name){
  $stmt = $db->query("SELECT idsoiree FROM soiree WHERE annee='$annee' AND name='$name'");
  $stmt->setFetchMode(PDO::FETCH_OBJ);
  $stmt = $stmt->fetch();
  return $stmt->idsoiree;
}

function uploadPhotoDB($db,$idPosteur,$idSoiree,$heure,$commentaire,$extension){

	$nbLike=0;

	$stmt = $db->prepare("INSERT INTO photo(idsoiree, date_mel, heure, composteur, nblike, idposteur, extension, heure_mel) VALUES ('$idSoiree', NOW(), :heure, :commentaire, '$nbLike', :idposteur, '$extension', NOW())");
	$stmt->bindParam(':heure', $heure);
	$stmt->bindParam(':commentaire', $commentaire);
	$stmt->bindParam(':idposteur', $idPosteur);
	$stmt->execute();
  return $db->lastInsertId('photo_idphoto_seq');
}

/* Corps du fichier */

  $idPosteur=$_SESSION['login'];

  $heure=$_POST['heure'];
  $commentaire=$_POST['commentaire'];
  $annee=$_POST['annee'];
  $name=$_POST['theme'];


/* On récupère le résultat de validateUpload() */

  $reponse=validatePhoto();

  $msg=$reponse[0];
  $extension=$reponse[1];

  $affichage="";
  


  if($msg != "OK") 
  {
    
    /* Cas où le format n'était pas correct, affichage du message d'erreur */

    $affichage=$msg;
  }
  else 
  {

    try{

    	
        /* Connexion */

        $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
        
        /* On récupère l'id de la soirée et l'id de la photo ajoutée*/

        $idSoiree=getIdSoiree($DB,$annee,$name);

        $idPhoto=uploadPhotoDB($DB,$idPosteur,$idSoiree,$heure,$commentaire,$extension);


        if($idPhoto != 0)
        {
          
          $chemin ="photos/{$annee}/{$name}/{$idPhoto}.{$extension}";
          $resultat= move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
            if($resultat)
            {
              $affichage="Votre photo a bien été ajoutée !";
              $button="Ajouter une autre photo";
            }
            else
            {
              $affichage="Erreur, retentez l'upload !";
              $button="Try again !";
            }


          
        }
        else
        {
          $affichage="Erreur, retentez l'upload !";
          $button="Try again !";
        }
        
        /* On ferme la connexion */

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

   <link rel="stylesheet" href="css/buttonLink.css">

</head>

<html>
<body>

 <?php include 'header.php'; ?>

    <h3 class="page-header">Participe aux timelines !</h3>

    <div class="container-fluid">
        <h2> <?php echo $affichage; ?> </h2>
        <div class="col-sm-3">          
        <button class="btn btn-default btn-block" id="button"><a href="ajout.php"><?php echo $button; ?></a></button>
        </div>
    </div>   

 <?php include 'footer.php'; ?>