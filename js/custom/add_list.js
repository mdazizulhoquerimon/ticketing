
function edit_new(id,name,sl,head,ob){
	
	var li=links();
		
	var val=$("#"+id+"s").empty();
	var val=$("#"+id+"d").empty();
	//var v=$("#"+id+"v").val();
	
	$("#"+id+"main").empty();
	
	$("#"+id+"main").append("<a href='#' style='color:red;font-weight:bold;' onclick=save("+id+","+sl+","+head+","+ob+")>Save</a>");
	
	$("#"+id+"s").append("<input style='margin-bottom:5px' id=save_"+id+" type='text' value="+name+" class='form-control'>");
	

	$("#"+id+"d").append("<a href='#' style='color:red;font-weight:bold;' onclick=reload('"+id+"d',"+id+","+sl+",'"+name+"',"+head+","+ob+")>X</a>");

	
	var str = document.getElementById("save_"+id).value; 
    var res = str.replace(/%20/g, " ");
	 // res = str.replace(/%26/g, " ");
    document.getElementById("save_"+id).value= res;
	
}	
function list(data){
		
	var li=links();	
		var stuff2="";
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
				
+"<div class='col-sm-6' id='"+val.id+"s'><label style='font-size:20px;text-align:right;' onclick=parent_change("+val.id+","+val.head+")>"+ i++ +")"+val.name+"</label></div>"+								
							
"<div style='text-align: right' class='col-sm-1' id='"+val.id+"main' onclick=edit_new("+val.id+",'"+encodeURIComponent(val.name)+"',"+(i-1)+","+val.head+")><a href='#' style='color:red;font-weight:bold;'>"+edit+"</a></div>"
+"<div class='col-sm-1' onclick=delete_new("+val.id+","+val.head+") id='"+val.id+"d'><a href='#' style='color:red;font-weight:bold'>"+del+"</a></div>"
							
								
							+"</div>"
							
	

				
			});
		
		document.getElementById("re").innerHTML=stuff2;


		
	}
function delete_new(id,head,ob){
	
	var li=links();
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
		url:li+'account_permission/add_delete',
		data:{id:id,head:head},
		success:function(data)
		{

  
                      if(data == 1)
                        alert("Can't be delete..");
			else{
			add_list(data,ob);
			}
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
function save(id,sl,head,ob){
	
	var name=$("#save_"+id+"").val();
	
	var li=links();
	
	//alert(name);
	
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'account_permission/add_update',
		data:{name:name,id:id},
		success:function(data)
		{
			
			
			$("#"+id+"s").empty();
	
	$("#"+id+"s").append("<label onclick=parent_change("+id+",'"+name+"',"+ob+") style='font-size:20px;padding:0px;' class='col-sm-12 control-label'>"+sl+")"+name+"</label>");
	
	$("#"+id+"main").empty();
	$("#"+id+"main").append("<a onclick=edit_new("+id+",'"+name+"','"+sl+"',"+head+","+ob+") style='color:red;font-weight:bold' href='#'><span id="+id+">Edit</span></a>");
	
	$("#"+id+"d").empty();
	$("#"+id+"d").append("<a href='#' style='color:red;font-weight:bold;' onclick=delete_new("+id+","+head+","+ob+")>X</a>");
			
			
		},
		error:function(error)
		{
			alert("Server Error");
		}
	});
	
	
	
}
function reload(de,id,sl,name,head,ob){



	$("#"+id+"s").empty();
	
	$("#"+id+"s").append("<label onclick=parent_change("+id+",'"+name+"',"+ob+") style='font-size:20px;padding:0px' class='col-sm-3 control-label'>"+sl+")"+name+"</label>");
	
	$("#"+id+"main").empty();
	$("#"+id+"main").append("<a onclick=edit_new("+id+",'"+name+"','"+sl+"',"+head+","+ob+") style='color:red;font-weight:bold' href='#'><span id="+id+">Edit</span></a>");
	
	$("#"+de+"").empty();
	$("#"+de+"").append("<a href='#' style='color:red;font-weight:bold;' onclick=delete_new("+id+","+head+","+ob+")>X</a>");
	
	
}
$("#add").click(function(){
	var li=links();
	
	var name=$("#name").val();
	
	$.ajax({
		type:'POST',
		dataType:'json',
		url:li+'account_permission/add_list',
		data:{name:name},
		success:function(data)
		{
			
			window.location=li+"admin/create_new";
			
			
		},
		error:function(error)
		{
			alert("Server Error");
		}
	});
	
});