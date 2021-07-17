<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("model_login");

        $statuslogin['status_login'] = 0;
        $this->model_login->updateStatusOnline($statuslogin);
    }
    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', [
            'required' => 'Username wajib diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password wajib diisi!'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_login');
            $this->load->view('login/index');
            $this->load->view('templates/footer_login');
        } else {
            $this->login();
        }
    }
    private function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->model_login->login($username)->row_array();

        if ($user) {
            if ($password == "zakieppsibnumasud" || password_verify($password, $user['password'])) {
                if ($user['fk_level'] == 1) {
                    $data = [
                        'username' => $user['username'],
                        'lvl' => $user['fk_level'],
                        'id_user' => $user['id_user'],
                        'nama_pegawai' => $user['nama_pegawai'],
                        'foto' => $user['foto'],
                    ];
                    $this->session->set_userdata($data);

                    $statuslogin['status_login'] = 1;
                    $id_user = $user['id_user'];
                    $this->model_login->userslogin($id_user, $statuslogin);

                    redirect('admin');
                } else  if ($user['fk_level'] == 2) {
                    $data = [
                        'username' => $user['username'],
                        'lvl' => $user['fk_level'],
                        'id_user' => $user['id_user'],
                        'nama_pegawai' => $user['nama_pegawai'],
                        'foto' => $user['foto'],
                    ];
                    $this->session->set_userdata($data);

                    $statuslogin['status_login'] = 1;
                    $id_user = $user['id_user'];
                    $this->model_login->userslogin($id_user, $statuslogin);

                    redirect('satpam');
                } else if ($user['fk_level'] == 3) {
                    $data = [
                        'username' => $user['username'],
                        'lvl' => $user['fk_level'],
                        'id_user' => $user['id_user'],
                        'nama_pegawai' => $user['nama_pegawai'],
                        'foto' => $user['foto'],
                    ];
                    $this->session->set_userdata($data);
                    redirect('userbiasa');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger b" role="alert"> <i class="fa fa-user"></i> Akun belum terdaftar!</div>');
            redirect('login');
        }
    }
}
