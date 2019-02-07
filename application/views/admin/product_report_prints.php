  <div>

    <div class="container-fluid">
						<input type="button" class="btn btn-primary" onclick="PrintDiv()" value="Print">
	
			<script type="text/javascript">     
        function PrintDiv() {
			
           var divToPrint = document.getElementById('print');
           var popupWin = window.open('', '_blank', 'width=900,height=900');
           popupWin.document.open();
           popupWin.document.write('<html><head><link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
			
			
                }
				
	</script>	
				<div class="row" id="print">
				
				<div class="col-sm-12" style="margin:0;padding:0">
				
                <div class="panel panel-default">
				
					<div class="panel-heading">
					
					
<h3 style="text-align:center;"><?php echo $name; ?></h3>
					
					
					
					</div>
					<div class="panel-body">
					
					
					<div class="row">
						

				<h3 style="text-align:center;margin:0;padding:0">Product Report</h3>
									
                    </div>
					
				<div class="row" style="margin-bottom:10px;">
						

				<h3 style="text-align:center;margin:0;padding:0">For the period <?php echo date('d-m-Y',strtotime($start)) ?>    to   <?php echo date('d-m-Y',strtotime($end)) ?></h3>
									
                    </div>		
					
					
				<div class="row style="margin:0;padding:0">
						 
							
							
							
			<table  class="display table table-bordered table-striped" id="dynamic-table">
                    
					<thead>
                    <tr>
                
                        
                        <th>Date</th>
                        
						
                       <th>Opening Qnt</th>
                       <th>Rate</th>
                       <th>Opening Value</th>
                       <th>Purchase Qnt</th>
			<th>Purchase Value</th>
                       <th>Sale Qnt</th>
                       <th>Sale Value</th>                       
                       <th>Closing Qnt</th>
                       <th>Rate</th>
                       <th>Closing Value</th>

                        
					
                    </tr>
                    </thead>
                    <tbody style="background:white">
					
				<?php

$total_open=0;
			$total_open_qun=0;
			$total_purchase_qun=0;
			$total_purchase=0;
			$total_sell=0;
			$total_sell_qun=0;
			$total_close_qun=0;
			$total_close=0;


				?>
					
					<?php $t_p_q=0;$t_p_v=0;$t_s_q=0;$t_s_v=0; foreach ($all as $item): ?>

						<tr class="gradeX">
						
						
						<td><?php echo $item['date'] ?></td>
						
						<?php


$last_price_op=$this->report_model->getLastPrice_open('product',$item['date'],$item['date'],$code);	
		
$last_price=$this->report_model->getLastPrice('product',$item['date'],$item['date'],$code);
	
	
	
$op_debit=$this->report_model->getQuantity('product','date',$item['date'],$item['date'],'d_id',$code,'');	

		
$op_credit=$this->report_model->getQuantity('product','date',$item['date'],$item['date'],'c_id',$code,'');
		
$open=$this->report_model->anyName('product_ledger','code',$code,'opening_stock');		
		
$total_open=$total_open+(($open+($op_debit-$op_credit))*$last_price_op);

$tov_im=(($open+($op_debit-$op_credit))*$last_price_op);	
$total_open_qun=$total_open_qun+$open+($op_debit-$op_credit);


$toq_im=$open+($op_debit-$op_credit);



	
       $op_debit=$this->report_model->getQuantity3('product','date',$item['date'],$item['date'],'d_id',$code,'',1);		
	   $op_credit=$this->report_model->getQuantity3('product','date',$item['date'],$item['date'],'c_id',$code,'',2);
		
		
		$total_purchase_qun=$total_purchase_qun+($op_debit-$op_credit);



	
		
	$op_debit_pv=$this->report_model->getFinalDCValue2('product','d_id',$code,'amount',$item['date'],$item['date'],'','1');

$op_credit_pv=$this->report_model->getFinalDCValue2('product','c_id',$code,'amount',$item['date'],$item['date'],'','2');	
		
		
		
		
		$tpq_im=($op_debit-$op_credit);
		$tpv_im=(($op_debit_pv-$op_credit_pv));


$total_purchase=$total_purchase+$tpv_im;
	
		

	$op_debit=$this->report_model->getFinalDCValue2('product','c_id',$code,'amount',$item['date'],$item['date'],'','3','5');

	$op_credit=$this->report_model->getFinalDCValue2('product','d_id',$code,'amount',$item['date'],$item['date'],'','4');


	$total_sell=$total_sell+($op_debit-$op_credit);
	
	
	$tsv_im=($op_debit-$op_credit);
	
	
	$op_debit=$this->report_model->getFinalDCValue2('product','c_id',$code,'qun',$item['date'],$item['date'],'','3','5');

	$op_credit=$this->report_model->getFinalDCValue2('product','d_id',$code,'qun',$item['date'],$item['date'],'','4');
    
	$total_sell_qun= $total_sell_qun+($op_debit-$op_credit);

	$tsq_im=($op_debit-$op_credit);
	
	
	$op_debit=$this->report_model->getClosingQun('product','date',$item['date'],$item['date'],'d_id',$code,'');
				
	$op_credit=$this->report_model->getClosingQun('product','date',$item['date'],$item['date'],'c_id',$code,'');



	$total_close=$total_close+(($open+($op_debit-$op_credit))*$last_price);
	
	
	
	
	$tcv_im=(($open+($op_debit-$op_credit))*$last_price);
		
	
	
	$tcq_im=$open+($op_debit - $op_credit);
	
	$total_close_qun=$total_close_qun+$tcq_im;





						?>
	
	<td><?php echo $toq_im ?></td>
	<td><?php echo $last_price_op ?></td>
	<td><?php echo $tov_im ?></td>
	
	<td><?php echo $tpq_im ?></td>
	<td><?php echo $tpv_im ?></td>
	
	<td><?php echo $tsq_im ?></td>
	<td><?php echo $tsv_im ?></td>
	
	
	<td><?php echo $tcq_im ?></td>
	<td><?php echo $last_price ?></td>
	<td><?php echo $tcv_im ?></td>
	
	
					
						
						</tr>
						
						
			
		

<?php  endforeach; ?>
		

<?php

       if(empty($all)){

                               
$last_price_op=$this->report_model->getLastPrice_open('product',$start,$end,$code);	      


$op_debit=$this->report_model->getQuantity('product','date',$start,$end,'d_id',$code,'');	

		
$op_credit=$this->report_model->getQuantity('product','date',$start,$end,'c_id',$code,'');
		
$open=$this->report_model->anyName('product_ledger','code',$code,'opening_stock');		
		
$total_open=$total_open+(($open+($op_debit-$op_credit))*$last_price_op);

$tov_im=(($open+($op_debit-$op_credit))*$last_price_op);	
$total_open_qun=$total_open_qun+$open+($op_debit-$op_credit);


$toq_im=$open+($op_debit-$op_credit);


                                            ?>


<td></td>
<td><?php echo $toq_im ?></td>
	<td><?php echo $last_price_op ?></td>

<td><?php echo $tov_im ?></td>

	
	<td></td>
	<td></td>
	
	<td></td>
	
	
	
	<td></td>
	<td></td>
	<td></td>

      
<?php

          }


?>






		<tr>
	
	
		<td><strong>Total</strong></td>
		<td><strong><?php echo $total_open_qun ?></strong></td>
		<td><strong><?php //echo $total_open_qun ?></strong></td>
		<td><strong><?php echo $total_open;  ?></strong></td>
		<td><strong><?php echo $total_purchase_qun;  ?></strong></td>
		<td><strong><?php echo $total_purchase;  ?></strong></td>
		<td><strong><?php echo $total_sell_qun;  ?></strong></td>
		<td><strong><?php echo $total_sell;  ?></strong></td>
		<td><strong><?php echo $total_close_qun;  ?></strong></td>
		<td><strong><?php //echo $total_close_qun;  ?></strong></td>
		<td><strong><?php echo $total_close;  ?></strong></td>
		
		
		
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