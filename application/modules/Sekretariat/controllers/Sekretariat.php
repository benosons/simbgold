<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Sekretariat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->load->model([
			'Msekretariat' => 'Msekretariat',
			'Global_model' => 'gm',
		]);
		$this->load->library('Simbg_lib');
		//$this->load->library('encrypt'); 
		$this->simbg_lib->check_session_login();
	}

	public function index()
	{
		redirect('dashboard');
	}
	
	public function Profil_sekretariat()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$role_id 				= $this->session->userdata('loc_role_id');
		$data['role']	 		= $this->session->userdata('loc_role_id');
		$data['profile_dinas'] 	= $this->Msekretariat->getDataSekretariat('a.*');
		$data['result'] 		= $this->Msekretariat->getDataAkun();
		$data['content']		= $this->load->view('Sekreatriat', $data, TRUE);
		$data['title']			=	'Sekretariat';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
		
	}
	
	public function saveDataSekte()
	{
		//$id_kabkot			= $this->session->userdata('loc_id_kabkot');
		$id					= $this->input->post('id');
		$p_nama_dinas		= $this->input->post('p_nama_dinas');
		$p_about			= $this->input->post('p_about');
		$p_alamat			= $this->input->post('p_alamat');
		$p_tlp				= $this->input->post('p_tlp');
		$p_email			= $this->input->post('p_email');
		$kepala_dinas		= $this->input->post('kepala_dinas');
		$nip_kepala_dinas	= $this->input->post('nip_kepala_dinas');	
		$data	= array(
			//'id_kabkot' => $id_kabkot,
			'id_dinas' => 8,
			//'p_about' => $p_about,
			'p_alamat' => $p_alamat,
			'p_tlp' => $p_tlp,
			'p_email' => $p_email,
			'p_nama_dinas' => $p_nama_dinas,
			'kepala_dinas' => $kepala_dinas,
			'nip_kepala_dinas' => $nip_kepala_dinas,
		);

		if ($id == 1) {
			$query		= $this->Mglobals->setData('tm_profile_dinas', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Profil Berhasil di Perbaharui.');
			$this->session->set_flashdata('status', 'success');
			redirect('Sekretariat/Profil_Sekretariat');
		} else {
			$this->session->set_flashdata('message', 'Profil Gagal di Simpan.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Sekretariat/Profil_Sekretariat');
		}
	}
	
	public function ASN_Sekretariat()
	{
		
		$data = array(
			'asn' => $this->Msekretariat->listDataPesonilAsn('*'),
			'daftar_provinsi' => $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi'),
		);
		$data['content']		= $this->load->view('ASN_Sekreatriat', $data, TRUE);
		$data['title']			= 'Lis Personal ASN';
		$data['heading']		= '';
		$this->load->view('Dbai', $data);
	}
	
	public function saveDataASNsekte()
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
			'stat' => 3,
			'nip' => $nip,
			'no_ktp' => $no_ktp,
			'alamat' => $alamat,
			'no_hp' => $no_hp,
			'email' => $email,
			'id_kabkot' => $id_kabkot,
			'id_provinsi' => $id_provinsi,
			'id_kecamatan' => $id_kecamatan,
			'id_kota_tabg' => 8,
		);

		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_personal', $datapersonal, 'id_personal', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Sekretariat/editDataASNsekte/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Sekretariat/editDataASNsekte/' . $id);
			}
		} else {
			$query		= $this->Mglobals->setData('tm_personal', $datapersonal, 'id_personal', $id);
			$this->Mglobals->setData('tm_riwpendidikan', array('id_personal' => $query));
			$this->Mglobals->setData('tm_sertifikasi', array('id_personal' => $query));
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan. Harap melengkapi informasi detail personil pada masing-masing tab');
				$this->session->set_flashdata('status', 'success');
				redirect('Sekretariat/editDataASNsekte/' . $query);
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Sekretariat/ASN_Sekretariat');
			}
		}
	}
	
	public function editDataASNsekte($id)
	{
		$id	= $this->uri->segment(3);
		$data['id']	= $id;
		if ($id != '') {
			$data['asn'] = $this->Msekretariat->listDataPesonilAsn('a.*,b.*,c.*, b.dir_file as dir_file_ijazah, c.dir_file as dir_file_sertifikat', $id);
			$data['daftar_jurusan']		= $this->Msekretariat->listDataJurusan('id_jurusan,nama_jurusan');
			$data['keahlian'] = $this->Msekretariat->listDataBidang('a.id_bidang,a.nama_bidang');
			$data['jenjang'] = $this->mglobals->listdata('tr_jenjang');
			$provinsi = $data['asn']->row()->id_provinsi;
			$kabkot = $data['asn']->row()->id_kabkot;
			$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
			$data['daftar_kabkota']		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $provinsi);
			$data['daftar_kecamatan']	= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $kabkot);
		} else {
			redirect('Sekretariat/ASN_Sekretariat');
		}
		$data['content']		= 	$this->load->view('personal_asn/personal_form', $data, TRUE);
		$data['title']			=	'Lengkapi Data Personil';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}
	
	public function saveDataPendidikan()
	{
		$id	= $this->input->post('id');
		$idgagal	= $this->input->post('idgagal');
		//$id_riwpend = $this->input->post('id_riwpend');
		$id_jenjang = $this->input->post('id_jenjang');
		$jurusan	= $this->input->post('jurusan');
		//$dir_file = $this->input->post('filename_ijazah');
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
			//'dir_file' => $dir_file,
		);

		/* if ($_FILES) {
			$thisdir = getcwd();
			$dirPath = $thisdir . "/file/personil/" . $id . '/ijazah/';
			if (!file_exists($dirPath)) {
				//mkdir($dirPath, 0755, true);
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
		} */

		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_riwpendidikan', $datapendidikan, 'id_personal', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Sekretariat/editDataASNsekte/' . $id . '#tab_3');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Sekretariat/editDataASNsekte/' . $idgagal. '#tab_3');
			}
		} else {
			$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Sekretariat/editDataASNsekte/' . $idgagal. '#tab_3');
		}
	}

	public function saveDataKeahlian()
	{
		$id	= $this->input->post('id');
		$idgagal	= $this->input->post('idgagal');
		$id_unsur = $this->input->post('id_unsur');
		$id_unsur_keahlian = $this->input->post('id_unsur_keahlian');
		//$dir_file = $this->input->post('filename_ijazah');

		$list_keahlian = $this->input->post('list_keahlian');
		$tgl_penetapan = $this->input->post('tgl_penetapan');
		$nama_bidang = $this->input->post('nama_bidang');

		$datakeahlian	= array(
			'id_unsur' => $id_unsur,
			'id_unsur_keahlian' => $id_unsur_keahlian,
			'list_keahlian' => $list_keahlian,
			'nama_bidang' => $nama_bidang,
			'tgl_penetapan' => date('Y-m-d', strtotime($tgl_penetapan)),
			//'dir_file' => $dir_file,
		);

		/* if ($_FILES) {
			$thisdir = getcwd();
			$dirPath = $thisdir . "/file/personil/" . $id . '/Sertifikat/';
			if (!file_exists($dirPath)) {
				//mkdir($dirPath, 0755, true);
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
		} */

		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_sertifikasi', $datakeahlian, 'id_personal', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Sekretariat/editDataASNsekte/' . $id. '#tab_4');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Sekretariat/editDataASNsekte/' . $idgagal. '#tab_4');
			}
		} else {
			$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Sekretariat/editDataASNsekte/' . $idgagal. '#tab_4');
		}
	}
	
	public function removeDataASNsekte($id)
	{
		$table = array('tm_personal', 'tm_sertifikasi', 'tm_riwpendidikan');
		$process = $this->Mglobals->multiDeleteData($table, 'id_personal', $id);
		// var_dump($process);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Sekretariat/ASN_Sekretariat');
	}
	
	public function SK_Sekretariat()
	{
		$this->PerSKan();
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
			//array('id_kabkot' => $this->session->userdata('loc_id_kabkot')),
			array('id_kabkot' => '0' ),
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
			'allowed_types' => '*',
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
					'id_kabkot' => 0,
				);
				$query = $this->mglobals->setData('tm_sk_pengaturan', $data, 'id_sk', $id);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Berhasil Diubah');
					$this->session->set_flashdata('status', 'success');
					redirect('Sekretariat/PerSKan');
				} else {
					$this->session->set_flashdata('message', 'Data Gagal Diubah');
					$this->session->set_flashdata('status', 'danger');
					redirect('Sekretariat/PerSKan');
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
					redirect('Sekretariat/PerSKan');
				} else {
					$data	= array(
						'no_sk' => $no_skp,
						'tipe_sk' => $tipe_sk,
						'tgl_sk' => date('Y-m-d', strtotime($tgl_skp)),
						'expired_sk' => $expired_skp,
						//'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'id_kabkot' => 0,
						'file_sk' => $this->upload->data('file_name'),
					);
					$cekFile = $this->gm->getId('id_sk', $id, 'tm_sk_pengaturan')->row()->file_sk;
					$path = FCPATH . '/public/uploads/pupr/sk/psk/';
					$fileLama = $path . $cekFile;
					if (!unlink($fileLama)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
						redirect('Sekretariat/PerSKan');
					}
					$query = $this->mglobals->setData('tm_sk_pengaturan', $data, 'id_sk', $id);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Diubah');
						$this->session->set_flashdata('status', 'success');
						redirect('Sekretariat/PerSKan');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Diubah');
						$this->session->set_flashdata('status', 'danger');
						redirect('Sekretariat/PerSKan');
					}
				}
			}
		} else {
			if (!$this->upload->do_upload('berkas')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				$this->session->set_flashdata('status', 'danger');
				redirect('Sekretariat/PerSKan');
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
					redirect('Sekretariat/PerSKan');
				} else {
					$data	= array(
						'id_sk' => $id,
						'no_sk' => $no_skp,
						'tipe_sk' => $tipe_sk,
						'tgl_sk' => date('Y-m-d', strtotime($tgl_skp)),
						'expired_sk' => $expired_skp,
						//'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'id_kabkot' => 0,
						'file_sk' => $this->upload->data('file_name'),
					);
					$query = $this->mglobals->setData('tm_sk_pengaturan', $data);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Disimpan');
						$this->session->set_flashdata('status', 'success');
						redirect('Sekretariat/PerSKan');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Disimpan');
						$this->session->set_flashdata('status', 'danger');
						redirect('Sekretariat/PerSKan');
					}
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
				$process2 = $this->Msekretariat->removeDataPSK($id);
			}else{
				$process2 = $this->Msekretariat->removeDataTPA($id);
			}
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Sekretariat/PerSKan');
	}

	public function personil_tpa($id)
	{
		$data = array(
			'disable' => '',
			'query_syarat_adm' => $this->Msekretariat->get_sk_tpa('a.*,b.*',0),
			'query_syarat_selected' => $this->Msekretariat->get_sk_tselected($id),
			'psk' => $this->Msekretariat->getDataEditPSK('a.*', $id),
		);
		$this->load->view('sk_data/personil_tpa', $data);
	}

	public function simpan_personil_tpa($var = null)
	{
		$id_skp		= $this->input->post('id');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');
		if ($dok_persyaratan != "") {
			$process = $this->Msekretariat->removeDataTPA($id_skp);
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
		redirect('Sekretariat/PerSKan');
	}
	
	public function personil_sk($id)
	{
		$this->session->userdata('loc_user_id') == 9999 ? $id_kabkot = '' : $id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data = array(
			'disable' => '',
			'query_syarat_adm' => $this->Msekretariat->get_sk_parent($id_kabkot),
			'query_syarat_selected' => $this->Msekretariat->get_sk_selected($id),
			'psk' => $this->Msekretariat->getDataEditPSK('a.*', $id),
		);
		$this->load->view('sk_data/personil_psk', $data);
	}
	
	public function simpan_personil_sk($var = null)
	{
		$id_skp		= $this->input->post('id');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');
		if ($dok_persyaratan != "") {
			$process = $this->Msekretariat->removeDataPSK($id_skp);
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
		redirect('Sekretariat/PerSKan');
	}
	//akhir PSK

	public function Data_Tpa()
	{

		$data['data_tpa']   	= $this->Msekretariat->tampilin_tpa('a.*,b.*', 0);		
		$data['content']		= $this->load->view('data_tpa/list_tpanya', $data, TRUE);
		$data['title']			= 'List Data TPA';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
		
		
	}
	
	function Tampilin_Tpa(){
		
		$data= $this->Msekretariat->tampilin_tpa('a.*,b.*', 0);//$this->Msekretariat->tpapusat_list();
		echo json_encode($data);
	}

	
	function Pilih_Hapus_Tpa(){
		$id_nya	= $this->input->post('kode');
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
		$getUnsur = $this->Msekretariat->getDataUnsur()->result();
		$daftar_provinsi = $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data = [
			'title'	=>	'Pilih Data TPA',
			'heading'	=>	'',
			'unsur' => $getUnsur,
			'daftar_provinsi' => $daftar_provinsi	
		];
		$this->template->load('template/template_backend', 'data_tpa/pilih_tpanya', $data);
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
	
	
	function Tampil_Pilih_Tpaold()
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data['provinsi_user'] = $this->Msekretariat->getProv('a.*', $id_kabkot);
		if (isset($data['provinsi_user']->id_provinsi)) {
			$provinsi = $data['provinsi_user']->id_provinsi;
		};
		$data=$this->Msekretariat->get_ATP('a.*b.nama_kota', $provinsi, $id_kabkot);//$this->Msekretariat->tpapusat_list();
		echo json_encode($data);
	}

	public function output_json($data, $encode = true)
	{
		if ($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}	

	
	function Tampil_Pilih_Tpa()
	{
		$data = $this->Msekretariat->_getAPIDataTPA(); //$this->Msekretariat->tpapusat_list();
		$this->output_json($data, false);
	}

	function Pilih_Simpan_Tpa(){
		$id_nya		= '';
		$id_tpanya	= $this->input->post('kode');
		$data	= array(
			'id_nya' => $id_nya,
			'id_kabkotnya' => 0,
			'id_tpanya' => $id_tpanya
		);
		$query		= $this->mglobals->setData('zample_tm_tpa_perkabkot', $data, 'id_nya', $id_nya);
	}
	//End Data TPA
}
