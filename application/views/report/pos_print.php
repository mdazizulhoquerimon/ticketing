<div id="page-wrapper">
    <div class="container-fluid">
			
      <?php $this->load->view('admin/print_receipt'); ?>

	   
	    <script>
	   
	   
	function PrintDiv()
		{
			
  var divToPrint = document.getElementById('print');
           var popupWin = window.open('', '_blank', 'width=900,height=900');
           popupWin.document.open();
           popupWin.document.write('<html><head><link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();






		}
	   
	
	   
	   
	   
	   
	   
	   
	   </script>
  <?php
	$this->db->where("id", $this->session->userdata('wire')); 
	$result = $this->db->get('ware');
	$row = $result->row();
        ?>	
	    <div class="col-sm-12 col-xs-12">
	        
	        <button class="btn btn-primary" onclick="PrintDiv()">Print</button>
	        
	   </div>
	   <div class="col-sm-12 col-xs-12" id="print">
	   
	    <div class="col-sm-12 col-xs-12">
		
		
			<div class="row">
			
			
				<h3 style="text-align:center;margin:0;padding:0"><?php echo $row->name; ?></h3>
				<p style="margin:0;padding:0;text-align:center;"><?php echo $row->address; ?></p>
				<p style="margin:0;padding:0;text-align:center;">Phone : <?php echo $row->phone; ?></p>
			
			
			</div>
			
			<div class="row">
			
			
				<p style="margin:0;padding:0;text-align:center;">Sales Receipt</p>
				<p style="margin:0;padding:0;text-align:center;"><?php echo date('Y-m-d') ?></p>
			
			
			</div>
		 <div class="row">
			
			
				<div class="col-sm-6 col-xs-6">
				
				
					<p style="margin:0;padding:0;">Sales Id : <?php echo $invoice; ?></p>
					
				
				</div>
				<div class="col-sm-6 col-xs-6">
				
				
				<p style="margin:0;padding:0;text-align:right;">Served :   <?php echo $session ?></p>
				
				
				</div>
				
		</div>
		
		
		
			<div class="row">
						 
							
							
		<div class="col-sm-12 col-xs-12">					
		<table style='width:100%;'>
		
			<thead>
					
					<th style="width:20%;">Item #</th>
					<th style="width:30%;">Item Name</th>
					<th style="width:10%;">Qty</th>
						<th style="width:20%;">Price</th>
					<th style="width:7%;">Total</th>
					<th style="width:13%;"></th>
					
			</thead>
			<tbody>
			
			
					<?php $amount=0;$tqun=0; foreach($all as $val): ?>
					
					<tr>
					
					<?php 
		
		       $re=0;
		
					if($val['type'] == 2 || $val['type'] == 3){
						
						$p=$val['c_id'];
						$name=$this->report_model->anyName('product_ledger','code',$val['c_id'],'name');
						
						?>
						<td style="font-size:12px;"><?php echo $p; ?></td>
							<td style="font-size:10px;"><?php

								echo $name;
							
							?></td>
						
						<?php
						
					}
					else{
						
							$p=$val['d_id'];
							
							
						$name=$this->report_model->anyName('product_ledger','code',$p,'name');
						
						?>
						
						<td style="font-size:12px;"><?php echo $p; ?></td>
							<td style="font-size:12px;">
							
							<?php

							
							
										if($val['type'] == 4){
											
											 $re=$val['amount'];
										 $name." ( Return )";
										}

									echo $name;	
							
							?></td>
						
						<?php
					}
						
			
			?>
					
							
							<td style="font-size:12px;"><?php

							echo $val['qun']; 
							$tqun=$tqun+$val['qun'];
							
							?></td>
							<td style="font-size:12px;"><?php echo number_format(round($val['price'],2), 2, '.', ',');	?></td>
							<td style="font-size:12px;"><?php echo number_format(round($val['amount']-$re,2), 2, '.', ',');	
							
							
							$amount=$amount+($val['amount']-$re);
							
							?></td>
							<td style="font-size:1px;"></td>
						
					
					
					</tr>
					
					<?php endforeach; ?>
			
					<tr class="trr">
						
						
						<td style="border-bottom: 2px dotted;"></td>
						<td style="border-bottom: 2px dotted;"></td>
						<td style="border-bottom: 2px dotted;"></td>
						<td style="border-bottom: 2px dotted;"></td>
						<td style="border-bottom: 2px dotted;"></td>
						<td></td>
					
					</tr>
			
			</tbody>		
					
		</table>
		
		<table style='width:100%;'>
		
			<?php foreach($inv as $in): ?>
		
			<tbody>
			
				<tr>
				
					<td></td>
					<td></td>
					<td style="width:10%;"><?php echo $tqun; ?></td>
					<td style="font-size:10px;width:20%">Sub Total</td>
					<td style="font-size:10px;width:7%"><?php echo number_format(round($amount,2), 2, '.', ','); ?></td>
					<td style="font-size:10px;width:13%"></td>
				</tr>
				
				
				<tr>
				
					<td></td>
					<td></td>
					<td></td>
					<td style="font-size:10px;width:20%">Discount</td>
					<td style="font-size:10px;width:7%"><?php echo number_format(round($in['gross_dis'],2), 2, '.', ','); ?></td>
					<td style="font-size:10px;width:13%"></td>
				</tr>
				
				
				<?php

						$t="Cash";
                                                $cash=0;
							if(!empty($in['card']) && !empty($in['cash'])){
								
								$t="Card & Cash";
								$cash=$in['card']+$in['cash'];
								
							}
							else if(!empty($in['card']))
							{
								
								$t="Card";
								$cash=$in['card'];
								
							}
							else if(!empty($in['cash'])){
								
								//$t="Cash";
								$cash=$in['cash'];
							}
							
								
				

				?>
				
				
				<tr>
				
					<td></td>
					<td></td>
					<td></td>
					<td style="font-size:10px;width:20%"><?php echo $t; ?></td>
					<td style="font-size:10px;width:7%"><?php echo number_format(round($cash,2), 2, '.', ','); ?></td>
					<td style="font-size:10px;width:13%"></td>
				</tr>
				
				
				<tr>
				
					<td></td>
					<td></td>
					<td></td>
					<td style="font-size:10px;width:20%">Due</td>
					<td style="font-size:10px;width:7%">
					
					
					
					<?php
					
				$due=$amount - ($cash + $in['gross_dis']);

							if($cash < ($amount - $in['gross_dis']) && empty($in['dual']))
					echo number_format(round($due,2), 2, '.', ','); 
							else
								echo "0.00";
								
					
					
					?>
					
					
					
					</td>
					<td style="font-size:10px;width:13%"></td>
				</tr>
				
				
				
				
				<tr>
				
					<td></td>
					<td style="font-size:10px;">Return Amount</td>
					<td></td>
					<td style="font-size:10px;width:20%"></td>
					<td style="font-size:10px;width:7%">
					
					
					
					<?php

						if(empty($in['dual']))	
					echo number_format(round((($cash-($amount - $in['gross_dis']))),2), 2, '.', ','); 
						else
                                                   echo "0.00";
					
					
					?>
					
					
					
					</td>
					<td style="font-size:10px;width:13%"></td>
				</tr>
				
				
				
				
			
			
			</tbody>
			
			
			<?php endforeach; ?>
			
		</table>
		
		
		
		</div>
		
		<div class="col-sm-12 col-xs-12" style="margin-top:10px">
		
				<p style='margin:0;padding:0;font-size:10px;'>Warranty of 3 days from the date of Cash Memo/Bill No Claim Will Be Entertained For the Discounted Products Cash Memu Should be returned and must be produced at the time of complaint or size change.Size/Model charge will be enteraudbed for one time only within 3(three) days fromthe date of purchase.Used and dirty goods will not be changed.</p>
		
		</div>
		
		
		
		</div>
	   
	   
	   </div>
	   
	   
	   
	   </div>
	   
	   
	   
	   </div>