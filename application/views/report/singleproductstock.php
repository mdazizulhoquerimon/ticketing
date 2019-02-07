<tr>



<?php

		$w = $this->session->userdata('wire');
		$admin = $this->session->userdata('admin');


		$data['start_date']=$start;
		$data['end_date']=$end;
		
		$sub=0;
				
				$subc=0;  
			

		$topen=0;
		$tclose=0;
		$tpur=0;
		$tpur_re=0;
		$tsale=0;
		$tsale_re=0;
		
		
		
		$op_qun=0;
			$pur_qun=0;
			$pur_qunr=0;
			$sale_qun=0;
			$sale_qunr=0;
			$close_qun=0;
				
			$adjust=0;
		
		
		
$op_debit=$this->report_model->getQuantity('product','date',$start,$end,'d_id',$leg,$admin);
		
		
$op_credit=$this->report_model->getQuantity('product','date',$start,$end,'c_id',$leg,$admin);
	
	$opening=$this->report_model->anyName('product_ledger','id',$leg,'opening_stock');

	
		
$total_open_qun=$opening+((float)$op_debit-(float)$op_credit);	


	
$op_qun=$op_qun+$total_open_qun;




$pur1=$this->report_model->getFinalDCValue2('product','d_id',$leg,'qun',$start,$end,$admin,'1');

$pur_return1=$this->report_model->getFinalDCValue2('product','c_id',$leg,'qun',$start,$end,$admin,'2');




//$ad_d=$this->report_model->getFinalDCValue2('product','d_id',$leg,'qun',$start,$end,$admin,'5');

//$ad_c=$this->report_model->getFinalDCValue2('product','c_id',$leg,'qun',$start,$end,$admin,'5');


//$adjust=$adjust+($ad_d - $ad_c);

$pur_qun=$pur_qun+$pur1;
$pur_qunr=$pur_qunr+$pur_return1;




$purs=$this->report_model->getFinalDCValue2('product','c_id',$leg,'qun',$start,$end,$admin,'3');

$pur_returns=$this->report_model->getFinalDCValue2('product','d_id',$leg,'qun',$start,$end,$admin,'4');



					
	$sale_qun=$sale_qun+$purs;
	$sale_qunr=$sale_qunr+$pur_returns;


		
		



		

	
$op_debit=$this->report_model->getClosingQun('product','date',$start,$end,'d_id',$leg,$admin);
		
		
$op_credit=$this->report_model->getClosingQun('product','date',$start,$end,'c_id',$leg,$admin);
		
		
$total_close_qun=(float)$opening+((float)$op_debit-(float)$op_credit);


$close_qun=$close_qun+$total_close_qun;



           $topen=$topen+$total_open_qun;
			$tpur=$tpur+$pur1;
			$tpur_re=$tpur_re+$pur_return1;
			$tsale=$tsale+$purs;
			$tsale_re=$tsale_re+$pur_returns;
			$tclose=$tclose+$total_close_qun;



					?>
					
					
<td>
		
		<?php
	$name=$this->report_model->anyName('product_ledger','code',$leg,'name');
//	$unit=$this->report_model->anyName('product_ledger','code',$leg,'unit');


		echo $name."(".$leg.")"; 
		
		
			
		
		?>
		
		
</td>					
<td><?php echo round($total_open_qun,3); ?></td>
<td><?php echo $pur1 ?></td>
<td><?php echo $pur_return1 ?> </td>
					
					
	<td><?php echo round($purs,3) ?></td>
	<td><?php echo round($pur_returns,3) ?></td>
		
		
		
	<td><?php echo round($total_close_qun,3) ?></td>				
					
					
					

</tr>