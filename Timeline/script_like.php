<?php

session_start();

$id = $_SESSION['login'];
$nombre = $_POST['nombre'];
$idphoto = $_POST['idphoto'];

$nombre = $nombre + 1;

function addLike($db, $idphoto, $id) {

	$stmt = $db->prepare("INSERT INTO liker(idphoto, idutilisateur) VALUES (:idphoto,'$id')");
	$stmt->bindParam(':idphoto', $idphoto);
	return $stmt->execute();
}

function upCompteurLike($db, $idphoto, $val) {
  $stmt = $db->prepare("UPDATE photo SET nblike='$val' WHERE idphoto=:id");
  $stmt->bindParam(':id', $idphoto);
  return $stmt->execute();
}

try{

      /* Connexion à la base de données avec PDO */

       $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

       $result = addLike($DB, $idphoto, $id);

       if($result)
       {
          $done = upCompteurLike($DB, $idphoto, $nombre);
          if($done)
          {
            echo "OK";
          }
           else
          {
            echo "erreur";
          }
       }
      else
      {
        echo "erreur";
      }
      
   	   $DB = null;
      

    }

    catch(PDOException $e){
       echo "Database Error";
    }



?>