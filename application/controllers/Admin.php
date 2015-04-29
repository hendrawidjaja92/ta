<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 20/04/2015
 * Time: 13:46
 */

class Admin extends CI_Controller {

    private $logged_in_admin;

    function __construct()
    {
        parent::__construct();

        if($this->session->userdata('logged_in_admin')){
            $this->logged_in_admin = true;
        }else {
            $this->logged_in_admin = false;
        }
        $this->load->model('kota_provinsi_model');
    }

    function index(){
        $this->load->view('admin_view', array('logged_in_admin' => $this->logged_in_admin));
    }
    function logout(){
        session_destroy();
        redirect('/', 'location');
    }
    function ubah_akun(){
        $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
        $this->load->view('ubah_akun_view_admin', $data);
    }
    function manage_pembayaran(){
        $this->load->view('manage_pembayaran_view_admin');
    }
    function manage_barang(){
        $this->load->view('manage_barang_view_admin');
    }
    function manage_refund(){
        $this->load->view('manage_refund_view_admin');
    }
    function manage_supplier(){
        $this->load->view('manage_supplier_view_admin');
    }
    function manage_seller(){
        $this->load->view('manage_seller_view_admin');
    }
    function manage_customer(){
        $this->load->view('manage_customer_view_admin');
    }
    function manage_pegawai(){
        $this->load->view('manage_pegawai_view_admin');
    }
    function pembelian(){
        $this->load->view('pembelian_view_admin');
    }
    function history_penjualan(){
        $this->load->view('history_penjualan_view_admin');
    }
    function history_pembelian(){
        $this->load->view('history_pembelian_view_admin');
    }
}