$(document).ready(function(){

	var mdp="";
	var theme="";
	var annee=0;

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
				url:'script_del_soiree.php',
				data:"mdp="+tmp,
				success:function(msg){

				    if(msg == "OK")
				    {
					$("#mdperror").html("OK");
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
		$("#formcorrect").html("");	
	});


	$("#theme").change(function() {

		var tmp = $(this).val();

		if(tmp == "")
		{
			theme="";
		}
		else
		{
			theme=tmp;
		}
		$("#formcorrect").html("");	
	});


	$("#annee").change(function() {

		var tmp = $(this).val();

		if(tmp == "")
		{
			annee=0;
		}
		else
		{
			annee=tmp;
		}

		$("#formcorrect").html("");		
	});


	$("#submit").click(function() {

		if ( mdp == "" || theme == "" || annee == 0)
		{
			$("#formerror").html("Informations incorrectes");
		}
		else{
			$("#formerror").html("");
			$.ajax({

				type:'POST',
				url:'script_del_soiree.php',
				data:"mdp="+mdp+"&theme="+theme+"&annee="+annee,
				success:function(msg) {

					if(msg != "OK"){
						$("#formerror").html(msg);
					}
					else{
						$("#formcorrect").html("Soirée supprimée !");
					}
				}
			});
		}
	});


});




