 
 var li=links();
 
 function trans_submit(th){
	 
	 
	 var c=confirm("Are you sure to complete ?");
	 if(c == true){
		 
	
	var gross=$("#gro_amount").val();
	var invoice=$("#invoice").val();
		
	if(gross != 0 && invoice != '' && invoice != 0){

		 $(th).text("Loading.....");
		 $(th).attr("disabled",true);
		 
	
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'mains/confirm_transfer',
		data:{invoice:invoice,gross:gross},
		success:function(data)
		{
	
	
			window.location=li+"mains/product_transfer";
	
		
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
		
	 }
	 
 }
 
 
 function table_data_add(data,c)
{	
	var stuff="";
	var classs="";
	var i=0;
	var gross=0;	
	var read="";

	
	var names="";
	var inv=0;
	
	$.each(data.inv,function(key,val)
			{
				inv=val.id;

	
			});
	$.each(data.posts,function(key,val)
			{
				
				
			
				
				if(i == 0){
					classs="success";
					i++;
				}
				else if(i == 1){
					
					classs="danger";
					
					i++;
				}
				else{
					
					classs="info";
					i=0;
				}
				
				//alert(val.t_r);
				
				var count=0;
				var display_row="none";
				var reads="";
				var re_amount=0;
				
				
				
					gross=parseFloat(gross) + parseFloat(val.amount);
				
					names=val.name;
				
				stuff=stuff+"<tr class="+classs+" id='"+val.id+"tr'>"
					
				+"<td>"+val.code+"</td>"
	
	
	
	+"<td><input style='width: 100px;' id='"+val.id+"q' onkeyup=product_up_in("+val.id+") class='form-control' value="+val.qun+"></td>"
	
	+"<td><input readonly style='width: 100px;' id='"+val.id+"p' onkeyup=product_up_in("+val.id+") class='form-control' value="+val.price+"></td>"
	
	+"<td id='"+val.id+"a'>"+val.amount+"</td>"

+"<td style='font-weight:bold;color:red;'><a href='#' onclick='product_delete("+val.id+","+val.trans_id+","+val.type+")'>X</a></td>"

							+"</tr>";
							
				
			});
				

				
				
				
			stuff=stuff+"<tr class='primary'>"

			
						+"<td><strong>Total => </strong></td>"
						+"<td><strong></strong></td>"
						+"<td><strong></strong></td>"
						+"<td><input readonly style='width:100px' class='form-control' value="+gross+" id='gro_amount'></td>"


						+"</tr>";
						
						
						stuff=stuff+"<tr class='primary'>"

			
						+"<td><strong></strong></td>"
						+"<td><strong></strong></td>"
						+"<td><strong></strong></td>"
						+"<td><button class='btn btn-primary' onclick=trans_submit(this)>Submit</button></td>"


						+"</tr>";
	
		
		
		$("#invoice").val(inv);
		
		document.getElementById("tbody").innerHTML=stuff;

	
	
}
 
 function retail()
{
	
	
	var invoice=$("#invoice").val();	
	var pro=$("#product").val();
	var qun=$("#qun").val();
	var price=$("#price").val();
	
	
	if(invoice != '' && pro != '' && qun != '' && qun != 0 && price != 0 && price != ''){
		

		$("#pur_complete").text("Loading....");
		$("#pur_complete").attr("disabled",true);
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'mains/product_add_transfer',
		data:{invoice:invoice,pro:pro,qun:qun,price:price},
		success:function(data)
		{
	
				table_data_add(data,1);
				
				$("#pur_complete").text("Submit");
				$("#pur_complete").attr("disabled",false);
				
				
				$("#product").val('');
				$("#product").focus();
				$("#qun").val('');
				$("#price").val(0);
		
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
	
	
	
	
}
 
 
 
 $("#product").focusout(function(){
	
	
	
	
	var product=$("#product").val();
	var inv=$("#invoice").val();
	var ty=3;
	
	
if(product != '' && inv != 0 && inv != '')
{
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'mains/getProductPriceType/',
		data:{product:product,ty:ty,inv:inv},
		success:function(data)
		{
					$("#price").val(data.price);
	
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
	});
	}
});

 
 
 $(".report_cancel").click(function(){
	
	
	$(".data_adding").show();
	$(".data_preview").hide();
	
	
});


function table_data_add_trans(data,c,w,apr)
{	
	var stuff="";
	var classs="";
	var i=0;
	var gross=0;	
	var read="";


	var names="";
	var ins="-1";
	$.each(data.posts,function(key,val)
			{
				
				
			
				
					gross=parseFloat(gross) + parseFloat(val.amount);
				
					names=val.name;
				
				stuff=stuff+"<tr id='"+val.id+"tr'>"
					
				+"<td>"+val.code+"</td>"
	
				+"<td>"+val.name+"</td>"
				+"<td>"+val.qun+"</td>"
				+"<td>"+val.price+"</td>"
	
		
	+"<td id='"+val.id+"a'>"+val.amount+"</td>"


							+"</tr>";
							
				
			});
				

				
				
				
			stuff=stuff+"<tr class='primary'>"

			
						+"<td><strong>Total => </strong></td>"
						+"<td><strong></strong></td>"
						+"<td><strong></strong></td>"
						+"<td><strong></strong></td>"
						+"<td><input readonly style='width:100px' class='form-control' value="+gross+" id='gro_amount'></td>"


						+"</tr>";
						
			
			if(apr == 0){
				
				stuff=stuff+"<tr class='primary'>"

			
						+"<td><strong></strong></td>"
						+"<td><strong></strong></td>"
						+"<td><strong></strong></td>"
						+"<td><strong></strong></td>"
						+"<td><button class='btn btn-success approve' onclick=approve("+c+","+w+")>Approve</button></td>"


						+"</tr>";
						
				
				
			}
			
					
		
			document.getElementById("tbody_modal").innerHTML=stuff;
		
		
		
		
		
		
		
		
		
		
		
	
	
}
 function transfer_details(t,id,w,apr,r){
	
	
	var title=$("."+t+""+r).text();
	
	$("#td_data").text("( "+title+" )");	
	
	$("#room_setup").modal('show');

	
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'mains/transfer_all_product',
		data:{id:id,w:w},
		success:function(data)
		{
			
			table_data_add_trans(data,id,w,apr);
	
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
 function invoice_deleting(id,inv,w,th){
	 
	 
	 var c=confirm("Are you sure to delete invoice ?");
	 if(c == true)
	 {
		 
	
	 
	  $(th).text("Loading.....");
	 $(th).attr("disabled",true);
		
	 
	 	 	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'mains/invoice_delete_trans',
		data:{id:inv,w:w},
		success:function(data)
		{
			
			$("."+id+"tr").remove();
			
			$("#invoice").val(0);
			$(".data_adding").empty();

	
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
	 
	 
 }
 function invoice_pending(id,inv,w,th){
	 
	 $(th).text("Loading.....");
	 $(th).attr("disabled",true);
		
		
	 $(".data_adding").show();
	 $("#p_body").show();
	 $("#invoice").val(inv);
	 
	 	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'mains/getPendingInvoice',
		data:{id:inv,w:w},
		success:function(data)
		{
			
			table_data_add(data,1);
			
			 $(th).text("inv.Pending");
			$(th).attr("disabled",false);
	
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
 
 $("#rsubmit").click(function(){
	
	
	
	var start=$("#rstart_date").val();
	var end=$("#rend_date").val();
	var op=$("#roption").val();
	
	
	var th=$(this);
	
	
	
	if(start != '' && end != ''){
		
		
		
		$(".data_adding").hide();
		$(".data_preview").show();
		
		th.text("Loading.....");
		th.attr("disabled",true);
		
		
		$("#report_tbody").empty();
		
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'mains/getReportTransferDate',
		data:{start:start,end:end,op:op},
		success:function(data)
		{
			
			var stuff="";
			var st="";
			
			
			
			
			$.each(data.trans,function(key,val){
				
				
				
				var send="";
				
				if(val.w == val.ware){
					
				st=st+"<li><span class='"+val.id+"rr'>"+val.send+"</span></li>"	
				send="Send To "+val.send;
				}
				
				else
				{
						send="Send From "+val.receive;
				st=st+"<li><span class='"+val.id+"rr'>"+val.receive+"</span></li>"	

				}
				
				
				var ap=val.noti;
				var dis_pendding="none";
				if(ap == 0)
					dis_pendding="show";
				
				//data_adding
				
			stuff=stuff+"<tr class='"+val.id+"tr'>"
			
			
						+"<td>"+val.invoice_id+"</td>"
						+"<td>"+send+"</td>"
						+"<td>"+val.pdate+"</td>"
						+"<td>"+val.date+"</td>"
						+"<td><a href='#' onclick=transfer_details("+val.id+","+val.invoice_id+","+val.ware+",1,'rr')>Details</a></td>"
						+"<td style='display:"+dis_pendding+"'><button onclick=invoice_pending("+val.id+","+val.invoice_id+","+val.ware+",this) class='btn btn-info'>Inv.Pending</button></td>"
						+"<td style='display:"+dis_pendding+"'><button onclick=invoice_deleting("+val.id+","+val.invoice_id+","+val.ware+",this) class='btn btn-danger'>X</button></td>"
			
						+"</tr>";	
				
				
		document.getElementById("report_tbody").innerHTML=stuff;		
		document.getElementById("r_title").innerHTML=st;		
				
				
				
				
			});
			

		th.text("Submit");
		th.attr("disabled",false);
		
		
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
		
		
		
		
		
		
		
		//var win=window.open(li+'product_con/check/'+start,'_blank');
		
	}
	else
		alert('Please Check Date');
	
	
	
	
});
 
 $(".submit").click(function(){
	 
		var ins=$("#invoice").val();
		var i=$("#store").val();
		var date=$("#date").val();
	
		var t=$(this);
		
	
		if(i != '' && i != 0)
		{
			
			t.text("Loading......");
			t.attr("disabled",true);
			
			
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'mains/trans_invoice',
		data:{i:i,date:date,ins:ins},
		success:function(data)
		{
	
	
	
	
			if(data.id == 3)
				alert("Leadger not found......");
			else{
				
			$("#store").attr('disabled',true);
			
			$("#invoice").val(data.invoice);
			$("#p_body").show();
	     
			$("#fbody").hide();
	
	
				

	
			$("#product").val('');
			$("#qun").val('');
			$("#price").val('');
			$("#product").focus();
			
			
				
			}
	
	
	t.text("Submit");
			t.attr("disabled",false);	
	
	
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