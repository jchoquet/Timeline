<?php

function modal ($button_name, $modal_header, $modal_body, $modal_footer){
 echo '<div class="container">';

    #Trigger the modal with a button
    echo "<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>$button_name</button>";
 
   #Modal
   echo '<div class="modal fade" id="myModal" role="dialog">';
     echo '<div class="modal-dialog">';
     
       #Modal content
       echo '<div class="modal-content">';
         echo '<div class="modal-header">';
           include $modal_header;
         echo '</div>';
         echo '<div class="modal-body">';
           include $modal_body;
         echo '</div>';
         echo '<div class="modal-footer">';
           include $modal_footer;
         echo '</div>';
       echo'</div>';
       
     echo '</div>';
   echo '</div>';
   
 echo '</div>';
}

#usage : modal ("click me", "header.php", "body.php", "footer.php");

?>
