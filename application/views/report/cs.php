
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
				<div class="col-sm-12">
				
                <div class="row" style="margin-top:5px;border-bottom: 2px dotted #384848;">
                   
				   
					<div class="col-sm-2">
					
						<input class="form-control" id="cs" onkeyup="customer_and_supplier()" placeholder="search customer or supplier" autofocus>
					
					</div>
				   
				   <div class="col-sm-2">
					
						<input class="form-control tcal tcalInput" value="<?php echo date('d-m-Y'); ?>" id="start_date">
					
					</div>
				   <div class="col-sm-2">
					
						<input class="form-control tcal tcalInput" value="<?php echo date('d-m-Y'); ?>" id="end_date">
					
					</div>
                   <div class="col-sm-1">
					
						<button class="btn btn-primary" onclick="onSubmit()">Submit</button>
					
					</div>
					<div class="col-sm-2">
					
						<button class="btn btn-success" onclick="PrintDiv()">Print</button>
					
					</div>
                </div>
				
				
			<div class="col-sm-12" id="print">	
				
				
				<div class="col-sm-12" style="text-align:center;">
				
				
						<h3 style='margin:0;padding:0' id="title"></h3>
						<h3 style='margin:0;padding:0'>For the period <span id="s"></span> to <span id="e"></span></h3>
				
				
				
				
				</div>
				<div class="col-sm-12">
				
					<table class="table table-bordered">
					
					
						<thead>
						
							<th>Date</th>
							<th>Product Name</th>
							<th>Qun</th>
							<th>Price</th>
							<th>Amount</th>
							<th>Invoice</th>
						
						
						</thead>
						
						<tbody id="thead">
						
						
						</tbody>
					</table>
				
				
				</div>
				</div>
				
				<div id="modals">
				
				<div class="col-sm-4"></div>
				<div class="col-sm-4" style="margin-top:15%;">
				
				<img style="display:none;" class="img" src="<?php echo base_url(); ?>css/715.gif"/>
				
				
				
				</div>
				<div class="col-sm-4"></div>
				
				
				</div>
				
				
				
				
				
                </div>
                <!-- /.row -->
            </div>
		
<script src="<?php echo base_url(); ?>js/custom/link.js"></script>
	
	
<script src="<?php echo base_url(); ?>js/custom/noti_js.js"></script>

		
<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>	
	
<script src="<?php echo base_url(); ?>js/custom/mul.js"></script>

<script>

function PrintDiv()
		{
			
var divToPrint = document.getElementById('print');
var win = window.open('', '_blank');
	win.document.write('<html><head><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><style>tr{line-height:15px;}</style><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css"></head><body>');
	win.document.write($("#print").html());
	win.document.write('</body></html>');
	win.print();
	win.close();


		}
	   


	function onSubmit(){
		
		
		var led=$("#cs").val();
		var start=$("#start_date").val();
		var end=$("#end_date").val();
		
		var title=led.split("*");
		
		if(led == '' || start == '' || end == '')
			alert('information incomplete...');
		else{
			
  $( "#modals" ).dialog({
      modal: true,
	  dialogClass: 'noTitleStuff'
    });
	$(".img").show();
			
			
			
			$("#title").text(title[0]);
			$("#s").text(start);
			$("#e").text(end);
			
			 $.ajax({
		
				type:'POST',
				dataType:'json',
				url:li+'transaction/report_cs/',
				data:{led:led,start:start,end:end},
				success:function(data)
					{
	
				var stuff="";
	
					$.each(data.posts,function(key,val){
						
						
						stuff=stuff+"<tr>"
						
									+"<td>"+val.date+"</td>"
									+"<td>"+val.name+"</td>"
									+"<td>"+val.qun+"</td>"
									+"<td>"+val.price+"</td>"
									+"<td>"+val.amount+"</td>"
									+"<td>"+val.trans_id+"</td>"
						
									+"<tr>";
						
						
					});
	
			document.getElementById("thead").innerHTML=stuff;
	
						
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




</script>




			
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

