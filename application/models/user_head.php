<?php


	class User_Head extends CI_Model{
		public function __construct()
	{
		$this->load->database();
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
		
		
		
		
	public function getHealList($table,$col,$vas,$i,$test){
		
			$mang1=array();
	
		$i = 0;
	$mang1=$this->getlist($table,$col,$vas,$mang1,$i);

	
	
	return $mang1;
		
		
	}
	
	public function getHealList2($table,$col,$vas,$i,$test){
		
		$mang1=array();
	
		$i = 0;
		$mang1=$this->getlist_pname($table,$col,$vas,$mang1,$i);

	
	
	return $mang1;
		
		
	}
	function getlist_pname($table,$col,$vas,&$mang1,$i){
				
				
				$w = $this->session->userdata('wire');
				if(!empty($w))
					$this->db->where("(ware='".$w."' OR ware='0')");
				
					$this->db->where($col,$vas);
					$info=$this->db->get($table);
					foreach($info->result_array() as $val){
					
					
						$mang1[]=$val['id'];
						$this->getlist_pname($table,'head',$val['id'],$mang1,$i);
					
					
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
		
		
	}



 ?>