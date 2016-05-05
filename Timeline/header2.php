<?php 
    
    session_start();
    
    $id=$_SESSION['login'];

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

