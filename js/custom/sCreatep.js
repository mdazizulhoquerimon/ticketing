
var li=links();	
	
	
	function slCreatSubmit(v){
		
		
	var sell=$("#sell").val();
	var head=$("#lhead").val();
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
		
	}
	
	$(document).ready(function() {
			

			
		shortcut.add("Ctrl+l",function() {
		
		$("#sLegerOpen").modal("show");
		
			lHead();
	
		});
			
			
	$('body').on('change','#photoimg', function(){ 
	
		$("#preview").html('');
   var stuff="<img id='img' src='"+li+"img/loader.gif' alt='Uploading....'>";

	document.getElementById("preview").innerHTML=stuff;			
					  
				
			$("#imageform").ajaxForm({
					target: '#preview'
				}).submit();
		
			});			
			
			
			
	});
	
function lHead(){
		
		var stuff="";
				
		
	$.ajax({
				type: "POST",
                url: li+"admin/getLedgerHead", 
                dataType: "json",
                success: function(data) {
					
					
					
		$.each(data.list,function(key,val){
		

						
stuff=stuff+"<option value='"+val.id+"'>"+val.name+"</option>";					
						
						
					});
					
					
				$("#lhead").html(stuff);
					
					
                }
            });
			
			
		
	}