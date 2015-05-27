<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 22/05/2015
 * Time: 17:17
 */

class refund_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function show_refund(){
        $this->db->select('*');
        $this->db->join('pembelian as p', 'p.id_pembelian = refund.id_pembelian');

        $query = $this->db->get('refund');

        return $query;
    }
    public function show_refund_by_idsup($id){
        $this->db->where('id_supplier', $id);
        $this->db->join('pembelian as p', 'p.id_pembelian = refund.id_pembelian');

        $query = $this->db->get('refund');

        return $query;
    }

    public function show_refund_by_id($id){
        $this->db->where('id_refund', $id);
        $this->db->join('pembelian as p', 'p.id_pembelian = refund.id_pembelian');

        $query = $this->db->get('refund');

        return $query;
    }

    public function update_refund_by_id($id,$data){
        $this->db->where('id_refund', $id);
        $this->db->update('refund', $data);

        return TRUE;
    }

    public function show_detail_refund_by_id_ref($id)
    {
        $this->db->where('detail_refund.id_refund', $id);
        $this->db->join('refund as r', 'r.id_refund = detail_refund.id_refund');
        $this->db->join('barang as b', 'b.id_barang = detail_refund.id_barang');

        $query = $this->db->get('detail_refund');

        return $query;
    }
} 