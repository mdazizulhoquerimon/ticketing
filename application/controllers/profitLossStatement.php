<?php 


	class profitLossStatement extends CI_Controller{
		
		
		
		
		public function __construct(){
			
			
			parent::__construct();
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library("pagination");
			$this->load->model("report_model");
			
			$admin_user = $this->session->userdata('admin');
			if(empty($admin_user))
			{	
				redirect('member/adminlogin');
			}
		}
		
		public function index(){
			
			
		/*	$data['type']=0;				
			$this->load->view('home/headar',$data);	
			
			$end=$this->input->post("end_date");
			if(empty($end))
				$end=date('Y-m-d');
			
			
			$data["start"]=date('Y-m-d',strtotime('2016-04-01'));
			$data["end"]=date('Y-m-d',strtotime($end));
			//$data["end"]=date('Y-m-d');
			
			$this->load->view('accounts/profitLossStatement',$data);
			$this->load->view('home/footer');
			
			*/
			
			
			
			
			
			$data['type']=0;				
			$this->load->view('home/headar',$data);	
			
			$end=$this->input->post("end_date");
			$start=$this->input->post("start_date");
			if(empty($end))
			{
				$end=date('Y-m-d');
				$start=date('Y-m-d');
			}
			
			$data["start"]=date('Y-m-d',strtotime($start));
			$data["end"]=date('Y-m-d',strtotime($end));
			//$data["end"]=date('Y-m-d');
			
			$this->load->view('accounts/profitLossStatement',$data);
			$this->load->view('home/footer');
			
			
			
			
			
			
			
			
		}
		
		
	}


?>