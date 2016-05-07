$(document).ready(function (){

        // Fonction qui permet l'affichage d'une photo en mode pop-up au click
        $('img').click(function () {
            
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
                        
                        // for(var index in resultObj)
                        // {
                        //     alert("index:"+index+"value"+resultObj[index]);
                        // }

                        // var commentaire = resultObj[2];

                        var commentaire = new Array();
                        commentaire = resultObj[2];
                        $('#com-content').html('');
                        for (var index in commentaire)
                        {
                            $('#com-content').append(commentaire[index]);
                        }

                    }
                    else
                    {
                        $('#com-content').html("Erreur");
                    }
                }
            });

          
        }); 
    
});