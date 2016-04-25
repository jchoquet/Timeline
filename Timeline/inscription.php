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
	<link rel="stylesheet" href="css/inscription.css">

	<!-- fichier JS validation formulaire -->
	<script src="js/validate_ins.js"></script>

</head>
<body>

	<div class="container-fluid">
	<!-- formulaire d'inscription -->

			<div id="ins" class="col-md-offset-4 col-md-4">
				
				<div class="form-group">
					<label for="nom">Nom</label> 
    				<input class="form-control" id="nom" name="nom" type="text"/>
    				<span class="errors" id="nomerror"></span>
    			</div>

    			<div class="form-group">
   				 	 <label for="prenom">Prénom</label>
    				<input class="form-control" id="prenom" name="prénom" type="text"/>
    				<span class="errors" id="prenerror"></span>
    			</div>

    			<div class="form-group">
   				 	<label for="promo">Promo</label> 
    				<input class="form-control" id="promo" name="promo" type="number" value="2010"/>
    				<span class="errors" id="promoerror"></span>
    			</div> 

    			<div class="form-group">
					<label for="identifiant">Identifiant</label>
    				<input class="form-control" id="identifiant" name="identifiant" type="text" value="" />
    				<span class="errors" id="iderror"></span>
    				<span class="correct" id="idcorrect"></span>
    			</div>

    			<div class="form-group">
   				 	<label for="mdp">Mot de passe</label>
    				<input class="form-control" id="mdp" type="password" name="Mot de passe" value="" />
    				<span class="errors" id="mdperror"></span>
    			</div>

    			<div class="form-groupe">
   				 	<label for="cmdp">Confirmer mot de passe</label>
    				<input class="form-control" id="cmdp" type="password" name="Mot de passe" value="" />
    				<span class="errors" id="cmdperror"></span>
    			</div>

    			<button class="btn btn-default btn-block" type="submit" id="inscription" name="inscription">S'inscrire</button>
    			<span class="errors" id="formerror"></span>

    			

			</div>


</div>
</body>
</html>