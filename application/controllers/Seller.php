<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 20/04/2015
 * Time: 14:20
 */

class Seller extends CI_Controller {

    private $logged_in_seller;

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in_seller')) {
            $this->logged_in_seller = true;
        } else {
            $this->logged_in_seller = false;
        }
        $this->load->model('kota_provinsi_model');
        $this->load->model('seller_model');
        $this->load->model('login_model');
        $this->load->model('barang_model');
        $this->load->model('admin_model');
    }

    function index(){
        $this->load->view('seller_view', array('logged_in_seller' => $this->logged_in_seller));
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
        $data['user']         = $this->seller_model->show($id_user);
        $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
        $data['kotaDrop']     = $this->kota_provinsi_model->getKota($id_provinsi);

        $this->load->view('ubah_akun_view_seller', $data);

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
            $data['user']         = $this->seller_model->show($id_user);
            $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
            $data['kotaDrop']     = $this->kota_provinsi_model->getKota($this->input->post('provinsi'));
            $this->load->view('ubah_akun_view_seller', $data);
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

            $data2['user'] = $this->seller_model->show($id_user);
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
            $this->seller_model->update_seller($id_user, $data);
            $this->session->set_flashdata('category_success', 'Success update seller.');
            redirect('/seller/ubah_akun/' . $id_user, $data, true);
        }


    }

    function manage_barang(){
        $id_user = $this->session->userdata('id_user');

        $data['barang'] = $this->barang_model->show_barang_by_id_seller($id_user);
        $this->load->view('manage_barang_view_seller', $data);

    }

    function add_barang(){
        $this->form_validation->set_rules('gambar_barang', 'Gambar Barang', 'callback_upload_check|trim|xss_clean');

        $this->form_validation->set_rules('nama_barang', 'Nama Barang',
            'required|callback_barang_check|trim|xss_clean');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli',
            'required|trim|callback_not_minus|numeric|xss_clean');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual',
            'required|trim|callback_not_minus|numeric|xss_clean');
        $this->form_validation->set_rules('jumlah', 'Stok', 'required|trim|callback_not_minus|numeric|xss_clean');
        $this->form_validation->set_rules('merk_barang', 'Merk', 'required|trim|xss_clean');
        $this->form_validation->set_rules('satuan_berat', 'Satuan Berat', 'required|trim|alpha|xss_clean');
        $this->form_validation->set_rules('nilai_berat', 'Nilai Berat', 'required|trim|numeric|xss_clean');
        $this->form_validation->set_rules('kategori_barang', 'Kategori Barang',
            'required|trim|callback_select_check|xss_clean');

        if ($this->form_validation->run() == false) {
            $data['pilot'] = $this->admin_model->show($this->session->userdata('id_user'));

            $data['kategoriBarang'] = $this->barang_model->show_kategori_barang();

            $this->load->view('add_barang_view', $data);
        } else {
            $fileType = $_FILES['gambar_barang']['type'];
            $fileName = $_FILES['gambar_barang']['name'];
            $fileSize = $_FILES['gambar_barang']['size'];
            $tempFile = $_FILES['gambar_barang']['tmp_name'];
            if (!empty($fileName)) {
                if ($fileType == "image/jpeg" || $fileType == "image/jpg" || $fileType == "image/png") {
                    $newFile = 'upload_image/' . $this->input->post('nama_barang') . "." . pathinfo($fileName,
                            PATHINFO_EXTENSION);
                }

            }
            $id_user = $this->session->userdata('id_user');

            $data = array(
                'gambar_barang'      => $newFile,
                'nama_barang'        => $this->input->post('nama_barang'),
                'harga_beli'         => $this->input->post('harga_beli'),
                'harga_jual'         => $this->input->post('harga_jual'),
                'jumlah'             => $this->input->post('jumlah'),
                'merk_barang'        => $this->input->post('merk_barang'),
                'satuan_berat'       => $this->input->post('satuan_berat'),
                'nilai_berat'        => $this->input->post('nilai_berat'),
                'id_kategori_barang' => $this->input->post('kategori_barang'),
                'status_barang'      => 3,
                'id_seller'      => $id_user,
            );


            move_uploaded_file($tempFile, $newFile);


            $this->db->insert('barang', $data);
            $data['barang'] = $this->barang_model->show_barang();
            $this->session->set_flashdata('category_success', 'Success add barang.');
            redirect('/seller/manage_barang', $data, true);


        }
    }

    function edit_barang()
    {
        if ($this->input->post('gambar_barang')) {
            $this->form_validation->set_rules('gambar_barang', 'Gambar Barang', 'callback_upload_check|trim|xss_clean');
        }
        $this->form_validation->set_rules('nama_barang', 'Nama Barang',
            'required|callback_barang_check|trim|xss_clean');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli',
            'required|trim|callback_not_minus|numeric|xss_clean');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual',
            'required|trim|callback_not_minus|numeric|xss_clean');
        $this->form_validation->set_rules('jumlah', 'Stok', 'required|trim|callback_not_minus|numeric|xss_clean');
        $this->form_validation->set_rules('merk_barang', 'Merk', 'required|trim|xss_clean');
        $this->form_validation->set_rules('satuan_berat', 'Satuan Berat', 'required|trim|alpha|xss_clean');
        $this->form_validation->set_rules('nilai_berat', 'Nilai Berat', 'required|trim|numeric|xss_clean');
        $this->form_validation->set_rules('kategori_barang', 'Kategori Barang',
            'required|trim|callback_select_check|xss_clean');

        if ($this->form_validation->run() == false) {
            $data['barang'] = $this->barang_model->show_barang_by($this->uri->segment(3));
            $data['pilot'] = $this->admin_model->show($this->session->userdata('id_user'));

            $data['kategoriBarang'] = $this->barang_model->show_kategori_barang();

            $this->load->view('edit_barang_view', $data);
        } else {
            $fileType = $_FILES['gambar_barang']['type'];
            $fileName = $_FILES['gambar_barang']['name'];
            $fileSize = $_FILES['gambar_barang']['size'];
            $tempFile = $_FILES['gambar_barang']['tmp_name'];
            if (!empty($fileName)) {
                if ($fileType == "image/jpeg" || $fileType == "image/jpg" || $fileType == "image/png") {
                    $newFile = 'upload_image/' . $this->input->post('nama_barang') . "." . pathinfo($fileName,
                            PATHINFO_EXTENSION);
                }
                $data = array(
                    'gambar_barang'      => $newFile,
                    'nama_barang'        => $this->input->post('nama_barang'),
                    'harga_beli'         => $this->input->post('harga_beli'),
                    'harga_jual'         => $this->input->post('harga_jual'),
                    'jumlah'             => $this->input->post('jumlah'),
                    'merk_barang'        => $this->input->post('merk_barang'),
                    'satuan_berat'       => $this->input->post('satuan_berat'),
                    'nilai_berat'        => $this->input->post('nilai_berat'),
                    'id_kategori_barang' => $this->input->post('kategori_barang'),
                );
                foreach ($this->barang_model->show_barang_by($this->uri->segment(3))->result() as $b) {
                    unlink($b->gambar_barang);
                }

            } else {
                $data = array(
//                    'gambar_barang'      => $newFile,
                    'nama_barang'        => $this->input->post('nama_barang'),
                    'harga_beli'         => $this->input->post('harga_beli'),
                    'harga_jual'         => $this->input->post('harga_jual'),
                    'jumlah'             => $this->input->post('jumlah'),
                    'merk_barang'        => $this->input->post('merk_barang'),
                    'satuan_berat'       => $this->input->post('satuan_berat'),
                    'nilai_berat'        => $this->input->post('nilai_berat'),
                    'id_kategori_barang' => $this->input->post('kategori_barang'),
                );
            }


            move_uploaded_file($tempFile, $newFile);

            $this->barang_model->update_barang($this->uri->segment(3), $data);

//            $this->db->insert('barang', $data);
//            $data['barang'] = $this->barang_model->show_barang();
            $this->session->set_flashdata('category_success', 'Success update barang.');
            redirect('/seller/manage_barang', $data, true);


        }
    }
    function delete_barang()
    {
        foreach ($this->barang_model->show_barang_by($this->uri->segment(3))->result() as $b) {
            unlink($b->gambar_barang);
        }
        $id = $this->uri->segment(3);
        $this->barang_model->delete($id);

        $this->session->set_flashdata('category_success', 'Success delete barang.');
        redirect('/seller/manage_barang', [], 'refresh');
    }

    function view_barang()
    {
        $data['pilot'] = $this->admin_model->show($this->session->userdata('id_user'));

        $data['barang'] = $this->barang_model->show_barang_by($this->uri->segment(3));

        $this->load->view('view_barang_view', $data);
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

    public function upload_check($str)
    {
//        var_dump($this->input->post('gambar_barang'));
//        var_dump($this->input->post($_FILES['gambar_barang']['name']));
        if ($_FILES['gambar_barang']['name'] == '') {
            return false;
        }
        return true;
    }

    public function barang_check($str)
    {
        foreach ($this->barang_model->show_barang()->result() as $a) {
            foreach ($this->admin_model->temp_by_id($this->uri->segment(3))->result() as $b) {
                if($a->id_barang == $b->id_temp){
                    if(strtolower($str) == strtolower($a->nama_barang)){
                        return true;
                    }
                }
            }
        }

        foreach ($this->barang_model->show_barang()->result() as $a) {
            foreach ($this->barang_model->show_barang_by($this->uri->segment(3))->result() as $b) {

                if (strtolower($str) == strtolower($a->nama_barang) && strtolower($str) != strtolower($b->nama_barang)) {

                    return false;
                }
            }

        }
        return true;
    }

    public function barang_temp($str)
    {

        foreach ($this->admin_model->temp()->result() as $a) {
            foreach ($this->barang_model->show_barang()->result() as $b) {

                if (strtolower($str) == strtolower($a->nama_barang_temp) || strtolower($str) == strtolower($b->nama_barang)) {

                    return false;
                }
            }
        }
        return true;
    }

    public function barang_temp_id($str)
    {
        foreach ($this->admin_model->temp_by_id($this->uri->segment(3))->result() as $c) {
            if (strtolower($str) == strtolower($c->nama_barang_temp)) {
                return true;
            }
        }

        foreach ($this->admin_model->temp()->result() as $a) {
            foreach ($this->barang_model->show_barang()->result() as $b) {


                if (strtolower($str) == strtolower($a->nama_barang_temp) || strtolower($str) == strtolower($b->nama_barang)) {

                    return false;
                }


            }
        }
        return true;
    }

    public function jumlah_refund($value){
        if($value == 0){
            return false;
        }
        foreach($this->pembelian_model->show_pembelian_by_idpem_idbar($this->uri->segment(3),$this->uri->segment(4))->result() as $a){
            if($value > $a->jumlah_beli_detail){
                return false;
            }
        }
        return true;
    }
}