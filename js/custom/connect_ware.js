

var li=links();

$("#connect").click(function(){
	
	
	var i=$(this);
	
	var c=confirm("Are you sure ?");
	
	if(c == true){
		
		i.text("Loading.....");
		i.attr("disabled",true);
		
		var w=$("#wl").val();
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'product_con/connectedToWare/',
		data:{w:w},
		success:function(data)
		{
			if(data == 0)
				alert("Already Connected.");
			
			
			i.text("Submit");
			i.attr("disabled",false);
	
		},
		error:function(jqXHR, textStatus, errorThrown)
		{
			//alert("Server Error");
				if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found.');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error.');
                } else if (errorThrown === 'parsererror') {
                    alert('Requested JSON parse failed');
                } else if (errorThrown === 'timeout') {
                    alert('Time out error');
                } else if (errorThrown === 'abort') {
                    alert('Ajax request aborted ');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText);
                }

		}
		  
		  
	});
		
		
	}
	
	
});