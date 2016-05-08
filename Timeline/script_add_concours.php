<?php

session_start();

$id=$_SESSION['login'];
$pwd=$_SESSION['pwd'];

function addConcoursDB($db,$nom,$description,$encours){

	$stmt = $db->prepare("INSERT INTO concours(nom,description,encours) VALUES (:nom, :description, :encours)");
	$stmt->bindParam(':nom', $nom);
	$stmt->bindParam(':description', $description);
	$stmt->bindParam(':encours', $encours);
	return $stmt->execute();
}

function checkConcoursDB($db,$nom,$encours){
	
	$stmt = $db->prepare("SELECT COUNT(*) FROM concours WHERE nom=:nom AND encours=:true");
	$stmt->bindParam(':nom', $nom);
	$stmt->bindParam(':encours', $encours);
	$stmt->execute();
	return $stmt->fetchColumn();
}


if(isset($_POST['mdp']) && isset($_POST['description']) &&isset($_POST['nom']))
{
	if (!password_verify($_POST['mdp'], $pwd)) 
	{
		echo "Mot de passe incorrect";
	}
	else{
		try{

			/* Connexion à la base de données avec PDO */

			$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
			
			$description=$_POST['description'];
			$nom=strtolower($_POST['nom']); 
      $encours="true";

			$existe=checkConcoursDB($db,$nom,$encours);

			if($existe ==1)
			{
				echo "Le concours est d�ja en cours� !";
			}
			else
			{
				$result=addConcoursDB($db,$nom,$description,$encours);

				if($result){

					/* On a réussi à inserer le concours dans la base de données, on crée maintenant le sous-dossier */

					$nameDir = "photos/".$name;

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