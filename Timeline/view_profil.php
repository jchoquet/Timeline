<?php

session_start();

function checkIdentifiantUser($db,$id){

	/* On prépare la requête pour éviter les injections SQL */
	
	$stmt = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE identifiant=:id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function getInfosUser($db, $id) {

        $stmt = $db->prepare("SELECT avatar, nom, prenom, surnom, promo, quote FROM utilisateur WHERE identifiant='$id'");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $result = $stmt->fetchAll();
        return $result;
}

if(isset($_GET['identifiant']))
{
	/* On vérifie que l'identifiant existe avec une requete préparée sinon page d'acceuil logout */

	$idprofil = $_GET['identifiant'];

	try{

	      $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
	      
	      if(checkIdentifiantUser($DB,$idprofil) == 1)
	      {

	      	$infos = getInfosUser($DB, $idprofil);

	      }
	      $DB = null;

	    }

	    catch(PDOException $e){
	      echo "Database Error";
	    }

}


?>

<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>TIMELINE</title>
    
    <!-- icone du titre de la page -->
    <link rel="shortcut icon" href="fonts/icone2.jpg">
 
    <!-- pour les moteurs de recherche -->
    <meta name="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <meta name="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />

     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="css/bootstrap.css">
      
     <!-- jquery -->
     <script src="js/jquery_library.js"></script>

     <!-- Latest compiled and minified JavaScript -->
     <script src="js/bootstrap.js"></script>
   

   <!-- fichier css perso -->
   <link rel="stylesheet" href="css/menu.css">
   <link rel="stylesheet" href="css/view_profil.css">  
  </head>

<body>

  		<?php include 'header.php'; ?>

  		<div class="container-fluid">
  			<div class="row">
	    		<div class="col-xs-12 col-sm-6 col-lg-4">
	    			<div class="thumbnail">
		     			<img src="users/avatar/<?php echo $idprofil.".".$infos[0][0]; ?>" alt='avatar' > 
					</div>
				</div> 
      	    	<div class="col-xs-12 col-sm-6 col-lg-4" id="infos">
		     		<ul>
	 		        	<li><span class="etiquette">Nom :</span><?php echo $infos[0][1]; ?></li>
			        	<li><span class="etiquette">Prénom :</span><?php echo $infos[0][2]; ?></li>
						<li><span class="etiquette">Surnom :</span><?php echo $infos[0][3]; ?></li>
						<li><span class="etiquette">Promo :</span><?php echo $infos[0][4]; ?></li>
		     		</ul> 
				</div>
				<blockquote class="col-xs-12" id="quote_block">
					<?php echo $infos[0][5]; ?>
				</blockquote>
				
	   		</div>
	    
	    	<div class="row">
	    		<div class="col-xs-12" id="nav_photos">    
	    			<ul>
	    				<li><span class="glyphicon glyphicon-pushpin"></span>Ses identifications</li>
	    				<li><span class="glyphicon glyphicon-camera"></span>Ses posts</li>
	    				<li><span class="glyphicon  glyphicon-star"></span>Ses Wins</li>
           			</ul>
           		</div>
           	</div>

        </div>
  
 		<?php include 'footer.php'; ?>