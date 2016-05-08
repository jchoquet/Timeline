<?php

      /* Fonction qui va retourner la chaine avec le path des photos à afficher */
  
    function getPath($tab){

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

    /* Fonction qui va crée le texte afficher à côté de chaque photo dans le carousel (utilisée pour posts, identifications) */

    function panelCarousel($tab){

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

    /* Fonction qui va crée le texte affiché à côté de chaque photo dans le carousel (utilisée pour wins) */

    function panelCarouselWins($tab){

        $i=0;
        foreach($tab as $a)
        {
            $annee=$a[0];
            $com=$a[4];

            $nomConcours = $a[5];
            $themeSoiree = $a[7];
            $votes = $a[8];

            echo "<div class='side-text' id='slide-content-".$i."'>";
            echo '<h3>Concours '.$nomConcours.'</h3>';
            echo '<h4>'.$annee.' - '.$themeSoiree.'</h4>';
            echo '<p>'.$com.'</p>';
            echo '<p class="sub-text">Dénoncée par '.$votes.' personnes</p>';
            echo '</div>';
            $i=$i+1;
        }
    }

    /* Fonction qui va crée le texte affiché à côté de chaque photo dans le carousel (utilisée pour acceuil) */

    function panelCarouselAcceuil($tab){

        $i=0;
        foreach($tab as $a)
        {
            $annee=$a[0];
            $com=$a[4];

            $theme=$a[5];
            $date=$a[6];
            $heure = date("H:i:s", strtotime($a[7]));

            echo "<div class='side-text' id='slide-content-".$i."'>";
            echo '<h3>'.$annee.' - '.$theme.'</h4>';
            echo '<p>'.$com.'</p>';
            echo '<p class="sub-text">Postée le '.$date.' à '.$heure.' </p>';
            echo '</div>';
            $i=$i+1;
        }
    }


     /* Carousel avec texte à droite + petites images en dessous (2eme argument : 2 pour le panel carousel wins, 3 pour celui de l'acceuil, sinon panel carousel de base )*/

     function carousel($tabPhotos,$version)
     {

         $photos = getPath($tabPhotos);

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

            $tab = $tabPhotos[$i];
            $id = $tab[2];
            $idsoiree = $tab[6];

            if($i == 0)
            {
                echo "<div class='active item' data-slide-number='$i'>";
            }
            else
            {
                 echo "<div class='item' data-slide-number='$i'>";
            }
            echo "<img src='$pic' id='$id' idsoiree='$idsoiree' class='img-responsive img-rounded' style='margin:0px auto;max-height:350px;' data-toggle='modal' data-target='#myModal'/>";
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

        if($version == 2)
        {
            panelCarouselWins($tabPhotos);
        }
        elseif ($version == 3) 
        {
            panelCarouselAcceuil($tabPhotos);
        }
        else
        {
            panelCarousel($tabPhotos);
        }

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
