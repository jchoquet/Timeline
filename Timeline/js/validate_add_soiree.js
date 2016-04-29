$(document).ready(function(){

function validateDate(date) {
    var test = /^(\d{4})[-\/](\d{2})[-\/](\d{2})$/.exec(date);
    if (test == null) return false;
    var d = test[3];
    var m = test[2] - 1;
    var y = test[1] ;
    var nDate = new Date(y, m, d);
    return nDate.getDate() == d &&
            nDate.getMonth() == m &&
            nDate.getFullYear() == y;
}

function getYear(date) {
	var test = /^(\d{4})[-\/](\d{2})[-\/](\d{2})$/.exec(date);
	var y = test[1] ;
	return y;
}

	var date = "";
	var theme = "";
	var description = "";
	var mdp = "";
	var annee = 0;

	
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

		$("#formcorrect").html("");
	});


	$("#date").keyup(function() {
		
		
		var tmp = $(this).val();
		date="";
		annee=0;
		
		$("#dateerror").html("");
		
		
		/* On vérifie si la date est au bon format */

		var possible = validateDate(tmp);
	
		if(possible){
			$("#dateerror").html("");
			date=tmp;
			annee=getYear(tmp);
		}
		else{
			$("#dateerror").html("Format incorrect");	
			date ="";
			annee=0;
		}
	
		$("#formcorrect").html("");
		
	});


	$("#submit").click(function() {

		if ( date == "" || theme == "" || description == "" || annee == 0 || mdp == "")
		{
			$("#formerror").html("Informations incorrectes");
		}
		else{
			$("#formerror").html("");
			$.ajax({

				type:'POST',
				url:'script_add_soiree.php',
				data:"d="+date+"&theme="+theme+"&mdp="+mdp+"&annee="+annee+"&description="+description,
				success:function(msg) {

					if(msg != "OK"){
						$("#formerror").html(msg);
					}
					else{
						$("#formcorrect").html("Soirée ajoutée !");
					}
				}
			});
		}
	});

});

