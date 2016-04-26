<?php

/* Fonction qui se charge de l'inscription */

function connexionUser($db,$id,$mdp){

	/* On prépare la requête pour éviter les injections SQL */
	
	$stmt = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE identifiant=:id AND mdp=:mdp");
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':mdp', $mdp);
	$stmt->execute();
	return $stmt->fetchColumn();
}

try{

	/* Connexion à la base de données avec PDO */

	$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

	/* Si tous les champs sont renseignés, on teste la connexion */
	
	
	if(isset($_POST['id']) && isset($_POST['mdp']))
	{

		

		$id=$_POST['id'];
		$mdp=$_POST['mdp'];

		$result=connexionUser($DB,$id,$mdp);

		/* On arrive jusque ici */	

		if($result == 1)
		{

			/* L'utilisateur existe, on démarre la session */

			session_start();
			$_SESSION['login']=$id;
			$_SESSION['pwd']=$mdp;

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
