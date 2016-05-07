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

    	 $i=0;
    	 foreach ($tab as $pic)
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
				echo "<button class='button-timeline btn btn-info btn-sm'  id='$heure' >";
				echo $heure.' H';
				echo '</button>';
				}

    	 		echo "<div class='timeline-badge primary'><a><i class='glyphicon glyphicon-record invert' rel='tooltip' title='$time' id=''></i></a></div>";
    	 	}

			echo "<div class='timeline-panel'>";
			echo "<div class='timeline-heading'>";
			echo "<img class='img-responsive' src='$path' id='$idphoto' data-toggle='modal' data-target='#myModal'/>";
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

    function printSideBar ($tab) {

        $i=0;
        foreach ($tab as $pic) 
        {
            if($i == 0)
            {
                $heure = date("H", strtotime($pic[3]));
                $oldHeure = $heure;

                echo "<li><button class='scroll-button' id='b_".$heure."'>".$heure." H</button><li>";
                
            }
            else
            {
                $oldHeure=$heure;
                $heure=date("H", strtotime($pic[3]));

                if($heure != $oldHeure)
                   echo "<li><button class='scroll-button' id='b_".$heure."'>".$heure." H</button><li>";
            }
            $i=$i+1;

        }

    }    
    try{

      /* Connexion à la base de données avec PDO */

       $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

       $theme = getThemeSoiree($DB,$name,$annee);
       $idsoiree = getIdSoiree($DB,$name,$annee);

       $tabPhotos = getPhotosSoiree($DB,$idsoiree);

       $tabOrd = orderPhoto($tabPhotos);

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

	<!-- fichier css mise en page timeline -->
	<link rel="stylesheet" type="text/css" href="css/timeline.css">

    <link rel="stylesheet" type="text/css" href="css/modal.css">

  
</head>

<body>

	<?php include 'header2.php'; ?>

  <!-- menu gauche -->
  <div id="lmenu" class="container-fluid">
  <div class="row">
        <div class="col-sm-2 col-md-1 sidebar">

          <ul class="nav nav-sidebar ss-links">
                <?php printSideBar($tabOrd); ?>
          </ul>
          
        </div>

        <div class="col-sm-10 col-sm-offset-2 col-md-11 col-md-offset-1 main">


        	<div class="container fluid" id="main">
            <div class="page-header text-center">
                <h1 id="timeline"><?php echo $annee." - ".$theme; ?></h1>
            </div>
            <ul class="timeline">
                
                <?php printTimeline($tabOrd, $annee, $name); ?>

                <li class="clearfix" style="float: none;"></li>
            </ul>
            </div>
        </div>

<!-- div fin de menu -->
    </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
           
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12" id="image-content">
                        <!-- Va contenir l'image -->
                        </div>
                        <div class="col-lg-12 col-sm-12 hidden-xs">
                                <div >
                                    <div id="com-content" class="container-fluid">
                                      <div class="row">

                                            <div class="comment-tabs">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="active"><a href="#list-comment" role="tab" data-toggle="tab"><h4>Commentaires</h4></a></li>
                                                    <li><a href="#add-comment" role="tab" data-toggle="tab"><h4>Ajouter un commentaire</h4></a></li>
                                                </ul>            
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="list-comment">                
                                                        <ul class="media-list" style="overflow-y: scroll; max-height: 240px;">
                                                          <li class="media">
                                                            <a class="pull-left" href="#">
                                                              <img class="media-object img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/dancounsell/128.jpg" alt="profile">
                                                            </a>
                                                            <div class="container media-body">
                                                              <div class="well well-lg">
                                                                  <h4 class="media-heading text-uppercase reviews">Marco </h4>
                                                                  <ul class="media-date text-uppercase reviews list-inline">
                                                                    <li class="dd">22</li>
                                                                    <li class="mm">09</li>
                                                                    <li class="aaaa">2014</li>
                                                                  </ul>
                                                                  <p class="media-comment">
                                                                    Great snippet! Thanks for sharing.
                                                                  </p>
                                                              </div>              
                                                            </div>
                                                          </li> 
                                                          <li class="media">
                                                            <a class="pull-left" href="#">
                                                              <img class="media-object img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/dancounsell/128.jpg" alt="profile">
                                                            </a>
                                                            <div class="container media-body">
                                                              <div class="well well-lg">
                                                                  <h4 class="media-heading text-uppercase reviews">Marco </h4>
                                                                  <ul class="media-date text-uppercase reviews list-inline">
                                                                    <li class="dd">22</li>
                                                                    <li class="mm">09</li>
                                                                    <li class="aaaa">2014</li>
                                                                  </ul>
                                                                  <p class="media-comment">
                                                                    Great snippet! Thanks for sharing.
                                                                  </p>
                                                              </div>              
                                                            </div>
                                                          </li> 
                                                          <li class="media">
                                                            <a class="pull-left" href="#">
                                                              <img class="media-object img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/dancounsell/128.jpg" alt="profile">
                                                            </a>
                                                            <div class="container media-body">
                                                              <div class="well well-lg">
                                                                  <h4 class="media-heading text-uppercase reviews">Marco </h4>
                                                                  <ul class="media-date text-uppercase reviews list-inline">
                                                                    <li class="dd">22</li>
                                                                    <li class="mm">09</li>
                                                                    <li class="aaaa">2014</li>
                                                                  </ul>
                                                                  <p class="media-comment">
                                                                    Great snippet! Thanks for sharing.
                                                                  </p>
                                                              </div>              
                                                            </div>
                                                          </li>                 
                                                        </ul>
                                                    </div>      
                                                    <div class="tab-pane" id="add-comment">
                                                        <form action="#" method="post" class="form-horizontal" id="commentForm" role="form"> 
                                                            <div class="form-group">
                                                                <label for="email" class="col-sm-2 control-label">Comment</label>
                                                                <div class="col-sm-10">
                                                                  <textarea class="form-control" name="addComment" id="addComment" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-2 col-sm-10">                    
                                                                    <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span> Summit comment</button>
                                                                </div>
                                                            </div>            
                                                        </form>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div> <!-- close modal body -->

                <div class="modal-footer">
                    <button class='btn btn-primary vote' data-toggle='tooltip' title='Vote pour la photo la plus trash'>Trash<span class='badge'>15</span></button>
                    <button class='btn btn-primary vote' data-toggle='tooltip' title='Vote pour la photo où ça pécho sec'>Love<span class='badge'>15</span></button>
                    <button class='btn btn-primary vote' data-toggle='tooltip' title='Photo de toute beauté'>Like<span class='badge'>15</span></button>
                </div>
          
            </div>

        </div>
    </div>


    <!-- End of content : script JS -->
	<script type="text/javascript" src="js/jquery_library.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/timeline.js"></script>
	<script type="text/javascript" src="js/modal.js"></script> 
</body>

</html>