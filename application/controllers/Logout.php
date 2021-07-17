
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("model_login");
        $this->load->helper('cookie');
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $this->session->sess_destroy();
        redirect("login");
    }
}
