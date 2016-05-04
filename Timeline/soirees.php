<?php
  session_start();
?>

<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>TIMELINE</title>

    <!-- pour les moteurs de recherche -->
    <meta name="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <meta name="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />

     <!-- icone du titre de la page -->
   <link rel="shortcut icon" href="fonts/icone2.jpg">
   
   
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">
	 <link rel="stylesheet" href="css/menu.css">


	<!-- jquery -->
	<script src="jquery_library.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.js"></script>


	<!-- fichier JS validation formulaire -->
	<script src="js/validate.js"></script>
    <link rel="stylesheet" href="css/ajout.css">

</head>

<body>

 <?php include 'header.php'; ?>
 
 
<h3 class="page-header"><b> choisis ta Soirée! </b></h3>

  <div class="container-fluid">
     <form id="modif" class="form-horizontal" role="form">
		          
          <div class="form-group">
        <label class="control-label col-sm-3" for="year" > Année : </label>
        <div class="col-sm-5">
  				<input class="form-control"  type="number"  max="2016" min="1960"   step="1" value="2016" required/> 
        </div>
        <div class="col-sm-4 errors" id="oldMdperror"></div>
   			</div>
          
    			<div class="form-group">
          <label class="control-label col-sm-3" for="heure" > Theme : </label>
          <div class="col-sm-5">
  				<select name="th�me" placeholder="choisir un th�me">
        <option>intre_rentrée</option>
        <option>soirée des associations</option>
        <option>BTP</option>
        <option>MisterIIE</option>
        <option>soirée tancarville</option>
        <option>soirée mexicaine</option>
        <option>soirée fluo</option>
        <option>soirée Noel</option>
        <option>soirée duo de marins</option>
        <option>soirée bakanim</option>
        <option>soirée Or</option>
      </select></div></div>
    		
    			<div class="form-group">
      <div class="col-sm-offset-3 col-sm-5">          
        <button class="btn btn-default btn-block" type="submit" id="Ajout" name="Ajout">Ajouter !</button>
        <span class="errors" id="formerror"></span>
      </div>
      </div>
      
      
			</form>
		</div>
   </div>
   </div>

<?php include 'footer.php'; ?>


</body>
</html>