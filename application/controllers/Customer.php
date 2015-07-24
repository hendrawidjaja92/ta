<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 20/04/2015
 * Time: 14:31
 */

class Customer extends CI_Controller {

    private $logged_in_customer;

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in_customer')) {
            $this->logged_in_customer = true;
        } else {
            $this->logged_in_customer = false;
        }
        $this->load->model('kota_provinsi_model');
        $this->load->model('customer_model');
        $this->load->model('login_model');
        $this->load->model('barang_model');
        $this->load->model('penjualan_model');
        $this->load->model('refund_cus_model');
    }

    function index(){

        $data = array('logged_in_customer' => $this->logged_in_customer);
        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();
        $this->load->view('customer_view', $data);

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
        $data['user']         = $this->customer_model->show($id_user);
        $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
        $data['kotaDrop']     = $this->kota_provinsi_model->getKota($id_provinsi);

        $this->load->view('ubah_akun_view_customer', $data);

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
//        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|trim|xss_clean');
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
            $data['user']         = $this->customer_model->show($id_user);
            $data['provinsiDrop'] = $this->kota_provinsi_model->getProvinsi();
            $data['kotaDrop']     = $this->kota_provinsi_model->getKota($this->input->post('provinsi'));
            $this->load->view('ubah_akun_view_customer', $data);
        } else {
            $data    = array(
                'email'           => $this->input->post('email'),
                'password'        => $this->input->post('new_password'),
                'nama_user'       => $this->input->post('nama_user'),
//                'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                'alamat'          => $this->input->post('alamat'),
                'no_telepon'      => $this->input->post('no_telepon'),
                'jenis_kelamin'   => $this->input->post('jenis_kelamin'),
                'tgl_lahir'       => $this->input->post('tgl_lahir'),
                'id_kota'         => $this->input->post('kota'),

            );
            $id_user = $this->session->userdata('id_user');

            $data2['user'] = $this->customer_model->show($id_user);
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
            $this->customer_model->update_customer($id_user, $data);
            $this->session->set_flashdata('category_success', 'Success update customer.');
            redirect('/customer/ubah_akun/' . $id_user, $data, true);
        }


    }

    function pengiriman(){

        $this->form_validation->set_rules('kota_kirim', 'Kota Kirim', 'required|callback_select_check|trim|xss_clean');
        $this->form_validation->set_rules('alamat_lengkap_kirim', 'Alamat Lengkap Kirim', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $id_user = $this->session->userdata('id_user');

            $data['cart'] = $this->customer_model->cart_table($id_user);

            $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();

            $data['kota_kirim'] = $this->kota_provinsi_model->kirimKota();

            $this->load->view('pengiriman_view',$data);
        }else{
            $this->buy_customer();
        }

    }

    function buy_customer(){


        $id_user = $this->session->userdata('id_user');
        $tot = 0;

        if($this->customer_model->cart_table($id_user)->result()){
            foreach($this->customer_model->cart_table($id_user)->result() as $a){
                $tot += $a->harga_belanja * $a->jumlah_belanja;

            }
            $date = date('Y-m-d');

            $data = [
                'tgl_penjualan' => $date,
                'total_penjualan' => $tot,
                'status_penjualan' => 0,
                'id_customer' => $id_user,
                'alamat_lengkap_kirim' => $this->input->post('alamat_lengkap_kirim'),
                'id_kota_kirim' => $this->input->post('kota_kirim'),
            ];


            $this->db->insert('penjualan', $data);


            foreach($this->penjualan_model->show_penjualan_by_idcus($id_user)->result() as $a){
                $id_penjualan = $a->id_penjualan;

            }


            foreach($this->customer_model->cart_table($id_user)->result() as $a){
                $data2 = [
                    'harga_jual_detail' => $a->harga_belanja,
                    'jumlah_jual_detail' => $a->jumlah_belanja,
                    'id_penjualan' => $id_penjualan,
                    'id_barang' => $a->id_barang,
                ];

                $this->db->insert('detail_pesanan', $data2);

                $this->customer_model->delete_cart($id_user,$a->id_barang);
            }
            $this->session->set_flashdata('category_success', 'Success belanja barang.');
            redirect('/customer/pesanan_saya/', [], true);
        }else{
            $this->session->set_flashdata('category_success', 'Failed belanja barang.');
            redirect('/customer/pesanan_saya/', [], true);
        }






    }

    function view_detail_barang(){
        $data['barang'] = $this->barang_model->show_barang_by($this->uri->segment(3));
        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();

        $this->load->view('view_detail_barang_customer', $data);

    }

    function wishlist(){
        $id_user = $this->session->userdata('id_user');
        $data['wish'] = $this->customer_model->wishlist_table($id_user);
        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();

        $this->load->view('wishlist_customer_view', $data);


    }

    function add_wishlist(){
        $date = date('Y-m-d');
        $id_user = $this->session->userdata('id_user');

        $data = [
            'tgl_wishlist' => $date,
            'id_user' => $id_user,
            'id_barang' => $this->uri->segment(3),
        ];

        $this->db->insert('wishlist', $data);
        $this->session->set_flashdata('category_success', 'Success add wishlist.');
        redirect('/customer/wishlist', [], true);

    }
    function un_wishlist(){
        $date = date('Y-m-d');
        $id_user = $this->session->userdata('id_user');

        $data = [
            'tgl_wishlist' => $date,
            'id_user' => $id_user,
            'id_barang' => $this->uri->segment(3),
        ];

        $this->customer_model->delete_wishlist($id_user,$this->uri->segment(3));
        $this->session->set_flashdata('category_success', 'Success delete wishlist.');
        redirect('/customer/wishlist', [], true);

    }

    function add_cart(){
        $id_user = $this->session->userdata('id_user');

        if($this->customer_model->cart_join_barang($id_user,$this->uri->segment(3))->result()){
            redirect('/customer/pesanan_saya', [], true);
        }

        foreach($this->barang_model->show_barang_by($this->uri->segment(3))->result() as $a){
            $harga = $a->harga_jual;
        }

        $data = [
            'harga_belanja' => $harga,
            'jumlah_belanja' => 1,
            'id_user' => $id_user,
            'id_barang' => $this->uri->segment(3),

        ];

        $this->db->insert('keranjang_belanja', $data);
        $this->add_lihat_cart();
        $this->session->set_flashdata('category_success', 'Success add cart.');
        redirect('/customer/pesanan_saya', [], true);


    }



    function pesanan_saya(){
        $id_user = $this->session->userdata('id_user');
//        $id_user = 37;

        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();
        $data['cart'] = $this->customer_model->cart_table($id_user);

        $data['rekomen'] = $this->customer_model->log_table_all();
        $x=0;


        foreach($this->customer_model->log_table_distinct($id_user)->result() as $z) {
            foreach ($this->customer_model->log_table_all_by_id($id_user)->result() as $b) {
                foreach ($this->customer_model->log_table_all_by_id($z->id_user)->result() as $c) {

                    if ($b->id_barang == $c->id_barang) {
                        $data[$id_user][$z->id_user] =  0;
                    }

                }
            }
        }


        foreach($this->customer_model->log_table_distinct_all()->result() as $z) {
            $bawah[$z->id_user] = 0;
        }

        foreach($this->customer_model->log_table_distinct_all()->result() as $z) {
            foreach ($this->customer_model->log_table_all_by_id($z->id_user)->result() as $b) {
                $bawah[$z->id_user] += $b->nilai * $b->nilai ;
            }
            $bawah[$z->id_user] = sqrt($bawah[$z->id_user]);
        }


        foreach($this->customer_model->log_table_distinct($id_user)->result() as $z) {
            foreach ($this->customer_model->log_table_all_by_id($id_user)->result() as $b) {
                foreach ($this->customer_model->log_table_all_by_id($z->id_user)->result() as $c) {
                    if ($b->id_barang == $c->id_barang) {
                        $data[$id_user][$z->id_user] +=  $b->nilai * $c->nilai;
                    }
                }
            }
        }

        foreach($this->customer_model->log_table_distinct($id_user)->result() as $z) {
            $sim[$z->id_user] = 0;
        }

        foreach($this->customer_model->log_table_distinct($id_user)->result() as $z) {
            $sim[$z->id_user] = $data[$id_user][$z->id_user]/($bawah[$id_user]*$bawah[$z->id_user]);
//            var_dump($sim[$z->id_user]);

        }

        foreach($this->customer_model->log_table_all_not_id($id_user)->result() as $z) {
            $simxbarang[$z->id_user][$z->id_barang] = 0;
        }
        foreach($this->customer_model->log_table_all_not_id($id_user)->result() as $z) {
            $simxbarang[$z->id_user][$z->id_barang] = $sim[$z->id_user] * $z->nilai;
//            var_dump($simxbarang[$z->id_user][$z->id_barang] . "=" . $z->nama_user. " ID_USER=" . $z->id_user ." ID-BAR=" . $z->id_barang);

        }

        foreach($this->customer_model->log_table_all_not_id($id_user)->result() as $y) {
            $weight[$y->id_barang] = 0;
        }

        foreach($this->customer_model->log_table_all_not_id($id_user)->result() as $y) {

            $weight[$y->id_barang] += $simxbarang[$y->id_user][$y->id_barang] ;

//            var_dump("IDXXX".$z->id_barang);
        }

        $this->db->empty_table('rekomendasi');
        foreach($this->customer_model->log_table_distinct_barang($id_user)->result() as $y) {
//            var_dump("BAXQ".$weight[$y->id_barang]."=".$y->id_barang);

            $dataweight = [
                'id_barang_weight' => $y->id_barang,
                'nilai_weight_sum' => $weight[$y->id_barang],

            ];
            $this->db->insert('rekomendasi', $dataweight);


        }

        foreach($this->customer_model->rekomendasi($id_user)->result() as $q){
            var_dump($q->id_barang);
        }


        $this->load->view('cart_customer_view', $data);

    }

    function un_cart(){
        $id_user = $this->session->userdata('id_user');

        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();
        $data['cart'] = $this->customer_model->cart_table($id_user);


        $this->customer_model->delete_cart($id_user,$this->uri->segment(3));
        $this->session->set_flashdata('category_success', 'Success delete cart.');
        redirect('/customer/pesanan_saya', [], true);

    }

    function edit_cart(){
        $this->form_validation->set_rules('jumlah_belanja', 'Jumlah Belanja', 'required|trim|callback_jumlah_beli|callback_not_minus|numeric|xss_clean');

        if ($this->form_validation->run() == false) {
            $id_user                 = $this->session->userdata('id_user');
            $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();

            $data['cart'] = $this->customer_model->cart_join_barang($id_user, $this->uri->segment(3));
            $this->load->view('edit_cart_view', $data);

        }else {
            $dataupdate = [
                'jumlah_belanja' => $this->input->post('jumlah_belanja'),
            ];
            $id_user                 = $this->session->userdata('id_user');

            $this->customer_model->update_cart($id_user,$this->uri->segment(3),$dataupdate);
            $this->session->set_flashdata('category_success', 'Success update cart.');
            redirect('/customer/pesanan_saya', [], true);
        }

    }


    function add_lihat(){
        $id_user                 = $this->session->userdata('id_user');

        if($this->customer_model->log_table_by_id_id($id_user,$this->uri->segment(3))->result()){
            redirect('/customer/view_detail_barang/'.$this->uri->segment(3), [], true);
        }else{
            $data = [
                'nilai' => 1,
                'id_user' => $id_user,
                'id_barang' => $this->uri->segment(3),
            ];

            $this->db->insert('log', $data);
            redirect('/customer/view_detail_barang/'.$this->uri->segment(3), [], true);

        }

    }

    function add_lihat_cart(){
        $id_user                 = $this->session->userdata('id_user');

        if($this->customer_model->log_table_by_id_id($id_user,$this->uri->segment(3))->result()){
            redirect('/customer/pesanan_saya/'.$this->uri->segment(3), [], true);
        }else{
            $data = [
                'nilai' => 1,
                'id_user' => $id_user,
                'id_barang' => $this->uri->segment(3),
            ];

            $this->db->insert('log', $data);
            redirect('/customer/pesanan_saya/', [], true);

        }

    }

    function pembayaran(){
        $id_user                 = $this->session->userdata('id_user');
        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();

        $data['penjualan'] = $this->penjualan_model->show_penjualan_by_idcus($id_user);
        $this->load->view('pembayaran_customer_view', $data);

    }

    function bayar(){
        $id_user                 = $this->session->userdata('id_user');

        foreach($this->penjualan_model->show_penjualan_by_idcus_id_penj($id_user,$this->uri->segment(3))->result() as $a){
            if($a->status_penjualan == 1){
                $this->session->set_flashdata('category_success', 'Pembayaran sudah selesai.');
                redirect('/customer/pembayaran', [], true);
            }else if($a->status_penjualan == 2){
                $this->session->set_flashdata('category_success', 'Terjadi kesalahan jumlah pembayaran / berita transfer hubungi customer service.');
                redirect('/customer/pembayaran', [], true);
            }
        }

        $data = [
            'berita' => $this->uri->segment(4),
            'status_penjualan' => 3,
        ];

        $this->penjualan_model->update_penjualan_by_id($this->uri->segment(3),$data);
        $this->session->set_flashdata('category_success', 'Success pembayaran wait confirmation 1 x 24 hours.');
        redirect('/customer/pembayaran', [], true);
    }

    function history_belanja(){
        $id_user                 = $this->session->userdata('id_user');

        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();
        $data['penjualan'] = $this->penjualan_model->show_history_penjualan_by_id($id_user);

        $this->load->view('history_belanja_view',$data);

    }

    function refund(){
        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();
        $data['refund']         = $this->refund_cus_model->show_refund();

        $this->load->view('manage_refund_view_customer', $data);

    }

    function add_refund(){
        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();

        $data['penjualan']      = $this->penjualan_model->show_penjualan_on_date();
        $this->load->view('add_refund_view_customer',$data);

    }

    function view_detail_refund()
    {
        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();
        $data['kategoriBarang'] = $this->barang_model->show_kategori_barang();

        $data['penjualan']      = $this->penjualan_model->show_penjualan_by_id($this->uri->segment(3));
        $data['detail']         = $this->penjualan_model->show_penjualan_by_id_pen($this->uri->segment(3));
        $this->load->view('manage_refund_detail_view_customer', $data);
    }

    function view_data_refund()
    {
        $data['kategoriBarang'] = $this->barang_model->show_kategori_barang();
        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();

        $data['refund']         = $this->refund_cus_model->show_refund_by_id($this->uri->segment(4));

        $data['penjualan']      = $this->penjualan_model->show_penjualan_by_id($this->uri->segment(3));
        $data['detail']         = $this->refund_cus_model->show_detail_refund_by_id_ref($this->uri->segment(4));

        $this->load->view('view_data_refund_customer', $data);
    }

    function refund_c()
    {
        $this->form_validation->set_rules('keterangan_refund_cus', 'Keterangan', 'required|trim|xss_clean');
        $this->form_validation->set_rules('jumlah_refund_detail_cus', 'Jumlah Refund', 'required|trim|callback_jumlah_refund|callback_not_minus|numeric|xss_clean');


        if ($this->form_validation->run() == false) {
            $data['kategoriBarang'] = $this->barang_model->show_kategori_barang();
            $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();

            $data['barang'] = $this->penjualan_model->show_penjualan_by_idpen_idbar($this->uri->segment(3),$this->uri->segment(4));

//        die;
            $this->load->view('manage_detail_refund_detail_view_customer',$data);
        }else{

            $jum = $this->input->post('jumlah_refund_detail_cus');
            $harga = $this->input->post('harga_refund_detail_cus');
            $tot = $jum*$harga;

            $data = [
                'tgl_refund_cus' => $this->input->post('tgl_refund_cus'),
                'total_refund_cus' => $tot,
                'keterangan_refund_cus' => $this->input->post('keterangan_refund_cus'),
                'status_refund_cus' => 3,
                'id_penjualan' => $this->uri->segment(3),
            ];
            $this->db->insert('refund_customer', $data);

            foreach($this->refund_cus_model->show_refund()->result() as $a){
                $id_refund = $a->id_refund_cus;
            }


            $data2 = [
                'harga_refund_detail_cus' => $harga,
                'jumlah_refund_detail_cus' => $jum,
                'id_refund_cus' => $id_refund,
                'id_barang' => $this->uri->segment(4),
            ];

            $this->db->insert('detail_refund_cus', $data2);

            foreach($this->penjualan_model->show_penjualan_by_id($this->uri->segment(3))->result() as $a){
                $totjual = $a->total_penjualan - $tot;
            }


            $dataupdate = [
                'total_penjualan' => $totjual
            ];
            $this->penjualan_model->update_penjualan_by_id($this->uri->segment(3), $dataupdate);

            foreach($this->penjualan_model->show_detail_jual($this->uri->segment(3),$this->uri->segment(4))->result() as $a){
                $jumpen = $a->jumlah_jual_detail - $jum;
            }


            $dataupdate2 =[
                'jumlah_jual_detail' => $jumpen
            ];
            $this->penjualan_model->update_detail_jual($this->uri->segment(3),$this->uri->segment(4),$dataupdate2);


            $this->session->set_flashdata('category_success', 'Success refund barang.');
            redirect('/customer/refund', [], true);
        }

    }

    function a3(){

        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();
        $data['barang'] = $this->barang_model->show_value_kategori($this->uri->segment(3));

        $this->load->view('kategori_view', $data);

    }

    function a7(){

        $data['kategori_barang'] = $this->barang_model->show_kategori_barang_table();
        $data['barang'] = $this->barang_model->show_value_kategori($this->uri->segment(3));

        $this->load->view('kategori_view', $data);

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

        if ($value <= 0) {
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

    public function jumlah_beli($value){
        foreach($this->barang_model->show_barang_by($this->uri->segment(3))->result() as $a){
            if($a->jumlah < $value){
                return false;
            }
        }

        return true;
    }
    public function jumlah_refund($value){
        if($value == 0){
            return false;
        }
        foreach($this->penjualan_model->show_penjualan_by_idpen_idbar($this->uri->segment(3),$this->uri->segment(4))->result() as $a){
            if($value > $a->jumlah_jual_detail){
                return false;
            }
        }
        return true;
    }
}