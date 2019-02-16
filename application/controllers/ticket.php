<?php

class Ticket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ticket_model');
        $this->load->model('common_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library("pagination");
        $admin_user = $this->session->userdata('admin');
        if (empty($admin_user)) {
            redirect('member/adminlogin');
        }
    }

    public function create_ticket()
    {
        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');
        $data['type'] = 0;
        $data['ticketSubject'] = $this->ticket_model->getAllTicketSubject();
        $data['priorityList'] = $this->ticket_model->getAllPriority();
        $data['ticketStatusList'] = $this->ticket_model->getAllTicketStatus();
        $this->load->view('home/headar', $data);
        $this->load->view('ticket/create_ticket_view', $data);
        $this->load->view('home/footer');
    }

    public function add_ticket()
    {
        echo json_encode($this->ticket_model->add_ticket());
    }

    public function all_ticket()
    {
        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');
        $rank = $this->session->userdata('rank');
        $data['type'] = 0;
        $data['ticketList'] = $this->ticket_model->getAllTicket();
        // $data['priorityList']    = $this->ticket_model->getAllPriority();
//        echo("<pre>");
//        print_r($data);
//        exit;


        $data['ticketSubject'] = $this->ticket_model->getAllTicketSubject();
        //$data['ticketStatusList']= $this->ticket_model->getAllTicketStatus();
        if ($rank == 1) {
            $data['notLockTicket'] = $this->ticket_model->get_allTicket_notLock();
            $data['allAdmin'] = $this->db->query("SELECT * FROM password WHERE type=3")->result();
        }
        $this->load->view('home/headar', $data);
        $this->load->view('ticket/all_ticket_view', $data);
        $this->load->view('home/footer');
    }

    public function fetch_ticket()
    {
        $ticket_id = $this->input->post('ticket_id');
        $data['aTicket'] = $this->ticket_model->fetch_ticket($ticket_id);
        echo json_encode($data['aTicket']);
    }

    public function update_ticket()
    {
        echo json_encode($this->ticket_model->update_ticket());
    }

    public function get_notLockTicket()
    {
        $data['notLockTicket'] = $this->ticket_model->get_allTicket_notLock();
        //$data['allAdmin'] = $this->db->query("SELECT * FROM password WHERE type=1")->result();
        echo json_encode($data);
    }

    public function assign_to()
    {
        $data['assignConfirm'] = $this->ticket_model->assign_to();
        $data['notLockTicket'] = $this->ticket_model->get_allTicket_notLock();
        echo json_encode($data);
    }

    public function check_incomplete()
    {
        $data['notification'] = $this->ticket_model->check_incomplete();
        echo json_encode($data);
    }

    public function reply_message($id)
    {
        $data['type'] = 0;
        $data['messages'] = $this->ticket_model->reply_message($id);
        $data['ticket_id'] = $id;
        $this->load->view('home/headar', $data);
        $this->load->view('ticket/reply_message_view', $data);
        $this->load->view('home/footer');
    }

    public function complete_ticket()
    {
        echo json_encode($this->ticket_model->complete_ticket());
    }

    public function chat_ticket()
    {
        echo json_encode($this->ticket_model->chat_ticket());
    }

    public function all_completed_ticket()
    {
        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');
        $data['type'] = 0;
        $data['ticketList'] = $this->ticket_model->getAllCompletedTicket();
        $data['ticketSubject'] = $this->ticket_model->getAllTicketSubject();
        $data['priorityList'] = $this->ticket_model->getAllPriority();
        $data['ticketStatusList'] = $this->ticket_model->getAllTicketStatus();
        $this->load->view('home/headar', $data);
        $this->load->view('ticket/completed_ticket_view', $data);
        $this->load->view('home/footer');
    }

    public function upld()
    {
        $ticket_id = $_POST['ticket_id'];


        $ticket_info = $this->db->select('*')->from('tbl_tickets')->where('ticket_id', $ticket_id)->get()->row();
        $data['user_id'] = $this->session->userdata('admin');
        $data['type'] = $this->session->userdata('type');


        $config['upload_path'] = 'pic_upload/';
        $config['allowed_types'] = '*';
        // $config['max_filename'] = '255';
        //$config['encrypt_name'] = TRUE;
        $config['max_size'] = '2048000'; // MB

        if (isset($_FILES['file']['name'])) {
            $userfile_name = $_FILES['file']['name'];
            $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.') + 1);

            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                $this->load->library('upload', $config);

                //echo 'File successfully uploaded : uploads/' . $_FILES['file']['name'];

                if ($data['user_id'] == $ticket_info->user_id) {
                    $msg['to_whom'] = $ticket_info->lock_by;
                    $msg['user_id'] = $data['user_id'];
                } elseif ($data['type'] == 1) {
                    $msg['to_whom'] = $ticket_info->user_id;
                    $msg['user_id'] = $ticket_info->lock_by;
                }
                // $msg['message'] = $ticket_id.'-'.$_FILES['file']['name'];
                $msg['is_img'] = 1;
                $msg['ticket_id'] = $ticket_info->ticket_id;
                $msg['ware_id'] = $this->session->userdata('wire');
                $msg['message_time'] = $this->ticket_model->getDateTime();
                $msg['status'] = 0;
                $this->db->insert('tbl_message_list', $msg);
                $message_id = $this->db->insert_id();
                $config['file_name'] = $message_id . '-' . 'file.' . $userfile_extn;

                $this->upload->initialize($config);

                $this->upload->do_upload('file');
                $message = $message_id . '-' . 'file.' . $userfile_extn;
                $this->db->where('message_id', $message_id);
                $this->db->update('tbl_message_list', array('message' => $message));
                echo "uploaded";

            }
        } else {
            echo 'Please choose a file';
        }
    }

}