   <div>

    <div class="container-fluid">
				<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
				
				
				<div class="row">
				
				<div class="col-sm-12">
				
                <div class="panel panel-default">
				
				
				
				<?php
				$this->load->view('admin/print_receipt');	?>
				
				
					<div class="panel-body">
					
					
					
					
						<div class="row">
						

				<h3  style="text-align:center;margin: 0;
padding: 0;"><?php echo $ledger_name; ?></h3>
									
                    </div>
					
					
					
						<div class="row">
						

				<h3 style="text-align:center;margin:0;padding:0">GENERAL LEDGER</h3>
									
                    </div>
					
				<div class="row" style="margin-bottom:10px;">
						

				<h3 style="text-align:center;margin:0;padding:0">For the period <?php echo date('d-m-Y',strtotime($start_date)) ?>    to   <?php echo date('d-m-Y',strtotime($end_date)) ?></h3>
									
                    </div>	
					
					
					
					
					
					
					
					
					
					<div class="col-sm-12">
						 
							
							
							
							<table width="100%">
                    <thead>
                    <tr>
                
                        
                        <th style="width:20%;">Date</th>
                        <th style="width:20%;">Vouchar</th>

                       <th style="width:20%;">Particular</th>
					    
                        <th style="width:10%;">Debit</th>
                        <th style="width:10%;">Credit</th>
                        <th style="width:20%;">Note</th>
                        
                        

                        
					
                    </tr>
                    </thead>
                    <tbody style="background:white">
					
					<tr>
					
							<td></td>
							<td></td>
							
							
							<?php  $total_debit=0;$total_credit=0;$grand_credit=0;$grand_debit=0  ?>
							
										<td><strong>BALANCE B/D</strong></td>
										<?php
								
				if(empty($op))
                                $credit=$credit+$oc;
                                else if(empty($oc))
				$debit=$debit+$op;			
										
											
								if($debit>=$credit)
								{
									?>
									
									
		<td><strong><?php echo ($debit - $credit); 
											
			$total_debit=$total_debit+($debit - $credit);?></strong></td>
											<td><strong>0</strong></td>
									<?php
								}
						else if($debit<$credit){
									
									?>
									
			<td><strong>0</strong></td>						
		<td><strong><?php echo ($credit- $debit); 
											
			$total_credit=$total_credit+($credit- $debit);?>
			
			</strong></td>
			
									<?php
									
								}

											
										
									
									

							?>
							
							
			<td></td>					
							
					
					</tr>
				
					
					<?php $t=0;$tt=0; foreach ($all as $item):

 ?>

						<tr class="gradeX">
						
						<td>
		
							<?php echo $item['date'] ?>
							
		
						</td>
						
						
						<td>
		
							<?php

							if(!empty($item['voucher'])){
								
								echo $item['voucher']; 
								
								
							}
							else{
								
								echo $item['invoice_id'];
							}
							
							
							
							?>
							
		
						</td>
<td>
						<?php 
						
						$ch=0;
						
			
		$name="";	
			
								if((int)$l_id == (int)$item['dr']){
									
$name=$this->report_model->anyName('ledger','id',$item['cr'],'ledger_title');


$ch=$this->report_model->anyName('ledger','id',$item['cr'],'type');


			
								
								}
								else if((int)$l_id == (int)$item['cr']){
									
$name=$this->report_model->anyName('ledger','id',$item['dr'],'ledger_title');	
									
				$ch=$this->report_model->anyName('ledger','id',$item['dr'],'type');
					
								}
						
					

		if($name == 'product_sale' && $item['type'] == 4)
				echo "Product Return";
		else
			echo $name;

					
						?>
								
						
		
			
						</td>
						
						
						
					<?php 
					
					
					
				if((int)$l_id == (int)$item['dr']){
						
								?>
							<td>
							
							<?php

							echo $item['amount']; 
							
							$t=$t+$item['amount'];
			$total_debit=$total_debit+$item['amount'];				
							
							?></td>
							<td>0</td>
							<td></td>
							
								
							<?php	
								}
								else if((int)$l_id == (int)$item['cr']){
					
					?>
							<td></td>		
							<td><?php

							echo $item['amount']; 
							
							
			$total_credit=$total_credit+$item['amount'];				
				$tt=$tt+$item['amount'];			
							?></td>
								<td><?php echo $item['description'];  ?></td>						
									
									<?php
									
									
								}
								
					
					?>
						
						
					
						
						
						
						
						
						
						</tr>
						
						
				
		

<?php  endforeach; ?>
			




<tr>
		
			<td></td>
			<td><strong>Total</strong></td>
			<td></td>
<td><strong><?php


	

		


  echo number_format(round($t,2), 2, '.', ','); 
  
  
  
  
  ?></strong></td>
<td><strong><?php  echo number_format(round($tt,2), 2, '.', ','); ?></strong></td>
			<td></td>
		
		
		
		</tr>


















		
		<tr>
		
		
		
				<td></td>
				<td></td>
				<td><strong>BALANCE C/D</strong></td>
				
				<?php

						if($total_debit>$total_credit)
						{
							?>
							
								<td><strong>0</strong></td>
								<td><strong><?php
								echo ($total_debit-$total_credit); 
								
		$grand_credit=$total_credit+($total_debit-$total_credit);
		$grand_debit=$total_debit;						
								
								
								?></strong></td>
							
							<?php
							
						}
						else if($total_debit<$total_credit){
							
							?>
								<td><strong><?php

								echo ($total_credit-$total_debit); 
								
	$grand_debit=$total_debit+($total_credit-$total_debit);							
			$grand_credit=$total_credit;					
								
								
								
								?></strong></td>
								<td><strong>0</strong></td>	
							
							<?php
							
						}
else{
							
							?>
							
							<td></td>
							<td></td>
							<?php
							
						}
				?>
				
				
				
		<td></td>	
		
		</tr>
		<tr>
		
		
				<td></td>
				<td></td>
				<td></td>
				<td><strong><?php echo $grand_debit; ?></strong></td>
				<td><strong><?php echo $grand_credit; ?></strong></td>
		<td></td>
				
		</tr>
		
					
					
					</tbody>

</table>



							
							
							
							
							
							
							
							
							
						
						
						
                    </div>
					
					
					
					
					
	
			
	
				
					
					</div>
				
				
				</div>
				
				
				</div>
				
			</div>	
				
				
		</div>		


<?php

function convert_number($number) 
{ 
    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 

    $Gn = floor($number / 100000);  /* Millions (giga) */ 
    $number -= $Gn * 100000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Lac"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
} 
?>