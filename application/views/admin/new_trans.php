<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default">
		
		
		
		<?php include('panel_heading.php'); ?>
			
			
		<div class="panel-footer" style="text-align:center;margin-bottom:20px">
		
		
			<strong><span id="footer">
			
			
			<?php

				if($type == 6)
					echo "Cash Payment";
				else
					echo "Cash Receive";
			

			?>
			
			
			</span></strong>
		
		
		</div>
		
		
		
		
		</div>
		
		
	<div class="panel panel-default" style="margin-top:20px">
		
		
		
			<div class="panel-heading">
		
				Transaction
		
		
			</div>
			<div class="panel-body cash_body">
			
			
			<div class="row r_padding">
                        <label class="col-sm-2 control-label">Voucher No</label>
                        <div class="col-sm-3">
                            <input type="text" id="voucher_no" value="<?php echo $voucher_no; ?>" class="form-control" readonly>
                        </div>
						
						<label class="col-sm-2 control-label">Date</label>
                        <div class="col-sm-3">
                            <input class="tcal" id="dat"  type="text" class="form-control">
                        </div>
						
                    </div>
			<div class="row r_padding">
                    
						
						<label class="col-sm-2 control-label">Ledger</label>	
						<div class="col-sm-3">		
								
						<span class="input-wrap"> <input class="form-control" type="input" name="ledger" id="tag"></span> 
							</div>
							
							
							
							    <label class="col-sm-2 control-label">Amount</label>
                        <div class="col-sm-3">
                            <input type="text" id="amount" value="<?php echo set_value('amount'); ?>" class="form-control">
                        </div>
						
                    </div>
			<div class="row">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-3">
                            <textarea id="description" rows="3" class="form-control" class="col-sm-3"></textarea>
                        </div>
                    </div>
					
					
			<div class="row" style="text-align:center">


	
			<button type="button" class="btn btn-info" onclick="cash_check()">Submit</button> 
			<button type="button" class="btn btn-info" onclick="up('6')">Update</button>
			
			
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
						<th>date</th>
					</tr>
				</thead>
				<tbody id="tbody">
				
				
				</tbody>
				
				
			</table>
			
			
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
		
		



<script src="<?php echo base_url(); ?>js/custom/link.js"></script>

<script src="<?php echo base_url(); ?>js/custom/mul.js"></script>

<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>	
<script src="<?php echo base_url(); ?>js/custom/cash_pay.js"></script>	
	</div>
</div>