<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class PerubahanData extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('utility');
		$this->load->model('Mperubahandata');
		$this->load->model('Global_model');
		$this->load->library('Simbg_lib');
		$this->simbg_lib->check_session_login();
	}
	function index()
	{
		
	}
	//Begin Perubahan Data Permohonan PBG/SLF
	public function UpdateData()
	{
		$nobobo = $this->uri->segment(3);
		$no_registrasi = str_replace("'", "", htmlspecialchars($nobobo, ENT_QUOTES));
		$SQLcari            = "";
		if (trim($no_registrasi) != '') {
			$SQLcari .= " AND a.no_konsultasi = '$no_registrasi' ";
		} else {
			$SQLcari .= " AND a.no_konsultasi = '000-000-0000-000' ";
		}
		$query = $this->Mperubahandata->getRegistrasi($SQLcari);
		$data['title']          =  '';
		$data['heading']        =  '';
		$this->template->load('template/template_backend', 'FormPerubahan', $data);
	}
	public function PerubahanPusat()
	{
		$nobobo = $this->uri->segment(3);
		$no_registrasi = str_replace("'", "", htmlspecialchars($nobobo, ENT_QUOTES));
		$SQLcari            = "";
		if (trim($no_registrasi) != '') {
			$SQLcari .= " AND a.no_konsultasi = '$no_registrasi' ";
		} else {
			$SQLcari .= " AND a.no_konsultasi = '000-000-0000-000' ";
		}
		$query = $this->Mperubahandata->getRegistrasi($SQLcari);
		$data['title']          =  '';
		$data['heading']        =  '';
		$this->template->load('template/template_backend', 'FormPerubahanPusat', $data);
	}

	public function Cari()
	{
		$data = "";
		$nobobo = $this->uri->segment(3);
		$del = $this->uri->segment(4);
		$no_registrasi = str_replace("'", "", htmlspecialchars($nobobo, ENT_QUOTES));
		$SQLcari = "";
		if (trim($no_registrasi) != '') {
			$SQLcari .= " AND a.no_konsultasi = '$no_registrasi' ";
			$SQLcari .= " AND a.status != 26 ";
			$SQLcari .= " AND a.pernyataan is not null";
			$SQLcari .= " AND a.id_kabkot_bgn = " . $this->session->userdata('loc_id_kabkot');
			
		}
		$query = $this->Mperubahandata->getRegistrasi($SQLcari);
		$mydata = $query->row_array();
		$baris = $query->num_rows();
		if ($no_registrasi != "") {
			if ($baris >= 1) {
				$i = 1;
				foreach ($query->result() as $row) {
					$data .= '<tr>
					<td>' . $i . '</td>
					<td>' . $row->no_konsultasi . '</td>
					<td>' . $row->nm_pemilik . '</td>
                    <td>' . $row->nm_konsultasi . '</td>
					<td>' . $row->almt_bgn . '</td>';
					if ($del) {
						$data .= '<td>' . '<a href="#" class="btn btn-danger btn-xs item_hapus" data-toggle="modal"onclick="ModalHapus(' . $row->id . ')">Delete</a> ' . ' </td>';
					} else {
						$data .= '<td>' . '<a href="' . base_url() . 'PerubahanData/Ubah/' . $row->id . '" class="btn btn-warning btn-xs" data=' . $row->id . '>Ubah</a> ' . ' </td>';
					}
					$data .= '</tr>';
					$data .= '<div id="popupHapusData" class="modal fade" role="dialog" aria-hidden="true" data-width="60%" data-backdrop="static" data-keyboard="false">
					<div class="modal-content">
					<div>
					<div>';
				}
				echo $data;
			} else {
				$fix = "Nomor Registrasi Tidak Ditemukan";
				$data2 = '<tr><td colspan="6" align="center">' . $fix . '</td></tr>';
				echo $data2;
			}
		}
	}
	public function QrCode()
	{
		$nobobo = $this->uri->segment(3);
		$no_registrasi = str_replace("'", "", htmlspecialchars($nobobo, ENT_QUOTES));
		$SQLcari            = "";
		if (trim($no_registrasi) != '') {
			$SQLcari .= " AND a.no_konsultasi = '$no_registrasi' ";
		} else {
			$SQLcari .= " AND a.no_konsultasi = '000-000-0000-000' ";
		}
		$query = $this->Mperubahandata->getRegistrasi($SQLcari);
		$data['title']          =  '';
		$data['heading']        =  '';
		$this->template->load('template/template_backend', 'FormPerubahanQrcode', $data);
	}
	public function CariQrcode()
	{
		$data = "";
		$nobobo = $this->uri->segment(3);
		$del = $this->uri->segment(4);
		$no_registrasi = str_replace("'", "", htmlspecialchars($nobobo, ENT_QUOTES));
		$SQLcari = "";
		if (trim($no_registrasi) != '') {
			$SQLcari .= " AND a.no_konsultasi = '$no_registrasi' ";
			$SQLcari .= " AND a.status != 26 ";
			$SQLcari .= " AND a.pernyataan is not null";
		}
		$query = $this->Mperubahandata->getRegistrasi($SQLcari);
		$mydata = $query->row_array();
		$baris = $query->num_rows();
		if ($no_registrasi != "") {
			if ($baris >= 1) {
				$i = 1;
				foreach ($query->result() as $row) {
					$data .= '<tr>
					<td>' . $i . '</td>
					<td>' . $row->no_konsultasi . '</td>
					<td>' . $row->nm_pemilik . '</td>
                    <td>' . $row->nm_konsultasi . '</td>
					<td>' . $row->almt_bgn . '</td>
					<td>' . $row->status_dinas . '</td>';
					if($row->id_izin != '2'){
						$data .= '<td>' . '<a href="' . base_url() . 'Dokumen/CetakVerifikasiBgnBaru/' . $row->id . '" class="btn btn-warning btn-xs" data=' . $row->id . '>Lihat Dokumen</a> ' . ' </td>';
					}else{
						$data .= '<td>' . '<a href="' . base_url() . 'Dokumen/CetakVerifikasiBangunanEksisting/' . $row->id . '" class="btn btn-warning btn-xs" data=' . $row->id . '>Lihat Dokumen</a> ' . ' </td>';
					}
					$data .= '<td>' . '<a href="#" class="btn btn-danger btn-xs item_qrcode" data-toggle="modal"onclick="ModalHapus(' . $row->id . ')">Create QrCode</a> ' . ' </td>';
					$data .= '</tr>';
					$data .= '<div id="popupHapusData" class="modal fade" role="dialog" aria-hidden="true" data-width="60%" data-backdrop="static" data-keyboard="false">
					<div class="modal-content">
					<div>
					<div>';
				}
				echo $data;
			} else {
				$fix = "Nomor Registrasi Tidak Ditemukan";
				$data2 = '<tr><td colspan="6" align="center">' . $fix . '</td></tr>';
				echo $data2;
			}
		}
	}

	public function CariPusat()
	{
		$data = "";
		$nobobo = $this->uri->segment(3);
		$del = $this->uri->segment(4);
		$no_registrasi = str_replace("'", "", htmlspecialchars($nobobo, ENT_QUOTES));
		$SQLcari = "";
		if (trim($no_registrasi) != '') {
			$SQLcari .= " AND a.no_konsultasi = '$no_registrasi' ";
			$SQLcari .= " AND a.status != 26 ";
			$SQLcari .= " AND a.pernyataan is not null";
			//$SQLcari .= " AND a.id_kabkot_bgn = " . $this->session->userdata('loc_id_kabkot');
			
		}
		$query = $this->Mperubahandata->getRegistrasi($SQLcari);
		$mydata = $query->row_array();
		$baris = $query->num_rows();
		if ($no_registrasi != "") {
			if ($baris >= 1) {
				$i = 1;
				foreach ($query->result() as $row) {
					$data .= '<tr>
					<td>' . $i . '</td>
					<td>' . $row->no_konsultasi . '</td>
					<td>' . $row->nm_pemilik . '</td>
                    <td>' . $row->nm_konsultasi . '</td>
					<td>' . $row->almt_bgn . '</td>';
					if ($del) {
						$data .= '<td>' . '<a href="#" class="btn btn-danger btn-xs item_hapus" data-toggle="modal"onclick="ModalHapus(' . $row->id . ')">Delete</a> ' . ' </td>';
					} else {
						$data .= '<td>' . '<a href="' . base_url() . 'PerubahanData/UbahPusat/' . $row->id . '" class="btn btn-warning btn-xs" data=' . $row->id . '>Ubah</a> ' . ' </td>';
					}
					
					$data .= '</tr>';
					$data .= '<div id="popupHapusData" class="modal fade" role="dialog" aria-hidden="true" data-width="60%" data-backdrop="static" data-keyboard="false">
					<div class="modal-content">
					<div>
					<div>';
				}
				echo $data;
			} else {
				$fix = "Nomor Registrasi Tidak Ditemukan";
				$data2 = '<tr><td colspan="6" align="center">' . $fix . '</td></tr>';
				echo $data2;
			}
		}
	}
	// Delete Permohonan PBG/SLF
	public function HapusData()
	{
		$nobobo = $this->uri->segment(3);
		$no_registrasi = str_replace("'", "", htmlspecialchars($nobobo, ENT_QUOTES));
		$SQLcari            = "";
		if (trim($no_registrasi) != '') {
			$SQLcari .= " AND a.no_konsultasi = '$no_registrasi' ";
		} else {
			$SQLcari .= " AND a.no_konsultasi = '000-000-0000-000' ";
		}
		$query = $this->Mperubahandata->getRegistrasi($SQLcari);
		$data['title']          =  '';
		$data['heading']        =  '';
		$this->template->load('template/template_backend', 'FormDelete', $data);
	}

	public function Ubah($id)
	{
		$user_id				= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$data['DataBangunan'] 	= $this->Mglobals->getData('', 'tmdatabangunan', array('id' => $id))->row();
		$data['DataPemilik'] 	= $this->Mglobals->getData('', 'tmdatapemilik', array('id' => $id))->row();
		$data['DataTanah']		= $this->Mperubahandata->getTanah('a.*', $id);
		$queFungsi = $this->Mglobals->getData('', 'tr_fungsi_bg')->result();
		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) {
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$queJenisP = $this->Mglobals->getData('*', 'tm_jenis_permohonan')->result();
		$list_JnsPer[''] = '--Pilih--';
		foreach ($queJenisP as $row) {
			$list_JnsPer[$row->id_jns_permohonan] = $row->nm_jns_permohonan;
		}
		$data['list_JnsPer'] = $list_JnsPer;
		$data['tipeA'] = array();
		$data['list_fungsi'] = $list_fungsi;
		$data['Provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['content']	= $this->load->view('FormEditPerubahan', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('template_pengajuan', $data);
	}
	public function UbahPusat($id)
	{
		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));

		$data['DataBangunan'] = $this->Mglobals->getData('', 'tmdatabangunan', array('id' => $id))->row();
		$data['DataPemilik'] = $this->Mglobals->getData('', 'tmdatapemilik', array('id' => $id))->row();
		$data['DataTanah']		= $this->Mperubahandata->getTanah('a.*', $id);
		$queFungsi = $this->Mglobals->getData('', 'tr_fungsi_bg')->result();
		$data['daftar_provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) {
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$queJenisP = $this->Mglobals->getData('*', 'tm_jenis_permohonan')->result();
		$list_JnsPer[''] = '--Pilih--';
		foreach ($queJenisP as $row) {
			$list_JnsPer[$row->id_jns_permohonan] = $row->nm_jns_permohonan;
		}
		$data['list_JnsPer'] = $list_JnsPer;
		$data['tipeA'] = array();
		$data['list_fungsi'] = $list_fungsi;
		$data['Provinsi']	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['content']	= $this->load->view('FormEditPerubahan', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('template_pengajuan', $data);
	}
	public function SaveData()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$id						= $this->input->post('id');
		//Data Pemilik Bangunan
		$jenis_id				= $this->input->post('jenis_id');
		$jns_pemilik			= $this->input->post('jns_pemilik');
		$nm_pemilik				= $this->input->post('nm_pemilik');
		$nama_pemilik 			= $this->input->post('nama_pemilik');
		$no_ktp					= $this->input->post('no_ktp');
		if ($jns_pemilik == '1') {
			$nm_pemilik		= $this->input->post('unit_organisasi');
		} else if ($jns_pemilik == '2') {
			$nm_pemilik		= $this->input->post('nm_pemilik');
		} else if ($jns_pemilik == '3') {
			$nm_pemilik		= $this->input->post('nama_pemilik');
		}
		$glr_depan				= $this->input->post('glr_depan');
		$glr_belakang			= $this->input->post('glr_belakang');
		$alamat					= $this->input->post('alamat');
		$nama_provinsi			= $this->input->post('nama_provinsi');
		$nama_kabkota			= $this->input->post('nama_kabkota');
		$nama_kecamatan			= $this->input->post('nama_kecamatan');
		$nama_kelurahan			= $this->input->post('nama_kelurahan');
		$no_hp					= $this->input->post('no_hp');
		$email					= $this->input->post('email');
		//Data Bangunan Gedung
		$id_bgn					= $this->input->post('id_bgn');
		$id_izin				= $this->input->post('id_izin');
		$nama_bangunan			= $this->input->post('nama_bangunan');
		$id_kecamatan_bg		= $this->input->post('id_kecamatan_bg');
		$id_kelurahan_bg		= $this->input->post('id_kelurahan_bg');
		$alamat_bg				= $this->input->post('alamat_bg');
		$luas_bg				= $this->input->post('luas_bg');
		$tinggi_bg				= $this->input->post('tinggi_bg');
		$almt_bgn				= $this->input->post('almt_bgn');
		$lantai_bg				= $this->input->post('lantai_bg');
		$luas_basement			= $this->input->post('luas_basement');
		$lapis_basement			= $this->input->post('lapis_basement');
		$id_jns_bg				= $this->input->post('id_jns_bg');
		$id_fungsi_bg			= $this->input->post('id_fungsi_bg');
		$fungsi_bangunan		= $this->input->post('nm_jenis_bg');
		$id_kolektif			= $this->input->post('id_kolektif');
		$tipeA					= $this->input->post('tipeA');
		$jumlahA				= $this->input->post('jumlahA');
		$luasA					= $this->input->post('luasA');
		$tinggiA				= $this->input->post('tinggiA');
		$lantaiA				= $this->input->post('lantaiA');
		$id_prasarana_bg		= $this->input->post('id_prasarana_bg');
		$luas_bgp				= $this->input->post('luas_bgp');
		$tinggi_bgp				= $this->input->post('tinggi_bgp');
		$jual					= $this->input->post('jual');
		$imb					= $this->input->post('imb');
		$slf					= $this->input->post('slf');
		$cetak					= $this->input->post('cetak');
		$id_doc_tek				= $this->input->post('id_doc_tek');
		$no_imb					= $this->input->post('no_imb');
		if ($id_fungsi_bg == 6) {
			$jns_campur			= $this->input->post('dcampur');
			$id_jns_bg			= json_encode($jns_campur);
		}
		if ($luas_bg < '100') {
			if ($lantai_bg < '2') {
				$id_klasifikasi = '1';
			} else {
				$id_klasifikasi = '2';
			}
		} else {
			$id_klasifikasi = '2';
		}
		if ($id_izin == '1') {
			if ($id_fungsi_bg == '1') { //Fungsi Hunian
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
			} else if ($id_fungsi_bg == '2') { //Fungsi Non Hunian dan Non Khusus serta Non Campuran
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
			} else if ($id_fungsi_bg == '6') { //Fungsi Campuran
				$jenis_konsultasi = '13';
			}
		} else if ($id_izin == '2') {
			if ($id_fungsi_bg == '1') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '2') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '3') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '4') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '6') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '5') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '16';
					} else {
						$jenis_konsultasi = '16';
					}
				} else {
					$jenis_konsultasi = '16';
				}
			}
			$jenis_konsultasi = '14';
		} else if ($id_izin == '3') {
			$jenis_konsultasi = '18';
		} else if ($id_izin == '4') {
			$jenis_konsultasi = '11';
		} else if ($id_izin == '5') {
			$jenis_konsultasi = '12';
		} else if ($id_izin == '6') {
			$jenis_konsultasi = '17';
		}
		$dataBangunan	= array(
			'id'					=> $id,
			//'id_izin'				=> $id_izin,
			'id_kec_bgn'			=> $id_kecamatan_bg,
			'id_kel_bgn'			=> $id_kelurahan_bg,
			'almt_bgn'				=> $alamat_bg,
			'id_fungsi_bg'			=> $id_fungsi_bg,
			'id_jns_bg'				=> $id_jns_bg,
			'nm_bgn'				=> $nama_bangunan,
			'luas_bgn'				=> $luas_bg,
			'tinggi_bgn'			=> $tinggi_bg,
			'jml_lantai'			=> $lantai_bg,
			'luas_basement'			=> $luas_basement,
			'lapis_basement'		=> $lapis_basement,
			'last_update'			=> date("Y-m-d h:i:sa"),
			'id_kolektif'			=> $id_kolektif,
			'tipeA'					=> json_encode($tipeA),
			'jumlahA'				=> json_encode($jumlahA),
			'luasA'					=> json_encode($luasA),
			'tinggiA'				=> json_encode($tinggiA),
			'lantaiA'				=> json_encode($lantaiA),
			'id_prasarana_bg'		=> $id_prasarana_bg,
			'luas_bgp'				=> $luas_bgp,
			'tinggi_bgp'			=> $tinggi_bgp,
			'id_doc_tek'			=> $id_doc_tek,
			'no_imb'				=> $no_imb,
			'imb'					=> $imb,
			'slf'					=> $slf,
			'id_klasifikasi'		=> $id_klasifikasi
		);
		$data	= array(
			//'user_id' 			=> $this->Outh_model->Encryptor('decrypt', $user_id),
			'nm_pemilik'		=> $nm_pemilik,
			'jns_pemilik' 		=> $jns_pemilik,
			'glr_depan' 		=> $glr_depan,
			'glr_belakang' 		=> $glr_belakang,
			'alamat' 			=> $alamat,
			'id_provinsi' 		=> $nama_provinsi,
			'id_kabkota' 		=> $nama_kabkota,
			'id_kecamatan'		=> $nama_kecamatan,
			'id_kelurahan' 		=> $nama_kelurahan,
			'jenis_id' 			=> $jenis_id,
			'no_ktp' 			=> $no_ktp,
			'no_hp' 			=> $no_hp,
			'email' 			=> $email,
		);
		$this->Mglobals->setData('tmdatabangunan', $dataBangunan, 'id', $id);
		$this->Mglobals->setData('tmdatapemilik', $data, 'id', $id);
		$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
		$this->session->set_flashdata('status', 'success');
		redirect('PerubahanData/Ubah/'.$id);
	}

	public function SaveDataPusat()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$id						= $this->input->post('id');
		//Data Pemilik Bangunan
		$jenis_id				= $this->input->post('jenis_id');
		$jns_pemilik			= $this->input->post('jns_pemilik');
		$nm_pemilik				= $this->input->post('nm_pemilik');
		$nama_pemilik 			= $this->input->post('nama_pemilik');
		$no_ktp					= $this->input->post('no_ktp');

		if ($jns_pemilik == '1') {
			$nm_pemilik		= $this->input->post('unit_organisasi');
		} else if ($jns_pemilik == '2') {
			$nm_pemilik		= $this->input->post('nm_pemilik');
		} else if ($jns_pemilik == '3') {
			$nm_pemilik		= $this->input->post('nama_pemilik');
		}
		$glr_depan				= $this->input->post('glr_depan');
		$glr_belakang			= $this->input->post('glr_belakang');
		$alamat					= $this->input->post('alamat');
		$nama_provinsi			= $this->input->post('nama_provinsi');
		$nama_kabkota			= $this->input->post('nama_kabkota');
		$nama_kecamatan			= $this->input->post('nama_kecamatan');
		$nama_kelurahan			= $this->input->post('nama_kelurahan');
		$no_hp					= $this->input->post('no_hp');
		$email					= $this->input->post('email');
		//Data Bangunan Gedung
		$id_bgn					= $this->input->post('id_bgn');
		$id_izin				= $this->input->post('id_izin');
		$nama_bangunan			= $this->input->post('nama_bangunan');
		$nama_bangunan_kolektif	= $this->input->post('nama_bangunan_kolektif');
		$permohonan_slf			= $this->input->post('permohonan_slf');
		if($id_izin == '2'){
			if($permohonan_slf == '3'){
				$nama_bangunan		= $this->input->post('nama_bangunan_pertashop'); //Pertashop Eksisting
			}else if($permohonan_slf == '2'){
				$nama_bangunan		= $this->input->post('nama_bangunan_prasarana'); //Prasarana Eksisting
			}else{
				$nama_bangunan		= $this->input->post('nama_bangunan'); //Bangunan Umum Eksisting
			}
		}else if ($id_izin == '4') {
			$nama_bangunan		= $this->input->post('nama_bangunan_kolektif'); //Bangunan Kolektif
		} else if ($id_izin == '5') {
			$nama_bangunan		= $this->input->post('nama_bangunan_prasarana'); // Bangunan Prasarana
		} else if($id_izin == '7'){
			$nama_bangunan		= $this->input->post('nama_bangunan_pertashop'); // Bangunan Pertashop
		}else{
			$nama_bangunan		= $this->input->post('nama_bangunan');
		}
		$id_kecamatan_bg		= $this->input->post('id_kecamatan_bg');
		$id_kelurahan_bg		= $this->input->post('id_kelurahan_bg');
		$alamat_bg				= $this->input->post('alamat_bg');
		$luas_bg				= $this->input->post('luas_bg');
		$tinggi_bg				= $this->input->post('tinggi_bg');
		$almt_bgn				= $this->input->post('almt_bgn');
		$lantai_bg				= $this->input->post('lantai_bg');
		$luas_basement			= $this->input->post('luas_basement');
		$lapis_basement			= $this->input->post('lapis_basement');
		$id_jns_bg				= $this->input->post('id_jns_bg');
		$id_fungsi_bg			= $this->input->post('id_fungsi_bg');
		$fungsi_bangunan		= $this->input->post('nm_jenis_bg');
		$id_kolektif			= $this->input->post('id_kolektif');
		$tipeA					= $this->input->post('tipeA');
		$jumlahA				= $this->input->post('jumlahA');
		$luasA					= $this->input->post('luasA');
		$tinggiA				= $this->input->post('tinggiA');
		$lantaiA				= $this->input->post('lantaiA');
		$id_prasarana_bg		= $this->input->post('id_prasarana_bg');
		$luas_bgp				= $this->input->post('luas_bgp');
		$tinggi_bgp				= $this->input->post('tinggi_bgp');
		$jual					= $this->input->post('jual');
		$imb					= $this->input->post('imb');
		$slf					= $this->input->post('slf');
		$cetak					= $this->input->post('cetak');
		$id_doc_tek				= $this->input->post('id_doc_tek');
		if ($id_fungsi_bg == 6) {
			$jns_campur			= $this->input->post('dcampur');
			$id_jns_bg			= json_encode($jns_campur);
		}
		if ($luas_bg < '100') {
			if ($lantai_bg < '2') {
				$id_klasifikasi = '1';
			} else {
				$id_klasifikasi = '2';
			}
		} else {
			$id_klasifikasi = '2';
		}
		if ($id_izin == '1') {
			if ($id_fungsi_bg == '1') { //Fungsi Hunian
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
			} else if ($id_fungsi_bg == '2') { //Fungsi Non Hunian dan Non Khusus serta Non Campuran
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
			} else if ($id_fungsi_bg == '6') { //Fungsi Campuran
				$jenis_konsultasi = '13';
			}
		} else if ($id_izin == '2') {
			if ($id_fungsi_bg == '1') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '2') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '3') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '4') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '6') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '15';
					} else {
						$jenis_konsultasi = '14';
					}
				} else {
					$jenis_konsultasi = '14';
				}
			} else if ($id_fungsi_bg == '5') {
				if ($imb == '1') {
					if ($slf == '1') {
						$jenis_konsultasi = '16';
					} else {
						$jenis_konsultasi = '16';
					}
				} else {
					$jenis_konsultasi = '16';
				}
			}
			$jenis_konsultasi = '14';
		} else if ($id_izin == '3') {
			$jenis_konsultasi = '18';
		} else if ($id_izin == '4') {
			$jenis_konsultasi = '11';
		} else if ($id_izin == '5') {
			$jenis_konsultasi = '12';
		} else if ($id_izin == '6') {
			$jenis_konsultasi = '17';
		}
		$dataBangunan	= array(
			'id'					=> $id,
			//'id_izin'				=> $id_izin,
			'id_kec_bgn'			=> $id_kecamatan_bg,
			'id_kel_bgn'			=> $id_kelurahan_bg,
			'almt_bgn'				=> $alamat_bg,
			'id_fungsi_bg'			=> $id_fungsi_bg,
			'id_jns_bg'				=> $id_jns_bg,
			'nm_bgn'				=> $nama_bangunan,
			'luas_bgn'				=> $luas_bg,
			'tinggi_bgn'			=> $tinggi_bg,
			'jml_lantai'			=> $lantai_bg,
			'luas_basement'			=> $luas_basement,
			'lapis_basement'		=> $lapis_basement,
			'last_update'			=> date("Y-m-d h:i:sa"),
			'id_kolektif'			=> $id_kolektif,
			'tipeA'					=> json_encode($tipeA),
			'jumlahA'				=> json_encode($jumlahA),
			'luasA'					=> json_encode($luasA),
			'tinggiA'				=> json_encode($tinggiA),
			'lantaiA'				=> json_encode($lantaiA),
			'id_prasarana_bg'		=> $id_prasarana_bg,
			'luas_bgp'				=> $luas_bgp,
			'tinggi_bgp'			=> $tinggi_bgp,
			'id_doc_tek'			=> $id_doc_tek,
			'imb'					=> $imb,
			'slf'					=> $slf,
			'id_klasifikasi'		=> $id_klasifikasi
		);
		$data	= array(
			//'user_id' 			=> $this->Outh_model->Encryptor('decrypt', $user_id),
			'nm_pemilik'		=> $nm_pemilik,
			'jns_pemilik' 		=> $jns_pemilik,
			'glr_depan' 		=> $glr_depan,
			'glr_belakang' 		=> $glr_belakang,
			'alamat' 			=> $alamat,
			'id_provinsi' 		=> $nama_provinsi,
			'id_kabkota' 		=> $nama_kabkota,
			'id_kecamatan'		=> $nama_kecamatan,
			'id_kelurahan' 		=> $nama_kelurahan,
			'jenis_id' 			=> $jenis_id,
			'no_ktp' 			=> $no_ktp,
			'no_hp' 			=> $no_hp,
			'email' 			=> $email,
		);
		$this->Mglobals->setData('tmdatabangunan', $dataBangunan, 'id', $id);
		$this->Mglobals->setData('tmdatapemilik', $data, 'id', $id);
		$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
		$this->session->set_flashdata('status', 'success');
		redirect('PerubahanData/UbahPusat/'.$id);
	}

	public function CreateQrCode()
	{
		$no_konsultasi = $this->input->post('keterangan');
		$this->load->library('ciqrcode'); //pemanggilan library QR CODE
		$config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
		$config['quality']      = true; //boolean, the default is true
		$config['size']         = '1024'; //interger, the default is 1024
		$config['black']        = array(224,255,255); // array, default is arra/y(255,255,255)
		$config['white']        = array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);
		$image_name=$no_konsultasi.'.png'; //buat name dari qr code sesuai dengan nim
		//$params['data'] 	= 'http://simbg.pu.go.id/Main/Berkas/'.$no_konsultasi; //data yang akan di jadikan QR CODE  SLF SIMBG ver Baru
		//$params['data'] = 'http://simbg.pu.go.id/Main/VerifikasiPBG/'.$no_konsultasi; //data yang akan di jadikan QR CODE PBG
		$params['data'] = 'http://simbg.pu.go.id/Main/Konsultasi/'.$no_konsultasi; //data yang akan di jadikan QR CODE PBG
		//$params['data'] = 'https://simbg.pu.go.id/Main/DraftSLF/'.$sk_slf; //data yang akan di jadikan QR CODE SLF
		//$params['data'] = 'https://simbg.pu.go.id/Main/VerifikasiBerkas/'.$sk_slf; //data yang akan di jadikan QR CODE IMB Lama
		$params['level'] 	= 'H'; //H=High
		$params['size'] 	= 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$data['QR'] 		= $this->ciqrcode->generate($params);
		redirect('PerubahanData/QrCode');
	}

	public function Delete()
	{

		$id = $this->input->post('id');
		$ket = $this->input->post('keterangan');
		$thisdir = getcwd();
		$dirPath = $thisdir . "/object-storage/dekill/PerubahanData/";
		if (!file_exists($dirPath)) {
			//mkdir($dirPath, 0755, true);
		}
		$config['upload_path'] 		= $dirPath;
		$config['allowed_types'] 	= 'pdf|doc|PDF';
		$config['max_size']			= '5024';
		$config['remove_spaces']	= False;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$file = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES["upload"]['name']);
		if ($_FILES["upload"]["name"]) {
			$config["file_name"] = $file;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$dir_file = $this->upload->do_upload('upload');
			$filean = $this->upload->data();
			$filean = $filean['file_name'];
			if (!$dir_file) {
				$data['err_msg'] = $this->upload->display_errors();
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'warning');
				redirect('PerubahanData/HapusData');
			}
		}
		$id_user = $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps';
		$this->Global_model->updateData('id', $id, 'tmdatabangunan', ['status' => 26, 'pernyataan' => null]);
		$this->Global_model->insertData('th_perubahandata', ['id_delete' => $id, 'id_user' => $id_user, 'tanggal' => date('Y-m-d'), 'Ket' => $ket, 'dir_file'=>$filean]);
		$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
		$this->session->set_flashdata('status', 'success');
		redirect('PerubahanData/HapusData');
	}


	public function getDataKabKota()
	{
		$crsf = $this->security->get_csrf_hash();

		$id_provinsi	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $id_provinsi);

		if ($query->num_rows() > 0 && $id_provinsi != '') {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kabkot' => $row->id_kabkot, 'nama_kabkota' => $row->nama_kabkota);
			}
		}
		$value['csrf']  = $crsf;
		echo json_encode($value);
	}
	public function getDataKecamatan()
	{
		$crsf = $this->security->get_csrf_hash();

		$id_kabkot	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $id_kabkot);
		if ($query->num_rows() > 0 && $id_kabkot != '') {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kecamatan' => $row->id_kecamatan, 'nama_kecamatan' => $row->nama_kecamatan);
			}
		}
		$value['csrf']  = $crsf;
		echo json_encode($value);
	}

	public function getDataKelurahan()
	{
		$crsf = $this->security->get_csrf_hash();

		$id_kecamatan	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mglobal->listDataKelurahan('a.id_kelurahan,a.nama_kelurahan', '', $id_kecamatan);
		if ($query->num_rows() > 0 && $id_kecamatan != '') {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kelurahan' => $row->id_kelurahan, 'nama_kelurahan' => $row->nama_kelurahan);
			}
		}
		$value['csrf']  = $crsf;
		echo json_encode($value);
	}
	public function getDataJnsBg()
	{
		$crsf = $this->security->get_csrf_hash();
		$id_fungsi_bg	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mglobals->getData('*', 'tm_jenis_bg', array('id_fungsi_bg' => $id_fungsi_bg));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_jns_bg' => $row->id_jns_bg, 'nm_jenis_bg' => $row->nm_jenis_bg);
			}
		}
		$value['csrf'] = $crsf;
		echo json_encode($value);
	}

	public function editDataTanah($id,$detail)
	{
		$filterBangunan	= '	a.*,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi,e.nm_konsultasi';
		$data['DataBangunan']	= $this->Mperubahandata->getBangunan($filterBangunan, $id);
		$data['DataTanah'] = $this->Mglobals->getData('', 'tmdatatanah', array('id' => $id, 'id_detail'=>$detail))->row();
		echo $this->load->view('PerubahanData/FormTanah', $data, TRUE);
	}

	public function saveTanah()
	{
		$id								= $this->input->post('id');
		$user_id						= $this->session->userdata('loc_user_id');
		$id_detail						= $this->input->post('id_detail');
		$id_dokumen						= $this->input->post('id_dokumen');
		$nama_jns_dok_lain				= $this->input->post('nama_jns_dok_lain');
		$nomor_dokumen					= $this->input->post('nomor_dokumen');
		$tgl_terbit_dokumen				= $this->input->post('tgl_terbit_dokumen');
		$lokasi_tanah					= $this->input->post('lokasi_tanah');
		$luas_tanah						= $this->input->post('luas_tanah');
		$nama_pemegang_hak_atas_tanah	= $this->input->post('atas_nama');
		$hat							= $this->input->post('hat');
		$hat2							= $this->input->post('hat2');
		$no_dok_izin_pemanfaatan		= $this->input->post('no_dok_izin_pemanfaatan');
		$tgl_terbit_pemanfaatan			= $this->input->post('tgl_terbit_phat');
		$nama_pemegang_izin				= $this->input->post('nama_penerima_kuasa');
		$data_tanah = [
			'upload_path' => './object-storage/dekill/Earth/',
			'allowed_types' => 'pdf|PDF',
			'max_size' => '54000',
			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];
		$filetan = [];
		if ($_FILES["d_file_tan"]["name"]) {
			$this->load->library('upload', $data_tanah);
			$this->upload->initialize($data_tanah);
			$d_file_tan = $this->upload->do_upload('d_file_tan');
			$filetan = $this->upload->data();
			if (!$d_file_tan) {
				$data['err_msg'] = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'danger');
				redirect('PerubahanData/ubah/' . $id);
			}
		}
		if ($_FILES["d_file_phat"]["name"]) {
			$this->load->library('upload', $data_tanah);
			$this->upload->initialize($data_tanah);
			$d_file_phat = $this->upload->do_upload('d_file_phat');
			$filephat = $this->upload->data();
			if (!$d_file_phat) {
				$data['err_msg'] = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'danger');
				redirect('PerubahanData/ubah/' . $id);
			}
		}
		$data	= array(
			'id' 					=> $id,
			'id_dokumen' 			=> $id_dokumen,
			//'dir_file' 				=> !empty($filetan['file_name']) ? $filetan['file_name'] : '',
			'jenis_dokumen_phat' 	=> $nama_jns_dok_lain,
			'no_dok' 				=> $nomor_dokumen,
			'tanggal_dok' 			=> date('Y-m-d', strtotime($tgl_terbit_dokumen)),
			'lokasi_tanah' 			=> $lokasi_tanah,
			'luas_tanah' 			=> $luas_tanah,
			'atas_nama_dok' 		=> $nama_pemegang_hak_atas_tanah,
			'status_phat' 			=> $hat2,
			//'dir_file_phat' 		=>  !empty($filephat['file_name']) ? $filephat['file_name'] : '',
			'no_dokumen_phat' 		=> $no_dok_izin_pemanfaatan,
			'nama_penerima_phat' 	=> $nama_pemegang_izin,
			'hat' 					=> $hat,
			'tgl_terbit_phat' 		=> date('Y-m-d', strtotime($tgl_terbit_pemanfaatan)),
		);
		if ($id_detail != "") {
			$query		= $this->Mglobals->setData('tmdatatanah', $data, 'id_detail', $id_detail);
			$this->session->set_flashdata('message', 'Data Tanah Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('PerubahanData/ubah/' . $id);
		} else {
			$query		= $this->Mglobals->setData('tmdatatanah', $data, 'id_detail', $id_detail);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('PerubahanData/ubah/' . $id);
			} else {
				$this->session->set_flashdata('message', 'Data Tanah Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('PerubahanData/ubah/' . $id);
			}
		}
	}
	public function DataTPT() 
	{
		//$this->load->model('mglobal');
		$data = array(
			'asn' => $this->Mperubahandata->listDataPesonilAsn('*'),
			'keahlian' => $this->Mperubahandata->listDataBidang('a.id_bidang,a.nama_bidang'),
			'daftar_provinsi' => $this->Mperubahandata->listDataProvinsi('id_provinsi,nama_provinsi'),
			'title' => 'Daftar Personal TPT',
			'heading' => ''
		);
		$this->template->load('template/template_backend', 'personal_list', $data);
	
	}
	public function DataPenilik() 
	{
		//$this->load->model('mglobal');
		$data = array(
			'asn' => $this->Mperubahandata->listDataPesonilPenilik('*'),
			'keahlian' => $this->Mperubahandata->listDataBidang('a.id_bidang,a.nama_bidang'),
			'daftar_provinsi' => $this->Mperubahandata->listDataProvinsi('id_provinsi,nama_provinsi'),
			'title' => 'Daftar Personal Penilik',
			'heading' => ''
		);
		$this->template->load('template/template_backend', 'personal_penilik', $data);
	
	}
}
