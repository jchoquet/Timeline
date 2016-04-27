<?php

session_start();

$id=$_SESSION['login'];
$pwd=$_SESSION['pwd'];

function addSoireeDB($db,$annee,$theme,$description){

	$stmt = $db->prepare("INSERT INTO soiree(idsoiree, theme, annee, description) VALUES (:idsoiree, :theme, :annee, :description)");
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':mdp', $mdp);
	$stmt->bindParam(':nom', $nom);
	$stmt->bindParam(':prenom', $prenom);
	$stmt->bindParam(':promo', $promo);
	return $stmt->execute();
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

/*if(isset($_POST['mdp']) && isset($_POST['annee']) && isset($_POST['theme']) && isset($_POST['description']))
{
	try{

		/* Connexion à la base de données avec PDO 

		$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
		
		$annee=$_POST['annee'];
		$theme=$_POST['theme'];
		$description=$_POST['description'];

		$result=addSoiree($DB,$annee,$theme,$description);

		$DB = null;
	}
	catch(PDOException $e){
		echo "Database Error";
	}

}*/

?>