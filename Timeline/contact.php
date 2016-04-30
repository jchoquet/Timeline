<?php

if(isset($_POST['mailform'])){
  if(!empty($_POST['nom'])AND !empty($_POST['mail']) AND !empty($_POST['message']))
  {
  $header="MIME-Version: 1.0\r\n";
  $header.='From:"Administrat_Timeline.com"<support@timeline.com>'."\n";
  $header.='Content-Type:text/html; charset="uft-8"'."\n";
  $header.='Content-Transfer-Encoding: 8bit';
  
  $message='
  <html>
  	<body>
  		<div align="center">
  			<br />
  			<u> Nom de l\'expéditeur : </u>'.$_POST['nom'].'<br/>
        <u> mail de l\'expéditeur : </u>'.$_POST['mail'].'<br/>
  			<br />
        '.$_POST['message'].'
        <br />
  		</div>
  	</body>
  </html>
  ';

  mail("adm.timeline@gmail.com", "CONTACT - TIMELINE", $message, $header);
  $msg="votre message à bien été envoyé";
  echo $msg ;
  }
  else
  {
    $msg=" veuillez remplir tous les champs ";

  }


}
?>
<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>TIMELINE</title>

    <!-- pour les moteurs de recherche -->
    <meta name="description" lang="fr" content="plateforme de timeline photo pour soirÃ©e et Ã©vÃ¨nement" />
    <meta name="keywords" lang="fr" content="photos, soirÃ©e, timeline, ENSIIE, iiens" />

     <!-- icone du titre de la page -->
   <link rel="shortcut icon" href="fonts/icone2.jpg">
   
   
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">
	 <link rel="stylesheet" href="css/menu.css">


	<!-- jquery -->
	<script src="jquery_library.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.js"></script>


	<!-- fichier JS validation formulaire -->
	<script src="js/validate.js"></script>
    <link rel="stylesheet" href="css/ajout.css">

</head>

<body>

 <?php include 'header.php'; ?>
 <h3 class="page-header"><b> Contact! </b></h3>
<div class="container-fluid">
     <form id="modif" class="form-horizontal" role="form" method="POST" action="">
		          
          <div class="form-group">
            <label class="control-label col-sm-3" for="nom" > Ajouter votre nom : </label>
            <div class="col-sm-5">
                <input class="form-control" type="text" name="nom" placeholder="ajouter votre nom " required/> 
            </div>
            <div class="col-sm-4 errors" id="nom"></div>
   			</div>
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="mail" > Ajouter votre email : </label>
            <div class="col-sm-5">
                <input class="form-control" type="email" name="mail" placeholder="Ajouter votre email"  required/> 
            </div>
            <div class="col-sm-4 errors" id="mail"></div>
   			</div>
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="year" > Ajouter votre nom : </label>
            <div class="col-sm-5">
                <textarea class="form-control" name="message" placeholder="votre message" ></textarea>
            </div>
            <div class="col-sm-4 errors" id="nom"></div>
   			</div>
        
        <div class="form-group">
      <div class="col-sm-offset-3 col-sm-5">          
        <button class="btn btn-default btn-block" type="submit" id="Ajout" name="mailform">Send it!</button>
        <span class="errors" id="formerror"></span>
      </div>
      </div>

</form>
<?php
if(isset($msg))
{

echo $msg;

}
?>
</body>
</html>