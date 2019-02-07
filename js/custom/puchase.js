var li;



$(document).ready(function(){
	
	
	$("#pro_body").hide();
	$("#in_complete").hide();
	$("#service_product").focus();
	$("#product").focus();
	//$("#supplier").val("");
	//$("#customer").val("");
	$("#product").focus();
	
	 li=links();

	
});

function discount(v){
	
	


     var c=hostReachable();


      if(c ==  false)
{
        alert("Please check your internet connection");
 

         window.location=li;

}



	$("#li_per").show();
	$("#li_change").show();

	var zero=$(v).val();
	
	

	var amount=$("#gro_amount").val();
	var taka=$("#dis_taka").val();
	var dis=$("#dis_per").val();
	var cash=$("#cash_pur").val();
	var card=$("#card_pur").val();
	var bkash=$("#bkash").val();


        if(amount == '')
		amount=0;
	if(taka == '')
		taka=0;
	if(dis == '')
		dis=0;
	if(cash == '')
		cash=0;

	if(card == '')
		card=0;
	
	if(bkash == '')
		bkash=0;


	var total=0;
	if(amount != '' || taka == 0){
		
		 total=total + + taka;
		
		var disc=0;
		
		if(dis != ''){
			
			disc=(amount*dis)/100;
			
			total = total + + disc;
		}
		
		
	//	alert(total);
		
document.getElementById("li_per").innerHTML="Total Discount : "+taka+" + "+disc.toFixed(2)+"="+total.toFixed(2);

	var ex=((parseFloat(cash)+parseFloat(card)+parseFloat(bkash)+total) - parseFloat((amount)));
document.getElementById("li_change").innerHTML="Exchange "+ex;
		
	}
	
	$("#check_gross").val(total);
	$("#check_change").val(ex);
	




	
}

function textChanges(id){
	
	
	
	var sname=$("#"+id+'t').val();
	
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'jquery_data/service_update/',
		data:{id:id,sname:sname},
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




  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}


$(window).on('beforeunload ',function() {
	
	
	
	
 
              
   
   
});
   
   
	 var currentMousePos = { x: -1, y: -1 };
    $(document).mousemove(function(event) {
        currentMousePos.x = event.clientX;
        currentMousePos.y = event.clientY;

	$("#d").show();	  	  
		   var i=0;
	 var j=0;
		 setInterval(function() {	
			
			// if(i == 1){
				
				// j=10;
			// }
			// else{
				
				// i=i + + 1;
				// j=10;
			// }
			
			if(i<5){
			
			
			j=j+5;
			
			$("#d").css({
      "background-color": "yellow",
      "font-weight": "bolder",
		"position": "absolute",
		"border" : "1px solid",
		"-ms-transform" : "rotate(180deg)",
		"-webkit-transform" : "rotate(180deg)",
		"transform" : "rotate(180deg)",
		"-ms-transform" : "translate(50px,100px)", /* IE 9 */
    "-webkit-transform": "translate(50px,100px)", /* Safari */
    "transform" : "translate(50px,100px)",
	  "top" : currentMousePos.y,
	"left" : currentMousePos.x - 150 + + j,
	  "z-index" : 9999
     });
		

		i++;

		
		 }
			//i=2;
			
			
			
		 }, 1000);	
			
			
			
			
	
 	 



	
		  
    });

    // ELSEWHERE, your code that needs to know the mouse position without an event
  
       
	 
	   
	   
   
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function bank_change(){
		
		
	  var invoice=$("#invoice").val();
	  var bank=$("#type").val();
	  var type=parseInt($("#update_invoice").val());
	  var sup="";
	if(type == 1 || type == 2){
		
		
		sup=$("#supplier").val();
		
	}
	else{
		
		sup=$("#customer").val();
		
	}
	  
	  
	  //alert(type);
	  
	  
	  if(invoice != '' && sup != '' && type != ''){
		  
		  
		  var c=confirm('Are you sure to change bank ?');
		
		if(c == true){
			
			
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'jquery_data/bank_change/',
		data:{invoice:invoice,sup:sup,type:type,bank:bank},
		success:function(data)
		{
			
			if(data.id == 1){
				
				
				alert('please agine login');
				
			}
			else if(data.id == 2){
				
				
				alert('you are given invalid input');
				
				
			}
			else if(data.id == 3){
				
				alert('updated');
				
			}
			else{
				
				
				
				//alert('uncatch error');
				
			}
			
			
			
			
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
	  else{
		  
		  
		  alert('Please Check Your Input');
		  
		  
	
	}
	
	}

function invoice_edit(id,type,type_l){
	
	
	
	
	
	var ch="";
	var links="";
	var stuff="";
	 if(type_l == 1 || type_l == 2)
		{
		 
		 
		 ch="supplier";
		links=li+'jquery_data/invoice_edit/';
			
	
			
			
		 
		 document.getElementById("name").innerHTML=ch;
		 
		}
		else if(type_l == 3 || type_l == 4){
		
		 ch="customer";
		 links=li+'jquery_data/invoice_edit/';
		 
		  document.getElementById("name").innerHTML=ch;
		
		}
		else{
			
				ch="customer";
				links=li+'jquery_data/go_invoice_issu/';
				
				
				 document.getElementById("name").innerHTML=ch;
			}
			
			
			
		$.ajax({
		type:'POST',
		dataType:'json',
		url:links,
		data:{id:id,type:type,type_l:type_l,ch:ch},
		success:function(data)
		{	
			
			$("#invoice").val(id);
			$("#invoice").attr('readonly','readonly');
			
			$.each(data.supp,function(key,val)
			 {
					stuff=stuff+"<option value="+val.id+">"+val.name+"</option>";
			 });
			
			
			$.each(data.date,function(key,val)
			 {
					
					$("#date").val(val.dates);
					
			 });
			
			
			
			
			document.getElementById("in").innerHTML=stuff;
			
			if(type_l != 5)
			table_data_add(data,type_l);
				else
				table_data_add2(data,type_l);	
			
			
			
		},
	error:function(xhr, status)
		 {
			alert(status);
		}
	});	
			
}

 $("#pro_body input").keypress(function (e) {
    if (e.keyCode == 13) {
       
	   
	   var test=$(this).attr('id');
	   
	   if(test == 'product' || test == 'service_product')
		   $("#qun").focus();
	   else if(test == 'qun')
			$("#price").focus();
		else if(test == 'price')
			$("#pur_complete").focus();
	   
	   
    }
 });



 $("#pro_bodys input").keypress(function (e) {
    if (e.keyCode == 13) {
       
	   
	   var test=$(this).attr('id');
	   
	   if(test == 'product' || test == 'service_product')
		   $("#qun").focus();
	   else if(test == 'qun')
			$("#price").focus();
		else if(test == 'price')
			$("#pur_complete").focus();
	   
	   
    }
 });



$("#product").focusout(function(){
	
	
	
	
	var product=$("#product").val();
	var ty=$("#pur_complete").val();
	
	
	if(product != ''){
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'transaction/getProductPriceType/',
		data:{product:product,ty:ty},
		success:function(data)
		{
	
	
	      
	
		
				if(data.id == 3){
					$("#product").val('');
					$("#price").val(0);
					
					//alert('invalid product name');
					
					$("#product").focus();
					
				}
				else{
					
					
				if(data.id == 1)
				{
					
					$("#price").attr('readonly','readonly');
					$("#price").val(data.price);
				}
				else{
					
	$("#price").attr('readonly',false);
	$("#price").val(data.price);				
				
				}
				
				
					
				}
	
	
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

/*
$("#dis_per").keyup(function(){
		$("#li_per").show();
	$("#li_change").show();
	
//alert('ok');
	
	var amount=$("#gro_amount").val();
	var taka=$("#dis_taka").val();
	var cash=$("#cash_pur").val();
	
	
	var dis=0;
	var total=0;
	if(amount != ''){
		
		dis=$("#dis_per").val();

		var discount=(amount*dis)/100;
		
	
		total = total + + discount;
	
		if(taka != ''){
			
			total=total + + taka;
		}
		
		
		
		document.getElementById("li_per").innerHTML="Total Discount : "+taka+" + "+discount.toFixed(2)+"="+total.toFixed(2);
		
		
		var ex=(amount - total) - cash;
		
		
document.getElementById("li_change").innerHTML=" Exchange "+ex.toFixed(2);

		$("#check_gross").val(total);
		$("#check_change").val(ex);
		
	}
	
	
	
});
*/

/*$("#cash_pur").keyup(function(){
	
	var total=0;
	
	var cg=$("#check_gross").val();
	var cp=$("#cash_pur").val();
	
	if(cg == '')
	    cg=0;
	if(cp == '')
	    cp=0;
	
	
	
	var ch=parseFloat(cg);
	var cash=parseFloat(cp);
	var gross=parseFloat($("#gro_amount").val());
	
	

	
	 total= cash + ch;
	
			alert(gross+" "+total);

	
	document.getElementById("li_change").innerHTML=" Exchange " + (gross - total);

});
*/

/*$("#dis_taka").keyup(function(){
	
	
		$("#li_per").show();
	$("#li_change").show();
	

	var amount=$("#gro_amount").val();
	var taka=$("#dis_taka").val();
	var dis=$("#dis_per").val();
	var cash=$("#cash_pur").val();
	
			var total=0;
	if(amount != '' || taka == 0){
		
		 total=total + + taka;
		
		var disc=0;
		
		if(dis != ''){
			
			disc=(amount*dis)/100;
			
			total = total + + disc;
		}
		
		
		
		document.getElementById("li_per").innerHTML="Total Discount : "+taka+" + "+disc.toFixed(2)+"="+total.toFixed(2);
		
		
		var ex=(amount - total)-cash;
		
		
		//alert(ex);
document.getElementById("li_change").innerHTML=" Exchange "+ex;
		
	}
	
	$("#check_gross").val(total);
	$("#check_change").val(ex);
	
});
*/


$("#in_complete").click(function(){
	
	
	var gross_amount=$("#gro_amount").val();
	var taka=$("#dis_taka").val();
	var per=$("#dis_per").val();
	var cash=$("#cash_pur").val();
	var card=$("#card_pur").val();
	var type=$("#type").val();
	var invoice=$("#invoice").val();
	var pdate=$("#pdate").val();
	var remark=$("#remarks").val();
	var bkash=$("#bkash").val();
	
	

	
	
	var p_type=$("#in_complete").val();
	if(p_type == 1 || p_type == 2){
		
		var supplier=$("#supplier").val();
	}
	else{
		
		var supplier=$("#customer").val();
		
	}
	
	
	
	
	
	var gross_discount=$("#check_gross").val();
	var exchange=$("#check_change").val();	

	
	
	
if(gross_amount == '' || invoice == '' || supplier == '' || pdate == ''){
		
		
		alert('information incomplete..');
		
	}
	else{
		
	  $( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });
	$(".img").show();	
		
		
		
		
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'transaction/purchase/',
		data:{gross_amount:gross_amount,taka:taka,per:per,cash:cash,type:type,invoice:invoice,supplier:supplier,gross_discount:gross_discount,exchange:exchange,card:card,p_type:p_type,pdate:pdate,remark:remark,bkash:bkash},
		success:function(data)
		{
			
			if(data.id == 1){
				
				
				alert('please again login....');
			}
			
			var c=confirm('Are you sure to print');
				
				
				if(c == true){


					
window.location=li+"mains/daily_sale_report_print/"+invoice+"/"+data.issu+"/"+data.sup;		
					
				



				
				}
				else{
					
		 if(p_type == 1){
				
				
				
				alert('PURCHASE COMPLETE');
				
				window.location=li+"admin/new_purchase/1";
				
			}
			else if(p_type == 2){
				
				alert('PURCHASE RETURN COMPLETE');
				
				window.location=li+"admin/new_purchase/2";
				
			}
			else if(p_type == 3){
				
				alert('SALES COMPLETE');
				
				window.location=li+"admin/new_purchase/3";
				
			}
			else if(p_type == 5){
				
				alert('SALES Issu COMPLETE');
				
				window.location=li+"admin/new_purchase/5";
				
			}
					
			else if(p_type == 4){
				
				alert('SALES RETURN COMPLETE');
				
				window.location=li+"admin/new_purchase/4";
				
			}
			else if(p_type == 12){
				
				
				alert('Service COMPLETE');
				
				window.location=li+"admin/new_purchase/12";
				
				
			}

				}
			
			

						
				
			
			
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


		
});


/*function scannerAuto(code,sell,buy)
{
	
	var type=parseInt($("#pur_complete").val());
	
		if(type != 12)
	var product=$("#product").val();
	else
		var product=$("#service_product").val();
	
	
	
	
	
	
	
	
	
	
	
}*/


function retail(){

//$("#pur_complete").click(function(){
	
	
	
	var type=parseInt($("#pur_complete").val());
	
	if(type != 12)
	var product=$("#product").val();
	else
		var product=$("#service_product").val();
	
	
	
	var qun=$("#qun").val();
	var price=$("#price").val();
	var invoice=$("#invoice").val();
	
	
	var ch="";
	var links="";
	var supp="";
	if(type == 0)
		alert('please refresh first....');
	else if(type == 1 || type == 2){
		
		 supp=$("#supplier").val();	
		 ch="supplier";
			links=li+'transaction/product_add/';
	}
	else if(type == 3 || type == 4 || type == 12){
		
		 supp=$("#customer").val();	
			
		links=li+'transaction/product_add/';
		ch="customer";
	}
	else if(type == 12){
		
		
		  supp=$("#customer").val();	
			
		 links=li+'transaction/service_add/';
		 ch="customer";
		
		
	}
	else{
		
		 supp=$("#customer").val();	
			
		links=li+'transaction/product_add_issu/';
		ch="customer";
		
	}
	
	
	$("#in_complete").show();
	$("#"+ch).attr('readonly','readonly');
	
	var atr=$("#pur_complete").attr("disabled");
	
	if(product == '' || qun == '' || invoice == '' || supp == '' || atr == 'disabled'){
		
		
		$("#product").val('');
	     $("#product").focus();

       $("#price").val("");
		
	}
	else{
		
		

	$("#pur_complete").text("Adding....");
	$("#pur_complete").attr("disabled",true);

		
		
	var default_qun="";
	
	var nsf=$("#nsf").val();
	if(typeof nsf != 'undefined')
		default_qun=1;
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url:links,
		data:{product:product,qun:qun,price:price,invoice:invoice,supp:supp,type:type},
		success:function(data)
		{
			
			
			
			if(data.id != 0){
				
				
				if(type != 5)
					table_data_add(data,type);
				else
					table_data_add2(data,type);

			}
			else{
				
				
				alert('please agine login....');
				
			}
					
				
		$("#pur_complete").text("submit");
	$("#pur_complete").attr("disabled",false);
	  
	  
	  
		$("#qun").val(default_qun);	
		$("#price").val("");	
		
		
		$("#product").val('');
	        $("#product").focus();
			
			$("#service_product").val('');
			$("#service_product").focus();
			
			
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
	//});


function return_qun(id){
	
		var val=$("#"+id+"rq").val();
		
		
		var invoice=$("#invoice").val();
	
		var re=$("#"+id+"iq").val();
		
		var qun=$("#"+id+"iq").val();
		
		
		
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'transaction/return_qun_update/',
		data:{val:val,id:id,invoice:invoice,qun:qun},
		success:function(data)
		{
			//table_data_add2(data,5);
			
			var am=data.id * (re - val);
			var am2=(re - val);
			document.getElementById(id+"ia").innerHTML=am;
			document.getElementById(id+"is").innerHTML=am2;
			
			
			$("#gro_amount").val(data.amount);
			setGrossAmToCash();
			
	
		},
		error:function(error)
		{
			alert('server error..');
		}
	});
	
	
}
function issue_qun(id)
	{
		
		
				var qun=$("#"+id+"iq").val();
				var rq=$("#"+id+"rq").val();
				var ins=$("#invoice").val();

		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'transaction/product_issue_update/',
		data:{id:id,qun:qun,rq:rq,ins:ins},
		success:function(data)
		{
			
			var am=data.price * (qun - rq);
			var am2=(qun - rq);
			document.getElementById(id+"ia").innerHTML=am;
			document.getElementById(id+"is").innerHTML=am2;
			
				$("#gro_amount").val(am);
				setGrossAmToCash();
			
		},
		error:function(error)
		{
			alert("Server Error");
		}
	});		
		
	}
function table_data_add2(data,type){
	
	var stuff="";
	var classs="";
	var i=0;
	var read="";
		$("#in_complete").val(type);
		$("#pur_complete").val(type);
		//$("#pur_complete").show();
	
	var gross=0;
	$.each(data.posts,function(key,val)
			{
				
				
				if(val.ptype == 1)
					read="readonly";
				else
					read="";

				gross=gross + + ((val.pices - val.return_qun) * val.price);
				
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
				
				
				
				
				
					stuff=stuff+"<tr class="+classs+">"
					
					+"<td>"+val.name+"</td>"
					
	+"<td><input style='width:100px' value="+val.pices+" id='"+val.id+"iq' onkeyup=issue_qun("+val.id+") class='form-control' placeholder='Quantity'></td>"
	
					+"<td>"+val.price+"</td>"
					
					+"<td id='"+val.id+"ia'>"+val.amount+"</td>"
					
					+"<td><input style='width:100px' id='"+val.id+"rq' value="+val.return_qun+" id="+val.id+" onkeyup=return_qun("+val.id+") class='form-control' placeholder='Return Value'></td>"
					
					+"<td id='"+val.id+"is'>"+(val.pices - val.return_qun)+"</td>"


					+"<td style='font-weight:bold;color:red;'><a style='color:red' href='#' onclick='product_delete2("+val.id+","+val.trans_id+",5)'>X</a></td>"

							+"</tr>";
							
				
			});
	document.getElementById("tbody").innerHTML=stuff;
	
	$("#gro_amount").val(gross);
	setGrossAmToCash();
	$("#gro_amount").attr('readonly','readonly');
	
	
}

$("#issu_confirm").click(function(){
	
	var invoice=$("#invoice").val();
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'jquery_data/issu_complete/',
		data:{invoice:invoice},
		success:function(data)
		{
	
			window.location=li+"admin/delar_sale/5";
	
		},
		error:function(error)
		{
			alert("Server Error");
		}
	});
	
	
});

	
	function product_up(id)
		{
			
			
		var qun=$("#"+id+"q").val();
		var price=$("#"+id+"p").val();
		var invoice=$("#invoice").val();
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'jquery_data/product_update2/',
		data:{id:id,qun:qun,price:price,invoice:invoice},
		success:function(data)
		{
			
			var am=price * qun;
			document.getElementById(id+"a").innerHTML=am;
			
			$("#gro_amount").val(data.price);
			setGrossAmToCash();
			
		},
		error:function(error)
		{
			alert("Server Error");
		}
	});	
			
			
		}


function table_data_add(data,type){
	
	
	
	
	
	
	
			var stuff="";
			var classs="";
			var i=0;
					
			var gross=0;	
				
				
			var read="";	
				
	
			$("#cash_pur").val('');
			$("#card_pur").val('');
			$("#in_complete").val(type);
			$("#pur_complete").val(type);
		
		
		
				var names="";
		
		
		
			$.each(data.posts,function(key,val)
			{
				
				
				
				if(val.ptype == 1)
					read="readonly";
				else
					read="";
				
				
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
				
				gross=gross + + val.amount;
				
				
					
				// if(type == 12)
					// names="<textarea class='form-control' id='"+val.id+"t' onkeyup=textChanges("+val.id+")>"+val.name+"</textarea>";
				// else
					
					names=val.name;
				
				
					stuff=stuff+"<tr class="+classs+">"
					
				+"<td>"+names+"</td>"
	
	
	
	+"<td><input style='width: 100px;' id='"+val.id+"q' onkeyup=product_up_in("+val.id+") class='form-control' value="+val.qun+"></td>"
	
	+"<td><input style='width: 100px;' id='"+val.id+"p' onkeyup=product_up_in("+val.id+") class='form-control' value="+val.price+" "+read+"></td>"
	
	+"<td id='"+val.id+"a'>"+val.amount+"</td>"

+"<td style='font-weight:bold;color:red;'><a href='#' onclick='product_delete("+val.id+","+val.trans_id+","+type+")'>X</a></td>"

							+"</tr>";
							
				
			});
				

				
		$("#gro_amount").val(gross);
		setGrossAmToCash();
		$("#gro_amount").attr('readonly','readonly');
		
		
		$("#dis_taka").val('');
		$("#dis_per").val('');
		$("#li_per").empty();
		$("#li_change").empty();
		

		
		
		document.getElementById("tbody").innerHTML=stuff;
		
		
		
		
		
		
		
		
		
		
		
	
	
}
function product_edit(id,name){
	
	
	
	$("#product").val(name+"*"+id);
	
}
function product_delete2(id,invoice,type){
	
	var con=confirm('Are you sure to delete ?');
	if(con == true){
	
	
		
	
	
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'transaction/product_delete2',
		data:{id:id,invoice:invoice},
		success:function(data)
		{
	
	
	
				table_data_add2(data,type);
				
				
				
		},
		error:function(error)
		{
			alert("Server Error");
		}
	});
	
	}

}
function product_delete(id,invoice,al){
	
	
	
	var con=confirm('Are you sure to delete ?');
	
	if(con == true){
		
		
    $( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });
	$(".img").show();
		
		$("#dis_taka").val('');
		$("#dis_per").val('');
		$("#li_per").empty();
		$("#li_change").empty();
		
		$("#card_pur").empty();
		$("#cash_pur").empty();
		
		var al=$("#pur_complete").val();
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'transaction/product_delete',
		data:{id:id,invoice:invoice,al:al},
		success:function(data)
		{
	
	
	
				
				
				
				
				table_data_add(data,al);
				
				$(".img").hide();
				$("#modals").dialog( "close" );


                               $("#product").val('');
$("#product").focus();
				$("#qun").val('');
				$("#price").val('');
				
				
		},
		error:function(error)
		{
			alert("Server Error");
		}
	});
		
	}
	
	
	
}
function go_invoice(id,type,type_l,ware,store){
	
	var ch="";
	var links="";
	
	
	
	if(type_l == 1 || type_l == 2){
		
		ch="supplier";
		links=li+'transaction/go_invoice';
	}
	else if(type_l == 3 || type_l == 4 || type == 12){
		links=li+'transaction/go_invoice';
		ch="customer";
		
	}
	else{
		ch="customer";
		links=li+'transaction/go_invoice_issu/';
		
	}
	
	 $( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });
	$(".img").show();
	
	
	
	$.ajax({
		type:'POST',
		dataType:'json',
		url:links,
		data:{id:id,type:type,type_l:type_l,ware:ware},
		success:function(data)
		{
	
			var res=store.replace(/%20/g, " ");

	if(store == 0)	
		res="Default Store";

	

		
		$(".s_title").text(res);
	
	
	$.each(data.supp,function(key,val)
			{
	
				$("#in_complete").show();
	
				$("#invoice").val(id);
				$("#"+ch).val(val.sup);
	
	
			$("#"+ch).attr('readonly','readonly');
			
			
			$(".img").hide();
			 $("#modals").dialog( "close" );
			
			
				$("#btn_div").hide();
				
				//if(type_l != 5)
				$("#pro_body").show();
				
					$("#product").focus();
					$("#service_product").val("");
					$("#service_product").focus();
					$("#qun").val("");
					$("#price").val("");
	
			});
			
									
				if(type_l != 5)
				table_data_add(data,type_l);
				else
				table_data_add2(data,type_l);	
				
				
		},
		error:function(xhr, status)
		{
			alert(status);
		}
	});
	
}

 function CloseMe()
         {
             window.opener.location.reload();
             window.close();
         }




$("#pur_btn").click(function(){
	
	
	
	
   
	
	
	
	var invoice=$("#invoice").val();
	var date=$("#pdate").val();
	var store=$(".store_value").val();

	//var stitle=$(".store_value option").attr("data-title");
	var stitle = $('.store_value option:selected').attr('data-title');
	//alert(stitle);
	

	
	
	var type=$("#pur_btn").val();
	var ch="";
	if(type == 1 || type == 2){
			var supp=$("#supplier").val();
			ch="supplier";
	}
	else{
		
		var supp=$("#customer").val();
			ch="customer";
		
	}
	
	if(invoice == '' || date == '' || supp == ''){
		
		
		alert('information incomplete..');
		
	}
	else{
		
		
	
		
	$("#product").val("");
	
			
		
			
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'transaction/new_purchase/',
		data:{invoice:invoice,date:date,supp:supp,type:type,store:store},
		success:function(data)
		{
			
			
			if(data.id == 1){
				
				
				alert('Session Error.Please Agine Login.');
			}
			else if(data.id == 3){
				
				
				alert('already inserted.');
				
			}
			else if(data.id == 2){
				
						
				$("#btn_div").hide();
				
				$("#pro_body").show();
				$("#product").focus();
				$("#pur_complete").val(type);
				
				$("#"+ch).attr('readonly','readonly');
				
				
				
				
			}
			
			
				$(".s_title").text(stitle);

			
		
			
		},
		error:function(error)
		{
			alert("Server Error");
		}
	});
		
		
		
	}
	
	
});