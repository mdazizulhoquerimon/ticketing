<?php




class Transactions extends CI_Model{
	
	public function __construct()
	{
		$this->load->database();
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
	public function getAll($table,$col=null,$val=null){
	
	$w = $this->session->userdata('wire');
				
		if(!empty($w) && $table != 'setting')
			$this->db->where('ware',$w);
	
	
	
	
	$this->db->order_by('id','DESC');
	if(!empty($col))
	$this->db->where($col,$val);
	$info=$this->db->get($table);
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
		
		
		
		return 0;
		
	}





}




 ?>