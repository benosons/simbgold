<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class DataSetting extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mglobal');
		$this->load->model('Mdatasetting');
		$this->load->library('Simbg_lib');
		$this->simbg_lib->check_session_login();
	}
	//Begin Dokumen
	public function Dokumen()
	{
		$data['syarat_imb'] = $this->Mdatasetting->listDataDokumen('a.id,a.nm_dokumen,a.jns_dokumen,a.keterangan');
		$data['content']	= $this->load->view('persyaratan/Dokumen', $data, TRUE);
		$data['title']		=	'Daftar Dokumen Ketentuan Teknis';
		$data['heading']	=	'';
		$this->load->view('backend', $data);
	}

	public function FormCreateDokumen($jenis = '')
	{
		$data['jenis'] = $jenis;
		$this->load->view('persyaratan/CreateDokumen', $data);
	}

	public function saveDataDokumen()
	{
		$id	= $this->input->post('id');
		$nm_dokumen		= $this->input->post('nm_dokumen');
		$jns_dokumen	= $this->input->post('jns_dokumen');
		$keterangan		= $this->input->post('keterangan');
		$data	= array(
			'nm_dokumen' => $nm_dokumen,
			'jns_dokumen' => $jns_dokumen,
			'keterangan' => $keterangan,
		);
		if ($id != "") {
			$query		= $this->mglobals->setData('tr_dokumen_syarat', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data Jenis Permohonan Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('DataSetting/Dokumen');
		} else {
			$cek = $this->Mdatasetting->cekNamaDokumen('a.id,a.nm_dokumen', $nm_dokumen);
			if ($cek->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Gagal Simpan Jenis Permohonan ' . $nm_dokumen . ' Sudah Tersedia..!!!');
				$this->session->set_flashdata('status', 'danger');
				redirect('DataSetting/Dokumen');
			} else {
				$query		= $this->mglobals->setData('tr_dokumen_syarat', $data, 'id', $id);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Jenis Permohonan Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					redirect('DataSetting/Dokumen');
				} else {
					$this->session->set_flashdata('message', 'Data Jenis Permohonan Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('DataSetting/Dokumen');
				}
			}
		}
	}

	public function FormEditDokumen($id)
	{
		$data['row'] = $this->Mdatasetting->getDataEditDokumen('a.*', $id);
		$this->load->view('persyaratan/UpdateDokumen', $data);
	}
	//End Dokumen
	//Begin Jenis Konsultasi
	public function Konsultasi()
	{
		$data['Konsultasi'] 	= $this->Mdatasetting->listDataKonsultasi('a.id,a.nm_konsultasi');
		
		$data['content']	= $this->load->view('Permohonan/permohonan', $data, TRUE);
		$data['title']		=	'Daftar Jenis Permonohan';
		$data['heading']	=	'Daftar Jenis Permonohan';
		$this->load->view('backend', $data);
	}

	public function saveDataKonsultasi($jenis = '')
	{
		$id					= $this->input->post('id');
		$nm_konsultasi 		= $this->input->post('nm_konsultasi');
		$id_izin 			= $this->input->post('id_izin');
		$id_perancang_dok 	= $this->input->post('id_perancang_dok');
		$id_jenis_bg 		= $this->input->post('id_jenis_bg');
		$klasifikasi_bg 		= $this->input->post('klasifikasi_bg');
		$lama_proses 		= $this->input->post('lama_proses');

		$data	= array(
			'nm_konsultasi' => $nm_konsultasi,
			'id_izin' => $id_izin,
			'id_perancang_dok' => $id_perancang_dok,
			'klasifikasi_bg' => $klasifikasi_bg,
			/*'id_jenis_bg' => $id_jenis_bg,
			'id_dok_tek' => $id_dok_tek,
			'lama_proses' => $lama_proses*/
		);
		if ($id != "") {
			$query		= $this->mglobals->setData('tr_konsultasi', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data Jenis Permohonan Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('DataSetting/Konsultasi');
		} else {
			$cek = $this->Mdatasetting->cekNamaKonsultasi('a.id,a.nm_konsultasi', $nm_konsultasi);
			if ($cek->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Gagal Simpan Jenis Permohonan ' . $nm_konsultasi . ' Sudah Tersedia..!!!');
				$this->session->set_flashdata('status', 'danger');
				redirect('DataSetting/Konsultasi');
			} else {
				$query		= $this->mglobals->setData('tr_konsultasi', $data, 'id', $id);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Jenis Permohonan Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					redirect('DataSetting/Konsultasi');
				} else {
					$this->session->set_flashdata('message', 'Data Jenis Permohonan Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('DataSetting/Konsultasi');
				}
			}
		}
	}

	public function FormEditKonsultasi($id)
	{
		$data['row'] = $this->Mdatasetting->getKonsultasi('a.*', $id);
		$this->load->view('Permohonan/UpdateKonsultasi', $data);
	}
	//End Jenis Konsultasi
	//Begin Data Umum dan Data Teknis
	public function ViewSyarat($id)
	{
		$queJenisUrusan = $this->Mdatasetting->get_jenis_permohonan_list()->result();
		$list_jenis_urusan[''] = '--Pilih--';
		foreach ($queJenisUrusan as $row) 
		{
			$list_jenis_urusan[$row->id] = $row->nm_konsultasi;
		}
		$data['list_jenis_urusan'] = $list_jenis_urusan;
		
		$query = $this->Mdatasetting->getSyaratList($id);		
		$data['jum_data'] = $query->num_rows();		
		$data['result'] = $query;
		$data['model_syarat'] = $this->Mdatasetting;
		$data['head_title'] = '.:: Syarat ::.';	
		/* Begin List Akses Menu */
		$data['head_title'] = '.:: SIMBG ::.';
		$this->load->view('permohonan/Konsultasi/ViewPersyaratan', $data);
	}

	public function EditSyarat($id)
	{
		$id							= $this->uri->segment(3);
		$data['id'] 				= $id;
		$data['jenis_permohonan'] 	= $this->Mdatasetting->getJnsKonsultasi($id);	
		$data['result'] 			= $this->Mdatasetting->getSyaratList($id);		
		$data['jum_data'] 			= $data['result']->num_rows();	
		$data['content']	= $this->load->view('Permohonan/Konsultasi/EditPersyaratan', $data, TRUE);
		$data['title']		= '';
		$data['heading']	= 'Daftar Dokumen Teknis';
		$this->load->view('backend', $data);
	}

	public function EditPersyaratan($id,$id_detail_jenis_persyaratan)
	{
		$data['id_detail_jenis_persyaratan']	= $id_detail_jenis_persyaratan;
		$data['disable']	= '';
		$data['jenis_permohonan'] 		= $this->Mdatasetting->getJnsKonsultasi($id);	
		$data['query_syarat_selected'] 	= $this->Mdatasetting->getSyaratSelected($id,$id_detail_jenis_persyaratan);
		$data['query_syarat_adm']		= $this->Mdatasetting->get_syarat_parent('1');
		$this->load->view('Permohonan/Konsultasi/ListAdministrasi', $data);
	}
	
	public function EditDataTeknisTanah($id,$id_detail_jenis_persyaratan)
	{
		$data['id_detail_jenis_persyaratan']	= $id_detail_jenis_persyaratan;
		$data['disable']	= '';
		$data['jenis_permohonan'] 		= $this->Mdatasetting->getJnsKonsultasi($id);	
		$data['query_syarat_selected'] 	= $this->Mdatasetting->getSyaratSelected($id,$id_detail_jenis_persyaratan);
		$data['query_syarat_adm']		= $this->Mdatasetting->get_syarat_parent('2');
		$this->load->view('Permohonan/Konsultasi/ListArs', $data);
	}

	public function EditDataTeknisArsitektur($id,$id_detail_jenis_persyaratan)
	{
		$data['id_detail_jenis_persyaratan']	= $id_detail_jenis_persyaratan;
		$data['disable']	= '';
		$data['jenis_permohonan'] 		= $this->Mdatasetting->getJnsKonsultasi($id);	
		$data['query_syarat_selected'] 	= $this->Mdatasetting->getSyaratSelected($id,$id_detail_jenis_persyaratan);
		$data['query_syarat_adm']		= $this->Mdatasetting->get_syarat_parent('3');
		$this->load->view('Permohonan/Konsultasi/ListArs', $data);
	}

	public function EditDataTeknisStruktur($id,$id_detail_jenis_persyaratan)
	{
		$data['id_detail_jenis_persyaratan']	= $id_detail_jenis_persyaratan;
		$data['disable']	= '';
		$data['jenis_permohonan'] 		= $this->Mdatasetting->getJnsKonsultasi($id);	
		$data['query_syarat_selected'] 	= $this->Mdatasetting->getSyaratSelected($id,$id_detail_jenis_persyaratan);
		$data['query_syarat_adm']		= $this->Mdatasetting->get_syarat_parent('4');
		$this->load->view('permohonan/Konsultasi/ListArs', $data);
	}

	public function EditDataTeknisME($id,$id_detail_jenis_persyaratan)
	{
		$data['id_detail_jenis_persyaratan']	= $id_detail_jenis_persyaratan;
		$data['disable']	= '';
		$data['jenis_permohonan'] 		= $this->Mdatasetting->getJnsKonsultasi($id);	
		$data['query_syarat_selected'] 	= $this->Mdatasetting->getSyaratSelected($id,$id_detail_jenis_persyaratan);
		$data['query_syarat_adm']		= $this->Mdatasetting->get_syarat_parent('5');
		$this->load->view('Permohonan/Konsultasi/ListArs', $data);
	}

	public function listPersyaratanAdmShow()
	{
		$value		= $this->input->post('value');
		$disable	= $this->input->post('disable') == 'N' ? '' : 'disabled';
		$menu 		= $this->Mdatasetting->ListPersyaratan($value, 'checkbox', 'menu-list', $disable, '1');
		echo $menu;
	}

	public function saveDataPersyaratanKonsultasi()
	{
		$id		= $this->input->post('id');
		$id_detail_jenis_persyaratan	= $this->input->post('id_detail_jenis_persyaratan');
		$id_nama_permohonan ='';
		if ($id_detail_jenis_persyaratan == 5) {
			$id_jenis_persyaratan = 1;
		} else{
			$id_jenis_persyaratan = 2;
		}
		$old_id_persyaratan		= $this->input->post('id_persyaratan');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');

		if ($dok_persyaratan != "") {
			$this->Mdatasetting->removeKonsultasiAdmDetail($old_id_persyaratan);
			$this->Mdatasetting->removeKonsultasiAdm($id_nama_permohonan,$id_detail_jenis_persyaratan);
			$data = array(
				'id' => $id,
				'id_jenis_persyaratan' => $id_jenis_persyaratan,
				'id_detail_jenis_persyaratan' => $id_detail_jenis_persyaratan
			);
			$processInput = $this->mglobals->setData('tr_konsultasi_syarat', $data, '', '');
			for ($i = 0; $i < count($dok_persyaratan); $i++) {
				$id_dokumen_permohonan = $dok_persyaratan[$i];
				$dataDetail	= array(
					'id_persyaratan' => $processInput,
					'id_syarat' => $id_dokumen_permohonan
				);
				$processInputDetail = $this->mglobals->setData('tr_pbg_syarat_detail', $dataDetail, '', '');
			}
			if (!$processInputDetail) {
				$this->session->set_flashdata('message', 'Data Persyaratan Gagal di Ubah.');
				$this->session->set_flashdata('status', 'danger');
				redirect('DataSetting/EditSyarat/'.$id);
			} else {
				$this->session->set_flashdata('message', 'Data Persyaratan Berhasil di Ubah.');
				$this->session->set_flashdata('status', 'success');
				redirect('DataSetting/EditSyarat/'.$id);
			}
		}
	}
	
	//Begin Referensi Provinsi//
	
}
