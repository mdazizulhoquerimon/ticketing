<?php

		class store{
			
			public function  __construct($code = null)
			{
			
					
			
			
			}
			
			public function total_avarage($id,$start,$end)
			{
				
				$opening=0;
				$opening_qun=0;
				$avg=0;
				
				
				$ci =& get_instance();
				$test=array();
				$test=$ci->report_model->getTrialValue('setting','head',$id);	
				$length=count($test);
				for($i=$length-1;$i>=0;$i--)
				{
					$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger','head',$test[$i]);	
						foreach($ledger_id['all'] as $leg)
							{
								
	$op_debit=$ci->report_model->getBalance2('product','date',$start,$end,'d_id',$leg['code'],'',1);
		
		
	$op_credit=$ci->report_model->getBalance2('product','date',$start,$end,'c_id',$leg['code'],'',2);
		
	$opening=$opening+($leg['opening_stock']*$leg['buy_price'])+($op_debit-$op_credit);
	
	
	$op_debit=$ci->report_model->getQuantity2('product','date',$start,$end,'d_id',$leg['code'],'',1);
		
		
	$op_credit=$ci->report_model->getQuantity2('product','date',$start,$end,'c_id',$leg['code'],'',2);
		
	$opening_qun=$opening_qun+($leg['opening_stock'])+($op_debit-$op_credit);
								
							}
					
				}
				
				if(!empty($opening_qun))
				{
					
					$avg=$opening/$opening_qun;
					
				}
				
				
				return $avg;
				
			}
			
			
			public function getAdministretive($id,$start,$end)
			{
				
				
				
				
				$ci =& get_instance();
				$test=array();
				$test=$ci->report_model->getTrialValue('setting','head',$id);	
				$length=count($test);
				$admin = $ci->session->userdata('admin');
				
				$total_open=0;
				
				$t=0;
				
				for($i=$length-1;$i>=0;$i--)
						{
							
			$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','parent_head_id',(int)$test[$i]);	
			
			
			
			
			
						foreach($ledger_id['all'] as $leg)
							{

				$total_open=$total_open+$leg['opening_balance'];

	$op_debit=$ci->report_model->getBalance2('product_trans','date',$start,$end,'dr',$leg['id'],$admin);		
	$op_credit=$ci->report_model->getBalance2('product_trans','date',$start,$end,'cr',$leg['id'],$admin);				
			$t=$t+$leg['opening_balance']+($op_debit - $op_credit);	

			
			
			
			
			
							}
							
						}
				
				
				return $t.":".$total_open;
				
			}
			
			public function openingStock_op($id=null,$start=null,$end=null)
				{
				    
				    
				    
				    					$ci =& get_instance();
			
                                               $test=array();
						$test=$ci->report_model->getTrialValue('setting','head',$id);	
						$length=count($test);
						$admin = $ci->session->userdata('admin');
						
						$total_open=0;
						
						$present_open=0;
						
						$total_open_before=0;
						$before_pur=0;
						$avg_qc=0;
						$total_qun=0;
						$total_close_pur=0;
						$total_before_close=0;
						$t_pur=0;
					for($i=$length-1;$i>=0;$i--)
						{

					
				
	$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger','head',$test[$i]);
		
						foreach($ledger_id['all'] as $leg)
							{
		
$last_price_op=$ci->report_model->getLastPrice_open('product',$start,$end,$leg['code']);	
		
$last_price=$ci->report_model->getLastPrice('product',$start,$end,$leg['code']);



$op_debit=$ci->report_model->getQuantity('product','date',$start,$end,'d_id',$leg['code'],'');			
$op_credit=$ci->report_model->getQuantity('product','date',$start,$end,'c_id',$leg['code'],'');


$op_debit2=$ci->report_model->getQuantity('product','date',$start,$end,'d_id',$leg['code'],'','',1);			
$op_credit2=$ci->report_model->getQuantity('product','date',$start,$end,'c_id',$leg['code'],'','',1);


		
$total_open=$total_open+(($leg['opening_stock']+($op_debit-$op_credit))*$last_price_op);	



$last_price_op=$ci->report_model->getLastPrice_open('product','2016-05-30','2016-05-30',$leg['code'],'1');


$total_open_before=$total_open_before+(($leg['opening_stock']+($op_debit2-$op_credit2))*$last_price_op);//before



$present_open=$present_open + ((($op_debit-$op_credit))*$last_price_op); //present
	

$s = date('Y-m-d', strtotime($start . ' - 1 day'));	



$pur_debit=$ci->report_model->getPurchase_Close('product','date','2016-05-30',$s,'d_id',$leg['code'],$admin,1,1);
$pur_credit=$ci->report_model->getPurchase_Close('product','date','2016-05-30',$s,'c_id',$leg['code'],$admin,2,1);


$op_debit=$ci->report_model->getPurchase_Close('product','date',$start,$end,'d_id',$leg['code'],$admin,1);
$op_credit=$ci->report_model->getPurchase_Close('product','date',$start,$end,'c_id',$leg['code'],$admin,2);	


$t_pur=$t_pur+(($op_debit-$op_credit));
$before_pur=$before_pur+($pur_debit-$pur_credit);


$op_debit=$ci->report_model->getQuantity2('product','date',$start,$end,'d_id',$leg['code'],$admin);		
	$op_credit=$ci->report_model->getQuantity2('product','date',$start,$end,'c_id',$leg['code'],$admin);


	$op_debit2=$ci->report_model->getQuantity2('product','date',$start,$end,'d_id',$leg['code'],$admin,'',1);	
	$op_credit2=$ci->report_model->getQuantity2('product','date',$start,$end,'c_id',$leg['code'],$admin,'',1);

	
	$last_price_op=$ci->report_model->getLastPrice_open('product',$start,$end,$leg['code']);			
	
	
	$total_before_close=$total_before_close+(($leg['opening_stock']+($op_debit2-$op_credit2))*$last_price_op);
							
	$total_close_pur=$total_close_pur+(($leg['opening_stock']+($op_debit-$op_credit))*$last_price);
	
								
							}
							
						

						}
			
				
				


return $total_open.":".($t_pur).":".($total_close_pur).":".$total_open_before.":".$before_pur.":".$total_before_close;
			
				    
				
				
					/*	$ci =& get_instance();
			
						$test=array();
						$test=$ci->report_model->getTrialValue('setting','head',$id);	
						$length=count($test);
						$admin = $ci->session->userdata('admin');
												$before_pur=0;
$total_before_close=0;
						$total_open=0;
						$total_open_before=0;
						$avg_vc=0;
						$avg_qc=0;
						$total_qun=0;
						$total_close_pur=0;
						$t_pur=0;
					for($i=$length-1;$i>=0;$i--)
						{

					
				
	$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger','head',$test[$i]);
		
						foreach($ledger_id['all'] as $leg)
							{
							    
							    
							    $s = date('Y-m-d', strtotime($start . ' - 1 day'));	

		
$last_price_op=$ci->report_model->getLastPrice_open('product',$start,$end,$leg['code']);	
		
$last_price=$ci->report_model->getLastPrice('product',$start,$end,$leg['code']);

		
								
	$total_open=$total_open+($leg['opening_stock']*$leg['buy_price']);
	$total_open_before=$total_open_before+($leg['opening_stock']*$leg['buy_price']);	

	$op_debit=$ci->report_model->getPurchase_Close('product','date',$start,$end,'d_id',$leg['code'],$admin,1);



	
	$op_credit=$ci->report_model->getPurchase_Close('product','date',$start,$end,'c_id',$leg['code'],$admin,2);

	
	$pur_debit=$ci->report_model->getPurchase_Close('product','date','2016-05-30',$s,'d_id',$leg['code'],$admin,1,1);
    $pur_credit=$ci->report_model->getPurchase_Close('product','date','2016-05-30',$s,'c_id',$leg['code'],$admin,2,1);

	$before_pur=$before_pur+($pur_debit-$pur_credit);

	
	$t_pur=$t_pur+(($op_debit-$op_credit));

		$op_debit2=$ci->report_model->getQuantity2('product','date',$start,$end,'d_id',$leg['code'],$admin,'',1);	
	$op_credit2=$ci->report_model->getQuantity2('product','date',$start,$end,'c_id',$leg['code'],$admin,'',1);

	
		$total_before_close=$total_before_close+(($leg['opening_stock']+($op_debit2-$op_credit2))*$last_price_op);

	
	$op_debit=$ci->report_model->getFinalDCValue('product','d_id',$leg['code'],'qun',$start,$end);
		
	$op_credit=$ci->report_model->getFinalDCValue('product','c_id',$leg['code'],'qun',$start,$end);							
							
	$total_close_pur=$total_close_pur+(($leg['opening_stock']+($op_debit-$op_credit))*$last_price);
		
								
							}
							
						

						}
			
				
				
				return $total_open.":".($t_pur).":".($total_close_pur).":".$total_open_before.":".$before_pur.":".$total_before_close;
				
			*/
			
			
			
			
			
			
			
			
			
				
				}
			
			
			
			
			
			
			
			
			
			
			
			
			public function openingStock($id=null,$start=null,$end=null)
				{
				
				
						$ci =& get_instance();
			
						$test=array();
						$test=$ci->report_model->getTrialValue('setting','head',$id);	
						$length=count($test);
						$admin = $ci->session->userdata('admin');
						
						$total_open=0;
						$total_open_before=0;
						$avg_vc=0;
						$avg_qc=0;
						$total_qun=0;
						$total_close_pur=0;
						$t_pur=0;
					for($i=$length-1;$i>=0;$i--)
						{

					
				
	$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger','head',$test[$i]);
		
						foreach($ledger_id['all'] as $leg)
							{
		
$last_price_op=$ci->report_model->getLastPrice_open('product',$start,$end,$leg['code']);	
		
$last_price=$ci->report_model->getLastPrice('product',$start,$end,$leg['code']);

		
								
	$total_open=$total_open+($leg['opening_stock']*$leg['buy_price']);
	$total_open_before=$total_open_before+($leg['opening_stock']*$leg['buy_price']);	

	//$op_debit=$ci->report_model->getPurchase_Close('product','date',$start,$end,'d_id',$leg['code'],$admin,1);



	
	//$op_credit=$ci->report_model->getPurchase_Close('product','date',$start,$end,'c_id',$leg['code'],$admin,2);

	
	$op_debit=$ci->report_model->getFinalDCValue2('product','d_id',$leg['code'],'amount',$start,$end,'','1');

$op_credit=$ci->report_model->getFinalDCValue2('product','c_id',$leg['code'],'amount',$start,$end,'','2');
	
	
	$t_pur=$t_pur+(($op_debit-$op_credit));

	
	
	$op_debit=$ci->report_model->getQuantity2('product','date',$start,$end,'d_id',$leg['code'],$admin);
		
	$op_credit=$ci->report_model->getQuantity2('product','date',$start,$end,'c_id',$leg['code'],$admin);							
							
	$total_close_pur=$total_close_pur+(($leg['opening_stock']+($op_debit-$op_credit))*$last_price);
		
								
							}
							
						

						}
			
				
				
				return $total_open.":".($t_pur).":".($total_close_pur).":".$total_open_before;
				
				
				}
			
			public function getSingleValue($id,$start,$end,$type,$ch)
			{
				
				$ci =& get_instance();
				
				$test=array();
				$test=$ci->report_model->getTrialValue3('setting','head',$id);	
				$length=count($test);
				
				for($i=0;$i<=$length-1;$i++)
					{
					
						if($ch == 83)
							{
							
$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger','head',$test[$i]);
foreach($ledger_id['all'] as $leg)				
				{

						


				}				
							}
							else{
																
								
$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','parent_head_id',$test[$i]);
foreach($ledger_id['all'] as $leg)				
				{




				}						
																
							}
					
					
					
					}
				
			}
			public function getStoreValue($id,$start,$end,$type,$ch)
			{
				
				
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
			$total_close_qun=0;
			$avgc=0;
			
			$before_year_inventory=0;

			for($i=0;$i<=$length-1;$i++){
			

			
			
				if($ch == 83){
					

				
	$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger','head',$test[$i]);	

	
				foreach($ledger_id['all'] as $leg)
				
				{
					
	$last_price=$ci->report_model->getLastPrice('product',$start,$end,$leg['code']);	
	
		$op_debit=$ci->report_model->getQuantity2('product','',$start,$end,'d_id',$leg['code'],$admin);
		
		
		$op_credit=$ci->report_model->getQuantity2('product','',$start,$end,'c_id',$leg['code'],$admin);
		
		
$total_close_qun=$total_close_qun+(($leg['opening_stock']+($op_debit-$op_credit))*$last_price);

		
		

		$before_year_inventory=$before_year_inventory+($leg['opening_stock'] * $leg['buy_price']);
	

			
			}
				
			
			$total_asset=$total_close_qun;
			
			
			
			
			
			
			
					
		}
				
				
				
		else{
					
$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','parent_head_id',$test[$i]);


foreach($ledger_id['all'] as $leg){
	


	
$debit=$debit+$ci->report_model->getBalance2('product_trans','',$start,$end,'dr',$leg['id'],$admin);
					
$credit=$credit+$ci->report_model->getBalance2('product_trans','',$start,$end,'cr',$leg['id'],$admin);
					
		 $amount=$amount+$leg['opening_balance'];







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
			
			
			
		}




?>