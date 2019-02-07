<?php

	class Head{
	public function getAvarage($id,$start,$end)
	{
		
		
			$ci =& get_instance();
			
			$test=array();
			$test=$ci->report_model->getTrialValue('setting','head',$id);	
			$length=count($test);
			$avg_v=0;
			$avg_q=0;
			$close=0;
			$open=0;
			$avg=0;
			
			for($i=$length-1;$i>=0;$i--)
				{

						
		$ledger_id['all']=$ci->report_model->getTrialBalance('product_ledger','head',$test[$i]);
		
		foreach($ledger_id['all'] as $leg)
			{
			
	


		
		$op_debit=$ci->report_model->getBalance3('product','date',$start,$end,'d_id',$leg['id'],'',1);		
		$op_credit=$ci->report_model->getBalance3('product','date',$start,$end,'c_id',$leg['id'],'',2);		
		$avg_v=$avg_v+($leg['opening_stock']*$leg['buy_price'])+($op_debit-$op_credit);
		
		
		$op_debit=$ci->report_model->getQuantity3('product','date',$start,$end,'d_id',$leg['id'],'',1);		
		$op_credit=$ci->report_model->getQuantity3('product','date',$start,$end,'c_id',$leg['id'],'',2);



		
		$avg_q=$avg_q+$leg['opening_stock']+($op_debit-$op_credit);
		
		
		
		
	
			
			}
		

				}
				
				if(!empty($avg_v))
					$avg=$avg_v/$avg_q;
				
				
				
				return $avg;
				
				
				
				
	}
	public function getTransValue($type,$start,$end){
		
		$s=0;
		if($type == 10)
			$s=1;
		
		$ci =& get_instance();	
		
		$op_debit=$ci->report_model->getBalanceType('product_trans','',$start,$end,'status',$s,'',$type);
		
		
		if(!empty($op_debit))
		return $op_debit;
	
		else
			return 0.00;
		
	}


	}

?>