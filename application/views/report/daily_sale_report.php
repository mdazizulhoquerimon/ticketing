<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default heads">
		
		<div class="panel-heading" style="height:55px">
			
			
				Invoice Report
				<div class="col-sm-6">
				<form action="<?php echo base_url(); ?>mains/indi_invoice" method="post">
				<div class="col-sm-6">
				<input class="form-control" name="inv" id="ir" placeholder="Search Invoice" required>
			
				</div>
			<div class="col-sm-4">
				<input class="btn btn-success" type="submit" value="submit">
			
				</div>
				
				</form>
				</div>
				
			</div>
			<div class="panel-body">	
				<div class="row">
				
				<form action="<?php echo base_url(); ?>mains/daily_sale_report" method="get">
<table align="center">
<tr>

<td><div class="feild">Start Date</div></td>
<td><input class="tcal" type="input" name="start_date" value="<?php echo date('d-m-Y',strtotime($start_date)) ?>" /></td>

<td><div class="feild">End Date</div></td>
<td><input class="tcal" type="input" name="end_date" value="<?php echo date('d-m-Y',strtotime($end_date)); ?>" /></td>
<td>

				<select name="type" class="form-control">
				
				
					<option value=""></option>
					<option value="1">PURCHASE</option>
					<option value="2">PURCHASE RETURN</option>
					<option value="3">SALE</option>
					<option value="4">SALE RETURN</option>
						<option value="5">Issu</option>
						<option value="12">Service</option>
					<option value="6">Pending Invoice</option>

				
				</select>



</td>
</tr>
</table>


<div class="form-group" style="text-align:center">	
<button type="submit" target="_blank" class="btn btn-info">Submit</button></div>

</form>
				
				</div>

				<div class="row">
				
				
				
				<table  class="display table table-bordered table-striped" id="dynamic-table" >
			<thead>
				<tr>
					<th>Invoice No</th>
<th>Invoice Type</th>
					<th>Name</th>
					<th>Date</th>
					<th>P Date</th>
				</tr>
			</thead>
			<tbody>
			
			
					<?php foreach($all as $val): ?>
					
					
						<tr>
						
							<td><?php echo $val['invoice']; ?></td>

<td><?php
$types=$val['type']; 
if($types == 1) echo "Purchase";
if($types == 2) echo "Purchase Return";
if($types == 3) echo "Sale";
if($types == 4) echo "Sale Return";
if($types == 6) echo "Pending Invoice";
if($types == 12) echo "Servicing";



?></td>


							<td><?php

							
								
	echo $this->report_model->anyName('ledger','id',$val['supplier'],'ledger_title');														
								
						
							
							?></td>
							
							
							<td><?php echo $val['date']; ?></td>
							<td><?php echo $val['pdate']; ?></td>
						
<td style="width: 100px;">




<?php

			if((int)$type != 6){
				?>
				
		<a style="color:red;font-weight:bold;" target="_blank" href="<?php echo base_url(); ?>mains/daily_sale_report_print/<?php echo $val['invoice'] ?>/<?php echo $val['issu'] ?>/<?php echo $val['supplier']?>">Print</a>

				
				<?php
			}
	
	?>

</td>
<td style="width: 100px;">



<?php

			if((int)$type != 6 && (int)$edit == 0){
				?>
				
				
				
		<a style="color:red;font-weight:bold;" href="<?php echo base_url(); ?>mains/invoice_edit/<?php echo $val['invoice'] ?>/<?php echo $val['issu'] ?>/<?php echo $val['supplier']?>" target="_blank">Edit</a>
	
				
				<?php
			}
	
	?>


</td>


<td>

<?php
		if((int)$edit == 0)
		{
				?>
		
		
	
		
		<a style="color:red;font-weight:bold;" onclick="return confirm('Are you sure to delete ?')" href="<?php echo base_url(); ?>mains/invoice_delete/<?php echo $val['invoice'] ?>">X</a>
		
		
		<?php
			
		}
		
		?>

</td>








						</tr>
					
					<?php endforeach; ?>
			
			
			</tbody>
			
			
</table>
				
				
				
				
				
				
				
				
				
				</div>
				
				
				
				<?php echo $links; ?>
				
				
				
				
				
			</div>
			
			
		</div>
		
		

	
	
	
	<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>
		
		<script src="<?php echo base_url(); ?>js/custom/link.js"></script>
		
		
		
		
		</div>
		</div>