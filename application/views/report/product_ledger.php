<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default heads">
		
			<div class="panel-heading">
			
			
				Product Report
			
			
			</div>
			<div class="panel-body">	
				<div class="row">
				
				<form action="<?php echo base_url(); ?>mains/product_report" method="post">
<table align="center">
<tr>

<td><label for="text">Product Name</label>	</td>
<td><span class="input-wrap"> <input type="input" name="ledger_id" id="product"></span></td>

<td><div class="feild">Start Date</div></td>
<td><input class="tcal" type="input" name="start_date" value="<?php echo date('d-m-Y',strtotime($start)) ?>" /></td>

<td><div class="feild">End Date</div></td>
<td><input class="tcal" type="input" name="end_date" value="<?php echo date('d-m-Y',strtotime($end)); ?>" /></td>
</tr>
</table>


<div class="form-group" style="text-align:center">	
<button type="submit" target="_blank" class="btn btn-info">Submit</button></div>

</form>
				
				
				</div>
				
				
				
			
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			</div>
			
			
		</div>
		<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>	
	
	
	
	<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>
	<script src="<?php echo base_url(); ?>js/custom/link.js"></script>
	<script src="<?php echo base_url(); ?>js/custom/mul.js"></script>
	
	
	
		
	</div>
	</div>