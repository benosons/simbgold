<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class TenagaAhli extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MtenagaAhli');
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->load->library('simbg_lib');
		$this->simbg_lib->check_session_login();
	}

	public function index()
	{
		$this->TenagaAhli();
	}

	public function TenagaAhli() // Halaman 2
	{
		$id	= $this->uri->segment(3);
		$user_id	= $this->session->userdata('loc_user_id');
		$user_id	= $this->Outh_model->Encryptor('decrypt', $user_id);
		$data['user_id'] = $user_id;
		$data['id']	= $id;

		$data['tpa'] = $this->MtenagaAhli->listDataPesonilTpa('a.*,b.id_dok,b.id_asak,b.dir_file,b.keahlian', $user_id);
		$status  	= $data['tpa']->row()->status;
		$ids			= $data['tpa']->row()->id;
		$data['ids']	= $ids;
		$id_lembaga = $data['tpa']->row()->id_lembaga;

		//echo $id;
		$getRow = $this->MtenagaAhli->gettpaPengalaman($ids);
		$data['pengalaman'] = $getRow->result();
		//Begin For Asosiasi Profesiona
		if ($id_lembaga == '1') {
			$queprofesi = $this->MtenagaAhli->getperguruan()->result();
		} else if ($id_lembaga == '3') {
			$queprofesi = $this->MtenagaAhli->getasosiasi()->result();
		} else if ($id_lembaga == '2') {
			$queprofesi = $this->MtenagaAhli->getpakar()->result();
		}
		$list_asosiasi[''] = '--Pilih--';
		foreach ($queprofesi as $row) {
			$list_asosiasi[$row->id] = $row->nm_asosiasi;
		}
		$data['list_asosiasi'] = $list_asosiasi;
		//End For Asosiasi Profesiona
		//echo $status;
		// var_dump($id_lembaga);
		// die;
		if ($id_lembaga == '1') {
			$data['content']			= $this->load->view('Dokelaka', $data, TRUE); //Akademisi
		} else if ($id_lembaga == '2') {
			$data['content']			= $this->load->view('Dokelpakar', $data, TRUE); //Pakar
		} else if ($id_lembaga == '3') {
			$data['content']			= $this->load->view('Dokelprofesi', $data, TRUE); //Profesi
		}
		$data['title']				=	'Edit Tambah Personil';
		$data['heading']			=	'Edit Tambah Personil';
		$this->load->view('template_profil', $data);
	}

	public function Datadiri() // Halaman 3 
	{
		$user_id	= $this->session->userdata('loc_user_id');
		$user_id	= $this->Outh_model->Encryptor('decrypt', $user_id);
		$permohonan = $this->MtenagaAhli->listDataPesonilTpa('a.*', $user_id)->row_array();
		$id = $permohonan['id'];
		$id_lembaga = $permohonan['id_lembaga'];
		$data['id']	= $id;
		$data['id_lembaga'] = $id_lembaga;

		//echo $id_lembaga;
		$queJenisP = $this->Mglobals->getData('*', 'tm_jenis_permohonan')->result();
		$list_Jabatan[''] = '--Pilih--';
		foreach ($queJenisP as $row) {
			$list_JnsPer[$row->id_jns_permohonan] = $row->nm_jns_permohonan;
		}
		$data['list_Jabatan'] = $list_Jabatan;
		$data['Dataaka']		= $this->MtenagaAhli->getdatadiri('a.*', $id);
		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		if (isset($data['Dataaka']->id_provinsi)) {
			$provinsi = $data['Dataaka']->id_provinsi;
			$data['daftar_kabkota']		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $provinsi);
		}
		if (isset($data['Dataaka']->id_kabkot)) {
			$kabkot = $data['Dataaka']->id_kabkot;
			$data['daftar_kecamatan']	= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $kabkot);
		}

		if ($id_lembaga == '1') {
			$data['content']			= $this->load->view('Datadiriaka', $data, TRUE); // Akademisi
		} else if ($id_lembaga == '2') {
			$data['content']			= $this->load->view('Datadiripakar', $data, TRUE); // Pakar
		} else if ($id_lembaga == '3') {
			$data['content']			= $this->load->view('Datadiriprofesi', $data, TRUE); //Profesi
		} else {
		}

		$data['title']				=	'Edit Tambah Personil';
		$data['heading']			=	'Edit Tambah Personil';
		$this->load->view('template_profil', $data);
	}

	public function Dataprofesi() //Halaman 4
	{
		$user_id	= $this->session->userdata('loc_user_id');
		$user_id	= $this->Outh_model->Encryptor('decrypt', $user_id);
		$permohonan = $this->MtenagaAhli->listDataPesonilTpa('a.*,c.nm_asosiasi', $user_id)->row_array();
		$id = $permohonan['id'];
		$id_lembaga = $permohonan['id_lembaga'];
		$data['id']	= $id;
		$data['id_lembaga'] = $id_lembaga;
		$nm_asosiasi = $permohonan['nm_asosiasi'];
		$data['nm_asosiasi'] = $nm_asosiasi;
		//echo $nm_asosiasi;
		$data['Dataaso']		= $this->MtenagaAhli->getdataprofesi('a.*', $id);
		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		if (isset($data['Dataaso']->id_provinsi)) {
			$provinsi = $data['Dataaso']->id_provinsi;
			$data['daftar_kabkota']		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $provinsi);
		}
		if (isset($data['Dataaso']->id_kabkot)) {
			$kabkot = $data['Dataaso']->id_kabkot;
			$data['daftar_kecamatan']	= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $kabkot);
		}

		if ($id_lembaga == '1') {
			$data['content']			= $this->load->view('Dataasosiasi', $data, TRUE); // Akademisi
		} else if ($id_lembaga == '2') {
			$data['content']			= $this->load->view('Datapakar', $data, TRUE); //Pakar
		} else if ($id_lembaga == '3') {
			$data['content']			= $this->load->view('Dataprofesi', $data, TRUE); //Profesi
		} else {
		}

		$data['title']				=	'Edit Tambah Personil';
		$data['heading']			=	'Edit Tambah Personil';
		$this->load->view('template_profil', $data);
	}

	//Begin TenagaAhli Dinas
	public function saveDokumen()
	{
		$id_dok			= $this->input->post('id_dok');
		$id				= $this->input->post('id');
		$id_asak		= $this->input->post('id_asak');
		$keahlian		= $this->input->post('keahlian');

		$filean = $this->input->post('dir_dokumen');
		$thisdir = getcwd();
		$dirPath = $thisdir . "/object-storage/dekill/Tpa/";

		$config = [
			'upload_path' => "$dirPath",
			'allowed_types' => 'pdf|png|jpg',
			'max_size' => '50000',

			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$file = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES["dir_file"]['name']);
		if ($_FILES["dir_file"]["name"]) {
			$config["file_name"] = $file;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$dir_file = $this->upload->do_upload('dir_file');
			$filean = $this->upload->data();
			$filean = $filean['file_name'];
			if (!$dir_file) {
				$data['err_msg'] = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'warning');
				redirect('TenagaAhli');
			}
		}
		$datapersonal	= array(
			'id' => $id,
			'id_asak' => $id_asak,
			'keahlian' => $keahlian,
			'dir_file' 		=> $filean,
		);

		if ($id_dok != "") {
			$query		= $this->mglobals->setData('tm_tpadokumen', $datapersonal, 'id_dok', $id_dok);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('TenagaAhli');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('TenagaAhli');
			}
		} else {
			$query		= $this->mglobals->setData('tm_tpadokumen', $datapersonal, 'id_dok', $id_dok);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('TenagaAhli');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('TenagaAhli');
			}
		}
	}

	public function simpanpengalaman()
	{
		$id_pengalaman				= $this->input->post('id_pengalaman');
		$id							= $this->input->post('id');
		$nm_paket					= $this->input->post('nm_paket');
		$tahun						= $this->input->post('tahun');
		$luas_bgn					= $this->input->post('luas_bgn');
		$jml_lantai 				= $this->input->post('jml_lantai');
		$nilai						= $this->input->post('nilai');
		$data	= array(
			'id' => $id,
			'nm_paket' => $nm_paket,
			'tahun' => $tahun,
			'luas_bgn' => $luas_bgn,
			'jml_lantai' => $jml_lantai,
			'nilai' => $nilai,
		);

		if ($id_pengalaman != "") {
			$query		= $this->Mglobals->setData('tm_tpapengalaman', $data, 'id_pengalaman', $id_pengalaman);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('TenagaAhli');
		} else {
			$query		= $this->Mglobals->setData('tm_tpapengalaman', $data, 'id_pengalaman', $id_pengalaman);
			if ($query) {
				$this->session->set_flashdata('message', 'Biodata User Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('TenagaAhli');
			} else {
				$this->session->set_flashdata('message', 'Biodata User Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('TenagaAhli');
			}
		}
	}

	public function simpandatadiri()
	{
		$id			= $this->input->post('id');
		$nm_tpa		= $this->input->post('nm_tpa');
		$glr_depan	= $this->input->post('glr_depan');
		$glr_blkg	= $this->input->post('glr_blkg');
		$no_ktp 	= $this->input->post('no_ktp');
		$nidn = $this->input->post('nidn');
		$nip = $this->input->post('nip');
		$pangkat = $this->input->post('pangkat');
		$golongan = $this->input->post('golongan');
		$jabatan = $this->input->post('jabatan');
		$jns_kelamin = $this->input->post('jns_kelamin');
		$tmpt_lahir = $this->input->post('tmpt_lahir');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$npwp	= $this->input->post('npwp');
		$replace 	= "";
		$find 		= array(".", "-");
		$npwp_r 	= str_replace($find, $replace, $npwp);
		$nama_provinsi = $this->input->post('nama_provinsi');
		$nama_kabkota = $this->input->post('nama_kabkota');
		$nama_kecamatan = $this->input->post('nama_kecamatan');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$no_kontak = $this->input->post('no_kontak');
		$id_kerja = $this->input->post('id_kerja');
		$status = $this->input->post('status');
		if ($status == '') {
			$status_tpa = '1';
		} else {
			$status_tpa = $status;
		}
		$filean = $this->input->post('dir_dokumen');
		$filean2 = $this->input->post('dir_keahlian');
		$filean3 = $this->input->post('dir_sub');
		$thisdir = getcwd();
		$dirPath = $thisdir . "/object-storage/dekill/Tpa/";

		$config = [
			'upload_path' => "$dirPath",
			'allowed_types' => 'pdf|png|jpg',
			'max_size' => '50000',

			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$file = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES["dir_file"]['name']);
		$file2 = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES["dir_file2"]['name']);
		$file3 = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES["dir_file3"]['name']);
		if ($_FILES["dir_file"]["name"]) {
			$config["file_name"] = $file;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$dir_file = $this->upload->do_upload('dir_file');
			$filean = $this->upload->data();
			$filean = $filean['file_name'];
			if (!$dir_file) {
				$data['err_msg'] = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'warning');
				redirect('TenagaAhli/Datadiri');
			}
		}
		if ($_FILES["dir_file2"]["name"]) {
			$config["file_name"] = $file2;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$dir_file2 = $this->upload->do_upload('dir_file2');
			$filean2 = $this->upload->data();
			$filean2 = $filean2['file_name'];
			if (!$dir_file2) {
				$data['err_msg'] = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'warning');
				redirect('TenagaAhli/Datadiri');
			}
		}
		if ($_FILES["dir_file3"]["name"]) {
			$config["file_name"] = $file3;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$dir_file3 = $this->upload->do_upload('dir_file3');
			$filean3 = $this->upload->data();
			$filean3 = $filean3['file_name'];
			if (!$dir_file3) {
				$data['err_msg'] = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'warning');
				redirect('TenagaAhli/Datadiri');
			}
		}

		$datadiri	= array(
			//'id' => $id,
			'nm_tpa' => $nm_tpa,
			'glr_depan' => $glr_depan,
			'glr_blkg' => $glr_blkg,
			'nidn' => $nidn,
			'nip' => $nip,
			'pangkat' => $pangkat,
			'golongan' => $golongan,
			'jabatan' => $jabatan,
			'no_ktp' => $no_ktp,
			'jns_kelamin' => $jns_kelamin,
			'tmpt_lahir' => $tmpt_lahir,
			'tgl_lahir' => $tgl_lahir,
			'npwp' => $npwp_r,
			'id_provinsi' => $nama_provinsi,
			'id_kabkot' => $nama_kabkota,
			'id_kecamatan' => $nama_kecamatan,
			'alamat' => $alamat,
			'email' => $email,
			'no_kontak' => $no_kontak,
			'id_kerja' => $id_kerja,
			'dir_photo' => $filean,
			'dir_keahlian' => $filean2,
			'dir_sub' => $filean3,
			'status' => $status_tpa,
		);

		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_tpa', $datadiri, 'id', $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Perbaharui.');
			$this->session->set_flashdata('status', 'success');
			redirect('TenagaAhli/Dataprofesi');
		} else {
			$query		= $this->Mglobals->setData('tm_tpa', $datadiri, 'id', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('TenagaAhli/Dataprofesi');
			} else {
				$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('TenagaAhli/Datadiri');
			}
		}
	}

	public function Savedatadiri()
	{
		$id			= $this->input->post('id');
		$nm_tpa		= $this->input->post('nm_tpa');
		$glr_depan	= $this->input->post('glr_depan');
		$glr_blkg	= $this->input->post('glr_blkg');
		$no_ktp 	= $this->input->post('no_ktp');
		$nidn = $this->input->post('nidn');
		$nip = $this->input->post('nip');
		$pangkat = $this->input->post('pangkat');
		$golongan = $this->input->post('golongan');
		$jabatan = $this->input->post('jabatan');
		$id_jabatan = $this->input->post('id_jabatan');
		$jns_kelamin = $this->input->post('jns_kelamin');
		$tmpt_lahir = $this->input->post('tmpt_lahir');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$npwp	= $this->input->post('npwp');
		$replace 	= "";
		$find 		= array(".", "-");
		$npwp_r 	= str_replace($find, $replace, $npwp);
		$nama_provinsi = $this->input->post('nama_provinsi');
		$nama_kabkota = $this->input->post('nama_kabkota');
		$nama_kecamatan = $this->input->post('nama_kecamatan');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$no_kontak = $this->input->post('no_kontak');
		$id_kerja = $this->input->post('id_kerja');
		$status = $this->input->post('status');
		if ($status == '') {
			$status_tpa = '1';
		} else {
			$status_tpa = $status;
		}
		$filean = $this->input->post('dir_dokumen');
		$thisdir = getcwd();
		$dirPath = $thisdir . "/object-storage/dekill/Tpa/";

		$config = [
			'upload_path' => "$dirPath",
			'allowed_types' => 'pdf|jpg|png',
			'max_size' => '50000',
			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];


		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$file = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES["dir_file"]['name']);
		if ($_FILES["dir_file"]["name"]) {
			$config["file_name"] = $file;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$dir_file = $this->upload->do_upload('dir_file');
			$filean = $this->upload->data();
			$filean = $filean['file_name'];
			if (!$dir_file) {
				$data['err_msg'] = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'warning');
				redirect('TenagaAhli/Datadiri');
			}
		}
		$datadiri	= array(
			'id' => $id,
			'nm_tpa' => $nm_tpa,
			'glr_depan' => $glr_depan,
			'glr_blkg' => $glr_blkg,
			'nidn' => $nidn,
			'nip' => $nip,
			'pangkat' => $pangkat,
			'golongan' => $golongan,
			'jabatan' => $jabatan,
			'id_jabatan' => $id_jabatan,
			'no_ktp' => $no_ktp,
			'jns_kelamin' => $jns_kelamin,
			'tmpt_lahir' => $tmpt_lahir,
			'tgl_lahir' => $tgl_lahir,
			'npwp' => $npwp_r,
			'id_provinsi' => $nama_provinsi,
			'id_kabkot' => $nama_kabkota,
			'id_kecamatan' => $nama_kecamatan,
			'alamat' => $alamat,
			'email' => $email,
			'no_kontak' => $no_kontak,
			'id_kerja' => $id_kerja,
			'dir_photo' => $filean,
			'status' => $status_tpa,
		);
		// var_dump($datadiri);
		// die;
		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_tpa', $datadiri, 'id', $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Perbaharui.');
			$this->session->set_flashdata('status', 'success');
			redirect('TenagaAhli/Dataprofesi');
		} else {
			$query		= $this->Mglobals->setData('tm_tpa', $datadiri, 'id', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('TenagaAhli/Dataprofesi');
			} else {
				$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('TenagaAhli/Datadiri');
			}
		}
	}

	public function savedataasosiasi()
	{
		$id_aso = $this->input->post('id_aso');
		$id			= $this->input->post('id');
		$nama_provinsi = $this->input->post('nama_provinsi');
		$nama_kabkota = $this->input->post('nama_kabkota');
		$nama_kecamatan = $this->input->post('nama_kecamatan');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$no_tlpn_fax = $this->input->post('no_tlpn_fax');
		$datadiri	= array(
			'id' => $id,
			'id_provinsi' => $nama_provinsi,
			'id_kabkot' => $nama_kabkota,
			'id_kecamatan' => $nama_kecamatan,
			'alamat' => $alamat,
			'email' => $email,
			'no_tlpn_fax' => $no_tlpn_fax,
		);
		if ($id_aso != "") {
			$query		= $this->Mglobals->setData('tm_tpaints', $datadiri, 'id_aso', $id_aso);
			$this->session->set_flashdata('message', 'Data User Berhasil di Perbaharui.');
			$this->session->set_flashdata('status', 'success');
			redirect('Dashboard');
		} else {
			$query		= $this->Mglobals->setData('tm_tpaints', $datadiri, 'id_aso', $id_aso);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Dashboard');
			} else {
				$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('TenagaAhli/Dataprofesi');
			}
		}
	}

	public function savedataaosiasi()
	{
		$id_aso = $this->input->post('id_aso');
		$id			= $this->input->post('id');
		$npwp	= $this->input->post('npwp');
		$nm_fakultas = $this->input->post('nm_fakultas');
		$nm_jurusan = $this->input->post('nm_jurusan');
		$nm_program = $this->input->post('nm_program');
		$akreditasi_a = $this->input->post('akreditasi_a');
		$akreditasi_b = $this->input->post('akreditasi_b');
		$nama_provinsi = $this->input->post('nama_provinsi');
		$nama_kabkota = $this->input->post('nama_kabkota');
		$nama_kecamatan = $this->input->post('nama_kecamatan');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$no_tlpn_fax = $this->input->post('no_tlpn_fax');
		$datadiri	= array(
			'id' => $id,
			'nm_fakultas' => $nm_fakultas,
			'nm_jurusan' => $nm_jurusan,
			'nm_program' => $nm_program,
			'akreditasi_a' => $akreditasi_a,
			'akreditasi_b' => $akreditasi_b,
			'id_provinsi' => $nama_provinsi,
			'id_kabkot' => $nama_kabkota,
			'id_kecamatan' => $nama_kecamatan,
			'alamat' => $alamat,
			'email' => $email,
			'no_tlpn_fax' => $no_tlpn_fax,
		);
		if ($id_aso != "") {
			$query		= $this->Mglobals->setData('tm_tpaints', $datadiri, 'id_aso', $id_aso);
			$this->session->set_flashdata('message', 'Data User Berhasil di Perbaharui.');
			$this->session->set_flashdata('status', 'success');
			redirect('Dashboard');
		} else {
			$query		= $this->Mglobals->setData('tm_tpaints', $datadiri, 'id_aso', $id_aso);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Dashboard');
			} else {
				$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('TenagaAhli/Dataprofesi');
			}
		}
	}

	public function getDataJurusan()
	{
		$id_pendidikan	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->mglobals->listData('tr_jurusan', 'id_jurusan,nama_jurusan', 'id_grjurusan', $id_pendidikan);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_jurusan' => $row->id_jurusan, 'nama_jurusan' => $row->nama_jurusan);
			}
		}
		echo json_encode($value);
	}

	public function data_RiwPen()
	{
		$id = $this->uri->segment(3);

		$data = $this->mglobals->getData('*', 'tmdatariwpend', array('id_riwpend' => $id));
		echo json_encode($data->row());
	}

	public function delete_RiwPen()
	{
		$id = $this->uri->segment(3);
		if (trim($id) != '' && trim($id) != '') {
			try {
				$this->mglobals->deleteDataKey('tmdatariwpend', 'id_riwpend', $id);
				$status = 'success';
				$msg = 'Data successfully deleted';
			} catch (Exception $e) {
				$status = 'error';
				$msg = 'Please try again';
			}
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	public function delete_RiwKeahlian()
	{
		$id = $this->uri->segment(3);
		if (trim($id) != '' && trim($id) != '') {
			try {
				$this->mglobals->deleteDataKey('tmdatatahli', 'id_ahli', $id);
				$status = 'success';
				$msg = 'Data successfully deleted';
			} catch (Exception $e) {
				$status = 'error';
				$msg = 'Please try again';
			}
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	public function data_RiwKeahlian()
	{
		$id = $this->uri->segment(3);
		$data = $this->mglobals->getData('*', 'tm_riwkeahlian', array('id_riwkeahlian' => $id));
		echo json_encode($data->row());
	}

	public function deleteRiwPeng()
	{

		$id = $this->uri->segment(3);

		if (trim($id) != '' && trim($id) != '') {
			try {
				$this->mglobals->deleteDataKey('tm_tpapengalaman', 'id_pengalaman', $id);
				$status = 'success';
				$msg = 'Data successfully deleted';
			} catch (Exception $e) {
				$status = 'error';
				$msg = 'Please try again';
			}
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	public function delete_RiwPeng()
	{
		$id = $this->uri->segment(3);

		if (trim($id) != '' && trim($id) != '') {
			try {
				$this->mglobals->deleteDataKey('tmdatatpengalaman', 'id_pengalaman', $id);
				$status = 'success';
				$msg = 'Data successfully deleted';
			} catch (Exception $e) {
				$status = 'error';
				$msg = 'Please try again';
			}
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	public function data_RiwPeng()
	{
		$id = $this->uri->segment(3);

		$data = $this->mglobals->getData('*', 'tm_riwpengalaman', array('id_riwpeng' => $id));
		echo json_encode($data->row());
	}

	public function getDataSpesialis()
	{
		$id_keahlian	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->mglobals->getData('*', 'tr_spesialis', array('id_keahlian' => $id_keahlian));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_spesialis' => $row->id_spesialis, 'spesialis' => $row->spesialis);
			}
		}
		echo json_encode($value);
	}

	public function getDataKabKota()
	{
		$id_provinsi	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $id_provinsi);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kabkot' => $row->id_kabkot, 'nama_kabkota' => $row->nama_kabkota);
			}
		}
		echo json_encode($value);
	}

	public function getDataKecamatan()
	{
		$id_kabkot	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $id_kabkot);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kecamatan' => $row->id_kecamatan, 'nama_kecamatan' => $row->nama_kecamatan);
			}
		}
		echo json_encode($value);
	}
	//End Validasi TPA oleh Kementerian PUPR
}
