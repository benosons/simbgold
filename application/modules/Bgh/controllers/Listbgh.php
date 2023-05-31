<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Listbgh extends CI_Controller
{
    public function index()
    {
        $data = array('page' => 'bgh');
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('bgh');
        $this->load->view('includes/footer', $data);
    }
}
