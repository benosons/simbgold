<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class PenyerahanDokumen extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->load->model('Mpenyerahandokumen');
		$this->load->library('Simbg_lib');
		$this->load->helper('utility');
		$this->simbg_lib->check_session_login();
	}
	public function index()
	{
		
	}
    //Begin Penyerahan Dokumen Persetujuan Bangunan Gedung Bangunan Baru
    public function PenyerahanList()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Draft'] = $this->Mpenyerahandokumen->getListPenyerahan();
		$data['content']	= $this->load->view('ListPenyerahan',$data,TRUE);
		$data['title']		=	'Daftar List Penyerahan Dokumen PBG';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}
    public function PenyerahanForm()
	{
		$id = $this->input->post('x_id_p');
		$cat = $this->input->post('x_cat_p');
		$nama_p = $this->input->post('x_penerima');
		if (trim($id) != '') {
			$tgl_log = date('Y-m-d');
			$keterangan = 'Persetujuan Bangunan Gedung Telah Diserahkan';
			$nama_fb = 'Hasil Sidang';
			$kode_feedback = '50';
			$data_log = array (
				'id' => $id,
				'tgl_log_permohonan' => $tgl_log,
				'keterangan' => $keterangan,
				'kode_proses' => 16,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$dataPbg = array (
				'id' => $id,
				'tanggal_penyerahan' => $tgl_log,
				'catatan' => $cat,
				'nama_penerima' => $nama_p,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$this->Mpenyerahandokumen->SimpanPenyerahan($dataPbg);				
			$dataStatus = array(
				'status' => 17,
			);
			$this->Mpenyerahandokumen->updateProgress($dataStatus,$id);
		}
		$this->session->set_flashdata('message','Persetujuan Bangunan Gedung Telah Telah Diserahkan');
		$this->session->set_flashdata('status','success');
		redirect('PenyerahanDokumen/PenyerahanList');	
	}
    public function Penyerahan ()
	{
		$id = $this->input->get('id');
		$data= $this->Mpenyerahandokumen->getTerbitPBG('a.*,b.nm_pemilik',$id);
		echo json_encode($data);
	}
    //End Penyerahan Dokumen Persetujuan Bangunan Gedung Bangunan Baru
    //Begin Penyerahan Dokumen Sertifikat Laik Fungsi Bangunan Baru
    public function PenyerahanDok()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Draft'] = $this->Mpenyerahandokumen->getListPenyerahanSlf();
		$data['content']	= $this->load->view('ListPenyerahanSlf',$data,TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}
    public function PenyerahanDokEks()
	{
		$id = $this->input->post('x_id_p');
		$cat = $this->input->post('x_cat_p');
		$nama_p = $this->input->post('x_penerima');
		$tgl_log = date('Y-m-d');
		if (trim($id) != '') {
			$dataPbg = array (
				'id' => $id,
				'tanggal_penyerahan' => $tgl_log,
				'catatan' => $cat,
				'nama_penerima' => $nama_p,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$this->Mpenyerahandokumen->SimpanPenyerahanDok($dataPbg);				
			$dataStatus = array(
				'status' => 21,
			);
			$this->Mpenyerahandokumen->updateProgress($dataStatus,$id);
		}
		$this->session->set_flashdata('message','Dokumen Telah Telah Diserahkan');
		$this->session->set_flashdata('status','success');
		redirect('PenyerahanDokumen/PenyerahanDok');	
	}
    public function PenyerahanDokumen ()
	{
		$id = $this->input->get('id');
		$data= $this->Mpenyerahandokumen->getTerbitPBG('a.*,b.nm_pemilik',$id);
		echo json_encode($data);
	}
    //End Penyerahan Dokumen Sertifikat Laik Fungsi Bangunan Baru
    //Begin Penyerahan Dokumen Bangunan Eksisting
    public function PenyerahanSLF()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Draft'] = $this->Mpenyerahandokumen->getListPenyerahanSlfEks(null,$SQLcari);
		$data['content']	= $this->load->view('ListPenyerahanEksis',$data,TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}
    public function PenyerahanDokEksis()
	{
		$id = $this->input->post('x_id_p');
		$cat = $this->input->post('x_cat_p');
		$nama_p = $this->input->post('x_penerima');
		$tgl_log = date('Y-m-d');
		if (trim($id) != '') {
			//$this->imb_model->insert_log_permohonan($data_log);
			$dataPbg = array (
				'id' => $id,
				'tanggal_penyerahan' => $tgl_log,
				'catatan' => $cat,
				'nama_penerima' => $nama_p,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$this->Mpenyerahandokumen->SimpanPenyerahanDok($dataPbg);				
			$dataStatus = array(
				'status' => 21,
			);
			$this->Mpenyerahandokumen->updateProgress($dataStatus,$id);
		}
		$this->session->set_flashdata('message','Dokumen Telah Telah Diserahkan');
		$this->session->set_flashdata('status','success');
		redirect('PenyerahanDokumen/PenyerahanSLF');	
	}
    public function PenyerahanDokumenEksisting()
	{
		$id = $this->input->get('id');
		$data= $this->Mpenyerahandokumen->getTerbitPBG('a.*,b.nm_pemilik',$id);
		echo json_encode($data);
	}
    //End Penyerahan Dokumen Bangunan Eksisting
}
