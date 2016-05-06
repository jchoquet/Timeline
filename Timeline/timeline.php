<?php

	session_start();

	$annee = $_POST['annee'];
	$name = $_POST['theme'];


    function getThemeSoiree($db, $name, $annee) {

      $stmt = $db->query("SELECT theme FROM soiree WHERE name='$name' AND annee='$annee'");
      $stmt->setFetchMode(PDO::FETCH_OBJ);
      $stmt = $stmt->fetch();
      return $stmt->theme;
    }

    function getIdSoiree($db, $name, $annee) {

      $stmt = $db->query("SELECT idsoiree FROM soiree WHERE name='$name' AND annee='$annee'");
      $stmt->setFetchMode(PDO::FETCH_OBJ);
      $stmt = $stmt->fetch();
      return $stmt->idsoiree;
    }

    function getPhotosSoiree($db, $idsoiree) {

        $stmt = $db->query("SELECT photo.idphoto, photo.extension, photo.composteur, photo.heure, utilisateur.surnom FROM photo INNER JOIN utilisateur ON photo.idposteur=utilisateur.identifiant WHERE idsoiree='$idsoiree' ORDER BY photo.heure ASC");
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $result = $stmt->fetchAll();
        return $result;
    }

    /* Working */

    function orderPhoto($tab) {

    	 $avantMinuit = array();
    	 $apresMinuit = array();

    	 foreach ($tab as $pic)
    	{
	    	if( strtotime($pic[3]) < strtotime("12:00:00"))
		 	{
		 		$apresMinuit[] = $pic;
		 	}
		 	else
		 	{
		 		$avantMinuit[] = $pic;
		 	}
		}

    	 $result = array();

    	 foreach ($avantMinuit as $a) 
    	 {
    	 	$result[] = $a;
    	 }
    	 foreach ($apresMinuit as $b) 
    	 {
    	 	$result[] = $b;
    	 }

    	 return $result;

    }

    function test($tab) {

	  	foreach($tab as $a)
	  	{
	  			

	  			echo $a[0].$a[1]. PHP_EOL;
	  		
	  	}
  	}
    

    function printTimeline($tab, $annee, $name) {

    	// $tab[0] idphoto
    	// 1 extension
    	// 2 com
    	// 3 heure
    	// 4 surnom posteur

    	$test = orderPhoto($tab);
    	

    	 $i=0;
    	 foreach ($test as $pic)
    	 {

    	 	$idphoto=$pic[0];
    	 	$extension=$pic[1];
    	 	$com=$pic[2];
    	 	$surnom=$pic[4];
    	 	$time=$pic[3];
    	 
    	 	$path = "photos/{$annee}/{$name}/{$idphoto}.{$extension}";
    	 	if( ($i%2) == 0 )
    	 	{
    	 		echo "<li>";

				if($i == 0)
				{
				$heure = date("H", strtotime($pic[3]));
				$oldHeure = $heure;

				echo "<button class='button-timeline btn btn-info btn-sm' id='$heure'>";
				echo $heure.' H';
				echo '</button>';
				}
				else
				{
				$oldHeure=$heure;
				$heure=date("H", strtotime($pic[3]));

				if($heure != $oldHeure)
				{
				echo "<button class='button-timeline btn btn-info btn-sm' id='$heure'>";
				echo $heure.' H';
				echo '</button>';
				}
				}
    	 		echo "<div class='timeline-badge primary'><a><i class='glyphicon glyphicon-record' rel='tooltip' title='$time' id=''></i></a></div>";
    	 	}
    	 	else
    	 	{
    	 		echo "<li  class='timeline-inverted'>";

    	 		$oldHeure=$heure;
				$heure=date("H", strtotime($pic[3]));

				if($heure != $oldHeure)
				{
				echo "<button class='button-timeline btn btn-info btn-sm'  id='$heure'>";
				echo $heure.' H';
				echo '</button>';
				}

    	 		echo "<div class='timeline-badge primary'><a><i class='glyphicon glyphicon-record invert' rel='tooltip' title='$time' id=''></i></a></div>";
    	 	}

			echo "<div class='timeline-panel'>";
			echo "<div class='timeline-heading'>";
			echo "<img class='img-responsive' src='$path' />";
			echo '</div>';
			echo "<div class='timeline-body'>";
			echo "<blockquote><p>".$com."</p><footer>D'après ".$surnom."</footer></blockquote>";
			echo "</div>";
			// echo "<div class='timeline-footer'>";
			// echo "<a><i class='glyphicon glyphicon-thumbs-up'></i></a>";
			// echo "<a><i class='glyphicon glyphicon-share'></i></a>";
			// echo "<a class='pull-right'>Postée par ".$surnom."</a>";
			// echo "</div>";
			echo "</div>";
			echo "</li>";
			$i=$i+1;
    	 }
    	
          
    }


    try{

      /* Connexion à la base de données avec PDO */

       $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

       $theme = getThemeSoiree($DB,$name,$annee);
       $idsoiree = getIdSoiree($DB,$name,$annee);

       $tabPhotos = getPhotosSoiree($DB,$idsoiree);



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
    <meta name="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <meta name="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- fichier css menu -->
	<link rel="stylesheet" href="css/menu.css">

	<!-- fichier css et js mise en page timeline -->
	<link rel="stylesheet" type="text/css" href="css/timeline.css">

  
</head>

<body>

	<?php include 'header2.php'; ?>

  <!-- menu gauche -->
  <div id="lmenu" class="container-fluid">
  <div class="row">
        <div class="col-sm-2 col-md-1 sidebar">
        <button id="b_22">LOL</button>
          <ul class="nav nav-sidebar ss-links">
                <li><a href="#22">22 H</a><li>
                <li><a href="#23">23 H</a></li>
                <li><a href="#02">02 H</a></li>
                <li><a href="#03">03 H</a></li>
                <li><a href="#july">Jul</a></li>
                <li><a href="#june">Jun</a></li>
          </ul>
          
        </div>

        <div class="col-sm-10 col-sm-offset-2 col-md-11 col-md-offset-1 main">


        	<div class="container fluid" id="main">
            <div class="page-header text-center">
                <h1 id="timeline"><?php echo $annee." - ".$theme; ?></h1>
            </div>
            <ul class="timeline">
                
                <?php printTimeline($tabPhotos, $annee, $name); ?>

                <li class="clearfix" style="float: none;"></li>
            </ul>
            </div>
        </div>

<!-- div fin de menu -->
</div>
</div>

	<script type="text/javascript" src="js/jquery_library.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/timeline.js"></script>
	  <script>
    $(document).ready(function (){
            $("#b_22").click(function (){
                $('html, body').scrollTop($("#02").offset().top - 100);
            });
        });
    </script>
</body>

</html>