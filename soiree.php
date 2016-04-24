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
 	 <link rel="stylesheet" href="css/menu.css">
	 <link rel="stylesheet" href="css/acceuil.css">

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

 <?php include ("base.php"); ?>

<div class="container-fluid">
  <div class="tab-pane fade in active" id="soiree">
    <div class="tab-content">
    <form id="co" class="col-md-offset-4 col-sm-4" role="form">
        <h2> choisis ta soir�e! </h2>			
        <br/>       	    			
          <div class="form-group">
    				year : <input class="form-control" name="year" type="number"  max="2016" min="1960"   step="1" value="2016" required/> 
    			</div>
          
    			<div class="form-group">

    				Theme : <input class="form-control" name="theme" type="text" value="" required/>

    			</div>
    		
    			<button class="btn btn-lg btn-success pull-right" type="submit" name="balance"><a href="recherchesoiree.php"><center>Balance!</center></a></button>
			</form>
		</div>
   </div>
   </div>




</body>
</html>