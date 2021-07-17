
<?php

class Model_userbiasa extends CI_Model
{
    public function isNotLogin()
    {
        if ($this->session->userdata('lvl') === null) {
            return true;
        } else if ($this->session->userdata('lvl') != 3) {
            return true;
        }
    }
    function getPengumuman()
    {
        $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('pukul', 'DESC');
        return $this->db->get_where('pengumuman', ['kepada' => 1]);
    }
    function getAHI($id)
    {
        $this->db->order_by('id_kehadiran', 'DESC');
        $this->db->limit(1);
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id, 'tanggal' => date('Y-m-d')]);
    }
    function getJumlahKehadiran($id, $bulan, $tahun)
    {
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id, 'ket_absen' => 1, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun]);
        // return $this->db->query("SELECT * FROM kehadiran WHERE fk_user = $id AND MONTH(tanggal)=$bulan");
    }
    function getJumlahSakit($id, $bulan, $tahun)
    {
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id, 'ket_absen' => 3, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun]);
    }
    function getJumlahCuti($id, $bulan, $tahun)
    {
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id, 'ket_absen' => 2, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun]);
    }
    function getJumlahTanpaKet($id, $bulan, $tahun)
    {
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id, 'ket_absen' => 4, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun]);
    }
    function getJumlahTerlambat($id, $bulan, $tahun)
    {
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id, 'terlambat >' => 0, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun]);
    }
    function getJumlahJurnal($id, $bulan, $tahun)
    {
        return $this->db->get_where('jurnal', ['fk_user_jurnal' => $id, 'MONTH(tanggal_jurnal)' => $bulan, 'YEAR(tanggal_jurnal)' => $tahun]);
    }
    function getJumlahMenitTerlambat($id, $bulan, $tahun)
    {
        $this->db->select_sum('terlambat');
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun]);
    }
    function getJumlahMenitKeluar($id, $bulan, $tahun)
    {
        $this->db->select_sum('lama_keluar');
        return $this->db->get_where('jurnal', ['fk_user_jurnal' => $id, 'MONTH(tanggal_jurnal)' => $bulan, 'YEAR(tanggal_jurnal)' => $tahun]);
    }
    function getJumlahPengumumanHI()
    {
        return $this->db->get_where('pengumuman', ['tanggal' => date('Y-m-d'), 'kepada' => 1]);
    }
    function getJumlahPengumuman()
    {
        return $this->db->get_where('pengumuman', ['kepada' => 1]);
    }
    function getJamDatangPulang()
    {
        return $this->db->get('jam_datangpulang');
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
    function getSeluruhKehadiran($id)
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
    function update_data($tbl, $data, $idnya, $id)
    {
        $this->db->where($idnya, $id);
        $query = $this->db->update($tbl, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
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
    function add_data($tbl, $data)
    {
        $query = $this->db->insert($tbl, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getMulaiPukul($id)
    {
        return $this->db->get_where('jurnal', ['id_jurnal' => $id]);
    }
    function getPengawasYayasan($pengawas)
    {
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan', 'left');
        return $this->db->get_where('users', ['nama_jabatan' => $pengawas]);
    }
    function getHariIni($hari)
    {
        return $this->db->get_where('jam_datangpulang', ['hari' => $hari]);
    }
}
