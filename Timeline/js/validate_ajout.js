$(document).ready(function(){


$("#commentaire").keyup(function() {
		
		var tmp = $(this).val();

		/* test vide */
		if(tmp == "")
		{
			$("comerror").html("");
		}
		else if(tmp.length > 254)
		{
			$("#comerror").html("Taille max 299 caractères !");
		}
		else
		{
			$("#comerror").html("");
		}
	});

});

