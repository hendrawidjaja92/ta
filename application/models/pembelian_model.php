<?php

/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 08/05/2015
 * Time: 16:21
 */
class pembelian_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show_pembelian()
    {
        $this->db->select('*');
        $this->db->join('user as u', 'u.id_user = pembelian.id_user');
        $this->db->join('user as s', 's.id_user = pembelian.id_supplier');
        $this->db->order_by('tgl_beli', 'desc');
        $query = $this->db->get('pembelian');

        return $query;
    }

    public function show_pembelian_by_idsup($id)
    {
        $this->db->where('pembelian.id_supplier', $id);
        $this->db->join('user as u', 'u.id_user = pembelian.id_user');
        $this->db->join('user as s', 's.id_user = pembelian.id_supplier');
        $this->db->order_by('tgl_beli', 'desc');
        $query = $this->db->get('pembelian');

        return $query;
    }

    public function show_pembelian_on_date()
    {
        $this->db->select('*');
        $this->db->join('user as u', 'u.id_user = pembelian.id_user');
        $this->db->join('user as s', 's.id_user = pembelian.id_supplier');
        $this->db->where('tgl_beli BETWEEN CURDATE()-3 AND  CURDATE()');
        $this->db->order_by('tgl_beli', 'desc');
        $query = $this->db->get('pembelian');

        return $query;
    }

    public function show_pembelian_by_idpem_idbar($idpem,$idbar )
    {
        $this->db->where('detail_beli.id_pembelian', $idpem);
        $this->db->where('detail_beli.id_barang', $idbar);
        $this->db->join('pembelian as p', 'p.id_pembelian = detail_beli.id_pembelian');
        $this->db->join('barang as b', 'b.id_barang = detail_beli.id_barang');

        $query = $this->db->get('detail_beli');

        return $query;
    }

    public function show_detail_beli($idpem,$idbar )
    {
        $this->db->select('*');
        $this->db->where('id_pembelian', $idpem);
        $this->db->where('id_barang', $idbar);

        $query = $this->db->get('detail_beli');

        return $query;
    }

    public function show_pembelian_by_id_pem($id)
    {
        $this->db->where('detail_beli.id_pembelian', $id);
        $this->db->join('pembelian as p', 'p.id_pembelian = detail_beli.id_pembelian');
        $this->db->join('barang as b', 'b.id_barang = detail_beli.id_barang');

        $query = $this->db->get('detail_beli');

        return $query;
    }

    public function show_pembelian_by_id($id)
    {
        $this->db->where('id_pembelian', $id);
        $this->db->join('user as u', 'u.id_user = pembelian.id_user');
        $this->db->join('user as s', 's.id_user = pembelian.id_supplier');

        $query = $this->db->get('pembelian');

        return $query;
    }

    public function update_pembelian_by_id($id,$data)
    {
        $this->db->where('id_pembelian', $id);
        $this->db->update('pembelian', $data);
//        $this->db->join('user as u', 'u.id_user = pembelian.id_user');
//        $this->db->join('user as s', 's.id_user = pembelian.id_supplier');

        return TRUE;
    }

    public function update_detail_beli($idpem, $idbar, $data){
        $this->db->where('id_pembelian', $idpem);
        $this->db->where('id_barang', $idbar);
        $this->db->update('detail_beli', $data);

        return TRUE;
    }

    public function show_pembelian_by_no($no)
    {
        $this->db->where('no_faktur_pembelian', $no);
        $this->db->join('user as u', 'u.id_user = pembelian.id_user');
        $this->db->join('user as s', 's.id_user = pembelian.id_supplier');

        $query = $this->db->get('pembelian');

        return $query;
    }

    public function show_barang_supplier(){
        $this->db->select('*');
        $this->db->join('pembelian as p', 'p.id_pembelian = detail_beli.id_pembelian');
        $this->db->join('barang as b', 'b.id_barang = detail_beli.id_barang');

        $query = $this->db->get('detail_beli');

        return $query;
    }

    public function cek_kategori_barang(){
        $this->db->select('*');
        $this->db->join('barang as b', 'b.id_barang = detail_beli.id_barang');

        $query = $this->db->get('detail_beli');

        return $query;
    }

    public function show_barang_by_barang($id){
        $this->db->where('detail_beli.id_barang', $id);
        $this->db->join('pembelian as p', 'p.id_pembelian = detail_beli.id_pembelian');
        $this->db->join('barang as b', 'b.id_barang = detail_beli.id_barang');

        $query = $this->db->get('detail_beli');

        return $query;
    }

    public function show_barang_by_supplier($id){

/////////// PEMBELIAN DISTINCT //////////////// ?????????????????
//        $this->db->select('distinct(detail_beli.id_barang)','pembelian.*','barang.*');
//        $this->db->distinct();
        $this->db->select('distinct(b.id_barang),id_kategori_barang,id_supplier,gambar_barang,nama_barang,merk_barang,jumlah,harga_beli,harga_jual');
        $this->db->from('detail_beli');
//        $this->db->where('id_supplier', $id);
        $this->db->join('pembelian as p', 'p.id_pembelian = detail_beli.id_pembelian');
        $this->db->join('barang as b', 'b.id_barang = detail_beli.id_barang');
        $this->db->where('id_supplier', $id);


        $query = $this->db->get();

        return $query->result();
//        $this->db->select('*');
//        $this->db->join('pembelian as p', 'p.id_pembelian = detail_beli.id_pembelian');
//        $this->db->join('barang as b', 'b.id_barang = detail_beli.id_barang');
//        $this->db->join('user as s', 's.id_user = p.id_supplier');
//        $this->db->from('detail_beli');
//        $query = $this->db->get();
//        // the query mean select cat_id,category from category
//        $data[0] = "--Select Supplier--";
//        foreach ($query->result() as $row) {
////            $data[$row['id_provinsi']]=$row['nama_provinsi'];
//            $data[$row->id_supplier] = $row->nama_perusahaan;
//        }
//        // the fetching data from database is return
//        return $data;
    }

} 