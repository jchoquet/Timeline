$(document).ready(function(){

	/* variables modification */

	var surnom = "";
	var avatar = "";
	var omdp = "";
	var nmdp = "";
	var cnmdp = "";
	var quote = "";

	/* Vérification format formulaire inscription */
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


});
