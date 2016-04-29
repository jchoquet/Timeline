function fetch_select_theme(val)
{
		  	
  	$.ajax({
  		type:'POST',
  		url:'fetch_select.php',
  		data:"get_option="+val,
  		success:function(msg){

  			$("#theme").html(msg);
  		}

  	});

}
