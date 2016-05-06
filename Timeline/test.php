<?php 
	
	session_start();

	$annee = $_POST['annee'];
	$name = $_POST['theme'];

	/* On doit chopper les photos de l'id soiree du ocup changer le truc d'en dessous pour chopper l'id */

	/* apres on se connecter pour chopper where id soirre = machin
		il faut extension idphoto, com posteur, surnom posteur, heure */

    function getThemeSoiree($db, $name, $annee) {

      $stmt = $db->query("SELECT theme FROM soiree WHERE name='$name' AND annee='$annee'");
      $stmt->setFetchMode(PDO::FETCH_OBJ);
      $stmt = $stmt->fetch();
      return $stmt->theme;
    }

    function getIdSoiree($db, $name, $annee) {

      $stmt = $db->query("SELECT idsoiree FROM soiree WHERE name='$name' AND annee='$annee'");
      $stmt->setFetchMode(PDO::FETCH_OBJ);
      $stmt = $stmt->fetch();
      return $stmt->idsoiree;
    }

    function getPhotosSoiree($db, $idsoiree) {

        $stmt = $db->query("SELECT photo.idphoto, photo.extension, photo.composteur, photo.heure, utilisateur.surnom FROM photo INNER JOIN utilisateur ON photo.idposteur=utilisateur.identifiant WHERE idsoiree='$idsoiree' ORDER BY photo.heure ASC");
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $result = $stmt->fetchAll();
        return $result;
    }

    function orderPhoto($tab) {

    	 $avantMinuit = array();
    	 $apresMinuit = array();

    	 foreach ($tab as $pic)
    	 {
    	 	

    	 	if( strtotime($pic[3]) < strtotime("12:00:00"))
    	 	{
    	 		$apresMinuit[] = $pic;
    	 	}
    	 	else
    	 	{
    	 		$avantMinuit[] = $pic;
    	 	}
    	 }

    	 $result = array();

    	 foreach ($avantMinuit as $a) 
    	 {
    	 	$result[] = $a;
    	 }
    	 foreach ($apresMinuit as $b) 
    	 {
    	 	$result[] = $b;
    	 }

    	 return $result;

    }

    function test($tab) {

	  	foreach($tab as $a)
	  	{
	  			

	  			echo $a[0].$a[1].$a[2].$a[3]. PHP_EOL;
	  		
	  	}
  	}

    function printTimeline($tab, $annee, $name) {

      // $tab[0] idphoto
      // 1 extension
      // 2 com
      // 3 heure
      // 4 surnom posteur

      $test = orderPhoto($tab);
      

       $i=0;
       foreach ($test as $pic)
       {

        if($i == 0)
        {

          
          $heure = date("H", strtotime($pic[3]));
          echo $heure;
          $oldHeure = date("H", strtotime("23:00:00"));
          echo $oldHeure;
          if(($heure - $oldHeure) == -1)
          {
            echo "lol";
          }
          else
          {
            echo "xd";
          }
        // }
        // else
        // {
        //   $oldHeure=$heure;
        //   $tmp=explode(":",$pic[3]);
        //   $heure=$tmp[0];
          
        //   $test = explode(":",date('H:i', $heure - $oldHeure));
          
          
         }
         $i=$i+1;
      }
    }
  try{

      /* Connexion à la base de données avec PDO */

       $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

       $theme = getThemeSoiree($DB,$name,$annee);
       $idsoiree = getIdSoiree($DB,$name,$annee);

       $tabPhotos = getPhotosSoiree($DB,$idsoiree);


       printTimeline($tabPhotos,$annee,$name);

       $DB = null;
    	


    }

    catch(PDOException $e){
       echo "Database Error";
    }

?>