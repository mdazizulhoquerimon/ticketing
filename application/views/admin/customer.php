 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                       
<div class="col-lg-6">


   <h1 class="page-header">Setting Accounts</h1>



</div>
<div class="col-lg-6">
<h1 class="page-header">

<a href="#pop2" data-hd="0" id="chat" data-id="0" class="btn btn-danger">Chat of Account</a></h1>

</div>

					
                    </div>
                   
                </div>
				
				<div class="col-lg-12">
				
				
				<section class="panel">
				
				
				 <header class="panel-heading">
			
			

  <span id="sub"></span>
				 </header>
				
	<div class="panel-body" style="padding: 15px;
min-height: 500px;
overflow: auto;">
				
						
			<div class="row" style="margin-bottom:15px;margin-right: -6px;
}" id="body">
			
			
			
			</div>
			
			
<div id="pop2" class="Modal">
				
				
					<div class="content">
					
						<div id="childs" class="row" style="text-align:center;margin-bottom:5px;">
							
								<h3>Chat Of Account</h3>	
							
							
						</div>
						
						<div class="row">
						
						<div class="col-sm-12">
			
			
				<table id="cchild">
				
				
					
				
				
				
				
				</table>
			
			
			</div>
				</div>		
						<span class="closes"></span>
					
				</div>
				
				
				</div>
			
			<div class="row" id="pop" style="display:none">
			
			
			<a href="#Popup"><button style='font-family:cursive;padding:10px;font-weight:bold;back' onclick='create_ladger()' id="btn_pop" type="button">Create Ledger</button></a>
			
			
	<a href="#Popup"><button style='font-family:cursive;padding:10px;font-weight:bold;back' onclick='ladger_all()' id="ladger_all" type="button">Ledger All</button></a>
	
	<a href="#Popup"><button style='font-family:cursive;padding:10px;font-weight:bold;back;' onclick='create_product()' id="btn_product" type="button">Create Product Ledger</button></a>
	
	<a href="#Popup"><button style='font-family:cursive;padding:10px;font-weight:bold;back;' onclick='product_all()' id="product_all" type="button">Product All</button></a>
			
			
			</div>
			
			
			
			
			
			
			
			
				<div class="row" id="re">
			
			<?php $i=1; foreach($all as $val):?>
                    <div class="row">
					
						<div class="col-sm-3" id="<?php echo $val['id']."s" ?>">
					
                        <label onclick="parent_change(<?php echo $val['id'] ?>,<?php echo $val['head'] ?>,<?php echo $val['ob'] ?>)" style="font-size:20px;text-align:right;" class="col-sm-3 control-label">
						
						<?php echo $i ?>)<?php echo $val['name'] ?>
						
						
						</label>
						</div>
						
						
						<div class="col-sm-2">
						
						<?php 
						
							if($val['acces'] == 1){
								
								?>
					<div class="col-sm-3" id="<?php echo $val['id']."main" ?>">
							
	<a onclick="edit_new(<?php echo $val['id'] ?>,'<?php echo $val['name'] ?>',<?php echo $i ?>,<?php echo $val['head'] ?>)" style="color:red;font-weight:bold" href="#"><span id="<?php echo $val['id'] ?>">Edit</span></a>
							
							</div>
							<div class="col-sm-5" id="<?php echo $val['id']."d" ?>">
							
							<a onclick="delete_new(<?php echo $val['id'] ?>,<?php echo $val['head'] ?>)" style="color:red;font-weight:bold" href="#">X</a>
							
							</div>
							
								
								<?php
								
							}
						
							?>
							
						
						</div>
                    </div>
                    	
					
			<?php $i++; endforeach; ?>
			
			</div>
				
									
				<div id="Popup" class="Modal">
						<div class="content">
  
		<div id="ltitle" class="row" style="text-align:center;margin-bottom:5px;">
							
								<h3>CREATE LEDGER</h3>	
							
							
		</div>
		<div  id="ltable" class="row" style="display:none;background:white;">
		
		
			<div class="col-sm-12">
								
								
								
				<div class="form-group">
				
				<strong>
					<label class="col-sm-4" id="job_count" style='color:red;'>
					
					
						
					
					</label>
					
				</strong>
				<div class="col-sm-6" style="text-align:right">
				
				
				
						<ul id="pagi" style="margin:0;padding:0;list-style:none;">
						
							
						
						</ul>
				
				
				</div>
				</div>				
								
								
			</div>
		<div class="col-sm-12" style='overflow:auto'>
				<table class="table table-bordered">
				
					<thead>
					
							<tr>
								<th>Ledger</th>
								<th>Bank Name</th>
								<th>Bank Address</th>
								<th>Account Name</th>
								<th>Account No</th>
								<th>Opening Balance</th>
								<th>Remark</th>
								<th>Phone</th>
								
							</tr>
					
					</thead>
					<tbody id="table_data">
					
					
					
					</tbody>
				
				</table>
		</div>
		
		</div>
		
		
		<div  id="ptable" class="row" style="display:none;background:white;overflow:auto">
		
			<div class="col-sm-12">
								
								
								
				<div class="form-group">
				
				<strong>
					<label class="col-sm-4" id="page_c" style='color:red;'>
					
					
						
					
					</label>
					
				</strong>
				<div class="col-sm-6" style="text-align:right">
				
				
				
						<ul id="pc" style="margin:0;padding:0;list-style:none;">
						
							
						
						</ul>
				
				
				</div>
				</div>				
								
								
			</div>
		
		
		
				<table class="table table-bordered">
				
					<thead>
					
							<tr>
								<th>pcode</th>
								<th>pname</th>
								<th>pices</th>
								<th>category</th>
								<th>pr.type</th>
								<th>unit</th>
								<th>sorting</th>
								<th>opening stock</th>
								<th>buy price</th>
								<th>cost</th>
								<th>sell price</th>
								<th>Wire H</th>
							</tr>
					
					</thead>
					<tbody id="ptable_data">
					
					
					
					</tbody>
				
				</table>
		
		
		</div>
		
		
		
		<div id="lbody" class="row" style="overflow:auto;display:none">

						
							
								<div class="col-sm-12">
								
								
									<div class="row r_padding">
									
											
	<label style="text-align:right" class="col-sm-3">Ledger Title</label>
	<div class="col-sm-3">
					
			<input id="title" type="text" class="form-control">
					
					
	</div>
	<label class="col-sm-2">Bank Name</label>
					<div class="col-sm-3">
					
						<input id="bname" type="text" class="form-control">
					
					
					</div>						
									
									</div>
									
									
							
									
									
									
									
									
									
									
									
								
			




<div class="row r_padding">
									
											
	<label class="col-sm-3" style="text-align:right">Bank Account Name</label>
	<div class="col-sm-3">
					
		<input id="ac_name" type="text" class="form-control">
					
					
	</div>
		<label class="col-sm-2">Bank Account No</label>
					<div class="col-sm-3">
					
						<input id="ac_no" type="text" class="form-control">
					
					
					</div>							
									
</div>



<div class="row r_padding">
									
											
					<label style="text-align:right" class="col-sm-3">Branch Address</label>
					<div class="col-sm-3">
					
						<input id="address" type="text" class="form-control">
					
					
					</div>
									
						
					<label class="col-sm-2">Opening Balance</label>
					<div class="col-sm-3">
					
						<input id="balance" type="text" class="form-control">
					
					
					</div>									
</div>				
								
		

<div class="row r_padding">
									
											
					<label style="text-align:right" class="col-sm-3">Date</label>
					<div class="col-sm-2">
					
						<input id="date" type="text" class="input-lg m-bot15">
					
					
					</div>
					
					
						<label style="text-align:right" class="col-sm-3">Remark</label>
					<div class="col-sm-3">
					
						<textarea id="remark" class="form-control"></textarea>
					
					
					</div>
					
					
					
					
									
									
				</div>

				<div class="row r_padding">
				
				
				
				
				<label style="text-align:right" class="col-sm-3">Warehouse</label>
					<div class="col-sm-3">
					
	<select id="wl" class="form-control">
	
		<?php

			$type=$this->session->userdata('type');
			
			if($type == 1){
				?>
				
					<option value="0">Admin</option>
				
				<?php
			}
			

		?>
	
	
	
		<?php foreach($ware as $val):?>
	
			<option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
	
		<?php endforeach; ?>
		
		
		
		
	</select>
					
					
					</div>
				
				<label class="col-sm-2">Phone Number</label>
				
				<div class="col-sm-3">
				
				
			<input id="phone" type="text" class="form-control">	
				
				
				
				</div>
				
				</div>
				
								
	
								
								
								</div>
						
						
		
							</div>
					
							
							
							
<div id="pbody" class="row" style="overflow:auto;display:none">

						
								<div class="col-sm-12">
							
								
									<div class="row r_padding">
									
											
	<label style="text-align:right" class="col-sm-3">Product Code</label>
					<div class="col-sm-3">
					
						<input id="pcode" type="text" class="form-control">
					
					
					</div>
								

									
		<label style="text-align:right" class="col-sm-3">Product Name</label>
					<div class="col-sm-3">
					
						<input id="pname" type="text" class="form-control">
					
					
					</div>								
									
									</div>
									
									
							
									
									
									
									
									
									
									
									
								
			
				
				
				
			<div class="row r_padding">
									
											
		<label style="text-align:right" class="col-sm-3">Pices of Carton</label>
					<div class="col-sm-3">
					
						<input id="carton" type="text" class="form-control">
					
					
					</div>
			<label style="text-align:right" class="col-sm-3">Warehouse</label>
					<div class="col-sm-3">
					
	<select id="ware" class="form-control">
	
		<?php

			$type=$this->session->userdata('type');
			
			if($type == 1){
				?>
				
					<option value="0">Admin</option>
				
				<?php
			}
			

		?>
	
	
		<?php foreach($ware as $val):?>
	
			<option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
	
		<?php endforeach; ?>
	</select>
					
					
					</div>						
									
				</div>	
				
				
				



<div class="row r_padding">
									
											
<label style="text-align:right" class="col-sm-3">Category</label>
					<div class="col-sm-3">
					
					<select id="category" class="form-control">
					
					
							<?php foreach($category as $ca): ?>
							
							
							
<option value="<?php echo $ca['id'] ?>"><?php echo $ca['name']; ?></option>
							
							
							<?php endforeach; ?>
					
					
					
					
					
					
					
					</select>
					
					
					
					</div>
		<label style="text-align:right" class="col-sm-3">Unit</label>
					<div class="col-sm-3">
					
						<input id="unit" type="text" class="form-control">
					
					
					</div>							
									
				</div>





<div class="row r_padding">
									
											
					<label style="text-align:right" class="col-sm-3">Sorting</label>
					<div class="col-sm-3">
					
						<input id="sorting" type="text" class="form-control input-lg m-bot15">
					
					
					</div>
					<label style="text-align:right" class="col-sm-3">Opening Stock</label>
		<div class="col-sm-3">
					
			<input id="open" type="text" class="form-control">
					
					
		</div>
								
									
				</div>				
								
								


<div class="row r_padding">
									
											
	<label style="text-align:right" class="col-sm-3">Buy Price</label>
	<div class="col-sm-3">
					
		<input id="buy" type="text" class="form-control">
					
					
	</div>
		<label style="text-align:right" class="col-sm-3">Cost</label>
					<div class="col-sm-3">
					
			<input id="cost" type="text" class="form-control">

					
					
					</div>							
									
</div>				
								
	

		<div class="row r_padding">
									
											
	<label style="text-align:right" class="col-sm-3">Selling Price</label>
					<div class="col-sm-3">
					
			<input id="sell" type="text" class="form-control">

					
					
					</div>
					
					
	<label style="text-align:right" class="col-sm-3">Price Type</label>
					<div class="col-sm-3">
					
<select id="price_type" class="form-control">


                                <option value="2">Customize Price</option>
				<option value="1">Fixed Price</option>
				

</select>
					
					
					</div>				
					
									
									
				</div>
								
					
				<div class="row r_padding">
									
											
	<label style="text-align:right" class="col-sm-3">Image Upload</label>
					<div class="col-sm-3">
					
					
					
<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo base_url(); ?>product_con/upload/'>



Upload your image <input type="file" name="photoimg" id="photoimg" />



</form>



<div id='preview' style="padding:5px">

<img style='display:none' src="<?php echo base_url(); ?>img/loader.gif" id="img">


</div>
	
					
					</div>
								

							
									
				</div>
				
				<div class="row r_padding">
									
											
	<label style="text-align:right" class="col-sm-3"></label>
					<div class="col-sm-3">
					
	<button type="submit" onclick="process_p()" id="submit_p" class="btn btn-success">Submit</button>

	
					
					</div>
								

							
									
				</div>








					
					
								
								</div>
						
						
		
							</div>			
							
		<div class="row" id="pbtn" style="display:none">
							<div class="col-sm-12" style="text-align:right">
							
					<div class="col-sm-4"></div>
					<div class="col-sm-3">
					
	<button onclick="process()" id="submit_l" class="btn btn-primary">Submit</button>
					
					</div>
					<div class="col-sm-4"></div>
					
						</div>	
							</div>
							
							
							
							
						
	
							<span class="closes"></span>
	
	
	
	
	
						</div>
				</div>
				
	</div>			
				
					<div id="modals">
				
				<div class="col-sm-4"></div>
				<div class="col-sm-4" style="margin-top:15%;">
				
				<img style="display:none;" class="img" src="<?php echo base_url(); ?>css/715.gif" title="Loading........"/>
				
				
				
				</div>
				<div class="col-sm-4"></div>
				
				
		</div>
				
				
				</section>
				
				
				</div>
				
				
				
				
				
				
				
				
				
				
				
               
            </div>
            
<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
	
<script src="<?php echo base_url(); ?>js/custom/link.js"></script>

<script src="<?php echo base_url(); ?>js/custom/child.js"></script>	

<script src="<?php echo base_url(); ?>js/custom/add_list.js"></script>	


<script src="<?php echo base_url(); ?>js/custom/jquery.form.js"></script>	
<script src="<?php echo base_url(); ?>js/custom/product.js"></script>	
				

	<script>
	
		parent_change(<?php echo $id; ?>,<?php echo $id2 ?>,<?php echo $ob; ?>,1);
	
	
	
	</script>		
			
			
        </div>
		
		
		
		
		
		