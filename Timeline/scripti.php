<?php


/* Fonction qui vérifie si l'identifiant n'est pas déjà pris (renvoie 1) sinon 0 */

function checkIdentifiant($db,$id){

	/* On prépare la requête pour éviter les injections SQL */
	
	$stmt = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE identifiant=:id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	return $stmt->fetchColumn();
}


try{

	/* Connexion à la base de données avec PDO */

	$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
	
	/* Si identifiant renseigné */

	if(isset($_POST['identifiant']))
	{

		$id=$_POST['identifiant'];

		$result=checkIdentifiant($DB, $id);

		if($result == 1)
		{
			echo "Identifiant déjà pris";
		}
        else{
            echo "OK";
        }
	}

	/* On ferme la connexion */

	$DB = null;
}
catch(PDOException $e){
	echo "Database Error";
}


?>
