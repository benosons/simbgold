<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Retribusi extends CI_Controller {

	var $limit = 1000;
	public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->model('mretribusi');
		$this->load->model('mpermohonan');
		$this->load->model('kalkulator_model','mkal');
		$this->load->model('master_permohonan_model','m_mpermohonan');
		$this->load->model('mpenjadwalan');
		$this->load->model('mpenugasan');
		//$this->load->library('oss_lib');
		//$this->qi_auth->check_permissions_v2();
		$this->load->library('simbg_lib');
		$this->load->helper(array('form', 'url'));
		//$this->simbg_lib->check_session_login();
	}

	function killSession()
	{
		$this->session->unset_userdata('pencarian');
	}

	public function index()
	{
		//$this->killSession();
		$this->penetapan_retribusi_list();
	}

	function penetapan_retribusi_list()
	{
		// Mengambil Jenis Permohonan
		$queJenisUrusan = $this->mpermohonan->get_jenis_pelayanan_list()->result();
		$list_jenis_urusan[''] = '--Pilih--';
		foreach ($queJenisUrusan as $row)
		{
			$list_jenis_urusan[$row->id_jenis_permohonan] = $row->nama_permohonan;
		}
		$data['list_jenis_urusan'] = $list_jenis_urusan;

		$queKlasifikasi_bg = $this->m_mpermohonan->get_klasifikasi_bg()->result();
		$list1[''] = '--Pilih--';
		foreach ($queKlasifikasi_bg as $row)
		{
			$list1[$row->id_klasifikasi_bg] = $row->klasifikasi_bg;
		}
		$data['list1'] = $list1;

		$uri_segment = 3;
		$offset = 0;
		$SQLcari = "";

		if ($this->input->post('search',TRUE)){
			$this->session->set_userdata('pencarian' ,1);
			$nama_kabkota = $this->input->post('nama_kabkota');
			$id_kabkot = trim($this->input->post('id_kabkot'));
			$data['nama_kabkota'] = $nama_kabkota;
			$data['id_kabkot'] = $id_kabkot;
			if (trim($id_kabkot) != '')
			{
				$this->session->set_userdata('skeynama_kabkota' ,$nama_kabkota);
				$this->session->set_userdata('skeyid_kabkot' ,$id_kabkot);
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot'";
			}

			$nomor_registrasi = trim($this->input->post('nomor_registrasi'));
			$data['nomor_registrasi'] = $nomor_registrasi;
			if (trim($nomor_registrasi) != '')
			{
				$this->session->set_userdata('skeynomor_registrasi' ,$nomor_registrasi);
				$SQLcari .= " AND a.nomor_registrasi LIKE '%$nomor_registrasi%'";
			}

			$nama_pemohon = trim($this->input->post('nama_pemohon'));
			$data['nama_pemohon'] = $nama_pemohon;
			if (trim($nama_pemohon) != '')
			{
				$this->session->set_userdata('skeynama_bg' ,$nama_pemohon);
				$SQLcari .= " AND a.nama_pemohon LIKE '%$nama_pemohon%'";
			}

			$jenis_urusan = trim($this->input->post('jenis_urusan'));
			$data['jenis_urusan'] = $jenis_urusan;
			if (trim($jenis_urusan) != '')
			{
				$this->session->set_userdata('skeyjenis_urusan' ,$jenis_urusan);
				$SQLcari .= " AND a.id_jenis_permohonan = '$jenis_urusan'";
			}
			$id_jenis_bg = $this->input->post('id_jenis_bg');
			$data['id_jenis_bg'] = $id_jenis_bg;
			if (trim($id_jenis_bg) != '')
			{
				$id_jenis_bg = trim($id_jenis_bg);
				$this->session->set_userdata('skeyjenis_urusan' ,$id_jenis_bg);
				$SQLcari .= " AND a.id_jenis_bg = '$id_jenis_bg'";
			}

			$klasifikasi_bg = $this->input->post('klasifikasi_bg');
			$data['klasifikasi_bg'] = $klasifikasi_bg;
			if (trim($klasifikasi_bg) != '')
			{
				$klasifikasi_bg = trim($klasifikasi_bg);
				$this->session->set_userdata('skeyklasifikasi_bg' ,$klasifikasi_bg);
				$SQLcari .= " AND c.id_klasifikasi_bg = '$klasifikasi_bg'";
			}

			$id_pemanfaatan_bg = $this->input->post('id_pemanfaatan_bg');
			$data['id_pemanfaatan_bg'] = $id_pemanfaatan_bg;
			if (trim($id_pemanfaatan_bg) != '')
			{
				$id_pemanfaatan_bg = trim($id_pemanfaatan_bg);
				$this->session->set_userdata('skeyid_pemanfaatan_bg' ,$id_pemanfaatan_bg);
				$SQLcari .= " AND o.id_pemanfaatan_bg = '$id_pemanfaatan_bg'";
			}

			$stat_ret = $this->input->post('id_stat_ret');
			$data['id_stat_ret'] = $stat_ret;
			if ($stat_ret == '1')
			{
				$SQLcari .= " AND h.retribusi is null AND s.no_skrd is null AND t.no_ssrd is null";
			}
			if ($stat_ret == '2')
			{
				$SQLcari .= " AND s.no_skrd is not null AND t.no_ssrd is null";
			}
			if ($stat_ret == '3')
			{
				$SQLcari .= " AND t.no_ssrd is not null";
			}

			//Pencarian Periode Surat Masuk
			$tgl_permohonan_awal = $this->input->post('tgl_permohonan_awal');
			$tgl_permohonan_awal2 = date('Y-m-d',strtotime($tgl_permohonan_awal));
			$tgl_permohonan_akhir = $this->input->post('tgl_permohonan_akhir');
			$tgl_permohonan_akhir2 = date('Y-m-d',strtotime($tgl_permohonan_akhir));
			$data['tgl_permohonan_awal'] = $tgl_permohonan_awal;
			$data['tgl_permohonan_akhir'] = $tgl_permohonan_akhir;
			if (trim($tgl_permohonan_akhir) !='' && trim($tgl_permohonan_akhir) !='')
			{
				$SQLcari .= " AND a.tgl_permohonan between '$tgl_permohonan_awal2' AND '$tgl_permohonan_akhir2'";
			}

			if($this->qi_auth->get_id_kabkot()){
				$id_kabkot = $this->qi_auth->get_id_kabkot();
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$query = $this->mretribusi->get_penetapan_retribusi_list(0,1,$this->limit,$offset,null,$SQLcari);
			$jum_data = $this->mretribusi->get_penetapan_retribusi_list(1,0,null,null,null,$SQLcari);
		}else if ($this->session->userdata('pencarian') == TRUE){
			$SQLcari = '';

			if($this->qi_auth->get_id_kabkot()){
				$id_kabkot = $this->qi_auth->get_id_kabkot();
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$query = $this->mretribusi->get_penetapan_retribusi_list(0,1,$this->limit,$offset,null,$SQLcari);
			$jum_data = $this->mretribusi->get_penetapan_retribusi_list(1,0,null,null,null,$SQLcari);
		}else{

			//$this->killSession();
			if($this->qi_auth->get_id_kabkot()){
				$id_kabkot = $this->qi_auth->get_id_kabkot();
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$query = $this->mretribusi->get_penetapan_retribusi_list(0,1,$this->limit,$offset,null,$SQLcari);
			$jum_data = $this->mretribusi->get_penetapan_retribusi_list(1,0,null,null,null,$SQLcari);
		}
		$this_url = 'retribusi/penetapan_retribusi_list/';
		$data2 = $this->mypagination->getPagination($jum_data,$this->limit,$this_url,$uri_segment);
		$data['paging'] = $data2['link'];
		$data['offset'] = $offset;
		$data['jum_data'] = $jum_data;
		$data['results'] = $query->result_array();
		$data['head_title'] = '.:: Penetapan Retribusi ::.';
		$this->template->load('admin_template', 'retribusi/penetapan_retribusi_list',$data);
	}

	function cetak_retribusi_list()
	{
		$cari='';
		//user name
		$nomor_registrasi = $this->uri->segment(3);
		if (trim($nomor_registrasi ) != 'nomor_registrasi')
		{
			$nomor_registrasi = str_replace('*','/',trim($nomor_registrasi));
			$cari .= " AND a.nomor_registrasi LIKE '%$nomor_registrasi%' ";
			$data['nomor_registrasi'] = $nomor_registrasi;
		}

		// nama pemohon
		$nama_pemohon = $this->uri->segment(4);
		if (trim($nama_pemohon ) != 'nama_pemohon')
		{
			$nama_pemohon = str_replace('*','/',trim($nama_pemohon));
			$cari .= " AND a.nama_pemohon LIKE '%$nama_pemohon%' ";
			$data['nama_pemohon'] = $nama_pemohon;
		}

		//No jenis bg
		$id_jenis_bg = $this->uri->segment(5);
		if (trim($id_jenis_bg ) != 'permohonan')
		{
			$cari .= " AND a.id_jenis_bg = '$id_jenis_bg' ";
			$data['id_jenis_bg'] = $id_jenis_bg;

		}

		//klasifikasi
		$klasifikasi_bg = $this->uri->segment(6);
		if (trim($klasifikasi_bg ) != 'klasifikasi_bg')
		{
			$cari .= " AND c.id_klasifikasi_bg = '$klasifikasi_bg'";
			$data['klasifikasi_bg'] = $klasifikasi_bg;
		}

		//pemanfaatan
		$id_pemanfaatan_bg = $this->uri->segment(7);
		if (trim($id_pemanfaatan_bg ) != 'id_pemanfaatan_bg')
		{
			$cari .= " AND o.id_pemanfaatan_bg = '$id_pemanfaatan_bg'";
			$data['id_pemanfaatan_bg'] = $id_pemanfaatan_bg;
		}

		//jenis permohonana
		$jenis_urusan = $this->uri->segment(8);
		if (trim($jenis_urusan ) != 'jenis_urusan')
		{
			$cari .= " AND a.id_jenis_permohonan = '$jenis_urusan'";
			$data['jenis_urusan'] = $jenis_urusan;
		}

		$id_kabkot = $this->uri->segment(9);
		if (trim($id_kabkot ) != 'id_kabkot')
		{
			$cari .= " AND a.id_kabkot_bg = '$id_kabkot'";
			$data['id_kabkot'] = $id_kabkot;
		}

		//Pencarian Periode Surat Masuk
		$tgl_permohonan_awal = remove_spasi($this->uri->segment(10));
		$tgl_permohonan_akhir = remove_spasi($this->uri->segment(11));
		$tgl_permohonan_awal2 = date('Y-m-d',strtotime($tgl_permohonan_awal));
		$tgl_permohonan_akhir2 = date('Y-m-d',strtotime($tgl_permohonan_akhir));
		$data['tgl_permohonan_awal'] = '';
		$data['tgl_permohonan_akhir'] = '';
		if (trim($tgl_permohonan_awal) !='awal' && trim($tgl_permohonan_akhir) !='akhir')
				{
			$cari .= " AND a.tgl_permohonan between '$tgl_permohonan_awal2' AND '$tgl_permohonan_akhir2'";
			$data['tgl_permohonan_awal'] = $tgl_permohonan_awal;
			$data['tgl_permohonan_akhir'] = $tgl_permohonan_akhir;
		}
		$query = $this->mretribusi->get_penetapan_retribusi_list(null,null,null,null,null,$cari);
		$mydata = $query->row_array();
		$data['nama_permohonan'] = $mydata['nama_permohonan'];
		$data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
		$data['mretribusi'] = $this->mretribusi;
		//$data['offset'] = $offset;
		$data['jum_data'] = $query->num_rows();
		$roll = $query->row_array();
		$data['results'] = $query->result_array();
		$data['head_title'] = '.:: Cetak Daftar Retribusi IMB::.';
		$this->load->view('retribusi/cetak_retribusi_list',$data);
	}

	function retribusi_form()
	{
		$this->killSession();
		$id_permohonan = $this->uri->segment(3);
		$id = $this->uri->segment(3);
		$data['id_permohonan'] = $id_permohonan;
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

		//End data list untuk penetapan

		if(trim($id_permohonan) != ''){
			$query2 = $this->mretribusi->get_data_retsibusi($id_permohonan,null);
			$mydata2 = $query2->row_array();
			$baris2 = $query2->num_rows();
			if ($baris2 >= 1 ) {

				$data['id_penetapan_retribusi'] = $mydata2['id_penetapan_retribusi'];
				$data['id_fungsi_bg'] = $mydata2['id_fungsi_bg'];
				$id_fungsi_bg = $mydata2['id_fungsi_bg'];
				$data['id_klasifikasi_bg'] = $mydata2['id_klasifikasi_bg'];
				$id_klasifikasi_bg = $mydata2['id_klasifikasi_bg'];
				$data['id_resiko_kebakaran'] = $mydata2['id_resiko_kebakaran'].",".$mydata2['index_resiko_kebakaran'];
				$data['id_permanensi'] = $mydata2['id_permanensi'].",".$mydata2['index_permanensi'];
				$data['id_zona_gempa'] = $mydata2['id_zona_gempa'].",".$mydata2['index_zona_gempa'];
				$data['id_lokasi'] = $mydata2['id_lokasi'].",".$mydata2['index_lokasi'];
				$data['id_ketinggian_bg'] = $mydata2['id_ketinggian_bg'].",".$mydata2['index_ketinggian_bg'];
				$data['id_kepemilikan'] = $mydata2['id_kepemilikan'].",".$mydata2['index_kepemilikan'];
				$data['id_waktu_penggunaan'] = $mydata2['id_waktu_penggunaan'].",".$mydata2['index_waktu_penggunaan'];
				$data['harga_satuan'] = $mydata2['harga_satuan'];
				$data['retribusi'] = $mydata2['retribusi'];
				//$mydata2['retribusi']
				//$mydata2['retribusi']
				//$data['besar_retribusi'] = $mydata2['retribusi'];
				if($mydata2['retribusi'] != 0 && $mydata2['retribusi'] != null){
					$retribusi = $mydata2['retribusi'];
				}else{
					$retribusi = $mydata2['retribusi_manual'];
				}
				$data['besar_retribusi'] = $retribusi;
				$data['nama_fungsi'] = $mydata2['nama_fungsi'];
				$data['id_cara_penetapan'] = $mydata2['id_cara_penetapan'];
				$data['dir_file_edit_perhitungan'] = $mydata2['dir_file_perhitungan'];
				//data index
				$fungsi = $mydata2['index_fungsi'];
				$data['index_fungsi'] = $mydata2['index_fungsi'];
				if($id_fungsi_bg == '1')
				{
					if($id_klasifikasi_bg == '1')
					{
						$fungsi = 0.05;
						$data['index_fungsi'] = 0.05;
					}else if($id_klasifikasi_bg == '2'){
						$fungsi = 0.5;
						$data['index_fungsi'] = 0.5;
					}
				}
				$data['index_klasifikasi_bg'] = $mydata2['index_klasifikasi_bg'];
				$data['index_resiko_kebakaran'] = $mydata2['index_resiko_kebakaran'];
				$data['index_permanensi'] = $mydata2['index_permanensi'];
				$data['index_zona_gempa'] = $mydata2['index_zona_gempa'];
				$data['index_lokasi'] = $mydata2['index_lokasi'];
				$data['index_ketinggian_bg'] = $mydata2['index_ketinggian_bg'];
				$data['index_kepemilikan'] = $mydata2['index_kepemilikan'];
				$data['index_waktu_penggunaan'] = $mydata2['index_waktu_penggunaan'];
				$data['resiko_kebakaran'] = $mydata2['index_resiko_kebakaran'];
				$data['permanensi'] = $mydata2['index_permanensi'];
				$data['val_zonasi_gempa'] = $mydata2['index_zona_gempa'];
				$data['lokasi'] = $mydata2['index_lokasi'];
				$data['ketinggian_bg'] = $mydata2['index_ketinggian_bg'];
				$data['kepemilikan'] = $mydata2['index_kepemilikan'];
				$data['waktu'] = $mydata2['index_waktu_penggunaan'];
				$kompleksitas = 0.25*$mydata2['index_klasifikasi_bg'];
				$permanensi = 0.20*$mydata2['index_permanensi'];
				$resiko = 0.15*$mydata2['index_resiko_kebakaran'];
				$zonasi = 0.15*$mydata2['index_zona_gempa'];
				$lokasi = 0.10*$mydata2['index_lokasi'];
				// $ketinggian = 0.10*$mydata2['index_ketinggian_bg'];
				$kepemilikan = 0.05*$mydata2['index_kepemilikan'];
				$data['hasil_resiko_kebakaran'] = 0.15*$mydata2['index_resiko_kebakaran'];
				$data['hasil_permanensi'] = 0.20*$mydata2['index_permanensi'];
				$data['hasil_zonasi_gempa'] = 0.15*$mydata2['index_zona_gempa'];
				$data['hasil_lokasi'] = 0.10*$mydata2['index_lokasi'];
				$data['hasil_ketinggian_bg'] = 0.10*$mydata2['index_ketinggian_bg'];
				$data['hasil_kepemilikan'] = 0.05*$mydata2['index_kepemilikan'];
				$waktu = $mydata2['index_waktu_penggunaan'];
				$data['hasil_waktu'] = $waktu;
				$data['waktu2'] = $waktu;
				$lantai_bg = $mydata2['lantai_bg'];
				if($lantai_bg <=4){
				$tinggi = 0.40;
				$data['ketinggian'] = 0.40;
				$data['hketinggian'] = 'Rendah';}
				elseif($lantai_bg >=5 and $lantai_bg <=8){
				$tinggi = 0.70;
				$data['ketinggian'] = 0.70;
				$data['hketinggian'] = 'Sedang';}
				elseif($lantai_bg >=9){
				$tinggi = 1.00;
				$data['ketinggian'] = 1.00;
				$data['hketinggian'] = 'Tinggi';}
				$ketinggian = 0.10*$tinggi;
				$integrasi = $kompleksitas+$permanensi+$resiko+$zonasi+$lokasi+$ketinggian+$kepemilikan;
				$data['jumlah'] = $integrasi;
				$data['jumlah2'] = $integrasi;
				$data['integrasi'] = $fungsi*$integrasi*$waktu;
				//end data index
				//Data Pemohon/Hasil Rekomtek
				$data['id_jenis_permohonan'] = $mydata2['id_jenis_permohonan'];
				$data['nama_permohonan'] = $mydata2['nama_permohonan'];
				$data['nomor_registrasi'] = $mydata2['nomor_registrasi'];
				$data['alamat_pemohon'] = $mydata2['alamat_pemohon'];
				$data['kecamatan'] = $mydata2['kecamatan'];
				$data['kelurahan'] = $mydata2['kelurahan'];
				//$data['id_jenis_bg'] = $mydata2['id_jenis_bg'];
				$data['nama_kabkota'] = $mydata2['nama_kabkota'];
				$data['nama_provinsi'] = $mydata2['nama_provinsi'];
				$data['nama_kabkota_bg'] = $mydata2['nama_kabkota_bg'];
				$data['nama_provinsi_bg'] = $mydata2['nama_provinsi_bg'];
				$data['nama_kecamatan'] = $mydata2['nama_kecamatan'];
				$data['fungsi_bg'] = $mydata2['fungsi_bg'];
				$data['jns_bangunan'] = $mydata2['jns_bangunan'];
				$data['id_pemanfaatan_bg2'] = $mydata2['id_pemanfaatan_bg2'];
				$data['klasifikasi_bg'] = $mydata2['klasifikasi_bg'];
				$data['tinggi_bg'] = $mydata2['tinggi_bg'];
				$data['alamat_bg'] = $mydata2['alamat_bg'];
				$data['nama_pemohon'] = $mydata2['nama_pemohon'];
				$data['nama_perusahaan'] = $mydata2['nama_perusahaan'];
				$data['alamat_perusahaan'] = $mydata2['alamat_perusahaan'];
				$data['id_jenis_usaha'] = $mydata2['id_jenis_usaha'];
				$data['lantai_bg'] = $mydata2['lantai_bg'];
				$data['luas_bg'] = $mydata2['luas_bg'];
				$data['tinggi_prasarana'] = $mydata2['tinggi_prasarana'];
				$data['email'] = $mydata2['email'];
				$data['dir_file_jadwal'] =$mydata2['dir_file_jadwal'];
				$data['id_penjadwalan'] = $mydata2['id_penjadwalan'];
				//End Data Rekomtek id_penjadwalan
				//data skrd
				$data['id_skrd'] = $mydata2['id_skrd'];
				$data['no_skrd'] = $mydata2['no_skrd'];
				$data['tanggal_skrd'] = $mydata2['tgl_skrd'];
				$data['dir_file_edit'] = $mydata2['file_skrd'];
				//data ssrd
				$data['id_ssrd'] = $mydata2['id_ssrd'];
				$data['no_ssrd'] = $mydata2['no_ssrd'];
				$data['tanggal_ssrd'] = $mydata2['tgl_ssrd'];
				$data['dir_file_edit_s'] = $mydata2['file_ssrd'];
				
				//
				$data['id_jenis_bg'] = $mydata2['id_jenis_bg'];
						if($mydata2['id_jenis_bg'] == 5){
							$data['tsarana'] = 5;
						}else{
							$data['tsarana'] = null;
						}
				$data['id_kolektif'] = $mydata2['id_kolektif'];
				$data['luasA'] = $mydata2['luasA'];
				$data['luasB'] = $mydata2['luasB'];
				$data['luasC'] = $mydata2['luasC'];
				$data['luasD'] = $mydata2['luasD'];
				$data['unitA'] = $mydata2['unitA'];
				$data['unitB'] = $mydata2['unitB'];
				$data['unitC'] = $mydata2['unitC'];
				$data['unitD'] = $mydata2['unitD'];
				$data['tipeA'] = $mydata2['tipeA'];
				$data['tipeB'] = $mydata2['tipeB'];
				$data['tipeC'] = $mydata2['tipeC'];
				$data['tipeD'] = $mydata2['tipeD'];
				$data['tinggiA'] = $mydata2['tinggiA'];
				$data['tinggiB'] = $mydata2['tinggiB'];
				$data['tinggiC'] = $mydata2['tinggiC'];
				$data['tinggiD'] = $mydata2['tinggiD'];
				$data['id_prasarana_bg'] = $mydata2['id_prasarana_bg'];
				//
			}
		}
		
		if(trim($id) != ''){
			$query = $this->mpenjadwalan->get_data_penjadwalan($id,null);
			$data['jumdata_penjadwalan'] = $query->num_rows();
			$data['results_penjadwalan'] = $query->result_array();	
			$results_penjadwalan = $query->result_array();	
			if(count($results_penjadwalan) > 0){
				$i = count($results_penjadwalan)-1;
				$data['id_penjadwalan_aktif'] = $results_penjadwalan[$i]['id_penjadwalan'];
			}else{
				$data['id_penjadwalan_aktif'] = "";
			}
		}
		
		if($this->input->post('save')) {
			//if($this->form_validation->run() === FALSE)
			//{
				//$data['err_msg'] = validation_errors();
				//echo validation_errors()."disini";
			//}else {
				$id_penetapan_retribusi = trim($this->input->post('id_penetapan_retribusi'));
				$harga_satuan = str_replace(',','',$this->input->post('harga_satuan'));
				$besar_retribusi = str_replace(',','',$this->input->post('besar_retribusi_convert'));
				$id_permanensi = trim($this->input->post('list_klas_detail2'));
				$id_resiko_kebakaran = trim($this->input->post('list_klas_detail3'));
				$id_zona_gempa = trim($this->input->post('list_klas_detail4'));
				$id_lokasi = trim($this->input->post('list_klas_detail5'));
				$id_ketinggian_bg = trim($this->input->post('list_klas_detail6'));
				$id_kepemilikan = trim($this->input->post('list_klas_detail7'));
				$id_waktu_penggunaan = trim($this->input->post('list_w_peng'));
				$id_cara_penetapan = trim($this->input->post('id_cara_penetapan'));
				// $validasi_retribusi = trim($this->input->post('validasi_retribusi'));
				
				
				//Upload file Hitung Manual
				$file_element_name3 = 'd_file_p';
				$lam3 = $this->input->post('dir_file_perhitungan');
				$filename = $_FILES['d_file_p']['name'];
				
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/IMB/pengajuan_imb/$id_permohonan/retribusi/";
				if (!file_exists($dirPath)){
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				
				$config_file3['upload_path'] 		= $dirPath;
				$config_file3['allowed_types'] 		= 'pdf';
				$config_file3['max_size']			= '10240';
				$config_file3['encrypt_name']		= TRUE;
				
			
				
				$this->load->library('upload', $config_file3);
				$this->upload->initialize($config_file3);
				//End Upload

				if ((!$this->upload->do_upload($file_element_name3)) && ($lam3 != '') ){
					$data['err_msg'] = $this->upload->display_errors('','');
					$this->session->set_flashdata('message','Retribusi Gagal Disimpan.');
					$this->session->set_flashdata('status','danger');
				}else {

					if($lam3 != ''){
						$file3=$this->upload->data();
						$lampiran3=$file3['file_name'];
					}else{
						$lampiran3=$this->input->post('dir_file_edit_perhitungan');
					}

					$dataIn = array (
							'id_permohonan' =>$id_permohonan,
							'id_fungsi_bg' =>$data['id_fungsi_bg'],
							'id_klasifikasi_bg' =>$data['id_klasifikasi_bg'],
							'id_resiko_kebakaran' =>$id_resiko_kebakaran,
							'id_permanensi' =>$id_permanensi,
							'id_zona_gempa' =>$id_zona_gempa,
							'id_lokasi' =>$id_lokasi,
							'id_ketinggian_bg' =>$id_ketinggian_bg,
							'id_kepemilikan' =>$id_kepemilikan,
							'id_waktu_penggunaan' =>$id_waktu_penggunaan,
							'harga_satuan' =>$harga_satuan,
							'retribusi_manual' =>$besar_retribusi,
							'id_cara_penetapan' =>$id_cara_penetapan,
							'dir_file_perhitungan' =>$lampiran3
							);


					if (empty($id_penetapan_retribusi) || trim($id_penetapan_retribusi) == '' || $id_penetapan_retribusi==null || $id_penetapan_retribusi=='0') {

						try {
							$this->mretribusi->insert_data_penetapan_retribusi($dataIn);
							if (trim($id_permohonan) != '') {
								$tgl_log = date('Y-m-d');
								$keterangan = 'Penetapan Retribusi';
								$nama_fb = 'Penetapan Retribusi';
								$kode_feedback = '30';

								$data_log = array (
											'id_permohonan' => $id_permohonan,
											'tgl_log_permohonan' => $tgl_log,
											'keterangan' => 'Penetapan Retribusi',
											'kode_proses' => 7,
											'dir_file_proses' => $lampiran3
										);
								$dataStatus = array(
									'status' => 10,
								);
								$this->mpermohonan->update_permohonan($dataStatus,$id_permohonan);
								$this->mpermohonan->insert_log_permohonan($data_log);
								//feedback to oss
								//$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);

							}
							$this->session->set_flashdata('message','Berhasil Menetapkan Retribusi.');
							$this->session->set_flashdata('status','success');
						}
						catch (Exception $e) {
							$this->session->set_flashdata('message','Gagal Menetapkan Retribusi.');
							$this->session->set_flashdata('status','danger');
						}

					}else{
						try {
							$this->mretribusi->update_data_penetapan_retribusi($dataIn,$id_penetapan_retribusi);
							$this->session->set_flashdata('pesan', 'Retribusi Berhasil Disimpan');
							$this->session->set_flashdata('status','success');
						}
						catch (Exception $e) {
							$this->session->set_flashdata('message','Gagal Menyimpan Retribusi.');
							$this->session->set_flashdata('status','danger');
						}
					}
				}
			//}
			redirect('retribusi/retribusi_form/'.$id_permohonan);
		}

		if($this->input->post('save_skrd')) {
			$id_skrd = $this->input->post('id_skrd');
			$no_skrd = $this->input->post('no_skrd');
			$tgl_skrd = $this->input->post('tanggal_skrd');
			$email	 = $this->input->post('email');
			$noreg	 = $this->input->post('noreg');
			$retribusiXx	 = $this->input->post('retribusiXx');
			
			//Upload file Hitung Manual
				$file_element_name = 'd_file';
				$lam = $this->input->post('dir_file');
				$filename = $_FILES['d_file']['name'];
				
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/IMB/pengajuan_imb/$id_permohonan/skrd/";
				if (!file_exists($dirPath)){
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				
				$config_file['upload_path'] 		= $dirPath;
				$config_file['allowed_types'] 		= 'pdf';
				$config_file['max_size']			= '10240';
				$config_file['encrypt_name']		= TRUE;
				
			
				
				$this->load->library('upload', $config_file);
				$this->upload->initialize($config_file);
			//End Upload
			if ((!$this->upload->do_upload($file_element_name)) && ($lam != '') ){
				$this->session->set_flashdata('message','SKRD Gagal Disimpan.');
				$this->session->set_flashdata('status','danger');
			}else {

				if($lam != ''){
					$file=$this->upload->data();
					$lampiran=$file['file_name'];
				}else{
					$lampiran=$this->input->post('dir_file_edit');
				}
			$dataIn = array (
				 'id_permohonan' =>$id_permohonan,
				 'no_skrd' =>$no_skrd,
				 'tgl_skrd' =>tgl_ind_to_eng($tgl_skrd),
				 'file_skrd' =>$lampiran
				);

			if (empty($id_skrd) || trim($id_skrd) == '' || $id_skrd==null || $id_skrd=='0') {
				try {
					$this->mretribusi->insert_skrd($dataIn);
					if (trim($id_permohonan) != '') {
						$tgl_log = date('Y-m-d');
						$keterangan = 'Pembayaran Retribusi';
						$nama_fb = 'Pembayaran Retribusi';
						$kode_feedback = '30';
						$data_log = array (
							'id_permohonan' => $id_permohonan,
							'tgl_log_permohonan' => $tgl_log,
							'keterangan' => 'Pembayaran Retribusi',
							'kode_proses' => 8,
							'dir_file_proses' => $lampiran
						);
						$dataStatus = array(
									'status' => 11,
									'status_progress' => 12,
								);
						$this->mpermohonan->update_permohonan($dataStatus,$id_permohonan);
						$this->mpermohonan->insert_log_permohonan($data_log);
						
						$this->kirim_email_skrd($id_permohonan,$tgl_skrd,$keterangan,$email,$noreg,$lampiran,$retribusiXx);
						
						//feedback to oss
						//$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
						
					}
				}
				catch (Exception $e) {
					$this->session->set_flashdata('message','SKRD Gagal Disimpan.');
					$this->session->set_flashdata('status','danger');
				}

			}else{
				try {
					$this->mretribusi->update_skrd($dataIn,$id_skrd);
					//$this->session->set_flashdata('pesan', 'Data Berhasil Diupdate');
					$this->session->set_flashdata('message','Berhasil Menyimpan SKRD.');
					$this->session->set_flashdata('status','success');
					}
				catch (Exception $e) {
					$this->session->set_flashdata('message','Gagal Menyimpan SKRD.');
					$this->session->set_flashdata('status','danger');
					}
				}
			}
			redirect('retribusi/retribusi_form/'.$id_permohonan);
		}

		if($this->input->post('save_ssrd')) {
			if ($this->input->post('status_validasi_cetak') == 1) {
				$this->load->model('mpenerbitan_imb');
				$ttd = $this->mpermohonan->get_pejabat_ttd($id_permohonan);
				$ttd_pejabat_sk = $ttd['kepala_dinas'];
				$nip_pejabat_sk = $ttd['nip_kepala_dinas'];
				$sk_imb = $this->sk_imb($id_permohonan);
				$tgl_sk_imb = date('Y-m-d');
				$status_validasi_cetak = $this->input->post('status_validasi_cetak');
				

				$dataIn_imb = array(
					'id_permohonan' => $id_permohonan,
					'no_imb' => $sk_imb,
					'tgl_imb' => $tgl_sk_imb,
					'validasi_retribusi'=>$this->input->post('status_validasi_cetak'),
					'ttd_pejabat_sk' => $ttd_pejabat_sk,
					'nip_pejabat_sk' => $nip_pejabat_sk
					
				);
				$dataStatus = array(
					'status' => 13,
					'status_progress' => 14,
					);
				$this->mpermohonan->update_permohonan($dataStatus,$id_permohonan);
				$this->mpenerbitan_imb->insert_data_penerbitan_imb($dataIn_imb);
				
				$this->load->library('ciqrcode'); //pemanggilan library QR CODE
				$config['imagedir']     = 'file/IMB/qr_imb/'; //direktori penyimpanan qr code
				$config['quality']      = true; //boolean, the default is true
				$config['size']         = '1024'; //interger, the default is 1024
				$config['black']        = array(224,255,255); // array, default is array(255,255,255)
				$config['white']        = array(70,130,180); // array, default is array(0,0,0)
				$this->ciqrcode->initialize($config);
				$image_name=$sk_imb.'.png'; //buat name dari qr code sesuai dengan nim
				//$params['data'] = 'http://simbg.pu.go.id/admin/lacak/lacak_berkas/'.$sk_imb; //data yang akan di jadikan QR CODE
			 	$params['data'] = 'http://simbg.pu.go.id/main/VerifikasiBerkas/'.$sk_imb; //data yang akan di jadikan QR CODE
			 	
				$params['level'] = 'H'; //H=High
			 	$params['size'] = 10;
			 	$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/

				$data['QR'] = $this->ciqrcode->generate($params);
			}

			$id_ssrd = $this->input->post('id_ssrd');
			$no_ssrd = $this->input->post('no_ssrd');
			$tgl_ssrd = $this->input->post('tanggal_ssrd');
			$email	 = $this->input->post('email');
			$noreg	 = $this->input->post('noreg');
			$retribusiXx	 = $this->input->post('retribusiXx');
			$dirXXX	 = $this->input->post('dir_file_edit_s');
			
			//Upload file Hitung Manual
				$file_element_name2 = 'd_file_s';
				$lam2 = $this->input->post('dir_file_s');
				//$filename2 = $_FILES['d_file_s']['name'];
				
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/IMB/pengajuan_imb/$id_permohonan/ssrd/";
				if (!file_exists($dirPath)){
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				
				$config_file2['upload_path'] 		= $dirPath;
				$config_file2['allowed_types'] 		= 'pdf';
				$config_file2['max_size']			= '10240';
				$config_file2['encrypt_name']		= TRUE;
				
			
				
				$this->load->library('upload', $config_file2);
				$this->upload->initialize($config_file2);
				//End Upload
				
			if ((!$this->upload->do_upload($file_element_name2)) && ($lam2 != '') ){
				$data['err_msg'] = $this->upload->display_errors('','');
				$this->session->set_flashdata('message','SSRD Gagal Disimpan.');
				$this->session->set_flashdata('status','danger');
			}else {

				if($lam2 != ''){
					$file2=$this->upload->data();
					$lampiran2=$file2['file_name'];
				}else{
					$lampiran2=$this->input->post('dir_file_edit_s');
				}
			$dataIn = array (
				 'id_permohonan' =>$id_permohonan,
				 'no_ssrd' =>$no_ssrd,
				 'tgl_ssrd' =>tgl_ind_to_eng($tgl_ssrd),
				 'file_ssrd' =>$lampiran2
				);
			$dataUn = array (
				 'id_permohonan' =>$id_permohonan,
				 'no_ssrd' =>$no_ssrd,
				 'tgl_ssrd' =>tgl_ind_to_eng($tgl_ssrd)
				 
			);
			if (empty($id_ssrd) || trim($id_ssrd) == '' || $id_ssrd==null || $id_ssrd=='0') {

				try {
					$this->mretribusi->insert_ssrd($dataIn);
					if (trim($id_permohonan) != '') {
						$tgl_log = date('Y-m-d');

						$keterangan = 'Pembayaran Retribusi Terkonfirmasi';
						$nama_fb = 'Pembayaran Retribusi Terkonfirmasi';
						$kode_feedback = '50';
						$kd_akun = '';
						$kd_penerimaan = '';
						$nominal = '';
						$data_log = array (
							'id_permohonan' => $id_permohonan,
							'tgl_log_permohonan' => $tgl_log,
							'keterangan' => $keterangan,
							'kode_proses' => 9,
							'dir_file_proses' => $lampiran2
						);
						$this->mpermohonan->insert_log_permohonan($data_log);
						
						$this->kirim_email_ssrd($id_permohonan,$tgl_ssrd,$keterangan,$email,$noreg,$lampiran2,$retribusiXx,$dirXXX);
						
						//feedback to oss
						//$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
						//Feedback To OSS Finasl Status
						//$feedback_final = $this->oss_lib->receiveLicense($id_permohonan,$kode_feedback,$keterangan,$kd_akun,$kd_penerimaan,$nominal);
					}
					
				}
				catch (Exception $e) {
					$this->session->set_flashdata('message','SSRD Gagal Disimpan.');
					$this->session->set_flashdata('status','danger');
				}
			}else{
				try {
					$this->mretribusi->update_ssrd($dataUn,$id_ssrd);
					if (trim($id_permohonan) != '') {
						$tgl_log = date('Y-m-d');

						$keterangan = 'Pembayaran Retribusi Terkonfirmasi';
						$nama_fb = 'Pembayaran Retribusi Terkonfirmasi';
						$kode_feedback = '50';
						$kd_akun = '';
						$kd_penerimaan = '';
						$nominal = '';
						$data_log = array (
							'id_permohonan' => $id_permohonan,
							'tgl_log_permohonan' => $tgl_log,
							'keterangan' => $keterangan,
							'kode_proses' => 9,
							'dir_file_proses' => $lampiran2
						);
						$this->mpermohonan->insert_log_permohonan($data_log);
						
						$this->kirim_email_ssrd($id_permohonan,$tgl_ssrd,$keterangan,$email,$noreg,$lampiran2,$retribusiXx,$dirXXX);
						
						//feedback to oss
						//$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
						//Feedback To OSS Finasl Status
						//$feedback_final = $this->oss_lib->receiveLicense($id_permohonan,$kode_feedback,$keterangan,$kd_akun,$kd_penerimaan,$nominal);
					}
					
				}
				catch (Exception $e) {
					$this->session->set_flashdata('message','Gagal Menyimpan SSRD.');
					$this->session->set_flashdata('status','danger');
					}
				}
			}
			
			redirect('retribusi/retribusi_form/'.$id_permohonan);
		}
		$this->load->model('mpenerbitan_imb');
		$validasi_retri = $this->mpenerbitan_imb->validasi_retribusi_form($id_permohonan)->row_array();
		// $data['validasi_retri'] = $validasi_retri['validasi_retribusi'];
		$data['validasi_retri'] = isset($validasi_retri['validasi_retribusi']);

		$data['mretribusi'] = $this;
		$data['title']		=	'Penetapan Retribusi';
		$data['heading']		=	'';
		$data['content']	= $this->load->view('retribusi/retribusiform',$data,TRUE);
		$this->load->view('backend_adm',$data);
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

	function delete_file_skrd($file_id)
	{
		if ($this->mretribusi->delete_file_skrd($file_id))
		{
			$status = 'success';
			$msg = 'File successfully deleted';
		}
		else
		{
			$status = 'error';
			$msg = 'Something went wrong when deleteing the file, please try again';
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	function delete_file_perhitungan_retibusi($file_id)
	{
		if ($this->mretribusi->delete_file_retribusi($file_id))
		{
			$status = 'success';
			$msg = 'File successfully deleted';
		}
		else
		{
			$status = 'error';
			$msg = 'Something went wrong when deleteing the file, please try again';
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));

	}

	function delete_file_ssrd($file_id)
	{
		if ($this->mretribusi->delete_file_ssrd($file_id))
		{
			$status = 'success';
			$msg = 'File successfully deleted';
		}
		else
		{
			$status = 'error';
			$msg = 'Something went wrong when deleteing the file, please try again';
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	function popup_detail_retribusi()
	{
		$this->killSession();
		$id_permohonan = $this->uri->segment(3);
		$data['id_permohonan'] = $id_permohonan;

		if(trim($id_permohonan) != '' && trim($id_permohonan) != '') {
			$query = $this->mpermohonan->get_detail_imb($id_permohonan);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['statusaha'] = $mydata['id_jenis_usaha'];
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
				$data['jns_bangunan'] = $mydata['jns_bangunan'];
				$data['nama_permohonan'] = $mydata['nama_permohonan'];
				$data['lantai_bg'] = $mydata['lantai_bg'];
				$data['tinggi_bg'] = $mydata['tinggi_bg'];
				$data['luas_bg'] = $mydata['luas_bg'];
				$data['luas_tanah'] = $mydata['luas_tanah'];
				$data['alamat_bg'] = $mydata['alamat_bg'];
				$data['nama_kecamatan'] = $mydata['nama_kecamatan'];
				$data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
				$data['nama_provinsi_bg'] = $mydata['nama_provinsi_bg'];
				$data['id_pemanfaatan_bg'] = $mydata['id_pemanfaatan_bg2'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['id_klasifikasi_bg'] = $mydata['id_klasifikasi_bg'];
				$data['tgl_permohonan'] =  tgl_eng_to_ind($mydata['tgl_permohonan']);
				$data['id_jenis_bg'] = $mydata['id_jenis_bg'];
				$data['id_prasarana_bg'] = $mydata['id_prasarana_bg'];
				$data['tinggi_prasarana'] = $mydata['tinggi_prasarana'];
				$data['retribusi'] = $mydata['retribusi'];
				if($mydata['retribusi'] != 0 && $mydata['retribusi'] != null){
					$retribusi = $mydata['retribusi'];
				}else{
					$retribusi = $mydata['retribusi_manual'];
				}
			}
		}
		//get data penjadwalan
		$que2 = $this->mpermohonan->get_dtail_tanah($id_permohonan);
		$data['jmltanah'] = $que2->num_rows();
		$data['result_tanah'] = $que2->result_array();

		if(trim($id_permohonan) != ''){
		$query = $this->mpenjadwalan->get_data_penjadwalan($id_permohonan,null);
		$data['jumdata_penjadwalan'] = $query->num_rows();
		$data['results_penjadwalan'] = $query->result_array();
		}
		$que = $this->mpenugasan->get_data_penugasan($id_permohonan);
		$data['jmlPegawai'] = $que->num_rows();
		$data['result_peg'] = $que->result_array();

		$data['head_title'] = '.:: Detail Retribusi::.';
		$this->template->load('popup_template','retribusi/detail_retribusi',$data);

	}

	function unduh_lampiran()
	{
		$data['head_title'] = '.::  Cetak Surat Lampiran ::.';
		$this->load->view('retribusi/lampiran_retribusi',$data);
	}
	
	function sk_imb($id=null)
	{
	    $que = $this->mpermohonan->get_id_kabkot($id);
			$id_skrg = $que['id_kabkot_bg'];
			$no_reg_awal = $que['id_kec_bg'];
			$tgl_disetujui = date('d').date('m').date('Y');;
			$mydata2 = $this->mpermohonan->get_imb_akhir($id_skrg,$tgl_disetujui);
	    if(count($mydata2)>0){
	      $no_baru = SUBSTR($mydata2['no_registrasi_baru'],-2)+1;
	      if ($no_baru < 10){
					$sk_imb = "SK-IMB-".$no_reg_awal."-".$tgl_disetujui."-0".$no_baru;
	      }else {
	        $sk_imb = "SK-IMB-".$no_reg_awal."-".$tgl_disetujui."-".$no_baru;
	      }
	    } else {
	      $sk_imb = "SK-IMB-".$no_reg_awal."-".$tgl_disetujui."-01";
	    }
			return $sk_imb;
	}
	
	function receiveLicense ($id_permohonan,$kode_status,$keterangan)
	{
		$id_permohonan ='5645';
		
		
		
		$Feedback = array();
		$this->ci->load->model('oss_lib_model','ossmod');
		$key = $this->sendSecurityKey();
		
		if($id_permohonan != '' || $id_permohonan != null)
		{
			$query = $this->ci->ossmod->get_selesai($id_permohonan);
			if ($query->num_rows() == 1)
			{
				$data = $query->row_array();
				
				$dataFeedback = array (
					'nomor_registrasi' => $data['nomor_registrasi'],
					'nib' => $data['nib'],
					'oss_id' => $data['oss_id'],
					'kd_izin' => $data['kd_izin'],
					'nomor_izin' => $data['nomor_izin'],
					'tgl_terbit_izin' => $data['tgl_terbit_izin'],
					'tgl_berlaku_izin' => $data['tgl_berlaku_izin'],
					//'nama_ttd' => $data['nama_ttd'],
					//'nip_ttd' => $data['nip_ttd'],
					'jabatan_ttd' => $data['jabatan_ttd'],
					'status_izin' => $kode_status,
					//'file_izin' => base_url() . index_page()."file/IMB/pengajuan_imb/".$id_permohonan."/imb_n_lampiran/".$data['file_izin'],
					'file_izin' => base_url() . index_page()."penerbitan/cetak_form_imb/".$id_permohonan,
					'keterangan' => $keterangan
				);
				$Feedback['IZINFINAL'] = $dataFeedback;
				//Action FeedBack
				
				$curl = curl_init();
				
				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://services.oss.go.id/receiveLicense",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_SSL_VERIFYPEER => false,
					CURLOPT_SSL_VERIFYHOST => false,
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => json_encode($Feedback),
					CURLOPT_HTTPHEADER => array(
						"content-type: application/json",
						"oss-api-key: ".$key						
					),
				));
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
					return "cURL Error #:" . $err;
				} else {
					return $response;
				}
				//End Action FeedBack
			}
		}else{
			return "nomor registrasi null";
		}
	}
	
	function kirim_email_skrd($id_permohonan,$tgl_skrd,$keterangan,$email,$noreg,$lampiran,$retribusiXx)
	{
		$email_pemohon = $email;
		//$nomor_registrasi = "";
		$text_email = "";
		$this->load->library('PHPMailerAutoload');
        $mail = new PHPMailer();
		$mail->SMTPDebug = false;
        $mail->Debugoutput = 'html';
		// set smtp
        $mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
        $mail->Username = 'simbgcs@gmail.com';
        $mail->Password = 'cssimbg88';
        $mail->WordWrap = 50;  
		
		if( ! is_null($id_permohonan) && (trim($id_permohonan) != '') && (trim($id_permohonan) != '0')) {
			
			//$text_email .= "Lampiran Surat Ketetapan Retribusi Daerah  :<br>";
			$text_email .= "Nomor Registrasi :".$noreg."<br>";
			$text_email .= "Dengan Lampiran Surat Ketetapan Retribusi Daerah ini<br>";
			$text_email .= "Menyatakan Retribusi Sebesar Rp.".$retribusiXx.",- <br>";
			$text_email .= "diharapkan pemohon untuk membayar sebagaimana retribusi yang terlampir. <br>";
			
			
			//if($dir_file_undangan != ''){
			if( ! is_null($lampiran) && (trim($lampiran) != '')) {
				$file = realpath('./file/IMB/pengajuan_imb/'.$id_permohonan.'/skrd/'.$lampiran);
				$mail->AddAttachment( $file, 'LampiranSKRD.pdf' );
			}
			
			
			$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
			$mail->addAddress($email_pemohon);
			$mail->Subject = 'Surat Ketetapan Retribusi Daerah | CS SIMBG';
			
			$mail->Body = $text_email;
			$mail->isHTML(true); 
        
			$mail->send();
			
			$this->session->set_flashdata('message','SKRD Berhasil Disimpan.');
			$this->session->set_flashdata('status','success');
		}
	}
	
	function kirim_email_ssrd($id_permohonan,$tgl_ssrd,$keterangan,$email,$noreg,$lampiran2,$retribusiXx,$dirXXX)
	{
		$email_pemohon = $email;
		//$nomor_registrasi = "";
		$text_email = "";
		$this->load->library('PHPMailerAutoload');
        $mail = new PHPMailer();
		$mail->SMTPDebug = false;
        $mail->Debugoutput = 'html';
		// set smtp
        $mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
        $mail->Username = 'simbgcs@gmail.com';
        $mail->Password = 'cssimbg88';
        $mail->WordWrap = 50;  
		
		if( ! is_null($id_permohonan) && (trim($id_permohonan) != '') && (trim($id_permohonan) != '0')) {
			
			//$text_email .= "Lampiran Surat Ketetapan Retribusi Daerah  :<br>";
			$text_email .= "Nomor Registrasi :".$noreg."<br>";
			$text_email .= "Dengan Lampiran Surat Setoran Retribusi Daerah ini<br>";
			$text_email .= "Menyatakan Pembayaran Retribusi Sebesar Rp.".$retribusiXx.",-  telah Terkonfirmasi pada tanggal ".$tgl_ssrd."<br>";
			$text_email .= "dan menunggu proses Verifikasi Kepala Dinas sebelum IMB diserahkan oleh DPMPTSP. <br>";
			
			
			//if($dir_file_undangan != ''){
			if( ! is_null($lampiran2) && (trim($lampiran2) != '')) {
				$file = realpath('./file/IMB/pengajuan_imb/'.$id_permohonan.'/ssrd/'.$lampiran2);
				$mail->AddAttachment( $file, 'LampiranSSRD.pdf' );
			}else{
				$file = realpath('./file/IMB/pengajuan_imb/'.$id_permohonan.'/ssrd/'.$dirXXX);
				$mail->AddAttachment( $file, 'LampiranSSRD.pdf' );
			}
			
			
			$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
			$mail->addAddress($email_pemohon);
			$mail->Subject = 'Konfirmasi Pembayaran Retribusi IMB | CS SIMBG';
			
			$mail->Body = $text_email;
			$mail->isHTML(true); 
        
			$mail->send();
			
			$this->session->set_flashdata('message','SSRD Berhasil Disimpan.');
			$this->session->set_flashdata('status','success');
		}
	}

}
