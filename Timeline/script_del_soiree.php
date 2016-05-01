<?php

session_start();

$id=$_SESSION['login'];
$pwd=$_SESSION['pwd'];

function delSoireeDB($db,$idSoiree){

	$stmt = $db->prepare("DELETE FROM soiree WHERE idsoiree=:id");
	$stmt->bindParam(':id', $idSoiree);
	return $stmt->execute();
}

function getNameSoiree($db,$annee,$theme){
	$stmt = $db->query("SELECT name FROM soiree WHERE annee='$annee' AND theme='$theme'");
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$stmt = $stmt->fetch();
	return $stmt->name;
}

function getIdSoiree($db,$annee,$theme){
	$stmt = $db->query("SELECT idsoiree FROM soiree WHERE annee='$annee' AND theme='$theme'");
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$stmt = $stmt->fetch();
	return $stmt->idsoiree;
}

function getPhotos($db,$idSoiree){
	$stmt = $db->prepare("SELECT idphoto, extension FROM photo WHERE idsoiree=:id");
	$stmt->bindParam(':id', $idSoiree);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $result = $stmt->fetchAll();
    return $result;
}

function rmPhotosFiles($tabPhotos,$nameDir){
  	foreach($tabPhotos as $row)
  	{
  		$imageName=$row[0];
  		$imageExt=$row[1];

  		if(!unlink("{$nameDir}/{$imageName}.{$imageExt}"))
  		{
  			return false;
  		}
  	}

  	return true;
}

function delPhotosDB($db, $idSoiree){
	$stmt = $db->prepare("DELETE FROM photo WHERE idsoiree=:id");
	$stmt->bindParam(':id', $idSoiree);
	return $stmt->execute();
}

if(isset($_POST['mdp']) && !isset($_POST['annee']) )
{

	if($_POST['mdp'] == $pwd)
	{
		echo "OK";
	}
	else
	{
		echo "Mot de passe incorrect";
	}
}


if(isset($_POST['mdp']) && isset($_POST['annee']) && isset($_POST['theme']) )
{
	try{

		
		/* Connexion à la base de données avec PDO */

		$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
		
		$annee=$_POST['annee'];
		$theme=$_POST['theme'];
		$mdp=$_POST['mdp'];

		/* On récupère le nom du dossier dans la base de données et l'id de la soiree */

		$name=getNameSoiree($DB,$annee,$theme);
		$idSoiree=getIdSoiree($DB,$annee,$theme);

		
		$nameDir = "photos/".$annee."/".$name;
		$tabPhotos=getPhotos($DB,$idSoiree);


		/* On supprime les photos de la soirée des fichiers */

		if(rmPhotosFiles($tabPhotos,$nameDir))
		{


			/* On supprime le dossier soirée des fichiers */

			if (!rmdir($nameDir))
			{	
			  echo "Problème suppression du dossier soirée";
			}

			/*marche jusque là */

			/* On supprime les photos de la DB */

			if(delPhotosDB($DB,$idSoiree))
			{
				 /*On supprime la soirée de la DB */

				if(delSoireeDB($DB,$idSoiree))
				{
					echo "OK";
				}
				else
				{
					echo "Problème suppresion soirée de la DB";
				}

			}
			else
			{
				echo "Problème suppression des photos de la DB";
			}

		}		
		else
		{
			echo "Problème suppression des photos des fichiers";
		}


		$DB = null;
	}
	catch(PDOException $e){
		echo "Database Error";
	}

}

	
?>