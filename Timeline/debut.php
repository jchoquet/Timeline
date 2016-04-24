<!DOCTYPE html >
<html lang="fr">
  <head>
    <meta charset="utf-8"/>
    <title>TIMELINE</title>

    <!-- pour les moteurs de recherche -->
    <meta name="description" lang="fr" content="plateforme de timeline photo pour soirée et évènement" />
    <meta name="keywords" lang="fr" content="photos, soirée, timeline, ENSIIE, iiens" />


	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- jquery -->
	<script src="js/jquery_library.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.js"></script>

	<!-- fichier css perso -->
	<link rel="stylesheet" href="css/menu.css">

	<!-- fichier JS validation formulaire -->
	<script src="js/validate.js"></script>

</head>

<?php

    //Attribution des variables de session

		$login = (isset($_POST['Identifiant'])) ? $_POST['Identifiant'] : '';
		$pass  = (isset($_POST['Mot de passe']))  ? $_POST['Mot de passe']  : '';

?>

<?php
function erreur($err='')
{
   $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
   exit('<p>'.$mess.'</p><p>Cliquez <a href="indexe.php">ici</a> pour revenir � la page d\'accueil</p></div></body></html>');
}
?>


?>
