$(document).ready(function(){

	/* variables inscription */

	var nom = "";
	var prenom = "";
	var promo = 0;
	var id = "";
	var mdp = "";
	var cmdp = "";

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
			promo = 0;
		}
		else if (tmp > 2018 || tmp < 1990)
		{
			$("#promoerror").html("Promo entre 1990 et 2018");
			promo = 0;
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
		if(tmp == "" || tmp.length != 11)
		{
			$("#idcorrect").html("");
			$("#iderror").html("Format : 11 caractères");

			id = "";
		}
		else
		{

			$("#iderror").html("");
			$.ajax({

				type:'POST',
				url:'scripti.php',
				data:"identifiant="+tmp,
				success:function(msg){

				    if(msg == "OK")
				    {
					$("#idcorrect").html("OK");
					$("#iderror").html("");
					id = tmp;
				    }
				    else
				    {
					$("#iderror").html(msg);
					$("#idcorrect").html("");
					id = "";
				    }
				}
			});
			
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


	$("#inscription").click(function() {

		if ( cmdp == "" || mdp == "" || id == "" || promo == 0 || nom == "" || prenom == "")
		{
			$("#formerror").html("Informations incorrectes");
		}
		else{
			$("#formerror").html("");
			$.ajax({

				type:'POST',
				url:'scripti.php',
				data:"nom="+nom+"&prenom="+prenom+"&mdp="+mdp+"&id="+id+"&promo="+promo,
				success:function(msg) {
					$("#formerror").html(msg);
				}
			});
		}
	});


});

