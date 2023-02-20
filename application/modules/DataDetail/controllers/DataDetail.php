<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class DataDetail extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination');
		$this->load->model('MDataDetail');
		$this->load->library('simbg_lib');
		// $this->simbg_lib->check_session_login();
	}
	public function index()
	{
		//$this->killSession();
	}

	//Begin Data Detail Verifikasi Kelengkapan Dokumen
	public function DetailVerifikasi()
	{
		$id = $this->input->post('id', TRUE);
		$cekDataBangunan = $this->MDataDetail->cekDataBangunan($id);
		if ($cekDataBangunan->num_rows() > 0) {
			$row = $cekDataBangunan->row();
			$LuasBg = 0;
			$id_jenis_permohonan = $row->id_jenis_permohonan;
			if ($id_jenis_permohonan == 11 || $id_jenis_permohonan == 29 || $id_jenis_permohonan == 30 || $id_jenis_permohonan == 31 || $id_jenis_permohonan == 32 || $id_jenis_permohonan == 33 || $id_jenis_permohonan == 34 ) {
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
						$luas_total_kolektif  = bcadd(0, $LuasBg, 2);
					}
				}
			} else {
				$hasil_kolektif = 0;
				$luas_total_kolektif  = bcadd(0, $LuasBg, 2);
			}
			$tgl_pernyataan = $row->tgl_pernyataan;
			$date_plus = new DateTime($tgl_pernyataan);
			$lama_proses = intval($row->lama_proses);
			$date_plus->modify("+{$lama_proses} days");
			$hasil_tgl = $date_plus->format("d-m-Y");
			$tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
			$getDataTanah = $this->MDataDetail->getDataTanahPbg($id)->result();
			$getDataHistory = $this->MDataDetail->getDataHistory($id)->result();
			$id_jenis_permohonan = $row->id_jenis_permohonan;
			$getTeknisTanah = $this->MDataDetail->getSyaratList($id_jenis_permohonan, '1', null)->result();
			$syarat_tanah = [];
			foreach ($getTeknisTanah as $g) {
				$getSyarat = $this->MDataDetail->getSyarat($g->id_detail, $id)->row();
				$berkas = $getSyarat == NULL ? null : $getSyarat->dir_file;
				$dir_file = $berkas == NULL ? false : $getSyarat->dir_file;
				$oldFIle = FCPATH . 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				$dir = '';
				if (file_exists($oldFIle)) {
					$dir = 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				} else {
					$dir = 'object-storage/dekill/Requirement/' . $dir_file;
				}
				$syarat_tanah[] = [
					'nm_dokumen' => $g->nm_dokumen,
					'keterangan' => $g->keterangan,
					'dir_file' => $berkas == NULL ? false : $dir,
				];
			}
			$getDataUmum = $this->MDataDetail->getSyaratList($id_jenis_permohonan, '5', null)->result();
			$syarat_umum = [];
			foreach ($getDataUmum as $g) {
				$getSyarat = $this->MDataDetail->getSyarat($g->id_detail, $id)->row();
				$berkas = $getSyarat == NULL ? NULL : $getSyarat->dir_file;
				$dir_file = $berkas == NULL ? false : $getSyarat->dir_file;
				$oldFIle = FCPATH . 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				$dir = '';
				if (file_exists($oldFIle)) {
					$dir = 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				} else {
					$dir = 'object-storage/dekill/Requirement/' . $dir_file;
				}
				$syarat_umum[] = [
					'nm_dokumen' => $g->nm_dokumen,
					'keterangan' => $g->keterangan,
					'dir_file' => $berkas == NULL ? false : $dir,
				];
			}
			$getArsitektur = $this->MDataDetail->getSyaratList($id_jenis_permohonan, '2', null)->result();
			$syarat_arsitektur = [];
			foreach ($getArsitektur as $g) {
				$getSyarat 	= $this->MDataDetail->getSyarat($g->id_detail, $id)->row();
				$berkas 	= $getSyarat == NULL ? NULL : $getSyarat->dir_file;
				$dir_file 	= $berkas == NULL ? false : $getSyarat->dir_file;
				$oldFIle 	= FCPATH . 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				$dir = '';
				if (file_exists($oldFIle)) {
					$dir = 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				} else {
					$dir = 'object-storage/dekill/Requirement/' . $dir_file;
				}
				$syarat_arsitektur[] = [
					'nm_dokumen' 	=> $g->nm_dokumen,
					'keterangan' 	=> $g->keterangan,
					'dir_file' 		=> $berkas == NULL ? false : $dir,
				];
			}
			$getStruktur = $this->MDataDetail->getSyaratList($id_jenis_permohonan, '3', null)->result();
			$syarat_struktur = [];
			foreach ($getStruktur as $g) {
				$getSyarat 	= $this->MDataDetail->getSyarat($g->id_detail, $id)->row();
				$berkas 	= $getSyarat == NULL ? NULL : $getSyarat->dir_file;
				$dir_file 	= $berkas == NULL ? false : $getSyarat->dir_file;
				$oldFIle 	= FCPATH . 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				$dir = '';
				if (file_exists($oldFIle)) {
					$dir = 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				} else {
					$dir = 'object-storage/dekill/Requirement/' . $dir_file;
				}
				$syarat_struktur[] = [
					'nm_dokumen' 	=> $g->nm_dokumen,
					'keterangan' 	=> $g->keterangan,
					'dir_file' 		=> $berkas == NULL ? false : $dir,
				];
			}
			$getMep = $this->MDataDetail->getSyaratList($id_jenis_permohonan, '4', null)->result();
			$syarat_mep = [];
			foreach ($getMep as $g) {
				$getSyarat = $this->MDataDetail->getSyarat($g->id_detail, $id)->row();
				$berkas 	= $getSyarat == NULL ? NULL : $getSyarat->dir_file;
				$dir_file 	= $berkas == NULL ? false : $getSyarat->dir_file;
				$oldFIle 	= FCPATH . 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				$dir = '';
				if (file_exists($oldFIle)) {
					$dir = 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				} else {
					$dir = 'object-storage/dekill/Requirement/' . $dir_file;
				}
				$syarat_mep[] = [
					'nm_dokumen' 	=> $g->nm_dokumen,
					'keterangan' 	=> $g->keterangan,
					'dir_file' 		=> $berkas == NULL ? false : $dir,
				];
			}
			$tanah = [];
			foreach ($getDataTanah as $t) {
				$dir_file = $t->dir_file == NULL ? false : $t->dir_file;
				$oldFIleTanah = FCPATH . 'object-storage/file/Konsultasi/' . $id . '/data_tanah/' . $dir_file;
				$dir = '';
				if (file_exists($oldFIleTanah)) {
					$dir = 'object-storage/file/Konsultasi/' . $id . '/data_tanah/' . $dir_file;
				} else {
					$dir = 'object-storage/dekill/Earth/' . $dir_file;
				}
				$dir_file_phat = $t->dir_file_phat == NULL ? false : $t->dir_file_phat;
				$oldFIlePhat = FCPATH . 'object-storage/file/Konsultasi/' . $id . '/data_tanah/' . $dir_file_phat;
				$dir_phat = '';
				if (file_exists($oldFIlePhat)) {
					$dir_phat = 'object-storagefile/Konsultasi/' . $id . '/data_tanah/' . $dir_file_phat;
				} else {
					$dir_phat = 'object-storage/dekill/Earth/' . $dir_file_phat;
				}
				$tanah[] = [
					'no_dok' => $t->no_dok,
					'tanggal_dok' => $t->tanggal_dok,
					'jenis_dokumen' => $t->jenis_dokumen,
					'luas_tanah' => $t->luas_tanah,
					'atas_nama_dok' => $t->atas_nama_dok,
					'dir_file' => $t->dir_file == NULL ? false : $dir,
					'dir_file_phat' => $t->dir_file_phat == NULL ? false : $dir_phat,
				];
			}
			$history = [];
			foreach ($getDataHistory as $h){
				$dir_file = $h->dir_file == NULL ? false : $h->dir_file;
				$oldFIleTanah = FCPATH . 'object-storage/file/Konsultasi/' . $id .'/' . $dir_file;
				$dir = '';
				if (file_exists($oldFIleTanah)) {
					$dir = 'object-storage/dekill/Consultation/' . $dir_file;
				
				} else {
					$dir = 'object-storage/dekill/Consultation/' . $dir_file;
				}
				$history[] = [
					'tgl_status' => $h->tgl_status,
					'catatan' => $h->catatan,
					'post_by' => $h->post_by,
					'dir_file' => $h->dir_file == NULL ? false : $dir,
				];
			}
			$data = [
				'no_konsultasi' => $row->no_konsultasi,
				'id_jenis_permohonan' => $row->id_jenis_permohonan,
				'hasil_kolektif' => $hasil_kolektif,
				'luas_total_kolektif' => $luas_total_kolektif,
				'nm_pemilik' => $row->nm_pemilik,
				'fungsi_bg' => $row->fungsi_bg,
				'almt_bgn' => $row->almt_bgn,
				'nm_konsultasi' => $row->nm_konsultasi,
				'alamat' => $row->alamat,
				'nama_kecamatan' => $row->nama_kecamatan,
				'nama_kabkota' => $row->nama_kabkota,
				'nama_prov_pemilik' => $row->nama_prov_pemilik,
				'almt_bgn' => $row->almt_bgn,
				'nama_kel_bg' => $row->nama_kel_bg,
				'nama_kec_bg' => $row->nama_kec_bg,
				'nama_kabkota_bg' => $row->nama_kabkota_bg,
				'nama_provinsi_bg' => $row->nama_provinsi_bg,
				'fungsi_bg' => $row->fungsi_bg,
				'luas_bgn' => $row->luas_bgn,
				'luas_bgp' => $row->luas_bgp,
				'tinggi_bgn' => $row->tinggi_bgn,
				'tinggi_bgp' => $row->tinggi_bgp,
				'jml_lantai' => $row->jml_lantai,
				'jns_prasarana' => $row->jns_prasarana,
				'tgl_pernyataan' => $tgl_pernyataan,
				'lama_proses' => $row->lama_proses == NULL ? 0 : $row->lama_proses,
				'hasil_tgl' => $hasil_tgl,
				'no_hp' => $row->no_hp,
				'email' => $row->email,
				'no_ktp' => $row->no_ktp,
				'nm_bgn' => $row->nm_bgn,
				'luas_basement' => $row->luas_basement,
				'lapis_basement' => $row->lapis_basement,
				'klasifikasi_bg' => $row->klasifikasi_bg,
				'tanah' => empty($tanah) ? 0 : $tanah,
				'id_pemilik' => $row->id_pemilik,
				'syarat_tanah' => $syarat_tanah,
				'syarat_umum' => $syarat_umum,
				'syarat_arsitektur' => $syarat_arsitektur,
				'syarat_struktur' => $syarat_struktur,
				'syarat_mep' => $syarat_mep,
				'history'	=> $history,
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
	// End Data Detail Verifikasi Kelengkapan Dokumen

	function DataKonsultasi()
	{
		$id = $this->uri->segment(3);
		$data['id'] = $id;
		//Begin Data Pemilik Bangunan Gedung
		if (trim($id) != '' && trim($id) != '') {
			$query = $this->MDataDetail->getDetailPemilik($id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1) {
				$data['nm_pemilik'] = $mydata['nm_pemilik'];
				$data['glr_depan'] = $mydata['glr_depan'];
				$data['glr_belakang'] = $mydata['glr_belakang'];
				$data['alamat'] = $mydata['alamat'];
				$data['nm_kecamatan'] = $mydata['nama_kecamatan'];
				$data['nm_kabkota'] = $mydata['nama_kabkota'];
				$data['nm_provinsi'] = $mydata['nama_provinsi'];
				$data['email'] = $mydata['email'];
				$data['no_identitas'] = $mydata['no_ktp'];
				$data['no_kontak'] = $mydata['no_hp'];
			}
		}
		//End Data Pemilik Bangunan Gedung
		//Begin Data Bangunan Gedung
		if (trim($id) != '' && trim($id) != '') {
			$queryBangunan = $this->MDataDetail->getDetailBangunan($id);
			$mybangunan = $queryBangunan->row_array();
			$line = $queryBangunan->num_rows();
			if ($line >= 1) {
				$data['no_konsultasi'] = $mybangunan['no_konsultasi'];
				$data['luas_bgn'] = $mybangunan['luas_bgn'];
				$data['luas_bgp'] = $mybangunan['luas_bgp'];
				$data['jml_lantai'] = $mybangunan['jml_lantai'];
				$data['tinggi_bgn'] = $mybangunan['tinggi_bgn'];
				$data['tinggi_bgp'] = $mybangunan['tinggi_bgp'];
				$data['almt_bgn'] = $mybangunan['almt_bgn'];
				$data['nm_kec_bgn'] = $mybangunan['nama_kecamatan'];
				$data['nm_kabkota_bgn'] = $mybangunan['nama_kabkota'];
				$data['nm_prov_bgn'] = $mybangunan['nama_provinsi'];
				$data['status'] = $mybangunan['status'];
				$data['tipeA'] = $mybangunan['tipeA'];
				$data['luasA'] = $mybangunan['luasA'];
				$data['lantaiA'] = $mybangunan['lantaiA'];
				$data['tinggiA'] = $mybangunan['tinggiA'];
				$data['jumlahA'] = $mybangunan['jumlahA'];
				$data['nm_konsultasi'] = $mybangunan['nm_konsultasi'];
				$data['id_jenis_permohonan'] = $mybangunan['id_jenis_permohonan'];
				$data['file_retribusi'] = $mybangunan['file_retribusi'];
			}
		}
		//End Data Bangunan Gedung
		//Begin Data Tanah
		if (trim($id) != '') {
			$que2 = $this->MDataDetail->getDetailTanah($id);
			$data['jmltanah'] = $que2->num_rows();
			$data['result_tanah'] = $que2->result_array();
		}
		//End Data Tanah
		//Begin Data Tim Teknis/TPA

		//End Data Tim Teknis/TPA
		//Begin Data Konsultasi
		if (trim($id) != '') {
			$query = $this->MDataDetail->getDataJadwal($id);
			$data['jumdata_penjadwalan'] = $query->num_rows();
			$data['ResultsJadwal'] = $query->result_array();
		}
		//End Data Konsultasi
		$data['title']		=	'';
		$data['heading']		=	'';
		$this->load->view('DataDetail', $data);
	}
	// Detail Retribusi 

	function DetailRetribusi()
	{
		$id = $this->input->post('id', TRUE);
		$cekDataBangunan = $this->MDataDetail->cekDataBangunan($id);
		if ($cekDataBangunan->num_rows() > 0) {
			$row = $cekDataBangunan->row();
			$LuasBg = 0;
			$id_jenis_permohonan = $row->id_jenis_permohonan;
			if ($id_jenis_permohonan == 11 || $id_jenis_permohonan == 29 || $id_jenis_permohonan == 30 || $id_jenis_permohonan == 31 || $id_jenis_permohonan == 32 || $id_jenis_permohonan == 33 || $id_jenis_permohonan == 34) {
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
						$luas_total_kolektif  = bcadd(0, $LuasBg, 3);
					}
				}
			} else {
				$hasil_kolektif = 0;
				$luas_total_kolektif  = bcadd(0, $LuasBg, 3);
			}
			//$id_jenis_permohonan = $row->id_jenis_permohonan;
			$tgl_pernyataan = $row->tgl_pernyataan;
			$date_plus 		= new DateTime($tgl_pernyataan);
			$lama_proses 	= intval($row->lama_proses);
			$date_plus->modify("+{$lama_proses} days");
			$hasil_tgl 		= $date_plus->format("d-m-Y");
			$tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
			$getRetribusi 	= $this->MDataDetail->cekRetribusi($id);
			$getPrasarana 	= $this->MDataDetail->getPrasarana($id)->result();
			$prasarana = [];
			foreach ($getPrasarana as $r) {
				$prasarana[] = [
					'nama_prasarana' => $r->nama_prasarana,
					'plv' => $r->plv,
					'harga_prasarana' => str_replace(',', '.', (number_format($r->harga_prasarana))),
					'total_prasarana' => str_replace(',', '.', (number_format($r->total_prasarana)))
				];
			}
			if ($getRetribusi->num_rows() > 0) {
				$retribusi = $getRetribusi->row();
				$retribusi_bangunan = str_replace(',', '.', (number_format($retribusi->nilai_retribusi_bangunan)));
				$filename = FCPATH . "/object-storage/dekill/Retribution/$retribusi->file_retribusi";
				$oldFIle = FCPATH . 'object-storage/file/konsultasi/' . $id . '/retribusi/berkas_retribusi/' . $retribusi->file_retribusi;;
				$dir = '';
				if (file_exists($oldFIle)) {
					$dir = 'object-storage/file/konsultasi/' . $id . '/retribusi/berkas_retribusi/' . $retribusi->file_retribusi;
				} else {
					$dir = 'object-storage/dekill/Retribution/' . $retribusi->file_retribusi;
				}
				$data = [
					'no_konsultasi' => $row->no_konsultasi,
					'id_jenis_permohonan' => $row->id_jenis_permohonan,
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
					'luas_bgp' => $row->luas_bgp,
					'tinggi_bgn' => $row->tinggi_bgn,
					'tinggi_bgp' => $row->tinggi_bgp,
					'jns_prasarana' => $row->jns_prasarana,
					'jml_lantai' => $row->jml_lantai,
					'hasil_kolektif' => $hasil_kolektif,
					'luas_total_kolektif' => $luas_total_kolektif,
					'tgl_pernyataan' => $tgl_pernyataan,
					'lama_proses' => $row->lama_proses == NULL ? 0 : $row->lama_proses,
					'hasil_tgl' => $hasil_tgl,
					'nilai_retribusi_bangunan' => str_replace(',', '.', number_format($retribusi->nilai_retribusi_bangunan)),
					'status_perhitungan' => $retribusi->status_perhitungan == 2 ? 'Hitung Berdasarkan PERDA' : 'Hitung Berdasarkan Sistem',
					'nilai_retribusi_prasarana' => str_replace(',', '.', number_format($retribusi->nilai_retribusi_prasarana)),
					'nilai_retribusi_keseluruhan' => str_replace(',', '.', number_format($retribusi->nilai_retribusi_keseluruhan)),
					'stats_retribusi' => $retribusi->status_perhitungan,
					'res' => true,
					'berkas_retribusi' => $dir,
					'permanensi' => $retribusi->id_permanensi == 1 ? 'Permanen' : 'Non Permanen',
					'parameter_permanensi' => "0.2 x {$retribusi->id_permanensi}",
					'parameter_fungsi' => $retribusi->parameter_fungsi,
					'id_klasifikasi_bg' => $row->id_klasifikasi_bg == NULL ? '' : $row->id_klasifikasi_bg,
					'klasifikasi_bg' => $row->klasifikasi_bg == NULL ? '' : $row->klasifikasi_bg, 'parameter_kompleksitas' => $retribusi->parameter_kompleksitas,
					'parameter_ketinggian' => $retribusi->parameter_ketinggian,
					'id_fungsi' => $row->id_fungsi_bg,
					'kepemilikan' => $row->id_fungsi_bg == 1 ? 1 : 0,
					'jns_pemilik' => $row->jns_pemilik == 1 ? 0 : 1,
					'indeks_integrasi' => $retribusi->indeks_integrasi,
					'shst' => str_replace(',', '.', number_format($retribusi->shst)),
					'indeks_lokalitas' => $retribusi->indeks_lokalitas,
					'kegiatan' => $retribusi->nama_kegiatan,
					'parameter_kegiatan' => "{$retribusi->prefix1} x {$retribusi->prefix2} = {$retribusi->index_kegiatan}",
					'hasil_retribusi_bgn' => "{$row->luas_bgn} x ({$retribusi->indeks_lokalitas} x {$retribusi->indeks_integrasi} x {$retribusi->index_kegiatan}) = Rp.{$retribusi_bangunan}",
					'prasarana' => empty($prasarana) ? 0 : $prasarana
				];
				header('Content-Type: application/json');
				echo json_encode($data);
			} else {
				$data = [
					'message' => 'Data Retribusi Tidak Ditemukan!',
					'type' => 'error',
					'res' => false
				];
				header('Content-Type: application/json');
				echo json_encode($data);
			}
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
	// End Detail Retribusi
	public function DetailPenugasan($id = NULL)
	{
		$id = $this->input->post('id', TRUE);
		$cekDataBangunan = $this->MDataDetail->cekDataBangunan($id);
		if ($cekDataBangunan->num_rows() > 0) {
			$row = $cekDataBangunan->row();
			$LuasBg = 0;
			$id_jenis_permohonan = $row->id_jenis_permohonan;
			if ($id_jenis_permohonan == 11 || $id_jenis_permohonan == 29 || $id_jenis_permohonan == 30 || $id_jenis_permohonan == 31 || $id_jenis_permohonan == 32 || $id_jenis_permohonan == 33 || $id_jenis_permohonan == 34) {
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
						$luas_total_kolektif  = bcadd(0, $LuasBg, 3);
					}
				}
			} else {
				$hasil_kolektif = 0;
				$luas_total_kolektif  = bcadd(0, $LuasBg, 3);
			}
			$tgl_pernyataan = $row->tgl_pernyataan;
			$date_plus = new DateTime($tgl_pernyataan);
			$lama_proses = intval($row->lama_proses);
			$date_plus->modify("+{$lama_proses} days");
			$hasil_tgl = $date_plus->format("d-m-Y");
			$tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
			
			$id_fbg = $row->id_fungsi_bg;
			$id_izin = $row->id_izin;
			$id_klasifikasi = $row ->id_klasifikasi;
			
			if ($id_izin == '2') { // Bangunan Eksisting
				if ($id_fbg == '1') {
					$rew =  $this->MDataDetail->getByIdPtugas($id); //TPT
				} else {
					$rew =  $this->MDataDetail->getByIdPtugas($id); //TPT
				}
				$rew =  $this->MDataDetail->getByIdPtugas($id); //TPT
			} else if($id_izin =='7'){ //Pertashop
				$rew =  $this->MDataDetail->getByIdPtugas($id); //TPT
			}else  if($id_izin == '1'){ // Bangunan Baru
				if ($id_fbg == '1'){ // Fungsi Hunian
					if($id_klasifikasi == '2'){ //Bangunan Tidak Sederhana
						$rew =  $this->MDataDetail->getByIdPtugasTPA($id); //TPA
					}else{
						$rew =  $this->MDataDetail->getByIdPtugas($id); //TPT
					}
				}
			}else{ // Bangunan Baru
				$rew =  $this->MDataDetail->getByIdPtugasTPA($id); //TPA
			}

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
				}else if($id_izin =='7'){
					$gb =  $p->glr_belakang; //TPT
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

				if($id_izin =='2'){ //Bangunan Eksisting
					if( $id_fbg =='1'){
						$id_p =  $p->id_personal; //TPT
					}else{
						$id_p =  $p->id_personal; //TPT
					}
						$id_p =  $p->id_personal; //TPT
				}else if($id_izin =='7'){
					$id_p =  $p->id_personal; //TPT
				}else{ // Bangunan Baru
					if( $id_fbg =='1'){ // Fungsi Hunian
						if($id_klasifikasi =='2'){ // Tidak Sederhana
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
				$penugasan[] = [
					'id_personal' => $id_p,
					'nama_peg' => $gelar_depan . $nama_personal . $gelar_belakang,
					'nama_unsur' => $nama_unsur,
					'nama_bidang' => $nama_bidang,
					'nama_keahlian' => $nama_keahlian
				];
			}
			$data = [
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
				'luas_bgp' => $row->luas_bgp,
				'tinggi_bgn' => $row->tinggi_bgn,
				'tinggi_bgp' => $row->tinggi_bgp,
				'jml_lantai' => $row->jml_lantai,
				'jns_prasarana' => $row->jns_prasarana,
				'tgl_pernyataan' => $tgl_pernyataan,
				'id_jenis_permohonan' => $id_jenis_permohonan,
				'hasil_kolektif' => $hasil_kolektif,
				'luas_total_kolektif' => $luas_total_kolektif,
				'lama_proses' => $row->lama_proses == NULL ? 0 : $row->lama_proses,
				'hasil_tgl' => $hasil_tgl,
				'penugasan' => empty($penugasan) ? 0 : $penugasan,
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
	// detail penjadwalan
	public function DetailPenjadwalan()
	{
		$id = $this->input->post('id', TRUE);
		$cekDataBangunan = $this->MDataDetail->cekDataBangunan($id);
		if ($cekDataBangunan->num_rows() > 0) {
			$row = $cekDataBangunan->row();
			$tgl_pernyataan = $row->tgl_pernyataan;
			$date_plus = new DateTime($tgl_pernyataan);
			$lama_proses = intval($row->lama_proses);
			$date_plus->modify("+{$lama_proses} days");
			$hasil_tgl = $date_plus->format("d-m-Y");
			$tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
			$getPenjadwalanList = $this->MDataDetail->getPenjadwalanById($row->id_pemilik);
			$id_izin = $row->id_izin;
			$id_fbg = $row->id_fungsi_bg;
			if ($id_izin == '2') {
				if ($id_fbg == '1') {
					$rew =  $this->MDataDetail->getByIdPtugas($id); //TPT
				} else {
					$rew =  $this->MDataDetail->getByIdPtugas($id); //TPT
				}
				$rew =  $this->MDataDetail->getByIdPtugas($id); //TPT
			} else {
				if ($id_fbg == '1') {
					$rew =  $this->MDataDetail->getByIdPtugas($id); //TPT
				} else {
					$rew =  $this->MDataDetail->getByIdPtugasTPA($id); //TPA
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
				} else {
					if ($id_fbg == '1') {
						$gb =  $p->glr_belakang; //TPT
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
				} else {
					if ($id_fbg == '1') {
						$nm =  $p->nama_personal; //TPT
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
				} else {
					if ($id_fbg == '1') {
						$id_p =  $p->id_personal; //TPT
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
			$data = [
				'no_konsultasi' => $row->no_konsultasi,
				'nm_pemilik' => $row->nm_pemilik,
				'fungsi_bg' => $row->fungsi_bg,
				'almt_bgn' => $row->almt_bgn,
				'nama_kec_bg' => $row->nama_kec_bg,
				'nama_kabkota_bg' => $row->nama_kabkota_bg,
				'nama_provinsi_bg' => $row->nama_provinsi_bg,
				'nm_konsultasi' => $row->nm_konsultasi,
				'alamat' => $row->alamat,
				'list_jadwal' => $getPenjadwalanList->result(),
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
				'tgl_pernyataan' => $tgl_pernyataan,
				'lama_proses' => $row->lama_proses == NULL ? 0 : $row->lama_proses,
				'hasil_tgl' => $hasil_tgl,
				'penugasan' => empty($penugasan) ? 0 : $penugasan,
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
	// end detail penjadwalan

	// start detail IMBG
	public function DetailIMB()
	{
		$id = $this->input->post('id', TRUE);
		$cekDataIMB = $this->MDataDetail->getDataIMB($id);
		if ($cekDataIMB->num_rows() > 0) {
			$row = $cekDataIMB->row();
			$id_jenis_permohonan = $row->id_jenis_permohonan;
			$id_jenis_usaha = $row->id_jenis_usaha;
			$administrasi = $this->MDataDetail->get_syarat_list($id_jenis_permohonan, '1', $id_jenis_usaha, null)->result();
			$adm = [];

			foreach ($administrasi as $a) {
				$getAdministrasi = $this->MDataDetail->get_syarat($a->id_persyaratan_detail, $id)->row();
				$berkasAdmin = $getAdministrasi == NULL ? null : $getAdministrasi->dir_file;
				$adm[] = [
					'nama_syarat' => $a->nama_syarat,
					'dir_file' => $berkasAdmin == NULL ? false : $berkasAdmin,
				];
			}

			$teknis = $this->MDataDetail->get_syarat_list($id_jenis_permohonan, '2', $id_jenis_usaha, null)->result();
			$tkn = [];
			foreach ($teknis as $t) {
				$getSyarat = $this->MDataDetail->get_syarat($a->id_persyaratan_detail, $id)->row();
				$berkasTeknis = $getSyarat == NULL ? null : $getSyarat->dir_file;
				$tkn[] = [
					'nama_syarat' => $t->nama_syarat,
					'dir_file' => $berkasTeknis == NULL ? false : $berkasTeknis,
				];
			}

			$cekDataTanah = $this->MDataDetail->getDataTanahIMB($id)->result();
			$tanah = [];
			foreach ($cekDataTanah as $t) {
				$tanah[] = [
					'nomor_dokumen' => $t->no_dok == NULL ? '-' : $t->no_dok,
					'tgl_dokumen' => $t->tanggal_dok == NULL ? '-' : $t->tanggal_dok,
					'atas_nama' => $t->atas_nama_dok == NULL ? '' : $t->atas_nama_dok,
					'luas_tanah' => $t->luas_tanah == NULL ? '' : $t->luas_tanah,
					'dir_file' => $t->dir_file == NULL ? false : $t->dir_file,
					'dir_file_phat' => $t->dir_file_phat == NULL ? false : $t->dir_file_phat,
					'jenis_dokumen' => $t->jenis_dokumen == NULL ? '' : $t->jenis_dokumen,
				];
			}
			$data = [
				'id_permohonan' => $row->id_permohonan,
				'nama_pemohon' => $row->nama_pemohon,
				'alamat_pemohon' => $row->alamat_pemohon,
				'alamat_bg' => $row->alamat_bg == NULL ? '' : $row->alamat_bg,
				'nomor_registrasi' => $row->nomor_registrasi,
				'nama_permohonan' => $row->nama_permohonan,
				'kabkot_bg' => $row->kabkot_bg,
				'kabkot_pemohon' => $row->kabkot_pemohon,
				'kecamatan_bg' => $row->kecamatan_bg,
				'kecamatan_pemohon' => $row->kecamatan_pemohon,
				'provinsi_bg' => $row->provinsi_bg,
				'provinsi_pemohon' => $row->provinsi_pemohon == NULL ? '' : $row->provinsi_pemohon,
				'fungsi_bg' => $row->fungsi_bg,
				'tinggi_bg' => $row->tinggi_bg,
				'luas_bg' => $row->luas_bg,
				'lantai_bg' => $row->lantai_bg,
				'no_tlp' => $row->no_tlp,
				'email' => $row->email,
				'no_identitas' => $row->no_ktp,
				'nama_bangunan' => $row->nama_bangunan,
				'luas_basement' => $row->luas_basement,
				'lapis_basement' => $row->lapis_basement,
				'klasifikasi_bg' => $row->klasifikasi_bg == NULL ? '' : $row->klasifikasi_bg,
				'tanah' => empty($tanah) ? 0 : $tanah,
				'adm' => $adm,
				'tkn' => $tkn,
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
	// end detail IMB

	// detail verifikasi PBG

	
	// Detail Pemeriksaan
	public function DetailPemeriksaan()
	{
		$id = $this->input->post('id', TRUE);
		$cekDataBangunan = $this->MDataDetail->cekDataBangunan($id);
		if ($cekDataBangunan->num_rows() > 0) {
			$row = $cekDataBangunan->row();
			$LuasBg = 0;
			$id_jenis_permohonan = $row->id_jenis_permohonan;
			if ($id_jenis_permohonan == 11 || $id_jenis_permohonan == 29 || $id_jenis_permohonan == 30 || $id_jenis_permohonan == 31 || $id_jenis_permohonan == 32 || $id_jenis_permohonan == 33 || $id_jenis_permohonan == 34) {
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
						$luas_total_kolektif  = bcadd(0, $LuasBg, 3);
					}
				}
			} else {
				$hasil_kolektif = 0;
				$luas_total_kolektif  = bcadd(0, $LuasBg, 3);
			}

			$tgl_pernyataan = $row->tgl_pernyataan;
			$date_plus = new DateTime($tgl_pernyataan);
			$lama_proses = intval($row->lama_proses);
			$date_plus->modify("+{$lama_proses} days");
			$hasil_tgl = $date_plus->format("d-m-Y");
			$tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
			$getDataTanah = $this->MDataDetail->getDataTanahPbg($id)->result();
			$id_jenis_permohonan = $row->id_jenis_permohonan;
			$getTeknisTanah = $this->MDataDetail->getSyaratList($id_jenis_permohonan, '1', null)->result();
			$syarat_tanah = [];
			foreach ($getTeknisTanah as $g) {
				$getSyarat = $this->MDataDetail->getSyarat($g->id_detail, $id)->row();
				$berkas = $getSyarat == NULL ? null : $getSyarat->dir_file;
				$dir_file = $berkas == NULL ? false : $getSyarat->dir_file;
				$oldFIle = FCPATH . 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				$dir = '';
				if (file_exists($oldFIle)) {
					$dir = 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				} else {
					$dir = 'object-storage/dekill/Requirement/' . $dir_file;
				}
				$syarat_tanah[] = [
					'nm_dokumen' => $g->nm_dokumen,
					'keterangan' => $g->keterangan,
					'dir_file' => $dir,
				];
			}
			$getDataUmum = $this->MDataDetail->getSyaratList($id_jenis_permohonan, '5', null)->result();
			$syarat_umum = [];
			foreach ($getDataUmum as $g) {
				$getSyarat = $this->MDataDetail->getSyarat($g->id_detail, $id)->row();
				$berkas = $getSyarat == NULL ? null : $getSyarat->dir_file;
				$dir_file = $berkas == NULL ? false : $getSyarat->dir_file;
				$oldFIle = FCPATH . 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				$dir = '';
				if (file_exists($oldFIle)) {
					$dir = 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				} else {
					$dir = 'object-storage/dekill/Requirement/' . $dir_file;
				}
				$syarat_umum[] = [
					'nm_dokumen' => $g->nm_dokumen,
					'keterangan' => $g->keterangan,
					'dir_file' => $dir,
				];
			}
			$getArsitektur = $this->MDataDetail->getSyaratList($id_jenis_permohonan, '2', null)->result();
			$syarat_arsitektur = [];
			foreach ($getArsitektur as $g) {
				$p = $this->MDataDetail->getDataPemeriksaanKesesuaian($g->id_detail, $id)->row();
				$kesesuaian = $p == NULL ? 0 : $p->kesesuaian;
				$catatan = $p == NULL ? '' : $p->catatan;
				$getSyarat = $this->MDataDetail->getSyarat($g->id_detail, $id)->row();
				$berkas = $getSyarat == NULL ? null : $getSyarat->dir_file;
				$dir_file = $berkas == NULL ? false : $getSyarat->dir_file;
				$oldFIle = FCPATH . 'file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				$dir = '';
				if ($id_jenis_permohonan == 3) {
					$getPrototipe = $this->MDataDetail->getDataPrototipe($id)->row();
					$dir = 'object-storage/file/TypeProtype/' . $getPrototipe->dir_file;
					$resultDirFile = $dir;
				} else if ($id_jenis_permohonan == 21) {
					$dir = 'object-storage/file/TypeProtype/LampKepmen05-2022.pdf';
					$resultDirFile = $dir;
				} else {
					if (file_exists($oldFIle)) {
						$dir = 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
					} else {
						$dir = 'object-storage/dekill/Requirement/' . $dir_file;
					}
					$resultDirFile = $dir_file == NULL ? false : $dir;
				}
				$syarat_arsitektur[] = [
					'nm_dokumen' => $g->nm_dokumen,
					'kesesuaian' => $kesesuaian,
					'catatan' => $catatan == NULL ? '-' : $catatan,
					'dir_file' => $resultDirFile,
				];
			}
			$getStruktur = $this->MDataDetail->getSyaratList($id_jenis_permohonan, '3', null)->result();
			$syarat_struktur = [];
			foreach ($getStruktur as $g) {
				$p = $this->MDataDetail->getDataPemeriksaanKesesuaian($g->id_detail, $id)->row();
				$kesesuaian = $p == NULL ? 0 : $p->kesesuaian;
				$catatan = $p == NULL ? '' : $p->catatan;
				$getSyarat = $this->MDataDetail->getSyarat($g->id_detail, $id)->row();
				$berkas = $getSyarat == NULL ? null : $getSyarat->dir_file;
				$dir_file = $berkas == NULL ? false : $getSyarat->dir_file;
				$oldFIle = FCPATH . 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				$dir = '';
				if (file_exists($oldFIle)) {
					$dir = 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				} else {
					$dir = 'object-storage/dekill/Requirement/' . $dir_file;
				}
				$syarat_struktur[] = [
					'nm_dokumen' => $g->nm_dokumen,
					'kesesuaian' => $kesesuaian,
					'catatan' => $catatan == NULL ? '-' : $catatan,
					'dir_file' => $dir,
				];
			}
			$getMep = $this->MDataDetail->getSyaratList($id_jenis_permohonan, '4', null)->result();
			$syarat_mep = [];
			foreach ($getMep as $g) {
				$p = $this->MDataDetail->getDataPemeriksaanKesesuaian($g->id_detail, $id)->row();
				$kesesuaian = $p == NULL ? 0 : $p->kesesuaian;
				$catatan = $p == NULL ? '' : $p->catatan;
				$getSyarat = $this->MDataDetail->getSyarat($g->id_detail, $id)->row();
				$berkas = $getSyarat == NULL ? null : $getSyarat->dir_file;

				$dir_file = $berkas == NULL ? false : $getSyarat->dir_file;
				$oldFIle = FCPATH . 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				$dir = '';
				if (file_exists($oldFIle)) {
					$dir = 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $dir_file;
				} else {
					$dir = 'object-storage/dekill/Requirement/' . $dir_file;
				}
				$syarat_mep[] = [
					'nm_dokumen' => $g->nm_dokumen,
					'kesesuaian' => $kesesuaian,
					'catatan' => $catatan == NULL ? '-' : $catatan,
					'dir_file' => $dir,
				];
			}
			$tanah = [];
			foreach ($getDataTanah as $t) {
				$dir_file = $t->dir_file == NULL ? false : $t->dir_file;
				$oldFIleTanah = FCPATH . 'object-storage/file/Konsultasi/' . $id . '/data_tanah/' . $dir_file;
				$dir = '';
				if (file_exists($oldFIleTanah)) {
					$dir = 'object-storage/file/Konsultasi/' . $id . '/data_tanah/' . $dir_file;
				} else {
					$dir = 'object-storage/dekill/Earth/' . $dir_file;
				}
				$dir_file_phat = $t->dir_file_phat == NULL ? false : $t->dir_file_phat;
				$oldFIlePhat = FCPATH . 'object-storage/file/Konsultasi/' . $id . '/data_tanah/' . $dir_file_phat;
				$dir_phat = '';
				if (file_exists($oldFIlePhat)) {
					$dir_phat = 'object-storage/file/Konsultasi/' . $id . '/data_tanah/' . $dir_file_phat;
				} else {
					$dir_phat = 'object-storage/dekill/Earth/' . $dir_file_phat;
				}
				$tanah[] = [
					'no_dok' => $t->no_dok,
					'tanggal_dok' => $t->tanggal_dok,
					'jenis_dokumen' => $t->jenis_dokumen,
					'luas_tanah' => $t->luas_tanah,
					'atas_nama_dok' => $t->atas_nama_dok,
					'dir_file' => $dir,
					'dir_file_phat' => $dir_phat,
				];
			}
			$data = [
				'no_konsultasi' => $row->no_konsultasi,
				'id_jenis_permohonan' => $row->id_jenis_permohonan,
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
				'luas_bgp' => $row->luas_bgp,
				'tinggi_bgn' => $row->tinggi_bgn,
				'tinggi_bgp' => $row->tinggi_bgp,
				'jns_prasarana' => $row->jns_prasarana,
				'jml_lantai' => $row->jml_lantai,
				'tgl_pernyataan' => $tgl_pernyataan,
				'lama_proses' => $row->lama_proses == NULL ? 0 : $row->lama_proses,
				'hasil_tgl' => $hasil_tgl,
				'id_izin' => $row->id_izin,
				'no_hp' => $row->no_hp,
				'email' => $row->email,
				'no_ktp' => $row->no_ktp,
				'nm_bgn' => $row->nm_bgn,
				'luas_basement' => $row->luas_basement,
				'lapis_basement' => $row->lapis_basement,
				'klasifikasi_bg' => $row->klasifikasi_bg,
				'hasil_kolektif' => $hasil_kolektif,
				'luas_total_kolektif' => $luas_total_kolektif,
				'tanah' => empty($tanah) ? 0 : $tanah,
				'id_pemilik' => $row->id_pemilik,
				'syarat_tanah' => $syarat_tanah,
				'syarat_umum' => $syarat_umum,
				'syarat_arsitektur' => $syarat_arsitektur,
				'syarat_struktur' => $syarat_struktur,
				'syarat_mep' => $syarat_mep,
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
	// End Data Detail Pmeriksaan

	// Detail TPA 
	public function DetailTPA()
	{
		$id = $this->input->post('id');
		$getTPA = $this->MDataDetail->getDetailTPA($id);
		// var_dump($getTPA->num_rows()); die;
		if ($getTPA->num_rows() > 0) {
			$row = $getTPA->row();
			$glr_depan = $row->glr_depan == '' && $row->glr_depan == NULL ? '' : $row->glr_depan . ' ';
			$glr_blkg = $row->glr_blkg == '' && $row->glr_blkg == NULL ? '' : ' ' . $row->glr_blkg;
			$nama =  $glr_depan . $row->nm_tpa . $glr_blkg;
			$lembaga = $row->id_lembaga;
			$tmpt_lahir = $row->tmpt_lahir == NULL && $row->tmpt_lahir == '' ? 'Tidak Diisi' : ucwords($row->tmpt_lahir);
			$alamat = $row->alamat == NULL && $row->alamat == '' ? 'Tidak Diisi' : $row->alamat;
			$tgl_lahir = $row->tgl_lahir == NULL && $row->tgl_lahir == '' ? 'Tidak Diisi' : $row->tgl_lahir;
			$email = $row->email == NULL && $row->email == '' ? 'Tidak Diisi' : $row->email;
			$no_kontak = $row->no_kontak == NULL && $row->no_kontak == '' ? 'Tidak Diisi' : $row->no_kontak;
			if ($lembaga == 1) {
				$unsur = 'Akademisi';
			} else if ($lembaga == 2) {
				$unsur = 'Pakar';
			} else {
				$unsur = 'Profesi Ahli';
			}
			$data = [
				'nama' => $nama,
				'unsur' => $unsur,
				'keahlian' => '-',
				'id' => $row->id,
				'tmpt_lahir' => $tmpt_lahir,
				'alamat' => $alamat,
				'tgl_lahir' => $tgl_lahir,
				'email' => $email,
				'no_kontak' => $no_kontak,
				'dir_file' => $row->dir_file == '' && $row->dir_file == NULL ? false : $row->dir_file,
				'res' => true
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
	// End Detail TPA

	// detail validasi
	function DetailValidasi()
	{
		$id = $this->input->post('id', TRUE);
		$cekDataBangunan = $this->MDataDetail->cekDataBangunan($id);
		if ($cekDataBangunan->num_rows() > 0) {
			$row = $cekDataBangunan->row();
			$LuasBg = 0;
			$id_jenis_permohonan = $row->id_jenis_permohonan;
			if ($id_jenis_permohonan == 11 || $id_jenis_permohonan == 29 || $id_jenis_permohonan == 30 || $id_jenis_permohonan == 31 || $id_jenis_permohonan == 32 || $id_jenis_permohonan == 33) {
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
						$luas_total_kolektif  = bcadd(0, $LuasBg, 3);
					}
				}
			} else {
				$hasil_kolektif = 0;
				$luas_total_kolektif  = bcadd(0, $LuasBg, 3);
			}
			$tgl_pernyataan = $row->tgl_pernyataan;
			$date_plus = new DateTime($tgl_pernyataan);
			$lama_proses = intval($row->lama_proses);
			$date_plus->modify("+{$lama_proses} days");
			$hasil_tgl = $date_plus->format("d-m-Y");
			$tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
			$getRetribusi = $this->MDataDetail->cekRetribusi($id);
			$getShst   = $this->MDataDetail->getShst($row->id_kabkot_bgn, date('Y'))->row();
			$getPrasarana = $this->MDataDetail->getPrasarana($id)->result();
			$getDataBerkas = $this->MDataDetail->getDataBerkasPemeriksaan($id)->row();
			$prasarana = [];
			foreach ($getPrasarana as $r) {
				$prasarana[] = [
					'nama_prasarana' => $r->nama_prasarana,
					'plv' => $r->plv,
					'harga_prasarana' => str_replace(',', '.', (number_format($r->harga_prasarana))),
					'total_prasarana' => str_replace(',', '.', (number_format($r->total_prasarana)))
				];
			}
			if ($getRetribusi->num_rows() > 0) {
				$retribusi = $getRetribusi->row();
				$retribusi_bangunan = str_replace(',', '.', (number_format($retribusi->nilai_retribusi_bangunan)));
				$oldFIle = FCPATH . 'object-storage/file/konsultasi/' . $id . '/retribusi/berkas_retribusi/' . $retribusi->file_retribusi;;
				$dir = '';
				if (file_exists($oldFIle)) {
					$dir = 'object-storage/file/konsultasi/' . $id . '/retribusi/berkas_retribusi/' . $retribusi->file_retribusi;
				} else {
					$dir = 'object-storage/dekill/Retribution/' . $retribusi->file_retribusi;
				}
				
				//$oldFIleBerkas = FCPATH . 'public/uploads/penilaian/berita_acara/' . $getDataBerkas->dir_file_konsultasi;
				$oldFIleBerkas = FCPATH . 'dekill/Consultation/berita_acara/' . $getDataBerkas->dir_file_konsultasi;
				$dirFile = '';
				if (file_exists($oldFIleBerkas)) {
					$dirFile = 'object-storage/dekill/Consultation/berita_acara/' . $getDataBerkas->dir_file_konsultasi;
					//$dirFile = 'public/uploads/penilaian/berita_acara/' . $getDataBerkas->dir_file_konsultasi;
				} else {
					$dirFile = 'object-storage/dekill/Consultation/' . $getDataBerkas->dir_file_konsultasi;
				}
				$data = [
					'no_konsultasi' 		=> $row->no_konsultasi,
					'nm_pemilik' 			=> $row->nm_pemilik,
					'dir_file_konsultasi' 	=> $dirFile,
					'almt_bgn' => $row->almt_bgn,
					'nama_kec_bg' => $row->nama_kec_bg,
					'nama_kabkota_bg' => $row->nama_kabkota_bg,
					'nama_provinsi_bg' => $row->nama_provinsi_bg,
					'nm_konsultasi' => $row->nm_konsultasi,
					'alamat' => $row->alamat,
					'nama_kelurahan' => $row->nama_kelurahan,
					'nama_kecamatan' => $row->nama_kecamatan,
					'nama_kabkota' => $row->nama_kabkota,
					'nama_prov_pemilik' => $row->nama_prov_pemilik,
					'almt_bgn' => $row->almt_bgn,
					'nm_kelurahan' => $row->nm_kelurahan,
					'nama_kec_bg' => $row->nama_kec_bg,
					'nama_kabkota_bg' => $row->nama_kabkota_bg,
					'nama_provinsi_bg' => $row->nama_provinsi_bg,
					'fungsi_bg' => $row->fungsi_bg,
					'luas_bgn' => $row->luas_bgn,
					'luas_bgp' => $row->luas_bgp,
					'tinggi_bgn' => $row->tinggi_bgn,
					'tinggi_bgp' => $row->tinggi_bgp,
					'jml_lantai' => $row->jml_lantai,
					'jns_prasarana' => $row->jns_prasarana,
					'tgl_pernyataan' => $tgl_pernyataan,
					'lama_proses' => $row->lama_proses == NULL ? 0 : $row->lama_proses,
					'hasil_tgl' => $hasil_tgl,
					'nilai_retribusi_bangunan' => str_replace(',', '.', number_format($retribusi->nilai_retribusi_bangunan)),
					'status_perhitungan' => $retribusi->status_perhitungan == 2 ? 'Hitung Berdasarkan PERDA' : 'Hitung Berdasarkan Sistem',
					'nilai_retribusi_prasarana' => str_replace(',', '.', number_format($retribusi->nilai_retribusi_prasarana)),
					'nilai_retribusi_keseluruhan' => str_replace(',', '.', number_format($retribusi->nilai_retribusi_keseluruhan)),
					'stats_retribusi' => $retribusi->status_perhitungan,
					'res' => true,
					'berkas_retribusi' => $dir,
					'permanensi' => $retribusi->id_permanensi == 1 ? 'Permanen' : 'Non Permanen',
					'parameter_permanensi' => "0.2 x {$retribusi->id_permanensi}",
					'parameter_fungsi' => $retribusi->parameter_fungsi,
					'id_klasifikasi_bg' => $row->id_klasifikasi_bg == NULL ? '' : $row->id_klasifikasi_bg,
					'klasifikasi_bg' => $row->klasifikasi_bg == NULL ? '' : $row->klasifikasi_bg,
					'parameter_kompleksitas' => $retribusi->parameter_kompleksitas,
					'parameter_ketinggian' => $retribusi->parameter_ketinggian,
					'id_fungsi' => $row->id_fungsi_bg,
					'kepemilikan' => $row->id_fungsi_bg == 0 ? 0 : 1,
					'indeks_integrasi' => $retribusi->indeks_integrasi,
					'shst' => $getShst == NULL ? 0 : str_replace(',', '.', number_format($getShst->shst)),
					'indeks_lokalitas' => $retribusi->indeks_lokalitas,
					'kegiatan' => $retribusi->nama_kegiatan,
					'parameter_kegiatan' => "{$retribusi->prefix1} x {$retribusi->prefix2} = {$retribusi->index_kegiatan}",
					'hasil_retribusi_bgn' => "{$row->luas_bgn} x ({$retribusi->indeks_lokalitas} x {$retribusi->indeks_integrasi} x {$retribusi->index_kegiatan}) = Rp.{$retribusi_bangunan}",
					'prasarana' => empty($prasarana) ? 0 : $prasarana,
					'id_jenis_permohonan' => $id_jenis_permohonan,
					'hasil_kolektif' => $hasil_kolektif,
					'luas_total_kolektif' => $luas_total_kolektif,
				];
				header('Content-Type: application/json');
				echo json_encode($data);
			} else {
				$data = [
					'message' => 'Data Retribusi Tidak Ditemukan!',
					'type' => 'error',
					'res' => false
				];
				header('Content-Type: application/json');
				echo json_encode($data);
			}
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
	// end detail validasi
	//Begin Data Detail Penugasan Inpeksi
	public function DetailPenugasanInpeksi($id = NULL)
	{
		$id = $this->input->post('id', TRUE);
		$cekDataBangunan = $this->MDataDetail->cekDataBangunan($id);
		if ($cekDataBangunan->num_rows() > 0) {
			$row = $cekDataBangunan->row();
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
						$luas_total_kolektif  = bcadd(0, $LuasBg, 3);
					}
				}
			} else {
				$hasil_kolektif = 0;
				$luas_total_kolektif  = bcadd(0, $LuasBg, 3);
			}
			$tgl_pernyataan = $row->tgl_pernyataan;
			$date_plus = new DateTime($tgl_pernyataan);
			$lama_proses = intval($row->lama_proses);
			$date_plus->modify("+{$lama_proses} days");
			$hasil_tgl = $date_plus->format("d-m-Y");
			$tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
			
			$id_fbg = $row->id_fungsi_bg;
			$id_izin = $row->id_izin;
			$id_fbg = $row->id_fungsi_bg;

			$rew =  $this->MDataDetail->getByIdPtugasPenilik($id); //TPT
			$penugasan = [];
			foreach ($rew->result() as $p) {
				$gelar_depan = $p->glr_depan;
				$gelar_belakang = $p->glr_belakang;
				$nama_personal = $p->nama_personal;
				$nama_unsur = $id_fbg == 1 ? "{$p->nama_unsur} - {$p->nama_unsur_ahli}" : '-';
				$nama_bidang = $id_fbg == 1 ? "{$p->nama_bidang}" : '-';
				$nama_keahlian = $id_fbg == 1 ? $p->nama_keahlian : '<i>Belum Diisi!</i>';

				$penugasan[] = [
					'id_personal' => $p->id_personal,
					'nama_peg' => $gelar_depan . $nama_personal . $gelar_belakang,
					'nama_unsur' => $nama_unsur,
					'nama_bidang' => $nama_bidang,
					'nama_keahlian' => $nama_keahlian
				];
			}
			$data = [
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
				'luas_bgp' => $row->luas_bgp,
				'tinggi_bgn' => $row->tinggi_bgn,
				'tinggi_bgp' => $row->tinggi_bgp,
				'jml_lantai' => $row->jml_lantai,
				'jns_prasarana' => $row->jns_prasarana,
				'tgl_pernyataan' => $tgl_pernyataan,
				'id_jenis_permohonan' => $id_jenis_permohonan,
				'hasil_kolektif' => $hasil_kolektif,
				'luas_total_kolektif' => $luas_total_kolektif,
				'lama_proses' => $row->lama_proses == NULL ? 0 : $row->lama_proses,
				'hasil_tgl' => $hasil_tgl,
				'penugasan' => empty($penugasan) ? 0 : $penugasan,
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
	//End Data Detail Penugasan Inpeksi
}
