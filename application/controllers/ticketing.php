<?php

class Ticketing extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ticketing_model');
        $this->load->model('common_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $admin_user = $this->session->userdata('admin');
        if (empty($admin_user)) {
            redirect('member/adminlogin');
        }
    }

    //.........................Ticketing All Functionality Start..................................//
    public function ticket_all_view()
    {
        $w = $this->session->userdata('wire');
        $admin = $this->session->userdata('admin');
        $type = $this->session->userdata('type');
        $data['type'] = $type;
        $data['admin'] = $admin;
        $data['user'] = $this->common_model->anyNameWithoutWare('password', 'id', $admin, 'user');
        $data['allEngineer'] = $this->common_model->getAll('password', 'type', 3, 'asc', 'active', 1);
        if ($type == 3) {
            $data['allProject'] = $this->common_model->getAll('tbl_assigned_project', 'project_engineer', $admin);
        } elseif ($type == 4) {
            $data['allProject'] = $this->common_model->getAll('tbl_assigned_project', 'project_customer', $admin);
        } else {
            $data['allProject'] = $this->common_model->getAll('tbl_assigned_project');
        }

        $this->load->view('home/headar', $data);
        $this->load->view('tickets/ticket_all');
        $this->load->view('home/footer');
    }

    public function add_new_ticket()
    {

        $w = $this->session->userdata('wire');
        $admin = $this->session->userdata('admin');
        $ticket_subject = $_POST['ticket_subject'];
        $ticket_id = $_POST['ticket_id'];
        $assigned_project_id = trim($_POST['project_id']);


        if (!empty($ticket_subject)) {
            $data["assigned_project_id"] = $assigned_project_id;
            $data["ticket_subject"] = $ticket_subject;
            $data["ticket_priority"] = trim($_POST['ticket_priority']);
            $data["ticket_status_id"] = 1;// 1 means pending;
            $data["opened_by"] = trim($_POST['opened_by']);
            $data['ticket_message'] = trim($_POST['ticket_message']);
            $data["ticket_date_time"] = $this->common_model->getDateTime();
            $data["ticket_date"] = date('Y-m-d');
            $data["user_id"] = $admin;
            $data["ware"] = $w;
            if (!empty($ticket_id)) {

                $this->db->where('id', $ticket_id);
                $this->db->update('tbl_tickets', $data);

                $message['message'] = trim($_POST['ticket_message']);
                $this->db->where('ticket_id', $ticket_id);
                $this->db->update('tbl_message_list', $message);
                $ara = array("id" => 3);//Updated the table;

            } else {
                $this->db->insert('tbl_tickets', $data);
                $ticket_id = $this->db->insert_id();

                $message['ticket_id'] = $ticket_id;
                $message['message'] = trim($_POST['ticket_message']);
                $message['sender'] = $admin;
                $message['receiver'] = 0;//initially 0 will insert
                $message['message_time'] = $this->common_model->getDateTime();
                $message['is_seen'] = 0;
                $message['ware'] = $w;
                $message['status'] = 1;
                $this->db->insert('tbl_message_list', $message);


                $this->db->select('COUNT(assigned_project_id) as count');
                $this->db->from('tbl_tickets');
                $this->db->where('assigned_project_id', $assigned_project_id);
                $this->db->where('ticket_status_id', 1);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $data1['pending_ticket'] = $row->count;
                }
                $data1['ticket_id'] = $ticket_id;
                $this->db->where('id', $assigned_project_id);
                $this->db->update('tbl_assigned_project', $data1);

                $ara = array("id" => 2);//Inserted Into table;
            }
        } else {
            $ara = array("id" => 1);
        }
        echo json_encode($ara);
    }

    public function getTickettList()
    {
        $id = $_POST['id'];
        $w = $this->session->userdata('wire');

        if (!empty($w)) {
            $this->db->where("(ware='" . $w . "' OR ware='0')");
        }
        $this->db->like('id', $id);
        $this->db->or_like('project_name', $id);
        $info = $this->db->get('tbl_project');

        $data = array();
        foreach ($info->result_array() as $val) {
            array_push($data,$val['id']."*".$val['project_name']);
        }
        echo json_encode($data);
    }

    public function getAllTicketInfo()
    {

        $search_ticket = $_POST['search_ticket'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        $type = $this->session->userdata('type');
        $w = $this->session->userdata('wire');
        $admin = $this->session->userdata('admin');

        if(!empty($_POST['search_ticket'])){
            $project_id=explode("*",$_POST['search_ticket']);
        }
        if(!empty($project_id[0])){
            $assigned_projects= $this->common_model->getAll('tbl_assigned_project', 'project_id', $project_id[0]);
            foreach ($assigned_projects as $assigned_id) {
                $res[] = $assigned_id["id"];
            }
            $this->db->where_in('assigned_project_id', $res);
        }

        if (!empty($from_date) && !empty($to_date)) {
            $this->db-> where ("`ticket_date` BETWEEN '".$from_date."' AND '".$to_date."'");
        }
        if ($type != 1) {
            $this->db->where("(ware='" . $w . "' OR ware='0')");
        }
        if ($type == 3 || $type == 4) {
            $engineer_assigned_id = $this->common_model->anyNameWithoutWare('tbl_assigned_project', 'project_engineer', $admin, 'id');
            $customer_assigned_id = $this->common_model->anyNameWithoutWare('tbl_assigned_project', 'project_customer', $admin, 'id');
            $this->db->where("(assigned_project_id='" . $engineer_assigned_id . "' OR assigned_project_id='" . $customer_assigned_id . "' OR project_engineer = '" . $admin . "')");
        }

        $this->db->order_by('id', 'asc');
        $info = $this->db->get("tbl_tickets");

        $res["list"] = array();

        foreach ($info->result_array() as $val) {

            $post = array();
            $post["type"] = $type;
            $post["id"] = $val["id"];
            $poject_id = $this->common_model->anyNameWithoutWare('tbl_assigned_project', 'id', $val["assigned_project_id"], 'project_id');
            $poject_engineer = $this->common_model->anyNameWithoutWare('tbl_assigned_project', 'id', $val["assigned_project_id"], 'project_engineer');
            $poject_customer = $this->common_model->anyNameWithoutWare('tbl_assigned_project', 'id', $val["assigned_project_id"], 'project_customer');
            $post["project_name"] = $this->common_model->anyNameWithoutWare('tbl_project', 'id', $poject_id, 'project_name') . '->' . $this->common_model->anyNameWithoutWare('password', 'id', $poject_engineer, 'user') . '->' . $this->common_model->anyNameWithoutWare('password', 'id', $poject_customer, 'user');
            $post["ticket_subject"] = $val["ticket_subject"];

            if ($val["ticket_priority"] == 1) {

                $post["ticket_priority"] = "LOW";
            } elseif ($val["ticket_priority"] == 2) {

                $post["ticket_priority"] = "Medium";
            } elseif ($val["ticket_priority"] == 3) {

                $post["ticket_priority"] = "HIGH";
            }

            if ($val["ticket_status_id"] == 1) {
                $post["style"] = "Orange";
                $post["ticket_status"] = $this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["ticket_status_id"], 'status_name');
            } elseif ($val["ticket_status_id"] == 2) {
                $post["style"] = "yellow";
                $post["ticket_status"] = $this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["ticket_status_id"], 'status_name');
            } elseif ($val["ticket_status_id"] == 3) {
                $post["style"] = "MediumSeaGreen";
                $post["ticket_status"] = $this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["ticket_status_id"], 'status_name');
            } elseif ($val["ticket_status_id"] == 4) {
                $post["style"] = "DodgerBlue";
                $post["ticket_status"] = $this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["ticket_status_id"], 'status_name');
            } else {
                $post["style"] = "Tomato";
                $post["ticket_status"] = $this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["ticket_status_id"], 'status_name');
            }
            if ($val["is_hand_over"] == 1) {
                $post["is_hand_over"] = "Yes";
            } else {
                $post["is_hand_over"] = "No";
            }
            if ($val["hand_over_by"]) {
                $post["hand_over_by"] = $val["hand_over_by"];
            } else {
                $post["hand_over_by"] = "Not Yet";
            }
            if ($val["project_engineer"]) {
                $post["hand_over_to"] = $this->common_model->anyNameWithoutWare('password', 'id', $val["project_engineer"], 'user');
            } else {
                $post["hand_over_to"] = "Not Yet";
            }
            $post["ticket_date"] = $val["ticket_date_time"];
            $post["rating"] = $val["rating"];
            $post["opened_by"] = $val["opened_by"];

            array_push($res["list"], $post);
        }
        //print_r($res);
        echo json_encode($res);
    }

    public function getTicketInfo()
    {
        $id = $_POST['id'];
        $res["info"] = $this->common_model->getAnyInfoRow('tbl_tickets', 'id', $id);
        echo json_encode($res);
    }

    public function hand_over_ticket()
    {
        $ticket_id = $_POST['ticket_id'];
        if (!empty($ticket_id)) {

            $project_engineer = trim($_POST['project_engineer']);
            $is_hand_over = trim($_POST['is_hand_over']);
            $hand_over_by = trim($_POST['hand_over_by']);
            if($is_hand_over==1){
                $data['project_engineer'] = $project_engineer;
                $data['is_hand_over'] = $is_hand_over;
                $data['hand_over_by'] = $hand_over_by;
            }else{
                $data['project_engineer'] = '';
                $data['is_hand_over'] = '';
                $data['hand_over_by'] = '';
            }
            $this->db->where('id', $ticket_id);
            $this->db->update('tbl_tickets', $data);
            $ara = array("id" => 2);
        } else {
            $ara = array("id" => 1);
        }
        echo json_encode($ara);
    }

    //.........................Ticketing All Functionality End..................................//
}