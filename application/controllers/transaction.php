<?php

class Transaction extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library("pagination");
	}
	
	public function trans_product_update(){
		
		$id=$_POST['id'];
		$trans=$_POST['trans'];
		$qun=$_POST['qun'];
		
		$ara=array(
			
					"qun" => $qun
			
			
				);
		
		$this->db->where('transfer',$trans);
		$this->db->where('id',$id);
		$this->db->update('product',$ara);
				
		$this->db->where('transfer',$trans);
		$this->db->where('id',($id + 1));
		$this->db->update('product',$ara);
		
		
		echo 1;
			
				
		
		
	}
	
			public function trans_product_delete()
			{
			
				$this->load->model('setting');
			
			
				$id=$_POST['id'];
	
	$tid=$this->setting->anyName('product','id',$id,'transfer');

	
				$this->db->where('transfer',$tid);
				$this->db->where('id',$id);
				$this->db->delete('product');
				
				$this->db->where('transfer',$tid);
				$this->db->where('id',($id + 1));
				$this->db->delete('product');
			
				$ara=array(
			
					"id" => 1
			
			
				);
			
			
				echo json_encode($ara);
			
			
			
			}
			
			
			public function view_invoice(){
			
				$this->load->model('setting');
			$w=$this->session->userdata('wire');
			
			$invoice=$_POST['invoice'];
			$response["posts"]= array();		
			$this->db->where('transfer',$invoice);
			$this->db->order_by('id','asc');
			//$this->db->group_by('d_id'); 
			$this->db->where('ware',$w);
			$info=$this->db->get('product');
			foreach($info->result_array() as $val){
				
			$post= array();
				
				if($val['d_id'] == 1048)
					$post['name']=$this->setting->anyName('product_ledger','code',$val['c_id'],'name');
				else{
					
					$post['name']=$this->setting->anyName('product_ledger','code',$val['d_id'],'name');
				
				$post["id"]= $val["id"];
				$post["store"]= $val["store"];
				$post["qun"]= $val["qun"];
				$post["d_id"]= $val["d_id"];
				$post["c_id"]= $val["c_id"];
				$post["transfer"]= $val["transfer"];
				array_push($response["posts"],$post);	
				}
					
				
				
				
				
				
			}
					
				
				echo json_encode($response);
			
		}
			public function getTransInvoice()
		{
			
			$start=date("Y-m-d",strtotime($_POST['start']));
			$end=date("Y-m-d",strtotime($_POST['end']));
		
		
			$this->db->where("date >=",$start);
			$this->db->where("date <=",$end);
			$this->db->where('transfer !=',0);
			$this->db->group_by('transfer');
			
			$info=$this->db->get('product');
			$res['posts']=array();
			foreach($info->result_array() as $val)
				{
				
					$post=array();
					
					$post['in']=$val['transfer'];
					$post['date']=$val['date'];
					
					array_push($res['posts'],$post);
				
				
				}
		
		echo json_encode($res);
			
			
		}
	
			function insert_trans($p,$sd,$col,$col2,$q,$date,$max){
			
			$w=$this->session->userdata('wire');
			//$fixed=0;
			//	if($col == 'c_id')
				//	$fixed=1;
			
			$data=array(
					
						
						"type" => 13, //store transfer type
						$col => $p,
						"qun" => $q,
						$col2 => 1048,
						"store" => $sd,
						"transfer" => $max,
						"ware" => $w,
						"date" => date('Y-m-d',strtotime($date)),
						"trans_identy" => 1,
						//"fixed" => $fixed,
					
					
					);
				

				$this->db->insert('product',$data);
					
			
			
			
		}
			public function trans_product_add(){
			
				$w=$this->session->userdata('wire');
			
			$this->load->model('setting');
			$product=explode("*",$_POST['id']);
			$qun=$_POST['qun'];
			$sc=$_POST['sc'];
			$sd=$_POST['sd'];
			$date=$_POST['date'];
			$max=$_POST['max'];
			
			if(empty($product[0]) || empty($product[1])){
				
				$ara=array(
				
					"id" => 0
				
				);
				echo json_encode($ara);
			}
				
			else{
				$ch=$this->setting->anyName('product_ledger','code',$product[1],'name');
				
				if(!empty($ch))
				{
					$u=$this->setting->anyName('product','transfer',$max,'id','d_id',$product[1]);
					$q=$this->setting->anyName('product','transfer',$max,'qun','d_id',$product[1]);
					
					if(!empty($u)){
						
						
						
						
						$data=array(
						
							"qun" => ($qun+$q)
						
						);
						
						$this->db->where("(d_id='".$product[1]."' OR c_id='".$product[1]."')");
						$this->db->where('transfer',$max);
						$this->db->update('product',$data);
						
						
						
						
					}
					else{
						
						
					$this->insert_trans($product[1],$sd,'d_id','c_id',$qun,$date,$max);
					$this->insert_trans($product[1],$sc,'c_id','d_id',$qun,$date,$max);
						
					}
				
					
					
					
					
			$response["posts"]= array();		
			$this->db->where('transfer',$max);
			$this->db->order_by('id','asc');
			$this->db->where('ware',$w);
			$info=$this->db->get('product');
			foreach($info->result_array() as $val){
				
				
				$post= array();
				
				if($val['d_id'] == 1048)
					$post['name']=$this->setting->anyName('product_ledger','code',$val['c_id'],'name');
				else{
					
					$post['name']=$this->setting->anyName('product_ledger','code',$val['d_id'],'name');
				
				$post["id"]= $val["id"];
				$post["store"]= $val["store"];
				$post["qun"]= $val["qun"];
				$post["d_id"]= $val["d_id"];
				$post["c_id"]= $val["c_id"];
				$post["transfer"]= $val["transfer"];
				array_push($response["posts"],$post);	
				}
					
				
				
				
				
				
			}
					
				
				echo json_encode($response);
					
				}
				else{
					
					$ara=array(
				
					"id" => 2
				
				);
				echo json_encode($ara);
				}
				
				
			}
			
			
			
			
			
			
		}
	
	public function getSingleProductTrans($start=null,$end=null,$search=null)
	{
		
		$this->load->model('report_model');

		
		$data["leg"]=$search;
		$data["start"]=$start;
		$data["end"]=$end;
		
		
		$this->load->view("report/singleproductstock",$data);
		
		
		
		
		
	}
	
	
	
public function report_cs()
	{
		$this->load->model('setting');
		
		$led=$_POST['led'];
		$start=date("Y-m-d",strtotime($_POST['start']));
		$end=date("Y-m-d",strtotime($_POST['end']));
		//$end=$_POST['end'];
		$w = $this->session->userdata('wire');
		
		$l_id=explode("*",$led);
		
		$check=explode("*",$this->setting->anyTwiceName('ledger','id',$l_id[1],'sup'));
		$col=null;
		if(empty($check[0])){
			$this->db->where('c_id',$l_id[1]);
			$col="d_id";
		}			
		else if(empty($check[1])){
			$col="c_id";
			$this->db->where('d_id',$l_id[1]);
		}
			
		
		$this->db->where('date >=',$start);
		$this->db->where('date <=',$end);
		$this->db->where('ware',$w);
		
		$info=$this->db->get('product');
		
		$response["posts"]=array();
		foreach($info->result_array() as $val){
			
			$post=array();
			
			$post["id"]=$val["id"];
			$post["date"]=$val["date"];
			$post["trans_id"]=$val["trans_id"];
			$post["price"]=$val["price"];
			$post["qun"]=$val["qun"];
			$post["amount"]=$val["amount"];
			$post["name"]=$this->setting->anyName('product_ledger','code',$val[$col],'name');
			
			array_push($response["posts"],$post);
			
		}
		
		echo json_encode($response);
		
		
	}
	public function product_issue_update(){
		$this->load->model('setting');


               $w= $this->db->where('ware',$w);

		$qun=$_POST['qun'];
		$re=$_POST['rq'];
		$id=$_POST['id'];
		$in=$_POST['ins'];
		
		$price=$this->setting->anyName('issu','id',$id,'price');
		
		
		$data=array(
		
			"pices" => $qun,
			"amount" => $qun*$price,
		
		);
		
		$this->db->where('id',$id);
                $this->db->where('ware',$w);
		$this->db->where('trans_id',$in);
		$this->db->update('issu',$data);
		
		
		

		
		
		
		
		
		$ara=array(
		
			"price" => $price
		
		);
		
		echo json_encode($ara);
		
	}
	public function product_delete2(){


                 $w=$this->db->where('ware',$w);


		$this->load->model('setting');
		$id=$_POST['id'];
		$invoice=$_POST['invoice'];
		
		$this->db->where('id',$id);
		$this->db->delete('issu');
		
                $this->db->where('ware',$w);
		$this->db->where('trans_id',$invoice);
		$info=$this->db->get('issu');
			
		$response["posts"]= array();
		foreach($info->result_array() as $val)
				{
					
			$post= array();
			$post["id"]= $val["id"];
			$post["code"]= $val['code'];
			$post["trans_id"]= $val["trans_id"];
$post["name"]= $this->setting->anyName('product_ledger','code',$val['code'],'name');
			$post["pices"]= $val["pices"];
			$post["re_qun"]= $val["re_qun"];
			$post["price"]= $val["price"];
			$post["return_qun"]= $val["return_qun"];
			$post["amount"]= $val["amount"];
				
				array_push($response["posts"], $post);

				}
		echo json_encode($response);
		
	}
	public function invoice_admin_update()
	{
		
		$this->load->model('setting');
		$w = $this->session->userdata('wire');
		
		
		$date=$_POST['date'];
		$sup=explode('*',$_POST['supp']);
		$invoice=$_POST['invoice'];
		$type=$_POST['type'];
		$store=$_POST['store'];
		
		$sup_old=$this->setting->anyName('invoice','invoice',$invoice,'supplier');
		
		$col=null;
		
		$data=array(
		
			
				"store" => $store,
				"supplier" => $sup[1],
				"date" => date('Y-m-d',strtotime($date))
		
		
		);
		
			if(!empty($w))
				$this->db->where('ware',$w);


				$this->db->where('invoice',$invoice);
				$this->db->update('invoice',$data);
		
		
		if($type == 2 || $type == 3 || $type == 12){
			
			$col="d_id";
			
		}
		if($type == 1 || $type == 4){
			
			$col="c_id";
			
		}
		
		$data=array(
		
				"store" => $store,
				$col => $sup[1],
				"date" => date('Y-m-d',strtotime($date))
		
		
		);
		
			if(!empty($w))
			$this->db->where('ware',$w);

		$this->db->where('trans_id',$invoice);
		$this->db->update('product',$data);
		
		
		
		$this->db->where("(dr='".$sup_old."' OR cr='".$sup_old."')");
		$this->db->where('invoice_id',$invoice);
		$this->db->where('ware',$w);		
		
		$info=$this->db->get('product_trans');
		
		foreach($info->result_array() as $val){
			
			$data=null;
			
				if($val['dr'] == $sup_old)
				{
					
					$data=array(
					
					
					"store" => $store,
					"dr" => $sup[1],
					"date" => date('Y-m-d',strtotime($date))
					);
					
				}
				else if($val['cr'] == $sup_old){
					
					$data=array(
					
						"store" => $store,
						"cr" => $sup[1],
						"date" => date('Y-m-d',strtotime($date))
					
					);
					
				}
			
			if(!empty($w))
			$this->db->where('ware',$w);
			$this->db->where('id',$val['id']);
			$this->db->update('product_trans',$data);
			
			
		}
		
		
		
		$ara=array(
		
				"id" => 2
		
		);
		
		
		
		echo json_encode($ara);
		
	}
	public function voucher_date_update(){
		
		
		$this->load->database();
		
		$admin = $this->session->userdata('admin');
		$w = $this->session->userdata('wire');
		
		$id=$_POST['pro'];
		$type=$_POST['type'];
		$date=$_POST['date'];
		
		//$check=$this->news_model->anyName('product_trans','voucher',$id,'id','type',$type);
		
		
		$j=0;
		
			
		$da=array(
		
			"date" => date('Y-m-d',strtotime($date)), 
			"status" => $j 
		
		);
		
		
		$this->db->where('voucher',$id);
		if(!empty($w))
	$this->db->where('ware',$w);
	$this->db->where('type',$type);
	$this->db->update('product_trans',$da);
			
		$ara=array(
			
				"id" => 2
			
			);
			echo json_encode($ara);
			
			
			
			
			
			
			
			
			
			
			
		
	
		
		
		
		
		
		
	}
	public function delete_cash(){
		
		
		$vou=$_POST['vou'];
		$id=$_POST['id'];
		$type=$_POST['type'];
		
		$this->load->model('report_model');
		
		
		$admin = $this->session->userdata('admin');
		$w = $this->session->userdata('wire');
		
		
		$this->db->where('id',$id);
		$this->db->where('ware',$w);
		$this->db->delete('product_trans');
		
		$this->db->where('voucher',$vou);
		$this->db->where('type',$type);
		$this->db->where('ware',$w);
		
		
		$info=$this->db->get('product_trans');
		$response["posts"]= array();
		
		foreach($info->result_array() as $val)
				{
					
	$post= array();
	$post["id"]= $val["id"];
$post["debit"]= $this->report_model->anyName('ledger','id',$val["dr"],'ledger_title');
	$post["credit"]= $this->report_model->anyName('ledger','id',$val['cr'],'ledger_title');
	$post["amount"]= $val["amount"];
	
	$post["cheque_date"]= $val["cheque_date"];
	$post["cheque_no"]= $val["cheque_no"];
	
	
	$post["description"]= $val["description"];
	$post["cheque_date"]= $val["cheque_date"];
	$post["cheque_no"]= $val["cheque_no"];			
				array_push($response["posts"], $post);

				}
		echo json_encode($response);
		
	}
	public function cash_update(){
		
		
		$this->load->database();
		
		$amount=$_POST['amount'];
		$desc=$_POST['des'];
		$id=$_POST['id'];
		
		$data=array(
		
			"amount" => $amount,
			"description" => $desc,
			
		
		);
		
		$this->db->where('id',$id);
		$this->db->update('product_trans',$data);
		
		
		$ara=array("id" => 1);
		
		echo json_encode($ara);
		
	}
	public function autocomplete_view()
	{
		
		
	$this->load->database();	
		
		$id=$_POST['id'];
		
		
		$w=$this->session->userdata('wire');
		
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
	
		
		
		
		$this->db->like('ledger_title', $id); 
		$info=$this->db->get('ledger');
		
		
		


		$data=array();
		foreach($info->result_array() as $val)
		{
			array_push($data,$val['ledger_title']."*".$val['id']);
		}
		echo json_encode($data);
		
		
	}
	public function cash_p(){
		
		$admin = $this->session->userdata('admin');
		$w = $this->session->userdata('wire');
		
		
		
		
		$this->load->model('report_model');
		
		
		$voucher=$_POST['voucher'];
		$type=$_POST['type'];
		$date=$_POST['date'];
		$exp=explode('*',$_POST['lader']);
		$amount=$_POST['amount'];
		$desc=$_POST['desc'];
		$bank=$_POST['bank'];
		$check_no=$_POST['check_no'];
		$check_date=$_POST['check_date'];
		
		
		
		
		
		
$l_id=$this->report_model->anyName('ledger','id',$exp[1],'parent_head_id');


		if($type == 6){
			
			$dr=$exp[1];
			$cr=192;
			//$drs="dr";
			//$crs=192;
		}
		else if($type == 7){
			
			$cr=$exp[1];
			$dr=192;
			//$drs="dr";
			//$drs=192;
		}
		else if($type == 8){
			
			$dr=$bank;
			$cr=$exp[1];
			
		}
		else if($type == 9){
			
			$cr=$bank;
			$dr=$exp[1];
			
			
			if(!empty($check_date))
		$check_date=date('Y-m-d',strtotime($check_date));;
			
		}


		$data=array(
		
				"voucher" => $voucher,
				"amount" => $amount,
				"description" => $desc,
				"date" => date('Y-m-d',strtotime($date)),
				"dr" => $dr,
				"cr" => $cr,
				"l_id" => $l_id,
				"cheque_date" => $check_date,
				"cheque_no" => $check_no,
				"type" => $type,//cash payment
				"ware" => $w,//cash payment
				"by" => $admin
		
		);
		
		
		$this->db->insert('product_trans',$data);
		
		
		$this->db->where('voucher',$voucher);
		$this->db->where('type',$type);
		if(!empty($w))
	$this->db->where('ware',$w);


		$this->db->order_by('id','DESC');
		//$this->db->where('type',6);
		//$this->db->where('by',$admin);
		$info=$this->db->get('product_trans');		

		$response["posts"]= array();
		foreach($info->result_array() as $val)
				{
					
	$post= array();
	$post["id"]= $val["id"];
	
	
	
$post["debit"]= $this->report_model->anyName('ledger','id',$val['dr'],'ledger_title');

	$post["credit"]= $this->report_model->anyName('ledger','id',$val['cr'],'ledger_title');
	
	
	$post["amount"]= $val["amount"];
	$post["cheque_date"]= $val["cheque_date"];
	$post["cheque_no"]= $val["cheque_no"];
	$post["description"]= $val["description"];
				
				array_push($response["posts"], $post);

				}
		echo json_encode($response);
		
		
	}
	public function all_voucher(){
		
			$w=$this->session->userdata('wire');
		
		//$this->load->database();
		
		
		
		
		$type=$_POST['type'];
		
$start=date('y-m-d',strtotime($_POST['start']));
$end=date('y-m-d',strtotime($_POST['end']));
		



		$this->db->distinct();
		$this->db->group_by('voucher');
		$this->db->where('type',$type);
                $this->db->where('ware',$w);
		$this->db->where('date >=',$start);
		$this->db->where('date <=',$end);
		
		$info=$this->db->get('product_trans');
		
		$response["posts"]= array();
		foreach($info->result_array() as $val)
				{
					
			$post= array();
			$post["id"]= $val["id"];
			$post["voucher"]= $val["voucher"];
$post["date"]= $val['date'];

				array_push($response["posts"], $post);

				}
		echo json_encode($response);
		
		
		
	}
	public function trans_update(){
		
		$this->load->database();
		
		
		$id=$_POST['id'];
		$val=$_POST['va'];
		
		
		$data=array(
		
		
		
			"amount" => $val
		
		
		);
		
		$this->db->where('id',$id);
		$this->db->update('product_trans',$data);
		
		
		
		$ara=array(
		
			"id" => 1
		
		
		);
		
		
				echo json_encode($ara);
		
	}
	public function getServiceLedger()
		{
		
		
		
		
		
			$id=$_POST['id'];
			$w=$this->session->userdata('wire');
			if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
		
		
		
			$this->db->where('parent_head_id',17);
			$this->db->like('ledger_title', $id); 
			$info=$this->db->get('ledger');
		
		
		


		$data=array();
		foreach($info->result_array() as $val)
		{
			array_push($data,$val['ledger_title']."*".$val['id']);
		}
		echo json_encode($data);
		
		
		}
		public function service_add()
	{
		$this->load->model('transactions');
		
		$admin = $this->session->userdata('admin');
		$ara=null;
		if(empty($admin))
		{
			$ara=array(
			
				"id" => 1 //againe login
			
			);
			
			echo json_encode($ara);
			
			
		}
		else{
			
			
			$w=$this->session->userdata('wire');			
			$type=$_POST['type'];
			$invoice=$_POST['invoice'];
			$product=$_POST['product'];
			$qun=$_POST['qun'];
			$price=$_POST['price'];
			$sup=explode('*',$_POST['supp']);		
			$col=null;
			
			
			$credit=386;
			$debit=$sup[1];
			$col="c_id";
			
			$check=$this->transactions->getProductAddCheck('product','trans_id',$invoice,'s_name',$product,'id','type',$type);
			
			
			if(!empty($check)){
				
				$ara=array
					(
				
				
						"id" => 2 //Already Inserted
				
				
					);
				
				
				echo json_encode($ara);
				
			}
			else{
				
				
				$data=array(
		
							"d_id" => $debit,
							"c_id" => $credit,
							"amount" => $price*$qun,
							"qun" => $qun,
							"s_name" => $product,
							"type" => $type,
							"price" => $price,
							"trans_id" => $invoice,
							"by" => $admin,
							"ware" => $w,
		
							);
		
		$this->db->insert('product',$data);
		
		
		
		
		if(!empty($w))
			$this->db->where('ware', $w);
		
		
		$this->db->where('trans_id',$invoice);
		$this->db->where('type',$type);
		$info=$this->db->get('product');
		
		$response["posts"]= array();
		foreach($info->result_array() as $val)
				{
					
			$post= array();
			$post["id"]= $val["id"];
			$post["idd"]= $val[$col];
			$post["type"]= $val['type'];
			$post["trans_id"]= $val["trans_id"];
$post["name"]= $val['s_name'];
$post["ptype"]= $this->transactions->anyName('product_ledger','code',$val[$col],'ptype');
			$post["amount"]= $val["amount"];
			$post["price"]= $val["price"];
			$post["qun"]= $val["qun"];
				
				array_push($response["posts"], $post);

				}
		echo json_encode($response);
		
		
		
		
		
		
				
				
			}
		
		
		
		
		
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		}
		
		
	}
	public function return_qun_update(){
		
		$this->load->model('transactions');
		
		
		$id=$_POST['id'];
		$val=$_POST['val'];
		$in=$_POST['invoice'];
		$qun=$_POST['qun'];
		
	$pro=$this->transactions->anyName('issu','id',$id,'price','trans_id',$in);
	
		$data=array(
		
				"return_qun" => $val,
				"amount" => ($qun - $val)*$pro,
		
		);
		
		
		$this->db->where('id',$id);
		$this->db->update('issu',$data);
	
	
	$pro=$this->transactions->anyName('issu','id',$id,'price','trans_id',$in);
	$amount=$this->transactions->getUpdateSum('issu','trans_id',$in);
	
	
			$ar=array(
			
				"id" => $pro,
				"amount" => $amount
			);
		
		echo json_encode($ar);
	}
	public function product_add_issu()
	{
		
		
		$this->load->model('transactions');
		
		$admin = $this->session->userdata('admin');
		$w = $this->session->userdata('wire');
		
		
		$ara=null;
		if(empty($admin))
		{
			$ara=array(
			
				"id" => 0
			
			);
			
			echo json_encode($ara);
			
		}
		else{
			
		$invoice=$_POST['invoice'];
		$product=explode('*',$_POST['product']);
		$qun=explode('.',$_POST['qun']);
		
		$q=$_POST['qun'];
		
		
		$type=$_POST['type'];
		$price=$_POST['price'];
		$sup=explode('*',$_POST['supp']);
		

		
		$check=$this->transactions->getPname('product_ledger','code',$product[1],'carton');
		
		
		
		
		$amount=0;
		if(!empty($qun[0]))
			$amount=$amount+(($qun[0]*$check));
		if(!empty($qun[1]))
			$amount=$amount+$qun[1];
		else
			$amount=$q;
		
		
		
	$check=$this->transactions->getPname('issu','code',$product[1],'id','name',$sup[1],'trans_id',$invoice);		
				
		if(!empty($check)){
		
$check=$this->transactions->getPname2('issu','code',$product[1],'re_qun','name',$sup[1],'trans_id',$invoice);	


$re=$this->transactions->getPname('issu','code',$product[1],'return_qun','trans_id',$invoice);

			$quns=explode(':',$check);
		
		$al_qun=(($amount+$quns[1])-$re)*$price;
				$data=array
					(
			
						"price" => $price,
						"by" => $admin,
						"pices" => $amount+$quns[1],
						"amount" => $al_qun,
			
					);
		
		
		$this->db->where('trans_id',$invoice);
		$this->db->where('code',$product[1]);
		if(!empty($w))
	$this->db->where('ware',$w);
		$this->db->update('issu',$data);
		
		
		
		}
		else{
			
			$data=array(
			
				"name" => $sup[1],
				"price" => $price,
				"by" => $admin,
				"trans_id" => $invoice,
				"code" => $product[1],
				"pices" => $amount,
				"ware" => $w,
				"amount" => $amount*$price,
			
			);
			
			$this->db->insert('issu',$data);
			
		}
			
		
		
		
		
		
		
		
		
		
		
		
		

		
		$this->db->where('ware',$w);
			
		$this->db->where('trans_id',$invoice);
		$info=$this->db->get('issu');
			
		$response["posts"]= array();
		foreach($info->result_array() as $val)
				{
					
			$post= array();
			$post["id"]= $val["id"];
			$post["code"]= $val['code'];
			$post["trans_id"]= $val["trans_id"];
$post["ptype"]= $this->transactions->anyName('product_ledger','code',$val['code'],'ptype');
$post["name"]= $val['code'];
			$post["pices"]= $val["pices"];
			$post["re_qun"]= $val["re_qun"];
			$post["price"]= $val["price"];
			$post["return_qun"]= $val["return_qun"];
			$post["amount"]= $val["amount"];
				
				array_push($response["posts"], $post);

				}
		echo json_encode($response);			
			
		
			
		}
		
	}
	public function go_invoice_issu(){
		
		$this->load->model('transactions');
		
		$id=$_POST['id'];
		$type=$_POST['type'];
		$ltype=$_POST['type_l'];
		
		$w=$this->session->userdata('wire');
		
$check=$this->transactions->getProductAddCheck('invoice','invoice',$id,'issu',$ltype,'supplier','ware',$w);	

	
$name=$this->transactions->getProductAddCheck('ledger','id',$check,'','','ledger_title');
	

	
	
	$this->db->where('trans_id',$id);
	$this->db->where('ware',$w);
	$info=$this->db->get('issu');
	$response["posts"]= array();
	$response["supp"]= array();
	foreach($info->result_array() as $val)
				{
					
			$post= array();
			$post["id"]= $val["id"];
			$post["code"]= $val['code'];
			$post["trans_id"]= $val["trans_id"];
$post["name"]= $this->transactions->anyName('product_ledger','code',$val['code'],'name');
$post["ptype"]= $this->transactions->anyName('product_ledger','code',$val['code'],'ptype');
			$post["pices"]= $val["pices"];
			$post["re_qun"]= $val["re_qun"];
			$post["price"]= $val["price"];
			$post["amount"]= $val["amount"];
			$post["return_qun"]= $val["return_qun"];
				
				array_push($response["posts"], $post);

				}
				
			
				$post= array();
				$post["sup"]= $name."*".$check;
				array_push($response["supp"], $post);
			
		echo json_encode($response);


	
	}
	public function purchase(){
		
		$admin = $this->session->userdata('admin');
		$w=$this->session->userdata('wire');
		
		
		$this->load->model('transactions');
		
		
		$ara=null;
		if(empty($admin))
			{
			
					$ara=array(
					
						"id" => 1
					
					);
				
			}
		else{
			
			
			
			$gr_amount=$_POST['gross_amount'];
			$taka=$_POST['taka'];
			$per=$_POST['per'];
			$cash=$_POST['cash'];
			$card=$_POST['card'];
			$type=$_POST['type'];
			$invoice=$_POST['invoice'];
			$pdate=$_POST['pdate'];
			$remark=$_POST['remark'];
			$bkash=$_POST['bkash'];			
			$sup=explode('*',$_POST['supplier']);
			
			
			$gr_discount=$_POST['gross_discount'];
			$change=$_POST['exchange'];
			$ptype=$_POST['p_type'];
			
			$issu=$_POST['p_type'];
			
			
			
				

		$data=array(
		
		
				"gross_amount" => $gr_amount,
				"dis_taka" => $taka,
				"dis_per" => $per,
				"cash" => $cash,
				"card" => $card,
"due" => ($gr_amount - ($card+$cash+$gr_discount+$bkash)),
				"b_type" => $type,//bank type
				"gross_dis" => $gr_discount,
				"change" => $change,
				 "pdate" => date('Y-m-d'),
				"noti" => 1,				
				"bk_amount" => $bkash,
				"supplier" => $sup[1],
				"date" => date('Y-m-d',strtotime($pdate)),
				"by" => $admin,
				"remarks" => $remark,
		
		);	
			
			
			if(!empty($w))
				$this->db->where('ware',$w);

			$this->db->where('invoice',$invoice);
			$this->db->update('invoice',$data);
			
			
			
	$issu=$this->transactions->anyName('invoice','invoice',$invoice,'issu');		
			
			
			
			
		if($ptype == 5){
			
			
		$ch=$this->transactions->anyName('product_trans','invoice_id',$invoice,'id','cr',204);


			if(!empty($ch)){
				
				$data=array
					(
			
				"date" => date('Y-m-d',strtotime($pdate)),
					"amount" => $gr_amount,
					"noti" => 1,
					"by" => $admin,
					
					);
			
				$this->db->where('id',$ch);
				$this->db->update('product_trans',$data);
				
			}
			else{
			$data=array
					(
			
					"dr" => $sup[1],
					"cr" => 204,
					"type" => 3,
				"date" => date('Y-m-d',strtotime($pdate)),
					"invoice_id" => $invoice,
					"amount" => $gr_amount,
					//"voucher" => $invoice,
					"ware" => $w,
					"by" => $admin,
					);
			
				$this->db->insert('product_trans',$data);
			
			}
		}	
		else{
			
			$col=null;
			$cols=null;
			
			if($ptype == 1)
				{
				
					$col="dr";
					$cols=5;
				
				}
			else if($ptype == 2){
				
					$col="cr";
					$cols=5;
				
			}
			else if($ptype == 3)
			{
					$col="cr";
					$cols=204;
				
			}
			else if($ptype == 4)
			{
					$col="dr";
					$cols=204;
				
			}	
			else if($ptype == 12)
			{
					$col="cr";
					$cols=386;
				
			}
			
			
			
			
			$data=array(
			
				"date" => date('Y-m-d',strtotime($pdate)),
				"amount" => $gr_amount,
				"by" => $admin,
				"noti" => 1,
			
			);
			
			
				
			$this->db->where('ware',$w);
			$this->db->where($col,$cols);
			$this->db->where('invoice_id',$invoice);
			$this->db->update('product_trans',$data);
			
		}
			
		

     



		
			$debit=null;
			$debit_col=null;
			$credit=null;
			$bkash_d="";
			$bkash_c="";
			$debit_col2="";
			
			
			if($ptype == 1){
				
				$debit=$sup[1];
				$bkash_d=$sup[1];
				$credit=$debit_col=203;
				
				$debit_col2="cr";
				
				$bkash_c=343;
			}
			else if($ptype == 2){
				
				
				$credit=$sup[1];
				$debit=$debit_col=203;
			
				
				$bkash_d=343;
				$bkash_c=$sup[1];
				
				$debit_col2="dr";
				
				
			}
			else if($ptype == 3 || $ptype == 5 || $ptype == 12){
				
				$credit=$sup[1];
				$debit=$debit_col=205;
				
				if($ptype != 12)
				$ptype=3;
				
				$bkash_d=343;
				$bkash_c=$sup[1];
				
				$debit_col2="dr";
			}
			else if($ptype == 4){
				
				$debit=$sup[1];
				$credit=$debit_col=205;
				
				$bkash_d=$sup[1];
				$bkash_c=343;
				
				$debit_col2="cr";
				
				
			}

			
		$ch_b=$this->transactions->anyName('invoice','invoice',$invoice,'bk_id','bk','b');


	if(!empty($ch_b)){
		
		
		$data=array(
			
				"amount" => $bkash,
				"by" => $admin,
				"noti" => 1,
				"date" => date('Y-m-d',strtotime($pdate)),
			
			);
			$this->db->where('id',$ch_b);
			$this->db->update('product_trans',$data);
		
		
		
	}
	else if(!empty($bkash)){
		
		$data=array(
			
				"dr" => $bkash_d,
				"cr" => $bkash_c,
				"type" => $ptype,
				"ware" => $w,
				"invoice_id" => $invoice,
				"amount" => $bkash,
				"by" => $admin,
				"date" => date('Y-m-d',strtotime($pdate)),
				"noti" => 1,
			
			);
			
		$this->db->insert('product_trans',$data);
		
		$last_id=$this->db->insert_id();
		
		$up=array(
		
			"bk_id" => $last_id,
			"bk" => 'b',
		);
		
		$this->db->where('invoice',$invoice);
		$this->db->where('ware',$w);	
		$this->db->update('invoice',$up);
		
		
		
	}	
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
$ch=$this->transactions->anyName('product_trans','invoice_id',$invoice,'id',$debit_col2,$debit_col);			
			
if(!empty($ch)){
			
			$data=array(
			
				"amount" => $gr_discount,
				"by" => $admin,
				"noti" => 1,
				"date" => date('Y-m-d',strtotime($pdate)),
			
			);
			$this->db->where('id',$ch);
			$this->db->update('product_trans',$data);
			
			
			
			
			
		}			
else if(!empty($gr_discount)){
			
			$data=array(
			
				"dr" => $debit,
				"cr" => $credit,
				"type" => $ptype,
				"ware" => $w,
				"invoice_id" => $invoice,
				"amount" => $gr_discount,
				"by" => $admin,
				"date" => date('Y-m-d',strtotime($pdate)),
				"noti" => 1,
			
			);
			
		$this->db->insert('product_trans',$data);
			
			
		}	
			
			
			
			
			
			
			
			
			

		
		
		
		
		if($ptype == 1){
				
				$debit=$sup[1];
				$credit=192;
			}
		else if($ptype == 2){
				
				
				$credit=$sup[1];
				$debit=192;
			}
			else if($ptype == 3 || $ptype == 5 || $ptype == 12){
				
				$credit=$sup[1];
				$debit=192;
				
				if($ptype != 12)
					$ptype=3;
			}
			else if($ptype == 4){
				
				$debit=$sup[1];
				$credit=192;
				
			}
		
	
	
	
	
	
	
	
	
	
	$ch=$this->transactions->anyName('product_trans','invoice_id',$invoice,'id','dr',$debit,'cash','c');



    if(!empty($ch)){
			
			$data=array(
			
				"amount" => $cash,
				"by" => $admin,
				"noti" => 1,
				"date" => date('Y-m-d',strtotime($pdate)),
			
			);
			$this->db->where('id',$ch);
			$this->db->update('product_trans',$data);
			
		}
		else if(!empty($cash)){
			
		$data=array(
			
				"dr" => $debit,
				"cr" => $credit,
				"type" => $ptype,
				"ware" => $w,
				"cash" => 'c',
				"date" => date('Y-m-d',strtotime($pdate)),
				"invoice_id" => $invoice,
				"amount" => $cash,
				"by" => $admin,
				"noti" => 1,
			
			);
			
		$this->db->insert('product_trans',$data);
			
			
		}
	
	
	
	
	
	
	
	
		
		
		
		
		if($ptype == 1){
				
				$debit=$sup[1];
				$credit=$type;
				
				$ara=array(
					
						"id" => 11, //purchase
						"issu" => $issu, //purchase
						"sup" => $sup[1], //purchase
					
					);
				
			}
		else if($ptype == 2){
				
				$ara=array(
					
						"id" => 12,//purchase return
						"issu" => $issu, //purchase
						"sup" => $sup[1], //purchase
					
					);
					
				$credit=$sup[1];
				$debit=$type;
			}

			
	else if($issu == 5){
				
				$ara=array(
					
						"id" => 15, //sale 
						"issu" => $issu, //purchase
						"sup" => $sup[1], //purchase
					
					);
					
				$credit=$sup[1];
				$debit=$type;
				
			}
			
			else if($ptype == 3 || $ptype == 12){
				
				$ara=array(
					
						"id" => 13, //sale 
						"issu" => $issu, //purchase
						"sup" => $sup[1], //purchase
					
					);
					
				$credit=$sup[1];
				$debit=$type;
				
			}

			else if($ptype == 4){
				
				$debit=$sup[1];
				$credit=$type;
				
				$ara=array(
					
						"id" => 14, //sale return
						"issu" => $issu, //purchase
						"sup" => $sup[1], //purchase
					
					);
				
			}

			

			
			
			
			
			
			
			
			
			
			
			
			
			$ch=$this->transactions->anyName('product_trans','invoice_id',$invoice,'id','dr',$debit,'cash','s');			
		
	
		if(!empty($ch)){
			
			$data=array(
			
				"amount" => $card,
				"by" => $admin,
				"noti" => 1,
				"date" => date('Y-m-d',strtotime($pdate)),
			
			);
			$this->db->where('id',$ch);
			$this->db->update('product_trans',$data);
			
		}
		else if(!empty($card)){
			
			
				
				$data=array(
			
				"dr" => $debit,
				"cr" => $credit,
				"trans" => 2,
				"ware" => $w,
				"cash" => 's',
				"type" => $ptype,
		"date" => date('Y-m-d',strtotime($pdate)),
				"invoice_id" => $invoice,
				"amount" => $card,
				"by" => $admin,
			
				);
			
		$this->db->insert('product_trans',$data);
			
			
		}
			
			
		



		$data=array(
		
				"date" => date('Y-m-d',strtotime($pdate)),
			"by" => $admin,
		
		);
		
		
		if($issu != 5)
		{
			
			
			$this->db->where('trans_id',$invoice);
			$this->db->where('ware',$w);
			
			$this->db->update('product',$data);
			
		}
		else
		{
			
			
			
		if(!empty($w))
		$this->db->where('ware',$w);
		$this->db->where('trans_id',$invoice);
		$this->db->update('issu',$data);
		
		
		
		$datas['all']=$this->transactions->getAll('issu','trans_id',$invoice);
		
	$ch=$this->transactions->anyName('invoice','invoice',$invoice,'noti');				
		
		if((int)$ch != 0)
		{
			
			$this->db->where('ware',$w);
			$this->db->where('trans_id',$invoice);
			$this->db->delete('product');
			
		}
		
		foreach($datas['all'] as $val)
			{
			
			
		
			
			
					$data=array(
		
						"d_id" => $sup[1],
						"c_id" => $val['code'],
				"amount" => ($val['pices']-$val['return_qun'])*$val['price'],
						"qun" => ($val['pices']-$val['return_qun']),
						"type" => 3,
						"ware" => $w,
				"date" => date('Y-m-d',strtotime($pdate)),
						"price" => $val['price'],
						"trans_id" => $invoice,
						"by" => $admin,
		
		);
		
		$this->db->insert('product',$data);
			
			}
		
		
			
		}
		

		
			
			echo json_encode($ara);
			
		}
		
		
		
		
		
		
		
		
	}
	public function getCode(){
		
		$this->load->database();
		$v=trim($_POST['v']);
		$w=$this->session->userdata('wire');
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
		
		$this->db->where('code',$v);
		$info=$this->db->get('product_ledger');
		
		$tabl=$info->row();
		
		
		$data=array(
		
			"code" => $tabl->code,
			"sell" => $tabl->selling_price,
			"buy" => $tabl->buy_price,
			"name" => $tabl->name,
		
		
		);
		
		echo json_encode($data);
		
		
		
	}
	public function product_delete(){
		
		
		 $this->load->model('transactions');
		
		$id=$_POST['id'];
		$ltype=$_POST['al'];
		
		
		$invoice=$_POST['invoice'];
		
		$this->db->where('id',$id);
		$this->db->delete('product');
		
		$col=null;
		$col2=null;
		
		
		if($ltype == 1){
			
			$col="cr";
			$col2="d_id";
			
		}
		else if($ltype == 2){
			
			$col="dr";
			$col2="c_id";
		
			}
		else if($ltype == 3 || $ltype == 12){
			
			$col="dr";
			$col2="c_id";
		
		}
		else if($ltype == 4)
			{
			
				
				$col="cr";
				$col2="d_id";
			}
		
$check=$this->transactions->getProductAddCheck('product_trans','invoice_id',$invoice,'type',$ltype,$col,'','');

$name=$this->transactions->getProductAddCheck('ledger','id',$check,'','','ledger_title');


$w = $this->session->userdata('wire');
				
	$this->db->where('ware',$w);
	$this->db->where('trans_id',$invoice);
	$this->db->where('type',$ltype);
	$info=$this->db->get('product');
		
		$response["posts"]= array();
		$response["supp"]= array();
		foreach($info->result_array() as $val)
				{
					
			$post= array();
			$post["id"]= $val["id"];
			$post["idd"]= $val[$col2];
			$post["trans_id"]= $val["trans_id"];
			
			if($ltype != 12)
			{
				
$post["name"]= $this->transactions->anyName('product_ledger','code',$val[$col2],'name');
$post["pcode"]= $this->transactions->anyName('product_ledger','code',$val[$col2],'ptype');
				
			}
			else{
				
				
			$post["name"]= $this->transactions->anyName('ledger','id',$val[$col2],'ledger_title');
			$post["pcode"]= 2;	
				
				
			}




			$post["amount"]= $val["amount"];
			$post["price"]= $val["price"];
			$post["qun"]= $val["qun"];
				
				array_push($response["posts"], $post);

				}
				
			
				$post= array();
				$post["sup"]= $name."*".$check;
				array_push($response["supp"], $post);
			
		echo json_encode($response);
		
		
	}
	public function product_update2(){
		
		
		 $this->load->model('transactions');
		
		
		$qun=$_POST['qun'];
		$id=$_POST['id'];
		$price=$_POST['price'];
		$invoice=$_POST['invoice'];
		
		$ty=$_POST['ty'];
		
		
		
		
		
		
		
		if($ty == 1 || $ty == 2)
		{
			if($ty == 1)
				$col="d_id";
			else
				$col="c_id";
			
	$u=$this->transactions->anyName('product','id',$id,$col);
			
			$pupdate=array(
			
				"uprice" => $price
			
			);
			
			
		
			
		$this->db->where('code',$u);
		$this->db->update('product_ledger',$pupdate);
		
		
		}
		
		$data=array(
		
			"qun" => $qun,
			"amount" => $qun*$price,
			"price" => $price,
		
		);
		
		$this->db->where('id',$id);
		$this->db->update('product',$data);
		
		
	$sum=$this->transactions->productSum('product',$invoice,'amount');	
		
		
		$ara=array(
		
			"price" => $sum
		
		);
		
		echo json_encode($ara);
	}
	
	public function go_invoice(){
		
		 $this->load->model('transactions');
		
		
		
		
		$admin=$this->session->userdata('admin');
		$w=$this->session->userdata('wire');
		
		if(empty($admin))
			redirect('admin');
		
		$id=$_POST['id'];
		$type=$_POST['type'];
		$ltype=$_POST['type_l'];
		$ware=$_POST['ware'];
		
		
		$col=null;
		$col2=null;
		
		
		
		if($ltype == 1){
			
			$col="cr";
			$col2="d_id";
			
		}
		else if($ltype == 2){
			
			$col="dr";
			$col2="c_id";
		
			}
		else if($ltype == 3 || $ltype == 12){
			
			$col="dr";
			$col2="c_id";
		
		}
		else if($ltype == 4)
			{
			
				
				$col="cr";
				$col2="d_id";
			}
		
$che=$this->transactions->getProductAddCheck('invoice','invoice',$id,'type',$ltype,'supplier','ware',$w);



$name=$this->transactions->anyName('ledger','id',$che,'ledger_title');


	
	$this->db->where('ware',$w);	
	$this->db->where('trans_id',$id);
	$this->db->where('type',$ltype);
	$info=$this->db->get('product');
		
		$response["posts"]= array();
		$response["supp"]= array();
		foreach($info->result_array() as $val)
				{
					
			$post= array();
			$post["id"]= $val["id"];
			$post["idd"]= $val[$col2];
			$post["trans_id"]= $val["trans_id"];
			
			if($ltype != 12)
			{
$post["name"]= $this->transactions->anyName('product_ledger','code',$val[$col2],'name');
$post["ptype"]= $this->transactions->anyName('product_ledger','code',$val[$col2],'ptype');
			}
			else{
				
$post["name"]= $this->transactions->anyName('ledger','id',$val[$col2],'ledger_title');
$post["ptype"]= 0;
				
			}
			$post["amount"]= $val["amount"];
			$post["price"]= $val["price"];
			$post["qun"]= $val["qun"];
				
				array_push($response["posts"], $post);

				}
				
			
				$post= array();
				$post["sup"]= $name."*".$che;
				array_push($response["supp"], $post);
			
		echo json_encode($response);



		
		
		
	}
	
	
	
	
	
	
	public function product_add(){
		
		
		$admin = $this->session->userdata('admin');
		$ara=null;
		if(empty($admin))
		{
			$ara=array(
			
				"id" => 1
			
			);
			
		}
		else{
			
		


      $this->load->model('transactions');


		
		$w=$this->session->userdata('wire');
		
					$type=$_POST['type'];

			
			
			
			
			
		$invoice=$_POST['invoice'];
		
		
		
		$product=explode('*',$_POST['product']);
		$qun=$_POST['qun'];
		$price=$_POST['price'];
		$sup=explode('*',$_POST['supp']);
		
		
$store= $this->transactions->anyName('invoice','invoice',$invoice,'store');

$invoice_check= $this->transactions->anyName('invoice','invoice',$invoice,'id');

if(empty($invoice_check)){
    
    
    $data=array(
        
        
            "invoice" => $invoice,
            "date" => date('Y-m-d'),
            "ware" => $w,
            "type" => $type,
            "issu" => $type,
            "supplier" => $sup[1],
        
        );
        
        $this->db->insert("invoice",$data);
    
    
}	


if(empty($price)){
    
    $price= $this->transactions->anyName('product_ledger','code',$product[1],'selling_price');

    
}

		
		$col=null;
		
		
		if($type == 1){
			
			$debit=$product[1];
			$credit=$sup[1];
			$col="d_id";

		}
		else if($type == 2){
			
			$credit=$product[1];
			$debit=$sup[1];
			$col="c_id";
		}
		else if($type == 3 || $type == 12)
			{
			
				$credit=$product[1];
			$debit=$sup[1];
			$col="c_id";
			
			}
		else if($type == 4){
			
			$debit=$product[1];
			$credit=$sup[1];
			$col="d_id";
			
		}
		
		
$check=$this->transactions->getProductAddCheck('product','trans_id',$invoice,$col,$product[1],'id','type',$type);



		

		

	if(!empty($check)){
		
		$this->db->where('trans_id',$invoice);
		$this->db->where($col,$product[1]);
		$this->db->where('type',$type);
		if(!empty($w))
	$this->db->where('ware',$w);

		$info=$this->db->get('product');
		$row = $info->row();
		
		$total=$row->qun;
		
		$data=array(
		
			"amount" => ($row->qun+$qun)*$price,
			"qun" => ($row->qun+$qun),
			"price" => $price,
			"by" => $admin,
		
		);
		$this->db->where($col,$product[1]);
		$this->db->where('type',$type);
		$this->db->where('trans_id',$invoice);
		if(!empty($w))
	$this->db->where('ware',$w);
		$this->db->update('product',$data);
		

		
		
	}
	else{
		
		
		
		
		
		$data=array(
		
			"d_id" => $debit,
			"c_id" => $credit,
			"amount" => $price*$qun,
			"qun" => $qun,
			"type" => $type,
			"price" => $price,
			"trans_id" => $invoice,
			"by" => $admin,
			"ware" => $w,
			"store" => $store,
		
		);
		
		$this->db->insert('product',$data);
		
		
		
		
		
	}
	
			$ara=array(
			
				"id" => 2
			
			);


	
		}
		
	
		
		if(!empty($w))
			$this->db->where('ware', $w);
		
		
		$this->db->where('trans_id',$invoice);
		$this->db->where('type',$type);
		$info=$this->db->get('product');
		
		$response["posts"]= array();
		foreach($info->result_array() as $val)
				{
					
			$post= array();
			$post["id"]= $val["id"];
			$post["idd"]= $val[$col];
			$post["type"]= $val['type'];
			$post["trans_id"]= $val["trans_id"];
			
				if($type == 12)
					{
$post["name"]= $this->transactions->anyName('ledger','id',$val[$col],'ledger_title');
$post["ptype"]= 0;				
					
					}
				else{
					
					
					$post["name"]= $this->transactions->anyName('product_ledger','code',$val[$col],'name');
$post["ptype"]= $this->transactions->anyName('product_ledger','code',$val[$col],'ptype');
					
				}
			

			$post["amount"]= $val["amount"];
			$post["price"]= $val["price"];
			$post["qun"]= $val["qun"];
				
				array_push($response["posts"], $post);

				}
		echo json_encode($response);
		
		
		
		
		
		
	}
	public function getProductPriceType()
		{
			
			$this->load->model('transactions');
			
		
			$pro=explode('*',$_POST['product']);
			$type=$_POST['ty'];
			
			if($type == 1 || $type == 2)
				$price=$this->transactions->anyName('product_ledger','code',$pro[1],'buy_price');
			
			else
				$price=$this->transactions->anyName('product_ledger','code',$pro[1],'selling_price');
			
			
			
			$name=$this->transactions->anyName('product_ledger','code',$pro[1],'ptype');
			$ara=null;
			
			
			
			
			if(!empty($price)){
				
				$ara=array(
				
					"id" => $name,
					"price" => $price,
				
				);
			}
			else{
				
				$ara=array(
				
					"id" => 3
				
				);
			}
		
		
		echo json_encode($ara);
		
		
		}
	public function new_purchase(){
		
		
		$admin = $this->session->userdata('admin');
		$w=$this->session->userdata('wire');
		
		if(empty($admin))
			redirect('admin');
		
		$id=$_POST['invoice'];
		$date=$_POST['date'];
		$type=$_POST['type'];
		$store=$_POST['store'];
		$sup=explode('*',$_POST['supp']);
		
		$ara=null;
		
	
		$this->load->model('setting');
		
		$check=$this->setting->anyName('invoice','invoice',$id,'id');
		
		if(empty($admin))
			{
			
				$ara=array("id" => 1);
			
			}
			
		else if(!empty($check)){
			
				$ara=array("id" => 3);
			
			
		}	
			
		else
			{
				
				
				
				
			$dr=0;
			$cr=0;
			$types=0;
			if($type == 1){
				
				$dr=5;
				$cr=$sup[1];
				$types=1;
			}
			else if($type == 12){
				
				$dr=$sup[1];
				$cr=386;
				$types=12;
				
			}
			else if($type == 2){
				
				$dr=$sup[1];
				$cr=5;
				$types=2;
				
			}
			else if($type == 3 || $type == 5){
				
				$dr=$sup[1];
				$cr=204;
				$types=3;
				
			}
			
			else if($type == 6){
				
				$cr=$sup[1];
				$dr=204;
				$types=6;
			}
			else if($type == 4){
				
				$dr=204;
				$cr=$sup[1];
				$types=4;
				
			}
		
				
				if($type != 5){
					
					$data=array
					(
			
					"dr" => $dr,
					"cr" => $cr,
					"type" => $types,
					"invoice_id" => $id,
					"amount" => 0,
					"ware" => $w,
					"by" => $admin,
					"store" => $store,
					
					
					);
			
				$this->db->insert('product_trans',$data);
					
				}
					
			
	
				$data=array(
	
					"invoice" => $id,
					"type" => $types,
					"issu" => $type,
					"by" => $admin,
					"ware" => $w,
					"supplier" => $sup[1],
					"store" => $store,

	
							);

	$this->db->insert('invoice',$data);
	
			$ara=array("id" => 2);
			
			
		}
		
	
	echo json_encode($ara);


	
		
	}
	
	public function getProductList(){
		
		$admin = $this->session->userdata('admin');
		
		$id=$_POST['id'];
		
		
		$w=$this->session->userdata('wire');
		
		
	$info=$this->db->query("select * from product_ledger where (name like '%$id%' or code like '%$id%') and ware='$w'");	
		
		//if(!empty($w))
		//	$this->db->where("(ware='".$w."' OR ware='0')");
	
		
//$this->db->like("(code='".$id."' OR name='".$id."')");
		
		//$this->db->like('code', $id); 
		//$this->db->like('name', $id);		
		//$info=$this->db->get('product_ledger');
		
		
		
		
		$data=array();
		foreach($info->result_array() as $val)
		{
			array_push($data,$val['name']."*".$val['code']);
		}
		echo json_encode($data);
		
	}
	public function update_barcode(){
		
		$i=$_POST['i'];
		
		$w=$this->session->userdata('wire');

		if(!empty($w)){
			
			
				$data=array(
				
					"barcode" => $i
				
				);
			
			$this->db->where('id',$w);
			$this->db->update('ware',$data);
			
			$this->session->unset_userdata('barcode');
			
			$this->session->set_userdata('barcode',$i);

			
			
			
			
		}
		
		echo 1;
		
		
		
	}
	
	
	public function getSupplierList()
	{
		
		$id=$_POST['val'];
		$t=$_POST['t'];
		
		
		
		
		
		
		$w=$this->session->userdata('wire');
		
		
		
		
		
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
		
		
		
		
		
		$this->db->where("(sup='s' OR cus='c')");
	
		$this->db->like('ledger_title', $id); 
		$info=$this->db->get('ledger');
		
		
		$data=array();
		foreach($info->result_array() as $val)
		{
			array_push($data,$val['ledger_title']."*".$val['id']);
		}
		echo json_encode($data);
		
		
	}
	
	
	
	public function getNotification(){
		

		$this->load->database();
		$this->load->model("setting");
		
		
		$admin = $this->session->userdata('admin');
		$w = $this->session->userdata('wire');
		
		if(empty($admin))
				redirect('admin');
		
		
		$show=$_POST['show'];
		$type=$_POST['type'];
		
		$ara=null;
		if(empty($admin)){
			
			$ara=array("id" => 1);
			
			echo json_encode($ara);
		}
		else{
		
		
				$response["posts"]= array();

		
		if($type == 10)
		{
			$this->db->distinct();
			
			$this->db->select('voucher');
			$this->db->where('status',1);
			if(!empty($w))
			$this->db->where('ware',$w);
			$info=$this->db->get('product_trans');
			
			
			foreach($info->result_array() as $val)
				{
					
					$post= array();
					//$post["id"]= $val["id"];
					$post["voucher"]= $val["voucher"];				
									
				array_push($response["posts"], $post);

				}
			
		}
		
		
		else{
		
		
		
		
		if(!empty($w))
			$this->db->where('ware',$w);
		
		
		$this->db->where('noti',0);
		$this->db->where('issu',$type);
		
		
		
		$info=$this->db->get('invoice');
		
		foreach($info->result_array() as $val)
				{
					
			$post= array();
			$post["id"]= $val["id"];
			$post["invoice_id"]= $val["invoice"];				
			$post["type"]= $val["issu"];		
			$post["sname"]= $this->setting->anyName('store_list','id',$val['store'],'name');				
			
			$post["ware"]= $val["ware"];				
				array_push($response["posts"], $post);

				}
				
				
		}
		echo json_encode($response);
			
		}
		
		
	}
	
	
	
}



 ?>