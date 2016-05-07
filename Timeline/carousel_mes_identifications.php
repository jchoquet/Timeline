<?php


     function getPhotosMesIdentifications($db) {

        $id=$_SESSION['login'];
        $stmt = $db->query("SELECT soiree.annee, soiree.name, photo.idphoto, photo.extension, photo.composteur, soiree.theme FROM photo INNER JOIN soiree ON photo.idsoiree=soiree.idsoiree INNER JOIN identification ON photo.idphoto=utilisateur.idphoto WHERE identification.idutilisateur='$id'");
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $result = $stmt->fetchAll();
        return $result;
    }

    /* Fonction qui va retourner la chaine avec le path des photos à afficher */
    
    function getPathMesIdentifications($tab){

        $photos = array();

        foreach($tab as $a)
        {
                $annee=$a[0];
                $name=$a[1];
                $idphoto=$a[2];
                $ext=$a[3];

                $photoPath = "photos/{$annee}/{$name}/{$idphoto}.{$ext}";
                $photos[] = $photoPath;
        }

        return $photos;
    }

    /* Fonction qui va crée le texte afficher à côté de chaque photo dans le carousel */

    function panelMesIdentifications($tab){

        $i=0;
        foreach($tab as $a)
        {
                $annee=$a[0];
                $com=$a[4];
                $theme=$a[5];
            echo "<div class='side-text' id='slide-content-".$i."'>";
            echo '<h3>'.$annee.' / '.$theme.'</h3>';
            echo '<p>'.$com.'</p>';
            echo '<p class="sub-text"></p>';
            echo '</div>';
            $i=$i+1;
        }
    }

     /* Carousel avec texte à droite + petites images en dessous */

     function carousel_mes_identifications($tabPhotos)
     {

         $photos = getPathMesPosts($tabPhotos);

         $first = 0;     
      
         echo '<div class="container">';
         
         echo '<div id="main_area">';

        // Slider 
        echo '<div class="row border">';
        echo '<div class="col-xs-12" id="slider">';
        //Top part of the slider 
        echo '<div class="row">';
        echo '<div class="col-sm-8" id="carousel-bounding-box">';
        echo '<div class="carousel slide" id="myCarousel">';
       
        // Carousel items 
        echo '<div class="carousel-inner">';

        $n = count($photos); 
        $i=0;
        foreach ($photos as $pic)
        {
            if($i == 0)
            {
                echo "<div class='active item' data-slide-number='$i'>";
            }
            else
            {
                 echo "<div class='item' data-slide-number='$i'>";
            }
            echo "<img src='$pic' class='img-responsive img-rounded' style='margin:0px auto;max-height:350px;'/>";
            echo '</div>';
           $i=$i+1;
        }

        echo "</div>";

        // Carousel controlers (left, right)
        echo '<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">';
        echo '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
        echo '<span class="sr-only">Previous</span>';
        echo'</a>';
        echo'<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">';
        echo'<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
        echo'<span class="sr-only">Next</span>';
        echo'</a>';

        echo'</div>';
        echo'</div>';

        // carousel right panel with texts
        echo '<div class="col-sm-4" id="carousel-text"></div>';
        echo '<div id="slide-content" style="display: none;">';

        panelMesPosts($tabPhotos);

        echo'</div>';
        echo'</div>';
        echo'</div>';
        echo'</div>';

        // Row of thumbnails
        echo '<div class="row hidden-xs hidden-sm" id="slider-thumbs">';
        echo '<ul class="hide-bullets">';

        $i=0;
        foreach ($photos as $pic)
        {
            echo '<li class="col-sm-2">';
            echo "<a class='thumbnail' id='carousel-selector-{$i}'><img src='$pic' class='img-responsive img-rounded' style='margin:0px auto;max-height:100px;'></a>";
            echo '</li>';
            $i=$i+1;
        }

        echo '</ul>';

        echo'</div>';
        echo'</div>';
        echo'</div>';
    }
?>

