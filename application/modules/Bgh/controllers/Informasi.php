<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
{
    public function index()
    {
        $data = array('page' => 'informasi');
        $data['informasi'] = $this->db->get('t_informasi_bgh')->result();
        $data['page_content'] = $this->load->view('informasi', $data, TRUE);

        $this->load->view('layout', $data);
    }
        
    public function juknis()
    {
        $data = array('page' => 'juknis');
        $data['juknis'] = $this->db->get('t_juknis')->result();
        $data['page_content'] = $this->load->view('juknis', $data, TRUE);

        $this->load->view('layout', $data);     
    }
}
