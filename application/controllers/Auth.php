<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }
    public function index($error = null)
    {
        $data = [
            // 'content'=>'frontend/login.php'
        ];
        $this->load->view('frontend/login.php', $data);
    }

    

    public function login()
    {
        //CAPTCHA================================//
        $cpt    = $this->input->post("cpt", true);
        $rescpt = $this->input->post("rescpt", true);
        if ($cpt != $rescpt) {
            $this->session->set_flashdata('msgcaptcha', '<i class="fa fa-warning"></i> Captcha belum tepat, silakan ulangi lagi');
            redirect(site_url(''));
        }

        //ENDOFCAPTCHA=========================//
        //sebut nama tabel yg akan dicek login
        $data_tbl = array('users');
        foreach ($data_tbl as $key => $vtbl) {
            $login = $this->Auth_model->login_multitable($this->input->post('username'), md5($this->input->post('password')), $vtbl);
            // die($this->db->last_query());
            if ($login == 1) {
                // die($value . "=" . $login);
                //          ambil detail data
                $row = $this->Auth_model->data_login_multitable($this->input->post('username'), md5($this->input->post('password')), $vtbl);
                // switch ($vtbl) { //sesuai id di tabel user_group
                //     case 'users':
                //         $grup = 1;
                //         break;
                // }
                // die($grup."dfdf");
                //          daftarkan session
                $data = array(
                    'logged'   => true,
                    'shift'  => $this->input->post("shift", true),
                    'id_user'  => $row->id_user,
                    'username' => $row->username,
                    'fullname' => $row->fullname,
                    'telp'     => $row->telp,
                    'email'    => $row->email,
                    'foto'     => $row->foto,
                    'level'    => $row->id_group,
                    'id_cabang'   => $row->id_cabang,
                );
                $this->session->set_userdata($data);

                //            redirect ke halaman sukses
                redirect(site_url('backend'));
            }
        }
        // die("asdf");
        //            tampilkan pesan error
        $this->session->set_flashdata('msgcaptcha', '<i class="fa fa-warning"></i> Username atau password belum tepat');
        redirect(site_url(''));
    }

    public function logout()
    {
        //        destroy session
        $this->session->sess_destroy();

        //        redirect ke halaman login
        redirect(site_url('auth'));
    }
}