<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8"/>
    <title>TIMELINE</title>

    <!-- pour les moteurs de recherche -->
    <metaname="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <metaname="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />

     <!-- icone du titre de la page -->
  <link rel="shortcut icon" href="fonts/icone2.jpg">
     
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- jquery -->
	<script src="js/jquery_library.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.js"></script>

	<!-- fichier css perso -->
	<link rel="stylesheet" href="css/co2.css">

	<!-- fichier JS validation formulaire -->
	<script src="js/validate_co.js"></script>

</head>
<body>

    <div class="container-fluid">

    <!-- formulaire de connexion -->
			<form id="co" class="col-md-offset-4 col-md-4" role="form">
				
				<div class="form-group">
					<label for="identifiantc">Identifiant</label>
    				<input class="form-control" id="identifiantc" name="identifiantc" type="text" value="" required/> 
    				<span class="errors" id="idcerror"></span> 
    			</div>
    			
    			<div class="form-group">
   				 	<label for="mdp">Mot de passe</label>
    				<input class="form-control" id="mdpc" type="password" name="Mot de passe" value="" required/>
    				<span class="errors" id="mdperrorc"></span>
    			</div>
    		
    			<button class="btn btn-default btn-block" type="submit" name="connexion">Se connecter</button>

			</form>

</div>
</body>
</html>