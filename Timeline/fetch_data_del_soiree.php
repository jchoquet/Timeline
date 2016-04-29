<?php
	
	/* On va récupérer les thèmes correspondant à l'année sélectionnée */
	
	function selectThemeAnnee($db,$annee){

		$stmt = $db->prepare("SELECT theme FROM soiree WHERE annee=:a ORDER BY theme");
		$stmt->bindParam(':a', $annee);
	    $stmt->execute();
	    $stmt->setFetchMode(PDO::FETCH_NUM);
	    $result = $stmt->fetchAll();
	    return $result;

	}

	function printSelectTheme($tab){

		echo "<option>Sélectionnez un thème</option>";
	  	foreach($tab as $a)
	  	{
	  		foreach ($a as $b) 
	  		{
	  			echo "<option value='$b'>$b</option>" . PHP_EOL;
	  		}
	  	}
  	}

	if(isset($_POST['get_option']))
	{
		try{

			$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

			$annee=$_POST['get_option'];

			$tabTheme=selectThemeAnnee($DB,$annee);

			printSelectTheme($tabTheme);

			$DB = null;

		}

		catch(PDOException $e){
			echo "Database Error";
		}
	}


?>
