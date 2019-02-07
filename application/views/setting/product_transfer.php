<div id="page-wrapper">
    <div class="container-fluid">
	
	
	
			<div class="row" id="r_title" style="display:none">
			
			
			
			</div>
	
	
		<div class="row report">
		
		 
	<div class="panel panel-default heads">
		
		<div class="panel-heading">


			<strong>Report</strong>
		
		

		</div>
		<div class="panel-body">
		
		
			<div class="row">
			
			
			
				<label class="col-sm-1">Start Date</label>
				<div class="col-sm-2">
				
				
					<input class="form-control tcal tcalInput" id="rstart_date" value="<?php echo date('d-m-Y') ?>" readonly >
				
				
				</div>
				
				<label class="col-sm-1">End Date</label>
				<div class="col-sm-2">
				
				
					<input class="form-control tcal tcalInput" id="rend_date" value="<?php echo date('d-m-Y') ?>" readonly>
				
				
				</div>
			<div class="col-sm-2">
				
				
					<select class="form-control" id="roption">
					
						<option value="0">All</option>
						<option value="2">Complete</option>
						<option value="1">Pending</option>

					
					</select>
				
				
				</div>
			<div class="col-sm-2">
				
				
					<button class="btn btn-primary" id="rsubmit">Submit</button>
				
				
				</div>
			
			</div>
		
		
		</div>
		
		 
		 
		 </div>
		
		
		
		</div>
	
	
	<div class="row data_preview" style="display:none">
	
	
	<div class="panel panel-default heads">
		
	<div class="panel-heading">

	<div class="row">
	
	
		<div class="col-sm-11">
		
					<strong>Report View</strong>

		
		</div>
		<div class="col-sm-1">
		
				<span class='report_cancel'>X</span>

		
		
		</div>
	
	
	</div>
	</div>
	<div class="panel-body">
	
	
	
		<table class="table table-borderd">
		
		
		
			<thead>
			
				<th>Invoice No</th>
				<th>Transfer</th>
				<th>Date</th>
				<th>P Date</th>
			
			</thead>
		
			<tbody id="report_tbody">
			
			
				
			
			
			</tbody>
		
		</table>
	
	
	
	</div>
	
	
	</div>
	
	
	
	</div>
	
	
	
	<div class="row data_adding">
	
<div class="panel panel-default heads">
		
	<div class="panel-heading">
		<div class="row">
		
			<div class="col-sm-6">
			<strong>Store Transfer</strong>
			
			
			</div>
			<div class="col-sm-6">
						<input class="form-control" value="0" id="invoice" disabled />

		</div>
		</div>
	</div>
	<div class="panel-body">
	
	
		<div class="row" id="fbody">
		
		
			<label class="col-sm-1"><strong>Store</strong></label>
			<div class="col-sm-3">
			
			
		<select class="form-control" id="store">
		
		<option value="0"></option>
			<?php foreach($store as $val): ?>
			
			
				<option value="<?php echo $val['cware'] ?>"><?php

				echo $this->setting->getPname("ware","id",$val['cware'],"name");



				?></option>
			
			
			<?php endforeach; ?>
			
		</select>	
			
			</div>
		
		  <div class="col-sm-2">
		  
<input type="text" id="date" value="<?php echo date('d-m-Y'); ?>" id="pdate" class="form-control tcal tcalInput" disabled>
                        
			</div>	
		<div class="col-sm-2">
		
		
		
			<button class="btn btn-primary submit" style="padding:3px 12px;" value="">Submit</button>
		
		
		
		</div>
		<div class="col-sm-3"></div>
		<div class="col-sm-1">
		
		
		
		
		</div>
		
		
		</div>
	
	
	
		<div class="row" style="margin-top:20px;display:none" id="p_body">
		
		
<div class="col-sm-2">

  <input type="text" placeholder="Search Product" id="product" class="form-control">

</div>		
		
<div class="col-sm-2">

  <input type="text" id="qun" placeholder="Quantity" class="form-control">

</div>
		
<div class="col-sm-2">

  <input type="text" id="price" placeholder="Price" class="form-control" readonly>

</div>
		   
 <div class="col-sm-3">
			
  <button type="button" id="pur_complete" style="padding:3px 12px;" onclick="retail()" class="btn btn-primary">Submit</button>

</div> 		
		
		
		
		
		
		
		</div>







		<div class="row">
		
		<div class="col-sm-12">
		
			<table class="table table-borderd">
			
			
				<thead>
				
				
					<th>Product Code</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Amount</th>
				
				
				</thead>
			
			
			<tbody id="tbody"></tbody>
			
			
			</table>
		
		
		
		
		</div>
		</div>




		
		
		
		
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
				
<div class="row">







		
		
		
		<div class="modal fade" id="room_setup" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;"><span><strong>Transfer Details <span id="td_data"></span></strong></span></h4>
        </div>
        <div class="modal-body">

			<div class="row">
			
			
				<div class="col-sm-12">
		
		
					<div class="col-sm-12">
						
						
							<table class="table table-borderd">
							
							
								<thead>
								
					<th>Product Code</th>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Amount</th>
				
								
								</thead>
							
					<tbody id="tbody_modal"></tbody>
			
							
							</table>
						
						
					</div>
						
						
				
					
						
						
					</div>		
						
						
						
						
						
		
			
			
			
			
			
			
			
			
			
			
			
			
		
				
				
			
			
		
			
			</div>
			

		
	
		
		
		
		
		
		

		</div>
		
	</div>
	
	
	</div>
	
	</div>





		<div class="modal fade" id="room_setup" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;"><span><strong>Transfer Details <span id="td_data"></span></strong></span></h4>
        </div>
        <div class="modal-body">

			<div class="row">
			
			
				<div class="col-sm-12">
		
		
					<div class="col-sm-12">
						
						
							<table class="table table-borderd">
							
							
								<thead>
								
					<th>Product Code</th>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Amount</th>
				
								
								</thead>
							
					<tbody id="tbody_modal"></tbody>
			
							
							</table>
						
						
					</div>
						
						
				
					
						
						
					</div>		
						
						
						
						
						
		
			
			
			
			
			
			
			
			
			
			
			
			
		
				
				
			
			
		
			
			</div>
			

		
	
		
		
		
		
		
		

		</div>
		
	</div>
	
	
	</div>
	
	</div>





</div>
<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>
	
<script src="<?php echo base_url(); ?>js/custom/link.js"></script>
<script src="<?php echo base_url(); ?>js/custom/transfer.js"></script>
<script src="<?php echo base_url(); ?>js/custom/mul.js"></script>

		
	
	</div>
	
	
	</div>	
