		$(document).ready(function(){
			
       var li=links();
              
		$('body').on('change','#photoimg', function(){ 
			           $("#preview").html('');
   var stuff="<img id='img' src='"+li+"img/loader.gif' alt='Uploading....'>";

	document.getElementById("preview").innerHTML=stuff;			
					  
				
			$("#imageform").ajaxForm({
					target: '#preview'
				}).submit();
		
			});	
			
			
			
			

			
			
			
		});
		
		

	$(".eventInsForm input").keypress(function(e){
		
		
		
		
		
		if(e.keyCode == 13)
		{
		    
		
				var li=links();
			
			var code=$(this).val();
			
	
			$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'product_con/search_product',
		data:{code:code},
		success:function(data)
		{
		
		
		
		
		
		var total=0;
		
			var len=0;
			var stuff2="";
			var type="";
			var cash=0;
			var cars=new Array();
			var category=new Array();
			var pr_type=new Array();
			var ware=new Array();
			
			var stuff="";
			
	$.each(data.posts,function(key,val)
			{
				
			
				cars[len]=val.id;
				category[len]=val.category;
				pr_type[len]=val.ptype;
				ware[len]=val.ware;
				
			
					stuff=stuff+"<tr>"
										
+"<td id='"+val.id+"code' ondblclick=edit_data("+val.id+",'code','code')><span data-id='"+val.code+"' id='"+val.id+"c'>"+val.code+"</span></td>"
					
	+"<td id='"+val.id+"n' ondblclick=edit_data("+val.id+",'n','name')><span data-id='"+val.name+"'>"+val.name+"</span></td>"
	
+"<td id='"+val.id+"cp' ondblclick=edit_data("+val.id+",'cp','carton')><span data-id='"+val.carton+"'>"+val.carton+"</span></td>"


+"<td><select style='width:150px;display:none;' id='"+val.id+"ce' class='form-control'></select></td>"


+"<td><select onChange=priceChange("+val.id+") style='width:150px;' id='"+val.id+"ptype' class='form-control'></select></td>"
					
					
+"<td id='"+val.id+"un' ondblclick=edit_data("+val.id+",'un','unit')><span data-id='"+val.unit+"'>"+val.unit+"</span></td>" 
					
					
+"<td id='"+val.id+"sor' ondblclick=edit_data("+val.id+",'sor','sorting')><span data-id='"+val.sorting+"'>"+val.sorting+"</span></td>"
					
					
+"<td id='"+val.id+"op' ondblclick=edit_data("+val.id+",'op','opening_stock')><span data-id='"+val.opening_stock+"'>"+val.opening_stock+"</span></td>"
					
					
+"<td id='"+val.id+"bp' ondblclick=edit_data("+val.id+",'bp','buy_price')><span data-id='"+val.buy_price+"'>"+val.buy_price+"</span></td>"
					
					
+"<td id='"+val.id+"cost' ondblclick=edit_data("+val.id+",'cost','cost')><span data-id='"+val.cost+"'>"+val.cost+"</span></td>"
					
					
+"<td id='"+val.id+"sp' ondblclick=edit_data("+val.id+",'sp','selling_price')><span data-id='"+val.selling_price+"'>"+val.selling_price+"</span></td>"
					
					
					+"<td><select style='width:150px;' id='"+val.id+"ware'></select></td>"
					
+"<td id='"+val.id+"dist' ondblclick=edit_data("+val.id+",'dist','dis_taka')><span data-id='"+val.dis_taka+"'>"+val.dis_taka+"</span></td>"
+"<td id='"+val.id+"disp' ondblclick=edit_data("+val.id+",'disp','dis_percent')><span data-id='"+val.dis_percent+"'>"+val.dis_percent+"</span></td>"
					
					

				
							+"</tr>";
							
				len++;
		
			});
			
			
			$("#ptable_data").empty();
			
		document.getElementById("ptable_data").innerHTML=stuff;
		
		
		

		
		var pc="";
		for(var i=0;i<len;i++){
			
			var ops="";
			var op="";
			
			$.each(data.options,function(key,val)
			{
			
					if(val.id == category[i])
					{
			
				ops=ops+"<option value="+val.id+" selected='selected'>"+val.name+"</option>";
				
					}
					else{
						
	ops=ops+"<option value="+val.id+">"+val.name+"</option>";					
						
					}
					
					
				
			});
			
			
			var k=0;
			$.each(data.ware,function(key,val)
					{
						
						if(ware[i] == 0 && k == 0)
							{
								
						op=op+"<option value='0' selected='selected'>Admin</option>";
						
							k=1;
						
							}
						
						if(val.id == ware[i])
							{
			
								op=op+"<option value="+val.id+" selected='selected'>"+val.name+"</option>";
				
							}
					
						else{
						
								op=op+"<option value="+val.id+">"+val.name+"</option>";					
						
							}
					
					
				
					});

				document.getElementById(cars[i]+"ware").innerHTML=op;

			
			if(pr_type[i] == 1){
						
	pc="<option value='1' selected='selected'>Fixed Price</option><option value='2'>Customize Price</option>";
					}
					else{
						
pc="<option value='1'>Fixed Price</option><option value='2' selected='selected'>Customize Price</option>";						
					}
					
			
			document.getElementById(cars[i]+'ce').innerHTML=ops;
			document.getElementById(cars[i]+'ptype').innerHTML=pc;

			pc="";
		}
		
		
		$("#search_pro").val("");
		$("#search_pro").focus();

		},
		error:function(jqXHR, textStatus, errorThrown)
		{
			
			//alert(jqXHR.responseText);
			
			
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

function search(v){
		
		
		var li=links();
		
		
		
		
        $(v).addClass('ac_loading');		
		
		 var id=$(v).val();
		
		
		
		$(v).autocomplete({
    source: function( request, response ) {
		
		 $.ajax({
		
		type:'POST',
		dataType:'json',
		url:li+'transaction/getProductList/',
		data:{id:id},
		success:function(data)
			{
	
	
				response(data);
	  
	  
			}
			
			
	});
					
					
	$(v).removeClass('ac_loading');
	
	
	
	
	
			}
		
		
		 });
		 
		 
	$(v).autocomplete( "option", "appendTo", ".eventInsForm" );
		
		
		
	}
	
	
	function ledgerShow(data){
	    
	    
			
			var jobs=0;
	
			var stuff2="";
			var type="";
			var cash=0;
			var stuff="";
	$.each(data.posts,function(key,val)
			{
				
				
					stuff=stuff+"<tr>"
					//+"<td id='"+val.id+"nn' ondblclick=edit_data("+val.id+",'nn','ledger_title',1)><span data-id='"+val.ledger_title+"'>"+val.ledger_title+"</span></td>"
					


+"<td id='"+val.id+"nn' ondblclick=edit_data("+val.id+",'nn','ledger_title',1)><span data-id='"+val.ledger_title+"'>"+val.ledger_title+"</span></td>"




	+"<td id='"+val.id+"bn' ondblclick=edit_data("+val.id+",'bn','bank_name',1)><span data-id='"+val.bank_name+"'>"+val.bank_name+"</span></td>"
					
					
					
					+"<td id='"+val.id+"ba' ondblclick=edit_data("+val.id+",'ba','branch_address',1)><span data-id='"+val.branch_address+"'>"+val.branch_address+"</span></td>"
					
					
					
					
					+"<td id='"+val.id+"ban' ondblclick=edit_data("+val.id+",'ban','bank_account_name',1)><span data-id='"+val.bank_account_name+"'>"+val.bank_account_name+"</span></td>"
					
					
					
					+"<td id='"+val.id+"bano' ondblclick=edit_data("+val.id+",'bano','bank_account_no',1)><span data-id='"+val.bank_account_no+"'>"+val.bank_account_no+"</span></td>"
					
					
					
					
					+"<td id='"+val.id+"op' ondblclick=edit_data("+val.id+",'op','opening_balance',1)><span data-id='"+val.opening_balance+"'>"+val.opening_balance+"</span></td>"
					
					
					
					+"<td id='"+val.id+"rem' ondblclick=edit_data("+val.id+",'rem','remarks',1)><span data-id='"+val.remarks+"'>"+val.remarks+"</span></td>"
					
					
	                    +"<td id='"+val.id+"phone' ondblclick=edit_data("+val.id+",'phone','phone',1)><span data-id='"+val.phone+"'>"+val.phone+"</span></td>"		


							+"</tr>";
							
				
			});
			
			
			
			document.getElementById("table_data").innerHTML=stuff;

		
		
		
	    
	    
	    
	}
	
	
		$(".eventInsForm_ledger input").keypress(function(e){
	
		    if(e.keyCode == 13)
	        	{
		    	
		    		var code=$(this).val();
		    	

		    		var li=links();

		
		                    $.ajax({
		                        type:'POST',
		                        dataType:'json',
		                        url:li+'product_con/getLedger_search',
		                        data:{code:code},
		                        success:function(data)
		                            {
		                                
		                                ledgerShow(data);
		                                
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
	
	

	function ledger_search(v,t){
		
		
		var li=links();
		
		
		
		
        $(v).addClass('ac_loading');		
		
		 var id=$(v).val();
		
		
		
		$(v).autocomplete({
    source: function( request, response ) {
		
		 $.ajax({
		
		type:'POST',
		dataType:'json',
		url:li+'transaction/getSupplierList/',
		data:{val:id,t:t},
		success:function(data)
			{
	
	
				response(data);
	  
	  
			}
			
			
	});
					
					
	$(v).removeClass('ac_loading');
	
	
	
	
	
			}
		
		
		 });
		 
		 
	$(v).autocomplete( "option", "appendTo", ".eventInsForm_ledger" );
		
		
		
	}
		
		
		
		
		
		
		
		
		
		


function photoChange(id){
	
	       var li=links();

	
	$("#preview"+id).html('');
   var stuff="<img id='img' src='"+li+"img/loader.gif' alt='Uploading....'>";

	document.getElementById("preview"+id).innerHTML=stuff;

	
	$("#img"+id).submit(function(){

    var formData = new FormData(this);

	
	alert('ok')
	
    $.ajax({
        url: li+"product_con/change_photo",
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
            alert(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
	
	});
	
	
	/* $("#img"+id).ajaxForm(function() {
		 
           alert("Thank you for your comment!");
		   
		   
       });
	*/
	/*$("#img"+id).ajaxForm({
		
		target: '#preview'+id
	
		}).submit();
		*/
			
	
}

		
function charMatch(string, ch){
	
  for(var i=0;i<string.length;i++)
  {
    if(string.charAt(i) == ch)
		return 1;
		
  }
  
  return 0;
  
}	
		
	function process_p(){
	
	var li=links();
	
	
	
	var id=$("#submit_p").val();
	var sell=$("#sell").val();
	var cost=$("#cost").val();
	var buy=$("#buy").val();
	var carton=$("#carton").val();
	var opening=$("#open").val();
	var sort=$("#sorting").val();
	var unit=$("#unit").val();
	var category=$("#category").val();
	var ware=$("#ware").val();
	var pname=$("#pname").val();
	var pcode=$("#pcode").val();
	var ptype=$("#price_type").val();
	
	
	
   var test = $("#img").attr('src').split('\/');
    
	var img=test[test.length-1];
	
	if(img == 'loader.gif')
		img="";

	var pn=charMatch(pname,'*');
	var pc=charMatch(pcode,'*');

	
	if(pn == 1 || pc == 1)
		alert("You can't use * character for product name or product code.");
	else if(sell == '' || buy == '' || opening == '' || pname == '' || pcode == ''|| ware== '' || ptype == ''){
		
		alert('Information not complete');
		
	}
	else{
		
		
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'product_con/create_product',
data:{id:id,sell:sell,cost:cost,buy:buy,opening:opening,sort:sort,unit:unit,category:category,ware:ware,pname:pname,pcode:pcode,carton:carton,ptype:ptype,img:img},
		success:function(data)
		{
		
			if(data.id == 1){
				
				alert('product code already created this ware house...');
			}
			else if(data.id == 2){
				
				alert('inserted');
				
			$("#sell").val('');
			$("#cost").val('');
			$("#buy").val('');
			$("#open").val('');
			$("#sorting").val('');
			$("#unit").val('');
			$("#category").val('');
			$("#ware").val('');
			$("#pname").val('');
			$("#pcode").val('');
				
			}
			
			

			
			
		
		},
		error:function(error)
		{
			alert("Server Error");
		}
		});
		
		
		
		
		
	}
	
	
}



$(".closes").click(function(){

 var li=links();

	$("#preview").html('');

 var stuff="<img style='display:none' id='img' src='"+li+"img/loader.gif' alt='Uploading....'>";

                 	document.getElementById("preview").innerHTML=stuff;

   			//$("#img").css({'display':'none'});

			

});






	
	
/*
$(".bhead button").click(function(){
	
	var code=$("#titles p").attr('data-id');
	var name=$("#titles p").attr('data-hveid');
	var cur=$(this).val();
	
	
	var start=$(".start").val();
	var end=$(".end").val();
	
	
	if(code == '' || name == '' || start == '' || end == ''){
		
		alert('check your informatin');
		
		
	}
	else{
		
		
		if(cur == 1)
		{
			
var win = window.open(li+"mains/product_ledger/"+code+"/"+start+"/"+end, '_blank');
	if(win){
    //Browser has allowed it to be opened
    win.focus();
}else{
    //Broswer has blocked it
    alert('Please allow popups for this site');
}		
		//window.location=li+"mains/product_ledger/"+code+"/"+start+"/"+end;		
			
			
		}
		
	
		else{
			
			
			
	var win = window.open(li+"mains/product_ledger_monthly/"+code+"/"+start+"/"+end, '_blank');		
			
			
			
			
			
			
		}
		
		
		
		
		
		
		
		
	}
	
	
	
	
});

	
		
	
	$("#phover a").click(function(){
		
		
		
		var data=$(this).attr('data-id');
		var name=$(this).attr('data-hveid');
		
	
	
	
			$(".notice").show();
	
	
	
	var stuff="<p data-id='"+data+"' data-hveid='"+name+"'>"+data+"</p>";
	
document.getElementById("titles").innerHTML=stuff;
	
		
		
		
	})
	
	
	$("#bhead button").val(data);
	
	
	
	
	
	 // .mouseout(function() {
		 
   
	// $(".notice").hide();
	
	
  // });
	
	
	 
	
	$(".closes").click(function(){

 $("#preview").html('');

 var stuff="<img src='"+li+"img/loader.gif' alt='Uploading....'>";

                 	document.getElementById("preview").innerHTML=stuff;

   			$("#img").css({'display':'none'});

});





function create_product(){
	
	
	
		$("#ltitle").empty();
		$("#lbody").hide();
		$("#pbody").show();
		$("#ltable").hide();
		$("#ptable").hide();
		$("#pbtn").hide();
		$("#pbtn_p").show();
		
		$("#ltitle").append("<h3 style='border-bottom:2px solid;padding-bottom:5px;padding-top:5px;background:black;color:white'>CREATE PRODUCT LEDGER</h3>");
	
	
}


function process_p(){
	
	var id=$("#submit_p").val();
	var sell=$("#sell").val();
	var cost=$("#cost").val();
	var buy=$("#buy").val();
	var carton=$("#carton").val();
	var opening=$("#open").val();
	var sort=$("#sorting").val();
	var unit=$("#unit").val();
	var category=$("#category").val();
	var ware=$("#ware").val();
	var pname=$("#pname").val();
	var pcode=$("#pcode").val();
	var ptype=$("#price_type").val();
	
	
	
   var test = $("#img").attr('src').split('\/');
    
	var img=test[test.length-1];
	
	if(img == 'loader.gif')
		img="";



	
	if(sell == '' || buy == '' || opening == '' || pname == '' || pcode == ''|| ware== '' || ptype == ''){
		
		alert('Information not complete');
		
	}
	else{
		
		
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'admin/create_product',
data:{id:id,sell:sell,cost:cost,buy:buy,opening:opening,sort:sort,unit:unit,category:category,ware:ware,pname:pname,pcode:pcode,carton:carton,ptype:ptype,img:img},
		success:function(data)
		{
		
			if(data.id == 1){
				
				alert('product code already created this ware house...');
			}
			else if(data.id == 2){
				
				alert('inserted');
				
			$("#sell").val('');
			$("#cost").val('');
			$("#buy").val('');
			$("#open").val('');
			$("#sorting").val('');
			$("#unit").val('');
			$("#category").val('');
			$("#ware").val('');
			$("#pname").val('');
			$("#pcode").val('');
				
			}
			
			

			
			
		
		},
		error:function(error)
		{
			alert("Server Error");
		}
		});
		
		
		
		
		
	}
	
	
}*/