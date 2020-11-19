<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main_model extends CI_Model
{

    function login($table, $username, $password)
    {
        $query = $this->db->get_where($table, array('username' => $username, 'password' => $password, 'status' => 'aktif'));
        if ($query->num_rows() > 0) return true;
        else return false;
    }
    function get_data($nama_tabel)
    {
        $query = $this->db->get($nama_tabel);
        if ($query->num_rows() > 0) {
            return $query;
        } else return false;
    }
    function get_data_where($nama_tabel, $id, $value_id)
    {
        $query = $this->db->get_where($nama_tabel, array($id => $value_id));
        if ($query->num_rows() > 0) {
            return $query;
        } else return false;
    }
    function get_data_sort($nama_tabel, $order_by, $order)
    {
        $this->db->order_by($order_by, $order);
        $query = $this->db->get($nama_tabel);
        if ($query->num_rows() > 0) {
            return $query;
        } else return false;
    }
    function get_data_one($nama_tabel, $id, $value_id, $data)
    {
        $query = $this->db->get_where($nama_tabel, array($id => $value_id));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {
                return $r->$data;
            }
        }
    }
}
