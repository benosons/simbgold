<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pemeriksaan extends CI_Controller {
	
	var $limit = 1000;
	public function __construct() {
		parent::__construct();
		$this->load->helper('utility');
		$this->load->model('MPenilaian');
		$this->load->library('simbg_lib');
		$this->load->library('oss_lib');
		$this->simbg_lib->check_session_login();
	}
	
	function index(){

	}
	// Begin  Validasi Data 
	public function PenilaianList()
	{
		
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Validasi'] = $this->MPenilaian->getListKonsultasi(null,$SQLcari);
		$data['content']	= $this->load->view('ListKonsultasi',$data,TRUE);
		$data['title']		=	'Daftar Konsultasi';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}
	public function Retribusi()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Validasi'] = $this->MPenilaian->getListKonsultasi(null,$SQLcari);
		$data['content']	= $this->load->view('ListKonsultasi',$data,TRUE);
		$data['title']		=	'Daftar Konsultasi';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}
}