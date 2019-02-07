<?php include ("Head.php"); ?>

<div id="page-wrapper">
            <div class="container-fluid">
		
			<div class="row" style="margin-top:20px">
			
			<div class="col-lg-12">
			
			
			
				<div class="panel panel-default">
				
				
					<div class="panel-heading">
					
					
					Transaction History
					
					
					</div>
				<div class="panel-body">
				
				
					<div class="row">
					
					
						<form action="<?php echo base_url(); ?>admin/transaction_history2" method="post">
			
				<div class="col-lg-12">
						 <label class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-2">
 <input type="text" id="fdate" value="<?php echo $start ?>" name="start_date" class="form-control tcal tcalInput">
                        </div>
						
						
						
			<label class="col-sm-1 control-label">End Date</label>				 
                        <div class="col-sm-2">
<input type="text" id="ldate" value="<?php echo $end ?>" name="end_date" class="form-control tcal tcalInput">
                        </div>



							 <div class="col-sm-2">
<input type="submit" class="form-control">
                        </div>
						
						
						</div>
		</form>
					
					
					
					</div>
				
				
				
				<div class="row" style="margin-top:20px">
				
					<div class="col-lg-12">
					
					
					
	<div class="panel panel-default">
	
	
		<div class="panel-heading">
		
		
			List
		
		
		</div>
		<div class="panel-body">
		
		
		<div class="adv-table" id="menu">
					<div class="row">
					<div class="col-sm-6">
					
					
		<?php

				$str=new Head();
				
				
				$data=array();
				$sub=0;
				
				
				$led=array(
				
					5,
					5,
					204,
					204,
					0,
					0,
					0,
					0,
					0,
					0
					
				
				);
				
				
				
				
				for($i=0;$i<=9;$i++)
				{
					
$data[$i]=$str->getTransValue($i+1,$led[$i],$start,$end);
				

					
					
				}
				
				//echo count($data);
				



		?>			
					
					
					
						<ul>
						
							<li><strong><a href="#" onclick="trans_details(1,5)">1.Purchase</a></strong></li>
							<li><strong><a href="#" onclick="trans_details(2,5)">2.Purchase Return</a></strong></li>
							<li><strong><a href="#" onclick="trans_details(3,204)">3.Sale</a></strong></li>
							<li><strong><a href="#" onclick="trans_details(4,204)">4.Sale Return</a></strong></li>
							<li><strong><a href="#" onclick="trans_details(6,0)">5.Cash Payment</a></strong></li>
							<li><strong><a href="#" onclick="trans_details(7,0)">6.Cash Receive</a></strong></li>
							<li><strong><a href="#" onclick="trans_details(8,0)">7.Bank Deposite</a></strong></li>
							<li><strong><a href="#" onclick="trans_details(9,0)">8.Bank Withdraw</a></strong></li>
							<li><strong><a href="#" onclick="trans_details(10,0)">9.Journal Posting</a></strong></li>
						
						</ul>
						
						
						</div>
						<div class="col-sm-6">
						<ul>
						<?php
						
						for($i=0;$i<=9;$i++)
						{
							if($i != 4)
							{
								?>
								
								<li><a href="#"><?php echo number_format(round($data[$i],2), 2, '.', ','); ?></a></li>
								
								<?php
								
								$sub=$sub+$data[$i];
							}
					
					
						}
						
						
					?>	
						</ul>
						</div>
					</div>
					
					
					<div class="row">
					
					
						<div class="col-sm-6" style="text-align:right">
						
						
						<strong>Total :</strong>
						
						</div>
						<div class="col-sm-6">
						
							<strong><?php echo number_format(round($sub,2), 2, '.', ','); ?></strong>
						
						
						</div>
					
					</div>
					
					
					</div>
		
		
		
		
		<div class="row">
		
		
			<div class="panel panel-default">
			
			
			
				<div class="panel-heading">
				
				
				
					List Of Transaction
				
				
				</div>
			
				<div class="panel-body" style="max-height: 400px;overflow:auto">
				
				
				
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Debit</th>
							<th>Credit</th>
							<th>Amount</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody id="trans_b">
					
					
					
					</tbody>
				
				</table>
				
				
				
				
				
				</div>
			
			
			<div class="panel-footer" style="text-align:center">
			
			
				End Of List
			
			
			</div>
			
			
			</div>
		
		
		
		
		</div>
		
		
		
		</div>
	
	
	
	
	
	
	</div>
					
					
					
					</div>
				
				
				
				
				</div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				</div>
				
				
				
				
				
				</div>
			
			
			
			
			</div>
			
			
			
			
			</div>
			 
		
		<div id="modals">
				
				<div class="col-sm-4"></div>
				<div class="col-sm-4" style="margin-top:12%;">
				
				<img style="display:none;" class="img" src="<?php echo base_url(); ?>css/715.gif"/>
				
				
				
				</div>
				<div class="col-sm-4"></div>
				
				
				</div>
		
				
</div>






<script src="<?php echo base_url(); ?>js/custom/link.js"></script>

<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>
<script src="<?php echo base_url(); ?>js/custom/cash_pay.js"></script>




</div>