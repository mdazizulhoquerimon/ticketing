<?php

class Ticket_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getAllPriority()
    {
        return $this->db->select('*')->from('tbl_priority')->where('status', 1)->get()->result();
    }

    public function getAllTicketStatus()
    {
        return $this->db->select('*')->from('tbl_ticket_status')->where('status', 1)->get()->result();
    }

    public function getAllTicketSubject()
    {
        $type = $this->session->userdata('type');
        $ware_id = $this->session->userdata('wire');
        $sql = "SELECT * FROM tbl_ticket_subjects WHERE status=1";
        if ($type == 1) {
            return $this->db->query($sql)->result();
        } else {
            //$sql .= " AND ware_id= $ware_id";
            return $this->db->query($sql)->result();
        }
    }

    public function add_ticket()
    {
        $data['ticket_sub'] = $this->input->post('ticket_sub');
        // $data['message'] = $this->input->post('message');
        $data['priority_id'] = $this->input->post('priority');
        //$data['ticket_status_id'] = $this->input->post('ticket_status');
        $data['ticket_status_id'] = 1;//by default '1 = pending' ticket status
        $data['lock_by'] = 0;
        $data['rating'] = 0; // by default 0 for rating
        $data['ticket_date_time'] = $this->getDateTime();
        $data['ware_id'] = $this->session->userdata('wire');
        $data['user_id'] = $this->session->userdata('admin');
        $data['status'] = 1;
        if ($this->db->insert('tbl_tickets', $data)) {
            $ticket_id = $this->db->insert_id();
            $message['is_seen'] = 0;
            $message['message'] = $this->input->post('message');
            $message['to_whom'] = 0;//initially 0 will insert
            $message['user_id'] = $this->session->userdata('admin');
            $message['ticket_id'] = $ticket_id;
            $message['ware_id'] = $data['ware_id'];
            $message['status'] = 1;
            $message['message_time'] = $this->getDateTime();
            if ($this->db->insert('tbl_message_list', $message)) {
                return true;
            }
        }
    }

    public function getAllTicket()
    {
        $type = $this->session->userdata('type');
        $ware_id = $this->session->userdata('wire');
        $user_id = $this->session->userdata('admin');
        $rank = $this->session->userdata('rank');
        $sql = "SELECT tbl_tickets.*, tbl_ticket_status.ticket_status,tbl_priority.priority,password.user,password.rank
			FROM `tbl_tickets` 
			INNER JOIN tbl_ticket_status on tbl_tickets.ticket_status_id=tbl_ticket_status.id
			INNER JOIN tbl_priority on tbl_tickets.priority_id = tbl_priority.id
			INNER JOIN password on tbl_tickets.user_id = password.id
			WHERE tbl_tickets.ticket_status_id != 4";
        if ($type == 1 && $rank == 1) {//super-superAdmin
            return $this->db->query($sql)->result();
        } elseif ($type == 1) {
            $sql .= " AND tbl_tickets.lock_by = $user_id";
            return $this->db->query($sql)->result();
        } elseif ($type == 2) {//admin
            $sql .= " AND tbl_tickets.ware_id = $ware_id";
            return $this->db->query($sql)->result();
        } else {
            $sql .= " AND tbl_tickets.ware_id = $ware_id AND tbl_tickets.user_id=$user_id";
            return $this->db->query($sql)->result();
        }
    }

    public function getAllCompletedTicket()
    {
        $type = $this->session->userdata('type');
        $ware_id = $this->session->userdata('wire');
        $user_id = $this->session->userdata('admin');
        $rank = $this->session->userdata('rank');
        $sql = "SELECT tbl_tickets.*, tbl_ticket_status.ticket_status,tbl_priority.priority,password.user,password.rank
			FROM `tbl_tickets` 
			INNER JOIN tbl_ticket_status on tbl_tickets.ticket_status_id=tbl_ticket_status.id
			INNER JOIN tbl_priority on tbl_tickets.priority_id = tbl_priority.id
			INNER JOIN password on tbl_tickets.user_id = password.id
			WHERE tbl_tickets.ticket_status_id = 4";
        if ($type == 1 && $rank == 1) {//super-superAdmin
            return $this->db->query($sql)->result();
        } elseif ($type == 1) {
            $sql .= " AND tbl_tickets.lock_by = $user_id";
            return $this->db->query($sql)->result();
        } elseif ($type == 2) {//admin
            $sql .= " AND tbl_tickets.ware_id = $ware_id";
            return $this->db->query($sql)->result();
        } else {
            $sql .= " AND tbl_tickets.ware_id = $ware_id AND tbl_tickets.user_id=$user_id";
            return $this->db->query($sql)->result();
        }
    }

    public function fetch_ticket($ticket_id)
    {
        return $this->db->query("SELECT tbl_message_list.*, tbl_tickets.*
			 	FROM `tbl_tickets` 
				INNER JOIN tbl_message_list on tbl_tickets.ticket_id=tbl_message_list.ticket_id
    			WHERE tbl_tickets.ticket_id=$ticket_id")->row();
    }

    public function update_ticket()
    {
        $ticket_id = $this->input->post('ticket_id');
        $message_id = $this->input->post('message_id');
        $data['ticket_sub'] = $this->input->post('ticket_sub');
        $msg['message'] = $this->input->post('message');
        $q = $this->db->where('ticket_id', $ticket_id)->update('tbl_tickets', $data);
        $r = $this->db->where('message_id', $message_id)->update('tbl_message_list', $msg);
        if ($this->db->affected_rows() == '1') {
            $msg = 'Update successfully';
            $sts = 1;

        } else {
            $msg = 'Update failed';
            $sts = 0;
        }
        $temp = $this->db->query("SELECT tbl_message_list.*, tbl_tickets.*, tbl_ticket_status.ticket_status,tbl_priority.priority,password.user,password.rank
			FROM `tbl_tickets` 
			INNER JOIN tbl_ticket_status on tbl_tickets.ticket_status_id=tbl_ticket_status.id
			INNER JOIN tbl_priority on tbl_tickets.priority_id = tbl_priority.id
			INNER JOIN password on tbl_tickets.user_id = password.id
			INNER JOIN tbl_message_list on tbl_tickets.ticket_id=tbl_message_list.ticket_id
			WHERE tbl_tickets.ticket_id = $ticket_id")->result();
        $arr = array(

            'msg' => $msg,
            'sts' => $sts,
            'temp' => $temp
        );
        return $arr;
    }

    public function get_allTicket_notLock()
    {
        return $this->db->query("SELECT * FROM tbl_tickets WHERE lock_by=0")->result();
    }

    public function assign_to()
    {
        $ticket_id = $this->input->post('ticket_id');
        $data['lock_by'] = $this->input->post('admin_id');
        $msg['to_whom'] = $data['lock_by'];
        $this->db->where('ticket_id', $ticket_id)->update('tbl_tickets', $data);
        $this->db->where('ticket_id', $ticket_id)->update('tbl_message_list', $msg);
        if ($this->db->affected_rows() == '1') {
            return true;
        }
    }

    public function check_incomplete()
    {
        $user_id = $this->session->userdata('admin');
        return $this->db->query("SELECT * FROM `tbl_tickets` 
									INNER JOIN tbl_ticket_status ON tbl_tickets.ticket_status_id = tbl_ticket_status.id
									WHERE tbl_tickets.lock_by = $user_id AND tbl_ticket_status.ticket_status != 'Complete'")->result();
    }

    public function reply_message($ticket_id)
    {
        return $this->db->query("SELECT * FROM tbl_message_list WHERE ticket_id=$ticket_id")->result();
    }

    public function complete_ticket()
    {
        $data['rating'] = $this->input->post('rate');
        $ticket_id = $this->input->post('ticket_id');
        $data['ticket_status_id'] = 4; //4=complete from tbl_ticket_status
        //$this->db->where('ticket_id',$ticket_id)->update('tbl_tickets',$data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->update('tbl_tickets', $data);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
    }

    public function chat_ticket()
    {
        $ticket_id = $this->input->post('ticket_id');
        $msg['message'] = $this->input->post('msg');
        $data['user_id'] = $this->session->userdata('admin');
        $data['type'] = $this->session->userdata('type');

        $ticket_info = $this->db->select('*')->from('tbl_tickets')->where('ticket_id', $ticket_id)->get()->row();

        if ($data['user_id'] == $ticket_info->user_id) {

            $msg['to_whom'] = $ticket_info->lock_by;
            $msg['user_id'] = $data['user_id'];
        } elseif ($data['type'] == 1) {
            $msg['to_whom'] = $ticket_info->user_id;
            $msg['user_id'] = $ticket_info->lock_by;
        }
        $msg['is_img'] = 0;
        $msg['ticket_id'] = $ticket_info->ticket_id;
        $msg['ware_id'] = $this->session->userdata('wire');
        $msg['message_time'] = $this->getDateTime();
        $this->db->insert('tbl_message_list', $msg);
        return $msg;
    }
}