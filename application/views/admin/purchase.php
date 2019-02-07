<div id="page-wrapper">
            <div class="container-fluid">
			
			
			
			
			
			
		  <div class="row">
                        <h4 class="page-header" style="margin-top:10px;text-align:center">Transaction</h4>
                 
             
				   
                </div>	
	<div class="row">
				
	 <div class="col-lg-12">
<div class="panel panel-default">

	   <div class="panel-heading">
	   
                          <?php 
					
					
					$var="";
					
					
							if($type == 1){
								
								$var="Purchase";
								
								?>
								<strong>NEW PURCHASE</strong>
							<?php
							
							}
							else if($type == 2){
								
					$var="Purchase Return";			
								
								
								?>
								
								<strong>PURCHASE RETURN</strong>
								
								<?php
								
							}
							else if($type == 3){
								
				$var="Sale";				
								
								
													?>
								
								<strong>NEW SALE</strong>
								
								<?php			
								
							}
							else if($type == 4){
								
		$var="Sale Return";						
								
								
													?>
								
								<strong>Sales Return</strong>
								
								<?php			
								
							}
							else if($type == 5){
	$var="Sale";							
													?>
								
								<strong>Issu</strong>
								
								<?php			
								
							}
							else if($type == 6){
	$var="Sale";							
													?>
								
								<strong>Issu Sales Return</strong>
								
								<?php			
								
							}
							else if($type == 12){
		$var="Sale";						
													?>
								
								<strong>Service</strong>
								
								<?php			
								
							}
					
					?>
       </div>
	   
	   
	   
	   
	  <div class="panel-body">
	  
	  
<div class="form-group">
                      <label class="col-sm-1 control-label">Invoice No</label>
                        <div class="col-sm-2">
 <input type="text" id="invoice"  value="<?php echo ($max+1) ?>" class="form-control" readonly>
                        </div>
						
						
						
			<label class="col-sm-1 control-label">Date</label>				 
                        <div class="col-sm-2">
<input type="text" value="<?php echo date('d-m-Y'); ?>" id="pdate" class="form-control tcal tcalInput">
                        </div>			
						
					

<?php 
				
					if($type == 1 || $type == 2){
						
						?>
						
<label class="col-sm-1 control-label">Supplier</label>				 
                        <div class="col-sm-2">
						
						
  <input type="text" id="supplier"  class="form-control">
							
							
							
							
							
                        </div>
						
						<?php
						
					}
					else{
						
						?>
						
<label class="col-sm-1 control-label">Customer</label>				 
                        <div class="col-sm-2">
						
						
  <input type="text" id="customer" value="common*426" class="form-control">
							
							
							
							
							
                        </div>
						
						<?php
					}
				
				?>


	<div class="col-sm-2 p_store">
			
			
				<select class="form-control store_value">
				
					
					
					<?php foreach($store as $s): ?>
					
						<option data-title="<?php echo $s['name']; ?>" value="<?php echo $s['id'] ?>"><?php echo $s['name'] ?></option>
					
					<?php endforeach; ?>
				
				
				</select>
					
			
			</div>
<div id="btn_div" class="col-sm-1" style="text-align:center">

	 
		<button type="button" value="<?php echo $type ?>" id="pur_btn" class="btn btn-success">Submit</button>



		</div>


	<div class="col-sm-2">
	
			<?php


					$barcode=$this->session->userdata('barcode');
					
					if(empty($barcode)){
						?>
						
									<input type="checkbox" value="0" id="check"> Barcode Permission

						
						<?php
					}
					else{
						
						?>
									<input type="checkbox" value="0" id="check" checked> Barcode Permission

						
						<?php
						
					}
			?>
			
	
	
	</div>

					
						
                    
				</div>
	  
	  
	  
	  <div class="form-group" style="display:none;" id="re_main">

	  
	  <label class="col-sm-2 control-label">Return Quantity</label>				 
                        <div class="col-sm-4">
						
						
  <input type="text" id="return_qun"  class="form-control input-lg m-bot15">
							
							
							
							
							
                        </div>
	  
	  
	  
	  
	  </div>
	  
	 <div class="form-group" id="pro_body" style="margin-top:70px">  
	  
	<div class="panel panel-default">

	   <div class="panel-heading" style="text-align:center;">
		
		
				<span><h3 style="margin:0;padding:0;" class="s_title"></h3><span class="s_id" style="display:none">0</span></span>

		
		
		
		</div>
		<div class="panel-body">
		
		<?php

					if($type != 12){
						
						?>
						
						<div class="col-sm-3">
  <input type="text" placeholder="Search Product" id="product" class="form-control">

           </div>
						
						<?php
						
					}
					else{
						
						?>
						
							<div class="col-sm-3">
  <input type="text" placeholder="Write Service Name" id="service_product" class="form-control">

           </div>
							
						
						
						
						
						<?php
						
						
					}


			?>
		
		
		               <div class="col-sm-3">
  <input type="text" id="qun" placeholder="Quantity" class="form-control">

           </div>
		
		 <div class="col-sm-3">
  <input type="text" id="price" placeholder="Price" class="form-control">

           </div>
		   
		   
		  
		    <div class="col-sm-3">
  <button type="button" id="pur_complete" onclick="retail()" class="btn btn-primary">Submit</button>

           </div>   
		   
		   
		   
		</div>
	  
	  
	  
	  
	  </div>
	  
	  
	  
	  
	  
	  
	  
	  </div>
	  
	  
	  
	 <div class="form-group" id="table_body">  
	  
	  
	  <table class="table table-bordered">
				
			<thead>
						
				<tr>
							
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Amount</th>
								
				</tr>
						
			</thead>
						<tbody id="tbody">
						
						
						
						
						
						</tbody>
				
				
		</table>
	  
	  
	  
	  
	  
	  </div>
	  
	  
	  <div class="form-group">
	  
	  <div class="col-sm-7"></div>
	  
	  <div class="col-sm-5">
	  
	  
	  <div class="panel panel-default">

	   <div class="panel-heading" style="text-align:center">
	  
	 <strong> <?php echo $var; ?></strong>
	  
	  </div>
	  
	  <div class="panel-body">
	  
	  
	  <div class="row r_padding">
	  
	  
	  <label class="col-sm-6" style='padding-right:0px'>
				
		<strong>Gross Amount</strong>
		
	  </label>
	  
	  
	 <div class="col-sm-6" style='padding-left:0px'>
				
	<input id="gro_amount" class="form-control"/>

	</div> 
	  
	  
	  
	  
	  </div>
	  
	  
	  <div class="row r_padding">
			
				<label class="col-sm-6" style='padding-right:0px'>
				
				<strong>Discount(TK)</strong>
				</label>
				<div class="col-sm-6" style='padding-left:0px'>
				
<input onkeyup="discount(this)" onkeypress="return isNumberKey(event)" id="dis_taka" class="form-control"/>

				</div>
			
			</div>
	  
	<div class="row r_padding">
			
				<label class="col-sm-6" style='padding-right:0px'>
				
				<strong>Discount(%)</strong>
				</label>
				<div class="col-sm-6" style='padding-left:0px'>
				
<input onkeyup="discount(this)" id="dis_per" onkeypress="return isNumberKey(event)" class="form-control"/>

				</div>
			
			</div>  
	  
	 <div class="row r_padding">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>Cash</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
	<input onkeyup="discount(this)" onkeypress="return isNumberKey(event)" class="form-control" id="cash_pur"/>
				</div>
			
			</div> 
	   <div class="row">
	<label style="color:red;font-weight:bold;display:none" id="li_per"></label>
	
	</div>
	 <div class="row">
<label style="color:red;font-weight:bold;display:none" id="li_change"></label>
  </div>
	
<input type="hidden"  id="check_gross" class="form-control"/>
<input type="hidden"  id="check_change" class="form-control"/>


<div class="row r_padding">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>BKash</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
	<input onkeyup="discount(this)" onkeypress="return isNumberKey(event)" class="form-control" id="bkash"/>
				</div>
			
			</div>


	<div class="row r_padding">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>Bank</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
	<input onkeyup="discount(this)" value="0" onkeypress="return isNumberKey(event)" class="form-control" id="card_pur"/>
				</div>
			
			</div>		
			
			
	<div class="row r_padding">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>Bank Type</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
						<select id="type" class="form-control input-lg m-bot15">
					
						<?php foreach($bank as $val): ?>
						
							<option value="<?php echo $val['id'] ?>"><?php echo $val['ledger_title'] ?></option>
						
						<?php endforeach; ?>
					
					</select>
				</div>
			
			</div>		
			
		<div class="row r_padding">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>Remarks</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
						
						<textarea id="remarks" rows="5" class="form-control"></textarea>
						
						
				</div>
			
			</div>	
	
	<button style="text-align:center;margin-bottom:5px;" type="button"  id="in_complete" class="btn btn-info">Submit</button>

			
	
	
	
	
	
	
	
	
	  
	  </div>
	  
	  
	  
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

</div>
				
	</div>
	
	



<script src="<?php echo base_url(); ?>js/custom/link.js"></script>
	
	
<script src="<?php echo base_url(); ?>js/custom/noti_js.js"></script>

		
<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>	
	
<script src="<?php echo base_url(); ?>js/custom/mul.js"></script>

		
<script src="<?php echo base_url(); ?>js/custom/puchase.js"></script>

		
<script src="<?php echo base_url(); ?>js/custom/invoice_edit.js"></script>		

</div>

			
</div>