
var li=links();



	$(document).ready(function() {
			

			
	
			
	$('body').on('change','#photoimg', function(){ 
	
		$("#preview").html('');
   var stuff="<img id='img' src='"+li+"img/loader.gif' alt='Uploading....'>";

	document.getElementById("preview").innerHTML=stuff;			
					  
				
			$("#imageform").ajaxForm({
					target: '#preview'
				}).submit();
		
			});			
			
			
			
	});

	
	function updateProduct(v){
		
		
		
	var test = $("#img").attr('src').split('\/');
    
	var img=test[test.length-1];
	
	if(img == 'loader.gif')
		img="";
		
		
	var p=$("#product").val();

	
	if(p != ''){
		
		
			$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'product_con/update_product',
		data:{img:img,p:p},
		success:function(data)
		{
			
			alert("Updated");
			$("#product").val("");
			$("#product").focus();
		},
		error:function(error)
		{
			alert("Server Error");
		}
		});
		
		
		
	}
		
		
	}
	

	function invoice_view(invoice){
		
		$.ajax({
				
				
		type:'POST',
		dataType:'json',
		url:li+'transaction/view_invoice',
		data:{invoice:invoice},
		success:function(data)
		{
				
				$(".max").text(invoice);
				
				data_view(data);
		
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

	
	function invoice_delete(id){
		
		
		var c=confirm('Are you sure to delete ?');
		
		if(c ==  true){
			
			
			$("#"+id+"in").remove();
			
			
			$.ajax({
				
				
		type:'POST',
		dataType:'json',
		url:li+'transaction/invoice_delete',
		data:{id:id},
		success:function(data)
		{
			
			
			
			
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


	function report_search()
	{
		
		
		var start=$("#starts").val();
		var end=$("#ends").val();
		
		if(end != '' || start != ''){
			
			
			
			$.ajax({
				
				
		type:'POST',
		dataType:'json',
		url:li+'transaction/getTransInvoice',
		data:{start:start,end:end},
		success:function(data)
		{
			
			var stuff="";
			
			
			$.each(data.posts,function(key,val){
				
				stuff=stuff+"<tr id='"+val.in+"in'>"
				
					
							+"<td><a onclick=invoice_view("+val.in+") href='#'>"+val.in+"</a></td>"
							+"<td>"+val.date+"</td>"
							+"<td><a onclick=invoice_delete("+val.in+") style='font-weight:bold;color:red;' href='#'>X</a></td>"
				
							+"</tr>";
				
				
				
			});
			
			
			document.getElementById("in_tbody").innerHTML=stuff;
			
			
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



	function transfer_delete(id)
	{
		
		var c=confirm("Are you sure to delete ?");
		
		if(c == true){
			
			
			
			
			$.ajax({
				
				
		type:'POST',
		dataType:'json',
		url:li+'transaction/trans_product_delete',
		data:{id:id},
		success:function(data)
		{
						$("#"+id+"tr").remove();

			
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


	function data_view(data){
		
		
		
		
					if(data.id == 0){
						
						
					}
					else{
						
						var stuff="";
						var classs="";
						var i=1;
						$.each(data.posts,function(key,val){
							
							//alert(val.id+" "+val.name+" "+val.qun);
							
							if(i == 1)
								classs="warning";
							else if(i == 2)
								classs="success";
							else if(i == 3)
								classs="danger";
							else if(i == 4){
								
								classs="info";
								i=1;
								
							}
								
								
							
							stuff=stuff+"<tr class='"+classs+"' id='"+val.id+"tr'>"
							
							
										+"<td>"+val.name+"</td>"
										+"<td><input onkeyup=transfer_pupdate("+val.id+","+val.transfer+",this) style='width:100px' type='text' class='form-control' value="+val.qun+"></td>"
										+"<td><a onclick=transfer_delete("+val.id+") style='font-weight:bold;color:red;' href='#'>X</a></td>"
							
							
										+"</tr>";
							
							i++;
							
						});
						
						
				
						
						
					}
		document.getElementById("tbody").innerHTML=stuff;		
		
	}
	
	function transfer_pupdate(id,trans,v){
		
		
		
		var qun=$(v).val();
		if(qun == '')
			qun=0;
		
		
		$.ajax({	
		type:'POST',
		dataType:'json',
		url:li+'transaction/trans_product_update',
		data:{id:id,trans:trans,qun:qun},
		success:function(data)
		{
			
			
	
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
	
	function transfer(){
		
		
		var id=$("#product").val();
		var qun=$("#qun").val();
		var sc=$("#sc").val();
		var sd=$("#sd").val();
		var date=$("#date").val();
		var max=parseInt($(".max").text());

		var sp=id.split("*");
		
		//alert(sp[0] +" "+sp[1]);
		if(id == '' || date == '')
			alert('product or date feild empty');
		else if(sc == sd)
			alert('Invalid Transfer');
		else if(qun == '')
			alert('product quntity empty');
		else{
			
			
			var i=1;
			
			$.ajax({
				
				
		type:'POST',
		dataType:'json',
		url:li+'transaction/trans_product_add',
		data:{id:id,qun:qun,sc:sc,sd:sd,date:date,max:max},
		success:function(data)
		{
			
			data_view(data);
			
			$("#product").val("");
			$("#product").focus();
			$("#qun").val("");
	
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
