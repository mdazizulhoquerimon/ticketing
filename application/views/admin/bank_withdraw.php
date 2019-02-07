<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default">
		
		<?php include('panel_heading.php'); ?>
		
		
		</div>
		<div class="panel-footer" style="text-align:center;margin-bottom:20px">
		
		
			<strong><span id="footer">
			
			
			<?php

				if($type == 8)
					echo "Bank Diposite";
				else
					echo "Bank Withdraw";
			

			?>
			
			
			</span></strong>
		
		
		</div>
		
		<div class="panel panel-default">
		
		<div class="panel-heading">
		
				Transaction
		
		
		</div>
		
		
		<div class="panel-body cash_body">
		
		
		<div class="row">
                        <label class="col-sm-2 control-label" style="text-align:right">Voucher No</label>
                        <div class="col-sm-2">
                            <input type="text" id="voucher_no" value="<?php echo $voucher_no; ?>" class="form-control" readonly>
                        </div>
						
						<label class="col-sm-2 control-label" style="text-align:right">Date</label>
                        <div class="col-sm-2">
                            <input class="tcal" id="dat"  type="text" class="form-control">
                        </div>
						
						
						<label class="col-sm-2 control-label" style="text-align:right;">Bank</label>
                        <div class="col-sm-2">
                            
							
							<select id="bank" class="form-control">
								<?php foreach($bank as $val):?>
								
									<option value="<?php echo $val['id'] ?>">
									<?php echo $val['bank_name'] ?></option>
								
								<?php endforeach; ?>
							
							</select>
							
							
							
                        </div>
						
                    </div>
		
		
		
		<?php


			if($type == 9){
				?>
				
				<div class="row r_padding">
                    
						
						<label class="col-sm-2 control-label" style="text-align:right">Cheque No </label>	
						<div class="col-sm-2">		
								
						<span class="input-wrap"> <input class="form-control" type="input" name="ledger" id="ch_no"></span> 
							</div>
							
							
							
							    <label class="col-sm-2 control-label" style="text-align:right">Cheque Date</label>
                        <div class="col-sm-2">
                            <input class="tcal" id="ch_date"  type="text" class="form-control">
                        </div>
						
         </div>
				
				<?php
			}



		?>
		
			
					
					
					
					
		
		<div class="row r_padding">
                    
						
						<label class="col-sm-2 control-label" style="text-align:right">Ledger</label>	
						<div class="col-sm-2">		
								
						<span class="input-wrap"> <input class="form-control" type="input" name="ledger" id="tag"></span> 
							</div>
							
							
							
							    <label class="col-sm-2 control-label" style="text-align:right">Amount</label>
                        <div class="col-sm-2">
                            <input type="text" id="amount" value="<?php echo set_value('amount'); ?>" class="form-control">
                        </div>
						
					 <label class="col-sm-2 control-label" style="text-align:right">Description</label>
                        <div class="col-sm-2">
                            <textarea id="description" rows="2" class="form-control" class="col-sm-3"></textarea>
                        </div>	
						
						
						
						
                    </div>
		
<div class="row r_padding" style="text-align:center">	


	<button type="button" class="btn btn-info" onclick="cash_check()">Submit</button>
	<button type="button" class="btn btn-info" onclick="up('<?php echo $type ?>')">Update</button>
	<button style="display:none" id="type" class="btn btn-info" value="<?php echo $type; ?>"></button>



        </div>		
		<div class="row vouch" style="display:none;max-height:200px;overflow:auto">
			
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						
						<th>Voucher</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody id="tbodys">
				
				
				</tbody>
				
				
			</table>
			
			
			</div>		
					
			<div class="row vouch_main">
			
			
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						
						<th>Debit</th>
						<th>Credit</th>
						<th>amount</th>
						<th>Description</th>
						<th>Date</th>
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
		
		
		



<script src="<?php echo base_url(); ?>js/custom/link.js"></script>

<script src="<?php echo base_url(); ?>js/custom/mul.js"></script>

<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>
		
<script src="<?php echo base_url(); ?>js/custom/cash_pay.js"></script>		
		
	</div>
	
</div>