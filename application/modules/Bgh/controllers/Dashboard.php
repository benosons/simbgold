<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->library('simbg_lib');
		$this->load->helper(array('form', 'url'));
		$this->simbg_lib->check_session_login();
	}
    
    public function index()
    {
        $data['page'] = 'dashboard';
        $data['page_content'] = $this->load->view('dashboard', $data, TRUE);

        $this->load->view('layout', $data);
    }
}
