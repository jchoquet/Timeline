<?php



  # Return the challenges won by a user as an array [name, year, theme, Pic]
  # Pic : link to the physical location of the picture concerned by each victory ('id+extension')
  # NbVote : Number of people who voted for Pic 
  


  function selectMesWins($db,$IdUser){
  	$stmt = $db->prepare("
	       SELECT nom, annee, theme, winner, extension
	       FROM concours
	       INNER JOIN soiree ON concours.idsoiree = soiree.idsoiree
	       INNER JOIN photo ON photo.idphoto = concours.winner
	       WHERE photo.idposteur = $IdUser AND NOT encours
	       ;
	   
           ");	

	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_NUM);
	$result = $stmt->fetchAll();
	$info = array (
	      "name" => "$result[nom]",
	      "year" => "$result[annee]",
	      "theme" => "$result[theme]",
	      "Pic" => "$result[winner].$result[extension]"
	      );      
	return $info;
  }

?>