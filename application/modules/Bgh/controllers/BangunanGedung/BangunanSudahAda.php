<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BangunanSudahAda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->library('simbg_lib');
		$this->load->helper(array('form', 'url'));
		// $this->simbg_lib->check_session_login();
        $session_login 	= $this->session->userdata('loc_login');
        if($session_login != TRUE)
        {
            redirect('Front');
        }
	}
    
    public function index()
    {
        $data['page'] = 'dashboard';
        $data['content'] = $this->load->view('bangunangedung/bangunansudahada/index', $data, TRUE);

        $this->load->view('layouts', $data);
        // $this->load->view('layouts');
    }

    public function permohonan()
    {
        $data['page'] = 'permohonan';
        $data['content'] = $this->load->view('bangunangedung/bangunansudahada/form', $data, TRUE);

        $this->load->view('layouts', $data);
    }
}
