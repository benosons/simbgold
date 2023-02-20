<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Pupr extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'Mpupr' => 'Mpupr',
			'Global_model' => 'gm',
			'Tabg_model' => 'tabg',
		]);
		$this->load->library('Simbg_lib');
		$this->simbg_lib->check_session_login();
	}
	public function index()
	{
		redirect('dashboard');
	}
	//Begin Profile Dinas
	public function data_dinas()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$id_kabkot				= $this->session->userdata('loc_id_kabkot');
		$role_id 				= $this->session->userdata('loc_role_id');
		$kabkot 				= $this->session->userdata('loc_id_kabkot');
		$data['role']	 		= $this->session->userdata('loc_role_id');
		$data['profile_dinas'] 	= $this->Mpupr->getDataDinasProfile('a.*', $id_kabkot);
		if ($role_id == '6') {
			$data['result'] 	= $this->Mpupr->getDataAkun($kabkot);
			$data['htable'] = 'Pengawas';
		} else if ($role_id == '8') {
			$data['result'] 	= $this->Mpupr->getDataAkun($kabkot);
			$data['htable'] = 'Operator';
		}else{
			$data['result'] 	= $this->Mpupr->getDataAkun($kabkot);
			$data['htable'] = 'Operator';
		}	
		$data['content']		= $this->load->view('data_dinas/profile_dinas', $data, TRUE);
		$data['title']			=	'Profil Dinas';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}

	public function saveDataDinas()
	{
		$id_kabkot			= $this->session->userdata('loc_id_kabkot');
		$id					= $this->input->post('id');
		$p_nama_dinas		= $this->input->post('p_nama_dinas');
		$p_about			= $this->input->post('p_about');
		$p_alamat			= $this->input->post('p_alamat');
		$p_tlp				= $this->input->post('p_tlp');
		$p_email			= $this->input->post('p_email');
		$status_pejabat		= $this->input->post('status_pejabat');
		$kepala_dinas		= $this->input->post('kepala_dinas');
		$nip_kepala_dinas	= $this->input->post('nip_kepala_dinas');
		$data	= array(
			'id_kabkot' => $id_kabkot,
			'id_dinas' => 2,
			'p_alamat' => $p_alamat,
			'p_tlp' => $p_tlp,
			'p_email' => $p_email,
			'status_pejabat' => $status_pejabat,
			'p_nama_dinas' => $p_nama_dinas,
			'kepala_dinas' => $kepala_dinas,
			'nip_kepala_dinas' => $nip_kepala_dinas,
		);
		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_profile_teknis', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('Pupr/data_dinas');
		} else {
			$query		= $this->Mglobals->setData('tm_profile_teknis', $data, 'id', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Biodata User Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/data_dinas');
			} else {
				$this->session->set_flashdata('message', 'Biodata User Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/data_dinas');
			}
		}
	}
	// End Profile Dinas Teknis
	//Begin Sub Akun
	public function create_sub_akun()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required|valid_email|max_length[50]');
		$this->form_validation->set_rules('nama','Nama','required|max_length[50]');
		$this->form_validation->set_rules('jabatan','Jabatan','required|max_length[13]');
		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Pupr/data_dinas');
		}else{
			$email = $this->input->post('email');
			$nama 	= $this->input->post('nama');
			$jabatan = $this->input->post('jabatan');
			$cekmail = $this->cekmail($email);
			if ($cekmail == 'false') {
				//$this->session->set_flashdata('message', 'Pendaftaran Gagal. ');
				$pesanan = "Pendaftaran Gagal !<br>Email Telah Digunakan";
				$this->session->set_flashdata('message', $pesanan);
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/data_dinas');
			} else {
				$this->createdlah($email,$nama,$jabatan);	
			}
		}		
	}
	
	private function createdlah($email,$nama,$jabatan)
	{
		$email = $email;
		$nama = $nama;
		$jabatan = $jabatan;
		$kabkot = $this->session->userdata('loc_id_kabkot');
		$role_id = $this->session->userdata('loc_role_id');
		$penginput	= $this->session->userdata('loc_email');
		$len = 8;
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		//$pwdnya = substr( str_shuffle( $chars ), 0, $len );
		$pwdnya = "simbg123pu";
		//$role_id = 3;
		switch ($role_id) {
			case 1:
				$child = 4;
				$data['htable'] = 'Eksklusif';
				$max = 999;
				break;
			case 5:
				$child = 7;
				$data['htable'] = 'Pengawas';
				$max = 15;
				break;
			case 6:
				$child = 8;
				$data['htable'] = 'Pengawas';
				$max = 15;
				break;
			case 7:
				$child = 9;
				$data['htable'] = 'Operator';
				$max = 50;
				break;
			case 8:
				$child = 11;
				$data['htable'] = 'Operator';
				$max = 50;
				break;

			default:
				$child = 0;
				$data['htable'] = 'N/A';
				$max = 10;
				break;
		}
		$cekmax = $this->Mpupr->get('tm_user', array('role_id' => $child, 'id_kabkot' => $kabkot))->result_array();
		$aktivation = $nama . '-' . $email;
		$u_password	= sha1($pwdnya . $this->config->item('encryption_key'));
		$cek = $this->Mpupr->get('tm_user', array('username' => $email))->result_array();
		if (count($cek) == 0 && count($cekmax) < $max) {
			$data1 = array(
				'username' => $email,
				'password' => $u_password,
				'id_kabkot'=> $kabkot,
				'role_id'  => $child,
				'email' => $email,
				'activation' => sha1($aktivation . $this->config->item('encryption_key')),
				// 'activation' => sha1($nama += $kabkot . $this->config->item('encryption_key'))
				'post_date' => date('Y-m-d H:i:s'),
				'post_by' => $penginput
			);
			$id_pengguna = $this->Mpupr->createSubAkun('tm_user', $data1);
			// $kd_aktivasi = urlencode($email);
			$kd_aktivasi = sha1($aktivation . $this->config->item('encryption_key'));
			$data = array(
				'email' => $email,
				'nama_lengkap' => $nama,
				'jabatan_dinas' => $jabatan,
				'user_id' => $id_pengguna, // add last insert id to mahasiswa table
				'post_date' => date('Y-m-d'),
				'post_by' => $penginput
			);
			$query = $this->Mpupr->createSubAkun('tm_user_data', $data);
			if ($query) {
				//Begin SendEmail
				$subject 	= "Verifikasi User Pengajuan Akses Admin SIMBG | CS SIMBG";
				$link		=  base_url() . "Front/daftar_akun_dinas/$kd_aktivasi";
				$text 		= "";
				$text .= "Yth Bapak/Ibu,<br>";
				$text .= "<br>";
				$text .= "Kami menerima permintaan pembuatan akun untuk mengakses layanan SIMBG Online dengan wewenang sebagai $jabatan. <br><br>";
				$text .= "Akun Anda Sebagi berikut <br>";
				$text .= "&emsp; Email : $email <br>";
				$text .= "&emsp; Kata Sandi : $pwdnya <br><br>";
				$text .= "Silahkan Klik Tautan berikut ini untuk melanjutkan proses -> <a href='$link' >Verifikasi</a> <br>";
				//$text .= "Username Anda Adalah : $email <br>";
				$text .= "<br>";
				$text .= "<br>";
				$text .= "Hormat Kami <br>";
				$text .= "Admin SIMBG ";
				$this->simbg_lib->sendEmail($email, $subject, $text);
				//End SendEmail
				// echo "akun dengan email $email berhasil didaftarkan<br>";
				// echo "klik link berikut untuk aktivasi login $link";
				$data_kirimulang = array(
					's_email' => $email,
					's_subject' => $subject,
					's_text' => $text
				);
				
				$this->session->set_userdata('sku', $data_kirimulang); //sku = session kirim ulang

				$this->session->set_flashdata('message', "Akun dengan email $email berhasil didaftarkan.<br>Silahkan buka email yg telah didaftarkan untuk proses aktivasi.");
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/data_dinas');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/data_dinas');
			}
		} elseif (count($cekmax) >= 5) {
			$this->session->set_flashdata('message', 'Tidak bisa menambah akun (max 5 akun),<br>Silahkan hubungi admin kami untuk info lebih lanjut.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Pupr/data_dinas');
		} else {
			$this->session->set_flashdata('message', 'akun dengan email $email sudah terdaftarkan di System kami.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Pupr/data_dinas');
		}
	}

	private function cekmail($email)
	{
		$email = $email;
		$cekmail = "";
		//$data['gagal'] = "";
		if ($email != "") {
			$temp = $this->Mpupr->get_email($email);
			$user = $this->Mpupr->getEmailUser($email);
			$userdata = $this->Mpupr->getEmailUserData($email);
			if ($temp->num_rows() > 0 || $user->num_rows() > 0 || $userdata->num_rows() > 0) {
				$cekmail = "false";
			} else if ($temp->num_rows() < 1 || $user->num_rows() < 1 || $userdata->num_rows() < 1) {
				$cekmail = "true";
			}
		}
		return $cekmail;
		
	}

	public function remove_sub_akun($id)
	{
		$process = $this->Mpupr->removeData($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Sub Akun Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Sub Akun Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Pupr/data_dinas');
	}
	//End Sub Akun

	//Begin Personil ASN
	public function personal_asn()
	{
		$this->load->model('mglobal');
		$data = array(
			'asn' => $this->Mpupr->listDataPesonilAsn('*'),
			'keahlian' => $this->Mpupr->listDataBidang('a.id_bidang,a.nama_bidang'),
			'daftar_provinsi' => $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi'),
			'title' => 'Daftar Personal ASN',
			'heading' => ''
		);
		$this->template->load('template/template_backend', 'personal_asn/personal_list', $data);
	}

	public function tambah_personil_form()
	{
		$this->load->model('mglobal');
		$data['list_personal'] 		= "";
		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['daftar_pendidikan']	= $this->Mpupr->listDataPendidikan('id_pendidikan,pendidikan');
		$data['daftar_jurusan']		= $this->Mpupr->listDataJurusan('id_jurusan,nama_jurusan');
		$data['keahlian'] 			= $this->Mpupr->listDataBidang('a.id_bidang,a.nama_bidang');
		$data['jenjang'] 			= $this->Mglobals->listdata('tr_jenjang');
		$data['content']			= $this->load->view('personal_asn/personal_form', $data, TRUE);
		$data['title']				=	'Form Tambah Personil';
		$data['heading']			=	'Form Tambah Personil';
		$this->load->view('template_profil', $data);
	}

	public function edit_personal_form($id)
	{
		$this->load->model('mglobal');
		$id	= $this->uri->segment(3);
		$data['id']	= $id;
		if ($id != '') {
			$data['asn'] = $this->Mpupr->listDataPesonilAsn('a.*,b.*,c.*, b.dir_file as dir_file_ijazah, c.dir_file as dir_file_sertifikat', $id);
			$data['daftar_jurusan']		= $this->Mpupr->listDataJurusan('id_jurusan,nama_jurusan');
			$data['keahlian'] = $this->Mpupr->listDataBidang('a.id_bidang,a.nama_bidang');
			$data['jenjang'] = $this->Mglobals->listdata('tr_jenjang');
			$provinsi = $data['asn']->row()->id_provinsi;
			$kabkot = $data['asn']->row()->id_kabkot;
			$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
			$data['daftar_kabkota']		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $provinsi);
			$data['daftar_kecamatan']	= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $kabkot);
		} else {
			$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
			$data['daftar_kecamatan']	= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan');
			$data['daftar_kabkota']		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota');
		}
		$data['content']			= $this->load->view('personal_asn/personal_form', $data, TRUE);
		$data['title']				=	'Edit Tambah Personil';
		$data['heading']			=	'Edit Tambah Personil';
		$this->load->view('template_profil', $data);
	}

	public function saveDataPersonil()
	{
		$id	= $this->input->post('id');
		//$id	= $this->Outh_model->Encryptor('decrypt', $this->input->post('id',TRUE));
		$glr_depan = $this->input->post('glr_depan');
		$nama_personal = $this->input->post('nama_personal');
		$glr_belakang = $this->input->post('glr_belakang');
		$stat = $this->input->post('stat');
		$nip = $this->input->post('nip');
		$no_ktp = $this->input->post('no_ktp');
		$alamat = $this->input->post('alamat');
		$id_kabkot = $this->input->post('id_kabkot');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$id_provinsi = $this->input->post('id_provinsi');
		$id_kabkot = $this->input->post('id_kabkot');
		$id_kecamatan = $this->input->post('id_kecamatan');

		$datapersonal	= array(
			'glr_depan' => $glr_depan,
			'nama_personal' => $nama_personal,
			'glr_belakang' => $glr_belakang,
			'stat' => $stat,
			'nip' => $nip,
			'no_ktp' => $no_ktp,
			'alamat' => $alamat,
			'no_hp' => $no_hp,
			'email' => $email,
			'id_kabkot' => $id_kabkot,
			'id_provinsi' => $id_provinsi,
			'id_kecamatan' => $id_kecamatan,
			'id_kota_tabg' => $this->session->userdata('loc_id_kabkot')
		);

		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_personal', $datapersonal, 'id_personal', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/edit_personal_form/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/personal_asn');
			}
		} else {
			$query		= $this->Mglobals->setData('tm_personal', $datapersonal, 'id_personal', $id);
			$this->Mglobals->setData('tm_riwpendidikan', array('id_personal' => $query));
			$this->Mglobals->setData('tm_sertifikasi', array('id_personal' => $query));
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan. Harap melengkapi informasi detail personil pada masing-masing tab');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/edit_personal_form/' . $query);
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/personal_asn');
			}
		}
	}

	public function saveDataPendidikan()
	{
		$id	= $this->input->post('id');
		$id_riwpend = $this->input->post('id_riwpend');
		$id_jenjang = $this->input->post('id_jenjang');
		$jurusan	= $this->input->post('jurusan');
		$dir_file = $this->input->post('filename_ijazah');
		$nm_sekolah = $this->input->post('nm_sekolah');
		$alamat_skl = $this->input->post('alamat_skl');
		$no_ijazah = $this->input->post('no_ijazah');
		$thn_lulus = $this->input->post('thn_lulus');


		$datapendidikan	= array(
			'id_jenjang' => $id_jenjang,
			//'id_jurusan' => $id_jurusan,
			'jurusan' => $jurusan,
			'nm_sekolah' => $nm_sekolah,
			'alamat_skl' => $alamat_skl,
			'no_ijazah' => $no_ijazah,
			'thn_lulus' => $thn_lulus,
			'dir_file' => $dir_file,
		);

		if ($_FILES) {
			$thisdir = getcwd();
			$dirPath = $thisdir . "/file/personil/" . $id . '/ijazah/';
			if (!file_exists($dirPath)) {
				mkdir($dirPath, 0755, true);
  //create directory if not exist
			}

			$config['upload_path'] 		= $dirPath;
			$config['allowed_types'] 	= 'pdf|jpg|png';
			$config['max_size']			= '10240';
			$config['encrypt_name']		= TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('dir_file')) {
				$this->upload->display_errors();
			} else {
				$upload	 		= $this->upload->data();
				$datapendidikan['dir_file'] = $upload['file_name'];
			}
		}
		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_riwpendidikan', $datapendidikan, 'id_personal', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/edit_personal_form/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/personal_asn');
			}
		} else {
			$query		= $this->Mglobals->setData('tm_riwpendidikan', $datapendidikan, 'id_personal', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan. Harap melengkapi informasi detail personil pada masing-masing tab');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/edit_personal_form/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/personal_asn');
			}
		}
	}

	public function saveDataKeahlian()
	{
		$id	= $this->input->post('id');
		$id_unsur = $this->input->post('id_unsur');
		$id_unsur_keahlian = $this->input->post('id_unsur_keahlian');
		$dir_file = $this->input->post('filename_ijazah');
		$list_keahlian = $this->input->post('list_keahlian');
		$tgl_penetapan = $this->input->post('tgl_penetapan');
		$nama_bidang = $this->input->post('nama_bidang');
		$datakeahlian	= array(
			'id_unsur' => $id_unsur,
			'id_unsur_keahlian' => $id_unsur_keahlian,
			'list_keahlian' => $list_keahlian,
			'nama_bidang' => $nama_bidang,
			'tgl_penetapan' => date('Y-m-d', strtotime($tgl_penetapan)),
			'dir_file' => $dir_file,
		);
		if ($_FILES) {
			$thisdir = getcwd();
			$dirPath = $thisdir . "/file/personil/" . $id . '/Sertifikat/';
			if (!file_exists($dirPath)) {
				mkdir($dirPath, 0755, true);
  //create directory if not exist
			}
			$config['upload_path'] 		= $dirPath;
			$config['allowed_types'] 	= 'pdf|jpg|png';
			$config['max_size']			= '10240';
			$config['encrypt_name']		= TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('dir_file')) {
				$this->upload->display_errors();
			} else {
				$upload	 		= $this->upload->data();
				$datakeahlian['dir_file'] = $upload['file_name'];
			}
		}

		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_sertifikasi', $datakeahlian, 'id_personal', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/edit_personal_form/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/personal_asn');
			}
		} else {
			$query		= $this->Mglobals->setData('tm_sertifikasi', $datakeahlian, 'id_personal', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan. Harap melengkapi informasi detail personil pada masing-masing tab');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/edit_personal_form/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/personal_asn');
			}
		}
	}


	public function getDataJurusan()
	{
		$id_pendidikan	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mglobals->listData('tr_jurusan', 'id_jurusan,nama_jurusan', 'id_grjurusan', $id_pendidikan);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_jurusan' => $row->id_jurusan, 'nama_jurusan' => $row->nama_jurusan);
			}
		}
		echo json_encode($value);
	}

	public function removeDataPersonal($id)
	{
		$table = array('tm_personal', 'tm_sertifikasi', 'tm_riwpendidikan');
		$process = $this->Mglobals->multiDeleteData($table, 'id_personal', $id);
		
		// var_dump($process);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			//tambah hapus folder personil
			$link = "/file/personil/".$id;
			$this->AllDelete($link);

			//$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			//$this->session->set_flashdata('status', 'success');
		}
		redirect('Pupr/personal_asn');
	}
	//End Personil ASN

	//Begin SK TABG
	public function sk_tabg()
	{

		$data['sk_tabg'] = $this->Mglobals->getData(
			'id_sk_tabg,no_sk_tabg,tgl_sk_tabg,untuk_tahun',
			'tm_sk_tabg',
			array('id_kabkot' => $this->session->userdata('loc_id_kabkot')),
			'id_sk_tabg ',
			'desc'
		);
		// var_dump($data['sk_tabg']);
		$data['content']			= $this->load->view('sk_tabg/index', $data, TRUE);
		$data['title']				=	'List SK TABG';
		$data['heading']			=	'';

		$this->load->view('template_profil', $data);
	}

	public function pengaturan_sk_tabg_editOld($id)
	{
		$data['disable']			= '';
		if ($this->session->userdata('loc_user_id') == 9999) {
			$id_kabkot				= '';
		} else {
			$id_kabkot				= $this->session->userdata('loc_id_kabkot');
		}
		$data['query_syarat_adm']			= $this->Mpupr->get_tabg_parent($id_kabkot);
		$data['query_syarat_selected'] = $this->Mpupr->get_tabg_selected($id);
		$data['row'] = $this->Mpupr->getDataEditTimTABG('a.*', $id);
		// var_dump($data['row']);
		$this->load->view('sk_tabg/personil', $data);
	}

	public function pengaturan_sk_tabg_edit($id)
	{
		$this->session->userdata('loc_user_id') == 9999 ? $id_kabkot = '' : $id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data = array(
			'disable' => '',
			'query_syarat_adm' => $this->tabg->get_tabg_parent($id_kabkot),
			'query_syarat_selected' => $this->tabg->get_tabg_selected($id),
			'row' => $this->tabg->getDataEditTimTABG('a.*', $id),
		);
		$this->load->view('sk_tabg/personil', $data);
	}

	public function pengaturan_sk_tabg_saveold($var = null)
	{
		$id_sk_tabg		= $this->input->post('id');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');

		if ($dok_persyaratan != "") {
			$process = $this->Mpupr->removeDataPersyaratanPermohonan($id_sk_tabg);
			if (!$process) {
				$this->session->set_flashdata('message', 'Data Gagal Di simpan');
				$this->session->set_flashdata('status', 'error');
			} else {
				for ($i = 0; $i < count($dok_persyaratan); $i++) {
					$id_personal = $dok_persyaratan[$i];
					$data	= array(
						'id_sk_tabg' => $id_sk_tabg,
						'id_personal' => $id_personal,
						//'post_date'=>date('Y-m-d H:i:s'),
						//'post_by'=>$this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
					);

					$processInput = $this->Mglobals->setData('tm_sk_tabg_detail', $data, '', '');
				}
				if (!$processInput) {
					$this->session->set_flashdata('message', 'Data Gagal di Ubah.');
					$this->session->set_flashdata('status', 'danger');
					//redirect('Pupr/sk_tabg');
				} else {
					$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					//redirect('Pupr/sk_tabg');
				}
			}
		} else {
			$this->session->set_flashdata('message', 'Data Gagal Di simpan, Pastikan Memilih Minimal 1.');
			$this->session->set_flashdata('status', 'danger');
		}
		redirect('Pupr/sk_tabg');
	}

	public function pengaturan_sk_tabg_save($var = null)
	{
		$id_skta		= $this->input->post('id');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');

		if ($dok_persyaratan != "") {
			$process = $this->tabg->removeDataPersyaratanPermohonan($id_skta);
			if (!$process) {
				$this->session->set_flashdata('message', 'Data Gagal Di simpan');
				$this->session->set_flashdata('status', 'error');
			} else {
				for ($i = 0; $i < count($dok_persyaratan); $i++) {
					$id_personal = $dok_persyaratan[$i];
					$data	= array(
						'id_skta' => $id_skta,
						'id_personal' => $id_personal,
						//'post_date'=>date('Y-m-d H:i:s'),
						//'post_by'=>$this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
					);

					$processInput = $this->Mglobals->setData('tm_sktabgdetail', $data, '', '');
				}
				if (!$processInput) {
					$this->session->set_flashdata('message', 'Data Gagal di Ubah.');
					$this->session->set_flashdata('status', 'danger');
					//redirect('Pupr/sk_tabg');
				} else {
					$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					//redirect('Pupr/sk_tabg');
				}
			}
		} else {
			$this->session->set_flashdata('message', 'Data Gagal Di simpan, Pastikan Memilih Minimal 1.');
			$this->session->set_flashdata('status', 'danger');
		}
		redirect('sk-tabg');
	}

	public function sk_tabg_save()
	{
		$id = $this->input->post('id_sk_tabg');
		$no_sk_tabg = $this->input->post('no_sk_tabg');
		$tgl_sk_tabg = $this->input->post('tgl_sk_tabg');
		$untuk_tahun = $this->input->post('untuk_tahun');
		$data	= array(
			'id_sk_tabg' => $id,
			'tgl_sk_tabg' => date('Y-m-d', strtotime($tgl_sk_tabg)),
			'no_sk_tabg' => $no_sk_tabg,
			'untuk_tahun' => $untuk_tahun,
			'id_kabkot' => $this->session->userdata('loc_id_kabkot')

		);
		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_sk_tabg', $data, 'id_sk_tabg', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/sk_tabg');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/sk_tabg');
			}
		} else {
			$query		= $this->Mglobals->setData('tm_sk_tabg', $data);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/sk_tabg');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/sk_tabg');
			}
		}
	}

	public function sk_tabg_edit($id)
	{
		$data['row'] = $this->Mglobals->getData('id_sk_tabg,no_sk_tabg,tgl_sk_tabg,untuk_tahun', 'tm_sk_tabg', array('id_sk_tabg' => $id))->row();
		$this->load->view('sk_tabg/edit', $data);
	}

	public function sk_tabg_edit2()
	{
		$id = $this->input->get('id');
		$data = $this->Mglobals->getData('id_sk_tabg,no_sk_tabg,tgl_sk_tabg,untuk_tahun', 'tm_sk_tabg', array('id_sk_tabg' => $id))->row();
		echo json_encode($data);
	}

	public function sk_tabg_delete2($id)
	{

		// $table = array('tm_personal', 'tm_sertifikasi', 'tm_riwpendidikan');
		$table = 'tm_sk_tabg';
		$process = $this->Mglobals->deleteDataKey($table, 'id_sk_tabg', $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Pupr/sk_tabg');
	}

	public function sk_tabg_delete($id)
	{
		$table = 'tm_sktabg';
		$cekFile = $this->gm->getId('id_skta', $id, 'tm_sktabg')->row()->file_skta;
		$path = FCPATH . '/public/uploads/Pupr/sk/sk_tabg/';
		$fileLama = $path . $cekFile;
		if (!unlink($fileLama)) {
			$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
			$this->session->set_flashdata('status', 'warning');
		}
		$process = $this->Mglobals->deleteDataKey($table, 'id_skta', $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('sk-tabg');
	}

	public function sktabg()
	{
		$select = 'id_skta,no_skta,tgl_skta,expired_skta,file_skta';
		$table = 'tm_sktabg';
		$pk = 'id_skta';
		$sk_tabg = $this->Mglobals->getData(
			$select,
			$table,
			array('id_kabkot' => $this->session->userdata('loc_id_kabkot')),
			$pk,
			'desc'
		);
		$data = array(
			'title' => 'List SK TIM TEKNIS',
			'heading' => '',
			'sk_tabg' => $sk_tabg
		);
		$this->template->load('template/template_backend', 'sk_tabg/sktabg_v', $data);
	}

	public function sktabg_save()
	{
		$id = $this->input->post('id_skta');
		$no_skta = $this->input->post('no_skta');
		$tgl_skta = $this->input->post('tgl_skta');
		$expired_skta = $this->input->post('expired_skta');
		$config = [
			'upload_path' => './public/uploads/Pupr/sk/sk_tabg/',
			'allowed_types' => 'pdf|PDF',
			'max_size' => '50000',
			'max_width' => 5000,
			'max_height' => 5000,
			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];
		$this->load->library('upload', $config);
		if ($id != NULL) {
			if (!$this->upload->do_upload('berkas')) {
				$data	= array(
					'no_skta' => $no_skta,
					'tgl_skta' => date('Y-m-d', strtotime($tgl_skta)),
					'expired_skta' => $expired_skta,
					'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
				);

				$query = $this->Mglobals->setData('tm_sktabg', $data, 'id_skta', $id);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Berhasil Diubah');
					$this->session->set_flashdata('status', 'success');
					redirect('sk-tabg');
				} else {
					$this->session->set_flashdata('message', 'Data Gagal Diubah');
					$this->session->set_flashdata('status', 'danger');
					redirect('sk-tabg');
				}
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/Pupr/sk/sk_tabg/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('sk-tabg');
				} else {
					$data	= array(
						'no_skta' => $no_skta,
						'tgl_skta' => date('Y-m-d', strtotime($tgl_skta)),
						'expired_skta' => $expired_skta,
						'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_skta' => $this->upload->data('file_name'),
					);
					$cekFile = $this->gm->getId('id_skta', $id, 'tm_sktabg')->row()->file_skta;
					$path = FCPATH . '/public/uploads/Pupr/sk/sk_tabg/';
					$fileLama = $path . $cekFile;
					if (!unlink($fileLama)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					$query = $this->Mglobals->setData('tm_sktabg', $data, 'id_skta', $id);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Diubah');
						$this->session->set_flashdata('status', 'success');
						redirect('sk-tabg');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Diubah');
						$this->session->set_flashdata('status', 'danger');
						redirect('sk-tabg');
					}
				}
			}
		} else {
			if (!$this->upload->do_upload('berkas')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				$this->session->set_flashdata('status', 'danger');
				redirect('sk-tabg');
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/Pupr/sk/sk_teknis/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('sk-tabg');
				} else {
					$data	= array(
						'id_skta' => $id,
						'no_skta' => $no_skta,
						'tgl_skta' => date('Y-m-d', strtotime($tgl_skta)),
						'expired_skta' => $expired_skta,
						'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_skta' => $this->upload->data('file_name'),
					);
					$query = $this->Mglobals->setData('tm_sktabg', $data);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Disimpan');
						$this->session->set_flashdata('status', 'success');
						redirect('sk-tabg');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Disimpan');
						$this->session->set_flashdata('status', 'danger');
						redirect('sk-tabg');
					}
				}
			}
		}
	}

	//End SK TABG

	//Begin SK Tim Teknis
	public function sk_tim_teknis()
	{
		$data['sk_tabg'] = $this->Mglobals->getData(
			'id_sk_tabg,no_sk_tabg,tgl_sk_tabg,untuk_tahun',
			'tm_sk_tim_teknis',
			array('id_kabkot' => $this->session->userdata('loc_id_kabkot')),
			'id_sk_tabg ',
			'desc'
		);
		// var_dump($data['sk_tabg']);

		$data['content']			= $this->load->view('sk_tim_teknis/index', $data, TRUE);
		$data['title']				=	'List SK TIM TEKNIS';
		$data['heading']			=	'';

		$this->load->view('template_profil', $data);
	}

	public function sk_t()
	{
		$select = 'id_skt,no_skt,tgl_skt,expired_skt,file_skt';
		$table = 'tm_sk_timteknis';
		$pk = 'id_skt';
		$sk_teknis = $this->Mglobals->getData(
			$select,
			$table,
			array('id_kabkot' => $this->session->userdata('loc_id_kabkot')),
			$pk,
			'desc'
		);
		$data = array(
			'title' => 'List SK TIM TEKNIS',
			'heading' => '',
			'sk_teknis' => $sk_teknis
		);
		$this->template->load('template/template_backend', 'sk_tim_teknis/sktenis_v', $data);
	}



	public function sk_tim_teknis_save()
	{
		$id = $this->input->post('id_sk_tabg');
		$no_sk_tabg = $this->input->post('no_sk_tabg');
		$tgl_sk_tabg = $this->input->post('tgl_sk_tabg');
		$untuk_tahun = $this->input->post('untuk_tahun');
		$data	= array(
			'id_sk_tabg' => $id,
			'tgl_sk_tabg' => date('Y-m-d', strtotime($tgl_sk_tabg)),
			'no_sk_tabg' => $no_sk_tabg,
			'untuk_tahun' => $untuk_tahun,
			'id_kabkot' => $this->session->userdata('loc_id_kabkot')
		);
		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_sk_tim_teknis', $data, 'id_sk_tabg', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/sk_tim_teknis');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/sk_tim_teknis');
			}
		} else {
			$query		= $this->Mglobals->setData('tm_sk_tim_teknis', $data);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/sk_tim_teknis');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/sk_tim_teknis');
			}
		}
	}

	public function sktimteknis_save()
	{
		$id = $this->input->post('id_skt');
		$no_skt = $this->input->post('no_skt');
		$tgl_skt = $this->input->post('tgl_skt');
		$expired_skt = $this->input->post('expired_skt');
		$config = [
			'upload_path' => './public/uploads/Pupr/sk/sk_teknis/',
			'allowed_types' => 'pdf|PDF',
			'max_size' => '50000',
			'max_width' => 5000,
			'max_height' => 5000,
			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];
		$this->load->library('upload', $config);
		if ($id != NULL) {
			if (!$this->upload->do_upload('berkas')) {
				$data	= array(
					'no_skt' => $no_skt,
					'tgl_skt' => date('Y-m-d', strtotime($tgl_skt)),
					'expired_skt' => $expired_skt,
					'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
				);

				$query = $this->Mglobals->setData('tm_sk_timteknis', $data, 'id_skt', $id);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Berhasil Diubah');
					$this->session->set_flashdata('status', 'success');
					redirect('sk-tim-teknis');
				} else {
					$this->session->set_flashdata('message', 'Data Gagal Diubah');
					$this->session->set_flashdata('status', 'danger');
					redirect('sk-tim-teknis');
				}
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/Pupr/sk/sk_teknis/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('sk-tim-teknis');
				} else {
					$data	= array(
						'no_skt' => $no_skt,
						'tgl_skt' => date('Y-m-d', strtotime($tgl_skt)),
						'expired_skt' => $expired_skt,
						'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_skt' => $this->upload->data('file_name'),
					);
					$cekFile = $this->gm->getId('id_skt', $id, 'tm_sk_timteknis')->row()->file_skt;
					$path = FCPATH . '/public/uploads/Pupr/sk/sk_teknis/';
					$fileLama = $path . $cekFile;
					if (!unlink($fileLama)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					$query = $this->Mglobals->setData('tm_sk_timteknis', $data, 'id_skt', $id);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Diubah');
						$this->session->set_flashdata('status', 'success');
						redirect('sk-tim-teknis');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Diubah');
						$this->session->set_flashdata('status', 'danger');
						redirect('sk-tim-teknis');
					}
				}
			}
		} else {
			if (!$this->upload->do_upload('berkas')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				$this->session->set_flashdata('status', 'danger');
				redirect('sk-tim-teknis');
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/Pupr/sk/sk_teknis/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('sk-tim-teknis');
				} else {
					$data	= array(
						'id_skt' => $id,
						'no_skt' => $no_skt,
						'tgl_skt' => date('Y-m-d', strtotime($tgl_skt)),
						'expired_skt' => $expired_skt,
						'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_skt' => $this->upload->data('file_name'),
					);
					$query = $this->Mglobals->setData('tm_sk_timteknis', $data);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Disimpan');
						$this->session->set_flashdata('status', 'success');
						redirect('sk-tim-teknis');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Disimpan');
						$this->session->set_flashdata('status', 'danger');
						redirect('sk-tim-teknis');
					}
				}
			}
		}
	}



	public function sktimteknis_delete($id)
	{
		$table = 'tm_sk_timteknis';
		$cekFile = $this->gm->getId('id_skt', $id, 'tm_sk_timteknis')->row()->file_skt;
		$path = FCPATH . '/public/uploads/Pupr/sk/sk_teknis/';
		$fileLama = $path . $cekFile;
		if (!unlink($fileLama)) {
			$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
			$this->session->set_flashdata('status', 'warning');
		}
		$process = $this->Mglobals->deleteDataKey($table, 'id_skt', $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('sk-tim-teknis');
	}

	public function sk_tim_teknis_edit($id)
	{
		$data['row'] = $this->Mglobals->getData('id_sk_tabg,no_sk_tabg,tgl_sk_tabg,untuk_tahun', 'tm_sk_tim_teknis', array('id_sk_tabg' => $id))->row();
		//$this->load->view('sk_tim_teknis/edit', $data);
	}


	public function sk_tabgedit()
	{
		$id = $this->input->get('id');
		$data = $this->Mglobals->getData('id_skta,no_skta,tgl_skta,expired_skta', 'tm_sktabg', array('id_skta' => $id))->row();
		echo json_encode($data);
	}


	public function sk_timteknis_edit()
	{
		$id = $this->input->get('id');
		$data = $this->Mglobals->getData('id_skt,no_skt,tgl_skt,expired_skt', 'tm_sk_timteknis', array('id_skt' => $id))->row();
		echo json_encode($data);
	}


	public function sk_tim_teknis_edit2()
	{
		$id = $this->input->get('id');
		$data = $this->Mglobals->getData('id_sk_tabg,no_sk_tabg,tgl_sk_tabg,untuk_tahun', 'tm_sk_tim_teknis', array('id_sk_tabg' => $id))->row();
		echo json_encode($data);
		//$this->load->view('sk_tim_teknis/edit', $data);
	}

	public function sk_tim_teknis_delete($id)
	{
		// $table = array('tm_personal', 'tm_sertifikasi', 'tm_riwpendidikan');
		$table = 'tm_sk_tim_teknis';
		$process = $this->Mglobals->deleteDataKey($table, 'id_sk_tabg', $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Pupr/sk_tim_teknis');
	}

	public function pengaturan_sk_tim_teknis_edit2($id)
	{
		$data['disable']			= '';
		if ($this->session->userdata('loc_user_id') == 9999) {
			$id_kabkot				= '';
		} else {
			$id_kabkot				= $this->session->userdata('loc_id_kabkot');
		}
		$data['query_syarat_adm']			= $this->Mpupr->get_tim_teknis_parent($id_kabkot);
		$data['query_syarat_selected'] = $this->Mpupr->get_tim_teknis_selected($id);
		$data['row'] = $this->Mpupr->getDataEditTimTeknis('a.*', $id);
		// var_dump($data['row']);
		$this->load->view('sk_tim_teknis/personil', $data);
	}

	public function pengaturan_sk_tim_teknis_edit($id)
	{
		$this->session->userdata('loc_user_id') == 9999 ? $id_kabkot = '' : $id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data = array(
			'disable' => '',
			'query_syarat_adm' => $this->dt->get_tim_teknis_parent($id_kabkot),
			'query_syarat_selected' => $this->dt->get_tim_teknis_selected($id),
			'row' => $this->dt->getDataEditTimTeknis('a.*', $id),
		);
		$this->load->view('sk_tim_teknis/personil', $data);
	}

	public function pengaturan_sk_tim_teknis_saveOld($var = null)
	{
		$id_sk_tabg		= $this->input->post('id');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');
		if ($dok_persyaratan != "") {
			$process = $this->Mpupr->removeDataTimTeknis($id_sk_tabg);
			if (!$process) {
				$this->session->set_flashdata('message', 'Data Gagal Di simpan');
				$this->session->set_flashdata('status', 'danger');
			} else {
				for ($i = 0; $i < count($dok_persyaratan); $i++) {
					$id_personal = $dok_persyaratan[$i];
					$data	= array(
						'id_sk_tabg' => $id_sk_tabg,
						'id_personal' => $id_personal,
						//'post_date'=>date('Y-m-d H:i:s'),
						//'post_by'=>$this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
					);
					$processInput = $this->Mglobals->setData('tm_sk_tim_teknis_detail', $data, '', '');
				}
				if (!$processInput) {
					$this->session->set_flashdata('message', 'Data Gagal di Ubah.');
					$this->session->set_flashdata('status', 'danger');
					//redirect('Pupr/sk_tim_teknis');
				} else {
					$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					//redirect('Pupr/sk_tim_teknis');
				}
			}
		} else {
			$this->session->set_flashdata('message', 'Data Gagal Di simpan, Pastikan Memilih Minimal 1.');
			$this->session->set_flashdata('status', 'danger');
		}
		redirect('Pupr/sk_tim_teknis');
	}

	public function pengaturan_sk_tim_teknis_save($var = null)
	{
		$id_skt		= $this->input->post('id');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');
		if ($dok_persyaratan != "") {
			$process = $this->dt->removeDataTimTeknis($id_skt);
			if (!$process) {
				$this->session->set_flashdata('message', 'Data Gagal Di simpan');
				$this->session->set_flashdata('status', 'danger');
			} else {
				for ($i = 0; $i < count($dok_persyaratan); $i++) {
					$id_personal = $dok_persyaratan[$i];
					$data	= array(
						'id_skt' => $id_skt,
						'id_personal' => $id_personal,
					);
					$processInput = $this->Mglobals->setData('tm_sktdetail', $data, '', '');
				}
				if (!$processInput) {
					$this->session->set_flashdata('message', 'Data Gagal di Ubah.');
					$this->session->set_flashdata('status', 'danger');
					//redirect('Pupr/sk_tim_teknis');
				} else {
					$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					//redirect('Pupr/sk_tim_teknis');
				}
			}
		} else {
			$this->session->set_flashdata('message', 'Data Gagal Di simpan, Pastikan Memilih Minimal 1.');
			$this->session->set_flashdata('status', 'danger');
		}
		redirect('sk-tim-teknis');
	}
	//End SK Tim Teknis



	public function saveDataGambar($var = null)
	{
		$id			= $this->input->post('id');
		// var_dump($_FILES);
		if ($_FILES) {
			$thisdir = getcwd();
			$dirPath = $thisdir . "/file/personil/" . $id . '/foto/';
			if (!file_exists($dirPath)) {
				mkdir($dirPath, 0755, true);
  //create directory if not exist
			}

			$config['upload_path'] 		= $dirPath;
			$config['allowed_types'] 	= 'jpg|png';
			$config['max_size']			= '10240';
			$config['encrypt_name']		= TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('foto_upload')) {
				$error['upload'] = $this->upload->display_errors();
				$this->session->set_flashdata('message', 'Foto Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				//redirect('Pupr/personal_asn');
			} else {
				$upload	 		= $this->upload->data();
				$upload_file	= $upload['file_name'];

				$data	= array(
					'foto' => $upload_file,
				);

				if ($id != "") {
					$query		= $this->Mglobals->setData('tm_personal', $data, 'id_personal', $id);
					if ($query) {
						$this->session->set_flashdata('message', 'Foto Berhasil di Simpan.');
						$this->session->set_flashdata('status', 'success');
						//redirect('Pupr/edit_personal_form/' . $id);
					} else {
						$this->session->set_flashdata('message', 'Foto Gagal di Simpan.');
						$this->session->set_flashdata('status', 'danger');
						//redirect('Pupr/edit_personal_form/' . $id);
					}
				} else {

					$this->session->set_flashdata('message', 'Foto Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
				}
			}
		}
		redirect('Pupr/edit_personal_form/' . $id);
	}


	public function UploadFile($id, $dir_file)
	{
		// var_dump($dir_file);
		if ($dir_file) {
			$thisdir = getcwd();
			$dirPath = $thisdir . "/file/personil/" . $id . '/ijazah/';
			if (!file_exists($dirPath)) {
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
			}

			$config['upload_path'] 		= $dirPath;
			$config['allowed_types'] 	= 'pdf';
			$config['max_size']			= '10240';
			$config['encrypt_name']		= TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('foto_upload')) {
				$error['upload'] = $this->upload->display_errors();
			} else {
				$upload	 		= $this->upload->data();
				return $upload['file_name'];
			}
		} else {
			return FALSE;
		}
	}

	//awal psk
	public function PerSKan()
	{
		$select = 'id_sk,no_sk,tgl_sk,expired_sk,file_sk,tipe_sk,personil_id';
		$table = 'tm_sk_pengaturan';
		$pk = 'id_sk';
		$data_sk = $this->mglobals->getData(
			$select,
			$table,
			array('id_kabkot' => $this->session->userdata('loc_id_kabkot')),
			$pk,
			'desc'
		);
		$data['data_sk']	 	= $data_sk;
		$data['content']		= $this->load->view('sk_data/data_sk', $data, TRUE);
		$data['title']			= 'List Data SK';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}
	
	public function simpan_psk()
	{
		$id = $this->input->post('id_skp');
		$no_skp = $this->input->post('no_skp');
		$tipe_sk = $this->input->post('tipe_sk');
		$tgl_skp = $this->input->post('tgl_skp');
		$expired_skp = $this->input->post('expired_skp');
		$config = [
			'upload_path' => './public/uploads/pupr/sk/psk/',
			'allowed_types' => 'pdf|PDF',
			'max_size' => '50000',
			'max_width' => 5000,
			'max_height' => 5000,
			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];
		$this->load->library('upload', $config);
		if ($id != NULL) {
			if (!$this->upload->do_upload('berkas')) {
				$data	= array(
					'no_sk' => $no_skp,
					'tipe_sk' => $tipe_sk,
					'tgl_sk' => date('Y-m-d', strtotime($tgl_skp)),
					'expired_sk' => $expired_skp,
					'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
				);
				$query = $this->mglobals->setData('tm_sk_pengaturan', $data, 'id_sk', $id);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Berhasil Diubah');
					$this->session->set_flashdata('status', 'success');
					redirect('Pupr/PerSKan');
				} else {
					$this->session->set_flashdata('message', 'Data Gagal Diubah');
					$this->session->set_flashdata('status', 'danger');
					redirect('Pupr/PerSKan');
				}
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/pupr/sk/psk/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('Pupr/PerSKan');
				} else {
					$data	= array(
						'no_sk' => $no_skp,
						'tipe_sk' => $tipe_sk,
						'tgl_sk' => date('Y-m-d', strtotime($tgl_skp)),
						'expired_sk' => $expired_skp,
						'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_sk' => $this->upload->data('file_name'),
					);
					$cekFile = $this->gm->getId('id_sk', $id, 'tm_sk_pengaturan')->row()->file_sk;
					$path = FCPATH . '/public/uploads/pupr/sk/psk/';
					$fileLama = $path . $cekFile;
					if (!unlink($fileLama)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
						redirect('Pupr/PerSKan');
					}
					$query = $this->mglobals->setData('tm_sk_pengaturan', $data, 'id_sk', $id);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Diubah');
						$this->session->set_flashdata('status', 'success');
						redirect('Pupr/PerSKan');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Diubah');
						$this->session->set_flashdata('status', 'danger');
						redirect('Pupr/PerSKan');
					}
				}
			}
		} else {
			if (!$this->upload->do_upload('berkas')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/PerSKan');
			} else {
				if ($this->upload->data('file_ext') == ".pdf") {
					$data	= array(
						'id_sk' => $id,
						'no_sk' => $no_skp,
						'tipe_sk' => $tipe_sk,
						'tgl_sk' => date('Y-m-d', strtotime($tgl_skp)),
						'expired_sk' => $expired_skp,
						'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_sk' => $this->upload->data('file_name'),
					);
					$query = $this->mglobals->setData('tm_sk_pengaturan', $data);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Disimpan');
						$this->session->set_flashdata('status', 'success');
						redirect('Pupr/PerSKan');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Disimpan');
						$this->session->set_flashdata('status', 'danger');
						redirect('Pupr/PerSKan');
					}
				} else if($this->upload->data('file_ext') == ".PDF"){
					$data	= array(
						'id_sk' => $id,
						'no_sk' => $no_skp,
						'tipe_sk' => $tipe_sk,
						'tgl_sk' => date('Y-m-d', strtotime($tgl_skp)),
						'expired_sk' => $expired_skp,
						'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_sk' => $this->upload->data('file_name'),
					);
					$query = $this->mglobals->setData('tm_sk_pengaturan', $data);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Disimpan');
						$this->session->set_flashdata('status', 'success');
						redirect('Pupr/PerSKan');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Disimpan');
						$this->session->set_flashdata('status', 'danger');
						redirect('Pupr/PerSKan');
					}
				} else {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/pupr/sk/psk/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('Pupr/PerSKan');
				}
			}
		}
	}
	
	public function ubah_psk()
	{
		$id = $this->input->get('id');
		$data = $this->mglobals->getData('id_sk,no_sk,tipe_sk,tgl_sk,expired_sk', 'tm_sk_pengaturan', array('id_sk' => $id))->row();
		echo json_encode($data);
	}
	
	public function hapus_psk($id)
	{
		$table = 'tm_sk_pengaturan';
		$cekFile = $this->gm->getId('id_sk', $id, 'tm_sk_pengaturan')->row()->file_sk;
		$cekTipeSK = $this->gm->getId('id_sk', $id, 'tm_sk_pengaturan')->row()->tipe_sk;
		$path = FCPATH . '/public/uploads/pupr/sk/psk/';
		$fileLama = $path . $cekFile;
		if (!unlink($fileLama)) {
			$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
			$this->session->set_flashdata('status', 'warning');
		}
		
		$process = $this->mglobals->deleteDataKey($table, 'id_sk', $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			if ($cekTipeSK != "TPA") {
				$process2 = $this->Mpupr->removeDataPSK($id);
			}else{
				$process2 = $this->Mpupr->removeDataTPA($id);
			}
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Pupr/PerSKan');
	}

	public function personil_tpa($id)
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data = array(
			'disable' => '',
			'query_syarat_adm' => $this->Mpupr->get_sk_tpa('a.*,b.*',$id_kabkot),
			'query_syarat_selected' => $this->Mpupr->get_sk_tselected($id),
			'psk' => $this->Mpupr->getDataEditPSK('a.*', $id),
		);
		$this->load->view('sk_data/personil_tpa', $data);
	}

	public function simpan_personil_tpa($var = null)
	{
		$id_skp		= $this->input->post('id');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');
		if ($dok_persyaratan != "") {
			$process = $this->Mpupr->removeDataTPA($id_skp);
			if (!$process) {
				$this->session->set_flashdata('message', 'Data Gagal Di simpan');
				$this->session->set_flashdata('status', 'danger');
			} else {
				for ($i = 0; $i < count($dok_persyaratan); $i++) {
					$id = $dok_persyaratan[$i];
					$data	= array(
						'id_sk' => $id_skp,
						'id_tpanya' => $id,
					);
					$processInput = $this->mglobals->setData('tm_sk_tdetail', $data, '', '');
				}
				if (!$processInput) {
					$this->session->set_flashdata('message', 'Data Gagal di Perbaharui.');
					$this->session->set_flashdata('status', 'danger');
				} else {
					$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
				}
			}
		} else {
			$this->session->set_flashdata('message', 'Data Gagal Di simpan, Pastikan Memilih Minimal 1.');
			$this->session->set_flashdata('status', 'danger');
		}
		redirect('Pupr/PerSKan');
	}
	
	public function personil_sk($id)
	{
		$this->session->userdata('loc_user_id') == 9999 ? $id_kabkot = '' : $id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data = array(
			'disable' => '',
			'query_syarat_adm' => $this->Mpupr->get_sk_parent($id_kabkot),
			'query_syarat_selected' => $this->Mpupr->get_sk_selected($id),
			'psk' => $this->Mpupr->getDataEditPSK('a.*', $id),
		);
		$this->load->view('sk_data/personil_psk', $data);
	}

	public function personil_penilik($id)
	{
		$this->session->userdata('loc_user_id') == 9999 ? $id_kabkot = '' : $id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data = array(
			'disable' => '',
			'query_syarat_adm' => $this->Mpupr->get_sk_parent_p($id_kabkot),
			'query_syarat_selected' => $this->Mpupr->get_sk_selected($id),
			'psk' => $this->Mpupr->getDataEditPSK('a.*', $id),
		);
		$this->load->view('sk_data/personil_psk', $data);
	}
	
	public function simpan_personil_sk($var = null)
	{
		$id_skp		= $this->input->post('id');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');
		if ($dok_persyaratan != "") {
			$process = $this->Mpupr->removeDataPSK($id_skp);
			if (!$process) {
				$this->session->set_flashdata('message', 'Data Gagal Di simpan');
				$this->session->set_flashdata('status', 'danger');
			} else {
				for ($i = 0; $i < count($dok_persyaratan); $i++) {
					$id_personal = $dok_persyaratan[$i];
					$data	= array(
						'id_sk' => $id_skp,
						'id_personal' => $id_personal,
					);
					$processInput = $this->mglobals->setData('tm_sk_pdetail', $data, '', '');
				}
				if (!$processInput) {
					$this->session->set_flashdata('message', 'Data Gagal di Perbaharui.');
					$this->session->set_flashdata('status', 'danger');
					//redirect('pupr/sk_tim_teknis');
				} else {
					$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					//redirect('pupr/sk_tim_teknis');
				}
			}
		} else {
			$this->session->set_flashdata('message', 'Data Gagal Di simpan, Pastikan Memilih Minimal 1.');
			$this->session->set_flashdata('status', 'danger');
		}
		redirect('Pupr/PerSKan');
	}
	//akhir PSK

	//Begin Data TPA
	
	public function Data_Tpa()
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data['provinsi_user'] = $this->Mpupr->getProv('a.*', $id_kabkot);
		if (isset($data['provinsi_user']->nama_kabkota)) {
			$nama_kabkota 	= $data['provinsi_user']->nama_kabkota;
			$id_kabkota		= $data['provinsi_user']->id_kabkot;
		};
		$data['data_tpa']   	= $this->Mpupr->tampilin_tpa('a.*,b.*', $id_kabkot);
		$data['nama_kabkota']	= $nama_kabkota;
		
		$data['content']		= $this->load->view('data_tpa/list_tpanya', $data, TRUE);
		$data['title']			= 'List Data TPA';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}
	
	function Tampilin_Tpa(){
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data=$this->Mpupr->tampilin_tpa('a.*,b.*', $id_kabkot);//$this->Mpupr->tpapusat_list();
		echo json_encode($data);
	}
	
	function Pilih_Hapus_Tpa(){
		$id_nya	= $this->input->get('kode');
		$table = 'zample_tm_tpa_perkabkot';
		$process = $this->mglobals->deleteDataKey($table, 'id_nya', $id_nya);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
	}
	
	public function Pilih_Tpa()
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data['provinsi_user'] = $this->Mpupr->getProv('a.*', $id_kabkot);
		if (isset($data['provinsi_user']->id_provinsi)) {
			$provinsi = $data['provinsi_user']->id_provinsi;
		};
		$data['provinsi_nama'] = $this->Mpupr->getnamaProv('a.*', $provinsi);
		if (isset($data['provinsi_nama']->nama_provinsi)) {
			$nama_provinsi = $data['provinsi_nama']->nama_provinsi;
		};
		
		$data['data_tpa']      	=$this->Mpupr->get_ATP('a.*,b.nama_kota', $provinsi, $id_kabkot);
		$data['provinsi']	 	= $nama_provinsi;

		$getUnsur = $this->Mpupr->getDataUnsur()->result();
		$daftar_provinsi = $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data = [
			'title'	=>	'Pilih Data TPA',
			'heading'	=>	'',
			'unsur' => $getUnsur,
			'daftar_provinsi' => $daftar_provinsi	
		];
		$this->template->load('template/template_backend', 'data_tpa/pilih_tpanya', $data);
	}
	public function output_json($data, $encode = true)
	{
		if ($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}	
	function Tampil_Pilih_Tpa()
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data['provinsi_user'] = $this->Mpupr->getProv('a.*', $id_kabkot);
		if (isset($data['provinsi_user']->id_provinsi)) {
			$provinsi = $data['provinsi_user']->id_provinsi;
		};
		$data = $this->Mpupr->_getAPIDataTPA($id_kabkot,$provinsi); //$this->Msekretariat->tpapusat_list();
		$this->output_json($data, false);
	}

	public function getDataKabKota()
    {
        $id_provinsi    = $this->uri->segment(3);
        $value        = array();
        $query        = $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $id_provinsi);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $value[]    = array('id_kabkot' => $row->id_kabkot, 'nama_kabkota' => $row->nama_kabkota);
            }
        }
        echo json_encode($value);
    }	
	
	
	function Tampil_Pilih_Tpa2(){
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data['provinsi_user'] = $this->Mpupr->getProv('a.*', $id_kabkot);
		if (isset($data['provinsi_user']->id_provinsi)) {
			$provinsi = $data['provinsi_user']->id_provinsi;
		};
		$data=$this->Mpupr->get_ATP('a.*b.nama_kota', $provinsi, $id_kabkot);//$this->Mpupr->tpapusat_list();
		echo json_encode($data);
	}
	
	function Pilih_Simpan_Tpa(){
		$id_nya		= '';
		$id_kabkotnya  = $this->session->userdata('loc_id_kabkot');
		$id_tpanya	= $this->input->get('kode');
		$data	= array(
			'id_nya' => $id_nya,
			'id_kabkotnya' => $id_kabkotnya,
			'id_tpanya' => $id_tpanya
		);
		$query		= $this->mglobals->setData('zample_tm_tpa_perkabkot', $data, 'id_nya', $id_nya);
	}
	//End Data TPA
	//Begin SK TPA Pusat
	public function SkTpa()
	{
		$select = 'id_sk,no_sk,tgl_sk,expired_sk,file_sk,tipe_sk,personil_id';
		$table = 'tm_sk_pengaturan';
		$pk = 'id_sk';
		$data_sk = $this->mglobals->getData(
			$select,
			$table,
			array('id_kabkot' => '0' ),
			$pk,
			'desc'
		);
		$data['data_sk']	 	= $data_sk;
		$data['content']		= $this->load->view('sk_data/data_sk_tpa', $data, TRUE);
		$data['title']			= 'List Data SK';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}
	
	public function simpan_sk()
	{
		$id = $this->input->post('id_skp');
		$no_skp = $this->input->post('no_skp');
		$tipe_sk = $this->input->post('tipe_sk');
		$tgl_skp = $this->input->post('tgl_skp');
		$expired_skp = $this->input->post('expired_skp');
		$config = [
			'upload_path' => './public/uploads/pupr/sk/psk/',
			'allowed_types' => 'pdf|PDF',
			'max_size' => '50000',
			'max_width' => 5000,
			'max_height' => 5000,
			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];
		$this->load->library('upload', $config);
		if ($id != NULL) {
			if (!$this->upload->do_upload('berkas')) {
				$data	= array(
					'no_sk' => $no_skp,
					'tipe_sk' => $tipe_sk,
					'tgl_sk' => date('Y-m-d', strtotime($tgl_skp)),
					'expired_sk' => $expired_skp,
					//'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
				);
				$query = $this->mglobals->setData('tm_sk_pengaturan', $data, 'id_sk', $id);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Berhasil Diubah');
					$this->session->set_flashdata('status', 'success');
					redirect('Pupr/SkTpa');
				} else {
					$this->session->set_flashdata('message', 'Data Gagal Diubah');
					$this->session->set_flashdata('status', 'danger');
					redirect('Pupr/SkTpa');
				}
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/pupr/sk/psk/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('Pupr/SkTpa');
				} else {
					$data	= array(
						'no_sk' => $no_skp,
						'tipe_sk' => $tipe_sk,
						'tgl_sk' => date('Y-m-d', strtotime($tgl_skp)),
						'expired_sk' => $expired_skp,
						//'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_sk' => $this->upload->data('file_name'),
					);
					$cekFile = $this->gm->getId('id_sk', $id, 'tm_sk_pengaturan')->row()->file_sk;
					$path = FCPATH . '/public/uploads/pupr/sk/psk/';
					$fileLama = $path . $cekFile;
					if (!unlink($fileLama)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
						redirect('Pupr/SkTpa');
					}
					$query = $this->mglobals->setData('tm_sk_pengaturan', $data, 'id_sk', $id);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Diubah');
						$this->session->set_flashdata('status', 'success');
						redirect('Pupr/SkTpa');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Diubah');
						$this->session->set_flashdata('status', 'danger');
						redirect('Pupr/SkTpa');
					}
				}
			}
		} else {
			if (!$this->upload->do_upload('berkas')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/SkTpa');
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/pupr/sk/psk/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('Pupr/SkTpa');
				} else {
					$data	= array(
						'id_sk' => $id,
						'no_sk' => $no_skp,
						'tipe_sk' => $tipe_sk,
						'tgl_sk' => date('Y-m-d', strtotime($tgl_skp)),
						'expired_sk' => $expired_skp,
						//'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_sk' => $this->upload->data('file_name'),
					);
					$query = $this->mglobals->setData('tm_sk_pengaturan', $data);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Disimpan');
						$this->session->set_flashdata('status', 'success');
						redirect('Pupr/SkTpa');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Disimpan');
						$this->session->set_flashdata('status', 'danger');
						redirect('Pupr/SkTpa');
					}
				}
			}
		}
	}
	
	public function personil_tpap($id)
	{
		//$this->session->userdata('loc_user_id') == 9999 ? $id_kabkot = '' : $id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data = array(
			'disable' => '',
			'query_syarat_adm' => $this->Mpupr->get_sk_tpa(),
			'query_syarat_selected' => $this->Mpupr->get_sk_tselected($id),
			'psk' => $this->Mpupr->getDataEditPSK('a.*', $id),
		);
		$this->load->view('sk_data/personil_tpap', $data);
	}
	
	public function simpan_personil_tpap($var = null)
	{
		$id_skp		= $this->input->post('id');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');
		if ($dok_persyaratan != "") {
			$process = $this->Mpupr->removeDataTPA($id_skp);
			if (!$process) {
				$this->session->set_flashdata('message', 'Data Gagal Di simpan');
				$this->session->set_flashdata('status', 'danger');
			} else {
				for ($i = 0; $i < count($dok_persyaratan); $i++) {
					$id = $dok_persyaratan[$i];
					$data	= array(
						'id_sk' => $id_skp,
						'id_tpanya' => $id,
					);
					$processInput = $this->mglobals->setData('tm_sk_tdetail', $data, '', '');
				}
				if (!$processInput) {
					$this->session->set_flashdata('message', 'Data Gagal di Perbaharui.');
					$this->session->set_flashdata('status', 'danger');
				} else {
					$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
				}
			}
		} else {
			$this->session->set_flashdata('message', 'Data Gagal Di simpan, Pastikan Memilih Minimal 1.');
			$this->session->set_flashdata('status', 'danger');
		}
		redirect('Pupr/SkTpa');
	}
	//End SK TPA Pusat
	public function data_kampus()
	{
		$select = 'id,nm_asosiasi,alamat,no_tlp';
		$table = 'tr_asosiasi';
		$pk = 'id';
		$dat_kam = $this->mglobals->getData(
			$select,
			$table,
			array('group' => 2),
			$pk,
			'desc'
		);
		$data['dat_kampus'] 	= $dat_kam;
		$data['content']		= $this->load->view('data_kampus', $data, TRUE);
		$data['title']			=	'';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}

	public function simpan_kampus()
	{
		//$nama_as			= $this->session->userdata('loc_id_kabkot');
		$id				= $this->input->post('id_as');
		$nama_as		= $this->input->post('nama_as');
		$alamat_as		= $this->input->post('alamat_as');
		$notel			= $this->input->post('notel');
		
		if ($id != NULL) {
			
			$data	= array(
				'nm_asosiasi' => $nama_as,
				'group' => 2,
				'alamat' => $alamat_as,
				'no_tlp' => $notel,
				);
				
			$query = $this->mglobals->setData('tr_asosiasi', $data, 'id', $id);
				
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/data_kampus');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/data_kampus');
			}
		}else{
			
			$data	= array(
				'id' => $id,
				'nm_asosiasi' => $nama_as,
				'group' => 2,
				'alamat' => $alamat_as,
				'no_tlp' => $notel,
			);
			$query		= $this->mglobals->setData('tr_asosiasi', $data);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pupr/data_kampus');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pupr/data_kampus');
			}
		}	
	}

	public function ubah_kampus()
	{
		$id = $this->input->get('id');
		$data = $this->mglobals->getData('id,nm_asosiasi,alamat,no_tlp', 'tr_asosiasi', array('id' => $id))->row();
		echo json_encode($data);
	}

	public function hapus_kampus($id)
	{
		$table = 'tr_asosiasi';
		$process = $this->mglobals->deleteDataKey($table, 'id', $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Pupr/data_kampus');
	}

	// Detail TPA 
	public function DetailTPA()
	{
		$id = $this->input->get('id');
		$getTPA = $this->Mpupr->getDetailTPA($id);
		// var_dump($getTPA->num_rows()); die;
		if ($getTPA->num_rows() > 0) {
			$row = $getTPA->row();
			$glr_depan = $row->glr_depan == '' && $row->glr_depan == NULL ? '' : $row->glr_depan . ' ';
			$glr_blkg = $row->glr_blkg == '' && $row->glr_blkg == NULL ? '' : ' ' . $row->glr_blkg;
			$nama =  $glr_depan . $row->nm_tpa . $glr_blkg;
			$lembaga = $row->id_lembaga;
			$tmpt_lahir = $row->tmpt_lahir == NULL && $row->tmpt_lahir == '' ? 'Tidak Diisi' : ucwords($row->tmpt_lahir);
			$alamat = $row->alamat == NULL && $row->alamat == '' ? 'Tidak Diisi' : $row->alamat;
			$tgl_lahir = $row->tgl_lahir == NULL && $row->tgl_lahir == '' ? 'Tidak Diisi' : $row->tgl_lahir;
			$email = $row->email == NULL && $row->email == '' ? 'Tidak Diisi' : $row->email;
			$no_kontak = $row->no_kontak == NULL && $row->no_kontak == '' ? 'Tidak Diisi' : $row->no_kontak;

			if ($lembaga == 1) {
				$unsur = 'Akademisi';
			} else if ($lembaga == 2) {
				$unsur = 'Pakar';
			} else {
				$unsur = 'Profesi Ahli';
			}

			$data = [
				'nama' => $nama,
				'unsur' => $unsur,
				'keahlian' => '-',
				'id' => $row->id,
				'tmpt_lahir' => $tmpt_lahir,
				'alamat' => $alamat,
				'tgl_lahir' => $tgl_lahir,
				'email' => $email,
				'no_kontak' => $no_kontak,
				'dir_file' => $row->dir_file == '' && $row->dir_file == NULL ? false : $row->dir_file,
				'res' => true
			];
			header('Content-Type: application/json');
			echo json_encode($data);
		} else {
			$data = [
				'message' => 'Record Not Found!',
				'type' => 'error',
				'res' => false
			];
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}

	// End Detail TPA
	// Delete Directory
	private function AllDelete($link)
	{
		  $this->load->helper('file'); // Load codeigniter file helper
		  $thisdir = getcwd();
		  $dirPath = $thisdir . $link;

		  if(is_dir($dirPath))
		  {
			delete_files($dirPath, true); // Delete files into the folder
			rmdir($dirPath); // Delete the folder 
			$this->session->set_flashdata('message', 'Data Berhasil di Bersihkan.');
			$this->session->set_flashdata('status', 'success');
		  }else{
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		  }
		  
		  //redirect();
	}

	public function kirim_ulang()
	{

		$id_kirimulang = $this->uri->segment(3);

		if ($id_kirimulang > 1) {
			$query = $this->db->get_where('tm_user',array('id'=>$id_kirimulang));
			if($query->num_rows() > 0) {

				$data_user = $query->row();

				$email	= $data_user->email;
				$link	=  base_url() . "Front/daftar_akun_dinas/$data_user->activation";
				$pwdnya	='simbg123pu';
				//$jabatan='';

				$subject 	= "Verifikasi User Pengajuan Akses Admin SIMBG | CS SIMBG";
				$text 		= "";
				$text .= "Yth Bapak/Ibu,<br>";
				$text .= "<br>";
				$text .= "Kami menerima permintaan pembuatan akun untuk mengakses layanan SIMBG Online. <br><br>";
				$text .= "Akun Anda Sebagi berikut <br>";
				$text .= "&emsp; Email : $email <br>";
				$text .= "&emsp; Kata Sandi : $pwdnya <br><br>";
				$text .= "Silahkan Klik Tautan berikut ini untuk melanjutkan proses -> <a href='$link' >Verifikasi</a> <br>";
				$text .= "<br>";
				$text .= "<br>";
				$text .= "Hormat Kami <br>";
				$text .= "Admin SIMBG ";
				$this->simbg_lib->sendEmail($email, $subject, $text);

				$this->session->set_flashdata('message', "Link aktivasi berhasil dikirim ulang. Silahkan buka email $email untuk proses aktivasi.");
				$this->session->set_flashdata('status', 'success');

			}else{

				$this->session->set_flashdata('message', 'Pengiriman Gagal.');
				$this->session->set_flashdata('status', 'danger');
			}


		}else{

			if(!$this->session->userdata('sku')) {

				$this->session->set_flashdata('message', 'Pengiriman Email Gagal.');
				$this->session->set_flashdata('status', 'danger');

			}else{

				$sku = $this->session->userdata('sku');

				$email	= $sku["s_email"];
				$subject= $sku["s_subject"];
				$text	= $sku["s_text"];
				$this->simbg_lib->sendEmail($email, $subject, $text);

				$this->session->set_flashdata('message', "Link aktivasi berhasil terkirim ulang. Silahkan buka email $email untuk proses aktivasi.");
				$this->session->set_flashdata('status', 'success');

			}

		}
		
		redirect('Pupr/data_dinas');			

	}

	public function delsku(){
		$this->session->unset_userdata('sku');
	}

}
