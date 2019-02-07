<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default heads">
		
			<div class="panel-heading">
			
				Trial Balance Details
			
			
			</div>
			<div class="panel-body">
			
			<div class="row">
			
			<form action="<?php echo base_url(); ?>mains/trial_details/<?php echo $head ?>/<?php echo $type ?>" method="post">
<table align="center">
<tr>

<td><div class="feild">Start Date</div></td>
<td><input class="tcal" type="input" name="start_date" value="<?php echo date('d-m-Y') ?>" /></td>

<td><div class="feild">End Date</div></td>
<td><input class="tcal" type="input" name="end_date" value="<?php echo date('d-m-Y'); ?>" /></td>
</tr>
</table>


<div class="form-group" style="text-align:center">	
<button type="submit" target="_blank" class="btn btn-info">Submit</button></div>

</form>
			
			
			
			</div>
			
		<div class="row">
		
		
		
		
		<table  class="display table table-bordered" id="dynamic-table" >
		<thead>
			<tr>
				<th>SL</th>
				<th>HEAD</th>
				<th>DEBIT</th>
				<th>CREDIT</th>
			</tr>
		</thead>
		<tbody>
		
		<?php $j=1;$admin = $this->session->userdata('admin'); foreach($assets as $as): ?>
		
			<tr>
			
				<td colspan="4" style="background:#DDDDDD;color:black">
				
					<strong><?php echo $as['name'] ?> :</strong>
				
				</td>
			
			</tr>
			
	<?php $sub=0;$subc=0;  $data['all']=$this->report_model->getTrialBalance('setting','head',$as['id']); ?>
		
		
	<?php if(!empty($data['all'])){

		$j=1;
		
      foreach($data['all'] as $ass): ?>
			
					<tr>
					
						<td><strong><?php echo $j++; ?></strong></td>	
						<td><strong><?php echo $ass['name']; ?></strong></td>	
						
						
						
						<?php

	$test=array();
	$test=$this->report_model->getTrialValue('setting','head',$ass['id']);	
	$length=count($test);
	$k=$length-1;
	
	

			
		
			$debit=0;
			$credit=0;
			$amount=0;
			for($i=$length-1;$i>=0;$i--){
				
$ledger_id['all']=$this->report_model->getTrialBalance('ledger','parent_head_id',$test[$i]);
			
				foreach($ledger_id['all'] as $leg){
					
$debit=$debit+$this->report_model->getFinalDCValue('product_trans','dr',$leg['id'],'amount',$start,$end,$admin);
					
$credit=$credit+$this->report_model->getFinalDCValue('product_trans','cr',$leg['id'],'amount',$start,$end,$admin);
					
					
		
				}
			
			
			}
						
			//echo $debit." checck ".$credit."<br>";


			
						if((int)$type == 1){
								
						if($debit>$credit)		
						{
							?>
<td><a target="_blank" href="<?php echo base_url();?>mains/trial_details/<?php echo $ass['id'] ?>/<?php echo $as['ob'] ?>/<?php echo $start; ?>/<?php  echo $end;?>"><?php
								
	echo number_format(round(($debit-$credit),2), 2, '.', ',');								
								
						$sub=$sub+($debit-$credit);		
						$subc=$subc+0;	

$debit=0;
$credit=0;
						
								
								?></a></td>
								<td>0.00</td>
							<?php
						}
						else if($debit<$credit)
						{
							?>
							<td>0.00</td>
							<td><a target="_blank" href="<?php echo base_url();?>mains/trial_details/<?php echo $ass['id'] ?>/<?php echo $as['ob'] ?>/<?php echo $start; ?>/<?php  echo $end;?>"><?php
								
	echo number_format(round(($credit-$debit),2), 2, '.', ',');								
								
						$subc=$subc+($credit-$debit);		
						//$subc=$subc+0;		
							$debit=0;
							$credit=0;	
								?></a></td>
								
							<?php
						}

	?>						

								
								<?php	
							
						}
						else if((int)$type == 2)
						{
							if($debit>$credit)		
						{
							?>
							<td><a target="_blank" href="<?php echo base_url();?>mains/trial_details/<?php echo $ass['id'] ?>/<?php echo $as['ob'] ?>/<?php echo $start; ?>/<?php  echo $end;?>"><?php
								
	echo number_format(round(($debit-$credit),2), 2, '.', ',');								
								
						$sub=$sub+($debit-$credit);		
						$subc=$subc+0;		
								$debit=0;
								$credit=0;
								?></a></td>
								<td>0.00</td>
							<?php
						}
						else if($debit<$credit)
						{
							
							?>
							<td>0.00</td>
							<td><a target="_blank" href="<?php echo base_url();?>mains/trial_details/<?php echo $ass['id'] ?>/<?php echo $as['ob'] ?>/<?php echo $start; ?>/<?php  echo $end;?>"><?php
								
	echo number_format(round(($credit-$debit),2), 2, '.', ',');								
								
						$subc=$subc+($credit-$debit);		
						//$subc=$subc+0;		
							$debit=0;
							$credit=0;	
								?></a></td>
								
							<?php
						}	
								
							
						}
						else{
							
							?>
							<td>0.00</td>
							<td>0.00</td>
							
							<?php
							
						}
						?>	 
			
			
			
	
	
						
						
					
					</tr>
			
			<?php endforeach; ?>
		
		
		<?php

				
						
	$ledger_id['all']=$this->report_model->getTrialBalance('ledger','parent_head_id',$as['id']);
						
					
						foreach($ledger_id['all'] as $leg){
		
		$debit=0;
		$credit=0;
		
			$db=$this->report_model->getFinalDCValue('product_trans','dr',$leg['id'],'amount',$start,$end,$admin);
			
			
			$cr=$this->report_model->getFinalDCValue('product_trans','cr',$leg['id'],'amount',$start,$end,$admin);
			
			//$debit=$db;
					
			//$credit=$cr;
							

			?>
				<tr>
				<td><?php echo $j++; ?></td>
				<td><?php echo $leg['ledger_title'] ?></td>
				
				<?php
				
				
					if($db>$cr)		
						{
							?>
<td><a target="_blank" href="<?php echo base_url(); ?>mains/report_ledger/<?php echo $leg['id'] ?>/<?php echo $leg['type'] ?>/<?php echo $start ?>/<?php echo $end ?>"><?php
						
	echo number_format(round(($db-$cr),2), 2, '.', ',');
					
						//$subc=$subc+0;
						$debit=$db-$cr;
						
						?></a></td>
								<td>0.00</td>
							<?php
						}
						else if($db<$cr)
						{
							?>
							<td>0.00</td>
							<td><a target="_blank" href="<?php echo base_url(); ?>mains/report_ledger/<?php echo $leg['id'] ?>/<?php echo $leg['type'] ?>/<?php echo $start ?>/<?php echo $end ?>"><?php
						
	echo number_format(round(($cr-$db),2), 2, '.', ',');
					
						//$subc=$subc+0;
					$debit=$cr-$db;
						
						?></a></td>
								
							<?php
						}
				
				if((int)$type == 2){
					
					
					$sub=$sub+$debit;
					
				}
				else if((int)$type == 1){
					
					$subc=$subc+$debit;
					
					
				}
				
				
			
				
				
				
				?>
				
									
								
			
				
				
				</tr>	
			<?php



			
				}
			


	}			
				?>
		
		
		
		
		
		
	
		
		
		
				
				<?php

					if(empty($data['all'])){
						
						
	$ledger_id['all']=$this->report_model->getTrialBalance('ledger','parent_head_id',$as['id']);
						
					
						foreach($ledger_id['all'] as $leg){
		
		$debit=0;
		$credit=0;
		
			$db=$this->report_model->getFinalDCValue('product_trans','dr',$leg['id'],'amount',$start,$end,$admin);
			
			
			$cr=$this->report_model->getFinalDCValue('product_trans','cr',$leg['id'],'amount',$start,$end,$admin);
			
			//$debit=$db;
					
			//$credit=$cr;
							

			?>
				<tr>
				<td><?php echo $j++; ?></td>
				<td><?php echo $leg['ledger_title'] ?></td>
				
				<?php
				
				
					if($db>$cr)		
						{
							?>
<td><a target="_blank" href="<?php echo base_url(); ?>mains/report_ledger/<?php echo $leg['id'] ?>/<?php echo $leg['type'] ?>/<?php echo $start ?>/<?php echo $end ?>"><?php
						
	echo number_format(round(($db-$cr),2), 2, '.', ',');
					
						//$subc=$subc+0;
						$debit=$db-$cr;
						
						?></a></td>
								<td>0.00</td>
							<?php
						}
						else if($db<$cr)
						{
							?>
							<td>0.00</td>
							<td><a target="_blank" href="<?php echo base_url(); ?>mains/report_ledger/<?php echo $leg['id'] ?>/<?php echo $leg['type'] ?>/<?php echo $start ?>/<?php echo $end ?>"><?php
						
	echo number_format(round(($cr-$db),2), 2, '.', ',');
					
						//$subc=$subc+0;
					$debit=$cr-$db;
						
						?></a></td>
								
							<?php
						}
				
				if((int)$type == 2){
					
					
					$sub=$sub+$debit;
					
				}
				else if((int)$type == 1){
					
					$subc=$subc+$debit;
					
					
				}
				
				
			
				
				
				
				?>
				
									
								
			
				
				
				</tr>	
			<?php



			
				}
			


	}			
				?>
		
	
		<tr>
				<td></td>
				<td><strong>SubTotal</strong></td>
	<?php
					if($type == 1){
							
							
								
								?>
		<td>
			<strong>
				<?php
					echo number_format(round($sub,2), 2, '.', ',');
								
				?>
								
			</strong>
								
								
								</td>
								
	<td>
			<strong>
					<?php
						echo number_format(round($subc,2), 2, '.', ',');
								
					?>
			</strong></td>
								
								<?php	
							
						}
						else if($type == 2)
						{
							
								
								?>
<td><strong><?php
					echo number_format(round($sub,2), 2, '.', ',');
								
				?></strong></td>
<td><strong><?php

								//echo $subc 
								
echo number_format(round($subc,2), 2, '.', ',');								
								?></strong></td>
								
								
								
								<?php	
							
						}
						else{
							?>
							<td><strong>0.00</strong></td>
							<td><strong>0.00</strong></td>
							
							<?php
							
							
						}



?>				
				
			
			</tr>
		
		
		
		<?php endforeach; ?>
		
		
	
		</tbody>
</table>
		
		
		
		
		
		</div>	
			
			
			
			
			
			
			
			
			
			
			
			
			
			</div>
			
	</div>
		

	
	
	
	<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>
	
</div>

</div>