<?php

class Common_model extends CI_Model
{
    public function getAll($table, $col = null, $val = null, $asc = null,$col3 = null, $val3 = null)
    {

        $w = $this->session->userdata('wire');
        if (!empty($w))
            $this->db->where("(ware='" . $w . "' OR ware='0')");
        if (empty($asc))
            $this->db->order_by('id', 'DESC');
        else
            $this->db->order_by('id', 'asc');
        if (!empty($col))
            $this->db->where($col, $val);
        if (!empty($col3))
            $this->db->where($col3, $val3);

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

    public function getWareList($table, $col = null, $asc = null, $check = null)
    {
        $this->db->where('ch !=', 0);
        $this->db->order_by($col, $asc);
        $info = $this->db->get($table);
        return $info->result_array();
    }

    public function getAnyInfoRow($table, $col, $val)
    {
        if (!empty($col)) {
            $this->db->where($col, $val);
        }
        $info = $this->db->get($table);
        return $info->row();
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
        $this->db->where("(ware='" . $w . "' OR ware='0')");
        $this->db->where($col, $id);
        $info = $this->db->get($table);
        foreach ($info->result_array() as $val) {
            return $val[$name];
        }
    }

    public function anyNameWithoutWare($table, $col, $id, $name, $col2 = null, $id2 = null, $col3 = null, $id3 = null)
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