 <div id="page-wrapper">
            <div class="container-fluid">
			
                <div class="row">
<div class="col-lg-2"><h4 class="page-header">Stock Journal</h4></div>
<div class="col-lg-2" style="margin-top:10px">



<input type="text" placeholder="Invoice No" class="form-control" id="stock"/>






</div>
                   
                </div>
				
				<div class="row">
				
				
				
				<div class="panel panel-default">
				
				  <div class="panel-heading">
                          Transaction
                  </div>
				 <div class="panel-body">
				 
				 
				 <div class="row r_padding">
					

					
					
                        <label class="col-sm-1 control-label">Type</label>	
						<div class="col-sm-2">		
								
							<select class="form-control" id="type2">
							
									<option value="1">Debit</option>
									<option value="2">Credit</option>
							
							
							</select>
							
							
							
							
							</div>
							
							
							
						<label class="col-sm-1 control-label">Product</label>	
						<div class="col-sm-2">		
								
							
							
							<input type="text" id="product" class="form-control">
							
							
						</div>
						
						<label class="col-sm-1 control-label">Quantity</label>
                        <div class="col-sm-2">
                            <input type="text" id="amount" class="form-control">
                        </div>
							
						
						
						
						
                    </div>
				 
				 
				
					
					<div class="row r_padding">
                        <label class="col-sm-1 control-label">Invoice No</label>
                        <div class="col-sm-2">
                            <input type="text" id="voucher_no" value="<?php echo $voucher_no; ?>" class="form-control" readonly>
                        </div>
						
						<label class="col-sm-1 control-label">Date</label>
                        <div class="col-sm-2">
                            <input class="tcal" id="j_date"  type="text" class="form-control">
                        </div>
					
						
						
                    </div>
					
					
					
				
				 
				 
				 <div class="row r_padding" style="text-align:center">	
<button type="button" id="stock_trans" class="btn btn-info">Submit</button></div>
				 
				 
				 
				 </div>
				
				</div>
				
				
				
				</div>
				
				
				
			</div>



<script src="<?php echo base_url(); ?>js/custom/link.js"></script>



<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>	


<script src="<?php echo base_url(); ?>js/custom/mul.js"></script>	
<script src="<?php echo base_url(); ?>js/custom/purchase.js"></script>	





</div>