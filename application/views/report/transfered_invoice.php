<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default heads">
		
		<div class="panel-heading" style="height:55px">
			
			
				Invoice Report
				<div class="col-sm-6">
				<form action="<?php echo base_url(); ?>mains/indi_invoice_trans" method="post">
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
				
				<form action="<?php echo base_url(); ?>mains/transfered_invoice" method="get">
<table align="center">
<tr>

<td><div class="feild">Start Date</div></td>
<td><input class="tcal" type="input" name="start_date" value="<?php echo date('d-m-Y',strtotime($start_date)) ?>" /></td>

<td><div class="feild">End Date</div></td>
<td><input class="tcal" type="input" name="end_date" value="<?php echo date('d-m-Y',strtotime($end_date)); ?>" /></td>
<td>

				<select name="type" class="form-control"></select>



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
					<th>from</th>
					<th>Date</th>
					<th>P Date</th>
				</tr>
			</thead>
			<tbody>
			
			
					<?php foreach($all as $val): ?>
					
					
						<tr>
						
							<td><?php echo $val['invoice']; ?></td>

							<td><?php

							
								
	echo $this->report_model->getPname('ware','id',$val['ware'],'name');														
								
						
							
							?></td>
							
							
							<td><?php echo $val['date']; ?></td>
							<td><?php echo $val['pdate']; ?></td>
							<td><a style="color:red;" href="<?php echo base_url(); ?>mains/view_transfered_invoice/<?php echo $val["invoice"] ?>/<?php echo $val["ware"] ?>" target="_blank">View</a></td>

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