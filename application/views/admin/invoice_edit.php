<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default heads">
		
			<div class="panel-heading">
			
			
				Invoice Report Update
			
			
			</div>
			<div class="panel-body">	
				<div class="row" id="test">
				
				
				<div class="col-lg-12">
				
				<div class="row" style='text-align:center'>
					
					<?php 
					
							if($type == 1){
								?>
								<strong>PURCHASE Update</strong>
							<?php
							
							}
							else if($type == 2){
								?>
								
								<strong>PURCHASE RETURN Update</strong>
								
								<?php
								
							}
							else if($type == 3){
								
													?>
								
								<strong>SALE Update</strong>
								
								<?php			
								
							}
							else if($type == 4){
								
													?>
								
								<strong>Sales Return Update</strong>
								
								<?php			
								
							}
							else if($type == 6){
								
													?>
								
								<strong>Issu Sales Return</strong>
								
								<?php			
								
							}
							else if($type == 12){
								
													?>
								
								<strong>Servicing</strong>
								
								<?php			
								
							}
					
					?>
					
					
					</div>
				
				
				<div class="row" style="margin-top:10px">
				
			<span id="d" style="display:none"></span>	
				
				
				
				
				<form class="form-horizontal bucket-form" id="forms" method="post" action="<?php echo base_url(); ?>/create_user">

				
				
				
				
				
				<div class="col-sm-12">
				<div class="form-group">
                      <label class="col-sm-1 control-label">Invoice No</label>
                        <div class="col-sm-2">
						
						
 <input type="text" id="invoice"  value="<?php echo $invoice ?>" class="form-control" readonly>
 
 
 
 
 
                        </div>
						
						
						
			<label class="col-sm-1 control-label">Date</label>				 
                        <div class="col-sm-2">
<input type="text" id="pdate" value="<?php echo date('d-m-Y',strtotime($date)) ?>" class="form-control tcal tcalInput">
                        </div>			
						
					

<?php 
				
					if($type == 1 || $type == 2){
						
						?>
						
<label class="col-sm-1 control-label">Supplier</label>				 
                        <div class="col-sm-2">
						
						
  <input type="text" id="supplier" value="<?php echo $cus ?>" class="form-control">
							
							
							
							
							
                        </div>
						
						<?php
						
					}
					else{
						
						?>
						
<label class="col-sm-1 control-label">Customer</label>				 
                        <div class="col-sm-2">
						
						
  <input type="text" id="customer" value="<?php echo $cus ?>" class="form-control">
							
							
							
							
							
                        </div>
						
						<?php
					}
				
				?>


<div class="col-sm-2 ">
			
								
			<select class="form-control" id="store">
					
					<?php foreach($store as $s): ?>
					
					
			<option <?php if($s["id"] == $sts): ?>selected<?php endif;?> data-title="<?php echo $s['name']; ?>" value="<?php echo $s['id'] ?>"><?php echo $s['name'] ?></option>
					
					
					<?php endforeach; ?>
				
				
				</select>
				
				
			</div>

<div id="btn_div" class="col-sm-1" style="text-align:center">

	 
		<button type="button" value="<?php echo $type ?>" id="update_invoice" class="btn btn-info">Update</button>



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
				</div>
	
	

	
	<div class="col-sm-12">

		<div class="form-group" id="pro_bodys"> 
		
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
  <button type="button" id="pur_complete" onclick="retail()" value="<?php echo $type ?>" class="btn btn-info">Submit</button>

           </div>
		   
		   
</div>
</div>

<div class="col-sm-12">
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
						
						
							<?php $gross=0; foreach($product as $val): ?>
							
									<tr class="success">
									
											<td>
									

									
									<?php

				$ptype = $this->report_model->anyName('product_ledger','code',$val[$col2],'ptype');

								if($type != 12)
								{
									
				echo $this->report_model->anyName('product_ledger','code',$val[$col2],'name')." - ".$val[$col2];
									
									
								}
								else{
	echo $this->report_model->anyName('ledger','id',$val[$col2],'ledger_title');
									
								}
										
									
				

										?>
					
					
					
					
					
													
											</td>
									<td style="width:100px">
											
					
					<input type="text" onkeyup="product_up_in(<?php echo $val['id'] ?>)" id="<?php echo $val['id']."q" ?>" value="<?php echo $val['qun'] ?>" class="form-control">
					
													
									</td>
									
									<td style="width:100px">
											
					<input type="text" onkeyup="product_up_in(<?php echo $val['id']?>)" id="<?php echo $val['id']."p" ?>" value="<?php echo $val['price'] ?>" <?php if($ptype == 1): ?>readonly<?php endif; ?> class="form-control">								
									</td>
									
									<td id="<?php echo $val['id']."a" ?>">
											
					<?php

					echo $val['qun']*$val['price'];
					$gross=$gross+$val['qun']*$val['price'];
					
					
					
					?>
													
									</td>
									
									<td style="width:60px;font-weight:bold;color:red;">
		<a id="tes" href="#" style="font-weight:bold;color:red;" onclick="product_delete(<?php echo $val['id'] ?>,<?php echo $val['trans_id'] ?>,<?php echo $val['type'] ?>)">X</a>
									</td>
									</tr>
							
							<?php endforeach; ?>
						
						
						</tbody>
				
				
				</table>
	 
	 
		</div>
		</div>
		
		<div class="form-group" id="pro_bodys">
		
		
		
		
		
			<div class="col-sm-9"></div>
			<div class="col-sm-3" style="border:1px solid;padding-top:5px">
			
			
	<?php foreach($invo as $in) :?>		
			
		
			
			<div class="form-group">
			
				<label class="col-sm-6" style='padding-right:0px'>
				
				<strong>Gross Amount</strong>
				</label>
				<div class="col-sm-6" style='padding-left:0px'>
				
			<input id="gro_amount" value="<?php echo $gross ?>" class="form-control" readonly="readonly"/>

				</div>
			
			</div>
					
			<div class="form-group">
			
				<label class="col-sm-6" style='padding-right:0px'>
				
				<strong>Discount(TK)</strong>
				</label>
				<div class="col-sm-6" style='padding-left:0px'>
				
	<input onkeyup="discount(this)" id="dis_taka" onkeypress="return isNumberKey(event)" value="<?php echo $in['dis_taka'] ?>" class="form-control"/>

				</div>
			
			</div>



					<div class="form-group">
			
				<label class="col-sm-6" style='padding-right:0px'>
				
				<strong>Discount(%)</strong>
				</label>
				<div class="col-sm-6" style='padding-left:0px'>
				
			<input onkeyup="discount(this)" id="dis_per" value="<?php echo $in['dis_per'] ?>" class="form-control" onkeypress="return isNumberKey(event)"/>

				</div>
			
			</div>


		<div class="form-group">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>Cash</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
			<input onkeyup="discount(this)" type="text" value="<?php echo $in['cash'] ?>" class="form-control" onkeypress="return isNumberKey(event)" id="cash_pur"/>
				</div>
			
			</div>

<label style="color:red;font-weight:bold;" id="li_per"></label><br>
<label style="color:red;font-weight:bold;" id="li_change"></label><br>


<input type="hidden"  id="check_gross" value="<?php echo $in['gross_dis'] ?>" class="form-control"/>
<input type="hidden"  id="check_change" value="<?php echo $in['change'] ?>"  class="form-control"/>


      <div class="form-group">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>BKash</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
	<input onkeyup="discount(this)" onkeypress="return isNumberKey(event)" class="form-control" value="<?php echo $in['bk_amount'] ?>" id="bkash"/>
				</div>
			
			</div>





			<div class="form-group">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>Bank</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
<input onkeyup="discount(this)" onkeypress="return isNumberKey(event)" value="<?php echo $in['card'] ?>" class="form-control" id="card_pur"/>
				</div>
			
			</div>



			<div class="form-group">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>Bank Type</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
						<select id="type" class="form-control" onChange="bank_change()">
					
						<?php foreach($bank as $val): ?>
						
							<option value="<?php echo $val['id'] ?>" <?php if($val['id'] == $in['b_type']) :?>selected="selected"<?php endif ?>><?php echo $val['ledger_title'] ?></option>
						
						<?php endforeach; ?>
					
					</select>
				</div>
			
			</div>	
					
				<div class="form-group">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>Remarks</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
						
						<textarea id="remarks" rows="5" class="form-control"><?php echo $in['remarks'] ?></textarea>
						
						
				</div>
			
			</div>		
					
				
			



			<?php endforeach ?>

<button style="text-align:center;margin-bottom:5px;" value="<?php echo $type ?>" type="button" id="in_complete" class="btn btn-info">Submit</button>



			</div>
		
		
		</div>
	 
				
					</form>
				
				
				
				
				
				
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
			
			
	</div>
	
	
	
	
	

	
	
	
	<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>
		
<script src="<?php echo base_url(); ?>js/custom/link.js"></script>
<script src="<?php echo base_url(); ?>js/custom/mul.js"></script>
<script src="<?php echo base_url(); ?>js/custom/puchase.js"></script>
		
<script src="<?php echo base_url(); ?>js/custom/invoice_edit.js"></script>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	</div>
	</div>