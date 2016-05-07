<?php

	session_start();

	$idphoto = $_POST['idphoto'];
	$idsoiree = $_POST['idsoiree'];


	function getComment($db,$idphoto) {

		$stmt = $db->query("SELECT commentaire.idcom, commentaire.date_post, commentaire.heure_post, commentaire.contenu, utilisateur.surnom, utilisateur.identifiant, utilisateur.avatar FROM commentaire INNER JOIN utilisateur ON utilisateur.identifiant = commentaire.idauteur WHERE idphoto='$idphoto' ORDER BY commentaire.idcom ASC");
		$stmt->setFetchMode(PDO::FETCH_NUM);
		$result = $stmt->fetchAll();
		return $result;
	}

	try{

      /* Connexion à la base de données avec PDO */

       $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

       $commentaires = getComment($DB, $idphoto);

   	   $DB = null;

    }

    catch(PDOException $e){
       echo "Database Error";
    }


	$array = array($commentaires);

	echo json_encode($array);

?>