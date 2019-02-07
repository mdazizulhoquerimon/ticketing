<?php


	class Product_Model extends CI_Model{
		
				public function __construct()
		{
			
			$this->load->database();	
		
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
	
	public function counts_all($table,$feild=null,$value=null,$start=null,$end=null,$type=null){
		
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
	
	
	
		public function all_count($table,$feild=null,$value=null,$start=null,$end=null,$type=null)
{	

 			$w = $this->session->userdata('wire');

	if(!empty($w))
		{
			$this->db->where("ware",$w);
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
		
//if(!empty($_GET['type']) && $_GET['type'] != 6)
	//$this->db->where('type',$_GET['type']);

//else if(empty($_GET['type']))
	//$this->db->where('date','0000-00-00');


 
		if(!empty($feild))
			$this->db->where($feild, $value);
			$this->db->from($table);
			$count = $this->db->count_all_results();
			return $count;	
			
			
			
			
			
			
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
		public function getChecking($table,$col,$vas){
		
			$mang1=array();
			
	$mang1[]=$vas;
		
			$mang1=$this->getParent($table,$col,$vas,$mang1);

	
	
			return $mang1;
		
		
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
		
		
	}





 ?>