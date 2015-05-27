<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 08/05/2015
 * Time: 16:21
 */

class barang_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function show_barang(){
        $this->db->select('*');
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori_barang = barang.id_kategori_barang');

        $query = $this->db->get('barang');

        return $query;
    }

    public function show_barang_by_seller(){
        $this->db->where('s.id_kategori_user', 3);
        $this->db->join('user as s', 's.id_user = barang.id_seller');
        $this->db->join('kategori_barang as k', 'k.id_kategori_barang= barang.id_kategori_barang');
        $this->db->order_by('status_barang desc');

        $query = $this->db->get('barang');

        return $query;
    }

    public function show_value_kategori($id){
        $this->db->where('id_kategori_barang', $id);
        $this->db->where('jumlah >', 0);

        $query = $this->db->get('barang');

        return $query;
    }

    public function show_kategori_barang_table(){
        $this->db->select('*');
        $this->db->order_by('nama_kategori_barang asc');

        $query = $this->db->get('kategori_barang');

        return $query;
    }
    public function show_kategori_barang_by_id($id){
        $this->db->where('id_kategori_barang', $id);

        $query = $this->db->get('kategori_barang');

        return $query;
    }

    public function update_kategori_barang_by_id($id,$data){
        $this->db->where('id_kategori_barang', $id);
        $this->db->update('kategori_barang', $data);

        return TRUE;
    }

    public function show_barang_by_id_seller($id){
        $this->db->where('id_seller', $id);
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori_barang = barang.id_kategori_barang');

        $query = $this->db->get('barang');

        return $query;
    }

    public function show_barang_by($id){
        $this->db->where('id_barang', $id);
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori_barang = barang.id_kategori_barang');

        $query = $this->db->get('barang');

        return $query;
    }

    public function show_barang_by_name($str){
        $this->db->where(strtolower('nama_barang'), strtolower($str));
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori_barang = barang.id_kategori_barang');

        $query = $this->db->get('barang');

        return $query;
    }

    public function update_barang($id,$data) {
        $this->db->where('id_barang',$id);
        $this->db->update('barang', $data);
        $this->db->join('kategori_barang as k', 'k.id_kategori_barang = barang.id_kategori_barang');
        return TRUE;
    }

    public function show_kategori_barang(){
        $this->db->select('id_kategori_barang,nama_kategori_barang');
        $this->db->from('kategori_barang');
        $query = $this->db->get();
        // the query mean select cat_id,category from category
        $data[0] = "--Select Kategori--";
        foreach ($query->result() as $row) {
//            $data[$row['id_provinsi']]=$row['nama_provinsi'];
            $data[$row->id_kategori_barang] = $row->nama_kategori_barang;
        }
        // the fetching data from database is return
        return $data;
    }

    public function delete($id){
        $this->db->where('id_barang', $id);
        $this->db->delete('barang');

    }
    public function delete_kategori_barang($id){
        $this->db->where('id_kategori_barang', $id);
        $this->db->delete('kategori_barang');

    }

    function fetch_image($path){
        return get_filenames($path);
    }

} 