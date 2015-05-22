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
        parent::__construct();
    }
    public function show($id){
        $this->db->where('id_user', $id);
        $this->db->join('kota', 'kota.id_kota = user.id_kota');
        $this->db->join('provinsi', 'provinsi.id_provinsi = kota.id_provinsi');

        $query = $this->db->get('user');

        return $query;
    }

    public function update_admin($id,$data) {
        $this->db->where('id_user',$id);
        $this->db->update('user', $data);
        $this->db->join('kota', 'kota.id_kota = user.id_kota');
        return TRUE;
    }

    public function show_pegawai(){
        $this->db->where('id_kategori_user', 2);
        $this->db->join('kota', 'kota.id_kota = user.id_kota');
        $this->db->join('provinsi', 'provinsi.id_provinsi = kota.id_provinsi');

        $query = $this->db->get('user');

        return $query;
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

    public function temp(){
        $this->db->select('*');
        $query = $this->db->get('temp');

        return $query;
    }

    public function temp_by_id($id){
        $this->db->where('id_temp', $id);
        $query = $this->db->get('temp');

        return $query;
    }

    public function update_temp($id,$data) {
        $this->db->where('id_temp',$id);
        $this->db->update('temp', $data);
        return TRUE;
    }

    public function delete_temp($id){
        $this->db->where('id_temp', $id);
        $this->db->delete('temp');

    }
} 