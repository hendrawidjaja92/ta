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

    public function show_barang()
    {
        $this->db->select('*');
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori_barang = barang.id_kategori_barang');

        $query = $this->db->get('barang');

        return $query;
    }

    public function show_barang_by($id)
    {
        $this->db->where('id_barang', $id);
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori_barang = barang.id_kategori_barang');

        $query = $this->db->get('barang');

        return $query;
    }

    public function update_barang($id, $data)
    {
        $this->db->where('id_barang', $id);
        $this->db->update('barang', $data);
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori_barang = barang.id_kategori_barang');
        return true;
    }

    public function show_kategori_barang()
    {
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

    public function delete($id)
    {
        $this->db->where('id_barang', $id);
        $this->db->delete('barang');

    }


} 