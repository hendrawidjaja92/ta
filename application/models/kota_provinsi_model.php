<?php
/**
 * Created by PhpStorm.
 * User: Vanny
 * Date: 4/16/2015
 * Time: 8:39 AM
 */

class kota_provinsi_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    //fill your contry dropdown
    public function getProvinsi()
    {
        $this->db->select('id_provinsi,nama_provinsi');
        $this->db->from('provinsi');
        $query = $this->db->get();
        // the query mean select cat_id,category from category
        foreach($query->result_array() as $row){
            $data[0]= "--Select Provinsi--";
            $data[$row['id_provinsi']]=$row['nama_provinsi'];
        }
        // the fetching data from database is return
        return $data;
    }
    public function getKota($id)
    {
        $this->db->select('id_kota,nama_kota');
        $this->db->from('kota');
        $this->db->where('id_provinsi',$id);

        $query = $this->db->get();
        // the query mean select cat_id,category from category
        foreach($query->result_array() as $row){
            $data[$row['id_kota']]=$row['nama_kota'];
        }
        // the fetching data from database is return
        return $data;
    }
    //fill your cities dropdown depending on the selected city
    public function getKotaByProvinsi($id)
    {
        $this->db->select('id_kota,nama_kota');
        $this->db->from('kota');
        $this->db->where('id_provinsi',$id);
        $query = $this->db->get();
        return $query->result();
    }
} 