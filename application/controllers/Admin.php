<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("model_admin");
        $this->load->model("model_login");
        $this->load->helper('cookie');
        $this->load->library('pdfku');
        $this->load->library('ciqrcode');
        if ($this->model_admin->isNotLogin()) {
            redirect("login");
        };

        date_default_timezone_set('Asia/Jakarta');
        $now['last_login'] = date('Y-m-d H:i:s');
        $this->model_login->updateLastLogin($this->session->userdata('id_user'), $now);

        $statuslogin['status_login'] = 1;
        $id_user = $this->session->userdata('id_user');
        $this->model_login->userslogin($id_user, $statuslogin);
    }
    public function index()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['lvl'] = $this->session->userdata('lvl');

        $data['sp'] = $this->model_admin->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_admin->getJumlahPengumumanHI()->num_rows();
        $data['jml_jurnal_hi'] = $this->model_admin->getJurnalHI()->num_rows();
        $data['jml_h_hi'] = $this->model_admin->getJHadir()->num_rows();
        $data['jml_th_hi'] = $this->model_admin->getJTHadir()->num_rows();
        $data['jml_ju_hi'] = $this->model_admin->getJUsers()->num_rows();
        $data['jml_juo_hi'] = $this->model_admin->getJUsersOnline()->num_rows();
        $data['jml_jsj_hi'] = $this->model_admin->getSJurnal()->num_rows();

        $this->load->view("templates/header", $data);
        $this->load->view("admin/index", $data);
        $this->load->view("templates/footer");
    }
    public function data_info()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['pengumuman'] = $this->model_admin->getPengumuman()->result();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("admin/data_info", $data);
        $this->load->view("templates/footer");
    }
    public function add_pengumuman()
    {
        $this->form_validation->set_rules('isi', 'Isi', 'required', [
            'required' => 'Isi pengumuman wajib diisi !',
        ]);
        $this->form_validation->set_rules('kepada', 'Kepada', 'required', [
            'required' => 'Tujuan kepada user wajib dipilih !',
        ]);
        if ($this->form_validation->run() == false) {
            $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
            $data['foto'] = $this->session->userdata('foto');
            $data['pengumuman'] = $this->model_admin->getPengumuman()->result();
            $data['lvl'] = $this->session->userdata('lvl');
            $this->load->view("templates/header", $data);
            $this->load->view("admin/data_info", $data);
            $this->load->view("templates/footer");
        } else {
            $data = array(
                'isi' => $this->input->post('isi'),
                'kepada' => $this->input->post('kepada'),
                'tanggal' => date('Y-m-d'),
                'pukul' => date('H:i:s')
            );
            $this->model_admin->add_pengumuman($data);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Pengumuman Berhasil Ditambahkan!</div></h4>');
            redirect("admin/data_info");
        }
    }
    public function hapus_pengumuman()
    {
        $id['id_pengumuman'] = $this->uri->segment(3);
        $this->model_admin->hapus_pengumuman($id);
        $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Pengumuman Berhasil Dihapus!</div></h4>');
        redirect("admin/data_info");
    }
    public function update_pengumuman()
    {
        $isi = $this->input->post('isip');
        $kepada = $this->input->post('ke');
        $id = $this->input->post('idp');
        if (empty($isi) || is_null($kepada)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Isi & Tujuan Pengumuman Wajib di Isi !</div></h4>');
            redirect("admin/data_info");
        } else {
            $data = array(
                'isi' => $isi,
                'kepada' => $kepada,
                'ket_edit' => 1
            );
            $this->model_admin->update_pengumuman($data, $id);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Pengumuman Berhasil Diubah!</div></h4>');
            redirect("admin/data_info");
        }
    }
    public function data_users()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['jabatan'] = $this->model_admin->getJabatan()->result();
        $data['users'] = $this->model_admin->getUsers()->result();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("admin/data_users", $data);
        $this->load->view("templates/footer");
    }
    public function tambah_user()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['jabatan'] = $this->model_admin->getJabatan()->result();
        $data['users'] = $this->model_admin->getUsers()->result();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("admin/tambah_user", $data);
        $this->load->view("templates/footer");
    }
    public function add_user()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]', [
            'required' => 'Nama wajib diisi !',
            'min_length' => 'Nama terlalu pendek'
        ]);
        $this->form_validation->set_rules('tl', 'Tempat Lahir', 'required|trim|min_length[3]', [
            'required' => 'Tempat Lahir wajib diisi !',
            'min_length' => 'Tempat Lahir terlalu pendek'
        ]);
        $this->form_validation->set_rules('tgl', 'Tanggal Lahir', 'required', [
            'required' => 'Tanggal Lahir wajib diisi !'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[15]|is_unique[users.username]', [
            'required' => 'Username wajib diisi !',
            'is_unique' => 'Username sudah ada',
            'min_length' => 'Username terlalu pendek',
            'max_length' => 'Username terlalu panjang'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Password wajib diisi !',
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'required' => 'Password wajib diisi !',
            'matches' => 'Password tidak sama',
        ]);
        $this->form_validation->set_rules('asal', 'Asal', 'required|trim|min_length[3]', [
            'required' => 'Asal wajib diisi !',
            'min_length' => 'Asal terlalu pendek'
        ]);
        $this->form_validation->set_rules('tamatan', 'Tamatan', 'required|trim|min_length[3]', [
            'required' => 'Tamatan wajib diisi !',
            'min_length' => 'Tamatan terlalu pendek'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[3]', [
            'required' => 'Alamat wajib diisi !',
            'min_length' => 'Alamat terlalu pendek'
        ]);
        $this->form_validation->set_rules('pend_terakhir', 'Pendidikan', 'required|trim', [
            'required' => 'Pendidikan terakhir wajib diisi !',
        ]);
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
            'required' => 'Jabatan wajib diisi !',
        ]);
        $this->form_validation->set_rules('level_user', 'Level', 'required|trim', [
            'required' => 'Level user wajib diisi !',
        ]);
        if ($this->form_validation->run() == false) {
            $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
            $data['foto'] = $this->session->userdata('foto');
            $data['users'] = $this->model_admin->getUsers()->result();
            $data['jabatan'] = $this->model_admin->getJabatan()->result();
            $data['lvl'] = $this->session->userdata('lvl');
            $this->load->view("templates/header", $data);
            $this->load->view("admin/tambah_user", $data);
            $this->load->view("templates/footer");
        } else {

            $data_user = [
                'username' => htmlspecialchars($this->input->post('username')),
                'password' => password_hash(
                    $this->input->post('password1'),
                    PASSWORD_DEFAULT
                ),
                'fk_level' => $this->input->post('level_user')
            ];
            $this->model_admin->add_data('users', $data_user);
            $id__ = $this->db->insert_id();
            $data = [
                'fk_user' => $id__,
                'nama_pegawai' => htmlspecialchars($this->input->post('nama')),
                't_lahir' => htmlspecialchars($this->input->post('tl')),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl')),
                'nohp' => htmlspecialchars($this->input->post('nohp')),
                'asal' => htmlspecialchars($this->input->post('asal')),
                'alamat' => htmlspecialchars($this->input->post('alamat')),
                'pendidikan_terakhir' => $this->input->post('pend_terakhir'),
                'tamatan' => htmlspecialchars($this->input->post('tamatan')),
                'keahlian' => htmlspecialchars($this->input->post('keahlian')),
                'jabatan' => htmlspecialchars($this->input->post('jabatan')),
                'foto' => 'default.jpg'
            ];
            $this->model_admin->add_data('pegawai', $data);

            $data_ahi['fk_user_ahi'] = $id__;
            $this->model_admin->add_data('absen_hariini', $data_ahi);

            $data_j['fk_user_jhi'] = $id__;
            $this->model_admin->add_data('jurnal_hariini', $data_j);

            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Pegawai Berhasil Ditambahkan!</div></h4>');
            redirect('admin/data_users');
        }
    }
    public function update_jabatan()
    {
        $id = htmlspecialchars($this->input->post('id_ej'));
        $nama_ej = htmlspecialchars($this->input->post('jabatan_ej'));

        if ($nama_ej == null) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Jabatan Gagal Di Ubah, Nama Jabatan Wajib Di Isi !</div></h4>');
            redirect("admin/data_users");
        } else {
            $data = array(
                'nama_jabatan' => $nama_ej
            );
            $this->model_admin->update_data('jabatan', $data, 'id_jabatan', $id);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Jabatan Berhasil Ditambahkan!</div></h4>');
            redirect('admin/data_users');
        }
    }
    public function update_user()
    {
        $id = htmlspecialchars($this->input->post('id_ep'));
        $nama = htmlspecialchars($this->input->post('nama_ep'));
        $tl = htmlspecialchars($this->input->post('tl_ep'));
        $tgl = htmlspecialchars($this->input->post('tgl_ep'));
        $jabatan = htmlspecialchars($this->input->post('jabatan_ep'));
        $nohp = htmlspecialchars($this->input->post('nohp_ep'));
        $keahlian = htmlspecialchars($this->input->post('keahlian_ep'));
        $level = htmlspecialchars($this->input->post('level_ep'));
        $pend = htmlspecialchars($this->input->post('pend_ep'));
        $tamatan = htmlspecialchars($this->input->post('tamatan_ep'));
        $asal = htmlspecialchars($this->input->post('asal_ep'));
        $alamat = htmlspecialchars($this->input->post('alamat_ep'));
        // var_dump(is_null($keahlian));
        // die;
        // var_dump($nama, $tl . $tgl, $jabatan, $nohp, $keahlian, $level, $pend, $tamatan, $asal, $alamat);
        // die;
        if ($nama == null) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Pegawai Gagal Di Ubah, Nama* Wajib Di Isi !</div></h4>');
            redirect("admin/data_users");
        } else  if ($tl == null) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Pegawai Gagal Di Ubah, Tempat Lahir* Wajib Di Isi !</div></h4>');
            redirect("admin/data_users");
        } else  if ($tgl == null) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Pegawai Gagal Di Ubah, Tanggal Lahir* Wajib Di Isi !</div></h4>');
            redirect("admin/data_users");
        } else  if ($jabatan == null) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Pegawai Gagal Di Ubah, Jabatan* Wajib Di Isi !</div></h4>');
            redirect("admin/data_users");
        } else  if ($level == null) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Pegawai Gagal Di Ubah, Level User* Wajib Di Isi !</div></h4>');
            redirect("admin/data_users");
        } else  if ($pend == null) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Pegawai Gagal Di Ubah, Pendidikan Terakhir* Wajib Di Isi !</div></h4>');
            redirect("admin/data_users");
        } else  if ($tamatan == null) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Pegawai Gagal Di Ubah, Tamatan* Wajib Di Isi !</div></h4>');
            redirect("admin/data_users");
        } else  if ($asal == null) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Pegawai Gagal Di Ubah, Asal* Wajib Di Isi !</div></h4>');
            redirect("admin/data_users");
        } else  if ($alamat == null) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Pegawai Gagal Di Ubah, Alamat* Wajib Di Isi !</div></h4>');
            redirect("admin/data_users");
        } else {
            $data_user['fk_level'] = $level;
            $this->model_admin->update_data('users', $data_user, 'id_user', $id);
            $data = [
                'nama_pegawai' => $nama,
                't_lahir' => $tl,
                'tgl_lahir' => $tgl,
                'nohp' => $nohp,
                'asal' => $asal,
                'alamat' => $alamat,
                'pendidikan_terakhir' => $pend,
                'tamatan' => $tamatan,
                'keahlian' => $keahlian,
                'jabatan' => $jabatan
            ];
            $this->model_admin->update_data('pegawai', $data, 'fk_user', $id);

            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Pegawai Berhasil Di Ubah!</div></h4>');
            redirect('admin/data_users');
        }
    }
    public function add_jabatan()
    {
        $nama_jabatan = htmlspecialchars($this->input->post("jabatan"));
        if (empty($nama_jabatan) || is_null($nama_jabatan)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Jabatan Gagal Ditambahkan, Nama Jabatan Wajib di Isi !</div></h4>');
            redirect("admin/data_users");
        } else {
            $data = [
                'nama_jabatan' => $nama_jabatan
            ];
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Jabatan Berhasil Ditambahkan!</div></h4>');
            $this->model_admin->add_data('jabatan', $data);
            redirect("admin/data_users");
        }
    }
    public function profile()
    {
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->model_admin->getProfileSaya($id_user)->row_array();
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("admin/profile", $data);
        $this->load->view("templates/footer");
    }
    public function edit_profileku()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]', [
            'required' => 'Nama wajib diisi !',
            'min_length' => 'Nama terlalu pendek'
        ]);
        $this->form_validation->set_rules('t_lahir', 'Tempat Lahir', 'required|trim|min_length[3]', [
            'required' => 'Tempat Lahir wajib diisi !',
            'min_length' => 'Tempat Lahir terlalu pendek'
        ]);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required', [
            'required' => 'Tanggal Lahir wajib diisi !'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[15]', [
            'required' => 'Username wajib diisi !',
            // 'is_unique' => 'Username sudah ada',
            'min_length' => 'Username terlalu pendek',
            'max_length' => 'Username terlalu panjang'
        ]);
        // $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
        //     'required' => 'Password wajib diisi !',
        //     'matches' => 'Password tidak sama',
        //     'min_length' => 'Password terlalu pendek'
        // ]);
        // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
        //     'required' => 'Password wajib diisi !',
        //     'matches' => 'Password tidak sama',
        // ]);
        $this->form_validation->set_rules('asal', 'Asal', 'required|trim|min_length[3]', [
            'required' => 'Asal wajib diisi !',
            'min_length' => 'Asal terlalu pendek'
        ]);
        $this->form_validation->set_rules('tamatan', 'Tamatan', 'required|trim|min_length[3]', [
            'required' => 'Tamatan wajib diisi !',
            'min_length' => 'Tamatan terlalu pendek'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[3]', [
            'required' => 'Alamat wajib diisi !',
            'min_length' => 'Alamat terlalu pendek'
        ]);
        $this->form_validation->set_rules('pend_terakhir', 'Pendidikan', 'required|trim', [
            'required' => 'Pendidikan terakhir wajib diisi !',
        ]);
        if ($this->form_validation->run() == false) {
            $id_user = $this->session->userdata('id_user');
            $data['profile'] = $this->model_admin->getProfileSaya($id_user)->row_array();
            $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
            $data['foto'] = $this->session->userdata('foto');
            $data['lvl'] = $this->session->userdata('lvl');
            $this->load->view("templates/header", $data);
            $this->load->view("admin/profile", $data);
            $this->load->view("templates/footer");
        } else {
            $id_user = $this->session->userdata('id_user');

            // $upload_foto = $_FILES['fotoku'];
            // var_dump($upload_foto);
            // die;

            $data_user = [
                'username' => htmlspecialchars($this->input->post('username')),
            ];
            $this->model_admin->update_data('users', $data_user, 'id_user', $id_user);
            $fotoku = $_FILES['fotoku']['name'];
            if ($fotoku) {
                $config['upload_path'] = './assets/img/profile';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size']             = 2048;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('fotoku')) {
                    $fotoku = $this->upload->data('file_name');
                    $data = [
                        'nama_pegawai' => htmlspecialchars($this->input->post('nama')),
                        't_lahir' => htmlspecialchars($this->input->post('t_lahir')),
                        'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir')),
                        'nohp' => htmlspecialchars($this->input->post('nohp')),
                        'asal' => htmlspecialchars($this->input->post('asal')),
                        'alamat' => htmlspecialchars($this->input->post('alamat')),
                        'pendidikan_terakhir' => $this->input->post('pend_terakhir'),
                        'tamatan' => htmlspecialchars($this->input->post('tamatan')),
                        'keahlian' => htmlspecialchars($this->input->post('keahlian')),
                        'foto' => $fotoku
                    ];
                    $this->model_admin->update_data('pegawai', $data, 'fk_user', $id_user);
                    $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Profile Anda Berhasil Diubah!</div></h4>');
                } else {
                    $error = $this->upload->display_errors();
                    // menampilkan pesan error
                    $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i>' . $error . '!</div></h4>');
                }
            } else {
                $data = [
                    'nama_pegawai' => htmlspecialchars($this->input->post('nama')),
                    't_lahir' => htmlspecialchars($this->input->post('t_lahir')),
                    'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir')),
                    'nohp' => htmlspecialchars($this->input->post('nohp')),
                    'asal' => htmlspecialchars($this->input->post('asal')),
                    'alamat' => htmlspecialchars($this->input->post('alamat')),
                    'pendidikan_terakhir' => $this->input->post('pend_terakhir'),
                    'tamatan' => htmlspecialchars($this->input->post('tamatan')),
                    'keahlian' => htmlspecialchars($this->input->post('keahlian')),
                ];
                $this->model_admin->update_data('pegawai', $data, 'fk_user', $id_user);
                $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Profile Anda Berhasil Diubah!</div></h4>');
            }
            redirect('admin/profile');
        }
    }
    public function data_jadwal()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['data_jam'] = $this->model_admin->getJamDatangPulang()->result();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("admin/data_jadwal", $data);
        $this->load->view("templates/footer");
    }
    public function data_kehadiran()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['kehadiran_hi'] = $this->model_admin->getKehadiranHI()->result();
        $data['seluruh_kehadiran'] = $this->model_admin->getSeluruhKehadiran()->result();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("admin/data_kehadiran", $data);
        $this->load->view("templates/footer");
    }
    public function pengaturan()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['jml_jsj_hi'] = $this->model_admin->getSJurnal()->num_rows();
        $data['jml_qrcode'] = $this->model_admin->jml_qrcode()->num_rows();
        $data['sdk'] = $this->model_admin->jumlahSeluruhKehadiran()->num_rows();
        $data['sp'] = $this->model_admin->getJumlahPengumuman()->num_rows();
        $data['lvl'] = $this->session->userdata('lvl');
        $data['setting'] = $this->model_admin->jurnal_kejujuran(1)->row_array();
        $this->load->view("templates/header", $data);
        $this->load->view("admin/pengaturan", $data);
        $this->load->view("templates/footer");
    }
    public function hapus_seluruh_pengumuman()
    {
        $this->model_admin->hapus_seluruh_pengumuman();
        $this->session->set_flashdata('message1', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Seluruh Data Pengumuman Berhasil Dihapus!</div></h4>');
        redirect("admin/pengaturan");
    }
    public function hapus_seluruh_kehadiran()
    {
        $data = array(
            'ket_ahi' => 0,
            'tanggal_ahi' => date('Y-m-d'),
            'jam_datang_ahi' => null,
            'terlambat_ahi' => 0,
            'ket_datang_ahi' => null,
            'jam_pulang_ahi' => null,
            'ket_pulang_ahi' => null
        );
        $this->model_admin->update_semuadata('absen_hariini', $data);

        $data2 = array(
            'ket_ahi_jurnal' => 0,
            'tanggal_jhi' => date('Y-m-d'),
            'kegiatan_keluar_jhi' => '',
            'acc_jurnal_jhi' => 0,
        );
        $this->model_admin->update_semuadata('jurnal_hariini', $data2);
        $this->model_admin->hapus_seluruh_kehadiran();
        $this->session->set_flashdata('message2', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Seluruh Data Kehadiran Berhasil Dihapus!</div></h4>');
        redirect("admin/pengaturan");
    }
    public function hapus_seluruh_jurnal()
    {
        $this->model_admin->hapus_seluruh_jurnal();
        $this->session->set_flashdata('message3', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i>Seluruh Data Jurnal Berhasil Dihapus!</div></h4>');
        redirect("admin/pengaturan");
    }
    public function rekap_data()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['lvl'] = $this->session->userdata('lvl');
        $data['rekapdata_kehadiran'] = $this->model_admin->getRekapKehadiranBulanIni()->result();
        $data['rekapdata_kehadirans'] = $this->model_admin->getRekapKehadiranS()->result();
        $this->load->view("templates/header", $data);
        $this->load->view("admin/rekap_data", $data);
        $this->load->view("templates/footer");
    }
    public function hapus_user()
    {
        $id = $this->uri->segment(3);

        $id_user['id_user'] = $id;
        $id_pegawai['fk_user'] = $id;
        $id_absen_hi['fk_user_ahi'] = $id;
        $id_jurnal_hi['fk_user_jhi'] = $id;

        $this->model_admin->hapus_data('users', $id_user);
        $this->model_admin->hapus_data('pegawai', $id_pegawai);
        $this->model_admin->hapus_data('absen_hariini', $id_absen_hi);
        $this->model_admin->hapus_data('jurnal_hariini', $id_jurnal_hi);
        $this->session->set_flashdata('message', '<h4 class=""gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Pegawai Berhasil Dihapus!</div></h4>');
        redirect('admin/data_users');
    }
    public function hapus_jam()
    {
        $id = $this->uri->segment(3);

        $data = array(
            'jam_datang' => null,
            'jam_pulang' => null
        );
        $this->model_admin->update_data('jam_datangpulang', $data, 'id_jam', $id);
        $this->session->set_flashdata('message', '<h4 class=""gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Jam Datang Pulang Berhasil Dihapus!</div></h4>');
        redirect('admin/data_jadwal');
    }
    public function hapus_jabatan()
    {
        $id['id_jabatan'] = $this->uri->segment(3);
        $this->model_admin->hapus_data('jabatan', $id);
        $this->session->set_flashdata('message', '<h4 class=""gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Jam Datang Pulang Berhasil Dihapus!</div></h4>');
        redirect('admin/data_users');
    }
    public function isi_jam()
    {
        $id = $this->input->post("ij_id");
        $jam_datang = htmlspecialchars($this->input->post("ij_jamd"));
        $jam_pulang = htmlspecialchars($this->input->post("ij_jamp"));
        if ($jam_datang == null && $jam_pulang == null) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Jam Datang & Jam Pulang Gagal Di Tambahkan !</div></h4>');
        } else if ($jam_datang == null) {
            $data = array(
                'jam_datang' => null,
                'jam_pulang' => $jam_pulang
            );
            $this->model_admin->update_data('jam_datangpulang', $data, 'id_jam', $id);
            $this->session->set_flashdata('message', '<h4 class=""gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Jam Datang Pulang Berhasil Di Tambahkan!</div></h4>');
        } else if ($jam_pulang == null) {
            $data = array(
                'jam_datang' => $jam_datang,
                'jam_pulang' => null
            );
            $this->model_admin->update_data('jam_datangpulang', $data, 'id_jam', $id);
            $this->session->set_flashdata('message', '<h4 class=""gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Jam Datang Pulang Berhasil Di Tambahkan!</div></h4>');
        } else {
            $data = array(
                'jam_datang' => $jam_datang,
                'jam_pulang' => $jam_pulang
            );
            $this->model_admin->update_data('jam_datangpulang', $data, 'id_jam', $id);
            $this->session->set_flashdata('message', '<h4 class=""gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Jam Datang Pulang Berhasil Di Tambahkan!</div></h4>');
        }
        redirect('admin/data_jadwal');
    }
    public function edit_jam()
    {
        $id = $this->input->post("ej_id");
        $jam_datang = htmlspecialchars($this->input->post("ej_jamd"));
        $jam_pulang = htmlspecialchars($this->input->post("ej_jamp"));
        if ($jam_datang == null && $jam_pulang == null) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Data Jam Datang & Jam Pulang Gagal Di Edit !</div></h4>');
        } else if ($jam_datang == null) {
            $data = array(
                'jam_datang' => null,
                'jam_pulang' => $jam_pulang
            );
            $this->model_admin->update_data('jam_datangpulang', $data, 'id_jam', $id);
            $this->session->set_flashdata('message', '<h4 class=""gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Jam Datang Pulang Berhasil Diubah!</div></h4>');
        } else if ($jam_pulang == null) {
            $data = array(
                'jam_datang' => $jam_datang,
                'jam_pulang' => null
            );
            $this->model_admin->update_data('jam_datangpulang', $data, 'id_jam', $id);
            $this->session->set_flashdata('message', '<h4 class=""gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Jam Datang Pulang Berhasil Diubah!</div></h4>');
        } else {
            $data = array(
                'jam_datang' => $jam_datang,
                'jam_pulang' => $jam_pulang
            );
            $this->model_admin->update_data('jam_datangpulang', $data, 'id_jam', $id);
            $this->session->set_flashdata('message', '<h4 class=""gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Jam Datang Pulang Berhasil Diubah!</div></h4>');
        }
        redirect('admin/data_jadwal');
    }
    public function data_jurnal()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['seluruh_jurnal'] = $this->model_admin->getSeluruhJurnal()->result();
        $data['jurnal_acc'] = $this->model_admin->getJurnalACC()->result();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("admin/data_jurnal", $data);
        $this->load->view("templates/footer");
    }
    public function rekap_kehadirans()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['lvl'] = $this->session->userdata('lvl');

        $id_user = $this->session->userdata('id_user');
        //hadir
        $data['jk1'] = $this->model_admin->getRekap1($id_user, '01', 1)->num_rows();
        $data['jk2'] = $this->model_admin->getRekap1($id_user, '02', 1)->num_rows();
        $data['jk3'] = $this->model_admin->getRekap1($id_user, '03', 1)->num_rows();
        $data['jk4'] = $this->model_admin->getRekap1($id_user, '04', 1)->num_rows();
        $data['jk5'] = $this->model_admin->getRekap1($id_user, '05', 1)->num_rows();
        $data['jk6'] = $this->model_admin->getRekap1($id_user, '06', 1)->num_rows();
        $data['jk7'] = $this->model_admin->getRekap1($id_user, '07', 1)->num_rows();
        $data['jk8'] = $this->model_admin->getRekap1($id_user, '08', 1)->num_rows();
        $data['jk9'] = $this->model_admin->getRekap1($id_user, '09', 1)->num_rows();
        $data['jk10'] = $this->model_admin->getRekap1($id_user, '10', 1)->num_rows();
        $data['jk11'] = $this->model_admin->getRekap1($id_user, '11', 1)->num_rows();
        $data['jk12'] = $this->model_admin->getRekap1($id_user, '12', 1)->num_rows();
        //cuti
        $data['jc1'] = $this->model_admin->getRekap1($id_user, '01', 2)->num_rows();
        $data['jc2'] = $this->model_admin->getRekap1($id_user, '02', 2)->num_rows();
        $data['jc3'] = $this->model_admin->getRekap1($id_user, '03', 2)->num_rows();
        $data['jc4'] = $this->model_admin->getRekap1($id_user, '04', 2)->num_rows();
        $data['jc5'] = $this->model_admin->getRekap1($id_user, '05', 2)->num_rows();
        $data['jc6'] = $this->model_admin->getRekap1($id_user, '06', 2)->num_rows();
        $data['jc7'] = $this->model_admin->getRekap1($id_user, '07', 2)->num_rows();
        $data['jc8'] = $this->model_admin->getRekap1($id_user, '08', 2)->num_rows();
        $data['jc9'] = $this->model_admin->getRekap1($id_user, '09', 2)->num_rows();
        $data['jc10'] = $this->model_admin->getRekap1($id_user, '10', 2)->num_rows();
        $data['jc11'] = $this->model_admin->getRekap1($id_user, '11', 2)->num_rows();
        $data['jc12'] = $this->model_admin->getRekap1($id_user, '12', 2)->num_rows();
        //sakit
        $data['js1'] = $this->model_admin->getRekap1($id_user, '01', 3)->num_rows();
        $data['js2'] = $this->model_admin->getRekap1($id_user, '02', 3)->num_rows();
        $data['js3'] = $this->model_admin->getRekap1($id_user, '03', 3)->num_rows();
        $data['js4'] = $this->model_admin->getRekap1($id_user, '04', 3)->num_rows();
        $data['js5'] = $this->model_admin->getRekap1($id_user, '05', 3)->num_rows();
        $data['js6'] = $this->model_admin->getRekap1($id_user, '06', 3)->num_rows();
        $data['js7'] = $this->model_admin->getRekap1($id_user, '07', 3)->num_rows();
        $data['js8'] = $this->model_admin->getRekap1($id_user, '08', 3)->num_rows();
        $data['js9'] = $this->model_admin->getRekap1($id_user, '09', 3)->num_rows();
        $data['js10'] = $this->model_admin->getRekap1($id_user, '10', 3)->num_rows();
        $data['js11'] = $this->model_admin->getRekap1($id_user, '11', 3)->num_rows();
        $data['js12'] = $this->model_admin->getRekap1($id_user, '12', 3)->num_rows();
        //tanpa ket
        $data['jtk1'] = $this->model_admin->getRekap1($id_user, '01', 4)->num_rows();
        $data['jtk2'] = $this->model_admin->getRekap1($id_user, '02', 4)->num_rows();
        $data['jtk3'] = $this->model_admin->getRekap1($id_user, '03', 4)->num_rows();
        $data['jtk4'] = $this->model_admin->getRekap1($id_user, '04', 4)->num_rows();
        $data['jtk5'] = $this->model_admin->getRekap1($id_user, '05', 4)->num_rows();
        $data['jtk6'] = $this->model_admin->getRekap1($id_user, '06', 4)->num_rows();
        $data['jtk7'] = $this->model_admin->getRekap1($id_user, '07', 4)->num_rows();
        $data['jtk8'] = $this->model_admin->getRekap1($id_user, '08', 4)->num_rows();
        $data['jtk9'] = $this->model_admin->getRekap1($id_user, '09', 4)->num_rows();
        $data['jtk10'] = $this->model_admin->getRekap1($id_user, '10', 4)->num_rows();
        $data['jtk11'] = $this->model_admin->getRekap1($id_user, '11', 4)->num_rows();
        $data['jtk12'] = $this->model_admin->getRekap1($id_user, '12', 4)->num_rows();
        //terlambat
        $data['jt1'] = $this->model_admin->getRekapT1($id_user, '01')->num_rows();
        $data['jt2'] = $this->model_admin->getRekapT1($id_user, '02')->num_rows();
        $data['jt3'] = $this->model_admin->getRekapT1($id_user, '03')->num_rows();
        $data['jt4'] = $this->model_admin->getRekapT1($id_user, '04')->num_rows();
        $data['jt5'] = $this->model_admin->getRekapT1($id_user, '05')->num_rows();
        $data['jt6'] = $this->model_admin->getRekapT1($id_user, '06')->num_rows();
        $data['jt7'] = $this->model_admin->getRekapT1($id_user, '07')->num_rows();
        $data['jt8'] = $this->model_admin->getRekapT1($id_user, '08')->num_rows();
        $data['jt9'] = $this->model_admin->getRekapT1($id_user, '09')->num_rows();
        $data['jt10'] = $this->model_admin->getRekapT1($id_user, '10')->num_rows();
        $data['jt11'] = $this->model_admin->getRekapT1($id_user, '11')->num_rows();
        $data['jt12'] = $this->model_admin->getRekapT1($id_user, '12')->num_rows();
        //MENIT terlambat
        $data['jmt1'] = $this->model_admin->getRekapMT1($id_user, '01')->row_array();
        $data['jmt2'] = $this->model_admin->getRekapMT1($id_user, '02')->row_array();
        $data['jmt3'] = $this->model_admin->getRekapMT1($id_user, '03')->row_array();
        $data['jmt4'] = $this->model_admin->getRekapMT1($id_user, '04')->row_array();
        $data['jmt5'] = $this->model_admin->getRekapMT1($id_user, '05')->row_array();
        $data['jmt6'] = $this->model_admin->getRekapMT1($id_user, '06')->row_array();
        $data['jmt7'] = $this->model_admin->getRekapMT1($id_user, '07')->row_array();
        $data['jmt8'] = $this->model_admin->getRekapMT1($id_user, '08')->row_array();
        $data['jmt9'] = $this->model_admin->getRekapMT1($id_user, '09')->row_array();
        $data['jmt10'] = $this->model_admin->getRekapMT1($id_user, '10')->row_array();
        $data['jmt11'] = $this->model_admin->getRekapMT1($id_user, '11')->row_array();
        $data['jmt12'] = $this->model_admin->getRekapMT1($id_user, '12')->row_array();

        $data['seluruh_kehadiran'] = $this->model_admin->getSeluruhKehadiranSaya($id_user)->result();

        $this->load->view("templates/header", $data);
        $this->load->view("admin/rekap_kehadirans", $data);
        $this->load->view("templates/footer");
    }
    public function rekap_jurnals()
    {
        $id_user = $this->session->userdata('id_user');
        $data['total_lamakeluar'] = $this->model_admin->getRekapMJ($id_user, date('m'))->row_array();
        $data['jurnalku'] = $this->model_admin->getJurnalKu($id_user)->result();
        $data['total_lamakeluarsemua'] = $this->model_admin->getRekapMJS($id_user)->row_array();
        $data['seluruh_jurnalku'] = $this->model_admin->getSJurnalKu($id_user)->result();
        $data['profile'] = $this->model_admin->getProfileSaya($id_user)->row_array();
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['setting'] = $this->model_admin->jurnal_kejujuran(1)->row_array();
        $data['foto'] = $this->session->userdata('foto');
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("admin/rekap_jurnals", $data);
        $this->load->view("templates/footer");
    }
    public function aktifkan()
    {
        $data['status'] = 1;
        $this->model_admin->update_data('pengaturan', $data, 'id_pengaturan', 1);
        $this->session->set_flashdata('message', '<h4 class=""gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Sistem Kejujuran Berhasil di Aktikan!</div></h4>');
        redirect("admin/pengaturan");
    }
    public function matikan()
    {
        $data['status'] = 0;
        $this->model_admin->update_data('pengaturan', $data, 'id_pengaturan', 1);
        $this->session->set_flashdata('message', '<h4 class=""gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Sistem Kejujuran Berhasil di Matikan!</div></h4>');
        redirect("admin/pengaturan");
    }
    public function mulai_jurnal_modal()
    {
        $id = $this->session->userdata('id_user');
        $ket_keluar = $this->input->post('ij_ket');
        if (empty($ket_keluar) || is_null($ket_keluar)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Keterangan Keluar Wajib di Isi !</div></h4>');
            redirect("admin/rekap_jurnals");
        } else {
            $setting = $this->model_admin->jurnal_kejujuran(1)->row_array();
            if ($setting['status'] == 1) {
                $data = array(
                    'tanggal_jhi' => date('Y-m-d'),
                    'kegiatan_keluar_jhi' => htmlspecialchars($this->input->post('ij_ket')),
                    'mulai_pukul_jhi' => date('H:i:s'),
                    'acc_jurnal_jhi' => 2
                );
                $data_jurnal = array(
                    'fk_user_jurnal' => $id,
                    'tanggal_jurnal' => date('Y-m-d'),
                    'kegiatan_keluar' => htmlspecialchars($this->input->post('ij_ket')),
                    'mulai_pukul' => date('H:i:s'),
                    'acc_jurnal' => 2
                );
                $this->model_admin->add_data('jurnal', $data_jurnal);
                $this->model_admin->update_data('jurnal_hariini', $data, 'fk_user_jhi', $id);
            } elseif ($setting['status'] == 0) {
                $data = array(
                    'tanggal_jhi' => date('Y-m-d'),
                    'kegiatan_keluar_jhi' => htmlspecialchars($this->input->post('ij_ket')),
                    'acc_jurnal_jhi' => 3
                );
                $data_jurnal = array(
                    'fk_user_jurnal' => $id,
                    'tanggal_jurnal' => date('Y-m-d'),
                    'kegiatan_keluar' => htmlspecialchars($this->input->post('ij_ket')),
                    'acc_jurnal' => 0
                );
                $this->model_admin->add_data('jurnal', $data_jurnal);
                $this->model_admin->update_data('jurnal_hariini', $data, 'fk_user_jhi', $id);
            }
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Jurnal Berhasil di Isi!</div></h4>');
            redirect("admin/rekap_jurnals");
        }
    }
    public function selesai_jurnal_modal()
    {
        $id = $this->input->post('ij_id1');
        $fk = $this->session->userdata('id_user');
        $mulai = $this->model_admin->getMulaiPukul($id)->row_array();

        $awal = strtotime($mulai['mulai_pukul']);
        $akhir = strtotime(date('H:i:s'));
        $diff = $akhir - $awal;
        $hasil_menit = floor($diff / 60);
        $ket_keluar = $this->input->post('ij_ket1');
        if (empty($ket_keluar) || is_null($ket_keluar)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Keterangan Keluar Wajib di Isi !</div></h4>');
            redirect("admin/rekap_jurnals");
        } else {
            $setting = $this->model_admin->jurnal_kejujuran(1)->row_array();

            if ($setting['status'] == 1) {
                $data = array(
                    'sampai_pukul_jhi' => date('H:i:s'),
                    'acc_jurnal_jhi' => 1
                );
                $data_jurnal = array(
                    'fk_user_jurnal' => $fk,
                    'sampai_pukul' => date('H:i:s'),
                    'acc_jurnal' => 1,
                    'lama_keluar' => $hasil_menit
                );
                $this->model_admin->update_data('jurnal', $data_jurnal, 'id_jurnal', $id);
                $this->model_admin->update_data('jurnal_hariini', $data, 'fk_user_jhi', $fk);
                $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Anda Telah Kembali Ke Pondok!</div></h4>');
            }
            redirect("admin/rekap_jurnals");
        }
    }
    public function edit_password()
    {
        $id = $this->input->post('ep_id');
        $password1 = $this->input->post('ep_password');
        $password2 = $this->input->post('ep_ulangipassword');

        if ($password1 != $password2) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Password Gagal Diubah, Password Wajib Sama !</div></h4>');
            redirect("admin/data_users");
        } elseif (empty($password1) || is_null($password1) || empty($password2) || is_null($password2)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Password Gagal Diubah, Password Wajib Diisi    !</div></h4>');
            redirect("admin/data_users");
        } else {
            $data = array(
                'password' => password_hash(
                    $password1,
                    PASSWORD_DEFAULT
                ),
            );
            $this->model_admin->update_data('users', $data, 'id_user', $id);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Password Berhasil Diubah!</div></h4>');
            redirect("admin/data_users");
        }
    }
    public function edit_passwordku()
    {
        $id = $this->session->userdata('id_user');
        $password1 = $this->input->post('ep_password');
        $password2 = $this->input->post('ep_ulangipassword');

        if ($password1 != $password2) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Password Gagal Diubah, Password Wajib Sama !</div></h4>');
            redirect("admin/profile");
        } elseif (empty($password1) || is_null($password1) || empty($password2) || is_null($password2)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Password Gagal Diubah, Password Wajib Diisi    !</div></h4>');
            redirect("admin/profile");
        } else {
            $data = array(
                'password' => password_hash(
                    $password1,
                    PASSWORD_DEFAULT
                ),
            );
            $this->model_admin->update_data('users', $data, 'id_user', $id);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Password Berhasil Diubah!</div></h4>');
            redirect("admin/profile");
        }
    }
    public function pdf_rekapjurnalku()
    {
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->model_admin->getProfileSaya($id_user)->row_array();
        $data['total_lamakeluar'] = $this->model_admin->getRekapMJ($id_user, date('m'))->row_array();
        $data['pengawas_yayasan'] = $this->model_admin->getPengawasYayasan("Pengawas Yayasan")->row_array();
        $data['jurnalku'] = $this->model_admin->getJurnalKu($id_user)->result();

        $this->load->view('admin/tcpdf_jurnalku', $data);
    }
    public function pdf_rekap_data()
    {
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->model_admin->getProfileSaya($id_user)->row_array();
        $data['total_lamakeluar'] = $this->model_admin->getRekapMJ($id_user, date('m'))->row_array();
        $data['mudir'] = $this->model_admin->getMudir("Pimpinan Pesantren")->row_array();
        $data['jurnalku'] = $this->model_admin->getJurnalKu($id_user)->result();

        $data['rekapdata_kehadiran'] = $this->model_admin->getRekapKehadiranBulanIni()->result();
        $this->load->view('admin/tcpdf_rekap_data', $data);
    }
    public function scann_qrcode()
    {
        $id_user = $this->session->userdata('id_user');
        $data['ahi'] = $this->model_admin->getAHI($id_user)->row_array();
        $data['kehadiran_hi'] = $this->model_admin->getKehadiranHI()->result();
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');

        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("admin/scann_qrcode", $data);
        $this->load->view("templates/footer");
    }
    public function scan()
    {
        $data = $_GET['data'];
        $array = explode(" ", $data);

        $id_user = $this->session->userdata('id_user');
        $ahi = $this->model_admin->getAHI($id_user)->row_array();
        $daftar_hari = array(
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        );
        $date = date('Y-m-d');
        $namahari = date('l', strtotime($date));
        $hari = $this->model_admin->getHariIni($daftar_hari[$namahari])->row_array();
        // echo $daftar_hari[$namahari];
        // echo "<br>";
        $jadwal_jd = strtotime($hari['jam_datang']);
        $jd = strtotime(date('H:i:s'));
        $diff = $jd - $jadwal_jd;

        $hasil_menit = floor($diff / 60);
        if ($hasil_menit <= 0) {
            $hasil_menit = 0;
        }

        if (password_verify(date('d'), $array[0])) {
            if ($array[1] == date('Y-m-d')) {
                if ($ahi['tanggal'] != date('Y-m-d')) {
                    $data_h = array(
                        'fk_user_kehadiran' => $id_user,
                        'ket_absen' => 1,
                        'tanggal' => date('Y-m-d'),
                        'jam_datang' => date('H:i:s'),
                        'terlambat' => $hasil_menit,
                        'jam_pulang' => $hari['jam_pulang']
                    );
                    $data_a = array(
                        'fk_user_ahi' => $id_user,
                        'ket_ahi' => 1,
                        'tanggal_ahi' => date('Y-m-d'),
                        'jam_datang_ahi' => date('H:i:s'),
                        'terlambat_ahi' => $hasil_menit,
                        'jam_pulang_ahi' => $hari['jam_pulang']
                    );
                    $data_j = array(
                        'ket_ahi_jurnal' => 1
                    );
                    $this->model_admin->update_data('jurnal_hariini', $data_j, 'fk_user_jhi', $id_user);
                    $this->model_admin->add_data('kehadiran', $data_h);
                    $id__ = $this->db->insert_id();
                    $this->model_admin->update_data('absen_hariini', $data_a, 'fk_user_ahi', $id_user);
                    $data_k = array(
                        'fk_kehadiran' => $id__
                    );
                    $this->model_admin->update_data('absen_hariini', $data_k, 'fk_user_ahi', $id_user);
                }
                redirect("admin/scann_qrcode");
            } else {
                echo "<script>
                alert('qr code kadaluarsa');
                </script>";
            }
        } else {
            echo "<script>
            alert('qr code salah');
            </script>";
        }
    }
    public function hapus_seluruh_qrcode()
    {
        $this->model_admin->hapus_seluruh_qrcode();
        $this->session->set_flashdata('message_qrcode', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Seluruh Data QR-Code Berhasil Dihapus!</div></h4>');
        redirect("admin/pengaturan");
    }
    public function kartuqrcode()
    {
        $id_user = $this->session->userdata('id_user');
        $params['data'] = $id_user;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . "assets/img/qrcode/" . $id_user . ".png";

        $this->ciqrcode->generate($params);
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['lvl'] = $this->session->userdata('lvl');
        $data['sp'] = $this->model_admin->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_admin->getJumlahPengumumanHI()->num_rows();
        $data['id'] = $id_user;
        $data['profile'] = $this->model_admin->getProfileSaya($id_user)->row_array();
        $this->load->view("templates/header", $data);
        $this->load->view("admin/kartu_qrcode", $data);
        $this->load->view("templates/footer");
    }
    public function pdf_kartu()
    {
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->model_admin->getProfileSaya($id_user)->row_array();

        $this->load->view('admin/tcpdf_kartu', $data);
    }
}
