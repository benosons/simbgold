<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Docreader extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->load->library('Simbg_lib');
		//$this->simbg_lib->check_session_login();
	}
	public function PDFRead($urlfile = NULL)
    {
		$urlfile	= $this->Outh_model->Encryptor('decrypt', $urlfile);
		$data['urlfile'] = $urlfile;
		$this->load->view('Docreader/ReadPDF', $data);
	}

	public function ReaderDok($urlfile = NULL){
		
		$urlfile	= $this->Outh_model->Encryptor('decrypt', $urlfile);
		echo $urlfile;
		$data['urlfile'] 	= $urlfile;
		$file_path	 = $urlfile;
		if (file_exists($file_path)) {
			header('Content-Type: application/pdf');
			header('Content-Disposition: inline; filename=".pdf"');
			readfile($file_path);
		} else {
			echo "File tidak ditemukan.";
		}
	}
}
