<?php

	class Head{
	public function getAvarage($id,$start,$end)
	{
		
		
			$ci =& get_instance();
			
			$test=array();
			$test=$ci->news_model->getTrialValue('setting','head',$id);	
			$length=count($test);
			$avg_v=0;
			$avg_q=0;
			$close=0;
			$open=0;
			$avg=0;
			
			for($i=$length-1;$i>=0;$i--)
				{

						
		$ledger_id['all']=$ci->news_model->getTrialBalance('product_ledger','head',$test[$i]);
		
		foreach($ledger_id['all'] as $leg)
			{
			
	


		
		$op_debit=$ci->news_model->getBalance3('product','date',$start,$end,'d_id',$leg['code'],'',1);		
		$op_credit=$ci->news_model->getBalance3('product','date',$start,$end,'c_id',$leg['code'],'',2);		
		$avg_v=$avg_v+($leg['opening_stock']*$leg['buy_price'])+($op_debit-$op_credit);
		
		
		$op_debit=$ci->news_model->getQuantity3('product','date',$start,$end,'d_id',$leg['code'],'',1);		
		$op_credit=$ci->news_model->getQuantity3('product','date',$start,$end,'c_id',$leg['code'],'',2);



		
		$avg_q=$avg_q+$leg['opening_stock']+($op_debit-$op_credit);
		
		
		
		
	
			
			}
		

				}
				
				if(!empty($avg_v))
					$avg=$avg_v/$avg_q;
				
				
				
				return $avg;
				
				
				
				
	}
	public function getTransValue($type,$id,$start,$end){
		
		$s=0;
		
		
		$ci =& get_instance();	
		
		$op_debit=$ci->report_model->getBalanceType('product_trans',$id,$start,$end,'status',$s,'',$type);
		
		
		if(!empty($op_debit))
		return $op_debit;
	
		else
			return 0.00;
		
	}


	}

?>