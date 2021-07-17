<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satpam extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("model_satpam");
        $this->load->model("model_login");
        $this->load->helper('cookie');
        $this->load->library('pdfku');
        $this->load->library('ciqrcode');

        if ($this->model_satpam->isNotLogin()) {
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
        $data['jmlbelumacc'] = $this->model_satpam->getJumlahBelumAcc()->num_rows();
        $data['sp'] = $this->model_satpam->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_satpam->getJumlahPengumumanHI()->num_rows();
        $data['jml_jurnal_hi'] = $this->model_satpam->getJurnalHI()->num_rows();
        $data['jml_h_hi'] = $this->model_satpam->getJHadir()->num_rows();
        $data['jml_th_hi'] = $this->model_satpam->getJTHadir()->num_rows();
        $data['jml_ju_hi'] = $this->model_satpam->getJUsers()->num_rows();
        $data['jml_juo_hi'] = $this->model_satpam->getJUsersOnline()->num_rows();
        $data['jml_jsj_hi'] = $this->model_satpam->getSJurnal()->num_rows();
        $data['pengumuman'] = $this->model_satpam->getPengumuman()->result();

        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("satpam/index", $data);
        $this->load->view("templates/footer");
    }
    public function data_kehadiran()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['jmlbelumacc'] = $this->model_satpam->getJumlahBelumAcc()->num_rows();
        $data['sp'] = $this->model_satpam->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_satpam->getJumlahPengumumanHI()->num_rows();

        $data['ket_absensi'] = $this->model_satpam->getKetAbsensi()->result();
        $data['users_ahi'] = $this->model_satpam->getUsers_ahi()->result();
        $data['users_ahi_hadir'] = $this->model_satpam->getUsers_ahi_hadir()->result();
        $data['users_ahi_thadir'] = $this->model_satpam->getUsers_ahi_thadir()->result();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("satpam/data_kehadiran", $data);
        $this->load->view("templates/footer");
    }
    public function isi_kehadiran_modal()
    {
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
        $hari = $this->model_satpam->getHariIni($daftar_hari[$namahari])->row_array();
        // echo $daftar_hari[$namahari];
        // echo "<br>";
        $jam_datang = htmlspecialchars($this->input->post('jd'));
        $jadwal_jd = strtotime($hari['jam_datang']);
        $jd = strtotime($jam_datang);
        $diff = $jd - $jadwal_jd;

        $hasil_menit = floor($diff / 60);
        if ($hasil_menit <= 0) {
            $hasil_menit = 0;
        }
        $absen = $this->input->post('ik_absensi');
        $id = $this->input->post('ik_id');
        if (empty($absen) || is_null($absen)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Keterangan Kehadiran Wajib di Pilih !</div></h4>');
            redirect("satpam/data_kehadiran");
        } else {
            if ($absen > 1) {
                $data = array(
                    'fk_user_kehadiran' => $id,
                    'ket_absen' => $absen,
                    'tanggal' => date('Y-m-d'),
                    'jam_datang' => null,
                    'ket_jd' => htmlspecialchars($this->input->post('ik_ket')),
                );
            } else {
                $data = array(
                    'fk_user_kehadiran' => $id,
                    'ket_absen' => $absen,
                    'tanggal' => date('Y-m-d'),
                    'jam_datang' => $jam_datang,
                    'ket_jd' => htmlspecialchars($this->input->post('ik_ket')),
                    'terlambat' => $hasil_menit,
                    'jam_pulang' => $hari['jam_pulang']
                );
                $data2 = array(
                    'ket_ahi_jurnal' => 1
                );
            }
            if ($absen > 1) {
                $data1 = array(
                    'fk_user_ahi' => $id,
                    'ket_ahi' => $absen,
                    'tanggal_ahi' => date('Y-m-d'),
                    'jam_datang_ahi' => null,
                    'terlambat_ahi' => 0,
                    'ket_datang_ahi' => htmlspecialchars($this->input->post('ik_ket'))
                );
                $data2 = array(
                    'ket_ahi_jurnal' => 0
                );
            } else {
                $data1 = array(
                    'fk_user_ahi' => $id,
                    'ket_ahi' => $absen,
                    'tanggal_ahi' => date('Y-m-d'),
                    'jam_datang_ahi' => $jam_datang,
                    'terlambat_ahi' => $hasil_menit,
                    'ket_datang_ahi' => htmlspecialchars($this->input->post('ik_ket')),
                    'jam_pulang_ahi' => $hari['jam_pulang']
                );
            }

            $this->model_satpam->update_data('jurnal_hariini', $data2, 'fk_user_jhi', $id);
            $this->model_satpam->add_data('kehadiran', $data);
            $id__ = $this->db->insert_id();
            $this->model_satpam->update_data('absen_hariini', $data1, 'fk_user_ahi', $id);
            $data_k = array(
                'fk_kehadiran' => $id__
            );
            $this->model_satpam->update_data('absen_hariini', $data_k, 'fk_user_ahi', $id);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Kehadiran Hari Ini Berhasil Diisi!</div></h4>');
            redirect("satpam/data_kehadiran");
        }
    }
    public function data_jurnal()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['tanggal_jurnal'] = $this->model_satpam->getDataTerakhirJurnal()->row_array();
        $data['jmlbelumacc'] = $this->model_satpam->getJumlahBelumAcc()->num_rows();
        $data['sp'] = $this->model_satpam->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_satpam->getJumlahPengumumanHI()->num_rows();
        $data['jmlbelumacc'] = $this->model_satpam->getJumlahBelumAcc()->num_rows();
        $data['jurnal_hariini'] = $this->model_satpam->getJurnalHariIni()->result();
        $data['jurnal_acc'] = $this->model_satpam->getJurnalACC()->result();
        $data['lvl'] = $this->session->userdata('lvl');
        $data['setting'] = $this->model_satpam->jurnal_kejujuran(1)->row_array();
        $this->load->view("templates/header", $data);
        $this->load->view("satpam/data_jurnal", $data);
        $this->load->view("templates/footer");
    }
    public function profile()
    {
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->model_satpam->getProfileSaya($id_user)->row_array();
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['jmlbelumacc'] = $this->model_satpam->getJumlahBelumAcc()->num_rows();
        $data['sp'] = $this->model_satpam->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_satpam->getJumlahPengumumanHI()->num_rows();
        $data['a'] = $this->model_satpam->hitungJumlahKehadiran(1, 1);

        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("satpam/profile", $data);
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
            $data['profile'] = $this->model_satpam->getProfileSaya($id_user)->row_array();
            $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
            $data['foto'] = $this->session->userdata('foto');
            $data['jmlbelumacc'] = $this->model_satpam->getJumlahBelumAcc()->num_rows();
            $data['sp'] = $this->model_satpam->getJumlahPengumuman()->num_rows();
            $data['phi'] = $this->model_satpam->getJumlahPengumumanHI()->num_rows();
            $data['a'] = $this->model_satpam->hitungJumlahKehadiran(1, 1);

            $data['lvl'] = $this->session->userdata('lvl');
            $this->load->view("templates/header", $data);
            $this->load->view("satpam/profile", $data);
            $this->load->view("templates/footer");
        } else {
            $id_user = $this->session->userdata('id_user');
            $data_user = [
                'username' => htmlspecialchars($this->input->post('username')),
            ];
            $this->model_satpam->update_data('users', $data_user, 'id_user', $id_user);
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
                    $this->model_satpam->update_data('pegawai', $data, 'fk_user', $id_user);
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
                $this->model_satpam->update_data('pegawai', $data, 'fk_user', $id_user);
                $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Profile Anda Berhasil Diubah!</div></h4>');
            }
            redirect('satpam/profile');
        }
    }
    // public function mulai_absen()
    // {

    //     $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Absen Hari Ini Sudah Bisa Dilakukan!</div></h4>');
    //     redirect("satpam/data_kehadiran");
    // }
    public function seluruh_data()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['ket_absensi'] = $this->model_satpam->getKetAbsensi()->result();
        $data['jmlbelumacc'] = $this->model_satpam->getJumlahBelumAcc()->num_rows();
        $data['sp'] = $this->model_satpam->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_satpam->getJumlahPengumumanHI()->num_rows();
        $data['seluruh_kehadiran'] = $this->model_satpam->getSeluruhKehadiran()->result();
        $data['seluruh_jurnal'] = $this->model_satpam->getSeluruhJurnal()->result();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("satpam/seluruh_data", $data);
        $this->load->view("templates/footer");
    }
    public function mulai_jurnal_modal()
    {
        $id = $this->input->post('ij_id');
        $ket_keluar = $this->input->post('ij_ket');
        if (empty($ket_keluar) || is_null($ket_keluar)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Keterangan Keluar Wajib di Isi !</div></h4>');
            redirect("satpam/data_jurnal");
        } else {
            if ($this->input->post('ij_acc') == 0) {
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
                $this->model_satpam->add_data('jurnal', $data_jurnal);
                $this->model_satpam->update_data('jurnal_hariini', $data, 'fk_user_jhi', $id);
                $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Jurnal Berhasil Di Isi!</div></h4>');
            } elseif ($this->input->post('ij_acc') == 1) {
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
                $this->model_satpam->add_data('jurnal', $data_jurnal);
                $this->model_satpam->update_data('jurnal_hariini', $data, 'fk_user_jhi', $id);
                $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Jurnal Berhasil Di Isi!</div></h4>');
            } elseif ($this->input->post('ij_acc') == 2) {
            } elseif ($this->input->post('ij_acc') == 3) {
                $data = array(
                    'tanggal_jhi' => date('Y-m-d'),
                    'kegiatan_keluar_jhi' => htmlspecialchars($this->input->post('ij_ket')),
                    'mulai_pukul_jhi' => date('H:i:s'),
                    'sampai_pukul_jhi' => null,
                    'acc_jurnal_jhi' => 2
                );
                $data_jurnal = array(
                    'fk_user_jurnal' => $id,
                    'tanggal_jurnal' => date('Y-m-d'),
                    'kegiatan_keluar' => htmlspecialchars($this->input->post('ij_ket')),
                    'mulai_pukul' => date('H:i:s'),
                    'acc_jurnal' => 2
                );
                $this->model_satpam->update_data_spesial('jurnal', $data_jurnal, 'fk_user_jurnal', $id, htmlspecialchars($this->input->post('ij_ket')));
                $this->model_satpam->update_data('jurnal_hariini', $data, 'fk_user_jhi', $id);
                $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Jurnal Berhasil Di Acc!</div></h4>');
            }
            redirect("satpam/data_jurnal");
        }
    }
    public function selesai_jurnal_modal()
    {
        $id = $this->input->post('ij_id1');
        $fk = $this->input->post('ij_fk1');
        $mulai = $this->model_satpam->getMulaiPukul($id)->row_array();

        $awal = strtotime($mulai['mulai_pukul']);
        $akhir = strtotime(date('H:i:s'));
        $diff = $akhir - $awal;
        $hasil_menit = floor($diff / 60);
        $ket_keluar = $this->input->post('ij_ket1');
        if (empty($ket_keluar) || is_null($ket_keluar)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Keterangan Keluar Wajib di Isi !</div></h4>');
            redirect("satpam/data_jurnal");
        } else {
            if ($this->input->post('ij_acc1') == 2) {
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
                $this->model_satpam->update_data('jurnal', $data_jurnal, 'id_jurnal', $id);
                $this->model_satpam->update_data('jurnal_hariini', $data, 'fk_user_jhi', $fk);
                $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Pegawai Telah Kembali Ke Pondok!</div></h4>');
            }
            redirect("satpam/data_jurnal");
        }
    }
    public function mulai_jurnal()
    {
        $terakhir = $this->model_satpam->getDataTerakhirJurnal()->row_array();
        if ($terakhir['tanggal_jurnal'] == date('Y-m-d')) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Tombol Mulai Isi Jurnal Ini Hanya Bisa Berlaku Sehari Sekali !</div></h4>');
            redirect("satpam/data_jurnal");
        } else {
            $data = array(
                'acc_jurnal_jhi' => 0,
                'tanggal_jhi' => date('Y-m-d'),
                'kegiatan_keluar_jhi' => ''
            );
            $this->model_satpam->mulai_jurnal($data);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Jurnal Hari Ini Sudah Bisa Dilakukan!</div></h4>');
            redirect("satpam/data_jurnal");
        }
    }
    public function data_kepulangan()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['users_ahi_hadir'] = $this->model_satpam->getUsers_ahi_hadir()->result();
        $data['sp'] = $this->model_satpam->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_satpam->getJumlahPengumumanHI()->num_rows();
        $data['jmlbelumacc'] = $this->model_satpam->getJumlahBelumAcc()->num_rows();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("satpam/data_kepulangan", $data);
        $this->load->view("templates/footer");
    }
    public function hapus_kehadiran_sd()
    {
        $idfk = explode("a", $this->uri->segment(3));
        $id['id_kehadiran'] = $idfk[0];
        $fk = $idfk[1];

        $this->model_satpam->hapus_data('kehadiran', $id);
        $data = array(
            'ket_ahi' => 0,
            'jam_datang_ahi' => null,
            'terlambat_ahi' => 0,
            'ket_datang_ahi' => null,
            'jam_pulang_ahi' => null,
            'ket_pulang_ahi' => null
        );
        $this->model_satpam->update_data('absen_hariini', $data, 'id_ahi', $fk);
        $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Kehadiran Hari Ini Berhasil Dihapus!</div></h4>');
        redirect("satpam/seluruh_data");
    }
    public function pulang_cepat_modal()
    {
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
        $hari = $this->model_satpam->getHariIni($daftar_hari[$namahari])->row_array();

        $id = htmlspecialchars($this->input->post('p_id'));
        $id_k = htmlspecialchars($this->input->post('p_idk'));
        $jamp = htmlspecialchars($this->input->post('p_jamp'));
        $ket = htmlspecialchars($this->input->post('p_ket'));

        $jam_keluar = strtotime($jamp);
        $sampai_jam = strtotime($hari['jam_pulang']);
        $diff = $sampai_jam - $jam_keluar;

        $hasil_menit = floor($diff / 60);
        if ($hasil_menit <= 0) {
            $hasil_menit = 0;
        }

        if (empty($ket) || is_null($ket)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Keterangan Wajib di Isi !</div></h4>');
            redirect("satpam/data_kepulangan");
        } else {
            $data_a = array(
                'jam_pulang_ahi' => $jamp,
                'ket_pulang_ahi' => $ket
            );
            $data_k = array(
                'jam_pulang' => $jamp,
                'ket_jp' => $ket
            );
            $data_jhi = array(
                'tanggal_jhi' => date('Y-m-d'),
                'kegiatan_keluar_jhi' => $ket,
                'mulai_pukul_jhi' => $jamp,
                'sampai_pukul_jhi' => $hari['jam_pulang'],
                'acc_jurnal_jhi' => 1
            );
            $data_j = array(
                'fk_user_jurnal' => $id,
                'tanggal_jurnal' => date('Y-m-d'),
                'kegiatan_keluar' => $ket,
                'mulai_pukul' => $jamp,
                'sampai_pukul' => $hari['jam_pulang'],
                'acc_jurnal' => 1,
                'lama_keluar' => $hasil_menit
            );
            $this->model_satpam->update_data('absen_hariini', $data_a, 'id_ahi', $id);
            $this->model_satpam->update_data('kehadiran', $data_k, 'id_kehadiran', $id_k);
            $this->model_satpam->update_data('jurnal_hariini', $data_jhi, 'fk_user_jhi', $id);
            $this->model_satpam->add_data('jurnal', $data_j);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Kepulangan Lebih Awal Berhasil di Tambahkan!</div></h4>');
            redirect("satpam/data_kepulangan");
        }
    }
    public function hapus_jurnal()
    {
        $id['id_jurnal'] = $this->uri->segment(3);
        $this->model_satpam->hapus_data('jurnal', $id);
        $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Jurnal Berhasil Dihapus!</div></h4>');
        redirect("satpam/seluruh_data");
    }
    public function hapus_edit_jurnal()
    {
        $idfk = explode("a", $this->uri->segment(3));
        $id['id_jurnal'] = $idfk[0];
        $fk = $idfk[1];
        $data = array(
            'acc_jurnal_jhi' => 1
        );
        $this->model_satpam->hapus_data('jurnal', $id);
        $this->model_satpam->update_data('jurnal_hariini', $data, 'fk_user_jhi', $fk);
        $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Jurnal Berhasil Dihapus!</div></h4>');
        redirect("satpam/seluruh_data");
    }
    public function edit_jurnal_modal()
    {
        $id = htmlspecialchars($this->input->post('ej_id'));
        $fk = htmlspecialchars($this->input->post('ej_fk'));
        $mulai = htmlspecialchars($this->input->post('ej_mulaip'));
        $sampai = htmlspecialchars($this->input->post('ej_sampaip'));
        $ket = htmlspecialchars($this->input->post('ej_ket'));

        $jam_keluar = strtotime($mulai);
        $sampai_jam = strtotime($sampai);
        $diff = $sampai_jam - $jam_keluar;

        $hasil_menit = floor($diff / 60);
        if ($hasil_menit <= 0) {
            $hasil_menit = 0;
        }
        if (empty($ket) || is_null($ket)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Keterangan Wajib di Isi !</div></h4>');
            redirect("satpam/data_kepulangan");
        } else {
            $data = array(
                'kegiatan_keluar' => $ket,
                'mulai_pukul' => $mulai,
                'sampai_pukul' => $sampai,
                'lama_keluar' => $hasil_menit
            );
            $this->model_satpam->update_data('jurnal', $data, 'id_jurnal', $id);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Jurnal Berhasil Diubah!</div></h4>');
            redirect("satpam/seluruh_data");
        }
    }
    public function edit_jurnal_modal1()
    {
        $id = htmlspecialchars($this->input->post('ej_id1'));
        $fk = htmlspecialchars($this->input->post('ej_fk1'));
        $mulai = htmlspecialchars($this->input->post('ej_mulaip1'));
        $ket = htmlspecialchars($this->input->post('ej_ket1'));

        if (empty($ket) || is_null($ket)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Keterangan Wajib di Isi !</div></h4>');
            redirect("satpam/data_kepulangan");
        } else {
            $data = array(
                'kegiatan_keluar' => $ket,
                'mulai_pukul' => $mulai,
            );
            $this->model_satpam->update_data('jurnal', $data, 'id_jurnal', $id);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Jurnal Berhasil Diubah!</div></h4>');
            redirect("satpam/seluruh_data");
        }
    }
    public function edit_kehadiran_modal()
    {
        $id = htmlspecialchars($this->input->post('ek_id'));
        $fk = htmlspecialchars($this->input->post('ek_fk'));
        $absen = htmlspecialchars($this->input->post('ek_absen'));
        $jamd = htmlspecialchars($this->input->post('ek_jamd'));
        $ket = htmlspecialchars($this->input->post('ek_ketd'));

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
        $hari = $this->model_satpam->getHariIni($daftar_hari[$namahari])->row_array();
        // echo $daftar_hari[$namahari];
        // echo "<br>";
        $jadwal_jd = strtotime($hari['jam_datang']);
        $jd = strtotime($jamd);
        $diff = $jd - $jadwal_jd;

        $hasil_menit = floor($diff / 60);
        if ($hasil_menit <= 0) {
            $hasil_menit = 0;
        }
        if ($absen == "") {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Keterangan Absen Wajib di Isi !</div></h4>');
            redirect("satpam/seluruh_data");
        } else {

            $data = array(
                'ket_absen' => $absen,
                'jam_datang' => $jamd,
                'ket_jd' => $ket,
                'terlambat' => $hasil_menit,
                'jam_pulang' => $hari['jam_pulang']
            );
            $data1 = array(
                'ket_ahi' => $absen,
                'jam_datang_ahi' => $jamd,
                'terlambat_ahi' => $hasil_menit,
                'ket_datang_ahi' => $ket,
                'jam_pulang_ahi' => $hari['jam_pulang']
            );
            if ($absen > 1) {
                $data = array(
                    'ket_absen' => $absen,
                    'jam_datang' => null,
                    'ket_jd' => $ket,
                    'terlambat' => 0,
                    'jam_pulang' => null
                );
                $data1 = array(
                    'ket_ahi' => $absen,
                    'jam_datang_ahi' => null,
                    'terlambat_ahi' => 0,
                    'ket_datang_ahi' => $ket,
                    'jam_pulang_ahi' => null
                );
            }
            $this->model_satpam->update_data('kehadiran', $data, 'id_kehadiran', $id);
            $this->model_satpam->update_data('absen_hariini', $data1, 'fk_user_ahi', $fk);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Data Kehadiran Berhasil Diubah!</div></h4>');
            redirect("satpam/seluruh_data");
        }
    }
    public function data_jadwal()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['jmlbelumacc'] = $this->model_satpam->getJumlahBelumAcc()->num_rows();
        $data['sp'] = $this->model_satpam->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_satpam->getJumlahPengumumanHI()->num_rows();

        $data['data_jam'] = $this->model_satpam->getJamDatangPulang()->result();
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("satpam/data_jadwal", $data);
        $this->load->view("templates/footer");
    }

    public function rekap_kehadirans()
    {
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['lvl'] = $this->session->userdata('lvl');
        $data['jmlbelumacc'] = $this->model_satpam->getJumlahBelumAcc()->num_rows();
        $data['sp'] = $this->model_satpam->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_satpam->getJumlahPengumumanHI()->num_rows();
        $id_user = $this->session->userdata('id_user');
        //hadir
        $data['jk1'] = $this->model_satpam->getRekap1($id_user, '01', 1)->num_rows();
        $data['jk2'] = $this->model_satpam->getRekap1($id_user, '02', 1)->num_rows();
        $data['jk3'] = $this->model_satpam->getRekap1($id_user, '03', 1)->num_rows();
        $data['jk4'] = $this->model_satpam->getRekap1($id_user, '04', 1)->num_rows();
        $data['jk5'] = $this->model_satpam->getRekap1($id_user, '05', 1)->num_rows();
        $data['jk6'] = $this->model_satpam->getRekap1($id_user, '06', 1)->num_rows();
        $data['jk7'] = $this->model_satpam->getRekap1($id_user, '07', 1)->num_rows();
        $data['jk8'] = $this->model_satpam->getRekap1($id_user, '08', 1)->num_rows();
        $data['jk9'] = $this->model_satpam->getRekap1($id_user, '09', 1)->num_rows();
        $data['jk10'] = $this->model_satpam->getRekap1($id_user, '10', 1)->num_rows();
        $data['jk11'] = $this->model_satpam->getRekap1($id_user, '11', 1)->num_rows();
        $data['jk12'] = $this->model_satpam->getRekap1($id_user, '12', 1)->num_rows();
        //cuti
        $data['jc1'] = $this->model_satpam->getRekap1($id_user, '01', 2)->num_rows();
        $data['jc2'] = $this->model_satpam->getRekap1($id_user, '02', 2)->num_rows();
        $data['jc3'] = $this->model_satpam->getRekap1($id_user, '03', 2)->num_rows();
        $data['jc4'] = $this->model_satpam->getRekap1($id_user, '04', 2)->num_rows();
        $data['jc5'] = $this->model_satpam->getRekap1($id_user, '05', 2)->num_rows();
        $data['jc6'] = $this->model_satpam->getRekap1($id_user, '06', 2)->num_rows();
        $data['jc7'] = $this->model_satpam->getRekap1($id_user, '07', 2)->num_rows();
        $data['jc8'] = $this->model_satpam->getRekap1($id_user, '08', 2)->num_rows();
        $data['jc9'] = $this->model_satpam->getRekap1($id_user, '09', 2)->num_rows();
        $data['jc10'] = $this->model_satpam->getRekap1($id_user, '10', 2)->num_rows();
        $data['jc11'] = $this->model_satpam->getRekap1($id_user, '11', 2)->num_rows();
        $data['jc12'] = $this->model_satpam->getRekap1($id_user, '12', 2)->num_rows();
        //sakit
        $data['js1'] = $this->model_satpam->getRekap1($id_user, '01', 3)->num_rows();
        $data['js2'] = $this->model_satpam->getRekap1($id_user, '02', 3)->num_rows();
        $data['js3'] = $this->model_satpam->getRekap1($id_user, '03', 3)->num_rows();
        $data['js4'] = $this->model_satpam->getRekap1($id_user, '04', 3)->num_rows();
        $data['js5'] = $this->model_satpam->getRekap1($id_user, '05', 3)->num_rows();
        $data['js6'] = $this->model_satpam->getRekap1($id_user, '06', 3)->num_rows();
        $data['js7'] = $this->model_satpam->getRekap1($id_user, '07', 3)->num_rows();
        $data['js8'] = $this->model_satpam->getRekap1($id_user, '08', 3)->num_rows();
        $data['js9'] = $this->model_satpam->getRekap1($id_user, '09', 3)->num_rows();
        $data['js10'] = $this->model_satpam->getRekap1($id_user, '10', 3)->num_rows();
        $data['js11'] = $this->model_satpam->getRekap1($id_user, '11', 3)->num_rows();
        $data['js12'] = $this->model_satpam->getRekap1($id_user, '12', 3)->num_rows();
        //tanpa ket
        $data['jtk1'] = $this->model_satpam->getRekap1($id_user, '01', 4)->num_rows();
        $data['jtk2'] = $this->model_satpam->getRekap1($id_user, '02', 4)->num_rows();
        $data['jtk3'] = $this->model_satpam->getRekap1($id_user, '03', 4)->num_rows();
        $data['jtk4'] = $this->model_satpam->getRekap1($id_user, '04', 4)->num_rows();
        $data['jtk5'] = $this->model_satpam->getRekap1($id_user, '05', 4)->num_rows();
        $data['jtk6'] = $this->model_satpam->getRekap1($id_user, '06', 4)->num_rows();
        $data['jtk7'] = $this->model_satpam->getRekap1($id_user, '07', 4)->num_rows();
        $data['jtk8'] = $this->model_satpam->getRekap1($id_user, '08', 4)->num_rows();
        $data['jtk9'] = $this->model_satpam->getRekap1($id_user, '09', 4)->num_rows();
        $data['jtk10'] = $this->model_satpam->getRekap1($id_user, '10', 4)->num_rows();
        $data['jtk11'] = $this->model_satpam->getRekap1($id_user, '11', 4)->num_rows();
        $data['jtk12'] = $this->model_satpam->getRekap1($id_user, '12', 4)->num_rows();
        //terlambat
        $data['jt1'] = $this->model_satpam->getRekapT1($id_user, '01')->num_rows();
        $data['jt2'] = $this->model_satpam->getRekapT1($id_user, '02')->num_rows();
        $data['jt3'] = $this->model_satpam->getRekapT1($id_user, '03')->num_rows();
        $data['jt4'] = $this->model_satpam->getRekapT1($id_user, '04')->num_rows();
        $data['jt5'] = $this->model_satpam->getRekapT1($id_user, '05')->num_rows();
        $data['jt6'] = $this->model_satpam->getRekapT1($id_user, '06')->num_rows();
        $data['jt7'] = $this->model_satpam->getRekapT1($id_user, '07')->num_rows();
        $data['jt8'] = $this->model_satpam->getRekapT1($id_user, '08')->num_rows();
        $data['jt9'] = $this->model_satpam->getRekapT1($id_user, '09')->num_rows();
        $data['jt10'] = $this->model_satpam->getRekapT1($id_user, '10')->num_rows();
        $data['jt11'] = $this->model_satpam->getRekapT1($id_user, '11')->num_rows();
        $data['jt12'] = $this->model_satpam->getRekapT1($id_user, '12')->num_rows();
        //MENIT terlambat
        $data['jmt1'] = $this->model_satpam->getRekapMT1($id_user, '01')->row_array();
        $data['jmt2'] = $this->model_satpam->getRekapMT1($id_user, '02')->row_array();
        $data['jmt3'] = $this->model_satpam->getRekapMT1($id_user, '03')->row_array();
        $data['jmt4'] = $this->model_satpam->getRekapMT1($id_user, '04')->row_array();
        $data['jmt5'] = $this->model_satpam->getRekapMT1($id_user, '05')->row_array();
        $data['jmt6'] = $this->model_satpam->getRekapMT1($id_user, '06')->row_array();
        $data['jmt7'] = $this->model_satpam->getRekapMT1($id_user, '07')->row_array();
        $data['jmt8'] = $this->model_satpam->getRekapMT1($id_user, '08')->row_array();
        $data['jmt9'] = $this->model_satpam->getRekapMT1($id_user, '09')->row_array();
        $data['jmt10'] = $this->model_satpam->getRekapMT1($id_user, '10')->row_array();
        $data['jmt11'] = $this->model_satpam->getRekapMT1($id_user, '11')->row_array();
        $data['jmt12'] = $this->model_satpam->getRekapMT1($id_user, '12')->row_array();

        $data['seluruh_kehadiran'] = $this->model_satpam->getSeluruhKehadiranSaya($id_user)->result();

        $this->load->view("templates/header", $data);
        $this->load->view("satpam/rekap_kehadirans", $data);
        $this->load->view("templates/footer");
    }
    public function rekap_jurnals()
    {
        $id_user = $this->session->userdata('id_user');
        $data['total_lamakeluar'] = $this->model_satpam->getRekapMJ($id_user, date('m'))->row_array();
        $data['total_lamakeluarsemua'] = $this->model_satpam->getRekapMJS($id_user)->row_array();
        $data['jurnalku'] = $this->model_satpam->getJurnalKu($id_user)->result();
        $data['seluruh_jurnalku'] = $this->model_satpam->getSJurnalKu($id_user)->result();
        $data['jmlbelumacc'] = $this->model_satpam->getJumlahBelumAcc()->num_rows();
        $data['sp'] = $this->model_satpam->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_satpam->getJumlahPengumumanHI()->num_rows();
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['lvl'] = $this->session->userdata('lvl');
        $this->load->view("templates/header", $data);
        $this->load->view("satpam/rekap_jurnals", $data);
        $this->load->view("templates/footer");
    }
    public function edit_passwordku()
    {
        $id = $this->session->userdata('id_user');
        $password1 = $this->input->post('ep_password');
        $password2 = $this->input->post('ep_ulangipassword');

        if ($password1 != $password2) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Password Gagal Diubah, Password Wajib Sama !</div></h4>');
            redirect("satpam/profile");
        } elseif (empty($password1) || is_null($password1) || empty($password2) || is_null($password2)) {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Password Gagal Diubah, Password Wajib Diisi    !</div></h4>');
            redirect("satpam/profile");
        } else {
            $data = array(
                'password' => password_hash(
                    $password1,
                    PASSWORD_DEFAULT
                ),
            );
            $this->model_satpam->update_data('users', $data, 'id_user', $id);
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Password Berhasil Diubah!</div></h4>');
            redirect("satpam/profile");
        }
    }
    public function pdf_rekapjurnalku()
    {
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->model_satpam->getProfileSaya($id_user)->row_array();
        $data['total_lamakeluar'] = $this->model_satpam->getRekapMJ($id_user, date('m'))->row_array();
        $data['pengawas_yayasan'] = $this->model_satpam->getPengawasYayasan("Pengawas Yayasan")->row_array();
        $data['jurnalku'] = $this->model_satpam->getJurnalKu($id_user)->result();

        $this->load->view('satpam/tcpdf_jurnalku', $data);
    }
    public function absen_qrcode()
    {
        $data['terakhir'] = $this->model_satpam->getQRCodeTerakhir()->row_array();
        $data['kehadiran_hi'] = $this->model_satpam->getKehadiranHI()->result();
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');
        $data['foto'] = $this->session->userdata('foto');
        $data['lvl'] = $this->session->userdata('lvl');
        $data['jmlbelumacc'] = $this->model_satpam->getJumlahBelumAcc()->num_rows();
        $data['sp'] = $this->model_satpam->getJumlahPengumuman()->num_rows();
        $data['phi'] = $this->model_satpam->getJumlahPengumumanHI()->num_rows();
        $id_user = $this->session->userdata('id_user');
        $this->load->view("templates/header", $data);
        $this->load->view("satpam/absen_qrcode", $data);
        $this->load->view("templates/footer");
    }
    public function generate_qrcode()
    {
        // $terakhir = $this->model_satpam->getDataTerakhir()->row_array();
        $terakhir = $this->model_satpam->getQRCodeTerakhir()->row_array();
        if (date('l') == 'Sunday') {
            $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Absen Hari Ini Tidak Ada Karena Hari Ini Hari Ahad (Libur) !</div></h4>');
        } else {
            if ($terakhir['tanggal_qr'] == date('Y-m-d')) {
                $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> QR Code tidak bisa di Generate 2 kali sehari !</div></h4>');
            } else {
                $data = array(
                    'ket_ahi' => 0,
                    'qrcode_ahi' => 0,
                    'tanggal_ahi' => date('Y-m-d'),
                    'jam_datang_ahi' => null,
                    'terlambat_ahi' => 0,
                    'ket_datang_ahi' => null,
                    'jam_pulang_ahi' => null,
                    'ket_pulang_ahi' => null
                );
                $this->model_satpam->mulai_absen($data);

                $data2 = array(
                    'ket_ahi_jurnal' => 0,
                    'tanggal_jhi' => date('Y-m-d'),
                    'kegiatan_keluar_jhi' => '',
                    'acc_jurnal_jhi' => 0,
                );
                $this->model_satpam->update_semuadata('jurnal_hariini', $data2);

                $id_user = $this->session->userdata('id_user');
                $params['data'] = password_hash(
                    date('d'),
                    PASSWORD_DEFAULT
                ) . " " . date('Y-m-d');
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH . "assets/img/qrcode/pps_ibnu_mas'ud.png";


                $this->ciqrcode->generate($params);

                $data = array(
                    'fk_user_qr' => $id_user,
                    'tanggal_qr' => date('Y-m-d'),
                    'pukul_qr' => date('H:i:s'),
                    'nama_qr' => "pps_ibnu_mas'ud.png",
                    'data' => $params['data']
                );
                $this->model_satpam->add_data('generate_qrcode', $data);
                $this->session->set_flashdata('message', '<h4 class="gen-case"><div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> QR CODE Berhasil di Generate!</div></h4>');
            }
        }



        redirect("satpam/absen_qrcode");
        // echo '<img src="' . base_url() . "assets/img/qrcode/" . 'tes.png" />';
    }
    public function scan()
    {
        $data = $_GET['data'];
        $ahi = $this->model_satpam->getAHI($data)->row_array();
        $cek_id = $this->model_satpam->getID($data)->row_array();

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
        $hari = $this->model_satpam->getHariIni($daftar_hari[$namahari])->row_array();
        // echo $daftar_hari[$namahari];
        // echo "<br>";
        $jadwal_jd = strtotime($hari['jam_datang']);
        $jd = strtotime(date('H:i:s'));
        $diff = $jd - $jadwal_jd;

        $hasil_menit = floor($diff / 60);
        if ($hasil_menit <= 0) {
            $hasil_menit = 0;
        }
        if ($cek_id != null) {
            if ($ahi == null) {
                $data_h = array(
                    'fk_user_kehadiran' => $data,
                    'ket_absen' => 1,
                    'absen_qrcode' => 1,
                    'tanggal' => date('Y-m-d'),
                    'jam_datang' => date('H:i:s'),
                    'terlambat' => $hasil_menit,
                    'jam_pulang' => $hari['jam_pulang']
                );
                $data_a = array(
                    'fk_user_ahi' => $data,
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
                $this->model_satpam->update_data('jurnal_hariini', $data_j, 'fk_user_jhi', $data);
                $this->model_satpam->add_data('kehadiran', $data_h);
                $id__ = $this->db->insert_id();
                $this->model_satpam->update_data('absen_hariini', $data_a, 'fk_user_ahi', $data);
                $data_k = array(
                    'fk_kehadiran' => $id__
                );
                $this->model_satpam->update_data('absen_hariini', $data_k, 'fk_user_ahi', $data);
                redirect("satpam/absen_qrcode");
            } else {
                $this->session->set_flashdata('message2', '<h4><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Anda Sudah Absen!</div></h4>');
                redirect("satpam/absen_qrcode");
            }
        } else {
            $this->session->set_flashdata('message2', '<h4><div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> QR-Code Salah!</div></h4>');
            redirect("satpam/absen_qrcode");
        }
    }
}
