<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class InputTPA extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		//$this->load->model('Profile/Mprofile');
		$this->load->model('MtenagaAhli');
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->load->library('simbg_lib');
		$this->simbg_lib->check_session_login();
	}

	public function index()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$id_kabkot				= $this->session->userdata('loc_id_kabkot');
		$user_id				= $this->Outh_model->Encryptor('decrypt', $user_id);
		$data				= array();
		$data['tpa'] = $this->Mglobals->getData('*', 'tm_tpa', array('id_create' => $user_id));
		$data['content'] = $this->load->view('InputTPA/Index', $data, TRUE);
		$data['title']		=	'List Data TPA';
		$data['heading']	=	'';
		$this->load->view('Dbai', $data);
	}

	public function ProsesTambah()
	{
		$lembaga			= $this->input->post('lembaga');
		$id_kabkot		= $this->session->userdata('loc_id_kabkot');
		$user_id	= $this->session->userdata('loc_user_id');
		$user_id	= $this->Outh_model->Encryptor('decrypt', $user_id);
		$datadiri	= array(
			'id_lembaga' => $lembaga,
			'id_kabkot' => $id_kabkot,
			'id_create' => $user_id
		);

		$no_ktp		= $this->input->post('no_ktp');
		$cek_ktp = $this->Mglobals->getData('', 'tm_tpa', array('no_ktp' => $no_ktp));
		if ($cek_ktp->num_rows() > 0) {
			$query = $cek_ktp->row()->id;
			$this->session->set_flashdata('message', 'No ktp sudah terdaftar');
			$this->session->set_flashdata('status', 'success');
			redirect('InputTPA/form/' . $query . '/1');
		} else {
			$query		= $this->Mglobals->setData('tm_tpa', $datadiri);
			$this->session->set_flashdata('message', 'Lengkapi Data Diri.');
			$this->session->set_flashdata('status', 'success');
			redirect('InputTPA/form/' . $query);
		}
	}

	public function form($id = '', $stat = '')
	{
		$user_id	= $this->session->userdata('loc_user_id');
		$user_id	= $this->Outh_model->Encryptor('decrypt', $user_id);

		$data['Dataaka']		= $this->MtenagaAhli->getdatadiri('a.*', $id);
		$prov = $data['Dataaka']->id_provinsi;
		$kota = $data['Dataaka']->id_kabkot;
		$data['profile_user'] = $this->MtenagaAhli->getDataUserProfile('a.*', $user_id);
		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		if (isset($data['profile_user']->id_provinsi)) {
			$provinsi = !empty($prov) ? $prov : $data['profile_user']->id_provinsi;
			$data['daftar_kabkota']		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $provinsi);
		}
		if (isset($data['profile_user']->id_kabkota)) {
			$kabkot = !empty($kota) ? $kota : $data['profile_user']->id_kabkota;
			$data['daftar_kecamatan']	= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $kabkot);
		}
		$data['title']				=	'TPA';
		$data['heading']			=	'TPA';
		$data['stat']			=	$stat;
		$id_lembaga = $data['Dataaka']->id_lembaga;
		$queJenisP = $this->Mglobals->getData('*', 'tm_jenis_permohonan')->result();
		$list_Jabatan[''] = '--Pilih--';
		foreach ($queJenisP as $row) {
			$list_JnsPer[$row->id_jns_permohonan] = $row->nm_jns_permohonan;
		}
		$data['list_Jabatan'] = $list_Jabatan;
		// var_dump($id_lembaga);
		// die;
		if ($id_lembaga == '1') {
			$data['content']			= $this->load->view('Datadiriaka', $data, TRUE); // Akademisi
		} else if ($id_lembaga == '2') {
			$data['content']			= $this->load->view('Datadiripakar', $data, TRUE); // Pakar
		} else if ($id_lembaga == '3') {
			$data['content']			= $this->load->view('Datadiriprofesi', $data, TRUE); //Profesi
		} else {
			$data['content']			= $this->load->view('Datadiriaka', $data, TRUE);
		}
		$this->load->view('template_profil', $data);
	}
	public function simpandatadiri()
	{
		$id_kabkot_tpa		= $this->session->userdata('loc_id_kabkot');
		$id			= $this->input->post('id');
		$this->form_validation->set_rules('no_ktp', 'Nomor KTP', 'required|max_length[16]|min_length[16]|callback_valid_ktp');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_valid_email');
		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('status', 'danger');
			$this->session->set_flashdata('message', validation_errors());
			$this->session->set_flashdata('status', 'warning');
			$this->form($id);
		} else {
			$id_user			= $this->input->post('id_user');
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
			$filean = $this->input->post('dir_dokumen');
			$filean2 = $this->input->post('dir_keahlian');
			$filean3 = $this->input->post('dir_sub');
			$thisdir = getcwd();
			$thisdir = getcwd();
			$dirPath = $thisdir . "/dekill/Tpa/";
			$config = [
				'upload_path' => "$dirPath",
				'allowed_types' => 'png|jpg|pdf|jpeg|PDF',
				'max_size' => '50240',
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
					redirect('InputTPA/Form');
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
					redirect('InputTPA/Form');
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
					redirect('InputTPA/Form');
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
				'id_kabkot_tpa' => $id_kabkot_tpa,
			);
			if ($this->input->post('stat') == 1) {
				$user_id				= $this->session->userdata('loc_user_id');
				$user_id				= $this->Outh_model->Encryptor('decrypt', $user_id);
				$datadiri['status'] = 5;
				$datadiri['id_create'] = $user_id;
			}
			$user	= array(
				'id_kabkot' => $nama_kabkota,
				'username' => $email,
				'role_id' => 17,
				'status' => 1,
				'password' => sha1('simbg123' . $this->config->item('encryption_key')),
				'email' => $email
			);
			if ($id != "") {
				$query		= $this->Mglobals->setData('tm_tpa', $datadiri, 'id', $id);
				if ($id_user == "") {
					$user_id		= $this->Mglobals->setData('tm_user', $user);
					$datauser	= array(
						'user_id' => $user_id,
						'nama_lengkap' => $nm_tpa,
						'glr_depan' => $glr_depan,
						'glr_belakang' => $glr_blkg,
						'nip' => $nip,
						'jabatan_dinas' => $jabatan,
						'no_ktp' => $no_ktp,
						'id_provinsi' => $nama_provinsi,
						'id_kabkota' => $nama_kabkota,
						'id_kecamatan' => $nama_kecamatan,
						'alamat' => $alamat,
						'email' => $email,
						'no_hp' => $no_kontak,
					);
					$this->Mglobals->setData('tm_user_data', $datauser);
					$this->Mglobals->setData('tm_tpa', array('id_user' => $user_id), 'id', $id);
				}
				$this->session->set_flashdata('message', 'Data TPA  Berhasil di Disimpan/Ditambahkan');
				$this->session->set_flashdata('status', 'success');
				redirect('InputTPA/TenagaAhli/' . $id);
			} else {
				$query		= $this->Mglobals->setData('tm_tpa', $datadiri, 'id', $id);
				$email = "$email";
				$subject 	= "Status Pendaftaran Akun TPA oleh Dinas Teknis";
				$text 		= "";
				$text .= "Yth Bapak/Ibu,<br>";
				$text .= "<br>";
				$text .= "Dengan ini kami memberitahukan bahwa $nm_tpa<br>";
				$text .= "Telah di Daftarkan sebagai Tenaga Ahli Profesional<br>";
				$text .= "Akun Untuk Mengakses SIMBG <br>";
				$text .= "Akun : $email<br>";
				$text .= "Passwprd : simbg123 <br>";
				$text .= "<br>";
				$text .= "<br>";
				$text .= "Hormat Kami <br>";
				$text .= "Admin SIMBG ";
				$this->simbg_lib->sendEmail($email, $subject, $text);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Berhasil di Diperbaharui.');
					$this->session->set_flashdata('status', 'success');
					redirect('InputTPA/TenagaAhli/' . $id);
				} else {
					$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('InputTPA/Form');
				}
			}
		}
	}

	function valid_ktp()
	{
		$id			= $this->input->post('id');
		$old_ktp = $this->Mglobals->getData('no_ktp', 'tm_tpa', array('id' => $id))->row()->no_ktp;
		$new_ktp        = $this->input->post('no_ktp');
		if ($old_ktp === $new_ktp) {
			return TRUE;
		} else {
			if ($this->MtenagaAhli->valid_ktp($new_ktp) == TRUE) {
				$this->form_validation->set_message('valid_ktp', "KTP $new_ktp sudah terdaftar");
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	function valid_ktp2()
	{
		$id			= $this->input->post('id');
		$old_ktp = $this->Mglobals->getData('no_ktp', 'tm_tpa', array('id' => $id))->row()->no_ktp;
		$new_ktp        = $this->input->post('no_ktp');
		if ($old_ktp === $new_ktp) {
			$data = "true";
		} else {
			if ($this->MtenagaAhli->valid_ktp($new_ktp) == TRUE) {
				$this->form_validation->set_message('valid_ktp', "KTP $new_ktp sudah terdaftar");
				$data =  "false";
			} else {
				$data = "true";
			}
		}
		$crsf = $this->security->get_csrf_hash();
		$output['data']  = $data;
		$output['csrf']  = $crsf;

		echo json_encode($output);
	}

	public function valid_email()
	{
		$id					= $this->input->post('id');
		$address			= $this->input->post('email');
		$old_email = $this->Mglobals->getData('email', 'tm_tpa', array('id' => $id))->row()->email;
		if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address)) {
			$this->form_validation->set_message('valid_email', "email tidak valid");
			return FALSE;
		} else {
			if ($address === $old_email) {
				return TRUE;
			} else {
				if ($this->MtenagaAhli->valid_email($address) == TRUE) {
					$this->form_validation->set_message('valid_email', "Email $address sudah terdaftar");
					return FALSE;
				} else {
					return TRUE;
				}
			}
		}
	}

	public function Savedatadiri()
	{
		$id_kabkot_tpa		= $this->session->userdata('loc_id_kabkot');
		$id			= $this->input->post('id');
		$this->form_validation->set_rules('no_ktp', 'Nomor KTP', 'required|max_length[16]|min_length[16]|callback_valid_ktp');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_valid_email');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('status', 'danger');
			$this->session->set_flashdata('message', validation_errors());
			$this->session->set_flashdata('status', 'warning');
			$this->form($id);
		} else {
			$id_user			= $this->input->post('id_user');
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
			$filean = $this->input->post('dir_dokumen');
			$thisdir = getcwd();
			$dirPath = $thisdir . "/dekill/Tpa/";
			$config = [
				'upload_path' => "$dirPath",
				'allowed_types' => 'png|jpg|pdf|jpeg|PDF',
				'max_size' => '50240',
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
					redirect('InputTPA/Datadiri');
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
				'status'	=> 5,
				'id_kabkot_tpa' => $id_kabkot_tpa,
			);
			if ($this->input->post('stat') == 1) {
				$user_id				= $this->session->userdata('loc_user_id');
				$user_id				= $this->Outh_model->Encryptor('decrypt', $user_id);
				$datadiri['status'] = 5;
				$datadiri['id_create'] = $user_id;
			}
			$user	= array(
				'id_kabkot' => $nama_kabkota,
				'username' => $email,
				'role_id' => 17,
				'status' => 5,
				'password' => sha1('simbg123' . $this->config->item('encryption_key')),
				'email' => $email
			);
			if ($id != "") {
				$query		= $this->Mglobals->setData('tm_tpa', $datadiri, 'id', $id);
				if ($id_user == "") {
					$user_id		= $this->Mglobals->setData('tm_user', $user);
					$datauser	= array(
						'user_id' => $user_id,
						'nama_lengkap' => $nm_tpa,
						'glr_depan' => $glr_depan,
						'glr_belakang' => $glr_blkg,
						'nip' => $nip,
						'jabatan_dinas' => $jabatan,
						'no_ktp' => $no_ktp,
						'id_provinsi' => $nama_provinsi,
						'id_kabkota' => $nama_kabkota,
						'id_kecamatan' => $nama_kecamatan,
						'alamat' => $alamat,
						'email' => $email,
						'no_hp' => $no_kontak,
						// 'jns_kelamin' => $jns_kelamin,
					);
					$this->Mglobals->setData('tm_user_data', $datauser);
					$this->Mglobals->setData('tm_tpa', array('id_user' => $user_id), 'id', $id);
					$email = "$email";
					$subject 	= "Status Pendaftaran Akun TPA oleh Dinas Teknis";
					$text 		= "";
					$text .= "Yth Bapak/Ibu,<br>";
					$text .= "<br>";
					$text .= "Dengan ini kami memberitahukan bahwa $nm_tpa<br>";
					$text .= "Telah di Daftarkan sebagai Tenaga Ahli Profesional<br>";
					$text .= "Akun Untuk Mengakses SIMBG <br>";
					$text .= "Akun : $email<br>";
					$text .= "Passwprd : simbg123 <br>";
					$text .= "<br>";
					$text .= "<br>";
					$text .= "Hormat Kami <br>";
					$text .= "Admin SIMBG ";
					$this->simbg_lib->sendEmail($email, $subject, $text);
				}
				$this->session->set_flashdata('message', 'Data User Berhasil Disimpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('InputTPA/TenagaAhli/' . $id);
			} else {
				$query		= $this->Mglobals->setData('tm_tpa', $datadiri, 'id', $id);
				$email = "$email";
				$subject 	= "Status Pendaftaran Akun TPA oleh Dinas Teknis";
				$text 		= "";
				$text .= "Yth Bapak/Ibu,<br>";
				$text .= "<br>";
				$text .= "Dengan ini kami memberitahukan bahwa $nm_tpa<br>";
				$text .= "Telah di Verifikasi oleh Pemda sebagai Tenaga Ahli Profesional<br>";
				$text .= "Akun Untuk Mengakses SIMBG <br>";
				$text .= "Silahkan Memakai Akun yang Telah Anda Daftarkan<br>";
				$text .= "<br>";
				$text .= "<br>";
				$text .= "Hormat Kami <br>";
				$text .= "Admin SIMBG ";
				$this->simbg_lib->sendEmail($email, $subject, $text);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Berhasil di Perbaharui.');
					$this->session->set_flashdata('status', 'success');
					redirect('InputTPA/TenagaAhli/' . $id);
				} else {
					$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('InputTPA/Form');
				}
			}
			$this->form();
		}
	}
	public function TenagaAhli() // Halaman 2
	{
		$id	= $this->uri->segment(3);
		$user_id	= $this->session->userdata('loc_user_id');
		$user_id	= $this->Outh_model->Encryptor('decrypt', $user_id);
		$data['user_id'] = $user_id;
		$data['id']	= $id;
		$data['tpa'] = $this->MtenagaAhli->listDataPesonilTpa('a.*,b.id_dok,b.id_asak,b.dir_file,b.keahlian', $id);
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
		if ($id_lembaga == '1') {
			$data['content']			= $this->load->view('Dokelaka', $data, TRUE); //Akademisi
		} else if ($id_lembaga == '2') {
			$data['content']			= $this->load->view('Dokelpakar', $data, TRUE); //Pakar
		} else if ($id_lembaga == '3') {
			$data['content']			= $this->load->view('Dokelprofesi', $data, TRUE); //Profesi
		}
		$data['title']				=	'Tambah Personil';
		$data['heading']			=	'Tambah Personil';
		$this->load->view('template_profil', $data);
	}

	//Begin Profile Dinas
	public function saveDokumen()
	{
		$id_dok			= $this->input->post('id_dok');
		$id				= $this->input->post('id');
		$id_asak		= $this->input->post('id_asak');
		$keahlian		= $this->input->post('keahlian');
		$filean = $this->input->post('dir_dokumen');
		$thisdir = getcwd();
		$dirPath = $thisdir . "/dekill/Tpa/";
		$config = [
			'upload_path' => "$dirPath",
			'allowed_types' => 'png|jpg|pdf|jpeg|PDF',
			'max_size' => '50240',
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
				redirect('InputTPA/TenagaAhli/' . $id);
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
				redirect('InputTPA/TenagaAhli/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('InputTPA/TenagaAhli/' . $id);
			}
		} else {
			$query		= $this->mglobals->setData('tm_tpadokumen', $datapersonal, 'id_dok', $id_dok);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('InputTPA/TenagaAhli/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('InputTPA/TenagaAhli/' . $id);
			}
		}
	}

	public function Dataprofesi($id = '') //Halaman 4
	{
		$user_id	= $this->session->userdata('loc_user_id');
		$user_id	= $this->Outh_model->Encryptor('decrypt', $user_id);

		$permohonan = $this->MtenagaAhli->listDataPesonilTpa('a.*,c.nm_asosiasi', $id)->row_array();
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
		// var_dump($id_lembaga);
		// die;
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
			redirect('InputTPA/TenagaAhli/' . $id);
		} else {
			$query		= $this->Mglobals->setData('tm_tpapengalaman', $data, 'id_pengalaman', $id_pengalaman);
			if ($query) {
				$this->session->set_flashdata('message', 'Biodata User Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('InputTPA/TenagaAhli/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Biodata User Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('InputTPA/TenagaAhli/' . $id);
			}
		}
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

		$dataIn = array(
			'status' => '5',
		);

		if ($id_aso != "") {
			$query		= $this->Mglobals->setData('tm_tpaints', $datadiri, 'id_aso', $id_aso);
			$this->MtenagaAhli->updateStatus($dataIn, $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Perbaharui.');
			$this->session->set_flashdata('status', 'success');
			redirect('Dashboard');
		} else {
			$query		= $this->Mglobals->setData('tm_tpaints', $datadiri, 'id_aso', $id_aso);
			$this->MtenagaAhli->updateStatus($dataIn, $id);
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

		$dataIn = array(
			'status' => '5',
		);

		if ($id_aso != "") {
			$query		= $this->Mglobals->setData('tm_tpaints', $datadiri, 'id_aso', $id_aso);
			$this->MtenagaAhli->updateStatus($dataIn, $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Perbaharui.');
			$this->session->set_flashdata('status', 'success');
			redirect('InputTPA');
		} else {
			$query		= $this->Mglobals->setData('tm_tpaints', $datadiri, 'id_aso', $id_aso);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('InputTPA');
			} else {
				$this->session->set_flashdata('message', 'Data Diri Tenaga Ahli Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('InputTPA/Dataprofesi/' . $id);
			}
		}
	}

	public function removeDataTPA($id)
	{
		$table = array('tm_tpa', 'tm_tpadokumen', 'tm_tpapengalaman', 'tm_tpaints');
		$process = $this->Mglobals->multiDeleteData($table, 'id', $id);
		// var_dump($process);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('InputTPA');
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
}
