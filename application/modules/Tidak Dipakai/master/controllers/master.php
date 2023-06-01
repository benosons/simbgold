<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('mmaster');
		$this->load->library('simbg_lib');
		$this->simbg_lib->check_session_login();
	}

	public function index() {
		
	}



}
