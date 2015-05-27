<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 26/05/2015
 * Time: 13:00
 */

class refund_cus_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function show_refund(){
        $this->db->select('*');
        $this->db->join('penjualan as p', 'p.id_penjualan = refund_customer.id_penjualan');

        $query = $this->db->get('refund_customer');

        return $query;
    }
    public function show_refund_by_idsup($id){
        $this->db->where('id_supplier', $id);
        $this->db->join('pembelian as p', 'p.id_pembelian = refund.id_pembelian');

        $query = $this->db->get('refund_customer');

        return $query;
    }

    public function show_refund_by_id($id){
        $this->db->where('id_refund_cus', $id);
        $this->db->join('penjualan as p', 'p.id_penjualan = refund_customer.id_penjualan');

        $query = $this->db->get('refund_customer');

        return $query;
    }

    public function update_refund_by_id($id,$data){
        $this->db->where('id_refund', $id);
        $this->db->update('refund_customer', $data);

        return TRUE;
    }

    public function show_detail_refund_by_id_ref($id)
    {
        $this->db->where('detail_refund_cus.id_refund_cus', $id);
        $this->db->join('refund_customer as r', 'r.id_refund_cus = detail_refund_cus.id_refund_cus');
        $this->db->join('barang as b', 'b.id_barang = detail_refund_cus.id_barang');

        $query = $this->db->get('detail_refund_cus');

        return $query;
    }

} 