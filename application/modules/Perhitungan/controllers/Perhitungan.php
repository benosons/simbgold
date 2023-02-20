<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan extends CI_Controller
{
    protected $pathPerda = 'object-storage/dekill/Retribution/';


    public function __construct()
    {
        parent::__construct();
        //ini_set('memory_limit', "4096M");
        $this->load->model(['Mperhitungan']);
        $this->load->library('Simbg_lib');
        $this->simbg_lib->check_session_login();
    }

    public function index()
    {
        $this->Perhitungan();
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
            'Penugasan' => !isset($_GET['cari']) ? $this->Mperhitungan->getDataRetribusi(null, $SQLcari)->result() : $search,
        ];
        $this->template->load('template/template_backend', 'Retribusi/RetribusiList', $data);
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
                $query = $this->Mperhitungan->getDataPenugasan(null, $SQLcari)->result();
            } else if (intval($proses) !== 0 && intval($fungsi_bg) === 0) {
                $query = $this->Mperhitungan->findProsesWithoutDate($proses)->result();
            } else if (intval($proses) === 0 && intval($fungsi_bg) !== 0) {
                $query = $this->Mperhitungan->findFungsiWithoutDate($fungsi_bg)->result();
            } else {
                $query = $this->Mperhitungan->findAllWithoutDate($fungsi_bg, $proses)->result();
            }
        } else {
            if (intval($fungsi_bg) === 0 && intval($proses) === 0) {
                $query = $this->Mperhitungan->getPenugasanAll($tglAwal, $tglAkhir)->result();
            } else if (intval($fungsi_bg) !== 0 && intval($proses) === 0) {
                $query = $this->Mperhitungan->findFungsi($fungsi_bg, $tglAwal, $tglAkhir)->result();
            } else if (intval($fungsi_bg) === 0 && intval($proses) !== 0) {
                $query = $this->Mperhitungan->findProses($proses, $tglAwal, $tglAkhir)->result();
            } else {
                $query = $this->Mperhitungan->findAll($fungsi_bg, $proses, $tglAwal, $tglAkhir)->result();
            }
        }
        return $query;
    }
    private function isDecimal($val)
    {
        return is_numeric($val) && floor($val) != $val;
    }
    public function retribusi($id = NULL)
    {
        $getId = $this->Mperhitungan->cekId($id);
        if ($getId->num_rows() > 0) {
            $row                    = $getId->row();
            $year                   = date('Y');
            $getShst                = $this->Mperhitungan->getShst($row->id_kabkot_bgn, $year)->row();
            $jumlahLantai           = $row->jml_lantai;
            $lapisBsement           = $row->lapis_basement;
            $jumlahLantai = 0;
            if (
                $row->id_jenis_permohonan == '11'
                || $row->id_jenis_permohonan == '29'
                || $row->id_jenis_permohonan == '30'
                || $row->id_jenis_permohonan == '31'
                || $row->id_jenis_permohonan == '32'
                || $row->id_jenis_permohonan == '33'
            ) {
                $lantai = json_decode($row->lantaiA);
                foreach ($lantai as $key => $value) {
                    $jumlahLantai += $value['lantai'];
                }
            } else {
                $jumlahLantai = $row->jml_lantai;
            }
            $getKoefisienLantai     = $this->Mperhitungan->getKoefisienLantai($jumlahLantai)->row();
            $getKoefisienBasement   = $this->Mperhitungan->getKoefisienBasement($lapisBsement)->row();
            $kl                     = $getKoefisienLantai === NULL ? 0 : $getKoefisienLantai->koefisien_lantai;
            $kb                     = $getKoefisienBasement === NULL ? 0 : $getKoefisienBasement->koefisien_basement;
            $koefisienLantai        = $this->isDecimal($kl) === true ? number_format((float)$getKoefisienLantai->koefisien_lantai, 3, '.', '') : intval($kl);
            $koefisienBasement      = $this->isDecimal($kb) === true ? number_format((float)$getKoefisienBasement->koefisien_basement, 3, '.', '') : intval($kb); 
			$retribusi              = $this->Mperhitungan->getRowRetribusi($id)->row();
            $data = [
                'row'               => $row,
                'title'             => 'Perhitungan Retribusi',
                'heading'           => '',
                'koefisienLantai'   => $koefisienLantai,
                'koefisienBasement' => $koefisienBasement,
                'jns_kepemilikan'   => $row->jns_pemilik,
                'kegiatan'          => $this->Mperhitungan->getKegiatan()->result(),
                'shst'              => $getShst,
                'retribusi'         => $retribusi
            ];
            $this->template->load('template/template_backend', 'Retribusi/PerhitunganRetribusi', $data);
        } else {
            redirect('Perhitungan');
        }
    }

    public function SimpanRetribusi()
    {
        $id                             = $this->input->post('id', TRUE);
        $usaha                          = $this->input->post('usaha', TRUE);
        $permanensi                     = $this->input->post('permanensi', TRUE);
        $kegiatan                       = $this->input->post('kegiatan', TRUE);
        $nilai_retribusi                = $this->input->post('nilai-retribusi', TRUE);
        $nilai_retribusi_prasarana      = $this->input->post('total-retribusi-input', TRUE);
        $nilai_retribusi_keseluruhan    = $this->input->post('total-retribusi-keseluruhan', TRUE);
        $indeks_integrasi               = $this->input->post('indeks-integrasi', TRUE);
        $indeks_lokalitas               = $this->input->post('indeks-lokalitas', TRUE);
        $indeks_kegiatan                = $this->input->post('indeks-kegiatan', TRUE);
        $parameter_fungsi               = $this->input->post('parameter-fungsi', TRUE);
        $parameter_kompleksitas         = $this->input->post('parameter-kompleksitas', TRUE);
        $parameter_ketinggian           = $this->input->post('parameter-ketinggian', TRUE);
        $group_b                        = $this->input->post('group-b');
        $shst                           = $this->input->post('shst', TRUE);
        $findRetribusi                  = $this->Mperhitungan->getRowRetribusi($id);
		$findPrasarana                  = $this->Mperhitungan->getDataPrasarana($id);
        $data = [
            'id'                            => $id,
			'id_permanensi'                 => $permanensi,
			'nilai_retribusi_bangunan'      => str_replace(['.', ','], '', $nilai_retribusi),
			'nilai_retribusi_prasarana'     => str_replace(['.', ','], '', $nilai_retribusi_prasarana),
			'nilai_retribusi_keseluruhan'   => str_replace(['.', ','], '', $nilai_retribusi_keseluruhan),
			'id_kegiatan'                   => $kegiatan,
			'indeks_integrasi'              => $indeks_integrasi,
			'indeks_lokalitas'              => $indeks_lokalitas,
			'indeks_kegiatan'               => $indeks_kegiatan,
			'parameter_fungsi'              => $parameter_fungsi,
			'parameter_kompleksitas'        => $parameter_kompleksitas,
			'parameter_ketinggian'          => $parameter_ketinggian,
			'status_perhitungan'            => 1,
			'shst'                          => $shst,
			'status_simpan'                 => 2,
			'parameter_usaha'               => $usaha,
        ];
        if (isset($_POST['group_b'])) {
			foreach ($group_b as $r) {
				$prasarana[] = [
					'id'                => $id,
					'nama_prasarana'    => $r['nama_prasarana'],
					'plv'               => $r['vlt'],
					'harga_prasarana'   => $r['harga'],
					'total_prasarana'   => $r['jumlah']
				];
			}
			if ($findPrasarana->num_rows() > 0) {
				$this->Mperhitungan->updatePrasaranaBatch($id, $prasarana);
			} else {
				$this->Mperhitungan->insertPrasaranaBatch($prasarana);
			}
		}
		if ($findRetribusi->num_rows() > 0) {
			$this->Mperhitungan->updatePerhituganRetriusi($id, $data);
		} else {
			$this->Mperhitungan->insertPerhituganRetriusi($data);
		}
        $update = [
            'status' => 10
        ];
        $this->Mperhitungan->updateStatusBangunan($id, $update);
        $this->session->set_flashdata('message', 'Perhitungan Retribusi Berhasil Disimpan!');
        $this->session->set_flashdata('status', 'success');
        redirect('Perhitungan', 'refresh');
    }
    public function simpan_perda()
    {
        $retribusi_bangunan     = $this->input->post('retribusi_bangunan');
        $retribusi_prasarana    = $this->input->post('retribusi_prasarana');
        $keseluruhan            = intval($retribusi_bangunan) + intval($retribusi_prasarana);
        $id                     = $this->input->post('id');
        $noId                   = $this->Mperhitungan->cekId($id)->row()->id;
        $confPerda = [
            'upload_path'   => "./{$this->pathPerda}",
            'allowed_types' => 'pdf|PDF',
            'max_size'      => '50000',
            'max_width'     => 5000,
            'max_height'    => 5000,
            'encrypt_name'  =>  TRUE,
            'remove_space'  => TRUE,
        ];
        $this->load->library('upload', $confPerda);
        if (!$this->upload->do_upload('berkas')) {
            $output = [
                'status' => false,
                'type' => 'error',
                'message' => 'Silahkan Upload Berkas Terlebih Dahulu!'
            ];
            header('Content-Type: application/json');
            echo json_encode($output);
        } else {
            if ($this->upload->data('file_ext') == ".pdf" || $this->upload->data('file_ext') == ".PDF") {
                $noId           = $this->Mperhitungan->cekId($id)->row()->id_pemilik;
                $email          = $this->Mperhitungan->cekId($id)->row()->email;
                $no_konsultasi  = $this->Mperhitungan->cekId($id)->row()->no_konsultasi;
                $ket            ="Telah Selesai Perhitungan Retribusi";
                $catatan        ="Menunggu Validasi Kepala Dinas Teknis";
                $tgl_skrg 		= date('Y-m-d');
                $data = [
                    'id'                            => $noId,
                    'nilai_retribusi_bangunan'      => $retribusi_bangunan,
                    'nilai_retribusi_prasarana'     => $retribusi_prasarana,
                    'nilai_retribusi_keseluruhan'   => $keseluruhan,
                    'file_retribusi'                => $this->upload->data('file_name'),
                    'status_perhitungan'            => 2
                ];
                $update = [
                    'status' => 10,
                ];
                $this->Mperhitungan->insertPerhituganRetriusi($data);
                $this->Mperhitungan->updateStatusBangunan($noId, $update);
                $output = [
                    'status'        => true,
                    'type'          => 'success',
                    'message'       => 'Data Retribusi Berhasil Disimpan!',
                    'no_konsultasi' => $id,
                    'dataId'        => $noId,
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            } else {
                $path   = FCPATH . "/{$this->pathPerda}";
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
            }
        }
    }
    public function Rollback($id){
		$id	        = $this->uri->segment(3);
		$pernyataan = '1';
		$tgl_skrg 	= date('Y-m-d');
		if ($pernyataan == '1') {
			$data	= array(
				'status'    => '6',
                'data_step' => '4',
			);
			$datalog	= [
				'id'            => $id,
				'tgl_status'    => $tgl_skrg,
				'status'        => '4',
				'catatan'       => 'Mengembalikan Permohonan  Ke Tahap Input Hasil Konsultasi',
				'modul'         => 'Permohonan DIkembalikan ke Tahap Input Hasil Konsultasi'
			];
			$this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
			$this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Input Hasil Konsultasi');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Perhitungan' );
	}
}

/* End of file Perhitungan.php */
