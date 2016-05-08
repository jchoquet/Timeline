$(document).ready(function(){

	var nom = "";
	var description = "";
	var mdp = "";

	
	$("#description").keyup(function() {
		
		var tmp = $(this).val();

		/* test vide */
		if(tmp == "")
		{
			$("#descrierror").html("");
			description = "";
		}
		else if(tmp.length > 299)
		{
			$("#descrierror").html("Taille max 299 caractères !");
			description = "";
		}
		else
		{
			$("#descrierror").html("");
			description = tmp;
		}

		$("#formcorrect").html("");
	});



	
	$("#nom").keyup(function() {
		
		var tmp = $(this).val();

		/* TODO : test pas d'espace, pas de caractères chelous, pas de virgules, format : soiree_or par exemple */

		if(tmp == "")
		{
			$("#nomerror").html("");
			name= "";
		}
		else if(tmp.length > 20)
		{
			$("#nomerror").html("Taille max 20 caractères !");
			name = "";
		}
		else
		{
			$("#nomerror").html("");
			name = tmp;
		}

		$("#formcorrect").html("");
		
	});

	$("#mdp").keyup(function() {

		var tmp = $(this).val();

		if(tmp == "" || (tmp.length < 8)) 
		{
			$("#mdperror").html("Rappel format : Taille >= 8 caractères");
			mdp = "";
		}
		else
		{
			$("#mdperror").html("");
			mdp = tmp;
		}

		$("#formcorrect").html("");
	});


	
	$("#submit").click(function() {

		if (  nom == "" || description == "" ||  mdp == "")
		{
			$("#formerror").html("lol");
		}
		else{
			$("#formerror").html("");
			$.ajax({

				type:'POST',
				url:'script_add_concours.php',
				data:mdp="+mdp+"&description="+description+"&nom="+nom,
				success:function(msg) {

					if(msg != "OK"){
						$("#formerror").html(msg);
					}
					else{
						$("#formcorrect").html("Concours ajouté !");
					}
				}
			});
		}
	});

});

