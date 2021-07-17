
<?php

class Model_login extends CI_Model
{
    function login($username)
    {
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->where('username', $username);
        return $this->db->get('users');
    }
    function login_id($id)
    {
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->where('id', $id);
        return $this->db->get('users');
    }
    function userslogin($id, $data)
    {
        $this->db->where('id_user', $id);
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function updateLastLogin($id, $data)
    {
        $this->db->where('id_user', $id);
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function updateStatusOnline($data)
    {
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getUsersLogin($s)
    {
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->where('fk_level', $s);
        $this->db->order_by('status_login', 'DESC');
        return $this->db->get('users');
    }
    function getUsersLoginn($s, $id_kelas)
    {
        $this->db->join('pegawai', 'pegawai.fk_user = users.id_user', 'left');
        $this->db->where('id_kelas', $id_kelas);
        $this->db->where('fk_level', $s);
        return $this->db->get('users');
    }

    function getAdminLogin()
    {
        $this->db->order_by('status_login', 'DESC');
        return $this->db->get_where("users", ['fk_level' => 1]);
    }
}
