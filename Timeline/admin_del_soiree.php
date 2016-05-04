<?php
  session_start();

  /* On traite le cas où user lambda accède à la partie admin */

  $id=$_SESSION['login'];

  if($id != "administrat")
  {
  	header('location: connexion.php');
  }

  /* Fonction qui renvoie un tableau contenant les années présentes dans soiree */

  function getAnnee($db){

      $stmt = $db->prepare("SELECT DISTINCT annee FROM soiree ORDER BY annee DESC");
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_NUM);
      $result = $stmt->fetchAll();
      return $result;
  }

  
  /* Fonction qui crée un bouton select à partir d'un tableau */

  function printSelect($tab){

  	foreach($tab as $a)
  	{
  		foreach ($a as $b) 
  		{
  			echo "<option value='$b'>$b</option>" . PHP_EOL;
  		}
  	}
  }


  try{


		$DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

		$tab=getAnnee($DB);

		$DB = null;
	}
	catch(PDOException $e){
		echo "Database Error";
	}


?>

<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8"/>

    <link rel="shortcut icon" href="fonts/icone.ico">
    <title>TIMELINE</title>

    <!-- pour les moteurs de recherche -->
    <metaname="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <metaname="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />
    
	 <!-- jquery -->
	 <script src="js/jquery_library.js"></script>

	 <!-- Latest compiled and minified JavaScript -->
	 <script src="js/bootstrap.js"></script>

	 <!-- JS validation formulaire -->
	 <script src="js/validate_del_soiree.js"></script>

	 <!-- JS bouton select -->
	 <script src="js/fetch_select.js"></script>

   	 <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="css/bootstrap.css">

	 <!-- fichier css menu -->
	 <link rel="stylesheet" href="css/menu.css">
	 <link rel="stylesheet" href="css/admin_del_soiree.css">

</head>

<html>
<body>

 <?php include 'header.php'; ?>

	 	<h3 class="page-header"> Gestion administrateur - Suppression d'une soirée</h3>

	 	
	 	<div method="post" class="form-horizontal" >

	 	
		   <div class="form-group">
		        <label class="control-label col-sm-3" for="annee" > Année : </label>
		            <div class="col-sm-5">
		   				<select name="annee" id="annee" onchange="fetch_select_theme(this.value);">
		   				<option>Sélectionne une année</option>
		   					<?php printSelect($tab); ?>
		   				</select>
        			</div>
		   </div>

			<div class="form-group">
		        <label class="control-label col-sm-3" for="theme" > Thème : </label>
		            <div class="col-sm-5">
		   				<select name="theme" id="theme">
		   				</select>
        			</div>
		   </div>

		   <div class="form-group">
		        <label class="control-label col-sm-3" for="mdp" > Mot de passe : </label>
		            <div class="col-sm-5">
		   				<input type="password" class="form-control" id="mdp" name="mdp" />
        			</div>
        			<div class="col-sm-4 errors" id="mdperror"></div>
		   </div>

		    <div class="form-group">
		      <div class="col-sm-offset-3 col-sm-5">          
		        <button class="btn btn-default btn-block" type="submit" id="submit" name="submit">Supprimer</button>
		      	<span class="errors" id="formerror"></span>
        		<span class="correct" id="formcorrect"></span>
		      </div>
		    </div>

		</div>


   

 <?php include 'footer.php'; ?>