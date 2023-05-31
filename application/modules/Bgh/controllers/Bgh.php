<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bgh extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		ini_set('memory_limit', "4096M");
		$this->load->model('mglobal');
		$this->load->model('model_bgh');
		$this->load->library('simbg_lib');
		$this->simbg_lib->check_session_login();
	}

	public function index()
	{
		$data['page_heading'] = "Dashboard BGH";
		$data['page_content'] = $this->load->view('dashboard_bgh', $data, TRUE);
		$this->load->view('template/layout', $data);
	}

	public function permohonanbgh()
	{
		$data['page_heading'] = "Permohonan Bangunan Gedung Hijau";
		$data['page_content'] = $this->load->view('permohonan/listpermohonan', $data, TRUE);
		$this->load->view('template/layout', $data);
	}

	public function mandatorybghbaru()
	{
		$data['page_heading'] = "Permohonan Bangunan Gedung Hijau Mandatory";
		$data['klas'] = $this->model_bgh->getklas()->result();
		$data['provinsi'] = $this->mglobal->listDataProvinsi()->result();
		$data['page_content'] = $this->load->view('permohonan/mandatory', $data, TRUE);
		$this->load->view('template/layout', $data);
	}
}
