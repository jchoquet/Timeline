$(document).ready(function(){

	/* variables inscription */

	var nom = "";
	var prenom = "";
	var promo = "";
	var id = "";
	var mdp = "";
	var cmdp = "";

	/* variables connexion */

	var idc = "";
	var mdpc = "";

	/* Vérification format formulaire inscription */

	$("#nom").keyup(function() {
		
		var tmp = $(this).val();

		/* test vide */
		if(tmp == "")
		{
			$("#nomerror").html("Entrez votre nom ");
			nom = "";
		}
		else
		{
			$("#nomerror").html("");
			nom = tmp;
		}
	});

	$("#prenom").keyup(function() {
		
		var tmp = $(this).val();

		/* test vide */
		if(tmp == "")
		{
			$("#prenerror").html("Entrez votre prénom ");
			prenom = "";
		}
		else
		{
			$("#prenerror").html("");
			prenom = tmp;
		}
	});

	$("#promo").keyup(function() {
		
		
		var tmp = $(this).val();

		/* test vide */
		if(tmp == "")
		{
			$("#promoerror").html("Entrez votre promo");
			promo = 0;
		}
		else if (tmp.length != 4)
		{
			$("#promoerror").html("Format : YYYY");
			promo = "";
		}
		else if (tmp > 2018 || tmp < 1990)
		{
			$("#promoerror").html("Promo entre 1990 et 2018");
			promo = "";
		}
		else
		{
			$("#promoerror").html("");
			promo = tmp;
		}
	});

	$("#identifiant").keyup(function() {
		
		
		var tmp = $(this).val();

		/* test vide */
		if(tmp == "")
		{
			$("#iderror").html("Choisissez un identifiant");
			id = "";
		}
		else if(tmp.length != 11)
		{
			$("#iderror").html("Format : 11 caractères");
			id = "";
		}
		else
		{
			$("#iderror").html("");
			id=tmp;
		}
	});

	$("#mdp").keyup(function() {

		var tmp = $(this).val();

		if(tmp == "" || (tmp.length < 8)) 
		{
			$("#mdperror").html("Taille minimale de 8 caractères");
			mdp = "";
		}
		else
		{
			$("#mdperror").html("");
			mdp = tmp;
		}
	});

	$("#cmdp").keyup(function() {
		
		var tmp = $(this).val();

		/* test vide */
		if(tmp == "" || (mdp !== tmp))
		{
			$("#cmdperror").html("Mots de passe différents");
			cmdp = "";
		}
		else
		{
			$("#cmdperror").html("");
			cmdp = tmp;
		}
	});




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



	$("#inscription").click(function() {

	/* Les tests de formats ont déjà été effectués en JS, 
	le champ est vide si le format ne correspond pas */
	if(nom = "" || prenom = "" || promo = "" || id = "" || mdp = "" || cmdp = "")
	{
		$("#formerror").html("Formulaire incorrect");
	}
	else
	{
		$("#formerror").html("Good");
	}

	});


});