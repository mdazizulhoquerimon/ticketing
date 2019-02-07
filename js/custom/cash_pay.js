
var li;
$(document).ready(function(){


           $("#tag").focus();

 li=links();

});

function delete_jour_id(id,vou){



      var c=confirm('Are you sure to delete ?');

     if(c == true){







	 $( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });

	$(".img").show();

	
	
	$.ajax({
		type:'POST',
		dataType:'json',
        url: li+'admin/journal_post_delete',
		data:{id:id,vou:vou},
		success:function(data)
		{
			
	
			
			journal_data(data,vou);
			
			
			
			
		$(".img").hide();
	 $("#modals").dialog( "close" );
			
		},
		error:function(error)
		{
			alert('Error');
		}
	});
	
	
	}
	
	
	
}
function j_action_change(id)
 {
	 
	 
	 var vou=$("#voucher_no").val();
	 var value=$("#"+id+"se").val();
	 
	 
	 
	 
	 
	 if(vou != '')
	 {
		 
		 
		 
		 
		 $( "#modals" ).dialog({
			modal: true,
			dialogClass: 'noTitleStuff'
			});

			$(".img").show();
	
		$.ajax({
			type:'POST',
			dataType:'json',
			url: li+'admin/journal_post_change',
			data:{id:id,vou:vou,value:value},
			success:function(data)
				{
	
	
	journal_data(data,vou);
	
	
	
			$(".img").hide();
			$("#modals").dialog( "close" );
			
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
	 
	 
	 
	  
	 
	 
 }
$("#journal_post").click(function(){
	
	
	var voucher=$("#voucher_no").val();
	
	var date=$("#j_date").val();
	
	var lader=$("#tag").val();
	var type=$("#type2").val();
	var amount=$("#amount").val();
	var desc=$("#description").val();
	
	
	if(voucher == '' || date == '' || lader == '' || type == '' || amount == '')
	{
		
		
		alert('information incomplete');
		
	}

	else{
	
	
	$( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });

	$(".img").show();
	
	
	d_total=0;
	c_total=0;
	stuff="";
	
	
	$.ajax({
		type:'POST',
		dataType:'json',
        url: li+"admin/journal_post_ajax/",
		data:{voucher:voucher,date:date,lader:lader,type:type,amount:amount,desc:desc},
		success:function(data)
		{
			
			
			
		journal_data(data,voucher);
			
		$("#tag").val('');
		$("#amount").val('');
		$("#description").val('');
			
			
			
			$("#tag").focus();
				$(".img").hide();
	 $("#modals").dialog( "close" );
		},
		error:function(error)
		{
			alert('Error');
		}
	});
	
	
}
	
});




















$(".cash_sub button").click(function(){
	
	
	
	var type=$(this).val();
	
	var start=$("#start").val();
	var end=$("#end").val();
	
	
	if(type != '' && start != '' && end != ''){
		
			var color=new Array();
			
				color[0]="active";
				color[1]="success";
				color[2]="info";
				color[3]="warning";
				color[4]="danger";
		
		
		
		
		$( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });
	$(".img").show();
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'transaction/all_voucher/',
		data:{type:type,start:start,end:end},
		success:function(data)
		{
		
		
		
		
		
		
		var i=0;
		var stuff="";
		
		$.each(data.posts,function(key,val)
			{
		
		
		stuff=stuff+"<tr class='"+color[i]+"'>"
		
		
			+"<td><a onclick='search_cash("+val.voucher+")' href='#'>"+val.voucher+"</a></td>"
			+"<td><a href='#'>"+val.date+"</a></td>"
		
		
		
				+"</tr>";
				
				i++;
		
		if(i == 5)
		i=0;
			});
		
		
		$(".vouch").show();
		
		$(".vouch_main").hide();
		$("#tbodys").html(stuff);
		
		
		
		$(".img").hide();
			 $("#modals").dialog( "close" );
		
		},
	error:function(jqXHR, textStatus, errorThrown)
		{
			//alert("Server Error");
				if (jqXHR.status === 0) {
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
	else{
		
		alert('incomplete information');
		
	}
	
	
	
});


function trans_update(id){
	
	
	
	var va=$("#"+id).val();
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'transaction/trans_update/',
		data:{id:id,va:va},
		success:function(data)
		{
			
			
				
			
			
		},
	error:function(jqXHR, textStatus, errorThrown)
		{
			//alert("Server Error");
				if (jqXHR.status === 0) {
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
function trans_details(id,id2){
	

 $( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });
	$(".img").show();
	
	
          
		if(id == 1 || id == 2 || id == 3 || id == 4)
			var red="readonly";
		else
			var red="";


	var fdate=$("#fdate").val();
	var ldate=$("#ldate").val();
	
	if(fdate == '' || ldate == ''){
		
		alert('please check date....');
	}
	else{
		
		
	$.ajax({
		type:'POST',
		dataType:'json',
		url: li+"mains/geTransJValue/",
		data:{id:id,fdate:fdate,ldate:ldate,id2:id2},
		success:function(data)
		{
	
			var stuff="";
			
			var color=new Array();
			
				color[0]="active";
				color[1]="success";
				color[2]="info";
				color[3]="warning";
				color[4]="danger";
			
			var i=0;
			var amount=0;
			
			$.each(data.posts,function(key,val)
			{
				
				amount=amount + + val.amount;
	
				stuff=stuff+"<tr class="+color[i]+">"+
	
							"<td>"+val.debit+"</td>"+	
							"<td>"+val.credit+"</td>"+	
"<td style='width:150px'><input class='form-control' id="+val.id+" value="+val.amount+" "+red+" onkeyup=trans_update("+val.id+")></td>"+	
							"<td>"+val.date+"</td>"	

						  +"</tr>";
					i++;
					
				if(i >= 5)
					i=0;
				
					
	
			});
			
			
			stuff=stuff+"<tr class=''>"+
			
							
							"<td></td>"+	
							"<td style='text-align:center'><strong>Total </strong></td>"+	
							"<td><strong>"+amount+"</strong></td>"+	
							"<td></td>"	
							
						  +"</tr>";
			
			document.getElementById("trans_b").innerHTML=stuff;
	
	
		$(".img").hide();
	 $("#modals").dialog( "close" );
	
		},
		error:function(jqXHR, textStatus, errorThrown)
		{
			//alert("Server Error");
				if (jqXHR.status === 0) {
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
}




$("#cash").click(function(){
	
	
	
	var voucher=$("#voucher_no").val();
	var date=$("#dat").val();
	var lader=$("#tag").val();
	var amount=$("#amount").val();
	var desc=$("#description").val();

	
	d_total=0;
	c_total=0;
	stuff="";
	
	if(voucher  == '' || date == '' || lader == '' ||  amount == ''){
	
	
			alert('please check feild');
	
	}
	else{
	
	$.ajax({
		type:'POST',
		dataType:'json',
        url: li+"admin/cash_p/",
		data:{voucher:voucher,date:date,lader:lader,amount:amount,desc:desc},
		success:function(data)
		{
			
			
			
			//view_data(data,voucher);
			
				
						
					
		},
		error:function(error)
		{
			alert('Error');
		}
	});
	
	
	
	
	  $("#tag").focus();
	  
	  
	  
	}
	
	
});


function cash_check(){
	
	
	
	var voucher=$("#voucher_no").val();
	var type=$("#type").val();
	var date=$("#dat").val();
	var lader=$("#tag").val();
	var amount=$("#amount").val();
	var desc=$("#description").val();

	
	d_total=0;
	c_total=0;
	stuff="";
	
	if(voucher  == '' || date == '' || lader == '' ||  amount == ''){
	
	
			alert('please check feild');
	
	}
	else{
	
	$( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });
	$(".img").show();
	
	var bank="";
	var check_no="";
	var check_date="";
	var withs=0;
	if(type == 8){
		
		bank=$("#bank").val();
		
	}
	else if(type == 9){
		bank=$("#bank").val();
		check_no=$("#ch_no").val();
		check_date=$("#ch_date").val();
		withs=1;
	}
	
	if(withs == 1){
		
		
		if(check_no == '' || check_date == '')
			withs=1;
		else
			withs=0;
			
		
		
	}
	
	if(withs == 0){
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
        url: li+"transaction/cash_p/",
		data:{voucher:voucher,date:date,lader:lader,amount:amount,desc:desc,type:type,bank:bank,check_no:check_no,check_date:check_date},
		success:function(data)
		{
			
			
			
			view_data(data,voucher);
			
				
				$(".img").hide();
		$("#modals").dialog( "close" );			
					
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
	else{
		
		
		alert('please given check_no and check_date');
		
	}
	
	
	
	
	
	
	
	
	  $("#tag").focus();
	  
	  
	  
	}
	
	
	
	
}


function search_cash(ids){

//$("#cash_pay_all").keyup(function(){
	
	
	if(typeof ids == 'undefined')
		var v=$( "#cash_pay_all" ).val();
	else
		v=ids;
	
	
	var type=$( "#type" ).val();

	
		  if(v != '')
		   $('#cash_pay_all').addClass('ac_loading');
	   
	   
	   
	   $.ajax({
		type:'POST',
		dataType:'json',
       url: li+"mains/getCashPaymentAll/",
		data:{v:v,type:type},
		success:function(data)
		{
			
			
			
			
			if(data.id == 1){
				
				//v=data.v;
				
				$("#voucher_no").val(data.v);
				
			}
			else{
				
				$(".vouch").hide();
		
		$(".vouch_main").show();
		//$("#tbodys").html(stuff);
			
			
			
			
			/*if(type == 6 || type == 7){
				
			view_data(data,v);		
			
				
			}
			

			else if(type == 8 || type == 9){
				
				
				
				
				
				
				bank_depo_data(data,v);
				
			}*/
		 if(type == 10){
				
				
						journal_data(data,v);
			
						$("#tag").val('');
						$("#amount").val('');
						$("#description").val('');
			
			
			
						//$("#tag").focus();
				
			}
			else
				view_data(data,v);
			
			
			
			
			}
				
			
		
		
				
		$('#cash_pay_all').removeClass('ac_loading');
			
						
					
		},
		error:function(xhr, status)
		{
			
			alert(status);
			
					   $('#cash_pay_all').addClass('ac_loading');
		}
	});
}
	
//});

function up(type){
	
	
	//var pro=prompt('Please enter the voucher number');
	
	
	
	if(type == 10)
		var date=$("#j_date").val();
	else
		var date=$("#dat").val();
	
	
	
	var pro=$("#voucher_no").val();
	
	if(date == ''){
		
		alert('please check the update value');
	}
	else{
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
       url: li+"transaction/voucher_date_update/",
		data:{pro:pro,date:date,type:type},
		success:function(data)
		{
			
			
				if(data.id == 1){
					
					alert('invalid voucher.');
				}
				else if(data.id == 2){
					
					alert('update successfull. voucher id '+pro);
					
				}

		
		
						
					
		},
		error:function(error)
		{
			alert('Error');
		}
	});
		
		
	}
	
	
};

$( "#tags" ).keypress(function( event ) {




 	 if ( event.which == 13 ) {
     
     
    			onclick();	
     
     
 	 }
  
  });
  $( "#description" ).keypress(function( event ) {




 	 if ( event.which == 13 ) {
     
     
    			onclick();	
     
     
 	 }
  
  });
  
  
  
  
  
  
   $( "#amount" ).keypress(function( event ) {




 	 if ( event.which == 13 ) {
     
     
    			onclick();	
     
     
 	 }
  
  });



function delete_cash(id)
{


	var r = confirm("Are you sure to delete  ?");
		if (r == true)
			 {
				 
						
			$( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });
	$(".img").show();	 
				 
				 
				 
    		  $("#tag").focus();
    		var vou=$("#voucher_no").val();
    		var type=$("#type").val();
    		
			
			
			
			
			
    	
    				$.ajax({
						
				
						
						
		type:'POST',
		dataType:'json',
		url: li+"transaction/delete_cash/",
		data:{id:id,vou:vou,type:type},
		success:function(data)
		{
			
			
			
				view_data(data,vou);

		
		$(".img").hide();
		$("#modals").dialog( "close" );
						
					
		},
		error:function(error)
		{
			alert('Error');
		}
	});
    		
    		
			}
				 else {
				 
    		
    			
    			  $("#tags").focus();
    			
    			
				}


}


function view_report(v,t)
{


		if(t == 1)
		{
		
				var win = window.open('http://www.kishwan.com/fininv/accounts/new_tran/'+v);
					if(win){
   							 //Browser has allowed it to be opened
   							 win.focus();
   							 
   							//$("#tags").val('9');
   							 
   							 
						}else{
    								//Broswer has blocked it
   								 alert('Please allow popups for this site');
							}
		
		}
		else if(t == 3)
		{
		
		
		var win = window.open('http://www.kishwan.com/fininv/accounts/bank_deposit/'+v);
					if(win){
   							 //Browser has allowed it to be opened
   							 win.focus();
						}else{
    								//Broswer has blocked it
   								 alert('Please allow popups for this site');
							}
		
		
		}


}

function key_cash(id){
	
	var amount=$("#"+id+"a").val();
	var des=$("#"+id+"d").val();
	
	
	$.ajax({
		type:'POST',
		dataType:'json',
        url: li+"transaction/cash_update/",
		data:{id:id,amount:amount,des:des},
		success:function(data)
		{
			
			//alert(data.id);
			
			//view_data(data);
			
				
						
					
		},
		error:function(error)
		{
			alert('Error');
		}
	});
	  //$("#tag").focus();
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
function journal_data(data,v){
	
	stuff="";
	var check=0;
	var debit="";
	var credit="";
	var d_total=0;
	var c_total=0;
	var ch=1;
	
	
	var classs="";
			var i=0;
	
	var se_d="";
	var se_c="";
	var se_var="";
	var se_var2="";
	
	$.each(data.posts,function(key,val)
			{
				
				ch=0;
				
				check=1;
				
				
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
				
				
				
				var display_c="show";
				var display_d="show";
				var display="";
				if(val.type == 1){
					
					se_d="selected";
					se_c="";
					se_var2="";
					se_var="selected";
					debit=val.amount;
					credit="";
					display_c="none";
					
					d_total=d_total + + val.amount;
				}
				else{
					
					se_d="";
					se_c="selected";
					se_var2="selected";
					se_var="";
					
					credit=val.amount;
					debit="";
					display_d="none";
					c_total=c_total +  + val.amount;
				}
				
		
				
				stuff=stuff+"<tr class="+classs+">"+
				
"<td>"+val.ledger+"</td>"+	


	"<td><input style='display:"+display_d+"' id='"+val.id+"d' type='text' class='form-control' onkeyup='key("+val.id+",1,"+val.voucher_no+")' onkeypress='return isNumberKey(event,"+val.id+")' value="+debit+"></td>"+

	
"<td><input style='display:"+display_c+"' id='"+val.id+"c' type='text' class='form-control' onkeyup='key("+val.id+",2,"+val.voucher_no+")' onkeypress='return isNumberKey(event,"+val.id+")' value="+credit+"></td>"+	

						"<td>"+val.description+"</td>"+
						
		"<td><a style='color:red;font-weight:bold' href='#' onclick=delete_jour_id("+val.id+","+val.voucher_no+")>X</a></td>"+
		
		
		"<td><select onChange=j_action_change("+val.id+")  class='form-control' id='"+val.id+"se'><option value='1' "+se_var+"='"+se_d+"'>Debit</option><option value='2' "+se_var2+"='"+se_c+"'>Credit</option></select></td>"+
		
				 "<td>"+val.date+"</td>"+

		
		"</tr>";
				
					
				
				
			});
		if(ch == 0)
				$("#voucher_no").val(v);	
			
		if(check == 1){
				
				stuff=stuff+"<tr class='danger'>"+
					"<td></td>"+
					"<td><strong>Total Debit</strong> :<input type='text' class='form-control' id='tdebit' value="+d_total+" readonly></td>"+
					
					
					
					"<td><strong>Total Credit</strong> :<input type='text' class='form-control' id='tcredit' value="+c_total+" readonly></td>"

				+"</tr>";
			
			
			document.getElementById("tbody").innerHTML=stuff;
			check=0;




			

			
		}
		else{
			
			document.getElementById("tbody").innerHTML=stuff;
			
		}
			
				
				
			
			
			
										
			if(d_total == c_total && c_total != 0){
			

		document.getElementById("confirm").innerHTML="<button type='button' onclick=up(10) class='btn btn-info'>Confirm</button>";			
				
			}
			else{
				
	document.getElementById("confirm").innerHTML="";			
				
			}
	
	
}

function key(id,type,vou)
		{
	
	var debit=0;
	var credit=0;
	
		if(type == 1){
			
			debit=$("#"+id+"d").val();
			
		}
		else if(type == 2){
			
			credit=$("#"+id+"c").val();
			
		}
	
	
	
	
	var stuff="";

	
	thed=document.getElementById("confirm");
	
		$.ajax({
		type:'POST',
		dataType:'json',
        url: li+"admin/journal_update",
		data:{id:id,debit:debit,credit:credit,vou:vou},
		success:function(data)
		{
			document.getElementById("tdebit").value=data.debit;
			document.getElementById("tcredit").value=data.credit;
	
				
			if(data.debit == data.credit)
			{
				
	thed.innerHTML="<button type='button' class='btn btn-info'>Confirm</button>";

				
				
			}
			else{
				
				
				thed.innerHTML="";		
				
				
			}
			
			
			
			
			
			
			
		},
		error:function(error)
		{
			alert('server error');
		}
	});
	
		}







function view_data(data,v){
	
	
	var ty=$("#type").val();
	
	
	
			$("#tag").val('');
			$("#amount").val('');
			$("#description").val('');
			
			stuff="";
			var ch=1;
			var dis="";
			
			if(ty == 9)
				dis="show";
			else
				ty="none";
			
			
			
			
			
		$.each(data.posts,function(key,val)
			{

			ch=0;
			
			
			
			
			
				
				
			stuff=stuff+"<tr>"+
				
        "<td>"+val.debit+"</td>"+
		"<td>"+val.credit+"</td>"+	
							
"<td style='width:100px'><input id='"+val.id+"a' type='text' class='form-control' onkeyup=key_cash("+val.id+") onkeypress='return isNumberKey(event,"+val.id+")' value="+val.amount+"></td>"+	

 "<td><textarea id='"+val.id+"d' class='form-control' onkeyup=key_cash("+val.id+")>"+val.description+"</textarea></td>"+
 
  "<td>"+val.date+"</td>"+
 
 
  "<td style='display:"+dis+"'>"+val.cheque_date+"</td>"+
 
  "<td style='display:"+dis+"'>"+val.cheque_no+"</td>"+
 
		"<td style='width:60px'><a style='color:red;font-weight:bold;' href='#' onclick=delete_cash("+val.id+")>X</a></td>"
		
		
		 //+ "<td>"+val.date+"</td>"

									+"</tr>";
									
									
									
									
									
									
		
			});

			
			if(ch == 0)
				$("#voucher_no").val(v);
			
			

              thed=document.getElementById("tbody");
			  thed.innerHTML=stuff;	
	
}


function bank_depo_data(data,v){
	
	
	$("#tag").val('');
			$("#amount").val('');
			$("#description").val('');
			
			stuff="";
			ch=1;
		$.each(data.posts,function(key,val)
			{

		ch=0;
			
			
				stuff=stuff+"<tr>"+
				
                            "<td>"+val.debit+"</td>"+
                            "<td>"+val.credit+"</td>"+	
							"<td width='100px;'><input id='"+val.id+"a' type='text' class='form-control' onkeyup=key_cash("+val.id+") onkeypress='return isNumberKey(event,"+val.id+")' value="+val.amount+"></td>"+


	
 "<td><textarea id='"+val.id+"d' type='text' class='form-control' onkeyup=key_cash("+val.id+")>"+val.description+"</textarea></td>"+

 "<td>"+val.date+"</td>"+

		"<td  width='50px;'><a style='color:red;font-weight:bold' href='#' onclick=delete_cash("+val.id+")>X</a></td>"
									+"</tr>";
		
			});

			if(ch == 0)
				$("#voucher_no").val(v);

                          thed=document.getElementById("tbody");
			  thed.innerHTML=stuff;
	
	
	//$("#tag").focus();
}



function isNumberKey(evt,id){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
		//document.getElementById(id).value="";
		//alert('please given digit');
        return false;
		
	}
	else{
		
			//alert(document.getElementById("148").value);
		
		 return true;
	}
   
}