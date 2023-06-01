<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Penugasan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('utility');
		$this->load->model('Mpenugasan');
		$this->load->library('oss_lib');
		$this->load->library('simbg_lib');
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->simbg_lib->check_session_login();
	}
	function index()
	{
		$this->Penugasan();
	}
	// Begin Penugasan Pemeriksa Dokumen
	public function Penugasan()
	{
		$search = $this->input->post('search');
		$SQLcari 	= "";
		if ($search != '') {
			$SQLcari = array(
				'id_fungsi_bg' 	=> trim($this->input->post('id_fungsi_bg')),
				'id_proses' 	=> trim($this->input->post('id_proses')),
				'tanggalawal' 	=> trim($this->input->post('tanggalawal')),
				'tanggalakhir' 	=> trim($this->input->post('tanggalakhir'))
			);
			$this->session->set_userdata($SQLcari);
			$data = array(
				'id_fungsi_bg' 	=> trim($this->input->post('id_fungsi_bg')),
				'id_proses' 	=> trim($this->input->post('id_proses')),
				'tanggalawal' 	=> trim(tgl_ind_to_eng($this->input->post('tanggalawal'))),
				'tanggalakhir' 	=> trim(tgl_ind_to_eng($this->input->post('tanggalakhir')))
			);
		}
		$data['title']		=	'';
		$data['heading']	=	'';
		$data['Penugasan'] 	= $this->Mpenugasan->getListPenugasanDok($SQLcari)->result();
		$this->template->load('template/template_backend', 'Penugasan/PenugasanList', $data);
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
				$query = $this->Mpenugasan->getDataPenugasan(null, $SQLcari)->result();
			} else if (intval($proses) !== 0 && intval($fungsi_bg) === 0) {
				$query = $this->Mpenugasan->findProsesWithoutDate($proses)->result();
			} else if (intval($proses) === 0 && intval($fungsi_bg) !== 0) {
				$query = $this->Mpenugasan->findFungsiWithoutDate($fungsi_bg)->result();
			} else {
				$query = $this->Mpenugasan->findAllWithoutDate($fungsi_bg, $proses)->result();
			}
		} else {
			if (intval($fungsi_bg) === 0 && intval($proses) === 0) {
				$query = $this->Mpenugasan->getPenugasanAll($tglAwal, $tglAkhir)->result();
			} else if (intval($fungsi_bg) !== 0 && intval($proses) === 0) {
				$query = $this->Mpenugasan->findFungsi($fungsi_bg, $tglAwal, $tglAkhir)->result();
			} else if (intval($fungsi_bg) === 0 && intval($proses) !== 0) {
				$query = $this->Mpenugasan->findProses($proses, $tglAwal, $tglAkhir)->result();
			} else {
				$query = $this->Mpenugasan->findAll($fungsi_bg, $proses, $tglAwal, $tglAkhir)->result();
			}
		}
		return $query;
	}

	function export_pdf()
	{
		$this->load->library('F_pdflib');
		$SQLcari = "";
		$id_fungsi_bg = $this->input->get('id_fungsi_bg', TRUE);
		$id_proses = $this->input->get('id_proses', TRUE);
		$tanggalawal = $this->input->get('tanggalawal', TRUE);
		$tanggalakhir = $this->input->get('tanggalakhir', TRUE);
		$SQLcari 	= "";
		$search = $this->search([$id_fungsi_bg, $id_proses, $tanggalawal, $tanggalakhir]);
		$penugasan = !isset($_GET['cari']) ? $this->Mpenugasan->getDataPenugasan(null, $SQLcari)->result() : $search;
		$data = ['penugasan' => $penugasan];
		$this->load->view('penugasan_pdf', $data);
	}

	public function FormPenugasan()
	{
		$id 				= $this->input->post('id', TRUE);
		// var_dump($id); die;
		$cekDataBangunan 	= $this->Mpenugasan->cekDataBangunan($id);
		if ($cekDataBangunan->num_rows() > 0) {
			$row 			= $cekDataBangunan->row();
			$tgl_pernyataan = $row->tgl_pernyataan;
			$LuasBg 		= 0;
			$id_jenis_permohonan = $row->id_jenis_permohonan;
			if ($id_jenis_permohonan == 11) {
				$tipeA 		= $row->tipeA;
				$luasA 		= $row->luasA;
				$tinggiA 	= $row->tinggiA;
				$lantaiA 	= $row->lantaiA;
				$jumlahA 	= $row->jumlahA;
				$tipe 		= json_decode($tipeA);
				$luas 		= json_decode($luasA);
				$tinggi 	= json_decode($tinggiA);
				$lantai 	= json_decode($lantaiA);
				$jumlah 	= json_decode($jumlahA);
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
						$tipe_kolektif 		= !empty($bangunan_kolektif['tipe'][$no]) ? $bangunan_kolektif['tipe'][$no] : '';
						$luas_kolektif 		= !empty($bangunan_kolektif['luas'][$no]) ? $bangunan_kolektif['luas'][$no] : '';
						$tinggi_kolektif 	= !empty($bangunan_kolektif['tinggi'][$no]) ? $bangunan_kolektif['tinggi'][$no] : '';
						$lantai_kolektif 	= !empty($bangunan_kolektif['lantai'][$no]) ? $bangunan_kolektif['lantai'][$no] : '';
						$jumlah_kolektif 	= !empty($bangunan_kolektif['jumlah'][$no]) ? $bangunan_kolektif['jumlah'][$no] : '';
						$hasil_kolektif[] 	= [
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
			$date_plus 		= new DateTime($tgl_pernyataan);
			$lama_proses 	= intval($row->lama_proses);
			$date_plus->modify("+{$lama_proses} days");
			$hasil_tgl 		= $date_plus->format("d-m-Y");
			$tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
			if($row->id_kabkot_bgn =='3171' || $row->id_kabkot_bgn =='3172' || $row->id_kabkot_bgn =='3173' || $row->id_kabkot_bgn =='3174' || $row->id_kabkot_bgn =='3175'){
				$id_kabkot = $row->id_prov_bgn;
			}else {
				$id_kabkot = $row->id_kabkot_bgn;
			}
			$id_fbg = $row->id_fungsi_bg;
			$id_izin	= $row->id_izin;
			$id_klasifikasi = $row ->id_klasifikasi; 
			$year = $year = date('Y');
			if($id_izin =='2'){ // Bangunan Baru 
				if( $id_fbg =='1'){ //Fungsi Hunian
					$get_data_penugasan =  $this->Mpenugasan->getTimTpt($id_kabkot, $year); //TPT
					$Petugas = "Pilih Tenaga TPT";
				}else{
					$get_data_penugasan =  $this->Mpenugasan->getTimTpt($id_kabkot, $year); //TPT
					$Petugas = "Pilih Tenaga TPT";
				}
			}else if($id_izin =='7'){ //PertaShop
				$get_data_penugasan =  $this->Mpenugasan->getTimTpt($id_kabkot, $year); //TPT
				$Petugas = "Pilih Tenaga TPT";
			}else if($id_izin =='4'){
				$get_data_penugasan =  $this->Mpenugasan->getTimTpa($id_kabkot, $year); //TPA
				$Petugas = "Pilih Tenaga TPA";
			}else{
				if( $id_fbg =='1'){
					if($id_klasifikasi =='2'){ //Bangunan Tidak Sederhana
						$get_data_penugasan =  $this->Mpenugasan->getTimTpa($id_kabkot, $year); //TPA
						$Petugas = "Pilih Tenaga TPA";
					}else{
						$get_data_penugasan =  $this->Mpenugasan->getTimTpt($id_kabkot, $year); //TPT
					$Petugas = "Pilih Tenaga TPT";
					}
				}else{
					$get_data_penugasan =  $this->Mpenugasan->getTimTpa($id_kabkot, $year); //TPA
					$Petugas = "Pilih Tenaga TPA";
				}
			}
			//$get_data_penugasan = $id_fbg  == 1 ? $this->Mpenugasan->getTimTpt($id_kabkot, $year) : $this->Mpenugasan->getTimTpa($id_kabkot, $year);
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
				}else if($id_izin =='7'){
					$gb =  $p->glr_belakang; //TPT
				}else if($id_izin =='4'){
					$gb =  $p->glr_blkg; //TPA
						
				}else{
					if( $id_fbg =='1'){
						if($id_klasifikasi =='2'){
							$gb =  $p->glr_blkg; //TPA
						}else{
							$gb =  $p->glr_belakang; //TPT
						}
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
				}else if($id_izin =='7'){
					$nm =  $p->nama_personal; //TPT
				}else if($id_izin =='4'){
					$nm =  $p->nm_tpa; //TPA
				}else{
					if( $id_fbg =='1'){
						if($id_klasifikasi =='2'){
							$nm =  $p->nm_tpa; //TPA
						} else{
							$nm =  $p->nama_personal; //TPT
						}
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
				}else if($id_izin =='7'){
					$id_p =  $p->id_personal; //TPT
				}else if($id_izin =='4'){
					$id_p =  $p->id_tpanya; //TPA
				}else{
					if( $id_fbg =='1'){
						if($id_klasifikasi =='2'){
							$id_p =  $p->id_tpanya; //TPA
						} else {
							$id_p =  $p->id_personal; //TPT
						}
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
				'nama_kel_bg' => $row->nama_kec_bg,
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

	public function SimpanPenugasan2()
	{
		$id_pemilik = $this->input->post('id_pemilik');
		$tugas_personil = $this->input->post('tugas');
		$tgl_skrg 		= date('Y-m-d');
		if ($tugas_personil != NULL) {
			foreach ($tugas_personil as $key => $val) {
				$res[] = $val;
			}
			$k = array_unique($res);
			$cekPersonil = 	$this->Mpenugasan->cekPersonalPenugasan($id_pemilik, $k);
			if ($cekPersonil->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Personil Sudah Terpilih!');
				$this->session->set_flashdata('status', 'warning');
				redirect('Penugasan');
			} else {
				foreach ($tugas_personil as $key => $val) {
					$dataP[] = array(
						'id_personal' => $val,
						'id_pemilik' => $id_pemilik
					);
				}
				$tgl_log = date('Y-m-d');
				$data = array(
					'status' => 5,
					'post_date' => $tgl_log,
					'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
				);
				$datalog	= array(
					'tgl_status' => $tgl_skrg,
					'status' => '5',
					//'no_surat' => $no_surat,
					'id' => $id_pemilik,
					//'catatan' => $catatan,
					//'dir_file' => $filean,
					//'user_id' => $user_id,
					'modul' => 'Penugasan TPT/TPA'
				);
				$this->Mpenugasan->insertBatchPersonil($dataP);
				$this->Mpenugasan->updateStats($data, $id_pemilik);
				$this->Mglobals->setDatakol('th_data_konsultasia', $datalog);
				$this->session->set_flashdata('message', 'Data Penugasan Berhasil di Simpan');
				$this->session->set_flashdata('status', 'success');
				$this->kirimemailstatus($id_pemilik);
				$this->kirimemailtotpt($id_pemilik);
				redirect('Penugasan');
			}
		} else {
			$this->session->set_flashdata('message', 'Silahkan Pilih Tim Terlebih Dahulu!');
			$this->session->set_flashdata('status', 'warning');
			redirect('Penugasan');
		}
	}

	public function SimpanPenugasan()
	{
		$statsPenugasan 	= $this->input->post('statsPenugasan', true);
		$penugasan 			= $this->input->post('penugasan', TRUE);
		$noKonsultasi 		= $this->input->post('noKonsultasi', TRUE);
		$idPemilik 			= $this->input->post('idPemilik', TRUE);
		$tgl_skrg 			= date('Y-m-d');
		if ($statsPenugasan == 'TPT') {
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
			$datalog	= array(
				'tgl_status' => $tgl_skrg,
				'status' => '5',
				'id' => $idPemilik,
				'modul' => 'Penugasan TPT/TPA'
			);
			$this->Mpenugasan->insertBatchPersonil($petugas);
			$this->Mpenugasan->updateStats($data, $idPemilik);
			$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
			$this->kirimemailstatus($idPemilik);
			$this->kirimemailtotpt($idPemilik);
		} else {
			foreach ($penugasan as $r) {
				$dataP[] = array(
					'id' => $r['id'],
					'id_pemilik' => $idPemilik
				);
			}
			$tgl_log = date('Y-m-d');
			$data = array(
				'status' => 5,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$datalog	= array(
				'tgl_status' => $tgl_skrg,
				'status' => '5',
				'id' => $idPemilik,
				'modul' => 'Penugasan TPT/TPA'
			);
			$this->Mpenugasan->insertBatchPersonilTpa($dataP);
			$this->Mpenugasan->updateStats($data, $idPemilik);
			$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
			$this->kirimemailstatus($idPemilik);
			$this->kirimemailtotpa($idPemilik);
		}
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
			$query = $this->Mpenugasan->getEmailPemohon($id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$email_pemohon = $mydata['email'];
				$no_konsultasi = $mydata['no_konsultasi'];
			}
			$text_email .= "Dengan ini kami memberitahukan bahwa Permohonan dengan No.Registrasi $no_konsultasi <br>";
			$text_email .= "Telah Melakukan Penugasan TPT/TPA dan akan masuk proses untuk Penjadwalan Pemeriksaan Dokumen Teknis<br>";
			$text_email .= "<br>";
			$text_email .= "<br>";
			$text_email .= "Hormat Kami <br>";
			$text_email .= "Admin SIMBG ";	
			$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
			$mail->addAddress($email_pemohon);
			$mail->Subject = 'Penetapan TIM TPT/TPA | CS SIMBG';
			$mail->Body = $text_email;
			$mail->isHTML(true); 
			$mail->send();
		}
	}

	function kirimemailtotpt($id)
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
			$query = $this->Mpenugasan->getEmailPemohon($id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$email_pemohon = $mydata['email'];
				$no_konsultasi = $mydata['no_konsultasi'];
			}
			$query = $this->Mpenugasan->getEmailTpt($id)->result();;
			$text_email .= "Anda telah dipilih menjadi TPT untuk Permohonan dengan No Registrasi .$no_konsultasi <br>";	
			foreach ($query as $row) 
			{
				$text_email .= "- ".$row->nama_personal."<br>";
				$mail->AddCC($row->email, $row->nama_personal);
			}
			$text_email .= "<br>";
			$text_email .= "<br>";
			$text_email .= "Hormat Kami <br>";
			$text_email .= "Admin SIMBG ";
			$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
			//$mail->addAddress($email_pemohon);
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
			$query = $this->Mpenugasan->getEmailPemohon($id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$email_pemohon = $mydata['email'];
				$no_konsultasi = $mydata['no_konsultasi'];
			}
			$query = $this->Mpenugasan->getEmailTpa($id)->result();;
			$text_email .= "Anda telah dipilih menjadi TPA untuk Permohonan dengan No Registrasi .$no_konsultasi <br>";	
			foreach ($query as $row) 
			{
				$text_email .= "- ".$row->nm_tpa."<br>";
				$mail->AddCC($row->email, $row->nm_tpa);
			}
			$text_email .= "<br>";
			$text_email .= "<br>";
			$text_email .= "Hormat Kami <br>";
			$text_email .= "Admin SIMBG ";
			$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
			//$mail->addAddress($email_pemohon);
			$mail->Subject = 'Penetapan TIM TPA | CS SIMBG';
			$mail->Body = $text_email;
			$mail->isHTML(true); 
			$mail->send();
		}
	}

	function hapusPenugasan($id_petugas, $id_pemilik)
	{
		$process = $this->mglobals->deleteDataKey('tm_penugasan_pbg', 'id_personal', $id_petugas);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$cekPetugas = $this->Mpenugasan->cekTotalPetugas($id_pemilik);
			if ($cekPetugas->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
				$this->session->set_flashdata('status', 'success');
			} else {
				$tgl_log = date('Y-m-d');
				$data = array(
					'status' => 4,
					'post_date' => $tgl_log,
					'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
				);
				$this->Mpenugasan->updateStats($data, $id_pemilik);
				$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
				$this->session->set_flashdata('status', 'success');
			}
		}
		redirect('penugasan');
	}
	// End Penugasan Pemeriksa Dokumen
	// Penugasan Inspeksi
	public function inspeksi()
	{
		$id_fungsi_bg = $this->input->get('id_fungsi_bg', TRUE);
		$id_proses = $this->input->get('id_proses', TRUE);
		$tanggalawal = $this->input->get('tanggalawal', TRUE);
		$tanggalakhir = $this->input->get('tanggalakhir', TRUE);
		$SQLcari 	= "";
		$data['title']		=	'';
		$data['heading']	=	'';
		$search = $this->search([$id_fungsi_bg, $id_proses, $tanggalawal, $tanggalakhir]);
		$data['Penugasan'] = !isset($_GET['cari']) ? $this->Mpenugasan->getDataInspeksi(null, $SQLcari)->result() : $search;
		$data['content']	= $this->load->view('Inspeksi/inspeksi_list', $data, TRUE);
		$this->load->view('backend_adm', $data);
	}
	public function penugasan_inspeksi()
	{
		$year = date('Y');
		$id = $this->uri->segment(3);
		$que = $this->Mpenugasan->getDetailPengawas($id)->row_array();
		$id_kabkot = $que['id_kabkot_bgn'];
		$rew   = $this->Mpenugasan->getByIdPtugasInspeksi($id);
		$result = $this->Mpenugasan->getTimPenilik($id_kabkot, $year);
		$data = array(
			'judul' => 'Pilh Tim Penilik',
			'result' => $result->result(),
			'que' => $que,
			'rew' => $rew,
		);
		$this->load->view('inspeksi/inspeksi_form', $data);
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
			$cekPersonil = 	$this->Mpenugasan->cekPersonalPenugasanInspeksi($id_pemilik, $k);
			if ($cekPersonil->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Personil Sudah Terpilih!');
				$this->session->set_flashdata('status', 'warning');
				redirect('Penugasan/inspeksi');
			} else {
				foreach ($tugas_personil as $key => $val) {
					$dataP[] = array(
						'id' => $id_pemilik,
						'id_personal' => $val,
					);
				}
				$tgl_log = date('Y-m-d');
				$data = array(
					'status' => 5,
					'post_date' => $tgl_log,
					'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
				);
				$this->Mpenugasan->insertDataPenugasanInspeksi($dataP);
				$this->Mpenugasan->updateStats($data, $id_pemilik);
				$this->session->set_flashdata('message', 'Data Penugasan Inspeksi Berhasil di Simpan');
				$this->session->set_flashdata('status', 'success');
				redirect('Penugasan/inspeksi');
			}
		} else {
			$this->session->set_flashdata('message', 'Silahkan Pilih Tim Terlebih Dahulu!');
			$this->session->set_flashdata('status', 'warning');
			redirect('Penugasan/inspeksi');
		}
	}

	public function detail_inspeksi($id = NULL)
	{
		$year = $year = date('Y');
		$cekId = $this->Mpenugasan->getdetailPenugasan($id);
		$rew   = $this->Mpenugasan->getByIdPtugasInspeksi($id);
		if ($cekId->num_rows() > 0) {
			$row = $cekId->row();
			$id_fbg = $row->id_fungsi_bg;
			$id_kabkot = $row->id_kabkot_bgn;
			$result = $this->Mpenugasan->getTimPenilik($id_kabkot, $year);
			$data = array(
				'row' => $row,
				'rew' => $rew,
				'id_fbg' => $id_fbg,
				'result' => $result->result(),
			);
			$this->load->view('inspeksi/inspeksi_detail', $data);
		} else {
			echo 'tidak ditemukan';
		}
	}

	function hapusPenugasanInspeksi($id_petugas, $id_pemilik)
	{
		$process = $this->mglobals->deleteDataKey('tm_penugasan_inspeksi', 'id_personal', $id_petugas);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$cekPetugas = $this->Mpenugasan->cekTotalPetugas($id_pemilik);
			if ($cekPetugas->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
				$this->session->set_flashdata('status', 'success');
			} else {
				$tgl_log = date('Y-m-d');
				$data = array(
					'status' => 4,
					'post_date' => $tgl_log,
					'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
				);
				$this->Mpenugasan->updateStats($data, $id_pemilik);
				$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
				$this->session->set_flashdata('status', 'success');
			}
		}
		redirect('Penugasan/inspeksi');
	}
	// End Penugasan Inspeksi
	public function form_penugasan($id = NULL)
	{
		$id = $this->uri->segment(3);
		$year =date('Y');
		$que = $this->Mpenugasan->getDetailPengawas($id)->row_array();
		$id_kabkot = $que['id_kabkot_bgn'];
		$rew   = $this->Mpenugasan->getByIdPtugas($id);
		$id_fbg = $que['id_jenis_bg'];
		$result = $id_fbg == 1 ? $this->Mpenugasan->getTimTeknis($id_kabkot,$year) : $this->Mpenugasan->getTimTabg($id_kabkot,$year);
		$data = array(
			'judul' => $id_fbg == 1 ? 'Pilih TPT' : 'Pilih TPA',
			'result' => $result->result(),
			'que' => $que,
			'rew' => $rew,
		);
		$this->load->view('FormPenugasan', $data);
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
			$cekPersonil = 	$this->Mpenugasan->cekPersonalPenugasanTpa($id_pemilik, $k);
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
				$this->Mpenugasan->insertBatchPersonilTpa($dataP);
				$this->Mpenugasan->updateStats($data, $id_pemilik);
				$this->session->set_flashdata('message', 'Data Penugasan Berhasil di Simpan');
				$this->session->set_flashdata('status', 'success');
				$this->kirimemailstatus($id_pemilik);
				$this->kirimemailtotpa($id_pemilik);
				redirect('Penugasan');
			}
		} else {
			$this->session->set_flashdata('message', 'Silahkan Pilih Tim Terlebih Dahulu!');
			$this->session->set_flashdata('status', 'warning');
			redirect('Penugasan');
		}
	}
	public function cetak()
	{
		$id_fungsi_bg = $this->session->userdata('id_fungsi_bg');
		$id_proses = $this->session->userdata('id_proses');
		$tanggalawal = $this->session->userdata('tanggalawal');
		$tanggalakhir = $this->session->userdata('tanggalakhir');
		$SQLcari 	= array();
		if ($id_fungsi_bg != '') {
			$SQLcari['id_fungsi_bg'] = !empty($id_fungsi_bg) ? $id_fungsi_bg : '';
		}
		if ($id_proses != '') {

			$SQLcari['id_proses'] = !empty($id_proses) ? $id_proses : '';
		}
		if ($tanggalawal != '') {
			$SQLcari['tanggalawal'] = !empty($tanggalawal) ? $tanggalawal : '';
		}
		if ($id_fungsi_bg != '') {
			$SQLcari['tanggalakhir'] = !empty($tanggalakhir) ? $tanggalakhir : '';
		}
		$data['Penugasan'] = $this->Mpenugasan->getListPenugasanDok($SQLcari);
		$this->load->view('PrintPenugasanList', $data);
	}

	public function Rollback($id){
		$id	= $this->uri->segment(3);
		$pernyataan = '1';
		$tgl_skrg 	= date('Y-m-d');
		if ($pernyataan == '1') {
			$data	= array(
				'status' => '2',
			);
			$datalog	= [
				'id' => $id,
				'tgl_status' => $tgl_skrg,
				'status' => '3',
				'catatan' => 'Kabid/Kasie melakukan Mengembalikan Permohonan  Ke Tahap Verifikasi Untuk Pengecekan Ulang',
				'modul' => 'Permohonan DIkembalikan ke Tahap Verifikasi Dokumen'
			];
			$this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
			$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
			$this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Verifikasi');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Penugasan' );
	}

}
