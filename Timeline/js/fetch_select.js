function fetch_select_theme(val)
{
		  	
  	$.ajax({
  		type:'POST',
  		url:'fetch_data_del_soiree.php',
  		data:"get_option="+val,
  		success:function(msg){

  			$("#theme").html(msg);
  		}

  	});

}
