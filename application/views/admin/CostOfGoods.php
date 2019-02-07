<?php
		class CostOfGoods{
		public function  __construct($code = null)
			{
			
					
			
			
			}
			
			
			
			public function getFactory_expense_between($id=null,$start=null,$end=null,$start2=null,$end2=null)
	{
		
		
		$ci =& get_instance();
			
			$test=array();
			$test=$ci->report_model->getTrialValue('setting','head',$id);	
			$length=count($test);
			$admin = $ci->session->userdata('admin');

			
			$sub=0;
			$subr=0;
			for($i=$length-1;$i>=0;$i--)
				{
				
$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','parent_head_id',(int)$test[$i]);	


			
				
			foreach($ledger_id['all'] as $leg)
			{
				
		

$de=$ci->report_model->getFinalDCValue2('product_trans','dr',$leg['id'],'amount',$start,$end);

$cr=$ci->report_model->getFinalDCValue2('product_trans','cr',$leg['id'],'amount',$start,$end);

$de2=$ci->report_model->getBalance('product_trans','',$start,$end,'dr',(int)$leg['id'],'','');

$cr2=$ci->report_model->getBalance('product_trans','',$start,$end,'cr',(int)$leg['id'],'','');

$sub=$sub+($de-$cr);
$subr=$subr+(($de2-$cr2)+$leg['opening_balance']);




			
			}
				}
				
				
				return $sub.":".$subr;
		
		
		
	}
			
			
			
			
			
			function getLessDiscount($start,$end)
	{
		
		$ci =& get_instance();	
				
	
		
		$sub=0;	
		$sub2=0;	
$de=$ci->report_model->getFinalDCValue2('product_trans','dr',205,'amount',$start,$end);


$cr=$ci->report_model->getFinalDCValue2('product_trans','cr',205,'amount',$start,$end);


$sub=$sub+($de-$cr);
$sub2=$sub2+0;

		

			return $sub.":".$sub2;
		
	}
			function getLessDiscount2($start,$end,$id)
	{
		
		$ci =& get_instance();	
				
		$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','id',$id);
		
		$sub=0;	
		$sub2=0;	
		foreach($ledger_id['all'] as $leg)
			{



$de=$ci->report_model->getFinalDCValue('product_trans','dr',$id,'amount',$start,$end,'');
					
$cr=$ci->report_model->getFinalDCValue('product_trans','cr',$id,'amount',$start,$end,'');

$sub=$sub+($de-$cr);
$sub2=$sub2+$leg['opening_balance'];

			}

			return $sub.":".$sub2;
		
	}
			public function getPurchaseValue($start,$end)
			{
				$ci =& get_instance();


				$sub=0;

				
$de=$ci->report_model->getBalance3('product_trans','',$start,$end,'dr',5,'');

$cr=$ci->report_model->getBalance3('product_trans','',$start,$end,'cr',5,'');

$sub=$sub+($de-$cr);
				
				return $sub;
				
				
			}
	function getSales($id,$start,$end,$start_b,$end_b)
			
			{
			
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
		
		
		
	function finshed_good_oc($id=null,$start=null,$end=null,$start2=null,$end2=null)
	
	{
		
			$ci =& get_instance();
			
			$test=array();
			$test=$ci->report_model->getTrialValue('setting','head',$id);	
			$length=count($test);
			$admin = $ci->session->userdata('admin');

			
			$sub=0;
			$subr=0;
			
			$avg_vc=0;
			$avg_qc=0;
			$total_qun=0;
			$total_close_pur=0;
			
			
			
			for($i=$length-1;$i>=0;$i--)
				{
				
$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger
','head',$test[$i]);				
				
			foreach($ledger_id['all'] as $leg)
			{



				$sub=$sub+($leg['opening_stock']*$leg['buy_price']);
				$subr=$subr+($leg['opening_stock']*$leg['buy_price']);
				
				
$last_price=$ci->report_model->getLastPrice('product',$start,$end,$leg['code']);	
	
	
	$op_debit=$ci->report_model->getQuantity2('product','date',$start,$end,'d_id',$leg['code'],$admin);
		
	$op_credit=$ci->report_model->getQuantity2('product','date',$start,$end,'c_id',$leg['code'],$admin);							
							
$total_close_pur=$total_close_pur+(($leg['opening_stock']+($op_debit-$op_credit))*$last_price);
	
	
	
	
	
	
	
	
	
	
	
			
			}
				}
				
				
			
			
				return $sub.":".($total_close_pur).":".$subr;
				
				
				//return $sub.":".$subr;
		
		
		
	}
				
			

			
			function getLessVat($start,$end){
				
				
			$ci =& get_instance();	
				
		$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','id',227);		
		$sub=0;	
		$sub2=0;	
		foreach($ledger_id['all'] as $leg)
			{

$de=$ci->report_model->getFinalDCValue2('product_trans','dr',$leg['id'],'amount',$start,$end);

$cr=$ci->report_model->getFinalDCValue2('product_trans','cr',$leg['id'],'amount',$start,$end);

$sub=$sub+($cr-$de);
$sub2=$sub2+$leg['opening_balance'];

			}

			return $sub.":".$sub2;

			
			}
			
			
			function getProvisionTax($start,$end){
				
				
			$ci =& get_instance();	
				
		$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','id',225);		
		$sub=0;	
		$subr=0;	
		foreach($ledger_id['all'] as $leg)
			{

$de=$ci->report_model->getFinalDCValue2('product_trans','dr',$leg['id'],'amount',$start,$end);

$cr=$ci->report_model->getFinalDCValue2('product_trans','cr',$leg['id'],'amount',$start,$end);

$sub=$sub+($cr-$de);
$subr=$subr+$leg['opening_balance'];

			}

			return $sub.":".$subr;

			
			}
			
			
			
function getFactory_expense2($id=null,$start=null,$end=null,$start2=null,$end2=null){
			
			
			$ci =& get_instance();
			
			$test=array();
			$test=$ci->report_model->getTrialValue('setting','head',$id);	
			$length=count($test);
			$admin = $ci->session->userdata('admin');

			
			$sub=0;
			$subr=0;
			for($i=$length-1;$i>=0;$i--)
				{
				
$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','parent_head_id',$test[$i]);	


			
				
			foreach($ledger_id['all'] as $leg)
			{
				
				//echo $leg['id']."</br>";

$de=$ci->report_model->getBalance2('product_trans','',$start,$end,'dr',(int)$leg['id'],'amount',0);

$cr=$ci->report_model->getBalance2('product_trans','',$start,$end,'cr',(int)$leg['id'],'amount',0);

$sub=$sub+$leg['opening_balance']+($de-$cr);



//$de=$ci->news_model->getFinalDCValue2('product_trans','dr',$leg['id'],'amount',$start2,$end2,$admin);

//$cr=$ci->news_model->getFinalDCValue2('product_trans','cr',$leg['id'],'amount',$start2,$end2,$admin);

//$subr=$subr+$leg['opening_balance']+($de-$cr);
$subr=$subr+$leg['opening_balance'];




			
			}
				}
				
				
				return $sub.":".$subr;
			
		}
		function getFactory_expense($id=null,$start=null,$end=null,$start2=null,$end2=null){
			
			
			$ci =& get_instance();
			
			$test=array();
			$test=$ci->report_model->getTrialValue('setting','head',$id);	
			$length=count($test);
			$admin = $ci->session->userdata('admin');

			
			$sub=0;
			$subr=0;
			for($i=$length-1;$i>=0;$i--)
				{
				
$ledger_id['all']=$ci->report_model->getTrialBalance('ledger','parent_head_id',(int)$test[$i]);	


			
				
			foreach($ledger_id['all'] as $leg)
			{
				
				
				
				
$de=$ci->report_model->getBalance2('product_trans','',$start,$end,'dr',(int)$leg['id'],'amount',0);

$cr=$ci->report_model->getBalance2('product_trans','',$start,$end,'cr',(int)$leg['id'],'amount',0);

$sub=$sub+($de-$cr);


		



$subr=$subr+$leg['opening_balance'];



			
			}
				}
				
				
				return $sub.":".$subr;
			
		}
		
		function getProvision($id=null,$start=null,$end=null,$start2=null,$end2=null)
			{
		$sub=0;	
		$ci =& get_instance();	
		$admin = $ci->session->userdata('admin');
		$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger','head',$id);
		foreach($ledger_id['all'] as $leg)
			{

$de=$ci->report_model->getFinalDCValue2('product_trans','dr',$leg['id'],'amount',$start,$end,$admin);

$cr=$ci->report_model->getFinalDCValue2('product_trans','cr',$leg['id'],'amount',$start,$end,$admin);

$sub=$sub+$leg['opening_balance']+($de-$cr);
				


			}
			
			return $sub;
			
			}
		function getCheck($id=null,$start=null,$end=null,$start2=null,$end2=null)
			{
			
			$ci =& get_instance();
			
			$test=array();
			$test=$ci->report_model->getTrialValue('setting','head',$id);	
			$length=count($test);
			$admin = $ci->session->userdata('admin');
			
			
			$total_open=0;
			$total_qun=0;
			$total_open_before=0;
			
			$ch=0;
			$ch2=0;
			
			$total_pur=0;
			$total_pur_qun=0;
			$total_pur_before=0;
			
			
			
			$total_close_pur=0;
			$total_close_before=0;
			
			$avg_vc=0;
			$avg=0;
			$avg_qc=0;
			for($i=$length-1;$i>=0;$i--){
				
$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger
','head',$test[$i]);				
						foreach($ledger_id['all'] as $leg)
							{
							
							


$op_debit=$ci->report_model->getYearlyBalance('product','date',$start2,$end2,'d_id',$leg['code'],$admin);
		
$op_credit=$ci->report_model->getYearlyBalance('product','date',$start2,$end2,'c_id',$leg['code'],$admin);							





$total_open_before=$total_open_before+($leg['opening_stock']*$leg['buy_price']);

$total_qun=$total_qun+$leg['opening_stock'];

$op_debit=$ci->report_model->getBalance2('product','date',$start,$end,'d_id',$leg['code'],$admin,1);		
$op_credit=$ci->report_model->getBalance2('product','date',$start,$end,'c_id',$leg['code'],$admin,2);


$avg_vc=$avg_vc+($leg['opening_stock']*$leg['buy_price'])+($op_debit-$op_credit);




$op_debit=$ci->report_model->getQuantity2('product','date',$start,$end,'d_id',$leg['code'],$admin,1);
		
		
$op_credit=$ci->report_model->getQuantity2('product','date',$start,$end,'c_id',$leg['code'],$admin,2);
		
		
 $avg_qc=$avg_qc+($op_debit-$op_credit);














$pur=$ci->report_model->getFinalDCValue2('product','d_id',$leg['code'],'amount',$start,$end,$admin,'1');

$pur_return=$ci->report_model->getFinalDCValue2('product','c_id',$leg['code'],'amount',$start,$end,$admin,'2');


$total_pur=$total_pur+($pur-$pur_return);



$pur=$ci->report_model->getFinalDCValue2('product','d_id',$leg['code'],'amount',$start2,$end2,$admin,'1');

$pur_return=$ci->report_model->getFinalDCValue2('product','c_id',$leg['code'],'amount',$start2,$end2,$admin,'2');


$total_pur_before=$total_pur_before+($pur-$pur_return);





$op_debit=$ci->report_model->getQuantity2('product','date',$start,$end,'d_id',$leg['code'],$admin);
		
$op_credit=$ci->report_model->getQuantity2('product','date',$start,$end,'c_id',$leg['code'],$admin);							
							
$total_close_pur=$total_close_pur+($leg['opening_stock'])+($op_debit-$op_credit);




$op_debit=$ci->report_model->getBalance2('product','date',$start2,$end2,'d_id',$leg['code'],$admin);
		
$op_credit=$ci->report_model->getBalance2('product','date',$start2,$end2,'c_id',$leg['code'],$admin);							
							
$total_close_before=$total_close_before+($leg['opening_stock']*$leg['buy_price'])+($op_debit-$op_credit);	
							}
							
							
							
				
			}
			
			
			
			if(!empty($avg_vc))
			$avg=$avg_vc/($avg_qc+$total_qun);
			
			
			$ch=$avg_vc-($total_close_pur*$avg);
			
			
			return $ch.":".$total_open_before;
			
			}

		}
?>