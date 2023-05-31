<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
{
    public function index()
    {
        $data = array('page' => 'informasi');
        $data['informasi'] = $this->db->get('t_informasi_bgh')->result();
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('informasi', $data);
        $this->load->view('includes/footer', $data);
    }
        
    public function juknis()
    {
        $data = array('page' => 'juknis');
        $data['juknis'] = $this->db->get('t_juknis')->result();
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('juknis', $data);
        $this->load->view('includes/footer', $data);       
    }
}
