<!--http://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_carousel&stacked=h-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Carousel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>
</head>

<body>

<?php

function carousel($photos,$n) { 
   print('<div class="container">');
   print('<br>');
   print('<div id="myCarousel" class="carousel slide" data-ride="carousel">');

  
   #Images
   
   print('<div class="carousel-inner" role="listbox">');
   foreach($photos as $pic)
   {
      print('<div class="item">');
      print("<img src=$pic alt='img'>");
      print('</div>');
   }
   print('</div>');
  


  #Left and right controls
  
  print('<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">');
  print('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>');
  print('<span class="sr-only">Previous</span>');
  print('</a>');
  print('<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">');
  print('<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>');
  print('<span class="sr-only">Next</span>');
  print('</a>');


  print('</div>');
  print('</div>');
}

#For testing
#$pics = array("Img/1.png","Img/2.png","Img/3.gif","Img/4.jpeg","Img/5png","Img/6.jpeg");
#carousel($pics,6);



?>

</body>
