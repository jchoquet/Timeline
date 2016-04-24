<?php

session_start();

function config() {

    $_SESSION['nomhote']="host";
    $_SESSION['nomBase']="projet_web";
    $_SESSION['nomuser']="postgres";
    $_SESSION['mdp']="root";
}

$nomhote=$_SESSION['nomhote'];
$nomuser=$_SESSION['nomuser'];
$nomBase=$_SESSION['nomBase'];
$mdp=$_SESSION['mdp'];


/* Connexion à la base de données */

if($DB = pg_connect("host=$nomhote user=$nomuser dbname=$nomBase password=$mdp")){
    

	if(isset($_POST['identifiant']))
	{
		$identifiant = $_POST['identifiant'];
		
		/* Sécurité */

        
		$identifiants = pg_escape_string($DB, $identifiant);

		/* On checke si l'identifiant n'existe pas déjà */

        $requete="SELECT identifiant from utilisateur WHERE identifiant='$identifiant'";
		$result = pq_query($DB,$requete);

		if(pg_num_rows($result) == 1)
		{
			echo "existe";
		}
        else{
            echo "OK";
        }

        pg_close($DB);
	}
}
else{
    	echo "Database error";
}    

?>
