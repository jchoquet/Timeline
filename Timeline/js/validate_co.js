$(document).ready(function(){

	/* variables connexion */

	var idc = "";
	var mdpc = "";


	$("#mdpc").keyup(function() {

		var tmp = $(this).val();

		if(tmp == "" || (tmp.length < 8)) 
		{
			$("#mdperrorc").html("Taille minimale de 8 caractères");
			mdpc = "";
		}
		else
		{
			$("#mdperrorc").html("");
			mdpc = tmp;
		}
	});

	$("#identifiantc").keyup(function() {
		
		
		var tmp = $(this).val();

		/* test vide */
		if(tmp == "")
		{
			$("#idcerror").html("");
			idc = "";
		}
		else if(tmp.length != 11)
		{
			$("#idcerror").html("Format : 11 caractères");
			idc = "";
		}
		else
		{
			$("#idcerror").html("");
			idc = tmp;
		}
	});

});
