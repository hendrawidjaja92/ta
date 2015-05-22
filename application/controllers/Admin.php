<?php

/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 20/04/2015
 * Time: 13:46
 */
class Admin extends CI_Controller
{

    private $logged_in_admin;

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in_admin')) {
            $this->logged_in_admin = true;
        } else {
            $this->logged_in_admin = false;
        }
        $this->load->model('kota_provinsi_model');
        $this->load->model('admin_model');
        $this->load->model('supplier_model');
        $this->load->model('login_model');
        $this->load->model('barang_model');
        $this->load->model('pembelian_model');
    }

    function index()
    {
        $this->load->view('admin_view', array('logged_in_admin' => $this->logged_in_admin));
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
        $data['user']         = $this->admin_model->show($id_user);
        $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
        $data['kotaDrop']     = $this->kota_provinsi_model->getKota($id_provinsi);

        $this->load->view('ubah_akun_view_admin', $data);

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
            $data['user']         = $this->admin_model->show($id_user);
            $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
            $data['kotaDrop']     = $this->kota_provinsi_model->getKota($this->input->post('provinsi'));
            $this->load->view('ubah_akun_view_admin', $data);
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

            $data2['user'] = $this->admin_model->show($id_user);
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
            $this->admin_model->update_admin($id_user, $data);
            $this->session->set_flashdata('category_success', 'Success update admin.');
            redirect('/admin/ubah_akun/' . $id_user, $data, true);
        }


    }

    function manage_pembayaran()
    {
        $this->load->view('manage_pembayaran_view_admin');
    }

    function manage_barang()
    {
        $data['barang'] = $this->barang_model->show_barang();
        $this->load->view('manage_barang_view_admin', $data);
    }

    function add_barang()
    {

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
                'status_barang'      => 1,
            );


            move_uploaded_file($tempFile, $newFile);


            $this->db->insert('barang', $data);
            $data['barang'] = $this->barang_model->show_barang();
            $this->session->set_flashdata('category_success', 'Success add barang.');
            redirect('/admin/manage_barang', $data, true);


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
                    'status_barang'      => $this->input->post('status_barang'),
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
                    'status_barang'      => $this->input->post('status_barang'),
                );
            }


            move_uploaded_file($tempFile, $newFile);

            $this->barang_model->update_barang($this->uri->segment(3), $data);

//            $this->db->insert('barang', $data);
//            $data['barang'] = $this->barang_model->show_barang();
            $this->session->set_flashdata('category_success', 'Success update barang.');
            redirect('/admin/manage_barang', $data, true);


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
        redirect('/admin/manage_barang', [], 'refresh');
    }

    function view_barang()
    {
        $data['barang'] = $this->barang_model->show_barang_by($this->uri->segment(3));

        $this->load->view('view_barang_view', $data);
    }

    function manage_refund()
    {

        $this->load->view('manage_refund_view_admin');
    }

    function manage_supplier()
    {
        $data['supplier'] = $this->admin_model->show_supplier();
        $this->load->view('manage_supplier_view_admin', $data);
    }

    function add_supplier()
    {
//        $this->form_validation->set_rules('kategori', 'Kategori', 'required|callback_kategori_check|trim|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email',
            'required|callback_email_check|trim|valid_email|xss_clean');

        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5|xss_clean');
        $this->form_validation->set_rules('re_password', 'Password',
            'trim|required|md5|matches[password]|xss_clean');

        $this->form_validation->set_rules('nama_user', 'Nama User', 'required|trim|alpha|xss_clean');
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim|xss_clean');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim|numeric|xss_clean');
//        $this->form_validation->set_rules('reg_jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir',
            'required|trim|callback_birth_date_check|xss_clean');
        $this->form_validation->set_rules('provinsi', 'Provinsi',
            'required|callback_select_check|trim|xss_clean');
        $this->form_validation->set_rules('kota', 'Kota', 'required|callback_select_check|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
            if ($this->input->post('provinsi') == null) {
                $id = 0;
            } else {
                $id = $this->input->post('provinsi');
            }
            $data['kotaDrop'] = $this->kota_provinsi_model->getKota($id);
            $this->load->view('add_supplier_view', $data);
        } else {
            $data = array(

                'username'         => $this->input->post('username'),
                'email'            => $this->input->post('email'),
                'password'         => $this->input->post('password'),
                'nama_user'        => $this->input->post('nama_user'),
                'nama_perusahaan'  => $this->input->post('nama_perusahaan'),
                'alamat'           => $this->input->post('alamat'),
                'no_telepon'       => $this->input->post('no_telepon'),
                'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
                'tgl_lahir'        => $this->input->post('tgl_lahir'),
                'id_kota'          => $this->input->post('kota'),
                'status_user'      => 0,
                'id_kategori_user' => 4
            );

            $this->db->insert('user', $data);
            $data['supplier'] = $this->admin_model->show_supplier();
            $this->session->set_flashdata('category_success', 'Success add supplier.');
            redirect('/admin/manage_supplier', $data, true);
        }

    }

    function edit_supplier()
    {
//        var_dump($this->admin_model->show($this->uri->segment(3))->result());
//        $this->form_validation->set_rules('kategori', 'Kategori', 'required|callback_kategori_check|trim|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email',
            'required|callback_email_check|trim|valid_email|xss_clean');
        if ($this->input->post('password') || $this->input->post('re_password')) {
            $this->form_validation->set_rules('password', 'Re Password', 'trim|required|md5|xss_clean');
            $this->form_validation->set_rules('re_password', 'Password',
                'trim|required|md5|matches[password]|xss_clean');
        }
        $this->form_validation->set_rules('nama_user', 'Nama User', 'required|trim|alpha|xss_clean');
//        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim|xss_clean');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim|numeric|xss_clean');
//        $this->form_validation->set_rules('reg_jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir',
            'required|trim|callback_birth_date_check|xss_clean');
        $this->form_validation->set_rules('provinsi', 'Provinsi',
            'required|callback_select_check|trim|xss_clean');
        $this->form_validation->set_rules('kota', 'Kota', 'required|callback_select_check|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data['pilot'] = $this->admin_model->show($this->session->userdata('id_user'));

            $data['user'] = $this->admin_model->show($this->uri->segment(3));
            foreach ($data['user']->result() as $u) {
                $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
                $data['kotaDrop']     = $this->kota_provinsi_model->getKota($u->id_provinsi);
            }
            $this->load->view('edit_supplier_view', $data);
        } else {
            if ($this->input->post('password')) {
                $data = array(

                    'id_user'          => $this->input->post('id_user'),
                    'username'         => $this->input->post('username'),
                    'email'            => $this->input->post('email'),
                    'password'         => $this->input->post('password'),
                    'nama_user'        => $this->input->post('nama_user'),
                    'nama_perusahaan'  => $this->input->post('nama_perusahaan'),
                    'alamat'           => $this->input->post('alamat'),
                    'no_telepon'       => $this->input->post('no_telepon'),
                    'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
                    'tgl_lahir'        => $this->input->post('tgl_lahir'),
                    'id_kota'          => $this->input->post('kota'),
                    'status_user'      => $this->input->post('status'),
                    'id_kategori_user' => 4
                );
            } else {
                $data = array(

                    'id_user'          => $this->input->post('id_user'),
                    'username'         => $this->input->post('username'),
                    'email'            => $this->input->post('email'),
//                    'password'         => $this->input->post('password'),
                    'nama_user'        => $this->input->post('nama_user'),
                    'nama_perusahaan'  => $this->input->post('nama_perusahaan'),
                    'alamat'           => $this->input->post('alamat'),
                    'no_telepon'       => $this->input->post('no_telepon'),
                    'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
                    'tgl_lahir'        => $this->input->post('tgl_lahir'),
                    'id_kota'          => $this->input->post('kota'),
                    'status_user'      => $this->input->post('status'),
                    'id_kategori_user' => 4
                );
            }


            $this->admin_model->update_admin($data['id_user'], $data);

//            $data['pegawai'] = $this->admin_model->show_pegawai();
            $this->session->set_flashdata('category_success', 'Success update supplier.');
            redirect('/admin/manage_supplier', $data, true);
        }

    }

    function delete_supplier()
    {

        $id = $this->uri->segment(3);
        $this->admin_model->delete($id);
        $this->session->set_flashdata('category_success', 'Success delete supplier.');
        redirect('/admin/manage_supplier', [], 'refresh');
    }

    function view_supplier()
    {
        $data['pilot'] = $this->admin_model->show($this->session->userdata('id_user'));
        $data['user'] = $this->admin_model->show($this->uri->segment(3));
        $this->load->view('view_supplier_view', $data);
    }

    function manage_seller()
    {
        $data['seller'] = $this->admin_model->show_seller();
        $this->load->view('manage_seller_view_admin', $data);
    }

    function add_seller()
    {
//        $this->form_validation->set_rules('kategori', 'Kategori', 'required|callback_kategori_check|trim|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email',
            'required|callback_email_check|trim|valid_email|xss_clean');

        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5|xss_clean');
        $this->form_validation->set_rules('re_password', 'Password',
            'trim|required|md5|matches[password]|xss_clean');

        $this->form_validation->set_rules('nama_user', 'Nama User', 'required|trim|alpha|xss_clean');
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim|xss_clean');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim|numeric|xss_clean');
//        $this->form_validation->set_rules('reg_jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir',
            'required|trim|callback_birth_date_check|xss_clean');
        $this->form_validation->set_rules('provinsi', 'Provinsi',
            'required|callback_select_check|trim|xss_clean');
        $this->form_validation->set_rules('kota', 'Kota', 'required|callback_select_check|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
            if ($this->input->post('provinsi') == null) {
                $id = 0;
            } else {
                $id = $this->input->post('provinsi');
            }
            $data['kotaDrop'] = $this->kota_provinsi_model->getKota($id);
            $this->load->view('add_seller_view', $data);
        } else {
            $data = array(

                'username'         => $this->input->post('username'),
                'email'            => $this->input->post('email'),
                'password'         => $this->input->post('password'),
                'nama_user'        => $this->input->post('nama_user'),
                'nama_perusahaan'  => $this->input->post('nama_perusahaan'),
                'alamat'           => $this->input->post('alamat'),
                'no_telepon'       => $this->input->post('no_telepon'),
                'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
                'tgl_lahir'        => $this->input->post('tgl_lahir'),
                'id_kota'          => $this->input->post('kota'),
                'status_user'      => 0,
                'id_kategori_user' => 3
            );

            $this->db->insert('user', $data);
            $data['seller'] = $this->admin_model->show_seller();
            $this->session->set_flashdata('category_success', 'Success add seller.');
            redirect('/admin/manage_seller', $data, true);
        }

    }

    function edit_seller()
    {
//        var_dump($this->admin_model->show($this->uri->segment(3))->result());
//        $this->form_validation->set_rules('kategori', 'Kategori', 'required|callback_kategori_check|trim|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email',
            'required|callback_email_check|trim|valid_email|xss_clean');
        if ($this->input->post('password') || $this->input->post('re_password')) {
            $this->form_validation->set_rules('password', 'Re Password', 'trim|required|md5|xss_clean');
            $this->form_validation->set_rules('re_password', 'Password',
                'trim|required|md5|matches[password]|xss_clean');
        }
        $this->form_validation->set_rules('nama_user', 'Nama User', 'required|trim|alpha|xss_clean');
//        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim|xss_clean');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim|numeric|xss_clean');
//        $this->form_validation->set_rules('reg_jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir',
            'required|trim|callback_birth_date_check|xss_clean');
        $this->form_validation->set_rules('provinsi', 'Provinsi',
            'required|callback_select_check|trim|xss_clean');
        $this->form_validation->set_rules('kota', 'Kota', 'required|callback_select_check|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data['pilot'] = $this->admin_model->show($this->session->userdata('id_user'));

            $data['user'] = $this->admin_model->show($this->uri->segment(3));
            foreach ($data['user']->result() as $u) {
                $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
                $data['kotaDrop']     = $this->kota_provinsi_model->getKota($u->id_provinsi);
            }
            $this->load->view('edit_seller_view', $data);
        } else {
            if ($this->input->post('password')) {
                $data = array(

                    'id_user'          => $this->input->post('id_user'),
                    'username'         => $this->input->post('username'),
                    'email'            => $this->input->post('email'),
                    'password'         => $this->input->post('password'),
                    'nama_user'        => $this->input->post('nama_user'),
                    'nama_perusahaan'  => $this->input->post('nama_perusahaan'),
                    'alamat'           => $this->input->post('alamat'),
                    'no_telepon'       => $this->input->post('no_telepon'),
                    'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
                    'tgl_lahir'        => $this->input->post('tgl_lahir'),
                    'id_kota'          => $this->input->post('kota'),
                    'status_user'      => $this->input->post('status'),
                    'id_kategori_user' => 3
                );
            } else {
                $data = array(

                    'id_user'          => $this->input->post('id_user'),
                    'username'         => $this->input->post('username'),
                    'email'            => $this->input->post('email'),
//                    'password'         => $this->input->post('password'),
                    'nama_user'        => $this->input->post('nama_user'),
                    'nama_perusahaan'  => $this->input->post('nama_perusahaan'),
                    'alamat'           => $this->input->post('alamat'),
                    'no_telepon'       => $this->input->post('no_telepon'),
                    'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
                    'tgl_lahir'        => $this->input->post('tgl_lahir'),
                    'id_kota'          => $this->input->post('kota'),
                    'status_user'      => $this->input->post('status'),
                    'id_kategori_user' => 3
                );
            }


            $this->admin_model->update_admin($data['id_user'], $data);

//            $data['pegawai'] = $this->admin_model->show_pegawai();
            $this->session->set_flashdata('category_success', 'Success update seller.');
            redirect('/admin/manage_seller', $data, true);
        }

    }

    function delete_seller()
    {

        $id = $this->uri->segment(3);
        $this->admin_model->delete($id);
        $this->session->set_flashdata('category_success', 'Success delete seller.');
        redirect('/admin/manage_seller', [], 'refresh');
    }

    function view_seller()
    {
        $data['user'] = $this->admin_model->show($this->uri->segment(3));
        $data['pilot'] = $this->admin_model->show($this->session->userdata('id_user'));
        $this->load->view('view_seller_view', $data);
    }

    function manage_customer()
    {
        $data['customer'] = $this->admin_model->show_customer();
        $this->load->view('manage_customer_view_admin', $data);
    }

    function add_customer()
    {
//        $this->form_validation->set_rules('kategori', 'Kategori', 'required|callback_kategori_check|trim|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email',
            'required|callback_email_check|trim|valid_email|xss_clean');

        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5|xss_clean');
        $this->form_validation->set_rules('re_password', 'Password',
            'trim|required|md5|matches[password]|xss_clean');

        $this->form_validation->set_rules('nama_user', 'Nama User', 'required|trim|alpha|xss_clean');
//        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim|xss_clean');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim|numeric|xss_clean');
//        $this->form_validation->set_rules('reg_jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir',
            'required|trim|callback_birth_date_check|xss_clean');
        $this->form_validation->set_rules('provinsi', 'Provinsi',
            'required|callback_select_check|trim|xss_clean');
        $this->form_validation->set_rules('kota', 'Kota', 'required|callback_select_check|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
            if ($this->input->post('provinsi') == null) {
                $id = 0;
            } else {
                $id = $this->input->post('provinsi');
            }
            $data['kotaDrop'] = $this->kota_provinsi_model->getKota($id);
            $this->load->view('add_customer_view', $data);
        } else {
            $data = array(

                'username'         => $this->input->post('username'),
                'email'            => $this->input->post('email'),
                'password'         => $this->input->post('password'),
                'nama_user'        => $this->input->post('nama_user'),
                'nama_perusahaan'  => $this->input->post('nama_perusahaan'),
                'alamat'           => $this->input->post('alamat'),
                'no_telepon'       => $this->input->post('no_telepon'),
                'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
                'tgl_lahir'        => $this->input->post('tgl_lahir'),
                'id_kota'          => $this->input->post('kota'),
                'status_user'      => 0,
                'id_kategori_user' => 5
            );

            $this->db->insert('user', $data);
            $data['customer'] = $this->admin_model->show_customer();
            $this->session->set_flashdata('category_success', 'Success add customer.');
            redirect('/admin/manage_customer', $data, true);
        }

    }

    function edit_customer()
    {
//        var_dump($this->admin_model->show($this->uri->segment(3))->result());
//        $this->form_validation->set_rules('kategori', 'Kategori', 'required|callback_kategori_check|trim|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email',
            'required|callback_email_check|trim|valid_email|xss_clean');
        if ($this->input->post('password') || $this->input->post('re_password')) {
            $this->form_validation->set_rules('password', 'Re Password', 'trim|required|md5|xss_clean');
            $this->form_validation->set_rules('re_password', 'Password',
                'trim|required|md5|matches[password]|xss_clean');
        }
        $this->form_validation->set_rules('nama_user', 'Nama User', 'required|trim|alpha|xss_clean');
//        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim|xss_clean');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim|numeric|xss_clean');
//        $this->form_validation->set_rules('reg_jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir',
            'required|trim|callback_birth_date_check|xss_clean');
        $this->form_validation->set_rules('provinsi', 'Provinsi',
            'required|callback_select_check|trim|xss_clean');
        $this->form_validation->set_rules('kota', 'Kota', 'required|callback_select_check|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data['pilot'] = $this->admin_model->show($this->session->userdata('id_user'));

            $data['user'] = $this->admin_model->show($this->uri->segment(3));
            foreach ($data['user']->result() as $u) {
                $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
                $data['kotaDrop']     = $this->kota_provinsi_model->getKota($u->id_provinsi);
            }
            $this->load->view('edit_customer_view', $data);
        } else {
            if ($this->input->post('password')) {
                $data = array(

                    'id_user'          => $this->input->post('id_user'),
                    'username'         => $this->input->post('username'),
                    'email'            => $this->input->post('email'),
                    'password'         => $this->input->post('password'),
                    'nama_user'        => $this->input->post('nama_user'),
                    'nama_perusahaan'  => $this->input->post('nama_perusahaan'),
                    'alamat'           => $this->input->post('alamat'),
                    'no_telepon'       => $this->input->post('no_telepon'),
                    'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
                    'tgl_lahir'        => $this->input->post('tgl_lahir'),
                    'id_kota'          => $this->input->post('kota'),
                    'status_user'      => $this->input->post('status'),
                    'id_kategori_user' => 5
                );
            } else {
                $data = array(

                    'id_user'          => $this->input->post('id_user'),
                    'username'         => $this->input->post('username'),
                    'email'            => $this->input->post('email'),
//                    'password'         => $this->input->post('password'),
                    'nama_user'        => $this->input->post('nama_user'),
                    'nama_perusahaan'  => $this->input->post('nama_perusahaan'),
                    'alamat'           => $this->input->post('alamat'),
                    'no_telepon'       => $this->input->post('no_telepon'),
                    'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
                    'tgl_lahir'        => $this->input->post('tgl_lahir'),
                    'id_kota'          => $this->input->post('kota'),
                    'status_user'      => $this->input->post('status'),
                    'id_kategori_user' => 5
                );
            }


            $this->admin_model->update_admin($data['id_user'], $data);

//            $data['pegawai'] = $this->admin_model->show_pegawai();
            $this->session->set_flashdata('category_success', 'Success update customer.');
            redirect('/admin/manage_customer', $data, true);
        }

    }

    function delete_customer()
    {

        $id = $this->uri->segment(3);
        $this->admin_model->delete($id);
        $this->session->set_flashdata('category_success', 'Success delete customer.');
        redirect('/admin/manage_customer', [], 'refresh');
    }

    function view_customer()
    {
        $data['user'] = $this->admin_model->show($this->uri->segment(3));
        $data['pilot'] = $this->admin_model->show($this->session->userdata('id_user'));
        $this->load->view('view_customer_view', $data);
    }

    function manage_pegawai()
    {
        $data['pegawai'] = $this->admin_model->show_pegawai();

        $this->load->view('manage_pegawai_view_admin', $data);
    }

    function add_pegawai()
    {
//        $this->form_validation->set_rules('kategori', 'Kategori', 'required|callback_kategori_check|trim|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email',
            'required|callback_email_check|trim|valid_email|xss_clean');

        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5|xss_clean');
        $this->form_validation->set_rules('re_password', 'Password',
            'trim|required|md5|matches[password]|xss_clean');

        $this->form_validation->set_rules('nama_user', 'Nama User', 'required|trim|alpha|xss_clean');
//        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim|xss_clean');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim|numeric|xss_clean');
//        $this->form_validation->set_rules('reg_jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir',
            'required|trim|callback_birth_date_check|xss_clean');
        $this->form_validation->set_rules('provinsi', 'Provinsi',
            'required|callback_select_check|trim|xss_clean');
        $this->form_validation->set_rules('kota', 'Kota', 'required|callback_select_check|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
            if ($this->input->post('provinsi') == null) {
                $id = 0;
            } else {
                $id = $this->input->post('provinsi');
            }
            $data['kotaDrop'] = $this->kota_provinsi_model->getKota($id);
            $this->load->view('add_pegawai_view', $data);
        } else {
            $data = array(

                'username'         => $this->input->post('username'),
                'email'            => $this->input->post('email'),
                'password'         => $this->input->post('password'),
                'nama_user'        => $this->input->post('nama_user'),
                'nama_perusahaan'  => $this->input->post('nama_perusahaan'),
                'alamat'           => $this->input->post('alamat'),
                'no_telepon'       => $this->input->post('no_telepon'),
                'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
                'tgl_lahir'        => $this->input->post('tgl_lahir'),
                'id_kota'          => $this->input->post('kota'),
                'status_user'      => 1,
                'id_kategori_user' => 2
            );

            $this->db->insert('user', $data);
            $data['pegawai'] = $this->admin_model->show_pegawai();
            $this->session->set_flashdata('category_success', 'Success add pegawai.');
            redirect('/admin/manage_pegawai', $data, true);
        }

    }

    function edit_pegawai()
    {
//        var_dump($this->admin_model->show($this->uri->segment(3))->result());
//        $this->form_validation->set_rules('kategori', 'Kategori', 'required|callback_kategori_check|trim|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email',
            'required|callback_email_check|trim|valid_email|xss_clean');
        if ($this->input->post('password') || $this->input->post('re_password')) {
            $this->form_validation->set_rules('password', 'Re Password', 'trim|required|md5|xss_clean');
            $this->form_validation->set_rules('re_password', 'Password',
                'trim|required|md5|matches[password]|xss_clean');
        }
        $this->form_validation->set_rules('nama_user', 'Nama User', 'required|trim|alpha|xss_clean');
//        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim|xss_clean');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim|numeric|xss_clean');
//        $this->form_validation->set_rules('reg_jenis_kelamin', 'Jenis Kelamin', 'required|trim|xss_clean');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir',
            'required|trim|callback_birth_date_check|xss_clean');
        $this->form_validation->set_rules('provinsi', 'Provinsi',
            'required|callback_select_check|trim|xss_clean');
        $this->form_validation->set_rules('kota', 'Kota', 'required|callback_select_check|trim|xss_clean');

        if ($this->form_validation->run() == false) {

            $data['user'] = $this->admin_model->show($this->uri->segment(3));
            foreach ($data['user']->result() as $u) {
                $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
                $data['kotaDrop']     = $this->kota_provinsi_model->getKota($u->id_provinsi);
            }
            $this->load->view('edit_pegawai_view', $data);
        } else {
            if ($this->input->post('password')) {
                $data = array(

                    'id_user'          => $this->input->post('id_user'),
                    'username'         => $this->input->post('username'),
                    'email'            => $this->input->post('email'),
                    'password'         => $this->input->post('password'),
                    'nama_user'        => $this->input->post('nama_user'),
                    'nama_perusahaan'  => $this->input->post('nama_perusahaan'),
                    'alamat'           => $this->input->post('alamat'),
                    'no_telepon'       => $this->input->post('no_telepon'),
                    'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
                    'tgl_lahir'        => $this->input->post('tgl_lahir'),
                    'id_kota'          => $this->input->post('kota'),
                    'status_user'      => $this->input->post('status'),
                    'id_kategori_user' => 2
                );
            } else {
                $data = array(

                    'id_user'          => $this->input->post('id_user'),
                    'username'         => $this->input->post('username'),
                    'email'            => $this->input->post('email'),
//                    'password'         => $this->input->post('password'),
                    'nama_user'        => $this->input->post('nama_user'),
                    'nama_perusahaan'  => $this->input->post('nama_perusahaan'),
                    'alamat'           => $this->input->post('alamat'),
                    'no_telepon'       => $this->input->post('no_telepon'),
                    'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
                    'tgl_lahir'        => $this->input->post('tgl_lahir'),
                    'id_kota'          => $this->input->post('kota'),
                    'status_user'      => $this->input->post('status'),
                    'id_kategori_user' => 2
                );
            }


            $this->admin_model->update_admin($data['id_user'], $data);

//            $data['pegawai'] = $this->admin_model->show_pegawai();
            $this->session->set_flashdata('category_success', 'Success update pegawai.');
            redirect('/admin/manage_pegawai', $data, true);
        }

    }

    function delete_pegawai()
    {

        $id = $this->uri->segment(3);
        $this->admin_model->delete($id);
        $this->session->set_flashdata('category_success', 'Success delete pegawai.');
        redirect('/admin/manage_pegawai', [], 'refresh');
    }

    function view_pegawai()
    {
        $data['user'] = $this->admin_model->show($this->uri->segment(3));
        $this->load->view('view_pegawai_view', $data);
    }

    function pembelian_tambah()
    {
        foreach($this->admin_model->temp()->result() as $x){
            if($x->id_temp == $this->uri->segment(3)){
                $data['temp']           = $this->admin_model->temp();
                $data['supplier']       = $this->supplier_model->show_supplier();
                $data['kategoriBarang'] = $this->barang_model->show_kategori_barang();
                $data['barang']         = $this->pembelian_model->show_barang_by_barang($this->uri->segment(3));
                $this->session->set_flashdata('category_success', 'Failed add pembelian barang.');
                redirect('/admin/pembelian', $data, true);
            }
        }
        $this->form_validation->set_rules('no_faktur_pembelian', 'No Faktur', 'required|trim|xss_clean');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli',
            'required|trim|callback_not_minus|numeric|xss_clean');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual',
            'required|trim|callback_not_minus|numeric|xss_clean');
        $this->form_validation->set_rules('jumlah', 'Stok', 'required|trim|callback_not_minus|numeric|xss_clean');

        if ($this->form_validation->run() == false) {
            $data['temp']           = $this->admin_model->temp();
            $data['supplier']       = $this->supplier_model->show_supplier();
            $data['kategoriBarang'] = $this->barang_model->show_kategori_barang();
            $data['barang']         = $this->pembelian_model->show_barang_by_barang($this->uri->segment(3));


            $this->load->view('pembelian_barang', $data);
        } else {
//            $fileType = $_FILES['gambar_barang']['type'];
//            $fileName = $_FILES['gambar_barang']['name'];
//            $fileSize = $_FILES['gambar_barang']['size'];
//            $tempFile = $_FILES['gambar_barang']['tmp_name'];
//            if (!empty($fileName)) {
//                if ($fileType == "image/jpeg" || $fileType == "image/jpg" || $fileType == "image/png") {
//                    $newFile = 'upload_image/' . $this->input->post('nama_barang') . "." . pathinfo($fileName,
//                            PATHINFO_EXTENSION);
//                }
//
//            }
            $data = [
                'id_temp'                  => $this->uri->segment(3),
                'gambar_barang_temp'       => $this->input->post('gambar_barang'),
                'nama_barang_temp'         => $this->input->post('nama_barang'),
                'harga_beli_temp'          => $this->input->post('harga_beli'),
                'harga_jual_temp'          => $this->input->post('harga_jual'),
                'jumlah_temp'              => $this->input->post('jumlah'),
                'merk_barang_temp'         => $this->input->post('merk_barang'),
                'satuan_berat_temp'        => $this->input->post('satuan_berat'),
                'nilai_berat_temp'         => $this->input->post('nilai_berat'),
                'status_barang_temp'       => 1,
                'id_kategori_barang_temp'  => $this->input->post('kategori_barang'),
                'id_supplier'              => $this->input->post('supplier'),
                'tgl_beli_temp'            => $this->input->post('tgl_beli'),
                'no_faktur_pembelian_temp' => $this->input->post('no_faktur_pembelian'),
            ];
//var_dump($data);
//            die;
//            move_uploaded_file($tempFile, $newFile);

            $this->db->insert('temp', $data);
            $this->session->set_flashdata('category_success', 'Success add pembelian barang.');
            redirect('/admin/pembelian', $data, true);
        }
    }

    function pembelian()
    {
        $this->form_validation->set_rules('supplier', 'Supplier',
            'required|trim|callback_select_check|xss_clean');
        $this->form_validation->set_rules('no_faktur_pembelian', 'No Faktur', 'required|trim|xss_clean');
        $this->form_validation->set_rules('gambar_barang', 'Gambar Barang', 'callback_upload_check|trim|xss_clean');

        $this->form_validation->set_rules('nama_barang', 'Nama Barang',
            'required|callback_barang_check|callback_barang_temp|trim|xss_clean');
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
            $data['supplier']       = $this->supplier_model->show_supplier();
            $data['kategoriBarang'] = $this->barang_model->show_kategori_barang();
            $data['temp']           = $this->admin_model->temp();


//            $data['barang'] = $this->pembelian_model->show_barang_by_supplier();


            $this->load->view('pembelian_view_admin', $data);
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
            $data = [
                'gambar_barang_temp'       => $newFile,
                'nama_barang_temp'         => $this->input->post('nama_barang'),
                'harga_beli_temp'          => $this->input->post('harga_beli'),
                'harga_jual_temp'          => $this->input->post('harga_jual'),
                'jumlah_temp'              => $this->input->post('jumlah'),
                'merk_barang_temp'         => $this->input->post('merk_barang'),
                'satuan_berat_temp'        => $this->input->post('satuan_berat'),
                'nilai_berat_temp'         => $this->input->post('nilai_berat'),
                'status_barang_temp'       => 1,
                'id_kategori_barang_temp'  => $this->input->post('kategori_barang'),
                'id_supplier'              => $this->input->post('supplier'),
                'tgl_beli_temp'            => $this->input->post('tgl_beli'),
                'no_faktur_pembelian_temp' => $this->input->post('no_faktur_pembelian'),
            ];

            move_uploaded_file($tempFile, $newFile);
//            var_dump($data['id_supplier']);
//            die;
            $this->db->insert('temp', $data);
            $this->session->set_flashdata('category_success', 'Success add pembelian barang.');
            redirect('/admin/pembelian', $data, true);


        }


    }

    function buildBarang()
    {
        $id_supp        = $this->input->post('id', true);
        $data['barang'] = $this->pembelian_model->show_barang_by_supplier($id_supp);

        $kategoriBarang = $this->barang_model->show_kategori_barang();
        $supplier       = $this->supplier_model->show_supplier();
        $q              = 1;
        $output         = "<table class='table table-hover' >" .
            "<tr style='background-color: black; color: white'>" .
            "<th>#</th>" .
            "<th>Gambar Barang</th>" .
            "<th>Nama Barang</th>" .
            "<th>Merk</th>" .
            "<th>Kategori Barang</th>" .
            "<th>Stok</th>" .
            "<th>Harga Beli</th>" .
            "<th>Harga Jual</th>" .
            "<th>Supplier</th>" .
            "<th>Action</th>" .
            "</tr>";


        foreach ($data['barang'] as $row) {
            //here we build a dropdown item line for each query result

            foreach ($kategoriBarang as $key => $value) {
                if ($key == $row->id_kategori_barang) {
                    $value = $value;
                }
            }
            foreach ($supplier->result() as $s) {
                if ($s->id_user == $row->id_supplier) {
                    $nama_perus = $s->nama_perusahaan;
                }
            }
            $output .=
                "<tr>" .
                "<td>" . $q . "</td>" .
                "<td><img height='100px' width='150px' src='" . base_url() . $row->gambar_barang . "' /></td>" .
                "<td>" . $row->nama_barang . "</td>" .
                "<td>" . $row->merk_barang . "</td>" .
                "<td>" . $value . "</td>" .
                "<td align='right'><p id='jum'>" . number_format($row->jumlah, 0, ',', '.') . "</p></td>" .
                "<td align='right'><p id='harga'>" . "Rp " . number_format($row->harga_beli, 2, ',',
                    '.') . "</p></td>" .
                "<td align='right'><p id='harga'>" . "Rp " . number_format($row->harga_jual, 2, ',',
                    '.') . "</p></td>" .
                "<td>" . $nama_perus . "</td>" .
                "<td><a href='" . base_url() . 'index.php/admin/pembelian_tambah/' . $row->id_barang . "' >" .
                form_button(array(
                    'id'      => 'choose',
                    'name'    => 'choose',
                    'content' => 'Choose',
                    'class'   => 'btn btn-ok',
                    'onclick' => '#'
                ));
            "</a></td>" .
            "</tr>";

            $q++;
        }

        $output .= "</table>";

        echo $output;
    }

    function buy_barang()
    {


        $i   = 0;
        $jum = 0;
        $tot = 0;
        foreach ($this->admin_model->temp()->result() as $a) {
            $i++;
            $jum += $a->jumlah_temp;
            $tot += ($a->harga_beli_temp * $a->jumlah_temp);
        }

        $data2 = [
            'no_faktur_pembelian' => $a->no_faktur_pembelian_temp,
            'tgl_beli'            => $a->tgl_beli_temp,
            'total_beli'          => $tot,
            'pajak'               => 0,
            'status_pembelian'    => 1,
            'id_user'             => $this->session->userdata('id_user'),
            'id_supplier'         => $a->id_supplier,
        ];

        $this->db->insert('pembelian', $data2);

//        for ($x = 0; $x < $i; $x++) {

        foreach ($this->admin_model->temp()->result() as $a) {
            $result = false;
            foreach ($this->barang_model->show_barang()->result() as $b) {
//                var_dump($a->nama_barang_temp);
//                ?><!--<<< TEMP<br> --><?php
//                var_dump($b->nama_barang);
//                ?><!--<<< INVENT<br> --><?php
                if (strtolower($a->nama_barang_temp) == strtolower($b->nama_barang)) {
                    $result = true;
                    break;
                }
            }
            if ($result) {
                //EDIT
                echo "TRUE";
                $id = $a->id_temp;
                $lama_beli = $b->harga_beli * $b->jumlah;
                $baru_beli = $a->harga_beli_temp * $a->jumlah_temp;
                $jum_lama_baru =  $b->jumlah + $a->jumlah_temp;
                $beli = ($lama_beli + $baru_beli)/$jum_lama_baru;


                $lama_jual = $b->harga_jual * $b->jumlah;
                $baru_jual = $a->harga_jual_temp * $a->jumlah_temp;
                $jual = ($lama_jual + $baru_jual)/$jum_lama_baru;


                var_dump("jumlam =" . $b->jumlah);
                var_dump("jumbar =" . $a->jumlah_temp);

                var_dump("lama beli =" . $lama_beli);
                var_dump("lama jual =" . $lama_jual);
                var_dump("baru beli =" . $baru_beli);
                var_dump("baru jual =" . $baru_jual);
                var_dump("jum =" . $jum_lama_baru);
                var_dump("beli =" . $beli);
                var_dump("jual =" . $jual);


                $data = [
                    'harga_beli'         => $beli,
                    'harga_jual'         => $jual,
                    'jumlah'             => $jum_lama_baru,
                ];


                $this->barang_model->update_barang($id, $data);

                foreach ($this->barang_model->show_barang_by_name($a->nama_barang_temp)->result() as $n) {
                    $id_barang = $n->id_barang;

                }


                foreach ($this->pembelian_model->show_pembelian_by_no($a->no_faktur_pembelian_temp)->result() as $p) {
                    $id_pembelian = $p->id_pembelian;
                }

                $data3 = [
                    'harga_beli_detail'  => $a->harga_beli_temp,
                    'jumlah_beli_detail' => $a->jumlah_temp,
                    'id_pembelian'       => $id_pembelian,
                    'id_barang'          => $id_barang,
                ];

                $this->db->insert('detail_beli', $data3);

                $this->admin_model->delete_temp($a->id_temp);

            } else {
                //INSERT
                echo "FALSE";
//                var_dump($a);
                $data = [
                    'gambar_barang'      => $a->gambar_barang_temp,
                    'nama_barang'        => $a->nama_barang_temp,
                    'harga_beli'         => $a->harga_beli_temp,
                    'harga_jual'         => $a->harga_jual_temp,
                    'jumlah'             => $a->jumlah_temp,
                    'merk_barang'        => $a->merk_barang_temp,
                    'satuan_berat'       => $a->satuan_berat_temp,
                    'nilai_berat'        => $a->nilai_berat_temp,
                    'status_barang'      => $a->status_barang_temp,
                    'id_kategori_barang' => $a->id_kategori_barang_temp,
                ];

                ?><<< XXXXXXXX<br> <?php
//                var_dump($data);
                ?><<< ZZZZZZZZZ<br> <?php

                $this->db->insert('barang', $data);
                var_dump($a->nama_barang_temp);
                foreach ($this->barang_model->show_barang_by_name($a->nama_barang_temp)->result() as $n) {
                    $id_barang = $n->id_barang;

                }


                foreach ($this->pembelian_model->show_pembelian_by_no($a->no_faktur_pembelian_temp)->result() as $p) {
                    $id_pembelian = $p->id_pembelian;
                }

                $data3 = [
                    'harga_beli_detail'  => $a->harga_beli_temp,
                    'jumlah_beli_detail' => $a->jumlah_temp,
                    'id_pembelian'       => $id_pembelian,
                    'id_barang'          => $id_barang,
                ];

                $this->db->insert('detail_beli', $data3);

                $this->admin_model->delete_temp($a->id_temp);
            }
        }
        $this->session->set_flashdata('category_success', 'Success buy pembelian barang.');
        redirect('/admin/pembelian', [], true);


    }

    function buy_pajak()
    {


        $i   = 0;
        $jum = 0;
        $tot = 0;
        foreach ($this->admin_model->temp()->result() as $a) {
            $i++;
            $jum += $a->jumlah_temp;
            $tot += (($a->harga_beli_temp + ($a->harga_beli_temp / 10)) * $a->jumlah_temp);
        }

        $data2 = [
            'no_faktur_pembelian' => $a->no_faktur_pembelian_temp,
            'tgl_beli'            => $a->tgl_beli_temp,
            'total_beli'          => $tot,
            'pajak'               => 1,
            'status_pembelian'    => 1,
            'id_user'             => $this->session->userdata('id_user'),
            'id_supplier'         => $a->id_supplier,
        ];

        $this->db->insert('pembelian', $data2);

//        for ($x = 0; $x < $i; $x++) {

        foreach ($this->admin_model->temp()->result() as $a) {
            $result = false;
            foreach ($this->barang_model->show_barang()->result() as $b) {
//                var_dump($a->nama_barang_temp);
//                ?><!--<<< TEMP<br> --><?php
//                var_dump($b->nama_barang);
//                ?><!--<<< INVENT<br> --><?php
                if (strtolower($a->nama_barang_temp) == strtolower($b->nama_barang)) {
                    $result = true;
                    break;
                }
            }
            if ($result) {
                //EDIT
                echo "TRUE";

                $id = $a->id_temp;
                $lama_beli = $b->harga_beli * $b->jumlah;
                $baru_beli = ($a->harga_beli_temp + ($a->harga_beli_temp/10)) * $a->jumlah_temp;
                $jum_lama_baru =  $b->jumlah + $a->jumlah_temp;
                $beli = ($lama_beli + $baru_beli)/$jum_lama_baru;


                $lama_jual = $b->harga_jual * $b->jumlah;
                $baru_jual = ($a->harga_jual_temp + ($a->harga_jual_temp/10)) * $a->jumlah_temp;
                $jual = ($lama_jual + $baru_jual)/$jum_lama_baru;


                var_dump("jumlam =" . $b->jumlah);
                var_dump("jumbar =" . $a->jumlah_temp);

                var_dump("lama beli =" . $lama_beli);
                var_dump("lama jual =" . $lama_jual);
                var_dump("baru beli =" . $baru_beli);
                var_dump("baru jual =" . $baru_jual);
                var_dump("jum =" . $jum_lama_baru);
                var_dump("beli =" . $beli);
                var_dump("jual =" . $jual);

                $data = [
                    'harga_beli'         => $beli,
                    'harga_jual'         => $jual,
                    'jumlah'             => $jum_lama_baru,
                ];


                $this->barang_model->update_barang($id, $data);

                foreach ($this->barang_model->show_barang_by_name($a->nama_barang_temp)->result() as $n) {
                    $id_barang = $n->id_barang;

                }


                foreach ($this->pembelian_model->show_pembelian_by_no($a->no_faktur_pembelian_temp)->result() as $p) {
                    $id_pembelian = $p->id_pembelian;
                }

                $data3 = [
                    'harga_beli_detail'  => ($a->harga_beli_temp + ($a->harga_beli_temp/10)),
                    'jumlah_beli_detail' => $a->jumlah_temp,
                    'id_pembelian'       => $id_pembelian,
                    'id_barang'          => $id_barang,
                ];

                $this->db->insert('detail_beli', $data3);

                $this->admin_model->delete_temp($a->id_temp);

            } else {
                //INSERT
                echo "FALSE";
//                var_dump($a);
                $data = [
                    'gambar_barang'      => $a->gambar_barang_temp,
                    'nama_barang'        => $a->nama_barang_temp,
                    'harga_beli'         => ($a->harga_beli_temp + ($a->harga_beli_temp / 10)),
                    'harga_jual'         => ($a->harga_jual_temp + ($a->harga_jual_temp / 10)),
                    'jumlah'             => $a->jumlah_temp,
                    'merk_barang'        => $a->merk_barang_temp,
                    'satuan_berat'       => $a->satuan_berat_temp,
                    'nilai_berat'        => $a->nilai_berat_temp,
                    'status_barang'      => $a->status_barang_temp,
                    'id_kategori_barang' => $a->id_kategori_barang_temp,
                ];

                ?><<< XXXXXXXX<br> <?php
//                var_dump($data);
                ?><<< ZZZZZZZZZ<br> <?php

                $this->db->insert('barang', $data);
                var_dump($a->nama_barang_temp);
                foreach ($this->barang_model->show_barang_by_name($a->nama_barang_temp)->result() as $n) {
                    $id_barang = $n->id_barang;

                }


                foreach ($this->pembelian_model->show_pembelian_by_no($a->no_faktur_pembelian_temp)->result() as $p) {
                    $id_pembelian = $p->id_pembelian;
                }

                $data3 = [
                    'harga_beli_detail'  => ($a->harga_beli_temp + ($a->harga_beli_temp / 10)),
                    'jumlah_beli_detail' => $a->jumlah_temp,
                    'id_pembelian'       => $id_pembelian,
                    'id_barang'          => $id_barang,
                ];

                $this->db->insert('detail_beli', $data3);

                $this->admin_model->delete_temp($a->id_temp);
            }
        }
        $this->session->set_flashdata('category_success', 'Success buy pembelian barang.');
        redirect('/admin/pembelian', [], true);


    }

    public function pajak()
    {
        //set selected country id from POST
        //run the query for the cities we specified earlier
        $temp['beli']   = $this->admin_model->temp();
        $kategoriBarang = $this->barang_model->show_kategori_barang();

        $output = "<table class='table table-hover' >" .
            "<tr style='background-color: black; color: white'>" .
            "<th>#</th>" .
            "<th>Gambar Barang</th>" .
            "<th>Nama Barang</th>" .
            "<th>Merk</th>" .
            "<th>Kategori Barang</th>" .
            "<th>Jumlah</th>" .
            "<th>Harga Beli</th>" .
            "<th>Sub Total</th>" .
            "<th>View</th>" .
            "<th>Edit</th>" .
            "<th>Delete</th>" .

            "</tr>";

        $i   = 1;
        $j   = 0;
        $tot = 0;

        foreach ($temp['beli']->result() as $row) {
//            var_dump($output);
            //here we build a dropdown item line for each query result
            ?>






            <?php

            foreach ($kategoriBarang as $key => $value) {
                if ($key == $row->id_kategori_barang_temp):
                    $value = $value;
                endif;
            }

            $output .=

//                "<tr class='($row->status_barang_temp == 1) ?  'alert-success'  :  '' . ($row->status_barang_temp == 2) ? 'alert-danger' : '' '>" .
                "<tr>" .
                "<td>" . $i . "</td>" .
                "<td><img height='100px' width='150px' src='" . base_url() . $row->gambar_barang_temp . "'/></td>" .
                "<td>" . $row->nama_barang_temp . "</td>" .
                "<td>" . $row->merk_barang_temp . " </td>" .
                "<td>" . $value . "</td>" .
                "<td align='right'>" . number_format($row->jumlah_temp, 0, ",", ".") . "</td>" .
                "<td align='right'>" . "Rp " . number_format($row->harga_beli_temp + $row->harga_beli_temp / 10, 2, ",",
                    ".") . "</td>" .
                "<td align='right'>" . "Rp " . number_format($row->jumlah_temp * ($row->harga_beli_temp + $row->harga_beli_temp / 10),
                    2, ",", ".") . "</td>" .

                "<td><a href='" . base_url() . "index.php/admin/view_barang_temp/$row->id_temp'
       class='glyphicon glyphicon-user' aria-hidden='true'> VIEW</a></td>" .
                "<td><a href='" . base_url() . "index.php/admin/edit_barang_temp/$row->id_temp'
       class='glyphicon glyphicon-cog' aria-hidden='true'> EDIT</a></td>" .
                "<td><a href='#' onclick='confDelete($row->id_temp)'
       class='glyphicon glyphicon-remove' aria-hidden='true'>
        DELETE</a></td>" .
                "</tr>";

            $j   = $j + $row->jumlah_temp;
            $tot = $tot + $row->jumlah_temp * ($row->harga_beli_temp + $row->harga_beli_temp / 10);

            $i++;
        }
        $output .=
            "<tr style='background-color: black; color: white'>" .
            "<td colspan='5' align='center'><strong>" . ($i - 1) . "Items </strong></td>" .

            "<td align='right' style='border: solid 1px'><strong>" . number_format($j, 0, ",", ".") . "</strong></td>" .
            "<td></td>" .
            "<td align='right' style='border: solid 1px'><strong>" . "Rp " . number_format($tot, 2, ",",
                ".") . "</strong></td>" .


            "<td></td>" .
            "<td></td>" .
            "<td></td>" .
            "</tr>" .
            "</table>";

        echo $output;
    }

    function edit_barang_temp()
    {
        if ($this->input->post('gambar_barang')) {
            $this->form_validation->set_rules('gambar_barang', 'Gambar Barang', 'callback_upload_check|trim|xss_clean');
        }
        $this->form_validation->set_rules('nama_barang', 'Nama Barang',
            'required|callback_barang_check|callback_barang_temp_id|trim|xss_clean');
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
            $data['temp'] = $this->admin_model->temp_by_id($this->uri->segment(3));

            $data['kategoriBarang'] = $this->barang_model->show_kategori_barang();

            $this->load->view('edit_barang_temp_view', $data);
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
                    'gambar_barang_temp'      => $newFile,
                    'nama_barang_temp'        => $this->input->post('nama_barang'),
                    'harga_beli_temp'         => $this->input->post('harga_beli'),
                    'harga_jual_temp'         => $this->input->post('harga_jual'),
                    'jumlah_temp'             => $this->input->post('jumlah'),
                    'merk_barang_temp'        => $this->input->post('merk_barang'),
                    'satuan_berat_temp'       => $this->input->post('satuan_berat'),
                    'nilai_berat_temp'        => $this->input->post('nilai_berat'),
                    'id_kategori_barang_temp' => $this->input->post('kategori_barang'),
                    'status_barang_temp'      => $this->input->post('status_barang'),
                );
                foreach ($this->admin_model->temp_by_id($this->uri->segment(3))->result() as $b) {
                    unlink($b->gambar_barang_temp);
                }

            } else {
                $data = array(
//                    'gambar_barang'      => $newFile,
                    'nama_barang_temp'        => $this->input->post('nama_barang'),
                    'harga_beli_temp'         => $this->input->post('harga_beli'),
                    'harga_jual_temp'         => $this->input->post('harga_jual'),
                    'jumlah_temp'             => $this->input->post('jumlah'),
                    'merk_barang_temp'        => $this->input->post('merk_barang'),
                    'satuan_berat_temp'       => $this->input->post('satuan_berat'),
                    'nilai_berat_temp'        => $this->input->post('nilai_berat'),
                    'id_kategori_barang_temp' => $this->input->post('kategori_barang'),
                    'status_barang_temp'      => $this->input->post('status_barang'),
                );
            }


            move_uploaded_file($tempFile, $newFile);

            $this->admin_model->update_temp($this->uri->segment(3), $data);

//            $this->db->insert('barang', $data);
//            $data['barang'] = $this->barang_model->show_barang();
            $this->session->set_flashdata('category_success', 'Success update barang.');
            redirect('/admin/pembelian', $data, true);


        }
    }

    function delete_barang_temp()
    {
        $result = false;


        foreach ($this->admin_model->temp_by_id($this->uri->segment(3))->result() as $b) {
            foreach ($this->pembelian_model->show_barang_supplier()->result() as $a) {
                if ($b->gambar_barang_temp == $a->gambar_barang) {
                    $result = true;
                }
            }
        }

        if ($result) {

        } else {
            foreach ($this->admin_model->temp_by_id($this->uri->segment(3))->result() as $b) {
                unlink($b->gambar_barang_temp);
            }
        }

        $id = $this->uri->segment(3);
        $this->admin_model->delete_temp($id);

        $this->session->set_flashdata('category_success', 'Success delete barang.');
        redirect('/admin/pembelian', [], 'refresh');
    }

    function view_barang_temp()
    {
        $data['temp'] = $this->admin_model->temp_by_id($this->uri->segment(3));

        $this->load->view('view_barang_temp_view', $data);
    }

    function history_penjualan()
    {

        $this->load->view('history_penjualan_view_admin');
    }

    function history_pembelian()
    {
        $data['pembelian'] = $this->pembelian_model->show_pembelian();
        $data['supplier']       = $this->supplier_model->show_supplier();
        $this->load->view('history_pembelian_view_admin', $data);
    }

    function view_pembelian()
    {
        $data['supplier']       = $this->supplier_model->show_supplier();
        $data['kategoriBarang'] = $this->barang_model->show_kategori_barang();

        $data['pembelian'] = $this->pembelian_model->show_pembelian_by_id($this->uri->segment(3));
        $data['detail'] = $this->pembelian_model->show_pembelian_by_id_pem($this->uri->segment(3));
        $this->load->view('history_detail_pembelian_view', $data);

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
}