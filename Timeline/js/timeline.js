$(document).ready(function(){
    var my_posts = $("[rel=tooltip]");

    var size = $(window).width();
    for(i=0;i<my_posts.length;i++){
        the_post = $(my_posts[i]);

        if(the_post.hasClass('invert') && size >=767 ){
            the_post.tooltip({ placement: 'left'});
            the_post.css("cursor","pointer");
        }else{
            the_post.tooltip({ placement: 'rigth'});
            the_post.css("cursor","pointer");
        }
    }

// Fonction qui permet de scroller la timeline vers une heure
    $.each($('.scroll-button'), function (index, value) {
        var id = $(this).attr('id');
        var tmp = id.split('_');
        var cible = tmp[1];
        $("#"+id).click(function (){
            $('html, body').scrollTop($("#"+cible).offset().top - 100);
        });
    });
    
});