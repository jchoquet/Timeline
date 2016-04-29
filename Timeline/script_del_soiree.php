<?php

session_start();

$id=$_SESSION['login'];
$pwd=$_SESSION['pwd'];

function delSoireeDB($db,$annee,$theme){

	$stmt = $db->prepare("DELETE FROM soiree WHERE annee=:annee AND theme=:theme");
	$stmt->bindParam(':theme', $theme);
	$stmt->bindParam(':annee', $annee);
	return $stmt->execute();
}



if(isset($_POST['mdp']) && !isset($_POST['theme']) )
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

		$result=delSoireeDB($DB,$annee,$theme);

		if($result){

			/* TODO quand la page ajout est faite : supprimer les photos du dossier (on recup l'id on va dans table photos) dans la BD + supprimer les photos manuellement + puis supprimer le dossier manuellement */
			
			/*$nameDir = "photos/".$annee."/".$theme;

			if(!is_dir($nameDir))
			{
				mkdir($nameDir, 0777, true);
			}*/
			echo "OK";
		}
		else{
			echo "Problème suppression de la base de données";
		}

		$DB = null;
	}
	catch(PDOException $e){
		echo "Database Error";
	}

}

?>