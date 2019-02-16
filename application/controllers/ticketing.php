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
        $data['user'] = $this->common_model->anyNameWithoutWare('password', 'id',$admin, 'user');
        if ($type == 1 || $type == 2) {
            $data['allProject'] = $this->common_model->getAll('tbl_project');
        } else {
            $projects = $this->common_model->getAll('tbl_assigned_project', 'project_engineer', $admin);
            foreach ($projects as $projects_id) {
                $res[] = $projects_id["project_id"];
            }
            $this->db->where_in('id', $res);
            $info = $this->db->get('tbl_project');
            $data['allProject'] = $info->result_array();
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

        if (!empty($ticket_subject)) {
            $data["project_id"] = trim($_POST['project_id']);
            $data["ticket_subject"] = $ticket_subject;
            $data["ticket_priority"] = trim($_POST['ticket_priority']);
            $data["ticket_status_id"] = 1;// 1 means pending;
            $data["opened_by"] = trim($_POST['opened_by']);
            $data["ticket_date"] = $this->common_model->getDateTime();
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

                $ara = array("id" => 2);//Inserted Into table;
            }
        } else {
            $ara = array("id" => 1);
        }
        echo json_encode($ara);
    }

    public function getAllTicketInfo()
    {

        $search_ticket = $_POST['search_ticket'];
        $type = $this->session->userdata('type');
        $w = $this->session->userdata('wire');
        $admin = $this->session->userdata('admin');

        $this->db->where("(ware='" . $w . "' OR ware='0')");
        if (!empty($search_ticket)) {
            $this->db->where("ticket_subject", $search_ticket);
        }
        $this->db->order_by('id', 'asc');
        $info = $this->db->get("tbl_tickets");

        $res["list"] = array();

        foreach ($info->result_array() as $val) {

            $post = array();
            $post["type"] = $type;
            $post["id"] = $val["id"];
            $post["project_name"] = $this->common_model->anyNameWithoutWare('tbl_project', 'id',$val["project_id"], 'project_name');
            $post["ticket_subject"] = $val["ticket_subject"];
            $post["ticket_priority"] = $val["ticket_priority"];
            $post["ticket_status"] = $val["ticket_status_id"];
            $post["rating"] = $val["rating"];
            $post["opened_by"] = $val["opened_by"];
            $post["ticket_date"] = $val["ticket_date"];

            array_push($res["list"], $post);
        }
        //print_r($res);
        echo json_encode($res);
    }
    //.........................Ticketing All Functionality End..................................//
}