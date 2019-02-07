
var li;

$(document).ready(function(){
	
	
	li=links();

	
	
});






$("#in_complete_edit").click(function(){
	
	
	
	
	var gross_amount=$("#gro_amount").val();
	var taka=$("#dis_taka").val();
	var per=$("#dis_per").val();
	var cash=$("#cash_pur").val();
	var card=$("#card_pur").val();
	var type=$("#type").val();
	var invoice=$("#invoice").val();
	
	var p_type=$("#in_complete_edit").val();
	if(p_type == 1 || p_type == 2){
		
		var supplier=$("#supplier").val();
	}
	else{
		
		var supplier=$("#customer").val();
		
	}
	
	
	
	
	
	var gross_discount=$("#check_gross").val();
	var exchange=$("#check_change").val();	


if(gross_amount == '' || invoice == '' || supplier == ''){
		
		
		alert('information incomplete..');
		
	}
	else{
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url: li+'jquery_data/purchase_update/',
		data:{gross_amount:gross_amount,taka:taka,per:per,cash:cash,type:type,invoice:invoice,supplier:supplier,gross_discount:gross_discount,exchange:exchange,card:card,p_type:p_type},
		success:function(data)
		{
			
			if(data.id == 1){
				
				
				alert('please again login....');
			}
			else{
				
				alert('Update Complete');
				
				window.location="http://localhost/accounts/mains/daily_sale_report/";
				
			}
			
			
			
				
					


				
						
				
			
			
			
			
			
			
		},
		error:function(error)
		{
			alert("Server Error");
		}
	});
		
		
		
	}


		
});


$("#pur_complete_invoice").click(function(){
	
	
	var product=$("#product").val();
	var qun=$("#qun").val();
	var price=$("#price").val();
	var invoice=$("#invoice").val();
	
	var type=$("#pur_complete_invoice").val();
	var ch="";
	var links="";
	var supp="";
	if(type == 1 || type == 2){
		
		 supp=$("#supplier").val();	
		 ch="supplier";
			links= li+'jquery_data/product_add/';
	}
	else if(type == 3 || type == 4){
		
		 supp=$("#customer").val();	
			
		links= li+'jquery_data/product_add/';
		ch="customer";
	}
	else{
		
		 supp=$("#customer").val();	
			
		links= li+'jquery_data/product_add_issu/';
		ch="customer";
		
	}
	
	
	$("#in_complete").show();
	$("#"+ch).attr('readonly','readonly');
	
	
	
	if(product == '' || qun == '' || price == '' || invoice == '' || supp == ''){
		
		
		alert('information incomplete..');
		
	}
	else{
		
		

		
		
		
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url:links,
		data:{product:product,qun:qun,price:price,invoice:invoice,supp:supp,type:type},
		success:function(data)
		{
			
			$("#product").val('');
			$("#product").focus();
			$("#qun").val('');
			
			
			if(data.id != 0){
				
				
				if(type != 5)
					table_data_add(data,type);
				else
					table_data_add2(data,type);


			}
			else{
				
				
				alert('please agine login....');
				
			}
			
					

				
						
				
			
			
			
			
			
			
		},
		error:function(error)
		{
			alert("Server Error");
		}
	});
		
		
	}
	
	
	
});


$("#update_invoice").click(function(){
	
		var invoice=$("#invoice").val();
		var date=$("#pdate").val();
		
		var supp="";
		var ch="";
		var type=$("#update_invoice").val();
		
		var store=$("#store").val();
		
		
		if(typeof store == 'undefined')
			store=0;
		
		
		if(type == 1 || type == 2){
		
		 supp=$("#supplier").val();	
		 ch="supplier";
			
		}
		else if(type == 3 || type == 4 || type == 12){
		
		 supp=$("#customer").val();	
		 ch="customer";
			
		}
		
		
		
		
		
		if(invoice == '' || date == '' || type == '' || supp == ''){
			
			
			alert('Incomplete Information');
			
			
		}
		
		else{
		
		
		
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url: li+'transaction/invoice_admin_update/',
		data:{store:store,invoice:invoice,supp:supp,date:date,type:type},
		success:function(data)
		{
	
				alert('updated');
	
	
			$("#in_complete").show();
			$("#in_complete").val(type);
	
	
		},
		error:function(jqXHR, textStatus, errorThrown)
		{
			//alert("Server Error");
				if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.'+textStatus);
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found.'+textStatus);
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error.'+textStatus);
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











function product_up_in(id)
		{
			
			
		var qun=$("#"+id+"q").val();
		var price=$("#"+id+"p").val();
		var invoice=$("#invoice").val();
		//var ty=$("#pur_complete_invoice").val();
		var ty=$("#pur_complete").val();
		
		
	
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url: li+'transaction/product_update2/',
		data:{id:id,qun:qun,price:price,invoice:invoice,ty:ty},
		success:function(data)
		{
			
			var am=price * qun;
			document.getElementById(id+"a").innerHTML=am;
			
			$("#gro_amount").val(data.price);
			setGrossAmToCash();
			
		},
		error:function(xhr, status)
		{
			alert(status);
		}
	});	
			
			
		}



