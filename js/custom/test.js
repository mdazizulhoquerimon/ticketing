$.fn.expose = function(options) {
	
  var $modal = $(this),
      $trigger = $("a[href=" + this.selector + "]");
  
  $modal.on("expose:open", function() {
    
    $modal.addClass("is-visible");
    $modal.trigger("expose:opened");
	
		
	
	

  });
  
  $modal.on("expose:closes", function() {
    
    $modal.removeClass("is-visible");
    $modal.trigger("expose:closed");
  });
  
  $trigger.on("click", function() {
    
    //e.preventDefault();
    $modal.trigger("expose:open");
	
	
	
  });
  
  $modal.add( $modal.find(".closes") ).on("click", function(e) {
    
    //e.preventDefault();
    
    // if it isn't the background or close button, bail
    if( e.target !== this )
      return;
    
  	$modal.trigger("expose:closes");
  });
  
  return;
}

$("#Popup").expose();
$("#pop2").expose();
$("#store").expose();

// Example Cancel Button

$(".cancel").on("click", function() {
  

              

  $(this).trigger("expose:closes");


			
			


});



$("#chat").click(function(){
	
	var li=links();
	
	
	var v=$(this).attr('data-id');
	var hds=$(this).attr('data-hd');
	var hdi="k";
	var hd=-1;


	
	 $( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });
	$(".img").show();
	
	
		
	
	
	
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'account_permission/chatof_account',
		data:{v:v},
		success:function(data)
		{
	

	
	var stuff="";
	
	var i=0;
	var ii=0;
	var kk=0;
	var j=0;
	var ll=0;
	var first=0;
	var ch=new Array();
	var hd_id=0;
	var pre=new Array();
	
	pre[0]=0;
	
	  $.each(data.alls,function(key,val)
			{
				
				if(hd == val.head)
				{															
//alert(hd + " head " + val.head);					
					var l=ch.length;						
				for(var k=1;k<=l;k++){

					if(val.head != ch[k-1]){						
						i=1;

						
						
					}
					else{					
							i=0;						
							break;
					}																				
				}
				if(i == 1){
					hd=val.id;
					ch[j]=val.head;															
					i=0;					
					j++;					
				}								
					stuff=stuff+"<tr>"
					
					+"<td><span style='margin-left:"+ii+"px;font-size:18px'> >> "+val.name+"</span></td>"
					
					
							+"</tr>";
			ii=ii+20;
			
				}				
				else{
					
				 ii=0;	
					
				hd=val.id;
				hd_id=val.id;
					
					
				if((hdi == 'k' && first == 0) || val.head == 0){
					j=0;
					ch=new Array();
					
					ch[j]=val.head;
					
					j++;
					first=1;
					
				}
				var l=ch.length;											
				for(var k=1;k<=l;k++){
					if(ch[k-1] != val.head){						
						ii=ii  + (20);						
						i=1;
						ll=1;
						
					}
					else{	

					
							i=0;
							ll=0;

									
						break;
					}	
				}		
							
	
		stuff=stuff+"<tr>"
					
		+"<td><span style='margin-left:"+ii+"px;font-size:18px'> >> "+val.name+"</span></td>"
					
					
							+"</tr>";
							
							
		if(i == 1){
					
					ch[j]=hd;
					i=0;
					
					j++;
				}
		//else
			ii=ii + 20;
							
							
	kk=ii;							
				}
				
				
				
				
				
			});
	
	
	
	
	document.getElementById("cchild").innerHTML=stuff;
	
	
	
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
	
});



function create_ladger(){
	
	
	
	
	
	
	
	$("#ltitle").empty();
	$("#lbody").show();
	$("#pbody").hide();
	$("#ltable").hide();
	$("#ptable").hide();
	$("#pbtn").show();
	$("#ltitle").append("<h3>CREATE LEDGER</h3>");
	$("#pbtn_p").hide();
	
	
	
}
function edit_data_update(id,atr,col,tab){
	

var li=links();

             


	
	var data=$("#"+id+atr+" input").val();	
		
	 var pn=0;
		
	if(col == 'name')	
		pn=charMatch(data,'*');
	
	
	if(pn == 1)
		alert("You can't use * character for product name.");
	else{

	
	 $( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });
	
	
	
	$(".img").show();
	
	
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'product_con/data_edit_update',
		data:{id:id,col:col,data:data,tab:tab},
		success:function(datas)
		{
	
            if(datas.id == 0)
            alert("already inerted.......please try agine");
            
            
           	stuff="<span data-id="+data+">"+data+"</span>";
	
			document.getElementById(id+atr).innerHTML=stuff;
			    $(".img").hide();
			    $("#modals").dialog( "close" );
				
				
				
				
			
				
				
				
				
				
				
				
				
	
		},
		error:function(error)
		{
			alert("Server Error");
		}
	});
	
	}

}
function edit_data(id,atr,col,tab){
	

if(typeof tab == 'undefined')
		tab=2;
         
	
	var data=$("#"+id+atr+" span").attr('data-id');
	
	if(typeof data != 'undefined')
	{
	
stuff="<input style='width:150px;' class='form-control' value='"+data+"'>";
	

	
	
		$("#"+id+atr).empty();
		
		
	document.getElementById(id+atr).innerHTML=stuff;
	
		$("#"+id+atr+" input").focus();
	
	
	
	
	
	
   $("#"+id+atr+" input").focusout(function() {
   

			
   
          edit_data_update(id,atr,col,tab);


  });

}

}

function priceChange(id){
	
	var li=links();
	
	
	var data=document.getElementById(id+"ptype").value;
	var col="ptype";
	
	
	
	
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'product_con/data_edit_updates',
		data:{id:id,data:data,col:col},
		success:function(data)
		{
	
	
			
		},
		error:function(error)
		{
			alert("Server Error");
		}
		});
	
	
}


function pagina_product(start,limit){
	
	
	var li=links();
	
	
	
	
	var limit=limit;
	var start=start;
	var pagin=limit*(start-1);
	
	var id=$("#ladger_all").val();
	
	
	var stuff="";
	
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'product_con/product_all',
		data:{id:id,start:pagin,limit:limit},
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
			
			
			
	$.each(data.posts,function(key,val)
			{
				
				
				
				
				
				cars[len]=val.id;
				category[len]=val.category;
				pr_type[len]=val.ptype;
				ware[len]=val.ware;
				
				
				
					stuff=stuff+"<tr>"
					
//+"<td><span id='"+val.id+"c'>"+val.code+"</span></td>"
					
//+"<td id='"+val.id+"code' ondblclick=edit_data("+val.id+",'code','code')><span data-id='"+val.code+"' id='"+val.id+"c'>"+val.code+"</span></td>"
+"<td id='"+val.id+"code'><span data-id='"+val.code+"' id='"+val.id+"c'>"+val.code+"</span></td>"
					
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
+"<td><form id='img"+val.id+"' method='post' enctype='multipart/form-data' action='"+li+"product_con/change_photo'><input type='file' onChange=photoChange("+val.id+") name='photoimg' /><input type='hidden' name='valueid' value='"+val.id+"' /></form><div id='preview"+val.id+"' style='padding:5px'></div></td>"

					
					

				
			+"</tr>";
							
				len++;
			
			
			
			});
			
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
		
		
			
					
				$.each(data.tledger,function(key,val)
			{
				
				
				total=val.total;
				
			});
			
			
		
			
		var pagination="";
			var page=0;
			if(total<=limit)
				{
pagination=pagination+"<li><a href='#' style='color:red;font-weight:bold;text-decoration:none;padding:5px'>1</a></li>";
				
				}
				
				else{
					
					var p=total/limit;
					var p_modulas=total % limit;
					
					if(p_modulas != 0){
						
						p=p+1;
						
					}
					
					
					
			var end=start+2;		
			var loop=start-2;
			
			
				if(loop<1){
					
					loop=1;
					end=5;
					
				}
				if(end>p){
					
					end=p;
				}
			
			
			
			for(var i=loop;i<=end;i++){
				
				
				
				if(i == start){
					
					
					pagination=pagination+"<li><a style='color:red;font-weight:bold;text-decoration:none;padding:5px' href='#'>"+i+"</a></li>";
					
				}
				else{
					
					
pagination=pagination+"<li><a href='#' onclick=pagina_product("+i+","+limit+")>"+i+"</a></li>";
					
				}
				
				
			}

			
				}	
					
					
					
					
					
				
					
					
			thed=document.getElementById("page_c");
			thed.innerHTML="Total Product : "+total;
				
				
			thed=document.getElementById("pc");
			thed.innerHTML=pagination;
		
		
		
		
		
		
		
		
		
		
		
		
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
function product_all(){
	
	
	var start=1;
	var limit=10;
	
	
	$("#pbtn_p").hide();
	$("#ltitle").empty();
	$("#lbody").hide();
	$("#pbody").hide();
	$("#ltable").hide();
	$("#ptable").show();
	$("#pbtn").hide();
	$("#ltitle").append("<h3>Product ALL</h3>");
	
	pagina_product(start,limit);
	
	
	
	
	
}
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
function pagina(start,limit)
{
	

	
	
	var li=links();
	
	$("#pagi").empty();
	
	var head=$("#ladger_all").val();
	
	var limit=limit;
	var start=start;
	var pagin=limit*(start-1);
	var total=0;
	
	
	$.ajax({
		type:'POST',
		dataType:'json',
        url: li+"product_con/ladger_all/",
		data:{
			head:head,limit:limit,start:pagin
			},
		success:function(data)
		{
			
			
		
			
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
					
					
					
					
					
/*+"<td style='font-weight:bold;color:red;'><span id='"+val.id+"edit'><a href='#' onclick=ledger_edit("+val.id+",'"+encodeURIComponent(val.ledger_title)+"','"+encodeURIComponent(val.bank_name)+"','"+encodeURIComponent(val.branch_address)+"','"+encodeURIComponent(val.bank_account_name)+"','"+encodeURIComponent(val.bank_account_no)+"','"+encodeURIComponent(val.opening_balance)+"','"+encodeURIComponent(val.remarks)+"') style='color:red'>Edit</a></span></td>"
					+"<td style='font-weight:bold;color:red;'><span id='"+val.id+"ddel'><a href='#' style='color:red;' onclick=ledger_delete("+val.id+","+val.head+")>X</a></span></td>"*/
				
							+"</tr>";
							
				
			});
			
			
			
			document.getElementById("table_data").innerHTML=stuff;
			$("#192ddel").empty();
			
			$.each(data.tledger,function(key,val)
			{
				
				
				total=val.total;
				
			});
			
			
		var pagination="";
			var page=0;
			if(total<=limit)
				{
pagination=pagination+"<li><a href='#' style='color:red;font-weight:bold;text-decoration:none;padding:5px'>1</a></li>";
				
				}
				
				else{
					
					var p=total/limit;
					var p_modulas=total % limit;
					
					if(p_modulas != 0){
						
						p=p+1;
						
					}
					
					
					
			var end=start+2;		
			var loop=start-2;
				if(loop<1){
					
					loop=1;
					end=5;
					
				}
				if(end>p){
					
					end=p;
				}
			
			
			
			for(var i=loop;i<=end;i++){
				
				
				
				if(i == start){
					
					
					pagination=pagination+"<li><a style='color:red;font-weight:bold;text-decoration:none;padding:5px' href='#'>"+i+"</a></li>";
					
				}
				else{
					
					
pagination=pagination+"<li><a href='#' onclick=pagina("+i+","+limit+")>"+i+"</a></li>";
					
				}
				
				
			}

			
				}
			
				
			
			thed=document.getElementById("job_count");
			thed.innerHTML="Total Ledger : "+total;
				
				
			thed=document.getElementById("pagi");
			thed.innerHTML=pagination;
			
				
			
			
			
			
		},
		error:function(error)
		{
			//alert('Server Error....');
		}
	});
	
	
}
function ladger_all(){
	
	
	var limit=10;
	var start=1;
	
	pagina(start,limit);
	
	
	
	
	$("#pbtn_p").hide();
	$("#ltitle").empty();
	$("#lbody").hide();
	$("#pbody").hide();
	$("#ltable").show();
	$("#pbtn").hide();
	$("#ptable").hide();
	$("#ltitle").append("<h3>LEDGER ALL</h3>");
	
	
	var id=$("#ladger_all").val();
	
	
	stuff="";
	
	
	
	
	
}
function process(){
	
	var li=links();
	
	var id=$("#submit_l").val();
	var title=$("#title").val();
	var remark=$("#remark").val();
	var date=$("#date").val();
	var balance=$("#balance").val();
	var address=$("#address").val();
	var wire=$("#wl").val();
	var ac_no=$("#ac_no").val();
	var ac_name=$("#ac_name").val();
	var bname=$("#bname").val();
	var phone=$("#phone").val();
	
	if(title == ''){
		
		alert('Ladger Title Empty');
		
	}
	else{
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'product_con/create_ladger',
		data:{id:id,title:title,remark:remark,date:date,balance:balance,address:address,ac_no:ac_no,ac_name:ac_name,bname:bname,wire:wire,phone:phone},
		success:function(data)
		{
		
			if(data.id == 2){
				
				alert('already ledger name created.');
				
			}
			else{
			$("#title").val('');
			$("#remark").val('');
			$("#date").val('');
			$("#balance").val('');
			$("#address").val('');
			$("#ac_no").val('');
			$("#ac_name").val('');
			$("#bname").val('');
			
			
			alert('inserted');
			
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