<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        $data = array('page' => 'dashboard');
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('dashboard');
        $this->load->view('includes/footer', $data);
    }
}
