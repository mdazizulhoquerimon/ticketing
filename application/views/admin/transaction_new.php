<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default">
		
		<?php include('panel_heading.php'); ?>
		
		
		</div>
		<div class="panel-footer" style="text-align:center;margin-bottom:20px">
		
		
			<strong>Journal Posting</strong>
		
		
		</div>
		
		
		
	<div class="panel panel-default">
	
	
		<div class="panel-heading">
		
			Transaction
		
		
		</div>
		
		
		<div class="panel-body">
		
		<div class="row">
					

					
					
                        <label class="col-sm-1 control-label">Type</label>	
						<div class="col-sm-2">		
								
							<select class="form-control" id="type2">
							
									<option value="1">Debit</option>
									<option value="2">Credit</option>
							
							
							</select>
							
							
							
							
							</div>
							
							
							
						<label class="col-sm-1 control-label">Ledger</label>	
						<div class="col-sm-2">		
								
							
							
							<input type="text" id="tag" class="form-control">
							
							
						</div>
						
						<label class="col-sm-1 control-label">Amount</label>
                        <div class="col-sm-2">
                            <input type="text" id="amount" class="form-control">
                        </div>
							
						
						
						 <label class="col-sm-1 control-label">Description</label>
                        <div class="col-sm-2">
         <textarea rows="1" id="description" class="form-control"></textarea>
                        </div>	
						
                    </div>
		
		<div class="row">
                        <label class="col-sm-1 control-label">Voucher No</label>
                        <div class="col-sm-2">
                            <input type="text" id="voucher_no" value="<?php echo $voucher_no; ?>" class="form-control" readonly>
                        </div>
						
						<label class="col-sm-1 control-label">Date</label>
                        <div class="col-sm-2">
                            <input class="tcal" id="j_date"  type="text" class="form-control">
                        </div>
						
						
						
						
						
						
						
						
						
						
						
						
                    </div>
					
			


<div class="row" style="margin-bottom:10px">

<div class="col-sm-3"></div>
<div class="col-sm-6">


		<div class="col-sm-6" style="text-align:right;">
		<button type="button" id="journal_post" class="btn btn-info">Submit</button>
		
		<button style="display:none" id="type" class="btn btn-info" value="<?php echo $type; ?>"></button>
		
		
		</div>
		<div class="col-sm-2" id="confirm">
		
		
		</div>


</div>
<div class="col-sm-3"></div>

</div>
<div class="row">
<div class="col-lg-12">
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
						<th>Ledger</th>
						<th>Debit</th>
						<th>Credit</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody id="tbody">
				
				
				
				
				
				</tbody>
				
				
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
	
	
	</div>	
		
		
		
			



<script src="<?php echo base_url(); ?>js/custom/link.js"></script>
<script src="<?php echo base_url(); ?>js/custom/noti_js.js"></script>

<script src="<?php echo base_url(); ?>js/custom/mul.js"></script>

<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>
		
<script src="<?php echo base_url(); ?>js/custom/cash_pay.js"></script>
		
		
	</div>
	
</div>