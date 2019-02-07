<?php


	class Account_Permission extends CI_Controller{
		
			public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library("pagination");
	}
	
	public function chatof_account(){
		
		$this->load->model('user_head');
		$id=$_POST['v'];
		
		$test['alls']=array();
			$k['alls']=$this->user_head->ChatofAccounts('setting','head',$id,$test['alls']);

			
			
	echo json_encode($k);
		
		
		
		
	}
	public function add_list()
	{
		$this->load->database();	
		
		$admin = $this->session->userdata('admin');
		$w = $this->session->userdata('wire');
		
		
		$name=$_POST['name'];
		$id=$_POST['id'];
		$type=$_POST['ob'];
		
		
		
		
		$data=array(
		"head" => $id,
		"name" => $name,
		"ob" => $type,
		"type" => 2,
		"by" => $admin,
		"ware" => $w,
		"acces" => 1
		
		);
		
		$this->db->insert('setting',$data);
		
		$response["posts"]= array();
		
		
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
		
		
		$this->db->where('head',$id);
		$info=$this->db->get('setting');
		
		foreach($info->result_array() as $val)
				{
					
				$post= array();
				$post["id"]= $val["id"];
				$post["head"]= $val["head"];
				$post["type"]= $val["type"];
				$post["name"]= $val["name"];
				$post["acces"]= $val["acces"];
				array_push($response["posts"], $post);

				}
		echo json_encode($response);
		
	}
	
	
	
	
	
	
	
	
	
	
	
			public function add_update(){
		
		
		$this->load->database();	
		
		$name=$_POST['name'];
		$id=$_POST['id'];
		
		$data=array(
		
		"name" => $name,
		
		
		);
		$this->db->where('id',$id);
		$this->db->update('setting',$data);
		
		$ara=array("id" => 1);
		echo json_encode($ara);
		
	}
		
		public function add_delete(){
		
		$w = $this->session->userdata('wire');
		
				$this->load->model('setting');
	
		
		$id=$_POST['id'];
		$head=$_POST['head'];
		


              
                $check=$this->setting->anyName("setting","head",$id,"id");

               $lcheck=$this->setting->anyName("ledger","parent_head_id",$id,"id");

               $pcheck=$this->setting->anyName("product_ledger","head",$id,"id");



               if(!empty($check) || !empty($lcheck) || !empty($pcheck))
                 echo 1; //you can't delete

                else{

		$this->db->where('id',$id);
		$this->db->delete('setting');
		
		
		$this->db->where('head',$id);
		$this->db->delete('setting');
		
		
		
		
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");
		$response["posts"]= array();
		$this->db->where('head',$head);
		$info=$this->db->get('setting');
		
		foreach($info->result_array() as $val)
				{
					
				$post= array();
				$post["id"]= $val["id"];
				$post["head"]= $val["head"];
				$post["type"]= $val["type"];
				$post["name"]= $val["name"];
				$post["acces"]= $val["acces"];
				array_push($response["posts"], $post);

				}
		echo json_encode($response);




          }
		
	}
		
		
		
		
		
		
		
		
		public function getChild(){
			
			
		$this->load->database();	
			
		
		$w = $this->session->userdata('wire');
		
		
		$id=$_POST['id'];
		$table=$_POST['table'];
		$head=$_POST['head'];
		
		
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");

		$this->db->where('head',$id);
		$info=$this->db->get($table);
		
		$response["posts"]= array();
		$response["head"]= array();

		$i=1;
		foreach($info->result_array() as $val)
				{
					
				$post= array();
				$post["id"]= $val["id"];
				$post["head"]= $val["head"];
				$post["type"]= $val["type"];
				$post["name"]= $val["name"];
				
				$post["acces"]= $val["acces"];
				array_push($response["posts"], $post);

				}
		
				
				echo json_encode($response);
		
	}
		
		public function transaction()
	{
		
		
		
		$admin = $this->session->userdata('admin');
		$w = $this->session->userdata('wire');
		
		
		$this->load->model('user_head');
		
		
		$id=$_POST['id'];
		$table=$_POST['table'];
		$head=$_POST['head'];
		
		
		if(!empty($id)){
			$test=array();
			$test=$this->user_head->getHealList($table,'id',$id,0,$test);
			
			
			$length=count($test);
			$response["posts"]= array();
			for($i=$length-1;$i>=0;$i--){
				
				
				
		if(!empty($w))
			$this->db->where("(ware='".$w."' OR ware='0')");

			
			$this->db->where('id',$test[$i]);
			$in=$this->db->get($table);
			foreach($in->result_array() as $val)
				{
					
				$post= array();
				$post["id"]= $val["id"];
				$post["head"]= $val["head"];
				$post["name"]= $val["name"];
				array_push($response["posts"], $post);

				}
			
			}
	echo json_encode($response);
			
		}
				
		
	}
		
		
	}






 ?>