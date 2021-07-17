
<?php

class Model_admin extends CI_Model
{
    public function isNotLogin()
    {
        if ($this->session->userdata('lvl') === null) {
            return true;
        } else if ($this->session->userdata('lvl') != 1) {
            return true;
        }
    }
    function getPengumuman()
    {
        $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('pukul', 'DESC');
        return $this->db->get('pengumuman');
    }
    function add_pengumuman($data)
    {
        $query = $this->db->insert('pengumuman', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function hapus_pengumuman($id)
    {
        $query = $this->db->delete('pengumuman', $id);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function update_pengumuman($data, $id)
    {
        $this->db->where('id_pengumuman', $id);
        $query = $this->db->update('pengumuman', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getUsers()
    {
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('level_user', 'level_user.id_level = users.fk_level', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan', 'left');
        $this->db->order_by('jabatan', 'ASC');
        return $this->db->get('users');
    }
    function getPengawasYayasan($pengawas)
    {
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan', 'left');
        return $this->db->get_where('users', ['nama_jabatan' => $pengawas]);
    }
    function getMudir($mudir)
    {
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan', 'left');
        return $this->db->get_where('users', ['nama_jabatan' => $mudir]);
    }
    function getJabatan()
    {
        return $this->db->get('jabatan');
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
    function hapus_data($tbl, $id)
    {
        $query = $this->db->delete($tbl, $id);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getJamDatangPulang()
    {
        return $this->db->get('jam_datangpulang');
    }
    function getKehadiranHI()
    {
        $this->db->join('users', 'users.id_user = absen_hariini.fk_user_ahi', 'left');
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->join('ket_absensi', 'ket_absensi.id_absensi = absen_hariini.ket_ahi', 'left');
        $this->db->order_by('jam_datang_ahi', 'DESC');
        return $this->db->get_where('absen_hariini', ['tanggal_ahi' => date('Y-m-d')]);
    }
    function jumlahSeluruhKehadiran()
    {
        return $this->db->get('kehadiran');
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
    function jml_qrcode()
    {
        return $this->db->get('generate_qrcode');
    }
    function hapus_seluruh_qrcode()
    {
        return $this->db->truncate('generate_qrcode');
    }
    function hapus_seluruh_pengumuman()
    {
        return $this->db->truncate('pengumuman');
    }
    function hapus_seluruh_kehadiran()
    {
        return $this->db->truncate('kehadiran');
    }
    function hapus_seluruh_jurnal()
    {
        return $this->db->truncate('jurnal');
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
    function update_semuadata($tbl, $data)
    {
        $query = $this->db->update($tbl, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getSeluruhJurnal()
    {
        $this->db->join('users', 'users.id_user = jurnal.fk_user_jurnal', 'left');
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->order_by('tanggal_jurnal', 'DESC');

        return $this->db->get_where('jurnal');
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
    function jurnal_kejujuran($id)
    {
        return $this->db->get_where('pengaturan', ['id_pengaturan' => $id]);
    }
    function getJurnalKu($id)
    {
        return $this->db->get_where('jurnal', ['fk_user_jurnal' => $id, 'MONTH(tanggal_jurnal)' => date('m'), 'YEAR(tanggal_jurnal)' => date('Y')]);
    }
    function getsJurnalKu($id)
    {
        return $this->db->get_where('jurnal', ['fk_user_jurnal' => $id]);
    }
    function getMulaiPukul($id)
    {
        return $this->db->get_where('jurnal', ['id_jurnal' => $id]);
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
    function getRekapKehadiranBulanIni()
    {
        return $this->db->query('SELECT nama_pegawai,foto,nama_jabatan,COUNT(IF(ket_absen>1,ket_absen,NULL)) AS jml, COUNT(IF(ket_absen=1,ket_absen,NULL)) AS hadir,COUNT(IF(ket_absen=2,ket_absen,NULL)) AS cuti,COUNT(IF(ket_absen=3,ket_absen,NULL)) AS sakit,COUNT(IF(ket_absen=4,ket_absen,NULL)) AS tanpaket,COUNT(IF(terlambat>0,terlambat,NULL)) AS jumlah_terlambat,SUM(terlambat) AS jumlah_mterlambat FROM kehadiran JOIN pegawai ON pegawai.fk_user = kehadiran.fk_user_kehadiran JOIN jabatan ON jabatan.id_jabatan = pegawai.jabatan where MONTH(tanggal) = MONTH(CURRENT_DATE()) GROUP BY fk_user_kehadiran ORDER BY jabatan ASC, nama_pegawai ASC');
    }
    function getRekapKehadiranS()
    {
        return $this->db->query('SELECT nama_pegawai,foto,nama_jabatan,COUNT(IF(ket_absen>1,ket_absen,NULL)) AS jml, COUNT(IF(ket_absen=1,ket_absen,NULL)) AS hadir,COUNT(IF(ket_absen=2,ket_absen,NULL)) AS cuti,COUNT(IF(ket_absen=3,ket_absen,NULL)) AS sakit,COUNT(IF(ket_absen=4,ket_absen,NULL)) AS tanpaket,COUNT(IF(terlambat>0,terlambat,NULL)) AS jumlah_terlambat,SUM(terlambat) AS jumlah_mterlambat FROM kehadiran JOIN pegawai ON pegawai.fk_user = kehadiran.fk_user_kehadiran JOIN jabatan ON jabatan.id_jabatan = pegawai.jabatan GROUP BY fk_user_kehadiran ORDER BY jabatan ASC, nama_pegawai ASC');
    }
    function getAHI($id)
    {
        $this->db->order_by('id_kehadiran', 'DESC');
        $this->db->limit(1);
        return $this->db->get_where('kehadiran', ['fk_user_kehadiran' => $id, 'tanggal' => date('Y-m-d')]);
    }
    function getHariIni($hari)
    {
        return $this->db->get_where('jam_datangpulang', ['hari' => $hari]);
    }
}
