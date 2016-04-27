$(document).ready(function(){


	var date = "";
	var theme = "";
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
	});


	$("#theme").keyup(function() {
		
		var tmp = $(this).val();

		/* test vide */
		if(tmp == "")
		{
			$("#themeerror").html("");
			theme= "";
		}
		else if(tmp.length > 20)
		{
			$("#themeerror").html("Taille max 20 caractères !");
			theme = "";
		}
		else
		{
			$("#themeerror").html("");
			theme = tmp;
		}
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
			$.ajax({

				type:'POST',
				url:'script_add_soiree.php',
				data:"mdp="+tmp,
				success:function(msg){

				    if(msg == "OK")
				    {
					$("#mdperror").html("");
					mdp = tmp;
				    }
				    else
				    {
					$("#mdperror").html(msg);
					mdp = "";
				    }
				}
			});
		}
	});


	/* Le code marche jusque ici, problème sur la validation de la date */

	/*$("#date").keyup(function() {
		
		
		var tmp = $(this).val();

		if(tmp == "")
		{
			$("#dateerror").html("Entrez la date de la soiree");
			date = "";
		}
		else
		{
			$("#dateerror").html("la");
			var reg = /^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/g;
			var rep = tmp.match(reg);
			if(rep){
				$("#dateerror").html("oui");
				date=tmp;
			}
			else{
			    $("#dateerror").html("NOfiE");
				date="";
			}
			
		}
		
	});*/


});

