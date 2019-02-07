<?php
class report_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	
		public function getPreExpenseClosing($closingDate){
		
		
		$w = $this->session->userdata('wire');
		$date = date('Y-m-d', strtotime($closingDate));
		
		$test=array();
		$test=$this->getTrialValue('setting','head',3);	
		$length=count($test);
	
		$query="";
		for($i=$length-1;$i>=0;$i--){
		
		$or="or";
		if($i == 0)
		$or="";
	
		$query=$query."parent_head_id='".$test[$i]."' " .$or." ";
		
		}
	
	 $q="(".$query.")";
		
		
		
	$sql="select sum(tttt.net) as gross_amount from(select ttt.net,ttt.head,setting.name from setting inner join (select sum(tt.debit_amount) as debit,sum(tt.credit_amount) as credit,tt.head,sum(tt.debit_amount - tt.credit_amount) as net from

		(SELECT l.parent_head_id AS head, t.ware AS w, t.dr, t.cr, sum( t.amount ) AS debit_amount, 0 credit_amount, t.type, t.id, l.id AS lid
		FROM `product_trans` AS t
		INNER JOIN (

		SELECT *
		FROM `ledger`
		WHERE ware ='".$w."' and ".$query."


		) AS l ON t.dr = l.id
		WHERE t.ware ='".$w."' AND t.date !=  '0000-00-00' AND t.date <=  '".$date."' and t.status !='1'
		GROUP BY l.parent_head_id


		union


		SELECT l.parent_head_id AS head, t.ware AS w, t.dr, t.cr, 0 debit_amount, sum( t.amount ) AS credit_amount, t.type, t.id, l.id AS lid
		FROM `product_trans` AS t
		INNER JOIN (

		SELECT *
		FROM `ledger`
		WHERE ware ='".$w."' and ".$query."

		) AS l ON t.cr = l.id
		WHERE t.ware ='".$w."' AND t.date !=  '0000-00-00' AND t.date <=  '".$date."' and t.status !='1'
		GROUP BY l.parent_head_id) as tt group by tt.head) as ttt on ttt.head=setting.id) as tttt";	
		
		
		$qq=$this->db->query($sql);
		
		$row=$qq->row();
		
		
		return  $row->gross_amount;
		
		
		
	}
	
	
	
	
	public function getExpenseClosing($start,$closingDate){
		
		
		
		$w = $this->session->userdata('wire');
		$date = date('Y-m-d', strtotime($closingDate));
		$start_date = date('Y-m-d', strtotime($start));
		
		$test=array();
		$test=$this->getTrialValue('setting','head',3);	
		$length=count($test);
	
		$query="";
		for($i=$length-1;$i>=0;$i--){
		
		$or="or";
		if($i == 0)
		$or="";
	
		$query=$query."parent_head_id='".$test[$i]."' " .$or." ";
		
		}
	
	 $q="(".$query.")";
		
		
		
	$sql="select ttt.net,ttt.head,setting.name from setting inner join (select sum(tt.debit_amount) as debit,sum(tt.credit_amount) as credit,tt.head,sum(tt.debit_amount - tt.credit_amount) as net from

		(SELECT l.parent_head_id AS head, t.ware AS w, t.dr, t.cr, sum( t.amount ) AS debit_amount, 0 credit_amount, t.type, t.id, l.id AS lid
		FROM `product_trans` AS t
		INNER JOIN (

		SELECT *
		FROM `ledger`
		WHERE ware ='".$w."' and ".$query."


		) AS l ON t.dr = l.id
		WHERE t.ware ='".$w."' AND t.date !=  '0000-00-00' AND t.date >= '".$start_date."' and t.date <=  '".$date."' and t.status !='1'
		GROUP BY l.parent_head_id


		union


		SELECT l.parent_head_id AS head, t.ware AS w, t.dr, t.cr, 0 debit_amount, sum( t.amount ) AS credit_amount, t.type, t.id, l.id AS lid
		FROM `product_trans` AS t
		INNER JOIN (

		SELECT *
		FROM `ledger`
		WHERE ware ='".$w."' and ".$query."

		) AS l ON t.cr = l.id
		WHERE t.ware ='".$w."' AND t.date !=  '0000-00-00' AND t.date >= '".$start_date."' and t.date <=  '".$date."' and t.status !='1'
		GROUP BY l.parent_head_id) as tt group by tt.head) as ttt on ttt.head=setting.id";	
		
		
		$qq=$this->db->query($sql);
		
		return  $qq->result_array();

	}
	
	public function getTestList44($q){
		
		
		$w = $this->session->userdata('wire');
		$sql='select * from product_ledger where ware="'.$w.'" and '.$q;
		$qu=$this->db->query($sql);
		
		

		
		
		
		
	}
	
	public function getLastSequence($table,$id,$col){
		
		
			$w = $this->session->userdata('wire');
		
		
		
		
		$q=$this->db->query("SELECT count( ".$col." ) AS count
				FROM (

						SELECT ".$col."
						FROM ".$table."
							WHERE ware ='".$w."'
							AND ".$col." LIKE '".$id."%'
							GROUP BY ".$col."
							) AS t");
		
		
		
		foreach($q->result_array() as $val){
			
			
			return $val["count"];
			
		}
		
		return 0;
		
		
	}
	
	public function openingStockValue(){
		
		
		$w = $this->session->userdata('wire');
		$q=$this->db->query("SELECT sum(`opening_stock` * `buy_price`) as tamount FROM `product_ledger` where ware='".$w."'");
		
		$row=$q->row();
		$total=$row->tamount;
		
		
		return $total;
		
		
		
	}
	
	public function getProductClosingOrOpenningValueBySingleQuery($closingDate){
		
		$w = $this->session->userdata('wire');
		$date = date('Y-m-d', strtotime($closingDate));
		

		
		$q=$this->db->query("select sum(tclosing.net_amount) as closing_value from( select product_ledger.code,product_ledger.buy_price,COALESCE(tlp2.price,0) price,

							COALESCE(sum(product_ledger.opening_stock + ttt.closing_qun),0) total_stock

							,sum(CASE WHEN tlp2.price >= 0 THEN (tlp2.price *(product_ledger.opening_stock + ttt.closing_qun) ) 
								ELSE (product_ledger.buy_price *(product_ledger.opening_stock + ttt.closing_qun) ) END) as net_amount from product_ledger left join

						( SELECT ware,Y.ITEM, SUM( pq ) AS pq, SUM( prq ) AS prq, SUM( sq ) AS sq, SUM( srq ) AS srq, SUM( (
							pq + srq
						) - ( sq + prq ) ) AS closing_qun
						FROM (

					SELECT ware,d_id AS item, SUM( t.qun ) AS pq, 0 prq, 0 sq, 0 srq
					FROM product AS t
					WHERE ware =  '".$w."'
					AND DATE !=  '0000-00-00'
					AND DATE <=  '".$date."'
					AND TYPE =  '1'
					GROUP BY d_id, 
						TYPE 
					UNION 
					SELECT ware,c_id AS item, 0 pq, SUM( t.qun ) AS prq, 0 sq, 0 srq
					FROM product AS t
					WHERE ware =  '".$w."'
					AND DATE !=  '0000-00-00'
					AND DATE <=  '".$date."'
					AND TYPE =  '2'
					GROUP BY c_id, 
					TYPE 
						UNION 
							SELECT ware,c_id AS item, 0 pq, 0 prq, SUM( t.qun ) AS sq, 0 srq
						FROM product AS t
						WHERE ware =  '".$w."'
						AND DATE !=  '0000-00-00'
						AND DATE <=  '".$date."'
						AND TYPE =  '3'
						GROUP BY c_id, 
						TYPE 
						UNION 
						SELECT ware,d_id AS item, 0 pq, 0 prq, 0 sq, SUM( t.qun ) AS srq
							FROM product AS t
						WHERE ware =  '".$w."'
						AND DATE !=  '0000-00-00'
						AND DATE <=  '".$date."'
						AND TYPE =  '4' GROUP BY d_id
					) AS Y
						GROUP BY ITEM ) as ttt on ttt.ITEM=product_ledger.code 

						left join (SELECT tlp.d_id, tlp.price
					FROM (

					SELECT d_id, price
					FROM  `product` 
					WHERE ware =  '".$w."'
					AND TYPE =1
					AND DATE <=  '".$date."'
					AND DATE !=  '0000-00-00'
					ORDER BY id DESC
					) AS tlp
							GROUP BY tlp.d_id) as tlp2 on ttt.ITEM=tlp2.d_id

							where product_ledger.ware='".$w."' group BY product_ledger.code) as tclosing");
		
		
		$row=$q->row();
		$total=$row->closing_value;				
		return $total;
		
	}
	
	public function getPreTransactionForPl($start,$lastDate,$mainCol=null,$type1=null,$col=null,$col_head=null,$type2=null,$col2=null,$col_head2=null){
		
		$end_date = date('Y-m-d', strtotime($lastDate));
		$start_date = date('Y-m-d', strtotime($start));
		
		$w = $this->session->userdata('wire');
		
		$q=$this->db->query("
		select sum(tt.tamount) as gross_amount from(
		SELECT Y.ITEM, SUM( ".$col_head." ) AS sm,
			SUM( ".$col_head2." ) AS sra, SUM( ".$col_head." - ".$col_head2." ) AS tamount
				FROM (

						SELECT ".$col." AS item, SUM( t.".$mainCol." ) AS ".$col_head.", 0 ".$col_head2."
						FROM product AS t
						WHERE ware ='".$w."'
						AND DATE !=  '0000-00-00' and DATE <= '".$start_date."'
						AND TYPE ='".$type1."'
						GROUP BY ".$col.", 
						TYPE 
							UNION 
						SELECT ".$col2." AS item, 0 ".$col_head.", SUM( t.".$mainCol." ) AS ".$col_head2."
						FROM product AS t
						WHERE ware ='".$w."'
						AND DATE !=  '0000-00-00'  AND DATE <= '".$start_date."'
						AND TYPE ='".$type2."'
						GROUP BY ".$col2.", 
						TYPE
					) AS Y
							GROUP BY ITEM ) as tt
							
							
					");
					
					
					$row=$q->row();
					return $row->gross_amount;
		
	}
	
	public function getProductClosingList($start,$lastDate,$mainCol=null,$type1=null,$col=null,$col_head=null,$type2=null,$col2=null,$col_head2=null){
		
		
		
		$date = date('Y-m-d', strtotime($lastDate));
		$start_date = date('Y-m-d', strtotime($start));
		$w = $this->session->userdata('wire');
		
		
				
		$q=$this->db->query("SELECT Y.ITEM, SUM( ".$col_head." ) AS sm,
			SUM( ".$col_head2." ) AS sra, SUM( ".$col_head." - ".$col_head2." ) AS tamount
				FROM (

						SELECT ".$col." AS item, SUM( t.".$mainCol." ) AS ".$col_head.", 0 ".$col_head2."
						FROM product AS t
						WHERE ware ='".$w."'
						AND DATE !=  '0000-00-00' AND date >= '".$start_date."' and DATE <= '".$date."'
						AND TYPE ='".$type1."'
						GROUP BY ".$col.", 
						TYPE 
							UNION 
						SELECT ".$col2." AS item, 0 ".$col_head.", SUM( t.".$mainCol." ) AS ".$col_head2."
						FROM product AS t
						WHERE ware ='".$w."'
						AND DATE !=  '0000-00-00' AND date >= '".$start_date."' and DATE <= '".$date."'
						AND TYPE ='".$type2."'
						GROUP BY ".$col2.", 
						TYPE
					) AS Y
							GROUP BY ITEM
					");
				
			
				
				return $q->result_array();
		
		
		
	}
	
	
	
	
	
	
	
	
	/*	public function getExpenseClosing($closingDate){
		
		
		
		$w = $this->session->userdata('wire');
		$date = date('Y-m-d', strtotime($closingDate));
		
		$test=array();
		$test=$this->getTrialValue('setting','head',3);	
		$length=count($test);
	
		$query="";
		for($i=$length-1;$i>=0;$i--){
		
		$or="or";
		if($i == 0)
		$or="";
	
		$query=$query."parent_head_id='".$test[$i]."' " .$or." ";
		
		}
	
	 $q="(".$query.")";
		
		
		
	$sql="select ttt.net,ttt.head,setting.name from setting inner join (select sum(tt.debit_amount) as debit,sum(tt.credit_amount) as credit,tt.head,sum(tt.debit_amount - tt.credit_amount) as net from

(SELECT l.parent_head_id AS head, t.ware AS w, t.dr, t.cr, sum( t.amount ) AS debit_amount, 0 credit_amount, t.type, t.id, l.id AS lid
FROM `product_trans` AS t
INNER JOIN (

SELECT *
FROM `ledger`
WHERE ware ='".$w."' and ".$query."


) AS l ON t.dr = l.id
WHERE t.ware ='".$w."' AND t.date !=  '0000-00-00' AND t.date <=  '".$date."' and t.status !='1'
GROUP BY l.parent_head_id


union


SELECT l.parent_head_id AS head, t.ware AS w, t.dr, t.cr, 0 debit_amount, sum( t.amount ) AS credit_amount, t.type, t.id, l.id AS lid
FROM `product_trans` AS t
INNER JOIN (

SELECT *
FROM `ledger`
 WHERE ware ='".$w."' and ".$query."

) AS l ON t.cr = l.id
WHERE t.ware ='".$w."' AND t.date !=  '0000-00-00' AND t.date <=  '".$date."' and t.status !='1'
GROUP BY l.parent_head_id) as tt group by tt.head) as ttt on ttt.head=setting.id";	
		
		
		$qq=$this->db->query($sql);
		
		return  $qq->result_array();
		
	/*	$q=$this->db->query("SELECT sum( tt.debit_amount ) AS debit, sum( tt.credit_amount ) AS credit, sum( tt.debit_amount - tt.credit_amount ) AS net_amount
				FROM (

					SELECT t.ware AS w, t.dr, t.cr, sum( t.amount ) AS debit_amount, 0credit_amount, t.type, t.id, l.id AS lid FROM `product_trans` AS t
					INNER JOIN (

					SELECT * FROM `ledger`
					WHERE (`parent_head_id` =102 OR `parent_head_id` =483 ) AND ware =16 ) AS l ON t.dr = l.id WHERE t.ware =16
					UNION
						SELECT t.ware AS w, t.dr, t.cr, 0debit_amount, sum( t.amount ) AS credit_amount, t.type, t.id, l.id AS lid FROM `product_trans` AS t
					INNER JOIN (

					SELECT * FROM `ledger` WHERE ( `parent_head_id` =102 OR `parent_head_id` =483 ) AND ware =16 ) AS l ON t.cr = l.id WHERE t.ware =16 ) AS tt GROUP BY tt.w");
		
		
	}
	
	public function getTestList44($q){
		
		
		$w = $this->session->userdata('wire');
		$sql='select * from product_ledger where ware="'.$w.'" and '.$q;
		$qu=$this->db->query($sql);
		
		

		
		
		
		
	}
	
	public function getLastSequence($table,$id,$col){
		
		
			$w = $this->session->userdata('wire');
		
		
		//$q=$this->db->query("select count(".$col.") as count from  ".$table." where  ware='' ".$col." like '".$id."%' group by ".$col."");
		
		
		$q=$this->db->query("SELECT count( ".$col." ) AS count
				FROM (

						SELECT ".$col."
						FROM ".$table."
							WHERE ware ='".$w."'
							AND ".$col." LIKE '".$id."%'
							GROUP BY ".$col."
							) AS t");
		
		
		
		foreach($q->result_array() as $val){
			
			
			return $val["count"];
			
		}
		
		return 0;
		
		
	}
	
	public function openingStockValue(){
		
		
		$w = $this->session->userdata('wire');
		$q=$this->db->query("SELECT sum(`opening_stock` * `buy_price`) as tamount FROM `product_ledger` where ware='".$w."'");
		
		$row=$q->row();
		$total=$row->tamount;
		
		
		return $total;
		
		
		
	}
	
	public function getProductClosingOrOpenningValueBySingleQuery($closingDate){
		
		$w = $this->session->userdata('wire');
		$date = date('Y-m-d', strtotime($closingDate));
		
		
		/*
		
		SELECT Y.ITEM, SUM( pq ) AS pq, SUM( prq ) AS prq, SUM( sq ) AS sq, SUM( srq ) AS srq, SUM( (
pq + srq
) - ( sq + prq ) ) AS closing_qun
FROM (

SELECT d_id AS item, SUM( t.qun ) AS pq, 0prq, 0sq, 0srq
FROM product AS t
WHERE ware =  '13'
AND DATE !=  '0000-00-00'
AND DATE <=  '2017-10-17'
AND TYPE =  '1'
GROUP BY d_id, 
TYPE 
UNION 
SELECT c_id AS item, 0pq, SUM( t.qun ) AS prq, 0sq, 0srq
FROM product AS t
WHERE ware =  '13'
AND DATE !=  '0000-00-00'
AND DATE <=  '2017-10-17'
AND TYPE =  '2'
GROUP BY c_id, 
TYPE 
UNION 
SELECT c_id AS item, 0pq, 0prq, SUM( t.qun ) AS sq, 0srq
FROM product AS t
WHERE ware =  '13'
AND DATE !=  '0000-00-00'
AND DATE <=  '2017-10-17'
AND TYPE =  '3'
GROUP BY c_id, 
TYPE 
UNION 
SELECT d_id AS item, 0pq, 0prq, 0sq, SUM( t.qun ) AS srq
FROM product AS t
WHERE ware =  '13'
AND DATE !=  '0000-00-00'
AND DATE <=  '2017-10-17'
AND TYPE =  '4' GROUP BY d_id
) AS Y
GROUP BY ITEM
		
		
		
		
		$q=$this->db->query("select sum(tclosing.net_amount) as closing_value from( select product_ledger.code,product_ledger.buy_price,COALESCE(tlp2.price,0) price,

							COALESCE(sum(product_ledger.opening_stock + ttt.closing_qun),0) total_stock

							,sum(CASE WHEN tlp2.price >= 0 THEN (tlp2.price *(product_ledger.opening_stock + ttt.closing_qun) ) 
								ELSE (product_ledger.buy_price *(product_ledger.opening_stock + ttt.closing_qun) ) END) as net_amount from product_ledger left join

						( SELECT ware,Y.ITEM, SUM( pq ) AS pq, SUM( prq ) AS prq, SUM( sq ) AS sq, SUM( srq ) AS srq, SUM( (
							pq + srq
						) - ( sq + prq ) ) AS closing_qun
						FROM (

					SELECT ware,d_id AS item, SUM( t.qun ) AS pq, 0 prq, 0 sq, 0 srq
					FROM product AS t
					WHERE ware =  '".$w."'
					AND DATE !=  '0000-00-00'
					AND DATE <=  '".$date."'
					AND TYPE =  '1'
					GROUP BY d_id, 
						TYPE 
					UNION 
					SELECT ware,c_id AS item, 0 pq, SUM( t.qun ) AS prq, 0 sq, 0 srq
					FROM product AS t
					WHERE ware =  '".$w."'
					AND DATE !=  '0000-00-00'
					AND DATE <=  '".$date."'
					AND TYPE =  '2'
					GROUP BY c_id, 
					TYPE 
						UNION 
							SELECT ware,c_id AS item, 0 pq, 0 prq, SUM( t.qun ) AS sq, 0 srq
						FROM product AS t
						WHERE ware =  '".$w."'
						AND DATE !=  '0000-00-00'
						AND DATE <=  '".$date."'
						AND TYPE =  '3'
						GROUP BY c_id, 
						TYPE 
						UNION 
						SELECT ware,d_id AS item, 0 pq, 0 prq, 0 sq, SUM( t.qun ) AS srq
							FROM product AS t
						WHERE ware =  '".$w."'
						AND DATE !=  '0000-00-00'
						AND DATE <=  '".$date."'
						AND TYPE =  '4' GROUP BY d_id
					) AS Y
						GROUP BY ITEM) as ttt on ttt.ITEM=product_ledger.code 

						left join (SELECT tlp.d_id, tlp.price
					FROM (

					SELECT d_id, price
					FROM  `product` 
					WHERE ware =  '".$w."'
					AND TYPE =1
					AND DATE <=  '".$date."'
					AND DATE !=  '0000-00-00'
					ORDER BY id DESC
					) AS tlp
							GROUP BY tlp.d_id) as tlp2 on ttt.ITEM=tlp2.d_id

							where product_ledger.ware='".$w."' group BY product_ledger.code) as tclosing");
		
		
		$row=$q->row();
		$total=$row->closing_value;				
		return $total;
		
	}
	
	public function getProductClosingList($lastDate,$mainCol=null,$type1=null,$col=null,$col_head=null,$type2=null,$col2=null,$col_head2=null){
		
		
		
		$date = date('Y-m-d', strtotime($lastDate));
		
		$w = $this->session->userdata('wire');
		
		
		
	/*	SELECT Y.ITEM, SUM(pq) AS pq,SUM(prq) AS prq, SUM( sq )as sq,sum(srq) as srq,sum((pq + srq) - (sq+prq)) as closing_qun

FROM (

SELECT d_id AS item, SUM( t.qun) AS pq, 0 prq,0 sq,0 srq FROM product AS t WHERE ware ='16'
AND DATE != '0000-00-00' AND DATE <= '2017-10-17'
AND TYPE ='1'
GROUP BY d_id,
TYPE 

UNION 

SELECT c_id AS item, 0 pq, SUM( t.qun) AS prq,0 sq,0 srq FROM product AS t
WHERE ware ='16'
AND DATE != '0000-00-00' AND DATE <= '2017-10-17'
AND TYPE ='2'
GROUP BY c_id, 
TYPE

union

SELECT c_id AS item, 0 pq, 0 prq,SUM( t.qun) as sq,0 srq FROM product AS t WHERE ware ='16'
AND DATE != '0000-00-00' AND DATE <= '2017-10-17'
AND TYPE ='3'
GROUP BY c_id,
TYPE 

union

SELECT d_id AS item, 0 pq, 0 prq,0 sq,SUM( t.qun) AS srq FROM product AS t WHERE ware ='16'
AND DATE != '0000-00-00' AND DATE <= '2017-10-17'
AND TYPE ='4'

) as Y group by ITEM
				
				//
				
				
				
		$q=$this->db->query("SELECT Y.ITEM, SUM( ".$col_head." ) AS sm,
			SUM( ".$col_head2." ) AS sra, SUM( ".$col_head." - ".$col_head2." ) AS tamount
				FROM (

						SELECT ".$col." AS item, SUM( t.".$mainCol." ) AS ".$col_head.", 0 ".$col_head2."
						FROM product AS t
						WHERE ware ='".$w."'
						AND DATE !=  '0000-00-00' AND DATE <= '".$date."'
						AND TYPE ='".$type1."'
						GROUP BY ".$col.", 
						TYPE 
							UNION 
						SELECT ".$col2." AS item, 0 ".$col_head.", SUM( t.".$mainCol." ) AS ".$col_head2."
						FROM product AS t
						WHERE ware ='".$w."'
						AND DATE !=  '0000-00-00' AND DATE <= '".$date."'
						AND TYPE ='".$type2."'
						GROUP BY ".$col2.", 
						TYPE
					) AS Y
							GROUP BY ITEM
					");
				
				
				
				
				
				
				
				
		
/*
$q=$this->db->query("select plist_table2.buy_price,priceList.price as cprice ,plist_table2.c_id, plist_table2.tsq, plist_table2.trq, plist_table2.code from
					(select plist_table.c_id,plist_table.tsq,
						plist_table.trq,product_ledger.code,product_ledger.`opening_stock`as opening,product_ledger.`buy_price` from product_ledger left join 
						(SELECT tsq_table.c_id, tsq_table.tsq, trq_table.d_id, trq_table.trq
							FROM (

							SELECT c_id, SUM( amount ) AS tsq
								FROM product
								WHERE ware = '".$w."'
								AND TYPE =3
								AND DATE <= '".$date."'
								AND DATE != '0000-00-00'
								GROUP BY c_id
							) AS tsq_table
								LEFT JOIN (

						SELECT d_id, SUM( amount ) AS trq
						FROM product
						WHERE ware = '".$w."'
						AND TYPE =4
						AND DATE <= '".$date."'
						AND DATE != '0000-00-00'
						GROUP BY d_id
						) AS trq_table ON trq_table.d_id = tsq_table.c_id) as plist_table on product_ledger.code=plist_table.c_id 
							where product_ledger.ware='".$w."' order by product_ledger.code asc) as plist_table2 left join (SELECT pp.d_id, pp.price
						FROM (

						SELECT d_id, price
						FROM  `product` 
						WHERE ware =  '".$w."'
						AND TYPE =1
						AND DATE <=  '".$date."'
						AND DATE !=  '0000-00-00'
						ORDER BY id DESC
						) AS pp
						) as priceList on priceList.d_id=plist_table2.code group by plist_table2.code asc
");
		
*/




				
/*select tt.ITEM,tt.closing_qun,tprice.price,sum(tt.closing_qun * tprice.price) as total from (SELECT Y.ITEM, SUM( pq ) AS pq,
 SUM( prq ) AS prq, SUM( sq ) AS sq, SUM( srq ) AS srq, SUM( (
pq + srq
) - ( sq + prq ) ) AS closing_qun,ware
FROM (

SELECT ware,d_id AS item, SUM( t.qun ) AS pq, 0 prq, 0 sq, 0 srq
FROM product AS t
WHERE ware = '11'
AND DATE != '0000-00-00'
AND DATE <= '2017-10-17'
AND TYPE = '1'
GROUP BY d_id, 
TYPE 
UNION 
SELECT ware,c_id AS item, 0 pq, SUM( t.qun ) AS prq, 0 sq, 0 srq
FROM product AS t
WHERE ware = '11'
AND DATE != '0000-00-00'
AND DATE <= '2017-10-17'
AND TYPE = '2'
GROUP BY c_id, 
TYPE 
UNION 
SELECT ware,c_id AS item, 0 pq, 0 prq, SUM( t.qun ) AS sq, 0 srq
FROM product AS t
WHERE ware = '11'
AND DATE != '0000-00-00'
AND DATE <= '2017-10-17'
AND TYPE = '3'
GROUP BY c_id, 
TYPE 
UNION 
SELECT ware,d_id AS item, 0 pq, 0 prq, 0 sq, SUM( t.qun ) AS srq
FROM product AS t
WHERE ware = '11'
AND DATE != '0000-00-00'
AND DATE <=  '2017-10-17'
AND TYPE =  '4'
) AS Y
GROUP BY ITEM ) as tt inner join (SELECT tlp.d_id, tlp.price
FROM (

SELECT d_id, price
FROM  `product` 
WHERE ware =  '11'
AND TYPE =1
AND DATE <=  '2017-10-17'
AND DATE !=  '0000-00-00'
ORDER BY id DESC
) AS tlp
GROUP BY tlp.d_id) as tprice on tt.ITEM=tprice.d_id where tt.ware=11 group by tt.ITEM
				
				
				
				
				return $q->result_array();
		
		
		
	}
	
	
	
	*/
	
	
	
	
	
public function getindInvoiceWare($table,$col=null,$val=null,$col2=null,$val2=null){
		
		if(!empty($col))
		$this->db->where($col,$val);

		if(!empty($col2))
			$this->db->where($col2,$val2);
		
		$info=$this->db->get($table);
		
		return $info->result_array();
		
	}
public function getPreviousBalance($table,$col,$col2=null,$val2=null,$debit,$cols,$admin=null,$type=null){
		
	
		$w = $this->session->userdata('wire');
	
		
	
	  if(!empty($col2))
		  $this->db->where($col2,$val2);
	
		
		if(!empty($w))
			$this->db->where('ware',$w);

			
		if(!empty($cols))
			$this->db->where($debit,$cols);
		if(!empty($type))
			$this->db->where('type',$type);
		
		$this->db->select('SUM(`amount`) as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
	}
	
	public function getindInvoice($table,$col=null,$val=null){
		
		
		$this->db->where($col,$val);
		$w=$this->session->userdata('wire');
		
		if(!empty($w))
			$this->db->where('ware',$w);
		
		$info=$this->db->get($table);
		
		return $info->result_array();
		
	}
	public function getAllProductTransList($table,$id,$start,$end){
		
			$st = date('Y-m-d', strtotime($start));
			$en = date('Y-m-d', strtotime($end));

				$w=$this->session->userdata('wire');
		
		if(!empty($w))
			$this->db->where('ware',$w);
				
		
		$this->db->where('date >=', $st);

		$this->db->where('date <=', $en);
		
		
		
		$this->db->order_by('date', 'asc');

		$this->db->where("(d_id='".$id."' OR c_id='".$id."')");
	$this->db->distinct();
	$this->db->select('date');
	
		
		$info=$this->db->get($table);
		
		return $info->result_array();
		
		

		
		
		
	}
	
	public function getPurchase_Close($table,$col,$start_date,$end_date,$debit,$cols,$admin,$type=null){
		
		
		$w=$this->session->userdata('wire');
		
		if(!empty($w))
			$this->db->where('ware',$w);
		
		
		
		
		$this->db->where('date !=', '0000-00-00');
          $this->db->where('status', 0);
		  
		  
$previous_date = date('Y-m-d', strtotime($end_date));


$e = date('Y-m-d', strtotime($start_date));


$this->db->where('date <=', $previous_date);
$this->db->where('date >=', $e);
		
		
		
		
		if(!empty($cols))
			$this->db->where($debit,$cols);
		if(!empty($type))
			$this->db->where('type',$type);
		
		$this->db->select('SUM(`amount`) as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
		
		
	}
	
	
	
	
	
	
	
	
	public function getLastPrice_open($table,$start,$end,$id)
	{
	    
	    
	    
	    	$previous_date = date('Y-m-d', strtotime($start . ' - 1 day'));

		
		
		$w=$this->session->userdata('wire');
		
		if(!empty($w))
			$this->db->where('ware',$w);
	
		$this->db->limit(1);
		$this->db->order_by('id', 'desc');

		$this->db->where('date <=', $previous_date);
$this->db->where('date !=', '0000-00-00');
   // $this->db->where('status_s', 0);
		//$this->db->where('pt','0');
		$this->db->where("(d_id='".$id."')");
		
		$info=$this->db->get($table);
		$i=0;
		foreach($info->result_array() as $val)
		{
			$i=1;
			return $val['price'];
			
		}
		
		if($i == 0)
		{
			
			return $this->anyName('product_ledger','code',$id,'buy_price');
			
		}
	    
	    
	    
	    
	    
/*	$previous_date = date('Y-m-d', strtotime($start . ' - 1 day'));

		
		
		$w=$this->session->userdata('wire');
		$this->db->where('type','1');
		if(!empty($w))
			$this->db->where('ware',$w);
	
		$this->db->limit(1);
		$this->db->order_by('id', 'desc');

		$this->db->where('date <=', $previous_date);
$this->db->where('date !=', '0000-00-00');
   // $this->db->where('status_s', 0);
		//$this->db->where('pt','0');
		$this->db->where("(d_id='".$id."' OR c_id='".$id."')");
		
		$info=$this->db->get($table);
		$i=0;
		foreach($info->result_array() as $val)
		{
			$i=1;
			return $val['price'];
			
		}
		
		if($i == 0)
		{
			
			return $this->anyName('product_ledger','code',$id,'buy_price');
			
		}
		*/
		
		
		
		
		
	}
	
	public function getLastPrice($table,$start,$end,$id)
	{
		
		$source = $start;
		$date = new DateTime($source);
		$date1 = $date->format('Y-m-d');

		$source = $end;
		$date = new DateTime($source);
		$date2 = $date->format('Y-m-d');
		$w=$this->session->userdata('wire');
		
		if(!empty($w))
			$this->db->where('ware',$w);
		
	$this->db->where('date !=', '0000-00-00');

	$this->db->where('type','1');
		$this->db->where('date <=', $date2);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$this->db->where("(d_id='".$id."' OR c_id='".$id."')");
		
		$info=$this->db->get($table);
		$i=0;
		foreach($info->result_array() as $val)
		{
			$i=1;
			return $val['price'];
			
		}
		
		if($i == 0)
		{
			
			return $this->anyName('product_ledger','code',$id,'buy_price');
			
		}
		
	}
	
	
	
	
	public function getProductLedger($table,$col,$val,$start,$end)
	{
		$w=$this->session->userdata('wire');
		
		if(!empty($w))
			$this->db->where('ware',$w);
		
		
		
		
		
		
		
		
		
		
		
		$st = date('Y-m-d', strtotime($start));
		$en = date('Y-m-d', strtotime($end));
		$this->db->where('date !=', '0000-00-00');
          

		$this->db->order_by('trans_id','desc');
		  // $this->db->where('status_s', 0);
		$this->db->where('date >=', $st);
		$this->db->where('date <=', $en);				
		$this->db->where("(d_id='".$val."' OR c_id='".$val."')");
		
		$info=$this->db->get($table);
		
		return $info->result_array();


		
	}
	
	
	
	
	
	
	
	
	
	
	
	
		public function getMenuData($w,$admin){
		
		$q=$this->db->query("SELECT menu.id as ids,menu.name
FROM `menu`
LEFT JOIN user_access ON menu.id = user_access.head
WHERE user_access.sub =0 AND user = '$admin'");
		
		
		return $q->result_array();
		
		
	}
	
	
	public function productSummary($table,$col,$val,$start,$end,$type=null,$name=null){
		
		
		$w=$this->session->userdata('wire');
		
		if(!empty($w))
			$this->db->where('ware',$w);
		
		$st = date('Y-m-d', strtotime($start));
		$en = date('Y-m-d', strtotime($end));
		$this->db->where('date !=', '0000-00-00');
          
		  
		  if(!empty($type))
			$this->db->where('type',$type);

		$this->db->order_by('trans_id','desc');
		 $this->db->where('status', 0);
		 
		 
		 
		$this->db->where('date >=', $st);
		$this->db->where('date <=', $en);				
		$this->db->where("(d_id='".$val."' OR c_id='".$val."')");
		
		$this->db->select('SUM('.$name.') as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
		
		
		
	}
	
	
	
public function getBalanceType($table,$col,$start_date,$end_date,$debit,$cols,$admin,$type=null){
		
	$w=$this->session->userdata('wire');	
		
		
	
		
	$previous_date = date('Y-m-d', strtotime($end_date));
	$previous_date2 = date('Y-m-d', strtotime($start_date));
	
		$this->db->where('date >=', $previous_date2);
		$this->db->where('date <=', $previous_date);
		
		if(!empty($col))
			$this->db->where("(dr='".$col."' OR cr='".$col."')");
		 $this->db->where('status', 0);

		 if($type == 6)
			{
					$this->db->where("(type='4' OR type='6' OR type='1')");
					$this->db->where("cr",192);
				
			}
			else if($type == 7)
			{
				$this->db->where("(type='3' OR type='7' OR type='2')");
				$this->db->where("dr",192);

				
			}		
		 
		else if(!empty($type))
		$this->db->where('type',$type);


		$this->db->where('ware',$w);

		$this->db->select('SUM(`amount`) as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
	}
public function getTransValue($table,$start,$end,$type=null,$col=null,$val=null){
		
		$w=$this->session->userdata('wire');
			
			
			
			if(!empty($col))
				$this->db->where("(dr='".$col."' OR cr='".$col."')");
			
			
		
			$source = $start;
			$date = new DateTime($source);
			$date1 = $date->format('Y-m-d');

			$source = $end;
			$date = new DateTime($source);
			$date2 = $date->format('Y-m-d');
			
			
			
			$this->db->where('date >=', $date1);
			$this->db->where('date <=', $date2);
			$this->db->where('date !=', '0000-00-00');
			
			$this->db->where('status',0);
			$this->db->where('ware',$w);

			if($type == 6)
			{
					$this->db->where("(type='4' OR type='6' OR type='1')");
					$this->db->where("cr",192);
				
			}
			else if($type == 7)
			{
				$this->db->where("(type='3' OR type='7' OR type='2')");
				$this->db->where("dr",192);

				
			}			
			else if(!empty($type))
				$this->db->where('type',$type);


			
			$info = $this->db->get($table);
			
			return $info->result_array();
		
	}
	public function getSubMenuData($id,$ad){
		
		$this->db->where('head',$id);
		$this->db->where('sub !=','');
		$this->db->where('user',$ad);
		$info=$this->db->get('user_access');
		
		return $info->result_array();
		
	}
	public function getBank($table){
		
		$w = $this->session->userdata('wire');
				
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");

		
		$this->db->order_by('bank_name','asc');
		$this->db->where('bank_name !=','null');
		$this->db->where('bank_name !=','');
		$info=$this->db->get($table);
		
		return $info->result_array();
		
	}
	public function getMax($table,$col){
		
		
		$w=$this->session->userdata('wire');
		
		if(!empty($w))
			$this->db->where('ware',$w);
		
		$this->db->select_max($col,'invoice');
		$info=$this->db->get($table);
		foreach($info->result_array() as $val){
			
			
			return $val['invoice'];
		}
	}
	
	public function getWireList($table,$col,$asc,$check=null){
		
		$this->db->where('ch !=',0);
		$this->db->order_by($col,$asc);
		$info=$this->db->get($table);
		
		return $info->result_array();
		
	}
	
	public function getWare($table,$col,$asc,$check=null){
		
		
		$wire = $this->session->userdata('wire');
		$type=$this->session->userdata('type');
			
			if(!empty($wire))
				$this->db->where('id',$wire);
		
		
		$this->db->order_by($col,$asc);
		$info=$this->db->get($table);
		
		return $info->result_array();
		
	}
	public function getPname($table,$col,$id,$name,$col2=null,$id2=null,$col3=null,$id3=null)
	{

		
		
		$this->db->where($col,$id);
		if(!empty($col2))
			$this->db->where($col2,$id2);
				if(!empty($col3))
			$this->db->where($col3,$id3);
		
		$info=$this->db->get($table);
		
		foreach($info->result_array() as $val){
			
			
			return $val[$name];
			
		}
		
		
		
	}
	public function getPname2($table,$col,$id,$name,$col2=null,$id2=null,$col3=null,$id3=null)
	{
		
		$this->db->where($col,$id);
		if(!empty($col2))
			$this->db->where($col2,$id2);
				if(!empty($col3))
			$this->db->where($col3,$id3);
		
		$info=$this->db->get($table);
		
		foreach($info->result_array() as $val){
			
			
			return $val['re_qun'].":".$val['pices'].":".$val['amount'];
			
		}
		
		//return 0;
		
	}
	public function getIncomeStatement($table,$col,$id){
		
		$this->db->order_by('id','DESC');
		$this->db->where($col,$id);
		$this->db->where('id !=',1);
		$this->db->where('id !=',2);
		$info=$this->db->get($table);
		return $info->result_array();
	}
	public function getBalance($table,$col,$start_date,$end_date,$debit,$cols,$admin,$type=null){
		
	
		$w = $this->session->userdata('wire');
	
		
	$previous_date = date('Y-m-d', strtotime($start_date . ' - 1 day'));	


	
		
		$this->db->where('date <=', $previous_date);
		
		if(!empty($w))
			$this->db->where('ware',$w);

			
		if(!empty($cols))
			$this->db->where($debit,$cols);
		if(!empty($type))
			$this->db->where('type',$type);
		
		$this->db->where('status',0);
		$this->db->select('SUM(`amount`) as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
	}
	public function getBalance3($table,$col,$start_date,$end_date,$debit,$cols,$admin,$type=null){
		
	$w = $this->session->userdata('wire');
	
		
	$previous_date = date('Y-m-d', strtotime($end_date));
	$st = date('Y-m-d', strtotime($start_date));
	
		$this->db->where('date >=', $st);
		$this->db->where('date <=', $previous_date);
		
		if(!empty($w))
			$this->db->where('ware',$w);
		
		
		if(!empty($cols))
			$this->db->where($debit,$cols);
		if(!empty($type))
			$this->db->where('type',$type);
		
		if($table != 'product' || $table != 'product_ledger')
		$this->db->where('status',0);
		$this->db->select('SUM(`amount`) as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
	}
	public function getYearlyBalance($table,$col,$start_date,$end_date,$debit,$cols,$admin,$type=null){
		
		$w = $this->session->userdata('wire');
		
	$previous_date = date('Y-m-d', strtotime($end_date . ' - 1 day'));		
		$this->db->where('date >=', '2015-01-11');
		$this->db->where('date <=', $previous_date);
		
		
		if(!empty($cols))
			$this->db->where($debit,$cols);
		if(!empty($type))
			$this->db->where('type',$type);
		
		if(!empty($w))
			$this->db->where('ware',$w);
		
		if($table != 'product' || $table != 'product_ledger')
		$this->db->where('status',0);
		
		
		
		
		//$this->db->where('by',$admin);
		$this->db->select('SUM(`amount`) as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
	}
	public function getBalance2($table,$col,$start_date,$end_date,$debit,$cols,$admin=null,$type=null){
		
	$w = $this->session->userdata('wire');
	
		
	$previous_date = date('Y-m-d', strtotime($end_date));
	
	$pre = date('Y-m-d', strtotime($start_date));
	
	$this->db->where('date <=', $previous_date);
	$this->db->where('date >=', $pre);
		
		
		if(!empty($cols))
			$this->db->where($debit,(int)$cols);
		if(!empty($type))
			$this->db->where('type',(int)$type);
		if(!empty($w))
			$this->db->where('ware', (int)$w);
		
		
		if($table != 'product' || $table != 'product_ledger')
		$this->db->where('status',0);
		
		//$this->db->where('by',$admin);
		$this->db->select('SUM(amount) as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
	}
	
	public function getIssuQuntity2($table,$col,$start_date,$end_date,$debit,$cols,$admin,$type=null){
		
		$w = $this->session->userdata('wire');
		
		$end = date('Y-m-d', strtotime($end_date));		
		$start_date = date('Y-m-d', strtotime($start_date));		
		
		
		if(!empty($w))
		$this->db->where('ware',$w);
	
		
		
		
		
		//$this->db->where('date >=', $start_date);
		$this->db->where('date <=', $end);
		$this->db->where('date !=', '0000-00-00');
		
		$this->db->where($debit,$cols);
		//$this->db->where('by',$admin);
		$this->db->select('SUM(`pices`) as score');
		$this->db->select('SUM(`return_qun`) as re_qun');
		$q=$this->db->get($table);
		
		foreach($q->result_array() as $val){
			
			
			return ($val['score'] - $val['re_qun']);
		}
	}
	public function getQuantity($table,$col,$start_date,$end_date,$debit,$cols,$admin,$type=null,$days=null,$store=null){
		
	$w = $this->session->userdata('wire');
	
	
	if(empty($days)){
				$previous_date = date('Y-m-d', strtotime($start_date . ' - 1 day'));
		}
		else{
			
		$previous_date = date('Y-m-d', strtotime('2016-06-01'));

			
			
			//echo "Checking  ".$previous_date."<br>";
		}
	
		
//	$previous_date = date('Y-m-d', strtotime($start_date . ' - 1 day'));		
	$this->db->where('date <=', $previous_date);
	$this->db->where('date !=', '0000-00-00');
	
	
		if(!empty($w))
			$this->db->where('ware', $w);
			
		
		if(!empty($type))
				$this->db->where('type', $type);

			
		if(!empty($store))
				$this->db->where('store', $store);
		
		
		
		
		if(!empty($cols))
			$this->db->where($debit,$cols);
		
		 $this->db->where('status', 0);
		$this->db->select('SUM(`qun`) as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
	}
	public function getIssuReturn($table,$col,$start_date,$end_date,$debit,$cols,$admin,$type=null){
		
		$w = $this->session->userdata('wire');
		
	$start = date('Y-m-d', strtotime($start_date));		
	$previous_date = date('Y-m-d', strtotime($end_date));		
		
		
		if(!empty($w))
		$this->db->where('ware',$w);
	
		
		
		
		
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $previous_date);
		$this->db->where('date !=', '0000-00-00');
		
		$this->db->where($debit,$cols);
		//$this->db->where('by',$admin);
		$this->db->select('SUM(`return_qun`) as re_qun');
		$q=$this->db->get($table);
		
		foreach($q->result_array() as $val){
			
			
			return ($val['re_qun']);
		}
	}
public function getIssuQuntity($table,$col,$start_date,$end_date,$debit,$cols,$admin,$type=null){
		
		$w = $this->session->userdata('wire');
		
	$start = date('Y-m-d', strtotime($start_date));		
	$previous_date = date('Y-m-d', strtotime($end_date));		
		
		
		if(!empty($w))
		$this->db->where('ware',$w);
	
		
		
		
		
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $previous_date);
		$this->db->where('date !=', '0000-00-00');
		
		$this->db->where($debit,$cols);
		//$this->db->where('by',$admin);
		$this->db->select('SUM(`pices`) as score');
		$this->db->select('SUM(`return_qun`) as re_qun');
		$q=$this->db->get($table);
		
		foreach($q->result_array() as $val){
			
			
			return ($val['score']);
		}
	}
	
	public function getClosingQun($table,$col,$start_date,$end_date,$debit,$cols,$admin=null,$type=null,$store=null)
	{
		
		
			$w = $this->session->userdata('wire');
	
		
	$previous_date = date('Y-m-d', strtotime($end_date));		

		$this->db->where('date <=', $previous_date);
		$this->db->where('date !=', '0000-00-00');
		if(!empty($w))
			$this->db->where('ware', $w);
			
		
		if(!empty($type))
				$this->db->where('type', $type);
			
			
		if(!empty($store))
				$this->db->where('store', $store);
		

		if(!empty($cols))
			$this->db->where($debit,$cols);
		
		//$this->db->where('by',$admin);
		$this->db->select('SUM(`qun`) as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
		
	}
	
	public function getQuantity2($table,$col,$start_date=null,$end_date,$debit,$cols,$admin=null,$type=null,$days=null,$store=null){
		
		
				$w = $this->session->userdata('wire');

		
	if(empty($days))	
	$previous_date = date('Y-m-d', strtotime($end_date));
	else
		$previous_date = date('Y-m-d', strtotime($start_date . ' - 1 day'));	


$start = date('Y-m-d', strtotime($start_date));		
		
			//$this->db->where('date >=', $start);


		$this->db->where('date <=', $previous_date);
		$this->db->where('date !=', '0000-00-00');
		if(!empty($type))
				$this->db->where('type', $type);
		
		if(!empty($cols))
			$this->db->where($debit,$cols);
		
		if (!empty($store))
			$this->db->where('store', $store);
		
		if(!empty($w))
			$this->db->where('ware', $w);
		
		$this->db->where('status',0);
		
		
		$this->db->select('SUM(`qun`) as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
		
	/*	
		$w = $this->session->userdata('wire');

		
if(empty($days))	
	$previous_date = date('Y-m-d', strtotime($end_date));
	else
		$previous_date = date('Y-m-d', strtotime($start_date . ' - 1 day'));	

	
	$start = date('Y-m-d', strtotime($start_date));		
		
                      
                        if(!empty($start))
			$this->db->where('date >=', $start);
	
		
		
		
		
		$this->db->where('date <=',$previous_date);
		
		
		
		
		$this->db->where('date !=', '0000-00-00');
		
		
		
		
		if(!empty($type))
				$this->db->where('type', $type);
		
		if(!empty($cols))
			$this->db->where($debit,$cols);
		
		
		if(!empty($w))
			$this->db->where('ware', $w);
		
		$this->db->where('status',0);
		
		
		$this->db->select('SUM(`qun`) as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
		
		*/
		
		
		
	}
	
	
	
	
	
	
	
	public function getQuantity3($table,$col,$start_date,$end_date,$debit,$cols,$admin,$type=null,$store=null)
	
	{
		
		$w = $this->session->userdata('wire');

$previous_date = date('Y-m-d', strtotime($end_date));	
$s = date('Y-m-d', strtotime($start_date));	


	
		$this->db->where('date >=', $s);
		$this->db->where('date <=', $previous_date);
		$this->db->where('date !=', '0000-00-00');
		
		
		
		if(!empty($type))
				$this->db->where('type', $type);
		
		if(!empty($cols))
			$this->db->where($debit,$cols);
		
		if(!empty($store))
			$this->db->where('store',$store);
		
		if(!empty($w))
			$this->db->where('ware', $w);
		
		if($table != 'product' || $table != 'product_ledger')
		$this->db->where('status',0);
		
		
		//$this->db->where('by',$admin);
		$this->db->select('SUM(`qun`) as score');
		$q=$this->db->get($table);
		$row=$q->row();
		
		
		return $row->score;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function anyName($table,$col,$id,$name,$col2=null,$id2=null,$col3=null,$id3=null){
		
		
		
		$w = $this->session->userdata('wire');
		
		
		if(!empty($col2)){
			
					$this->db->where($col2,$id2);	

		}
		if(!empty($col3)){
			
					$this->db->where($col3,$id3);	

		}
		
	$this->db->where("(ware='".$w."' OR ware='0')");

	
	
		$this->db->where($col,$id);
		$info=$this->db->get($table);
		foreach($info->result_array() as $val){
			
			return $val[$name];
			
		}
	}
	public function getAssets($table,$col,$type){
		
		
		
		$this->db->order_by($col,$type);
		$info=$this->db->get($table);
		
		return $info->result_array();
		
		
	}
	
	
	public function getDailyBankAmount($table,$start_date,$end_date,$col,$sr_id,$type){
		
		$w = $this->session->userdata('wire');
		
		$date1 = date("Y-m-d", strtotime($start_date));
		$date2 = date("Y-m-d", strtotime($end_date));

		$this->db->where('date >=', $date1);
		$this->db->where('date <=', $date2);
		
		 $this->db->where('status', 0);
		
		$this->db->select('SUM(`amount`) as score');
		$this->db->where("(ware='".$w."')");
				if(!empty($sr_id))
					$this->db->where($col, $sr_id);
					$this->db->where('type', $type);
					$q=$this->db->get('product_trans');
					$row=$q->row();
					$count = $row->score; 
		
		return $count;
		
		
	}
	
	public function getAllExpense($table,$id=null,$start=null,$end=null){
		
		$w = $this->session->userdata('wire');
		
		$source = $start;
		$date = new DateTime($source);
		$date1 = $date->format('Y-m-d');

		$source = $end;
		$date = new DateTime($source);
		$date2 = $date->format('Y-m-d');
		if(!empty($w))
	$this->db->where("(ware='".$w."')");


		
			$this->db->where('cr', $id);	
	
			$this->db->where('type !=', 3);	
			$this->db->where('type !=', 1);	
			$this->db->where('type !=', 2);	
			$this->db->where('type !=', 4);	
			$this->db->where('status', 0);	
				

		

		$this->db->where('date >=', $date1);
		$this->db->where('date <=', $date2);

		
		$info=$this->db->get($table);
		return $info->result_array();
		
		
		
	}
	
	
	
	
	public function getLedgerReport($table,$col,$start,$end,$ledger_id,$admin){
		
		
		$w = $this->session->userdata('wire');

	
		
		$source = $start;
		$date = new DateTime($source);
		$date1 = $date->format('Y-m-d');

		$source = $end;
		$date = new DateTime($source);
		$date2 = $date->format('Y-m-d');
		
		
		
	if(!empty($w))
	$this->db->where('ware',$w);
	
	
		$this->db->where('date >=', $date1);
		$this->db->where('date <=', $date2);
		$this->db->order_by('date', 'asc'); 
		
		
$this->db->where("(dr='".$ledger_id."' OR cr='".$ledger_id."')");
		
		$info=$this->db->get($table);
		return $info->result_array();
		
	}
	
	
	public function getParent($table,$col,$vas,&$mang1){
		
		
		
		
		$w = $this->session->userdata('wire');
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
		
		$this->db->where($col,$vas);
		$info=$this->db->get($table);
		foreach($info->result_array() as $val){
			
			
				if($val['head'] == 0)
				$mang1[]=$val['id'];
				else if($val['id'] == 77)
					$mang1[]=77;
				else if($val['id'] == 76)
					$mang1[]=76;
				
			
			$this->getParent($table,$col,$val['head'],$mang1);
			
		}
	
		return $mang1;

	
	}
	public function getTrialOpening($table,$col,$id){
		
		$this->db->where($col,$id);
		$this->db->select('SUM(opening_balance) as total');
		$info = $this->db->get($table);
		$row=$info->row();
		return $row->total;
		
	}
	function getlist2($table,$col,$vas,&$mang1,$i,$last=null){
				
		$w = $this->session->userdata('wire');
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
				
				if(!empty($last))
					$mang1[]=$last;
				
				
				$this->db->where($col,$vas);
				$info=$this->db->get($table);
				foreach($info->result_array() as $val){
					
					
		$mang1[]=$val['id'];
		
 $this->getlist2($table,'head',$val['id'],$mang1,$i);
						
						
			//echo $val['id']."<br>";	
						
						
				
					
					 
					
					
				}
			
			return $mang1;
			
			}
			
			
function ChatofAccounts($table,$col,$vas,&$mang1,$i=null,$last=null){
				
		$w = $this->session->userdata('wire');
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
			
				
				$this->db->where($col,$vas);
				$info=$this->db->get($table);
				foreach($info->result_array() as $val){
					
			$post= array();
			$post["id"]= $val["id"];
			$post["name"]= $val["name"];
			$post["head"]= $val["head"];
			
	array_push($mang1, $post);

			
			
				// $mang[]=$val['id'];
				// $mang[]=$val['name'];
				// $mang[]=$val['head'];
		
 $this->ChatofAccounts($table,'head',$val['id'],$mang1,$i);
						
						
				
					
					 
					
					
				}
			
			return $mang1;
			
			}	
			
			
			
			
			
			
			
			
			
			
	function getlist($table,$col,$vas,&$mang1,$i){
				
				
		$w = $this->session->userdata('wire');
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
				
				$this->db->where($col,$vas);
				$info=$this->db->get($table);
				foreach($info->result_array() as $val){
					
					
						$mang1[]=$val['id'];
						 $this->getlist($table,'id',$val['head'],$mang1,$i);
						
						
				
						
						
				
					
					 
					
					
				}
			
			return $mang1;
			
			}
	public function getTrialValue2($table,$col,$val)
		{
		
		$mang1=array();
	
			$mang1=$this->getlist2($table,$col,$val,$mang1,1);

	
	
			return $mang1;
		
		
		
		}
	public function getTrialValue($table,$col,$val)
		{
		
		$mang1=array();
	
			$mang1[]=$val;
			$mang1=$this->getlist2($table,$col,$val,$mang1,1);

	
	
			return $mang1;
		
		
		
	}
	public function getTrialValue3($table,$col,$val,$ch=null)
		{
		
		$mang1=array();
	
			if(empty($ch))
			$mang1[]=$val;
			
			
			$mang1=$this->getlist2($table,$col,$val,$mang1,1);

	
	
			return $mang1;
		
		
		
	}

	public function getInvoiceData($table,$invoice){
		
		
		$session=$this->session->userdata('wire');	
		$this->db->where('ware',$session);
		
		
		
		$this->db->where('trans_id',$invoice);
		$info=$this->db->get($table);
		
		return $info->result_array();
		
		
	}
	public function getCustomerDue($table,$col,$id){
		
		
	$session=$this->session->userdata('wire');	
		
		if(!empty($session))
				$this->db->where('ware',$session);
			
			
		$this->db->where($col,$id);
		//$this->db->where('c_s_id !=','');
		$info=$this->db->get($table);
		
		return $info->result_array();
		
	}
	public function getUpdateSum($table,$col,$id){
		
		$session=$this->session->userdata('admin');
		$this->db->where($col,$id);
		//$this->db->where('by',$session);
			$this->db->select('SUM(amount) as total');
			$info = $this->db->get($table);
			
			foreach($info->result_array() as $val){
				
				
				return $val['total'];
				
			}
	}
	public function getDigiInvoiceData($table,$col,$id,$start,$end)
		{
		
			$session=$this->session->userdata('admin');
			$source = $start;
			$date = new DateTime($source);
			$date1 = $date->format('Y-m-d');

			$source = $end;
			$date = new DateTime($source);
			$date2 = $date->format('Y-m-d');
			
			$this->db->where($col,$id);
			$this->db->where('date >=', $date1);
			$this->db->where('date <=', $date2);
			$this->db->where('date !=', '0000-00-00');
			//$this->db->where('by',$session);
			$this->db->select('SUM(due) as total');
			$info = $this->db->get($table);
			
			foreach($info->result_array() as $val){
				
				
				return $val['total'];
				
			}
			
		
		}
	public function getDueDeposite($table,$col,$id,$start,$end,$i=null){
		
		
			$session=$this->session->userdata('admin');
			$t=$this->session->userdata('wire');
			
			
			
			$source = $start;
			$date = new DateTime($source);
			$date1 = $date->format('Y-m-d');

			$source = $end;
			$date = new DateTime($source);
			$date2 = $date->format('Y-m-d');
			
			if(!empty($t))
				$this->db->where('ware',$t);

			
			$this->db->where($col,$id);
			
			if(empty($i))
			$this->db->where('l_id',0);
			else
				$this->db->where('l_id !=',0);
			
			
			$this->db->where('date >=', $date1);
			$this->db->where('date <=', $date2);
			$this->db->where('date !=', '0000-00-00');
			
			 $this->db->where('status', 0);
			
			$this->db->select('SUM(amount) as total');
			$info = $this->db->get($table);
			$row=$info->row();
			return $row->total;
		
	}
	public function getSalesValue($table,$start,$end){
		
		$session=$this->session->userdata('admin');
		
		
		$w = $this->session->userdata('wire');
				
		
		
			$source = $start;
			$date = new DateTime($source);
			$date1 = $date->format('Y-m-d');

			$source = $end;
			$date = new DateTime($source);
			$date2 = $date->format('Y-m-d');
			
			if(!empty($w))
			$this->db->where('ware',$w);
		
		
			$this->db->where('date >=', $date1);
			$this->db->where('date <=', $date2);
			$this->db->where('date !=', '0000-00-00');
			$this->db->where('type',3);
			
			$info = $this->db->get($table);
			
			return $info->result_array();
		
	}


            public function getPending($table,$start,$end,$type=null,$col=null,$val)
               {
		
		$w=$this->session->userdata('wire');
			
			
			
			if(!empty($col))
				$this->db->where($col,$val);
			
			
		
			
			
			$this->db->where('status',0);
			$this->db->where('ware',$w);
			
			
			
			$info = $this->db->get($table);
			
			return $info->result_array();
		
	     }









	public function getIssuValue($table,$start,$end,$type,$limit=null,$s=null){
		
		
		if(!empty($type))
			$this->db->where('issu', $type);
		
		
		
		
		
			
		$this->db->limit($limit, $s);
		$this->db->order_by('id', 'asc'); 
			
		
		
		
		
		
			$source = $start;
			$date = new DateTime($source);
			$date1 = $date->format('Y-m-d');

			$source = $end;
			$date = new DateTime($source);
			$date2 = $date->format('Y-m-d');
			
			$wire=$this->session->userdata('wire');
			if(!empty($wire))
			$this->db->where('ware', $wire);
		
			$this->db->where('date >=', $date1);
			$this->db->where('date <=', $date2);
			$this->db->where('date !=', '0000-00-00');
			$info = $this->db->get($table);
			
			return $info->result_array();
	}
	
	public function productSum($table,$in,$name){
		
		
             $w = $this->session->userdata('wire');
		if(!empty($w))
				$this->db->where('ware',$w);

		$this->db->where('trans_id',$in);
		$this->db->select('SUM('.$name.') as total');
		$info = $this->db->get($table);
		$row=$info->row();
		return $row->total;
		
		
	}
	
	public function getFinalDCValue2($table,$col,$id,$name,$start,$end,$session=null,$type=null,$type2=null,$store=null){
		
		$w = $this->session->userdata('wire');

		
		if (!empty($start))
		{
			
			$source = $start;
			$date = new DateTime($source);
			$date1 = $date->format('Y-m-d');

			$source = $end;
			$date = new DateTime($source);
			$date2 = $date->format('Y-m-d');
			
			
			$this->db->where('date >=', $date1);
			$this->db->where('date <=', $date2);
			$this->db->where('date !=', '0000-00-00');
		}
		$this->db->where($col,$id);
		
		
		if (!empty($type))
		$this->db->where('type',$type);
			
		if (!empty($w))
			$this->db->where('ware', $w);
			
			
		if (!empty($store))
			$this->db->where('store', $store);
			
		$this->db->where('status',0);	

		$this->db->select('SUM('.$name.') as total');
		$info = $this->db->get($table);
		$row=$info->row();
		return $row->total;
		
	}
	public function getTrialBalanceWithDate($table,$col,$id,$start,$end,$admin){
		
		
			$source = $start;
			$date = new DateTime($source);
			$date1 = $date->format('Y-m-d');

			$source = $end;
			$date = new DateTime($source);
			$date2 = $date->format('Y-m-d');
			
			$this->db->where($col,$id);
			//$this->db->where('by',$admin);
			$this->db->where('date >=', $date1);
			$this->db->where('date <=', $date2);
			$info = $this->db->get($table);
		
		
		return $info->result_array();
		
	}
	public function getPreviousDue($table,$col,$id,$name,$col2=null,$val=null){
		
		$w=$this->session->userdata('wire');
		
		if(!empty($col2))
			{


                          $this->db->where($col2,$val);
                          $this->db->where("invoice <",$val);

                        }
		
		if(!empty($w))
			$this->db->where('ware',$w);
		
		
		$this->db->where($col,$id);


		$this->db->select('SUM('.$name.') as total');
		$info = $this->db->get($table);
		$row=$info->row();
		return $row->total;
		
		
		
	}
	public function getFinalDCValue($table,$col,$id,$name,$start=null,$end=null,$session=null){
		
		
		
		$w=$this->session->userdata('wire');
		
		
		if (!empty($start))
		{
			
			$source = $start;
			$date = new DateTime($source);
			$date1 = $date->format('Y-m-d');

			$source = $end;
			$date = new DateTime($source);
			$date2 = $date->format('Y-m-d');
			
			
			$this->db->where('date >=', $date1);
			$this->db->where('date <=', $date2);
		}
		
		if(!empty($w))
			$this->db->where('ware',$w);
		
		
		$this->db->where($col,$id);
		$this->db->where('status',0);
		$this->db->select('SUM('.$name.') as total');
		$info = $this->db->get($table);
		$row=$info->row();
		return $row->total;
		
	}
	public function getSupplierBalance($table,$col,$head){
		
				$w = $this->session->userdata('wire');
				if(!empty($w))
			$this->db->where("ware",$w);
				
					//$this->db->where($col, $head);
					$this->db->where('sup != ','');
					$info=$this->db->get($table);
					return $info->result_array();
		
		
	}
	public function getTrialBalance($table,$col,$val,$ch=null,$del=null,$col2=null,$val2=null){
		
		$w = $this->session->userdata('wire');

		if(!empty($del))
			$this->db->where('id !=',$del);
		
		
		
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
		
		
		
		if(!empty($col2))
			$this->db->order_by($col2,$val2);
		
		$this->db->where($col,$val);

		$info=$this->db->get($table);
		return $info->result_array();
		
	}
	public function getChecking($table,$col,$vas){
		
			$mang1=array();
			
	
		
			$mang1=$this->getParent($table,$col,$vas,$mang1);

	
	
			return $mang1;
		
		
	}
		public function getHealList($table,$col,$vas,$i,$test){
		
			$mang1=array();
	
		$i = 0;
	$mang1=$this->getlist($table,$col,$vas,$mang1,$i);

	
	
	return $mang1;
		
		
	}
public function getCategory($table){
	
	$this->db->order_by('name','ASC');
	$info=$this->db->get($table);
	return $info->result_array();
}	


	public function getInvoiceDataWOIssu($table,$in,$col,$type){
		
		
		
		
			$w = $this->session->userdata('wire');
				
		if(!empty($w) && $table != 'setting')
			$this->db->where('ware',$w);
		
		$this->db->where('type',$type);
		$this->db->where('trans_id',$in);
		$info=$this->db->get($table);
		
		return $info->result_array();
		
	}


public function getAll($table,$col=null,$val=null){
	
	$w = $this->session->userdata('wire');

	$this->db->where("(ware='".$w."' OR ware='0')");

	$this->db->order_by('id','DESC');
	if(!empty($col))
	$this->db->where($col,$val);
	$info=$this->db->get($table);
	return $info->result_array();
}

public function getProductAddCheck($table,$col,$id,$col2,$id2,$name,$col3=null,$id3=null){
	
	
	$w = $this->session->userdata('wire');
				
		if(!empty($w) && $table != 'setting')
			$this->db->where('ware',$w);
	
		if(!empty($col))
			$this->db->where($col,$id);
		if(!empty($col2))
			$this->db->where($col2,$id2);
		if(!empty($col3))
			$this->db->where($col3,$id3);

	$info=$this->db->get($table);
	
	foreach($info->result_array() as $val){
		
		
		return $val[$name];
		
		
		
	}

	
	
	
	
}
public function getAllBank($table,$col=null,$id=null){
	
	
	$w=$this->session->userdata('wire');
	if(!empty($w))
		$this->db->where('ware',$w);


	$this->db->where('bank_name !=','');
	$this->db->where('bank_name !=','null');
	$info=$this->db->get($table);
	return $info->result_array();
}
function report_by_date($table) 
{	

	$date1 =  $this->input->post('date1');
	$date2 = $this->input->post('date2');
	
$source = $date1;
$date = new DateTime($source);
$date1 = $date->format('Y/m/d');

$source = $date2;
$date = new DateTime($source);
$date2 = $date->format('Y/m/d');

	
$this->db->order_by("id", "desc"); 
$this->db->where('date >=', $date1);
$this->db->where('date <=', $date2);
$query = $this->db->get($table);

return $query->result_array();

}





	
			public function check_admin()
{
	$this->load->helper('url');
	
	
	$data = array(
		'name' => $this->input->post('name'),
		'pass' => $this->input->post('password'),
		
	);
	 if($data['name']=="admin" && $data['pass'] == "bangla1400")
 {
	$this->session->set_userdata('admin', '1');

	}
	else
	$this->session->set_userdata('admin', '0');
}

	
public function common_date($table,$field=NULL,$value=NULL,$field2=NULL,$value2=NULL,$date1=NULL,$date2=NULL,$order_feild=NULL,$order_value=NULL) 
{
$w = $this->session->userdata('wire');
if(!empty($w))
$this->db->where("ware",$w);
	
if (!empty($date1))
{
$date1 = date("Y-m-d", strtotime(date1));
$date1 = date("Y-m-d", strtotime(date1));

$this->db->where('date >=', $date1);
$this->db->where('date <=', $date2);
}

			if (!empty($order_feild))
			$this->db->order_by($order_feild, $order_value); 
			if (!empty($field2))
			$this->db->where($field2, $value2);
			if (!empty($field))
			$this->db->where($field, $value);
			$info = $this->db->get($table);
		
			return $info->result_array();

		}


	public function common($table,$field=NULL,$value=NULL,$field2=NULL,$value2=NULL,$order_feild=NULL,$order_value=NULL) // uqing in arabian
		{

		$w = $this->session->userdata('wire');
		if(!empty($w))
		$this->db->where("ware",$w);

			if (!empty($order_feild))
			$this->db->order_by($order_feild, $order_value); 
			if (!empty($field2))
			$this->db->where($field2, $value2);
			if (!empty($field))
			$this->db->where($field, $value);
			$info = $this->db->get($table);
		
			return $info->result_array();

		} 

				public function commononewhere($table,$field=NULL,$value=NULL,$order=NULL,$ad=NULL) // uqing in arabian
{

if (!empty($order))
	$this->db->order_by($order, "desc"); 
	
	if (!empty($field))
	$this->db->where($field, $value);
		$info = $this->db->get($table);
		
		return $info->result_array();

} 

	
	
			public function count($table,$field,$value,$field2,$value2)
{	


$this->db->where($field2, $value2);
$this->db->where($field, $value);
$this->db->from($table);
$count = $this->db->count_all_results();


		return $count;	
	
	
} 

public function pagination_trans($table,$field=NULL,$value=NULL,$limit, $start,$type=null,$col=null,$val=null) 
{


			

 if(!empty($col))
			$this->db->where($col,$val);
	 if(!empty($field))
			$this->db->where($field,$value);

				$this->db->where('noti !=','0');

	$this->db->where('date !=','0000-00-00');

	
   $this->db->limit($limit, $start);
	$this->db->order_by('invoice', 'desc'); 
	
	if(!empty($_GET['type'])){
		
		if($_GET['type'] != 6)
		$this->db->where('issu',$_GET['type']);
	
		
		
		
		
	}
	


	if(!empty($_GET['start_date']) && $_GET['type'] != 6)
 {
		$source = $_GET['start_date'];
		$date = new DateTime($source);
		$date1 = $date->format('Y-m-d');

		$source = $_GET['end_date'];
		$date = new DateTime($source);
		$date2 = $date->format('Y-m-d');

		$this->db->where('date >=', $date1);
		$this->db->where('date <=', $date2);
 }

		if(!empty($_GET['type']))
			$this->db->where('date !=', '0000-00-00');

			$info = $this->db->get($table);
			return $info->result_array();


} 
	
	
public function pagination($table,$field=NULL,$value=NULL,$limit, $start,$type=null,$col=null,$val=null) 
{


			$wire=$this->session->userdata('wire');
			if(!empty($wire))
			$this->db->where('ware', $wire);

 if(!empty($col))
			$this->db->where($col,$val);
		
   $this->db->limit($limit, $start);
	$this->db->order_by('invoice', 'desc'); 
	
	if(!empty($_GET['type'])){
		
		if($_GET['type'] != 6)
		$this->db->where('issu',$_GET['type']);
	
		
		
		
		
	}
	


if(!empty($_GET['start_date']) && $_GET['type'] != 6)
 {
$source = $_GET['start_date'];
$date = new DateTime($source);
$date1 = $date->format('Y-m-d');

$source = $_GET['end_date'];
$date = new DateTime($source);
$date2 = $date->format('Y-m-d');

$this->db->where('date >=', $date1);
$this->db->where('date <=', $date2);
 }

 if(!empty($_GET['type']))
$this->db->where('date !=', '0000-00-00');





	$info = $this->db->get($table);
	return $info->result_array();
 
 
 
 
 
	

} 
public function pagination2($table,$field=NULL,$value=NULL,$limit, $start,$type=null) // uqing in arabian
{
	$this->db->limit($limit, $start);
	$this->db->order_by('id', 'desc'); 
	if (!empty($field))
	$this->db->where($field,$value);
	$info = $this->db->get($table);
	return $info->result_array();

}	
public function pagination_sender($table,$field=NULL,$value=NULL,$limit, $start) // uqing in arabian
{
	$this->db->limit($limit, $start);
	$this->db->order_by('id', 'asc'); 
	if (!empty($field))
	$this->db->where('username',$field);
	$info = $this->db->get($table);
	return $info->result_array();

}		
	
	
	
	
	public function all_count2($table,$feild=null,$value=null,$start=null,$end=null,$type=null)
{	

	$w = $this->session->userdata('wire');

	if(!empty($w))
		{
			$this->db->where("ware",$w);
		}

if(!empty($feild))
			$this->db->where($feild, $value);
			$this->db->from($table);
			$count = $this->db->count_all_results();
			return $count;

}
	
	
	
	public function all_count_trans($table,$feild=null,$value=null,$start=null,$end=null,$type=null,$col=null,$val=null)
{	

		if(!empty($col))
			$this->db->where($col,$val);

		if(!empty($feild))
			$this->db->where($feild,$value);
			$this->db->where('date !=','0000-00-00');
			$this->db->where('noti !=','0');

	if(!empty($_GET['start_date']))
 {
		$source = $_GET['start_date'];
		$date = new DateTime($source);
		$date1 = $date->format('Y-m-d');

		$source = $_GET['end_date'];
		$date = new DateTime($source);
		$date2 = $date->format('Y-m-d');

		$this->db->where('date >=', $date1);
		$this->db->where('date <=', $date2);
 }	
		
	if(!empty($_GET['type']))
		$this->db->where('type',$_GET['type']);



 
		if(!empty($feild))
			$this->db->where($feild, $value);
			$this->db->from($table);
			$count = $this->db->count_all_results();
			return $count;

			
} 	
	
	
	public function all_count($table,$feild=null,$value=null,$start=null,$end=null,$type=null,$col=null,$val=null)
{	
$w = $this->session->userdata('wire');

	if(!empty($w))
		{
			$this->db->where("ware",$w);
		}
		
		if(!empty($col))
			$this->db->where($col,$val);

	if(!empty($_GET['start_date']))
 {
$source = $_GET['start_date'];
$date = new DateTime($source);
$date1 = $date->format('Y-m-d');

$source = $_GET['end_date'];
$date = new DateTime($source);
$date2 = $date->format('Y-m-d');

$this->db->where('date >=', $date1);
$this->db->where('date <=', $date2);
 }	
		
if(!empty($_GET['type']))
	$this->db->where('type',$_GET['type']);



 
		if(!empty($feild))
			$this->db->where($feild, $value);
			$this->db->from($table);
			$count = $this->db->count_all_results();
			return $count;	
} 	
	
	
}