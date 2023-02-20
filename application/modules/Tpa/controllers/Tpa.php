<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Tpa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtpa');
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->load->library('Simbg_lib');
		$this->simbg_lib->check_session_login();
	}

	public function index()
	{
		//$this->personil();
	}
	//Begin Verifikasi TPA Oleh  Asosiasi Profesi Khusus /Perguruan Tinggi/Pemda KabKota
	public function Verifikasi()
	{
		$asosiasi		= $this->session->userdata('loc_asosiasi');
		$id_asosiasi	= $this->session->userdata('loc_id_asosiasi');
		//echo $id_asosiasi;
		$data['tpa_result'] = $this->Mtpa->listDataTpa('a.*,b.keterangan,c.dir_file', $asosiasi,$id_asosiasi);
		if ($asosiasi =='1'){
			$data['content']	= $this->load->view('verifikasi/VerifikasiAkademisi', $data, TRUE);
		}else if($asosiasi == '2'){
			$data['content']	= $this->load->view('verifikasi/VerifikasiPakar', $data, TRUE);
		}else if($asosiasi =='3'){
			$data['content']	= $this->load->view('verifikasi/VerifikasiProfesi', $data, TRUE);
		}
		$data['title']		=	'Verifikasi Data TPA';
		$data['heading']	=	'Verifikasi';
		$this->load->view('template_profil', $data);
	}

	public function VerifikasiForm()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->Mtpa->getDataTpaVer($id);
		$data['data'] 		= $query->row();
		$this->load->view('verifikasi/Verifikasi', $data);
	}

	public function SimpanStatus()
	{
		$id	= $this->input->post('id');
		$email = $this->input->post('email');
		//Begin Ya
		if($this->input->post('xstileng')) {
			$dataProgress = array (
					'status' => 3,
			);
			$email = "$email";
			$subject 	= "Status Verifikasi Calon TPA";
			$text 		= "";
			$text .= "Yth Bapak/Ibu,<br>";
			$text .= "<br>";
			$text .= "Dengan ini kami memberitahukan bahwa Anda telah di Verifikasi Sebagai TPA<br>";
			$text .= "Dengan keterangan <b>Memenuhi Persyaratan</b><br>";
			$text .= "<br>";
			$text .= "<br>";
			$text .= "Hormat Kami <br>";
			$text .= "Admin SIMBG ";
			$this->Mtpa->updateProgress($dataProgress,$id);
			$this->simbg_lib->sendEmail($email, $subject, $text);
		
			$this->session->set_flashdata('message','Selesai Verifikasi');
			$this->session->set_flashdata('status','success');
			redirect('Tpa/Verifikasi');
		}
		//Begin Tidak
		if($this->input->post('xsleng')) {			
			$dataProgress = array (
					'status' => 2,
				);
			$email = "$email";
			$subject 	= "Status Verifikasi Calon TPA";
			$text 		= "";
			$text .= "Yth Bapak/Ibu,<br>";
			$text .= "<br>";
			$text .= "Dengan ini kami memberitahukan bahwa Anda telah di Verifikasi Sebagai TPA<br>";
			$text .= "Dengan keterangan <b>Hasil Tidak Memenuhi Persyaratan</b><br>";
			$text .= "Silahkan memperbaiki Dokumen jika anda masih berminat untuk menjadi TPA<br>";
			$text .= "<br>";
			$text .= "<br>";
			$text .= "Hormat Kami <br>";
			$text .= "Admin SIMBG ";
			$this->Mtpa->updateProgress($dataProgress,$id);
			$this->simbg_lib->sendEmail($email, $subject, $text);
			//$this->Mtpa->updateProgress($dataProgress,$id);							
			$this->session->set_flashdata('message','Selesai Verifikasi');
			$this->session->set_flashdata('status','success');
			redirect('Tpa/Verifikasi');
		}
	}
	//End Verifikasi TPA Oleh Asosiasi Profesi Khusus /Perguruan Tinggi/Pemda KabKota

	//Begin Validasi TPA oleh Kementerian PUPR
	public function Validasi()
	{
		$search = $this->input->post('search');
		//$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		if ($search != '') {
			$SQLcari = array(
				'id_lembaga' => trim($this->input->post('id_lembaga')),
				'status' => trim($this->input->post('status')),
			);
			$this->session->set_userdata($SQLcari);
			$data = array(
				'id_lembaga' => trim($this->input->post('id_lembaga')),
				'status' => trim($this->input->post('status')),
			);
		}
		$data['tpa_result'] = $this->Mtpa->getListValidasitor($SQLcari);
		//$data['tpa_result'] = $this->Mtpa->listValidasiDataTpa('a.*,b.*,c.nm_asosiasi,c.group');
		$data['content']	= $this->load->view('Validasi/Validasi_list', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm', $data);
	}

	public function ValidasiForm()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->Mtpa->getDataTpaVer($id);
		$data['data'] 		= $query->row();
		$data['DataPendidikan']	= $this->Mtpa->listDataPend($id);
		$data['DataAhli']		= $this->Mtpa->listDataKeahlian($id);
		$data['DataPengalaman']	= $this->Mtpa->listDataPeng($id);
		$this->load->view('Validasi/FormValidasi', $data);
	}
	//End Validasi TPA oleh Kementerian PUPR
	//Begin Profile Akademisi Asosiasi
	public function Profile()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$id_kabkot				= $this->session->userdata('loc_id_kabkot');
		$role_id 				= $this->session->userdata('loc_role_id');
		$asosiasi 				= $this->session->userdata('loc_id_asosiasi');
		$aso					= $this->session->userdata('loc_asosiasi');
		$data['role']	 		= $this->session->userdata('loc_role_id');
		$data['profile_ak'] 	= $this->Mtpa->getDataDinasAsosiasi('a.*', $asosiasi);
		$data['result'] 	= $this->Mtpa->getDataAkun($asosiasi);
		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		if($aso =='3'){
			if($role_id =='14'){
				$data['content']		= $this->load->view('Profile/ProfileAso', $data, TRUE);
			}else{
				$data['content']		= $this->load->view('Profile/Profile', $data, TRUE);
			}
		}else{
			$data['content']		= $this->load->view('Profile/Profile', $data, TRUE);
		}
		$data['title']			=	'Profil Asosiasi';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}

	public function saveDataAsosiasi()
	{
		$id					= $this->input->post('id');
		$nm_asosiasi		= $this->input->post('nm_asosiasi');
		$alamat				= $this->input->post('alamat');
		$no_tlp				= $this->input->post('no_tlp');
		$email			= $this->input->post('email');
		$data	= array(
			'alamat' => $alamat,
			'no_tlp' => $no_tlp,
			'email' => $email,
			'nm_asosiasi' => $nm_asosiasi,
			
		);

		if ($id != "") {
			$query		= $this->Mglobals->setData('tr_asosiasi', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('Tpa/Profile');
		} else {
			$query		= $this->Mglobals->setData('tr_asosiasi', $data, 'id', $id);

			if ($query) {
				$this->session->set_flashdata('message', 'Biodata User Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Tpa/Profile');
			} else {
				$this->session->set_flashdata('message', 'Biodata User Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Tpa/Profile');
			}
		}
	}

	public function create_sub_akun()
	{
		$email 		= $this->input->post('email');
		$nama 		= $this->input->post('nama');
		$jabatan 	= $this->input->post('jabatan');
		$kabkot 	= $this->input->post('id_provinsi');
		$role_id 	= $this->session->userdata('loc_role_id');
		$penginput	= $this->session->userdata('loc_email');
		$asosiasi 	= $this->session->userdata('loc_id_asosiasi');
		$len = 8;
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$pwdnya = substr( str_shuffle( $chars ), 0, $len );
		
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
				$max = 5;
				break;
			case 6:
				$child = 8;
				$data['htable'] = 'Pengawas';
				$max = 5;
				break;
			case 7:
				$child = 9;
				$data['htable'] = 'Operator';
				$max = 10;
				break;
			case 8:
				$child = 11;
				$data['htable'] = 'Operator';
				$max = 10;
				break;

			default:
				$child = 0;
				$data['htable'] = 'N/A';
				$max = 10;
				break;
		}
		$cekmax = $this->Mtpa->get('tm_user', array('role_id' => $child, 'id_kabkot' => $kabkot))->result_array();
		$aktivation = $nama . '-' . $email;
		$u_password	= sha1($pwdnya . $this->config->item('encryption_key'));
		$cek = $this->Mtpa->get('tm_user', array('username' => $email))->result_array();
		if (count($cek) == 0 && count($cekmax) < $max) {
			$data1 = array(
				'username' => $email,
				'password' => $u_password,
				'id_kabkot'=> $kabkot,
				'role_id'  => 16,
				'id_asosiasi' => $asosiasi,
				'Asosiasi' =>3,
				'email' => $email,
				'activation' => sha1($aktivation . $this->config->item('encryption_key')),
				'post_date' => date('Y-m-d H:i:s'),
				'post_by' => $penginput

			);
			$id_pengguna = $this->Mtpa->createSubAkun('tm_user', $data1);
			$kd_aktivasi = sha1($aktivation . $this->config->item('encryption_key'));
			$data = array(
				'email' => $email,
				'nama_lengkap' => $nama,
				'jabatan_dinas' => $jabatan,
				'user_id' => $id_pengguna, // add last insert id to mahasiswa table
				'post_date' => date('Y-m-d'),
				'post_by' => $penginput
			);
			$query = $this->Mtpa->createSubAkun('tm_user_data', $data);
			if ($query) {
				//Begin SendEmail
				$subject 	= "Verifikasi User Pengajuan Akses Admin SIMBG | CS SIMBG";
				$link		=  base_url() . "Front/daftar_akun_dinas/$kd_aktivasi";
				$text 		= "";
				$text .= "Yth Bapak/Ibu,<br>";
				$text .= "<br>";
				$text .= "Kami menerima permintaan pembuatan akun untuk mengakses layanan SIMBG Online dengan wewenang sebagai Verifikator Asosiasi Cabang Provinsi. <br><br>";
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
				$this->session->set_flashdata('message', "Akun dengan email $email berhasil didaftarkan.<br>Silahkan buka email yg telah didaftarkan untuk proses aktivasi.");
				$this->session->set_flashdata('status', 'success');
				redirect('Tpa/Profile');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Tpa/Profile');
			}
		} elseif (count($cekmax) >= 5) {
			$this->session->set_flashdata('message', 'Tidak bisa menambah akun (max 5 akun),<br>Silahkan hubungi admin kami untuk info lebih lanjut.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Tpa/Profile');
		} else {
			$this->session->set_flashdata('message', 'akun dengan email $email sudah terdaftarkan di System kami.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Tpa/Profile');
		}
	}
	//End Profile Akademisi/Asosiasi
	//Begin Verifikasi Oleh Provinsi
	public function VerifikasiProv()
	{
		$asosiasi		= $this->session->userdata('loc_asosiasi');
		$id_asosiasi	= $this->session->userdata('loc_id_asosiasi');
		$id_prov		= $this->session->userdata('loc_id_kabkot');
		$data['tpa_result'] = $this->Mtpa->listDataTpaProv('a.*,b.keterangan,c.dir_file', $asosiasi,$id_asosiasi,$id_prov);
		$data['content']	= $this->load->view('verifikasi/VerifikasiProfProv', $data, TRUE);
		$data['title']		=	'Verifikasi Data TPA';
		$data['heading']	=	'Verifikasi';
		$this->load->view('template_profil', $data);
	}

	public function VerifikasiProvForm()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->Mtpa->getDataTpaVer($id);
		$data['data'] 		= $query->row();
		$this->load->view('verifikasi/VerifikasiProv', $data);
	}

	public function SimpanStatusProv()
	{
		$id	= $this->input->post('id');
		if($this->input->post('xstileng')) {
			$dataProgress = array (
				'status' => 3,
			);
			$this->Mtpa->updateProgress($dataProgress,$id);
			$this->session->set_flashdata('message','Selesai Verifikasi');
			$this->session->set_flashdata('status','success');
			redirect('Tpa/VerifikasiProv');
		}
		//Begin Tidak
		if($this->input->post('xsleng')) {			
			$dataProgress = array (
					'status' => 2,
				);
			$this->Mtpa->updateProgress($dataProgress,$id);

			$this->session->set_flashdata('message','Selesai Verifikasi');
			$this->session->set_flashdata('status','success');
			redirect('Tpa/VerifikasiProv');
		}
	}
}
