<?php

/**
 * Created by PhpStorm.
 * User: Vanny
 * Date: 4/8/2015
 * Time: 1:46 PM
 */
class Home extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        $this->load->model('kota_provinsi_model');
        $this->load->model('login_model');
    }

    function index()
    {

        $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
        $this->load->view('home_view', $data);
    }

    public function buildDropKota()
    {
        //set selected country id from POST
        echo $id_kota = $this->input->post('id', true);
        //run the query for the cities we specified earlier
        $districtData['districtDrop'] = $this->kota_provinsi_model->getKotaByProvinsi($id_kota);
        $output                       = null;
        foreach ($districtData['districtDrop'] as $row) {
            //here we build a dropdown item line for each query result
            $output .= "<option value='" . $row->id_kota . "'>" . $row->nama_kota . "</option>";
        }
        echo $output;
    }

    public function user_login()
    {

        $response = [
            'result' => 'error'
        ];

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5|xss_clean');
        if ($this->form_validation->run() == false) {
            if ($this->input->is_ajax_request()) {
                $response['view'] = $this->load->view('home_user_login', [], true);
            } else {
                $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
                $data['kotaDrop']     = $this->kota_provinsi_model->getKota($this->input->post('provinsi'));
                $this->load->view('home_view', $data);
            }
        } else {
            $result = $this->login_model->login();

            switch ($result) {
                case 'logged_in_admin':
//                    $this->load->view('admin_view', $data);
                    $response['result'] = 'success';
                    $response['url']    = '/admin';
                    break;
                case 'logged_in_pegawai':
//                    $this->load->view('admin_view', $data);
                    $response['result'] = 'success';
                    $response['url']    = '/pegawai';
                    break;
                case 'logged_in_seller':
//                    $this->load->view('admin_view', $data);
                    $response['result'] = 'success';
                    $response['url']    = '/seller';
                    break;
                case 'logged_in_supplier':
//                    $this->load->view('admin_view', $data);
                    $response['result'] = 'success';
                    $response['url']    = '/supplier';
                    break;
                case 'logged_in_customer':
//                    $this->load->view('admin_view', $data);
                    $response['result'] = 'success';
                    $response['url']    = '/customer';
                    break;
                case 'incorrect_password':
//                    $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
//                    $this->load->view('home_view', $data);
                    $response['result'] = 'error';
                    $response['view']   = $this->load->view('home_user_login', ['error' => 'incorrect_password'], true);
                    break;
                case 'not_activated':
//                    $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
//                    $this->load->view('home_view', $data);
                    $response['result'] = 'error';
                    $response['view']   = $this->load->view('home_user_login', ['error' => 'not_activated'], true);
                    break;
                case 'email_not_found':
//                    $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
//                    $this->load->view('home_view', $data);
                    $response['result'] = 'error';
                    $response['view']   = $this->load->view('home_user_login', ['error' => 'email_not_found'], true);
                    break;
            }
        }

        if ($this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    public function registrasi()
    {
        $response = [
            'result' => 'error'
        ];


        $this->form_validation->set_rules('kategori', 'Kategori', 'required|callback_kategori_check|trim|xss_clean');
        $this->form_validation->set_rules('reg_username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('reg_email', 'Email',
            'required|callback_email_check|trim|valid_email|xss_clean');

        $this->form_validation->set_rules('reg_password', 'Password', 'trim|required|md5|xss_clean');
        $this->form_validation->set_rules('reg_re_password', 'Password',
            'trim|required|md5|matches[reg_password]|xss_clean');

        $this->form_validation->set_rules('reg_nama_user', 'Nama User', 'required|trim|alpha|xss_clean');
        $this->form_validation->set_rules('reg_nama_perusahaan', 'Nama Perusahaan', 'required|trim|xss_clean');
        $this->form_validation->set_rules('reg_alamat', 'Alamat', 'required|trim|xss_clean');
        $this->form_validation->set_rules('reg_no_telepon', 'No Telepon', 'required|trim|numeric|xss_clean');
//        $this->form_validation->set_rules('reg_jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('reg_tgl_lahir', 'Tanggal Lahir',
            'required|trim|callback_birth_date_check|xss_clean');
        $this->form_validation->set_rules('reg_provinsi', 'Provinsi',
            'required|callback_provinsi_check|trim|xss_clean');
        $this->form_validation->set_rules('reg_kota', 'Kota', 'required|callback_kota_check|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            if ($this->input->is_ajax_request()) {
                $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
                $data['kotaDrop']     = $this->kota_provinsi_model->getKota($this->input->post('reg_provinsi'));
                $response['view'] = $this->load->view('home_user_registrasi', $data, true);
            } else {

            $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
            $data['kotaDrop']     = $this->kota_provinsi_model->getKota($this->input->post('reg_provinsi'));
            $this->load->view('home_view', $data);
            }

        } else {
            $result = $this->login_model->insert_user();

            switch ($result) {
                case 'email_success':
//                    $this->load->view('admin_view', $data);
                    $response['result'] = 'success';
                    $response['url']    = '/';
                    break;
                case 'email_failed':
                    $response['result'] = 'error';
                    $response['view']   = $this->load->view('home_user_registrasi', ['error' => 'email_failed'], true);
                    break;
            }

        }
        if ($this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    //===============================================================================================================
    //===============================================================================================================
    //===============================================================================================================
    //===============================================================================================================
    //===============================================================================================================


    public function email_check()
    {

        $result = $this->login_model->all_user_email($this->input->post('reg_email'));
        if ($result == 'email_failed') {
            return false;
        }
        return true;

    }

    public function provinsi_check()
    {

        if ($this->input->post('reg_provinsi') == 0) {
            return false;
        }
        return true;
    }

    public function kota_check()
    {

        if ($this->input->post('reg_kota') == 0) {
            return false;
        }
        return true;

    }
    public function kategori_check()
    {

        if ($this->input->post('kategori') == 0) {
            return false;
        }
        return true;

    }
    public function birth_date_check($str)
    {
//        $str = "2010-01-05";
        $dateInterval = date_diff(new DateTime(), date_create($str));

//        var_dump($dateInterval);
//        die;
        if ($dateInterval->invert == 1 && $dateInterval->days >= 0 && $dateInterval->y >= 10) {
            return true;
        }
//        $this->form_validation->set_message('birth_date_check', 'The %s field can not be the word "test"');
        return false;
    }
}
