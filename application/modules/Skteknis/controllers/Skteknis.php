<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Skteknis extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Skteknis_model');
		$this->load->model('Global_model', 'gm');
		$this->load->model('Mglobals');
		$this->load->library('simbg_lib');
		$this->simbg_lib->check_session_login();
	}

	// SK TIM TPA
	public function sktpa()
	{
		$select = 'id_skta,no_skta,tgl_skta,expired_skta,file_skta';
		$table = 'tm_sktabg';
		$pk = 'id_skta';
		$sktpt = $this->Mglobals->getData(
			$select,
			$table,
			array('id_kabkot' => $this->session->userdata('loc_id_kabkot')),
			$pk,
			'desc'
		);
		$data = array(
			'title' => 'List Data SK TIM TPA',
			'heading' => '',
			'sktpa' => $sktpt
		);
		$this->template->load('template/template_backend', 'tpa/sktpa_v', $data);
	}

	public function sktpa_save()
	{
		$id = $this->input->post('id_skta');
		$no_skta = $this->input->post('no_skta');
		$tgl_skta = $this->input->post('tgl_skta');
		$expired_skta = $this->input->post('expired_skta');
		$config = [
			'upload_path' => './public/uploads/pupr/sk/sk_tabg/',
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
					'no_skta' => $no_skta,
					'tgl_skta' => date('Y-m-d', strtotime($tgl_skta)),
					'expired_skta' => $expired_skta,
					'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
				);

				$query = $this->Mglobals->setData('tm_sktabg', $data, 'id_skta', $id);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Berhasil Diubah');
					$this->session->set_flashdata('status', 'success');
					redirect('Skteknis/sktpa');
				} else {
					$this->session->set_flashdata('message', 'Data Gagal Diubah');
					$this->session->set_flashdata('status', 'danger');
					redirect('Skteknis/sktpa');
				}
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/pupr/sk/sk_tabg/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('Skteknis/sktpa');
				} else {
					$data	= array(
						'no_skta' => $no_skta,
						'tgl_skta' => date('Y-m-d', strtotime($tgl_skta)),
						'expired_skta' => $expired_skta,
						'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_skta' => $this->upload->data('file_name'),
					);
					$cekFile = $this->gm->getId('id_skta', $id, 'tm_sktabg')->row()->file_skta;
					$path = FCPATH . '/public/uploads/pupr/sk/sk_tabg/';
					$fileLama = $path . $cekFile;
					if (!unlink($fileLama)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					$query = $this->Mglobals->setData('tm_sktabg', $data, 'id_skta', $id);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Diubah');
						$this->session->set_flashdata('status', 'success');
						redirect('Skteknis/sktpa');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Diubah');
						$this->session->set_flashdata('status', 'danger');
						redirect('Skteknis/sktpa');
					}
				}
			}
		} else {
			if (!$this->upload->do_upload('berkas')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				$this->session->set_flashdata('status', 'danger');
				redirect('Skteknis/sktpa');
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/pupr/sk/sk_teknis/';
					$berkas = $path . $this->upload->data('file_name');
					redirect('Skteknis/sktpa');
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
						redirect('Skteknis/sktpa');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Disimpan');
						$this->session->set_flashdata('status', 'danger');
						redirect('Skteknis/sktpa');
					}
				}
			}
		}
	}


	public function pengaturan_sktpa_edit($id)
	{
		$this->session->userdata('loc_user_id') == 9999 ? $id_kabkot = '' : $id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data = array(
			'disable' => '',
			'query_syarat_adm' => $this->Skteknis_model->get_sktpa_parent($id_kabkot),
			'query_syarat_selected' => $this->Skteknis_model->get_sktpa_selected($id),
			'row' => $this->Skteknis_model->getDataEditTimTPA('a.*', $id),
		);
		$this->load->view('tpa/personil', $data);
	}

	public function pengaturan_sktpa_save($var = null)
	{
		$id_skta		= $this->input->post('id');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');

		if ($dok_persyaratan != "") {
			$process = $this->Skteknis_model->removeDataPersyaratanPermohonan($id_skta);
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

					$this->Mglobals->setData('tm_sktabgdetail', $data, '', '');
					$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					redirect('Skteknis/sktpa');
				}
			}
		} else {
			$this->session->set_flashdata('message', 'Data Gagal Di simpan, Pastikan Memilih Minimal 1.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Skteknis/sktpa');
		}
	}

	public function sktpa_edit()
	{
		$id = $this->input->get('id');
		$data = $this->Mglobals->getData('id_skta,no_skta,tgl_skta,expired_skta', 'tm_sktabg', array('id_skta' => $id))->row();
		echo json_encode($data);
	}


	public function sktpa_delete($id)
	{
		$table = 'tm_sktabg';
		$cekFile = $this->gm->getId('id_skta', $id, 'tm_sktabg')->row()->file_skta;
		$path = FCPATH . '/public/uploads/pupr/sk/sk_tabg/';
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
		redirect('Skteknis/sktpa');
	}
	// End SK TPA

	// SK TPT
	public function sktpt()
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
			'title' => 'List SK TIM TPT',
			'heading' => '',
			'sk_teknis' => $sk_teknis
		);
		$this->template->load('template/template_backend', 'Skteknis/tpt/sktpt_v', $data);
	}

	public function sktpt_save()
	{
		$id = $this->input->post('id_skt');
		$no_skt = $this->input->post('no_skt');
		$tgl_skt = $this->input->post('tgl_skt');
		$expired_skt = $this->input->post('expired_skt');
		$config = [
			'upload_path' => './public/uploads/pupr/sk/sk_teknis/',
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
					'no_skt' => $no_skt,
					'tgl_skt' => date('Y-m-d', strtotime($tgl_skt)),
					'expired_skt' => $expired_skt,
					'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
				);

				$query = $this->Mglobals->setData('tm_sk_timteknis', $data, 'id_skt', $id);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Berhasil Diubah');
					$this->session->set_flashdata('status', 'success');
					redirect('Skteknis/sktpt');
				} else {
					$this->session->set_flashdata('message', 'Data Gagal Diubah');
					$this->session->set_flashdata('status', 'danger');
					redirect('Skteknis/sktpt');
				}
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/pupr/sk/sk_teknis/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('Skteknis/sktpt');
				} else {
					$data	= array(
						'no_skt' => $no_skt,
						'tgl_skt' => date('Y-m-d', strtotime($tgl_skt)),
						'expired_skt' => $expired_skt,
						'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_skt' => $this->upload->data('file_name'),
					);
					$cekFile = $this->gm->getId('id_skt', $id, 'tm_sk_timteknis')->row()->file_skt;
					$path = FCPATH . '/public/uploads/pupr/sk/sk_teknis/';
					$fileLama = $path . $cekFile;
					$query = $this->Mglobals->setData('tm_sk_timteknis', $data, 'id_skt', $id);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Diubah');
						$this->session->set_flashdata('status', 'success');
						redirect('Skteknis/sktpt');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Diubah');
						$this->session->set_flashdata('status', 'danger');
						redirect('Skteknis/sktpt');
					}
				}
			}
		} else {
			if (!$this->upload->do_upload('berkas')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				$this->session->set_flashdata('status', 'danger');
				redirect('Skteknis/sktpt');
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/pupr/sk/sk_teknis/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('Skteknis/sktpt');
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
						redirect('Skteknis/sktpt');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Disimpan');
						$this->session->set_flashdata('status', 'danger');
						redirect('Skteknis/sktpt');
					}
				}
			}
		}
	}

	public function pengaturan_sktpt_edit($id)
	{
		$this->session->userdata('loc_user_id') == 9999 ? $id_kabkot = '' : $id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data = array(
			'disable' => '',
			'query_syarat_adm' => $this->Skteknis_model->get_sktpt_parent($id_kabkot),
			'query_syarat_selected' => $this->Skteknis_model->get_sktpt_selected($id),
			'row' => $this->Skteknis_model->getDataEditTPT('a.*', $id),
		);
		$this->load->view('tpt/personil', $data);
	}

	public function pengaturan_sktpt_save($var = null)
	{
		$id_skt		= $this->input->post('id');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');
		if ($dok_persyaratan != "") {
			$process = $this->Skteknis_model->removeDataTPT($id_skt);
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
		redirect('Skteknis/sktpt');
	}


	public function sktpt_delete($id)
	{
		$table = 'tm_sk_timteknis';
		$cekFile = $this->gm->getId('id_skt', $id, 'tm_sk_timteknis')->row()->file_skt;
		$path = FCPATH . '/public/uploads/pupr/sk/sk_teknis/';
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
		redirect('Skteknis/sktpt');
	}

	public function sktpt_edit()
	{
		$id = $this->input->get('id');
		$data = $this->Mglobals->getData('id_skt,no_skt,tgl_skt,expired_skt', 'tm_sk_timteknis', array('id_skt' => $id))->row();
		echo json_encode($data);
	}
	// End SK TPT


	//Begin SK Penilik
	public function penilik()
	{
		$select = 'id_skp,no_skp,tgl_skp,expired_skp,file_skp';
		//$table = 'tm_sk_timteknis';
		$table = 'tm_sk_timpenilik';
		$pk = 'id_skp';
		$sk_penilik = $this->Mglobals->getData(
			$select,
			$table,
			array('id_kabkot' => $this->session->userdata('loc_id_kabkot')),
			$pk,
			'desc'
		);
		$data = array(
			'title' => 'List SK TIM Penilik',
			'heading' => '',
			'sk_penilik' => $sk_penilik
		);
		$this->template->load('template/template_backend', 'Skteknis/penilik/skpenilik_v', $data);
	}
	
	public function sktpenilik_save()
	{
		$id = $this->input->post('id_skp');
		$no_skp = $this->input->post('no_skp');
		$tgl_skp = $this->input->post('tgl_skp');
		$expired_skp = $this->input->post('expired_skp');
		$config = [
			'upload_path' => './public/uploads/pupr/sk/sk_penilik/',
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
					'no_skp' => $no_skp,
					'tgl_skp' => date('Y-m-d', strtotime($tgl_skp)),
					'expired_skp' => $expired_skp,
					'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
				);
				$query = $this->Mglobals->setData('tm_sk_timpenilik', $data, 'id_skp', $id);
				if ($query) {
					$this->session->set_flashdata('message', 'Data Berhasil Diubah');
					$this->session->set_flashdata('status', 'success');
					redirect('Skteknis/penilik');
				} else {
					$this->session->set_flashdata('message', 'Data Gagal Diubah');
					$this->session->set_flashdata('status', 'danger');
					redirect('Skteknis/penilik');
				}
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/pupr/sk/penilik/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('Skteknis/penilik');
				} else {
					$data	= array(
						'no_skp' => $no_skp,
						'tgl_skp' => date('Y-m-d', strtotime($tgl_skp)),
						'expired_skp' => $expired_skp,
						'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_skp' => $this->upload->data('file_name'),
					);
					$cekFile = $this->gm->getId('id_skp', $id, 'tm_sk_timpenilik')->row()->file_skt;
					$path = FCPATH . '/public/uploads/pupr/sk/penilik/';
					$fileLama = $path . $cekFile;
					$query = $this->Mglobals->setData('tm_sk_timpenilik', $data, 'id_skp', $id);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Diubah');
						$this->session->set_flashdata('status', 'success');
						redirect('Skteknis/penilik');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Diubah');
						$this->session->set_flashdata('status', 'danger');
						redirect('Skteknis/penilik');
					}
				}
			}
		} else {
			if (!$this->upload->do_upload('berkas')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				$this->session->set_flashdata('status', 'danger');
				redirect('Skteknis/penilik');
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/pupr/sk/penilik/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('Skteknis/penilik');
				} else {
					$data	= array(
						'id_skp' => $id,
						'no_skp' => $no_skp,
						'tgl_skp' => date('Y-m-d', strtotime($tgl_skp)),
						'expired_skp' => $expired_skp,
						'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						'file_skp' => $this->upload->data('file_name'),
					);
					$query = $this->Mglobals->setData('tm_sk_timpenilik', $data);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Disimpan');
						$this->session->set_flashdata('status', 'success');
						redirect('Skteknis/penilik');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Disimpan');
						$this->session->set_flashdata('status', 'danger');
						redirect('Skteknis/penilik');
					}
				}
			}
		}
	}
	
	public function sktpenilik_edit()
	{
		$id = $this->input->get('id');
		$data = $this->Mglobals->getData('id_skp,no_skp,tgl_skp,expired_skp', 'tm_sk_timpenilik', array('id_skp' => $id))->row();
		echo json_encode($data);
	}
	
	public function sktpenilik_delete($id)
	{
		$table = 'tm_sk_timpenilik';
		$cekFile = $this->gm->getId('id_skp', $id, 'tm_sk_timpenilik')->row()->file_skp;
		$path = FCPATH . '/public/uploads/pupr/sk/sk_penilik/';
		$fileLama = $path . $cekFile;
		if (!unlink($fileLama)) {
			$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
			$this->session->set_flashdata('status', 'warning');
		}
		$process = $this->Mglobals->deleteDataKey($table, 'id_skp', $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Skteknis/penilik');
	}
	
	public function pengaturan_sktpenilik_edit($id)
	{
		$this->session->userdata('loc_user_id') == 9999 ? $id_kabkot = '' : $id_kabkot = $this->session->userdata('loc_id_kabkot');
		$data = array(
			'disable' => '',
			'query_syarat_adm' => $this->Skteknis_model->get_sktpenilik_parent($id_kabkot),
			'query_syarat_selected' => $this->Skteknis_model->get_sktpenilik_selected($id),
			'row' => $this->Skteknis_model->getDataEditPenilik('a.*', $id),
		);
		$this->load->view('penilik/personil', $data);
	}
	
	public function pengaturan_skpenilik_save($var = null)
	{
		$id_skp		= $this->input->post('id');
		$dok_persyaratan		= $this->input->post('dok_persyaratan');
		if ($dok_persyaratan != "") {
			$process = $this->Skteknis_model->removeDataTPenilik($id_skp);
			if (!$process) {
				$this->session->set_flashdata('message', 'Data Gagal Di simpan');
				$this->session->set_flashdata('status', 'danger');
			} else {
				for ($i = 0; $i < count($dok_persyaratan); $i++) {
					$id_personal = $dok_persyaratan[$i];
					$data	= array(
						'id_skp' => $id_skp,
						'id_personal' => $id_personal,
					);
					$processInput = $this->Mglobals->setData('tm_skpdetail', $data, '', '');
				}
				if (!$processInput) {
					$this->session->set_flashdata('message', 'Data Gagal di Ubah.');
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
		redirect('Skteknis/penilik');
	}

	//End SK Penilik

}

/* End of file Sktpt.php */
