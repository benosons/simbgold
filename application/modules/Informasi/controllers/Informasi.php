<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Informasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Simbg_lib');
		$this->load->model('Minfo');
		//$this->load->helper(array('captcha', 'form'));
		$this->tahun = date('Y');
	}

	public function index()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_info', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}
	
	
	//Menu Baru Pemohon
	
	public function Pemohon()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Pemohon', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}

	public function Perencana_Kontruksi()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Perencana_Kontruksi', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}

	public function Pelaksana_Kontruksi()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Pelaksana_Kontruksi', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}

	public function Perencana_Pembongkaran()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Perencana_Pembongkaran', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}

	public function Pelaksana_Pembongkaran()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Pelaksana_Pembongkaran', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}
	
	//Akhir Menu Pemohon

	//Awal Menu TPA
	public function Tpa()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Tpa', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}
	
	public function Calon_Tpa()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_CTPA', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}

	public function Asosiasi_Profesi()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Asosiasi_Profesi', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}

	public function Perguruan_Tinggi()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Perguruan_Tinggi', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}

	//Akhir Menu TPA

	//Awal Menu Arsitek
	/* public function Arsitek()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Arsitek', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	} */
	//Akhir Menu Arsitek

	//Awal Menu Pemda
	public function Dinas_Teknis()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Dinas_Teknis', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}
	
	public function Dpmptsp()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Dpmptsp', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}
	//Akhir Menu Pemda

	//Awal Menu Pusat
	public function Eksekutif()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Eksekutif', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}

	public function Sekretariat()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Sekretariat', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}

	public function Sekre()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Sekre', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}

	public function Balai_Daerah()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_Balai_Daerah', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}

	public function BGFK()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			//$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan_BGFK', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}


	//Akhir Menu Pusat

	public function Lacak()
	{
		$data = "";
		$nobobo = $this->uri->segment(3);
		$no_registrasi = str_replace("'", "", htmlspecialchars($nobobo, ENT_QUOTES));
		$SQLcari = "";
		if (trim($no_registrasi) != '') {
			$SQLcari .= " AND b.no_konsultasi = '$no_registrasi' ";
		}
		$query = $this->Minfo->getRegistrasi($SQLcari);
		$mydata = $query->row_array();
		$baris = $query->num_rows();

		if ($no_registrasi != "") {
			if ($baris >= 1) {
				$i = 0;
				foreach ($query->result() as $row) {
					/* if ($row->dir_file != null) {
						$file = "Download";
					} else {
						$file = "Tidak Ada File";
					} */
					$i++;
					$data .= '<tr>
					<td>' . $i . '</td>
					<td>' . $row->modul . '</td>
					<td>' . $row->tgl_status . '</td>
					<td>' . $row->catatan . '</td>
					
					
					</tr>';
				}
				echo $data;
			} else {
				$fix = "Nomor Registrasi Tidak Ditemukan";
				$data2 = '<tr><td colspan="4" align="center">' . $fix . '</td></tr>';
				echo $data2;
			}
		}
	}
}
