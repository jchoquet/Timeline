<!DOCTYPE html>
<html lang="en">
<head>
  <title>test</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

  <h1> COUCOU </h1>

  <?php
     include 'PicPopUp.php' ;
     PicPopUp ("PopUpClicSurPhoto","1.png", "");
     echo "<a data-toggle='modal' data-target='#PopUpClicSurPhoto'>MyAwesomeLink</a><br>";
     echo "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#PopUpClicSurPhoto'>MyAwesomeButton</button><br>";
?>
</body>
</html>
