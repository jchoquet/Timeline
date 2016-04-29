<?php

session_start();

$id=$_SESSION['login'];
$pwd=$_SESSION['pwd'];

function addSoireeDB($db,$annee,$theme,$description,$date){

	$stmt = $db->prepare("INSERT INTO soiree(theme, annee, description, d) VALUES (:theme, :annee, :description, :d)");
	$stmt->bindParam(':theme', $theme);
	$stmt->bindParam(':annee', $annee);
	$stmt->bindParam(':description', $description);
	$stmt->bindParam(':d', $date);
	return $stmt->execute();
}

function checkSoireeDB($db,$annee,$theme){
	
	$stmt = $db->prepare("SELECT COUNT(*) FROM soiree WHERE annee=:annee AND theme=:theme");
	$stmt->bindParam(':annee', $annee);
	$stmt->bindParam(':theme', $theme);
	$stmt->execute();
	return $stmt->fetchColumn();
}

if(isset($_POST['mdp']) && !isset($_POST['description']) )
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

if(isset($_POST['mdp']) && isset($_POST['annee']) && isset($_POST['theme']) && isset($_POST['description']) && isset($_POST['d']))
{
	try{

		/* Connexion à la base de données avec PDO */

		$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
		
		$annee=$_POST['annee'];
		$theme=strtolower($_POST['theme']);
		$description=$_POST['description'];
		$date=$_POST['d'];

		/* WARNING : check avant si la soirée n'existe pas !!! */

		$existe=checkSoireeDB($DB,$annee,$theme);

		if($existe ==1)
		{
			echo "La soirée existe déjà !";
		}
		else
		{
			$result=addSoireeDB($DB,$annee,$theme,$description,$date);

			if($result){

				/* On a réussi à inserer la soirée dans la base de données, on crée maintenant le sous-dossier */

				$nameDir = "photos/".$annee."/".$theme;

				if(!is_dir($nameDir))
				{
					mkdir($nameDir, 0777, true);
				}
				echo "OK";
			}
			else{
				echo "Problème d'insertion dans la base de données";
			}
		}
		
		$DB = null;
	}
	catch(PDOException $e){
		echo "Database Error";
	}

}

?>