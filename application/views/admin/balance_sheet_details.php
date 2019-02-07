<?php include "CostOfGoods.php"; ?>
<?php include "store/store.php"; ?>


<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default heads">
		
			<div class="panel-heading">
			
			
				Balance Sheet Details
			
			
			</div>
			<div class="panel-body">	
				<div class="row">
				
				<form action="<?php echo base_url(); ?>mains/balance_sheet_details" method="post">
<table align="center">
<tr>

<td><div class="feild">Date</div></td>
<td><input class="tcal" type="input" name="start_date" value="<?php echo date('d-m-Y',strtotime($end)) ?>" /></td>

</tr>
</table>


<div class="form-group" style="text-align:center">	
<button type="submit" target="_blank" class="btn btn-info">Submit</button></div>

</form>
				
				</div>
				
				
			<div class="row" style="text-align:center;margin:0;padding:0">
		
<?php
	$this->db->where("id", $ware); 
	$result = $this->db->get('ware');
	$row = $result->row();
?>		
			<h3><?php echo $row->name; ?></h3>	
		
		
		</div>
				
				
		<div class="row" style="text-align:center">
		
		<h3 style="margin:0;padding:0">As At <?php echo date('M d,Y'); ?></h3>
		
		
		</div>		
		
		<div class="row">
		
		
				<div class="col-sm-12">
				
	<table style="width: 100%">


		<tbody style="background:white">
		
			
			
		
			<?php



				$data['all']=$this->report_model->getTrialBalance('setting','head',3);
				
				foreach($data['all'] as $vals){
					
					?>
					
					<tr>
					
					<td style="text-align:left;"><strong><?php echo $vals['name']; ?></strong></td>
					<td style="text-align:center;"><strong>Taka</strong></td>
					<td style="text-align:right;">
							
							<strong>
							
	<?php	

	
			
		$cgs=new CostOfGoods();
	
	
		$expense=explode(':',$cgs->getFactory_expense2($vals['id'],$start,$end,$start_b,$end_b));
		
		
		
		echo number_format(round($expense[0],2), 2, '.', ',');	
				?>
						
							
							
							</strong>
							
							
							
					</td>
					
						<td style="text-align:right;"><strong>
							
							
							<?php  
							
								echo number_format(round($expense[1],2), 2, '.', ',');
							
						?>	
							</strong></td>
					
					</tr>
					
					
					
					<tr style='border:1px solid;'>
			
					<td style='border-right:1px solid;'><strong>
					
						Particular
					
					</strong></td>
					
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


			$str=new store();
			
				$data['sub']=$this->report_model->getTrialBalance('setting','head',$vals['id'],'','','orders','asc');	


				foreach($data['sub'] as $s){
					?>
						<tr>
					
						<td style="text-align:left">
						<?php echo $s['name']  ?>
					
					</td>	
					<td></td>	
					<td style="text-align:right;border:1px solid;">
					
						<?php

						

						
			$val=explode(':',$str->getAdministretive($s['id'],$start,$end));
				
				
				echo number_format(round($val[0],2), 2, '.', ',');


						?>
					
					
					</td>	
					<td style="text-align:right;border:1px solid;">
					
					
					<?php

					echo number_format(round($val[1],2), 2, '.', ',');  
					
					
					
					?>
					
					
					</td>
					
						</tr>
						
						
						
						
						

						
						
					<?php
					
				}
				
				
				
				$ci =& get_instance();					

				
				$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','parent_head_id',$vals['id']);
				$admin = $ci->session->userdata('admin');				

				foreach($ledger_id['all'] as $leg){
					
	$op_debit=$ci->report_model->getBalance2('product_trans','date',$start,$end,'dr',$leg['id'],$admin);

	
	$op_credit=$ci->report_model->getBalance2('product_trans','date',$start,$end,'cr',$leg['id'],$admin);				
			$t=$leg['opening_balance']+($op_debit - $op_credit);
					
					
					?>
				
					<tr>
					
								<td style="text-align:left">
					
					
						<?php echo $leg['ledger_title']  ?>
					
					</td>	
					<td></td>	
					<td style="text-align:right;border:1px solid;">
					
						<?php

						

						
		
				
				
				echo number_format(round($t,2), 2, '.', ',');


						?>
					
					
					</td>	
					<td style="text-align:right;border:1px solid;">
					
					
					<?php

					echo number_format(round($leg['opening_balance'],2), 2, '.', ',');  
					
					
					
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
	
			<td style="text-align:left"><strong>Total</strong></td>
			<td></td>
			<td style="text-align:right"><strong><?php


			echo number_format(round($expense[0],2), 2, '.', ',');
			
			
			
			?></strong></td>
			<td style="text-align:right"><strong><?php

			//echo $expense[1] 
			
			
			echo number_format(round($expense[1],2), 2, '.', ',');
			
			
			?></strong></td>
	
	</tr>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<!--<tr>
					
					
							<td style="text-align:left;"><strong>Financial Expenses :</strong></td>
							<td style="text-align:center;"><strong>Taka</strong></td>
							<td style="text-align:right;"><strong>
							
	<?php	

	
			
	//$cgs=new CostOfGoods();
	
	
	//$expense=explode(':',$cgs->getFactory_expense2(105,$start,$end,$start_b,$end_b));
		
		
		
	//	echo number_format(round($expense[0],2), 2, '.', ',');	
				?>
						
							
							
							</strong></td>
							<td style="text-align:right;">
							
							<strong>
							
							
							<?php  
							
	//	echo number_format(round($expense[1],2), 2, '.', ',');
							
							?>	
							</strong>
							
							
							</td>
					
					
					</tr>-->
	
	
	
<!---	<tr style='border:1px solid;'>
			
					<td style='border-right:1px solid;'><strong>
					
						Particular
					
					</strong></td>
					
					<td style='border-right:1px solid;'><strong>
					
					
					</strong></td>
					
	<td style='border-right:1px solid;'>
				
		<div class="col-sm-12" style='border-bottom:2px solid'>
				
				<strong><?php //echo date('d.m.Y',strtotime($end)); ?></strong>
				
		</div>
		<div class="col-sm-12">
				
				<strong>TAKA</strong>
				
		</div>

	</td>
				
							
				<td>
				
	<div class="col-sm-12" style='border-bottom:2px solid'>
				<strong>
				<?php
//
			//	$start_date=date('d.m.Y');
				 

					//echo date('d.m.Y',strtotime($end . ' - 1 year'));
				
				
				
				?>
				</strong>
		</div>
		<div class="col-sm-12">
				<strong>
				TAKA
				</strong>
				
		</div>			
				
				
				
				
				
				
				
				
				
				</td>		
						
					
					
			
			</tr>-->
	
	
	
	
	
	
						
		
	
	
	<!--<tr>
	
			<td style="text-align:left"><strong>Total</strong></td>
			<td></td>
			<td style="text-align:right"><strong><?php


		//	echo number_format(round($expense[0],2), 2, '.', ',');
			
			
			
			?></strong></td>
			<td style="text-align:right"><strong><?php

			//echo $expense[1] 
			
			
		//	echo number_format(round($expense[1],2), 2, '.', ',');
			
			
			?></strong></td>
	
	</tr>-->
	
	
	
	
	
	
	
	
	
	<tr>
					
					
							<td style="text-align:left;"><strong>Factory Overhead :</strong></td>
							<td style="text-align:center;"><strong>Taka</strong></td>
							<td style="text-align:right;"><strong>
							
	<?php	

	
			
	$cgs=new CostOfGoods();
	
	
	$expense=explode(':',$cgs->getFactory_expense2(99,$start,$end,$start_b,$end_b));
		
		
		
		echo number_format(round($expense[0],2), 2, '.', ',');	
				?>
						
							
							
							</strong></td>
							<td style="text-align:right;">
							
							<strong>
							
							
							<?php  
							
		echo number_format(round($expense[1],2), 2, '.', ',');
							
							?>	
							</strong>
							
							
							</td>
					
					
					</tr>
	
	
	
	<tr style='border:1px solid;'>
			
					<td style='border-right:1px solid;'><strong>
					
						Particular
					
					</strong></td>
					
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


				$data['sub']=$this->report_model->getTrialBalance('setting','head',99,'','','orders','asc');	


				foreach($data['sub'] as $s){
					?>
						<tr>
					
								<td style="text-align:left">
					
					
						<?php echo $s['name']  ?>
					
					</td>	
					<td></td>	
					<td style="text-align:right;border:1px solid;">
					
						<?php

						
						
						
						
			$val=explode(':',$str->getAdministretive($s['id'],$start,$end));
				
				
				echo number_format(round($val[0],2), 2, '.', ',');


						?>
					
					
					</td>	
					<td style="text-align:right;border:1px solid;">
					
					
					<?php

					echo number_format(round($val[0],2), 2, '.', ',');  
					
					
					
					?>
					
					
					</td>
					
						</tr>
					<?php
					
				}
				
				
				$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','parent_head_id',99);
				
				foreach($ledger_id['all'] as $leg){
					
	$op_debit=$ci->report_model->getBalance2('product_trans','date',$start,$end,'dr',$leg['id'],$admin);		
	$op_credit=$ci->report_model->getBalance2('product_trans','date',$start,$end,'cr',$leg['id'],$admin);				
			$t=$leg['opening_balance']+($op_debit - $op_credit);
					
					
					?>
					<tr>
					
							<td style="text-align:left;">
							
									<?php echo $leg['ledger_title']; ?>
							
							</td>
							<td></td>
							<td style="text-align:right;border:1px solid;"><?php


							//echo $t 
							
	echo number_format(round($t,2), 2, '.', ',');						
							
							?></td>
							<td style="text-align:right;border:1px solid;"><?php

							//echo $leg['opening_balance']; 
							
					echo number_format(round($leg['opening_balance'],2), 2, '.', ',');			
							
							
							?></td>
					
					
					
					</tr>
					
					
					<?php
					
				}
				
				
				
				
				
				

			?>

	
	<tr>
	
			<td style="text-align:left"><strong>Total</strong></td>
			<td></td>
			<td style="text-align:right"><strong><?php


			echo number_format(round($expense[0],2), 2, '.', ',');
			
			
			
			?></strong></td>
			<td style="text-align:right"><strong><?php

			//echo $expense[1] 
			
			
			echo number_format(round($expense[1],2), 2, '.', ',');
			
			
			?></strong></td>
	
	</tr>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<tr>
					
					
							<td style="text-align:left;"><strong>Cost of Goods Sold :</strong></td>
							<td style="text-align:center;"><strong>Taka</strong></td>
							<td style="text-align:right;"><strong>
							
	<?php 
	
	
	$data['all']=$this->report_model->getTrialBalance('setting','head',83);

		$cgs=new CostOfGoods();
		
		$total_open=0;
		$total_open_before=0;
		$expense=0;
		foreach($data['all'] as $val)
			{
					
		
	
	
	$ex=explode(':',$cgs->getCheck($val['id'],$start,$end,$start_b,$end_b));
	
	$total_open=$total_open+$ex[0];
	$total_open_before=$total_open_before+$ex[1];
			
			}
			
		$val=explode(':',$str->openingStock(83,$start,$end));
		
		$t=$val[0]+$val[1];
		$c=$t -($val[2]);
		
		
		$expense=explode(':',$cgs->getFactory_expense(99,$start,$end,$start_b,$end_b));
		
		$cost=$c+$expense[0];
		
		
		$op=explode(':',$cgs->finshed_good_oc(98,$start,$end,$start_b,$end_b));	

		$tfinish=$cost+$op[0];
		
		$gross=$tfinish-($op[1]);

							
							
				//echo number_format(round($gross,2), 2, '.', ',');

	
							?>
						
							
							
							</strong></td>
							<td style="text-align:right;"><strong>
							
							0.00
							
							<?php /* $gross_b=($total_open_before+$expense[1]+$op_b); 
							
								$this->db->where('id', 248);
								$query = $this->db->get("ledger");	
								$row = $query->row();
								$gross_b =$row->opening_balance;
							
							
								echo number_format(round($gross_b,2), 2, '.', ',');*/
							
						?>
							</strong></td>
					
					
					</tr>
					<tr style='border:1px solid;'>
			
					<td style='border-right:1px solid;'><strong>
					
						Particular
					
					</strong></td>
					
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
	
	
	
	<tr>	
					<td style="text-align:left">
					
					
						Opening Stock of Materials
					
					</td>	
					<td></td>	
					<td style="text-align:right;border:1px solid;">
					
						<?php

						
				
						
						
			$val=explode(':',$str->openingStock(83,$start,$end));
				
				
				
				
				
				
				
					echo number_format(round($val[0],2), 2, '.', ',');


						?>
					
					
					</td>	
					<td style="text-align:right;border:1px solid;">
					
					
					
					<?php

					echo number_format(round($val[3],2), 2, '.', ',');  
					
					
					
					?>
					
					
					</td>	
						
	</tr>
	
	
	<tr>	
					<td style="text-align:left">
					
					
						Add :Materials purchase during the year
					
					</td>	
					<td></td>	
					<td style="text-align:right;border:1px solid;">
					
					
						<?php

								
				
				
					echo number_format(round($val[1],2), 2, '.', ',');


						?>
					
					
					</td>	
					<td style="text-align:right;border:1px solid;">
					
						0.00
					
					<?php

					//echo number_format(round($val[1],2), 2, '.', ',');  
					
					
					
					?>
					
					
					</td>	
						
	</tr>
	
	
	<tr>	
					<td style="text-align:left">
					
					
					
					</td>	
					<td></td>	
					<td style="text-align:right;border:1px solid;">
					<strong>
						<?php

								
				$t=$val[0]+$val[1];
				
					echo number_format(round($t,2), 2, '.', ',');


						?>
					</strong>
					
					</td>	
					<td style="text-align:right;border:1px solid;">
					
					<strong>	
					
					
					<?php

				$tb=$val[3];	
					
					echo number_format(round($tb,2), 2, '.', ',');
					
					
					
					?>
					
					</strong>
					</td>	
						
	</tr>
	
	<tr>	
					<td style="text-align:left">
					
					
						Less : Closing Stock of Materials
					
					</td>	
					<td></td>	
					<td style="text-align:right;border:1px solid;">
					
						<?php

								//$val=explode(':',$str->purchase($tt['id'],$start,$end,2,$t['id']));
				
				$c=$t - ($val[2]);
				
					echo number_format(round($val[2],2), 2, '.', ',');


					//echo $to_av*115081.18;
					
						?>
					
					
					</td>	
					<td style="text-align:right;border:1px solid;">
					
					
					
					<?php

					echo number_format(round($tb,2), 2, '.', ',');  
					
					
					
					?>
					
					
					</td>	
						
	</tr>
	
	
	<tr>	
					<td style="text-align:left">
					
					
						 Materials Consumed
					
					</td>	
					<td></td>	
					<td style="text-align:right;border:1px solid;">
					
						<?php

								//$val=explode(':',$str->purchase($tt['id'],$start,$end,2,$t['id']));
				
				
					echo number_format(round($c,2), 2, '.', ',');


						?>
					
					
					</td>	
					<td style="text-align:right;border:1px solid;">
					
					
					
					<?php

					echo number_format(round($tb,2), 2, '.', ',');  
					
					
					
					?>
					
					
					</td>	
						
	</tr>
	
	<tr>	
					<td style="text-align:left">
					
					
						Add : Factory Overhead
					
					</td>	
					<td></td>	
					<td style="text-align:right;border:1px solid;">
					
						<?php

				$expense=explode(':',$cgs->getFactory_expense(99,$start,$end,$start_b,$end_b));
				
				
					echo number_format(round($expense[0],2), 2, '.', ',');


						?>
					
					
					</td>	
					<td style="text-align:right;border:1px solid;">
					
					
					<?php

					echo number_format(round($expense[1],2), 2, '.', ',');  
					
					
					
					?>
					
					
					</td>	
						
	</tr>
	
	<tr>	
					<td style="text-align:left">
					
					
						Cost of Production
					
					</td>	
					<td></td>	
					<td style="text-align:right;border:1px solid;">
					
						<?php

								//$val=explode(':',$str->purchase($tt['id'],$start,$end,2,$t['id']));
				$cost=$c+$expense[0];
				
					echo number_format(round($cost,2), 2, '.', ',');


						?>
					
					
					</td>	
					<td style="text-align:right;border:1px solid;">
					
					
					
					<?php

					$costb=$tb+$expense[1];
					
					echo number_format(round($costb,2), 2, '.', ',');  
					
					
					
					?>
					
					
					</td>	
						
	</tr>
	
	<tr>	
					<td style="text-align:left">
					
					
					<strong>	Cost Of Goods Sold </strong>
					
					</td>	
					<td></td>	
					<td style="text-align:right;border:1px solid;">
					<strong>
						<?php

								//$val=explode(':',$str->purchase($tt['id'],$start,$end,2,$t['id']));
				
				
					echo number_format(round($cost,2), 2, '.', ',');


						?>
					
					</strong>
					</td>	
					<td style="text-align:right;border:1px solid;">
					<strong>
					
					<?php

					echo number_format(round($costb,2), 2, '.', ',');  
					
					
					
					?>
					</strong>
					
					</td>	
						
	</tr>
	
		</tbody>


		
	</table>

	
				
				
				
				</div>
				
		
		</div>		
				
			</div>
			
		</div>

	
	
	
	<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>	
		
	</div>
	
	
</div>
		
		