<?php

class Project Extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('project_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $admin_user = $this->session->userdata('admin');
        if (empty($admin_user)) {
            redirect('member/adminlogin');
        }
    }

    //.........................Project All Functionality Start..................................//
    public function project_all_view(){

        $w=$this->session->userdata('wire');
        $admin = $this->session->userdata('admin');
        $type = $this->session->userdata('type');
        $data['type'] = 0;
        $data['allStatus']=$this->common_model->getAll('tbl_status','is_active',1);

        $this->load->view('home/headar',$data);
        $this->load->view('projects/project_all');
        $this->load->view('home/footer');
    }

    public function getSearchProjectList()
    {
        $id=$_POST['id'];
        $w=$this->session->userdata('wire');
        if(!empty($w))
            $this->db->where("(ware='".$w."' OR ware='0')");
        $this->db->like('id', $id);
        $this->db->or_like('project_name', $id);
        $info=$this->db->get('tbl_project');

        $data=array();
        foreach($info->result_array() as $val)
        {
            array_push($data,$val['project_name']);
        }
        echo json_encode($data);
    }

    public function add_new_project(){

        $w=$this->session->userdata('wire');

        $project_name= $_POST['project_name'];
        $project_id= $_POST['project_id'];

        if (!empty($project_name)) {
            $data["project_name"] = $project_name;
            $data["project_status"]= trim($_POST['project_status']);
            $data["project_start_date"]= trim($_POST['project_start_date']);
            $data["project_end_date"]= trim($_POST['project_end_date']);
            $data["ware"]= $w;
            if (!empty($project_id)){
                $this->db->where('id',$project_id);
                $this->db->update('tbl_project',$data);
                $ara = array("id" => 3);//Updated the table;
            }else{
                $this->db->insert('tbl_project', $data);
                $ara = array("id" => 2);//Inserted Into table;
            }
        } else {
            $ara = array("id" => 1);
        }
        echo json_encode($ara);
    }

    public function getAllProjectInfo(){

        $search_project = $_POST['search_project'];

        $w = $this->session->userdata('wire');

//        $this->db->select('Details.item_no,Details.rate,Details.quantity,Details.total,Bill.id,Bill.voucher_no,Bill.check_in_no,Bill.date,Bill.is_paid,');
//        $this->db->from('laundry_bill_details as Details');
//        $this->db->join('laundry_bill as Bill', 'Bill.id = Details.laundry_bill_id');

        $this->db->where("(ware='".$w."' OR ware='0')");
        if(!empty($search_project)){
            $this->db->where("project_name",$search_project);
        }
        $this->db->order_by('id','asc');
        $info = $this->db->get("tbl_project");

        $res["list"]=array();

        foreach($info->result_array() as $val){

            $post=array();
            $post["id"]=$val["id"];
            $post["project_name"]=$val["project_name"];
            $post["project_start_date"]=$val["project_start_date"];
            if(empty($val["project_end_date"])){
                $post["project_end_date"] = "Not Ended Yet";
            }else{
                $post["project_end_date"]=$val["project_end_date"];
            }

            if($val["project_status"]==1){
                $post["style"]= "Orange";
                $post["project_status"]=$this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["project_status"], 'status_name');
            }elseif ($val["project_status"]==2){
                $post["style"]= "yellow";
                $post["project_status"]=$this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["project_status"], 'status_name');
            }elseif ($val["project_status"]==3){
                $post["style"]= "MediumSeaGreen";
                $post["project_status"]=$this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["project_status"], 'status_name');
            }elseif ($val["project_status"]==4){
                $post["style"]= "DodgerBlue";
                $post["project_status"]=$this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["project_status"], 'status_name');
            }
            else{
                $post["style"]= "Tomato";
                $post["project_status"]=$this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["project_status"], 'status_name');
            }
            if($val["is_assigned"]==1){
                $post["is_assigned"]="YES";
            }else{
                $post["is_assigned"]="NO";
            }

            array_push($res["list"],$post);
        }
        //print_r($res);
        echo json_encode($res);
    }

    public function getProjectInfo(){

        $id = $_POST['id'];
        $res["info"] =  $this->common_model->getAnyInfoRow('tbl_project','id',$id);
        echo json_encode($res);
    }
    //.........................Project All Functionality End..................................//

    //.........................Assigned Project Functionality Start..................................//
    public function assigned_project_view(){

        $w=$this->session->userdata('wire');
        $admin = $this->session->userdata('admin');
        $type = $this->session->userdata('type');
        $data['type'] = 0;
        $data['allEngineer']=$this->common_model->getAll('password','type',3,'asc','active',1);
        $data['allCustomer']=$this->common_model->getAll('password','type',4,'asc','active',1);
        $data['allProject']=$this->common_model->getAll('tbl_project');

        $this->load->view('home/headar',$data);
        $this->load->view('projects/assigned_project');
        $this->load->view('home/footer');
    }

    public function getSearchAssignedProjectList()
    {
        $id=$_POST['id'];
        $w=$this->session->userdata('wire');

        if(!empty($w)) {
            $this->db->where("(ware='".$w."' OR ware='0')");
        }
        $this->db->where('is_assigned',1);
        $this->db->like('id', $id);
        $this->db->or_like('project_name', $id);
        $info=$this->db->get('tbl_project');

        $data=array();
        foreach($info->result_array() as $val)
        {
            array_push($data,$val['project_name']);
        }
        echo json_encode($data);
    }

    public function add_assigned_project(){

        $w=$this->session->userdata('wire');

        $project_id= $_POST['assigned_project'];

        if (!empty($project_id)) {
            $data["is_assigned"]= trim($_POST['assign_status']);
            $data["project_engineer"]= trim($_POST['project_engineer']);
            $data["project_customer"]= trim($_POST['project_customer']);
            $data["assigned_date"]= trim($_POST['assigned_date']);
            $data["assign_note"]= trim($_POST['assign_note']);
            $data["ware"]= $w;

            $this->db->where('id',$project_id);
            $this->db->update('tbl_project',$data);
            $ara = array("id" => 2);//updated Into table;

        } else {
            $ara = array("id" => 1);
        }
        echo json_encode($ara);
    }

    public function getAllAssignedProjectInfo(){

        $search_project = $_POST['search_assigned_project'];

        $w = $this->session->userdata('wire');

        $this->db->where("(ware='".$w."' OR ware='0')");
        $this->db->where('is_assigned',1);
        if(!empty($search_project)){
            $this->db->where("project_name",$search_project);
        }
        $this->db->order_by('id','asc');
        $info = $this->db->get("tbl_project");

        $res["list"]=array();

        foreach($info->result_array() as $val){

            $post=array();
            $post["id"]=$val["id"];
            $post["project_name"]=$val["project_name"];
            $post["project_engineer"]=$this->common_model->anyNameWithoutWare('password', 'id', $val["project_engineer"], 'user');
            $post["project_customer"]=$this->common_model->anyNameWithoutWare('password', 'id', $val["project_customer"], 'user');
            $post["assigned_date"]=$val["assigned_date"];
            if(empty($val["assign_note"])){
                $post["assign_note"]="NONE";
            }else{
                $post["assign_note"]=$val["assign_note"];
            }
            if(empty($val["project_ticket"])){
                $post["project_ticket"]="NONE";
            }else{
                $post["project_ticket"]=$val["project_ticket"];
            }


            array_push($res["list"],$post);
        }
        //print_r($res);
        echo json_encode($res);
    }

    //.........................Assigned Project Functionality End..................................//
}