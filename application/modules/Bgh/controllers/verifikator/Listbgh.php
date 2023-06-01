<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Listbgh extends CI_Controller
{
    public function index()
    {
        $data = array('page' => 'bgh');
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/listbgh');
        $this->load->view('admin/includes/footer', $data);
    }

    public function detail()
    {
        $data = array('page' => 'bgh');
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/detail');
        $this->load->view('admin/includes/footer', $data);
    }
}
