<?php

session_start();


/* Fonction qui va déterminer si la photo est au bon format retourne un array(message d'erreur ou OK, extension de la photo)
*/


function validatePhoto() {

  $msg="";
  $id=$_SESSION['login'];
  $extensions_valides=array('jpg','jpeg','gif','png');
  $tailleMax= 4194304;

  if ($_FILES['photo']['error'] > 0){
    $msg="Erreur, retentez l'upload en cliquant sur Ajout !";
  }
  else
  {

    if ($_FILES['photo']['size'] > $tailleMax)
    {
      $msg="Fichier trop volumineux (taille maximale : 4MO), retentez l'upload en cliquant sur Ajout !";
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

function getIdSoiree($db,$annee,$theme)
{
	$stmt = $db->query("SELECT idsoiree FROM soiree WHERE annee='$annee' AND theme='$theme'");
	$stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt = $stmt->fetch();
    return $stmt->idsoiree;
}

function uploadPhotoDB($db,$idPosteur,$idSoiree,$heure,$commentaire,$extension){

	$dateMEL=date("Y-m-d");
	$heureMEL=date("H:i");
	$nbLike=0;

	$stmt = $db->prepare("INSERT INTO photo(idsoiree, date_mel, heure, composteur, nblike, idposteur, extension, heure_mel) VALUES ('$idSoiree', '$dateMEL', :heure, :commentaire, '$nbLike', :idposteur, '$extension', '$heureMEL')");
	$stmt->bindParam(':heure', $heure);
	$stmt->bindParam(':commentaire', $commentaire);
	$stmt->bindParam(':idposteur', $idPosteur);
	return $stmt->execute();
}


/* Corps du fichier */

  $idPosteur=$_SESSION['login'];

  $heure=$_POST['heure'];
  $commentaire=$_POST['commentaire'];
  $annee=$_POST['annee'];
  $theme=$_POST['theme'];


/* On récupère le résultat de validateUpload() */

  $reponse=validatePhoto();

  $msg=$reponse[0];
  $extension=$reponse[1];

  $affichage="";
  $idSoiree="";


  if($msg != "OK") 
  {
    
    /* Cas où le format n'était pas correct, affichage du message d'erreur */

    $affichage=$msg;
  }
  else 
  {

    try{

    	/* Si le format est correct : on ajoute la photo dans la bd, ca marche on recupere l'identifiant et on dwl la photo */
        /* Connexion */

        $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
        
        /* On récupère l'id de la soirée */

        $idSoiree=getIdSoiree($DB,$annee,$theme);

        $result=uploadPhotoDB($DB,$idPosteur,$idSoiree,$heure,$commentaire,$extension);

        if($result)
        {
          $affichage="Votre photo a été ajoutée avec succès !";

          	/* TODO : ajout dans les fichiers */
        }
        else
        {
          $affichage="Erreur, retentez l'upload en cliquant sur Ajout !";
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

</head>

<html>
<body>

 <?php include 'header.php'; ?>

    <h3 class="page-header">Mon profil</h3>

    <div class="container-fluid">
        <h2> <?php echo $affichage; ?> </h2>
    </div>   

 <?php include 'footer.php'; ?>