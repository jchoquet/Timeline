<?php
session_start();

try{
  $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
}
catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
}


$titre="Connexion à votre compte ";



  $_SESSION['Identifiant'] = '';
	$_SESSION['Mot de passe'] = '';

	if (isset($_POST['Se connecter'])){

  include("debut.php");


if ($login!='') erreur(ERR_IS_CO);

else
{
    $message='';
    if (empty($_POST['Identifiant']) || empty($_POST['Mot de passe']) )   //cas : oublier de remplir un champ
    {
        $message = '<p> veuillez remplir tous les champs</p>
	                  <p>Cliquez <a href="connexion.php">ici</a> pour réessayer</p>';
    }
    else //On vérifie le mot de passe
    {
        $query=$db->prepare('SELECT Mdp, Identifiant FROM Utilisateur WHERE Identifiant = :login');    // login ou Identifiant ! not suure 
        $query->bindValue(':login',$_POST['Identifiant'], PDO::PARAM_STR);                             // login ou Identifiant ! not suure 
        $query->execute();
        $data=$query->fetch();
	if ($data['Mdp'] == md5($_POST['Mot de passe'])){       
	    $_SESSION['Identifiant'] = $data['Identifiant'];
	    $message = '<p>Bienvenue '.$data['Identifiant'].', vous êtes maintenant connecté!</p>' ;
	}
	else // Acces failed !
	{
	    $message = '<p style="color:#FF0000; font-weight:bold;">Une erreur s\'est produite pendant votre identification.<br /> Le mot de passe ou le pseudo entré n\'est pas correcte.</p><p>Cliquez <a href="connexion.php">ici</a> pour reessayer </p>';
	}
    $query->CloseCursor();
    }
    echo $message.'</div></body></html>';

}
}
?>
