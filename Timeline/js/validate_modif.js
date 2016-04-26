$(document).ready(function(){

	/* variables modification */

	var surnom = "";
	var avatar = "";
	var omdp = "";
	var nmdp = "";
	var cnmdp = "";
	var quote = "";

	/* Vérification format formulaire avant modification */
	
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

	$("#omdp").keyup(function() {

		var tmp = $(this).val();

		if(tmp == "" || (tmp.length < 8)) 
		{
			$("#oldMdperror").html("Rappel format : Taille >= 8 caractères");
			omdp = "";
		}
		else
		{
			$("#oldMdperror").html("");
			$.ajax({

				type:'POST',
				url:'scriptm.php',
				data:"oldmdp="+tmp,
				success:function(msg){

				    if(msg == "OK")
				    {
					$("#oldMdperror").html("");
					omdp = tmp;
				    }
				    else
				    {
					$("#oldMdperror").html(msg);
					omdp = "";
				    }
				}
			});
		}
	});


	$("#modifB").click(function() {

		if ( surnom == "" || avatar == "" || omdp == "" || nmdp == "" || cnmdp == "" || quote == "")
		{
			$("#formerror").html("Informations incorrectes");
		}
		else{
			$("#formerror").html("");
			$.ajax({

				type:'POST',
				url:'scriptm.php',
				data:"surnom="+surnom+"&avatar="+avatar+"&nmdp="+nmdp+"&quote="+quote,
				success:function(msg) {

					if(msg != "OK"){
						$("#formerror").html(msg);
					}
					else{
						$("#formcorrect").html("Modifications prises en compte !");
					}
				}
			});
		}
	});
	



});
