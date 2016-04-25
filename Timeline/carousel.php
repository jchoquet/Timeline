<?php

     function carousel($db, $sqlQuery) {
     
     $first = 0;     
     $dbConnected = pg_connect($db);
     $result = pg_query($dbConnected, $sqlQuery);
     $photos = pg_fetch_all ($result);
     

     echo '<div class="container">';
     echo '<br>';
     echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">';

    #Indicators
     $n = count($photos); #number of pictures to show
     echo '<ol class="carousel-indicators">';
     echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
     for ($i = 1; $i < $n; $i++){
	echo "<li data-target='#myCarousel' data-slide-to='$i'></li>";
     }
     echo '</ol>';
      
    #Wrapper for slides
     echo '<div class="carousel-inner" role="listbox">';
	
	

     foreach ($photos as $pic){
      if ($first == 0){ echo '<div class="item active">'; }
      else { echo '<div class="item">';}
      echo "<img src='$pic' alt='Chania' width='460' height='345'>";
      echo '</div>';
      $first = 1;
     }

     echo '</div>';
     
     #Left and right controls
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
     
     pg_close($dbConnected);
	
     }#endfunction

#usage : carousel("dbname=projet_web_h user=moi password=monsupermotdepasse", "SELECT idphoto FROM photos WHERE poster='Jean';");

?>