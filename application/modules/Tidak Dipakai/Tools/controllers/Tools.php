<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->model('kalkulator_model','mkal');
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

	}
	
	function sampledata()
	{
		$getsamplefungsi = $this->mkal->getitemparent($_REQUEST['id_fungsi'])->result();
		echo "<option value=''>- Pilih -</option>";
		foreach($getsamplefungsi as $index){
			echo "<option value='$index->kode'>$index->nama_indeks</option>";
		}
	}
	
	function getval()
	{
		$indeks = $this->mkal->getIndeks($_REQUEST['kode'])->row_array();
		if(isset($indeks['indeks'])) echo $indeks['indeks'];
		else echo 0;
	}
	
	function showindeks()
	{
		$nilk="";
		$showdata=$this->mkal->getsampleparameter($_REQUEST['id_sample'])->result();
		foreach($showdata as $index){
			$nilk=$nilk."~".$index->nilai_indeks."*".$index->parameter;
		}
		echo trim(substr($nilk,1,strlen($nilk)));
	}
	
	public function kalkulator()
	{	
		$fungsi = $this->mkal->getitemparent('1200')->result();
		$data['fungsi']=$fungsi;
		
		$parameter = $this->mkal->getitemparent('1300')->result();
		$data['parameter']=$parameter;
		
		$waktu = $this->mkal->getitemparent('1400')->result();
		$data['waktu']=$waktu;
		//Get data list untuk penetapan
		$que32 = $this->mkal->get_klas_detail(null,2)->result();
		$list_klas_detail2 [''] = '- Pilih -';
		foreach ($que32 as $row) {
			$list_klas_detail2[$row->id_klasifikasi_detail.','.$row->index_klasifikasi] = $row->nama_klasifikasi_detail;
		}
		$data['listKlasDetail2'] = $list_klas_detail2;

		$que33 = $this->mkal->get_klas_detail(null,3)->result();
		$list_klas_detail3 [''] = '- Pilih -';
		foreach ($que33 as $row) {
			$list_klas_detail3[$row->id_klasifikasi_detail.','.$row->index_klasifikasi] = $row->nama_klasifikasi_detail;
		}
		$data['listKlasDetail3'] = $list_klas_detail3;

		$que34 = $this->mkal->get_klas_detail(null,4)->result();
		$list_klas_detail4 [''] = '- Pilih -';
		foreach ($que34 as $row) {
			$list_klas_detail4[$row->id_klasifikasi_detail.','.$row->index_klasifikasi] = $row->nama_klasifikasi_detail;
		}
		$data['listKlasDetail4'] = $list_klas_detail4;

		$que35 = $this->mkal->get_klas_detail(null,5)->result();
		$list_klas_detail5 [''] = '- Pilih -';
		foreach ($que35 as $row) {
			$list_klas_detail5[$row->id_klasifikasi_detail.','.$row->index_klasifikasi] = $row->nama_klasifikasi_detail;
		}
		$data['listKlasDetail5'] = $list_klas_detail5;

		$que36 = $this->mkal->get_klas_detail(null,6)->result();
		$list_klas_detail6 [''] = '- Pilih -';
		foreach ($que36 as $row) {
			$list_klas_detail6[$row->id_klasifikasi_detail.','.$row->index_klasifikasi] = $row->nama_klasifikasi_detail;
		}
		$data['listKlasDetail6'] = $list_klas_detail6;

		$que37 = $this->mkal->get_klas_detail(null,7)->result();
		$list_klas_detail7 [''] = '- Pilih -';
		foreach ($que37 as $row) {
			$list_klas_detail7[$row->id_klasifikasi_detail.','.$row->index_klasifikasi] = $row->nama_klasifikasi_detail;
		}
		$data['listKlasDetail7'] = $list_klas_detail7;

		$que4 = $this->mkal->get_waktu_penggunaan()->result();
		$list_w_peng [''] = '- Pilih -';
		foreach ($que4 as $row) {
			$list_w_peng[$row->id_waktu.','.$row->index_waktu_penggunaan] = $row->nama_waktu_penggunaan;
		}
		$data['listWaktupeng'] = $list_w_peng;

		$data['id_cara_penetapan'] = 1;
		$data['title']		=	'Kalkulator Retribusi';
		$data['heading']		=	'';
		$data['content']	= $this->load->view('Tools/retribusiform',$data,TRUE);
		$this->load->view('template_profil',$data);
	}

	function hitung_retribusi($id_penetapan_retribusi,$harga_satuan,$luas_bg,$index_fungsi,$index_klasifikasi_bg,$index_resiko_kebakaran,$index_permanensi,$index_zona_gempa,$index_lokasi,$index_ketinggian_bg,$index_kepemilikan,$index_waktu_penggunaan){


		$val_klasifikasi_bg = 0.25*$index_klasifikasi_bg;
		$val_permanensi = 0.2*$index_permanensi;
		$val_resiko_kebakaran = 0.15*$index_resiko_kebakaran;
		$val_zona_gempa = 0.15*$index_zona_gempa;
		$val_lokasi = 0.1*$index_lokasi;
		$val_ketinggian_bg = 0.1*$index_ketinggian_bg;
		$val_kepemilikan = 0.05*$index_kepemilikan;
		$harga = number_format($harga_satuan,0,'',',');

		$val_total = $val_klasifikasi_bg+$val_permanensi+$val_resiko_kebakaran+$val_zona_gempa+$val_lokasi+$val_ketinggian_bg+$val_kepemilikan;
		$val_terintegrasi = $index_fungsi*$val_total*$index_waktu_penggunaan;
		$retribusi = $luas_bg*$val_terintegrasi*1.00*$harga_satuan;

		$dataIn = array (
				 'retribusi' => $retribusi
				);
		$this->mretribusi->update_data_penetapan_retribusi($dataIn,$id_penetapan_retribusi);

		return " Retribusi = Luas BG X Indeks Terintegrasi X 1,00 X HS<sub>bg</sub> <br>
		Retribusi = ".$luas_bg."*".$val_terintegrasi."*1,0*".$harga." = Rp.".number_format($retribusi,0,'',',')."<br>("
		.terbilang($retribusi)." rupiah)";
	}
}
