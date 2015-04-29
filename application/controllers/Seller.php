<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 20/04/2015
 * Time: 14:20
 */

class Seller extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->model('');
    }

    function index(){
        $this->load->view('seller_view');
    }

}