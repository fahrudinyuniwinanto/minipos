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
            if ($login == 1) {
                $row = $this->Auth_model->data_login_multitable($this->input->post('username'), md5($this->input->post('password')), $vtbl);
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
                );
                $this->session->set_userdata($data);

                //            redirect ke halaman sukses
                redirect(site_url('backend'));
            }
        }
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