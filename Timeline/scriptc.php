<?php

/* Fonction qui se charge de l'inscription */

function connexionUser($db,$id){

	/* On prépare la requête pour éviter les injections SQL */
	$stmt = $db->prepare("SELECT mdp FROM utilisateur WHERE identifiant=:id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt = $stmt->fetch();
    return $stmt->mdp;
}

try{

	/* Connexion à la base de données avec PDO */

	$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

	/* Si tous les champs sont renseignés, on teste la connexion */
	
	
	if(isset($_POST['id']) && isset($_POST['mdp']))
	{

	
		$id=$_POST['id'];
		$mdp=$_POST['mdp'];

		$hash=connexionUser($DB,$id);

		if (password_verify($mdp, $hash)) 
		{
			/* L'utilisateur existe, on démarre la session */

			session_start();
			$_SESSION['login']=$id;
			$_SESSION['pwd']=$hash;

		   	echo "OK";
		}
        else{
            echo "Erreur identifiant ou mot de passe";
        } 
	}
		
	/* On ferme la connexion */
	
	$DB = null;
}
catch(PDOException $e){
	echo "Database Error";
}


?>
