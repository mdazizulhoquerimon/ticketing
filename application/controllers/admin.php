<?php

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('news_model');
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
        $this->load->model('setting');

        $data['setting'] = "";
        $data['type'] = 0;
        //$data['head']=$this->setting->getAll('setting','head',0);

        $admin = $this->session->userdata('admin');
        $t = $this->session->userdata('wire');
        $type = $this->session->userdata('type');

        //$data['store'] = $this->setting->getAll('store_list');

        $this->load->view('home/headar', $data);

        $data['wire'] = $this->setting->getWireList('ware', 'name', 'asc', 2);

        if ($type == 1)
            $this->load->view('home/index', $data);
        else
            $this->load->view('home/blank');

        //}

        $this->load->view('home/footer');

    }

    public function pimage_update()
    {

        $data['type'] = 0;
        $this->load->view('home/headar', $data);

        $this->load->view('home/pimage_update');
        $this->load->view('home/footer');


    }

    public function transfer()
    {


        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');

        $data['type'] = 0;

        $this->load->model('setting');


        if (empty($admin))
            redirect('admin');


        $data['store'] = $this->setting->getStoreList('store_list');
        $this->load->view('home/headar', $data);


        $data['max'] = (int)$this->setting->getMax('product', 'transfer') + 1;

        $this->load->view('admin/transfer', $data);


        $this->load->view('home/footer');


    }


    public function getLedgerHead()
    {

        $res["list"] = array();

        $this->load->model('user_head');
        $this->load->model('setting');

        $test = array();
        $test = $this->user_head->getHealList2("setting", 'head', 83, 0, $test);
        $length = count($test);
        for ($i = $length - 1; $i >= 0; $i--) {

            $post = array();
            $post["id"] = $test[$i];
            $post["name"] = $this->setting->anyName("setting", "id", $test[$i], "name");
            array_push($res["list"], $post);

        }
        echo json_encode($res);


    }

    public function create_connect_ware()
    {

        $this->load->model('setting');


        $w = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');

        $this->load->model('setting');

        $data['ware'] = $this->setting->getConnectLessWare('ware', 'name', 'asc', 2, "id !=", $w);

        $data['type'] = 0;

        $this->load->view('home/headar', $data);
        $this->load->view('setting/add_connect_ware', $data);
        $this->load->view('home/footer');


    }

    public function create_new_customer($id = null, $head, $ob)
    {


        $this->load->model('setting');


        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');


        $data['type'] = 0;
        $data['setting'] = "Setting";
        $data['all'] = $this->setting->getAll('setting', 'head', $id);
        $data['head'] = $this->setting->getAll('setting', 'head', $id);
        $data['ware'] = $this->setting->getWare('ware', 'name', 'asc', $ware);


        $data['id'] = $id;
        $data['id2'] = $head;
        $data['ob'] = $ob;

        $this->load->view('home/headar', $data);
        $this->load->view('admin/customer', $data);
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

    public function journal_post_change()
    {

        $this->load->model('setting');
        $this->load->model('report_model');

        $admin = $this->session->userdata('admin');
        $w = $this->session->userdata('wire');


        $id = $_POST['id'];
        $voucher = $_POST['vou'];
        $val = $_POST['value'];


        if ($val == 1) {

            $led = $this->report_model->anyName('product_trans', 'id', $id, 'cr');
            $col = $led;
            $cols = 0;
        } else {

            $led = $this->report_model->anyName('product_trans', 'id', $id, 'dr');
            $col = 0;
            $cols = $led;
        }


        $data = array(

            "dr" => $col,
            "cr" => $cols,
            "d_c" => $val


        );

        /*	$data=array(


                "d_c" => $val


            );
            */

        $this->db->where('voucher', $voucher);
        $this->db->where('ware', $w);
        $this->db->where('id', $id);
        $this->db->update('product_trans', $data);


        $this->db->order_by("id", "desc");
        $this->db->where('ware', $w);
        $this->db->where("voucher", $voucher);
        $this->db->where("type", 10);
        $this->db->where("by", $admin);
        $info = $this->db->get('product_trans');


        $response["posts"] = array();

        foreach ($info->result_array() as $val) {

            $post = array();
            $post["voucher_no"] = $val["voucher"];
            $post["id"] = $val["id"];
            $post["date"] = $val["date"];
            $post["amount"] = $val["amount"];
            $post["type"] = $val["d_c"];
            $post["ledger"] = $this->setting->anyName('ledger', 'id', $val["l_type"], 'ledger_title');
            $post["description"] = $val["description"];
            array_push($response["posts"], $post);

        }

        echo json_encode($response);


    }

    public function journal_post_delete()
    {

        $admin = $this->session->userdata('admin');
        $w = $this->session->userdata('wire');

        $id = $_POST['id'];
        $voucher = $_POST['vou'];

        $this->load->model('setting');
        $this->db->where('id', $id);
        if (!empty($w))
            $this->db->where('ware', $w);
        $this->db->delete('product_trans');


        if (!empty($w))
            $this->db->where('ware', $w);
        $this->db->order_by("id", "desc");
        $this->db->where("voucher", $voucher);
        $this->db->where("type", 10);
        //$this->db->where("by",$admin);
        $info = $this->db->get('product_trans');


        $response["posts"] = array();

        foreach ($info->result_array() as $val) {

            $post = array();
            $post["voucher_no"] = $val["voucher"];
            $post["id"] = $val["id"];
            $post["date"] = $val["date"];
            $post["amount"] = $val["amount"];
            $post["type"] = $val["d_c"];
            $post["ledger"] = $this->setting->anyName('ledger', 'id', $val["l_type"], 'ledger_title');
            $post["description"] = $val["description"];
            array_push($response["posts"], $post);

        }

        echo json_encode($response);


    }


    public function journal_update()
    {

        $this->load->database();
        $id = $_POST['id'];
        $credit = $_POST['credit'];
        $debit = $_POST['debit'];
        $vou = $_POST['vou'];

        $this->db->where('id', $id);
        $data = array(

            "amount" => ($credit + $debit)

        );

        $this->db->update('product_trans', $data);


        $this->db->where('d_c', 1);
        $this->db->where('voucher', $vou);
        $this->db->select_sum('amount');
        $query = $this->db->get('product_trans');
        $debits = null;
        foreach ($query->result_array() as $val) {

            $debits = $val['amount'];

        }


        $this->db->where('d_c', 2);
        $this->db->where('voucher', $vou);
        $this->db->select_sum('amount');
        $query = $this->db->get('product_trans');
        $credits = null;
        foreach ($query->result_array() as $val) {

            $credits = $val['amount'];

        }


        $da = array(

            "debit" => $debits,
            "credit" => $credits

        );

        echo json_encode($da);


    }

    public function journal_post_ajax()
    {

        $admin = $this->session->userdata('admin');
        $w = $this->session->userdata('wire');

        $this->load->model('setting');

        $voucher = $_POST['voucher'];
        $date = $_POST['date'];
        $ladger = $_POST['lader'];
        $type = $_POST['type'];
        $desc = $_POST['desc'];
        $amount = $_POST['amount'];


        $value = explode("*", $ladger);

        $l_id = $this->setting->anyName('ledger', 'id', $value[1], 'parent_head_id');


        $dr = 0;
        $cr = 0;
        if ($type == 1) {

            $dr = $value[1];
            $cr = 0;
        } else if ($type == 2) {

            $cr = $value[1];
            $dr = 0;

        }


        if (!empty($voucher)) {

            $data = array(
                'voucher' => $voucher,
                'd_c' => $type,
                'type' => 10,
                'dr' => $dr,
                'cr' => $cr,
                'status' => 1,
                'amount' => $amount,
                'description' => $desc,
                'date' => date("Y-m-d", strtotime($date)),
                'l_id' => $l_id,
                'l_type' => $value[1],
                'ware' => $w,
                'by' => $this->session->userdata('admin'),

            );


            $this->db->insert('product_trans', $data);
        }


        $response["posts"] = array();
        if (!empty($w))
            $this->db->where('ware', $w);
        $this->db->where("voucher", $voucher);
        $this->db->where("status", 1);
        $this->db->where("type", 10);
        $info = $this->db->get('product_trans');
        foreach ($info->result_array() as $val) {

            $post = array();
            $post["voucher_no"] = $val["voucher"];
            $post["id"] = $val["id"];
            $post["date"] = $val["date"];
            $post["amount"] = $val["amount"];
            $post["type"] = $val["d_c"];
            $post["ledger"] = $this->setting->anyName('ledger', 'id', $val["l_type"], 'ledger_title');
            $post["description"] = $val["description"];
            array_push($response["posts"], $post);

        }

        echo json_encode($response);
    }

    public function journal_posting()
    {


        $this->load->model('setting');

        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');

        if (empty($admin))
            redirect('admin');

        $data['type'] = 10;

        $this->load->view('home/headar', $data);

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('ledger', 'ledger', 'required');

        if ($this->form_validation->run() === FALSE) {


            $data['bank'] = $this->setting->getAllBank('ledger');


            $w = $this->session->userdata('wire');

            if (!empty($ware))
                $this->db->where("ware", $w);
            $this->db->limit(1);
            $this->db->order_by("voucher", "DESC");
            $query = $this->db->get("product_trans");
            $row = $query->row();

            if (!empty($row->voucher)) {


                $data['voucher_no'] = $row->voucher + 1;


            } else {


                $data['voucher_no'] = 1;


            }


            $data['type'] = 10;

            $this->load->view('admin/transaction_new', $data);
            $this->load->view('home/footer');


        }


    }


    public function bank($id = null)
    {

        $this->load->model('setting');
        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');

        if (empty($admin))
            redirect('admin');

        $data['type'] = 0;

        /*if($type == 3)
                {
                    $data['all2']=$this->news_model->getMenuData($ware,$admin);
                    $this->load->view('main/header2',$data);

                }
                else{
                    */
        $this->load->view('home/headar', $data);

        //}


        //$data['type']=0;
        //$this->load->view('main/header',$data);

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('ledger', 'ledger', 'required');

        if ($this->form_validation->run() === FALSE) {


            $data['bank'] = $this->setting->getAllBank('ledger');


            $w = $this->session->userdata('wire');

            if (!empty($ware))
                $this->db->where("ware", $w);

            $this->db->order_by("voucher", "DESC");
            $this->db->limit(1);
            $query = $this->db->get("product_trans");
            $row = $query->row();

            if (!empty($row->voucher)) {


                $data['voucher_no'] = $row->voucher + 1;


            } else {


                $data['voucher_no'] = 1;


            }


            $data['type'] = $id;

            $this->load->view('admin/bank_withdraw', $data);
            $this->load->view('home/footer');


        }


    }

    public function new_tran($ty = null)
    {

        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');

        if (empty($admin))
            redirect('admin');


        $data['type'] = 0;

        /*if($type == 3)
                {
                    $data['all2']=$this->news_model->getMenuData($ware,$admin);
                    $this->load->view('main/header2',$data);

                }
                else{
                    */
        $this->load->view('home/headar', $data);

        //}

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('ledger', 'ledger', 'required');

        if ($this->form_validation->run() === FALSE) {


            $w = $this->session->userdata('wire');
            if (!empty($ware))
                $this->db->where("ware", $w);

            $this->db->order_by("voucher", "DESC");
            $this->db->limit(1);
            $query = $this->db->get("product_trans");
            $row = $query->row();

            if (!empty($row->voucher)) {


                $data['voucher_no'] = $row->voucher + 1;


            } else {


                $data['voucher_no'] = 1;


            }

            $data['type'] = $ty;

            $this->load->view('admin/new_trans', $data);
            $this->load->view('home/footer');


        }


    }


    public function transaction_history2()
    {

        $this->load->model('report_model');

        $data['setting'] = "";
        $data['type'] = 0;
        $data['head'] = $this->report_model->getAll('setting', 'head', 0);

        $admin = $this->session->userdata('admin');
        $w = $this->session->userdata('wire');
        $t = $this->session->userdata('type');

        if (empty($admin))
            redirect('admin');

        /*if($t == 3)
                {
                    $data['all2']=$this->report_model->getMenuData($ware,$admin);
                    $this->load->view('main/header2',$data);

                }
                else{
                    */
        $this->load->view('home/headar', $data);

        //	}


        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('start_date', 'start_date', 'required');
        $this->form_validation->set_rules('end_date', 'end_date', 'required');


        if ($this->form_validation->run() === FALSE) {

            $data['start'] = date('d-m-Y');
            $data['end'] = date('d-m-Y');


        } else {


            $data['start'] = $this->input->post('start_date');
            $data['end'] = $this->input->post('end_date');


        }

        $this->load->view('admin/trans_history', $data);
        $this->load->view('home/footer');

    }


    public function stock_transaction()
    {

        $this->load->model('setting');

        $data['setting'] = "";
        $data['type'] = 0;

        //$this->load->view('main/header',$data);

        $t = $this->session->userdata('type');


        /*if($t == 3)
                {
                    $data['all2']=$this->news_model->getMenuData($ware,$admin);
                    $this->load->view('main/header2',$data);

                }
                else{
                    */
        $this->load->view('home/headar', $data);

        //}


        $w = $this->session->userdata('wire');

        if (!empty($w))
            $this->db->where("ware", $w);

        $this->db->order_by("invoice", "DESC");
        $this->db->limit(1);
        $query = $this->db->get("invoice");
        $row = $query->row();

        if (!empty($row->invoice)) {
            $data['voucher_no'] = $row->invoice + 1;
        } else {

            $data['voucher_no'] = 1;

        }

        $this->load->view('admin/stock_journal', $data);
        $this->load->view('home/footer');

    }


    public function saleNewFormat($id = null)
    {

        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');


        $this->load->model('setting');


        if (empty($admin))
            redirect('admin');


        $data['type'] = $id;

        $data['store'] = $this->setting->getAll('store_list', '', '', '1', '');

        $this->load->view('home/headar', $data);

        //}

        $data['max'] = $this->setting->getMax('invoice', 'invoice');


        $data['bank'] = $this->setting->getBank('ledger');
        $this->load->view('admin/purchase_new_format', $data);


        $this->load->view('home/footer');

    }


    public function new_purchase($id = null)
    {

        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');


        $this->load->model('setting');


        if (empty($admin))
            redirect('admin');


        $data['type'] = $id;

        $data['store'] = $this->setting->getAll('store_list', '', '', '1', '');

        $this->load->view('home/headar', $data);

        //}

        $data['max'] = $this->setting->getMax('invoice', 'invoice');
        $data['bank'] = $this->setting->getBank('ledger');
        $this->load->view('admin/purchase', $data);


        $this->load->view('home/footer');

    }


    public function user_all()
    {

        $this->load->model('setting');
        $data['setting'] = "";
        $data['type'] = 0;
        //$data['head']=$this->news_model->getAll('setting','head',0);

        $admin = $this->session->userdata('admin');
        $t = $this->session->userdata('wire');
        $type = $this->session->userdata('type');

        $this->load->view('home/headar', $data);
        //$data['user']=$this->setting->getAll('password');

        /*if($t == 0 || $type == 1)
            {



            $this->load->view('home/headar',$data);
            //$data['wire']=$this->news_model->getWireList('ware','name','asc',2);
            //$this->load->view('user/dashboard',$data);

            }
        else{

            if($type == 3)
                {
                    $data['all2']=$this->news_model->getMenuData($t,$admin);
                    $this->load->view('main/header2',$data);

                }
                else{





                $this->load->view('main/header',$data);

                }


        }
        */


        $data['user'] = $this->setting->getCurrWare('password');


        $this->load->view('admin/user_all', $data);
        $this->load->view('home/footer');


    }


    public function create_user()
    {

        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');


        $this->load->model('setting');

        $data['type'] = 0;
        $data['ware'] = $this->setting->getWare('ware', 'name', 'asc', 1);


        /*if($type == 3)
                {
                    $data['all2']=$this->news_model->getMenuData($ware,$admin);
                    $this->load->view('main/header2',$data);

                }
                else{
                    */
        $this->load->view('home/headar', $data);

        //}


        $this->load->view('admin/create_user', $data);


        $this->load->view('home/footer');

    }


    public function create_new()
    {


        $this->load->model('setting');

        $ware = $this->session->userdata('wire');
        $type = $this->session->userdata('type');
        $admin = $this->session->userdata('admin');

        $data['type'] = 0;
        $data['setting'] = "Setting";
        $data['all'] = $this->setting->getAll('setting', 'head', 0);
        $data['head'] = $this->setting->getAll('setting', 'head', 0);
        $data['ware'] = $this->setting->getWare('ware', 'name', 'asc', $ware);
        $this->load->view('home/headar', $data);

        $this->load->view('setting/create', $data);
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