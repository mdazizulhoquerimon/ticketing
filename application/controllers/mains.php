<?php


	class Mains extends CI_Controller{
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('report_model');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library("pagination");
			

	$admin_user = $this->session->userdata('admin');
		if(empty($admin_user))
		{	
		redirect('member/adminlogin');
		}
			
		}
	
	public function view_transfered_invoice($inv,$w){
		
	$data['type']=0;				
	$this->load->view('home/headar',$data);	
	
	$data['inv']=$inv;
	$data['wname']=$this->report_model->getPname('ware','id',$w,'name');
	
	$data['all']=$this->report_model->getindInvoiceWare('invoice','invoice',$inv,"ware",$w);
	$data['pro']=$this->report_model->getindInvoiceWare('product','trans_id',$inv,"ware",$w);
	$this->load->view('home/view_transfered_invoice',$data);
	$this->load->view('home/footer');
	
		
		
	}

	
	public function confirm_transfer()
	{
		
		$w = $this->session->userdata('wire');
	
		$date_time = new DateTime('now', new DateTimezone('Asia/Dhaka'));
		$hours=$date_time->format('G'); 
	    $com=$date_time->format('Y-m-d G:i:s');
		 	
		
		$in=$_POST['invoice'];
		$gross=$_POST['gross'];
		
		
		
		$data=array(
		
			 "gross_amount" => $gross, 
			 "noti" => 1,
			 "pdate" => date('Y-m-d'),
			 "con_time" => $com,
		
		);
		
		
		$this->db->where('invoice',$in);
		$this->db->where('ware',$w);
		$this->db->update('invoice',$data);
		
		
		
		
		
		$data=array(
		
			 "amount" => $gross,
		
		);
		
		$this->db->where('invoice_id',$in);
		$this->db->where('ware',$w);
		$this->db->update('product_trans',$data);		
		
		
		
		echo "1";
		
		
		
		
		
	}
	public function product_add_transfer()
	{
	    
		$date_time = new DateTime('now', new DateTimezone('Asia/Dhaka'));
		$hours=$date_time->format('G'); 
	    $com=$date_time->format('Y-m-d G:i:s');
		
		
		$admin = $this->session->userdata('admin');
		 $this->load->model('setting');

		$invoice=$_POST['invoice'];
		$qun=$_POST['qun'];
		$price=$_POST['price'];
		$product=explode('*',$_POST['pro']);
		
$w=$this->session->userdata('wire');
$c=$this->setting->anyName('invoice','invoice',$invoice,'to_ware');		
$curr=$this->setting->anyName('ledger','trans_w_l',$c,'id');		
$check=$this->setting->anyName('product','trans_id',$invoice,"id","c_id",$product[1]);

if(empty($check))
{
	
	$data=array(
		
			"d_id" => $curr,
			"c_id" => $product[1],
			"amount" => ($price*$qun),
			"qun" => $qun,
			"type" => 13,
			"price" => $price,
			"trans_id" => $invoice,
			"by" => $admin,
			"con_time" => $hours,
			"ware" => $w,
		
		);
		
		$this->db->insert('product',$data);
	
	
	
}
else{
	
	
	$this->db->where('trans_id',$invoice);
	$this->db->where('c_id',$product[1]);
	$this->db->where('type',13);
	//if(!empty($w))
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
		$this->db->where('id',$check);
		$this->db->where('trans_id',$invoice);
		//if(!empty($w))
		$this->db->where('ware',$w);
		$this->db->update('product',$data);
	
	
	
}

			$this->getProductListTrnasfer($invoice,$w);
		
	}
public function invoice_delete_trans(){
	
	$invoice=$_POST['id'];
	$w=$_POST['w'];
	
	$this->db->where('trans_id',$invoice);
	$this->db->where('ware',$w);
	$this->db->delete("product");
	
	$this->db->where('invoice_id',$invoice);
	$this->db->where('ware',$w);
	$this->db->delete("product_trans");
	
	$this->db->where('invoice',$invoice);
	$this->db->where('ware',$w);
	$this->db->delete("invoice");
	
	echo 1;
	
	
}

public function getPendingInvoice(){
		
		
		$invoice=$_POST['id'];
		$w=$_POST['w'];
		
		$this->getProductListTrnasfer($invoice,$w);
		
	}
	public function getProductListTrnasfer($invoice,$w){
		
				 $this->load->model('setting');

	   $this->db->where('trans_id',$invoice);
       $this->db->where('ware',$w);
		$info=$this->db->get('product');
		$response["posts"]= array();


                $response["inv"]= array();
                $post= array();
				$post["id"]= $invoice;
                array_push($response["inv"], $post); 


		foreach($info->result_array() as $val)
				{
					
			$post= array();		
			$post["id"]= $val["id"];
			$post["idd"]= $val['c_id'];
			$post["type"]= $val['type'];
			$post["trans_id"]= $val["trans_id"];	
			$post["name"]= $this->setting->anyName('product_ledger','code',$val['c_id'],'name');
			$post["ptype"]= $this->setting->anyName('product_ledger','code',$val['c_id'],'ptype');
			$post['code']=$val['c_id'];
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
			$inv=$_POST['inv'];
			
			
			
	$price=$this->transactions->anyName('product_ledger','code',$pro[1],'selling_price');
			
			
			
			$name=$this->transactions->anyName('product_ledger','code',$pro[1],'ptype');
			$ara=null;
			
			$d=0;
			$c=0;
			
		/*	if(!empty($inv)){
				
				
				$d=$this->transactions->getQuantity('product','d_id',$pro[1],'trans_id',$inv,'4');
				$c=$this->transactions->getQuantity('product','c_id',$pro[1],'trans_id',$inv,'3');
				
				
				
				
				
				
			}
			
			*/
			
			
			if(!empty($price)){
				
				$ara=array(
				
					"id" => $type,
					"price" => $price,
				     "return" => ($c - $d)
				);
			}
			else{
				
				$ara=array(
				
					"id" => 3,
					"return" => 0,
					"price" => 0
				
				);
			}
		
		
		echo json_encode($ara);
		
		
		}		
public function transfer_all_product()
	{
		
      $this->load->model('setting');
       $invoice=$_POST['id'];
       $w=$_POST['w'];
		
	$this->db->where('trans_id',$invoice);
    $this->db->where('ware',$w);
	$info=$this->db->get('product');
	$response["posts"]= array();
	foreach($info->result_array() as $val)
		{
					
			$post= array();		
			$post["id"]= $val["id"];
			$post["idd"]= $val['c_id'];
			$post["type"]= $val['type'];
			$post["trans_id"]= $val["trans_id"];	
			$post["name"]= $this->setting->anyName('product_ledger','code',$val['c_id'],'name');
			$post["ptype"]= $this->setting->anyName('product_ledger','code',$val['c_id'],'ptype');
			$post['code']=$val['c_id'];
			$post["amount"]= $val["amount"];
			$post["price"]= $val["price"];
			$post["qun"]= $val["qun"];
				
		    array_push($response["posts"], $post);

				}
		echo json_encode($response);
		
		
		
		
		
	}	
		
		
    public function getReportTransferDate()
		{
			
		$response["trans"]= array();
	$w = $this->session->userdata('wire');
	
	$this->load->model('setting');
	
		$start=date('Y-m-d',strtotime($_POST['start']));
		$end=date('Y-m-d',strtotime($_POST['end']));
		$op=$_POST['op'];
	
	
	/*	if(!empty($op) && $op == 1)
			$this->db->where('ap_date','0000-00-00');
		else if(!empty($op) && $op == 2)
			$this->db->where('ap_date !=','0000-00-00');
			*/
			
		if(!empty($op) && $op == 1)	
					$this->db->where('noti',0);
		else if(!empty($op) && $op == 2)
					$this->db->where('noti',1);

		$this->db->where('date >=',$start);
		$this->db->where('date <=',$end);	
		$this->db->order_by('invoice','desc');
		$this->db->where('type',13);
		//$this->db->where("(ware='".$w."' OR to_ware='".$w."')");
		$this->db->where("(ware='".$w."')");
		$infos=$this->db->get('invoice');
		
		foreach($infos->result_array() as $val)
		{
					
			$post= array();
			$post["id"]= $val["id"];
			$post["invoice_id"]= $val["invoice"];				
			$post["from"]= $val["to_ware"];				
			$post["ware"]= $val["ware"];
			$post["approve"]= $val["approve"];
			$post["pdate"]= $val["pdate"];
			$post["noti"]= $val["noti"];
			$post["date"]= $val["date"];			
			$post['receive']=$this->setting->getPname('ware','id',$val["ware"],'name');
			$post['send']=$this->setting->getPname('ware','id',$val['to_ware'],'name');

			$post["w"]= $w;				
			array_push($response["trans"], $post);	
					
					
					
		}	
			
		
	echo json_encode($response);


		
			
		}
	public function trans_invoice(){
		
		
		$date_time = new DateTime('now', new DateTimezone('Asia/Dhaka'));
		$hours=$date_time->format('G'); 
	    $com=$date_time->format('Y-m-d G:i:s');
		 	
		
		
		$admin = $this->session->userdata('admin');
		$w=$this->session->userdata('wire');
		
		if(empty($admin))
			redirect('admin');
		
	
		$store=$_POST['i'];
		
	//	$id=$_POST['ins'];	
		
		$date=$_POST['date'];	
		
$this->load->model('setting');	
$id=($this->setting->getMax('invoice','invoice'))+1;

$check=$this->setting->anyName('invoice','invoice',$id,'id');

$curr_cus=$this->setting->anyName('ledger','trans_w_l',$store,'id','cus','c');

//if($store != 426)	
	//$wares=$this->setting->anyNameCustomer('ledger','id',$store,'ware');

	
	
	if(!empty($check)){
			
				$ara=array("id" => 1);//alreay inserted
			
			
		}
	else if(empty($curr_cus)){
			
				$ara=array("id" => 3);//alreay inserted
			
			
		}
      else{
		  
		  	$data=array(
	
					"invoice" => $id,
					"type" => 13,
					"issu" =>13,
					"by" => $admin,
					"ware" => $w,
					"supplier" => $curr_cus,
					"pdate" => date('Y-m-d'),
					"date" => date('Y-m-d',strtotime($date)),
					"to_ware" => $store,
					"con_time" => $com,
	
					);

	$this->db->insert('invoice',$data);	
		  
		$data=array
		(
			"cr" => 426,
			"dr" => $curr_cus,
			"type" => 13,
			"invoice_id" => $id,
			"amount" => 0,
			"ware" => $w,
			"by" => $admin,
			"con_time" => $hours,
			
		);
			
		$this->db->insert('product_trans',$data);
					
		
					
			
	

		  
		$ara=array(
		
		"id" => $curr_cus,
		"invoice" => $id,
		
		);//new  inserted  
		  

	  }		
	
	
		
				  	echo json_encode($ara);

		
		
		
	}
	public function product_transfer(){
			
			
			$this->load->model('setting');
		
		
		$w=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
	$this->load->model('setting');	
	$data['store']=$this->setting->getConnectLessWare('connectware','','','',"cuware",$w);
		
		$data['type']=0;		
		
	$this->load->view('home/headar',$data);
	$this->load->view('setting/product_transfer',$data);
	$this->load->view('home/footer');
		
			
			
			
		}	
	public function update_setting()
	{
		
		$id=$_POST["id"];
		$name=$_POST["name"];
		$note=$_POST["note"];
		$move=explode("*",$_POST["move"]);
		
		if(!empty($move[1]))
		{
		$head=$move[1];
			
		}
		else
			$head=$this->report_model->anyName("setting","id",$id,"head");
			
			$ob=$this->report_model->anyName("setting","id",$id,"ob");
		
		$data=array(
		
		
			"name" => $name,
			"note" => $note,
			"head" => $head,
		
		);
		
		
		$this->db->where("id",$id);
		$this->db->update("setting",$data);
		
		$data=array(
		
			"id" => $id,
			"head" => $head,
			"ob" => $ob,
		
		);
		
		echo json_encode($data);
		
		
	}
		
		
		public function getSetting(){
		
		$admin = $this->session->userdata('admin');
		
		$id=$_POST['id'];
	
		
		$w=$this->session->userdata('wire');
	
		
		if(!empty($w))
		{
			$this->db->where("(ware='".$w."' OR ware='0')");
		}	
		$this->db->like('name', $id); 
		
		$info=$this->db->get('setting');
		
		
		$data=array();
		foreach($info->result_array() as $val)
		{
			array_push($data,$val['name']."*".$val['id']);
		}
		echo json_encode($data);
		
		
	}
		
		
		public function loadFile($id=null)
	{
		
		
				$data["name"]=$this->report_model->anyName("setting","id",$id,"note");
				$data["id"]=$id;
		
			    $this->load->view('home/dropdown',$data);   
		
		
	}
		
		public function indi_invoice(){
		
		$data['type']=0;
		$data['edit']=0;
		$data['links']='';
		$this->load->view('home/headar',$data);
		
		$inv=$this->input->post('inv');
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin = $this->session->userdata('admin');
		
		if(empty($admin))
			redirect('admin');
		
		
	$data['all']=$this->report_model->getindInvoice('invoice','invoice',$inv);
	
	$data['start_date']=date('Y-m-d');	
	$data['end_date']=date('Y-m-d');	
	$this->load->view('report/daily_sale_report',$data);
	$this->load->view('home/footer');
		
	}


public function cs()
		{
			
			$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin = $this->session->userdata('admin');
		
		
		 $this->load->model('setting');
		
		
		if(empty($admin))
				redirect('admin');
		
		
		$data['type']=0;

			$this->load->view('home/headar',$data);

		
			$this->load->view('report/cs');
		
	//$data['max']=$this->setting->getMax('invoice','invoice');
	////$data['bank']=$this->setting->getBank('ledger');	
	//$this->load->view('admin/purchase',$data);
		
		
		
		
		
		
		$this->load->view('home/footer');
			
			
		}
		
		public function invoice_edit($id,$ltype,$sup){
		
		
		$admin=$this->session->userdata('admin');
		$w=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		
		if(empty($admin))
			redirect('admin');
		
		$data['type']=0;
		
$data['store']=$this->report_model->getAll('store_list');

				$this->load->view('home/headar',$data);	
					
				//}
		
		
		
		
		
		$data['col']=null;
		$data['col2']=null;
		$table=null;
		
		$data['type']=$ltype;
		$data['invoice']=$id;
		$data['date']=$this->report_model->anyName('invoice','invoice',$id,'date','ware',$w);
		$data['sts']=$this->report_model->anyName('invoice','invoice',$id,'store');
		
		
		if((int)$ltype == 1){
			
			$data['col']="cr";
			$data['col2']="d_id";
			$table="supplier";
		}
		else if((int)$ltype == 2){
			
			$data['col']="dr";
			$data['col2']="c_id";
		$table="supplier";
			}
		else if((int)$ltype == 3 || (int)$ltype == 12){
			
			$data['col']="dr";
			$data['col2']="c_id";
			$table="customer";
		}
		else if((int)$ltype == 4)
			{
			
				$table="customer";
				$data['col']="cr";
				$data['col2']="d_id";
			}
		

		$check=$this->report_model->anyName('invoice','invoice',$id,'date');
		
		$data['date']=$check;
		$data['cus']=$this->report_model->anyName('ledger','id',$sup,'ledger_title')."*".$sup;


		
		//$w = $this->session->userdata('wire');
		
		
	
		
		$this->db->where('issu',(int)$ltype);

		$this->db->where('ware',$w);
		$this->db->where('invoice',$id);
		$invoice=$this->db->get('invoice');
		
		
		$data['invo']=$invoice->result_array();

		$data['bank']=$this->report_model->getBank('ledger');
		
		
		
		
		if((int)$ltype != 5){
			
			
			
			
		$this->db->where('ware',$w);
		$this->db->where('trans_id',$id);
		$this->db->where('type',$ltype);
		$info=$this->db->get('product');
		
		
		$data['product']=$info->result_array();	
		$this->load->view('admin/invoice_edit',$data);

			
		}
	
		else{
			
			$data['type']=3;
			
			$this->db->where('ware',$w);
		$this->db->where('trans_id',$id);
		$info=$this->db->get('issu');
		
		
		$data['product']=$info->result_array();
			
		$this->load->view('admin/issu_edit',$data);	
	
			
		}



		$this->load->view('home/footer');
		
		
	}
		
		
		public function invoice_delete($id)
		{
			$w=$this->session->userdata('wire');
			
			if(empty($w))
				redirect('admin');
			
			$this->db->where('ware',$w);
			$this->db->where('invoice',$id);
			$this->db->delete('invoice');
			
			
			
			$this->db->where('ware',$w);
			$this->db->where('trans_id',$id);
			$this->db->delete('issu');
			
			
			
			$this->db->where('ware',$w);
			$this->db->where('trans_id',$id);
			$this->db->delete('product');
			
			
			
			$this->db->where('ware',$w);
			$this->db->where('invoice_id',$id);
			$this->db->delete('product_trans');
			
			
			
			redirect('mains/daily_sale_report');
			
		}
	public function transfered_invoice($types=null,$starts=null,$ends=null){
		
		$w=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin = $this->session->userdata('admin');
		
		if(empty($admin))
			redirect('admin');
		
		
		
		
		$data['type']=0;
		$data['edit']=0;
				
		$this->load->view('home/headar',$data);

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('start_date','start_date', 'required');
		$this->form_validation->set_rules('end_date','end_date', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{	
	
		$data['start_date']=date('Y-m-d');
		$data['end_date']=date('Y-m-d');
		
		//$data['type']=$this->input->post('type');

	}
	else{
		
		
		
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		
		$data['type']=$this->input->post('type');
		
		$data['start_date']=$start_date;
		$data['end_date']=$end_date;	
		
		
		
		
	}


		$config = array();
        $config["base_url"] = base_url() . "mains/transfered_invoice";
		$config["total_rows"] = $this->report_model->all_count_trans('invoice','to_ware',$w,$data['start_date'],$data['end_date'],$data['type'],'type',13);
         $config["per_page"] = 15;
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE;
		
		
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		
		
		
		$config['first_link'] = 'First';
        $config["uri_segment"] = 3;
$config['last_link'] = 'LAST';
$config['next_link'] = '...NEXT';
		$config['prev_link'] = 'PREV...';

				$config['full_tag_open'] = '<div id="pagination">';
$config['full_tag_close'] = '</div>';
$config['anchor_class'] = 'class="number" ';
		$config['use_page_numbers'] = TRUE;
		
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
		
		$limit = $config["per_page"];
	 if ($page!=0)
            {
              $page = ($page * $limit)-$limit;
            }
            else
            {
              $page= 0;
            }
	
     
	
	
	
	$data['all']=$this->report_model->pagination_trans('invoice','to_ware',$w,$config["per_page"], $page,$data['type'],'type',13);





	
		

	$data["links"] = $this->pagination->create_links();

	
	$this->load->view('report/transfered_invoice',$data);
	$this->load->view('home/footer');	
		
		
	}	
	public function daily_sale_report($types=null,$starts=null,$ends=null)
	{
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin = $this->session->userdata('admin');
		
		if(empty($admin))
			redirect('admin');
		
		
		
		
		$data['type']=0;
		$data['edit']=0;
				
		$this->load->view('home/headar',$data);

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('start_date','start_date', 'required');
		$this->form_validation->set_rules('end_date','end_date', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{	
	
		$data['start_date']=date('Y-m-d');
		$data['end_date']=date('Y-m-d');
		
		//$data['type']=$this->input->post('type');

	}
	else{
		
		
		
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		
		$data['type']=$this->input->post('type');
		
		$data['start_date']=$start_date;
		$data['end_date']=$end_date;	
		
		
		
		
	}
	

             if((int)$data['type'] == 6)
	                              {
		
		
		
	$data['all']=$this->report_model->getPending('invoice',$data['start_date'],$data['end_date'],'','noti','0');
		
		
		
		
	                               }
                                       else{




		$config = array();
        $config["base_url"] = base_url() . "mains/daily_sale_report";
		$config["total_rows"] = $this->report_model->all_count('invoice','','',$data['start_date'],$data['end_date'],$data['type'],'type !=',13);
         $config["per_page"] = 15;
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE;
		
		
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		
		
		
		$config['first_link'] = 'First';
        $config["uri_segment"] = 3;
$config['last_link'] = 'LAST';
$config['next_link'] = '...NEXT';
		$config['prev_link'] = 'PREV...';

				$config['full_tag_open'] = '<div id="pagination">';
$config['full_tag_close'] = '</div>';
$config['anchor_class'] = 'class="number" ';
		$config['use_page_numbers'] = TRUE;
		
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
		
		$limit = $config["per_page"];
	 if ($page!=0)
            {
              $page = ($page * $limit)-$limit;
            }
            else
            {
              $page= 0;
            }
	
     
	
	
	
	
	$data['all']=$this->report_model->pagination('invoice','','',$config["per_page"], $page,$data['type'],'type !=',13);







                                                }




	
		

	$data["links"] = $this->pagination->create_links();

	
	$this->load->view('report/daily_sale_report',$data);
	$this->load->view('home/footer');	
		
	}	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
public function product_report(){
		
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		
		if(empty($admin))
			redirect('admin');

		$data['type']=0;
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ledger_id','ledger_id', 'required');
		$this->form_validation->set_rules('start_date','start_date', 'required');
		$this->form_validation->set_rules('end_date','end_date', 'required');
		if ($this->form_validation->run() === FALSE)
			{
		
	
	$this->load->view('home/headar',$data);
				//}	
		$data['start']=date('Y-m-d');
		$data['end']=date('Y-m-d');
		
			
			$this->load->view('report/product_ledger',$data);
			$this->load->view('home/footer');
		
		
		
		
			}
		else{
			
				
			
			
			$code=explode('*',$this->input->post('ledger_id'));
			
			$data['start']=$this->input->post('start_date');
			$data['end']=$this->input->post('end_date');
			
			
	$data['name']=$code[0];
	$data['code']=$code[1];
	
	$data['all']=$this->report_model->getAllProductTransList('product',$code[1],$data['start'],$data['end']);
	
	
	

	
			$this->load->view('report/report_header2');
			
			$this->load->view('admin/product_report_prints',$data);

			
			$this->load->view('home/footer');
			
			
		}
		
	}

		
		public function stock_report_details($head=null,$start,$end,$one=null,$two=null,$th=null,$fo=null,$h=null,$store=null)
		{
		
			$admin = $this->session->userdata('admin');
			$type = $this->session->userdata('type');

			
			
					$data['sts']=$store;
		
				$data['store']=$this->report_model->getAll('store_list');

			
				if(empty($admin)){
					
					
					redirect('admin');
				}
	$data['type']=0;
	
	
	/*if($type == 3)
				{
					$data['all2']=$this->news_model->getMenuData($ware,$admin);
					$this->load->view('main/header2',$data);
				
				}
				else{
					*/
			$this->load->view('home/headar',$data);
					
				//}
		
	
		$data['start']=$start;
		$data['end']=$end;
		$data['head']=$head;
			$data['head2']=$h;
		$data["ch"]=array(
		
		$one,
		$two,
		$th,
		$fo,
		
		
		);
		
		

	$data['check']=1;
	$this->load->view('report/stock_by_value',$data);	
		
		
	$this->load->view('home/footer');

		

	
		
	}
	
		public function stock_summary_details($head=null,$start,$end,$sts=null){
		
			$admin = $this->session->userdata('admin');

				if(empty($admin)){
					
					
					redirect('admin');
				}
				
				$data["exe"]=false;
	
	$data['type']=0;
	$this->load->view('home/headar',$data);
	
	
		$data['start']=$start;
		$data['end']=$end;
		$data['head']=$head;
		
	$data['store']=$this->report_model->getAll('store_list');
	
	$data['sts']=$sts;
	$this->load->view('report/stock_by_summary',$data);	
		
		
	$this->load->view('home/footer');

		

	
		
	}
		
	public function stock_summary($head=null){
		
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin = $this->session->userdata('admin');

				if(empty($admin)){
					
					
					redirect('admin');
				}
		
	$data['type']=0;
	
$data['store']=$this->report_model->getAll('store_list');

			$this->load->view('home/headar',$data);
					
				//}
	
	$data["exe"]=false;
	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('start_date','start_date', 'required');
	$this->form_validation->set_rules('end_date','end_date', 'required');
		if($this->form_validation->run() === FALSE)
		{


			$data['start']=date('Y-m-d',strtotime('01-04-2016 '));
			$data['end']=date('Y-m-d');
			$data['head']=83;
			$data['sts']=0;
		

		}
		else{
		
			$data['start']=$this->input->post('start_date');
			$data['end']=$this->input->post('end_date');
			$data['head']=$head;
			$data['sts']=$this->input->post('store');
			$data["exe"]=true;

			}
	
	$this->load->view('report/stock_by_summary',$data);	
		
		
	$this->load->view('home/footer');
	
		
	}	
		
		
		
		
		
		public function stock_report($head=null,$h=null){
		
		$admin = $this->session->userdata('admin');
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		
		
				if(empty($admin))
					{

						redirect('admin');
						
					}
				
	$data['type']=0;
	
	
			$this->load->view('home/headar',$data);
					
				//}
			 $this->load->model('setting');

	$data['store']=$this->setting->getAll('store_list');


	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('start_date','start_date', 'required');
	$this->form_validation->set_rules('end_date','end_date', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{


		$data['start']=date('Y-m-d');
		$data['end']=date('Y-m-d');
		$data['check']=0;
		$data['head']=83;
		$data['head2']=0;
		
				$data['sts']=0;

		
		$data["ch"]=array(
		
			1,
			2,
			3,
			4,
		
		
		);

	}
	else{
		
		
		
		$data['start']=$this->input->post('start_date');
		$data['sts']=$this->input->post('store');
		$data['end']=$this->input->post('end_date');
		$data['head']=$head;
		$data['head2']=$h;
		$data["ch"]=array(
		
		$this->input->post('open'),
		$this->input->post('pur'),
		$this->input->post('sale'),
		$this->input->post('close'),
		
		
		);
		
		

		$data['check']=1;
		
		
		
	}
	
	$config = array();
        $config["base_url"] = base_url() . "mains/stock_report";
        $config["total_rows"] = $this->report_model->all_count('invoice');
       $config["per_page"] = 1;
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE;
		$config['first_link'] = 'First';
        $config["uri_segment"] = 5;
		$config['last_link'] = 'LAST';
		$config['next_link'] = '...NEXT';
		$config['prev_link'] = 'PREV...';
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['anchor_class'] = 'class="number" ';
		$config['use_page_numbers'] = TRUE;
		
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        
		
		if($page > 1)
		{
		
			
			$page=($page -1) * $config["per_page"];
		}
		else{
			
			$page=0;
		}
	
	
	
	
	$this->load->view('report/stock_by_value',$data);	
		
		
	$this->load->view('home/footer');
	
		
		
	}
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function income_statement(){
		
		
		//$ware=$this->session->userdata('wire');
		
		$data['type']=0;
		$data['ware']=$ware=$this->session->userdata('wire');
		
		$type=$this->session->userdata('type');
		$admin = $this->session->userdata('admin');
		
		
		/*if($type == 3)
				{
					$data['all2']=$this->news_model->getMenuData($ware,$admin);
					$this->load->view('main/header2',$data);
				
				}
				else{
					*/
					$this->load->view('home/headar',$data);
				//}

				
		//$this->load->view('main/header',$data);
	
	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('start_date','start_date', 'required');
	$this->form_validation->set_rules('end_date','end_date', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{

		$data['start']=date('Y-m-d');
		$data['end']=date('Y-m-d');

		
		$data['start_b']= date('Y-m-d',strtotime('01-04-2016'));
		$data['end_b']= date('Y-m-d',strtotime('01-04-2016'));
	}
	else{
		
		$data['start']=$this->input->post('start_date');
		$data['end']=$this->input->post('end_date');
		
		
		$data['start_b']= date('Y-m-d',strtotime('01-04-2016'));
		$data['end_b']= date('Y-m-d',strtotime('01-04-2016'));
		
	}
		
	
		
	$this->load->view('admin/income_statement',$data);
	$this->load->view('home/footer');
		
	}
		
		public function balance_sheet_details($id=null,$type=null,$s=null,$e=null)
		{
			
			$data['ware']=$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		
		if(empty($admin))
			redirect('admin');

		$data['type']=0;
		/*if($type == 3)
				{
					$data['all2']=$this->news_model->getMenuData($ware,$admin);
					$this->load->view('main/header2',$data);
				
				}
				else{*/
					
			$this->load->view('home/headar',$data);
					
				//}
			
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('start_date','start_date', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{


  


		if(!empty($s)){
			
			$data['start']= date('Y-m-d',strtotime($s));
			$data['end']= date('Y-m-d',strtotime($e));
			
		}
		else{
			
			$data['start']= date('Y-m-d',strtotime('01-04-2016'));
			$data['end']=date('Y-m-d');
			
			
			
			
			
		}

		

		
		
		$data['start_b']= date('Y-m-d',strtotime('01-03-2016'));
		$data['end_b']= date('Y-m-d',strtotime('01-03-2016'));
	}
	else{
		
		$data['start']=date('Y-m-d',strtotime('01-04-2016'));
		$data['end']=$this->input->post('start_date');
		
		
		$data['start_b']= date('Y-m-d',strtotime('01-04-2016'));
		$data['end_b']= date('Y-m-d',strtotime('01-04-2016'));
		
	}
			
			
			$data['id']=$id;
			$data['type']=$type;
			
			$this->load->view('admin/balance_sheet_details',$data);
			$this->load->view('home/footer');	
			
			
		}
		
		
		
		
		
		
		
		
		public function income_statement2()
	{
		
		$data['ware']=$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		
		if(empty($admin))
			redirect('admin');

		$data['type']=0;
		/*if($type == 3)
				{
					$data['all2']=$this->news_model->getMenuData($ware,$admin);
					$this->load->view('main/header2',$data);
				
				}
				else{*/
					
			$this->load->view('home/headar',$data);
					
				//}
	
	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('start_date','start_date', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{

		$data['start']='2015-1-1';
		$data['end']=date('Y-m-d');

		
		$data['start_b']= date('Y-m-d',strtotime($data['start'] . ' - 1 year'));
		$data['end_b']= date('Y-m-d',strtotime($data['end'] . ' - 1 year'));
	}
	else{
		
		$data['start']='2015-1-1';
		$data['end']=$this->input->post('start_date');
		
		
		$data['start_b']= date('Y-m-d',strtotime($data['start'] . ' - 1 year'));
		$data['end_b']= date('Y-m-d',strtotime($data['end'] . ' - 1 year'));
		
	}
		
	
		
	$this->load->view('admin/income_statement2',$data);
	$this->load->view('home/footer');
	}
		
		
		
		public function balance_sheet_details_nav($id=null,$typss=null,$head,$start=null,$end=null)
			{
			
			$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		$data['id']=$id;
			
			$data['head']=$head;
			
			
			
			
			
		if(empty($admin))
			redirect('admin');

		$data['type']=0;
		
			$this->load->view('home/headar',$data);
					
				//}
			
			$data['type']=$typss;
			
			$data['start']=date('Y-m-d',strtotime($start));
			$data['end']=date('Y-m-d',strtotime($end));
		
		
		
			$this->load->view('admin/balance_sheet_details_nav',$data);
			$this->load->view('home/footer');
			
			}
			
			
		public function balance_sheet2(){
		
		$data['ware']=$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		
		if(empty($admin))
			redirect('admin');

		$data['type']=0;
	/*	if($type == 3)
				{
					$data['all2']=$this->news_model->getMenuData($ware,$admin);
					$this->load->view('main/header2',$data);
				
				}
				else{
					*/
			$this->load->view('home/headar',$data);
					
				//}
	
	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('start_date','start_date', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{

		$data['start']='2015-1-1';
		$data['end']=date('Y-m-d');

		
		$data['start_b']= date('Y-m-d',strtotime($data['start'] . ' - 1 year'));
		$data['end_b']= date('Y-m-d',strtotime($data['end'] . ' - 1 year'));
	}
	else{
		
		$data['start']='2015-1-1';
		$data['end']=$this->input->post('start_date');
		
		
		$data['start_b']= date('Y-m-d',strtotime($data['start'] . ' - 1 year'));
		$data['end_b']= date('Y-m-d',strtotime($data['end'] . ' - 1 year'));
		
	}
		
	
		
	$this->load->view('admin/balance_sheet2',$data);
	$this->load->view('home/footer');	
		
	}
		
		
		
		
		
		public function trial_details($head,$type,$start=null,$end=null){
		
		$admin = $this->session->userdata('admin');
		
		$data['type']=0;
		
		$this->load->view('home/headar',$data);
	
	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('start_date','start_date', 'required');
	$this->form_validation->set_rules('end_date','end_date', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{

		$data['start']=$start;
		$data['end']=$end;

	}
	else{
		
		$data['start']=$this->input->post('start_date');
		$data['end']=$this->input->post('end_date');
		
	}
		
$data['assets']=$this->report_model->getTrialBalance('setting','id',$head);	
	$data['type']=$type;	
	$data['head']=$head;	
	$this->load->view('admin/trial_balance_details',$data);
	$this->load->view('home/footer');

		
	}
		public function trial_balance(){
		
		
		
		
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		
		if(empty($admin))
			redirect('admin');

		$data['type']=0;
		
		
		
	//	echo "Checking DAta";
		
		
		/*if($type == 3)
				{
					$data['all2']=$this->news_model->getMenuData($ware,$admin);
					$this->load->view('main/header2',$data);
				
				}
				else{*/
					
			$this->load->view('home/headar',$data);
					
				//}
		
	
		
		//$this->load->view('main/header',$data);
	
	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->form_validation->set_rules('start_date','start_date', 'required');
	$this->form_validation->set_rules('end_date','end_date', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{

		$data['start']=date('Y-m-d');
		$data['end']=date('Y-m-d');

	}
	else{
		
		$data['start']=$this->input->post('start_date');
		$data['end']=$this->input->post('end_date');
		
	}
		
$data['assets']=$this->report_model->getTrialBalance('setting','head',0);	
		
	$this->load->view('admin/trial_balance',$data);
	$this->load->view('home/footer');		
		
		
	}
	
	
	
	
		
		public function service_ledger($ids=null,$types=null,$starts=null,$ends=null)
	{
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		
		if(empty($admin))
			redirect('admin');

		$data['type']=0;

		
			
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ledger_id','ledger_id', 'required');
		$this->form_validation->set_rules('start_date','start_date', 'required');
		$this->form_validation->set_rules('end_date','end_date', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{	

	
			
			
			$data['type']=0;
		
			/*if($type == 3)
				{
					$data['all2']=$this->news_model->getMenuData($ware,$admin);
					$this->load->view('main/header2',$data);
				
				}
				else{
					*/
					$this->load->view('home/headar',$data);
				//}	
		
		
			
			$this->load->view('report/service_ledger');
			$this->load->view('home/footer');
		//}
		
		
		
		


	}
	else{
		
		$this->load->view('report/report_header2');
		
		
		$ledger=explode('*',$this->input->post('ledger_id'));
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		
		
		$data['start_date']=$start_date;
		$data['end_date']=$end_date;
		
		
		
	$data['ledger_name']=$ledger[0];	
	$data['type']=$type;	
$data['all']=$this->report_model->getProductLedger('product','date',$ledger[1],$start_date,$end_date);



		
	$this->load->view('report/service_report_print',$data);	
		
		
	$this->load->view('home/footer');	
		
		
	}
		
		
		
		
		
	}
		
		
	public function report_ledger($ids=null,$types=null,$starts=null,$ends=null){
		
		$ware=$this->session->userdata('wire');
		$type=$this->session->userdata('type');
		$admin=$this->session->userdata('admin');
		
		
		if(empty($admin))
			redirect('admin');

		$data['type']=0;

		
			
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ledger_id','ledger_id', 'required');
		$this->form_validation->set_rules('start_date','start_date', 'required');
		$this->form_validation->set_rules('end_date','end_date', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{	

		
		if(!empty($ids)){
			
$this->load->view('report/report_header2');
		
		
		$start_date=$starts;
		$end_date=$ends;
		
		
		$data['start_date']=$start_date;
		$data['end_date']=$end_date;
		
		
		$data['debit']=$this->report_model->getBalance('product_trans','date',$start_date,$end_date,'dr',$ids,$admin);
		
		
		$data['credit']=$this->report_model->getBalance('product_trans','date',$start_date,$end_date,'cr',$ids,$admin);
		
		
		
		
		
		$type=$this->report_model->anyName('ledger','id',$ids,'type');
		
		
	$opening=$this->report_model->anyName('ledger','id',$ids,'opening_balance');
	
	
	$data['l_id']=$ids;

	
	$data['ledger_name']=$this->report_model->anyName('ledger','id',$ids,'ledger_title');
	

   
	
		if((int)$types == 1){
			
			$data['op']=$opening;
			$data['oc']=0;
			
			//$data['balance_bd']=$opening+($data['debit'] - $data['credit']);
		}
		else if((int)$types == 2){
			
		///$data['balance_bd']=$opening+($data['credit'] - $data['debit']);
	
		 $data['oc']=$opening;
			$data['op']=0;
		}
		
		
		
	$data['type']=$types;	
$data['all']=$this->report_model->getLedgerReport('product_trans','date',$start_date,$end_date,$ids,$admin);



		
	$this->load->view('report/ledger_report_print',$data);	
		
		
	$this->load->view('home/footer');	
	
	
	
	
	
	
	
	
	
		}
		else{
			$data['type']=0;
		
			/*if($type == 3)
				{
					$data['all2']=$this->news_model->getMenuData($ware,$admin);
					$this->load->view('main/header2',$data);
				
				}
				else{
					*/
					$this->load->view('home/headar',$data);
				//}	
		
		
			
			$this->load->view('report/report_header');
			
			$this->load->view('home/footer');
		}
		
		
		
		


	}
	else{
		
		$this->load->view('report/report_header2');
		
		
		$ledger=explode('*',$this->input->post('ledger_id'));
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		
		
		$data['start_date']=$start_date;
		$data['end_date']=$end_date;
		// echo $data['start_date']."  f ".$data['end_date'];
		
		$data['debit']=$this->report_model->getBalance('product_trans','date',$start_date,$end_date,'dr',$ledger[1],$admin);
		
		
		$data['credit']=$this->report_model->getBalance('product_trans','date',$start_date,$end_date,'cr',$ledger[1],$admin);
		
		
//		echo $data['debit']." credit ".	$data['credit'];
		
		
		$type=$this->report_model->anyName('ledger','id',$ledger[1],'type');
		
		
	$opening=$this->report_model->anyName('ledger','id',$ledger[1],'opening_balance');
	
	
	$data['l_id']=$ledger[1];

	
	$data['ledger_name']=$ledger[0];


         



		if($type == 1){
			
			$data['op']=$opening;
			$data['oc']=0;
			
			//$data['balance_bd']=$opening+($data['debit'] - $data['credit']);
		}
		else if($type == 2){
			
		//$data['balance_bd']=$opening+($data['credit'] - $data['debit']);
	
		        $data['oc']=$opening;
			$data['op']=0;
		}
		
		
		
	$data['type']=$type;	
$data['all']=$this->report_model->getLedgerReport('product_trans','date',$start_date,$end_date,$ledger[1],$admin);



	
	$this->load->view('report/ledger_report_print',$data);	
		
		
	$this->load->view('home/footer');	
		
		
	}
		
		
		
		
		
	}	
		
		
		
		
	public function getCashPaymentAll()
	{
		
		
	
		
		$w=$this->session->userdata('wire');
		
		$col=null;
		$col2=null;
		$id=$_POST['v'];
		$type=$_POST['type'];
		
		
		
		
		$this->db->where('ware',$w);
		$this->db->where('type',$type);
		$this->db->where('invoice_id',0);
		$this->db->where('voucher',$id);
		$this->db->order_by('id','DESC');

		$info=$this->db->get('product_trans');
		
		
		
		
		
		$test=1;
		$response["posts"]= array();
		foreach($info->result_array() as $val)
				{
				

			$test=0;
				
	$post= array();
	$post["id"]= $val["id"];
	$post["date"]= $val["date"];
	
		$post["cheque_date"]= $val["cheque_date"];
	$post["cheque_no"]= $val["cheque_no"];
	
	
	
	if($type == 6)
		{
			
			$post["debit"]= $this->report_model->anyName('ledger','id',$val['dr'],'ledger_title');
	$post["credit"]= $this->report_model->anyName('ledger','id',192,'ledger_title');
		}
		else if($type == 7){
			
			
			$post["debit"]= $this->report_model->anyName('ledger','id',192,'ledger_title');
	$post["credit"]= $this->report_model->anyName('ledger','id',$val['cr'],'ledger_title');
		}
		else if($type == 10){
			
			
			$post["voucher_no"]= $val["voucher"];
			
			$post["type"]= $val["d_c"];
			$post["ledger"]=$this->report_model->anyName('ledger','id',$val["l_type"],'ledger_title');

		}
		else if($type == 8 || $type == 9){
			
			
			$post["debit"]= $this->report_model->anyName('ledger','id',$val['dr'],'ledger_title');
	$post["credit"]= $this->report_model->anyName('ledger','id',$val['cr'],'ledger_title');
		}
	
	$post["amount"]= $val["amount"];
	$post["description"]= $val["description"];
				
				array_push($response["posts"], $post);
				
				
				}
				
				
		if(!empty($test)){
			
	$this->db->where("ware", $w); 	
	$this->db->order_by("voucher", "DESC");
	$this->db->limit(1);
	$query = $this->db->get("product_trans");
	$row = $query->row();
			
			$data=array(
			
				"id" => 1,
				"v" => $row->voucher+1,
			
			);
			
			echo json_encode($data);
			
		}
		else{
			
			echo json_encode($response);
			
		}
				
				
	
					
				
		
		
		
		
				
		
		
	}	
	public function geTransJValue()
	{
		
		$id=$_POST['id'];
		$id2=$_POST['id2'];
		$fdate=$_POST['fdate'];
		$ldate=$_POST['ldate'];
		
		$data['all']=$this->report_model->getTransValue('product_trans',$fdate,$ldate,$id,$id2);
		
		
		
		$response["posts"]= array();
		foreach($data['all'] as $val)
		{

		
			$post= array();
			$post["id"]= $val["id"];
			$post["debit"]= $this->report_model->anyName('ledger','id',$val['dr'],'ledger_title');
			$post["credit"]= $this->report_model->anyName('ledger','id',$val["cr"],'ledger_title');
			$post["amount"]= $val["amount"];
			$post["date"]= $val["date"];
			$post["description"]= $val["description"];
				
				array_push($response["posts"], $post);
		
		
		
		}
		
		echo json_encode($response);
		
	}	
		
	public function daily_sale_report_print($invoice=null,$type=null,$sup){

	
	$data['type']=0;
	
		$this->load->view('home/headar',$data);
		
		
		
		$admin = $this->session->userdata('admin');
		
		
	$data['name']=$this->report_model->anyName('ledger','id',$sup,'ledger_title');
	$t=$this->report_model->anyName('ledger','id',$sup,'type');
	
	$w=$this->session->userdata('wire');

	$print=$this->report_model->anyName('ware','id',$w,'printer');

	
	
	$de_am=$this->report_model->getBalance2('product_trans','',date('Y-m-d'),date('Y-m-d'),'dr',$sup);
	$cr_am=$this->report_model->getBalance2('product_trans','',date('Y-m-d'),date('Y-m-d'),'cr',$sup);
	
	$op=$this->report_model->anyName('ledger','id',$sup,'opening_balance');
	
	
	if((int)$t == 1)
		$data['closing']=$op+($de_am - $cr_am);
	else
		$data['closing']=$op+($cr_am - $de_am);
	
	$data['session']=$this->report_model->anyName('password','id',$admin,'user');
	
	
	
	$data['previous']=$this->report_model->getPreviousDue('invoice','supplier',$sup,'due','invoice !=',$invoice);
	
	
	
	
	$data['date']=$this->report_model->anyName('product_trans','invoice_id',$invoice,'date');
	
	
	$data['invoice']=$invoice;
	$data['type']=$type;
	
	
	$data['inv']=$this->report_model->getAll('invoice','invoice',$invoice);
	
	
	$data['all']=$this->report_model->getInvoiceDataWOIssu('product',$invoice,'type',$type);

	

		if($type == 5){
			
	$data['all']=$this->report_model->getInvoiceData('issu',$invoice);
		
	$this->load->view('report/daily_sale_report_view',$data);		
		
		
		
		}
		
		else if(($type == 1 || $type == 2) && empty($print)){
			
//	$data['all']=$this->report_model->getInvoiceDataWOIssu('product',$invoice,'type',$type);
		
	$this->load->view('report/product_report_view',$data);		
			
			
		}
		else if(($type == 3 || $type == 4 || $type == 12) && empty($print)){
			
//$data['all']=$this->report_model->getInvoiceDataWOIssu('product',$invoice,'type',$type);
	


	
	$this->load->view('report/product_report_view',$data);					
			
		}
		
		else if(!empty($print))
			$this->load->view('report/pos_print',$data);	
		
		
		$this->load->view('home/footer');		
		
		
		
	}	
		
		
	}


 ?>