<?php include "CostOfGoods.php"; ?>
<?php include "store/store.php"; ?>

<?php $cog=new CostOfGoods(); ?>


<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default heads">
		
			<div class="panel-heading">
			
				Trial Balance
			
			
			</div>
			
			<div class="panel-body">
			
			
			
				<div class="row">
				
				<form action="<?php echo base_url(); ?>mains/trial_balance" method="post">
<table align="center">
<tr>

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
		
		<?php $j=1;$tasset=0;$tlib=0; foreach($assets as $as): ?>
		
			<tr>
			
				<td colspan="4" style="background:#DDDDDD;color:black">
				
					<strong><?php echo $as['name'] ?> :</strong>
				
				</td>
			
			</tr>
			
	<?php $sub=0;$subc=0;  $data['all']=$this->report_model->getTrialBalance('setting','head',$as['id']); ?>
		
		
		<?php $j=1; foreach($data['all'] as $ass): ?>
			
					<tr>
					
	<td><strong><?php echo $j++; ?></strong></td>	
	<td><strong><?php echo $ass['name']; ?></strong></td>	
						
						
						
						<?php

	$test=array();
$test=$this->report_model->getTrialValue('setting','head',$ass['id']);	
	$length=count($test);
	$k=$length-1;
	
$admin = $this->session->userdata('admin');
			
		
			$debit=0;
			$credit=0;
			$amount=0;
			$store=0;
			
			
			for($i=$length-1;$i>=0;$i--){
				
			
				
$ledger_id['all']=$this->report_model->getTrialBalance('ledger','parent_head_id',$test[$i]);


			
				foreach($ledger_id['all'] as $leg)
					{
					
					
					
$debit=$debit+$this->report_model->getFinalDCValue('product_trans','dr',$leg['id'],'amount',$start,$end,$admin);
					
$credit=$credit+$this->report_model->getFinalDCValue('product_trans','cr',$leg['id'],'amount',$start,$end,$admin);
					
					
					
					
					
		
					}
				
			
			}
						
						
						if($as['id'] == 1 || $as['id'] == 3){
						

			
			

						
		if($debit>$credit){
						
	$sub=$sub+($debit-$credit);
	//$tasset=$tasset+$sub;				
					?>
					<td><a target="_blank" href="<?php echo base_url();?>mains/trial_details/<?php echo $ass['id'] ?>/<?php echo $as['ob'] ?>/<?php echo $start; ?>/<?php  echo $end;?>">
					
					
					<?php echo number_format(round(($debit-$credit+$store),2), 2, '.', ','); ?></a></td>
					<td>0.00</td>
					<?php
					
					
	}
	else if($debit<$credit){
						?>
					<td>0.00</td>
					<td><a target="_blank" href="<?php echo base_url();?>mains/trial_details/<?php echo $ass['id'] ?>/<?php echo $as['ob'] ?>/<?php echo $start; ?>/<?php  echo $end;?>">
					
					
					<?php echo number_format(round(($credit-$debit+$store),2), 2, '.', ','); ?></a></td>
				
<?php					
						//$sub=$sub-($credit-$debit);
						$subc=$subc+($credit-$debit);
						
						
		//$tasset=$tasset+$subc;				
						
						
	}
		else{
			?>
			<td>0.00</td>
			<td>0.00</td>
			<?php
		}
							
						}
else if($as['id'] == 2 || $as['id'] == 4)
	{
		
		
		
		
			if($debit>$credit){
						
					$sub=$sub+($debit-$credit);
					//$tlib=$tlib+$sub;	
					?>
					<td><a target="_blank" href="<?php echo base_url();?>mains/trial_details/<?php echo $ass['id'] ?>/<?php echo $as['ob'] ?>/<?php echo $start; ?>/<?php  echo $end;?>">
					
					
					<?php echo number_format(round(($debit-$credit),2), 2, '.', ','); ?></a></td>
					<td>0.00</td>
					<?php
					
					
	}
	else if($debit<$credit){
						?>
					<td>0.00</td>
					<td><a target="_blank" href="<?php echo base_url();?>mains/trial_details/<?php echo $ass['id'] ?>/<?php echo $as['ob'] ?>/<?php echo $start; ?>/<?php  echo $end;?>">
					
					
					<?php echo number_format(round(($credit-$debit),2), 2, '.', ','); ?></a></td>
				
<?php					
						$subc=$subc+($credit-$debit);
						//$tlib=$tlib+$subc;	
	}
		else{
			?>
			<td>0.00</td>
			<td>0.00</td>
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

				
				$debit=0;
				$credit=0;
				
				$ledger_id['all']=$this->report_model->getTrialBalance('ledger','parent_head_id',$as['id']);


			
				foreach($ledger_id['all'] as $leg)
					{
					
					
					
$debit=$this->report_model->getFinalDCValue('product_trans','dr',$leg['id'],'amount',$start,$end,$admin);
					
$credit=$this->report_model->getFinalDCValue('product_trans','cr',$leg['id'],'amount',$start,$end,$admin);
					
					?>
					
					<tr>
					
					
					<td></td>
					<td><?php echo $leg['ledger_title'] ?></td>
					
					
					<?php
					
					
					if($as['id'] == 1 || $as['id'] == 3){
						

			
			

						
		if($debit>$credit){
						
	$sub=$sub+($debit-$credit);
	
			
  

	
					?>
					<td><?php echo number_format(round(($debit-$credit),2), 2, '.', ',');?></td>
					<td>0.00</td>
					
					<?php
					
					
	}
	else if($debit<$credit){
						?>
					
					<td>0.00</td>
					<td><?php echo number_format(round(($credit-$debit),2), 2, '.', ',');?></td>
					
				
<?php					
						//$sub=$sub-($credit-$debit);
						$subc=$subc+($credit-$debit);
						
						
		//$tasset=$tasset+$subc;				
						
						
	}
		else{
			?>
			<td>0.00</td>
			<td>0.00</td>
			<?php
		}
							
						}
						
						
						
						
else if($as['id'] == 2 || $as['id'] == 4)
	{
		
		
		
		
			if($debit>$credit){
						
					$sub=$sub+($debit-$credit);
					//$tlib=$tlib+$sub;	
					?>
					<td><?php echo number_format(round(($debit-$credit),2), 2, '.', ',');?></td>
					
					<td>0.00</td>
					<?php
					
					
	}
	else if($debit<$credit){
						?>
					<td>0.00</td>
				<td><?php echo number_format(round(($credit-$debit),2), 2, '.', ',');?></td>
						
<?php					
						$subc=$subc+($credit-$debit);
						//$tlib=$tlib+$subc;	
	}
		else{
			?>
			<td>0.00</td>
			<td>0.00</td>
			<?php
		}
								
	
						}
					
				?>
					
		</tr>
		
		<?php
					}




			?>
			
			
			
			
			
			
			
			
			
			
		
		<?php


				if($as['id'] == 3)
			{
				$store=$store+$cog->getPurchaseValue($start,$end);
				
			//$tasset=$tasset+$store;	
				
				
				?>
				
				<tr>
		<td></td>
		<td><strong>Purchase</strong></td>
			<td>
			
				<?php  echo number_format(round($store,2), 2, '.', ','); //echo $store;

			$sub=$sub+$store;

				?>
			
			</td>
		<td>0.00</td>
		
		
		</tr>
		

				
				<?php
				
				
			}

if($as['id'] == 1)
			{
				$store=$store+$cog->getPurchaseValue($start,$end);
				
			//$tasset=$tasset+$store;	
				
				
				?>
				
		
		
		
				
				<?php
				
				
			}

			?>
		
		
		
		
		
			
		<tr>
			
				<td></td>
				<td><strong>SubTotal</strong></td>
				
				<?php

					if($as['id'] == 1 || $as['id'] == 3){
							
							 $tasset=$tasset+$sub;
							 $tlib=$tlib+$subc;
								
								?>
<td><strong><?php
echo number_format(round($sub,2), 2, '.', ',');
								
								
								
								?></strong></td>
								
								<td><strong>
								
					<?php
	echo number_format(round($subc,2), 2, '.', ',');
								
				?></strong></td>
								
								<?php

								
								$sub=0;
								$subc=0;
						}
						else if($as['id'] == 2 || $as['id'] == 4)
						{
							 $tasset=$tasset+$sub;
							 $tlib=$tlib+$subc;
								
								?>
<td><strong><?php
echo number_format(round($sub,2), 2, '.', ',');
								//echo $sub 
								
								
								?></strong></td>
<td><strong><?php

								//echo $subc 
								
echo number_format(round($subc,2), 2, '.', ',');								
								?></strong></a></td>
								
								
								
								<?php	
						$sub=0;
								$subc=0;	
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
		
		<tr style='margin-top:20px'>
			<td></td>
			<td><strong>
			
			Grand Total
			
			</strong></td>
			<td><strong>
			
			<?php echo number_format(round($tasset,2), 2, '.', ',');
 //echo $tasset ?>
			
			</strong></td>
			<td><strong>
			
			<?php echo number_format(round($tlib,2), 2, '.', ','); //echo $tlib ?>
			
			</strong></td>
			
			</tr>
	
		</tbody>
</table>
			
			
			
			
			
			
			</div>
			
			
			
			
			
			</div>
		
		
		</div>
		

	
	
	
	<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>	

	
	
	
	
	</div>
	
</div>