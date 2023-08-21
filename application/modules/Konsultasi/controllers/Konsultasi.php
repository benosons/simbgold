<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Konsultasi extends CI_Controller
{
	protected $pathRetribusi = 'object-storage/file/Konsultasi/pembayaran_retribusi/';
	protected $pathBerkas = 'object-storage/dekill/Requirement/';
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->load->model('Mkonsultasi');
		$this->load->library('Simbg_lib');
		$this->load->helper('utility');
		$this->simbg_lib->check_session_login();
	}
	public function index()
	{
		$this->DataKonsultasi();
	}
	//Begin Data List Konsultasi
	public function DataKonsultasi($user_id = null)
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$data['user_id'] 		= $this->Outh_model->Encryptor('decrypt', $user_id);
		$user_id				= $this->Outh_model->Encryptor('decrypt', $user_id);
		$filterQuery			= 'a.*, b.no_konsultasi,b.pernyataan,b.status, b.almt_bgn,b.id_izin,c.nm_konsultasi,d.status_pemohon';
		$data['DataKonsultasi'] = $this->Mkonsultasi->getDataKonsultasi($filterQuery, $user_id);
		$queFungsi = $this->Mkonsultasi->get_jenis_fungsi_list()->result();
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) {
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$queJenisP = $this->Mglobals->getData('*', 'tm_jenis_permohonan')->result();
		$list_JnsPer[''] = '--Pilih--';
		foreach ($queJenisP as $row) {
			$list_JnsPer[$row->id_jns_permohonan] = $row->nm_jns_permohonan;
		}
		$data['list_JnsPer'] = $list_JnsPer;
		$filterPemilik	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
		$data['DataBangunan'] 	= $this->Mkonsultasi->getBangunan($filterPemilik, 0);
		$data['list_fungsi'] = $list_fungsi;
		$data['content'] = $this->load->view('Konsultasi/Dakon', $data, TRUE);
		$data['title']		=	'Daftar Permohonan';
		$data['heading']	=	'';
		$this->load->view('template_pengajuan', $data);
	}
	public function savePermohonan()
	{
		$user_id			= $this->session->userdata('loc_user_id');
		$user_id			= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$id_izin			= $this->input->post('id_izin');
		$id_kolektif		= $this->input->post('id_kolektif');
		$tipeA				= $this->input->post('tipeA');
		$jumlahA			= $this->input->post('jumlahA');
		$luasA				= $this->input->post('luasA');
		$tinggiA			= $this->input->post('tinggiA');
		$lantaiA			= $this->input->post('lantaiA');
		$id_fungsi_bg		= $this->input->post('id_fungsi_bg');
		$id_jns_bg			= $this->input->post('id_jns_bg');
		if ($id_izin == '') {
			$id_izin			= $this->input->post('id_existing');
		}
		$nama_bangunan				= $this->input->post('nama_bangunan');
		$nama_bangunan_prasarana 	= $this->input->post('nama_bangunan_prasarana');
		$nama_bangunan_kolektif		= $this->input->post('nama_bangunan_kolektif');
		$nama_bangunan_pertashop 	= $this->input->post('nama_bangunan_pertashop');
		if ($nama_bangunan) {
			$nama_bangunan		= $this->input->post('nama_bangunan');
		} else if ($nama_bangunan_kolektif) {
			$nama_bangunan		= $this->input->post('nama_bangunan_kolektif');
		} else if ($nama_bangunan_prasarana){
			$nama_bangunan		= $this->input->post('nama_bangunan_prasarana');
		}else{
			$nama_bangunan		= $this->input->post('nama_bangunan_pertashop');
		}
		$luas_bg			= $this->input->post('luas_bg');
		$tinggi_bg			= $this->input->post('tinggi_bg');
		$lantai_bg			= $this->input->post('lantai_bg');
		$luas_basement		= $this->input->post('luas_basement');
		$lapis_basement		= $this->input->post('lapis_basement');
		$id_prasarana_bg	= $this->input->post('id_prasarana_bg');
		$luas_bgp			= $this->input->post('luas_bgp');
		$tinggi_bgp			= $this->input->post('tinggi_bgp');
		$id_prototype		= $this->input->post('id_prototype');
		$jual				= $this->input->post('jual');
		$imb				= $this->input->post('imb');
		$slf				= $this->input->post('slf');
		$cetak				= $this->input->post('cetak');
		$id_doc_tek			= $this->input->post('id_doc_tek');
		$no_imb				= $this->input->post('no_imb');
		$no_slf				= $this->input->post('no_slf');
		$permohonan_slf		= $this->input->post('permohonan_slf');
		if ($id_fungsi_bg == 6) {
			$jns_campur		= $this->input->post('dcampur');
			$id_jns_bg	= json_encode($jns_campur);
		}
		if ($id_izin == '1') {
			if ($id_fungsi_bg == '1') { //Fungsi Hunian
				if($id_jns_bg =='1'){
					if ($id_doc_tek == '1') {
						if ($luas_bg <= 72) { // Fungsi Hunian Sederhana Penyedia Jasa
							if($lantai_bg <= '2'){
								$jenis_konsultasi = '1';
								$id_klasifikasi = '1';
							}
						} else if ($luas_bg <= 90){ //Fungsi Hunian Sederhana Penyedia Jasa 
							if($lantai_bg <= '2')
							$jenis_konsultasi = '1';
							$id_klasifikasi = '1';
						}else if($luas_bg > 91) { //Fungsi Hunian Tidak Sederhana Penyedia Jasa
							$jenis_konsultasi = '2';
							$id_klasifikasi = '2';
						}
					} else if ($id_doc_tek == '2') { //Fungsi Hunian Prototype
						$jenis_konsultasi = '3';
					} else if ($id_doc_tek == '3') { //Fungsi Hunian Pengembangan Prototype
						$jenis_konsultasi = '4';
					} else if ($id_doc_tek == '4') { //Fungsi Hunian Tahan Gempa
						$jenis_konsultasi = '5';
					}
				}else if($id_jns_bg =='3'){
					$jenis_konsultasi = '7';
				}else{
					$jenis_konsultasi = '27';
				}
			} else if ($id_fungsi_bg == '2') { //Fungsi Non Hunian dan Non Khusus serta Non Campuran
				$jenis_konsultasi = '6';
			} else if ($id_fungsi_bg == '3') {
				if ($jual == '1') {
					$jenis_konsultasi = '7';
				} else {
					$jenis_konsultasi = '6';
				}
			} else if ($id_fungsi_bg == '4') {
				$jenis_konsultasi = '6';
			} else if ($id_fungsi_bg == '5') {
				$jenis_konsultasi = '9';
			} else if ($id_fungsi_bg == '6') { //Fungsi Campuran
				$jenis_konsultasi = '13';
			}
		} else if ($id_izin == '2') {
			if ($id_fungsi_bg == '1') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '2') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '3') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '4') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '6') {
				if ($imb == '1' || $slf == '1') {
					$jenis_konsultasi = '15';
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '5') {
				$jenis_konsultasi = '16';
			}
			$jenis_konsultasi 	= '14';
		} else if ($id_izin == '3') {
			$jenis_konsultasi 	= '18';
		} else if ($id_izin == '4') {
			if ($luasA[1] <= 72) { // Fungsi Hunian Sederhana Kolektif Luas Maksimal 72m
				if($lantaiA[1] == '1'){
					$jenis_konsultasi 	= '29'; // Fungsi Hunian Luas Maksimal 72m dengan 1 Lantai Kolektif
					$id_klasifikasi 	= '1';
					$tahap_pbg 			= null;
				}else if($lantaiA[1] == '2'){
					$jenis_konsultasi 	= '30'; // Fungsi Hunian Luas Maksimal 72 dengan 2 Lantai
					$id_klasifikasi 	= '2';
					$tahap_pbg 			= null;
				}else{
					$jenis_konsultasi 	= '33';
					$id_klasifikasi 	= '2';
					$tahap_pbg 			= null;
				}
			} else if ($luasA[1] <= 90){ //Fungsi Hunian SederhanaKolektif dengan Luas Maksimal 90 Penyedia Jasa 
				if($lantaiA[1] == '1'){
					$jenis_konsultasi 	= '30'; //Fungsi Hunian Kolektif Luas 90 m dengan 1 Lantai
					$id_klasifikasi 	= '1';
				}else if($lantaiA[1] == '2'){
					$jenis_konsultasi 	= '30';
					$id_klasifikasi 	= '1';
					$tahap_pbg 			= null;
				}else{
					$jenis_konsultasi 	= '33';// Fungsi Hunian Kolektif Bangunan Tidak Sederhana
					$id_klasifikasi 	= '2';
					$tahap_pbg 			= null;
				}
			}else{
				if($lantaiA[1] == '1'){
					$jenis_konsultasi 	= '31';
					$id_klasifikasi 	= '2';
					$tahap_pbg 			= null;
				}else if($lantaiA[1] == '2'){
					$jenis_konsultasi 	= '32';
					$id_klasifikasi 	= '2';
					$tahap_pbg 			= null;
				}else{
					$jenis_konsultasi 	= '33';
					$id_klasifikasi 	= '2';
					$tahap_pbg 			= null;
				}
			}
		} else if ($id_izin == '5') {
			$jenis_konsultasi 	= '12';
		} else if ($id_izin == '6') {
			$jenis_konsultasi 	= '17';
		} else if($id_izin == '7'){
			$jenis_konsultasi 	= '21';
			$id_fungsi_bg 		='3';
			$id_jns_bg			='2';
			$luas_bgp 			='10.01';
			$tinggi_bgp 		='2.6';
			$id_klasifikasi		='2';
		}
		$data	= array(
			'id_izin'			=> $id_izin,
			'id_prov_bgn'		=> $id_kolektif,
			'tipeA'				=> json_encode($tipeA),
			'jumlahA'			=> json_encode($jumlahA),
			'luasA'				=> json_encode($luasA),
			'tinggiA'			=> json_encode($tinggiA),
			'lantaiA'			=> json_encode($lantaiA),
			'id_fungsi_bg'		=> $id_fungsi_bg,
			'id_jns_bg'			=> $id_jns_bg,
			'nm_bgn'			=> $nama_bangunan,
			'luas_bgn'			=> $luas_bg,
			'tinggi_bgn'		=> $tinggi_bg,
			'jml_lantai'		=> $lantai_bg,
			'luas_basement'		=> $luas_basement,
			'lapis_basement'	=> $lapis_basement,
			'id_prasarana_bg'	=> $id_prasarana_bg,
			'luas_bgp'			=> $luas_bgp,
			'tinggi_bgp'		=> $tinggi_bgp,
			'jual'				=> $jual,
			'imb'				=> $imb,
			'slf'				=> $slf,
			'status'			=> 0,
			'id_prototype'		=> $id_prototype,
			'id_jenis_permohonan' => $jenis_konsultasi,
			'id_doc_tek'		=> $id_doc_tek,
			'id_klasifikasi'	=> $id_klasifikasi,
			'no_imb'			=> $no_imb,
			'no_slf'			=> $no_slf,
			'permohonan_slf'	=> $permohonan_slf,
			'cetak_dok'			=> json_encode($cetak),
			'last_update'		=> date("Y-m-d h:i:sa"),
		);
		$dataP	= array(
			'user_id' => $this->Outh_model->Encryptor('decrypt', $user_id)
		);
		$idP		= $this->Mglobals->setData('tmdatapemilik', $dataP);
		$data['id'] = $idP;
		if ($idP != "") {
			$this->Mglobals->setData('tmdatabangunan', $data);
			$this->session->set_flashdata('message', 'Data User Berhasil.');
			$this->session->set_flashdata('status', 'success');
			redirect('Konsultasi/FormPendaftaran/' . $idP);
		} else {
			$this->session->set_flashdata('message', 'Biodata User Gagal di Simpan.');
			$this->session->set_flashdata('status', 'danger');
		}
	}

	public function removeData($id)
	{
		$process = $this->Mkonsultasi->removeData($id);
		$this->Mkonsultasi->removeDataBangunan(null, $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Permohonan Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		} else {
			$this->session->set_flashdata('message', 'Data Permohonan Berhasil di Hapus');
			$this->session->set_flashdata('status', 'danger');
		}
		redirect('Konsultasi');
	}
	//End Data List Konsultasi 
	//Begin Form Permohonan Konsultasi BG
	public function FormPendaftaran()
	{
		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		//$user_id	= $this->session->userdata('loc_user_id');
		$id	= $this->uri->segment(3);
		$data['id']	= $id;
		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['prof'] = $this->Mkonsultasi->getDataUserProfil('a.*', $user_id);
		if ($id != '') {
			$data['DataPemilik']	= $this->Mkonsultasi->getPemilik('a.*', $id);
		}
		$data['content']	= $this->load->view('FormPemilik', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('template_pengajuan', $data);
	}
	public function cekDataPemilik($var = null)
	{
		$user_id	= $this->session->userdata('loc_user_id');
		$select = array('nama_lengkap', 'alamat', 'id_provinsi', 'id_kabkota', 'id_kecamatan', 'no_ktp', 'no_hp');
		$where = array("user_id = " => $user_id);
		$result = $this->db->select($select)->get_where('tmDataPemilik', $where)->row();
		$i = 0;
		if (count($result) > 0) {
			foreach ($result as $key => $value) {
				if ($value == '') {
					$i++;
				}
			}
		}
		if ($i > 0) {
			$this->session->set_flashdata('message', 'Data Harus diengkapi sebelum melanjutkan.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Konsultasi/lengkapi_akun');
		} else {
			$this->session->set_flashdata('message', 'Data Berhasil Disimpan.');
			$this->session->set_flashdata('status', 'success');
			redirect('Konsultasi');
		}
	}

	public function SaveData()
	{
		$user_id		= $this->session->userdata('loc_user_id');
		$id				= $this->input->post('id');
		$jns_pemilik	= $this->input->post('jns_pemilik');
		$nm_pemilik		= $this->input->post('nm_pemilik');
		$nama_pemilik	= $this->input->post('nama_pemilik');
		if ($jns_pemilik == '1') {
			$nm_pemilik		= $this->input->post('unit_organisasi');
		} else if ($jns_pemilik == '2') {
			$nm_pemilik		= $this->input->post('nm_pemilik');
		} else if ($jns_pemilik == '3') {
			$nm_pemilik		= $this->input->post('nama_pemilik');
		}
		
		$glr_depan		= $this->input->post('glr_depan');
		$glr_belakang	= $this->input->post('glr_belakang');
		$alamat			= $this->input->post('alamat');
		$nama_provinsi	= $this->input->post('nama_provinsi');
		$nama_kabkota	= $this->input->post('nama_kabkota');
		$nama_kecamatan	= $this->input->post('nama_kecamatan');
		$nama_kelurahan	= $this->input->post('nama_kelurahan');
		$jenis_id		= $this->input->post('jenis_id');
		$no_ktp			= $this->input->post('no_ktp');
		$no_kitas		= $this->input->post('no_kitas');
		$no_hp			= $this->input->post('no_hp');
		$nip			= $this->input->post('nip');
		$email			= $this->input->post('email');
		$unit_organisasi	= $this->input->post('unit_organisasi');
		$data	= array(
			'user_id' => $this->Outh_model->Encryptor('decrypt', $user_id),
			'nm_pemilik' => $nm_pemilik,
			'jns_pemilik' => $jns_pemilik,
			'glr_depan' => $glr_depan,
			'glr_belakang' => $glr_belakang,
			'alamat' => $alamat,
			'id_provinsi' => $nama_provinsi,
			'id_kabkota' => $nama_kabkota,
			'id_kecamatan' => $nama_kecamatan,
			'id_kelurahan' => $nama_kelurahan,
			'jenis_id' => $jenis_id,
			'no_ktp' => $no_ktp,
			'no_kitas' => $no_kitas,
			'no_hp' => $no_hp,
			'email' => $email,
			'unit_organisasi' => $unit_organisasi,
		);
		if ($id != "") {
			$this->Mglobals->setData('tmdatapemilik', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('Konsultasi/FormBangunan/' . $id);
		} else {
			$query		= $this->Mglobals->setData('tmdatapemilik', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			if ($query) {
				redirect('Konsultasi/FormBangunan/' . $query);
			} else {
				$this->session->set_flashdata('message', 'Biodata User Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Konsultasi/FormBangunan/' . $id);
			}
		}
	}
	public function FormBangunan()
	{
		$user_id	= $this->session->userdata('loc_user_id');
		$id	= $this->uri->segment(3);
		$data['id']	= $id;
		$queFungsi = $this->Mkonsultasi->get_jenis_fungsi_list()->result();
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) {
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		if ($id != '') {
			$data['DataPemilik']	= $this->Mkonsultasi->getPemilik('a.*', $id);
		}
		$queJenisP = $this->Mglobals->getData('*', 'tm_jenis_permohonan')->result();
		$list_JnsPer[''] = '--Pilih--';
		foreach ($queJenisP as $row) {
			$list_JnsPer[$row->id_jns_permohonan] = $row->nm_jns_permohonan;
		}
		$data['list_JnsPer'] = $list_JnsPer;
		$data['tipeA'] = array();
		$data['list_fungsi'] = $list_fungsi;
		$data['DataBangunan'] = $this->Mkonsultasi->getBangunan('a.*', $id);
		$data['Provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['content']	= $this->load->view('FormBangunan', $data, TRUE);
		$data['title']		=	'Form Permohonan Konsultasi';
		$data['heading']	=	'';
		$this->load->view('template_pengajuan', $data);
	}
	public function SaveBangunan()
	{
		$id_bgn			= $this->input->post('id_bgn');
		$id				= $this->input->post('id');
		$nama_bangunan				= $this->input->post('nama_bangunan');
		$nama_bangunan_kolektif		= $this->input->post('nama_bangunan_kolektif');
		
		if ($nama_bangunan) {
			$nama_bangunan		= $this->input->post('nama_bangunan');
		} else if ($nama_bangunan_kolektif) {
			$nama_bangunan		= $this->input->post('nama_bangunan_kolektif');
		} else {
			$nama_bangunan		= $this->input->post('nama_bangunan_prasarana');
		}
		$luas_bg			= $this->input->post('luas_bg');
		$tinggi_bg			= $this->input->post('tinggi_bg');
		$almt_bgn			= $this->input->post('almt_bgn');
		$nama_provinsi		= $this->input->post('nama_provinsi');
		$nama_kabkota		= $this->input->post('nama_kabkota');
		$nama_kecamatan		= $this->input->post('nama_kecamatan');
		$nama_kelurahan 	= $this->input->post('nama_kelurahan');
		$id_otorita							= $this->input->post('id_otorita');
		if($id_otorita =='1'){
			$id_otorita						= $this->input->post('id_otorita');
		}else{
			$id_otorita						= '0';
		}
		$lantai_bg			= $this->input->post('lantai_bg');
		$luas_basement		= $this->input->post('luas_basement');
		$lapis_basement		= $this->input->post('lapis_basement');
		$lantai_bg			= $this->input->post('lantai_bg');
		$id_jns_bg			= $this->input->post('id_jns_bg');
		$id_fungsi_bg		= $this->input->post('id_fungsi_bg');
		$id_izin			= $this->input->post('id_izin');
		$id_kolektif		= $this->input->post('id_kolektif');
		$tipeA				= $this->input->post('tipeA');
		$jumlahA			= $this->input->post('jumlahA');
		$luasA				= $this->input->post('luasA');
		$tinggiA			= $this->input->post('tinggiA');
		$lantaiA			= $this->input->post('lantaiA');
		$id_prasarana_bg	= $this->input->post('id_prasarana_bg');
		$luas_bgp			= $this->input->post('luas_bgp');
		$tinggi_bgp			= $this->input->post('tinggi_bgp');
		$jual				= $this->input->post('jual');
		$imb				= $this->input->post('imb');
		$slf				= $this->input->post('slf');
		$id_prototype		= $this->input->post('id_prototype');
		$cetak				= $this->input->post('cetak');
		$id_doc_tek			= $this->input->post('id_doc_tek');
		$permohonan_slf		= $this->input->post('permohonan_slf');
		if ($id_fungsi_bg == 6) {
			$jns_campur		= $this->input->post('dcampur');
			$id_jns_bg	= json_encode($jns_campur);
		}
		if ($nama_kabkota == '9972') {
			$nama_kabkota  = '9971';
			$nama_kecamatan  = '997101';
			$nama_kelurahan  = '9971012001';
		} else if ($nama_kabkota == '9971') {
			$nama_kabkota  = '9971';
			$nama_kecamatan  = '997101';
			$nama_kelurahan  = '9971012001';
		} else {
			$nama_kabkota  = $this->input->post('nama_kabkota');
		}
		if ($id_izin == '1') {
			if ($id_fungsi_bg == '1') { //Fungsi Hunian
				if($id_jns_bg =='1'){
					if ($id_doc_tek == '1') {
						if ($luas_bg <= 72) { // Fungsi Hunian Sederhana Penyedia Jasa
							if($lantai_bg == '1'){
								$jenis_konsultasi = '23'; // Fungsi Hunian Luas Maksimal 72 dengan 1 Lantai
								$id_klasifikasi = '1';
								$tahap_pbg 			= null;
							}else if($lantai_bg == '2'){
								$jenis_konsultasi = '25'; // Fungsi Hunian Luas Maksimal 72 dengan 2 Lantai
								$id_klasifikasi = '2';
								$tahap_pbg 			= null;
							}else{
								$jenis_konsultasi = '27'; // Fungsi Hunian Luas Maksimal 72 dengan 3 Lantai Ke atas
								$id_klasifikasi = '2';
								$tahap_pbg 			= null;
							}
						} else if ($luas_bg <= 90){ //Fungsi Hunian Sederhana Penyedia Jasa 
							if($lantai_bg == '1'){
								$jenis_konsultasi = '24'; // Fungsi Hunian Luas Maksimal 90 dengan 1 Lantai
								$id_klasifikasi = '1';
								$tahap_pbg 			= null;
							}else if($lantai_bg == '2'){
								$jenis_konsultasi = '24'; // Fungsi Hunian Luas Maksimal 90 dengan 2 Lantai
								$id_klasifikasi = '1';
								$tahap_pbg 			= null;
							}else{
								$jenis_konsultasi = '27';
								$id_klasifikasi = '2';
								$tahap_pbg 			= null;
							}
						}else if($luas_bg <= 1000000){ //Fungsi Hunian Tidak Sederhana Penyedia Jasa
							if($lantai_bg == '1'){
								$jenis_konsultasi = '25';
								$id_klasifikasi = '2';
								$tahap_pbg 			= null;
							}else if($lantai_bg == '2'){
								$jenis_konsultasi = '26';
								$id_klasifikasi = '2';
								$tahap_pbg 			= null;
							}else{
								$jenis_konsultasi = '27';
								$id_klasifikasi = '2';
								$tahap_pbg 			= null;
							}
						}
					} else if ($id_doc_tek == '2') { //Fungsi Hunian Prototype
						$jenis_konsultasi 	= '3';
						$id_klasifikasi 	= '1';
						$tahap_pbg 			= null;
					} else if ($id_doc_tek == '3') { //Fungsi Hunian Pengembangan Prototype
						$jenis_konsultasi = '4';
						$id_klasifikasi = '1';
						$tahap_pbg 			= null;
					} else if ($id_doc_tek == '4') { //Fungsi Hunian Tahan Gempa
						$jenis_konsultasi = '5';
						$id_klasifikasi = '1';
						$tahap_pbg 			= null;
					}
				}else if($id_jns_bg =='3'){
					$jenis_konsultasi = '7';
				}else if($id_jns_bg =='2'){
					$jenis_konsultasi = '27';
				}
			} else if ($id_fungsi_bg == '2') { //Fungsi Non Hunian dan Non Khusus serta Non Campuran
				$jenis_konsultasi = '6';
			} else if ($id_fungsi_bg == '3') {
				if ($jual == '1') {
					$jenis_konsultasi = '7';
				} else {
					$jenis_konsultasi = '6';
				}
			} else if ($id_fungsi_bg == '4') {
				$jenis_konsultasi = '6';
			} else if ($id_fungsi_bg == '5') {
				$jenis_konsultasi = '9';
			} else if ($id_fungsi_bg == '6') { //Fungsi Campuran
				$jenis_konsultasi = '13';
			}
		} else if ($id_izin == '2') {
			if ($imb == '1') {
				if ($slf == '1') {
					if($permohonan_slf =='1'){
						$jenis_konsultasi = '15'; //SLF Administrastif atau SLF perpanjangan-> Bangunan
					}else if($permohonan_slf =='2'){
						$jenis_konsultasi = '15'; //SLF Administrastif atau SLF perpanjangan-> Prasarana
						$tahap_pbg			= null;
					}else if($permohonan_slf =='3'){
						$jenis_konsultasi = '15'; //SLF Administrastif atau SLF perpanjangan-> Pertashop
						$tahap_pbg			= null;
						$id_fungsi_bg ='3';
						$id_jns_bg ='2';
					}
				} else if($slf == '0'){
					if($permohonan_slf =='1'){
						$jenis_konsultasi = '14';
					}else if($permohonan_slf =='2'){
						$jenis_konsultasi = '14';
						$id_klasifikasi		= 2;
						$tahap_pbg			= null;
					}else if($permohonan_slf =='3'){
						$jenis_konsultasi = '35';
						$tahap_pbg			= null;
						$id_fungsi_bg 		='3';
						$id_jns_bg 			='2';
						$id_klasifikasi		= 2;
						$luas_bgp 			='10.01';
						$tinggi_bgp 		='2.6';
						$luas_bgn 			='10.01';
						$tinggi_bgn 		='2.6';
					}
				}
			}else if($imb == '0'){
				if ($slf == '1') {
					if($permohonan_slf =='1'){
						$jenis_konsultasi = '15'; //SLF Administrastif atau SLF perpanjangan-> Bangunan
					}else if($permohonan_slf =='2'){
						$jenis_konsultasi = '15'; //SLF Administrastif atau SLF perpanjangan-> Prasarana
					}else if($permohonan_slf =='3'){
						$jenis_konsultasi = '15'; //SLF Administrastif atau SLF perpanjangan-> Pertashop
						$tahap_pbg			= null;
					}
				} else if($slf == '0'){
					if($permohonan_slf =='1'){
						$jenis_konsultasi = '14';
						$tahap_pbg			= null;
					}else if($permohonan_slf =='2'){
						$jenis_konsultasi = '14';
						$tahap_pbg			= null;
					}else if($permohonan_slf =='3'){
						$jenis_konsultasi 	= '36';
						$tahap_pbg			= null;
						$id_fungsi_bg 		='3';
						$id_jns_bg 			='2';
						$id_klasifikasi		= 2;
						$luas_bgp 			='10.01';
						$tinggi_bgp 		='2.6';
						$luas_bgn 			='10.01';
						$tinggi_bgn 		='2.6';
					}
				}
			}
		} else if ($id_izin == '3') {
			$jenis_konsultasi = '18';
		} else if ($id_izin == '4') {
			if ($luasA[1] <= 72) { // Fungsi Hunian Sederhana Kolektif Luas Maksimal 72m
				if($lantaiA[1] == '1'){
					$jenis_konsultasi = '29'; // Fungsi Hunian Luas Maksimal 72m dengan 1 Lantai Kolektif
					$id_klasifikasi = '1';
					$tahap_pbg 			= null;
					$id_jns_bg			= '1';
					$id_fungsi_bg		= '1';
				}else if($lantaiA[1] == '2'){
					$jenis_konsultasi 	= '30'; // Fungsi Hunian Luas Maksimal 72 dengan 2 Lantai
					$id_klasifikasi 	= '2';
					$tahap_pbg 			= null;
					$id_jns_bg			= '1';
					$id_fungsi_bg		= '1';
				}else{
					$jenis_konsultasi 	= '33';
					$id_klasifikasi 	= '2';
					$tahap_pbg 			= null;
					$id_jns_bg			= '1';
					$id_fungsi_bg		= '1';
				}
			} else if ($luasA[1] <= 90){ //Fungsi Hunian SederhanaKolektif dengan Luas Maksimal 90 Penyedia Jasa 
				if($lantaiA[1] == '1'){
					$jenis_konsultasi 	= '30'; //Fungsi Hunian Kolektif Luas 90 m dengan 1 Lantai
					$id_klasifikasi 	= '1';
					$id_jns_bg			= '1';
					$id_fungsi_bg		= '1';
				}else if($lantaiA[1] == '2'){
					$jenis_konsultasi 	= '30';
					$id_klasifikasi 	= '1';
					$tahap_pbg 			= null;
					$id_jns_bg			= '1';
					$id_fungsi_bg		= '1';
				}else{
					$jenis_konsultasi 	= '33';// Fungsi Hunian Kolektif Bangunan Tidak Sederhana
					$id_klasifikasi 	= '2';
					$tahap_pbg 			= null;
					$id_jns_bg			= '1';
					$id_fungsi_bg		= '1';
				}
			}else{
				if($lantaiA[1] == '1'){
					$jenis_konsultasi 	= '31';
					$id_klasifikasi 	= '2';
					$tahap_pbg 			= null;
					$id_jns_bg			= '1';
					$id_fungsi_bg		= '1';
				}else if($lantaiA[1] == '2'){
					$jenis_konsultasi 	= '32';
					$id_klasifikasi 	= '2';
					$tahap_pbg 			= null;
					$id_jns_bg			= '1';
					$id_fungsi_bg		= '1';
				}else{
					$jenis_konsultasi 	= '33';
					$id_klasifikasi 	= '2';
					$tahap_pbg 			= null;
					$id_jns_bg			= '1';
					$id_fungsi_bg		= '1';
				}
			}
		} else if ($id_izin == '5') {
			$jenis_konsultasi = '12';
		} else if ($id_izin == '6') {
			$jenis_konsultasi = '17';
		} else if ($id_izin == '7'){
			$jenis_konsultasi 	= '34';
			$id_fungsi_bg 		='3';
			$id_jns_bg 			='2';
			$luas_bgp 			= '10.01';
			$tinggi_bgp 		= '2.6';
		} else if($id_izin == '8'){
			$jenis_konsultasi 	= '8';
			$tahap_pbg 			= '1';
			$id_klasifikasi 	='2';
		}
		$data	= array(
			'id'					=> $id,
			'id_prov_bgn'			=> $nama_provinsi,
			'id_kabkot_bgn'			=> $nama_kabkota,
			'id_kec_bgn'			=> $nama_kecamatan,
			'id_kel_bgn'			=> $nama_kelurahan,
			'almt_bgn'				=> $almt_bgn,
			'id_izin'				=> $id_izin,
			'id_fungsi_bg'			=> $id_fungsi_bg,
			'id_jns_bg'				=> $id_jns_bg,
			'nm_bgn'				=> $nama_bangunan,
			'luas_bgn'				=> $luas_bg,
			'tinggi_bgn'			=> $tinggi_bg,
			'jml_lantai'			=> $lantai_bg,
			'luas_basement'			=> $luas_basement,
			'lapis_basement'		=> $lapis_basement,
			'last_update'			=> date("Y-m-d h:i:sa"),
			'id_kolektif'			=> $id_kolektif,
			'tipeA'					=> json_encode($tipeA),
			'jumlahA'				=> json_encode($jumlahA),
			'luasA'					=> json_encode($luasA),
			'tinggiA'				=> json_encode($tinggiA),
			'lantaiA'				=> json_encode($lantaiA),
			'id_prasarana_bg'		=> $id_prasarana_bg,
			'luas_bgp'				=> $luas_bgp,
			'tinggi_bgp'			=> $tinggi_bgp,
			'id_doc_tek'			=> $id_doc_tek,
			'id_prototype'			=> $id_prototype,
			'id_jenis_permohonan' 	=> $jenis_konsultasi,
			'imb'					=> $imb,
			'slf'					=> $slf,
			'id_klasifikasi'		=> $id_klasifikasi,
			'tahap_pbg'				=> $tahap_pbg,
			'id_otorita'			=> $id_otorita,
			'permohonan_slf'		=> $permohonan_slf,
		);
		if ($id_bgn != "") {
			$query		= $this->Mglobals->setData('tmdatabangunan', $data, 'id_bgn', $id_bgn);
			$this->session->set_flashdata('message', 'Data Bangunan Gedung Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('Konsultasi/FormDataTanah/' . $id);
		} else {
			$query		= $this->Mglobals->setData('tmdatabangunan', $data, 'id_bgn', $id_bgn);
			if ($query) {
				redirect('Konsultasi/FormDataTanah/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Data Bangunan Gedung Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Konsultasi/FormBangunan/' . $id);
			}
		}
	}
	//End Form Pendaftaran Permohonan BG 
	//Begin Form Edit Data Permohonan Konsultasi
	public function FormDataTanah()
	{
		$id			= $this->uri->segment(3);
		$data['id']	= $id;
		$permohonan = $this->Mkonsultasi->getDataJnsKonsultasi('a.*', $id)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		if ($id != '') {
			$filterPemilik	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
			$data['DataPemilik']	= $this->Mkonsultasi->getPemilik($filterPemilik, $id);
			$data['DataTanah']		= $this->Mkonsultasi->getTanah('a.*', $id);
			$filterBangunan	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,e.nm_konsultasi,h.nama_kelurahan';
			$data['DataBangunan']	= $this->Mkonsultasi->getBangunan($filterBangunan, $id);
			$data['DataTeknisTanah']	= $this->Mkonsultasi->getDataDokumen('a.*', $id);
			$filterQuery				= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan';
			$data['DataTkTanah']	= $this->Mkonsultasi->getDataTanah($filterQuery, $id_jenis_permohonan);
		}
		$data['Konsultasi'] = $this->Mkonsultasi->getDataKonsultasi('a.*', $id);
		$data['content']	= $this->load->view('FormDataTanah', $data, TRUE);
		$data['title']		=	'Form Data Tanah';
		$data['heading']	=	'';
		$this->load->view('template_pengajuan', $data);
	}
	public function saveTanah()
	{
		$user_id						= $this->session->userdata('loc_user_id');
		$id_tanah						= $this->input->post('id_tanah');
		$id								= $this->input->post('id');
		$id_dokumen						= $this->input->post('id_dokumen');
		$nama_jns_dok_lain				= $this->input->post('nama_jns_dok_lain');
		$nomor_dokumen					= $this->input->post('nomor_dokumen');
		$tgl_terbit_dokumen				= $this->input->post('tgl_terbit_dokumen');
		$lokasi_tanah					= $this->input->post('lokasi_tanah');
		$nama_provinsi					= $this->input->post('nama_provinsi');
		$nama_kabkota					= $this->input->post('nama_kabkota');
		$nama_kecamatan					= $this->input->post('nama_kecamatan');
		$luas_tanah						= $this->input->post('luas_tanah');
		$nama_pemegang_hak_atas_tanah	= $this->input->post('atas_nama');
		$hat							= $this->input->post('hat');
		$hat2							= $this->input->post('hat2');
		$id_status_izin_pemanfaatan		= $this->input->post('id_status_izin_pemanfaatan');
		$no_dok_izin_pemanfaatan		= $this->input->post('no_dok_izin_pemanfaatan');
		$tgl_terbit_pemanfaatan			= $this->input->post('tgl_terbit_phat');
		$nama_pemegang_izin				= $this->input->post('nama_penerima_kuasa');
		$data_tanah = [
			'upload_path' => './object-storage/dekill/Earth/',
			'allowed_types' => 'pdf|PDF',
			'max_size' => '54000',
			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];
		$filetan = [];
		if ($_FILES["d_file_tan"]["name"]) {
			$this->load->library('upload', $data_tanah);
			$this->upload->initialize($data_tanah);
			$d_file_tan = $this->upload->do_upload('d_file_tan');
			$filetan = $this->upload->data();
			if (!$d_file_tan) {
				$data['err_msg'] = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'danger');
				redirect('Konsultasi/FormDataTanah/' . $id);
			}
		}
		if ($_FILES["d_file_phat"]["name"]) {
			$this->load->library('upload', $data_tanah);
			$this->upload->initialize($data_tanah);
			$d_file_phat = $this->upload->do_upload('d_file_phat');
			$filephat = $this->upload->data();
			if (!$d_file_phat) {
				$data['err_msg'] = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'danger');
				redirect('Konsultasi/FormDataTanah/' . $id);
			}
		}
		$data	= array(
			'id' => $id,
			'id_dokumen' => $id_dokumen,
			'dir_file' => !empty($filetan['file_name']) ? $filetan['file_name'] : '',
			'jenis_dokumen_phat' => $nama_jns_dok_lain,
			'no_dok' => $nomor_dokumen,
			'tanggal_dok' => date('Y-m-d', strtotime($tgl_terbit_dokumen)),
			'lokasi_tanah' => $lokasi_tanah,
			'id_provinsi' => $nama_provinsi,
			'id_kabkot' => $nama_kabkota,
			'id_kecamatan' => $nama_kecamatan,
			'luas_tanah' => $luas_tanah,
			'atas_nama_dok' => $nama_pemegang_hak_atas_tanah,
			'status_phat' => $hat2,
			'dir_file_phat' =>  !empty($filephat['file_name']) ? $filephat['file_name'] : '',
			'no_dokumen_phat' => $no_dok_izin_pemanfaatan,
			'nama_penerima_phat' => $nama_pemegang_izin,
			'hat' => $hat,
			'tgl_terbit_phat' => date('Y-m-d', strtotime($tgl_terbit_pemanfaatan)),
		);
		if ($id_tanah != "") {
			$query		= $this->Mglobals->setData('tmdatatanah', $data, 'id_permohonan_detail_tanah', $id_tanah);
			$this->session->set_flashdata('message', 'Data Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('Konsultasi/FormDataTanah/' . $id);
		} else {
			$query		= $this->Mglobals->setData('tmdatatanah', $data, 'id_permohonan_detail_tanah', $id_tanah);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Konsultasi/FormDataTanah/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Konsultasi/FormDataTanah/' . $id);
			}
		}
	}
	public function removeDataTanah($id_tanah)
	{
		$id_tanah	= $this->uri->segment(3);
		$id			= $this->uri->segment(4);
		$process = $this->Mkonsultasi->removeDataTanah($id_tanah);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Tanah Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Tanah Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Konsultasi/FormDataTanah/' . $id);
	}
	//Begin Data Dokumen Administrasi dan Teknis
	public function FormDataDokumen()
	{
		$id			= $this->uri->segment(3);
		$data['id']	= $id;
		$permohonan = $this->Mkonsultasi->getDataJnsKonsultasi('a.*', $id)->row_array();
		$id_jenis_permohonan 			= $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		$tahap_pbg 						= $permohonan['tahap_pbg'];
		if($tahap_pbg != ''){
			$data['id_jenis_permohonan']	= $id_jenis_permohonan;
			if ($id != '') {
				$filterPemilik			= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
				$data['DataPemilik']	= $this->Mkonsultasi->getPemilik($filterPemilik, $id);
				$filterBangunan			= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,e.nm_konsultasi,f.dir_file,h.nama_kelurahan';
				$data['DataBangunan']	= $this->Mkonsultasi->getBangunan($filterBangunan, $id);
				$data['DataUmum']		= $this->Mkonsultasi->getDataDokumen('a.*', $id);
				$filterQuery			= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan,c.id_tahap';
				$data['DokumenUmum']	= $this->Mkonsultasi->getDataUmumBertahap($filterQuery, $id_jenis_permohonan, $tahap_pbg);
			}
			$data['content']	= $this->load->view('FormDataDokumenBertahap', $data, TRUE);
			$data['title']		=	'';
			$data['heading']	=	'';
			$this->load->view('template_pengajuan', $data);
		}else{
			$data['id_jenis_permohonan']	= $id_jenis_permohonan;
			if ($id != '') {
				$filterPemilik	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
				$data['DataPemilik']	= $this->Mkonsultasi->getPemilik($filterPemilik, $id);
				$filterBangunan	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,e.nm_konsultasi,h.nama_kelurahan';
				$data['DataBangunan']	= $this->Mkonsultasi->getBangunan($filterBangunan, $id);
				//Begin Data Umum 
				$data['DataUmum']		= $this->Mkonsultasi->getDataDokumen('a.*', $id);
				$filterQuery			= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan';
				$data['DokumenUmum']	= $this->Mkonsultasi->getDataUmum($filterQuery, $id_jenis_permohonan);
			}
			$data['content']	= $this->load->view('FormDataDokumen', $data, TRUE);
			$data['title']		=	'Form Data Umum';
			$data['heading']	=	'';
			$this->load->view('template_pengajuan', $data);
		}
	}
	public function FormDataTeknis()
	{
		$id						= $this->uri->segment(3);
		//$id 					= $this->secure->decrypt_url($id);
		$data['id']				= $id;
		$permohonan 			= $this->Mkonsultasi->getDataJnsKonsultasi('a.*', $id)->row_array();
		$id_jenis_permohonan 	= $permohonan['id_jenis_permohonan'];
		$tahap_pbg 				= $permohonan['tahap_pbg'];
		//echo $tahap_pbg;
		if($tahap_pbg != ''){
			$data['id_jenis_permohonan']	= $id_jenis_permohonan;
			if ($id != '') {
				$filterPemilik	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
				$data['DataPemilik']	= $this->Mkonsultasi->getPemilik($filterPemilik, $id);
				$filterBangunan	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,e.nm_konsultasi,f.dir_file,h.nama_kelurahan';
				$data['DataBangunan']	= $this->Mkonsultasi->getBangunan($filterBangunan, $id);
				//Begin Data Teknis Arsitektur
				$data['DataTeknisArsitektur']	= $this->Mkonsultasi->getDataDokumen('a.*', $id);
				$filterQuery				= 'b.id_detail, b.id_syarat,c.id, c.nm_dokumen,c.keterangan,c.id_tahap';
				$data['DataArsitektur']	= $this->Mkonsultasi->getDataArsitekturBertahap($filterQuery, $id_jenis_permohonan, $tahap_pbg);
				//End Data Teknis Arsitektur
				//Begin Data Teknis Struktur
				$data['DataTeknisStruktur']	= $this->Mkonsultasi->getDataDokumen('a.*', $id);
				$filterQuery				= 'b.id_detail, b.id_syarat,c.id, c.nm_dokumen,c.keterangan,c.id_tahap';
				$data['DataStruktur']	= $this->Mkonsultasi->getDataStrukturBertahap($filterQuery, $id_jenis_permohonan, $tahap_pbg);
				//End Data Teknis Struktur
			}
			$data['content']	= $this->load->view('FormDataTeknisBertahap', $data, TRUE);
			$data['title']		=	'';
			$data['heading']	=	'';
			$this->load->view('template_pengajuan', $data);
		}else{
			$data['id_jenis_permohonan']	= $id_jenis_permohonan;
			if ($id != '') {
				$filterPemilik	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
				$data['DataPemilik']	= $this->Mkonsultasi->getPemilik($filterPemilik, $id);
				$filterBangunan	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,e.nm_konsultasi,f.dir_file,h.nama_kelurahan';
				$data['DataBangunan']	= $this->Mkonsultasi->getBangunan($filterBangunan, $id);
				//Begin Data Teknis Arsitektur
				$data['DataTeknisArsitektur']	= $this->Mkonsultasi->getDataDokumen('a.*', $id);
				$filterQuery				= 'b.id_detail, b.id_syarat,c.id, c.nm_dokumen,c.keterangan';
				$data['DataArsitektur']	= $this->Mkonsultasi->getDataArsitektur($filterQuery, $id_jenis_permohonan);
				//End Data Teknis Arsitektur
				//Begin Data Teknis Struktur
				$data['DataTeknisStruktur']	= $this->Mkonsultasi->getDataDokumen('a.*', $id);
				$filterQuery				= 'b.id_detail, b.id_syarat,c.id, c.nm_dokumen,c.keterangan';
				$data['DataStruktur']	= $this->Mkonsultasi->getDataStruktur($filterQuery, $id_jenis_permohonan);
				//End Data Teknis Struktur
			}
			$data['content']	= $this->load->view('FormDataTeknis', $data, TRUE);
			$data['title']		=	'';
			$data['heading']	=	'';
			$this->load->view('template_pengajuan', $data);
		}
	}
	public function FormDataMEP()
	{
		$id							= $this->uri->segment(3);
		//$id 						= $this->secure->decrypt_url($id);
		$data['id']			= $id;
		$permohonan = $this->Mkonsultasi->getDataJnsKonsultasi('a.*', $id)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		$tahap_pbg = $permohonan['tahap_pbg'];
		if($tahap_pbg != ''){
			$data['id_jenis_permohonan']	= $id_jenis_permohonan;
			if ($id != '') {
				$filterPemilik	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
				$data['DataPemilik']	= $this->Mkonsultasi->getPemilik($filterPemilik, $id);
				$filterBangunan	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,e.nm_konsultasi,f.dir_file,h.nama_kelurahan';
				$data['DataBangunan']	= $this->Mkonsultasi->getBangunan($filterBangunan, $id);
				//Begin Data Teknis MEP
				$data['DataTeknisMEP']	= $this->Mkonsultasi->getDataDokumen('a.*', $id);
				$filterQuery				= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan,c.id_tahap';
				$data['DataMPE']	= $this->Mkonsultasi->getDataMEPBertahap($filterQuery, $id_jenis_permohonan, $tahap_pbg);
				//End Data Teknis Struktur
			}
			$data['content']	= $this->load->view('FormDataMEPBertahap', $data, TRUE);
			$data['title']		=	'';
			$data['heading']	=	'';
			$this->load->view('template_pengajuan', $data);
		}else{
			$data['id_jenis_permohonan']	= $id_jenis_permohonan;
			if ($id != '') {
				$filterPemilik	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
				$data['DataPemilik']	= $this->Mkonsultasi->getPemilik($filterPemilik, $id);
				$filterBangunan	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,e.nm_konsultasi,h.nama_kelurahan';
				$data['DataBangunan']	= $this->Mkonsultasi->getBangunan($filterBangunan, $id);
				//Begin Data Teknis MEP
				$data['DataTeknisMEP']	= $this->Mkonsultasi->getDataDokumen('a.*', $id);
				$filterQuery				= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan,c.id_tahap';
				//$filterQuery				= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan';
				$data['DataMPE']	= $this->Mkonsultasi->getDataMEP($filterQuery, $id_jenis_permohonan);
				//End Data Teknis MEP
			}
			$data['content']	= $this->load->view('FormDataMEP', $data, TRUE);
			$data['title']		=	'';
			$data['heading']	=	'';
			$this->load->view('template_pengajuan', $data);
		}
	}

	public function FormDataHijau()
	{
		$id							= $this->uri->segment(3);
		//$id 						= $this->secure->decrypt_url($id);
		$data['id']			= $id;
		$permohonan = $this->Mkonsultasi->getDataJnsKonsultasi('a.*', $id)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		$tahap_pbg = $permohonan['tahap_pbg'];
		if ($id != '') {
			$filterPemilik	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
			$data['DataPemilik']	= $this->Mkonsultasi->getPemilik($filterPemilik, $id);
			$filterBangunan	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,e.nm_konsultasi,h.nama_kelurahan';
			$data['DataBangunan']	= $this->Mkonsultasi->getBangunan($filterBangunan, $id);
			//Begin Data Teknis MEP
			$data['DataTeknisMEP']	= $this->Mkonsultasi->getDataDokumen('a.*', $id);
			$filterQuery				= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan';
			$data['DataMPE']	= $this->Mkonsultasi->getDataHijau($filterQuery, $id_jenis_permohonan, $tahap_pbg);
			//End Data Teknis MEP
		}
		$data['content']	= $this->load->view('FormDataHijau', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('template_pengajuan', $data);
	}

	public function SaveDokumen()
	{
		$id							= $this->uri->segment(3);
		$id_syarat					= $this->uri->segment(4);
		$kode_jenis_syarat			= $this->uri->segment(5);
		$id_administrasi			= $this->uri->segment(6);
		$data['id']		= $id;
		$data['id_syarat']			= $id_syarat;
		$file_element_name 	= 'd_file';
		$config = [
			'upload_path' 	=> './object-storage/dekill/Requirement/',
			'allowed_types' => 'pdf|PDF',
			'max_size' 		=> '54000',
			'encrypt_name' 	=>  TRUE,
			'remove_space' 	=> TRUE,
		];
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		//id_persyaratan_detail
		if (!empty($_FILES)) {
			if (!$this->upload->do_upload('d_file')) {
				$error['upload'] = $this->upload->display_errors();
				$this->session->set_flashdata('message', $this->upload->display_errors());
				// $this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'danger');
				if ($kode_jenis_syarat == '5') {
					redirect('Konsultasi/FormDataDokumen/' . $id);
				} else if ($kode_jenis_syarat == '2') {
					redirect('Konsultasi/FormDataTeknis/' . $id);
				} else if ($kode_jenis_syarat == '1') {
					redirect('Konsultasi/FormDataTanah/' . $id);
				} else if ($kode_jenis_syarat == '4') {
					redirect('Konsultasi/FormDataMEP/' . $id);
				} else if ($kode_jenis_syarat == '3') {
					redirect('Konsultasi/FormDataTeknis/' . $id);
				}
			} else {
				if ($file_element_name != '') {
					$file_undangan = $this->upload->data();
					$filename = $file_undangan['file_name'];
				} else {
					$filename = $_FILES['d_file']['name'];
				}
				$dataPersyaratan = array(
					'id' => $id,
					'dir_file' => $filename,
					'id_persyaratan' => $kode_jenis_syarat,
					'id_persyaratan_detail' =>  $id_syarat
				);
				$this->Mglobals->setData('tmpersyaratankonsultasi', $dataPersyaratan, 'id', $id_administrasi);
				$this->session->set_flashdata('message', 'Berkas Berhasil Disimpan !.');
				$this->session->set_flashdata('status', 'success');
				if ($kode_jenis_syarat == '5') {
					redirect('Konsultasi/FormDataDokumen/' . $id);
				} else if ($kode_jenis_syarat == '2') {
					redirect('Konsultasi/FormDataTeknis/' . $id);
				} else if ($kode_jenis_syarat == '1') {
					redirect('Konsultasi/FormDataTanah/' . $id);
				} else if ($kode_jenis_syarat == '4') {
					redirect('Konsultasi/FormDataMEP/' . $id);
				} else if ($kode_jenis_syarat == '3') {
					redirect('Konsultasi/FormDataTeknis/' . $id);
				}
			}
		}
	}
	public function DeleteTeknisTanah()
	{
		$id_detail 	= $this->uri->segment(3);
		$key_syarat = $this->uri->segment(4);
		$id 		= $this->uri->segment(5);
		$dir 		= './object-storage/dekill/Earth/' . $this->uri->segment(6);
		$data['pesan'] = '';
		$data['err_msg'] = '';
		if (trim($id_detail) != '') {
			try {
				$this->Mkonsultasi->RemoveTeknisTanah($id_detail);
				$this->session->set_flashdata('message', 'Berkas Berhasil Dihapus.');
				$this->session->set_flashdata('status', 'success');
				unlink($dir);
				redirect('Konsultasi/FormDataTanah/' . $id);
			} catch (Exception $e) {
				$this->session->set_flashdata('message', 'Berkas Gagal Dihapus.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Konsultasi/FormDataTanah/' . $id);
			}
		}
	}
	public function DeleteTeknis()
	{
		$id_detail = $this->uri->segment(3);
		$key_syarat = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		$dir = './file/konsultasi/' . $this->uri->segment(6);
		$data['pesan'] = '';
		$data['err_msg'] = '';
		if (trim($id_detail) != '') {
			try {
				$this->Mkonsultasi->RemoveTeknisTanah($id_detail);
				$this->session->set_flashdata('message', 'Berkas Berhasil Dihapus.');
				$this->session->set_flashdata('status', 'success');
				unlink($dir);
				redirect('Konsultasi/FormDataTeknis/' . $id);
			} catch (Exception $e) {
				$this->session->set_flashdata('message', 'Berkas Gagal Dihapus.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Konsultasi/FormDataTeknis/' . $id);
			}
		}
	}
	public function DeleteMEP()
	{
		$id_detail = $this->uri->segment(3);
		$key_syarat = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		$dir = './file/konsultasi/' . $this->uri->segment(6);
		$data['pesan'] = '';
		$data['err_msg'] = '';
		if (trim($id_detail) != '') {
			try {
				$this->Mkonsultasi->RemoveTeknisTanah($id_detail);
				$this->session->set_flashdata('message', 'Berkas Berhasil Dihapus.');
				$this->session->set_flashdata('status', 'success');
				unlink($dir);
				redirect('Konsultasi/FormDataMEP/' . $id);
			} catch (Exception $e) {
				$this->session->set_flashdata('message', 'Berkas Gagal Dihapus.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Konsultasi/FormDataMEP/' . $id);
			}
		}
	}
	//End Data Dokumen Administrasi dan Teknis
	public function FormPernyataan()
	{
		$id			= $this->uri->segment(3);
		$data['id']	= $id;
		if ($id != '') {
			$filterPemilik	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
			$data['DataPemilik']	= $this->Mkonsultasi->getPemilik($filterPemilik, $id);
			$data['DataTanah']		= $this->Mkonsultasi->getTanah('a.*', $id);
			$filterBangunan	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,e.nm_konsultasi,h.nama_kelurahan';
			$data['DataBangunan']	= $this->Mkonsultasi->getBangunan($filterBangunan, $id);
		}
		$data['Konsultasi'] = $this->Mkonsultasi->getDataKonsultasi('a.*', $id);
		$data['content']	= $this->load->view('FormPernyataan', $data, TRUE);
		$data['title']		=	'Form Pernyataan';
		$data['heading']	=	'';
		$this->load->view('template_pengajuan', $data);
	}
	public function saveDataPernyataan()
	{
		$user_id		= $this->session->userdata('loc_user_id');
		$user_id		= $this->Outh_model->Encryptor('decrypt', $user_id);
		$id				= $this->input->post('id');
		$pernyataan		=  $this->input->post('pernyataan');
		$tgl_skrg 		= date('Y-m-d');
		$no_konsultasi 	= $this->nomor_registrasi($id);
		if ($pernyataan == '1') {
			$data	= array(
				'pernyataan' => $pernyataan,
				'no_konsultasi' => $no_konsultasi,
				'tgl_pernyataan' => $tgl_skrg,
				'status' => '1',
				'post_date' => date('Y-m-d')
			);
			$cek = $this->Mkonsultasi->cekNamaNoKonsultasi('a.id,a.no_konsultasi', $no_konsultasi);
			if ($cek->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Gagal Simpan Karena ada kesalahan silahkan simpan ulang!!!');
				$this->session->set_flashdata('status', 'danger');
				redirect('Konsultasi/FormPernyataan/'. $id);
			} else {
				$query		= $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Menu Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');

					$this->load->library('ciqrcode'); //pemanggilan library QR CODE
					$config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
					$config['quality']      = true; //boolean, the default is true
					$config['size']         = '1024'; //interger, the default is 1024
					$config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
					$config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
					$this->ciqrcode->initialize($config);
					$image_name = $no_konsultasi . '.png'; //buat name dari qr code sesuai dengan nim
					$params['data'] = 'http://simbg.pu.go.id/Main/Konsultasi/' . $no_konsultasi; //data yang akan di jadikan QR CODE
					$params['level'] = 'H'; //H=High
					$params['size'] = 10;
					$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
					$data['QR'] = $this->ciqrcode->generate($params);
					redirect('Konsultasi');
				} else {
					$this->session->set_flashdata('message', 'Data Menu Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('Konsultasi/FormPernyataan/'.$id);
				}
			}
			/*$this->load->library('ciqrcode'); //pemanggilan library QR CODE
			$config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
			$config['quality']      = true; //boolean, the default is true
			$config['size']         = '1024'; //interger, the default is 1024
			$config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
			$config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$image_name = $no_konsultasi . '.png'; //buat name dari qr code sesuai dengan nim
			$params['data'] = 'http://simbg.pu.go.id/Main/Konsultasi/' . $no_konsultasi; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
			$data['QR'] = $this->ciqrcode->generate($params);*/
		}
		redirect('Konsultasi');
	}
	public function nomor_registrasi($id = null)
	{
		$que = $this->Mkonsultasi->get_id_kabkot($id);
		$no_reg_awal = $que['id_kec_bgn'];
		$id_izin = $que['id_izin'];
		$tgl_disetujui = date('d') . date('m') . date('Y');;
		$mydata2 = $this->Mkonsultasi->get_nomor_registrasi($no_reg_awal, $tgl_disetujui);
		if ($id_izin == '2') {
			if (count($mydata2) > 0) {
				$no_baru = SUBSTR($mydata2['no_urut'], -2) + 1;
				if ($no_baru < 10) {
					$no_registrasi = "SLF-" . $no_reg_awal . "-" . $tgl_disetujui . "-0" . $no_baru;
				} else {
					$no_registrasi = "SLF-" . $no_reg_awal . "-" . $tgl_disetujui . "-" . $no_baru;
				}
			} else {
				$no_registrasi = "SLF-" . $no_reg_awal . "-" . $tgl_disetujui . "-01";
			}
		} else {
			if (count($mydata2) > 0) {
				$no_baru = SUBSTR($mydata2['no_urut'], -2) + 1;
				if ($no_baru < 10) {
					$no_registrasi = "PBG-" . $no_reg_awal . "-" . $tgl_disetujui . "-0" . $no_baru;
				} else {
					$no_registrasi = "PBG-" . $no_reg_awal . "-" . $tgl_disetujui . "-" . $no_baru;
				}
			} else {
				$no_registrasi = "PBG-" . $no_reg_awal . "-" . $tgl_disetujui . "-01";
			}
		}
		return $no_registrasi;
	}
	private function isDecimal($val)
	{
		return is_numeric($val) && floor($val) != $val;
	}
	public function FormSummary($id = NULL)
	{
		$getPermohonan = $this->Mkonsultasi->getRowKonsultasi($id);
		if ($getPermohonan->num_rows() > 0) {
			$row = $getPermohonan->row();
			$filterPemilik	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
			$filterBangunan	= 'a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,e.nm_konsultasi,g.jns_prasarana';
			$filterQuery = 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan';
			$jumlahLantai = $row->jml_lantai;
			$lapisBsement = $row->lapis_basement;
			$getKoefisienLantai = $this->Mkonsultasi->getKoefisienLantai($jumlahLantai)->row();
			$getKoefisienBasement = $this->Mkonsultasi->getKoefisienBasement($lapisBsement)->row();
			$kl = $getKoefisienLantai === NULL ? 0 : $getKoefisienLantai->koefisien_lantai;
			$kb = $getKoefisienBasement === NULL ? 0 : $getKoefisienBasement->koefisien_basement;
			$koefisienLantai = $this->isDecimal($kl) === true ? number_format((float)$getKoefisienLantai->koefisien_lantai, 3, '.', '') : intval($kl);
			$koefisienBasement = $this->isDecimal($kb) === true ? number_format((float)$getKoefisienBasement->koefisien_basement, 3, '.', '') : intval($kb);
			$retribusi = $this->Mkonsultasi->getRowRetribusi($id)->row();
			$skrd = $this->Mkonsultasi->getRowSKRD($id)->row();
			$data = [
				'row' 					=> $row,
				'status' 				=> $row->status,
				'imb' 					=> $row->imb,
				'id_izin' 				=> $row->id_izin,
				'id' 					=> $row->id_pemilik,
				'jns_kepemilikan' => $row->jns_pemilik,
				'id_jenis_permohonan' => $row->id_jenis_permohonan,
				'DataTanah' => $this->Mkonsultasi->getTanah('a.*,b.Jns_dok', $id),
				'DataTeknisTanah'  => $this->Mkonsultasi->getDataDokumen('a.*', $id),
				'DataTkTanah' => $this->Mkonsultasi->getDataTanah($filterQuery, $row->id_jenis_permohonan),
				'DataUmum' => $this->Mkonsultasi->getDataDokumen('a.*', $id),
				'DokumenUmum' => $this->Mkonsultasi->getDataUmum($filterQuery, $row->id_jenis_permohonan),
				'DataArsitektur' => $this->Mkonsultasi->getDataArsitektur($filterQuery, $row->id_jenis_permohonan),
				'DataStruktur' => $this->Mkonsultasi->getDataStruktur($filterQuery, $row->id_jenis_permohonan),
				'DataMPE' => $this->Mkonsultasi->getDataMEP($filterQuery, $row->id_jenis_permohonan),
				'kegiatan' => $this->Mkonsultasi->getKegiatan()->result(),
				'DataPemilik' => $this->Mkonsultasi->getPemilik($filterPemilik, $id),
				'DataBangunan' => $this->Mkonsultasi->getBangunan($filterBangunan, $id),
				'title' => 'Summary Permohonan',
				'koefisienLantai' => $koefisienLantai,
				'koefisienBasement' => $koefisienBasement,
				'retribusi' => $retribusi,
				'skrd' => $skrd,
				'heading' => '',
			];
			$this->template->load('template/template_backend', 'Summary/DataSummary', $data);
		} else {
			$this->session->set_flashdata('message', 'Data Konsultasi Tidak Ditemukan!');
			$this->session->set_flashdata('status', 'warning');
			redirect('Konsultasi');
		}
	}
	public function getDataKabKota()
	{
		$crsf = $this->security->get_csrf_hash();
		$id_provinsi	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $id_provinsi);
		if ($query->num_rows() > 0 && $id_provinsi != '') {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kabkot' => $row->id_kabkot, 'nama_kabkota' => $row->nama_kabkota);
			}
		}
		$value['csrf']  = $crsf;
		echo json_encode($value);
	}
	public function getDataKecamatan()
	{
		$crsf = $this->security->get_csrf_hash();
		$id_kabkot	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $id_kabkot);
		if ($query->num_rows() > 0 && $id_kabkot != '') {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kecamatan' => $row->id_kecamatan, 'nama_kecamatan' => $row->nama_kecamatan);
			}
		}
		$value['csrf']  = $crsf;
		echo json_encode($value);
	}
	public function getDataKelurahan()
	{
		$crsf = $this->security->get_csrf_hash();
		$id_kecamatan	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mglobal->listDataKelurahan('a.id_kelurahan,a.nama_kelurahan', '', $id_kecamatan);
		if ($query->num_rows() > 0 && $id_kecamatan != '') {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kelurahan' => $row->id_kelurahan, 'nama_kelurahan' => $row->nama_kelurahan);
			}
		}
		$value['csrf']  = $crsf;
		echo json_encode($value);
	}
	public function getDataJnsBg()
	{
		$crsf = $this->security->get_csrf_hash();
		$id_fungsi_bg	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mglobals->getData('*', 'tm_jenis_bg', array('id_fungsi_bg' => $id_fungsi_bg));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_jns_bg' => $row->id_jns_bg, 'nm_jenis_bg' => $row->nm_jenis_bg);
			}
		}
		$value['csrf'] = $crsf;
		echo json_encode($value);
	}
	public function bayar_retribusi()
	{
		$id = $this->uri->segment(3);
		$tgl_pembayaran = date('Y-m-d');
		$id = $this->input->post('id', TRUE);
		$thisdir = getcwd();
		$dirPath = $thisdir . "/object-storage/dekill/Retribution/";
		$config = [
			'upload_path' => $dirPath,
			'allowed_types' => 'pdf|PDF',
			'max_size' => '50000',
			'max_width' => 5000,
			'max_height' => 5000,
			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('bukti_upload')) {
			$this->session->set_flashdata('message', $this->upload->display_errors());
			$this->session->set_flashdata('status', 'danger');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			if ($this->upload->data('file_ext') == ".pdf" || $this->upload->data('file_ext') == ".PDF") {
				$data = [
					'id' => $id,
					'bukti_pembayaran' => $this->upload->data('file_name'),
					'tgl_pembayaran' => $tgl_pembayaran,
				];
				$this->Mkonsultasi->insertDataPembayaran($data);
				$this->session->set_flashdata('message', 'Pembayaran Retribusi Berhasil Disimpan!');
				$this->session->set_flashdata('status', 'success');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$path = FCPATH . "/{$this->pathRetribusi}";
				$berkas = $path . $this->upload->data('file_name');
				if (!unlink($berkas)) {
				}
				$this->session->set_flashdata('message', 'Silahkan Upload Berkas Menggunakan Format PDF!');
				$this->session->set_flashdata('status', 'warning');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
	//Begin Revisi Dokumen
	public function FormPerbaikan()
	{
		$id							= $this->uri->segment(3);
		$data['id']					= $id;
		$permohonan 				= $this->Mkonsultasi->getDataJnsKonsultasi('a.*', $id)->row_array();
		$id_jenis_permohonan 		= $permohonan['id_jenis_permohonan'];
		$status 					= $permohonan['status'];
		$no_konsultasi 				= $permohonan['no_konsultasi'];
		$data['id_jenis_permohonan']= $id_jenis_permohonan;
		$data['status'] 			= $status;
		$data['no_konsultasi'] 		= $no_konsultasi;

		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['daftar_kabkota']		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota');
		$data['daftar_kecamatan']	= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan');
		$filterPemilik	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
		$filterBangunan	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,i.nm_konsultasi';
		//Begin Data Tanah dan Data Teknis Tanah
		$data['DataTanah']		= $this->Mkonsultasi->getTanah('a.*,b.Jns_dok', $id);
		$data['DataTeknisTanah']	= $this->Mkonsultasi->getDataDokumen('a.*', $id);
		$filterQuery				= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan';
		$data['DataTkTanah']	= $this->Mkonsultasi->getDataTanah($filterQuery, $id_jenis_permohonan);
		//End Data Tanah dan Data Teknis Tanah
		//Begin Data Dokumen Umum
		$data['DataUmum']		= $this->Mkonsultasi->getDataDokumen('a.*', $id);
		$filterUmum			= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan';
		$data['DokumenUmum']	= $this->Mkonsultasi->getDataUmum($filterUmum, $id_jenis_permohonan);
		//End Data Dokumen Umum
		//Begin Data Arsitektur dan Struktur
		$data['DataTeknisArsitektur']	= $this->Mkonsultasi->getDataDokumen('a.*', $id);
		$filterArsitektur				= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan';
		$data['DataArsitektur']	= $this->Mkonsultasi->getDataArsitektur($filterArsitektur, $id_jenis_permohonan);

		$data['DataTeknisStruktur']	= $this->Mkonsultasi->getDataDokumen('a.*', $id);
		$filterStruktur				= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan';
		$data['DataStruktur']	= $this->Mkonsultasi->getDataStruktur($filterStruktur, $id_jenis_permohonan);
		//End Data Arsitektur dan Struktur
		//Begin Data teknis MEP
		$data['DataTeknisMEP']	= $this->Mkonsultasi->getDataDokumen('a.*', $id);
		$filterMEP				= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan';
		$data['DataMPE']	= $this->Mkonsultasi->getDataMEP($filterMEP, $id_jenis_permohonan);
		//End Data Teknis MEP
		//Begin Data Informasi Perbaikan
		$data['DataInformasi']		= $this->Mkonsultasi->getInformasi('a.*', $id);
		//End Data Informasi Perbaikan

		$data['DataPemilik']	= $this->Mkonsultasi->getPemilik($filterPemilik, $id);
		$data['DataBangunan'] 	= $this->Mkonsultasi->getBangunan($filterBangunan, $id);
		$data['content']	= $this->load->view('RevisiVerifikasi/DataSummary', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('template_pengajuan', $data);
	}
	public function SimpanTanahPerbaikan()
	{
		$user_id						= $this->session->userdata('loc_user_id');
		$id_tanah						= $this->input->post('id_tanah');
		$id								= $this->input->post('id');
		$id_dokumen						= $this->input->post('id_dokumen');
		$nama_jns_dok_lain				= $this->input->post('nama_jns_dok_lain');
		$nomor_dokumen					= $this->input->post('nomor_dokumen');
		$tgl_terbit_dokumen				= $this->input->post('tgl_terbit_dokumen');
		$lokasi_tanah					= $this->input->post('lokasi_tanah');
		$nama_provinsi					= $this->input->post('nama_provinsi');
		$nama_kabkota					= $this->input->post('nama_kabkota');
		$nama_kecamatan					= $this->input->post('nama_kecamatan');
		$luas_tanah						= $this->input->post('luas_tanah');
		$nama_pemegang_hak_atas_tanah	= $this->input->post('atas_nama');
		$hat							= $this->input->post('hat');
		$hat2							= $this->input->post('hat2');
		$id_status_izin_pemanfaatan		= $this->input->post('id_status_izin_pemanfaatan');
		$no_dok_izin_pemanfaatan		= $this->input->post('no_dok_izin_pemanfaatan');
		$tgl_terbit_pemanfaatan			= $this->input->post('tgl_terbit_phat');
		$nama_pemegang_izin				= $this->input->post('nama_penerima_kuasa');
		//Upload file 
		$file_tanah = 'd_file_tan';
		$lam_tanah = $this->input->post('dir_file_tan');
		$filename_tanah = $_FILES['d_file_tan']['name'];

		$file_phat = 'd_file_phat';
		$lam_phat = $this->input->post('dir_file_phat');
		$filename_phat = $_FILES['d_file_phat']['name'];

		$thisdir = getcwd();
		$dirPath = $thisdir . "/object-storage/dekill/Earth/";

		$config['upload_path'] 		= $dirPath;
		$config['allowed_types'] 	= 'pdf||PDF';
		$config['max_size']			= '50240';
		$config['remove_spaces']	= False;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$file_tan = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES["d_file_tan"]['name']);
		$file_phat = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES["d_file_phat"]['name']);
		if ($_FILES["d_file_tan"]["name"]) {
			$config["file_name"] = $file_tan;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$d_file_tan = $this->upload->do_upload('d_file_tan');
			$filetan = $this->upload->data();
			if (!$d_file_tan) {
				$data['err_msg'] = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'warning');
				redirect('Konsultasi/FormPerbaikan/' . $id . '#tab2');
			}
		}
		if ($_FILES["d_file_phat"]["name"]) {
			$config["file_name"] = $file_phat;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$d_file_phat = $this->upload->do_upload('d_file_phat');
			$filephat = $this->upload->data();
			if (!$d_file_phat) {
				$data['err_msg'] = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'warning');
				redirect('Konsultasi/FormPerbaikan/' . $id . '#tab2');
			}
		}
		$data	= array(
			'id' 					=> $id,
			'id_dokumen' 			=> $id_dokumen,
			'dir_file' 				=> $filetan['file_name'],
			'jenis_dokumen_phat' 	=> $nama_jns_dok_lain,
			'no_dok' 				=> $nomor_dokumen,
			'tanggal_dok' 			=> date('Y-m-d', strtotime($tgl_terbit_dokumen)),
			'lokasi_tanah' 			=> $lokasi_tanah,
			'id_provinsi' 			=> $nama_provinsi,
			'id_kabkot' 			=> $nama_kabkota,
			'id_kecamatan' 			=> $nama_kecamatan,
			'luas_tanah' 			=> $luas_tanah,
			'atas_nama_dok' 		=> $nama_pemegang_hak_atas_tanah,
			'status_phat' 			=> $hat2,
			'dir_file_phat' 		=> $filephat['file_name'],
			'no_dokumen_phat' 		=> $no_dok_izin_pemanfaatan,
			'nama_penerima_phat' 	=> $nama_pemegang_izin,
			'hat' 					=> $hat,
			'tgl_terbit_phat' 		=> date('Y-m-d', strtotime($tgl_terbit_pemanfaatan)),
		);
		if ($id_tanah != "") {
			$query		= $this->Mglobals->setData('tmdatatanah', $data, 'id_permohonan_detail_tanah', $id_tanah);
			$this->session->set_flashdata('message', 'Data Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('Konsultasi/FormPerbaikan/' . $id);
		} else {
			$query		= $this->Mglobals->setData('tmdatatanah', $data, 'id_permohonan_detail_tanah', $id_tanah);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Konsultasi/FormPerbaikan/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Konsultasi/FormPerbaikan/' . $id);
			}
		}
	}
	public function removeTanah($id)
	{
		$id_tanah	= $this->uri->segment(3);
		$id			= $this->uri->segment(4);
		$process = $this->Mkonsultasi->removeDataTanah($id_tanah);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Tanah Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Tanah Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Konsultasi/FormPerbaikan/' . $id);
	}
	public function UploadPerbaikan()
	{
		$id							= $this->uri->segment(3);
		$id_syarat					= $this->uri->segment(4);
		$kode_jenis_syarat			= $this->uri->segment(5);
		$id_administrasi			= $this->uri->segment(6);
		$data['id']		= $id;
		$data['id_syarat']			= $id_syarat;
		$file_element_name 	= 'd_file';
		$config = [
			'upload_path' => './object-storage/dekill/Requirement/',
			'allowed_types' => 'pdf|PDF',
			'max_size' => '54000',
			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		//id_persyaratan_detail
		if (!empty($_FILES)) {
			if (!$this->upload->do_upload('d_file')) {
				$error['upload'] = $this->upload->display_errors();
				$this->session->set_flashdata('message', $this->upload->display_errors());
				// $this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'danger');
				if ($kode_jenis_syarat == '5') {
					redirect('Konsultasi/FormPerbaikan/' . $id);
				} else if ($kode_jenis_syarat == '2') {
					redirect('Konsultasi/FormPerbaikan/' . $id);
				} else if ($kode_jenis_syarat == '1') {
					redirect('Konsultasi/FormPerbaikan/' . $id);
				} else if ($kode_jenis_syarat == '4') {
					redirect('Konsultasi/FormPerbaikan/' . $id);
				} else if ($kode_jenis_syarat == '3') {
					redirect('Konsultasi/FormPerbaikan/' . $id);
				}
			} else {
				if ($file_element_name != '') {
					$file_undangan = $this->upload->data();
					$filename = $file_undangan['file_name'];
				} else {
					$filename = $_FILES['d_file']['name'];
				}
				$dataPersyaratan = array(
					'id' => $id,
					'dir_file' => $this->upload->data('file_name'),
					'id_persyaratan' => $kode_jenis_syarat,
					'id_persyaratan_detail' =>  $id_syarat
				);
				$this->Mglobals->setData('tmpersyaratankonsultasi', $dataPersyaratan, 'id', $id_administrasi);
				$this->session->set_flashdata('message', 'Berkas Berhasil Disimpan !.');
				$this->session->set_flashdata('status', 'success');
				if ($kode_jenis_syarat == '5') {
					redirect('Konsultasi/FormPerbaikan/' . $id);
				} else if ($kode_jenis_syarat == '2') {
					redirect('Konsultasi/FormPerbaikan/' . $id);
				} else if ($kode_jenis_syarat == '1') {
					redirect('Konsultasi/FormPerbaikan/' . $id);
				} else if ($kode_jenis_syarat == '4') {
					redirect('Konsultasi/FormPerbaikan/' . $id);
				} else if ($kode_jenis_syarat == '3') {
					redirect('Konsultasi/FormPerbaikan/' . $id);
				}
			}
		}
	}
	public function SaveDokumen1()
	{
		$id							= $this->uri->segment(3);
		$id_syarat					= $this->uri->segment(4);
		$kode_jenis_syarat			= $this->uri->segment(5);
		$id_administrasi			= $this->uri->segment(6);
		$data['id']		= $id;
		$data['id_syarat']			= $id_syarat;
		$file_element_name 	= 'd_file';
		$thisdir = getcwd();
		$dirPath = $thisdir . "/object-storage/dekill/Requirement/";
		$config['upload_path'] 		= $dirPath;
		$config['allowed_types'] 	= 'pdf|PDF';
		$config['max_size']			= '50240';
		$config['encrypt_name']		= TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		//id_persyaratan_detail
		if (!empty($_FILES)) {
			if (!$this->upload->do_upload('d_file')) {
				$error['upload'] = $this->upload->display_errors();
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'danger');
				if ($kode_jenis_syarat != '2') {
					redirect('Konsultasi/FormPerbaikan/' . $id);
				} else {
					redirect('Konsultasi/FormPerbaikan/' . $id);
				}
			} else {
				if ($file_element_name != '') {
					$file_undangan = $this->upload->data();
					$filename = $file_undangan['file_name'];
				} else {
					$filename = $_FILES['d_file']['name'];
				}
				$dataPersyaratan = array(
					'id' => $id,
					'dir_file' => $filename,
					'id_persyaratan' => $kode_jenis_syarat,
					'id_persyaratan_detail' =>  $id_syarat
				);
				$this->Mglobals->setData('tmpersyaratankonsultasi', $dataPersyaratan, 'id', $id_administrasi);
				$this->session->set_flashdata('message', 'Berkas Berhasil Disimpan !.');
				$this->session->set_flashdata('status', 'success');
				redirect('Konsultasi/FormPerbaikan/' . $id);
			}
		}
	}
	public function DeleteDokumenRev()
	{
		$id_detail = $this->uri->segment(3);
		$key_syarat = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		$data['pesan'] = '';
		$data['err_msg'] = '';
		if (trim($id_detail) != '') {
			try {
				$this->Mkonsultasi->RemoveTeknisDokumen($id_detail);
				$this->session->set_flashdata('message', 'Berkas Berhasil Dihapus.');
				$this->session->set_flashdata('status', 'success');
				redirect('Konsultasi/FormPerbaikan/' . $id);
			} catch (Exception $e) {
				$this->session->set_flashdata('message', 'Berkas Gagal Dihapus.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Konsultasi/FormPerbaikan/' . $id);
			}
		}
	}

	public function DeleteAdministrasi()
	{
		$id_detail = $this->uri->segment(3);
		$key_syarat = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		$dir = './file/konsultasi/' . $this->uri->segment(6);
		$data['pesan'] = '';
		$data['err_msg'] = '';
		if (trim($id_detail) != '') {
			try {
				$this->Mkonsultasi->RemoveTeknisTanah($id_detail);
				$this->session->set_flashdata('message', 'Berkas Berhasil Dihapus.');
				$this->session->set_flashdata('status', 'success');
				unlink($dir);
				redirect('Konsultasi/FormDataDokumen/' . $id);
			} catch (Exception $e) {
				$this->session->set_flashdata('message', 'Berkas Gagal Dihapus.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Konsultasi/FormDataDokumen/' . $id);
			}
		}
	}

	public function saveUlangPernyataan()
	{
		$user_id		= $this->session->userdata('loc_user_id');
		$user_id		= $this->Outh_model->Encryptor('decrypt', $user_id);
		$id				= $this->input->post('id');
		$pernyataan		= $this->input->post('pernyataan');
		$tgl_skrg 		= date('Y-m-d');
		$no_konsultasi	= $this->input->post('no_konsultasi');
		if ($pernyataan == '1') {
			$data	= array(
				'status' => '2',
			);
			$datalog	= [
				'id' => $id,
				'tgl_status' => $tgl_skrg,
				'status' => '2',
				'catatan' => 'Selesai Melalakukan Perbaikan Dokumen',
				//'dir_file' => $this->upload->data('file_name'),
				'modul' => 'Pernyataan Telah Selesai Memperbaiki Dokumen'
			];
			$this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
			$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Konsultasi');
	}

	public function grouping_data($id = NULL)
	{
		$check = [
			[
				'name' => 0,
				'value' => 3
			],
			[
				'name' => 0,
				'value' => 4
			],
			[
				'name' => 0,
				'value' => 5
			],
			// pengecekan dua kali
			[
				'name' => 1,
				'value' => 1
			],
			[
				'name' => 1,
				'value' => 6
			],
			[
				'name' => 1,
				'value' => 7
			],
			[
				'name' => 1,
				'value' => 14
			],
			[
				'name' => 1,
				'value' => 15
			],
			[
				'name' => 1,
				'value' => 16
			],
			[
				'name' => 1,
				'value' => 2
			],
			// pengecekan tiga kali
			[
				'name' => 2,
				'value' => 8
			],
			[
				'name' => 2,
				'value' => 9
			]
		];
		$key = $this->searchForId($id, $check);
		return $key;
	}
	function searchForId($id, $array)
	{
		foreach ($array as $k => $v) {
			if ($v['value'] === $id) {
				return $v['name'];
			}
		}
		return NULL;
	}
	public function FormRevisi($id = null)
	{
		$getId = $this->Mkonsultasi->get_permohonan_list($id);
		if ($getId->num_rows() > 0) {
			$row = $getId->row();
			$History= $this->Mkonsultasi->getCatatanKonsultasi('a.*', $id);
			$group = $this->grouping_data(intval($row->id_jenis_permohonan));
			$getStep = $this->Mkonsultasi->cekStep($id)->row();
			$cek = $getStep->data_step;
			$res = $cek == NULL ? 0 : intval($cek);
			if ($res == 0) {
				$dokumen = 2;
				$keteranganPemeriksaan = "Pemeriksaan Arsitektur";
			} else if ($res == 1) {
				$keteranganPemeriksaan = "Pemeriksaan Struktur";
				$dokumen = 3;
			} else {
				$keteranganPemeriksaan = "Pemeriksaan MEP";
				$dokumen = 4;
			}
			$getPersyaratan = $this->Mkonsultasi->getSyaratList($row->id_jenis_permohonan, $dokumen, null)->result();
			$persyaratan = [];
			foreach ($getPersyaratan as $g) {
				$p = $this->Mkonsultasi->getDataPemeriksaanKesesuaian($g->id_detail, $id)->row();
				$kesesuaian = $p == NULL ? 0 : $p->kesesuaian;
				$catatan = $p == NULL ? '' : $p->catatan;
				$berkas = $p == NULL ? '' : $p->dir_file;
				if ($kesesuaian == 0 || $kesesuaian == null ) {
					$persyaratan[] = [
						'id_jenis_permohonan' => $g->id_jenis_permohonan,
						'id_detail_jenis_persyaratan' => $g->id_detail_jenis_persyaratan,
						'id_detail' => $g->id_detail,
						'nm_dokumen' => $g->nm_dokumen,
						'kesesuaian' => $kesesuaian,
						'catatan' => $catatan == NULL ? '' : $catatan,
						'berkas' => $berkas
					];
				}
			}
			$data = array(
				'id' => $id,
				'id_konsultasi' => $row->id_pemilik,
				'no_konsultasi' => $row->no_konsultasi,
				'nm_pemilik' => $row->nm_pemilik,
				'alamat' => $row->alamat,
				'status' => $row->status,
				'nama_kecamatan' => $row->nama_kecamatan,
				'nama_kabkota' => $row->nama_kabkota,
				'nm_konsultasi' => $row->nm_konsultasi,
				'nama_kec_bg' => $row->nama_kec_bg,
				'nama_kabkota_bg' => $row->nama_kabkota_bg,
				'nama_provinsi_bg' => $row->nama_provinsi_bg,
				'fungsi_bg' => $row->fungsi_bg,
				'almt_bgn' => $row->almt_bgn,
				'tinggi_bgn' => $row->tinggi_bgn,
				'luas_bgn' => $row->luas_bgn,
				'jml_lantai' => $row->jml_lantai,
				'email' => $row->email,
				'id_provinsi' => $row->id_provinsi,
				'id_kabkota' => $row->id_kabkota,
				'id_kecamatan' => $row->id_kecamatan,
				'nm_bgn' => $row->nm_bgn,
				'id_prov_bgn' => $row->id_prov_bgn,
				'id_kabkot_bgn' => $row->id_kabkot_bgn,
				'id_kec_bgn' => $row->id_kec_bgn,
				'id_jenis_permohonan' => $row->id_jenis_permohonan,
				'luas_basement' => $row->luas_basement,
				'lapis_basement' => $row->lapis_basement,
				'tipeA' => $row->tipeA,
				'luasA' => $row->luasA,
				'lantaiA' => $row->lantaiA,
				'tinggiA' => $row->tinggiA,
				'jumlahA' => $row->jumlahA,
				'persyaratan' => $persyaratan,
				'History' => $History,
				'heading'  => '',
				'keterangan' => $keteranganPemeriksaan
			);
			if ($group === 0) {
				$this->template->load('template/template_backend', 'Konsultasi/RevisiTeknis/revisi_teknis', $data);
			} else if ($group === 1) {
				$this->template->load('template/template_backend', 'Konsultasi/RevisiTeknis/revisi_teknis', $data);
			} else if ($group === 2) {
				$this->template->load('template/template_backend', 'Konsultasi/RevisiTeknis/revisi_teknis', $data);
			} else {
				$this->template->load('template/template_backend', 'Konsultasi/RevisiTeknis/revisi_teknis', $data);
			}
		} else {
			redirect('Konsultasi');
		}
	}
	public function simpan_berkas()
	{
		$dataKonsultasi = $this->input->post('dataKonsultasi', TRUE);
		$dataId = $this->input->post('dataId', TRUE);
		$dataVal = $this->input->post('dataVal', TRUE);
		$config = [
			'upload_path' =>  "./{$this->pathBerkas}",
			'allowed_types' => 'pdf|PDF',
			'max_size' => '50000',
			'max_width' => 5000,
			'max_height' => 5000,
			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];
		$this->load->library('upload', $config);
		$cekData =  $this->Mkonsultasi->getDataBerkas($dataKonsultasi, $dataVal, $dataId);
		if ($cekData->num_rows() > 0) {
			if (!$this->upload->do_upload('berkas')) {
				$output = [
					'status' => false,
					'type' => 'error',
					'message' => 'Silahkan Upload Berkas Terlebih Dahulu!'
				];
				header('Content-Type: application/json');
				echo json_encode($output);
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$path = FCPATH . $this->pathBerkas;
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
					}
					$output = [
						'status' => false,
						'type' => 'warning',
						'message' => 'Silahkan Upload Berkas Menggunakan Format PDF!'
					];
					header('Content-Type: application/json');
					echo json_encode($output);
				} else {
					$data = [
						'dir_file' => $this->upload->data('file_name')
					];
					$cekFile = $this->Mkonsultasi->cekBerkas($dataKonsultasi, $dataVal, $dataId)->row()->dir_file;
					if ($cekFile == NULL) {
						$this->Mkonsultasi->updateBerkas($dataKonsultasi, $dataVal, $dataId, $data);
						$output = [
							'status' => true,
							'type' => 'success',
							'message' => 'Data Berkas Berhasil Diupload!',
							'result' => "file/Requirement/" . $this->upload->data('file_name')
						];
						header('Content-Type: application/json');
						echo json_encode($output);
					} else {
						$path = FCPATH . $this->pathBerkas;
						$fileLama = $path . $cekFile;
						$this->Mkonsultasi->updateBerkas($dataKonsultasi, $dataVal, $dataId, $data);
						$output = [
							'status' => true,
							'type' => 'success',
							'message' => 'Data Berkas Berhasil Diupload!',
							'result' => "object-storage/dekill/Konsultasi/{$dataKonsultasi}/Dokumen/" . $this->upload->data('file_name')
						];
						header('Content-Type: application/json');
						echo json_encode($output);
					}
				}
			}
		} else {
			if (!$this->upload->do_upload('berkas')) {
				$output = [
					'status' => false,
					'type' => 'error',
					'message' => 'Silahkan Upload Berkas Terlebih Dahulu!'
				];
				header('Content-Type: application/json');
				echo json_encode($output);
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$path = FCPATH . $this->pathBerkas;
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
					}
					$output = [
						'status' => false,
						'type' => 'warning',
						'message' => 'Silahkan Upload Berkas Menggunakan Format PDF!'
					];
					header('Content-Type: application/json');
					echo json_encode($output);
				} else {
					$data = [
						'id' => $dataKonsultasi,
						'id_persyaratan' => $dataId,
						'id_persyaratan_detail' => $dataVal,
						'dir_file' => $this->upload->data('file_name')
					];
					$this->Mkonsultasi->insertBerkas($data);
					$output = [
						'status' => true,
						'type' => 'success',
						'message' => 'Data Berkas Berhasil Diupload!',
						'result' => "object-storage/dekill/Requirement/" . $this->upload->data('file_name')
					];
					header('Content-Type: application/json');
					echo json_encode($output);
				}
			}
		}
	}
	public function SimpanRevisi()
	{
		$jenis = $this->input->post('jenis', TRUE);
		$syarat = $this->input->post('syarat', TRUE);
		$dataKonsultasi = $this->input->post('dataKonsultasi', TRUE);
		$pemeriksaan = $this->Mkonsultasi->getSyaratListId($jenis, $syarat);
		$cek = [];
		$not = 0;
		$done = 0;
		foreach ($pemeriksaan->result() as $r) {
			$p = $this->Mkonsultasi->getDataPemeriksaanKesesuaian($r->id_detail, $dataKonsultasi)->row();
			$not = $p != NULL ? $not++ : $not;
			$kesesuaian = $p == NULL ? 0 : $p->kesesuaian;
			$cek[] = [
				'nm_dokumen' => $r->nm_dokumen,
				'kesesuaian' => $kesesuaian,
			];
		}
		foreach ($cek as $x) {
			if ($x['kesesuaian'] == 0) {
				$not++;
			}
			if ($x['kesesuaian'] == 1) {
				$done++;
			}
		}
		$output = [
			'status' => $done > 0 ? true : false,
			'type' => 'success',
			'message' => 'Hasil Data Penilaian',
			'result' => $cek,
			'not' => $not
		];
		header('Content-Type: application/json');
		echo json_encode($output);
	}
	public function SimpanStatus()
	{
		$id = $this->input->post('id');
		$update = [
			'status' => 8
		];
		$this->Mkonsultasi->updateStatsPbg($id, $update);
		$this->session->set_flashdata('message', 'Data Berhasil Disimpan');
		$this->session->set_flashdata('status', 'success');
		redirect('Konsultasi');
	}
	public function removeDataPengajuan($id)
	{
		$process = $this->Mkonsultasi->removeDataPermohonan($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Permohonan Berhasil Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Permohonan Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Konsultasi');
	}
	//End Revisi Dokumen
	public function QrCode()
	{
		$no_konsultasi	= '452219';
		$this->load->library('ciqrcode'); //pemanggilan library QR CODE
		$config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
		$config['quality']      = true; //boolean, the default is true
		$config['size']         = '1024'; //interger, the default is 1024
		$config['black']        = array(224,255,255); // array, default is arra/y(255,255,255)
		$config['white']        = array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);
		$image_name=$no_konsultasi.'.png'; //buat name dari qr code sesuai dengan nim
		//$params['data'] = 'https://simbg.pu.go.id/Main/Berkas/'.$no_konsultasi; //data yang akan di jadikan QR CODE  SLF SIMBG ver Baru
		//$params['data'] = 'https://simbg.pu.go.id/Main/VerifikasiPBG/'.$no_konsultasi; //data yang akan di jadikan QR CODE PBG
		//$params['data'] = 'https://simbg.pu.go.id/Main/Konsultasi/'.$no_konsultasi; //data yang akan di jadikan QR CODE PBG
		//$params['data'] = 'https://simbg.pu.go.id/Main/DraftSLF/'.$sk_slf; //data yang akan di jadikan QR CODE SLF
		//$params['data'] = 'https://simbg.pu.go.id/Main/VerifikasiBerkas/'.$sk_slf; //data yang akan di jadikan QR CODE IMB Lama
		//$params['data'] = 'https://simbg.pu.go.id/Main/Retribusi/'.$no_konsultasi; //data yang akan di jadikan QR CODE
		$params['data'] = 'https://simbg.pu.go.id/Main/DataTeknis/'.$no_konsultasi; //data yang akan di jadikan QR CODE
					
		$params['level'] 	= 'H'; //H=High
		$params['size'] 	= 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$data['QR'] 		= $this->ciqrcode->generate($params);
		redirect('Konsultasi');
	}
	public function FormPengecekan($id=null)
	{
		$user_id				= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		//$id 					= $this->secure->decrypt_url($id);
		$id 					= $this->uri->segment(3);
		$data['id']			= $id;
		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['prof'] 	= $this->Mkonsultasi->getDataUserProfil('a.*', $user_id);
		$data['id']			= $id;
		$permohonan 		= $this->Mkonsultasi->getDataJnsKonsultasi('a.*', $id)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		$getPermohonan = $this->Mkonsultasi->getRowKonsultasi($id);
		$retribusi = $this->Mkonsultasi->getRowRetribusi($id)->row();
		$data1 = [
			'retribusi' => $retribusi,
		];
		if ($id != '') {
			$data['DataPemilik']	= $this->Mkonsultasi->getPemilik('a.*', $id);
			$data['DataTanah']		= $this->Mkonsultasi->getTanah('a.*', $id);
			$data['retribusi'] 		= $this->Mkonsultasi->getRowRetribusi($id)->row();
			$data['Prasarana']		= $this->Mkonsultasi->getRetribusiPrasarana('a.*', $id);
			$filterBangunan	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,e.nm_konsultasi,g.jns_prasarana';
			$data['DataBangunan']	= $this->Mkonsultasi->getBangunan($filterBangunan, $id);
		}
		$data['Konsultasi'] = $this->Mkonsultasi->getDataKonsultasi('a.*', $id);
		$data['content']	= $this->load->view('RevisiEdit/FormVerifikasi', $data, TRUE);
		$data['title']		=	'Konfirmasi Data Permohonan';
		$data['heading']	=	'';
		$this->load->view('template_pengajuan', $data);
	}

	public function saveDataPemik()
	{
		$user_id		= $this->session->userdata('loc_user_id');
		$id				= $this->input->post('id');
		$nm_pemilik		= $this->input->post('nm_pemilik');
		$jns_pemilik	= $this->input->post('jns_pemilik');
		$jenis_id		= $this->input->post('jenis_id');
		$glr_depan		= $this->input->post('glr_depan');
		$glr_belakang	= $this->input->post('glr_belakang');
		$alamat			= $this->input->post('alamat');
		$nama_provinsi	= $this->input->post('nama_provinsi');
		$nama_kabkota	= $this->input->post('nama_kabkota');
		$nama_kecamatan	= $this->input->post('nama_kecamatan');
		$nama_kelurahan	= $this->input->post('nama_kelurahan');
		$no_ktp			= $this->input->post('no_ktp');
		$no_kitas		= $this->input->post('no_kitas');
		$no_hp			= $this->input->post('no_hp');
		$nip			= $this->input->post('nip');
		$email			= $this->input->post('email');
		$data	= array(
			'user_id' => $this->Outh_model->Encryptor('decrypt', $user_id),
			'nm_pemilik' => $nm_pemilik,
			'jns_pemilik' => $jns_pemilik,
			'glr_depan' => $glr_depan,
			'glr_belakang' => $glr_belakang,
			'alamat' => $alamat,
			'id_provinsi' => $nama_provinsi,
			'id_kabkota' => $nama_kabkota,
			'id_kecamatan' => $nama_kecamatan,
			'id_kelurahan' => $nama_kelurahan,
			'no_ktp' => $no_ktp,
			'no_hp' => $no_hp,
			'jenis_id' => $jenis_id,
			'no_kitas' => $no_kitas,
			'email' => $email
		);
		$databg = array(
			'data_step' => '7'
		);
		$this->Mglobals->setData('tmdatapemilik', $data, 'id', $id);
		$this->Mglobals->setData('tmdatabangunan', $databg, 'id', $id);
		$this->session->set_flashdata('message', 'Data User Berhasil di Ubahsasasa.');
		$this->session->set_flashdata('status', 'success');
		redirect('Konsultasi');
	}
	public function SimpanRetribusi()
	{
		$usaha = $this->input->post('usaha', TRUE);
		$permanensi = $this->input->post('permanensi', TRUE);
		$kegiatan = $this->input->post('kegiatan', TRUE);
		$nilai_retribusi = $this->input->post('nilai-retribusi', TRUE);
		$nilai_retribusi_prasarana = $this->input->post('total-retribusi-input', TRUE);
		$nilai_retribusi_keseluruhan = $this->input->post('total-retribusi-keseluruhan', TRUE);
		$indeks_integrasi = $this->input->post('indeks-integrasi', TRUE);
		$indeks_lokalitas = $this->input->post('indeks-lokalitas', TRUE);
		$indeks_kegiatan = $this->input->post('indeks-kegiatan', TRUE);
		$parameter_fungsi = $this->input->post('parameter-fungsi', TRUE);
		$parameter_kompleksitas = $this->input->post('parameter-kompleksitas', TRUE);
		$parameter_ketinggian = $this->input->post('parameter-ketinggian', TRUE);
		$id = $this->input->post('id', TRUE);
		$group_b = $this->input->post('group-b');
		$shst = $this->input->post('shst', TRUE);
		$findRetribusi = $this->Mkonsultasi->getRowRetribusi($id);
		$findPrasarana = $this->Mkonsultasi->getDataPrasarana($id);
		$data = [
			'id' => $id,
			'id_permanensi' => $permanensi,
			'nilai_retribusi_bangunan' => str_replace(['.', ','], '', $nilai_retribusi),
			'nilai_retribusi_prasarana' => str_replace(['.', ','], '', $nilai_retribusi_prasarana),
			'nilai_retribusi_keseluruhan' => str_replace(['.', ','], '', $nilai_retribusi_keseluruhan),
			'id_kegiatan' => $kegiatan,
			'indeks_integrasi' => $indeks_integrasi,
			'indeks_lokalitas' => $indeks_lokalitas,
			'indeks_kegiatan' => $indeks_kegiatan,
			'parameter_fungsi' => $parameter_fungsi,
			'parameter_kompleksitas' => $parameter_kompleksitas,
			'parameter_ketinggian' => $parameter_ketinggian,
			'status_perhitungan' => 1,
			'shst' => $shst,
			'status_simpan' => 1,
			'parameter_usaha' => $usaha,
		];
		if (isset($_POST['group_b'])) {
			foreach ($group_b as $r) {
				$prasarana[] = [
					'id' => $id,
					'nama_prasarana' => $r['nama_prasarana'],
					'plv' => $r['vlt'],
					'harga_prasarana' => $r['harga'],
					'total_prasarana' => $r['jumlah']
				];
			}
			if ($findPrasarana->num_rows() > 0) {
				$this->Mkonsultasi->updatePrasaranaBatch($id, $prasarana);
			} else {
				$this->Mkonsultasi->insertPrasaranaBatch($prasarana);
			}
		}
		if ($findRetribusi->num_rows() > 0) {
			$this->Mkonsultasi->updatePerhituganRetriusi($id, $data);
		} else {
			$this->Mkonsultasi->insertPerhituganRetriusi($data);
		}
		$this->session->set_flashdata('message', 'Perhitungan Retribusi Berhasil Disimpan!');
		$this->session->set_flashdata('status', 'success');
		redirect('Konsultasi', 'refresh');
	}
	
	public function CetakDokumen()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$DataVal 			= $this->Mkonsultasi->getdatabg($id)->row_array();
        $id_izin 			= $DataVal['id_izin'];
		$status				= $DataVal['status'];
		$data['Konsultasi'] 	= $this->Mkonsultasi->getBangunanData('a.*', $id);
		if($id_izin == '2'){
			$this->load->view('Dokumen/FormDokumenEksis', $data);
		}else{
			$this->load->view('Dokumen/FormDokumen', $data);
		}
	}
	public function getDataOtorita()
	{
		$crsf = $this->security->get_csrf_hash();
		$id_kelurahan	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mglobal->listDataKelurahan('a.status', $id_kelurahan)->row();
		$value['id_otorita']  = !empty($query->status)?$query->status:'';
		$value['csrf']  = $crsf;
		echo json_encode($value);
	}

}
