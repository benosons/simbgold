<?php defined('BASEPATH') or exit('No direct script access allowed');
class Kadintek extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utility');
        $this->load->model(array('Mkadintek', 'mglobal'));
        $this->load->library(array('Simbg_lib', 'Oss_lib'));
        $this->load->model('Mglobal');
        $this->load->model('Mglobals');
        $this->simbg_lib->check_session_login();
    }
    //Begin Validasi Kadis Teknis Hasil Inspeksi Bangunan Gedung Baru
    public function VerInpeksiBaru()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mkadintek->getListValInspeksiBangunanGedung();
        $data['title']      =    '';
        $data['heading']    =    '';
        $this->template->load('template/template_backend', 'Kadintek/ListBangunanGedungBaru', $data);
    }
    public function FormVerifikasiBangunanGedung()
    {
        $user_id        = $this->session->userdata('loc_user_id');
        $user_id        = $this->Outh_model->Encryptor('decrypt', $user_id);
        $id             = $this->input->post('id');
        $tgl_skrg       = date('Y-m-d');
        $data['id']     = $id;
        $DataVal        = $this->Mkadintek->getdatapermohonan($id)->row_array();
        $email          = $DataVal['email'];
        $nip_kadis      = $DataVal['nip_kepala_dinas'];
        $nama_kadis     = $DataVal['kepala_dinas'];
        $nama_dinas     = $DataVal['p_nama_dinas'];
        $stat_pejabat   = $DataVal['status_pejabat'];
        $no_konsultasi  = $DataVal['no_konsultasi'];

        //$sk_slf = $this->SK_SLF($id);

        $ket = "Proses Masuk Ke Dinas Perizinan Untuk Penerbitan Sertifikat Laik Fungsi (SLF)";
        if (trim($id) != '') {
            $dataStatus = array(
                'status' => 20,
            );
            $data    = array(
                'tgl_status' => $tgl_skrg,
                'status' => '20',
                'id' => $id,
                'catatan' => "Telah Selesai di Validasi Kepala Dinas Teknis dan akan masuk ke dinas perizinan untuk Untuk Penerbitan Sertifikat Laik Fungsi (SLF)",
                'user_id' => $user_id,
                'modul' => 'Validasi Kepala Dinas Teknis'
            );
            $dataval = array(
                'id' => $id,
                'tgl_validasi' => $tgl_skrg,
                'nip_kadis' => $nip_kadis,
                'nama_kadis' => $nama_kadis,
                'nama_dinas' => $nama_dinas,
                'stat_pejabat' => $stat_pejabat,
            );
            //$cek = $this->Mkadintek->cekNamaNoIzinSLF('a.id,a.no_izin_pbg', $sk_slf);
			

            $this->Mkadintek->updateProgress($dataStatus, $id);
            $this->Mglobals->setDatakol('tmdatavalkadintek', $dataval);
            $this->Mglobals->setDatakol('th_data_konsultasi', $data);

            /*$this->load->library('ciqrcode'); //pemanggilan library QR CODE
            $config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
			$config['quality']      = true; //boolean, the default is true
			$config['size']         = '1024'; //interger, the default is 1024
			$config['black']        = array(224,255,255); // array, default is array(255,255,255)
			$config['white']        = array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$image_name=$sk_slf.'.png'; //buat name dari qr code sesuai dengan nim
		    $params['data'] = 'https://simbg.pu.go.id/Main/Berkas/'.$sk_slf; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
			$data['QR'] = $this->ciqrcode->generate($params);*/

        }
        $email = "$email";
        $no_konsultasi = "$no_konsultasi";
        $ket    = "$ket";
        $subject     = "Status Progress Permohonan $no_konsultasi";
        $text         = "";
        $text .= "Yth Bapak/Ibu,<br>";
        $text .= "<br>";
        $text .= "Dengan ini kami memberitahukan bahwa Permohonan dengan No.Registrasi $no_konsultasi <br>";
        $text .= "Dengan keterangan Telah Selesai di Validasi Kepala Dinas Teknis<br>";
        $text .= "Catatan : $ket";
        $text .= "<br>";
        $text .= "<br>";
        $text .= "Hormat Kami <br>";
        $text .= "Admin SIMBG ";
        $this->simbg_lib->sendEmail($email, $subject, $text);
        $this->session->set_flashdata('message', 'Rekomandasi Teknis Terverifikasi');
        $this->session->set_flashdata('status', 'success');
        redirect('Kadintek/VerInpeksiBaru');
    }

    function SK_SLF($id=null)
	{
        $que = $this->Mkadintek->get_id_kabkot($id);
		$lokasi = $que['id_kec_bgn'];
        $tgl_disetujui = date('d').date('m').date('Y');
		$mydata2 = $this->Mkadintek->getNoDrafSlf($lokasi,$tgl_disetujui);
        if (count($mydata2) > 0) {
            $no_baru = SUBSTR($mydata2['no_registrasi_baru'], -3) + 1;
            if ($no_baru < 10) {
                $sk_pbg = "SK-SLF-" . $lokasi . "-" . $tgl_disetujui . "-00" . $no_baru;
            } else if ($no_baru < 99){
                $sk_pbg = "SK-SLF-" . $lokasi . "-" . $tgl_disetujui . "-0" . $no_baru;
            }else if($no_baru > 100){
                $sk_pbg = "SK-SLF-" . $lokasi . "-" . $tgl_disetujui . "-" . $no_baru;
            }else{
                $sk_pbg = "SK-SLF-" . $lokasi . "-" . $tgl_disetujui . "-" . $no_baru;
            }
        } else {
            $sk_pbg = "SK-SLF-" . $lokasi . "-" . $tgl_disetujui . "-001";
        }
		return $sk_pbg;
	}

    public function RollbackKadis()
    {
        $id    = $this->uri->segment(3);
        $pernyataan = '1';
        $tgl_skrg     = date('Y-m-d');
        if ($pernyataan == '1') {
            $data    = array(
                'status' => '18',
            );
            $datalog    = [
                'id' => $id,
                'tgl_status' => $tgl_skrg,
                'status' => '5',
                'catatan' => 'Kepalad Dinas melakukan Mengembalikan Permohonan  Ke Tahap Perhitungan Retribusi',
                'modul' => 'Permohonan Dikembalikan ke Tahap Perhitungan Retribusi'
            ];
            $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Perhitungan Retribusi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('Kadintek/VerInpeksiBaru');
    }
    //End Validasi Kadis Teknis Hasil Inspeksi Bangunan Gedung Baru
    //Begin Validasi Kadis Teknis Hasil Inspeksi Bangunan Prasarana Baru
    public function VerInpeksiPrasaranaBaru()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mkadintek->getListValInspeksiBangunanPrasarana();
        $data['title']      =    '';
        $data['heading']    =    '';
        $this->template->load('template/template_backend', 'Kadintek/ListBangunanPrasaranaBaru', $data);
    }
    public function FormVerifikasiBangunanPrasarana()
    {
        $user_id        = $this->session->userdata('loc_user_id');
        $user_id        = $this->Outh_model->Encryptor('decrypt', $user_id);
        $id = $this->input->post('id');
        $tgl_skrg         = date('Y-m-d');
        $data['id'] = $id;
        $DataVal = $this->Mkadintek->getdatapermohonan($id)->row_array();
        $imb = $DataVal['imb'];
        $email = $DataVal['email'];
        $nip_kadis = $DataVal['nip_kepala_dinas'];
        $nama_kadis = $DataVal['kepala_dinas'];
        $nama_dinas = $DataVal['p_nama_dinas'];
        $stat_pejabat = $DataVal['status_pejabat'];
        $no_konsultasi = $DataVal['no_konsultasi'];
        $ket = "Proses Masuk Ke Dinas Perizinan Untuk Validasi Kepala Dinas Perizinan Untuk Penerbitan SLF";
        if (trim($id) != '') {
            $dataStatus = array(
                'status' => 13,
            );
            $data    = array(
                'tgl_status' => $tgl_skrg,
                'status' => '13',
                'id' => $id,
                'catatan' => "Telah Selesai di Validasi Kepala Dinas Teknis dan akan di Validasi Kepala Dinas Perizinan",
                'user_id' => $user_id,
                'modul' => 'Validasi Kepala Dinas Teknis'
            );
            $dataval = array(
                'id' => $id,
                'tgl_validasi' => $tgl_skrg,
                'nip_kadis' => $nip_kadis,
                'nama_kadis' => $nama_kadis,
                'nama_dinas' => $nama_dinas,
                'stat_pejabat' => $stat_pejabat,
            );
            $this->Mkadintek->updateProgress($dataStatus, $id);
            $this->Mglobals->setDatakol('tmdatavalkadintek', $dataval);
            $this->Mglobals->setDatakol('th_data_konsultasi', $data);
        }
        $email = "$email";
        $no_konsultasi = "$no_konsultasi";
        $ket    = "$ket";
        $subject     = "Status Progress Permohonan $no_konsultasi";
        $text         = "";
        $text .= "Yth Bapak/Ibu,<br>";
        $text .= "<br>";
        $text .= "Dengan ini kami memberitahukan bahwa Permohonan dengan No.Registrasi $no_konsultasi <br>";
        $text .= "Dengan keterangan Telah Selesai di Validasi Kepala Dinas Teknis<br>";
        $text .= "Catatan : $ket";
        $text .= "<br>";
        $text .= "<br>";
        $text .= "Hormat Kami <br>";
        $text .= "Admin SIMBG ";
        $this->simbg_lib->sendEmail($email, $subject, $text);
        $this->session->set_flashdata('message', 'Rekomandasi Teknis Terverifikasi');
        $this->session->set_flashdata('status', 'success');
        redirect('Kadintek/Valeksisting');
    }

    public function RollbackKadisEksis()
    {
        $id    = $this->uri->segment(3);
        $pernyataan = '1';
        $tgl_skrg     = date('Y-m-d');
        if ($pernyataan == '1') {
            $data    = array(
                'status' => '6',
                'data_step' => '4',
            );
            $datalog    = [
                'id' => $id,
                'tgl_status' => $tgl_skrg,
                'status' => '5',
                'catatan' => 'Kabid/Kasie melakukan Mengembalikan Permohonan  Ke Tahap Perhitungan Retribusi',
                'modul' => 'Permohonan Dikembalikan ke Tahap Perhitungan Retribusi'
            ];
            $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mkadintek->removeDataRetribusi($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Perhitungan Retribusi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('Kadintek/Valeksisting');
    }
    //End Validasi Kadis Teknis Bangunan Eksisting Sudah Memiliki IMB
    //Begin Validasi Kadis Teknis Bangunan Eksisting Tidak Memiliki IMB
    public function ValEksisNon() 
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $data['id_kabkot']  =
        $SQLcari            = "";
        $data['Kadis']      = $this->Mkadintek->getListValEksisNon(null, $SQLcari);
        $data['content']    = $this->load->view('ListValidasiEksisNon', $data, TRUE);
        $data['title']      =    '';
        $data['heading']    =    '';
        $this->template->load('template/template_backend', 'Kadintek/ListValidasiEksisNon', $data);
    }
    //End Validasi Kadis Teknis Bangunan Eksisting Tidak Memiliki IMB
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
        $id_fungsi_bg = $this->input->get('id', TRUE);
        $value        = array();
        $query        = $this->mglobals->getData('*', 'tm_jenis_bg', array('id_fungsi_bg' => $id_fungsi_bg));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $value[]    = array('id_jns_bg' => $row->id_jns_bg, 'nm_jenis_bg' => $row->nm_jenis_bg);
            }
        }
        echo json_encode($value);
    }
    public function Rollback()
    {
        $id    = $this->uri->segment(3);
        $pernyataan = '1';
        $tgl_skrg     = date('Y-m-d');
        if ($pernyataan == '1') {
            $data    = array(
                'status' => '5',
            );
            $datalog    = [
                'id' => $id,
                'tgl_status' => $tgl_skrg,
                'status' => '5',
                'catatan' => 'Kabid/Kasie melakukan Mengembalikan Permohonan  Ke Tahap Penjadwalan',
                'modul' => 'Permohonan Dikembalikan ke Tahap Penjadwalan TPA/TPT'
            ];
            $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mpemeriksaan->removeDataJadwal($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Verifikasi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('Pemeriksaan/Penilaian');
    }
    public function Catatan($id = null)
    {
        $id                 = $this->uri->segment(3);
        $data['id']            = $id;
        $data['DataBangunan'] = $this->Mpemeriksaan->getcatatan('a.catatan', $id);
        $this->load->view('Validasi/kosong', $data);
    }
}
/* End of file Pemeriksaan.php */
