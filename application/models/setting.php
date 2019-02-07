<?php

class Setting extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function anyTwiceName($table, $col, $id, $name, $col2 = null, $id2 = null, $col3 = null, $id3 = null)
    {

        $w = $this->session->userdata('wire');


        if (!empty($col2)) {

            $this->db->where($col2, $id2);

        }
        if (!empty($col3)) {

            $this->db->where($col3, $id3);

        }

        $this->db->where("(ware='" . $w . "')");


        $this->db->where($col, $id);
        $info = $this->db->get($table);
        foreach ($info->result_array() as $val) {

            return $val['cus'] . "*" . $val['sup'];

        }

    }

    public function getAllBank($table, $col = null, $id = null)
    {


        $w = $this->session->userdata('wire');
        if (!empty($w))
            $this->db->where('ware', $w);


        $this->db->where('bank_name !=', '');
        $this->db->where('bank_name !=', 'null');
        $info = $this->db->get($table);
        return $info->result_array();
    }

    public function getMax($table, $col)
    {


        $w = $this->session->userdata('wire');

        if (!empty($w))
            $this->db->where('ware', $w);

        //	$this->db->select_max($col,'invoice');
        $this->db->select_max($col, $col);
        $info = $this->db->get($table);
        foreach ($info->result_array() as $val) {


            return $val[$col];
        }
    }

    public function getBank($table)
    {

        $w = $this->session->userdata('wire');

        if (!empty($w))
            $this->db->where("(ware='" . $w . "' OR ware='0')");


        $this->db->order_by('bank_name', 'asc');
        $this->db->where('bank_name !=', 'null');
        $this->db->where('bank_name !=', '');
        $info = $this->db->get($table);

        return $info->result_array();

    }

    public function getStoreList($table, $col = null, $val = null)
    {
        $w = $this->session->userdata('wire');

        if (!empty($w))
            $this->db->where("(ware='" . $w . "' OR ware='0')");
        if (!empty($col))
            $this->db->where($col, $val);

        $info = $this->db->get($table);

        return $info->result_array();

    }

    public function getWireList($table, $col = null, $asc = null, $check = null)
    {


        $this->db->where('ch !=', 0);

        $this->db->order_by($col, $asc);
        $info = $this->db->get($table);

        return $info->result_array();

    }

    public function getConnectLessWare($table, $col = null, $asc = null, $check = null, $col2 = null, $val2 = null, $col3 = null, $val3 = null)
    {


        if (!empty($col2))
            $this->db->where($col2, $val2);
        if (!empty($col3))
            $this->db->where($col3, $val3);

        if (!empty($col))
            $this->db->order_by($col, $asc);
        $info = $this->db->get($table);

        return $info->result_array();

    }

    public function anyName($table, $col, $id, $name, $col2 = null, $id2 = null, $col3 = null, $id3 = null)
    {


        $w = $this->session->userdata('wire');


        if (!empty($col2)) {

            $this->db->where($col2, $id2);

        }
        if (!empty($col3)) {

            $this->db->where($col3, $id3);

        }

        $this->db->where("(ware='" . $w . "' or ware='0')");


        $this->db->where($col, $id);
        $info = $this->db->get($table);
        foreach ($info->result_array() as $val) {

            return $val[$name];

        }


        return 0;

    }

    public function getAll($table, $col = null, $val = null, $col2 = null, $val2 = null)
    {

        $w = $this->session->userdata('wire');

        if (!empty($w) && $table != 'setting')
            $this->db->where("(ware='" . $w . "' OR ware='0')");


        if (empty($col2))
            $this->db->order_by('id', 'DESC');
        else
            $this->db->order_by('id', 'asc');


        if (!empty($col))
            $this->db->where($col, $val);
        $info = $this->db->get($table);
        return $info->result_array();
    }

    public function getCurrWare($table, $col = null, $val = null, $col2 = null, $val2 = null)
    {

        $w = $this->session->userdata('wire');

        if (!empty($w) && $table != 'setting')
            $this->db->where("(ware='" . $w . "')");


        if (empty($col2))
            $this->db->order_by('id', 'DESC');
        else
            $this->db->order_by('id', 'asc');


        if (!empty($col))
            $this->db->where($col, $val);
        $info = $this->db->get($table);
        return $info->result_array();
    }

    public function getWare($table, $col, $asc, $check = null)
    {


        $wire = $this->session->userdata('wire');
        $type = $this->session->userdata('type');

        if (!empty($wire))
            $this->db->where('id', $wire);

        //$this->db->where('ch !=','');

        $this->db->order_by($col, $asc);
        $info = $this->db->get($table);

        return $info->result_array();

    }

    public function getPname($table, $col, $id, $name, $col2 = null, $id2 = null, $col3 = null, $id3 = null)
    {


        $this->db->where($col, $id);
        if (!empty($col2))
            $this->db->where($col2, $id2);
        if (!empty($col3))
            $this->db->where($col3, $id3);

        $info = $this->db->get($table);

        foreach ($info->result_array() as $val) {


            return $val[$name];

        }


    }


}


?>