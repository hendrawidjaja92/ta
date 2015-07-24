<?php

/**
 * Created by PhpStorm.
 * User: uuy
 * Date: 21/04/2015
 * Time: 1:06
 */
class login_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function insert_user()
    {

        $data = [

            'username'         => $this->input->post('reg_username'),
            'email'            => $this->input->post('reg_email'),
            'password'         => $this->input->post('reg_password'),
            'nama_user'        => $this->input->post('reg_nama_user'),
            'nama_perusahaan'  => $this->input->post('reg_nama_perusahaan'),
            'alamat'           => $this->input->post('reg_alamat'),
            'no_telepon'       => $this->input->post('reg_no_telepon'),
            'jenis_kelamin'    => $this->input->post('reg_jenis_kelamin'),
            'tgl_lahir'        => $this->input->post('reg_tgl_lahir'),
            'id_kategori_user' => $this->input->post('kategori'),
            'id_kota'          => $this->input->post('reg_kota'),
            'status_user'      => '0'

        ];
//        var_dump($data);
//        die;
        $this->db->insert('user', $data);


    }

    public function login()
    {

        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        $sql = "SELECT * FROM user u JOIN kota k ON u.id_kota = k.id_kota JOIN provinsi p ON k.id_provinsi = p.id_provinsi WHERE email = '{$email}' LIMIT 1";
//        $sql = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";
        $result = $this->db->query($sql);
        $row    = $result->row();
//        printf($row->status_user);
//        printf($row->password);
//        printf("===");
        if ($result->num_rows() === 1) {
            if ($row->status_user == 1) {

                if ($row->password === ($password)) {

                    $session_data = array(
                        'id_user'          => $row->id_user,
                        'username'         => $row->username,
                        'email'            => $row->email,
                        'nama_user'        => $row->nama_user,
                        'nama_perusahaan'  => $row->nama_perusahaan,
                        'alamat'           => $row->alamat,
                        'no_telepon'       => $row->no_telepon,
                        'jenis_kelamin'    => $row->jenis_kelamin,
                        'tgl_lahir'        => $row->tgl_lahir,
                        'id_kategori_user' => $row->id_kategori_user,
                        'id_kota'          => $row->id_kota,
                        'id_provinsi'      => $row->id_provinsi,

                    );
                    if ($row->id_kategori_user == 1) {
                        $this->set_session($session_data);
                        return 'logged_in_admin';
                    } else {
                        if ($row->id_kategori_user == 2) {
                            $this->set_session($session_data);
                            return 'logged_in_pegawai';
                        } else {
                            if ($row->id_kategori_user == 3) {
                                $this->set_session($session_data);
                                return 'logged_in_seller';
                            } else {
                                if ($row->id_kategori_user == 4) {
                                    $this->set_session($session_data);
                                    return 'logged_in_supplier';
                                } else {
                                    if ($row->id_kategori_user == 5) {
                                        $this->set_session($session_data);
                                        return 'logged_in_customer';
                                    }
                                }
                            }
                        }
                    }


                }
                return 'incorrect_password';
            }
            return 'not_activated';
        }
        return 'email_not_found';
    }

    private function set_session($session_data) {

        $sess_data = array(
            'id_user'            => $session_data['id_user'],
            'username'           => $session_data['username'],
            'email'              => $session_data['email'],
            'nama_user'          => $session_data['nama_user'],
            'nama_perusahaan'    => $session_data['nama_perusahaan'],
            'alamat'             => $session_data['alamat'],
            'no_telepon'         => $session_data['no_telepon'],
            'jenis_kelamin'      => $session_data['jenis_kelamin'],
            'tgl_lahir'          => $session_data['tgl_lahir'],
            'id_kategori_user'   => $session_data['id_kategori_user'],
            'id_kota'            => $session_data['id_kota'],
            'id_provinsi'        => $session_data['id_provinsi'],
            'logged_in_admin'    => 1,
            'logged_in_pegawai'  => 1,
            'logged_in_seller'   => 1,
            'logged_in_supplier' => 1,
            'logged_in_customer' => 1
        );
        $this->session->set_userdata($sess_data);
    }

    public
    function read_user_information(
        $sess_array
    ) {

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

    public function all_user_email($str){
    $this->db->select('email');
    $this->db->from('user');
    $query = $this->db->get();
    $query = $query->result();
    foreach($query as $q){
        if($str == $q->email){
            return 'email_failed';
        }

    }
    return 'email_success';
}
    public function my_user_email($id,$str){
        $this->db->select('email');
        $this->db->from('user');
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        $query = $query->result();
        foreach($query as $q){
            if($str == $q->email){
                return 'email_success';
            }
        }
        return 'email_failed';
    }
} 