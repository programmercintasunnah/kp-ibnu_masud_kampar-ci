<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Render extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Ciqrcode');
    }
    public function index()
    {
        $data['title'] = "belajar";
        $this->load->view('render', $data);
    }
}
