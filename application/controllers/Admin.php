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
        $this->load->model('login_model');
        $this->load->model('barang_model');
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
        $this->form_validation->set_rules('gambar_barang', 'Gambar Barang', 'required|trim|xss_clean');

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim|xss_clean');
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
            $data = array(
                'gambar_barang'      => $this->input->post('gambar_barang'),
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


            $config['upload_path']   = './upload_image/';
            $config['allowed_types'] = 'jpeg|jpg|gif|png';
            $config['max_size']      = '1024';
            $config['max_width']     = '2024';
            $config['max_height']    = '1468';
            $this->load->library('upload', $config);

            $this->upload->do_upload();

            $img['upload_data'] = $this->upload->do_upload();

            $config_resize = [
                'source_image'    => $img['upload_data']['full_path'],
                'new_image'       => './thumb/',
                'maintain_ration' => true,
                'width'           => 160,
                'height'          => 120
            ];

            $$this->config->library('image_lib', $config_resize);
            $img['images'] = $this->barang_model->fetch_image(FCPATH . 'gambar_barang');



            $this->db->insert('barang', $data);
            $data['barang'] = $this->barang_model->show_barang();
            $this->session->set_flashdata('category_success', 'Success add barang.');
            redirect('/admin/manage_barang', $data, true);


        }

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

    function pembelian()
    {
        $this->load->view('pembelian_view_admin');
    }

    function history_penjualan()
    {
        $this->load->view('history_penjualan_view_admin');
    }

    function history_pembelian()
    {
        $this->load->view('history_pembelian_view_admin');
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