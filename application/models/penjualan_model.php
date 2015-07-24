<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 25/05/2015
 * Time: 16:49
 */

class penjualan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show_penjualan()
    {
        $this->db->select('*');
//        $this->db->join('user as u', 'u.id_user = penjualan.id_user');
        $this->db->join('user as c', 'c.id_user = penjualan.id_customer');
        $this->db->order_by('tgl_penjualan', 'desc');
        $query = $this->db->get('penjualan');

        return $query;
    }

    public function show_penjualan_noresi($id)
    {
        $this->db->where('id_penjualan', $id);

        $query = $this->db->get('penjualan');

        return $query;
    }

    public function show_penjualan_noresi_seller($idbar,$id)
    {
        $this->db->where('id_penjualan', $id);
        $this->db->where('id_barang', $idbar);

        $query = $this->db->get('detail_pesanan');

        return $query;
    }

    public function show_penjualan_by_id($id)
    {
        $this->db->where('id_penjualan', $id);
        $this->db->join('user as u', 'u.id_user = penjualan.id_user');
        $this->db->join('user as c', 'c.id_user = penjualan.id_customer');

        $query = $this->db->get('penjualan');

        return $query;
    }

    public function update_penjualan_by_id($id,$data)
    {
        $this->db->where('id_penjualan', $id);
        $this->db->update('penjualan', $data);
//        $this->db->join('user as u', 'u.id_user = pembelian.id_user');
//        $this->db->join('user as s', 's.id_user = pembelian.id_supplier');

        return TRUE;
    }

    public function show_penjualan_on_date()
    {
        $this->db->select('*');
        $this->db->join('user as u', 'u.id_user = penjualan.id_user');
        $this->db->join('user as c', 'c.id_user = penjualan.id_customer');
        $this->db->where('tgl_penjualan BETWEEN CURDATE()-3 AND  CURDATE()');
        $this->db->order_by('tgl_penjualan', 'desc');
        $query = $this->db->get('penjualan');

        return $query;
    }

    public function show_penjualan_by_id_pen($id)
    {
        $this->db->where('detail_pesanan.id_penjualan', $id);
        $this->db->join('penjualan as p', 'p.id_penjualan = detail_pesanan.id_penjualan');
        $this->db->join('barang as b', 'b.id_barang = detail_pesanan.id_barang');

        $query = $this->db->get('detail_pesanan');

        return $query;
    }

    public function show_penjualan_by_idpen_idbar($idpen,$idbar )
    {
        $this->db->where('detail_pesanan.id_penjualan', $idpen);
        $this->db->where('detail_pesanan.id_barang', $idbar);
        $this->db->join('penjualan as p', 'p.id_penjualan = detail_pesanan.id_penjualan');
        $this->db->join('barang as b', 'b.id_barang = detail_pesanan.id_barang');

        $query = $this->db->get('detail_pesanan');

        return $query;
    }

    public function show_penjualan_for_admin()
    {
        $this->db->select('distinct(p.id_penjualan),status_penjualan,tgl_penjualan,id_kota_kirim,total_penjualan,berita,email');
        $this->db->where('status_penjualan !=', 0);
//        $this->db->where('id_seller =', 0);
//        $this->db->join('user as u', 'u.id_user = penjualan.id_user');
        $this->db->join('user as c', 'c.id_user = penjualan.id_customer');
        $this->db->join('detail_pesanan as p', 'p.id_penjualan = penjualan.id_penjualan');
        $this->db->join('barang as b', 'b.id_barang = p.id_barang');
        $this->db->order_by('tgl_penjualan', 'desc');
        $query = $this->db->get('penjualan');

        return $query;
    }


    public function show_detail_penjualan_for_pembayaran($id)
    {
        $this->db->where('p.id_penjualan =', $id);
        $this->db->join('penjualan as p', 'p.id_penjualan = detail_pesanan.id_penjualan');
        $this->db->join('barang as b', 'b.id_barang = detail_pesanan.id_barang');
        $this->db->join('kota_kirim as k', 'k.id_kota_kirim = p.id_kota_kirim');


        $query = $this->db->get('detail_pesanan');

        return $query;
    }

    public function show_penjualan_by_idpenjualan($id)
    {
        $this->db->where('id_penjualan =', $id);
//        $this->db->join('barang as b', 'b.id_barang = penjualan.id_barang');
        $this->db->join('kota_kirim as k', 'k.id_kota_kirim = penjualan.id_kota_kirim');


        $query = $this->db->get('penjualan');

        return $query;
    }

    public function cek_for_no_resi($id)
    {
        $this->db->where('id_penjualan =', $id);
        $this->db->where('id_seller =', 0);
        $this->db->join('barang as b', 'b.id_barang = detail_pesanan.id_barang');


        $query = $this->db->get('detail_pesanan');

        return $query;
    }

    public function update_detail_pesanan_for_admin($id,$data){
        $sql = "UPDATE detail_pesanan d JOIN barang b ON b.id_barang = d.id_barang SET no_resi = {$data}
                WHERE id_penjualan = {$id} AND id_seller = 0";
        $query = $this->db->query($sql);



        return TRUE;
    }

    public function update_detail_pesanan_for_seller($id,$idsel,$idbar,$data){
        $sql = "UPDATE detail_pesanan d JOIN barang b ON b.id_barang = d.id_barang SET no_resi = {$data}
                WHERE id_penjualan = {$id} AND id_seller = {$idsel} AND b.id_barang = {$idbar}";
        $query = $this->db->query($sql);



        return TRUE;
    }

    public function show_detail_penjualan_by_id($id)
    {
        $this->db->where('detail_pesanan.id_penjualan', $id);
//        $this->db->join('user as u', 'u.id_user = penjualan.id_user');
        $this->db->join('penjualan as p', 'p.id_penjualan = detail_pesanan.id_penjualan');
        $query = $this->db->get('detail_pesanan');

        return $query;
    }

    public function show_penjualan_correct()
    {
        $this->db->where('p.status_penjualan', 1);
        $this->db->where('b.id_seller =', 0);
        $this->db->join('penjualan as p', 'p.id_penjualan = detail_pesanan.id_penjualan');
        $this->db->join('barang as b', 'b.id_barang = detail_pesanan.id_barang');
        $this->db->join('user as c', 'c.id_user = p.id_customer');
        $this->db->order_by('p.tgl_penjualan', 'desc');
        $query = $this->db->get('detail_pesanan');

        return $query;
    }

    public function show_penjualan_correct_seller($id)
    {
        $this->db->where('p.status_penjualan', 1);
        $this->db->where('b.id_seller =', $id);
        $this->db->join('penjualan as p', 'p.id_penjualan = detail_pesanan.id_penjualan');
        $this->db->join('barang as b', 'b.id_barang = detail_pesanan.id_barang');
        $this->db->join('user as c', 'c.id_user = p.id_customer');
        $this->db->order_by('p.tgl_penjualan', 'desc');
        $query = $this->db->get('detail_pesanan');

        return $query;
    }

    public function show_penjualan_by_idcus($id)
    {
        $this->db->where('penjualan.id_customer', $id);
//        $this->db->join('user as u', 'u.id_user = penjualan.id_user');
        $this->db->join('user as c', 'c.id_user = penjualan.id_customer');
        $query = $this->db->get('penjualan');

        return $query;
    }

    public function show_penjualan_by_idcus_id_penj($idc,$idp)
    {
        $this->db->where('penjualan.id_customer', $idc);
        $this->db->where('penjualan.id_penjualan', $idp);
//        $this->db->join('user as u', 'u.id_user = penjualan.id_user');
        $this->db->join('user as c', 'c.id_user = penjualan.id_customer');
        $query = $this->db->get('penjualan');

        return $query;
    }

    public function show_history_penjualan_by_id($id)
    {
        $this->db->where('penjualan.id_customer', $id);
        $this->db->where('penjualan.status_penjualan', 1);
//        $this->db->join('user as u', 'u.id_user = penjualan.id_user');
        $this->db->join('user as c', 'c.id_user = penjualan.id_customer');
        $query = $this->db->get('penjualan');

        return $query;
    }

    public function show_detail_jual($idpen,$idbar )
    {
        $this->db->select('*');
        $this->db->where('id_penjualan', $idpen);
        $this->db->where('id_barang', $idbar);

        $query = $this->db->get('detail_pesanan');

        return $query;
    }

    public function update_detail_jual($idpen, $idbar, $data){
        $this->db->where('id_penjualan', $idpen);
        $this->db->where('id_barang', $idbar);
        $this->db->update('detail_pesanan', $data);

        return TRUE;
    }

    public function show_detail_for_kirim($id)
    {

        $this->db->where('id_penjualan', $id);
        $this->db->join('barang as b', 'b.id_barang = detail_pesanan.id_barang');


        $query = $this->db->get('detail_pesanan');

        return $query;
    }

    public function show_kota_kirim($id)
    {

        $this->db->where('id_kota_kirim', $id);

        $query = $this->db->get('kota_kirim');

        return $query;
    }

    public function detail_by_id_seller($id){
        $this->db->where('b.id_seller', $id);
        $this->db->where('no_resi =', 0);
        $this->db->join('barang as b', 'b.id_barang = detail_pesanan.id_barang');
        $this->db->join('kategori_barang as k', 'k.id_kategori_barang = b.id_kategori_barang');
        $this->db->join('penjualan as p', 'p.id_penjualan = detail_pesanan.id_penjualan');
        $this->db->join('kota_kirim as kk', 'kk.id_kota_kirim = p.id_kota_kirim');
        $this->db->order_by('tgl_penjualan', 'asc');
        $query = $this->db->get('detail_pesanan');

        return $query;
    }
} 