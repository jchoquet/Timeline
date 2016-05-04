<?php

$done ="";
$error="";

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
  $done="Votre message a bien été envoyé ! ";

  }
  else
  {
    $error="Veuillez remplir tous les champs !";

  }


}
?>
<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <link rel="shortcut icon" href="fonts/icone.ico">
    <title>TIMELINE</title>

     <!-- pour les moteurs de recherche -->
    <metaname="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <metaname="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />
     
   <!-- jquery -->
   <script src="js/jquery_library.js"></script>

   <!-- Latest compiled and minified JavaScript -->
   <script src="js/bootstrap.js"></script>

   <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- fichier css menu -->
   <link rel="stylesheet" href="css/menu.css">

   <link rel="stylesheet" href="css/contact.css">

</head>

<body>

 <?php include 'header.php'; ?>

 <h3 class="page-header">Contact </h3>

  <div class="container-fluid">
     <form id="contact" class="form-horizontal" role="form" method="POST" action="">
		          
          <div class="form-group">
            <label class="control-label col-sm-3" for="nom" > Votre nom : </label>
            <div class="col-sm-5">
                <input class="form-control" type="text" name="nom"  required/> 
            </div>
            <div class="col-sm-4 errors" id="nomerror"></div>
   			</div>
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="mail" > Votre email : </label>
            <div class="col-sm-5">
                <input class="form-control" type="email" name="mail" required/> 
            </div>
            <div class="col-sm-4 errors" id="mailerror"></div>
   			</div>
        
        <div class="form-group">
            <label class="control-label col-sm-3" for="year" > Un petit message : </label>
            <div class="col-sm-5">
                <textarea class="form-control" name="message" ></textarea>
            </div>
            <div class="col-sm-4 errors" id="nomerror"></div>
   			</div>
        
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-5">          
            <button class="btn btn-default btn-block" type="submit" id="submit" name="mailform">Balance !</button>
            <span class="errors" id="formerror"><?php if(isset($res)) { echo $res ; } ?></span>
            <span class="correct" id="formcorrect"><?php if(isset($done)) { echo $done ; } ?></span>
          </div>
        </div>

    </form>
  </div>

 <?php include 'footer.php'; ?>

