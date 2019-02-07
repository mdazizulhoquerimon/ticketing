<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="row report">
			<div class="panel panel-default heads">
		
				<div class="panel-heading">										
					<div class="row">
		
					<div class="col-sm-6">
							<strong style='color:red;'>Transfered From <?php echo $wname; ?></strong>
			
			
					</div>
					<div class="col-sm-6">
						<input class="form-control" value="<?php echo $inv ?>" id="invoice" disabled />

					</div>
				</div>
					
				</div>
				<div class="panel-body">
		
		
		<div class="row">
		
		<div class="col-sm-12">
		
			<table class="table table-bordered">
			
			
				<thead>
				
				
					<th>Product Code</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Amount</th>
				
				
				</thead>
			
			
			<tbody id="tbody">
			
				
				<?php $dis=""; ;$tqun=0;$tam=0; foreach($pro as $p): ?>
			
			
					<tr>
					
						<td>
						<?php

						echo $p["c_id"]; 
						
	$pcode=$this->report_model->anyName('product_ledger','code',$p["c_id"],'id');
						
						
						?>
						<p style="margin:0;padding:0;color:red;"><?php if(empty($pcode)): $dis="disabled";?>P.code not exist<?php endif; ?></p>
						</td>
						<td><?php echo $p["qun"] ?></td>
						<td><?php echo $p["price"] ?></td>
						<td><?php 
						
						echo $am=$p["price"]*$p["qun"]; 
						$tqun=$tqun+$p["qun"];
						$tam=$tam+$am;
						
						?></td>
					
					</tr>
			
				<?php endforeach; ?>
				<tr>
				
					<td style='color:red;'><strong>Total =></strong></td>
					<td style='color:red;'><strong><?php echo $tqun ?></strong></td>
					<td><strong></strong></td>
					<td style='color:red;'><strong><?php echo $tam ?></strong></td>

				
				</tr>
				
				<tr>
				
					<td></td>
					<td></td>
					<td></td>
					<td><button class="btn btn-primary" <?php echo $dis; ?>>Approve</button></td>

				
				</tr>
				
			</tbody>
			
			</table>
		
		
		
		
		</div>
		
		</div>
		
		
		
				</div>
			</div>
		</div>
	

<style>

	.rr{
		
		margin-top:10px;
		
	}

</style>
  <div class="modal fade" id="sLegerOpen" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Shorcut Product</h4>
        </div>
        <div class="modal-body">
          
		  
			<div class="row rr">
			
			
				<div class="col-sm-2"></div>				
				<label class="col-sm-1">Category Head</label>
				<div class="col-sm-3">
				
				
					<select class="form-control" id="lhead">
					
					
					
					</select>
				
				</div>	
						
			
			</div>
		  
		  <div class="row rr">
			
			
				<div class="col-sm-2"></div>				
				<label class="col-sm-1">Product Code</label>
				<div class="col-sm-3">
				
					<input class="form-control" id="pcode">
				
				
				</div>	
				<label class="col-sm-1">Product Name</label>
				<div class="col-sm-3">
				
					<input class="form-control" id="pname">
				
				
				</div>		
			
			</div>
			
			
			 <div class="row rr">
			
			
				<div class="col-sm-2"></div>				
				<label class="col-sm-1">Pices of Carton</label>
				<div class="col-sm-3">
				
					<input class="form-control" id="carton">
				
				
				</div>	
				<label class="col-sm-1">Unit</label>
				<div class="col-sm-3">
				
					<input class="form-control" id="unit">
				
				
				</div>		
			
			</div>
			
			
			 <div class="row rr">
			
			
				<div class="col-sm-2"></div>				
				<label class="col-sm-1">Sorting</label>
				<div class="col-sm-3">
				
					<input class="form-control" id="sorting">
				
				
				</div>	
				<label class="col-sm-1">Opening Stock</label>
				<div class="col-sm-3">
				
					<input class="form-control" id="ostock">
				
				
				</div>		
			
			</div>
			
			 <div class="row rr">
			
			
				<div class="col-sm-2"></div>				
				<label class="col-sm-1">Buy Price</label>
				<div class="col-sm-3">
				
					<input class="form-control" id="buy">
				
				
				</div>	
				<label class="col-sm-1">Cost</label>
				<div class="col-sm-3">
				
					<input class="form-control" id="cost">
				
				
				</div>		
			
			</div>
			
			 <div class="row rr">
			
			
				<div class="col-sm-2"></div>				
				<label class="col-sm-1">Selling Price</label>
				<div class="col-sm-3">
				
					<input class="form-control" id="sell">
				
				
				</div>	
				<label class="col-sm-1">Price Type</label>
				<div class="col-sm-3">
				
					<select id="price_type" class="form-control">


                                <option value="2">Customize Price</option>
								<option value="1">Fixed Price</option>
				

					</select>				
				
				</div>		
			
			</div>
			 <div class="row rr">
			
			
				<div class="col-sm-2"></div>				
				<label class="col-sm-1">Image Upload</label>
				<div class="col-sm-3">
				
<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo base_url(); ?>product_con/upload/'>



Upload your image <input type="file" name="photoimg" id="photoimg" />



</form>



<div id='preview' style="padding:5px">

<img style='display:none' src="<?php echo base_url(); ?>img/loader.gif" id="img">


</div>
				
				
				</div>	
				
			
			</div>
			
			  <div class="row rr">
			
			
				<div class="col-sm-2"></div>				
				<label class="col-sm-2"></label>
				<div class="col-sm-3">
				
					<button class="btn btn-primary" onclick="slCreatSubmit(this)">Submit</button>
				
				
				</div>	
						
			
			</div>
			
        </div>
       
      </div>
    </div>
  </div>	
	
	
<script src="<?php echo base_url(); ?>js/custom/link.js" type="text/javascript"></script>	
<script src="<?php echo base_url(); ?>js/custom/shortcut.js" type="text/javascript"></script>	
<script src="<?php echo base_url(); ?>js/custom/sCreatep.js" type="text/javascript"></script>	
<script src="<?php echo base_url(); ?>/js/custom/jquery.form.js"></script>		
	
	</div>
</div>