<?php 
    
    session_start();
    
    $id=$_SESSION['login'];
    $surnom="";
    $msg="";
    $extension="";

    function surnomUserLeftBar($db, $id) {

      /* On ne prépare pas la requête car l'id est déjà safe */

      $stmt = $db->query("SELECT surnom FROM utilisateur WHERE identifiant='$id'");
      $stmt->setFetchMode(PDO::FETCH_OBJ);
      $stmt = $stmt->fetch();
      return $stmt->surnom;

    }

    function avatarUserLeftBar($db, $id) {

      $stmt = $db->query("SELECT avatar FROM utilisateur WHERE identifiant='$id'");
      $stmt->setFetchMode(PDO::FETCH_OBJ);
      $stmt = $stmt->fetch();
      return $stmt->avatar;

    }

    try{

      /* Connexion à la base de données avec PDO */

       $DB = new PDO("pgsql:host=localhost;dbname=projet_web", "postgres", "root");

      $surnom=surnomUserLeftBar($DB,$id);
      $extension=avatarUserLeftBar($DB,$id);

      if($surnom != "")
      {
        $msg=$surnom;
      }
      else
      {
        $msg="Tanche";
      }

      if($extension != "")
      {
        $avatar="users/avatar/{$id}.{$extension}";
      }
      else
      {
        $avatar="fonts/im_pro.jpg";
      }
      
      $DB = null;
    

    }

    catch(PDOException $e){
      $msg="Database Error";
    }

    /* Rubriques qui n'apparaissent que si on est connecté avec le compte administrateur */
  

    if($id == "administrat"){
      $admin="<li><a href=\"admin_gestion.php\">Gestion</a></li>";
    }
    else{
      $admin="";
    }
    
?>


  <!-- barre de navigation -->
     <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">

        <!-- affichage mobile -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <a class="navbar-brand" href="#">TIMELINE</a>
        </div>

        <!-- regroupage des liens pour faciliter l'affichage mobile -->
        <div class="navbar-collapse collapse" id="navbar">
          <ul class="nav navbar-nav" >
            <li class="m"><a href="acceuil.php">Accueil</a></li>
            <li><a href="soirees.php">Soirées</a></li>
            <li><a href="concours.php">Concours</a></li>
            <li><a href="ajout.php">Ajout</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php echo $admin; ?>
          </ul>
        </div>

      </div>
    </nav>

  <!-- menu gauche -->
  <div id="lmenu" class="container-fluid">
  <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <div class="thumbnail">
            <img alt="profil" src=<?php echo $avatar; ?> />
            <div class="caption">
              <p> <?php echo $msg; ?></p>
            </div>
          </div>
          <ul class="nav nav-sidebar">
            <li><a href="monprofil.php"><span class="glyphicon glyphicon-user"></span>Mon profil</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-camera"></span>Mes posts</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-pushpin"></span>Mes identifications</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-star"></span>Mes wins</a></li>
          </ul>
          <ul class="nav nav-sidebar navbar-static-bottom" id="d">
            <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span>Déconnexion</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
