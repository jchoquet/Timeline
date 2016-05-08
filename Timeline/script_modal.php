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

	function getLike($db,$idphoto) {
		$stmt = $db->query("SELECT nblike FROM photo WHERE idphoto='$idphoto'");
		$stmt->setFetchMode(PDO::FETCH_NUM);
      	$result = $stmt->fetchAll();
		return $result;
	}

	function concoursEncours($db, $nameConcours, $idsoiree) {
		$stmt = $db->prepare("SELECT winner, encours, idconcours FROM concours WHERE nom=:nom AND idsoiree='$idsoiree'");
		$stmt->bindParam(':nom', $nameConcours);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_NUM);
      	$result = $stmt->fetchAll();
		return $result;
	}

	function getVote($db, $idphoto, $idconcours, $idsoiree) {
		$stmt = $db->query("SELECT compteur.nbre_votes FROM compteur WHERE idconcours='$idconcours' AND idphoto='$idphoto'");
		$stmt->setFetchMode(PDO::FETCH_NUM);
      	$result = $stmt->fetchAll();
		return $result;
	}

	try{

      /* Connexion à la base de données avec PDO */

       $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

       $commentaires = getComment($DB, $idphoto);
       $nblike = getLike($DB, $idphoto);

       $trashActu = concoursEncours($DB, "Trash", $idsoiree);
       $loveActu = concoursEncours($DB, "Love", $idsoiree);

       if (($trashActu[0][0] == 0) && ($trashActu[0][1]) )
       {
       	 $voteTrash = getVote($DB, $idphoto, $trashActu[0][2], $idsoiree);
       	 if($voteTrash)
       	 {
       	 	$trashResult = $voteTrash;
       	 }
       	 else
       	 {
       	 	$trashResult = 0;
       	 }
       }
       else
       {
       	$trashResult = -1;
       }
   	   $DB = null;

    }

    catch(PDOException $e){
       echo "Database Error";
    }


	$array = array($commentaires, $nblike, $trashResult);

	echo json_encode($array);

?>