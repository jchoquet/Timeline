<?php

session_start();

/* Récupération du vrai mdp pour vérifier */

$pwd=$_SESSION['pwd'];


if(isset($_POST['oldmdp']) && !isset($_POST['nmdp']))
{

	if($_POST['oldmdp'] == $pwd) {

		echo "OK";
	}
	else{

		echo "Mot de passe incorrect";
	}


}


?>
