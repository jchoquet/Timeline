<?php

session_start();

$id=$_SESSION['login'];
$extensions_valides=array('jpg','jpeg','gif','png');
$tailleMax= 2097152;

if ($_FILES['avatar']['error'] > 0){
   echo "Erreur lors du transfert";
}
else
{

  if ($_FILES['avatar']['size'] > $tailleMax)
  {
    echo "Le fichier est trop gros";
  }
  else
  {
      $extension_upload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
      if ( !in_array($extension_upload,$extensions_valides) ) 
      {
        echo "Extension incorrecte (jpg, jpeg, gif, png)";
      }
      else
      {

        $chemin ="users/avatar/{$id}.{$extension_upload}";
        $resultat= move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
        if($resultat)
        {
          echo "Upload réussi";
        }
        else
        {
          echo "Problème transfert fichier";
        }
      }

  }
}

?>






