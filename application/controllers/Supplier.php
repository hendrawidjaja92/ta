<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 20/04/2015
 * Time: 14:31
 */

class Supplier extends CI_Controller {

    private $logged_in_supplier;

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in_supplier')) {
            $this->logged_in_supplier = true;
        } else {
            $this->logged_in_supplier = false;
        }
        $this->load->model('kota_provinsi_model');
        $this->load->model('supplier_model');
        $this->load->model('login_model');
        $this->load->model('pembelian_model');
        $this->load->model('barang_model');
        $this->load->model('refund_model');
    }

    function index(){
        $this->load->view('supplier_view', array('logged_in_supplier' => $this->logged_in_supplier));

    }

    function logout()
    {
        session_destroy();
        redirect('/', 'location');
    }

    function ubah_akun()
    {
        $id_provinsi          = $this->session->userdata('id_provinsi');
        $id_user              = $this->session->userdata('id_user');
        $data['user']         = $this->supplier_model->show($id_user);
        $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
        $data['kotaDrop']     = $this->kota_provinsi_model->getKota($id_provinsi);

        $this->load->view('ubah_akun_view_supplier', $data);

    }

    function update()
    {
//        $this->_set_rules();
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|xss_clean');
//        $this->form_validation->set_rules('old', 'Old', 'trim|xss_clean');
//        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|md5|matches[old]|xss_clean');
        if ($this->input->post('new_password') || $this->input->post('re_password')) {
            $this->form_validation->set_rules('new_password', 'Re Password', 'trim|required|md5|xss_clean');
            $this->form_validation->set_rules('re_password', 'Password',
                'trim|required|md5|matches[new_password]|xss_clean');
        }
        $this->form_validation->set_rules('nama_user', 'Nama User', 'required|trim|alpha|xss_clean');
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim|xss_clean');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|xss_clean');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim|numeric|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir',
            'required|trim|callback_birth_date_check|xss_clean');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|callback_select_check|trim|xss_clean');
        $this->form_validation->set_rules('kota', 'Kota', 'required|callback_select_check|trim|xss_clean');

        if ($this->form_validation->run() == false) {
//            $id_provinsi          = $this->session->userdata('id_provinsi');
            $id_user              = $this->session->userdata('id_user');
            $data['user']         = $this->supplier_model->show($id_user);
            $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
            $data['kotaDrop']     = $this->kota_provinsi_model->getKota($this->input->post('provinsi'));
            $this->load->view('ubah_akun_view_supplier', $data);
        } else {
            $data    = array(
                'email'           => $this->input->post('email'),
                'password'        => $this->input->post('new_password'),
                'nama_user'       => $this->input->post('nama_user'),
                'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                'alamat'          => $this->input->post('alamat'),
                'no_telepon'      => $this->input->post('no_telepon'),
                'jenis_kelamin'   => $this->input->post('jenis_kelamin'),
                'tgl_lahir'       => $this->input->post('tgl_lahir'),
                'id_kota'         => $this->input->post('kota'),

            );
            $id_user = $this->session->userdata('id_user');

            $data2['user'] = $this->supplier_model->show($id_user);
            foreach ($data2['user']->result() as $u) {
                if ($data['password'] == '') {
                    $data['password'] = $u->password;

                } else {
                    if ($this->input->post('re_password') == '') {
                        $data['password'] = $u->password;

                    }
                }
            }

            $id_provinsi = $this->session->userdata('id_provinsi');
            $this->supplier_model->update_supplier($id_user, $data);
            $this->session->set_flashdata('category_success', 'Success update supplier.');
            redirect('/supplier/ubah_akun/' . $id_user, $data, true);
        }

    }

    function history_penjualan()
    {
        $id_user = $this->session->userdata('id_user');
        $data['pembelian'] = $this->pembelian_model->show_pembelian_by_idsup($id_user);
        $data['supplier']  = $this->supplier_model->show_supplier();
        $this->load->view('history_penjualan_view_supplier', $data);
    }

    function view_penjualan()
    {
        $data['supplier']       = $this->supplier_model->show_supplier();
        $data['kategoriBarang'] = $this->barang_model->show_kategori_barang();
        $data['pembelian'] = $this->pembelian_model->show_pembelian_by_id($this->uri->segment(3));
        $data['detail'] = $this->pembelian_model->show_pembelian_by_id_pem($this->uri->segment(3));

        $this->load->view('history_detail_penjualan_view_supplier', $data);
    }

    function manage_refund(){
        $id_user = $this->session->userdata('id_user');

        $data['refund']         = $this->refund_model->show_refund_by_idsup($id_user);
        $data['supplier']       = $this->supplier_model->show_supplier();
        $this->load->view('manage_refund_view_supplier',$data);
    }
    function view_data_refund()
    {
        $data['supplier']       = $this->supplier_model->show_supplier();
        $data['kategoriBarang'] = $this->barang_model->show_kategori_barang();
        $data['refund']         = $this->refund_model->show_refund_by_id($this->uri->segment(4));

        $data['pembelian'] = $this->pembelian_model->show_pembelian_by_id($this->uri->segment(3));
        $data['detail'] = $this->refund_model->show_detail_refund_by_id_ref($this->uri->segment(4));

        $this->load->view('view_data_refund_supplier', $data);
    }
    function edit_refund()
    {
        $datarefund = [
            'status_refund' => 1
        ];
        $this->refund_model->update_refund_by_id($this->uri->segment(4),$datarefund);
        $this->session->set_flashdata('category_success', 'Success update refund.');
        redirect('/supplier/manage_refund/', [], true);
    }
    //===============================================================================================================
    //===============================================================================================================
    //===============================================================================================================
    //===============================================================================================================
    //===============================================================================================================


    public
    function email_check()
    {
        $result  = $this->login_model->all_user_email($this->input->post('email'));
        $result2 = $this->login_model->my_user_email($this->input->post('id_user'), $this->input->post('email'));
//        die($result);
        if ($result == 'email_failed' && $result2 == 'email_failed') {
            return false;
        } else {
            if ($result == 'email_failed' && $result2 == 'email_success') {
                return true;
            }
        }
        return true;

    }

    public
    function birth_date_check(
        $str
    ) {
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

    public
    function not_minus(
        $value
    ) {

        if ($value < 0) {
            return false;
        }
        return true;

    }

    public
    function select_check(
        $value
    ) {

        if ($value == 0) {
            return false;
        }
        return true;

    }
}