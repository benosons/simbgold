<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Detail extends CI_Controller {

	var $limit = 1000;
	public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->model('mpenerbitan_imb');
		$this->load->model('mpermohonan');
		$this->load->model('master_permohonan_model','m_mpermohonan');
		$this->load->model('mpenjadwalan');
		$this->load->model('mpenugasan');
		//$this->load->library('oss_lib');
		//$this->qi_auth->check_permissions_v2();
	}

	function killSession()
	{
		$this->session->unset_userdata('pencarian');	
	}
	
	public function index()
	{	 
		$this->killSession();
		//$this->penjadwalan_list();
	}

	function detail_imb()
	{
		$this->killSession();
		$id_permohonan = $this->uri->segment(3);
		$data['id_permohonan'] = $id_permohonan;
		$id = $this->uri->segment(3);

		if(trim($id_permohonan) != '' && trim($id_permohonan) != '') {
			$query = $this->mpermohonan->get_detail_imb($id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['nomor_registrasi'] = $mydata['nomor_registrasi'];
				$data['statusaha'] = $mydata['id_jenis_usaha'];
				
						if($mydata['id_jenis_usaha'] == 1){
							$data['usaha'] = "Perseorangan";
							
						}elseif ($mydata['id_jenis_usaha'] ==2){
							$data['usaha'] = "Badan Usaha/Badan Hukum";
							$data['usaha2'] = "2";
						}elseif($mydata['id_jenis_usaha'] ==3){
							$data['usaha'] = "Pemerintah";
							$data['usaha2'] = "3";
						}else{
							$data['usaha'] = "";
							//$data['usaha2'] = "";
						}	
				
				$data['jenis_urusan'] = $mydata['id_jenis_permohonan'];
				$data['nama'] = $mydata['nama_pemohon'];
				$data['jalan'] = $mydata['alamat_pemohon'];
				$data['kelurahan'] = $mydata['kelurahan'];
				$data['kecamatan'] = $mydata['kecamatan'];
				$data['id_kec'] = $mydata['id_kecamatan'];
				$data['nama_kec'] = $mydata['nama_kecamatan'];
				$data['id_kabkot'] = $mydata['id_kabkot'];
				$data['nama_kabkota'] = $mydata['nama_kabkota'];
				$data['id_provinsi'] = $mydata['id_provinsi'];
				$data['nama_provinsi'] = $mydata['nama_provinsi'];
				$data['no_tlpn'] = $mydata['no_tlp'];
				$data['email'] = $mydata['email'];
				$data['ktp'] = $mydata['no_ktp'];
				$data['jabdpershn'] = $mydata['jabatan_perusahaan'];
				$data['nm_pershn'] = $mydata['nama_perusahaan'];
				$data['alamat_pershn'] = $mydata['alamat_perusahaan'];
				$data['no_tlpn_pershn'] = $mydata['no_tlp_perusahaan'];
				$data['jalan_lokasi'] = $mydata['alamat_bg'];
				$data['kel'] = $mydata['kelurahan'];
				$data['kec'] = $mydata['kecamatan'];
				$data['stat'] = $mydata['status'];
				$data['id_fungsi_bg'] = $mydata['id_fungsi_bg'];
						
						if($mydata['id_fungsi_bg'] == 5){
							$data['sarana'] = 5;
						}else{
							$data['sarana'] = null;
							//$data['usaha2'] = "";
						}
						
				$data['jns_bangunan'] = $mydata['jns_bangunan'];
				$data['nama_bangunan'] = $mydata['nama_bangunan'];
				$data['username'] = $mydata['username'];
				$data['nama_permohonan'] = $mydata['nama_permohonan'];
				$data['lantai_bg'] = $mydata['lantai_bg'];
				$data['tinggi_bg'] = $mydata['tinggi_bg'];
				$data['luas_bg'] = $mydata['luas_bg'];
				$data['luas_tanah'] = $mydata['luas_tanah'];
				$data['alamat_bg'] = $mydata['alamat_bg'];
				$data['nama_kecamatan'] = $mydata['nama_kecamatan'];
				$data['nama_kecamatan_bg'] = $mydata['nama_kecamatan_bg'];
				$data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
				$data['nama_provinsi_bg'] = $mydata['nama_provinsi_bg'];
				$data['id_pemanfaatan_bg'] = $mydata['id_pemanfaatan_bg2'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['id_klasifikasi_bg'] = $mydata['id_klasifikasi_bg'];
						if($mydata['id_klasifikasi_bg'] == 1){
							$data['klasifikasi_bg'] = "Sederhana";
						}elseif ($mydata['id_klasifikasi_bg'] ==2){
							$data['klasifikasi_bg'] = "Tidak Sederhana";
						}elseif($mydata['id_klasifikasi_bg'] ==3){
							$data['klasifikasi_bg'] = "Khusus";
						}else{
							$data['klasifikasi_bg'] = "";
						}
				//$data['tgl_pelaksanaan'] =  tgl_eng_to_ind($mydata['tgl_pelaksanaan']);
				$data['tgl_permohonan'] =  tgl_eng_to_ind($mydata['tgl_permohonan']);
				$data['id_jenis_bg'] = $mydata['id_jenis_bg'];
						if($mydata['id_jenis_bg'] == 5){
							$data['tsarana'] = 5;
						}else{
							$data['tsarana'] = null;
							//$data['usaha2'] = "";
						}
				$data['id_prasarana_bg'] = $mydata['id_prasarana_bg'];
				$data['tinggi_prasarana'] = $mydata['tinggi_prasarana'];
				$data['luas_prasarana'] = $mydata['luas_prasarana'];
				$data['lapis_basement'] = $mydata['lapis_basement'];
				$data['luas_basement'] = $mydata['luas_basement'];
				$data['retribusi'] = $mydata['retribusi'];
				$data['retribusi_manual'] = $mydata['retribusi_manual'];
				if($mydata['retribusi'] != 0 && $mydata['retribusi'] != null){
					$data['harganya'] = $mydata['retribusi'];
				}else{
					$data['harganya'] = $mydata['retribusi_manual'];
				}

				$data['no_imb'] = $mydata['no_imb'];
				$data['tgl_imb'] = tgl_eng_to_ind($mydata['tgl_imb']);
				//$data['tanggal_penyerahan_imb'] = tgl_eng_to_ind($mydata['tanggal_penyerahan_imb']);
				
				//
				$data['id_kolektif'] = $mydata['id_kolektif'];
				$data['luasA'] = $mydata['luasA'];
				$data['luasB'] = $mydata['luasB'];
				$data['luasC'] = $mydata['luasC'];
				$data['luasD'] = $mydata['luasD'];
				$data['unitA'] = $mydata['unitA'];
				$data['unitB'] = $mydata['unitB'];
				$data['unitC'] = $mydata['unitC'];
				$data['unitD'] = $mydata['unitD'];
				$data['tipeA'] = $mydata['tipeA'];
				$data['tipeB'] = $mydata['tipeB'];
				$data['tipeC'] = $mydata['tipeC'];
				$data['tipeD'] = $mydata['tipeD'];
				$data['tinggiA'] = $mydata['tinggiA'];
				$data['tinggiB'] = $mydata['tinggiB'];
				$data['tinggiC'] = $mydata['tinggiC'];
				$data['tinggiD'] = $mydata['tinggiD'];
				//
			}
		}
		//get data penjadwalan
		$que2 = $this->mpermohonan->get_dtail_tanah($id_permohonan);
		$data['jmltanah'] = $que2->num_rows();
		$data['result_tanah'] = $que2->result_array();

		if(trim($id_permohonan) != ''){
			$query = $this->mpenjadwalan->get_data_penjadwalan($id_permohonan);
			$data['jumdata_penjadwalan'] = $query->num_rows();
			$data['results_penjadwalan'] = $query->result_array();
		}
		$que = $this->mpenugasan->get_data_penugasan($id_permohonan);
		$data['jmlPegawai'] = $que->num_rows();
		$data['result_peg'] = $que->result_array();
		$data['title']		=	'';
		$data['heading']		=	'';
		//$data['content']	= $this->load->view('detail_imb',$data,TRUE);
		//$this->load->view('kosong',$data);
		$this->load->view('detail_imb',$data);
	}
	
}
