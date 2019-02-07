<?php

	class User_Access extends CI_Controller{
		
		
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library("pagination");
	
	}
		public function add_store(){
		
		
				$admin=$this->session->userdata('admin');

		
		$name=$_POST['name'];
		$remarks=$_POST['remarks'];
		$ware=$_POST['ware'];
		
		$data=array(
		
				"name" => $name,
				"remarks" => $remarks,
				"ware" => $ware,
				"by" => $admin,
		
		
		);
		
		$this->db->insert('store_list',$data);
		
		
		echo 1;
		
		
	}
	public function addAdminAccessUpdate()
	{
		
		$admin=$this->session->userdata('admin');
		
		if(empty($admin))
			redirect('admin');
		
		
		
		$active=$_POST['active'];
		$pass=$_POST['pass'];
		$id=$_POST['id'];
		
		
		$da=array(
			
				"password" => $pass,
				"active" => $active,
				"by" => $admin,
			
			);
		
		$this->db->where('id',$id);
		$this->db->update('password',$da);
		
		
		
		
		$ara=array(
		
			"id" => 2
		
		);
		
		echo json_encode($ara);
		
		
	}
	public function addUserAccessUpdate(){
		
		$admin=$this->session->userdata('admin');
		
		if(empty($admin))
			redirect('admin');
		
		
			$active=$_POST['active'];
			$pass=$_POST['pass'];
			$type=$_POST['type'];
			$shop=$_POST['shop'];
			$id=$_POST['id'];
		
		
		$da=array(
			
				"password" => $pass,
				"active" => $active,
				"by" => $admin,
			
			);
		
		$this->db->where('id',$id);
		$this->db->update('password',$da);
		
		
		
		
		$this->db->where('user',$id);
		$this->db->delete('user_access');
		
		
		
		
		
		$data = json_decode(stripslashes($_POST['data']));
		
		 foreach($data as $val){
				
				
				$exp=explode(":",$val);
				
				
			if(!empty($exp[1])){
				
				
				$d=array(
				
					"head" => $exp[0],
					"sub" => $exp[1],
					"ware" => $shop,
					"user" => $id
				
				);
				
		$this->db->insert('user_access',$d);
				
			}
						
				
			
				
				
			}
		
		
		$ara=array(
		
			"id" => 2
		
		);
		
		echo json_encode($ara);
		
		
	}
	
	public function getUserList(){
		
		
		$id=$_POST['id'];
		//$w=$_POST['ware'];
		//$t=$_POST['type'];
		
		
		$admin = $this->session->userdata('admin');
		$w = $this->session->userdata('wire');
		$t = $this->session->userdata('type');
		
		$ara=null;
		
		if($t == 3)
		{
			
			$ara=array(
			
				"id" => 3
			
			);
			
			echo json_encode($ara);
			
		}
		else{
			
			
			$response["users"]= array();
			$post= array();
			$post["sup"]= $w;
			array_push($response["users"], $post);
			
		$this->db->where('id',$id);
		$info=$this->db->get('password');
		$response["posts"]= array();
		foreach($info->result_array() as $val)
				{
					
					$post= array();
					$post["id"]= $val["id"];
					$post["user"]= $val["user"];
					$post["password"]= $val["password"];
					$post["ware"]= $this->user_model->anyName('ware','id',$val["ware"],'name');
					$post["ware2"]= $val["ware"];
					$post["type"]= $val["type"];
					
				
					array_push($response["posts"], $post);

				}
				
				
		$this->db->where('ware',$w);
		$this->db->where('user',$id);
		$this->db->where('sub !=',0);
		$info=$this->db->get('user_access');
		$response["access"]= array();
		foreach($info->result_array() as $val)
				{
					
					$post= array();
					$post["name"]= $this->user_model->anyName('sub_menu','id',$val["head"],'name')." -> ".$this->user_model->anyName('sub_menu','id',$val["sub"],'name');
				
					array_push($response["access"], $post);

				}		
				
				
				
				
				
				
				
				
		if(empty($w))		
		{

	
		$this->db->where('ch !=','');
		$info=$this->db->get('ware');
		$response["ware"]= array();
		foreach($info->result_array() as $val)
				{
					
					$post= array();
					$post["id"]= $val["id"];
					$post["name"]= $val["name"];
					
				
					array_push($response["ware"], $post);

				}		
				
		}
				
				
				
				
				
		echo json_encode($response);
			
			
			
			
			
			
		}
		
		
		
	}
	
	
	
	public function sub_menu(){
		
		$id=$_POST['id'];
		
		$this->db->where('root',$id);
		$info=$this->db->get('sub_menu');
		$response["posts"]= array();
		foreach($info->result_array() as $val)
				{
					
					$post= array();
					$post["id"]= $val["id"];
					$post["name"]= $val["name"];
				
					array_push($response["posts"], $post);

				}
		echo json_encode($response);
		
	}
	public function menu()
	{
		$this->db->order_by('id','ASC');
		$info=$this->db->get('menu');		

		$response["posts"]= array();
		foreach($info->result_array() as $val)
				{
					$post= array();
					$post["id"]= $val["id"];
					$post["name"]= $val["name"];
					array_push($response["posts"], $post);
				}
		echo json_encode($response);
	}
	public function addUser(){
		
		$admin_user = $this->session->userdata('admin');
		$w = $this->session->userdata('wire');
		
			$active=$_POST['active'];
			$user=$_POST['user'];
			$pass=$_POST['pass'];
			$type=$_POST['type'];
			$shop=$_POST['shop'];
			
		$ara=null;
		$check=$this->user_model->getPname('password','user',$user,'id');
		
		
		
		if(!empty($w))
			{
			
				if(!empty($check))
				{
					$ara=array("id" => 1);
				}
				else{
					
					$data=array(
			
				"user" => $user,
				"password" => $pass,
				"active" => $active,
				"ware" => $w,
				"type" => $type,
				"by" => $admin_user,
			
			);
			
			$this->db->insert('password',$data);
					
				

				$ara=array("id" => 2);

				
					
				}
			
			
			
			
			
			
			
			}
		else{
			
	
	
					if($type == 1)
						{
				
							$shop=0;
						}
					if(!empty($check))
						{
		
							$ara=array("id" => 1);
		
						}
					else{
		
		$data=array(
			
				"user" => $user,
				"password" => $pass,
				"active" => $active,
				"ware" => $shop,
				"type" => $type,
				"by" => $admin_user,
			
			);
			
			$this->db->insert('password',$data);
			
			$last=$this->db->insert_id();
			
		
		
		if($type != 1){
			
			$up=array(
		

			"ch" => $last,
		
		);

		$this->db->where('id',$shop);
		$this->db->update('ware',$up);
		
			
		}
		
		
		$ara=array("id" => 2);
		
		
	}
	
	
	
	
			
		}
			

		echo json_encode($ara);		
			
		
			
		}
	
	
	
	
	
	
	
	public function addUserAccess(){
		
		$admin=$this->session->userdata('admin');
		
		if(empty($admin))
			redirect('admin');
				
			$active=$_POST['active'];
			$user=$_POST['user'];
			$pass=$_POST['pass'];
			$type=$_POST['type'];
			$shop=$_POST['shop'];
			
	$ara=null;
	$check=$this->user_model->getPname('password','user',$user,'id');		
		
	if(!empty($check)){
		
		$ara=array(
		
			"id" => 1
		
		);
		
	}
	else{
		
		$da=array(
			
				"user" => $user,
				"password" => $pass,
				"active" => $active,
				"ware" => $shop,
				"type" => $type,
				"by" => $admin,
			
			);
			
			$this->db->insert('password',$da);
			
			$last=$this->db->insert_id();
		
	$chec=$this->user_model->anyName('ware','ch',$shop,'id');

		if(empty($chec)){
			
			$up=array(
			
				"ch" => $last
			
			);
			$this->db->where('id',$shop);
			$this->db->update('ware',$up);
			
		}
		
		$data = json_decode(stripslashes($_POST['data']));
		$response["posts"]= array();
		 foreach($data as $val){
				
				
				$exp=explode(":",$val);
				
				
			
			
			if(!empty($exp[1])){
				
				
								$d=array(
				
					"head" => $exp[0],
					"sub" => $exp[1],
					"ware" => $shop,
					"user" => $last
				
				);
				
		$this->db->insert('user_access',$d);
				
			}
			
		
				
			
				
				
			}
		
		$ara=array(
		
			"id" => 2
		
		);
		
	}
		
		echo json_encode($ara);
		
	}	
	public function addwirehouse(){
		
		$admin_user = $this->session->userdata('admin');
		
			$name=$_POST['name'];
			$theme=$_POST['theme'];
			$address=$_POST['address'];
			$phone=$_POST['phone'];
			$vat=$_POST['vat'];
        	$printer=$_POST['printer'];
                         
	$ara=null;	

	
	$data=array(
	
		"name" => $name,
		"ch" => 0,
		"user" => 0,
		"address" => $address,
		"theme" => $theme,
        "phone" => $phone,
		"printer" => $printer,
        "vat" => $vat,
	
	);
	
	$this->db->insert('ware',$data);
	
$ara=array("id" => 2);
echo json_encode($ara);	
		
		
	}	
		
	}



 ?>