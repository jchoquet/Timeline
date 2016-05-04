<?php


/* Fonction qui vérifie si l'identifiant n'est pas déjà pris (renvoie 1) sinon 0 */

function checkIdentifiantUser($db,$id){

	/* On prépare la requête pour éviter les injections SQL */
	
	$stmt = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE identifiant=:id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	return $stmt->fetchColumn();
}

/* Fonction qui se charge de l'inscription */

function inscriptionUser($db,$id,$nom,$promo,$mdp,$prenom){

	$stmt = $db->prepare("INSERT INTO utilisateur(identifiant, mdp, nom, prenom, promo, surnom, quote, avatar) VALUES (:id, :mdp, :nom, :prenom, :promo, '', '', '')");
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':mdp', $mdp);
	$stmt->bindParam(':nom', $nom);
	$stmt->bindParam(':prenom', $prenom);
	$stmt->bindParam(':promo', $promo);
	return $stmt->execute();
}

try{

	/* Connexion à la base de données avec PDO */

	$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
	
	/* Si identifiant renseigné, on verifie s'il n'est pas déjà pris */

	if(isset($_POST['identifiant']) && !(isset($_POST['mdp'])))
	{

		$id=$_POST['identifiant'];

		$result=checkIdentifiantUser($DB, $id);

		if($result == 1)
		{
			echo "Identifiant déjà pris";
		}
        else{
            echo "OK";
        }
	}

	/* Si tous les champs sont renseignés, on fait l'inscription */

	if(isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['promo']) && isset($_POST['mdp']) && isset($_POST['prenom']))
	{
		
		$id=$_POST['id'];
		$nom=$_POST['nom'];
		$promo=$_POST['promo'];
		$mdp=$_POST['mdp'];
		$prenom=$_POST['prenom'];

		$hash = password_hash($mdp, PASSWORD_DEFAULT);
		$result=inscriptionUser($DB,$id,$nom,$promo,$hash,$prenom);

		if($result)
		{

			/* L'inscription est réussi, on démarre la session utilisateur, on garde en mem l'id */

			session_start();
			$_SESSION['login']=$id;
			$_SESSION['pwd']=$hash;

			echo "OK";
		}
        else{
            echo "Erreur inscription";
        }
	}
	/* On ferme la connexion */

	$DB = null;
}
catch(PDOException $e){
	echo "Database Error";
}


?>
