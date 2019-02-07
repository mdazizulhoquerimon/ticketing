<div id="page-wrapper">
	<div class="container-fluid">
	



		<div class="row">
			 
			<div class="col-lg-12">
			
			
				 <p class="page-header">Store Transfer</p>
			
			
			</div>
		</div>
		
		<div class="row">
		
			<div class="panel panel-default">	
		
				 <div class="panel-heading">
				 
					<div class="row">
					
						<div class="col-sm-2">
						
							<input class="form-control k_search" placeholder="Search Invoice"/>
						
						</div>
						
						<div class="col-sm-1">
						
							<strong>Start Date</strong>
						
						</div>
						
					<div class="col-sm-2">
						
							<input id="starts" class="form-control tcal tcalInput" value="<?php echo date('d-m-Y'); ?>"/>
						
						</div>
						<div class="col-sm-1">
						
							<strong>Start Date</strong>
						
						</div>
						<div class="col-sm-2">
						
							<input id="ends" class="form-control tcal tcalInput" value="<?php echo date('d-m-Y'); ?>"/>
						
						</div>
					
					<div class="col-sm-2">
						
							<input type="button" class="btn btn-success" onclick="report_search()" value="Search"/>
						
						</div>
					
					
					
					</div>
				 
				 </div>
				 
				 
			 <div class="panel-body">	 
				<div class="row" style="margin-bottom:15px">
				<div class="col-sm-3">
					<span style="padding:5px"><strong>Product Transfer<span class="badge">Invoice No <span class="max"><?php echo ($max);  ?></span></span></strong></span>
				
				</div>
				
				<div class="col-sm-1">
				
					<strong>Date</strong>
				
				</div>
				<div class="col-sm-2">
				
			<input class="form-control tcal tcalInput" id="date"/>		
				
				</div>
				
				
				</div>
				 <div class="row">
				 
				
				 
				<div class="col-sm-2">
  <input type="text" placeholder="Search Product" id="product" class="form-control">

           </div>
						
					
		
		
		               <div class="col-sm-2">
  <input type="text" id="qun" placeholder="Quantity" class="form-control">

           </div>
		
		   <div class="col-sm-1">

		   
		   <span>Store Debit</span>
		   
		   
           </div> 
		   
		    <div class="col-sm-2">
		 
			
			<select class="form-control" id="sd" style="margin-top:3px;">
				<option value="0"></option>
				<?php foreach($store as $s): ?>
				
					<option value="<?php echo $s['id'] ?>"><?php echo $s['name'] ?></option>
				
				<?php endforeach; ?>
		
			
			</select>
		 
		 
		 
		 </div> 
		  
		  
		  
		<div class="col-sm-1">

		   
		   <span>Store Credit</span>
		   
		   
           </div> 
		   
		    <div class="col-sm-2">
		 
			
			<select class="form-control" id="sc" style="margin-top:3px;">
			
				<option value="0"></option>
			
				<?php foreach($store as $s): ?>
				
					<option value="<?php echo $s['id'] ?>"><?php echo $s['name'] ?></option>
				
				<?php endforeach; ?>
		
			
			</select>
		 
		 
		 
		 </div>   
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		    <div class="col-sm-1">
  <button type="button" id="pur_complete" onclick="transfer()" class="btn btn-primary">Submit</button>

           </div> 
		   
		  
		   
		   
		   

			</div>
			</div>
				 
				 
				 
			
				 
				 
		
			</div>
			
			<div class="panel panel-default pinvoice">	
		
			<div class="panel-heading" style="text-align:left">
				
				<span><strong>Invoice List</strong></span>	
			
			</div>
			 <div class="panel-body">

	<div class="row">
						
							
		<table class="table table-bordered">
				
			<thead>
						
				<tr>
							
					<th>Invoice</th>
					<th>Date</th>
								
				</tr>
						
			</thead>
			<tbody id="in_tbody">
						
						
						
						
						
			</tbody>
				
				
		</table>
							
							
							
							
						
	</div>


			</div>
			
		</div>
			
			
			
			
			
			
		
		<div class="panel panel-default">	
		
			<div class="panel-heading" style="text-align:left">
				
				<span><strong>Product List</strong></span>	
			
			</div>
			 <div class="panel-body">	 
			
			
			
			<table class="table table-bordered">
				
			<thead>
						
				<tr>
							
					<th>Product Name</th>
					<th>Quantity</th>
					
				</tr>
						
			</thead>
						<tbody id="tbody">
						
						
						
						
						
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
		
		
		
		
		
		
		
		
	<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>


<script src="<?php echo base_url(); ?>js/custom/link.js"></script>
	
	

		
<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>	
	
<script src="<?php echo base_url(); ?>js/custom/mul.js"></script>
<script src="<?php echo base_url(); ?>js/custom/store_to_trans.js"></script>

		
	</div>
</div>