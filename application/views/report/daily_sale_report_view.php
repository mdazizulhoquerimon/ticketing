  <div id="page-wrapper">
    <div class="container-fluid">
			
       <div class="row">
           <div class="col-lg-12">
              <h4 class="page-header">Report</h4>
           </div>
                   
       </div>
	   
	   <div class="row">
	   
	     <div class="col-lg-12">
             
			  
			  <?php
			  
	$ware=$this->session->userdata('wire');		  
	$this->db->where("id", $ware); 
	$result = $this->db->get('ware');
	$row = $result->row();
?>		
			<h3><?php echo $row->name; ?></h3>	
		
			  
			  
			  
           </div>
		 

		<div class="col-lg-12">
		
		
			<div class="row">
			
			
				<div class="col-sm-3 col-xs-3">
				
						<div class="col-sm-8">
						
							<p>SL NO ......................</p>
						
						</div>
						<div class="col-sm-4"></div>
				
				</div>
				<div class="col-sm-6 col-xs-6">
				
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
					
					<p style="text-align:center;font-size:16px;border-bottom:2px solid;">Daily Sales Reports</p>
					
					</div>
					<div class="col-sm-3"></div>
				
				</div>
				<div class="col-sm-3 col-xs-3">
				
				
				</div>
			
			
			
			
			</div>		
					
					
			<div class="row" style="margin-bottom:15px">
			
				<div class="col-sm-10 col-xs-10">
				
				
					Name of the SR/MR/Supervisor: <?php echo $name;?>
				
				</div>
				<div class="col-sm-2 col-xs-2"></div>
			
			
			</div>	
		
		
		
		
		</div>



		 
		<div class="panel panel-default">
				 
				  <div class="panel-heading">
                          
						  View Report
                   </div>
	   
	   
			<div class="panel-body">
			
			
			<table style="width:100%;border:1px solid;background:white">
<thead>
<tr style="border:1px solid;">
<th style="text-align:center">PRODUCT NAME</th>
<th style="text-align:center">Price</th>
<th style="text-align:center">RECEIVING QTN</th>
<th style="text-align:center">SALES</th>
<th style="text-align:center">SALES AMOUNT</th>
</tr>
</thead>

	<tbody>

		<?php $total=0; foreach($all as $val): ?>
		
		
				<tr style="border:1px solid;">
				
<td style="text-align:center">

<?php echo $this->report_model->anyName('product_ledger','code',$val['code'],'name');
					 ?>
					 
					 
					 
	</td>
	
	<td style="text-align:center"><?php echo $val['price']; ?></td>
	
	
	
					<td style="text-align:center"><?php echo $val['pices']; ?></td>
					<td style="text-align:center"><?php echo ($val['pices'] - $val['return_qun']); ?></td>
					<td style="text-align:center">
					
					
					<?php


					$data= ($val['pices'] - $val['return_qun'])*$val['price']; 
					
					
					echo number_format(round($data,0), 2, '.', ',');
					
					//echo $data;
					
					$total=$total+$data;
					
					
					?>
					
					
					</td>
				
				</tr>
		
		
		
		<?php endforeach; ?>
		
		
		<?php foreach($inv as $in): ?>
		
		
		<tr>
		
		<td></td>
		<td></td>
		<td></td>
		<td style="text-align:center"><strong>Total </strong></td>
		<td style="text-align:center"> <strong><?php

		
		echo number_format(round($total,0), 2, '.', ',');

		//echo $total
		
		
		
		
		?></strong></td>
		
		
		</tr>
		
		<tr>
		
		<td></td>
		<td></td>
		<td></td>
		<td style="text-align:center"><strong>Discount </strong></td>
		<td style="text-align:center"> <strong><?php

		//echo $in['gross_dis']
		
		echo number_format(round($in['gross_dis'],0), 2, '.', ',');
		
		
		
		?></strong></td>
		
		
		</tr>
		
		<tr>
		
		<td></td>
		<td></td>
		<td></td>
		<td style="text-align:center"><strong>Cash </strong></td>
		<td style="text-align:center"> <strong><?php


		echo number_format(round($in['cash'],0), 2, '.', ',');
		//echo $in['cash']
		
		
		
		
		?></strong></td>
		
		
		</tr>
		
		
		<tr>
		
		<td></td>
		<td></td>
		<td></td>
		<td style="text-align:center"><strong>Bkash </strong></td>
		<td style="text-align:center"> <strong><?php


		///echo $in['bk_amount']
		
		
		echo number_format(round($in['bk_amount'],0), 2, '.', ',');
		
		
		
		
		?></strong></td>
		
		
		</tr>
		
		
		<tr>
		
		<td></td>
		<td></td>
		<td></td>
		<td style="text-align:center"><strong>Bank </strong></td>
		<td style="text-align:center"> <strong><?php


		//echo $in['card']
		
echo number_format(round($in['card'],0), 2, '.', ',');		
		
		
		
		?></strong></td>
		
		
		</tr>
		
		
		<tr>
		
		<td></td>
		<td></td>
		<td></td>
		<td style="text-align:center"><strong> Previous Due </strong></td>
		<td style="text-align:center"><strong><?php


		//echo $previous 
		
echo number_format(round($previous ,0), 2, '.', ',');		
		
		
		
		?></strong></td>
		
		
		
		</tr>
		<tr>
		
		<td></td>
		<td></td>
		<td></td>
		<td style="text-align:center"><strong>Due </strong></td>
		<td style="text-align:center"><strong><?php


		$due=($this->report_model->anyName('invoice','invoice',$invoice,'due'));
		
		
		
		echo number_format(round($due ,0), 2, '.', ',');		

		
		
		
		?></strong></td>
		
		
		</tr>
		
		
		
		<tr>
		
		<td></td>
		<td></td>
		<td></td>
		<td style="text-align:center"><strong> Total Due </strong></td>
		<td style="text-align:center"><strong><?php


		$due=($this->report_model->anyName('invoice','invoice',$invoice,'due') + $previous);
		
		
		
		echo number_format(round($due ,0), 2, '.', ',');		

		
		
		
		?></strong></td>
		
		
		</tr>
		
		
		
		
		
		
		
		
		
		
		<tr>
		
		<td></td>
		<td></td>
		<td></td>
		<td style="text-align:center"><strong>Closing Balance</strong></td>
		<td style="text-align:center"><strong><?php 

		
		echo number_format(round($closing ,0), 2, '.', ',');	
		
		
		
		?></strong></td>
		
		
		</tr>

	
<?php endforeach; ?>
</tbody>


</table>
			
			
			
			
			</div>
	   
	   
	   
		</div>
	   
	   
	   </div>
	   
	   
	   
	   
				
	</div>
			
			
			
<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
			
			
			
			
</div>