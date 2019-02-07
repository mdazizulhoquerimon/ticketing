<?php include "CostOfGoods.php"; ?>
<?php include "store/store.php"; ?>


<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default heads">
		
			<div class="panel-heading">
			
			<strong>
				BalanceSheet
			</strong>
			
			</div>
			<div class="panel-body">
			
			
			
				<div class="row">
				
				<form action="<?php echo base_url(); ?>mains/balance_sheet2" method="post">
<table align="center">
<tr>

<td><div class="feild">Date</div></td>
<td><input class="tcal" type="input" name="start_date" value="<?php echo $end ?>" /></td>
<td>

<button type="submit" target="_blank" class="btn btn-info">Submit</button>

</td>
</tr>
</table>


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
		
		
		<div class="row">
		
		
				<div class="col-sm-12">
				
	<table style="width: 100%">


		<tbody style="background:white">
		
			<tr style='border:1px solid;'>
			
					<td style='border-right:1px solid;'><strong>
					
						SUBJECT MATTERS
					
					</strong></td>
					
					<td style='border-right:1px solid;'><strong>
					
						NOTE
					
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
			
				<td>
				
				<div class="col-sm-12" style='text-align:left;margin:0;padding:0;border-bottom:2px solid;'>
	
		<strong>APPLICATION OF FUND:</strong>
	
	
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
		
		$data['all']=$this->report_model->getTrialBalance('setting','head',1,'','','orders','asc'); 
		
		
		
		?>
		
		
		<?php $j=0; foreach($data['all'] as $ass): ?>
			
			
					<tr>
					
	<td valign="top" height="1" style='text-align:left;'>
	
	<strong>
						
						<?php

						echo $al[$j].".".$ass['name'];

						$j++;
						
						
						
						
						?>

	</strong>
	
	</td>
	<td></td>
	
	<td style="text-align:right;font-weight:bold;">
	
	<?php

	
	$vals=explode(':',getValue($ass['id'],$start,$end,$start_b,$end_b,1));

	echo number_format(round($vals[0]),2);		
	$total_asset=$total_asset+$vals[0];	
		
	
	?>
	
	
	</td>
	<td style="text-align:right;font-weight:bold;">
	
	<?php

	

		//echo $vals[1];
		echo number_format(round($vals[1]),2);	
		$total_assetb=$total_assetb+ $vals[1];;
		
	
	?>
	
	
	</td>
						
					</tr>

					
						
						<?php
						
						
			$data['all']=$this->report_model->getTrialBalance('setting','head',$ass['id'],'','','orders','asc'); 	
			
			
			foreach($data['all'] as $t)
			{
				
				?>

			<tr>


			
	<td style='text-align:left'>
	
	<a target="_blank" href="<?php echo base_url();?>mains/balance_sheet_details_nav/<?php echo $t['id'] ?>/<?php echo $t['ob'] ?>/<?php echo $t['id'] ?>/<?php echo $start ?>/<?php echo $end ?>">
	<?php echo $this->report_model->anyName('setting','id',$t['id'],'name'); ?>
	
	
	
	</td>
	
	</a>
	
	
	<td></td>
			<?php	
			
			
	$test=array();
	$test=$this->report_model->getTrialValue3('setting','head',$t['id']);	
	
	
	$length=count($test);
	
	
	
	$admin = $this->session->userdata('admin');
			
		
			$debit=0;
			$credit=0;
			$amount=0;
			
			$debit_b=0;
			$credit_b=0;
			$amount_b=0;
			$sub_b=0;
			
			
			$total_close_qun=0;
			$avg_vc=0;
			$avg_qc=0;
			
			
			for($i=0;$i<=$length-1;$i++){
				
		
			
			
			if($t['id'] == 83){
				
				
				
				
$ledger_id['all']=$this->report_model->getTrialBalance('product_ledger','head',$test[$i]);

		
				
				
			}
			else{
$ledger_id['all']=$this->report_model->getTrialBalance('ledger','parent_head_id',$test[$i]);
				
				
			}
			
			$check=0;
				foreach($ledger_id['all'] as $leg){
					
					
					
					
					
					if($t['id'] == 83){
						
$last_price=$this->report_model->getLastPrice('product',$start,$end,$leg['code']);				
			
					
$op_debit=$this->report_model->getQuantity2('product','date',$start,$end,'d_id',$leg['code'],$admin);
		
		
$op_credit=$this->report_model->getQuantity2('product','date',$start,$end,'c_id',$leg['code'],$admin);
		
		
$total_close_qun=$total_close_qun+(($leg['opening_stock']+($op_debit-$op_credit))*$last_price);





					
						
				

				
		$amount_b=$amount_b+($leg['opening_stock']*$leg['buy_price']);				
						
				
				
					
				
				
				
				
						
					}
					else{
						
						
						
$debit=$debit+$this->report_model->getBalance2('product_trans','',$start,$end,'dr',$leg['id'],$admin);
					
$credit=$credit+$this->report_model->getBalance2('product_trans','',$start,$end,'cr',$leg['id'],$admin);
					
		$amount=$amount+$leg['opening_balance'];



					
		$amount_b=$amount_b+$leg['opening_balance'];						
						
						
						
					}
					








		
		
				}
		
				
				
			//if($t['id'] == 83)	
					//echo $avg_qc."<br>";
				
		//$avg_qc=0;
				
				
				
				
				
			
			}
			
			
			
			
				?>
			
			<td style='text-align:right;border:1px solid;'>
			
			
			<?php

			
			if($t['id'] == 83){				
				
			
			echo number_format(round($total_close_qun,2), 2, '.', ',');	
			
			
			//echo $total_close_qun;
			
			$sub=$sub+$total_close_qun;	
			
			
				
			}
			else{
				
			$ts2= $amount+($debit-$credit);
echo number_format(round($ts2,2), 2, '.', ',');	
			
				$sub=$sub+$amount+($debit-$credit);
				
				
			}
					

				$debit=0;
				$credit=0;
				$amount=0;
				$avgc=0;
				$avg_vc=0;
				$avg_qc=0;
				$total_close_qun=0;
		
		
			?>
			
			
			
			</td>
			<td style='text-align:right;border:1px solid;'><?php

			$ts3= $amount_b+($debit_b-$credit_b);

			
			echo number_format(round($ts3,2), 2, '.', ',');	

			
			
			
$sub_b=$sub_b+$amount_b+($debit_b-$credit_b);

		$debit_b=0;
		$credit_b=0;
		$amount_b=0;
		
			?>
			
			
			
			</td>
			
			
			
			
			
			
			
			
			<?php
			
			
			
			
			
				
				
				
				?>
					
		



</tr>			
			<?php




			
			}


		
					
					
					

	
							
						
						
						?>	 
			
			
			
	
	
						
						
					
				
			
			<?php endforeach; ?>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		
		
		
			
		<tr>
			
				<td style='text-align:left'><strong>TOTAL(A+B)</strong></td>
				<td></td>
				<td style="text-align:right;border:1px solid"><strong>
				
				
				
				<?php


			//	echo $total_asset;  
				
			echo number_format(round($total_asset,2), 2, '.', ',');		
		//echo number_format($total_asset,2);			
				
				?>
				
				
				
				
				</strong></td>
				
				
				
				<td style="text-align:right;border:1px solid"><strong>
				
				
				
				<?php


				///echo $total_assetb; 

	echo number_format(round($total_assetb),2);	



				?>
				
				
				
				
				</strong>
				
				
				</td>
				
				
				
				
				
				
							
				
			
			</tr>
		
		
		
		
		
		
		
		
		
		
		
	
	<?php $rev_data=0;$subss=0;$su=0;$expense=0; 
	
	$data['all']=$this->report_model->getTrialBalance('setting','head',2,'','','orders','asc'); 
		
		
		
		?>
		
		
	
	
					<tr>
					
<td style='text-align:left;border-bottom:1px solid' >

<strong>Source Of Fund:</strong>



</td>	
<td colspan="3"></td>	
						
					</tr>
	
	<?php

	$data['ass']=$this->report_model->getTrialBalance('setting','head',2,'','','orders','asc'); 
		$j=0;
	foreach($data['ass'] as $as){
		?>
		
		
				<tr>
					
						<td style='text-align:left;'>
							<strong>
							
								<?php echo $al[$j].".".$as['name']; $j++?>:
								
							</strong>
							
						</td>	
						<td></td>	
						<td style="text-align:right"><strong>
						
						
			<?php

	$vals=explode(':',getValue($as['id'],$start,$end,$start_b,$end_b,2));

		
	echo number_format(round($vals[0],2), 2, '.', ',');
		?>						
						
						
						</strong></td>	
						<td style="text-align:right"><strong>
						
						
				<?php


	//	echo $vals[1];
	echo number_format(round($vals[1],2), 2, '.', ',');
		?>			
						
						
						</strong></td>	
						
				</tr>
				
				
				
				
		
	<?php




	$data['ass_s']=$this->report_model->getTrialBalance('setting','head',$as['id'],'','','orders','asc');

	foreach($data['ass_s'] as $as_s)
		{
			
	$test=array();
	$test=$this->report_model->getTrialValue3('setting','head',$as_s['id']);	
	$length=count($test);	
	$admin = $this->session->userdata('admin');
	$debits=0;
	$credits=0;
	$amounts=0;		
	$de=0;
	$cr=0;
	$am=0;
	for($i=0;$i<=$length-1;$i++){
		
	$ledger_id['all']=$this->report_model->getTrialBalance('ledger','parent_head_id',$test[$i]);
	
	foreach($ledger_id['all'] as $leg){
					
$debits=$debits+$this->report_model->getBalance2('product_trans','',$start,$end,'dr',$leg['id'],$admin);
					
$credits=$credits+$this->report_model->getBalance2('product_trans','',$start,$end,'cr',$leg['id'],$admin);


					
		$amounts=$amounts+$leg['opening_balance'];





$de=$debits+$this->report_model->getBalance2('product_trans','',$start_b,$end_b,'dr',$leg['id'],$admin);
					
$cr=$credits+$this->report_model->getBalance2('product_trans','',$start_b,$end_b,'cr',$leg['id'],$admin);


					
		$am=$am+$leg['opening_balance'];




		
		
				}
				
				
		}
	
			?>
				<tr>
				
						<td style='text-align:left'>
	
	
<a target="_blank" href="<?php echo base_url(); ?>mains/balance_sheet_details_nav/<?php echo $as_s['id']; ?>/<?php echo $as_s['ob']; ?>/<?php echo $as['id']; ?>/<?php echo $start ?>/<?php echo $end; ?>"><?php echo $as_s['name'] ?></a>
	
	
	
						</td>
						<td></td>
					<td style='text-align:right;border:1px solid;'><?php

			$ts4= $amounts+($credits-$debits);

			
			echo number_format(round($ts4,2), 2, '.', ',');
			
			$subss=$subss+$amounts+($credits-$debits);


			$credits=0;
			$debits=0;
			$amounts=0;
			?></td>
			
			
			
					<td style='text-align:right;border:1px solid;'>
			
				<?php

					echo number_format(round($am,2), 2, '.', ',');


					$su=$su+$am;


					$cr=0;
					$de=0;
					$am=0;
			
			
			?>
			
			
					</td>
				
				</tr>
		
			<?php
		
		}
	

			if($as['id'] == 94){
				?>
				
						<tr>
						
							<td style="text-align:left">Net Profit/Loss</td>	
							<td></td>	
							<td style="text-align:right;border:1px solid"><strong>
				
				
				<?php 
				
		$cgs=new CostOfGoods();
		
		
		
		
		$total_open=0;
		$total_open_before=0;
		$vals=explode(':',$cgs->getSales(87,$start,$end,$start_b,$end_b));
		$operting=explode(':',$cgs->getSales(193,$start,$end,$start_b,$end_b));//old was 171
			

		$vat=explode(':',$cgs->getLessVat($start,$end));	
			
				$sale=($vals[0]+$operting[0])-$vat[0];
				$sale_b=($vals[1]+$operting[1])-$vat[1];
				
				
		$str=new store();

		//$to_av=$str->total_avarage(83,$start,$end);
		
		
		$val=explode(':',$str->openingStock(83,$start,$end));
				
	
			
		
		$t=$val[0]+$val[1];
		$c=$t - ($val[2]);

	$expense=explode(':',$cgs->getFactory_expense(99,$start,$end,$start_b,$end_b));
	
	$cost=$c+$expense[0];
	

	
	
		
	$gross=$cost;		
			
		



	
	
	
					$this->db->where('id', 248);
					$query = $this->db->get("ledger");	
					$row = $query->row();
					$gross_b =$row->opening_balance;

					$to=$sale - $gross;
					$tob=$sale_b - $gross_b;

				$expense=explode(':',$cgs->getFactory_expense2(3,$start,$end,$start_b,$end_b));



				$operating=$to-$expense[0];
				$operatingb=$tob-$expense[1];
				
				
				
				
				$rent_from_banoful = 0;
	
	
	$rent=$operating + 0;
	$rentb=$operatingb + $rent_from_banoful;
	
	
	$expense=explode(':',$cgs->getFactory_expense(-199,$start,$end,$start_b,$end_b));
	
	
	$net_pro=$rent-$expense[0];
	
	$net_prob=$rentb-$expense[1];
	
	
	$privi=explode(':',$cgs->getProvisionTax($start,$end));
	//$privi=$cgs->getProvision(108,$start,$end,$start_b,$end_b);
	
	
	$net= $net_pro-$privi[0];
	
	$net_b= $net_prob-$privi[1];
	
	
	
				
							
					
					$balance_froward_for_PL =0;
					$balance_froward_for_PL_running = $net_b + $balance_froward_for_PL;
	
				
				
				$net=$net_pro+$balance_froward_for_PL_running;
	
	
				$net_b=$net_b+$balance_froward_for_PL;
				
		$tax_expense=explode(':',$cgs->getFactory_expense(120,$start,$end,$start_b,$end_b));		
				
			

		 $financial_position = $net - $tax_expense[0];
		 
		 $financial_position_pro = $net_b - $tax_expense[1];


             $tax_expense=explode(':',$cgs->getFactory_expense(120,$start,$end,$start_b,$end_b));

              $l=($financial_position_pro+$net_pro)-$tax_expense[0];


		echo number_format(round($l,2), 2, '.', ',');

	
           
			
				//echo number_format(round($net_pro,2), 2, '.', ',');
			
	 $subss=$subss+$l;
	
				?>
							
							
				
				
				
				
								</strong>
								
								
								</td>
								
								
								<td style="text-align:right;border:1px solid">
								
								<strong>
				
				
				
				<?php
				
				echo number_format(round($financial_position_pro,2), 2, '.', ',');
				
			//	echo $financial_position_pro;

			$su=$su+$financial_position_pro;


				?>
				
				
				
				
								</strong>
								
								
								
								</td>
						</tr>
				
				<?php
			}





	}

	
			
	
	?>		
			

			
				
			
	
	
	
	<tr>
			
				<td style='text-align:left'><strong>TOTAL(A+B+C)</strong></td>
				<td></td>
				<td style="text-align:right;border:1px solid"><strong>
				
				
				
				<?php


				//echo $subss; 


echo number_format(round($subss,2), 2, '.', ',');

				?>
				
				
				
				
				</strong></td>
				
				
				
				<td style="text-align:right;border:1px solid"><strong>
				
				
				
				<?php 
				
				
			//	echo $su;  
				
				
		echo number_format(round($su,2), 2, '.', ',');
		
				
				?>
				
				
				
				
				</strong>
				
				
				</td>
				
				
				
				
				
				
							
				
			
			</tr>
	
	
	
			<tr>
			
			
				<td colspan="4" style="text-align:center;padding-top:45px">
				
				<strong> Difference Between Assets and Liabilities : <?php echo number_format(round(($total_asset)-$subss,2), 2, '.', ',');
//echo $total_asset-$subss; ?>
				</strong>
				</td>
			
			
			</tr>
	
	
		</tbody>


		
	</table>

	
				
				
				
				</div>
				
		
		</div>
		
		
		
			<div class="row" style="margin-top:10px;text-align:center">
		
		
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


	function getValue($id,$start,$end,$start_b,$end_b,$type){
			
			
	$ci =& get_instance();		

	
	
	$total_asset=0;
	$sub=0;
	$total_assetb=0;
	
	
	$test=array();
	$test=$ci->report_model->getTrialValue3('setting','head',$id);	
	$length=count($test);
	
	
	
		$admin = $ci->session->userdata('admin');
			
		
			$debit=0;
			$credit=0;
			$amount=0;
			
			$debit_b=0;
			$credit_b=0;
			$amount_b=0;
			$sub_b=0;
			
			$avg_vc=0;
			$avg_qc=0;
			$total_close=0;
			$avgc=0;
			
			$before_year_inventory=0;

			for($i=0;$i<=$length-1;$i++){
			

			
			
				if($test[$i] == 83){
					
					
				
					
					
					
					$test2=array();
					$test2=$ci->report_model->getTrialValue3('setting','head',83);	
					$length2=count($test2);


			for($j=0;$j<=$length2-1;$j++){
				
				
				
				
	$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger','head',$test2[$j]);	

	
				foreach($ledger_id['all'] as $leg){
	

$last_price=$ci->report_model->getLastPrice('product',$start,$end,$leg['code']);
	
	
	$op_debit=$ci->report_model->getQuantity2('product','',$start,$end,'d_id',$leg['code'],$admin);
		
		
	$op_credit=$ci->report_model->getQuantity2('product','',$start,$end,'c_id',$leg['code'],$admin);
		
		
	$total_close=$total_close+(($leg['opening_stock']+($op_debit-$op_credit))*$last_price);

	$before_year_inventory=$before_year_inventory+($leg['opening_stock'] * $last_price);
	
	
			
			
			}
				
					
				
				
				
				
				
				
				
				
				
			}
					
				
		
		
			$total_asset=$total_asset+$total_close;

	

			

				
			//	break;
				



				}
				else{
					
$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','parent_head_id',$test[$i]);



foreach($ledger_id['all'] as $leg){
	
	$ch=$ci->report_model->getBalance2('product_trans','',$start,$end,'dr',$leg['id'],$admin);
	$ch2=$ci->report_model->getBalance2('product_trans','',$start,$end,'cr',$leg['id'],$admin);

	
$debit=$debit+$ci->report_model->getBalance2('product_trans','',$start,$end,'dr',$leg['id'],$admin);
					
$credit=$credit+$ci->report_model->getBalance2('product_trans','',$start,$end,'cr',$leg['id'],$admin);
					
		$amount=$amount+$leg['opening_balance'];




		//echo "id =>".$leg['id']." amount ".($leg['opening_balance'])."<br/>";


$before_year_inventory=$before_year_inventory+$leg['opening_balance'];


		
		
				}


				
					
				
					
					
				}
		
			
			
			
			
		}

				if($type == 1)
				$sub=$sub+$amount+($debit-$credit);
				else
				$sub=$sub+$amount+($credit-$debit);	
			
				
				
					$total_asset=$total_asset+$sub;
					
					
					

					

					
				return $total_asset.":".$before_year_inventory;

		}





?>
	