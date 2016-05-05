<?php

	session_start();

	$annee = $_POST['annee'];
	$name = $_POST['theme'];

	/* On doit chopper les photos de l'id soiree du ocup changer le truc d'en dessous pour chopper l'id */

	/* apres on se connecter pour chopper where id soirre = machin
		il faut extension idphoto, com posteur, surnom posteur, heure */

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

        $stmt = $db->query("SELECT photo.idphoto, photo.extension, photo.composteur, photo.heure, utilisateur.surnom FROM photo INNER JOIN utilisateur ON photo.idposteur=utilisateur.identifiant WHERE idsoiree='$idsoiree'");
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $result = $stmt->fetchAll();
        return $result;
    }


    function printTimeline($tab, $annee, $name) {

    	// $tab[0] idphoto
    	// 1 extension
    	// 2 com
    	// 3 heure
    	// 4 surnom posteur

    	 
    	 $i=0;
    	 foreach ($tab as $pic)
    	 {
    	 	$idphoto=$pic[0];
    	 	$extension=$pic[1];
    	 	$com=$pic[2];
    	 	$heure=$pic[3];
    	 	$surnom=$pic[4];

    	 	$path = "photos/{$annee}/{$name}/{$idphoto}.{$extension}";
    	 	if( ($i%2) == 0 )
    	 	{
    	 		echo "<li>";
    	 		echo "<div class='timeline-badge primary'><a><i class='glyphicon glyphicon-record' rel='tooltip' title='$heure' id=''></i></a></div>";
    	 	}
    	 	else
    	 	{
    	 		echo "<li  class='timeline-inverted'>";
    	 		echo "<div class='timeline-badge primary'><a><i class='glyphicon glyphicon-record invert' rel='tooltip' title='$heure' id=''></i></a></div>";
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

	<div class="container" id="main">
    <div class="page-header text-center">
        <h1 id="timeline"><?php echo $annee." - ".$theme; ?></h1>
    </div>
    <ul class="timeline">
        
        <?php printTimeline($tabPhotos, $annee, $name); ?>

        <li class="clearfix" style="float: none;"></li>
    </ul>
</div>

<!-- div fin de menu -->
</div>
</div>

	<script type="text/javascript" src="js/jquery_library.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/timeline.js"></script>
	
</body>

</html>