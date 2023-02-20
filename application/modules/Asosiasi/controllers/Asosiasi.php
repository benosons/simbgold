<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Asosiasi extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->model('mglobal');
		$this->load->model('masosiasi');
		$this->load->library('simbg_lib');
		$this->load->helper(array('form', 'url'));
		$this->simbg_lib->check_session_login();
	}

	function killSession()
	{
		$this->session->unset_userdata('pencarian');
	}

	public function index()
	{
		//$this->killSession();
		$this->DataAsosiasi();
	}
	// Begin Data Asosiasi
	public function DataAsosiasi()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$asosiasi				= $this->session->userdata('loc_asoasiasi');
		$data['profile_dinas'] 	= $this->masosiasi->getDataAsosiasi('a.*', $asosiasi);
		
		$data['content']		= $this->load->view('ProfileAsosiasi', $data, TRUE);
		$data['title']			=	'Profile Asosiasi';
		$data['heading']		=	'';
		$this->load->view('template_profil', $data);
	}

	public function saveDataAkpro()
	{

	}
	// End Data Asosiasi

	// Begin Data Akun Asosiasi
	public function Akun()
	{

		$kabkot = $this->session->userdata('loc_id_kabkot');
		$role_id = $this->session->userdata('loc_role_id');
		$data['result'] 	= $this->masosiasi->getDataAkun($kabkot);
		$data['htable'] = 'Asoasiasi Profesi';
		$data['Chtable'] = 'Asosiasi Wilayah';

		$data['Provinsi']	= $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['content']		= $this->load->view('DataAkun', $data, TRUE);
		$data['title']			=	'Sub Akun';
		$data['heading']		=	'';
		$this->load->view('template_profil', $data);
	}

	public function create_sub_akun()
	{
		$email			= $this->input->post('email');
		$nama 			= $this->input->post('nama');
		$jabatan 		= $this->input->post('jabatan');
		$nama_provinsi	= $this->input->post('nama_provinsi');
		$role_id		= $this->session->userdata('loc_role_id');
		$penginput		= $this->session->userdata('loc_username');
		$asosiasi		= $this->session->userdata('loc_asoasiasi');
		switch ($role_id) {
			case 14:
				$child = 16;
				$data['htable'] = 'Asoasisi Wilayah';
				$max = 100;
				break;
			default:
				$child = 0;
				$data['htable'] = 'N/A';
				$max = 10;
				break;
		}
		$cekmax = $this->masosiasi->get('tm_user', array('role_id' => $child, 'id_kabkot' => $kabkot))->result_array();
		$aktivation = $nama . '-' . $kabkot;
		$cek = $this->masosiasi->get('tm_user', array('username' => $email))->result_array();
		if (count($cek) == 0 && count($cekmax) < $max) {
			$data1 = array(
				'id_kabkot' => $nama_provinsi,
				'role_id' => $child,
				'email' => $email,
				'activation' => sha1($aktivation . $this->config->item('encryption_key')),
				'asosiasi' => $asosiasi,
				'post_date'=>date('Y-m-d H:i:s'),
				'post_by'=>$penginput
			);
			$id_pengguna = $this->masosiasi->createSubAkun('tm_user', $data1);
			$kd_aktivasi = sha1($aktivation . $this->config->item('encryption_key'));
			$data = array(
				'email' => $email,
				'nama_lengkap' => $nama,
				'jabatan_dinas' => $jabatan,
				'user_id' => $id_pengguna, 
				'post_date'=>date('Y-m-d'),
				'post_by'=>$penginput
			);
			$query = $this->masosiasi->createSubAkun('tm_user_data', $data);
			if ($query) {
				//Begin SendEmail
				$subject 	= "Verifikasi User Pengajuan Akses Admin SIMBG | CS SIMBG";
				$link		=  base_url() . "front/daftar_akun_Aso/$kd_aktivasi";
				$text 		= "";
				$text .= "Yth Bapak/Ibu,<br>";
				$text .= "<br>";
				$text .= "Kami menerima permintaan pembuatan akun untuk mengakses layanan SIMBG Online dengan wewenang sebagai $jabatan. <br>";
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
				redirect('Asosiasi/Akun');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('front/pendaftaran');
			}
		} elseif (count($cekmax) >= 5) {
			$this->session->set_flashdata('message', 'Tidak bisa menambah akun (max 5 akun),<br>Silahkan hubungi admin kami untuk info lebih lanjut.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Asosiasi/Akun');
		} else {
			$this->session->set_flashdata('message', 'akun dengan email $email sudah terdaftarkan di System kami.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Asosiasi/Akun');
		}
	}

	// End Data Akun Asosiasi
}
