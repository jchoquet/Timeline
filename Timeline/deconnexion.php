<?php
session_start();
session_destroy();
$titre="D�connexion";
include("debut.php");
include("menu.php");

if ($id==0) erreur(ERR_IS_NOT_CO);

echo '<p>Vous �tes � pr�sent d�connect� <br />
Cliquez <a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'">ici</a> 
pour revenir � la page pr�c�dente.<br />
Cliquez <a href="indexe.php">ici</a> pour revenir � la page principale</p>';
echo '</div></body></html>';
?>
