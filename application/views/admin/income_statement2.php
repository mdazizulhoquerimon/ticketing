<?php include "CostOfGoods.php"; ?>
<?php include "store/store.php"; ?>


<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default heads">
		
			<div class="panel-heading">
			
			
				Income Statement
			
			
			</div>
			<div class="panel-body">	
				<div class="row">
				
				
				<form action="<?php echo base_url(); ?>mains/income_statement2" method="post">
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
			<h3 style="margin:0;padding:0"><?php echo $row->name; ?></h3>	
		
		
		</div>
		
		
		
			<div class="row" style="text-align:center">
		
	<h3 style="margin:0;padding:0">Statement of Financial Position</h3>	
		
		</div>
		
		<div class="row" style="text-align:center">
		
		<h3 style="margin:0;padding:0">As At <?php echo date('M d,Y',strtotime($end)); ?></h3>
		
		
		</div>
				
				
			<div class="col-sm-12">
			
			
			
			
				<table style="width: 100%">


		<tbody style="background:white">
		
			<tr style='border:1px solid;'>
			
					<td style='border-right:1px solid;'><strong>
					
						PARTICULARS
					
					</strong></td>
					
					<td style='border-right:1px solid;'><strong>
					
						NOTE
					
					</strong></td>
					
	<td style='border-right:1px solid;width:150px;'>
				
		<div class="col-sm-12" style='border-bottom:2px solid'>
				
				<strong><?php echo date('d.m.Y',strtotime($end)); ?></strong>
				
		</div>
		<div class="col-sm-12">
				
				<strong>TAKA</strong>
				
		</div>

	</td>
				
							
				<td style='width:150px;'>
				
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
		$sub=0;

		$subc=0;
		$total_asset=0;
		$total_assetb=0;

		$al=array(
		
		"A",
		"B",
		"C",
		"D",
		"E",
		"F",
		"G",
		
		);		
		
		
		?>
		<tr>
		
				<td style="text-align:left"><strong>REVENUE:</strong></td>
				<td colspan="3"></td>
		
		</tr>
		
			
			
					<tr>
					
	<td style="text-align:left">
	
		
						Sale
	
	</td>
	<td></td>
	
	<td style="text-align:right;font-weight:bold;">
	
	
			<div class="col-sm-12">
			
			
			<?php

	$vals=explode(':',getSales(87,$start,$end,$start_b,$end_b));

		//echo $vals[0];
	echo number_format(round($vals[0],2), 2, '.', ',');	

	?>
			
			</div>
	
	
	</td>
	<td style="text-align:right;font-weight:bold;">
	<div class="col-sm-12">
	<?php

	
echo number_format(round($vals[1],2), 2, '.', ',');	
		///echo $vals[1];
	
	?>
	
	</div>
	</td>
						
					</tr>

					
					
					<tr>
					
	<td style="text-align:left">
	
		
						Add:Non-Operating Profit Of the year
	
	</td>
	<td></td>
	
	<td style="text-align:right;font-weight:bold;">
	
	
			<div class="col-sm-12">
			
			
			<?php

	$operting=explode(':',getSales(193,$start,$end,$start_b,$end_b));

		//echo $vals[0];
	echo number_format(round($operting[0],2), 2, '.', ',');	

	?>
			
			</div>
	
	
	</td>
	<td style="text-align:right;font-weight:bold;">
	<div class="col-sm-12">
	<?php

	
echo number_format(round($operting[1],2), 2, '.', ',');	
		///echo $vals[1];
	
	?>
	
	</div>
	</td>
						
					</tr>
					
					
					
					
					
					
					
					
					
					<tr>
					
						<td style="text-align:left">Less:VAT</td>
						<td></td>
						<td style="text-align:right">
						<div class="col-sm-12">
						<strong>
						<?php
						
			$cgs=new CostOfGoods();


				 $vat=explode(':',$cgs->getLessVat($start,$end));
			

			
			
			echo number_format(round($vat[0],2), 2, '.', ',');				
						?>
						
						</strong>
						</div>
						</td>
						<td style="text-align:right">
						<div class="col-sm-12">
						<strong>
						
						
						
						<?php

							echo number_format(round($vat[1],2), 2, '.', ',');
					
						?>
						
						
						
						</strong>
						</div>
						</td>
					
					</tr>
					
<tr>
					
						<td style="text-align:left"><strong>NET SALES</strong></td>
						<td></td>
						<td style="text-align:right;">
						
							<div class="col-sm-12" style="border-top:2px solid">
							
							<strong><?php 
							
							
							 $sale=($vals[0]+$operting[0])-$vat[0]; 
							
							
							
							
				echo number_format(round($sale,2), 2, '.', ',');			
							
							
							
							?></strong>
							
							</div>
						
						
						
						</td>
						<td style="text-align:right;">
						<div class="col-sm-12" style="border-top:2px solid">
							
							<strong><?php 
							
							
							 $sale_b=($vals[1]+$operting[1])-$vat[1]; 
							
				echo number_format(round($sale_b,2), 2, '.', ',');			
							
							
							
							?></strong>
							
							</div>
						
						
						</td>
					
</tr>					
					
<tr>
					
		<td style="text-align:left"><a target="_blank" href="<?php echo base_url(); ?>mains/balance_sheet_details/">Less: Cost of Goods Sold</a></td>
						<td></td>
						
						
<?php 


		$str=new store();
		
		
		$val=explode(':',$str->openingStock(83,$start,$end));
		
		$t=$val[0]+$val[1];
		$c=$t -($val[2]);
		
		
		$expense=explode(':',$cgs->getFactory_expense(99,$start,$end,$start_b,$end_b));
		
		$cost=$c+$expense[0];
		
		
		
		//$tfinish=$cost;
		
		$gross=$cost;


		

  ?>						
						
						<td style="text-align:right;">
						
							<div class="col-sm-12">
							
							<strong>
							 
							<?php  //$gross=($total_open+$expense[0]+$op_b) - $cl; 

							
	echo number_format(round($gross,2), 2, '.', ',');



	
							?></strong>
							
							</div>
						
						
						
						</td>
						<td style="text-align:right;">
						<div class="col-sm-12">
							
							
							<strong>
							<?php  //$gross_b=($expense[1]+$op[0]); 
							
$this->db->where('id', 248);
$query = $this->db->get("ledger");	
$row = $query->row();
$gross_b =$row->opening_balance;
							
							
	echo number_format(round($gross_b,2), 2, '.', ',');							
							?></strong>
							
							</div>
						
						
						</td>
					
</tr>					
					
				<tr>

					<td style='text-align:left'>
					
					<strong>Gross Profit for the year</strong>
					
					</td>
					<td></td>
					<td style='text-align:right;'><strong>
					
					
						<div class="col-sm-12" style='border-top:2px solid;'>
						
						<?php


						 $to=$sale - $gross;
				

						//echo $to;
						
		echo number_format(round($to,2), 2, '.', ',');				
						
						?>
						
						</div>
					
					</strong>
					
					
					</td>
					<td style='text-align:right;'><strong>
					
					
						<div class="col-sm-12" style='border-top:2px solid;'>
						
						<?php


						 $to_b=$sale_b - $gross_b;
						
						
	echo number_format(round($to_b,2), 2, '.', ',');				
						
						?>
						
						</div>
					
					</strong>
					
					
					</td>

				</tr>					
					
				<tr>
				
					<td style='text-align:left'>
						<a target="_blank" href="<?php echo base_url(); ?>mains/balance_sheet_details/">Less: Administrative & Other Expenses</a></strong>
					</td>
				<td></td>
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12">
			<?php		
		$expense=explode(':',$cgs->getFactory_expense2(3,$start,$end,$start_b,$end_b));
		
		
			//echo $expense[0];
		
		echo number_format(round($expense[0],2), 2, '.', ',');	
				?>	
					</div>
					
					
					</td>
					
					
					
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12">
			<?php		
		
		
		
		echo number_format(round($expense[1],2), 2, '.', ',');	
				?>	
					</div>
					
					
					</td>
				
				
				</tr>
				
				<tr>
				
					<td style='text-align:left'>
						<strong>Operating Profit  for the year</strong>
					</td>
				<td></td>
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12" style="border-top:2px solid">
			<?php		
		
						 $operating=$to-$expense[0];
						 
						 
						 
						 
		echo number_format(round($operating,2), 2, '.', ',');	
				?>	
					</div>
					</strong>
					
					</td>
					
					
					
					
					
				<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12" style="border-top:2px solid">
			<?php		
		
						 $operating_b=$to_b-$expense[1];
		echo number_format(round($operating_b,2), 2, '.', ',');	
				?>	
					</div>
					</strong>
					
					</td>	
					
					
					
					
					
					
					
					
					
					
				
					
				
				
				</tr>	
						
						
				<tr>
				
					<td style='text-align:left'>
						<a target="_blank" href="<?php echo base_url(); ?>mains/balance_sheet_details/">Less: Financial Expenses</a>
					</td>
				<td></td>
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12">
			<?php


 $rent=$operating + 0;	
					
				$rent_from_banoful=0;
						
						 $rent_b=$operating_b + $rent_from_banoful;	

			
		$expense=explode(':',$cgs->getFactory_expense(-199,$start,$end,$start_b,$end_b));
		
		
			//echo $expense[0];
		
			echo number_format(round($expense[0],2), 2, '.', ',');	
				?>
					</div>
					</strong>
					
					</td>
				
				
				
				
				<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12">
			<?php		
		
				
			echo number_format(round($expense[1],2), 2, '.', ',');	
				?>
					</div>
					</strong>
					
					</td>
	
				</tr>
				
				
				<tr>
				
					<td style='text-align:left'><strong>
						Net Profit/(Loss)  before Tax</strong>			

					</td>
				<td></td>
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12" style='border-top:2px solid;'>
			<?php		
		
			$net_pro=$rent-$expense[0];
		
		echo number_format(round($net_pro,2), 2, '.', ',');		
				?>
					</div>
					</strong>
					
					</td>
					
					
					
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12" style='border-top:2px solid;'>
			<?php		
		
			$net_prob=$rent_b-$expense[1];
		
		echo number_format(round($net_prob,2), 2, '.', ',');		
				?>
					</div>
					</strong>
					
					</td>
				
				
				</tr>
				
				
				<tr>
				
					<td style='text-align:left'>
						Less:Provision for Taxation			

					</td>
				<td></td>
					
					
					
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12">
			<?php		
		
					//echo $net_pro
		$privi=explode(':',$cgs->getProvisionTax($start,$end));
		echo number_format(round($privi[0],2), 2, '.', ',');			
				?>
					</div>
					</strong>
					
					</td>
					
					
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12">
			<?php		
		
		echo number_format(round($privi[1],2), 2, '.', ',');			
				?>
					</div>
					</strong>
					
					</td>
				
				
				</tr>
				
				
				
				
				<tr>
				
					<td style='text-align:left'><strong>
						Net Profit/(Loss)  after Tax</strong>			

					</td>
				<td></td>
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12" style='border-top:2px solid;'>
			<?php		
		
		
		
			 $net=$net_pro-$privi[0];
		echo number_format(round($net,2), 2, '.', ',');
		
				?>
					</div>
					</strong>
					
					</td>
					
					
					
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12" style='border-top:2px solid;'>
			<?php		
		
		
		
			 $net_b=$net_prob-$privi[1];
		echo number_format(round($net_b,2), 2, '.', ',');
		
				?>
					</div>
					</strong>
					
					</td>
				
				
				</tr>
				
				<tr>
				
					<td style='text-align:left'>
						Add: Balance brought forward from last year accounts				

					</td>
				<td></td>
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12">
				
							<?php
							$net_b2=0;
											
											$balance_froward_for_PL =0;
											$balance_froward_for_PL_running = $net_b + $balance_froward_for_PL;
					
$tax_expense=explode(':',$cgs->getFactory_expense(120,$start,$end,$start_b,$end_b));

			 $net_b2=$net_b+$balance_froward_for_PL;
			$financial_position_pro2 = $net_b2 - $tax_expense[1];				
							
											
								echo number_format(round($financial_position_pro2,2), 2, '.', ',');




								
	?>	
				
					</div>
					</strong>
					
					</td>
					
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12">
				<?php
echo number_format(round($balance_froward_for_PL,2), 2, '.', ',');	
	?>			
					</div>
					</strong>
					
					</td>
				
				
				</tr>
				
				<tr>
				
					<td style='text-align:left'><strong>
					
					</td>
				<td></td>
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12" style='border-top:2px solid;'>
			<?php		
		
		
		
			 $net=$net_pro+$financial_position_pro2;
		echo number_format(round($net,2), 2, '.', ',');
		
				?>
					</div>
					</strong>
					
					</td>
					
					
					
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12" style='border-top:2px solid;'>
			<?php		
		
		
		
			 $net_b=$net_b+$balance_froward_for_PL;
		echo number_format(round($net_b,2), 2, '.', ',');
		
				?>
					</div>
					</strong>
					
					</td>
				
				
				</tr>
	
	<tr>
				
					<td style='text-align:left'>
						Less: Income Tax Paid
					</td>
				<td></td>
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12">
			<?php		
		
		
		
			//echo $expense[0];
		
			echo number_format(round($tax_expense[0],2), 2, '.', ',');	
				?>
					</div>
					</strong>
					
					</td>
				
				
				
				
				<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12">
			<?php		
		
				
			echo number_format(round($tax_expense[1],2), 2, '.', ',');	
				?>
					</div>
					</strong>
					
					</td>
	
				</tr>
	
	<tr>
				
					<td style='text-align:left'>
						Add: Balance Carried to Financial Position				

					</td>
				<td></td>
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12">
				
							<?php
$financial_position = $net - $tax_expense[0];
echo number_format(round($financial_position,2), 2, '.', ',');	
	?>	
				
					</div>
					</strong>
					
					</td>
					
					<td style="text-align:right;">
					
					
					<strong>
					<div class="col-sm-12">
				<?php
				$financial_position_pro = $net_b - $tax_expense[1];
echo number_format(round($financial_position_pro,2), 2, '.', ',');	
	?>			
					</div>
					</strong>
					
					</td>
				
				
				</tr>
				
		</tbody>


		
	</table>
			
			
			
			
			
			
			
			</div>	
				
				
			<div class="row" style="margin-top:10px">
		
		
				<div class="col-sm-12">
				
					<p>This Financial Position is to be read in conjunction  with attached Notes to the accounts .</p>
				
				</div>
		
		</div>	
				
				
				
				
				
				
			</div>
			
		</div>

	
	
	
	<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>	
	</div>
	
</div>
	
<?php	

	

	function getSales($id,$start,$end,$start_b,$end_b){
			
			
	$ci =& get_instance();		

	
	$total_asset=0;
	$sub=0;
	$total_assetb=0;
	
	
	
		$admin = $ci->session->userdata('admin');
			
		
			$debit=0;
			$credit=0;
			$amount=0;
			
			$debit_b=0;
			$credit_b=0;
			$amount_b=0;
			$sub_b=0;
			
			
			
			
		
$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','parent_head_id',$id);
			
				foreach($ledger_id['all'] as $leg){
					
$debit=$debit+$ci->report_model->getBalance2('product_trans','',$start,$end,'dr',$leg['id'],$admin);
					
$credit=$credit+$ci->report_model->getBalance2('product_trans','',$start,$end,'cr',$leg['id'],$admin);
					
		$amount=$amount;




$debit_b=$debit_b+$ci->report_model->getBalance2('product_trans','',$start_b,$end_b,'dr',$leg['id'],$admin);
					
$credit_b=$credit_b+$ci->report_model->getBalance2('product_trans','',$start_b,$end_b,'cr',$leg['id'],$admin);
					
		$amount_b=$amount_b+$leg['opening_balance'];

				}		
			$sub=$sub+$amount+($credit-$debit);
			$sub_b=$sub_b+$amount_b+($credit_b-$debit_b);
			$total_asset=$total_asset+$sub;
			$total_assetb=$total_assetb+$sub_b;

			return $total_asset.":".$total_assetb;

		}


?>
	