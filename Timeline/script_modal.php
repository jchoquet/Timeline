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

       $commentaire = getComment($DB, $idphoto);

       $comresult = array();

       foreach ($commentaire as $com){
	      $comresult[] = "<p>".$com[1]." ".$com[2]." ".$com[5]." : ".$com[3]."</p>";
	  	}
    

    	$DB = null;

    }

    catch(PDOException $e){
       echo "Database Error";
    }


	$array = array($idphoto, $idsoiree, $comresult);

	echo json_encode($array);

?>