<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 20/04/2015
 * Time: 14:32
 */

class Pegawai extends CI_Controller {

    private $logged_in_pegawai;

    function __construct()
    {
        parent::__construct();

        if($this->session->userdata('logged_in_pegawai')){
            $this->logged_in_pegawai = true;
        }else {
            $this->logged_in_pegawai = false;
        }
        $this->load->model('kota_provinsi_model');
    }

    function index(){
        $this->load->view('pegawai_view', array('logged_in_pegawai' => $this->logged_in_pegawai));
    }

}