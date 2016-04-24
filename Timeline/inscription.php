<?php

    //On r�cup�re les variables
    $i = 0;
    $temps = time(); 
    $nom=$_POST['Nom'];
    $prenom=$_POST['Pr�nom'];
    $promo = $_POST['Promo'];
    $identifiant = $_POST['Identifiant'];
    $pass = md5($_POST['Mot de passe']);
    $confirmpass = md5($_POST['Confirmer mot de passe']);
	
    //V�rification de l'identifiant
    $query=$db->prepare('SELECT COUNT(*) AS nbr FROM Utilisateur WHERE Identifiant =:Identifiant');
    $query->bindValue(':Identifiant',$identifiant, PDO::PARAM_STR);
    $query->execute();
    $identifiant_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    
    if(!$identifiant)
    {
        $identifiant_erreur1 = "Votre identifiant est d�j� utilis� par un membre";
        $i++;
    }

    if (strlen($identifiant) < 3 || strlen($identifiant) > 15)
    {
        $identifiant_erreur2 = "Votre identifiant doit contenir entre 3 et 15 caracteres ";
        $i++;
    }

    //V�rification du mdp
    if ($pass != $confirmpass || empty($confirmpass) || empty($pass))
    {
        $mdp_erreur = "Votre mot de passe et votre confirmation diff�rent, ou sont vides";
        $i++;
    }
?>
