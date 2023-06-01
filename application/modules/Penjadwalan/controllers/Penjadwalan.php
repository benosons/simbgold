<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Penjadwalan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Mpenjadwalan', 'mglobal']);
		$this->load->helper('utility');
		$this->load->library(['oss_lib', 'simbg_lib']);
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->simbg_lib->check_session_login();
	}

	public function index()
	{
		$search = $this->input->post('search');
		$SQLcari 	= "";
		if ($search != '') {
			$SQLcari = array(
				'id_fungsi_bg' => trim($this->input->post('id_fungsi_bg')),
				'id_proses' => trim($this->input->post('id_proses')),
				'tanggalawal' => trim($this->input->post('tanggalawal')),
				'tanggalakhir' => trim($this->input->post('tanggalakhir'))
			);
			$this->session->set_userdata($SQLcari);
			$data = array(
				'id_fungsi_bg' => trim($this->input->post('id_fungsi_bg')),
				'id_proses' => trim($this->input->post('id_proses')),
				'tanggalawal' => trim(tgl_ind_to_eng($this->input->post('tanggalawal'))),
				'tanggalakhir' => trim(tgl_ind_to_eng($this->input->post('tanggalakhir')))
			);
		}
		$data['datapbg'] = $this->Mpenjadwalan->getDataKonsultasi($SQLcari)->result();
		$data['title'] = '';
		$data['heading'] = '';
		$this->template->load('template/template_backend', 'penjadwalan/penjadwalan_list', $data);
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
		$data['datapbg'] = $this->Mpenjadwalan->getDataKonsultasi($SQLcari)->result();

		$this->load->view('penjadwalan/PrintPenjadwalan_list', $data);
	}

	public function konsultasi()
	{
		$id = $this->Outh_model->Encryptor('decrypt', $this->input->post('id', TRUE));
		$getId = $this->Mpenjadwalan->cekDataBangunan($id);
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

			$countJadwal = $this->Mpenjadwalan->getCountJadwal($row->id_pemilik)->num_rows();
			$nextKonsultasi = $countJadwal + 1;
			$getPenjadwalanList = $this->Mpenjadwalan->getPenjadwalanById($row->id_pemilik);
			$tgl_pernyataan = $row->tgl_pernyataan;
			$date_plus = new DateTime($tgl_pernyataan);
			$lama_proses = intval($row->lama_proses);
			$date_plus->modify("+{$lama_proses} days");
			$hasil_tgl = $date_plus->format("d-m-Y");
			$tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
			$id_izin = $row->id_izin;
			$id_fbg = $row->id_fungsi_bg;
			$id_klasifikasi = $row->id_klasifikasi;
			if ($id_izin == '2') { // Bangunan Eksisting 
				if ($id_fbg == '1') {
					$rew =  $this->Mpenjadwalan->getByIdPtugas($id); //TPT
				} else {
					$rew =  $this->Mpenjadwalan->getByIdPtugas($id); //TPT
				}
				$rew =  $this->Mpenjadwalan->getByIdPtugas($id); //TPT
			} else if($id_izin == '7'){ //Pertashop
				$rew =  $this->Mpenjadwalan->getByIdPtugas($id); //TPT
			}else{ // Bangunan Baru
				if ($id_fbg == '1') {
					if($id_klasifikasi == '2'){ // Bangunan Tidak Sederhana
						$rew =  $this->Mpenjadwalan->getByIdPtugasTPA($id); //TPA
					} else { // Bangunan Sederhana
						$rew =  $this->Mpenjadwalan->getByIdPtugas($id); //TPT
					}
				} else {
					$rew =  $this->Mpenjadwalan->getByIdPtugasTPA($id); //TPA
				}
			}
			$penugasan = [];
			foreach ($rew->result() as $p) {
				$gelar_depan = $p->glr_depan != '' && $p->glr_depan != NULL ? $p->glr_depan . ' ' : '';
				if ($id_izin == '2') {
					if ($id_fbg == '1') {
						$gb =  $p->glr_belakang; //TPT
					} else {
						$gb =  $p->glr_belakang; //TPT
					}
					$gb =  $p->glr_belakang; //TPT
				} else if ($id_izin == '7'){
					$gb =  $p->glr_belakang; //TPT
				}else{
					if ($id_fbg == '1') {
						if($id_klasifikasi == '2'){
							$gb =  $p->glr_blkg; //TPA
						} else {
							$gb =  $p->glr_belakang; //TPT
						}
					} else {
						$gb =  $p->glr_blkg; //TPA
					}
				}
				$gelar_belakang = $gb != '' && $gb != NULL ? $gb . ' ' : '';
				if ($id_izin == '2') {
					if ($id_fbg == '1') {
						$nm =  $p->nama_personal; //TPT
					} else {
						$nm =  $p->nama_personal; //TPT
					}
					$nm =  $p->nama_personal; //TPT
				} else if($id_izin == '7'){
					$nm =  $p->nama_personal; //TPT
				}else{
					if ($id_fbg == '1') {
						if ($id_klasifikasi == '2'){
							$nm =  $p->nm_tpa; //TPA
						}else {
							$nm =  $p->nama_personal; //TPT
						}
					} else {
						$nm =  $p->nm_tpa; //TPA
					}
				}
				$nama_personal = $nm != '' && $nm != NULL ? $nm : '';
				if ($id_izin == '2') {
					if ($id_fbg == '1') {
						$id_p =  $p->id_personal; //TPT
					} else {
						$id_p =  $p->id_personal; //TPT
					}
					$id_p =  $p->id_personal; //TPT
				} else if($id_izin == '7'){
					$id_p =  $p->id_personal; //TPT
				}else{
					if ($id_fbg == '1') {
						if($id_klasifikasi == '2'){
							$id_p =  $p->id; //TPA
						} else {
							$id_p =  $p->id_personal; //TPT
						}
					} else {
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

			$csrf = $this->security->get_csrf_hash();
			$data = array(
				'csrf' => $csrf,
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
		$tipe_konsultasi = $this->input->post('tipe_konsultasi', TRUE);
		$linkMeeting = $this->input->post('linkMeeting', TRUE);
		$passwordMeeting = $this->input->post('passwordMeeting', TRUE);
		$konsultasi_ke = explode('-', $this->input->post('konsultasi_ke', TRUE));
		$tanggal_konsultasi = $this->input->post('tanggal_konsultasi', TRUE);
		$jam_konsultasi = $this->input->post('jam_konsultasi', TRUE);
		$ketempat = $this->input->post('ketempat', TRUE);
		$email	=  $this->input->post('email', TRUE);
		$noreg = $this->input->post('noreg', TRUE);
		$primary = $this->input->post('id', TRUE);
		$tgl_skrg 		= date('Y-m-d');
		$config['upload_path'] 		= 'object-storage/dekill/Schedule/';
		//$config['upload_path'] 		= 'mnt/object-storage/dekill/Schedule/';
		$config['allowed_types'] 	= 'pdf|PDF';
		$config['max_size']			= '512000';
		$config['encrypt_name']		= TRUE;
		$config['remove_space']		= TRUE;
		$this->load->library('upload', $config, 'uploads');
		if (!$this->uploads->do_upload('berkas')) {
			$this->session->set_flashdata('message', 'Silahkan Upload File Undangan Konsultasi Terlebih Dahulu!.');
			$this->session->set_flashdata('status', 'danger');
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		} else {
			if ($this->uploads->data('file_ext') == ".pdf") {
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
				$datalog	= array(
					'id' => $primary,
					'tgl_status' => $tgl_skrg,
					'status' => '6',
					'catatan' => $ketempat,
					'dir_file' => $this->uploads->data('file_name'),
					'modul' => 'Penjawalan Konsultasi'
				);
				$this->Mpenjadwalan->insertDataKonsultasi($data);
				$this->Mpenjadwalan->updateStats($status, $primary);
				$this->kirimjadwalkonsultasi($$primary, $tanggal_konsultasi, $jam_konsultasi, $konsultasi_ke, $ketempat, $email, $noreg);
				$this->kirimemailtotpa($primary,$tanggal_konsultasi,$jam_konsultasi,$ketempat);
				//$this->kirimemailtotpa($primary);
				$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
				$this->session->set_flashdata('message', 'Konsultasi Berhasil Disimpan!');
				$this->session->set_flashdata('status', 'success');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} else if ($this->uploads->data('file_ext') == ".PDF") {
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
				$datalog	= array(
					'id' => $primary,
					'tgl_status' => $tgl_skrg,
					'status' => '6',
					'catatan' => $ketempat,
					'dir_file' => $this->uploads->data('file_name'),
					'modul' => 'Penjawalan Konsultasi'
				);
				$this->Mpenjadwalan->insertDataKonsultasi($data);
				$this->Mpenjadwalan->updateStats($status, $primary);
				$this->kirimemailtotpa($primary,$tanggal_konsultasi,$jam_konsultasi,$ketempat);
				//$this->kirimjadwalkonsultasi($$primary, $tanggal_konsultasi, $jam_konsultasi, $konsultasi_ke, $ketempat, $email, $noreg);
				//$this->kirimemailtotpa($primary);
				$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
				$this->session->set_flashdata('message', 'Konsultasi Berhasil Disimpan!');
				$this->session->set_flashdata('status', 'success');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} else {
				$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
				$this->session->set_flashdata('status', 'warning');
				$path = FCPATH . "'object-storage/dekill/Schedule/'";
				$berkas = $path . $this->uploads->data('file_name');
				if (!unlink($berkas)) {
					$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
					$this->session->set_flashdata('status', 'warning');
				}
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		}
	}

	function kirimjadwalkonsultasi($primary, $tanggal_konsultasi, $jam_konsultasi, $konsultasi_ke, $ketempat, $email, $noreg)
	{
		$email = $email;
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
		$mail->Username = 'simbg@pu.go.id';
		$mail->Password = 'SIMBG2020!!';
		$mail->WordWrap = 50;
		if (!is_null($primary) && (trim($primary) != '') && (trim($primary) != '0')) {
			$text_email .= "Undangan Konsultasi :<br>";
			$text_email .= "No Registrasi :" . $noreg . "<br>";
			$text_email .= "Tanggal :" . $tanggal_konsultasi . "<br>";
			$text_email .= "Jam :" . $jam_konsultasi . "<br>";
			$text_email .= "Keterangan :" . $ketempat . "<br>";
			$text_email .= "TIM TPT :<br>";
			$query = $this->Mpenjadwalan->getEmailTpt($primary)->result();;
			foreach ($query as $row) {
				$text_email .= "- " . $row->nama_personal . "<br>";
				$mail->AddCC($row->email, $row->nama_personal);
			}
			//if($dir_file_undangan != ''){
			if (!is_null($lampiran_undangan) && (trim($lampiran_undangan) != '')) {
				//$dirPath = $thisdir . "/file/PBG/$noreg/konsultasi/undangan_konsultasi/";
				$file = realpath('./object-storage/file/PBG/' . $noreg / 'konsultasi/undangan_konsultasi');
				$mail->AddAttachment($file, 'UndanganKonsultasi.pdf');
			}
			$text_email .= "<br>";
			$text_email .= "Di Mohon Untuk Hadir Tepat Pada Waktunya<br>";
			$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
			$mail->addAddress($email);
			$mail->Subject = 'Undangan Konsultasi PBG/SLF | CS SIMBG';
			$mail->Body = $text_email;
			$mail->isHTML(true);
			$mail->send();
			$this->session->set_flashdata('message', 'Penjadwalan Sidang Berhasil Disimpan !.');
			$this->session->set_flashdata('status', 'success');
		}
	}

	public function Rollback($id) {
		$id	= $this->uri->segment(3);
		$pernyataan = '1';
		$tgl_skrg 	= date('Y-m-d');
		if ($pernyataan == '1') {
			$data	= array(
				'status' => '4',
			);
			$datalog	= [
				'id' => $id,
				'tgl_status' => $tgl_skrg,
				'status' => '5',
				'catatan' => 'Kabid/Kasie melakukan Mengembalikan Permohonan  Ke Tahap Penugasan TPA/TPT',
				'modul' => 'Permohonan Dikembalikan ke Tahap Penugasan TPA/TPT'
			];
			$this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
			$this->Mpenjadwalan->removeDataTpa($id);
			$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
			$this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Verifikasi');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Penjadwalan' );
	}

	function kirimemailtotpa($primary,$tanggal_konsultasi,$jam_konsultasi,$ketempat)
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
		$mail->Username = 'simbg@pu.go.id';
		$mail->Password = 'SIMBG2020!!';
		$mail->WordWrap = 50;
		if (!is_null($primary) && (trim($primary) != '') && (trim($primary) != '0')) {
			$query = $this->Mpenjadwalan->getEmailPemohon($primary);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1) {
				$email_pemohon = $mydata['email'];
				$no_konsultasi = $mydata['no_konsultasi'];
			}
			$query = $this->Mpenjadwalan->getEmailTpa($primary)->result();;
			foreach ($query as $row) {
				$text_email .= "Tgl. Konsultasi:  $tanggal_konsultasi <br>";
				$text_email .= "Jam. Konsultasi:  $jam_konsultasi <br>";
				$text_email .= "Catatan 			 :  $ketempat <br>";
				//$text_email .= "- " . $row->nm_tpa . "<br>";
				$mail->AddCC($row->email, $row->nm_tpa);
			}
			$text_email .= "Sebagai TIM TPA untuk permohonan dengan No. Registrasi :" . $no_konsultasi . "<br>";
			$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
			$mail->Subject = 'Penetapan TIM TPA | CS SIMBG';
			/*if (!is_null($berkas) && (trim($berkas) != '')) {
				$file = realpath('./Dekill/Schedule/');
				$mail->AddAttachment($file, 'UndanganKonsultasi.pdf');
			}*/
			$mail->Body = $text_email;
			$mail->isHTML(true);
			$mail->send();
		}
	}
}

/* End of file Penjadwalan.php */
