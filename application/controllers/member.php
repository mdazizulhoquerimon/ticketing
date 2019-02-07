<?php

class Member extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //$this->load->model('news_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('email');

    }


    function adminlogin()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[1]');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/login');
        } else {
            $this->load->database();
            $data = array(
                'name' => $this->input->post('name'),
                'pass' => $this->input->post('password'),
            );
            $this->db->where('user', $data['name']);
            $query = $this->db->get("password");
            $row = $query->row();
            if(!empty($row)){
                if ($row->password == $data['pass']) {
                    $this->session->set_userdata('admin', $row->id);
                    $this->session->set_userdata('type', $row->type);
                    $this->session->set_userdata('wire', $row->ware);
                    $this->session->set_userdata('rank',$row->rank);
                    session_start();
                    $session_id = session_id();
                    $da = array(
                        "session" => $session_id
                    );
                    $this->db->where('id', $row->id);
                    $this->db->update('password', $da);
                    if (!empty($row->ware)) {
                        $this->db->where('id', $row->ware);
                        $querys = $this->db->get("ware");
                        $rows = $querys->row();
                        $this->session->set_userdata('barcode', $rows->barcode);
                        /*if(!empty($row->type)){
                            if($row->type == 3){
                                $this->db->where('ware',$row->ware);
                                $this->db->where('user',$row->id);
                                $info=$this->db->get('user_access');

                                $response["posts"]= array();
                                foreach($info->result_array() as $val)
                                    {
                                    $post= array();
                                    $post['head']=$val['head'];
                                    $post['sub']=$val['sub'];
                                    array_push($response["posts"],$post);

                                    }
                            $this->session->set_userdata('access', $response);
                            }

                        }*/
                    }
                    /*
                    session_start();
                    $session_id = session_id( );
                    $da=array(
                        "session" => $session_id
                    );
                    $this->db->where('id',$row->id);
                    $this->db->update('password',$da);
                    */
                    redirect('admin');

                } else {

                    $this->load->view('admin/login');
                }
            }else{
                $this->session->set_flashdata('error', 'UserName or password mismatch');
                $this->load->view('admin/login');
            }
        }
    }
}