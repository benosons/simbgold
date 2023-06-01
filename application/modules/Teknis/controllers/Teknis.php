<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Teknis extends CI_Controller {
	
	protected $pathBerkas = 'public/uploads/pengajuan/persyaratan/';
    protected $pathPerbaikan = 'public/uploads/penilaian/perbaikan/';
    protected $pathBerita = 'public/uploads/penilaian/berita_acara/';
    protected $pathInspeksi = 'public/uploads/inspeksi/pemeriksaan/';
    protected $pathBeritaInspeksi = 'public/uploads/inspeksi/berita_acara/';
    protected $pathJustifikasi = 'public/uploads/inspeksi/justifikasi/';
    protected $pathCatatan = 'public/uploads/inspeksi/catatan/';

    public function __construct()
    {
		parent::__construct();
		$this->load->helper('utility');
		$this->load->model('Mteknis');
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->load->model('mglobal');
		$this->load->library('Simbg_lib');
		$this->load->library('Oss_lib');
        $this->simbg_lib->check_session_login();
	}
	
	function index(){
	}
	//Begin Verifikasi Operator
	public function Verifikasi()
	{
		$SQLcari 	= "";
		$data['Verifikasi'] = $this->Mteknis->getListVerifikator(null,$SQLcari);
		$data['content']	= $this->load->view('Verifikasi/VerifikasiList',$data,TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}
	
	public function FormVerifikasi()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->Mteknis->getDataVerifikator($id);
		$data['data'] 		= $query->row();
        $query2             = $this->Mteknis->getDataBangunan($id);
        $data['Bangunan']   = $query2->row();
		$data['DataTanah']	= $this->Mteknis->getTanahVerifikasi($id);
		$data['DataHis']	= $this->Mteknis->getHis('a.*, b.status_admin,c.username', $id);
		$this->getDataUmum();
		$this->getDataTanah();
		$this->getDataArsitektur();
		$this->getDataStruktur();
		$this->getDataMEP();
		$permohonan = $this->Mteknis->getDataJnsKonsultasi('a.*',$id)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		//Begin Data Teknis Tanah
		$data['DataTeknisTanah']	= $this->Mteknis->getDataDokumen('a.*',$id);
		$filterQuery				= 'b.id_detail, b.id_syarat, c.nm_dokumen,c.keterangan';
		$data['DataUmumTanah']		= $this->Mteknis->getDataTanah($filterQuery,$id_jenis_permohonan);
		//End Data Teknis Tanah
		$this->load->view('Verifikasi/FormVerifikasi', $data);
	}
	
	function getDataTanah()
	{
		$id= $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mteknis->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mteknis->getSyaratList($id_j_per,'1',null);			
		$data['jum_data'] = $query->num_rows();		
		$data['results_tnh'] = $query->result();
		$this->load->view('kosong',$data);
	}
	
	function getDataUmum()
	{
		$id= $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mteknis->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mteknis->getSyaratList($id_j_per,'5',null);			
		$data['jum_data'] = $query->num_rows();		
		$data['results_umum'] = $query->result();
		$this->load->view('kosong',$data);
	}
	
	public function getDataArsitektur()
	{
		$id= $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mteknis->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mteknis->getSyaratList($id_j_per,'2',null);			
		$data['jum_data'] = $query->num_rows();		
		$data['results_Ars'] = $query->result();
		$this->load->view('kosong',$data);
	}
	
	public function getDataStruktur()
	{
		$id= $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mteknis->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mteknis->getSyaratList($id_j_per,'3',null);			
		$data['jum_data'] = $query->num_rows();		
		$data['results_Str'] = $query->result();
		$this->load->view('kosong',$data);
	}
	
	public function getDataMEP()
	{
		$id= $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->Mteknis->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->Mteknis->getSyaratList($id_j_per,'4',null);			
		$data['jum_data'] = $query->num_rows();		
		$data['results_MEP'] = $query->result();
		$this->load->view('kosong',$data);
	}
	
	public function check_status_tanah()
	{
		$id= $this->uri->segment(3);
		$id_detail= $this->uri->segment(4);
		$data['id'] = $id;
		$dataIn = array ('status_verifikasi_tanah' => '1');
		try
		{
			$this->Mteknis->updateVerifikasiTanah($dataIn,$id_detail);
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		}catch(Exception $e) 
		{
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
	}
	public function uncheck_status_tanah()
	{
		$id= $this->uri->segment(3);
		$id_detail= $this->uri->segment(4);
		$data['id'] = $id;
		$dataIn = array ('status_verifikasi_tanah' => null);
		try
		{
			$this->Mteknis->updateVerifikasiTanah($dataIn,$id_detail);
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		}catch(Exception $e) 
		{
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
	}
	
	function check_status()
	{
		$id= $this->uri->segment(3);
		$id_persyaratan_detail= $this->uri->segment(4);
		$key_syarat = $this->uri->segment(5);
		$data['id'] = $id;
		$dataIn = array ('status' => '1');
		try
		{
			$id_detail =  $this->Mteknis->updateValidasi($dataIn,$id,$id_persyaratan_detail);
			if($id_detail != $id_persyaratan_detail){
				$dataIsi = array (
						'id' => $id,
						'id_persyaratan_detail' => $id_persyaratan_detail,
						'status' => '1'
						);
				$this->Mteknis->insert_syarat($dataIsi); // Sudah tersedia
			}
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
			
		}catch(Exception $e) 
		{
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
		$permohonan = $this->Mteknis->getPermohonan($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$data['pernyataan'] = $permohonan['pernyataan'];
		$queryCekJum_syarat = $this->Mteknis->getSyaratList($id_j_per,null)->result();
		if($key_syarat == 'adm'){
			$query = $this->Mteknis->getSyaratList($id_j_per,'1');
		}else if ($key_syarat == 'tek'){
			$query = $this->Mteknis->getSyaratList($id_j_per,'2');
		}
		$data['jum_data'] = $query->num_rows();		
		$data['results'] = $query->result();
		$data['model_permohonan'] = $this->Mteknis;
	}
	
	function uncheck_status()
	{
		$id= $this->uri->segment(3);
		$id_persyaratan_detail= $this->uri->segment(4);
		$key_syarat = $this->uri->segment(5);
		$data['id'] = $id;
		$dataIn = array ('status' => null);
		try {
			$this->Mteknis->updateValidasi($dataIn,$id,$id_persyaratan_detail);
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		}catch(Exception $e) {
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
		$permohonan = $this->Mteknis->getPermohonan($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$data['pernyataan'] = $permohonan['pernyataan'];
		$queryCekJum_syarat = $this->Mteknis->getSyaratList($id_j_per,null)->result();
		if($key_syarat == 'adm'){
			$query = $this->Mteknis->getSyaratList($id_j_per,'1');
		}else if ($key_syarat == 'tek'){
			$query = $this->Mteknis->getSyaratList($id_j_per,'2');
		}
		$data['jum_data'] = $query->num_rows();		
		$data['results'] = $query->result();
		$data['model_permohonan'] = $this->Mteknis;
	}
	
	public function status_dt_teknis()
	{
		$user_id		= $this->session->userdata('loc_user_id');
		$user_id		= $this->Outh_model->Encryptor('decrypt', $user_id);
		$status			= $this->input->post('status_syarat');
		$no_surat		= $this->input->post('no_surat');
		$catatan		= $this->input->post('catatan');
		$id_pemilik		= $this->input->post('id_pemilik');
		$email			= $this->input->post('email');
		$no_konsultasi	= $this->input->post('no_konsultasi');
		$tgl_skrg 		= date('Y-m-d');
		if ($status == '1') {
			$data	= array(
				'tgl_status' => $tgl_skrg,
				'status' => '4',
				'no_surat' => $no_surat,
				'id' => $id_pemilik,
				'catatan' => $catatan,
				'user_id' => $user_id,
				'modul' => 'verifikasi'
			);
		} else {
			$data	= array(
				'tgl_status' => $tgl_skrg,
				'status' => '3',
				'no_surat' => $no_surat,
				'id' => $id_pemilik,
				'catatan' => $catatan,
				'user_id' => $user_id,
				'modul' => 'verifikasi'
			);
		}
		$this->Mglobals->setData('tmdatabangunan', ['status' => $data['status']], 'id', $id_pemilik);
		$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
		$this->session->set_flashdata('status', 'success');
		$email = "$email";
		$no_konsultasi = "$no_konsultasi";
		$catatan = "$catatan";
		$subject 	= "Status Verifikasi $no_konsultasi";
		$text 		= "";
		$text .= "Yth Bapak/Ibu,<br>";
		$text .= "<br>";
		$text .= "Dengan ini kami memberitahukan bahwa Permohonan dengan No.Registrasi $no_konsultasi <br>";
		$text .= "$catatan<br>";
		$text .= "<br>";
		$text .= "<br>";
		$text .= "<br>";
		$text .= "Hormat Kami <br>";
		$text .= "Admin SIMBG ";
		if($status == '1'){
			$this->simbg_lib->sendEmail($email,$subject, $text);
		}else{
			$this->simbg_lib->sendEmail($email,$subject, $text);
		}
		redirect('Teknis/Verifikasi');
	}
	// End Verifikasi Operator
	//Begin Data Penugasan TPA

    public function Penugasan()
	{
		$id_fungsi_bg = $this->input->get('id_fungsi_bg', TRUE);
		$id_proses = $this->input->get('id_proses', TRUE);
		$tanggalawal = $this->input->get('tanggalawal', TRUE);
		$tanggalakhir = $this->input->get('tanggalakhir', TRUE);
		$SQLcari 	= "";
		$data['title']		=	'';
		$data['heading']	=	'';
		$search = $this->search([$id_fungsi_bg, $id_proses, $tanggalawal, $tanggalakhir]);
		$data['Penugasan'] = !isset($_GET['cari']) ? $this->Mteknis->getListPenugasanDokDInas(null, $SQLcari)->result() : $search;
		$this->template->load('template/template_backend', 'Teknis/Penugasan/PenugasanList', $data);
	}


	public function FormPenugasan()
	{
		$id = $this->input->post('id', TRUE);
		// var_dump($id); die;
		$cekDataBangunan = $this->Mteknis->cekDataBangunan($id);
		if ($cekDataBangunan->num_rows() > 0) {
			$row = $cekDataBangunan->row();
			$tgl_pernyataan = $row->tgl_pernyataan;

			$LuasBg = 0;
			$id_jenis_permohonan = $row->id_jenis_permohonan;
			if ($id_jenis_permohonan == 11) {
				$tipeA = $row->tipeA;
				$luasA = $row->luasA;
				$tinggiA = $row->tinggiA;
				$lantaiA = $row->lantaiA;
				$jumlahA = $row->jumlahA;
				$tipe = json_decode($tipeA);
				$luas = json_decode($luasA);
				$tinggi = json_decode($tinggiA);
				$lantai = json_decode($lantaiA);
				$jumlah = json_decode($jumlahA);

				$bangunan_kolektif = [];
				foreach ($tipe as $noo => $val) {
					$bangunan_kolektif['tipe'][$noo] = $val != '' ? $val : 0;
				}
				foreach ($luas as $noo => $val) {
					$bangunan_kolektif['luas'][$noo] = $val != '' ? $val : 0;
				}
				foreach ($tinggi as $noo => $val) {
					$bangunan_kolektif['tinggi'][$noo] = $val != '' ? $val : '';
				}

				if (!empty($lantai)) {
					foreach ($lantai as $noo => $val) {
						$bangunan_kolektif['lantai'][$noo] = $val != '' ? $val : '';
					}
				}

				if (!empty($jumlah)) {
					foreach ($jumlah as $noo => $val) {
						$bangunan_kolektif['jumlah'][$noo] = $val != '' ? $val : '';
					}
				}
				$no = 0;
				$hasil_kolektif = [];
				if (!empty($bangunan_kolektif)) {
					foreach ($bangunan_kolektif['tipe'] as $val) {
						$no++;
						$tipe_kolektif = !empty($bangunan_kolektif['tipe'][$no]) ? $bangunan_kolektif['tipe'][$no] : '';
						$luas_kolektif = !empty($bangunan_kolektif['luas'][$no]) ? $bangunan_kolektif['luas'][$no] : '';
						$tinggi_kolektif = !empty($bangunan_kolektif['tinggi'][$no]) ? $bangunan_kolektif['tinggi'][$no] : '';
						$lantai_kolektif = !empty($bangunan_kolektif['lantai'][$no]) ? $bangunan_kolektif['lantai'][$no] : '';
						$jumlah_kolektif = !empty($bangunan_kolektif['jumlah'][$no]) ? $bangunan_kolektif['jumlah'][$no] : '';

						$hasil_kolektif[] = [
							'tipe' => $tipe_kolektif,
							'luas' => $luas_kolektif,
							'tinggi' => $tinggi_kolektif,
							'lantai' => $lantai_kolektif,
							'jumlah' => $jumlah_kolektif,
						];
						$hitung_luas = $luas_kolektif == '' ? 0 : $luas_kolektif;
						$hitung_jumlah = $jumlah_kolektif == '' ? 0 : $jumlah_kolektif;
						$LuasBg += $hitung_luas * $hitung_jumlah;
						$luas_total_kolektif  = $LuasBg;
					}
				}
			} else {
				$hasil_kolektif = 0;
				$luas_total_kolektif  = $LuasBg;
			}

            
			$date_plus = new DateTime($tgl_pernyataan);
			$lama_proses = intval($row->lama_proses);
			$date_plus->modify("+{$lama_proses} days");
			$hasil_tgl = $date_plus->format("d-m-Y");
			$tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
			$id_kabkot = $row->id_kabkot_bgn;
			$id_fbg = $row->id_fungsi_bg;
			$id_izin	= $row->id_izin;
			$year = $year = date('Y');
			//if( $id_izin)

			if($id_izin =='2'){
				if( $id_fbg =='1'){
					$get_data_penugasan =  $this->Mteknis->getTimTpt(0, $year); //TPT
					$Petugas = "Pilih Tenaga TPT";
				}else{
					$get_data_penugasan =  $this->Mteknis->getTimTpt(0, $year); //TPT
					$Petugas = "Pilih Tenaga TPT";
				}
					$get_data_penugasan =  $this->Mteknis->getTimTpt(0, $year); //TPT
					$Petugas = "Pilih Tenaga TPT";
			}else{
				if( $id_fbg =='1'){
					$get_data_penugasan =  $this->Mteknis->getTimTpt(0, $year); //TPT
					$Petugas = "Pilih Tenaga TPT";
				}else{
					$get_data_penugasan =  $this->Mteknis->getTimTpa(0, $year); //TPA
					$Petugas = "Pilih Tenaga TPA";
				}
			}
			//$get_data_penugasan = $id_fbg  == 1 ? $this->Mteknis->getTimTpt($id_kabkot, $year) : $this->Mteknis->getTimTpa($id_kabkot, $year);
			$tim_petugas = [];
			// var_dump($get_data_penugasan->result()); die;
			foreach ($get_data_penugasan->result() as $p) {
				$gelar_depan = $p->glr_depan != '' && $p->glr_depan != NULL ? $p->glr_depan . ' ' : '';
				if($id_izin =='2'){
					if( $id_fbg =='1'){
						$gb =  $p->glr_belakang; //TPT
					}else{
						$gb =  $p->glr_belakang; //TPT
					}
						$gb =  $p->glr_belakang; //TPT
				}else{
					if( $id_fbg =='1'){
						$gb =  $p->glr_belakang; //TPT
					}else{
						$gb =  $p->glr_blkg; //TPA
					}
				}
				$gelar_belakang = $gb != '' && $gb != NULL ? $gb . ' ' : '';
				if($id_izin =='2'){
					if( $id_fbg =='1'){
						$nm =  $p->nama_personal; //TPT
					}else{
						$nm =  $p->nama_personal; //TPT
					}
						$nm =  $p->nama_personal; //TPT
				}else{
					if( $id_fbg =='1'){
						$nm =  $p->nama_personal; //TPT
					}else{
						$nm =  $p->nm_tpa; //TPA
					}
				}
				$nama_personal = $nm != '' && $nm != NULL ? $nm : '';
				if($id_izin =='2'){
					if( $id_fbg =='1'){
						$id_p =  $p->id_personal; //TPT
					}else{
						$id_p =  $p->id_personal; //TPT
					}
						$id_p =  $p->id_personal; //TPT
				}else{
					if( $id_fbg =='1'){
						$id_p =  $p->id_personal; //TPT
					}else{
						$id_p =  $p->id_tpanya; //TPA
					}
				}
				$nama_unsur = $id_fbg == 1 ? "{$p->nama_unsur} - {$p->nama_unsur_ahli}" : '-';
				$nama_bidang = $id_fbg == 1 ? "{$p->nama_bidang}" : '-';
				$nama_keahlian = $id_fbg == 1 ? $p->nama_keahlian : '<i>Belum Diisi!</i>';
				$tim_petugas[] = [
					'id_personal' => $id_p,
					'nama_peg' => $gelar_depan . $nama_personal . $gelar_belakang,
					'nama_unsur' => $nama_unsur,
					'nama_bidang' => $nama_bidang,
					'nama_keahlian' => $nama_keahlian == NULL ? '-' : $nama_keahlian
				];
			}

		
			$data = [
				'id_pemilik' => $row->id_pemilik,
				'daftar_tim_penugasan' => $id_fbg == 1 ? 'Pilih' : 'Pilih',
				'no_konsultasi' => $row->no_konsultasi,
				'nm_pemilik' => $row->nm_pemilik,
				'fungsi_bg' => $row->fungsi_bg,
				'almt_bgn' => $row->almt_bgn,
				'nama_kec_bg' => $row->nama_kec_bg,
				'nama_kabkota_bg' => $row->nama_kabkota_bg,
				'nama_provinsi_bg' => $row->nama_provinsi_bg,
				'nm_konsultasi' => $row->nm_konsultasi,
				'alamat' => $row->alamat,
				'nama_kecamatan' => $row->nama_kecamatan,
				'nama_kabkota' => $row->nama_kabkota,
				'nama_prov_pemilik' => $row->nama_prov_pemilik,
				'almt_bgn' => $row->almt_bgn,
				'nama_kec_bg' => $row->nama_kec_bg,
				'nama_kabkota_bg' => $row->nama_kabkota_bg,
				'nama_provinsi_bg' => $row->nama_provinsi_bg,
				'fungsi_bg' => $row->fungsi_bg,
				'luas_bgn' => $row->luas_bgn,
				'tinggi_bgn' => $row->tinggi_bgn,
				'jml_lantai' => $row->jml_lantai,
				'jns_prasarana' => $row->jns_prasarana,
				'luas_bgp' => $row->luas_bgp,
				'tinggi_bgp' => $row->tinggi_bgp,
				'id_jenis_permohonan' => $id_jenis_permohonan,
				'hasil_kolektif' => $hasil_kolektif,
				'luas_total_kolektif' => $luas_total_kolektif,
				'tgl_pernyataan' => $tgl_pernyataan,
				'lama_proses' => $row->lama_proses == NULL ? 0 : $row->lama_proses,
				'hasil_tgl' => $hasil_tgl,
				'tim_petugas' => empty($tim_petugas) ? 0 : $tim_petugas,
				'res' => true,
			];
			header('Content-Type: application/json');
			echo json_encode($data);
		} else {
			$data = [
				'message' => 'Record Not Found!',
				'type' => 'error',
				'res' => false
			];
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}

    public function SimpanPenugasan()
	{
		$statsPenugasan = $this->input->post('statsPenugasan', true);
		$penugasan = $this->input->post('penugasan', TRUE);
		$noKonsultasi = $this->input->post('noKonsultasi', TRUE);
		$idPemilik = $this->input->post('idPemilik', TRUE);
		$petugas = [];
		foreach ($penugasan as $r) {
			$petugas[] = [
				'id_personal' => $r['id'],
				'id_pemilik' => $idPemilik
			];
		}
		$tgl_log = date('Y-m-d');
		$data = array(
			'status' => 5,
			'post_date' => $tgl_log,
			'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
		);
		$this->Mteknis->insertBatchPersonil($petugas);
		$this->Mteknis->updateStats($data, $idPemilik);
        $this->kirimemailstatus($idPemilik);
        $this->kirimemailtotpa($idPemilik);
		$output = [
			'status' => true,
			'type' => 'success',
			'message' => 'Data Penugasan Berhasil Disimpan!',
			'no_konsultasi' => $noKonsultasi,
			'dataId' => $idPemilik,
			'typePenugasan' => $statsPenugasan
		];
		header('Content-Type: application/json');
		echo json_encode($output);
	}
	

	private function search($post = [])
	{
		// var_dump($post); die;
		$fungsi_bg = $post[0];
		$proses = $post[1];
		$d1 = $post[2];
		$d2 = $post[3];
		$tglAwal =  date("Y-m-d", strtotime($d1));
		$tglAkhir = date("Y-m-d", strtotime($d2));
		if ($d1 === "" || $d2 === "") {
			if (intval($proses) === 0 && intval($fungsi_bg) === 0) {
				$SQLcari     = "";
				$query = $this->Mteknis->getDataPenugasan(null, $SQLcari)->result();
			} else if (intval($proses) !== 0 && intval($fungsi_bg) === 0) {
				$query = $this->Mteknis->findProsesWithoutDate($proses)->result();
			} else if (intval($proses) === 0 && intval($fungsi_bg) !== 0) {
				$query = $this->Mteknis->findFungsiWithoutDate($fungsi_bg)->result();
			} else {
				$query = $this->Mteknis->findAllWithoutDate($fungsi_bg, $proses)->result();
			}
		} else {
			if (intval($fungsi_bg) === 0 && intval($proses) === 0) {
				$query = $this->Mteknis->getPenugasanAll($tglAwal, $tglAkhir)->result();
			} else if (intval($fungsi_bg) !== 0 && intval($proses) === 0) {
				$query = $this->Mteknis->findFungsi($fungsi_bg, $tglAwal, $tglAkhir)->result();
			} else if (intval($fungsi_bg) === 0 && intval($proses) !== 0) {
				$query = $this->Mteknis->findProses($proses, $tglAwal, $tglAkhir)->result();
			} else {
				$query = $this->Mteknis->findAll($fungsi_bg, $proses, $tglAwal, $tglAkhir)->result();
			}
		}
	}

	public function SimpanPenugasanTpa()
	{
		$id_pemilik = $this->input->post('id_pemilik');
		$tugas_personil = $this->input->post('tugas');
		if ($tugas_personil != NULL) {
			foreach ($tugas_personil as $key => $val) {
				$res[] = $val;
			}
			$k = array_unique($res);
			$cekPersonil = 	$this->Mteknis->cekPersonalPenugasanTpa($id_pemilik, $k);
			if ($cekPersonil->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Personil Sudah Terpilih!');
				$this->session->set_flashdata('status', 'warning');
				redirect('Penugasan');
			} else {
				foreach ($tugas_personil as $key => $val) {
					$dataP[] = array(
						'id' => $val,
						'id_pemilik' => $id_pemilik
					);
				}
				$tgl_log = date('Y-m-d');
				$data = array(
					'status' => 5,
					'post_date' => $tgl_log,
					'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
				);
				$this->Mteknis->insertBatchPersonilTpa($dataP);
				$this->Mteknis->updateStats($data, $id_pemilik);
				$this->session->set_flashdata('message', 'Data Penugasan Berhasil di Simpan');
				$this->session->set_flashdata('status', 'success');
				$this->kirimemailstatus($id_pemilik);
				$this->kirimemailtotpa($id_pemilik);
				redirect('Teknis/Penugasan');
			}
		} else {
			$this->session->set_flashdata('message', 'Silahkan Pilih Tim Terlebih Dahulu!');
			$this->session->set_flashdata('status', 'warning');
			redirect('Teknis/Penugasan');
		}
	}

	function kirimemailstatus($id)
	{
		$email_pemohon = "";
		$no_konsultasi = "";
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
        $mail->Username = 'simbgcs.reset@gmail.com';
        $mail->Password = '@shinigami07';
        $mail->WordWrap = 50;  
		
		if( ! is_null($id) && (trim($id) != '') && (trim($id) != '0')) {
			$query = $this->Mteknis->getEmailPemohon($id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$email_pemohon = $mydata['email'];
				$no_konsultasi = $mydata['no_konsultasi'];
			}
			$text_email .= "No Registrasi :".$no_konsultasi."<br>";
			$text_email .= "Telah Menetapkan Penugasan TPT Untuk No Registrasi $no_konsultasi<br>";
			$text_email .= "Sebagai TIM TPT untuk permohonan dengan No. Registrasi :".$no_konsultasi."<br>";
			$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
			$mail->addAddress($email_pemohon);
			$mail->Subject = 'Penetapan TIM TPT | CS SIMBG';
			$mail->Body = $text_email;
			$mail->isHTML(true); 
			$mail->send();
		}
	}

	function kirimemailtotpa($id)
	{
		$email_pemohon = "";
		$no_konsultasi = "";
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
        $mail->Username = 'simbgcs.reset@gmail.com';
        $mail->Password = '@shinigami07';
        $mail->WordWrap = 50;  
		
		if( ! is_null($id) && (trim($id) != '') && (trim($id) != '0')) {
			$query = $this->Mteknis->getEmailPemohon($id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$email_pemohon = $mydata['email'];
				$no_konsultasi = $mydata['no_konsultasi'];
			}
			$query = $this->Mteknis->getEmailTpa($id)->result();;
			foreach ($query as $row) 
			{
				$text_email .= "- ".$row->nm_tpa."<br>";
				$mail->AddCC($row->email, $row->nm_tpa);
			}
			$text_email .= "Sebagai TIM TPA untuk permohonan dengan No. Registrasi :".$no_konsultasi."<br>";
			$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
			//$mail->addAddress($email_pemohon);
			$mail->Subject = 'Penetapan TIM TPA | CS SIMBG';
			$mail->Body = $text_email;
			$mail->isHTML(true); 
			$mail->send();
		}
	}
	//End Data Penugasan TPA
	//Begin Data Penjadwalan TPA
	public function Penjadwalan()
	{
		$data = [
			'datapbg' => $this->Mteknis->getDataPenjadwalan()->result(),
			'title' => 'Penjadwalan Konsultasi',
			'heading' => ''
		];
		$this->template->load('template/template_backend', 'Teknis/Penjadwalan/penjadwalan_list', $data);
	}

    
    public function Konsultasi()
	{
		$id = $this->Outh_model->Encryptor('decrypt', $this->input->post('id', TRUE));
		$getId = $this->Mteknis->cekDataBangunan($id);
		if ($getId->num_rows() > 0) {
			$row = $getId->row();
			$LuasBg = 0;
			$id_jenis_permohonan = $row->id_jenis_permohonan;
			if ($id_jenis_permohonan == 11) {
				$tipeA = $row->tipeA;
				$luasA = $row->luasA;
				$tinggiA = $row->tinggiA;
				$lantaiA = $row->lantaiA;
				$jumlahA = $row->jumlahA;
				$tipe = json_decode($tipeA);
				$luas = json_decode($luasA);
				$tinggi = json_decode($tinggiA);
				$lantai = json_decode($lantaiA);
				$jumlah = json_decode($jumlahA);

				$bangunan_kolektif = [];
				foreach ($tipe as $noo => $val) {
					$bangunan_kolektif['tipe'][$noo] = $val != '' ? $val : 0;
				}
				foreach ($luas as $noo => $val) {
					$bangunan_kolektif['luas'][$noo] = $val != '' ? $val : 0;
				}
				foreach ($tinggi as $noo => $val) {
					$bangunan_kolektif['tinggi'][$noo] = $val != '' ? $val : '';
				}

				if (!empty($lantai)) {
					foreach ($lantai as $noo => $val) {
						$bangunan_kolektif['lantai'][$noo] = $val != '' ? $val : '';
					}
				}

				if (!empty($jumlah)) {
					foreach ($jumlah as $noo => $val) {
						$bangunan_kolektif['jumlah'][$noo] = $val != '' ? $val : '';
					}
				}
				$no = 0;
				$hasil_kolektif = [];
				if (!empty($bangunan_kolektif)) {
					foreach ($bangunan_kolektif['tipe'] as $val) {
						$no++;
						$tipe_kolektif = !empty($bangunan_kolektif['tipe'][$no]) ? $bangunan_kolektif['tipe'][$no] : '';
						$luas_kolektif = !empty($bangunan_kolektif['luas'][$no]) ? $bangunan_kolektif['luas'][$no] : '';
						$tinggi_kolektif = !empty($bangunan_kolektif['tinggi'][$no]) ? $bangunan_kolektif['tinggi'][$no] : '';
						$lantai_kolektif = !empty($bangunan_kolektif['lantai'][$no]) ? $bangunan_kolektif['lantai'][$no] : '';
						$jumlah_kolektif = !empty($bangunan_kolektif['jumlah'][$no]) ? $bangunan_kolektif['jumlah'][$no] : '';

						$hasil_kolektif[] = [
							'tipe' => $tipe_kolektif,
							'luas' => $luas_kolektif,
							'tinggi' => $tinggi_kolektif,
							'lantai' => $lantai_kolektif,
							'jumlah' => $jumlah_kolektif,
						];
						$hitung_luas = $luas_kolektif == '' ? 0 : $luas_kolektif;
						$hitung_jumlah = $jumlah_kolektif == '' ? 0 : $jumlah_kolektif;
						$LuasBg += $hitung_luas * $hitung_jumlah;
						$luas_total_kolektif  = $LuasBg;
					}
				}
			} else {
				$hasil_kolektif = 0;
				$luas_total_kolektif  = $LuasBg;
			}

			$countJadwal = $this->Mteknis->getCountJadwal($row->id_pemilik)->num_rows();
			$nextKonsultasi = $countJadwal + 1;
			$getPenjadwalanList = $this->Mteknis->getPenjadwalanById($row->id_pemilik);
			$tgl_pernyataan = $row->tgl_pernyataan;
			$date_plus = new DateTime($tgl_pernyataan);
			$lama_proses = intval($row->lama_proses);
			$date_plus->modify("+{$lama_proses} days");
			$hasil_tgl = $date_plus->format("d-m-Y");
			$tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
			$id_izin = $row->id_izin;
			$id_fbg = $row->id_fungsi_bg;
			if($id_izin =='2'){
				if( $id_fbg =='1'){
					$rew =  $this->Mteknis->getByIdPtugas($id); //TPT
				}else{
					$rew =  $this->Mteknis->getByIdPtugas($id); //TPT
				}
					$rew =  $this->Mteknis->getByIdPtugas($id); //TPT
			}else{
				if( $id_fbg =='1'){
					$rew =  $this->Mteknis->getByIdPtugas($id); //TPT
				}else{
					$rew =  $this->Mteknis->getByIdPtugasTPA($id); //TPA
				}
			}
			//$rew   = $id_fbg == 1 ? $this->Mteknis->getByIdPtugas($id) : $this->Mteknis->getByIdPtugasTPA($id);
			$penugasan = [];
			foreach ($rew->result() as $p) {
				$gelar_depan = $p->glr_depan != '' && $p->glr_depan != NULL ? $p->glr_depan . ' ' : '';
				if($id_izin =='2'){
					if( $id_fbg =='1'){
						$gb =  $p->glr_belakang; //TPT
					}else{
						$gb =  $p->glr_belakang; //TPT
					}
						$gb =  $p->glr_belakang; //TPT
				}else{
					if( $id_fbg =='1'){
						$gb =  $p->glr_belakang; //TPT
					}else{
						$gb =  $p->glr_blkg; //TPA
					}
				}
				$gelar_belakang = $gb != '' && $gb != NULL ? $gb . ' ' : '';
				if($id_izin =='2'){
					if( $id_fbg =='1'){
						$nm =  $p->nama_personal; //TPT
					}else{
						$nm =  $p->nama_personal; //TPT
					}
						$nm =  $p->nama_personal; //TPT
				}else{
					if( $id_fbg =='1'){
						$nm =  $p->nama_personal; //TPT
					}else{
						$nm =  $p->nm_tpa; //TPA
					}
				}
				$nama_personal = $nm != '' && $nm != NULL ? $nm : '';
				if($id_izin =='2'){
					if( $id_fbg =='1'){
						$id_p =  $p->id_personal; //TPT
					}else{
						$id_p =  $p->id_personal; //TPT
					}
						$id_p =  $p->id_personal; //TPT
				}else{
					if( $id_fbg =='1'){
						$id_p =  $p->id_personal; //TPT
					}else{
						$id_p =  $p->id; //TPA
					}
				}
				$nama_unsur = $id_fbg == 1 ? "{$p->nama_unsur} - {$p->nama_unsur_ahli}" : '-';
				$nama_bidang = $id_fbg == 1 ? "{$p->nama_bidang}" : '-';
				$nama_keahlian = $id_fbg == 1 ? $p->nama_keahlian : '<i>Belum Diisi!</i>';
				$penugasan[] = [
					'id_personal' => $id_p,
					'nama_peg' => $gelar_depan . $nama_personal . $gelar_belakang,
					'nama_unsur' => $nama_unsur,
					'nama_bidang' => $nama_bidang,
					'nama_keahlian' => $nama_keahlian
				];
			}
			$data = array(
				'daftar_tim_penugasan' => $id_fbg == 1 ? 'Nama Tim TPT' : 'Nama Tim TPA',
				'nextKonsultasi' => $nextKonsultasi,
				'id' => $id,
				'id_konsultasi' => $row->id_pemilik,
				'no_konsultasi' => $row->no_konsultasi,
				'nm_pemilik' => $row->nm_pemilik,
				'alamat' => $row->alamat,
				'nama_kecamatan' => $row->nama_kecamatan,
				'nama_kabkota' => $row->nama_kabkota,
				'nama_prov_pemilik' => $row->nama_prov_pemilik,
				'nm_konsultasi' => $row->nm_konsultasi,
				'nama_kec_bg' => $row->nama_kec_bg,
				'nama_kabkota_bg' => $row->nama_kabkota_bg,
				'nama_provinsi_bg' => $row->nama_provinsi_bg,
				'fungsi_bg' => $row->fungsi_bg,
				'almt_bgn' => $row->almt_bgn,
				'tinggi_bgn' => $row->tinggi_bgn,
				'luas_bgn' => $row->luas_bgn,
				'jml_lantai' => $row->jml_lantai,
				'jns_prasarana' => $row->jns_prasarana,
				'luas_bgp' => $row->luas_bgp,
				'tinggi_bgp' => $row->tinggi_bgp,
				'email' => $row->email,
				'list_jadwal' => $getPenjadwalanList->result(),
				'id_provinsi' => $row->id_provinsi,
				'id_kabkota' => $row->id_kabkota,
				'id_kecamatan' => $row->id_kecamatan,
				'nm_bgn' => $row->nm_bgn,
				'id_prov_bgn' => $row->id_prov_bgn,
				'id_kabkot_bgn' => $row->id_kabkot_bgn,
				'id_kec_bgn' => $row->id_kec_bgn,
				//'id_jenis_permohonan' => $row->id_jenis_permohonan,
				'luas_basement' => $row->luas_basement,
				'lapis_basement' => $row->lapis_basement,
				'tgl_pernyataan' => $tgl_pernyataan,
				'id_jenis_permohonan' => $id_jenis_permohonan,
				'hasil_kolektif' => $hasil_kolektif,
				'luas_total_kolektif' => $luas_total_kolektif,
				'lama_proses' => $row->lama_proses == NULL ? 0 : $row->lama_proses,
				'hasil_tgl' => $hasil_tgl,
				'penugasan' => empty($penugasan) ? 0 : $penugasan,
				'id_jenis_bg' => $row->id_jenis_bg,
				'message' => 'Data Berhasil Ditampilkan!',
			);
			header('Content-Type: application/json');
			echo json_encode($data);
		} else {
			$data = [
				'message' => 'Data Tidak Ada!'
			];
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}

    public function simpan_penjadwalan()
	{
		$tipe_konsultasi = $this->input->post('tipe_konsultasi',TRUE);
		$linkMeeting = $this->input->post('linkMeeting', TRUE);
		$passwordMeeting = $this->input->post('passwordMeeting', TRUE);
		$konsultasi_ke = explode('-', $this->input->post('konsultasi_ke', TRUE));
		$tanggal_konsultasi = $this->input->post('tanggal_konsultasi', TRUE);
		$jam_konsultasi = $this->input->post('jam_konsultasi', TRUE);
		$ketempat = $this->input->post('ketempat', TRUE);
		$noreg = $this->input->post('noreg', TRUE);
		$primary = $this->input->post('id', TRUE);
		$thisdir = getcwd();
		$dirPath = $thisdir . "/file/PBG/$noreg/konsultasi/undangan_konsultasi/";
		if (!file_exists($dirPath)) {
			//mkdir($dirPath, 0755, true);
  //create directory if not exist
		}
		$config['upload_path'] 		= $dirPath;
		$config['allowed_types'] 		= 'pdf|PDF';
		$config['max_size']			= '5120000';
		$config['encrypt_name']		= TRUE;
		$config['remove_space']		= TRUE;
		$this->load->library('upload', $config, 'uploads');

		if (!$this->uploads->do_upload('berkas')) {
			$this->session->set_flashdata('message', 'Silahkan Upload File Undangan Konsultasi Terlebih Dahulu!.');
			$this->session->set_flashdata('status', 'danger');
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		} else {
			if ($this->uploads->data('file_ext') != ".pdf") {
				$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
				$this->session->set_flashdata('status', 'warning');
				$path = FCPATH . "/file/PBG/{$noreg}/konsultasi/undangan_konsultasi/";
				$berkas = $path . $this->uploads->data('file_name');
				if (!unlink($berkas)) {
					$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
					$this->session->set_flashdata('status', 'warning');
				}
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} else {
				$data = array(
					'id' => $primary,
					'konsultasi' => $konsultasi_ke[1],
					'tgl_konsultasi' => $tanggal_konsultasi,
					'jam_konsultasi' => $jam_konsultasi,
					'ket_konsultasi' => $ketempat,
					'dir_file_undangan' => $this->uploads->data('file_name'),
					'tipe_konsultasi' => $tipe_konsultasi,
					'link_meeting' => $linkMeeting,
					'password_meeting' => $passwordMeeting
				);
		
				$status = array(
					'status' => 6
				);

				$this->Mteknis->insertDataKonsultasi($data);
				$this->Mteknis->updateStats($status,$primary);
				$this->session->set_flashdata('message', 'Konsultasi Berhasil Disimpan!');
				$this->session->set_flashdata('status', 'success');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		}
	}


	public function FormPenjadwalan()
	{
		$id = $this->Outh_model->Encryptor('decrypt', $this->input->post('id', TRUE));
		$getId = $this->Mteknis->get_permohonan_list($id);
		if ($getId->num_rows() > 0) {
			$row = $getId->row();
			$pengawasKonsultasi   = $this->Mteknis->getByIdPtugas($row->id_pemilik);
			$countJadwal = $this->Mteknis->getCountJadwal($row->id_pemilik)->num_rows();
			$nextKonsultasi = $countJadwal + 1;
			$getPenjadwalanList = $this->Mteknis->getPenjadwalanById($row->id_pemilik);
			$tgl_pernyataan = $row->tgl_pernyataan;
			$date_plus = new DateTime($tgl_pernyataan);
			$lama_proses = intval($row->lama_proses);
			$date_plus->modify("+{$lama_proses} days");
			$hasil_tgl = $date_plus->format("d-m-Y");
			$tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
			$data = array(
				'nextKonsultasi' => $nextKonsultasi,
				'id' => $id,
				'id_konsultasi' => $row->id_pemilik,
				'no_konsultasi' => $row->no_konsultasi,
				'nm_pemilik' => $row->nm_pemilik,
				'alamat' => $row->alamat,
				'nama_kecamatan' => $row->nama_kecamatan,
				'nama_kabkota' => $row->nama_kabkota,
				'nama_prov_pemilik' => $row->nama_prov_pemilik,
				'nm_konsultasi' => $row->nm_konsultasi,
				'nama_kec_bg' => $row->nama_kec_bg,
				'pengawas' => $pengawasKonsultasi->result(),
				'nama_kabkota_bg' => $row->nama_kabkota_bg,
				'nama_provinsi_bg' => $row->nama_provinsi_bg,
				'fungsi_bg' => $row->fungsi_bg,
				'almt_bgn' => $row->almt_bgn,
				'tinggi_bgn' => $row->tinggi_bgn,
				'luas_bgn' => $row->luas_bgn,
				'jml_lantai' => $row->jml_lantai,
				'email' => $row->email,
				'list_jadwal' => $getPenjadwalanList->result(),
				'id_provinsi' => $row->id_provinsi,
				'id_kabkota' => $row->id_kabkota,
				'id_kecamatan' => $row->id_kecamatan,
				'nm_bgn' => $row->nm_bgn,
				'id_prov_bgn' => $row->id_prov_bgn,
				'id_kabkot_bgn' => $row->id_kabkot_bgn,
				'id_kec_bgn' => $row->id_kec_bgn,
				'id_jenis_permohonan' => $row->id_jenis_permohonan,
				'luas_basement' => $row->luas_basement,
				'lapis_basement' => $row->lapis_basement,
				'tgl_pernyataan' => $tgl_pernyataan,
				'lama_proses' => $row->lama_proses,
				'hasil_tgl' => $hasil_tgl,
				'message' => 'Data Berhasil Ditampilkan!',

			);
			header('Content-Type: application/json');
			echo json_encode($data);
		} else {
			$data = [
				'message' => 'Data Tidak Ada!'
			];
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	//End Data Penjadwalan TPA
	//Begin Data Input Hasil Konsultasi
	public function InputKonsultasi()
	{
        $data['konsultasi']     = $this->Mteknis->getListKonsultasi();
        $data['title']          =  '';
        $data['heading']        =  '';
        $this->template->load('template/template_backend', 'Konsultasi/KonsultasiList', $data);
	}
	

   

    public function detail_penilaian($id = NULL)
    {
        $getId = $this->Mteknis->get_permohonan_list($id);
        if ($getId->num_rows() > 0) {
            $row = $getId->row();
            $group = $this->grouping_data(intval($row->id_jenis_permohonan));
            $arsitektur = $this->Mteknis->getSyaratList($row->id_jenis_permohonan, '2')->result();
            $struktur_mep = $this->Mteknis->getSyaratGroup($row->id_jenis_permohonan, ['3', '4'])->result();
            $ars_str_mep = $this->Mteknis->getSyaratGroup($row->id_jenis_permohonan, ['2', '3', '4'])->result();
            $struktur = $this->Mteknis->getSyaratList($row->id_jenis_permohonan, '3')->result();
            $MEP = $this->Mteknis->getSyaratList($row->id_jenis_permohonan, '4')->result();
            $pengawasSidang   = $this->Mteknis->getByIdPtugas($row->id_pemilik);
            $getPenjadwalanList = $this->Mteknis->getPenjadwalanById($row->id_pemilik);
            $daftar_provinsi = $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
            $daftar_kabkota = $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $row->id_provinsi);
            $daftar_kecamatan = $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $row->id_kabkota);
            $daftar_provinsi_bg = $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
            $daftar_kabkota_bg = $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $row->id_prov_bgn);
            $daftar_kecamatan_bg = $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $row->id_kabkot_bgn);
            $get_konsultasi = $this->mglobal->listDataKonsultasi('a.id,a.nm_konsultasi');
            $get_fungsi = $this->mglobal->listDataFungsiBg('a.id_fungsi_bg,a.fungsi_bg');
            $queJenisP = $this->mglobals->getData('*', 'tm_jenis_permohonan')->result();
            $list_JnsPer[''] = '--Pilih--';
            foreach ($queJenisP as $r) {
                $list_JnsPer[$r->id_jns_permohonan] = $r->nm_jns_permohonan;
            }
            $queFungsi = $this->Mteknis->get_jenis_fungsi_list()->result();
            $list_fungsi[''] = '--Pilih--';
            foreach ($queFungsi as $r) {
                $list_fungsi[$r->id_fungsi_bg] = $r->fungsi_bg;
            }
            $filterPemilik    = '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi';
            $DataBangunan     = $this->Mteknis->getBangunan($filterPemilik, $row->id_pemilik);
            $data = array(
                'list_fungsi' => $list_fungsi,
                'DataBangunan' => $DataBangunan,
                'list_JnsPer' => $list_JnsPer,
                'id' => $id,
                'id_konsultasi' => $row->id_pemilik,
                'no_konsultasi' => $row->no_konsultasi,
                'nm_pemilik' => $row->nm_pemilik,
                'alamat' => $row->alamat,
                'nama_kecamatan' => $row->nama_kecamatan,
                'nama_kabkota' => $row->nama_kabkota,
                'nm_konsultasi' => $row->nm_konsultasi,
                'nama_kec_bg' => $row->nama_kec_bg,
                'pengawas' => $pengawasSidang->result(),
                'nama_kabkota_bg' => $row->nama_kabkota_bg,
                'nama_provinsi_bg' => $row->nama_provinsi_bg,
                'fungsi_bg' => $row->fungsi_bg,
                'almt_bgn' => $row->almt_bgn,
                'tinggi_bgn' => $row->tinggi_bgn,
                'luas_bgn' => $row->luas_bgn,
                'jml_lantai' => $row->jml_lantai,
                'id_izin' => $row->id_izin,
                'status_imb' => $row->imb,
                'email' => $row->email,
                'tipeA' => $row->tipeA,
                'luasA' => $row->luasA,
                'lantaiA' => $row->lantaiA,
                'tinggiA' => $row->tinggiA,
                'jumlahA' => $row->jumlahA,
                'list_jadwal' => $getPenjadwalanList->result(),
                'id_provinsi' => $row->id_provinsi,
                'id_kabkota' => $row->id_kabkota,
                'id_kecamatan' => $row->id_kecamatan,
                'daftar_provinsi' => $daftar_provinsi,
                'daftar_kabkota' => $daftar_kabkota,
                'daftar_kecamatan' => $daftar_kecamatan,
                'daftar_provinsi_bg' => $daftar_provinsi_bg,
                'daftar_kabkota_bg' => $daftar_kabkota_bg,
                'daftar_kecamatan_bg' => $daftar_kecamatan_bg,
                'nm_bgn' => $row->nm_bgn,
                'id_prov_bgn' => $row->id_prov_bgn,
                'id_kabkot_bgn' => $row->id_kabkot_bgn,
                'id_kec_bgn' => $row->id_kec_bgn,
                'get_konsultasi' => $get_konsultasi,
                'id_jenis_permohonan' => $row->id_jenis_permohonan,
                'get_fungsi' => $get_fungsi,
                'luas_basement' => $row->luas_basement,
                'lapis_basement' => $row->lapis_basement,
                'arsitektur' => $arsitektur,
                'struktur' => $struktur,
                'mep' => $MEP,
                'struktur_mep' => $struktur_mep,
                'title' => 'Penilaian Sidang',
                'heading'  => '',
                'pathBerkas' => $this->pathBerkas,
                'ars_str_mep' => $ars_str_mep,
                'jns_pemilik' => $row->jns_pemilik,
                'id_kelurahan' => $row->id_kelurahan,
            );
            if ($group === 0) {
                $this->template->load('template/template_backend', 'Teknis/Konsultasi/pemeriksaan_dua', $data);
            } else if ($group === 1) {
                $this->template->load('template/template_backend', 'Teknis/Konsultasi/pemeriksaan_dua', $data);
            } else if ($group === 2) {
                $this->template->load('template/template_backend', 'Teknis/Konsultasi/pemeriksaan_dua', $data);
            } else {
                $this->template->load('template/template_backend', 'Teknis/Konsultasi/pemeriksaan_dua', $data);
            }
        } else {
            redirect('Pemeriksaan/Penilaian');
        }
    }

	public function grouping_data($id = NULL)
    {
        $check = [
            // pengecekan satu kali
            [
                'name' => 0,
                'value' => 4
            ],
            // pengecekan dua kali
            [
                'name' => 1,
                'value' => 1
            ],
            [
                'name' => 1,
                'value' => 3
            ],
            [
                'name' => 1,
                'value' => 5
            ],
            [
                'name' => 1,
                'value' => 6
            ],
            [
                'name' => 1,
                'value' => 7
            ],
            [
                'name' => 1,
                'value' => 14
            ],
            [
                'name' => 1,
                'value' => 15
            ],
            [
                'name' => 1,
                'value' => 16
            ],
            [
                'name' => 1,
                'value' => 2
            ],
            // pengecekan tiga kali
            [
                'name' => 2,
                'value' => 8
            ],
            [
                'name' => 2,
                'value' => 9
            ]
        ];
        $key = $this->searchForId($id, $check);
        return $key;
    }

	function searchForId($id, $array)
    {
        foreach ($array as $k => $v) {

            if ($v['value'] === $id) {
                return $v['name'];
            }
        }
        return NULL;
    }

	public function cek_arsitektur($id = NULL)
    {
        $dataKonsultasi = $this->input->post('dataKonsultasi', TRUE);
        $mode = $this->input->post('mode', TRUE);
        $dataId = $this->input->post('dataId', TRUE);
        $dataVal = $this->input->post('dataVal', TRUE);
        $cek = filter_var($mode, FILTER_VALIDATE_BOOLEAN);
        $insert = [
            'id' => $dataKonsultasi,
            'id_persyaratan' => $dataVal,
            'id_persyaratan_detail' => $dataId,
            'kesesuaian' => $cek === true ? 1 : 0,
        ];
        $update = [
            'kesesuaian' => $cek === true ? 1 : 0
        ];
        $cekData =  $this->Mteknis->getDataKesuaian($dataKonsultasi, $dataId, $dataVal);
        $cekData->num_rows() > 0 ? $this->Mteknis->updateDataKesesuaian($dataKonsultasi, $dataVal, $dataId, $update) : $this->Mteknis->insertDataKesesuaian($insert);
        $output = [
            'status' => $cek,
            'message' => 'Data Kesesuaian Berhasil Diubah!'
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }
	//End Data Input Hasil Konsultasi

	public function cek_step()
    {
        $id = $this->input->post('id', TRUE);
        $cek_step = $this->Mteknis->cekStep($id)->row();
        $cek = $cek_step->data_step;
        $res = $cek == NULL ? 0 : intval($cek);
        $output = [
            'result' => $res
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function save_step()
    {
        $step = $this->input->post('step', TRUE);
        $data = [
            'data_step' => $step,
        ];
        $dataVal = $this->input->post('dataVal', TRUE);
        $this->Mteknis->saveStep($dataVal, $data);
        $output = [
            'status' => true
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function kirim_perbaikan()
    {
        $no_skperbaikan = $this->input->post('no_skperbaikan', TRUE);
        $tgl_perbaikan = $this->input->post('tgl_perbaikan', TRUE);
        $konsultasi = $this->input->post('konsultasi', TRUE);
        $cekKonsultasi = $this->Mteknis->getIdKonsultasi($konsultasi)->row();
        $id = $cekKonsultasi->id;
        $config = [
            'upload_path' => "./{$this->pathPerbaikan}",
            'allowed_types' => 'pdf|TPA',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('berkas')) {
            $output = [
                'status' => false,
                'type' => 'error',
                'message' => 'Silahkan Upload Berkas Terlebih Dahulu!'
            ];
            header('Content-Type: application/json');
            echo json_encode($output);
        } else {
            if ($this->upload->data('file_ext') != ".pdf") {
                $path = FCPATH . "/{$this->pathPerbaikan}";
                $berkas = $path . $this->upload->data('file_name');
                if (!unlink($berkas)) {
                }
                $output = [
                    'status' => false,
                    'type' => 'warning',
                    'message' => 'Silahkan Upload Berkas Menggunakan Format PDF!'
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            } else {
                $data = [
                    'id' => $id,
                    'no_sk' => $no_skperbaikan,
                    'tgl_perbaikan' => $tgl_perbaikan,
                    'lampiran_perbaikan' => $this->upload->data('file_name')
                ];
                $update = [
                    'status' => 8
                ];
                $this->Mteknis->insertPerbaikan($data);
                $this->Mteknis->updateStatsPbg($id, $update);
                $output = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Data Berkas Berhasil Diupload!',
                    'result' => $this->pathPerbaikan . $this->upload->data('file_name')
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            }
        }
    }


    function SK_SLF($id=null)
	{
	    $que = $this->Mteknis->get_id_kabkot($id);
		$lokasi = $que['id_kec_bgn'];
		$tgl_disetujui = date('d').date('m').date('Y');;
		$mydata2 = $this->Mteknis->getNoDrafSlf($lokasi,$tgl_disetujui);
	    if(count($mydata2)>0){
	      $no_baru = SUBSTR($mydata2['no_registrasi_baru'],-3)+1;
	    	if ($no_baru < 100){
				$sk_pbg = "SK-SLF-".$lokasi."-".$tgl_disetujui."-00".$no_baru;
	  		} else {
	       		$sk_pbg = "SK-SLF-".$lokasi."-".$tgl_disetujui."-".$no_baru;
	   		}
	    } else {
	    	$sk_pbg = "SK-SLF-".$lokasi."-".$tgl_disetujui."-001";
	    }
		return $sk_pbg;
	}

    public function save_penilaian()
    {
        $nomor_berita = $this->input->post('nomor_berita', TRUE);
        $tgl_berita = $this->input->post('tgl_berita', TRUE);
        $okupansi   = $this->input->post('okupansi', TRUE);
        $konsultasi = $this->input->post('id', TRUE);
        $status_imb = $this->input->post('status_imb', TRUE);
		$id_konsultasi = $this->input->post('id_konsultasi', TRUE);
        $jns_permohonan = $this->input->post('jns_permohonan', TRUE);
        if ($status_imb =='1'){
            $status ='10';
        }else{
            $status ='9';
        }
        $cekKonsultasi = $this->Mteknis->getIdKonsultasi($konsultasi)->row();
        $id = $cekKonsultasi->id;
        $config = [
            'upload_path' => "./{$this->pathBerita}",
            'allowed_types' => 'pdf|TPA',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('berkas')) {
            $this->session->set_flashdata('message', $this->upload->display_errors());
            $this->session->set_flashdata('status', 'danger');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($this->upload->data('file_ext') != ".pdf") {
                $this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
                $this->session->set_flashdata('status', 'danger');
                $path = FCPATH . "/{$this->pathBerita}";
                $berkas = $path . $this->upload->data('file_name');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
				if($jns_permohonan == '14' ){ //Bangunan Eksisting Memiliki PBG/IMB
					$ttd = $this->Mteknis->get_pejabat($id_konsultasi);
					$ttd_pejabat_sk = $ttd['kepala_dinas'];
					$nip_kadis_teknis = $ttd['nip_kepala_dinas'];
                    $nm_dinas = $ttd['p_nama_dinas'];
					$sk_slf = $this->SK_SLF($id_konsultasi);
					$tgl_sk_slf = date('Y-m-d');
					$dataInSLF = array(
						'id' => $id_konsultasi,
						'no_slf' => $sk_slf,
						'tgl_penerbitan_slf' => $tgl_sk_slf,
						'nm_kadis_teknis' => $ttd_pejabat_sk,
						'nip_kadis_teknis' => $nip_kadis_teknis,
                        'nm_dinas' => $nm_dinas,
                        'okupansi' => $okupansi
					);
					$data = [
						'dir_file_konsultasi' =>  $this->upload->data('file_name'),
						'no_sk_tk' => $nomor_berita,
						'date_sk_tk' => $tgl_berita,
					];
					$update = [
						'status' => $status,
					];
					$this->Mteknis->updateStatsPbg($id, $update);
					$query = $this->Mteknis->updateHasilPenilaian($id, $data);
					$this->Mteknis->insertdataslf($dataInSLF);

					$this->load->library('ciqrcode'); //pemanggilan library QR CODE
					$config['imagedir']     = 'file/Konsultasi/QR_Code/'; //direktori penyimpanan qr code
					$config['quality']      = true; //boolean, the default is true
					$config['size']         = '1024'; //interger, the default is 1024
					$config['black']        = array(224,255,255); // array, default is array(255,255,255)
					$config['white']        = array(70,130,180); // array, default is array(0,0,0)
					$this->ciqrcode->initialize($config);
					$image_name=$sk_slf.'.png'; //buat name dari qr code sesuai dengan nim
					$params['data'] = 'http://simbg.pu.go.id/Main/Berkas/'.$sk_slf; //data yang akan di jadikan QR CODE
					$params['level'] = 'H'; //H=High
					$params['size'] = 10;
					$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
					$data['QR'] = $this->ciqrcode->generate($params);
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Disimpan');
						$this->session->set_flashdata('status', 'success');
						redirect('Teknis/InputKonsultasi');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Disimpan');
						$this->session->set_flashdata('status', 'danger');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}else{
					$data = [
						'dir_file_konsultasi' =>  $this->upload->data('file_name'),
						'no_sk_tk' => $nomor_berita,
						'date_sk_tk' => $tgl_berita,
					];
					$update = [
						'status' => $status,
					];
					$this->Mteknis->updateStatsPbg($id, $update);
					$query = $this->Mteknis->updateHasilPenilaian($id, $data);
					
                    $this->load->library('ciqrcode'); //pemanggilan library QR CODE
					$config['imagedir']     = 'file/Konsultasi/QR_Code/'; //direktori penyimpanan qr code
					$config['quality']      = true; //boolean, the default is true
					$config['size']         = '1024'; //interger, the default is 1024
					$config['black']        = array(224,255,255); // array, default is array(255,255,255)
					$config['white']        = array(70,130,180); // array, default is array(0,0,0)
					$this->ciqrcode->initialize($config);
					$image_name=$sk_slf.'.png'; //buat name dari qr code sesuai dengan nim
					//$params['data'] = 'http://simbg.pu.go.id/admin/lacak/lacak_berkas/'.$sk_imb; //data yang akan di jadikan QR CODE
					$params['data'] = 'http://simbg.pu.go.id/Main/Berkas/'.$sk_slf; //data yang akan di jadikan QR CODE
					$params['level'] = 'H'; //H=High
					$params['size'] = 10;
					$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
					$data['QR'] = $this->ciqrcode->generate($params);


					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Disimpan');
						$this->session->set_flashdata('status', 'success');
						redirect('Teknis/InputKonsultasi');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Disimpan');
						$this->session->set_flashdata('status', 'danger');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}  
            }
        }
    }

    public function save_penilaianOLd()
    {
        $nomor_berita = $this->input->post('nomor_berita', TRUE);
        $tgl_berita = $this->input->post('tgl_berita', TRUE);
        $konsultasi = $this->input->post('id', TRUE);
        $cekKonsultasi = $this->Mteknis->getIdKonsultasi($konsultasi)->row();
        $id = $cekKonsultasi->id;
        $config = [
            'upload_path' => "./{$this->pathBerita}",
            'allowed_types' => 'pdf|TPA',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('berkas')) {
            $this->session->set_flashdata('message', $this->upload->display_errors());
            $this->session->set_flashdata('status', 'danger');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($this->upload->data('file_ext') != ".pdf") {
                $this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
                $this->session->set_flashdata('status', 'danger');
                $path = FCPATH . "/{$this->pathBerita}";
                $berkas = $path . $this->upload->data('file_name');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $data = [
                    'dir_file_konsultasi' =>  $this->upload->data('file_name'),
                    'no_sk_tk' => $nomor_berita,
                    'date_sk_tk' => $tgl_berita,
                ];
                $update = [
                    'status' => 8
                ];
                $this->Mteknis->updateStatsPbg($id, $update);

                $query = $this->Mteknis->updateHasilPenilaian($id, $data);
                if ($query) {
                    $this->session->set_flashdata('message', 'Data Berhasil Disimpan');
                    $this->session->set_flashdata('status', 'success');
                    redirect('Teknis/inputKonsultasi');
                } else {
                    $this->session->set_flashdata('message', 'Data Gagal Disimpan');
                    $this->session->set_flashdata('status', 'danger');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }
    }
    // End Pemeriksaan Konsultasi


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

    public function getDataKecamatan()
    {
        $id_kabkot    = $this->uri->segment(3);
        $value        = array();
        $query        = $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $id_kabkot);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $value[]    = array('id_kecamatan' => $row->id_kecamatan, 'nama_kecamatan' => $row->nama_kecamatan);
            }
        }
        echo json_encode($value);
    }


    public function getDataKelurahan()
    {
        $id_kecamatan    = $this->uri->segment(3);
        $value        = array();
        $query        = $this->Mglobal->listDataKelurahan('a.id_kelurahan,a.nama_kelurahan', '', $id_kecamatan);
        if ($query->num_rows() > 0 && $id_kecamatan != '') {
            foreach ($query->result() as $row) {
                $value[]    = array('id_kelurahan' => $row->id_kelurahan, 'nama_kelurahan' => $row->nama_kelurahan);
            }
        }
        echo json_encode($value);
    }


    public function getDataJnsBg()
    {

        $id_fungsi_bg    = $this->uri->segment(3);
        $value        = array();
        $query        = $this->mglobals->getData('*', 'tm_jenis_bg', array('id_fungsi_bg' => $id_fungsi_bg));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $value[]    = array('id_jns_bg' => $row->id_jns_bg, 'nm_jenis_bg' => $row->nm_jenis_bg);
            }
        }
        echo json_encode($value);
    }

    public function saveDataBangunan()
    {
        $id_bgn            = $this->input->post('id_bgn');
        $id                = $this->input->post('id');
        $nama_bangunan    = $this->input->post('nama_bangunan');
        $luas_bg        = $this->input->post('luas_bg');
        $tinggi_bg        = $this->input->post('tinggi_bg');
        $almt_bgn            = $this->input->post('almt_bgn');
        $nama_provinsi        = $this->input->post('nama_provinsi');
        $nama_kabkota        = $this->input->post('nama_kabkota');
        $nama_kecamatan        = $this->input->post('nama_kecamatan');
        $nama_kelurahan     = $this->input->post('nama_kelurahan');
        $lantai_bg            = $this->input->post('lantai_bg');
        $luas_basement        = $this->input->post('luas_basement');
        $lapis_basement        = $this->input->post('lapis_basement');
        $lantai_bg            = $this->input->post('lantai_bg');
        $id_jns_bg            = $this->input->post('id_jns_bg');
        $id_fungsi_bg        = $this->input->post('id_fungsi_bg');
        $id_izin            = $this->input->post('id_izin');
        $id_kolektif        = $this->input->post('id_kolektif');
        $tipeA                = $this->input->post('tipeA');
        $unitA                = $this->input->post('unitA');
        $tinggiA            = $this->input->post('tinggiA');
        $id_prasarana_bg    = $this->input->post('id_prasarana_bg');
        $luas_bgp            = $this->input->post('luas_bgp');
        $tinggi_bgp            = $this->input->post('tinggi_bgp');
        $id_doc_tek            = $this->input->post('id_doc_tek');
        $jual                = "";
        $imb                = "";
        $slf                = "";
        if ($id_izin == '1') {
            if ($id_fungsi_bg == '1') {
                if ($id_doc_tek == '1') {
                    if ($luas_bg < 100) {
                        $jenis_konsultasi = '1';
                    } else {
                        $jenis_konsultasi = '2';
                    }
                } else if ($id_doc_tek == '2') {
                    $jenis_konsultasi = '3';
                } else if ($id_doc_tek == '3') {
                    $jenis_konsultasi = '4';
                } else if ($id_doc_tek == '4') {
                    $jenis_konsultasi = '5';
                }
            } else if ($id_fungsi_bg == '2') {
                $jenis_konsultasi = '6';
            } else if ($id_fungsi_bg == '3') {
                if ($jual == '1') {
                    $jenis_konsultasi = '7';
                } else {
                    $jenis_konsultasi = '6';
                }
            } else if ($id_fungsi_bg == '4') {
                $jenis_konsultasi = '6';
            } else if ($id_fungsi_bg == '5') {
                $jenis_konsultasi = '9';
            } else if ($id_fungsi_bg == '6') {
                $jenis_konsultasi = '9';
            }
        } else if ($id_izin == '2') {
            if ($id_fungsi_bg == '1') {
                if ($imb == '1' || $slf == '1') {
                    $jenis_konsultasi = '15';
                } else {
                    $jenis_konsultasi = '14';
                }
            } else if ($id_fungsi_bg == '5') {
                $jenis_konsultasi = '16';
            }
        } else if ($id_izin == '3') {
            $jenis_konsultasi = '18';
        } else if ($id_izin == '4') {
            $jenis_konsultasi = '11';
        } else if ($id_izin == '5') {
        } else if ($id_izin == '6') {
            $jenis_konsultasi = '17';
        }
        $data    = array(
            'id'                => $id,
            'id_prov_bgn'        => $nama_provinsi,
            'id_kabkot_bgn'        => $nama_kabkota,
            'id_kec_bgn'        => $nama_kecamatan,
            'id_kel_bgn'        => $nama_kelurahan,
            'almt_bgn'            => $almt_bgn,
            'id_izin'            => $id_izin,
            'id_fungsi_bg'        => $id_fungsi_bg,
            'id_jns_bg'            => $id_jns_bg,
            'nm_bgn'            => $nama_bangunan,
            'luas_bgn'            => $luas_bg,
            'tinggi_bgn'        => $tinggi_bg,
            'jml_lantai'        => $lantai_bg,
            'luas_basement'        => $luas_basement,
            'lapis_basement'    => $lapis_basement,
            'last_update'        => date("Y-m-d h:i:sa"),
            'id_kolektif'        => $id_kolektif,
            'tipeA'                => json_encode($tipeA),
            'tinggiA'            => json_encode($tinggiA),
            'id_prasarana_bg'    => $id_prasarana_bg,
            'luas_bgp'            => $luas_bgp,
            'tinggi_bgp'        => $tinggi_bgp,
            'id_doc_tek'        => $id_doc_tek
        );

        if ($id_bgn != "") {
            $query        = $this->Mglobals->setData('tmdatabangunan', $data, 'id_bgn', $id_bgn);
            $this->session->set_flashdata('message', 'Data Bangunan Berhasil di Simpan/Ubah.');
            $this->session->set_flashdata('status', 'success');
            $output = [
                'message' => 'Data Bangunan Berhasil Di Ubah!',
                'res' => true,
                'type' => 'success',
            ];
        } else {
            $query        = $this->Mglobals->setData('tmdatabangunan', $data, 'id_bgn', $id_bgn);
            if ($query) {
                $output = [
                    'message' => 'Data Bangunan Berhasil Di Simpan!',
                    'res' => true,
                    'type' => 'success',
                ];
            } else {
                $output = [
                    'message' => 'Data Bangunan Gagal Diubah!',
                    'res' => false,
                    'type' => 'danger',
                ];
            }
        }
        header('Content-Type: application/json');
        echo json_encode($output);
    }

	public function cek_kesesuaian($id = NULL)
    {
        $dataKonsultasi = $this->input->post('dataKonsultasi', TRUE);
        $mode = $this->input->post('mode', TRUE);
        $dataId = $this->input->post('dataId', TRUE);
        $dataVal = $this->input->post('dataVal', TRUE);
        $cek = filter_var($mode, FILTER_VALIDATE_BOOLEAN);
        $insert = [
            'id' => $dataKonsultasi,
            'id_persyaratan' => $dataVal,
            'id_persyaratan_detail' => $dataId,
            'kesesuaian' => $cek === true ? 1 : 0,
        ];
        $update = [
            'kesesuaian' => $cek === true ? 1 : 0
        ];
        $cekData =  $this->Mteknis->getDataKesuaian($dataKonsultasi, $dataId, $dataVal);
        $cekData->num_rows() > 0 ? $this->Mteknis->updateDataKesesuaian($dataKonsultasi, $dataVal, $dataId, $update) : $this->Mteknis->insertDataKesesuaian($insert);
        $output = [
            'status' => $cek,
            'message' => 'Data Kesesuaian Berhasil Diubah!'
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function simpan_catatan()
    {
        $dataKonsultasi = $this->input->post('dataKonsultasi', TRUE);
        $syarat = $this->input->post('syarat', TRUE);
        $dataId = $this->input->post('dataId', TRUE);
        $dataVal = $this->input->post('dataVal', TRUE);
        $insert = [
            'id' => $dataKonsultasi,
            'id_persyaratan' => $dataVal,
            'id_persyaratan_detail' => $dataId,
            'catatan' => $syarat,
        ];
        $update = [
            'catatan' => $syarat
        ];
        $cekData =  $this->Mteknis->getDataCatatan($dataKonsultasi, $dataId, $dataVal);
        $cekData->num_rows() > 0 ? $this->Mteknis->updateDataCatatan($dataKonsultasi, $dataVal, $dataId, $update) : $this->Mteknis->insertDataCatatan($insert);
        $output = [
            'status' => true,
            'message' => 'Data Berhasil Disimpan!'
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function ubah_berkas()
    {
        $dataId = $this->input->post('dataId', TRUE);
        $dataVal = $this->input->post('dataVal', TRUE);
        $cekData =  $this->Mteknis->getDataBerkas($dataId, $dataVal);
    }

    public function simpan_berkas()
    {

        $dataKonsultasi = $this->input->post('dataKonsultasi', TRUE);
        $dataId = $this->input->post('dataId', TRUE);
        $dataVal = $this->input->post('dataVal', TRUE);
        $thisdir = getcwd();
        $dirPath = $thisdir . "/file/Konsultasi/$dataKonsultasi/Dokumen/";
        if (!file_exists($dirPath)) {
            //mkdir($dirPath, 0755, true);
  //create directory if not exist
        }
        $config = [
            'upload_path' => "$dirPath",
            'allowed_types' => 'pdf|TPA',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $config);
        $cekData =  $this->Mteknis->getDataBerkas($dataKonsultasi, $dataVal, $dataId);
        if ($cekData->num_rows() > 0) {
            if (!$this->upload->do_upload('berkas')) {
                $output = [
                    'status' => false,
                    'type' => 'error',
                    'message' => 'Silahkan Upload Berkas Terlebih Dahulu!'
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            } else {
                if ($this->upload->data('file_ext') != ".pdf") {
                    $path = $dirPath;
                    $berkas = $path . $this->upload->data('file_name');
                    if (!unlink($berkas)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload Berkas Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'dir_file' => $this->upload->data('file_name')
                    ];
                    $cekFile = $this->Mteknis->cekBerkas($dataKonsultasi, $dataVal, $dataId)->row()->dir_file;
                    if ($cekFile == NULL) {
                        $this->Mteknis->updateBerkas($dataKonsultasi, $dataVal, $dataId, $data);
                        $output = [
                            'status' => true,
                            'type' => 'success',
                            'message' => 'Data Berkas Berhasil Diupload!',
                            'result' => "file/Konsultasi/{$dataKonsultasi}/Dokumen/" . $this->upload->data('file_name')
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    } else {
                        $path = $dirPath;
                        $fileLama = $path . $cekFile;
                        $this->Mteknis->updateBerkas($dataKonsultasi, $dataVal, $dataId, $data);
                        $output = [
                            'status' => true,
                            'type' => 'success',
                            'message' => 'Data Berkas Berhasil Diupload!',
                            'result' => "file/Konsultasi/{$dataKonsultasi}/Dokumen/" . $this->upload->data('file_name')
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    }
                }
            }
        } else {
            if (!$this->upload->do_upload('berkas')) {
                $output = [
                    'status' => false,
                    'type' => 'error',
                    'message' => 'Silahkan Upload Berkas Terlebih Dahulu!'
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            } else {
                if ($this->upload->data('file_ext') != ".pdf") {
                    $path = $dirPath;
                    $berkas = $path . $this->upload->data('file_name');
                    if (!unlink($berkas)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload Berkas Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'id' => $dataKonsultasi,
                        'id_persyaratan' => $dataId,
                        'id_persyaratan_detail' => $dataVal,
                        'dir_file' => $this->upload->data('file_name')
                    ];
                    $this->Mteknis->insertBerkas($data);
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Data Berkas Berhasil Diupload!',
                        'result' => "file/Konsultasi/{$dataKonsultasi}/Dokumen/" . $this->upload->data('file_name')
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
            }
        }
    }

    public function simpan_penilaian()
    {
        $jenis = $this->input->post('jenis', TRUE);
        $syarat = $this->input->post('syarat', TRUE);
        $dataKonsultasi = $this->input->post('dataKonsultasi', TRUE);
        $pemeriksaan = $this->Mteknis->getSyaratListId($jenis, $syarat);
        $cek = [];
        $not = 0;
        $done = 0;
        foreach ($pemeriksaan->result() as $r) {
            $p = $this->Mteknis->getDataPemeriksaanKesesuaian($r->id_detail,$dataKonsultasi)->row();
            $not = $p != NULL ? $not++ : $not;
            $kesesuaian = $p == NULL ? 0 : $p->kesesuaian;
            $cek[] = [
                'nm_dokumen' => $r->nm_dokumen,
                'kesesuaian' => $kesesuaian,
            ];
        }


        foreach ($cek as $x) {
            if ($x['kesesuaian'] == 0) {
                $not++;
            }
            if ($x['kesesuaian'] == 1) {
                $done++;
            }
        }
        $output = [
            'status' => $done > 0 ? true : false,
            'type' => 'success',
            'message' => 'Hasil Data Penilaian',
            'result' => $cek,
            'not' => $not
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }


    // inspeksi

    public function inspeksi()
    {
        $data = [
            'konsultasi' => $this->Mteknis->getListKonsultasi(),
            'title' => 'Penjadwalan Konsultasi PBG',
            'heading' => ''
        ];
        $this->template->load('template/template_backend', 'Teknis/Inspeksi/list_konsultasi', $data);
    }

    public function detail_inspeksi($id = NULL)
    {
        $getId = $this->Mteknis->get_permohonan_list($id);
        if ($getId->num_rows() > 0) {
            $row = $getId->row();
            $cekId = $this->Mteknis->cekIdBangunan($id)->row();
            $id_bgn = $cekId->id_bgn;
            $group = $this->grouping_data($id_bgn);
            $struktur_bawah = $this->Mteknis->getJenisInspeksi($id_bgn, 1)->row();
            $basement = $this->Mteknis->getJenisInspeksi($id_bgn, 2)->row();
            $struktur_atas = $this->Mteknis->getJenisInspeksi($id_bgn, 3)->row();
            $testing = $this->Mteknis->getJenisInspeksi($id_bgn, 4)->row();
            $getPenjadwalanList = $this->Mteknis->getPenjadwalanById($row->id_pemilik);
            $get_konsultasi = $this->mglobal->listDataKonsultasi('a.id,a.nm_konsultasi');
            $get_fungsi = $this->mglobal->listDataFungsiBg('a.id_fungsi_bg,a.fungsi_bg');
            $data = array(
                'id' => $id,
                'id_konsultasi' => $row->id_pemilik,
                'no_konsultasi' => $row->no_konsultasi,
                'nm_pemilik' => $row->nm_pemilik,
                'alamat' => $row->alamat,
                'nama_kecamatan' => $row->nama_kecamatan,
                'nama_kabkota' => $row->nama_kabkota,
                'nm_konsultasi' => $row->nm_konsultasi,
                'nama_kec_bg' => $row->nama_kec_bg,
                'nama_kabkota_bg' => $row->nama_kabkota_bg,
                'nama_provinsi_bg' => $row->nama_provinsi_bg,
                'fungsi_bg' => $row->fungsi_bg,
                'almt_bgn' => $row->almt_bgn,
                'tinggi_bgn' => $row->tinggi_bgn,
                'luas_bgn' => $row->luas_bgn,
                'jml_lantai' => $row->jml_lantai,
                'email' => $row->email,
                'list_jadwal' => $getPenjadwalanList->result(),
                'id_provinsi' => $row->id_provinsi,
                'id_kabkota' => $row->id_kabkota,
                'id_kecamatan' => $row->id_kecamatan,
                'nm_bgn' => $row->nm_bgn,
                'id_prov_bgn' => $row->id_prov_bgn,
                'id_kabkot_bgn' => $row->id_kabkot_bgn,
                'id_kec_bgn' => $row->id_kec_bgn,
                'get_konsultasi' => $get_konsultasi,
                'id_jenis_permohonan' => $id_bgn,
                'get_fungsi' => $get_fungsi,
                'luas_basement' => $row->luas_basement,
                'lapis_basement' => $row->lapis_basement,
                'title' => 'Inspeksi',
                'heading'  => '',
                'pathCatatan' => $this->pathCatatan,
                'pathInspeksi' => $this->pathInspeksi,
                'pathJustifikasi' => $this->pathJustifikasi,
                'struktur_bawah' => $struktur_bawah,
                'basement' => $basement,
                'struktur_atas' => $struktur_atas,
                'testing' => $testing,
            );
            if ($group === 0) {
                $this->template->load('template/template_backend', 'Teknis/Inspeksi/pemeriksaan_inspeksi', $data);
            } else if ($group === 1) {
                $this->template->load('template/template_backend', 'Teknis/Inspeksi/pemeriksaan_inspeksi', $data);
            } else if ($group === 2) {
                $this->template->load('template/template_backend', 'Teknis/Inspeksi/pemeriksaan_inspeksi', $data);
            } else {
                $this->template->load('template/template_backend', 'Teknis/Inspeksi/pemeriksaan_inspeksi', $data);
            }
        } else {
        }
    }

    public function simpan_inspeksi()
    {
        $confJustifikasi = [
            'upload_path' => "./{$this->pathJustifikasi}",
            'allowed_types' => 'pdf|TPA',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $confCatatan = [
            'upload_path' => "./{$this->pathCatatan}",
            'allowed_types' => 'pdf|TPA',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $config = [
            'upload_path' => "./{$this->pathInspeksi}",
            'allowed_types' => 'pdf|TPA',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $config, 'berkas');
        $this->load->library('upload', $confJustifikasi, 'justifikasi');
        $this->load->library('upload', $confCatatan, 'catatan');
        $cekId = $this->Mteknis->cekIdBangunan($this->input->post('id_bangunan'))->row();
        $id_inspeksi = $this->input->post('id_inspeksi', TRUE);
        if ($id_inspeksi != '') {
            if (!$this->catatan->do_upload('catatan')) {
                $data = [
                    'id' => $cekId->id_bgn,
                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                    'kesesuaian' => $this->input->post('kesesuaian'),
                ];
                $this->Mteknis->updateInspeksi($id_inspeksi, $data);
                $output = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Hasil Data Penilaian'
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            } else {
                if ($this->catatan->data('file_ext') != ".pdf") {
                    $path = FCPATH . "/{$this->pathCatatan}";
                    $berkas = $path . $this->catatan->data('file_name');
                    if (!unlink($berkas)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload Berkas Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    if (!$this->berkas->do_upload('berkas')) {
                        $data = [
                            'id' => $cekId->id_bgn,
                            'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                            'kesesuaian' => $this->input->post('kesesuaian'),
                            'catatan' => $this->catatan->data('file_name'),
                        ];
                        $this->Mteknis->updateInspeksi($id_inspeksi, $data);
                        $output = [
                            'status' => true,
                            'type' => 'success',
                            'message' => 'Hasil Data Penilaian'
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    } else {
                        if ($this->berkas->data('file_ext') != ".pdf") {
                            $path = FCPATH . "/{$this->pathInspeksi}";
                            $berkas = $path . $this->berkas->data('file_name');
                            if (!unlink($berkas)) {
                            }
                            $output = [
                                'status' => false,
                                'type' => 'warning',
                                'message' => 'Silahkan Upload Berkas Menggunakan Format PDF!'
                            ];
                            header('Content-Type: application/json');
                            echo json_encode($output);
                        } else {
                            if (!$this->justifikasi->do_upload('justifikasi')) {
                                $data = [
                                    'id' => $cekId->id_bgn,
                                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                    'kesesuaian' => $this->input->post('kesesuaian'),
                                    'catatan' => $this->catatan->data('file_name'),
                                    'berkas_file' => $this->berkas->data('file_name')
                                ];
                                $this->Mteknis->updateInspeksi($id_inspeksi, $data);
                                $output = [
                                    'status' => true,
                                    'type' => 'success',
                                    'message' => 'Hasil Data Penilaian'
                                ];
                                header('Content-Type: application/json');
                                echo json_encode($output);
                            } else {
                                $data = [
                                    'id' => $cekId->id_bgn,
                                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                    'kesesuaian' => $this->input->post('kesesuaian'),
                                    'catatan' => $this->catatan->data('file_name'),
                                    'berkas_file' => $this->berkas->data('file_name'),
                                    'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                                ];
                                $this->Mteknis->updateInspeksi($id_inspeksi, $data);
                                $output = [
                                    'status' => true,
                                    'type' => 'success',
                                    'message' => 'Hasil Data Penilaian'
                                ];
                                header('Content-Type: application/json');
                                echo json_encode($output);
                            }
                        }
                    }
                }
            }
        } else {
            if (!$this->catatan->do_upload('catatan')) {
                $output = [
                    'status' => false,
                    'type' => 'error',
                    // 'message' => $this->berkas->display_errors(),
                    'message' => 'Silahkan Upload Berkas Terlebih Dahulu!'
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            } else {
                if ($this->catatan->data('file_ext') != ".pdf") {
                    $path = FCPATH . "/{$this->pathCatatan}";
                    $berkas = $path . $this->catatan->data('file_name');
                    if (!unlink($berkas)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload Berkas Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    if (!$this->berkas->do_upload('berkas')) {
                        $output = [
                            'status' => false,
                            'type' => 'error',
                            // 'message' => $this->berkas->display_errors(),
                            'message' => 'Silahkan Upload Berkas Terlebih Dahulu!'
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    } else {
                        if ($this->berkas->data('file_ext') != ".pdf") {
                            $path = FCPATH . "/{$this->pathInspeksi}";
                            $berkas = $path . $this->berkas->data('file_name');
                            if (!unlink($berkas)) {
                            }
                            $output = [
                                'status' => false,
                                'type' => 'warning',
                                'message' => 'Silahkan Upload Berkas Menggunakan Format PDF!'
                            ];
                            header('Content-Type: application/json');
                            echo json_encode($output);
                        } else {
                            if (!$this->justifikasi->do_upload('justifikasi')) {
                                $data = [
                                    'id' => $cekId->id_bgn,
                                    'id_struktur' => $this->input->post('id'),
                                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                    'kesesuaian' => $this->input->post('kesesuaian'),
                                    'catatan' => $this->catatan->data('file_name'),
                                    'berkas_file' => $this->berkas->data('file_name')
                                ];
                                $this->Mteknis->insertInspeksi($data);
                                $output = [
                                    'status' => true,
                                    'type' => 'success',
                                    'message' => 'Hasil Data Penilaian'
                                ];
                                header('Content-Type: application/json');
                                echo json_encode($output);
                            } else {
                                $data = [
                                    'id' => $cekId->id_bgn,
                                    'id_struktur' => $this->input->post('id'),
                                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                    'kesesuaian' => $this->input->post('kesesuaian'),
                                    'catatan' => $this->catatan->data('file_name'),
                                    'berkas_file' => $this->berkas->data('file_name'),
                                    'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                                ];
                                $this->Mteknis->insertInspeksi($data);
                                $output = [
                                    'status' => true,
                                    'type' => 'success',
                                    'message' => 'Hasil Data Penilaian'
                                ];
                                header('Content-Type: application/json');
                                echo json_encode($output);
                            }
                        }
                    }
                }
            }
        }
    }
    

    public function cek_data_inspeksi()
    {
        $id = $this->input->post('id');
        $nomor_berita = $this->input->post('nomor_berita', TRUE);
        $tgl_berita = $this->input->post('tgl_berita', TRUE);
        $cekId = $this->Mteknis->cekIdBangunan($id)->row()->id_bgn;
        $cekInspeksi = $this->Mteknis->cekInspeksiBangunan($cekId);
        $cek = $this->Mteknis->cekDataInspeksiBangunan($cekId);
        if ($cekInspeksi->num_rows() > 0) {
            $row = $cekInspeksi->row();
            $data = [
                'no_berita_inspeksi' => $nomor_berita,
                'tgl_berita_inspeksi' => $tgl_berita
            ];
            $this->Mteknis->updateDataInspeksi($row->id, $data);
            $output = [
                'status' => true,
                'type' => 'success',
                'message' => 'Hasil Data Inspeksi',
                'result' => $cek->result()
            ];
            header('Content-Type: application/json');
            echo json_encode($output);
        } else {
            $data = [
                'id' => $cekId,
                'no_berita_inspeksi' => $nomor_berita,
                'tgl_berita_inspeksi' => $tgl_berita
            ];
            $this->Mteknis->insertDataInspeksi($data);
            $output = [
                'status' => true,
                'type' => 'success',
                'message' => 'Hasil Data Inspeksi',
                'result' => $cek->result()
            ];
            header('Content-Type: application/json');
            echo json_encode($output);
        }
    }

    public function hapus_inspeksi($id)
    {
        $this->Mteknis->hapusInspeksi($id);
        $this->session->set_flashdata('message', 'Data Inspeksi Berhasil di Hapus.');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function cek_step_inspeksi()
    {
        $id = $this->input->post('id', TRUE);
        $cek_step = $this->Mteknis->cekStepInspeksi($id)->row();
        $cek = $cek_step->step_inspeksi;
        $res = $cek == NULL ? 0 : intval($cek);
        $output = [
            'result' => $res
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function save_step_inspeksi()
    {
        $step = $this->input->post('step', TRUE);
        $data = [
            'step_inspeksi' => $step,
        ];
        $dataVal = $this->input->post('dataVal', TRUE);
        $this->Mteknis->saveStepInspeksi($dataVal, $data);
        $output = [
            'status' => true
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function ValidasiPBG() 
    {
        $SQLcari 	= "";
		$data['Verifikasi'] = $this->Mteknis->getListValidasiPBG(null,$SQLcari);
        $data['content']	= $this->load->view('Penerbitan/ValidasiList',$data,TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
    }

    public function CetakVerifikasi($id = NULL)
    {
        $getId = $this->Mteknis->getDataVerifikasiBGFK($id);
        if ($getId->num_rows() > 0) {
            $row = $getId->row();
            $data = array(
                'nm_pemilik' => $row->nm_pemilik,
                'almt_bgn' => $row->almt_bgn,
                'luas_bgn' => $row->luas_bgn,
                'tinggi_bgn' => $row->tinggi_bgn,
                'jml_lantai' => $row->jml_lantai,
                'no_konsultasi' => $row->no_konsultasi,
                'tgl_pernyataan' => $row->tgl_pernyataan,
                'nm_bgn' => $row->nm_bgn,
                'almt_bgn' => $row->almt_bgn,
                'nm_prov_bgn' => $row->nm_prov_bgn,
                'nm_kabkot_bgn' => $row->nm_kabkot_bgn,
                'kepala_dinas' => $row->kepala_dinas,
                'nip_kepala_dinas' => $row->nip_kepala_dinas,
                'p_nama_dinas' => $row->p_nama_dinas,
            );
        }
        $this->load->view('Penerbitan/CetakVerifikasi', $data);
    }

    public function CetakPersetujuanBangunanGedung($id = NULL)
    {
        
    }

    public function ValidasiSBKBG()
    {
        $SQLcari 	= "";
		$data['Verifikasi'] = $this->Mteknis->getListValidasiPBG(null,$SQLcari);
        $data['content']	= $this->load->view('SLF/ValidasiList',$data,TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
    }

    public function ValidasiSLF($id=null) 
    {
        $getId = $this->Mteknis->getDataSlf($id);
		if ($getId->num_rows() > 0) {
            $row = $getId->row();
            $data = array(
                'nm_pemilik' => $row->nm_pemilik,
                'almt_bgn' => $row->almt_bgn,
                'luas_bgn' => $row->luas_bgn,
                'tinggi_bgn' => $row->tinggi_bgn,
                'jml_lantai' => $row->jml_lantai,
                'nm_bgn' => $row->nm_bgn,
				'alamat' => $row->alamat,
                'nm_prov_bgn' => $row->nama_provinsi,
                'nm_kabkot_bgn' => $row->nama_kabkota,
                'nm_kec_bgn' => $row->nama_kecamatan,
                'no_konsultasi' => $row->no_konsultasi,
				'no_izin_pbg' => $row->no_izin_pbg,
				'nm_kadis' => $row->nm_kadis,
				'nip_kadis' => $row->nip_kadis,
				'p_nama_dinas' => $row->p_nama_dinas,
            );
        }
        $this->load->view('SLF/Dokumen', $data);
    
    }

    public function Perhitungan() 
    {
        $id_fungsi_bg = $this->input->get('id_fungsi_bg', TRUE);
        $id_proses = $this->input->get('id_proses', TRUE);
        $tanggalawal = $this->input->get('tanggalawal', TRUE);
        $tanggalakhir = $this->input->get('tanggalakhir', TRUE);
        $search = $this->search([$id_fungsi_bg, $id_proses, $tanggalawal, $tanggalakhir]);
        $SQLcari     = "";
        $data = [
            'title' => '',
            'heading' => '',
            'Penugasan' => !isset($_GET['cari']) ? $this->Mteknis->getDataRetribusi(null, $SQLcari)->result() : $search,
        ];
        $this->template->load('template/template_backend', 'Retribusi/RetribusiList', $data);
    }


    // end inspeksi

    // penugasan Inspeksi
    public function PenugasanInspeksi()
    {
        $id_fungsi_bg = $this->input->get('id_fungsi_bg', TRUE);
		$id_proses = $this->input->get('id_proses', TRUE);
		$tanggalawal = $this->input->get('tanggalawal', TRUE);
		$tanggalakhir = $this->input->get('tanggalakhir', TRUE);
		$SQLcari 	= "";
		$data['title']		=	'Penugasan Inspeksi';
		$data['heading']	=	'';
		$search = $this->search([$id_fungsi_bg, $id_proses, $tanggalawal, $tanggalakhir]);
		$data['Penugasan'] = !isset($_GET['cari']) ? $this->Mteknis->getDataPenugasanInspeksi(null, $SQLcari)->result() : $search;
		$data['content']	= $this->load->view('PenugasanInspeksi/ListInspeksi', $data, TRUE);
        $this->load->view('backend_adm', $data);
    }

    public function penugasan_inspeksi()
	{
		$year = date('Y');
		$id = $this->uri->segment(3);
		$que = $this->Mteknis->getDetailPengawasInspeksi($id)->row_array();
		$id_kabkot = $que['id_kabkot_bgn'];
		$rew   = $this->Mteknis->getByIdPtugasInspeksi($id);
		$result = $this->Mteknis->getTimPenilik($id_kabkot, $year);
		$data = array(
			'judul' => 'Pilh Tim Penilik',
			'result' => $result->result(),
			'que' => $que,
			'rew' => $rew,
		);
		$this->load->view('PenugasanInspeksi/inspeksi_form', $data);
	}

    
    public function simpan_penugasaninspeksi()
	{
		$id_pemilik = $this->input->post('id_pemilik');
		$tugas_personil = $this->input->post('tugas');
		if ($tugas_personil != NULL) {
			foreach ($tugas_personil as $key => $val) {
				$res[] = $val;
			}
			$k = array_unique($res);
			$cekPersonil = 	$this->Mteknis->cekPersonalPenugasanInspeksi($id_pemilik, $k);
			if ($cekPersonil->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Personil Sudah Terpilih!');
				$this->session->set_flashdata('status', 'warning');
                redirect('Teknis/PenugasanInspeksi');
			} else {
				foreach ($tugas_personil as $key => $val) {
					$dataP[] = array(
						'id' => $id_pemilik,
						'id_personal' => $val,
					);
				}
				$tgl_log = date('Y-m-d');
				$data = array(
					'status' => 17,
					'post_date' => $tgl_log,
					'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
				);
				$this->Mteknis->insertDataPenugasanInspeksi($dataP);
				$this->Mteknis->updateStats($data, $id_pemilik);
				$this->session->set_flashdata('message', 'Data Penugasan Inspeksi Berhasil di Simpan');
				$this->session->set_flashdata('status', 'success');
                redirect('Teknis/PenugasanInspeksi');
			}
		} else {
			$this->session->set_flashdata('message', 'Silahkan Pilih Tim Terlebih Dahulu!');
			$this->session->set_flashdata('status', 'warning');
			redirect('Teknis/PenugasanInspeksi');
		}
	}
}