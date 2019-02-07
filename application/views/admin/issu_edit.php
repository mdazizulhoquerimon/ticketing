<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default heads">
		
			<div class="panel-heading">
			
			
				Invoice Report Update
			
			
			</div>
			<div class="panel-body">
			
				
				
				
				
				<div class="row" style='text-align:center'>
					
							<strong>Issue Update</strong>
					
					
				</div>
				
				<div class="row tops">
				
				
				<div class="col-sm-12">
				
				
				
				
					
				<div class="row tops">
                      <label class="col-sm-2 control-label">Invoice No</label>
                        <div class="col-sm-2">
 <input type="text" id="invoice"  value="<?php echo $invoice ?>" class="form-control" readonly>
                        </div>
						
						
						
			<label class="col-sm-1 control-label">Date</label>				 
                        <div class="col-sm-2">
<input type="text" value="<?php echo $date ?>" id="pdate" class="form-control tcal tcalInput">
                        </div>			
						
				

<label class="col-sm-1 control-label">Customer</label>				 
                        <div class="col-sm-2">
						
						
  <input type="text" id="customer"  value="<?php echo $cus ?>"  class="form-control">
							
							
							
							
							
                        </div>


			<div class="col-sm-2">
						
						
							
				 <div id="btn_div" style="text-align:center">

	 
		<button type="button"  value="<?php echo $type ?>" id="update_invoice" class="btn btn-info">Submit</button>



		</div>			
							
							
							
            </div>
				
						
                    
				</div>
	
	
	

	
		<div class="row tops" id="pro_bodys"> 
            <div class="col-sm-3">
  <input type="text" placeholder="Search Product" id="product" class="form-control">

           </div>
		   
		   
		               <div class="col-sm-3">
  <input type="text" id="qun" placeholder="Quantity" class="form-control">

           </div>
		   
		   
		    <div class="col-sm-3">
  <input type="text" id="price" placeholder="Price" class="form-control">

           </div>
		   
		   
		    <div class="col-sm-3">
  <button value="5" type="button" id="pur_complete" onclick="retail()" class="btn btn-info">Submit</button>

           </div>
		   
		   
</div>

		<div class="row tops" id="table_body"> 
	 
	 
				<table class="table table-bordered">
				
						<thead>
						
							<tr>
							
								<th>Product Code</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Amount</th>
								<th>Return Quntity</th>
								<th>Sale</th>
								
							</tr>
						
						</thead>
						<tbody id="tbody">
						
						<?php $gross=0; foreach($product as $val): ?>
						
						
							<tr class="success">
							
				<td><?php echo $val['code'] ?></td>
				
				
	<td style="width:100px;"><input id="<?php echo $val['id']."iq" ?>" onkeyup="issue_qun(<?php echo $val['id'] ?>)" type="text" value="<?php echo $val['pices'] ?>" class="form-control"></td>
				
				
				<td style="width:100px;"><?php echo $val['price'] ?></td>
				
				
				<td style="width:100px;" id="<?php echo $val['id']."ia" ?>"><?php $gross=$gross+$val['amount']; echo $val['amount'] ?></td>
							
					<td style="width:100px;">
					
					<input onkeyup="return_qun(<?php echo $val['id'] ?>)" id="<?php echo $val['id']."rq" ?>" type="text" value="<?php echo $val['return_qun'] ?>" class="form-control">
					
					
					</td>	


<td id="<?php echo $val['id']."is" ?>"><?php echo $val['pices'] - $val['return_qun'] ?></td>


<td style='color:red;font-weight:bold'><a href="#" style='color:red;font-weight:bold' onclick="product_delete2(<?php echo $val['id'] ?>,<?php echo $val['trans_id'] ?>,5)">X</a></td>
					
							</tr>
						
						
						<?php  endforeach; ?>
						
						
						
						</tbody>
				
				
				</table>
	 
	 
		</div>
		
		
					
						<div class="form-group">
		
		
			<div class="col-sm-9"></div>
			<div class="col-sm-3" style="border:1px solid;padding-top:5px">
			
		<?php foreach($invo as $in) :?>		
			
			
			
			<div class="row">
			
				<label class="col-sm-6" style='padding-right:0px'>
				
				<strong>Gross Amount</strong>
				</label>
				<div class="col-sm-6" style='padding-left:0px'>
				
			<input id="gro_amount" value="<?php echo $gross ?>" class="form-control" readonly="readonly"/>

				</div>
			
			</div>
					
			<div class="row">
			
				<label class="col-sm-6" style='padding-right:0px'>
				
				<strong>Discount(TK)</strong>
				</label>
				<div class="col-sm-6" style='padding-left:0px'>
				
						<input id="dis_taka" value="<?php echo $in['dis_taka'] ?>" class="form-control ui-autocomplete-input"/>

				</div>
			
			</div>



					<div class="row">
			
				<label class="col-sm-6" style='padding-right:0px'>
				
				<strong>Discount(%)</strong>
				</label>
				<div class="col-sm-6" style='padding-left:0px'>
				
			<input id="dis_per" value="<?php echo $in['dis_per'] ?>" class="form-control"/>

				</div>
			
			</div>


		<div class="row">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>Cash</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
			<input type="text" value="<?php echo $in['cash'] ?>" class="form-control" id="cash_pur"/>
				</div>
			
			</div>

<label style="color:red;font-weight:bold;" id="li_per"></label><br>
<label style="color:red;font-weight:bold;" id="li_change"></label><br>


<input type="hidden"  id="check_gross" value="<?php echo $in['gross_dis'] ?>" class="form-control"/>
<input type="hidden"  id="check_change" value="<?php echo $in['change'] ?>"  class="form-control"/>


 <div class="row">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>BKash</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
	<input onkeypress="return isNumberKey(event)" class="form-control" value="<?php echo $in['bk_amount'] ?>" id="bkash"/>
				</div>
			
			</div>



			<div class="row">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>Bank</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
						<input value="<?php echo $in['card'] ?>" class="form-control ui-autocomplete-input" id="card_pur"/>
				</div>
			
			</div>



			<div class="row">
			
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
					
					
			<div class="row">
			
				<label class="col-sm-4" style='padding-right:0px'>
				
				<strong>Remarks</strong>
				</label>
				<div class="col-sm-8" style='padding-left:0px'>
				
						
						<textarea id="remarks" rows="5" class="form-control"><?php echo $in['remarks'] ?></textarea>
						
						
				</div>
			
			</div>			
				
			
<button style="text-align:center;margin-bottom:5px;" value="<?php echo $type ?>" type="button" id="in_complete" class="btn btn-info">Submit</button>


			<?php endforeach ?>
			</div>
		
		
		</div>
						
						
					
						
						<div class="row r_padding">
						
						
						
								<div class="col-sm-5"></div>
								<div class="col-sm-2">
								
<button style="text-align:center;margin-bottom:5px;display:none" type="button" id="issu_confirm" class="btn btn-info">Submit</button>								
								
								
								
								</div>
								<div class="col-sm-5"></div>
						
						
						
						
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