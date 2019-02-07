
var li;
var vv;

$(document).ready(function(){
	
	li=links();
	vv=0;
	
});



$("#tag")
      .keyup(function(){
		  
		  var v=$("#tag").val();
		  
		    if(v != ''){
				
				  $('#tag').addClass('ac_loading');
				
				
				$("#tag").autocomplete({
    source: function( request, response ) {
		
		 $.ajax({
		
		type:'POST',
		dataType:'json',
		url:li+'transaction/autocomplete_view/',
		data:{id:v},
		success:function(data)
			{
	
	
	   response(data);
	  
	  
			}
				});
					
					
	$("#tag").removeClass('ac_loading');
	
	
	
	
	
			}
		
		
		 });
			}
		 
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
	  });











$("#service_product")
      .keyup(function(){
		  
		  var v=$("#service_product").val();
		  
		    if(v != ''){
				
				  $('#service_product').addClass('ac_loading');
				
				
				$("#service_product").autocomplete({
    source: function( request, response ) {
		
		 $.ajax({
		
		type:'POST',
		dataType:'json',
		url:li+'transaction/getServiceLedger/',
		data:{id:v},
		success:function(data)
			{
	
	
	   response(data);
	  
	  
			}
				});
					
					
	$("#service_product").removeClass('ac_loading');
	
	
	
	
	
			}
		
		
		 });
			}
		 
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
	  });









$( "#product" ).unbind('keyup').bind('keyup',function(event){
	
		var v=$( "#product" ).val();

		  
		  if(v != ''){
			   
			   $('#product').addClass('ac_loading');
	   
	  
	   
	    vv++;
		
		 if($("#check").is(':checked')){
	   
	  
      	if(vv == 1){

              $.ajax({
		type:'POST',
		dataType:'json',
		url:li+'transaction/getCode',
		 data:{v:v},
		 success:function(data)
		 {

               

				
					var type=parseInt($("#pur_complete").val());

				
				
			
					
					 $("#product").val(data.name+"*"+data.code);
					 $("#qun").val(1);
					
					 if(type == 1 || type == 2)
					 $("#price").val(data.buy);
					 else
					 $("#price").val(data.sell);
				
				      
				        retail();
				
				        $('#product').removeClass('ac_loading');
				
				
			
				

	   
		},
	error:function(jqXHR, textStatus, errorThrown)
		{
			

		}
		});

			  
		}
		else{


                       
					
			vv=0;


					
		}

	   

	   
	   
			
	   
	   
	   
		}
		else{
			
		
			$("#product").autocomplete({
    source: function( request, response ) {
		
		 $.ajax({
		
		type:'POST',
		dataType:'json',
		url:li+'transaction/getProductList/',
		data:{id:v},
		success:function(data)
			{
	
	
	   response(data);
	  
	  
			}
				});
					
					
	$("#product").removeClass('ac_loading');
	
	
	
	
	
			}
		
		
		 });
			
			
			
		}
	   
	   
	   
		
			  
		  }
		  
	   
	   
	   
	  });





$('#check').change(function(event)
	{

		if($(this).is(':checked'))
		var i=1;
		else
			var i=0;
		
		
			$.ajax({
	type:'POST',
	dataType:'json',
	url:li+'transaction/update_barcode',
	data:{i:i},
	success:function(data)
	{
			
			
			
	}
			
	});

	});


function customer_and_supplier(){
	
	
	var val=$("#cs").val();
	autocom(val,0);
}
	

$("#customer").keyup(function(){
	
	
	
	var val=$("#customer").val();
	
	autocom(val,1);
	
	
});


$("#supplier").keyup(function(){
	
	
	var val=$("#supplier").val();
	

	
		autocom(val,2);
	
	
});


function autocom(val,t){
	
	var b="";
	
	
	
	if(t == 0){
		
		$('#cs').addClass('ac_loading');
		b="cs";
	}
	else if(t == 1){
		$('#customer').addClass('ac_loading');
		b="customer";
		
	}
		 
	 else{
		 
		$('#supplier').addClass('ac_loading'); 
		b="supplier"; 
		
	 }
		  
	
	if(val != ''){
		
		
		
		
	$("#"+b).autocomplete({
    source: function( request, response ) {
		
		 $.ajax({
		
		type:'POST',
		dataType:'json',
		url:li+'transaction/getSupplierList/',
		data:{val:val,t:t},
		success:function(data)
			{
	
	
	   response(data);
	  
	  
			}
				});
					
					
	$('#'+b).removeClass('ac_loading');
	
	
	
	
	
			}
		
		
		 });
		
	 }

}
  // });

	 
		
		/*$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'transaction/getSupplierList/',
		data:{val:val,t:t},
		success:function(data)
			{
	
	
			$("#"+b).autocomplete({
				
				source: function( request, response ) {
				
				source: data
	  
	  
	  
				}
				});
					
					
	$('#'+b).removeClass('ac_loading');
	
	
	
	
	
			},
		error:function(jqXHR, textStatus, errorThrown)
		{
			if (jqXHR.status === 0)
			{
              alert('Not connect.\n Verify Network.');
              } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404] - Click \'OK\'');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error. [500] - Click \'OK\'');
                } else if (errorThrown === 'parsererror') {
                    alert('Requested JSON parse failed - Click \'OK\'');
                } else if (errorThrown === 'timeout') {
                    alert('Time out error - Click \'OK\' and try to re-submit your responses');
                } else if (errorThrown === 'abort') {
                    alert('Ajax request aborted ');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
                }

		}
	
	
		});*/
	
	
	//}
	
	
	
	
	
	
	
//}


/*function autocom(val,type){
	
	
	if(type == 1)
		 $('#customer').addClass('ac_loading');
	 else
		  $('#supplier').addClass('ac_loading');
	
	
	alert(val);
	
	
	
	if(val != ''){
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'jquery_data/getProductPriceType/',
		data:{product:product,ty:ty},
		success:function(data)
		{
			
			
			
		},
		error:function(jqXHR, textStatus, errorThrown)
		{
			if (jqXHR.status === 0)
			{
              alert('Not connect.\n Verify Network.');
              } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404] - Click \'OK\'');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error. [500] - Click \'OK\'');
                } else if (errorThrown === 'parsererror') {
                    alert('Requested JSON parse failed - Click \'OK\'');
                } else if (errorThrown === 'timeout') {
                    alert('Time out error - Click \'OK\' and try to re-submit your responses');
                } else if (errorThrown === 'abort') {
                    alert('Ajax request aborted ');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
                }

		}
		
	}
	
	}
}*/