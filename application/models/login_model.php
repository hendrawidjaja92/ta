<?php
/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 21/04/2015
 * Time: 1:06
 */

class login_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function insert_user() {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $nama_user = $this->input->post('nama_user');
        $alamat = $this->input->post('alamat');
        $no_telepon = $this->input->post('no_telepon');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $provinsi = $this->input->post('provinsi');
        $kota = $this->input->post('kota');

    }

    public function login() {

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $sql = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->row();

        if($result->num_rows() === 1){
            if($row->status_user){

                printf($row->status_user);
                printf($row->password);
                printf("===");
                printf($row->id_kategori_user);
                if($row->password === ($password)){

                    $session_data = array(
                        'id_user' => $row->id_user,
                        'username' => $row->username,
                        'email' => $row->email,
                        'nama_user' => $row->nama_user,
                        'nama_perusahaan' => $row->nama_perusahaan,
                        'alamat' => $row->alamat,
                        'no_telepon' => $row->no_telepon,
                        'jenis_kelamin' => $row->jenis_kelamin,
                        'tgl_lahir' => $row->tgl_lahir,
                        'id_kategori_user' => $row->id_kategori_user,

                    );
                    if($row->id_kategori_user == 1){
                        $this->set_session($session_data);
                        return 'logged_in_admin';
                    }else if($row->id_kategori_user == 2){
                        $this->set_session($session_data);
                        return 'logged_in_pegawai';
                    }else if($row->id_kategori_user == 3){
                        $this->set_session($session_data);
                        return 'logged_in_seller';
                    }else if($row->id_kategori_user == 4){
                        $this->set_session($session_data);
                        return 'logged_in_supplier';
                    }else if($row->id_kategori_user == 5){
                        $this->set_session($session_data);
                        return 'logged_in_customer';
                    }
                }
                return 'incorrect_password';
            }
            return 'not_activated';
        }
        return 'email_not_found';
    }

    private function set_session($session_data){

        $sess_data = array(
            'id_user' => $session_data['id_user'],
            'username' => $session_data['username'],
            'email' => $session_data['email'],
            'nama_user' => $session_data['nama_user'],
            'nama_perusahaan' => $session_data['nama_perusahaan'],
            'alamat' => $session_data['alamat'],
            'no_telepon' => $session_data['no_telepon'],
            'jenis_kelamin' => $session_data['jenis_kelamin'],
            'tgl_lahir' => $session_data['tgl_lahir'],
            'id_kategori_user' => $session_data['id_kategori_user'],
            'logged_in_admin' => 1,
            'logged_in_pegawai' => 1,
            'logged_in_seller' => 1,
            'logged_in_supplier' => 1,
            'logged_in_customer' => 1
        );
        $this->session->set_userdata($sess_data);
    }

    public function read_user_information($sess_array) {

        $condition = "username =" . "'" . $sess_array['username'] . "'";
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

} 