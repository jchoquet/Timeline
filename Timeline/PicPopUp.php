<?php
   $PicPopUp_pic;
   $PicPopUp_d;
   function PicPopUp ($name,$pic, $db) {
      $GLOBALS["PicPopUp_pic"] = $pic;
      $GLOBALS["PicPopUp_db"] = $db;
      include "modal.php";
      modal($name, "PicPopUpHeader.php", "PicPopUpBody.php", "PicPopUpFooter.php"); 
   };
   

   #== usage : ======================================
   #PicPopUp ("PopUpClicSurPhoto","1.png", "");

   #echo "<a data-toggle='modal' data-target='#PopUpClicSurPhoto'>MyAwesomeLink</a><br>";
   #== OR ===
   #echo "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#PopUpClicSurPhoto'>MyAwesomeButton</button><br>";
   #===============================================

?>
    
 