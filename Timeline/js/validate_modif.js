$(document).ready(function(){

	/* variables modification */

	var surnom = "";
	var avatar = "";
	var omdp = "";
	var nmdp = "";
	var cnmdp = "";
	var quote = "";

	/* Vérification format formulaire modification */
	$("#surnom").keyup(function() {
		
		var tmp = $(this).val();

		/* test vide */
		if(tmp == "")
		{
			$("#surerror").html("");
			surnom = "";
		}
		else if(tmp.length > 20)
		{
			$("#surerror").html("Taille max 20 caractères !");
			surnom = "";
		}
		else
		{
			$("#surerror").html("");
			surnom = tmp;
		}
	});

	$("#nmdp").keyup(function() {

			var tmp = $(this).val();

			if(tmp == "" || (tmp.length < 8)) 
			{
				$("#newMdperror").html("Taille minimale de 8 caractères");
				nmdp = "";
			}
			else
			{
				$("#newMdperror").html("");
				nmdp = tmp;
			}
	});

	$("#mdpc").keyup(function() {
		
			var tmp = $(this).val();

			/* test vide */
			if(tmp == "" || (nmdp !== tmp))
			{
				$("#cnewMdperror").html("Mots de passe différents");
				cnmdp = "";
			}
			else
			{
				$("#cnewMdperror").html("");
				cnmdp = tmp;
			}
	});




	$("#quote").keyup(function() {
		
		var tmp = $(this).val();

		/* test vide */
		if(tmp == "")
		{
			$("#quoteerror").html("");
			quote = "";
		}
		else if(tmp.length > 254)
		{
			$("#quoteerror").html("Taille max 254 caractères !");
			quote = "";
		}
		else
		{
			$("#quoteerror").html("");
			quote = tmp;
		}
	});

});
