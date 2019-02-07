<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			 
			<div class="col-lg-12">
			
			
				 <p class="page-header">Image Update</p>
			
			
			</div>
		</div>
		
		<div class="row">
		
		
	<div class="col-sm-2">
	
	
  <input type="text" placeholder="Search Product" id="product" class="form-control">

   </div>
	
									
											
	<label style="text-align:right" class="col-sm-1">Image Upload</label>
	
					<div class="col-sm-2">
					
					
					
<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo base_url(); ?>product_con/upload/'>



Upload your image <input type="file" name="photoimg" id="photoimg" />



</form>



<div id='preview' style="padding:5px">

<img style='display:none' src="<?php echo base_url(); ?>img/loader.gif" id="img">


</div>
	
					
					</div>
				 <div class="col-sm-1">
  <button type="button" id="pur_complete" onclick="updateProduct(this)" class="btn btn-primary">Submit</button>

           </div> 				

							
									
			
		
		
		</div>
<script src="<?php echo base_url(); ?>js/custom/jquery.form.js"></script>	
		
<script src="<?php echo base_url(); ?>js/custom/link.js"></script>
		
<script src="<?php echo base_url(); ?>js/custom/mul.js"></script>
<script src="<?php echo base_url(); ?>js/custom/store_to_trans.js"></script>
		
		
		
		</div>
</div>