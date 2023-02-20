<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Setting extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('msetting');
		$this->load->library('simbg_lib');
		$this->simbg_lib->check_session_login();
	}

	//Begin Setting Hari Libur
	public function set_hari_libur()
	{
		$id_kabkot		= $this->session->userdata('loc_id_kabkot');
		$user_id		= $this->session->userdata('loc_user_id');

		$data['data_periode_libur']	 	= $this->msetting->getDataPeriodeHariLibur('a.*', $id_kabkot);
		$data['data_libur'] 			= $this->msetting->getDataHariLibur('a.id,a.tgl_libur,a.keterangan_tgl_libur,b.periode', $id_kabkot);

		$data['content']	= $this->load->view('setting_hari_libur/hari_libur_form', $data, TRUE);
		$data['title']		=	'Setting Hari Libur';
		$data['heading']	=	'Tambah dan Ubah Data Hari Libur';
		$this->load->view('backend', $data);
	}


	public function saveDataPeriodeHariLibur()
	{
		$id_kabkot		= $this->session->userdata('loc_id_kabkot');
		$id				= $this->input->post('id');
		$periode		= $this->input->post('periode');
		$awal_periode	= $this->input->post('awal_periode');
		$akhir_periode	= $this->input->post('akhir_periode');

		$data	= array(
			'id_kabkot' => $id_kabkot,
			'periode' => $periode,
			'tgl_awal_periode' => date('Y-m-d', strtotime($awal_periode)),
			'tgl_akhir_periode' => date('Y-m-d', strtotime($akhir_periode)),
			//'post_date'=>date('Y-m-d H:i:s'),
			//'post_by'=>$this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
		);


		if ($id != "") {
			$query		= $this->mglobals->setData('tm_data_hari_libur', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('setting/set_hari_libur');
		} else {
			$query		= $this->mglobals->setData('tm_data_hari_libur', $data, 'id', $id);

			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('setting/set_hari_libur');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('setting/set_hari_libur');
			}
		}
	}

	public function edit_periode_libur($id)
	{
		$data['edit_periode_libur'] = $this->msetting->getDataEditPeriodeHariLibur('a.*', $id);
		$this->load->view('setting_hari_libur/form_edit_periode_libur', $data);
	}

	public function saveDataHariLibur()
	{
		$id						= $this->input->post('id');
		$data_hari_libur_id		= $this->input->post('periode');
		$tgl_libur				= $this->input->post('tgl_libur');
		$keterangan_tgl_libur	= $this->input->post('keterangan_tgl_libur');

		$data	= array(
			'data_hari_libur_id' => $data_hari_libur_id,
			'tgl_libur' => date('Y-m-d', strtotime($tgl_libur)),
			'keterangan_tgl_libur' => $keterangan_tgl_libur,
			//'post_date'=>date('Y-m-d H:i:s'),
			//'post_by'=>$this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
		);

		if ($id != "") {
			$query		= $this->mglobals->setData('tm_data_hari_libur_detail', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('setting/set_hari_libur');
		} else {
			$query		= $this->mglobals->setData('tm_data_hari_libur_detail', $data, 'id', $id);

			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('setting/set_hari_libur');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('setting/set_hari_libur');
			}
		}
	}

	public function edit_libur($id)
	{
		$id_kabkot		= $this->session->userdata('loc_id_kabkot');
		$data['data_periode_libur']	 	= $this->msetting->getDataPeriodeHariLibur('a.*', $id_kabkot);
		$data['edit_libur'] = $this->msetting->getDataEditHariLibur('a.*', $id);
		$this->load->view('setting_hari_libur/form_edit_libur', $data);
	}
	//End Setting Hari Libur


	//Begin Role User
	public function role_user($role = '', $id = '')
	{
		$data['role_user'] = $this->msetting->listDataRoleUser('a.*');
		$data['content']	= $this->load->view('role_user/role_user_list', $data, TRUE);
		$data['title']		=	'Role User';
		$data['heading']	=	'Pengaturan Hak Akses';
		$this->load->view('backend', $data);
	}

	public function edit_role_user($id)
	{
		$data['row'] = $this->msetting->getDataEditRoleUser('a.*', $id);
		$this->load->view('role_user/form_edit_role_user', $data);
	}

	public function saveDataRoleUser()
	{
		$id			= $this->input->post('id');
		$name_role	= $this->input->post('nama_role');
		$group		= $this->input->post('group');

		$data	= array(
			'name_role' => $name_role,
			'group' => $group,
			//'post_date'=>date('Y-m-d H:i:s'),
			//'post_by'=>$this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
		);

		if ($id != "") {
			$query		= $this->mglobals->setData('tm_role', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('setting/role_user');
		} else {
			$cek = $this->msetting->cekroleUser('a.id,a.name_role,a.group', $name_role);
			if ($cek->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Gagal Simpan Role Name ' . $name_role . ' Sudah Tersedia..!!!');
				$this->session->set_flashdata('status', 'danger');
				redirect('setting/role_user');
			} else {
				$query		= $this->mglobals->setData('tm_role', $data, 'id', $id);

				if ($query) {
					$this->session->set_flashdata('message', 'Data Role User Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					redirect('setting/role_user');
				} else {
					$this->session->set_flashdata('message', 'Data Role User Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('setting/role_user');
				}
			}
		}
	}

	public function removeDataRoleUser($id)
	{
		$process = $this->msetting->removeDataRoleUser($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data User Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data User Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('setting/role_user');
	}
	//END Role User

	//Begin Daftar Menu
	public function daftar_menu()
	{

		$data['daftar_menu'] = $this->msetting->listDataMenu('a.*');
		$data['content']	= $this->load->view('daftar_menu/menu_list', $data, TRUE);
		$data['title']		=	'Tambah Menu List';
		$data['heading']	=	'Daftar Menu SIMBG';
		$this->load->view('backend', $data);
	}

	public function getMenuUtama()
	{
		$value		= array();
		$query		= $this->msetting->getMenuUtama('id,name_menu');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id' => $row->id, 'name' => $row->name_menu);
			}
		}
		echo json_encode($value);
	}

	public function edit_menu($id)
	{
		$data['menu_utama_list']		= $this->msetting->getMenuUtama('id,name_menu');
		$data['row'] = $this->msetting->getDataMenu('a.*', $id);

		$this->load->view('daftar_menu/form_edit_data_menu', $data);
	}

	public function saveDataMenu()
	{
		$id				= $this->input->post('id');
		$jenis_menu		= $this->input->post('jenis_menu');
		$menu_utama		= $this->input->post('menu_utama');
		$nama_menu		= $this->input->post('nama_menu');
		$url_link		= $this->input->post('url_link');
		$icon_bootstrap	= $this->input->post('icon_bootstrap');
		$status			= $this->input->post('status');

		if ($jenis_menu == '1') {
			$menu_utama = '0';
		}

		$data	= array(
			'parentid' => $menu_utama,
			'name_menu' => $nama_menu,
			'url' => $url_link,
			'icon' => $icon_bootstrap,
			'menu_aktif' => $status,
			//'post_date'=>date('Y-m-d H:i:s'),
			//'post_by'=>$this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
		);

		if ($id != "") {
			$query		= $this->mglobals->setData('tm_menu', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('Setting/daftar_menu');
		} else {
			$cek = $this->msetting->cekNamaMenu('a.id,a.name_menu,a.url', $nama_menu);
			if ($cek->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Gagal Simpan Role Name ' . $name_role . ' Sudah Tersedia..!!!');
				$this->session->set_flashdata('status', 'danger');
				redirect('Setting/daftar_menu');
			} else {
				$query		= $this->mglobals->setData('tm_menu', $data, 'id', $id);

				if ($query) {
					$this->session->set_flashdata('message', 'Data Menu Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					redirect('Setting/daftar_menu');
				} else {
					$this->session->set_flashdata('message', 'Data Menu Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('Setting/daftar_menu');
				}
			}
		}
	}

	public function removeDataMenu($id)
	{
		$process = $this->msetting->removeDataMenu($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Menu Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Menu Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('setting/daftar_menu');
	}

	//END Daftar Menu

	//Begin Pengaturan Menu
	public function pengaturan_menu()
	{
		$data['role_user'] = $this->msetting->listDataRoleUser('a.*');
		$data['content']	= $this->load->view('pengaturan_menu/pengaturan_menu_list', $data, TRUE);
		$data['title']		=	'Hak Akses User';
		$data['heading']	=	'Pengaturan Menu SIMBG';
		$this->load->view('backend', $data);
	}

	public function listMenushow()
	{
		$value		= $this->input->post('value');
		$disable	= $this->input->post('disable') == 'N' ? '' : 'disabled';
		$menu 		= $this->mmenu->ListMenu($value, 'checkbox', $value, 'menu-list', $disable);
		if ($menu != '') {
			echo $menu;
		} else {
			echo "gagal";
		}
	}

	public function getRoleUser()
	{
		$value		= array();
		$query		= $this->msetting->listDataRoleUserForAdd('id,name_role');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id' => $row->id, 'name' => $row->name_role);
			}
		}
		echo json_encode($value);
	}

	public function listMenu()
	{
		$value		= $this->input->post('value');
		$disable	= $this->input->post('disable') == 'N' ? '' : 'disabled';
		$menu 		= $this->mmenu->ListMenu($value, 'checkbox', $value, 'menu-list', $disable);
		echo $menu;
	}

	public function edit_menu_akses($id)
	{
		$data['query_menu_selected'] = $this->msetting->get_menu_selected($id);
		$data['query_menu']			= $this->msetting->get_menu_parent();
		$data['msetting']			= $this->msetting;
		$data['row']				= $this->msetting->getDataEditRoleUser('a.*', $id);
		$this->load->view('pengaturan_menu/form_edit_hak_akses', $data);
	}

	public function saveDataPengaturanMenu()
	{
		$idrole		= $this->input->post('id');
		$menu		= $this->input->post('menu');
		if ($menu != "") {
			$process = $this->msetting->removeDataHakAkses($idrole);
			if (!$process) {
				$this->session->set_flashdata('message', 'Data Hak Akses Gagal Di simpan');
				$this->session->set_flashdata('status', 'error');
			} else {
				for ($i = 0; $i < count($menu); $i++) {
					$menu_id = $menu[$i];
					$data	= array(
						'role_id' => $idrole,
						'menu_id' => $menu_id,
					);
					$processInput = $this->mglobals->setData('tm_role_menu', $data, '', '');
				}
				if (!$process) {
					$this->session->set_flashdata('message', 'Data Hak Akses Gagal di Ubah.');
					$this->session->set_flashdata('status', 'danger');
					redirect('Setting/pengaturan_menu');
				} else {
					$this->session->set_flashdata('message', 'Data Hak Akses Berhasil di Ubah.');
					$this->session->set_flashdata('status', 'success');
					redirect('Setting/pengaturan_menu');
				}
			}
			redirect('Setting/pengaturan_menu');
		}
	}
	//End Pengaturan Menu

	//Begin Pengaturan User
	public function pengaturan_user()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$group		= $this->session->userdata('loc_group');
		if ($group == '1') {
			$group = '';
		}
		$data['user_result'] = $this->msetting->listDataUser('a.id,a.username,a.status,b.name_role,b.group,c.nama_kabkota', $id_kabkot, $group);
		$data['content']	= $this->load->view('pengaturan_user/user_list', $data, TRUE);

		$data['title']		=	'Tambah Data User';
		$data['heading']	=	'Pengaturan User';
		$this->load->view('backend', $data);
	}

	public function getNamaRole()
	{
		$value		= array();
		$query		= $this->msetting->listDataRoleUser('id,name_role');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id' => $row->id, 'name_role' => $row->name_role);
			}
		}
		echo json_encode($value);
	}

	public function getNamaKabKota()
	{
		//$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$value		= array();
		$query		= $this->msetting->listDataKabKota('id_kabkot,nama_kabkota');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kabkot' => $row->id_kabkot, 'nama_kabkota' => $row->nama_kabkota);
			}
		}
		echo json_encode($value);
	}

	public function savePengaturanUser()
	{
		$id				= $this->input->post('id');
		$username		= $this->input->post('username');
		$password		= $this->input->post('password');
		$ulangi_password = $this->input->post('ulangi_password');
		$id_kabkot	= $this->input->post('nama_kabkota');
		$role_id	= $this->input->post('nama_role');
		$status			= $this->input->post('status');
		

		$data	= array(
			'username' => $username,
			'password' => sha1($password . $this->config->item('encryption_key')),
			'id_kabkot' => $id_kabkot,
			'role_id' => $role_id,
			'status' => $status,
			//'post_date'=>date('Y-m-d H:i:s'),
			//'post_by'=>$this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
		);

		if ($id != "") {
			$query		= $this->mglobals->setData('tm_user', $data, 'id', $id);

			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
							redirect('Setting/pengaturan_user');
		} else {
			$cekAdminDaerah = $this->msetting->cekusername('a.id,a.username', '', $id_kabkot, $role_id);
			if ($cekAdminDaerah->num_rows() > 0 && $role_id <= 4) {
				$this->session->set_flashdata('message', 'Gagal Simpan Username ' . $username . ' Sudah Ada Admin di Posisi ini..!!!');
				$this->session->set_flashdata('status', 'danger');
								redirect('Setting/pengaturan_user');
			} else {
				$cekUserName = $this->msetting->cekusername('a.id,a.username', $username, '', '');
				if ($cekUserName->num_rows() > 0) {
					$this->session->set_flashdata('message', 'Gagal Simpan Username ' . $username . ' Sudah Terpakai..!!!');
					$this->session->set_flashdata('status', 'danger');
									redirect('Setting/pengaturan_user');
				} else {
					$query		= $this->mglobals->setData('tm_user', $data, 'id', $id);
					if ($query) {
						$this->session->set_flashdata('message', 'Data User Berhasil di Simpan.');
						$this->session->set_flashdata('status', 'success');
										redirect('Setting/pengaturan_user');
					} else {
						$this->session->set_flashdata('message', 'Data User Gagal di Simpan.');
						$this->session->set_flashdata('status', 'danger');
										redirect('Setting/pengaturan_user');
					}
				}
			}
		}
	}

	public function removePengaturanUser($id)
	{
		$process = $this->msetting->removeDataUser($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Menu Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Menu Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
						redirect('Setting/pengaturan_user');
	}


	public function edit_pengaturan_user($id)
	{
		$data['daftar_kabkota']	= $this->msetting->listDataKabKota('id_kabkot,nama_kabkota');
		$data['daftar_role']	= $this->msetting->listDataRoleUser('id,name_role');
		$data['row']			= $this->msetting->getDataUser('a.*', $id);
		$this->load->view('pengaturan_user/form_edit_user', $data);
	}
	//End Pengaturan User

	public function notification()
	{
		echo "notification";
	}

	public function dashboard_setting()
	{
		echo "dashboard_setting";
	}

	public function system_apps()
	{
		echo "system_apps";
	}

	public function pengaturan_api()
	{
		$data = [
			'title' => 'Pengaturan API',
			'heading' => '',
			'api' => $this->mglobals->getData('*', 'tmuserapi')->result()
		];
		$this->template->load('template/template_backend', 'pengaturan_api/api_v', $data);
	}

	public function simpan_api()
	{
		$id = $this->input->post('id');
		$data = [
			'username' => $this->input->post('username'),
			'security_key' => $this->input->post('api_key'),
		];
		if ($id != "") {
			$query	= $this->mglobals->setData('tmuserapi', $data, 'id_userapi', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Setting/pengaturan_api');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Setting/pengaturan_api');
			}
		} else {
			$query	= $this->mglobals->setData('tmuserapi', $data, 'id', '');
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Setting/pengaturan_api');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Setting/pengaturan_api');
			}
		}
	}

	public function edit_api()
	{
		$id = $this->input->post('id', TRUE);
		$getRow = $this->msetting->getRowApi($id);
		if ($getRow->num_rows() > 0) {
			$row = $getRow->row();
			$data = [
				'status' => true,
				'id_userapi' => $row->id_userapi,
				'username' => $row->username,
				'security_key' => $row->security_key,
			];
			echo json_encode($data);
		} else {
			$data = [
				'status' => false,
				'message' => 'Data Tidak Ditemukan!'
			];
			echo json_encode($data);
		}
	}

	public function delete_api($id)
	{
		$process = $this->mglobals->deleteDataKey('tmuserapi', 'id_userapi', $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data User Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data User Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('setting/pengaturan_api');
	}
}
