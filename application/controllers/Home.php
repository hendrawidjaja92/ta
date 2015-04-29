<?php
/**
 * Created by PhpStorm.
 * User: Vanny
 * Date: 4/8/2015
 * Time: 1:46 PM
 */
class Home extends CI_Controller {


    function __construct()
    {
        parent::__construct();

        $this->load->model('kota_provinsi_model');
        $this->load->model('login_model');
    }
    function index(){

        $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
        $this->load->view('home_view', $data);
    }
    public function buildDropKota()
{
    //set selected country id from POST
    echo $id_kota = $this->input->post('id',TRUE);
    //run the query for the cities we specified earlier
    $districtData['districtDrop']=$this->kota_provinsi_model->getKotaByProvinsi($id_kota);
    $output = null;
    foreach ($districtData['districtDrop'] as $row)
    {
        //here we build a dropdown item line for each query result
        $output .= "<option value='".$row->id_kota."'>".$row->nama_kota."</option>";
    }
    echo $output;
}

    public function user_login()
    {

        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
            $this->load->view('home_view', $data);
        } else {
            $result = $this->login_model->login();

            switch ($result) {
                case 'logged_in_admin':
//                    $this->load->view('admin_view', $data);
                    redirect('/admin', 'location');
                    break;
                case 'logged_in_pegawai':
//                    $this->load->view('admin_view', $data);
                    redirect('/pegawai', 'location');
                    break;
                case 'logged_in_seller':
//                    $this->load->view('admin_view', $data);
                    redirect('/seller', 'location');
                    break;
                case 'logged_in_supplier':
//                    $this->load->view('admin_view', $data);
                    redirect('/supplier', 'location');
                    break;
                case 'logged_in_customer':
//                    $this->load->view('admin_view', $data);
                    redirect('/customer', 'location');
                    break;
                case 'incorrect_password':
//                    $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
//                    $this->load->view('home_view', $data);
                    redirect('/', 'location');
                    break;
                case 'not_activated':
//                    $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
//                    $this->load->view('home_view', $data);
                    redirect('/', 'location');
                    break;
                case 'email_not_found':
//                    $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
//                    $this->load->view('home_view', $data);
                    redirect('/', 'location');
                    break;

            }

        }
    }


}
