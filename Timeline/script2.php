<?php

/* Connexion à la base */

if($DB = pg_connect("host=localhost user=postgres dbname=projet_web password=root"))
{

	/* Si identifiant renseigné */

	if(isset($_POST['identifiant']))
	{
		$id=$_POST['identifiant'];
		$requete="SELECT identifiant FROM utilisateur WHERE identifiant='$id';";
		$result=pg_query($DB,$requete);

		if(pg_num_rows($result) == "1")
		{
			echo "Identifiant déjà pris";
		}
        else{
            echo "OK";
        }
	}
	else
	{
		echo "Problème de requête";
	}
	pg_close($DB);
}
else
{
	echo "Problème de connexion";
}
?>
