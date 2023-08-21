<?php
//session_start();
//$_SESSION['usernamepas']='x1';
//echo $_SESSION['usernamepas'];

//exit;
if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Permohonan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('utility');
		$this->load->model('mglobal');
		$this->load->model('Mpermohonan');
		$this->load->library('simbg_lib');
		//$this->simbg_lib->check_session_login();
	}

	public function index()
	{
		$this->imb();
	}


	public function imb()
	{
		$data = [
			'imb' => $this->Mpermohonan->getDataPermohonanIMB(),
			'title' => 'Permohonan IMB',
			'heading' => ''
		];
		$this->template->load('template/template_backend', 'Permohonan/PermohonanIMB', $data);
	}

	
	public function PermohonanSLF()
	{
		$this->load->view('backend_adm');
	}

	public function Konsultasi()
	{
		$search = $this->input->post('search');
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		if ($search != '') {
			$SQLcari = array(
				'id_fungsi_bg' => trim($this->input->post('id_fungsi_bg')),
				'id_proses' => trim($this->input->post('id_proses')),
				'tanggalawal' => trim($this->input->post('tanggalawal')),
				'tanggalakhir' => trim($this->input->post('tanggalakhir'))
			);
			$this->session->set_userdata($SQLcari);
			$data = array(
				'id_fungsi_bg' => trim($this->input->post('id_fungsi_bg')),
				'id_proses' => trim($this->input->post('id_proses')),
				'tanggalawal' => trim(tgl_ind_to_eng($this->input->post('tanggalawal'))),
				'tanggalakhir' => trim(tgl_ind_to_eng($this->input->post('tanggalakhir')))
			);			
		}
		$data['fungsi'] = !empty($this->input->post('id_fungsi_bg'))? $this->input->post('id_fungsi_bg'):0;
		$data['awal'] = !empty($this->input->post('tanggalawal'))? $this->input->post('tanggalawal'):0;
		$data['akhir'] = !empty($this->input->post('tanggalakhir'))? $this->input->post('tanggalakhir'):0;
		$data['Verifikasi'] = $this->Mpermohonan->getListVerifikator($SQLcari);
		$data['content']	= $this->load->view('DataPermohonan', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm', $data);
	}

	public function MonHapus()
	{
		$search = $this->input->post('search');
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		if ($search != '') {
			$SQLcari = array(
				'id_fungsi_bg' => trim($this->input->post('id_fungsi_bg')),
				'id_proses' => trim($this->input->post('id_proses')),
				'tanggalawal' => trim($this->input->post('tanggalawal')),
				'tanggalakhir' => trim($this->input->post('tanggalakhir'))
			);
			$this->session->set_userdata($SQLcari);
			$data = array(
				'id_fungsi_bg' => trim($this->input->post('id_fungsi_bg')),
				'id_proses' => trim($this->input->post('id_proses')),
				'tanggalawal' => trim(tgl_ind_to_eng($this->input->post('tanggalawal'))),
				'tanggalakhir' => trim(tgl_ind_to_eng($this->input->post('tanggalakhir')))
			);
		}
		$data['Verifikasi'] = $this->Mpermohonan->getListHapusData($SQLcari);
		$data['content']	= $this->load->view('DataMonHapus', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm', $data);
	}

	

	public function removeDataPengajuan($id)
	{
		//$id_permohonan	= $this->uri->segment(4);
		$process = $this->Mpermohonan->removeDataPermohonan($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Permohonan Berhasil Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Permohonan Gagal di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Permohonan/MonHapus');
	}

	public function cetak_excel($fungsi = '', $awal = '', $akhir = '')
	{

		$SQLcari = array();
		if ($fungsi != 0) {
			$SQLcari['id_fungsi_bg'] = $fungsi;
		}
		if ($awal != 0) {
			$SQLcari['tanggalawal'] = $awal;
		}
		if ($akhir != 0) {
			$SQLcari['tanggalakhir'] = $akhir;
		}

		$query = $this->Mpermohonan->getListVerifikator($SQLcari);
		$data['jum_data'] = $query->num_rows();
		$data['result'] = $query->result();
		$html = $this->load->view('CetakDataPermohonan', $data, true);
		print_cetak($html, 'xls', 'Cetak Permohonan'.date('D-M-Y'), 'L');
	}
	
}
