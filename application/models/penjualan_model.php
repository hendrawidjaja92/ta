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
        $this->db->where('status_penjualan !=', 0);
//        $this->db->join('user as u', 'u.id_user = penjualan.id_user');
        $this->db->join('user as c', 'c.id_user = penjualan.id_customer');
        $this->db->order_by('tgl_penjualan', 'desc');
        $query = $this->db->get('penjualan');

        return $query;
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
        $this->db->where('status_penjualan', 1);
//        $this->db->join('user as u', 'u.id_user = penjualan.id_user');
        $this->db->join('user as c', 'c.id_user = penjualan.id_customer');
        $this->db->order_by('tgl_penjualan', 'desc');
        $query = $this->db->get('penjualan');

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
} 