<?php


class Project Extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('project_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $admin_user = $this->session->userdata('admin');
        if (empty($admin_user)) {
            redirect('member/adminlogin');
        }
    }

    public function getSearchProjectList()
    {
        $id=$_POST['id'];
//        $w=$this->session->userdata('wire');
//        if(!empty($w))
//            $this->db->where("(ware='".$w."' OR ware='0')");
//        //$this->db->where('em_code',$id);
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

    public function project_all(){

        $this->load->model('setting');
        $data['setting'] = "";
        $data['type'] = 0;
        $data['allStatus']=$this->project_model->getAll('tbl_status','is_active',1);

        $admin = $this->session->userdata('admin');
        $t = $this->session->userdata('wire');
        $type = $this->session->userdata('type');


        $this->load->view('home/headar',$data);
        $this->load->view('projects/project_all');
        $this->load->view('home/footer');
    }

    public function add_new_project(){

        $project_name= $_POST['project_name'];
        $project_id= $_POST['project_id'];

        if (!empty($project_name)) {
            $data["project_name"] = $project_name;
            $data["project_status"]= trim($_POST['project_status']);
            $data["project_start_date"]= trim($_POST['project_start_date']);
            $data["project_end_date"]= trim($_POST['project_end_date']);
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

        //$w = $this->session->userdata('wire');

        //$this->db->where("(ware='".$w."' OR ware='0')");

//        $this->db->select('Details.item_no,Details.rate,Details.quantity,Details.total,Bill.id,Bill.voucher_no,Bill.check_in_no,Bill.date,Bill.is_paid,');
//        $this->db->from('laundry_bill_details as Details');
//        $this->db->join('laundry_bill as Bill', 'Bill.id = Details.laundry_bill_id');
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
                $post["project_status"]=$this->project_model->anyName('tbl_status', 'id', $val["project_status"], 'status_name');
            }elseif ($val["project_status"]==2){
                $post["style"]= "yellow";
                $post["project_status"]=$this->project_model->anyName('tbl_status', 'id', $val["project_status"], 'status_name');
            }elseif ($val["project_status"]==3){
                $post["style"]= "MediumSeaGreen";
                $post["project_status"]=$this->project_model->anyName('tbl_status', 'id', $val["project_status"], 'status_name');
            }elseif ($val["project_status"]==4){
                $post["style"]= "DodgerBlue";
                $post["project_status"]=$this->project_model->anyName('tbl_status', 'id', $val["project_status"], 'status_name');
            }
            else{
                $post["style"]= "Tomato";
                $post["project_status"]=$this->project_model->anyName('tbl_status', 'id', $val["project_status"], 'status_name');
            }

            $post["project_ticket"]=$val["project_ticket"];
            if(empty($val["project_ticket"])){
                $post["project_ticket"]="NO";
            }else{
                $post["project_ticket"]=$val["project_ticket"];
            }

            array_push($res["list"],$post);
        }
        //print_r($res);
        echo json_encode($res);
    }

    public function getProjectInfo(){

        $id = $_POST['id'];
        $res["info"] =  $this->project_model->getAnyInfoRow('tbl_project','id',$id);
        echo json_encode($res);
    }
}