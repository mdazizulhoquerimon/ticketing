<div id="page-wrapper">
    <div class="container-fluid">
	
	
		<div class="row report">
		
		
			<div class="panel panel-default heads">
		
				<div class="panel-heading">
			
			
				Income Statement
			
			
			<?php 
			
			
			/*
			
			SELECT sq.purchase_qun, sq.sale_qun, sq.type1, sq.code, sq.type2, sq.code2
FROM (

SELECT ptable.d_id AS code, 0code2, ptable.type AS type1, 0type2, sum( ptable.qun ) AS purchase_qun, 0sale_qun
FROM `product` AS ptable
WHERE ptable.type =1
AND ware =11
GROUP BY ptable.d_id ASC
UNION
SELECT c_id AS code2, 0code,
TYPE AS type2, 0type1, sum( ptable.qun ) AS sale_qun, 0purchase_qun
FROM product AS ptable
WHERE TYPE =3
AND ware =11
GROUP BY c_id ASC
) AS sq

			
			*/
			
			?>
			
				</div>
			<div class="panel-body">	
			
				<div class="row">
			
			<form action="<?php echo base_url(); ?>profitLossStatement" method="post">
				<table align="center">
					<tr>

						<td><div class="feild">End Date</div></td>
						<td><input class="form-control tcal" type="input" name="end_date" value="<?php echo date('d-m-Y',strtotime($end)) ?>" readonly /></td>
						<td>
						
							<button type="submit" target="_blank" class="btn btn-info">Submit</button>
						
						</td>

					</tr>
				</table>


			

			</form>
			
				</div>
				<div class="row rr" style="text-align:center">	
				
				
				
				
			<div class="panel panel-default heads">
		
				<div class="panel-heading">
			
		
			
			
				</div>
			<div class="panel-body">
				
				
				
				<div class="row" style="text-align:center;margin:0;padding:0">	
				
				<?php
				$w = $this->session->userdata('wire');
					$this->db->where("id", $w); 
					$result = $this->db->get('ware');
					$row = $result->row();
				?>		
			<h3 style="margin:0;padding:0"><?php echo $row->name; ?></h3>	
			<p style="margin:0;padding:0">Profit & Loss</p>	
			<p style="margin:0;padding:0">For The Month Of ,<?php echo date('F,Y',strtotime($end)); ?></p>	
		
				
				</div>	
				<div class="col-sm-12 col-xs-12">
				
				<style>
				
				
				th{
					
					text-align:center;
					border:1px solid;
					
				}
				td{
					
					font-family: initial;
					font-size: 18px;
				}
				
				</style>
				
				
					<table width="100%">
					
					
						<thead>
						
						
							<tr>
							
							
								<th style="width:80%">Particulars</th>
								<th>Amount</th>
							
							
							</tr>
						
						
						</thead>
						<tbody>
						
						<tr style='border-right: 1px solid;'>
						<td style='padding:3px;'></td>
						<td style='padding:3px;'></td>
						
						</tr>
						
							<tr>
							
							
								<td style="text-align:left;"><strong>Sales:</strong></td>
								<td style="border:1px solid;"><strong class="sale_amount"></strong></td>
							
							</tr>
							
							<tr style='border-right: 1px solid;'>
						<td style='padding:3px;'></td>
						<td style='padding:3px;'></td>
						
						</tr>
							
								<tr>
									
									
										<td style="text-align:left;"></td>
										<td style="border-top:1px solid"></td>
									
								</tr>
						
						
							
						
									<?php 
									
									$data["lastDate"]=$end;
									
									$data["type1"]=3;
									$data["mainCol"]="amount";
									$data["start"]=$start;
									$data["col"]="c_id";
									$data["col_head"]="sale_amount";
									
									$data["type2"]=4;
									$data["col2"]="d_id";
									$data["col_head2"]="sale_return_amount";
									$data["class"]="gsale";
									
									$this->load->view("accounts/pList",$data); ?>
						
						
								<tr>
									
									
										<td style="text-align:left;"></td>
										<td style="border-bottom:1px solid"></td>
									
								</tr>
						
						
						
							<tr style='border-right: 1px solid;'>
						<td style='padding:3px;'></td>
						<td style='padding:3px;'></td>
						
						</tr>
						
							<tr>
							
							
					<?php 


							$opening=$this->report_model->openingStockValue();
							$closing=$this->report_model->getProductClosingOrOpenningValueBySingleQuery($end);
			

					?>
							
							
								<td style="text-align:left;"><strong>Openning</strong></td>
								<td style="border:1px solid;"><strong class="opening_amount"><?php echo $opening; ?></strong></td>
							
							</tr>
							
							<tr style='border-right: 1px solid;'>
						<td style='padding:3px;'></td>
						<td style='padding:3px;'></td>
						
						</tr>
						
						
						
						
						<tr>
							
							
								<td style="text-align:left;"><strong>Add:Purchase</strong></td>
								<td style="border:1px solid;"><strong class="purchase_amount"></strong></td>
							
							</tr>
							
							<tr>
									
									
										<td style="text-align:left;"></td>
										<td style="border-top:1px solid"></td>
									
								</tr>
								
								
								
						<?php 
									
									$data["lastDate"]=$end;
									
									$data["type1"]=1;
									$data["col"]="d_id";
									$data["col_head"]="parchase_amount";
									$data["mainCol"]="amount";
									$data["start"]=$start;
									$data["type2"]=2;
									$data["col2"]="c_id";
									$data["col_head2"]="parchase_return_amount";
									$data["class"]="gpurchase";
									
									
									$this->load->view("accounts/pList",$data); 
									
									
									//echo $tp."test";
									
									?>
						
						
						
								<tr>
									
									
										<td style="text-align:left;"></td>
										<td style="border-bottom:1px solid"></td>
									
								</tr>
						
						<tr>
							
							
								<td style="text-align:left;"><strong>Less: Closing Balance</strong></td>
								<td style="border:1px solid;"><strong class="closing_amount"><?php echo $closing ?></strong></td>
							
							</tr>
						<tr>
							
							
								<td style="text-align:left;"><strong>Cost Of Goods Sold</strong></td>
								<td style="border:1px solid;"><strong class="cgs"></strong></td>
							
							</tr>
						
						
						
						
							<tr style=''>
						<td style='padding:3px;'></td>
						<td style='padding:3px;'></td>
						
						</tr>
						
						
						
						<tr>
							
							
								<td style="text-align:left;"><strong>Gross Profit</strong></td>
								<td style="border:1px solid;"><strong class="gprofit"></strong></td>
							
							</tr>
							
						<tr style=''>
						<td style='padding:3px;'></td>
						<td style='padding:3px;'></td>
						
						</tr>
						
						
					
						
						
							<tr>
							
							
								<td style="text-align:left;"><strong>Administrative Expenses:</strong></td>
								<td style="border:1px solid;"><strong class="texpense_head"></strong></td>
							
							</tr>
						
						
						<?php


						$eList=$this->report_model->getExpenseClosing($end);
						$sum=0;
						foreach($eList as $list){
							
							$sum=$sum + $list["net"];
							
							?>
							
							<tr>
									
									
										<td style="text-align:left;"><?php echo $list["name"] ?></td>
										<td style="border-right:1px solid;border-left:1px solid"><?php echo $list["net"]  ?></td>
									
							</tr>
							
							<?php
							
						}
						
						//echo "Total ".$sum;
						?>
						
						<input class="form-control texpense" value="<?php echo $sum ?>" style="display:none;"/>
						
							<tr>
									
									
										<td style="text-align:left;"></td>
										<td style="border-bottom:1px solid"></td>
									
								</tr>
						
						<tr style=''>
						<td style='padding:3px;'></td>
						<td style='padding:3px;'></td>
						
						</tr>
						
						
					
						
						
						<tr>
							
							
								<td style="text-align:left;"><strong>Net Profit During the month</strong></td>
								<td style="border:1px solid;"><strong class="current_profit"></strong></td>
							
							</tr>
						
						<tr style=''>
						<td style='padding:3px;'></td>
						<td style='padding:3px;'></td>
						
						</tr>
						
						
						
						<tr>
							
							
								<td style="text-align:left;"><strong>Add: Balance Brought Forward From Last Month Accounts</strong></td>
								<td style="border:1px solid;"></td>
							
							</tr>
							
							
							
						<tr style=''>
						<td style='padding:3px;'></td>
						<td style='padding:3px;'></td>
						
						</tr>
						
						
						
						<tr>
							
							
								<td style="text-align:left;"><strong>Balance Carried To Balance Sheet</strong></td>
								<td style="border:1px solid;"></td>
							
							</tr>	
							
							
							
						
						</tbody>
					
					</table>
				
				
				
				</div>
				
				
			</div>	
			
			
			</div>

			
				</div>
				
			</div>
		
		</div>
	
	</div>
	
	<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>	
	<script>
	
	
		$(document).ready(function(){
			
			
			var pur=parseFloat($(".gpurchase").val());
			var sale=parseFloat($(".gsale").val());
			var texpense=parseFloat($(".texpense").val());
			var oamount=parseFloat($(".opening_amount").text());
			var closing=parseFloat($(".closing_amount").text());
			
			$(".purchase_amount").text(pur);
			$(".sale_amount").text(sale);
			
			
			
			var cgs=(pur + oamount) - closing;
			$(".cgs").text(cgs);
			
			var gprofit= sale - cgs;
			//var expense=
			$(".gprofit").text(gprofit);
			$(".texpense_head").text(texpense);
			
			var cprofit=gprofit - texpense;
			
			$(".current_profit").text(cprofit);
			
			
		});
	
	
	</script>
	
</div>