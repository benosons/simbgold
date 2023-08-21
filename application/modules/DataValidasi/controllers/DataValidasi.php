<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class DataValidasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('utility');
		$this->load->model('Mdatavalidasi');
		$this->load->library('simbg_lib');
		$this->simbg_lib->check_session_login();
	}
	public function index()
	{ 
		$this->DataRetribusi();
	}
	//Begin Data QrCode Lampiran B Persetujuan Bangunan Gedung
	function DataTeknis()
	{	
		$no_konsultasi 			= $this->uri->segment(3);
		$data['no_konsultasi'] 	= $no_konsultasi;
		$id 					= $this->uri->segment(3);
		$data['id']				= $id;
		$query 					= $this->Mdatavalidasi->getDataPemilik($id);
		$data['data'] 			= $query->row();
		$bangunan				= $this->Mdatavalidasi->getDataBangunan($id);
		$data['bangunan']		= $bangunan->row();
		$DataVal 				= $this->Mdatavalidasi->getdatastatus($id)->row_array();
        $status 				= $DataVal['status'];
		
		$this->getDataTanah();
		$this->getDataUmum();
		$this->getDataArsitektur();
		$this->getDataStruktur();
		$this->getDataMEP();
		
		if($status == null || $status == '1' || $status == '2' || $status == '3' || $status == '4' || $status == '5' || $status == '6' || $status == '7' || $status == '8' || $status == '9' || $status == '10' || $status == '11' || $status == '12' || $status == '13' ||  $status == '14' || $status == '25' || $status == '26'){
			redirect('Front/LogOut');
		}else{
			$data['title']		=	'';
			$data['heading']	=	'';
			$data['content']	= $this->load->view('DataTeknis', $data, TRUE);
			$this->load->view('Front_Info', $data);
		}
	}
	function getDataTanah()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mdatavalidasi->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mdatavalidasi->getSyaratList($id_j_per, '1', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_tnh'] = $query->result();
		$this->load->view('kosong', $data);
	}
	function getDataUmum()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mdatavalidasi->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mdatavalidasi->getSyaratList($id_j_per, '5', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_umum'] = $query->result();
		$this->load->view('kosong', $data);
	}
	public function getDataArsitektur()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mdatavalidasi->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mdatavalidasi->getSyaratList($id_j_per, '2', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_Ars'] = $query->result();
		$this->load->view('kosong', $data);
	}
	public function getDataStruktur()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mdatavalidasi->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mdatavalidasi->getSyaratList($id_j_per, '3', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_Str'] = $query->result();
		$this->load->view('kosong', $data);
	}
	public function getDataMEP()
	{
		$id 		= $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mdatavalidasi->getJenisKonsultasi($id)->row_array();
		$id_j_per 	= $permohonan['id_jenis_permohonan'];
		$query 		= $this->Mdatavalidasi->getSyaratList($id_j_per, '4', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_MEP'] = $query->result();
		$this->load->view('kosong', $data);
	}
	//End Data QrCode Lampiran B Persetujuan Bangunan Gedung
	//Begin Data QrCode Lampiran C Persetujuan Bangunan Gedung
	function DataRetribusi()
	{	
		$id_kabkot				= $this->session->userdata('loc_id_kabkot');
		$SPPST 					= $this->uri->segment(3);
		$data['SPPST'] 			= $SPPST;
		$DataVal 				= $this->Mdatavalidasi->getdatastatusRetribusi($SPPST)->row_array();
        $status 				= $DataVal['status'];
		$id						= $DataVal['id'];
		$query 					= $this->Mdatavalidasi->getDataPemilik($id);
		$data['data'] 			= $query->row();
		$querybangunan 				= $this->Mdatavalidasi->getDataBangunanRetribusi($id);
		$getTotalRetribusi 			= $this->Mdatavalidasi->getTotalRetribusi($id);
		$total 						= $getTotalRetribusi->num_rows() > 0 ? $getTotalRetribusi->row()->nilai_retribusi_keseluruhan : 0;
		$data['total_retribusi'] 	= $total;
		$data['databgn'] 			= $querybangunan->row();
		$data['prasarana'] 			= $this->Mdatavalidasi->getPrasarana($id)->result();
			
		if($status == null || $status == '1' || $status == '2' || $status == '3' || $status == '4' || $status == '5' || $status == '6' || $status == '7' || $status == '8' || $status == '9' || $status == '10' || $status == '11' || $status == '12' || $status == '13' ||  $status == '14' || $status == '25' || $status == '26'){
			redirect('Front/LogOut');
		}else{
			$data['title']		=	'';
			$data['heading']	=	'';
			$data['content'] = $this->load->view('DataRetribusiValidasi', $data, TRUE);
			$this->load->view('Front_Info_Validasi', $data);
		}
	}
	//End Data QrCode Lampiran C Persetujuan Bangunan Gedung
}
