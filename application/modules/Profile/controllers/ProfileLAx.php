<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mprofile');
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->load->library('simbg_lib');
		//$this->simbg_lib->check_session_login();
	}

	public function index()
	{ 
		$this-> akun_saya();
	}

	public function cekLog()
	{ 
		//if ($this->session->userdata('loc_role_id') == '' and $this->session->userdata('loc_email') == '') {
		if ($this->session->userdata('loc_login') != TRUE) {
			redirect('Front/logout');
		}
	}
	
	public function lengkapi_akun()
	{
		$this-> cekLog();
		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$data['profile_user'] = $this->Mprofile->getDataUserProfile('a.*', $user_id);
		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		if (isset($data['profile_user']->id_provinsi)) {
			$provinsi = $data['profile_user']->id_provinsi;
			$data['daftar_kabkota']		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $provinsi);
		}
		if (isset($data['profile_user']->id_kabkota)) {
			$kabkot = $data['profile_user']->id_kabkota;
			$data['daftar_kecamatan']	= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $kabkot);
		}
		$data['judul']		=	'Lengkapi Akun Anda';
		$data['content']	= $this->load->view('akun_saya/form_akun', $data, TRUE);
		$data['title']		=	'Lengkapi Akun Anda';
		$data['heading']	=	'';
		$this->load->view('temp_profil', $data);
	}
	//Begin Akun Saya
	public function akun_saya()
	{
		$this-> cekLog();
		//$user_id	= $this->session->userdata('loc_user_id');
		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$role_id	= $this->session->userdata('loc_role_id');
		$data['profile_user'] = $this->Mprofile->getDataUserProfile('a.*', $user_id);
		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		if (isset($data['profile_user']->id_provinsi)) {
			$provinsi = $data['profile_user']->id_provinsi;
			$data['daftar_kabkota']		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $provinsi);
		}
		if (isset($data['profile_user']->id_kabkota)) {
			$kabkot = $data['profile_user']->id_kabkota;
			$data['daftar_kecamatan']	= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $kabkot);
		}
		$data['judul']		=	'Informasi Akun';
		$data['content']	= $this->load->view('akun_saya/form_akun', $data, TRUE);
		$data['title']		=	'Akun Saya';
		$data['heading']	=	'';
		$this->load->view('Dbai', $data);
	}

	public function cekKelengkapanData($var = null)
	{
		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$select = array('nama_lengkap', 'alamat', 'id_provinsi', 'id_kabkota', 'id_kecamatan', 'no_hp');
		$where = array("user_id = " => $user_id);
		// $this->db->select($select);
		$result = $this->db->select($select)->get_where('tm_user_data', $where)->row();

		$i = 0;
		if (count($result) > 0) {

			foreach ($result as $key => $value) {
				// echo $key . " => " . $value;
				if ($value == '') {
					// echo "No-Data $key";
					$i++;
				}
				// echo "<br>";
			}
		}
		// print_r($i);
		if ($i > 0) {
			$this->session->set_flashdata('message', 'Data Harus diengkapi sebelum melanjutkan.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Profile/lengkapi_akun');
		} else {
			$this->session->set_flashdata('message', 'Data Berhasil Disimpan.');
			$this->session->set_flashdata('status', 'success');
			redirect('Dashboard');
		}
	}

	public function getDataProvinsi()
	{

		$value		= array();
		$query		= $this->Mprofile->listDataProvinsi('id_provinsi,nama_provinsi');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_provinsi' => $row->id_provinsi, 'nama_provinsi' => $row->nama_provinsi);
			}
		}
		echo json_encode($value);
	}

	public function getDataKabKota()
	{
		$id_provinsi	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mprofile->listDataKabKota('id_kabkot,nama_kabkota', '', $id_provinsi);
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
		$query		= $this->Mprofile->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $id_kabkot);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kecamatan' => $row->id_kecamatan, 'nama_kecamatan' => $row->nama_kecamatan);
			}
		}
		echo json_encode($value);
	}

	public function getDataKelurahan()
	{
		$id_kecamatan	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mprofile->listDataKelurahan('a.id_kelurahan,a.nama_kelurahan', '', $id_kecamatan);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kelurahan' => $row->id_kelurahan, 'nama_kelurahan' => $row->nama_kelurahan);
			}
		}
		echo json_encode($value);
	}


	public function saveBiodata()
	{

		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$id				= $this->input->post('id');
		$role_id		= $this->session->userdata('loc_role_id');
		$nama_lengkap	= $this->input->post('nama_lengkap');
		$glr_depan	= $this->input->post('glr_depan');
		$glr_belakang	= $this->input->post('glr_belakang');
		$alamat			= $this->input->post('alamat');
		$nama_provinsi	= $this->input->post('nama_provinsi');
		$nama_kabkota	= $this->input->post('nama_kabkota');
		$nama_kecamatan	= $this->input->post('nama_kecamatan');
		$no_ktp			= $this->input->post('no_ktp');
		$no_hp			= $this->input->post('no_hp');
		$nip			= $this->input->post('nip');
		$jabatan		= $this->input->post('jabatan');
		$email			= $this->input->post('email');
		$id_lembaga		= $this->input->post('id_lembaga');

		$data	= array(
			'user_id' => $user_id,
			'nama_lengkap' => $nama_lengkap,
			'glr_depan' => $glr_depan,
			'glr_belakang' => $glr_belakang,
			'alamat' => $alamat,
			'id_provinsi' => $nama_provinsi,
			'id_kabkota' => $nama_kabkota,
			'id_kecamatan' => $nama_kecamatan,
			'no_ktp' => $no_ktp,
			'no_hp' => $no_hp,
			'nip' => $nip,
			'jabatan_dinas' => $jabatan,
			'email'=>$email
		);

		$datatpa	= array(
			'id_user' => $user_id,
			'nm_tpa' => $nama_lengkap,
			'glr_depan' => $glr_depan,
			'glr_blkg' => $glr_belakang,
			'no_ktp' => $no_ktp,
			'id_lembaga' => $id_lembaga,
			'email'	=> $email,
			'alamat' => $alamat,
			'id_provinsi' => $nama_provinsi,
			'id_kabkot' => $nama_kabkota,
			'id_kecamatan' => $nama_kecamatan,
			
		);

		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_user_data', $data, 'id', $id);
			if($role_id != 17 ){
			
			}else{
				$query		= $this->Mglobals->setData('tm_tpa', $datatpa, 'id');
			}
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			if($role_id != 17 ){
				redirect('Profile/cekKelengkapanData');
			}else{
				redirect('Profile/cekKelengkapanData');
			}
	
		} else {
			$query		= $this->Mglobals->setData('tm_user_data', $data, 'id', $id);
			if($role_id != 17 ){
			
			}else{
				$query		= $this->Mglobals->setData('tm_tpa', $datatpa, 'id', $id);
			}
			if ($query) {
				redirect('Profile/cekKelengkapanData');
			} else {
				$this->session->set_flashdata('message', 'Biodata User Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				if($role_id != 17 ){
					redirect('Profile/cekKelengkapanData');
				}else{
					redirect('Profile/cekKelengkapanData');
				}
			}
		}
	}

	public function saveDataPekerjaan()
	{
		$user_id					= $this->session->userdata('loc_user_id');
		$id							= $this->input->post('id');
		$bentuk_usaha				= $this->input->post('bentuk_usaha');
		$pekerjaan					= $this->input->post('pekerjaan');
		$nama_perusahaan			= $this->input->post('nama_perusahaan');
		$jabatan_perusahaan			= $this->input->post('jabatan_perusahaan');
		$alamat_perusahaan			= $this->input->post('alamat_perusahaan');
		$nama_provinsi_perusahaan	= $this->input->post('nama_provinsi_perusahaan');
		$nama_kabkota_perusahaan	= $this->input->post('nama_kabkota_perusahaan');
		$nama_kecamatan_perusahaan	= $this->input->post('nama_kecamatan_perusahaan');

		$data	= array(
			'user_id' => $user_id,
			'bentuk_usaha' => $bentuk_usaha,
			'pekerjaan' => $pekerjaan,
			'jabatan_perusahaan' => $jabatan_perusahaan,
			'nama_perusahaan' => $nama_perusahaan,
			'alamat_perusahaan' => $alamat_perusahaan,
			'id_provinsi_perusahaan' => $nama_provinsi_perusahaan,
			'id_kabkota_perusahaan' => $nama_kabkota_perusahaan,
			'id_kecamatan_perusahaan' => $nama_kecamatan_perusahaan,
			// 'post_date' => date('Y-m-d H:i:s'),
			// 'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
		);

		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_user_data', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('profile/akun_saya');
		} else {
			$query		= $this->Mglobals->setData('tm_user_data', $data, 'id', $id);

			if ($query) {
				$this->session->set_flashdata('message', 'Biodata User Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('profile/akun_saya');
			} else {
				$this->session->set_flashdata('message', 'Biodata User Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('profile/akun_saya');
			}
		}
	}

	public function saveDataFoto()
	{
		$user_id	= $this->session->userdata('loc_user_id');
		$id			= $this->input->post('id');
		if ($_FILES) {
			$thisdir = getcwd();
			$dirPath = $thisdir . "/file/profile_user/" . $user_id . "/foto_profile/";
			if (!file_exists($dirPath)) {
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
			}

			$config['upload_path'] 		= $dirPath;
			$config['allowed_types'] 	= 'jpg|png';
			$config['max_size']			= '10240';
			$config['encrypt_name']		= TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('foto_upload')) {
				$error['upload'] = $this->upload->display_errors();
			} else {
				$upload	 		= $this->upload->data();
				$upload_file	= $upload['file_name'];

				$data	= array(
					'foto_profile' => $upload_file,
					// 'post_date' => date('Y-m-d H:i:s'),
					// 'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
				);

				if ($id != "") {
					$query		= $this->Mglobals->setData('tm_user_data', $data, 'id', $id);
					$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
					$this->session->set_flashdata('status', 'success');
					redirect('profile/akun_saya');
				} else {
					$query		= $this->Mglobals->setData('tm_user_data', $data, 'id', $id);

					if ($query) {
						$this->session->set_flashdata('message', 'Biodata User Berhasil di Simpan.');
						$this->session->set_flashdata('status', 'success');
						redirect('profile/akun_saya');
					} else {
						$this->session->set_flashdata('message', 'Biodata User Gagal di Simpan.');
						$this->session->set_flashdata('status', 'danger');
						redirect('profile/akun_saya');
					}
				}
			}
		} else {
			redirect('profile/akun_saya');
		}
	}
	//End Akun Saya

	//Begin Ubah password
	public function ubah_password()
	{
		$this-> cekLog();
		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$data['daftar_kecamatan']	= $this->Mprofile->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan');
		$data['daftar_kabkota']	= $this->Mprofile->listDataKabKota('id_kabkot,nama_kabkota');
		$data['daftar_provinsi']	= $this->Mprofile->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['profile_user'] = $this->Mprofile->getDataUserProfile('a.*', $user_id);
		$data['judul']		=	'Ubah Kata Sandi';
		$data['content']	= $this->load->view('ubah_password/form_ubah_password', $data, TRUE);
		$data['title']		=	'Ubah Password';
		$data['heading']	=	'';
		$this->load->view('Dbai', $data);
	}

	public function saveDataPassword()
	{
		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$password					= sha1($this->input->post('password') . $this->config->item('encryption_key'));
		$new_password				= sha1($this->input->post('new_password') . $this->config->item('encryption_key'));
		$confirm_new_password		= $this->input->post('confirm_new_password');

		$cekUserName = $this->Mprofile->cekusername('a.id', '', '', '', $user_id, $password);
		if ($cekUserName->num_rows() > 0) {

			$data	= array(
				'password' => $new_password,
				// 'post_date' => date('Y-m-d H:i:s'),
				// 'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);

			$query		= $this->Mglobals->setData('tm_user', $data, 'id', $user_id);
			//$this->session->set_flashdata('message', 'Password Berhasil di Ubah.');
			//$this->session->set_flashdata('status', 'success');
			//redirect('profile/akun_saya');
			$response = "<div class='alert alert-success'>
									<button class='close' data-close='alert' data-dismiss='modal'></button>
									<center><span>Kata Sandi Berhasil di Perbaharui.</span></center>
						</div>";
			echo $response;
		} else {
			//$this->session->set_flashdata('message', 'Password tidak sesuai,Jika Ada lupa Password Anda silahkan menggunakan fitur Reset Password.');
			//$this->session->set_flashdata('status', 'danger');
			//redirect('profile/akun_saya');
			$response = "<div class='alert alert-danger'>
									<button class='close' data-close='alert'></button>
									<center><span>Kata Sandi Tidak Sesuai & Gagal di Perbaharui.</span></center>
						</div>";
			echo $response;
		}
	}
	//End Ubah Password

	public function Data_Profil()
	{
		$this-> cekLog();
		//$user_id	= $this->session->userdata('loc_user_id');
		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$data['user_id'] = $user_id;
		//echo $user_id;
		$data['profile_user'] = $this->Mprofile->getDataUserProfile('a.*', $user_id);
		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		if (isset($data['profile_user']->id_provinsi)) {
			$provinsi = $data['profile_user']->id_provinsi;
			$data['daftar_kabkota']		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $provinsi);
		}
		if (isset($data['profile_user']->id_kabkota)) {
			$kabkot = $data['profile_user']->id_kabkota;
			$data['daftar_kecamatan']	= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $kabkot);
		}
		$data['judul']		=	'';
		$data['content']	= $this->load->view('dapot', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('Dbai', $data);
	}
	
	public function Profil_info()
	{
		$this->cekLog();
		//$user_id	= $this->session->userdata('loc_user_id');
		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$data = $this->Mprofile->getDataUserProfil('a.*', $user_id)->result_array();
		echo json_encode($data);
	}

	public function saveBiodatanya()
	{
		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$id				= $this->input->post('id');
		$nama_lengkap	= $this->input->post('nama_lengkap');
		$glr_depan	= $this->input->post('glr_depan');
		$glr_belakang	= $this->input->post('glr_belakang');
		$alamat			= $this->input->post('alamat');
		$nama_provinsi	= $this->input->post('nama_provinsi');
		$nama_kabkota	= $this->input->post('nama_kabkota');
		$nama_kecamatan	= $this->input->post('nama_kecamatan');
		$nama_kelurahan	= $this->input->post('nama_kelurahan');
		$no_ktp			= $this->input->post('no_ktp');
		$no_hp			= $this->input->post('no_hp');
		$nip			= $this->input->post('nip');
		$jabatan		= $this->input->post('jabatan');
		$email			= $this->input->post('email');
		$data	= array(
			'user_id' => $user_id,
			'nama_lengkap' => $nama_lengkap,
			'glr_depan' => $glr_depan,
			'glr_belakang' => $glr_belakang,
			'alamat' => $alamat,
			'id_provinsi' => $nama_provinsi,
			'id_kabkota' => $nama_kabkota,
			'id_kecamatan' => $nama_kecamatan,
			//'ID_kelurahan' => $nama_kelurahan,
			'no_ktp' => $no_ktp,
			'no_hp' => $no_hp,
			'nip' => $nip,
			'jabatan_dinas' => $jabatan,
			'email'=>$email
			//'post_date'=>date('Y-m-d H:i:s'),
			// 'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
		);

		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_user_data', $data, 'id', $id);
			//$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			//$this->session->set_flashdata('status', 'success');
			//redirect('profile/cekKelengkapanData');
			$response = "<div class='alert alert-success'>
									<center><span><b>Data Profil Berhasil di Perbaharui.</b></span></center>
						</div>";
			echo $response;
		} else {
			$query		= $this->Mglobals->setData('tm_user_data', $data, 'id', $id);

			if ($query) {
				redirect('profile/cekKelengkapanData');
			} else {
				//$this->session->set_flashdata('message', 'Biodata User Gagal di Simpan.');
				//$this->session->set_flashdata('status', 'danger');
				//redirect('profile/akun_saya');
				$response = "<div class='alert alert-danger'>
									<center><span><b>Data Profil Gagal di Perbaharui.</b></span></center>
							</div>";
				echo $response;
			}
		}
	}


}
