<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userbiasa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("model_userbiasa");
        $this->load->model("model_login");
        $this->load->helper('cookie');
        $this->load->library('pdfku');
        $this->load->library('ciqrcode');

        if ($this->model_userbiasa->isNotLogin()) {
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
        $bulan = date('m');
        $tahun = date('Y');
        $id_user = $this->session->userdata('id_user');

        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['lvl'] = $this->session->userdata('lvl');
        $data['pengumuman'] = $this->model_userbiasa->getPengumuman()->result();

        $data['sp'] = $this->model_userbiasa->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_userbiasa->getJumlahPengumumanHI()->num_rows();

        $data['jml_kehadiran'] = $this->model_userbiasa->getJumlahKehadiran($id_user, $bulan, $tahun)->num_rows();
        $data['jml_sakit'] = $this->model_userbiasa->getJumlahSakit($id_user, $bulan, $tahun)->num_rows();
        $data['jml_cuti'] = $this->model_userbiasa->getJumlahCuti($id_user, $bulan, $tahun)->num_rows();
        $data['jml_tanpaket'] = $this->model_userbiasa->getJumlahTanpaKet($id_user, $bulan, $tahun)->num_rows();
        $data['jml_jurnal'] = $this->model_userbiasa->getJumlahJurnal($id_user, $bulan, $tahun)->num_rows();
        $data['jml_terlambat'] = $this->model_userbiasa->getJumlahTerlambat($id_user, $bulan, $tahun)->num_rows();
        $data['jml_menitterlambat'] = $this->model_userbiasa->getJumlahMenitTerlambat($id_user, $bulan, $tahun)->row_array();
        $data['jml_menitkeluar'] = $this->model_userbiasa->getJumlahMenitKeluar($id_user, $bulan, $tahun)->row_array();


        $data['ahi'] = $this->model_userbiasa->getAHI($id_user)->row_array();
        $this->load->view("templates/header", $data);
        $this->load->view("userbiasa/index", $data);
        $this->load->view("templates/footer");
    }
    public function jadwaldp()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['data_jam'] = $this->model_userbiasa->getJamDatangPulang()->result();
        $data['sp'] = $this->model_userbiasa->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_userbiasa->getJumlahPengumumanHI()->num_rows();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("userbiasa/jadwaldp", $data);
        $this->load->view("templates/footer");
    }
    public function profile()
    {
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->model_userbiasa->getProfileSaya($id_user)->row_array();
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['phi'] = $this->model_userbiasa->getJumlahPengumumanHI()->num_rows();
        $data['sp'] = $this->model_userbiasa->getJumlahPengumuman()->num_rows();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("userbiasa/profile", $data);
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
            $data['profile'] = $this->model_userbiasa->getProfileSaya($id_user)->row_array();
            $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
            $data['foto'] = $this->session->userdata('foto');
            $data['phi'] = $this->model_userbiasa->getJumlahPengumumanHI()->num_rows();
            $data['sp'] = $this->model_userbiasa->getJumlahPengumuman()->num_rows();
            $data['lvl'] = $this->session->userdata('lvl');
            $this->load->view("templates/header", $data);
            $this->load->view("userbiasa/profile", $data);
            $this->load->view("templates/footer");
        } else {
            $id_user = $this->session->userdata('id_user');
            $data_user = [
                'username' => htmlspecialchars($this->input->post('username')),
            ];
            $this->model_userbiasa->update_data('users', $data_user, 'id_user', $id_user);
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
                    $this->model_userbiasa->update_data('pegawai', $data, 'fk_user', $id_user);
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
                $this->model_userbiasa->update_data('pegawai', $data, 'fk_user', $id_user);
                $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Profile Anda Berhasil Diubah!</div></h4>');
            }
            redirect('userbiasa/profile');
        }
    }
    public function kehadiran_hi()
    {
        $data['kehadiran_hi'] = $this->model_userbiasa->getKehadiranHI()->result();
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['phi'] = $this->model_userbiasa->getJumlahPengumumanHI()->num_rows();
        $data['sp'] = $this->model_userbiasa->getJumlahPengumuman()->num_rows();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("userbiasa/kehadiran_hi", $data);
        $this->load->view("templates/footer");
    }
    public function scann_qrcode()
    {
        $id_user = $this->session->userdata('id_user');
        $data['ahi'] = $this->model_userbiasa->getAHI($id_user)->row_array();
        $data['kehadiran_hi'] = $this->model_userbiasa->getKehadiranHI()->result();
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['phi'] = $this->model_userbiasa->getJumlahPengumumanHI()->num_rows();
        $data['sp'] = $this->model_userbiasa->getJumlahPengumuman()->num_rows();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("userbiasa/scann_qrcode", $data);
        $this->load->view("templates/footer");
    }
    public function rekap_kehadiran()
    {
        $data['kehadiran_hi'] = $this->model_userbiasa->getKehadiranHI()->result();
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['phi'] = $this->model_userbiasa->getJumlahPengumumanHI()->num_rows();
        $data['sp'] = $this->model_userbiasa->getJumlahPengumuman()->num_rows();
        $data['lvl'] = $this->session->userdata('lvl');

        $id_user = $this->session->userdata('id_user');
        //hadir
        $data['jk1'] = $this->model_userbiasa->getRekap1($id_user, '01', 1)->num_rows();
        $data['jk2'] = $this->model_userbiasa->getRekap1($id_user, '02', 1)->num_rows();
        $data['jk3'] = $this->model_userbiasa->getRekap1($id_user, '03', 1)->num_rows();
        $data['jk4'] = $this->model_userbiasa->getRekap1($id_user, '04', 1)->num_rows();
        $data['jk5'] = $this->model_userbiasa->getRekap1($id_user, '05', 1)->num_rows();
        $data['jk6'] = $this->model_userbiasa->getRekap1($id_user, '06', 1)->num_rows();
        $data['jk7'] = $this->model_userbiasa->getRekap1($id_user, '07', 1)->num_rows();
        $data['jk8'] = $this->model_userbiasa->getRekap1($id_user, '08', 1)->num_rows();
        $data['jk9'] = $this->model_userbiasa->getRekap1($id_user, '09', 1)->num_rows();
        $data['jk10'] = $this->model_userbiasa->getRekap1($id_user, '10', 1)->num_rows();
        $data['jk11'] = $this->model_userbiasa->getRekap1($id_user, '11', 1)->num_rows();
        $data['jk12'] = $this->model_userbiasa->getRekap1($id_user, '12', 1)->num_rows();
        //cuti
        $data['jc1'] = $this->model_userbiasa->getRekap1($id_user, '01', 2)->num_rows();
        $data['jc2'] = $this->model_userbiasa->getRekap1($id_user, '02', 2)->num_rows();
        $data['jc3'] = $this->model_userbiasa->getRekap1($id_user, '03', 2)->num_rows();
        $data['jc4'] = $this->model_userbiasa->getRekap1($id_user, '04', 2)->num_rows();
        $data['jc5'] = $this->model_userbiasa->getRekap1($id_user, '05', 2)->num_rows();
        $data['jc6'] = $this->model_userbiasa->getRekap1($id_user, '06', 2)->num_rows();
        $data['jc7'] = $this->model_userbiasa->getRekap1($id_user, '07', 2)->num_rows();
        $data['jc8'] = $this->model_userbiasa->getRekap1($id_user, '08', 2)->num_rows();
        $data['jc9'] = $this->model_userbiasa->getRekap1($id_user, '09', 2)->num_rows();
        $data['jc10'] = $this->model_userbiasa->getRekap1($id_user, '10', 2)->num_rows();
        $data['jc11'] = $this->model_userbiasa->getRekap1($id_user, '11', 2)->num_rows();
        $data['jc12'] = $this->model_userbiasa->getRekap1($id_user, '12', 2)->num_rows();
        //sakit
        $data['js1'] = $this->model_userbiasa->getRekap1($id_user, '01', 3)->num_rows();
        $data['js2'] = $this->model_userbiasa->getRekap1($id_user, '02', 3)->num_rows();
        $data['js3'] = $this->model_userbiasa->getRekap1($id_user, '03', 3)->num_rows();
        $data['js4'] = $this->model_userbiasa->getRekap1($id_user, '04', 3)->num_rows();
        $data['js5'] = $this->model_userbiasa->getRekap1($id_user, '05', 3)->num_rows();
        $data['js6'] = $this->model_userbiasa->getRekap1($id_user, '06', 3)->num_rows();
        $data['js7'] = $this->model_userbiasa->getRekap1($id_user, '07', 3)->num_rows();
        $data['js8'] = $this->model_userbiasa->getRekap1($id_user, '08', 3)->num_rows();
        $data['js9'] = $this->model_userbiasa->getRekap1($id_user, '09', 3)->num_rows();
        $data['js10'] = $this->model_userbiasa->getRekap1($id_user, '10', 3)->num_rows();
        $data['js11'] = $this->model_userbiasa->getRekap1($id_user, '11', 3)->num_rows();
        $data['js12'] = $this->model_userbiasa->getRekap1($id_user, '12', 3)->num_rows();
        //tanpa ket
        $data['jtk1'] = $this->model_userbiasa->getRekap1($id_user, '01', 4)->num_rows();
        $data['jtk2'] = $this->model_userbiasa->getRekap1($id_user, '02', 4)->num_rows();
        $data['jtk3'] = $this->model_userbiasa->getRekap1($id_user, '03', 4)->num_rows();
        $data['jtk4'] = $this->model_userbiasa->getRekap1($id_user, '04', 4)->num_rows();
        $data['jtk5'] = $this->model_userbiasa->getRekap1($id_user, '05', 4)->num_rows();
        $data['jtk6'] = $this->model_userbiasa->getRekap1($id_user, '06', 4)->num_rows();
        $data['jtk7'] = $this->model_userbiasa->getRekap1($id_user, '07', 4)->num_rows();
        $data['jtk8'] = $this->model_userbiasa->getRekap1($id_user, '08', 4)->num_rows();
        $data['jtk9'] = $this->model_userbiasa->getRekap1($id_user, '09', 4)->num_rows();
        $data['jtk10'] = $this->model_userbiasa->getRekap1($id_user, '10', 4)->num_rows();
        $data['jtk11'] = $this->model_userbiasa->getRekap1($id_user, '11', 4)->num_rows();
        $data['jtk12'] = $this->model_userbiasa->getRekap1($id_user, '12', 4)->num_rows();
        //terlambat
        $data['jt1'] = $this->model_userbiasa->getRekapT1($id_user, '01')->num_rows();
        $data['jt2'] = $this->model_userbiasa->getRekapT1($id_user, '02')->num_rows();
        $data['jt3'] = $this->model_userbiasa->getRekapT1($id_user, '03')->num_rows();
        $data['jt4'] = $this->model_userbiasa->getRekapT1($id_user, '04')->num_rows();
        $data['jt5'] = $this->model_userbiasa->getRekapT1($id_user, '05')->num_rows();
        $data['jt6'] = $this->model_userbiasa->getRekapT1($id_user, '06')->num_rows();
        $data['jt7'] = $this->model_userbiasa->getRekapT1($id_user, '07')->num_rows();
        $data['jt8'] = $this->model_userbiasa->getRekapT1($id_user, '08')->num_rows();
        $data['jt9'] = $this->model_userbiasa->getRekapT1($id_user, '09')->num_rows();
        $data['jt10'] = $this->model_userbiasa->getRekapT1($id_user, '10')->num_rows();
        $data['jt11'] = $this->model_userbiasa->getRekapT1($id_user, '11')->num_rows();
        $data['jt12'] = $this->model_userbiasa->getRekapT1($id_user, '12')->num_rows();
        //MENIT terlambat
        $data['jmt1'] = $this->model_userbiasa->getRekapMT1($id_user, '01')->row_array();
        $data['jmt2'] = $this->model_userbiasa->getRekapMT1($id_user, '02')->row_array();
        $data['jmt3'] = $this->model_userbiasa->getRekapMT1($id_user, '03')->row_array();
        $data['jmt4'] = $this->model_userbiasa->getRekapMT1($id_user, '04')->row_array();
        $data['jmt5'] = $this->model_userbiasa->getRekapMT1($id_user, '05')->row_array();
        $data['jmt6'] = $this->model_userbiasa->getRekapMT1($id_user, '06')->row_array();
        $data['jmt7'] = $this->model_userbiasa->getRekapMT1($id_user, '07')->row_array();
        $data['jmt8'] = $this->model_userbiasa->getRekapMT1($id_user, '08')->row_array();
        $data['jmt9'] = $this->model_userbiasa->getRekapMT1($id_user, '09')->row_array();
        $data['jmt10'] = $this->model_userbiasa->getRekapMT1($id_user, '10')->row_array();
        $data['jmt11'] = $this->model_userbiasa->getRekapMT1($id_user, '11')->row_array();
        $data['jmt12'] = $this->model_userbiasa->getRekapMT1($id_user, '12')->row_array();

        $data['seluruh_kehadiran'] = $this->model_userbiasa->getSeluruhKehadiran($id_user)->result();

        $this->load->view("templates/header", $data);
        $this->load->view("userbiasa/rekap_kehadiran", $data);
        $this->load->view("templates/footer");
    }
    public function rekap_jurnal()
    {
        $id_user = $this->session->userdata('id_user');
        $data['total_lamakeluar'] = $this->model_userbiasa->getRekapMJ($id_user, date('m'))->row_array();
        $data['total_lamakeluarsemua'] = $this->model_userbiasa->getRekapMJS($id_user)->row_array();
        $data['profile'] = $this->model_userbiasa->getProfileSaya($id_user)->row_array();
        $data['jurnalku'] = $this->model_userbiasa->getJurnalKu($id_user)->result();
        $data['seluruh_jurnalku'] = $this->model_userbiasa->getSJurnalKu($id_user)->result();
        $data['kehadiran_hi'] = $this->model_userbiasa->getKehadiranHI()->result();
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['phi'] = $this->model_userbiasa->getJumlahPengumumanHI()->num_rows();
        $data['sp'] = $this->model_userbiasa->getJumlahPengumuman()->num_rows();
        $data['setting'] = $this->model_userbiasa->jurnal_kejujuran(1)->row_array();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("userbiasa/rekap_jurnal", $data);
        $this->load->view("templates/footer");
    }
    public function mulai_jurnal_modal()
    {
        $id = $this->session->userdata('id_user');
        $ket_keluar = $this->input->post('ij_ket');
        if (empty($ket_keluar) || is_null($ket_keluar)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Keterangan Keluar Wajib di Isi !</div></h4>');
            redirect("userbiasa/rekap_jurnal");
        } else {
            $setting = $this->model_userbiasa->jurnal_kejujuran(1)->row_array();
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
                $this->model_userbiasa->add_data('jurnal', $data_jurnal);
                $this->model_userbiasa->update_data('jurnal_hariini', $data, 'fk_user_jhi', $id);
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
                $this->model_userbiasa->add_data('jurnal', $data_jurnal);
                $this->model_userbiasa->update_data('jurnal_hariini', $data, 'fk_user_jhi', $id);
            }
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Jurnal Berhasil di Isi!</div></h4>');
            redirect("userbiasa/rekap_jurnal");
        }
    }
    public function selesai_jurnal_modal()
    {
        $id = $this->input->post('ij_id1');
        $fk = $this->session->userdata('id_user');
        $mulai = $this->model_userbiasa->getMulaiPukul($id)->row_array();

        $awal = strtotime($mulai['mulai_pukul']);
        $akhir = strtotime(date('H:i:s'));
        $diff = $akhir - $awal;
        $hasil_menit = floor($diff / 60);
        $ket_keluar = $this->input->post('ij_ket1');
        if (empty($ket_keluar) || is_null($ket_keluar)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Keterangan Keluar Wajib di Isi !</div></h4>');
            redirect("userbiasa/rekap_jurnal");
        } else {
            $setting = $this->model_userbiasa->jurnal_kejujuran(1)->row_array();

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
                $this->model_userbiasa->update_data('jurnal', $data_jurnal, 'id_jurnal', $id);
                $this->model_userbiasa->update_data('jurnal_hariini', $data, 'fk_user_jhi', $fk);
                $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Anda Telah Kembali Ke Pondok!</div></h4>');
            }
            redirect("userbiasa/rekap_jurnal");
        }
    }
    public function edit_passwordku()
    {
        $id = $this->session->userdata('id_user');
        $password1 = $this->input->post('ep_password');
        $password2 = $this->input->post('ep_ulangipassword');

        if ($password1 != $password2) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Password Gagal Diubah, Password Wajib Sama !</div></h4>');
            redirect("userbiasa/profile");
        } elseif (empty($password1) || is_null($password1) || empty($password2) || is_null($password2)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Password Gagal Diubah, Password Wajib Diisi    !</div></h4>');
            redirect("userbiasa/profile");
        } else {
            $data = array(
                'password' => password_hash(
                    $password1,
                    PASSWORD_DEFAULT
                ),
            );
            $this->model_userbiasa->update_data('users', $data, 'id_user', $id);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Password Berhasil Diubah!</div></h4>');
            redirect("userbiasa/profile");
        }
    }
    // public function pdf_rekapjurnalku1()
    // {
    //     $pdf = new FPDF('p', 'mm', 'A4');
    //     // membuat halaman baru
    //     $pdf->AddPage();
    //     // setting jenis font yang akan digunakan
    //     $pdf->SetFont('Arial', 'B', 14);
    //     // mencetak string 
    //     $pdf->Cell(190, 7, "JURNAL PEGAWAI PONDOK PESANTREN SALAFIYAH IBNU MAS'UD KAMPAR", 0, 1, 'C');
    //     $pdf->SetFont('Arial', 'B', 12);
    //     $pdf->Cell(190, 7, 'MULAI PUKUL 07:15 SAMPAI KEGIATAN SHALAT ASHAR', 0, 1, 'C');
    //     // Memberikan space kebawah agar tidak terlalu rapat
    //     $pdf->Cell(10, 7, '', 0, 1, 'C');
    //     $pdf->SetFont('Arial', 'B', 10, 'C');
    //     $pdf->Cell(25, 15, 'TANGGAL', 1, 0, 'C');

    //     $pdf->Cell(30, 15, 'MULAI PUKUL', 1, 0, 'C');
    //     $pdf->Cell(30, 15, 'SAMPAI PUKUL', 1, 0, 'C');
    //     $pdf->Cell(30, 15, 'LAMA KELUAR', 1, 0, 'C');
    //     $pdf->Cell(75, 15, 'KEGIATAN KELUAR', 1, 1, 'C');
    //     $pdf->SetFont('Arial', '', 12);
    //     $id_user = $this->session->userdata('id_user');
    //     $data['profile'] = $this->model_userbiasa->getProfileSaya($id_user)->row_array();
    //     $total_lamakeluar = $this->model_userbiasa->getRekapMJ($id_user, date('m'))->row_array();
    //     $pengawas_yayasan = $this->model_userbiasa->getPengawasYayasan("Pengawas Yayasan")->row_array();
    //     $jurnalku = $this->model_userbiasa->getJurnalKu($id_user)->result();

    //     foreach ($jurnalku as $row) {
    //         $pdf->Cell(25, 6, $row->tanggal_jurnal, 1, 0);
    //         $pdf->Cell(30, 6, $row->mulai_pukul, 1, 0);
    //         $pdf->Cell(30, 6, $row->sampai_pukul, 1, 0);
    //         $pdf->Cell(30, 6, $row->lama_keluar . " Menit", 1, 0);
    //         $pdf->MultiCell(75, 6, $row->kegiatan_keluar, 1, 1);
    //     }
    //     $pdf->SetFont('Arial', 'B', 12);
    //     $pdf->Cell(25, 10, "", 0, 0);
    //     $pdf->Cell(30, 10, "", 0, 0);
    //     $pdf->Cell(30, 10, "", 0, 0);
    //     $pdf->Cell(30, 10,  "", 0, 0);
    //     $pdf->Cell(75, 10, "Total : " . $total_lamakeluar['lama_keluar'] . " Menit", 0, 1);
    //     $pdf->SetFont('Arial', '', 12);
    //     $pdf->Cell(25, 7, "", 0, 1);
    //     $pdf->Cell(25, 4, "", 0, 0);
    //     $pdf->Cell(120, 4, 'Mengetahui :', 0, 0);
    //     $pdf->Cell(30, 4, 'Kampar, ' . date('d-m-Y'), 0, 1);
    //     $pdf->Cell(25, 7, "", 0, 0);
    //     $pdf->Cell(133, 7, "Pengawas Yayasan Nida' As-Sunnah Kampar,", 0, 0);
    //     $pdf->Cell(30, 7, 'Yang Mengisi, ', 0, 1);
    //     $pdf->SetFont('Arial', 'B', 12);
    //     $pdf->Cell(25, 50, "", 0, 0);
    //     $pdf->Cell(125, 50, ucwords($pengawas_yayasan['nama_pegawai']), 0, 0);
    //     $pdf->Cell(30, 50, ucwords($data['profile']['nama_pegawai']), 0, 0);
    //     $pdf->Output();
    // }
    // public function dompdf_rekapjurnalku()
    // {
    //     $id_user = $this->session->userdata('id_user');
    //     $data['profile'] = $this->model_userbiasa->getProfileSaya($id_user)->row_array();
    //     $data['total_lamakeluar'] = $this->model_userbiasa->getRekapMJ($id_user, date('m'))->row_array();
    //     $data['pengawas_yayasan'] = $this->model_userbiasa->getPengawasYayasan("Pengawas Yayasan")->row_array();
    //     $data['jurnalku'] = $this->model_userbiasa->getJurnalKu($id_user)->result();

    //     $this->load->view('pdf/laporan_pdf', $data);

    //     $paper_size = 'A4';
    //     $orientation = 'landscape';
    //     $html = $this->output->get_output();
    //     $this->dompdf->set_paper($paper_size, $orientation);

    //     $this->dompdf->load_html($html);
    //     $this->dompdf->render();
    //     $this->dompdf->stream("laporan_jurnalku.pdf");
    // }
    public function pdf_rekapjurnalku()
    {
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->model_userbiasa->getProfileSaya($id_user)->row_array();
        $data['total_lamakeluar'] = $this->model_userbiasa->getRekapMJ($id_user, date('m'))->row_array();
        $data['pengawas_yayasan'] = $this->model_userbiasa->getPengawasYayasan("Pengawas Yayasan")->row_array();
        $data['jurnalku'] = $this->model_userbiasa->getJurnalKu($id_user)->result();

        $this->load->view('userbiasa/tcpdf_jurnalku', $data);
    }
    public function scan()
    {
        $data = $_GET['data'];
        $array = explode(" ", $data);

        $id_user = $this->session->userdata('id_user');
        $ahi = $this->model_userbiasa->getAHI($id_user)->row_array();
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
        $hari = $this->model_userbiasa->getHariIni($daftar_hari[$namahari])->row_array();
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
                        'absen_qrcode' => 1,
                        'tanggal' => date('Y-m-d'),
                        'jam_datang' => date('H:i:s'),
                        'terlambat' => $hasil_menit,
                        'jam_pulang' => $hari['jam_pulang']
                    );
                    $data_a = array(
                        'fk_user_ahi' => $id_user,
                        'ket_ahi' => 1,
                        'qrcode_ahi' => 1,
                        'tanggal_ahi' => date('Y-m-d'),
                        'jam_datang_ahi' => date('H:i:s'),
                        'terlambat_ahi' => $hasil_menit,
                        'jam_pulang_ahi' => $hari['jam_pulang']
                    );
                    $data_j = array(
                        'ket_ahi_jurnal' => 1
                    );
                    $this->model_userbiasa->update_data('jurnal_hariini', $data_j, 'fk_user_jhi', $id_user);
                    $this->model_userbiasa->add_data('kehadiran', $data_h);
                    $id__ = $this->db->insert_id();
                    $this->model_userbiasa->update_data('absen_hariini', $data_a, 'fk_user_ahi', $id_user);
                    $data_k = array(
                        'fk_kehadiran' => $id__
                    );
                    $this->model_userbiasa->update_data('absen_hariini', $data_k, 'fk_user_ahi', $id_user);
                }
                redirect("userbiasa/scann_qrcode");
            } else {
                $this->session->set_flashdata('message', '<h4><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> QR-Code Tidak Berlaku Lagi!</div></h4>');
                redirect("userbiasa/scann_qrcode");
            }
        } else {
            $this->session->set_flashdata('message', '<h4><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> QR-Code Salah!</div></h4>');
            redirect("userbiasa/scann_qrcode");
        }
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
        $data['sp'] = $this->model_userbiasa->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_userbiasa->getJumlahPengumumanHI()->num_rows();
        $data['id'] = $id_user;
        $data['profile'] = $this->model_userbiasa->getProfileSaya($id_user)->row_array();
        $this->load->view("templates/header", $data);
        $this->load->view("userbiasa/kartu_qrcode", $data);
        $this->load->view("templates/footer");
    }
    public function pdf_kartu()
    {
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->model_userbiasa->getProfileSaya($id_user)->row_array();

        $this->load->view('userbiasa/tcpdf_kartu', $data);
    }
}
