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
    public function project_all_view()
    {

        $w = $this->session->userdata('wire');
        $admin = $this->session->userdata('admin');
        $type = $this->session->userdata('type');
        $data['type'] = $type;
        $data['admin'] = $admin;
        $data['allStatus'] = $this->common_model->getAll('tbl_status', 'is_active', 1);

        $this->load->view('home/headar', $data);
        $this->load->view('projects/project_all');
        $this->load->view('home/footer');
    }

    public function getSearchProjectList()
    {
        $id = $_POST['id'];
        $w = $this->session->userdata('wire');
        if (!empty($w))
            $this->db->where("(ware='" . $w . "' OR ware='0')");
        $this->db->like('id', $id);
        $this->db->or_like('project_name', $id);
        $info = $this->db->get('tbl_project');

        $data = array();
        foreach ($info->result_array() as $val) {
            array_push($data, $val['project_name']);
        }
        echo json_encode($data);
    }

    public function add_new_project()
    {

        $w = $this->session->userdata('wire');
        $admin = $this->session->userdata('admin');
        $project_name = $_POST['project_name'];
        $project_id = $_POST['project_id'];

        if (!empty($project_name)) {
            $data["project_name"] = $project_name;
            $data["project_status"] = trim($_POST['project_status']);
            $data["project_start_date"] = trim($_POST['project_start_date']);
            $data["project_end_date"] = trim($_POST['project_end_date']);
            $data["assigned_by"] = $admin;
            $data["ware"] = $w;
            if (!empty($project_id)) {
                $this->db->where('id', $project_id);
                $this->db->update('tbl_project', $data);
                $ara = array("id" => 3);//Updated the table;
            } else {
                $this->db->insert('tbl_project', $data);
                $ara = array("id" => 2);//Inserted Into table;
            }
        } else {
            $ara = array("id" => 1);
        }
        echo json_encode($ara);
    }

    public function getAllProjectInfo()
    {

        $search_project = $_POST['search_project'];
        $type = $this->session->userdata('type');
        $w = $this->session->userdata('wire');
        $admin = $this->session->userdata('admin');

        $this->db->where("(ware='" . $w . "' OR ware='0')");
        if (!empty($search_project)) {
            $this->db->where("project_name", $search_project);
        }
        $this->db->order_by('id', 'asc');
        $info = $this->db->get("tbl_project");

        $res["list"] = array();

        foreach ($info->result_array() as $val) {

            $post = array();
            $post["type"] = $type;
            $post["id"] = $val["id"];
            $post["project_name"] = $val["project_name"];
            $post["project_start_date"] = $val["project_start_date"];
            if (empty($val["project_end_date"])) {
                $post["project_end_date"] = "Not Ended Yet";
            } else {
                $post["project_end_date"] = $val["project_end_date"];
            }
            if ($val["project_status"] == 1) {
                $post["style"] = "Orange";
                $post["project_status"] = $this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["project_status"], 'status_name');
            } elseif ($val["project_status"] == 2) {
                $post["style"] = "yellow";
                $post["project_status"] = $this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["project_status"], 'status_name');
            } elseif ($val["project_status"] == 3) {
                $post["style"] = "MediumSeaGreen";
                $post["project_status"] = $this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["project_status"], 'status_name');
            } elseif ($val["project_status"] == 4) {
                $post["style"] = "DodgerBlue";
                $post["project_status"] = $this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["project_status"], 'status_name');
            } else {
                $post["style"] = "Tomato";
                $post["project_status"] = $this->common_model->anyNameWithoutWare('tbl_status', 'id', $val["project_status"], 'status_name');
            }

            array_push($res["list"], $post);
        }
        //print_r($res);
        echo json_encode($res);
    }

    public function getProjectInfo()
    {

        $id = $_POST['id'];
        $res["info"] = $this->common_model->getAnyInfoRow('tbl_project', 'id', $id);
        echo json_encode($res);
    }
    //.........................Project All Functionality End..................................//

    //.........................Assigned Project Functionality Start..................................//
    public function assigned_project_view()
    {

        $w = $this->session->userdata('wire');
        $admin = $this->session->userdata('admin');
        $type = $this->session->userdata('type');
        $data['admin'] = $admin;
        $data['type'] = $type;
        $data['allEngineer'] = $this->common_model->getAll('password', 'type', 3, 'asc', 'active', 1);
        $data['allCustomer'] = $this->common_model->getAll('password', 'type', 4, 'asc', 'active', 1);
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
        $this->load->view('projects/assigned_project');
        $this->load->view('home/footer');
    }

    public function getSearchAssignedProjectList()
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
            array_push($data, $val['project_name']);
        }
        echo json_encode($data);
    }

    public function add_assigned_project()
    {
        $w = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $assigned_id = $_POST['assigned_id'];
        $project_id = $_POST['assigned_project'];
        $is_assigned = trim($_POST['assign_status']);

        if (!empty($project_id)) {
            $data["project_id"] = $project_id;
            $data["project_engineer"] = trim($_POST['project_engineer']);
            $data["project_customer"] = trim($_POST['project_customer']);
            $data["assigned_date"] = trim($_POST['assigned_date']);
            $data["assign_note"] = trim($_POST['assign_note']);
            $data["is_assigned"] = $is_assigned;
            $data["assigned_by"] = trim($_POST['assigned_by']);
            if ($is_assigned == 3) {
                if (!empty($assigned_id)) {
                    $this->db->where('id', $assigned_id);
                    $this->db->update('tbl_assigned_project', $data);
                    $data1["is_assigned"] = $is_assigned;
                    $data1["assigned_by"] = trim($_POST['assigned_by']);
                    $this->db->where('id', $project_id);
                    $this->db->update('tbl_project', $data1);
                    $ara = array("id" => 3);
                }else{
                    $ara = array("id" => 4);
                }
            } else {
                $data["ware"] = $w;
                $this->db->insert('tbl_assigned_project', $data);
                $ara = array("id" => 2);//updated Into table;
            }

        } else {
            $ara = array("id" => 1);
        }
        echo json_encode($ara);
    }

    public function getAllAssignedProjectInfo()
    {

        $search_project = $_POST['search_assigned_project'];

        $w = $this->session->userdata('wire');
        $admin = $this->session->userdata('admin');
        $type = $this->session->userdata('type');

        $this->db->where("(ware='" . $w . "' OR ware='0')");
        $this->db->where("(is_assigned='1' OR is_assigned='3')");
        if ($type == 3) {
            $this->db->where('project_engineer', $admin);
        }
        if (!empty($search_project)) {
            $this->db->where("project_id", $search_project);
        }
        $this->db->order_by('id', 'asc');
        $info = $this->db->get("tbl_assigned_project");

        $res["list"] = array();

        foreach ($info->result_array() as $val) {

            $post = array();
            $post["id"] = $val["id"];
            $post["project_id"] = $val["project_id"];
            $post["project_name"] = $this->common_model->anyNameWithoutWare('tbl_project', 'id', $val["project_id"], 'project_name');
            $post["project_engineer"] = $this->common_model->anyNameWithoutWare('password', 'id', $val["project_engineer"], 'user');
            $post["project_customer"] = $this->common_model->anyNameWithoutWare('password', 'id', $val["project_customer"], 'user');
            $post["assigned_date"] = $val["assigned_date"];
            if (empty($val["assign_note"])) {
                $post["assign_note"] = "NONE";
            } else {
                $post["assign_note"] = $val["assign_note"];
            }
            if (empty($val["project_ticket"])) {
                $post["project_ticket"] = "NONE";
            } else {
                $post["project_ticket"] = $val["project_ticket"];
            }
            if ($val["is_assigned"] == 1) {
                $post["is_assigned"] = "ASSIGNED";
            } elseif ($val["is_assigned"] == 3) {
                $post["is_assigned"] = "HAND OVERED";
            } else {
                $post["is_assigned"] = "NO";
            }
            if ($val["assigned_by"]) {
                $post["assigned_by"] = $this->common_model->anyNameWithoutWare('password', 'id', $val["assigned_by"], 'user');
            } else {
                $post["assigned_by"] = "NONE";
            }

            array_push($res["list"], $post);
        }
        //print_r($res);
        echo json_encode($res);
    }

    public function getAssignedProjectInfo()
    {

        $id = $_POST['id'];
        $res["info"] = $this->common_model->getAnyInfoRow('tbl_assigned_project', 'id', $id);
        echo json_encode($res);
    }

    //.........................Assigned Project Functionality End..................................//
}