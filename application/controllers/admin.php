<?php

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $admin_user = $this->session->userdata('admin');
        if (empty($admin_user)) {
            redirect('member/adminlogin');
        }
    }

    public function index()
    {
        $data['setting'] = "";
        $data['type'] = 0;

        $admin = $this->session->userdata('admin');
        $t = $this->session->userdata('wire');
        $type = $this->session->userdata('type');

        $this->load->view('home/headar', $data);

        $data['wire'] = $this->common_model->getWareList('ware', 'name', 'asc');

        if ($type == 1)
            $this->load->view('home/index', $data);
        else
            $this->load->view('home/blank');

        $this->load->view('home/footer');

    }

    function logout()
    {
        $this->session->unset_userdata('admin');
        $this->session->unset_userdata('cid');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('admin');
        $this->session->unset_userdata('barcode');
        redirect('admin');
    }

    public function user_all()
    {
        $data['setting'] = "";
        $data['type'] = 0;

        $admin = $this->session->userdata('admin');
        $t = $this->session->userdata('wire');
        $type = $this->session->userdata('type');

        $this->load->view('home/headar', $data);

        $data['user'] = $this->common_model->getAll('password');

        $this->load->view('admin/user_all', $data);
        $this->load->view('home/footer');

    }

    public function create_user()
    {

        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');

        $data['type'] = 0;
        $data['ware'] = $this->common_model->getWare('ware', 'name', 'asc', 1);

        $this->load->view('home/headar', $data);
        $this->load->view('admin/create_user', $data);
        $this->load->view('home/footer');

    }

    public function change_wire($id = null)
    {
        if (!empty($id)) {
            $this->session->unset_userdata('admin');
            //$this->session->unset_userdata('type');
            $this->session->unset_userdata('wire');
            $this->session->set_userdata('wire', $id);
            $this->db->where('ware', $id);
            $info = $this->db->get('password');
            $row = $info->row();
            //$this->session->set_userdata('id',$row->id);
            $this->session->set_userdata('admin', $row->id);
            //$this->session->set_userdata('type',$row->type);
            //echo $row->id;
        }
        redirect('admin');

    }

}

?>