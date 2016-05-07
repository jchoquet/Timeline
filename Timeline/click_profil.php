<?php

  session_start();

  include 'carousel_click_profil.php';

  try{

      $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");
      $IdProfil = "";

      $tabPhotosPosts = getPhotosSesPosts($DB,$IProfil);   
      $tabPhotosIdentifications = getPhotosSesIdentifications($DB,$IdProfil);  
      
      $DB = null;

    }

    catch(PDOException $e){
      echo "Database Error";
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
    <meta name="description" lang="fr" content="plateforme de timeline photo pour soirÃ©e et Ã©vÃ¨nement" />
    <meta name="keywords" lang="fr" content="photos, soirÃ©e, timeline, ENSIIE, iiens" />

     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="css/bootstrap.css">
      
     <!-- jquery -->
     <script src="js/jquery_library.js"></script>

     <!-- Latest compiled and minified JavaScript -->
     <script src="js/bootstrap.js"></script>
   

   <!-- fichier css perso -->
   <link rel="stylesheet" href="css/menu.css">
/*   <link rel="stylesheet" href="css/click_profil.css">  ???*/
   <link rel="stylesheet" href="css/buttonLink.css">

   <script>

        //Code nécessaire pour le carroussel 
        jQuery(document).ready(function($) {
 
        $('#myCarousel').carousel({
                interval: 10000
        });
 
        $('#carousel-text').html($('#slide-content-0').html());
 
        //Handles the carousel thumbnails
       $('[id^=carousel-selector-]').click( function(){
            var id = this.id.substr(this.id.lastIndexOf("-") + 1);
            var id = parseInt(id);
            $('#myCarousel').carousel(id);
        });
 
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
         });
   </script>


  </head>

  <body>
  <?php include 'header.php'; 
  	include 'carousel_click_profil.php';   
	include 'script_mes_wins.php'; 
	include 'PicPopUp.php';
  ?>


      
      <div class="container-fluid" style="overflow:scroll"> /*menu déroulant*/

      /*diviser en 2 colone*/
      	    <h3>Son Profil</h3>
      	    <div classe="raw">
	    	<div classe="col-sm-4">
		     <img src=<?php echo "SELECT avatar FROM utilisateur WHERE identifiant=$IdProfil ;"?> alt='Echec chargement image > 
		</div> 
      	    	<div classe="col-sm-4">
		     <ul style="list-style-type:none">
 		        <li>Nom</li>
		        <li>Prenom</li>
			<li>Surnom</li>
			<li>Promo</li>
		     </ul> 
		</div>
		<div classe="col-sm-4">
		     <ul style="list-style-type:none">
 		        <li><?php echo "SELECT nom FROM utilisateur WHERE identifiant=$IdProfil ;"?></li>    
		        <li><?php echo "SELECT prenom FROM utilisateur WHERE identifiant=$IdProfil ;"?></li>    
			<li><?php echo "SELECT Surnom FROM utilisateur WHERE identifiant=$IdProfil ;"?></li>   
			<li><?php echo "SELECT Promo FROM utilisateur WHERE identifiant=$IdProfil ;"?></li>    
		     </ul> 
		</div>
	    </div>
	    
	    </br>
	    
	    <h3>Ses Identifications</h3>
           
		 <?php
			if($tabPhotosIdentifications) 
          		{
				carousel_ses_identificatons($tabPhotosIdentifications);
          		}
          		else
          		{
				echo "<div class='container-fluid'>";
            			echo "<p class='nothing'>Cette tanche n'est identifiée nul part !<p>";
            		}
        	?>

	    </br>
	    
	    <h3>Ses Posts</h3>
           
		 <?php
			if($tabPhotosPosts) 
          		{
				carousel_ses_posts($tabPhotosPosts);
          		}
          		else
          		{
				echo "<div class='container-fluid'>";
            			echo "<p class='nothing'>Cette tanche n'a encore rien poster !<p>";
            		}
        	?>

	    </br>
	    
	    <h3>Ses Wins</h3>
           
	         <?php
			$result = selectMesWins("dbname=projet_web_2016_h", $IdProfil);
	 		foreach($result1 as $vic){
	  		  echo "<div class='row'>";
             		  echo "<h4>Concours $vic[name] / $vic[year] / $vic[theme] </h4>";

			  /*Lien PicPopUp*/
	     		  $idPopUp = "$vic[Pic]_$vic[name]";
       	     		  PicPopUp ($idPopUp,$vic[substr(Pic,0,-4)], "projet_web_2016_h");
	     		  echo "<a data-toggle='modal' data-target='$idPopUp'>";
	       		  echo "<img src='$vic[Pic]' alt='Echec chargement image'/>";
	     		  echo "</a>";
	   		  echo "</div>";
			}
		 ?>






		 		

      </div>
	

  </body>
</html>

