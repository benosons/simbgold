<?php


if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Pengawas
 * 
 * Modules untuk menampilkan data penjadwalan & penilaian sidang PBG
 */

class Pengawas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('utility');
		$this->load->model(array('Mpenjadwalan', 'Mpengawas', 'mglobal'));
		$this->load->library(['oss_lib', 'simbg_lib']);
		$this->simbg_lib->check_session_login();
	}
	// Begin  Validasi Data 
	public function Validasi()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Validasi'] = $this->Mpengawas->getListValidasi(null, $SQLcari);
		$data['content']	= $this->load->view('Validasi/ValidasiList', $data, TRUE);
		$data['title']		=	'Validasi Data';
		$data['heading']	=	'';
		$this->load->view('backend_adm', $data);
	}

	public function FormValidasi()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->Mpengawas->getDataValidasi($id);
		$data['data'] 		= $query->row();
		$data['DataTanah']	= $this->Mpengawas->getTanahVerifikasi($id);
		$data['DataHis']	= $this->Mpengawas->getHis('a.*, b.status_admin,c.username', $id);
		$this->getDataUmum();
		$this->getDataTanah();
		$this->getDataArsitektur();
		$this->getDataStruktur();
		$this->getDataMEP();
		$permohonan = $this->Mpengawas->getDataJnsKonsultasi('a.*',$id)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		//Begin Data Teknis Tanah
		$data['DataTeknisTanah']	= $this->Mpengawas->getDataDokumen('a.*',$id);
		$filterQuery				= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan';
		$data['DataUmumTanah']		= $this->Mpengawas->getDataTanah($filterQuery,$id_jenis_permohonan);
		//End Data Teknis Tanah
		$this->load->view('Validasi/FormValidasi', $data);
	}
	
	function getDataTanah()
	{
		$id= $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mpengawas->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mpengawas->getSyaratList($id_j_per,'1',null);			
		$data['jum_data'] = $query->num_rows();		
		$data['results_tnh'] = $query->result();
		$this->load->view('kosong',$data);
	}
	
	function getDataUmum()
	{
		$id= $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mpengawas->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mpengawas->getSyaratList($id_j_per,'5',null);			
		$data['jum_data'] = $query->num_rows();		
		$data['results_umum'] = $query->result();
		$this->load->view('kosong',$data);
	}
	
	public function getDataArsitektur()
	{
		$id= $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mpengawas->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mpengawas->getSyaratList($id_j_per,'2',null);			
		$data['jum_data'] = $query->num_rows();		
		$data['results_Ars'] = $query->result();
		$this->load->view('kosong',$data);
	}
	
	public function getDataStruktur()
	{
		$id= $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mpengawas->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mpengawas->getSyaratList($id_j_per,'3',null);			
		$data['jum_data'] = $query->num_rows();		
		$data['results_Str'] = $query->result();
		$this->load->view('kosong',$data);
	}
	
	public function getDataMEP()
	{
		$id= $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mpengawas->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mpengawas->getSyaratList($id_j_per,'4',null);			
		$data['jum_data'] = $query->num_rows();		
		$data['results_MEP'] = $query->result();
		$this->load->view('kosong',$data);
	}
	
	public function check_status_tanah()
	{
		$id= $this->uri->segment(3);
		$id_detail= $this->uri->segment(4);
		$data['id'] = $id;
		$dataIn = array ('status_verifikasi_tanah' => '1');
		try
		{
			$this->Mpengawas->updateVerifikasiTanah($dataIn,$id_detail);
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		}catch(Exception $e) 
		{
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
	}
	public function uncheck_status_tanah()
	{
		$id= $this->uri->segment(3);
		$id_detail= $this->uri->segment(4);
		$data['id'] = $id;
		$dataIn = array ('status_verifikasi_tanah' => null);
		try
		{
			$this->Mpengawas->updateVerifikasiTanah($dataIn,$id_detail);
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		}catch(Exception $e) 
		{
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
	}
	
	function check_status()
	{
		$id= $this->uri->segment(3);
		$id_persyaratan_detail= $this->uri->segment(4);
		$key_syarat = $this->uri->segment(5);
		$data['id'] = $id;
		$dataIn = array ('status' => '1');
		try
		{
			$id_detail =  $this->Mpengawas->updateValidasi($dataIn,$id,$id_persyaratan_detail);
			if($id_detail != $id_persyaratan_detail){
				$dataIsi = array (
						'id' => $id,
						'id_persyaratan_detail' => $id_persyaratan_detail,
						'status' => '1'
						);
				$this->Mpengawas->insert_syarat($dataIsi); // Sudah tersedia
			}
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
			
		}catch(Exception $e) 
		{
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
		$permohonan = $this->Mpengawas->getPermohonan($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$data['pernyataan'] = $permohonan['pernyataan'];
		$queryCekJum_syarat = $this->Mpengawas->getSyaratList($id_j_per,null)->result();
		if($key_syarat == 'adm'){
			$query = $this->Mpengawas->getSyaratList($id_j_per,'1');
		}else if ($key_syarat == 'tek'){
			$query = $this->Mpengawas->getSyaratList($id_j_per,'2');
		}
		$data['jum_data'] = $query->num_rows();		
		$data['results'] = $query->result();
		$data['model_permohonan'] = $this->Mpengawas;
	}
	
	function uncheck_status()
	{
		$id= $this->uri->segment(3);
		$id_persyaratan_detail= $this->uri->segment(4);
		$key_syarat = $this->uri->segment(5);
		$data['id'] = $id;
		$dataIn = array ('status' => null);
		try {
			$this->Mpengawas->updateValidasi($dataIn,$id,$id_persyaratan_detail);
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		}catch(Exception $e) {
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
		$permohonan = $this->Mpengawas->getPermohonan($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$data['pernyataan'] = $permohonan['pernyataan'];
		$queryCekJum_syarat = $this->Mpengawas->getSyaratList($id_j_per,null)->result();
		if($key_syarat == 'adm'){
			$query = $this->Mpengawas->getSyaratList($id_j_per,'1');
		}else if ($key_syarat == 'tek'){
			$query = $this->Mpengawas->getSyaratList($id_j_per,'2');
		}
		$data['jum_data'] = $query->num_rows();		
		$data['results'] = $query->result();
		$data['model_permohonan'] = $this->Mpengawas;
	}
	
	public function status_dt_val()
	{
		$user_id		= $this->session->userdata('loc_user_id');
		$user_id		= $this->Outh_model->Encryptor('decrypt', $user_id);
		$status			= $this->input->post('status_syarat');
		$no_surat			= $this->input->post('no_surat');
		$catatan			= $this->input->post('catatan');
		$id_pemilik			= $this->input->post('id_pemilik');
		$tgl_skrg 		= date('Y-m-d');
		if ($status == '1') {
			$data	= array(
				'tgl_status' => $tgl_skrg,
				'status' => '4',
				'no_surat' => $no_surat,
				'id_pemilik' => $id_pemilik,
				'catatan' => $catatan,
				'user_id' => $user_id,
				'modul' => 'validasi'
			);
		} else {
			$data	= array(
				'tgl_status' => $tgl_skrg,
				'status' => '3',
				'pernyataan' => '',
				'no_surat' => $no_surat,
				'id_pemilik' => $id_pemilik,
				'catatan' => $catatan,
				'user_id' => $user_id,
				'modul' => 'validasi'
			);
		}
		$this->mglobals->setData('tmdatabangunan', ['status' => $data['status']], 'id', $id_pemilik);
		$this->mglobals->setDatakol('th_data_konsultasi', $data);
		$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
		$this->session->set_flashdata('status', 'success');
		redirect('Pengawas/Validasi');
	}
	// End Validasi Data
	// Begin Penugasan Pemeriksa Dokumen
	public function penugasan()
	{
		$id_fungsi_bg = $this->input->get('id_fungsi_bg', TRUE);
		$id_proses = $this->input->get('id_proses', TRUE);
		$tanggalawal = $this->input->get('tanggalawal', TRUE);
		$tanggalakhir = $this->input->get('tanggalakhir', TRUE);
		$SQLcari 	= "";
		$data['title']		=	'Penugasan Tim Teknis';
		$data['heading']	=	'';
		$search = $this->search([$id_fungsi_bg, $id_proses, $tanggalawal, $tanggalakhir]);
		$data['Penugasan'] = !isset($_GET['cari']) ? $this->Mpengawas->getDataPenugasan(null, $SQLcari)->result() : $search;
		$data['content']	= $this->load->view('Penugasan/PenugasanList', $data, TRUE);
		$this->load->view('backend_adm', $data);
	}

	private function search($post = [])
	{
		// var_dump($post); die;
		$fungsi_bg = $post[0];
		$proses = $post[1];
		$d1 = $post[2];
		$d2 = $post[3];
		$tglAwal =  date("Y-m-d", strtotime($d1));
		$tglAkhir = date("Y-m-d", strtotime($d2));
		if ($tglAwal && $tglAkhir != NULL) {
			if (intval($fungsi_bg) === 0 && intval($proses) === 0) {
				$query = $this->Mpengawas->getPenugasanAll($tglAwal, $tglAkhir)->result();
			} else if (intval($fungsi_bg) !== 0 && intval($proses) === 0) {
				$query = $this->Mpengawas->findFungsi($fungsi_bg, $tglAwal, $tglAkhir)->result();
			} else if (intval($fungsi_bg) === 0 && intval($proses) !== 0) {
				$query = $this->Mpengawas->findProses($proses, $tglAwal, $tglAkhir)->result();
			} else {
				$query = $this->Mpengawas->findAll($fungsi_bg, $proses, $tglAwal, $tglAkhir)->result();
			}
		} else {
			$SQLcari 	= "";
			$query = $this->Mpengawas->getDataPenugasan(null, $SQLcari)->result();
		}
		return $query;
	}


	public function FormPenugasan($id = NULL)
	{
		$id = $this->uri->segment(3);
		$que = $this->Mpengawas->getDetailPengawas($id)->row_array();
		$id_kabkot = $que['id_kabkot_bgn'];
		$rew   = $this->Mpengawas->getByIdPtugas($id);
		// var_dump($rew->result(	)); die;	
		$id_fbg = $que['id_fungsi_bg'];
		$result = $id_fbg == 1 ? $this->Mpengawas->getTimTeknis($id_kabkot) : $this->Mpengawas->getTimTabg($id_kabkot);
		$data = array(
			'judul' => $id_fbg == 1 ? 'Pilih Tim Tim Teknis' : 'Pilih Tim TABG',
			'result' => $result->result(),
			'que' => $que,
			'rew' => $rew,
		);

		$this->load->view('pengawas/penugasan/FormPenugasan', $data);
	}

	function detailpenugasan($id = NULL)
	{
		$cekId = $this->Mpengawas->getdetailPenugasan($id);
		$rew   = $this->Mpengawas->getByIdPtugas($id);
		if ($cekId->num_rows() > 0) {

			$row = $cekId->row();
			$id_fbg = $row->id_fungsi_bg;
			$id_kabkot = $row->id_kabkot_bgn;
			$result = $id_fbg == 1 ? $this->Mpengawas->getTimTeknis($id_kabkot) : $this->Mpengawas->getTimTabg($id_kabkot);
			$data = array(
				'row' => $row,
				'rew' => $rew,
				'id_fbg' => $id_fbg,
				'result' => $result->result(),
			);
			$this->load->view('pengawas/penugasan/penugasan_detail', $data);
		} else {
			echo 'tidak ditemukan';
		}
	}

	function export_pdf()
	{
		$this->load->library('F_pdflib');
		$SQLcari = "";
		$id_fungsi_bg = $this->input->get('id_fungsi_bg', TRUE);
		$id_proses = $this->input->get('id_proses', TRUE);
		$tanggalawal = $this->input->get('tanggalawal', TRUE);
		$tanggalakhir = $this->input->get('tanggalakhir', TRUE);
		$SQLcari 	= "";
		$search = $this->search([$id_fungsi_bg, $id_proses, $tanggalawal, $tanggalakhir]);
		$penugasan = !isset($_GET['cari']) ? $this->Mpengawas->getDataPenugasan(null, $SQLcari)->result() : $search;

		$data = ['penugasan' => $penugasan];
		$this->load->view('pengawas/penugasan/penugasan_pdf', $data);
	}

	function hapusPenugasan($id_petugas, $id_pemilik)
	{
		$process = $this->mglobals->deleteDataKey('tm_penugasan_pbg', 'id_personal', $id_petugas);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$cekPetugas = $this->Mpengawas->cekTotalPetugas($id_pemilik);
			if ($cekPetugas->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
				$this->session->set_flashdata('status', 'success');
			} else {
				$tgl_log = date('Y-m-d');
				$data = array(
					'status' => 3,
					'post_date' => $tgl_log,
					'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
				);
				$this->Mpengawas->updateStats($data, $id_pemilik);
				$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
				$this->session->set_flashdata('status', 'success');
			}
		}
		redirect('pengawas/penugasan');
	}
	function form_penugasan($id_permohonan)
	{
		$id = $this->uri->segment(3);
		$raw   = $this->imb_model->getById($id_permohonan);
		$rew   = $this->imb_model->getByIdPtugas($id_permohonan);
		$que = $this->imb_model->get_permohonan($id)->row_array();
		$id_kabkot = $que['id_kabkot_bg'];
		$id_fbg = $que['id_fungsi_bg'];
		$result = $id_fbg == 1 ? $this->imb_model->getTimTeknis($id_kabkot) : $this->imb_model->getTimTabg($id_kabkot);
		$data = array(
			'judul' => $id_fbg == 1 ? 'Pilih Tim Tim Teknis' : 'Pilih Tim TABG',
			'result' => $result->result(),
			'raw' => $raw,
			'rew' => $rew,
		);
		$this->load->view('penugasan/penugasan_form', $data);
	}

	public function SimpanPenugasan()
	{
		$id_pemilik = $this->input->post('id_pemilik');
		$tugas_personil = $this->input->post('tugas');
		if ($tugas_personil != NULL) {
			foreach ($tugas_personil as $key => $val) {
				$res[] = $val;
			}
			$k = array_unique($res);
			$cekPersonil = 	$this->Mpengawas->cekPersonalPenugasan($id_pemilik, $k);
			if ($cekPersonil->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Personil Sudah Terpilih!');
				$this->session->set_flashdata('status', 'warning');
				redirect('pengawas/penugasan');
			} else {
				foreach ($tugas_personil as $key => $val) {
					$dataP[] = array(
						'id_personal' => $val,
						'id_pemilik' => $id_pemilik
					);
				}
				$tgl_log = date('Y-m-d');
				$data = array(
					'status' => 4,
					'post_date' => $tgl_log,
					'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
				);
				$this->Mpengawas->insertBatchPersonil($dataP);
				$this->Mpengawas->updateStats($data, $id_pemilik);
				$this->session->set_flashdata('message', 'Data Penugasan Berhasil di Simpan');
				$this->session->set_flashdata('status', 'success');
				redirect('pengawas/penugasan');
			}
		} else {
			$this->session->set_flashdata('message', 'Silahkan Pilih Tim Terlebih Dahulu!');
			$this->session->set_flashdata('status', 'warning');
			redirect('pengawas/penugasan');
		}
	}
	// End Penugasan Pemeriksa Dokumen
	// Begin Penjadwalan Konsultasi Dokumen
	public function penjadwalan()
	{
		$data['datapbg']   = $this->Mpenjadwalan->getPBGPenjadwalan();
		$data['content']	= $this->load->view('Penjadwalan/penjadwalan_list', $data, TRUE);
		$data['title']		=	'Penjadwalan Konsultasi Bangunan Gedung';
		$data['heading']	=	'';
		$this->load->view('backend_adm', $data);
	}

	public function sidang($id = NULL)
	{
		$getId = $this->Mpenjadwalan->get_permohonan_list($id);
		if ($getId->num_rows() > 0) {
			$row = $getId->row();
			$pengawasSidang   = $this->Mpengawas->getByIdPtugas($row->id_pemilik);
			$countJadwal = $this->Mpenjadwalan->getCountJadwal($row->id_pemilik)->num_rows();
			$nextSidang = $countJadwal + 1;
			$getPenjadwalanList = $this->Mpenjadwalan->getPenjadwalanById($row->id_pemilik);
			$daftar_provinsi = $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
			$daftar_kabkota = $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $row->id_provinsi);
			$daftar_kecamatan = $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $row->id_kabkota);
			$daftar_provinsi_bg = $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
			$daftar_kabkota_bg = $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $row->id_prov_bgn);
			$daftar_kecamatan_bg = $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $row->id_kabkot_bgn);
			$get_konsultasi = $this->mglobal->listDataKonsultasi('a.id,a.nm_konsultasi');
			$get_fungsi = $this->mglobal->listDataFungsiBg('a.id_fungsi_bg,a.fungsi_bg');
			$data = array(
				'nextSidang' => $nextSidang,
				'id' => $id,
				'id_konsultasi' => $row->id_pemilik,
				'no_konsultasi' => $row->no_konsultasi,
				'nm_pemilik' => $row->nm_pemilik,
				'alamat' => $row->alamat,
				'nama_kecamatan' => $row->nama_kecamatan,
				'nama_kabkota' => $row->nama_kabkota,
				'nm_konsultasi' => $row->nm_konsultasi,
				'nama_kec_bg' => $row->nama_kec_bg,
				'pengawas' => $pengawasSidang->result(),
				'nama_kabkota_bg' => $row->nama_kabkota_bg,
				'nama_provinsi_bg' => $row->nama_provinsi_bg,
				'fungsi_bg' => $row->fungsi_bg,
				'jns_bangunan' => $row->jns_bangunan,
				'almt_bgn' => $row->almt_bgn,
				'tinggi_bgn' => $row->tinggi_bgn,
				'luas_bgn' => $row->luas_bgn,
				'jml_lantai' => $row->jml_lantai,
				'email' => $row->email,
				'list_jadwal' => $getPenjadwalanList->result(),
				'id_provinsi' => $row->id_provinsi,
				'id_kabkota' => $row->id_kabkota,
				'id_kecamatan' => $row->id_kecamatan,
				'daftar_provinsi' => $daftar_provinsi,
				'daftar_kabkota' => $daftar_kabkota,
				'daftar_kecamatan' => $daftar_kecamatan,
				'daftar_provinsi_bg' => $daftar_provinsi_bg,
				'daftar_kabkota_bg' => $daftar_kabkota_bg,
				'daftar_kecamatan_bg' => $daftar_kecamatan_bg,
				'nm_bgn' => $row->nm_bgn,
				'id_prov_bgn' => $row->id_prov_bgn,
				'id_kabkot_bgn' => $row->id_kabkot_bgn,
				'id_kec_bgn' => $row->id_kec_bgn,
				'get_konsultasi' => $get_konsultasi,
				'id_jenis_permohonan' => $row->id_jenis_permohonan,
				'get_fungsi' => $get_fungsi,
				'luas_basement' => $row->luas_basement,
				'lapis_basement' => $row->lapis_basement,
			);
			//end get data penjadwalan
			if (!is_null($id) && (trim($id) != '') && !$this->input->post('save') && (trim($id) != '0')) {
				$query = $this->Mpenjadwalan->get_permohonan_list($id);
				$mydata = $query->row_array();
				$baris = $query->num_rows();
				if ($baris >= 1) {
					$data['id_jenis_permohonan'] = $mydata['id_jenis_permohonan'];
					$data['nm_konsultasi'] = $mydata['nm_konsultasi'];
					$data['id_pemilik'] = $mydata['id_pemilik'];
					$data['id_fungsi_bg'] = $mydata['id_fungsi_bg'];
					$data['nama'] = $mydata['nm_pemilik'];
					$data['jalan'] = $mydata['alamat'];
					$data['kecamatan'] = $mydata['nama_kecamatan'];
					$data['id_kec'] = $mydata['id_kecamatan'];
					$data['nama_kec'] = $mydata['nama_kecamatan'];
					$data['id_kabkot'] = $mydata['id_kabkota'];
					$data['nama_kabkota'] = $mydata['nama_kabkota'];
					$data['id_provinsi'] = $mydata['id_provinsi'];
					$data['nama_provinsi'] = $mydata['nama_provinsi'];
					$data['no_tlpn'] = $mydata['no_hp'];
					$data['email'] = $mydata['email'];
					$data['ktp'] = $mydata['no_ktp'];
					$data['nm_pemilik'] = $mydata['nm_pemilik'];
					$data['alamat_pershn'] = $mydata['alamat'];
					$data['no_tlpn_pershn'] = $mydata['no_hp'];
					$data['jalan_lokasi'] = $mydata['almt_bgn'];
					$data['kec'] = $mydata['nama_kecamatan'];
					$data['nama_kec_bg'] = $mydata['nama_kec_bg'];
					$data['id_kabkot_bg'] = $mydata['id_prov_bgn'];
					$data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
					$data['id_provinsi_bg'] = $mydata['id_prov_bgn'];
					$data['nama_provinsi_bg'] = $mydata['nama_provinsi_bg'];
					$data['tgl_permohonan'] = $mydata['tgl_pernyataan'];
					$data['stat'] = $mydata['status'];
					$data['luas_bgn'] = $mydata['luas_bgn'];
					$data['tinggi'] = $mydata['tinggi_bgn'];
					$data['lantai'] = $mydata['jml_lantai'];
					$data['fungsi_bg'] = $mydata['fungsi_bg'];
					$data['jns_bangunan'] = $mydata['jns_bangunan'];
					$data['status_syarat'] = $mydata['status'];
					$data['nomor_registrasi'] = $mydata['nm_konsultasi'];
					$data['luas_prasarana'] = $mydata['luas_bgn'];
					$data['tinggi_prasarana'] = $mydata['tinggi_bgn'];
					$data['id_jenis_bg'] = $mydata['jns_bangunan'];
					$que_detail = $this->Mpengawas->getByIdPtugas($id);
					$data['jmlPegawai'] = $que_detail->num_rows();
					$data['result_peg'] = $que_detail->result_array();
				}
				$data['mpermohonan'] = $this->Mpengawas;
				$data['con_set'] = $this;
			}
			$data['title']		=	'Penjadwalan Konsultasi';
			$data['heading']		=	'';
			$this->load->view('penjadwalan/form_penjadwalan', $data);
		} else {	
		}
	}


	public function jadwal_form($id = NULL)
	{
		$sidang_ke = $this->input->post('sidang_ke', TRUE);
		$tanggal_sidang = $this->input->post('tanggal_sidang', TRUE);
		$jam_sidang = $this->input->post('jam_sidang', TRUE);
		$ketempat = $this->input->post('ketempat', TRUE);
		$noreg = $this->input->post('noreg', TRUE);
		$primary = $this->input->post('id', TRUE);
		$thisdir = getcwd();
		$dirPath = $thisdir . "/file/PBG/$noreg/sidang/undangan_sidang/";
		if (!file_exists($dirPath)) {
			//mkdir($dirPath, 0755, true);
  //create directory if not exist
		}
		$config['upload_path'] 		= $dirPath;
		$config['allowed_types'] 		= 'pdf|PDF';
		$config['max_size']			= '5120000';
		$config['encrypt_name']		= TRUE;
		$config['remove_space']		= TRUE;
		$this->load->library('upload', $config, 'uploads');

		if (!$this->uploads->do_upload('berkas')) {
			$this->session->set_flashdata('message', 'Silahkan Upload File Undangan Sidang Terlebih Dahulu!.');
			$this->session->set_flashdata('status', 'danger');
			redirect("pengawas/penjadwalan", "refresh");
		} else {
			if ($this->uploads->data('file_ext') != ".pdf") {
				$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
				$this->session->set_flashdata('status', 'warning');
				$path = FCPATH . "/file/PBG/{$noreg}/sidang/undangan_sidang/";
				$berkas = $path . $this->uploads->data('file_name');
				if (!unlink($berkas)) {
					$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
					$this->session->set_flashdata('status', 'warning');
				}
				redirect("pengawas/penjadwalan", "refresh");
			} else {
				$data = array(
					'id' => $primary,
					'konsultasi' => $sidang_ke,
					'tgl_konsultasi' => $tanggal_sidang,
					'jam_konsultasi' => $jam_sidang,
					'ket_konsultasi' => $ketempat,
					'dir_file_undangan' => $this->uploads->data('file_name')
				);
				$jadwal = array(
					'id' => $primary,
					'id_stsjadwal' => 2
				);
				$this->Mpenjadwalan->insertDataSidang($data);
				$this->Mpenjadwalan->insertStatusSidang($jadwal);
				$this->session->set_flashdata('message', 'Penjadwalan Sidang Berhasil Disimpan!');
				$this->session->set_flashdata('status', 'success');
				redirect("pengawas/penjadwalan", "refresh");
			}
		}
	}
	// End Begin Penjadwalan
}
