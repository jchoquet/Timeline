<?php

echo '<div id="myModal" class="modal fade" role="dialog">';
echo '<div class="modal-dialog modal-lg">';

echo '<div class="modal-content">';

echo '<div class="modal-header">';
echo '<button type="button" class="close" data-dismiss="modal">&times;</button>';
echo '<h4 class="modal-title"></h4>';
echo '</div>';

echo '<div class="modal-body">';
echo '<div class="row">';
echo '<div class="col-lg-12 col-sm-12" id="image-content">';

echo '</div>';
echo '<div class="col-lg-12 col-sm-12 hidden-xs">';
echo '<div>';
echo '<div id="com-content" class="container-fluid">';
echo '<div class="row">';

echo '<div class="comment-tabs">';
echo '<ul class="nav nav-tabs" role="tablist">';
echo '<li class="active"><a href="#list-comment" role="tab" data-toggle="tab"><h4>Commentaires</h4></a></li>';
echo '<li><a href="#add-comment" role="tab" data-toggle="tab"><h4>Ajouter un commentaire</h4></a></li>';
echo '</ul>';            
echo '<div class="tab-content"> ';
echo '<div class="tab-pane active" id="list-comment">';                
echo '<ul class="media-list" style="overflow-y: scroll; max-height: 240px;">';

echo '</ul>';
echo '</div>';      
echo '<div class="tab-pane" id="add-comment">';
echo '<form action="#" method="post" class="form-horizontal" id="commentForm" role="form">'; 
echo '<div class="form-group">';
echo '<label for="addComment" class="col-sm-2 control-label">Commentaire</label>';
echo '<div class="col-sm-10">';
echo '<textarea class="form-control" name="addComment" id="addComment" rows="5"></textarea>';
echo '</div>';
echo '</div>';
echo '<div class="form-group">';
echo '<div class="col-sm-offset-2 col-sm-10">';                    
echo '<button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span>Envoyer</button>';
echo '<span class="errors" id="formerror"></span>';
echo '<span class="correct" id="formcorrect"></span>';
echo '</div>';
echo '</div>';         
echo '</form>';
echo '</div>';

echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '</div>';

echo '</div>';
echo '</div>';

echo '<div class="modal-footer">';
echo '<button class="btn btn-primary vote" data-toggle="tooltip" title="Vote pour la photo la plus trash">Trash<span class="badge trash">0</span></button>';
echo '<button class="btn btn-primary vote" data-toggle="tooltip" title="Vote pour la photo où ça pécho sec">Love<span class="badge love">0</span></button>';
echo '<button class="btn btn-primary vote" data-toggle="tooltip" title="Photo de toute beauté" id="like">Like<span class="badge like">0</span></button>';
echo '</div>';

echo '</div>';

echo '</div>';
echo '</div>';

?>