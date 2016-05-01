<?php

session_start();

$id=$_SESSION['login'];
$pwd=$_SESSION['pwd'];

function delSoireeDB($db,$idSoiree){

	$stmt = $db->prepare("DELETE FROM soiree WHERE idsoiree=:id");
	$stmt->bindParam(':id', $idSoiree);
	return $stmt->execute();
}


function getIdSoiree($db,$annee,$name){
	$stmt = $db->query("SELECT idsoiree FROM soiree WHERE annee='$annee' AND name='$name'");
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$stmt = $stmt->fetch();
	return $stmt->idsoiree;
}


function delPhotosDB($db, $idSoiree){
	$stmt = $db->prepare("DELETE FROM photo WHERE idsoiree=:id");
	$stmt->bindParam(':id', $idSoiree);
	return $stmt->execute();
}

function delDir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir") delDir($dir."/".$object); else unlink($dir."/".$object); 
       } 
     } 
     reset($objects); 
     rmdir($dir); 

     return true;
   } 
   else{
   	return false;
   }
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


if(isset($_POST['mdp']) && isset($_POST['annee']) && isset($_POST['name']) )
{
	try{

		
		/* Connexion à la base de données avec PDO */

		$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
		
		$annee=$_POST['annee'];
		$name=$_POST['name'];
		$mdp=$_POST['mdp'];

		/* On récupère l'id de la soiree */
		
		$idSoiree=getIdSoiree($DB,$annee,$name);

		
		$nameDir = "photos/".$annee."/".$name;


		/* On supprime tout ce que contient le dossier */

		if(delDir($nameDir))
		{

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
			echo "Problème suppression du dossier soirée";;
		}


		$DB = null;
	}
	catch(PDOException $e){
		echo "Database Error";
	}

}

	
?>