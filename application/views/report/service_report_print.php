  <div>

    <div class="container-fluid">
	
				<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
				
			
                <div class="row">
								<?php
				$this->load->view('admin/print_receipt');	?>
					<div class="col-sm-12">
					
					
						<div class="row">
						

				<h3 style="text-align:center;"><?php echo $ledger_name; ?></h3>
									
                    </div>
					
					
					
						<div class="row">
						

				<h3 style="text-align:center;margin:0;padding:0">GENERAL LEDGER</h3>
									
                    </div>
					
				<div class="row" style="margin-bottom:10px;">
						

				<h3 style="text-align:center;margin:0;padding:0">For the period <?php echo date('d-m-Y',strtotime($start_date)) ?>    to   <?php echo date('d-m-Y',strtotime($end_date)) ?></h3>
									
                    </div>	
					
					
					
					
					
					
					
					
					
					<div class="row">
						 
							
							
							
							<table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                
                        
                        <th>Date</th>					    
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Qun</th>
                        <th>Amount</th>
                        
                        

                        
					
                    </tr>
                    </thead>
                    <tbody style="background:white">
					
					
				
					
					<?php $grand_debit=0;$grand_credit=0; foreach ($all as $item):

 ?>

<tr class="gradeX">
						
	<td>
		
		<?php echo $item['date'] ?>
							
		
	</td>

						
				
							
	<td>
							
					<?php

echo $this->report_model->anyName('ledger','id',$item['d_id'],'ledger_title');	
				
							
					?>
							
	</td>
								
						
	<td>
							
					<?php

echo $this->report_model->anyName('ledger','id',$item['c_id'],'ledger_title');	
				
							
					?>
							
	</td>					
						
	<td>
							
					<?php

			echo $item['qun'];	
				
							
					?>
							
	</td>						
						
	<td>
							
					<?php

			//echo $item['amount'];	
			
		$grand_debit=$grand_debit+$item['amount'];
echo number_format(round($item['amount'],0), 2, '.', ',');			
							
					?>
							
	</td>					
						
						
						</tr>
						
						
				
		

<?php  endforeach; ?>
					

		<tr>
		
		<td colspan="4"><strong>Total :</strong></td>
	   
	<td><strong><?php echo number_format(round($grand_debit,0), 2, '.', ',');			
// echo $grand_debit; ?></strong></td>
	
				
		</tr>
		
					
					
					</tbody>

</table>



							
							
							
							
							
							
							
							
							
						
						
						
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