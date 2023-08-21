<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Monitoring extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('utility');
		$this->load->model('mglobal');
		$this->load->model('Mmonitoring');
		$this->load->library('simbg_lib');
		$this->simbg_lib->check_session_login();
	}

	public function index()
	{
		$this->imb();
	}


	public function imb()
	{
		$data = [
			'imb' => $this->Mmonitoring->getDataMonitoringIMB(),
			'title' => 'Monitoring IMB',
			'heading' => ''
		];
		$this->template->load('template/template_backend', 'Monitoring/MonitoringIMB', $data);
	}

	
	public function MonitoringSLF()
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
		$data['Verifikasi'] = $this->Mmonitoring->getListVerifikator($SQLcari);
		$data['content']	= $this->load->view('DataMonitoring', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm', $data);
	}

	public function DataProvinsi()
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
		$data['Verifikasi'] = $this->Mmonitoring->getListVerifikatorBalai($SQLcari);
		$data['content']	= $this->load->view('DataMonitoringBalai', $data, TRUE);
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
		$data['Verifikasi'] = $this->Mmonitoring->getListHapusData($SQLcari);
		$data['content']	= $this->load->view('DataMonHapus', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm', $data);
	}

	public function removeDataPengajuan($id)
	{
		//$id_permohonan	= $this->uri->segment(4);
		$process = $this->Mmonitoring->removeDataPermohonan($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Permohonan Berhasil Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Permohonan Gagal di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Monitoring/MonHapus');
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

		$query = $this->Mmonitoring->getListVerifikator($SQLcari);
		$data['jum_data'] = $query->num_rows();
		$data['result'] = $query->result();
		$html = $this->load->view('CetakDataMonitoring', $data, true);
		print_cetak($html, 'xls', 'Cetak Monitoring'.date('D-M-Y'), 'L');
	}
	
}
