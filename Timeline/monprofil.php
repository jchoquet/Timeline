<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8"/>
    <title>TIMELINE</title>

    <!-- pour les moteurs de recherche -->
    <meta name="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <meta name="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />


	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- jquery -->
	<script src="jquery_library.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.js"></script>

	<!-- fichier css perso -->
	<link rel="stylesheet" href="css/index.css">

	<!-- fichier JS validation formulaire -->
	<script src="js/validate.js"></script>

</head>

<body>
<h1 class="page-header text-center"> Mon profil </h1>
 <?php include ("base.php"); ?>

<div class="container-fluid">
    <div class="tab-content">
       <form class="col-md-offset-4 col-md-4">
    	   
 
              <div class="form-group">
              <label for="surnom" > Modifier mon Surnom : </label>
                  <input type="text" class="form-control" id="text">
                  <span class="errors" id="iderror"></span> 
              </div>

            <div class="form-group">
            <label for="photo" > Modifier ma photo : </label>
                 <input type="textarea" class="form-control" id="textarea">
                 <span class="errors" id="iderror"></span> 
            </div>
            
            <div class="form-group">
            <label for="quote" class >Modifier ma quote : </label>
              <textarea class="form-control" id="textarea"></textarea>
              <span class="errors" id="iderror"></span> 
            </div>
            
            <div class="form-group">
      <label for="mdp" >Ancien Mot de Passe : </label>
        <input class="form-control" type="password" name="Mot de passe" value="" required/>
        <span class="errors" id="iderror"></span>
    </div>


    <div class="form-group">
    <label for="Nmdp" >Nouveau Mot de Passe : </label>
        <input class="form-control" id="mdpc" type="password" name="Mot de passe" value="" required/>
        <span class="errors" id="iderror"></span>
    </div>

    <div class="form-group">
    <label for="mdp" >Confirmez votre nouveau Mot de Passe : </label>
        <input class="form-control" id="mdpc" type="password" name="Mot de passe" value="" required/>
        <span class="errors" id="iderror"></span>
    </div>
                   
        <div class="form-group">
            <button class="btn btn-lg btn-success pull-right">Balance!</button>
        </div>
        </br>	
        </br>	
        </br>	
</form>
		</div>
   </div>

</body>
</html>