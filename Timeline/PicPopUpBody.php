 <?php

	# Need variable $pics refering to the id of the photo in the DB
        $pic = $GLOBALS["PicPopUp_pic"];
        #$pic = "1.png";

	# Need variable $db refering to the argument of pg_connect in order to access to the DB
        $db = $GLOBALS["PicPopUp_db"];
        #$db = "";

	$connection = pg_connect ($db);
	
        # List of idconcours, nom, description, Nbvotes for each challenge 	
	$concours = pg_fetch_all( pg_query($connection, "
		SELECT concours.idconcours, nom, description, COUNT (concours.idconcours) as Nbvotes 
		FROM concours LEFT OUTER JOIN vote
		ON concours.idconcours = vote.idconcours
		WHERE encours AND (vot.idphoto = $pic)
		GROUP BY concours.idconcours ;	
		"));	
        $commentaires = pg_fetch_all( pg_query($connection, "
			SELECT surnom, date_post, heure_post, contenu
			FROM commentaire 
			INNER JOIN utilisateur
			ON identifiant = idauteur
			WHERE idphoto = $pic;
			"));


        pg_close($connection);

        #Test===========================================
        #$com1 = array (
        #        "surnom" => "bob",
        #        "date_post" => "16/05/16",
        #        "heure_post" =>"20:12",
        #        "contenu" => "lol !"
        #        );
        #$com2 = array (
        #        "surnom" => "tom",
        #        "date_post" => "15/05/16",
        #        "heure_post" => "19:42",
        #        "contenu" => "enorme on dirait un elephant"
        #        );
        #$com3 = array (
        #        "surnom" => "luc",
        #        "date_post" => "16/05/16",
        #        "heure_post" => "20:14",
        #        "contenu" => "j'aime les hamsters"
        #        );
        #$com4 = array (
        #        "surnom" => "bob",
        #        "date_post" => "17/05/16",
        #        "heure_post" =>"21:12",
        #        "contenu" => "moi aussi"
        #        );
        #$com5 = array (
        #        "surnom" => "tom",
        #        "date_post" => "17/05/16",
        #        "heure_post" => "22:42",
        #        "contenu" => "like moi, je partage"
        #        );
        #$com6 = array (
        #        "surnom" => "luc",
        #        "date_post" => "18/05/16",
        #        "heure_post" => "20:14",
        #        "contenu" => "Quel boulet ce mec ..."
        #        );
        #$commentaire = array($com1,$com2,$com3,$com4,$com5,$com6);
        #=====================================================


        #Tri des commentaires par date
        function cmp($a,$b) {
             if ($a[date_post] == $b[date_post]){
                   return ($a[heure_post] < $b[heure_post]) ? -1 : 1;
              }
             return ($a[date_post] < $b[date_post]) ? -1 : 1 ;
         };
	uasort($commentaire,'cmp');		

	
	#Test================================================
	#$line1 = array(
	#	"nom" => "like",
	#	"description" => "nombre de like",
	#	"Nbvotes" => "5"
	#	);
	#$line2 = array(
	#	"nom" => "trash",
	#	"description" => "la photo la plus hard",
	#	"Nbvotes" => "3"
	#	);
	#$concours = array($line1, $line2);
        #=============================================================


	

  

  echo '<div class="row">';
    echo '<div class="col-sm-8">';

      echo "<img src='$pic' style='width:570px;height:380px;'>";
      echo '<br><br>';

      #Printing buttons (features: badge with actual number of votes, tooltip(hover over) with description of each challenge)
      # TODO : link of the button (update the vote value by sql query, AJAX ?)
      foreach ($concours as $line)
	{	
	   echo "<button class='btn btn-primary' data-toggle='tooltip' title='$line[description]'>$line[nom]  <span class='badge'>$line[Nbvotes]</span></button> ";
        }
    echo '</div>';





    echo '<div class="col-sm-4">';
	echo '<h2>Commentaires</h2><br>';
        echo '<div style="overflow:scroll; height:340px" >';
	  foreach ($commentaire as $com){
	      echo "<p>[$com[heure_post]] $com[surnom] : $com[contenu]</p>";
	  };
	echo '</div>';

    echo '</div>';


    
  echo '</div>';
  ?>

</body>
</html>
