<?php

	session_start();


	$id = $_SESSION['login'];
	$idphoto = $_POST['idphoto'];
	$idsoiree = $_POST['idsoiree'];


	function getComment($db,$idphoto) {

		$stmt = $db->query("SELECT commentaire.idcom, commentaire.date_post, commentaire.heure_post, commentaire.contenu, utilisateur.surnom, utilisateur.identifiant, utilisateur.avatar FROM commentaire INNER JOIN utilisateur ON utilisateur.identifiant = commentaire.idauteur WHERE idphoto='$idphoto' ORDER BY commentaire.idcom ASC");
		$stmt->setFetchMode(PDO::FETCH_NUM);
		$result = $stmt->fetchAll();
		return $result;
	}

	function getLike($db,$idphoto) {
		$stmt = $db->query("SELECT nblike FROM photo WHERE idphoto='$idphoto'");
		$stmt->setFetchMode(PDO::FETCH_NUM);
      	$result = $stmt->fetchAll();
		return $result;
	}

	function dejaLike($db, $idphoto, $id) {
		$stmt = $db->query("SELECT COUNT(*) FROM liker WHERE idutilisateur='$id' AND idphoto='$idphoto'");
		return $stmt->fetchColumn();
	}

	try{

      /* Connexion à la base de données avec PDO */

       $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

       $commentaires = getComment($DB, $idphoto);
       $nblike = getLike($DB, $idphoto);
       $likePossible = dejaLike($DB, $idphoto, $id);

   	   $DB = null;

    }

    catch(PDOException $e){
       echo "Database Error";
    }


	$array = array($commentaires, $nblike, $likePossible);

	echo json_encode($array);

?>