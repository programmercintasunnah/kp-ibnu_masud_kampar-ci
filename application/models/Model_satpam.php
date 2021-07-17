
<?php

class Model_satpam extends CI_Model
{
    public function isNotLogin()
    {
        if ($this->session->userdata('lvl') === null) {
            return true;
        } else if ($this->session->userdata('lvl') != 2) {
            return true;
        }
    }
    function hapus_data($tbl, $id)
    {
        $query = $this->db->delete($tbl, $id);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getUsers_ahi()
    {
        $this->db->join('users', 'users.id_user = absen_hariini.fk_user_ahi', 'left');
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('level_user', 'level_user.id_level = users.fk_level', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan', 'left');
        $this->db->order_by('jabatan', 'ASC');
        return $this->db->get_where('absen_hariini', ['ket_ahi' => 0, 'tanggal_ahi' => date('Y-m-d')]);
    }
    function getUsers_ahi_hadir()
    {
        $this->db->join('users', 'users.id_user = absen_hariini.fk_user_ahi', 'left');
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('level_user', 'level_user.id_level = users.fk_level', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan', 'left');
        $this->db->order_by('jabatan', 'ASC');
        return $this->db->get_where('absen_hariini', ['ket_ahi' => 1, 'tanggal_ahi' => date('Y-m-d')]);
    }
    function getUsers_ahi_thadir()
    {
        $this->db->join('users', 'users.id_user = absen_hariini.fk_user_ahi', 'left');
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('level_user', 'level_user.id_level = users.fk_level', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan', 'left');
        $this->db->join('ket_absensi', 'ket_absensi.id_absensi = absen_hariini.ket_ahi', 'right');
        $this->db->order_by('jabatan', 'ASC');
        return $this->db->get_where('absen_hariini', ['ket_ahi >' => 1, 'tanggal_ahi' => date('Y-m-d')]);
    }
    function getKetAbsensi()
    {
        return $this->db->get('ket_absensi');
    }
    function getJamDatangPulang()
    {
        return $this->db->get('jam_datangpulang');
    }
    function add_data($tbl, $data)
    {
        $query = $this->db->insert($tbl, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function update_data($table, $data, $idnya, $id)
    {
        $this->db->where($idnya, $id);
        $query = $this->db->update($table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function update_data_spesial($table, $data, $idnya, $id, $isi)
    {
        $this->db->order_by('tanggal_jurnal', 'DESC');
        $this->db->order_by('id_jurnal', 'DESC');
        $this->db->limit(1);
        $this->db->where($idnya, $id);
        $this->db->where('kegiatan_keluar', $isi);
        $query = $this->db->update($table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getRekapKehadiran()
    {
        $this->db->join('pegawai', 'pegawai.fk_user = rekap_kehadiran.fk_user_r', 'left');
        return $this->db->get('rekap_kehadiran');
    }
    function getRekapKehadiran_()
    {
        $this->db->join('pegawai', 'pegawai.fk_user = rekap_kehadiran.fk_user_r', 'left');
        return $this->db->get('rekap_kehadiran');
    }
    function hitungJumlahKehadiran()
    {
        $hasil = $this->db->get_where('kehadiran', ['ket_absen' => 1]);
        return $hasil;
    }
    function hitungJumlahCuti($id)
    {
        $this->db->get_where('kehadiran', ['ket_absen' => 2]);
        $hasil = $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id]);
        return $hasil;
    }
    function hitungJumlahSakit($id)
    {
        $this->db->get_where('kehadiran', ['ket_absen' => 3]);
        $hasil = $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id]);
        return $hasil;
    }
    function mulai_absen($data)
    {
        $query = $this->db->update('absen_hariini', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function mulai_jurnal($data)
    {
        $query = $this->db->update('jurnal_hariini', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getSeluruhKehadiran()
    {
        $this->db->join('users', 'users.id_user = kehadiran.fk_user_kehadiran', 'left');
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('ket_absensi', 'ket_absensi.id_absensi = kehadiran.ket_absen', 'left');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('jam_datang', 'ASC');
        return $this->db->get_where('kehadiran');
    }
    function getSeluruhJurnal()
    {
        $this->db->join('users', 'users.id_user = jurnal.fk_user_jurnal', 'left');
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->order_by('tanggal_jurnal', 'DESC');

        return $this->db->get_where('jurnal');
    }
    function getJurnalHariIni()
    {
        $this->db->join('users', 'users.id_user = jurnal_hariini.fk_user_jhi', 'left');
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('level_user', 'level_user.id_level = users.fk_level', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan', 'left');
        $this->db->order_by('acc_jurnal_jhi', 'DESC');
        $this->db->order_by('jabatan', 'ASC');
        return $this->db->get_where('jurnal_hariini', ['tanggal_jhi' => date('Y-m-d'), 'ket_ahi_jurnal' => 1]);
    }
    function getJurnalACC()
    {
        $this->db->join('users', 'users.id_user = jurnal.fk_user_jurnal', 'left');
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('level_user', 'level_user.id_level = users.fk_level', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan', 'left');
        $this->db->order_by('mulai_pukul', 'DESC');
        $this->db->order_by('jabatan', 'ASC');
        return $this->db->get_where('jurnal', ['tanggal_jurnal' => date('Y-m-d')]);
    }
    function getJumlahBelumAcc()
    {
        return $this->db->get_where('jurnal_hariini', ['acc_jurnal_jhi >' => 1]);
    }
    function getJumlahPengumumanHI()
    {
        return $this->db->get_where('pengumuman', ['tanggal' => date('Y-m-d')]);
    }
    function getJumlahPengumuman()
    {
        return $this->db->get('pengumuman');
    }

    function getJurnalHI()
    {
        return $this->db->get_where('jurnal', ['tanggal_jurnal' => date('Y-m-d')]);
    }
    function getJHadir()
    {
        return $this->db->get_where('kehadiran', ['ket_absen' => 1, 'tanggal' => date('Y-m-d')]);
    }
    function getJTHadir()
    {
        return $this->db->get_where('kehadiran', ['ket_absen >' => 1, 'tanggal' => date('Y-m-d')]);
    }
    function getJUsers()
    {
        return $this->db->get('users');
    }
    function getJUsersOnline()
    {
        return $this->db->get_where('users', ['status_login' => 1]);
    }
    function getSJurnal()
    {
        return $this->db->get('jurnal');
    }
    function getPengumuman()
    {
        $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('pukul', 'DESC');
        return $this->db->get('pengumuman');
    }
    function getDataTerakhir()
    {
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit(1);
        return $this->db->get_where('kehadiran');
    }
    function getDataTerakhirJurnal()
    {
        $this->db->order_by('tanggal_jurnal', 'DESC');
        $this->db->limit(1);
        return $this->db->get_where('jurnal');
    }
    function getMulaiPukul($id)
    {
        return $this->db->get_where('jurnal', ['id_jurnal' => $id]);
    }
    function getHariIni($hari)
    {
        return $this->db->get_where('jam_datangpulang', ['hari' => $hari]);
    }
    function update_semuadata($tbl, $data)
    {
        $query = $this->db->update($tbl, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getRekap1($id, $bulan, $absen)
    {
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id, 'ket_absen' => $absen, 'MONTH(tanggal)' => $bulan]);
    }
    function getRekapT1($id, $bulan)
    {
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id, 'terlambat >' => 0, 'MONTH(tanggal)' => $bulan]);
    }
    function getRekapMT1($id, $bulan)
    {
        $this->db->select_sum('terlambat');
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id, 'MONTH(tanggal)' => $bulan]);
    }
    function getSeluruhKehadiranSaya($id)
    {
        $this->db->join('users', 'users.id_user = kehadiran.fk_user_kehadiran', 'left');
        $this->db->join('ket_absensi', 'ket_absensi.id_absensi = kehadiran.ket_absen', 'left');
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id]);
    }
    function getProfileSaya($id)
    {
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('level_user', 'level_user.id_level = users.fk_level', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan', 'left');
        return $this->db->get_where('users', ['id_user' => $id]);
    }
    function getJurnalKu($id)
    {
        return $this->db->get_where('jurnal', ['fk_user_jurnal' => $id, 'MONTH(tanggal_jurnal)' => date('m'), 'YEAR(tanggal_jurnal)' => date('Y')]);
    }
    function getsJurnalKu($id)
    {
        return $this->db->get_where('jurnal', ['fk_user_jurnal' => $id]);
    }
    function jurnal_kejujuran($id)
    {
        return $this->db->get_where('pengaturan', ['id_pengaturan' => $id]);
    }
    function getRekapMJ($id, $bulan)
    {
        $this->db->select_sum('lama_keluar');
        return $this->db->get_where('jurnal', ['fk_user_jurnal' => $id, 'MONTH(tanggal_jurnal)' => $bulan]);
    }
    function getRekapMJS($id)
    {
        $this->db->select_sum('lama_keluar');
        return $this->db->get_where('jurnal', ['fk_user_jurnal' => $id]);
    }
    function getPengawasYayasan($pengawas)
    {
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan', 'left');
        return $this->db->get_where('users', ['nama_jabatan' => $pengawas]);
    }
    function getKehadiranHI()
    {
        $this->db->join('users', 'users.id_user = absen_hariini.fk_user_ahi', 'left');
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan', 'left');
        $this->db->join('ket_absensi', 'ket_absensi.id_absensi = absen_hariini.ket_ahi', 'left');
        $this->db->order_by('jam_datang_ahi', 'DESC');
        return $this->db->get_where('absen_hariini', ['tanggal_ahi' => date('Y-m-d')]);
    }
    function getQRCodeTerakhir()
    {
        $this->db->order_by('tanggal_qr', 'DESC');
        $this->db->limit(1);
        return $this->db->get_where('generate_qrcode');
    }
    function getAHI($id)
    {
        $this->db->order_by('id_kehadiran', 'DESC');
        $this->db->limit(1);
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id, 'tanggal' => date('Y-m-d')]);
    }
    function getID($id)
    {
        return $this->db->get_where('users', ['id_user' => $id]);
    }
}
