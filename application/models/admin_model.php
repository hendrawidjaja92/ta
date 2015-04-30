<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 29/04/2015
 * Time: 20:45
 */

class admin_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    public function show($id){
//        $this->db->where('id_user',$id);
//        $this->db->select('*');
//        $this->db->from('user');



        return TRUE;
    }

    public function update_admin($id,$data) {
        $this->db->where('id_user',$id);
        $this->db->update('user', $data);
        $this->db->join('kota', 'kota.id_kota = user.id_kota');
        $this->db->join('provinsi', 'provinsi.id_provinsi = kota.id_provinsi');
        return TRUE;
    }
} 