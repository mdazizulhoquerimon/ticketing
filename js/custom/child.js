



function parent_change(id,head,ob,chs ){
	
	var li=links();
	
	

	
	$("#pop").show();
	$("#submit_l").val(id);
	$("#submit_p").val(id);
	$("#product_all").val(id);
	$("#ladger_all").val(id);
	
	$("#body").empty();
	$("#re").empty();
	
	
	if(typeof chs == 'undefined')
	{
		 $( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });
	$(".img").show();
	
	}

	
	
	var head=head;
	if(head == ''){
		
		head=0;
		
	}
	var table="setting";
	
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'account_permission/transaction',
		data:{id:id,table:table,head:head},
		success:function(data)
		{
			

			var stuff="";
var i=-1;
			 $.each(data.posts,function(key,val)
			{
				
				
			stuff=stuff+"<strong id='hh'><a onclick=parent_change("+val.id+","+val.head+","+ob+") href='#'>->"+val.name+"</a></strong>";


if(val.id == 83 || i == val.head)
			{
				i=val.id;
				
				
				
				$("#btn_product").show();
				$("#product_all").show();
				
			}
			else{
				
				
				
				$("#btn_product").hide();
				$("#product_all").hide();
			}


				
			});
			
			
			
			document.getElementById("sub").innerHTML=stuff;
			
			
			
			
			
			add(id,table,head,ob);
			
			
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
function add_child(id,ob)
{
	
	
		var li=links();
	
	
	
	
	var name=document.getElementById(id).value;
	
	
	
	
	
	if(name != ''){
		
		
	 $( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });
	$(".img").show();
		
		
		
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'account_permission/add_list',
		data:{name:name,id:id,ob:ob},
		success:function(data)
		{
			
			

			
			add_list(data,ob);
			
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
function add_list(data,ob){
	
	var stuff2="";
	var edit="";
	var del="";
	var i=1;
	$.each(data.posts,function(key,val)
			{
				
				if(val.acces == 1){
					
					edit="Edit";
					del="X";
				}
				
				
				stuff2=stuff2+"<div class='row'>"
				
+"<div class='col-sm-6' id='"+val.id+"s'><label style='font-size:20px;text-align:right;' onclick=parent_change("+val.id+","+val.head+","+ob+")>"+ i++ +")"+val.name+"</label></div>"+								
							
"<div style='text-align: right' class='col-sm-1' id='"+val.id+"main' onclick=edit_new("+val.id+",'"+encodeURIComponent(val.name)+"',"+(i-1)+","+val.head+","+ob+")><a href='#' style='color:red;font-weight:bold;'>"+edit+"</a></div>"
+"<div class='col-sm-1' id='"+val.id+"d'><a onclick=delete_new("+val.id+","+val.head+","+ob+") href='#' style='color:red;font-weight:bold'>"+del+"</a></div>"
							
								
							+"</div>"
	

				
			});
			
			
			

document.getElementById("re").innerHTML=stuff2;
	
}
function add(id,table,head,ob){
	
	
	var li=links();
	
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'account_permission/getChild',
		data:{id:id,table:table,head:head},
		success:function(data)
		{
			
			

	
	
		var stuff="";
		var stuff2="";
		var child="";
		var head="";
	
	stuff=stuff+"<div class='form-group'>"
	
				
				+"<label style='text-align:right' class='col-sm-3 control-label'>Create New</label>"
				
				+"<div class='col-sm-4'>"
				
					+"<input type='text' id="+id+" class='form-control'>"
				
				+"</div>"
				
				+"<div class='col-sm-2'>"
				
	+"<input onclick=add_child("+id+","+ob+") type='button' name='name'  value='Add' class='btn btn-primary'>"
				
				+"</div>"
				
	
			   +"</div>";
			   var i=1;
			   var edit="";
			   var del="";
			  $.each(data.posts,function(key,val)
			{
				if(val.acces == 1){
					
					edit="Edit";
					del="X";
				}
				
				

				stuff2=stuff2+"<div class='row'>"
				
+"<div class='col-sm-6' id='"+val.id+"s'><label data-id='"+val.id+"' style='font-size:20px;text-align:right;' onclick=parent_change("+val.id+","+val.head+","+ob+")>"+ i++ +")<a href='#' class='"+val.id+"text'>"+val.name+"</a></label></div>"+								
							
"<div style='text-align: right' class='col-sm-1' id='"+val.id+"main' onclick=edit_new("+val.id+",'"+encodeURIComponent(val.name)+"',"+(i-1)+","+val.head+","+ob+")><a href='#' style='color:red;font-weight:bold;'>"+edit+"</a></div>"
+"<div class='col-sm-1' id='"+val.id+"d'><a onclick=delete_new("+val.id+","+val.head+","+ob+") href='#' style='color:red;font-weight:bold'>"+del+"</a></div>"
							
+"<div class='col-sm-5' id='"+val.id+"_edit'></div>"
								
							+"</div>"
							
	

				
			});
			
			
			

			   
		document.getElementById("body").innerHTML=stuff;	   
		document.getElementById("re").innerHTML=stuff2;	   
			   
	
			$(".img").hide();
			$("#modals").dialog( "close" );
	
		},
		error:function(error)
		{
			alert("Server Error");
		}
	});
	
	
	
	
	
	
			   
	
}

$("#re").on("mouseenter","label",function(){
	
		var id=$(this).attr('data-id');
	var li=links();


	if(typeof id != 'undefined')
	{
		
		
	$("#"+id+"_edit").load(li+"mains/loadFile/"+id,function( response, status, xhr){
	
	
	
	if ( status == "error" ) {
		
		alert("page not found");
		
		
			}
	
	});
	

	}
	
});
function edit_drop(id,name)
{
	
	
	
	$("#head_move_modal").modal("show");	
	var ctext=$("."+id+"text").text();
	
	$("#cate_name").val(ctext);
	$("#note").val(name);
	
	$("#cate_update").val(id);
	
}

function CloseModal(){
	
	$("#head_move_modal").modal("hide");
	
	$("#cate_name").val("");
	$("#note").val("");
	
	$("#cate_update").val(0);
	
	$( "#move" ).attr("readonly",false);
	$( "#move" ).val("");
	
}

	   $( "#move" )
      .keyup(function(){
		  
		  var v=$( "#move" ).val();
		  
	var li=links();

		  
		  if(v != '')
		   $( "#move" ).addClass('ac_loading');
		 else
			  $( "#move" ).removeClass('ac_loading');
		  
		  $( "#move" ).autocomplete({
    source: function( request, response ) {
		
		 $.ajax({
		
		type:'POST',
		dataType:'json',
		 url: li+"mains/getSetting",
		data:{id:v},
		success:function(data)
			{
	
	
	   response(data);
	  
	  
			}
				});
					
					
	$( "#move" ).removeClass('ac_loading');
	
	
	
	
	
			},
			select: function( event , ui ) {
    
	//var da=ui.item.label;
	
	$( "#move" ).attr("readonly",true);
	$( "#move" ).val(ui.item.label);
	
	
}
		
		
		 });
		  
	$( "#move" ).autocomplete( "option", "appendTo", ".auto_com" );	  
		  
});


//	parent_change("+val.id+","+val.head+","+ob+")

$("#cate_update").click(function(){
	
	
	var c=confirm("Are you sure to update");
	
	var v=$(this);
	
	if(c == true)
	{
			var li=links();

		var id=$(this).val();
		if(id != 0){
		
		v.text("Loading....");
		v.attr("disabled",true);
		
		var name=$("#cate_name").val();
		var note=$("#note").val();
		var move=$("#move").val();
		
		$.ajax({
		type:'POST',
		dataType:'json',
		url: li+'mains/update_setting/',
		data:{id:id,name:name,note:note,move:move},
		success:function(data)
		{	

			$("#myModal").modal("hide");
			$("#cate_name").val("");
			$("#note").val("");
			$( "#move" ).attr("readonly",false);
	        $( "#move" ).val("");
			
			v.text("Submit");
			v.attr("disabled",false);
			
			
		parent_change(data.id,data.head,data.ob);

		
			
				
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
	
	
	
	
});












