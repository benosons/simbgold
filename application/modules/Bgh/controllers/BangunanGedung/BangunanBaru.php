<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BangunanBaru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->library('simbg_lib');
		$this->load->helper(array('form', 'url'));
		// $this->simbg_lib->check_session_login();
        $this->load->model('checklist_model');
        $session_login 	= $this->session->userdata('loc_login');
        if($session_login != TRUE)
        {
            redirect('Front');
        }
	}
    
    public function index()
    {
        $data['page'] = 'dashboard';
        $data['content'] = $this->load->view('bangunangedung/bangunanbaru/index', $data, TRUE);

        $this->load->view('layouts', $data);
        // $this->load->view('layouts');
    }

    public function permohonan()
    {
        $data['page'] = 'permohonan';
        $head = $this->checklist_model->gethead()->result();

        foreach ($head as $h) {
            $x++;
            $row = array();
            $row['id'] = (!empty($h->id) ? $h->id : "NULL");
            $row['kode'] = (!empty($h->kode) ? $h->kode : "NULL");
            $row['nama'] = (!empty($h->nama) ? $h->nama : "NULL");
            $row['poin'] = (!empty($h->poin) ? $h->poin : "NULL");

            $main = $this->checklist_model->getmain(array('id_head' => $h->id))->result();

            foreach($main as $m){
                $row1 = array();
                $row1['id'] = (!empty($m->id) ? $m->id : "NULL");
                $row1['kode'] = (!empty($m->kode) ? $m->kode : "NULL");
                $row1['nama'] = (!empty($m->nama) ? $m->nama : "NULL");
                $row1['poin'] = (!empty($m->poin) ? $m->poin : "NULL");

                $row['main'] = $row1;
            }

            $data['checklist'] = $row;
        }
        // $data['head'] = ;
        $data['content'] = $this->load->view('bangunangedung/bangunanbaru/form', $data, TRUE);

        $this->load->view('layouts', $data);
    }
}
