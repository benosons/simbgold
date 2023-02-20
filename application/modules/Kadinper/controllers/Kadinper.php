<?php defined('BASEPATH') or exit('No direct script access allowed');
class Kadinper extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utility');
        $this->load->model(array('Mkadinper', 'mglobal'));
        $this->load->library(array('Simbg_lib', 'Oss_lib'));
        $this->load->model('Mglobal');
        $this->load->model('Mglobals');
        $this->simbg_lib->check_session_login();
    }
    //Begin Validasi Kadis Perizinan untuk Bangunan Gedung
    public function ValidasiBangunanBaru()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mkadinper->getListValBangunanGedungBaru();
        $data['title']      = '';
        $data['heading']    = '';
        $this->template->load('template/template_backend', 'Kadinper/ListValidasiBangunanGedungBaru', $data);
    }
    Public function ValidasiForm()
	{
		$id             = $this->input->post('id');
		$data['id']     = $id;
        $tgl_skrg       = date('Y-m-d');
		$ttd            = $this->Mkadinper->getPejabatTtd($id);
		$ttd_pejabat_sk = $ttd['kepala_dinas'];
		$nip_pejabat_sk = $ttd['nip_kepala_dinas'];
		$status_pejabat = $ttd['status_pejabat'];
		if (trim($id) != '') {
			$tgl_log = date('Y-m-d');
			$keterangan = 'Persetujuan Bangunan Gedung Sudah Di Validasi Kadis';
			$nama_fb = 'Hasil Sidang';
			$kode_feedback = '50';
			$data_log = array (
				'id'                    => $id,
				'tgl_log_permohonan'    => $tgl_log,
				'keterangan'            => $keterangan,
				'kode_proses'           => 17,
				'post_date'             => $tgl_log,
				'post_by'               => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$dataStatus = array(
				'status' => 15,
			);
			$datavalidasi	= array(
				'nm_kadis'          => $ttd_pejabat_sk,
				'nip_kadis'         => $nip_pejabat_sk,
				'status_pejabat'    => $status_pejabat,
                'tgl_validasi'      => $tgl_skrg
			);
			$this->Mkadinper->updateProgress($dataStatus,$id);
			$this->Mkadinper->updateValidasi($datavalidasi,$id);
		}
		$this->session->set_flashdata('message','Persetujuan Bangunan gedung Tervalidasi');
		$this->session->set_flashdata('status','success');
		redirect('Kadinper/ValidasiBangunanBaru');
	}
    public function RollbackKadis()
    {
        $id             = $this->uri->segment(3);
        $pernyataan     = '1';
        $tgl_skrg       = date('Y-m-d');
        if ($pernyataan == '1') {
            $data    = array(
                'status' => '12',
            );
            $datalog    = [
                'id'            => $id,
                'tgl_status'    => $tgl_skrg,
                'status'        => '12',
                'catatan'       => 'Kepalad Dinas melakukan Mengembalikan Permohonan  Ke Tahap Validasi Pembayaran Retribusi',
                'modul'         => 'Permohonan Dikembalikan ke Tahap Validasi Pembayaran Retribusi'
            ];
            $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mkadinper->removeDataSK($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Validasi Pembayaran Retribusi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('Kadinper/ValidasiBangunanBaru');
    }
    public function ValidasiBangunanEksisting() 
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mkadinper->getListValBangunanGedungEksis();
        $data['title']      = '';
        $data['heading']    = '';
        $this->template->load('template/template_backend', 'Kadinper/ListValidasiBangunanEksisting', $data);
    }
    Public function ValidasiFormEksis()
	{
		$id             = $this->input->post('id');
		$data['id']     = $id;
        $tgl_skrg       = date('Y-m-d');
		$ttd            = $this->Mkadinper->getPejabatTtd($id);
		$ttd_pejabat_sk = $ttd['kepala_dinas'];
		$nip_pejabat_sk = $ttd['nip_kepala_dinas'];
		$status_pejabat = $ttd['status_pejabat'];
		if (trim($id) != '') {
			$tgl_log        = date('Y-m-d');
			$keterangan     = 'Persetujuan Bangunan Gedung Eksisting Sudah Di Validasi Kadis';
			$nama_fb        = 'Hasil Sidang';
			$kode_feedback  = '50';
			$data_log = array (
				'id'                    => $id,
				'tgl_log_permohonan'    => $tgl_log,
				'keterangan'            => $keterangan,
				'kode_proses'           => 17,
				'post_date'             => $tgl_log,
				'post_by'               => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$dataStatus = array(
				'status' => 15,
			);
			$datavalidasi	= array(
				'nm_kadis'          => $ttd_pejabat_sk,
				'nip_kadis'         => $nip_pejabat_sk,
				'status_pejabat'    => $status_pejabat,
                'tgl_validasi'      => $tgl_skrg
			);
			$this->Mkadinper->updateProgress($dataStatus,$id);
			$this->Mkadinper->updateValidasi($datavalidasi,$id);
		}
		$this->session->set_flashdata('message','Persetujuan Bangunan Gedung Eksisting Tervalidasi');
		$this->session->set_flashdata('status','success');
		redirect('Kadinper/ValidasiBangunanEksisting');
	}
    public function RollbackKadisEksis()
    {
        $id             = $this->uri->segment(3);
        $pernyataan     = '1';
        $tgl_skrg       = date('Y-m-d');
        if ($pernyataan == '1') {
            $data    = array(
                'status' => '12',
            );
            $datalog    = [
                'id'            => $id,
                'tgl_status'    => $tgl_skrg,
                'status'        => '12',
                'catatan'       => 'Kepalad Dinas melakukan Mengembalikan Permohonan  Ke Tahap Validasi Pembayaran Retribusi',
                'modul'         => 'Permohonan Dikembalikan ke Tahap Validasi Pembayaran Retribusi'
            ];
            $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mkadinper->removeDataSK($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Validasi Pembayaran Retribusi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('Kadinper/ValidasiBangunanEksisting');
    }
    //End Validasi Kadis Perizinan untuk Bangunan Gedung
    //Begin Validasi Kadis Perizinan untuk Bangunan Prasarana
    public function ValidasiPrasaranaBaru()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mkadinper->getListValBangunanPrasaranaBaru();
        $data['title']      = '';
        $data['heading']    = '';
        $this->template->load('template/template_backend', 'Kadinper/ListValidasiBangunanPrasaranaBaru', $data);
    }
    Public function ValidasiFormPrasarana()
	{
		$id             = $this->input->post('id');
		$data['id']     = $id;
        $tgl_skrg       = date('Y-m-d');
		$ttd            = $this->Mkadinper->getPejabatTtd($id);
		$ttd_pejabat_sk = $ttd['kepala_dinas'];
		$nip_pejabat_sk = $ttd['nip_kepala_dinas'];
		$status_pejabat = $ttd['status_pejabat'];
		if (trim($id) != '') {
			$tgl_log        = date('Y-m-d');
			$keterangan     = 'Persetujuan Bangunan Gedung Eksisting Sudah Di Validasi Kadis';
			$nama_fb        = 'Hasil Sidang';
			$kode_feedback  = '50';
			$data_log       = array (
				'id'                    => $id,
				'tgl_log_permohonan'    => $tgl_log,
				'keterangan'            => $keterangan,
				'kode_proses'           => 17,
				'post_date'             => $tgl_log,
				'post_by'               => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$dataStatus = array(
				'status' => 15,
			);
			$datavalidasi	= array(
				'nm_kadis'          => $ttd_pejabat_sk,
				'nip_kadis'         => $nip_pejabat_sk,
				'status_pejabat'    => $status_pejabat,
                'tgl_validasi'      => $tgl_skrg
			);
			$this->Mkadinper->updateProgress($dataStatus,$id);
			$this->Mkadinper->updateValidasi($datavalidasi,$id);
		}
		$this->session->set_flashdata('message','Persetujuan Bangunan Gedung Eksisting Tervalidasi');
		$this->session->set_flashdata('status','success');
		redirect('Kadinper/ValidasiBangunanEksisting');
	}
    public function RollbackKadisPrasarana()
    {
        $id             = $this->uri->segment(3);
        $tgl_skrg       = date('Y-m-d');
        if ($pernyataan == '1') {
            $data    = array(
                'status' => '12',
            );
            $datalog    = [
                'id'            => $id,
                'tgl_status'    => $tgl_skrg,
                'status'        => '12',
                'catatan'       => 'Kepalad Dinas melakukan Mengembalikan Permohonan  Ke Tahap Validasi Pembayaran Retribusi',
                'modul'         => 'Permohonan Dikembalikan ke Tahap Validasi Pembayaran Retribusi'
            ];
            $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mkadinper->removeDataSK($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Validasi Pembayaran Retribusi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('Kadinper/ValidasiPrasaranaBaru');
    }
    public function ValidasiPrasaranaEksisting()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mkadinper->getListValBangunanPrasaranaEksisting();
        $data['title']      = '';
        $data['heading']    = '';
        $this->template->load('template/template_backend', 'Kadinper/ListValidasiBangunanPrasaranaEksisting', $data);
    }
    //End Validasi Kadis Perizinan untuk Bangunan Prasarana
    //Begin Validasi Kadis Perizinan untuk Bangunan Pertashop
    public function ValidasiBangunanPertashopBaru()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mkadinper->getListValBangunanPertashop();
        $data['title']      = '';
        $data['heading']    = '';
        $this->template->load('template/template_backend', 'Kadinper/ListValidasiBangunanPertashopBaru', $data);
    }

    public function ValidasiBangunanPertashopEksis()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mkadinper->getListValBangunanPertashopEksis();
        $data['title']      = '';
        $data['heading']    = '';
        $this->template->load('template/template_backend', 'Kadinper/ListValidasiBangunanPertashopEksis', $data);
    }
    //End Validasi Kadis Perizinan untuk Bangunan Pertashop
}