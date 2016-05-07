$(document).ready(function (){

        // Fonction qui permet l'affichage d'une photo en mode pop-up au click
        $('img').click(function () {
            
            $('.media-list').html('');

            var src = $(this).attr('src');
            var idphoto = $(this).attr('id');
            var idsoiree = '<?php echo $idsoiree; ?>';
            
            $('#image-content').html('<div class="thumbnail"><img src="' + src + '" class="img-responsive" /></div>');

            $.ajax({

                type:'POST',
                url:'script_modal.php',
                data:"idsoiree="+idsoiree+"&idphoto="+idphoto,
                success:function(result) {
                    if(result)
                    {
                        resultObj = eval (result);

                        var commentaires = new Array();
                        commentaires = resultObj[0];

                        for (var index in commentaires)
                        {
                            // On récupère un commentaire
                            var com = commentaires[index];

                            // On définit les variables

                            var idcom = com[0];
                            var date_post = com[1];
                            var heure_post = com[2];

                            var tmp = heure_post.split(".");
                            var heure_post2 = tmp[0];

                            var contenu = com[3];
                            var surnom = com[4];
                            var identifiant = com[5];
                            var ext = com[6];

                            var photo = '<a class="pull-left" href="#"><img class="media-object" src="users/avatar/'+identifiant+'.'+ext+'" alt="profile"></a>';
                            var titre = '<h4 class="media-heading text-uppercase reviews">'+surnom+'</h4><p class="media-date text-uppercase reviews ">';
                            var date = date_post+' '+heure_post2+'</p>';
                            var printContenu ='<p class="media-comment">'+contenu+'</p>';


                            $('.media-list').append('<li class="media">'+photo+'<div class="container media-body"><div class="well well-lg">'+titre+date+printContenu+'</div></div></li>');
                           
                        
                
                        }

                    }
                    else
                    {
                        $('.media-list').html('<p>Erreur</p>');
                    }
                }
            });

          
        }); 
    
});