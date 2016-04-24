
$(document).ready(function(){

	var nom = "";
	var prenom = "";
	var promo = "";
	var id = "";
	var mdp = "";
	var cmdp = "";

	$("#nom").keyup(function() {
		
		/* get the value of name field */
		var tmp = $(this).val();

		/* test si vide */
		if(tmp == "")
		{
			$("#nomerror").html("Entrez votre nom !");
			nom = "";
		}
		else
		{
			$("#nomerror").html("Ok !");
			nom = tmp;
		}
	});

	$("#prenom").keyup(function() {
		
		
		var tmp = $(this).val();

		/* test si vide */
		if(tmp == "")
		{
			$("#prenerror").html("Entrez votre prénom !");
			prenom = "";
		}
		else
		{
			$("#prenerror").html("Ok !");
			prenom = tmp;
		}
	});

	$("#promo").keyup(function() {
		
		
		var tmp = $(this).val();

		/* test si vide */
		if(tmp == "")
		{
			$("#promoerror").html("Entrez votre promo!");
			promo = "";
		}
		else if (tmp.length != 4)
		{
			$("#promoerror").html("Promo non valide");
			promo = "";
		}
		else
		{
			$("#promoerror").html("Ok !");
			promo = tmp;
		}
	});

	$("#id").keyup(function() {
		
		
		var tmp = $(this).val();

		/* test si vide */
		if(tmp == "")
		{
			$("#iderror").html("Choisissez un identifiant !");
			id = "";
		}
		else
		{
			$("#iderror").html("Ok !");
			id = tmp;
		}
	});

	$("#mdp").keyup(function() {
		
		/* get the value of name field */
		var tmp = $(this).val();

		/* test si vide */
		if(tmp == "" || tmp.length < 8)
		{
			$("#mdperror").html("Taille minimale de 8 caractères");
			mdp = "";
		}
		else
		{
			$("#mdperror").html("Ok !");
			mdp = tmp;
		}
	});

	$("#cmdp").keyup(function() {
		
		/* get the value of name field */
		var tmp = $(this).val();

		/* test si vide */
		if(tmp == "" || (mdp !== tmp))
		{
			$("#cmdperror").html("Confirmez votre mot de passe !");
			cmdp = "";
		}
		else
		{
			$("#cmdperror").html("Ok !");
			cmdp = tmp;
		}
	});

});
