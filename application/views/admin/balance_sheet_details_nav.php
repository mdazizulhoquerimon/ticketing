<?php include "store/store.php"; ?>
<?php include "CostOfGoods.php"; ?>

<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default heads">
		
			<div class="panel-heading">
			
			
				Balance Sheet Details
			
			
			</div>
			<div class="panel-body">
			
			
			
				<div class="row">
				
							
						<?php

						
		$data['all']=$this->report_model->getTrialBalance('setting','head',$id,'','','orders','asc');
$check=0;


$total_close_qun=0;
			$total_open=0;
			
			$total_close_qunl=0;
			$total_openl=0;
			$checks=0;

		if(!empty($data['all']))
		{
			?>
			<table style="width: 100%">
			<tbody>
			<tr style='border:1px solid;padding:10px'>
			
					<td style='border-right:1px solid;'><strong>
					
						Particular
					
					</strong>
					
					
					</td>
					
					<td style='border-right:1px solid;'><strong>
					
					
					</strong></td>
					
	<td style='border-right:1px solid;'>
				
		<div class="col-sm-12" style='border-bottom:2px solid'>
				
				<strong><?php echo date('d.m.Y',strtotime($end)); ?></strong>
				
		</div>
		<div class="col-sm-12">
				
				<strong>TAKA</strong>
				
		</div>

	</td>
				
							
				<td>
				
	<div class="col-sm-12" style='border-bottom:2px solid'>
				<strong>
				<?php

				$start_date=date('d.m.Y');
				 

					echo date('d.m.Y',strtotime($end . ' - 1 year'));
				
				
				
				?>
				</strong>
		</div>
		<div class="col-sm-12">
				<strong>
				TAKA
				</strong>
				
		</div>			
				
				
				
				
				
				
				
				
				
				</td>		
						
					
					
			
			</tr>
			
			
			
			
			
			
			
			
			<?php
			
			
			
			$str=new Store();
			foreach($data['all'] as $t)
			{
			
				?>
				
				
				
				
				
				
				
				<tr>	
					<td style="text-align:left">
					
					<a target="_blank" href="<?php echo base_url();?>mains/balance_sheet_details_nav/<?php echo $t['id'] ?>/<?php echo $t['ob'] ?>/<?php echo $head ?>/<?php echo $start ?>/<?php echo $end ?>">
						<?php echo $t['name'] ?>
					</a>
					</td>	
					<td></td>	
					<td style="text-align:right;border:1px solid;">
					
					
					
						<?php

					$val=explode(':',$str->getStoreValue($t['id'],$start,$end,$type,$head));
				
				
					echo number_format(round($val[0],2), 2, '.', ',');

					
					$check=$check + $val[0];
					
					

						?>
					
					
					
					</td>	
					<td style="text-align:right;border:1px solid;">
					
					
					<?php

					echo number_format(round($val[1],2), 2, '.', ',');  
					
					$checks=$checks + $val[1];
					
					
					?>
					
					
					</td>	
						
						</tr>
			
			
			<?php
			}
			
			?>
			</tbody>
			</table>
			
			
			
			
			
			
			
			
			
			<?php
			
			$ci =& get_instance();
	
	if($head == 83)
	{
$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger','head',$id);							
			
	}
	else{
		
	$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','parent_head_id',$id);	

	
	}
			
		?>	
		
		
		<table style="width: 100%">
			<tbody>	
			
		<?php	
			
			
			foreach($ledger_id['all'] as $leg)
		{
			
			if($head == 83)
			{
				
				?>
				<tr>
				
						<?php
						
						
		$last_price=$this->report_model->getLastPrice('product',$start,$end,$leg['code']);				
						
$op_debit=$ci->report_model->getQuantity2('product','',$start,$end,'d_id',$leg['code'],'');
		
		
$op_credit=$ci->report_model->getQuantity2('product','',$start,$end,'c_id',$leg['code'],'');
		
		
 $total_close=(($leg['opening_stock']+($op_debit-$op_credit))*$last_price);
		 
		 
		 $total_close_qun=$total_close_qun+(($leg['opening_stock']+($op_debit-$op_credit))*$last_price);

						?>
						
		<td style="text-align:left">
						
	<?php echo $leg['name'] ?>
						
		</td>
		<td style="text-align:left;width:459px">
						
							
						
		</td>
			<td style="text-align:right">
						
							<?php 
							
							
	$cu= $leg['opening_stock']*$leg['buy_price'];
echo number_format(round($cu,2), 2, '.', ',');

	
	
							?>
						
			</td>
			<td style="text-align:right">
						
						<?php

	$total_open=$total_open+$leg['opening_stock']*$leg['buy_price'];
					
		echo number_format(round($total_close,2), 2, '.', ',');
					
						
						?>
						
			</td>
						
				
				</tr>
				
				
				<?php	
				
				
			}
			else{
				
				?>
				<tr>
				
						<?php
						
						
						
						
$debit=$ci->report_model->getBalance2('product_trans','',$start,$end,'dr',$leg['id'],'');
					
$credit=$ci->report_model->getBalance2('product_trans','',$start,$end,'cr',$leg['id'],'');

						?>
						
		<td style="text-align:left;width:465px"">
						
	<?php echo $leg['ledger_title'] ?>
						
		</td>
		<td style="text-align:left">
						
							
						
		</td>
			
			<td style="text-align:right">
						
						<?php

	if($type == 1)
	{				
	$cu= ($debit - $credit)+$leg['opening_balance'];
	$total_close_qunl=$total_close_qunl+($debit - $credit)+$leg['opening_balance'];	
	}
	else{
		
		
		
		
		$cu= ($credit - $debit)+$leg['opening_balance'];
	$total_close_qunl=$total_close_qunl+($credit - $debit)+$leg['opening_balance'];	
		
	}
	
	
	echo number_format(round($cu,2), 2, '.', ',');
	
	
	
	$check=$check+$cu;
	
	






	
						
						?>
						
			</td>
						
				<td style="text-align:right">
						
							<?php 
	echo number_format(round($leg['opening_balance'],2), 2, '.', ',');

	
	$total_openl=$total_openl+$leg['opening_balance'];
	
	
	$checks=$checks+$leg['opening_balance'];
	
							?>
						
			</td>
				</tr>
				
				
				<?php
				
			}
			
			
			
			
			
			?>
			
				
			
			
			
			
			<?php
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
			
			if($head == 83)
			{
				?>
				<tr>
				
					<td><strong>Total</strong></td>
					<td></td>
					<td style="text-align:right">
					
					<strong>
					
					
					<?php


					///echo $total_open

echo number_format(round($check),2);	




					?>
					
					
					
					
					</strong>
					
					
					
					</td>
					<td style="text-align:right"><strong><?php

					//echo $total_close_qun 
					
echo number_format(round($checks),2);	
					
					
					
					?></strong>
					
					
					
					
					</td>
				
				</tr>
				
				
				<?php
				
			}
			else{
				
				
				
			?>
				<tr>
				
					<td><strong>Total</strong></td>
					<td></td>
					<td style="text-align:right">
					
					<strong>
					
					
					<?php

					//echo $total_openl 
					
echo number_format(round($check),2);	
					
					
					?>
					
					
					
					
					</strong>
					
					
					
					</td>
					<td style="text-align:right"><strong><?php

					//echo $total_close_qunl


echo number_format(round($checks),2);	

					?></strong></td>
				
				</tr>
				
				
				<?php	
				
				
			}
			
			?>
			
			
			
			
			</tbody>
			
			
		</table>
			
		<?php
			
			
			
			
			
			
			
		}
		else{
			
			
	



	
			
			
			
	$ci =& get_instance();
	
	if($head == 83)
	{
$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger','head',$id);							
			
	}
	else{
		
	$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','parent_head_id',$id);	

	
	}
			
		?>	
		<table style="width: 100%">



          <thead>
			
			
				<th style="text-align:right;border-bottom:2px solid"></th>
				<th style="text-align:right;border-bottom:2px solid"></th>
				<th style="text-align:right;border-bottom:2px solid">Opening</th>
				<th style="text-align:right;border-bottom:2px solid">Closing</th>
			
			
			</thead>
			<tbody>	
			
		<?php	
			
			
	foreach($ledger_id['all'] as $leg)
		{
			
			if($head == 83)
			{
				
				?>
				<tr>
				
						<?php
						
						
		$last_price=$this->report_model->getLastPrice('product',$start,$end,$leg['code']);				
						
$op_debit=$ci->report_model->getQuantity2('product','',$start,$end,'d_id',$leg['code'],'');
		
		
$op_credit=$ci->report_model->getQuantity2('product','',$start,$end,'c_id',$leg['code'],'');
		
		
 $total_close=(($leg['opening_stock']+($op_debit-$op_credit))*$last_price);
		 
		 
$total_close_qun=$total_close_qun+(($leg['opening_stock']+($op_debit-$op_credit))*$last_price);

						?>
						
		<td style="text-align:left">
						
	<?php echo $leg['name'] ?>
						
		</td>
		<td style="text-align:left;width:459px">
						
							
						
		</td>
		
			
			<td style="text-align:right">
						
							<?php 
							
							
	$cu= $leg['opening_stock']*$leg['buy_price'];
	echo number_format(round($cu,2), 2, '.', ',');

		$check=$check+$cu;

	
							?>
						
			</td>			
			<td style="text-align:right">
						
						<?php

	$total_open=$total_open+$leg['opening_stock']*$leg['buy_price'];
					
		echo number_format(round($total_close,2), 2, '.', ',');
				$checks=$checks+$total_close;
			
						
						?>
						
			</td>	
				</tr>
				
				
				<?php	
				
				
			}
			else{
				
				?>
				<tr>
				
						<?php
						
						
						
						
$debit=$ci->report_model->getBalance2('product_trans','',$start,$end,'dr',$leg['id'],'');
					
$credit=$ci->report_model->getBalance2('product_trans','',$start,$end,'cr',$leg['id'],'');

						?>
						
		<td style="text-align:left;width:465px">
						
	<?php echo $leg['ledger_title'] ?>
						
		</td>
		<td style="text-align:left">
						
							
						
		</td>
			<td style="text-align:right">
						
							<?php 
	echo number_format(round($leg['opening_balance'],2), 2, '.', ',');

	
	$total_openl=$total_openl+$leg['opening_balance'];
	
	
	$check=$check+$leg['opening_balance'];
	
							?>
						
			</td>
			<td style="text-align:right">
						
						<?php

	if($type == 1)
	{				
	$cu= ($debit - $credit)+$leg['opening_balance'];
	$total_close_qunl=$total_close_qunl+($debit - $credit)+$leg['opening_balance'];	
	}
	else{
		
		
		
		
		$cu= ($credit - $debit)+$leg['opening_balance'];
	$total_close_qunl=$total_close_qunl+($credit - $debit)+$leg['opening_balance'];	
		
	}
	
	
	echo number_format(round($cu,2), 2, '.', ',');
	
	
	
	$checks=$checks+$cu;
	
	






	
						
						?>
						
			</td>
						
				
				</tr>
				
				
				<?php
				
			}
			
			
			
			
			
			?>
			
				
			
			
			
			
			<?php
			
		}
		
				?>
				
				<tr>
				
					<td><strong>Total</strong></td>
					<td></td>
					<td style="text-align:right">
					
					<strong>
					
					
					<?php


					///echo $total_open

						echo number_format(round($check),2);	




					?>
					
					
					
					
					</strong>
					
					
					
					</td>
					<td style="text-align:right"><strong><?php

					//echo $total_close_qun 
					
						echo number_format(round($checks),2);	
					
					
					
					?></strong>
					
					
					
					
					</td>
				
				</tr>
				
				
			
			
			
			
			
			</tbody>
			
			
			
			
		</table>
			
		<?php
		
		
		
		
		
		}
		

						?>
						
							
						
				
				
				</div>
				
				
			</div>
			
	</div>

	
	
	
	<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>
</div>

</div>