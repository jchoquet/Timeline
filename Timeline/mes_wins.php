<?php

  session_start();

?>

<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Mes_Wins</title>
    
    <!-- icone du titre de la page -->
    <link rel="shortcut icon" href="fonts/icone2.jpg">
 
    <!-- pour les moteurs de recherche -->
    <meta name="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <meta name="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />

     <!-- Latest compiled and minified CSS -->
     #<link rel="stylesheet" href="css/bootstrap.css">
     <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">      

     <!-- jquery -->
     <script src="js/jquery_library.js"></script>

     <!-- Latest compiled and minified JavaScript -->
     <script src="js/bootstrap.js"></script>
   

  </head>
  
  <body>
    
    <?php #include 'header.php';
	  include 'script_mes_wins.php'; 
	  include 'PicPopUp.php';
    ?>
    

#TO DELETE (TESTS)
    <?php
    $v1 = array( 'name' => 'trash', 'year' => '2015', 'theme'=>'BTP', 'Pic'=>'1.png', 'NbVote'=>'5');
    $v2 = array( 'name' => 'love', 'year' => '2014', 'theme'=>'A3A', 'Pic'=>'1.png', 'NbVote'=>'10');
    $v3 = array( 'name' => 'raoul', 'year' => '2016', 'theme'=>'Or', 'Pic'=>'1.png', 'NbVote'=>'3');
    $result1 = [$v1,$v2,$v3];
    ?>
#END TO DELETE


    <h1 class="page-header">Mes Wins</h1>
    
    <div class="container-fluid" style="/*overflow:scroll;*/ padding-left:100px">
      <?php
	 #$result = selectMesWins("dbname=projet_web_2016_h", $iduser);
	 foreach($result1 as $vic){
	   echo "<div class='row'>";
             echo "<h2>Concours $vic[name] / $vic[year] / $vic[theme] </h2>";

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
