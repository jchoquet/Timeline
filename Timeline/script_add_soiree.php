<?php

session_start();

$id=$_SESSION['login'];
$pwd=$_SESSION['pwd'];

function addSoireeDB($db,$annee,$theme,$description,$date,$name){

	$stmt = $db->prepare("INSERT INTO soiree(theme, annee, description, d, name) VALUES (:theme, :annee, :description, :d, :name)");
	$stmt->bindParam(':theme', $theme);
	$stmt->bindParam(':annee', $annee);
	$stmt->bindParam(':description', $description);
	$stmt->bindParam(':d', $date);
	$stmt->bindParam(':name', $name);
	return $stmt->execute();
}

function checkSoireeDB($db,$annee,$theme){
	
	$stmt = $db->prepare("SELECT COUNT(*) FROM soiree WHERE annee=:annee AND theme=:theme");
	$stmt->bindParam(':annee', $annee);
	$stmt->bindParam(':theme', $theme);
	$stmt->execute();
	return $stmt->fetchColumn();
}


if(isset($_POST['mdp']) && isset($_POST['annee']) && isset($_POST['theme']) && isset($_POST['description']) && isset($_POST['d']) && isset($_POST['name']))
{

	if($_POST['mdp'] != $pwd)
	{
		echo "Mot de passe incorrect";
	}
	else{
		try{

			/* Connexion à la base de données avec PDO */

			$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
			
			$annee=$_POST['annee'];
			$theme=strtolower($_POST['theme']);
			$description=$_POST['description'];
			$date=$_POST['d'];
			$name=strtolower($_POST['name']); 

			$existe=checkSoireeDB($DB,$annee,$theme);

			if($existe ==1)
			{
				echo "La soirée existe déjà !";
			}
			else
			{
				$result=addSoireeDB($DB,$annee,$theme,$description,$date,$name);

				if($result){

					/* On a réussi à inserer la soirée dans la base de données, on crée maintenant le sous-dossier */

					$nameDir = "photos/".$annee."/".$name;

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
}

?>