<?php

session_start();

/* Récupération du vrai mdp pour vérifier */

$pwd=$_SESSION['pwd'];
$id=$_SESSION['login'];

function modifProfilUser($db,$id,$mdp,$quote,$surnom){

  $stmt = $db->prepare("UPDATE utilisateur SET mdp=:mdp, quote=:quote, surnom=:surnom WHERE identifiant=:id");
  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':mdp', $mdp);
  $stmt->bindParam(':quote', $quote);
  $stmt->bindParam(':surnom', $surnom);
  return $stmt->execute();
}


if(isset($_POST['oldmdp']) && !isset($_POST['nmdp']))
{

	if($_POST['oldmdp'] == $pwd) {

		echo "OK";
	}
	else{

		echo "Mot de passe incorrect";
	}


}

if(isset($_POST['oldmdp']) && isset($_POST['nmdp']) && isset($_POST['surnom']) && isset($_POST['quote']) )
{

	try
	{

		/* Connexion à la base de données avec PDO */

		$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

		$mdp=$_POST['nmdp'];
		$surnom=$_POST['surnom'];
		$quote=$_POST['quote'];

		$result=modifProfilUser($DB,$id,$mdp,$quote,$surnom);

		if($result)
		{
			echo "OK";
		}
		else
		{
			echo "Erreur lors de la modification";
		}

		$DB = null;

	}
	catch(PDOException $e){
		echo "Database Error";
	}

}


?>
