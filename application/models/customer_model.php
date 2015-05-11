<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 29/04/2015
 * Time: 20:45
 */

class customer_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    public function show($id){
        $this->db->where('id_user', $id);
        $this->db->join('kota', 'kota.id_kota = user.id_kota');
        $this->db->join('provinsi', 'provinsi.id_provinsi = kota.id_provinsi');

        $query = $this->db->get('user');

        return $query;
    }

    public function update_customer($id,$data) {
        $this->db->where('id_user',$id);
        $this->db->update('user', $data);
        $this->db->join('kota', 'kota.id_kota = user.id_kota');
        return TRUE;
    }

    public function show_supplier(){
        $this->db->where('id_kategori_user', 4);
        $this->db->join('kota', 'kota.id_kota = user.id_kota');
        $this->db->join('provinsi', 'provinsi.id_provinsi = kota.id_provinsi');

        $query = $this->db->get('user');

        return $query;
    }
    public function show_seller(){
        $this->db->where('id_kategori_user', 3);
        $this->db->join('kota', 'kota.id_kota = user.id_kota');
        $this->db->join('provinsi', 'provinsi.id_provinsi = kota.id_provinsi');

        $query = $this->db->get('user');

        return $query;
    }
    public function show_customer(){
        $this->db->where('id_kategori_user', 5);
        $this->db->join('kota', 'kota.id_kota = user.id_kota');
        $this->db->join('provinsi', 'provinsi.id_provinsi = kota.id_provinsi');

        $query = $this->db->get('user');

        return $query;
    }

    public function delete($id){
        $this->db->where('id_user', $id);
        $this->db->delete('user');

    }


} 