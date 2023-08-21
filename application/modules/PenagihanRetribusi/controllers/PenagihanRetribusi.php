<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class PenagihanRetribusi extends CI_Controller
{
	protected $pathRetribusi = 'object-storage/file/Konsultasi/pembayaran_retribusi/';
	protected $pathBerkas = 'object-storage/dekill/Requirement/';
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->load->model('Mpenagihanretribusi');
		$this->load->library('Simbg_lib');
		$this->load->helper('utility');
		$this->load->library('Oss_lib');
		$this->simbg_lib->check_session_login();
	}
	public function index()
	{
		$this->Retribusi();
	}
	//Begin Data List Konsultasi
	public function Retribusi()
	{
		$id_kabkot    		= $this->session->userdata('loc_id_kabkot');
        $SQLcari     		= "";
        $data['skrd'] 		= $this->Mpenagihanretribusi->getListPenagihanRetribusi();
        $data['title']      =    '';
        $data['heading']    =    '';
        $this->template->load('template/template_backend', 'ListPenagihan', $data);
	}
    public function FormRetribusi()
	{
		$id                         = $this->uri->segment(3);
		$data['id']                 = $id;
		$query 			            = $this->Mpenagihanretribusi->getDataPemilik($id);
		$data['data'] 	            = $query->row();
		$querybangunan 	            = $this->Mpenagihanretribusi->getDataBangunanRetribusi($id);
		$getTotalRetribusi          = $this->Mpenagihanretribusi->getTotalRetribusi($id);
		$total                      = $getTotalRetribusi->num_rows() > 0 ? $getTotalRetribusi->row()->nilai_retribusi_keseluruhan : 0;
		$data['total_retribusi']    = $total;
		$data['databgn'] 	        = $querybangunan->row();
		$data['prasarana']          = $this->Mpenagihanretribusi->getPrasarana($id)->result();
		//Bayarlah
		if(trim($id) != ''){
			$qBayar = $this->Mpenagihanretribusi->bayar($id,null);
			$mBayar = $qBayar->row_array();
			$bBayar = $qBayar->num_rows();
			if ($bBayar >= 1 ) {
				$data['id_bayar']           = $mBayar['id_bayar'];
				$data['total_retri']        = $mBayar['total_retri'];
				$data['tgl_penagihan']      = $mBayar['tgl_penagihan'];
				$data['no_penagihan']       = $mBayar['no_penagihan'];
				$data['dir_file_penagihan'] = $mBayar['dir_file_penagihan'];
				$data['email']              = $mBayar['email'];
			}
		}
		//Simpan Baru
		if($this->input->post('save_skrd')) {
			$id_bayar 							= $this->input->post('id_bayar');
			$no_skrd 							= $this->input->post('no_skrd');
			$email	 							= $this->input->post('email');
			$id_pbgnya	 						= $this->input->post('id_pbgnya');
			$total_retri_convert	 			= $this->input->post('total_retri_convert');
			$keterangan 						= '';
			$file_element_name 					= 'd_file';
			$lam 								= $this->input->post('dir_file');
			$filename 							= $_FILES['d_file']['name'];
			$thisdir 							= getcwd();
			$dirPath 							= $thisdir."/object-storage/dekill/Retribution/";
			$config_file['upload_path'] 		= $dirPath;
			//$config_file['allowed_types'] 		= 'pdf|PDF';
			$config_file['allowed_types'] 		= '*';
			$config_file['max_size']			= '502400';
			$config_file['encrypt_name']		= TRUE;
			$this->load->library('upload', $config_file);
			$this->upload->initialize($config_file);
			//End Upload
			if ((!$this->upload->do_upload($file_element_name)) && ($lam != '') ){
				$this->session->set_flashdata('message','SKRD Gagal Disimpan!!!.');
				$this->session->set_flashdata('status','danger');
			}else {
				if($lam != ''){
					$file=$this->upload->data();
					$lampiran=$file['file_name'];
				}else{
					$lampiran=$this->input->post('dir_file_edit');
				}
				$dataIn = array (
					'id_pbgnya' =>$id_pbgnya,
					'total_retri' =>$total_retri_convert,
					'no_penagihan' =>$no_skrd,
					'tgl_penagihan' =>date('Y-m-d'),
					'dir_file_penagihan' =>$lampiran,
					'ket1'=> $keterangan
				);
				if (empty($id_bayar) || trim($id_bayar) == '' || $id_bayar==null || $id_bayar=='0') {
					try {
						$this->Mpenagihanretribusi->insert_Penagihan($dataIn);
						if (trim($id) != '') {
							$tgl_log = date('Y-m-d');
							$keterangan = 'Pembayaran Retribusi';
							$nama_fb = 'Pembayaran Retribusi';
							$kode_feedback = '30';
							$dataStatus = array(
								'status' => 12,
							);
							$data	= array(
								'tgl_status' => $tgl_log,
								'status' => '12',
								'id' => $id,
								'catatan' => "SKRD telah di Kirim Silahkan Cek Akun Anda",
								//'user_id' => $user_id,
								'modul' => 'Penagihan Retribusi'
							);
							$dataPemilik 	= $this->Mpenagihanretribusi->getDataVerifikator($id)->row();
							if($dataPemilik->oss_id != '' || $dataPemilik->oss_id != null ){
								$tgl_skrg 		= date('Y-m-d');
								$kd_status 		= '30';
								$tgl_status 	= $tgl_skrg;
								$nama_status 	= 'Penagihan Retribusi Komitmen';
								$keterangan 	= 'Pembayaran Retribusi';
								$this->oss_lib->receiveLicenseStatusNew($id,$kd_status,$tgl_status,$nama_status,$keterangan);
							}
							$this->Mpenagihanretribusi->updateProgress($dataStatus,$id);
							$this->Mglobals->setDatakol('th_data_konsultasi', $data);
							$this->session->set_flashdata('message','SKRD Telah Disimpan!!!.');
							$this->session->set_flashdata('status','danger');
						}
					}
					catch (Exception $e) {
						$this->session->set_flashdata('message','SKRD Gagal Disimpan.');
						$this->session->set_flashdata('status','danger');
					}
				}else{
					try {
						$this->session->set_flashdata('message','Berhasil Menyimpan SKRD.');
						$this->session->set_flashdata('status','success');
					}
					catch (Exception $e) {
						$this->session->set_flashdata('message','Gagal Menyimpan SKRD.');
						$this->session->set_flashdata('status','danger');
					}
				}
			}
			redirect('PenagihanRetribusi/Retribusi');
		}
		$this->load->view('FormPenagihan', $data);
	}

	public function RollSKRD() 
    {
        $id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$this->load->view('kosong', $data);
    }

	public function SimpanPengembalianRetri()
	{
		$id				= $this->uri->segment(3);
		$id				= $this->input->post('id');
		$catatan 		= $this->input->post('catatan');
		$tgl_skrg 		= date('Y-m-d');
		$data	= array(
			'id'			=> $id,
			'status'		=> 10,
			'catatan'		=> $catatan
		);
		$datalog	= [
			'id' => $id,
			'tgl_status' => $tgl_skrg,
			'status' => '11',
			'catatan' => $catatan,
			'modul' => 'Permohonan Dikembalikan ke Tahap Validasi Kepala Dinas Teknis'
		];
		$this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
		$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
		$this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Validasi Kepala Dinas Teknis');
		$this->session->set_flashdata('status', 'success');
		redirect('PenagihanRetribusi/Retribusi' );
	}
}
