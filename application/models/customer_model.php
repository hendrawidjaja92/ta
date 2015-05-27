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

    public function delete_wishlist($idu,$idb){
        $this->db->where('id_user', $idu);
        $this->db->where('id_barang', $idb);
        $this->db->delete('wishlist');

    }

    public function wishlist($idu,$idb){
        $this->db->where('id_user', $idu);
        $this->db->where('id_barang', $idb);
        $query = $this->db->get('wishlist');

        return $query;
    }
    public function wishlist_table($idu){
        $this->db->where('id_user', $idu);
        $this->db->join('barang as b', 'b.id_barang = wishlist.id_barang');
        $query = $this->db->get('wishlist');

        return $query;
    }

    public function cart($idu,$idb){
        $this->db->where('id_user', $idu);
        $this->db->where('id_barang', $idb);
        $query = $this->db->get('keranjang_belanja');

        return $query;
    }

    public function cart_table($idu){
        $this->db->where('id_user', $idu);
        $this->db->join('barang as b', 'b.id_barang = keranjang_belanja.id_barang');
        $query = $this->db->get('keranjang_belanja');

        return $query;
    }

    public function delete_cart($idu,$idb){
        $this->db->where('id_user', $idu);
        $this->db->where('id_barang', $idb);
        $this->db->delete('keranjang_belanja');

    }

    public function cart_join_barang($idu,$idb){
        $this->db->where('id_user', $idu);
        $this->db->where('keranjang_belanja.id_barang', $idb);
        $this->db->join('barang as b', 'b.id_barang = keranjang_belanja.id_barang');

        $query = $this->db->get('keranjang_belanja');

        return $query;
    }
    public function update_cart($idu,$idb,$data){
        $this->db->where('id_user', $idu);
        $this->db->where('id_barang', $idb);

        $this->db->update('keranjang_belanja', $data);

        return TRUE;
    }

    public function log_table_all(){
        $this->db->select('*');
        $this->db->join('user as u' , 'u.id_user = log.id_user');


        $query = $this->db->get('log');

        return $query;
    }
    public function log_table_all_by_id($id){
        $this->db->where('log.id_user', $id);
        $this->db->join('user as u' , 'u.id_user = log.id_user');
        $this->db->join('barang as b' , 'b.id_barang = log.id_barang');


        $query = $this->db->get('log');

        return $query;
    }
    public function log_table_distinct(){
        $this->db->DISTINCT();
        $this->db->select('id_user');
        $this->db->FROM('log');

        $query = $this->db->get();

        return $query;
    }
    public function log_table_value($id){
        $this->db->where('id_user', $id);

        $query = $this->db->get('log');

        return $query;
    }
    public function log_table_by_id_id($idu,$idb){
        $this->db->where('id_user', $idu);
        $this->db->where('id_barang', $idb);

        $query = $this->db->get('log');

        return $query;
    }

    public function update_log_table_by_id_id($idu,$idb,$data){
        $this->db->where('id_user', $idu);
        $this->db->where('id_barang', $idb);
        $this->db->update('log', $data);

        return TRUE;
    }
} 