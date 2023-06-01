<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penerbitan extends CI_Controller {

	var $limit = 1000;
	public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->model('imb_model');
		$this->load->model('mpenerbitan_imb');
		$this->load->library('oss_lib');
		
	}

	function killSession()
	{
		redirect('#');	
	}

	public function index()
	{
		$this->killSession();
	}
	
	function cetak_form_imb()
	{
		$sqlcari = '';
		$id = $this->uri->segment(3);
		$permohonan = $this->imb_model->get_permohonan($id)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['Kolektif'] = $this->imb_model->getDataKolektif($id)->row_array();
		
		$tanah = $this->mpenerbitan_imb->tanah($id);
		$data['result_list'] = $this->mpenerbitan_imb->get_penerbitan_imb_cetak($id);
		$data['result_retri'] = $this->mpenerbitan_imb->retribusi($id)->row_array();
		$data['result_teknis'] = $this->mpenerbitan_imb->rek_teknis($id)->row_array();
		$data['result_per'] = $this->mpenerbitan_imb->peraturan($id)->result_array();
		$data['result_uu'] = $this->mpenerbitan_imb->undang2()->result_array();
		$data['result_tanah'] = $tanah->result_array();
		$data['count_tanah'] = $tanah->num_rows();
		$data['head_title'] = '.:: Cetak IMB ::.';
		
		if($id_jenis_permohonan == "47"){
			$this->load->view('penerbitan/CetakImbKolektif',$data);
		}elseif($id_jenis_permohonan == "48"){
			$this->load->view('penerbitan/CetakImbPemecahan',$data);
		}else{
			$this->load->view('penerbitan/cetak_imb',$data);
		}
	}
}
