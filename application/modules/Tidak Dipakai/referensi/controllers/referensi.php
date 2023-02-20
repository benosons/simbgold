<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Referensi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mglobal');
		$this->load->model('mreferensi');
		$this->load->library('simbg_lib');
		$this->simbg_lib->check_session_login();
	}

	//Begin Referensi Provinsi//
	public function provinsi_list()
	{
		$data['provinsi'] = $this->mreferensi->listDataProvinsi();
		$data['content']	= $this->load->view('provinsi/provinsi_list', $data, TRUE);
		$data['title']		=	'Daftar Provinsi';
		$data['heading']	=	'Daftar Provinsi';
		$this->load->view('backend', $data);
	}

	public function saveDataProvinsi()
	{
		$id_provinsi			= $this->input->post('id_provinsi');
		$nama_provinsi	= $this->input->post('nama_provinsi');
		$data	= array(
			'nama_provinsi' => $nama_provinsi,


		);

		if ($id_provinsi != "") {
			$query		= $this->mglobals->setData('tr_provinsi', $data, 'id_provinsi', $id_provinsi);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('referensi/provinsi_list');
		} else {
			$cek = $this->mreferensi->cekNamaProvinsi('a.id_provinsi,a.nama_provinsi', $nama_provinsi);
			if ($cek->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Gagal Simpan Nama Provinsi ' . $nama_provinsi . ' Sudah Tersedia..!!!');
				$this->session->set_flashdata('status', 'danger');
				redirect('referensi/provinsi_list');
			} else {
				$query		= $this->mglobals->setData('tr_provinsi', $data, 'id_provinsi', $id_provinsi);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Role User Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					redirect('referensi/provinsi_list');
				} else {
					$this->session->set_flashdata('message', 'Data Role User Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('referensi/provinsi_list');
				}
			}
		}
	}

	public function form_edit_provinsi($id_provinsi)
	{
		$data['row'] = $this->mreferensi->getDataEditProvinsi('a.*', $id_provinsi);
		$this->load->view('provinsi/form_edit_provinsi', $data);
	}
	//End Referensi Provinsi

	//Begin Referensi Kabupaten/Kota
	public function kabkota_list()
	{
		$data['kabkota'] = $this->mreferensi->listDataKabKota('a.id_kabkot,a.nama_kabkota,b.nama_provinsi');
		$data['content']	= $this->load->view('kabkota/kabkota_list', $data, TRUE);
		$data['title']		=	'Daftar Kab/Kota';
		$data['heading']	=	'Daftar Kab/Kota';
		$this->load->view('backend', $data);
	}
	//End Referensi Kabupaten/Kota
	//Begin Referensi Kecamatan
	public function kecamatan_list()
	{
		$data['kec'] = $this->mreferensi->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan,b.nama_kabkota');
		$data['content']	= $this->load->view('kecamatan/kecamatan_list', $data, TRUE);
		$data['title']		=	'Daftar Kecamatan';
		$data['heading']	=	'Daftar Kecamatan';
		$this->load->view('backend', $data);
	}
	//End Referensi Kecamatan

	//Begin Referensi Keahlian
	public function bidang()
	{
		$data['keahlian'] = $this->mreferensi->listDataBidang('a.id_bidang,a.nama_bidang');
		$data['content']	= $this->load->view('keahlian/keahlian_list', $data, TRUE);
		$data['title']		=	'Daftar Keahlian';
		$data['heading']	=	'Daftar Keahlian';
		$this->load->view('backend', $data);
	}

	public function form_edit_bidang($id_bidang)
	{
		$data['row'] = $this->mreferensi->getDataEditBidang('a.*', $id_bidang);
		$this->load->view('keahlian/form_edit_bidang', $data);
	}

	public function saveDataBidang()
	{
		$id_bidang	= $this->input->post('id_bidang');
		$nama_bidang = $this->input->post('nama_bidang');
		$data	= array(
			'nama_bidang' => $nama_bidang,


		);

		if ($id_bidang != "") {
			$query		= $this->mglobals->setData('tr_bidang', $data, 'id_bidang', $id_bidang);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('referensi/bidang');
		} else {
			$cek = $this->mreferensi->cekNamaBidang('a.id_bidang,a.nama_bidang', $nama_bidang);
			if ($cek->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Gagal Simpan Nama Bidang Keahlian ' . $nama_bidang . ' Sudah Tersedia..!!!');
				$this->session->set_flashdata('status', 'danger');
				redirect('referensi/bidang');
			} else {
				$query		= $this->mglobals->setData('tr_bidang', $data, 'id_bidang', $id_bidang);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Bidang Keahlian Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					redirect('referensi/bidang');
				} else {
					$this->session->set_flashdata('message', 'Data Bidang Keahlian Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('referensi/bidang');
				}
			}
		}
	}

	public function removeDataBidang($id_bidang)
	{
		$process = $this->mreferensi->removeDataBidang($id_bidang);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Bidang Keahlian Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Bidang Keahlian Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('referensi/bidang');
	}
	//End Referensi Keahlian
	//Begin Referensi Unsur TABG
	public function unsur_tabg()
	{
		$data['tabg'] = $this->mreferensi->listDataUnsurTABG('a.id_unsur_ahli,a.nama_unsur_ahli,b.nama_unsur');
		$data['content']	= $this->load->view('unsur_tabg/unsur_tabg_list', $data, TRUE);
		$data['title']		=	'Daftar TABG';
		$data['heading']	=	'Daftar Unsur TABG';
		$this->load->view('backend', $data);
	}

	public function form_edit_unsur_tabg($id_unsur_ahli)
	{
		$data['row'] = $this->mreferensi->getDataEditUnsurTabg('a.*', $id_unsur_ahli);
		$this->load->view('unsur_tabg/form_edit_unsur_tabg', $data);
	}

	public function saveDataUnsurTabg()
	{
		$id_unsur_ahli	= $this->input->post('id_unsur_ahli');
		$id_unsur = $this->input->post('id_unsur');
		$nama_unsur_ahli = $this->input->post('nama_unsur_ahli');
		$data	= array(
			'id_unsur' => $id_unsur,
			'nama_unsur_ahli' => $nama_unsur_ahli,
		);

		if ($id_unsur_ahli != "") {
			$query		= $this->mglobals->setData('tr_unsur_ahli', $data, 'id_unsur_ahli', $id_unsur_ahli);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('referensi/unsur_tabg');
		} else {
			$query		= $this->mglobals->setData('tr_unsur_ahli', $data, 'id_unsur_ahli', $id_unsur_ahli);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Unsur TABG Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('referensi/unsur_tabg');
			} else {
				$this->session->set_flashdata('message', 'Data Unsur TABG Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('referensi/unsur_tabg');
			}
		}
	}
	//END Referensi Unsur TABG
	//Begin Referensi Dokumen Persyaratan
	public function dokumen_persyaratan()
	{
		$data['syarat_imb'] = $this->mreferensi->listDataPersyaratanImb('a.id_syarat,a.nama_syarat,a.id_jenis_persyaratan');
		$data['syarat_slf'] = $this->mreferensi->listDataPersyaratanSlf('a.id_syarat,a.nama_syarat,a.id_jenis_persyaratan');
		$data['content']	= $this->load->view('persyaratan/persyaratan', $data, TRUE);
		$data['title']		=	'Daftar Nama Persyaratan';
		$data['heading']	=	'Daftar Nama Persyaratan';
		$this->load->view('backend', $data);
	}

	public function form_create_persyaratan($jenis = '')
	{
		$data['jenis'] = $jenis;
		$this->load->view('persyaratan/persyaratan_c', $data);
	}

	public function form_edit_persyaratan($jenis = '', $id)
	{
		if ($jenis == 'imb') {
			$data['row'] = $this->mreferensi->getDataEditPersyaratanImb('a.*', $id);
		} elseif ($jenis == 'slf') {
			$data['row'] = $this->mreferensi->getDataEditPersyaratanSlf('a.*', $id);
		}
		$data['jenis'] = $jenis;
		$this->load->view('persyaratan/persyaratan_u', $data);
	}

	public function saveDataPersyaratan($jenis = '')
	{
		$id	= $this->input->post('id');
		$nama_dokumen_permohonan = $this->input->post('nama_dokumen_permohonan');
		$id_jenis_dok_permohonan = $this->input->post('id_jenis_dok_permohonan');
		$id_sub_jenis_dok_permohonan = $this->input->post('id_sub_jenis_dok_permohonan');
		$status = $this->input->post('status');

		$data	= array(
			'nama_syarat' => $nama_dokumen_permohonan,
			'id_jenis_persyaratan' => $id_jenis_dok_permohonan
			);
		if($jenis == 'slf'){
			$name = '_slf';
		} else{
			$name = '';
		}
		$table = 'tr_imb_syarat' . $name;
		if ($id != "") {
			$this->mglobals->setData($table, $data, 'id_syarat', $id);
			$this->session->set_flashdata('message', "Data Persyaratan $jenis Berhasil di Ubah.");
			$this->session->set_flashdata('status', 'success');
			redirect('referensi/dokumen_persyaratan');
		} else {
			$cek = $this->mreferensi->cekNamaPersyaratan($table, 'a.id_syarat'.$name.',a.nama_syarat'.$name, $nama_dokumen_permohonan);
			if ($cek->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Gagal Simpan Nama Persyaratan ' . $nama_dokumen_permohonan . ' Sudah Tersedia..!!!');
				$this->session->set_flashdata('status', 'danger');
				redirect('referensi/dokumen_persyaratan');
			} else {
				$query		= $this->mglobals->setData($table, $data);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Persyaratan Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					redirect('referensi/dokumen_persyaratan');
				} else {
					$this->session->set_flashdata('message', 'Data Persyaratan Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('referensi/dokumen_persyaratan');
				}
			}
		}
	}

	public function removeDataDokumen($jenis, $id)
	{
		$table = 'tr_' . $jenis . '_syarat';
		$process = $this->mglobals->deleteDataKey($table, 'id_syarat', $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Persyaratan Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Persyaratan Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('referensi/dokumen_persyaratan');
	}
	//End Referensi Dokumen Persyaratan

	//Begin Referensi Jenis Permohonan
	public function jenis_permohonan()
	{
		$data['permohonan_imb'] = $this->mreferensi->listDataPermohonanIMB('a.id_jenis_permohonan,a.nama_permohonan,a.lama_proses');
		$data['permohonan_slf'] = $this->mreferensi->listDataPermohonanSLF('a.id_jenis_permohonan,a.nama_permohonan,a.lama_proses');
		$data['content']	= $this->load->view('permohonan/permohonan', $data, TRUE);
		$data['title']		=	'Daftar Jenis Permonohan';
		$data['heading']	=	'Daftar Jenis Permonohan';
		$this->load->view('backend', $data);
	}

	public function saveDataPermohonan($jenis = '')
	{
		$id	= $this->input->post('id');
		
		$nama_permohonan = $this->input->post('nama_permohonan');
		$id_klasifikasi_bg = $this->input->post('id_klasifikasi_bg');
		$id_pemanfaatan_bg = $this->input->post('id_pemanfaatan_bg');
		$id_jenis_bg = $this->input->post('id_jenis_bg');
		$id_dok_tek = $this->input->post('id_dok_tek');
		$lama_proses = $this->input->post('lama_proses');

		$data	= array(
			'nama_permohonan' => $nama_permohonan,
			'id_pemanfaatan_bg' => $id_pemanfaatan_bg,
			'id_klasifikasi_bg' => $id_klasifikasi_bg,
			'id_jenis_bg' => $id_jenis_bg,
			'id_dok_tek' => $id_dok_tek,
			'lama_proses' => $lama_proses
		);
		if ($id != "") {
			$query		= $this->mglobals->setData('tr_imb_permohonan', $data, 'id_jenis_permohonan', $id);
			$this->session->set_flashdata('message', 'Data Jenis Permohonan Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('referensi/jenis_permohonan');
		} else {
			$cek = $this->mreferensi->cekNamaPermohonan('a.id_jenis_permohonan,a.nama_permohonan', $nama_permohonan);
			if ($cek->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Gagal Simpan Jenis Permohonan ' . $nama_permohonan . ' Sudah Tersedia..!!!');
				$this->session->set_flashdata('status', 'danger');
				redirect('referensi/jenis_permohonan');
			} else {
				$query		= $this->mglobals->setData('tr_imb_permohonan', $data, 'id_jenis_permohonan', $id);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Jenis Permohonan Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					redirect('referensi/jenis_permohonan');
				} else {
					$this->session->set_flashdata('message', 'Data Jenis Permohonan Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('referensi/jenis_permohonan');
				}
			}
		}
	}

	public function form_edit_permohonan($jenis, $id)
	{
		$table = 'tr_imb_permohonan';
		$data['row'] = $this->mreferensi->getDataEditPermohonan($table, 'a.*', $id);
		$this->load->view('permohonan/permohonan_u', $data);
	}

	public function form_view_persyaratan($jenis, $id_permohonan)
	{
		// echo $jenis.$id_permohonan;
		$queJenisUrusan = $this->mreferensi->get_jenis_permohonan_list()->result();
		$list_jenis_urusan[''] = '--Pilih--';
		foreach ($queJenisUrusan as $row) 
		{
			$list_jenis_urusan[$row->id_jenis_permohonan] = $row->nama_permohonan;
		}
		$data['list_jenis_urusan'] = $list_jenis_urusan;
		
		
		// $queKlasifikasi_bg = $this->mreferensi->get_klasifikasi_bg()->result();
		// $list1[''] = '--Pilih--';
		// foreach ($queKlasifikasi_bg as $row) 
		// {
		// 	$list1[$row->id_klasifikasi_bg] = $row->klasifikasi_bg;
		// }
		// $data['list1'] = $list1;
		// // Load data dari tabel
		$query = $this->mreferensi->get_syarat_list($id_permohonan);		
		
		$data['jum_data'] = $query->num_rows();		
		$data['result'] = $query;
		$data['model_syarat'] = $this->mreferensi;
		$data['head_title'] = '.:: Syarat ::.';	
		/* Begin List Akses Menu */
		$data['head_title'] = '.:: SIMBG ::.';
		// $this->template->load('admin_template', 'syarat2/persyaratan_list',$data);

		// $table = 'tr_imb_permohonan';
		// $data['row'] = $this->mreferensi->getDataEditPermohonan($table, 'a.*', $id);
		$this->load->view('permohonan/view_persyaratan', $data);
		// echo '<pre>';
		// print_r($query->result());
	}

	public function form_edit_persyaratan_imb($id_permohonan)
	{
		$data['id_permohonan'] = $id_permohonan;
		
		$data['jenis_permohonan'] = $this->mreferensi->get_jenis_permohonan_list($id_permohonan);	
		$data['result'] = $this->mreferensi->get_syarat_list($id_permohonan);		
		$data['jum_data'] = $data['result']->num_rows();	
		$data['content']	= $this->load->view('permohonan/edit_persyaratan', $data, TRUE);
		$data['title']		= '';
		$data['heading']	= 'Daftar Nama Persyaratan';
		$this->load->view('backend', $data);
	}

	public function edit_persyaratan_imb_adm($id_permohonan,$id_detail_jenis_persyaratan)
	{
		$data['id_detail_jenis_persyaratan']	= $id_detail_jenis_persyaratan;
		$data['disable']	= '';
		$data['jenis_permohonan'] = $this->mreferensi->get_jenis_permohonan_list($id_permohonan);	
		$data['query_syarat_selected'] = $this->mreferensi->get_syarat_selected($id_permohonan,$id_detail_jenis_persyaratan);
		$data['query_syarat_adm']			= $this->mreferensi->get_syarat_parent('1');
		$data['id_persyaratan'] = $this->mreferensi->getIdPersyaratanImb('a.id_persyaratan', $id_permohonan,$id_detail_jenis_persyaratan);
		// echo '<pre>';
		// print_r($data['id_persyaratan']);
		$this->load->view('permohonan/list_imb_adm', $data);
	}

	public function edit_persyaratan_imb_teknis($id_permohonan,$id_detail_jenis_persyaratan)
	{
		$data['id_detail_jenis_persyaratan']	= $id_detail_jenis_persyaratan;
		$data['disable']	= '';
		$data['jenis_permohonan'] = $this->mreferensi->get_jenis_permohonan_list($id_permohonan);	
		$data['query_syarat_selected'] = $this->mreferensi->get_syarat_selected($id_permohonan,$id_detail_jenis_persyaratan);
		$data['query_syarat_teknis']			= $this->mreferensi->get_syarat_parent('2');
		$data['id_persyaratan'] = $this->mreferensi->getIdPersyaratanImb('a.id_persyaratan', $id_permohonan,$id_detail_jenis_persyaratan);
		$this->load->view('permohonan/list_imb_teknis', $data);
		
	}
	
	public function form_view_persyaratan_slf($jenis, $id_permohonan)
	{
		// echo $jenis.$id_permohonan;
		$queJenisUrusan = $this->mreferensi->get_jenis_permohonan_list()->result();
		$list_jenis_urusan[''] = '--Pilih--';
		foreach ($queJenisUrusan as $row) 
		{
			$list_jenis_urusan[$row->id_jenis_permohonan] = $row->nama_permohonan;
		}
		$data['list_jenis_urusan'] = $list_jenis_urusan;
		
		
		// $queKlasifikasi_bg = $this->mreferensi->get_klasifikasi_bg()->result();
		// $list1[''] = '--Pilih--';
		// foreach ($queKlasifikasi_bg as $row) 
		// {
		// 	$list1[$row->id_klasifikasi_bg] = $row->klasifikasi_bg;
		// }
		// $data['list1'] = $list1;
		// // Load data dari tabel
		$query = $this->mreferensi->get_syarat_list($id_permohonan);		
		
		$data['jum_data'] = $query->num_rows();		
		$data['result'] = $query;
		$data['model_syarat'] = $this->mreferensi;
		$data['head_title'] = '.:: Syarat ::.';	
		/* Begin List Akses Menu */
		$data['head_title'] = '.:: SIMBG ::.';
		// $this->template->load('admin_template', 'syarat2/persyaratan_list',$data);

		// $table = 'tr_imb_permohonan';
		// $data['row'] = $this->mreferensi->getDataEditPermohonan($table, 'a.*', $id);
		$this->load->view('permohonan/view_persyaratan', $data);
		// echo '<pre>';
		// print_r($query->result());
	}

	public function form_edit_persyaratan_slf($id_permohonan)
	{
		$data['id_permohonan'] = $id_permohonan;
		
		$data['jenis_permohonan'] = $this->mreferensi->get_jenis_permohonan_list($id_permohonan);	
		$data['result'] = $this->mreferensi->get_syarat_list($id_permohonan);		
		$data['jum_data'] = $data['result']->num_rows();	
		$data['content']	= $this->load->view('permohonan/edit_persyaratan', $data, TRUE);
		$data['title']		= '';
		$data['heading']	= 'Daftar Nama Persyaratan';
		$this->load->view('backend', $data);
	}

	public function edit_persyaratan_slf_adm($id_permohonan,$id_detail_jenis_persyaratan)
	{
		$data['id_detail_jenis_persyaratan']	= $id_detail_jenis_persyaratan;
		$data['disable']	= '';
		$data['jenis_permohonan'] = $this->mreferensi->get_jenis_permohonan_list($id_permohonan);	
		$data['query_syarat_selected'] = $this->mreferensi->get_syarat_selected($id_permohonan,$id_detail_jenis_persyaratan);
		$data['query_syarat_adm']			= $this->mreferensi->get_syarat_parent('1');
		$data['id_persyaratan'] = $this->mreferensi->getIdPersyaratanImb('a.id_persyaratan', $id_permohonan,$id_detail_jenis_persyaratan);
		// echo '<pre>';
		// print_r($data['id_persyaratan']);
		$this->load->view('permohonan/list_imb_adm', $data);
	}

	public function edit_persyaratan_slf_teknis($id_permohonan,$id_detail_jenis_persyaratan)
	{
		$data['id_detail_jenis_persyaratan']	= $id_detail_jenis_persyaratan;
		$data['disable']	= '';
		$data['jenis_permohonan'] = $this->mreferensi->get_jenis_permohonan_list($id_permohonan);	
		$data['query_syarat_selected'] = $this->mreferensi->get_syarat_selected($id_permohonan,$id_detail_jenis_persyaratan);
		$data['query_syarat_teknis']			= $this->mreferensi->get_syarat_parent('2');
		$data['id_persyaratan'] = $this->mreferensi->getIdPersyaratanImb('a.id_persyaratan', $id_permohonan,$id_detail_jenis_persyaratan);
		$this->load->view('permohonan/list_imb_teknis', $data);
		
	}

	// public public function save_persyaratan_imb()
	// {
	// 	$id_jenis_permohonan = $this->input->post('id_jenis_permohonan');	
	// 	$id_detail_jenis_persyaratan = $this->input->post('id_detail_jenis_persyaratan');
	// 	$id_jenis_persyaratan = $this->input->post('id_jenis_persyaratan');
	// 	// $jmlSyarat = $this->input->post('jmlSyarat');
	// 	// $jumSyaUp = $this->input->post('jumSyaUp');
		
	// 	$dataIn = array (
	// 					'id_jenis_permohonan' => $id_jenis_permohonan,
	// 					'id_jenis_persyaratan' => $id_jenis_persyaratan,
	// 					'id_detail_jenis_persyaratan' => $id_detail_jenis_persyaratan,
	// 				);
		
	// 	if (is_null($id) || trim($id) == '') {
	// 		//insert data baru
	// 		try {
	// 			$id_persyaratan = $this->msyarat->insert_syarat($dataIn);
	// 			for($i=0;$i<$jmlSyarat;$i++) {
	// 				$dataPersyaratan = array (
	// 								'id_persyaratan' => $id_persyaratan,
	// 								'id_syarat' => $this->input->post('id_syarat-'.$i)
	// 							);
	// 				if($this->input->post('id_syarat-'.$i) != ''){			
	// 					$this->msyarat->insert_syarat_detail($dataPersyaratan);
	// 				}
	// 			}
				
	// 			$this->session->set_flashdata('pesan', 'Data has been saved successfully');
	// 		}
	// 		catch (Exception $e) {
	// 			$this->session->set_flashdata('pesan', 'Data failed to saved');	
	// 		}
	// 	}
	// }

	

	public function jenis_permohonan_delete($id)
	{
		$process = $this->mglobals->deleteDataKey('tr_imb_permohonan', 'id_jenis_permohonan', $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Jenis Permohonan Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Jenis Permohonan Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('referensi/jenis_permohonan');
	}
	//End Referensi Jenis Permohonan
	//Begin Persyaratan Permohonan
	public function persyaratan()
	{
		$data['permohonan'] = $this->mreferensi->listDataPermohonanIMB('a.id_jenis_permohonan,a.nama_permohonan');
		$data['content']	= $this->load->view('persyaratan_permohonan/pengaturan_persyaratan_list', $data, TRUE);
		$data['title']		=	'Pengaturan Persyaratan';
		$data['heading']	=	'Edit Pengaturan Persyaratan';
		$this->load->view('backend', $data);
	}

	public function edit_persyaratan_permohonan($id)
	{
		// $value		= $this->input->post('value');
		// $data['disable']	= $this->input->post('disable') == 'N' ? '' : 'disabled';
		$data['disable']	= '';
		$data['query_syarat_selected'] = $this->mreferensi->get_syarat_selected($id);
		$data['query_syarat_adm']			= $this->mreferensi->get_syarat_parent('1');
		$data['query_syarat_teknis']			= $this->mreferensi->get_syarat_parent('2');
		// $data['query_adm'] 		= $this->mreferensi->ListPersyaratan($value,'checkbox','menu-list',$disable,'1');
		// $data['query_teknis'] 		= $this->mreferensi->ListPersyaratan($value,'checkbox','menu-list',$disable,'2');
		$data['row'] = $this->mreferensi->getDataEditPersyaratanPermohonanIMB('a.*', $id);
		// echo '<pre>';
		// print_r($data['row']);
		// var_dump($data['row']);
		$this->load->view('persyaratan_permohonan/form_edit_persyaratan_permohonan', $data);
	}


	public function listPersyaratanAdmShow()
	{
		$value		= $this->input->post('value');
		$disable	= $this->input->post('disable') == 'N' ? '' : 'disabled';
		$menu 		= $this->mreferensi->ListPersyaratan($value, 'checkbox', 'menu-list', $disable, '1');
		echo $menu;
	}

	public function listPersyaratanTeknisShow()
	{
		$value		= $this->input->post('value');
		$disable	= $this->input->post('disable') == 'N' ? '' : 'disabled';
		$menu 		= $this->mreferensi->ListPersyaratan($value, 'checkbox', 'menu-list', $disable, '2');
		echo $menu;
	}

	public function saveDataPersyaratanPermohonan()
	{
		$id_nama_permohonan		= $this->input->post('id');
		$id_detail_jenis_persyaratan	= $this->input->post('id_detail_jenis_persyaratan');
		if ($id_detail_jenis_persyaratan == 5) {
			$id_jenis_persyaratan = 1;
		} else{
			$id_jenis_persyaratan = 2;
		}
		$old_id_persyaratan		= $this->input->post('id_persyaratan');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');

		if ($dok_persyaratan != "") {
			$this->mreferensi->removeDataPersyaratanPermohonanImbAdmDetail($old_id_persyaratan);
			$this->mreferensi->removeDataPersyaratanPermohonanImbAdm($id_nama_permohonan,$id_detail_jenis_persyaratan);
			
				$data = array(
					'id_jenis_permohonan' => $id_nama_permohonan,
					'id_jenis_persyaratan' => $id_jenis_persyaratan,
					'id_detail_jenis_persyaratan' => $id_detail_jenis_persyaratan
				);
				$processInput = $this->mglobals->setData('tr_imb_persyaratan', $data, '', '');
				for ($i = 0; $i < count($dok_persyaratan); $i++) {
					
					$id_dokumen_permohonan = $dok_persyaratan[$i];

					$dataDetail	= array(
						'id_persyaratan' => $processInput,
						'id_syarat' => $id_dokumen_permohonan
					);

					$processInputDetail = $this->mglobals->setData('tr_imb_persyaratan_detail', $dataDetail, '', '');
				}
				if (!$processInputDetail) {
					$this->session->set_flashdata('message', 'Data Persyaratan Gagal di Ubah.');
					$this->session->set_flashdata('status', 'danger');
					redirect('referensi/form_edit_persyaratan_imb/'.$id_nama_permohonan);
				} else {
					$this->session->set_flashdata('message', 'Data Persyaratan Berhasil di Ubah.');
					$this->session->set_flashdata('status', 'success');
					redirect('referensi/form_edit_persyaratan_imb/'.$id_nama_permohonan);
				}
		}
	}

	public function persyaratan_permohonan_view($id = '')
	{
		if ($this->session->userdata('loc_user_id') == 1) {
			$id_kabkot				= '';
		} else {
			$id_kabkot				= $this->session->userdata('loc_id_kabkot');
		}
		$data['disable']	= $this->input->post('disable') == 'N' ? '' : 'disabled';
		// $data['query_syarat_adm']			= $this->mreferensi->get_syarat_parent($id_kabkot);
		$data['query_syarat_selected_view'] = $this->mreferensi->get_syarat_selected_view($id);
		$data['query_syarat_selected'] = $this->mreferensi->get_syarat_selected($id);
		$data['row'] = $this->mreferensi->getDataEditPersyaratanPermohonanIMB('a.*', $id);
		// var_dump($data['row']);
		$this->load->view('persyaratan_permohonan/view', $data);
	}
	//End Persyaratan Permohonan

	//Begin Referensi Perusahaan
	public function perusahaan()
	{
		echo "Perusahaan";
	}
	//End Referensi Perusahaan

	//Begin Personil ASN
	public function personal_asn()
	{
		$data['asn'] = $this->mreferensi->listDataPesonilAsn('a.id,a.nama_personal,a.glr_belakang');
		$data['content']	= $this->load->view('personal_pupr/personal_asn_list', $data, TRUE);
		$data['title']		=	'Daftar Personal ASN';
		$data['heading']	=	'Daftar Personal ASN';
		$this->load->view('backend', $data);
	}

	public function tambah_personil_form()
	{
		$data['list_personal'] 	= "";
		$data['daftar_provinsi']	= $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['daftar_kecamatan']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan');
		$data['daftar_kabkota']		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota');
		$data['daftar_pendidikan']	= $this->mreferensi->listDataPendidikan('id_pendidikan,pendidikan');
		$data['daftar_jurusan']	= $this->mreferensi->listDataJurusan('id_jurusan,nama_jurusan');
		$data['content']			= $this->load->view('personal_pupr/personal_form', $data, TRUE);
		$data['title']				=	'Form Tambah Personil';
		$data['heading']			=	'Form Tambah Personil';
		$this->load->view('backend', $data);
	}

	public function edit_personal_form()
	{
		$id	= $this->uri->segment(3);
		$data['id']	= $id;

		$data['daftar_provinsi']	= $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['daftar_kecamatan']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan');
		$data['daftar_kabkota']		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota');
		$data['daftar_pendidikan']	= $this->mreferensi->listDataPendidikan('id_pendidikan,pendidikan');
		$data['keahlian'] = $this->mreferensi->listDataBidang('a.id_bidang,a.nama_bidang');
		$data['asn'] = $this->mreferensi->listDataPesonilAsn('a.id,a.nama_personal');
		if ($id != '') {
			$data['asn'] = $this->mreferensi->listDataPesonilAsn('a.id,a.nama_personal');
			$data['daftar_provinsi']	= $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
			$data['daftar_kecamatan']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan');
			$data['daftar_kabkota']		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota');
		}
		$data['content']			= $this->load->view('personal_pupr/form_pegawai', $data, TRUE);
		$data['title']				=	'Edit Tambah Personil';
		$data['heading']			=	'Edit Tambah Personil';
		$this->load->view('user', $data);
	}

	public function saveDataPersonil()
	{
		$id	= $this->input->post('id');
		$glr_depan = $this->input->post('glr_depan');
		$nama_personal = $this->input->post('nama_personal');
		$glr_belakang = $this->input->post('glr_belakang');
		$no_ktp = $this->input->post('no_ktp');
		$alamat = $this->input->post('alamat');
		$id_kabkot = $this->input->post('id_kabkot');
		$no_kontak = $this->input->post('no_kontak');
		$email = $this->input->post('email');
		$stat = $this->input->post('stat');
		$id_provinsi = $this->input->post('id_provinsi');
		$id_kabkot = $this->input->post('id_kabkot');
		$id_kecamatan = $this->input->post('id_kecamatan');
		$data	= array(
			'glr_depan' => $glr_depan,
			'nama_personal' => $nama_personal,
			'glr_belakang' => $glr_belakang,
			'no_ktp' => $no_ktp,
			'alamat' => $alamat,
			'no_kontak' => $no_kontak,
			'email' => $email,
			'stat' => '1',
			'id_kabkot' => $id_kabkot,
			'id_provinsi' => $id_provinsi,
			'id_kecamatan' => $id_kecamatan,


		);

		if ($id != "") {
			$query		= $this->mglobals->setData('tm_personal', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data Jenis Permohonan Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('referensi/tambah_personil_form');
		} else {
			$query		= $this->mglobals->setData('tm_personal', $data, 'id', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Nama Personal Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('referensi/tambah_personil_form');
			} else {
				$this->session->set_flashdata('message', 'Data Nama Personal Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('referensi/tambah_personil_form');
			}
		}
	}

	public function saveDataPendidikan()
	{
		$id	= $this->uri->segment(3);
		$data['id']	= $id;
	}

	public function getDataJurusan()
	{
		$id_pendidikan	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->msetting->listDataJurusan('id_jurusan,nama_jurusan', '', $id_pendidikan);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_jurusan' => $row->id_jurusan, 'nama_jurusan' => $row->nama_jurusan);
			}
		}
		echo json_encode($value);
	}
	//End Personil ASN
	//Begin Personil Non ASN
	public function personal_non_asn()
	{
		$data['asn'] = $this->mreferensi->listDataPesonilNonAsn('a.id_personal,a.nama_personal');
		$data['content']	= $this->load->view('personal_non_pupr/personal_non_asn_list', $data, TRUE);
		$data['title']		=	'Daftar Personal Non ASN';
		$data['heading']	=	'Daftar Personal Non ASN';
		$this->load->view('backend', $data);
	}

	public function tambah_personil_ahli_form()
	{
		$data['daftar_pendidikan']	= $this->mreferensi->listDataPendidikan('id_pendidikan,pendidikan');
		$data['daftar_jurusan']	= $this->mreferensi->listDataJurusan('id_jurusan,nama_jurusan');
		$data['daftar_sub']	= $this->mreferensi->listDataSubUnsur('id_unsur_ahli,nama_unsur_ahli');
		$data['daftar_keahlian']	= $this->mreferensi->listDataKeahlian('id_unsur_keahlian,nama_keahlian');
		$data['content']			= $this->load->view('personal_non_pupr/personal_ahli_form', $data, TRUE);
		$data['title']				=	'Form Tambah Personil NON ASN';
		$data['heading']			=	'';
		$this->load->view('backend', $data);
	}
	//End Personil Non ASN
	//Begin SK TABG
	public function sk_tabg()
	{
		$data['list_tabg'] 	= $this->mreferensi->listDataTabg('a.id_personal,a.nama_personal');
		$data['content']			= $this->load->view('tabg/tabg_list', $data, TRUE);
		$data['title']				=	'Form SK TABG';
		$data['heading']			=	'';
		$this->load->view('backend', $data);
	}
	//End SK TABG

	//Begin Referensi Undang-undang
	public function uu()
	{
		$data['result'] = $this->mreferensi->listDatauu('a.id,a.uu');
		$data['content']	= $this->load->view('uu/daftar_uu', $data, TRUE);
		$data['title']		=	'Undang - Undang';
		$data['heading']	=	'';
		$this->load->view('backend', $data);
	}

	public function form_edit_uu($id)
	{
		$data['row'] = $this->mreferensi->getDataEdituu('a.*', $id);
		$this->load->view('uu/form_edit_uu', $data);
	}

	public function saveDatauu()
	{
		$id	= $this->input->post('id');
		$nama_dokumen_permohonan = $this->input->post('nama_uu');
		//$id_jenis_dok_permohonan = $this->input->post('id_jenis_dok_permohonan');
		//$id_sub_jenis_dok_permohonan = $this->input->post('id_sub_jenis_dok_permohonan');
		$status = $this->input->post('status');

		$data	= array(
			'uu' => $nama_dokumen_permohonan,


		);

		if ($id != "") {
			$query		= $this->mglobals->setData('tr_uu', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('referensi/uu');
		} else {

			$query		= $this->mglobals->setData('tr_uu', $data, '', '');
			if ($query) {
				$this->session->set_flashdata('message', 'Data uu Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('referensi/uu');
			} else {
				$this->session->set_flashdata('message', 'Data uu Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('referensi/uu');
			}
		}
	}

	public function removeDatauu($id)
	{
		$process = $this->mreferensi->removeDatauu($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Nama Dokumen uu Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Nama Dokumen uu Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('referensi/uu');
	}
	//End Referensi Dokumen Undang-undang

	//Begin Logo Dinas
	// public function logo_dinas()
	// {
	// 	$data = array (
	// 				'title'    => 'Add/Edit Album',
	// 				'picturelist' => $this->mreferensi->GetPictureList()
	// 				//'record' => $this->Mreferensi->GetAlbumDetails()
	// 		);
	// 		$data['content']	= $this->load->view('logo_dinas/logo_list',$data,TRUE);
	// 		$data['title']		=	'List Logo Dinas';
	// 		$data['heading']	=	'';
	// 	$this->load->view('backend',$data);
	// }

	// public function do_upload() {
	//       $upload_path_url = base_url() . 'uploads/gallery/';
	//
	//       $config['upload_path'] = './uploads/gallery';
	//       $config['allowed_types'] = 'jpg|jpeg|png|gif';
	//       $config['max_size'] = '30000';
	//
	//       $this->load->library('upload', $config);
	//
	//       if (!$this->upload->do_upload()) {
	//           //$error = array('error' => $this->upload->display_errors());
	//           //$this->load->view('upload', $error);
	//
	//           //Load the list of existing files in the upload directory
	//           $existingFiles = get_dir_file_info($config['upload_path']);
	//           $foundFiles = array();
	//           $f=0;
	//           foreach ($existingFiles as $fileName => $info) {
	//             if($fileName!='thumbs'){//Skip over thumbs directory
	//               //set the data for the json array
	//               $foundFiles[$f]['name'] = $fileName;
	//               $foundFiles[$f]['size'] = $info['size'];
	//               $foundFiles[$f]['url'] = $upload_path_url . $fileName;
	//               $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
	//               $foundFiles[$f]['deleteUrl'] = base_url() . 'referensi/deleteImage/' . $fileName;
	//               $foundFiles[$f]['deleteType'] = 'DELETE';
	//               $foundFiles[$f]['error'] = null;
	//
	//               $f++;
	//             }
	//           }
	//           $this->output
	//           ->set_content_type('application/json')
	//           ->set_output(json_encode(array('files' => $foundFiles)));
	//       } else {
	//           $data = $this->upload->data();
	//           // to re-size for thumbnail images un-comment and set path here and in json array
	//           $config = array();
	//           $config['image_library'] = 'gd2';
	//           $config['source_image'] = $data['full_path'];
	//           $config['create_thumb'] = TRUE;
	//           $config['new_image'] = $data['file_path'] . 'thumbs/';
	//           $config['maintain_ratio'] = TRUE;
	//           $config['thumb_marker'] = '';
	//           $config['width'] = 75;
	//           $config['height'] = 50;
	//           $this->load->library('image_lib', $config);
	//           $this->image_lib->resize();
	//
	//
	//           //set the data for the json array
	//           $info = new StdClass;
	//           $info->name = $data['file_name'];
	// 					$info->rawname = $data['raw_name'];
	//           $info->size = $data['file_size'] * 1024;
	//           $info->type = $data['file_type'];
	//           $info->url = $upload_path_url . $data['file_name'];
	//           // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
	//           $info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
	//           $info->deleteUrl = base_url() . 'referensi/deleteImage/' . $data['file_name'];
	//           $info->deleteType = 'DELETE';
	//           $info->error = null;
	//
	//           $files[] = $info;
	//           //this is why we put this in the constants to pass only json data
	//           if ($this->input->is_ajax_request()) {
	//               echo json_encode(array("files" => $files));
	//               //this has to be the only data returned or you will get an error.
	//               //if you don't give this a json array it will give you a Empty file upload result error
	//               //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
	//               // so that this will still work if javascript is not enabled
	//           } else {
	//               $file_data['upload_data'] = $this->upload->data();
	//           }
	//
	// 					if( $this->input->post('process') == 'true' ) {
	// 				            $this->mreferensi->Save($info->name,$info->rawname);
	// 				  }
	//
	//       }
	//   }
	//
	//   public function deleteImage($file) {
	// 			$this->mreferensi->Delete($file);
	// 		//gets the job done but you might want to add error checking and security
	//       $success = unlink(FCPATH . 'uploads/gallery/' . $file);
	//       $success = unlink(FCPATH . 'uploads/gallery/thumbs/' . $file);
	//       //info to see if it is doing what it is supposed to
	//   	$info = new StdClass;
	//       $info->sucess = $success;
	//       $info->path = base_url() . 'uploads/gallery/' . $file;
	//       $info->file = is_file(FCPATH . 'uploads/gallery' . $file);
	//
	//       if ($this->input->is_ajax_request()) {
	//           //I don't think it matters if this is set but good for error checking in the console/firebug
	//           echo json_encode(array($info));
	//       } else {
	//           //here you will need to decide what you want to show for a successful delete
	//           $file_data['delete_data'] = $file;
	//       }
	//   }
	//End Logo Dinas

	public function logo_dinas()
	{

		$data = array(
			'title'    => 'Add/Edit Album',
			'picturelist' => $this->mreferensi->GetPictureList()
			//'record' => $this->Mreferensi->GetAlbumDetails()
		);
		$data['content']	= $this->load->view('logo_dinas/logo_list', $data, TRUE);
		$data['title']		=	'List Logo Dinas';
		$data['heading']	=	'';
		$this->load->view('backend', $data);
	}

	public function do_upload()
	{
		$upload_path_url = base_url() . 'uploads/gallery/';

		$config['upload_path'] = './uploads/gallery';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = '30000';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload()) {
			//$error = array('error' => $this->upload->display_errors());
			//$this->load->view('upload', $error);

			//Load the list of existing files in the upload directory
			// $existingFiles = get_dir_file_info($config['upload_path']);
			// $foundFiles = array();
			// $f=0;
			// foreach ($existingFiles as $fileName => $info) {
			// 	if($fileName!='thumbs'){//Skip over thumbs directory
			// 		//set the data for the json array
			// 		$foundFiles[$f]['name'] = $fileName;
			// 		$foundFiles[$f]['size'] = $info['size'];
			// 		$foundFiles[$f]['url'] = $upload_path_url . $fileName;
			// 		$foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
			// 		$foundFiles[$f]['deleteUrl'] = base_url() . 'referensi/deleteImage/' . $fileName;
			// 		$foundFiles[$f]['deleteType'] = 'DELETE';
			// 		$foundFiles[$f]['error'] = null;
			//
			// 		$f++;
			// 	}
			// }
			// $this->output
			// ->set_content_type('application/json')
			// ->set_output(json_encode(array('files' => $foundFiles)));
		} else {
			$data = $this->upload->data();
			// to re-size for thumbnail images un-comment and set path here and in json array
			$config = array();
			$config['image_library'] = 'gd2';
			$config['source_image'] = $data['full_path'];
			$config['create_thumb'] = TRUE;
			$config['new_image'] = $data['file_path'] . 'thumbs/';
			$config['maintain_ratio'] = TRUE;
			$config['thumb_marker'] = '';
			$config['width'] = 75;
			$config['height'] = 50;
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();


			//set the data for the json array
			$info = new StdClass;
			$info->name = $data['file_name'];
			$info->rawname = $data['raw_name'];
			$info->size = $data['file_size'] * 1024;
			$info->type = $data['file_type'];
			$info->url = $upload_path_url . $data['file_name'];
			// I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
			$info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
			$info->deleteUrl = base_url() . 'referensi/deleteImage/' . $data['file_name'];
			$info->deleteType = 'DELETE';
			$info->error = null;

			$files[] = $info;
			//this is why we put this in the constants to pass only json data
			if ($this->input->is_ajax_request()) {
				echo json_encode(array("files" => $files));
				//this has to be the only data returned or you will get an error.
				//if you don't give this a json array it will give you a Empty file upload result error
				//it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
				// so that this will still work if javascript is not enabled
			} else {
				$file_data['upload_data'] = $this->upload->data();
			}

			if ($this->input->post('process') == 'true') {
				$this->mreferensi->Save($info->name, $info->rawname);
			}
		}
	}

	public function deleteImage($file)
	{
		$this->mreferensi->Delete($file);
		//gets the job done but you might want to add error checking and security
		$success = unlink(FCPATH . 'uploads/gallery/' . $file);
		$success = unlink(FCPATH . 'uploads/gallery/thumbs/' . $file);
		//info to see if it is doing what it is supposed to
		$info = new StdClass;
		$info->sucess = $success;
		$info->path = base_url() . 'uploads/gallery/' . $file;
		$info->file = is_file(FCPATH . 'uploads/gallery' . $file);

		if ($this->input->is_ajax_request()) {
			//I don't think it matters if this is set but good for error checking in the console/firebug
			echo json_encode(array($info));
		} else {
			//here you will need to decide what you want to show for a successful delete
			$file_data['delete_data'] = $file;
		}
	}
}
