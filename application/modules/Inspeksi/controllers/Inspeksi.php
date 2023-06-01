<?php defined('BASEPATH') or exit('No direct script access allowed');
class Inspeksi extends CI_Controller
{
    protected $pathBerkas = 'dekill/Inspection/berkas/';
    protected $pathBerita = 'dekill/Inspection/berita_acara/';
    protected $pathJustifikasi = 'dekill/Inspection/justifikasi/';
    protected $pathCatatan = 'dekill/Inspection/catatan/';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utility');
        $this->load->model(array('Minspeksi', 'mglobal'));
        $this->load->library(array('simbg_lib', 'oss_lib'));
        $this->simbg_lib->check_session_login();
    }
    public function index()
    {
        $this->Penugasan();
    }
    public function list_inspeksi()
    {
        $data['Penugasan']      = $this->Minspeksi->getListKonsultasi();
        $data['title']        =    'List Data Konsultasi';
        $data['heading']    =    '';
        $this->template->load('template/template_backend', 'Inspeksi/list_konsultasi', $data);
    }
    public function PemeriksaanInspeksi($id = NULL)
    {
        $getId = $this->Minspeksi->getPermohonanList($id);
        if ($getId->num_rows() > 0) {
            $row = $getId->row();
            $struktur_bawah = $this->Minspeksi->getJenisInspeksi($id, 1)->row();
            $basement = $this->Minspeksi->getJenisInspeksi($id, 2)->row();
            $struktur_atas = $this->Minspeksi->getJenisInspeksi($id, 3)->row();
            $testing = $this->Minspeksi->getJenisInspeksi($id, 4)->row();
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
                'id_provinsi' => $row->id_provinsi,
                'id_kabkota' => $row->id_kabkota,
                'id_kecamatan' => $row->id_kecamatan,
                'nm_bgn' => $row->nm_bgn,
                'id_prov_bgn' => $row->id_prov_bgn,
                'id_kabkot_bgn' => $row->id_kabkot_bgn,
                'id_kec_bgn' => $row->id_kec_bgn,
                'get_konsultasi' => $get_konsultasi,
                'id_jenis_permohonan' => $id,
                'get_fungsi' => $get_fungsi,
                'luas_basement' => $row->luas_basement,
                'lapis_basement' => $row->lapis_basement,
                'title' => 'Inspeksi',
                'heading'  => '',
                'pathCatatan' => "file/Konsultasi/{$id}/Inspeksi/Catatan",
                'pathInspeksi' => "file/Konsultasi/{$id}/Inspeksi/Dokumen",
                'pathJustifikasi' => "file/Konsultasi/{$id}/Inspeksi/Justifikasi",
                'struktur_bawah' => $struktur_bawah,
                'basement' => $basement,
                'struktur_atas' => $struktur_atas,
                'testing' => $testing,
            );
            $this->template->load('template/template_backend', 'pemeriksaan_inspeksi', $data);
        } else {
            redirect('Inspeksi/ListInspeksi');
        }
    }

    public function Penugasan()
    {
        $id_fungsi_bg = $this->input->get('id_fungsi_bg', TRUE);
		$id_proses = $this->input->get('id_proses', TRUE);
		$tanggalawal = $this->input->get('tanggalawal', TRUE);
		$tanggalakhir = $this->input->get('tanggalakhir', TRUE);
		$SQLcari 	= "";
		$data['title']		=	'Penugasan Inspeksi';
		$data['heading']	=	'';
		$search = $this->search([$id_fungsi_bg, $id_proses, $tanggalawal, $tanggalakhir]);
		$data['Penugasan'] = !isset($_GET['cari']) ? $this->Minspeksi->getDataPenugasan(null, $SQLcari)->result() : $search;
		$data['content']	= $this->load->view('list_konsultasi', $data, TRUE);
		$this->load->view('backend_adm', $data);
    }

    public function penugasan_inspeksi()
	{
		$year = date('Y');
        //$year = 2021;
		$id = $this->uri->segment(3);
		$que = $this->Minspeksi->getDetailPengawas($id)->row_array();
		$id_kabkot = $que['id_kabkot_bgn'];
		$rew   = $this->Minspeksi->getByIdPtugasInspeksi($id);
		$result = $this->Minspeksi->getTimPenilik($id_kabkot, $year);
		$data = array(
			'judul' => 'Pilh Tim Penilik',
			'result' => $result->result(),
			'que' => $que,
			'rew' => $rew,
		);
		$this->load->view('inspeksi_form', $data);
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
			$cekPersonil = 	$this->Minspeksi->cekPersonalPenugasanInspeksi($id_pemilik, $k);
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
					'status' => 18,
					'post_date' => $tgl_log,
					'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
				);
				$this->Minspeksi->insertDataPenugasanInspeksi($dataP);
				$this->Minspeksi->updateStats($data, $id_pemilik);
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
				$query = $this->Minspeksi->getDataPenugasan(null, $SQLcari)->result();
			} else if (intval($proses) !== 0 && intval($fungsi_bg) === 0) {
				$query = $this->Minspeksi->findProsesWithoutDate($proses)->result();
			} else if (intval($proses) === 0 && intval($fungsi_bg) !== 0) {
				$query = $this->Minspeksi->findFungsiWithoutDate($fungsi_bg)->result();
			} else {
				$query = $this->Minspeksi->findAllWithoutDate($fungsi_bg, $proses)->result();
			}
		} else {
			if (intval($fungsi_bg) === 0 && intval($proses) === 0) {
				$query = $this->Minspeksi->getPenugasanAll($tglAwal, $tglAkhir)->result();
			} else if (intval($fungsi_bg) !== 0 && intval($proses) === 0) {
				$query = $this->Minspeksi->findFungsi($fungsi_bg, $tglAwal, $tglAkhir)->result();
			} else if (intval($fungsi_bg) === 0 && intval($proses) !== 0) {
				$query = $this->Minspeksi->findProses($proses, $tglAwal, $tglAkhir)->result();
			} else {
				$query = $this->Minspeksi->findAll($fungsi_bg, $proses, $tglAwal, $tglAkhir)->result();
			}
		}
		return $query;
	}

    public function detail_inspeksi($id = NULL)
    {
        $getId = $this->Minspeksi->get_permohonan_list($id);
        if ($getId->num_rows() > 0) {
            $row = $getId->row();
            $cekId = $this->Minspeksi->cekIdBangunan($id)->row();
            $id_bgn = $cekId;
            $group = $this->grouping_data($id_bgn);
            $struktur_bawah = $this->Minspeksi->getJenisInspeksi($id_bgn, 1)->row();
            $basement = $this->Minspeksi->getJenisInspeksi($id_bgn, 2)->row();
            $struktur_atas = $this->Minspeksi->getJenisInspeksi($id_bgn, 3)->row();
            $testing = $this->Minspeksi->getJenisInspeksi($id_bgn, 4)->row();
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
                $this->template->load('template/template_backend', 'pemeriksaan_inspeksi', $data);
            } else if ($group === 1) {
                $this->template->load('template/template_backend', 'pemeriksaan_inspeksi', $data);
            } else if ($group === 2) {
                $this->template->load('template/template_backend', 'pemeriksaan_inspeksi', $data);
            } else {
				$this->template->load('template/template_backend', 'pemeriksaan_inspeksi', $data);
            }
        } else {

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

    public function simpan_inspeksi()
    {
        $idKonsultasi = $this->input->post('idKonsultasi', TRUE);
        $struktur = $this->input->post('struktur', TRUE);
        $kesesuaian = filter_var($this->input->post('kesesuaian'), FILTER_VALIDATE_BOOLEAN);
        $confCatatan = [
            'upload_path' => "./{$this->pathCatatan}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $confJustifikasi = [
            'upload_path' => "./{$this->pathJustifikasi}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $config = [
            'upload_path' => "./{$this->pathBerkas}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $this->load->library('upload', $config, 'berkas');
        $this->load->library('upload', $confJustifikasi, 'justifikasi');
        $this->load->library('upload', $confCatatan, 'catatan');
        $id_inspeksi = $this->input->post('id_inspeksi', TRUE);

        if ($id_inspeksi != '' && $id_inspeksi != NULL) {
            if (!$this->berkas->do_upload('berkas')  && !$this->catatan->do_upload('catatan') && !$this->justifikasi->do_upload('justifikasi')) {
                $data = [
                    'id' => $idKonsultasi,
                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                    'kesesuaian' => $kesesuaian == true ? 1 : 0,
                ];
                $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                $result[] = [
                    'id_pemilik' => $idKonsultasi,
                    'pemeriksaan' => $row->nama_pemeriksaan,
                    'kesesuaian' => $row->kesesuaian,
                    'catatan' => $row->catatan == NULL ? false : $row->catatan,
                    'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                    'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                ];
                $output = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Hasil Data Pemeriksaan Inspeksi',
                    'uploaded' => 'Semua Berkas Tidak Diupload!',
                    'result' => $result
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
                // echo "semua berkas tidak diupload!";
            } else if ($this->berkas->do_upload('berkas') && !$this->catatan->do_upload('catatan') && !$this->justifikasi->do_upload('justifikasi')) {
                if ($this->berkas->data('file_ext') != ".pdf") {
                    $path = $this->pathBerkas;
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
                    $data = [
                        'id' => $idKonsultasi,
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                        'berkas_file' => $this->berkas->data('file_name'),
                    ];
                    $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Berkas Berhasil Di Upload!',
                        'result' => $result
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                // echo "Berkas terupload, tapi catatan dan justifikasi tidak di upload!";
            } else if (!$this->berkas->do_upload('berkas') && $this->catatan->do_upload('catatan') && !$this->justifikasi->do_upload('justifikasi')) {
                if ($this->catatan->data('file_ext') != ".pdf") {
                    $path = $this->pathCatatan;
                    $berkas = $path . $this->catatan->data('file_name');
                    if (!unlink($berkas)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload File Catatan Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'id' => $idKonsultasi,
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                        'catatan' => $this->catatan->data('file_name'),
                    ];
                    $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Catatan Berhasil Di Upload!',
                        'result' => $result
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                // echo "catatan terupload, tapi berkas dan justifikasi tidak di upload!";
            } else if (!$this->berkas->do_upload('berkas') && !$this->catatan->do_upload('catatan') && $this->justifikasi->do_upload('justifikasi')) {
                $data = [
                    'id' => $idKonsultasi,
                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                    'kesesuaian' => $kesesuaian == true ? 1 : 0,
                    'berkas_justifikasi' => $this->justifikasi->data('file_name')
                ];
                $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                $result[] = [
                    'id_pemilik' => $idKonsultasi,
                    'pemeriksaan' => $row->nama_pemeriksaan,
                    'kesesuaian' => $row->kesesuaian,
                    'catatan' => $row->catatan == NULL ? false : $row->catatan,
                    'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                    'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                ];
                $output = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Hasil Data Pemeriksaan Inspeksi',
                    'uploaded' => 'Justifikasi Berhasil Di Upload!',
                    'result' => $result,
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            } else if ($this->berkas->do_upload('berkas') && $this->catatan->do_upload('catatan') && !$this->justifikasi->do_upload('justifikasi')) {
                if ($this->catatan->data('file_ext') != ".pdf" || $this->berkas->data('file_ext') != ".pdf") {
                    $pathCatatan = $this->pathCatatan;
                    $pathBerkas = $this->pathBerkas;
                    $berkasDokumen = $pathBerkas . $this->berkas->data('file_name');
                    $catatanBerkas = $pathCatatan . $this->catatan->data('file_name');
                    if (!unlink($berkasDokumen) || !unlink($catatanBerkas)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload File Berkas atau Catatan Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'id' => $idKonsultasi,
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                        'berkas_file' => $this->berkas->data('file_name'),
                        'catatan' => $this->catatan->data('file_name'),
                    ];
                    $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Berkas dan Catatan Berhasil Di Upload!',
                        'result' => $result
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                // echo "berkas terupload, catatan terupload, tapi justifikasi tidak di upload!";
            } else if (!$this->berkas->do_upload('berkas') && $this->catatan->do_upload('catatan') && $this->justifikasi->do_upload('justifikasi')) {
                if ($this->catatan->data('file_ext') != ".pdf") {
                    $pathCatatan = $this->pathCatatan;
                    $catatanBerkas = $pathCatatan . $this->catatan->data('file_name');
                    if (!unlink($catatanBerkas)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload File Catatan Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'id' => $idKonsultasi,
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                        'catatan' => $this->catatan->data('file_name'),
                        'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                    ];
                    $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Catatan dan Justifikasi Berhasil Di Upload!',
                        'result' => $result
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                // echo "catatan terupload, justifikasi terupload, tapi berkas tidak di upload!";
            } else if ($this->berkas->do_upload('berkas') && !$this->catatan->do_upload('catatan') && $this->justifikasi->do_upload('justifikasi')) {
                if ($this->berkas->data('file_ext') != ".pdf") {
                    $pathBerkas = $this->pathBerkas;
                    $berkasDokumen = $pathBerkas . $this->berkas->data('file_name');
                    if (!unlink($berkasDokumen)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload File Berkas Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'id' => $idKonsultasi,
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                        'berkas_file' => $this->berkas->data('file_name'),
                        'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                    ];
                    $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Catatan dan Justifikasi Berhasil Di Upload!',
                        'result' => $result,
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                // echo "berkas terupload, justifikasi terupload, tapi catatan tidak di upload!";
            } else {
                if ($this->catatan->data('file_ext') != ".pdf" || $this->berkas->data('file_ext') != ".pdf") {
                    $pathCatatan = $this->pathCatatan;
                    $pathBerkas = $this->pathBerkas;
                    $berkasDokumen = $pathBerkas . $this->berkas->data('file_name');
                    $catatanBerkas = $pathCatatan . $this->catatan->data('file_name');
                    if (!unlink($berkasDokumen) || !unlink($catatanBerkas)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload File Berkas atau Catatan Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'id' => $idKonsultasi,
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                        'berkas_file' => $this->berkas->data('file_name'),
                        'catatan' => $this->catatan->data('file_name'),
                        'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                    ];
                    $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Semua Dokumen Berhasil Di Upload!',
                        'result' => $result
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                // echo "semua berkas terupload!";
            }
        } else {
            if (!$this->berkas->do_upload('berkas')  && !$this->catatan->do_upload('catatan') && !$this->justifikasi->do_upload('justifikasi')) {
                if ($struktur == 2) {
                    $data = [
                        'id' => $idKonsultasi,
                        'id_struktur' => $this->input->post('id'),
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                    ];
                    $this->Minspeksi->insertInspeksi($data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Semua Berkas Tidak Diupload!',
                        'result' => $result,
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $output = [
                        'status' => false,
                        'type' => 'error',
                        'message' => 'Silahkan Upload File Berkas Terlebih Dahulu!',
                        'uploaded' => 'Semua Berkas Tidak Diupload!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
            } else if ($this->berkas->do_upload('berkas') && !$this->catatan->do_upload('catatan') && !$this->justifikasi->do_upload('justifikasi')) {
                if ($this->berkas->data('file_ext') != ".pdf") {
                    $path = $this->pathBerkas;
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
                    $data = [
                        'id' => $idKonsultasi,
                        'id_struktur' => $this->input->post('id'),
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                        'berkas_file' => $this->berkas->data('file_name'),
                    ];
                    $this->Minspeksi->insertInspeksi($data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Berkas Berhasil Di Upload!',
                        'result' => $result
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                // echo "Berkas terupload, tapi catatan dan justifikasi tidak di upload!";
            } else if (!$this->berkas->do_upload('berkas') && $this->catatan->do_upload('catatan') && !$this->justifikasi->do_upload('justifikasi')) {
                if ($this->catatan->data('file_ext') != ".pdf") {
                    $path = $this->pathCatatan;
                    $berkas = $path . $this->catatan->data('file_name');
                    if (!unlink($berkas)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload File Catatan Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'id' => $idKonsultasi,
                        'id_struktur' => $this->input->post('id'),
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                        'catatan' => $this->catatan->data('file_name'),
                    ];
                    $this->Minspeksi->insertInspeksi($data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Catatan Berhasil Di Upload!',
                        'result' => $result
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                // echo "catatan terupload, tapi berkas dan justifikasi tidak di upload!";
            } else if (!$this->berkas->do_upload('berkas') && !$this->catatan->do_upload('catatan') && $this->justifikasi->do_upload('justifikasi')) {
                $data = [
                    'id' => $idKonsultasi,
                    'id_struktur' => $this->input->post('id'),
                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                    'kesesuaian' => $kesesuaian == true ? 1 : 0,
                ];
                $this->Minspeksi->insertInspeksi($data);
                $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                $result[] = [
                    'id_pemilik' => $idKonsultasi,
                    'pemeriksaan' => $row->nama_pemeriksaan,
                    'kesesuaian' => $row->kesesuaian,
                    'catatan' => $row->catatan == NULL ? false : $row->catatan,
                    'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                    'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                ];
                $output = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Hasil Data Pemeriksaan Inspeksi',
                    'uploaded' => 'Justifikasi Berhasil Di Upload!',
                    'result' => $result
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
                // echo "justifikasi terupload, tapi berkas dan catatan tidak di upload!";
            } else if ($this->berkas->do_upload('berkas') && $this->catatan->do_upload('catatan') && !$this->justifikasi->do_upload('justifikasi')) {
                if ($this->catatan->data('file_ext') != ".pdf" || $this->berkas->data('file_ext') != ".pdf") {
                    $pathCatatan = $this->pathCatatan;
                    $pathBerkas = $this->pathBerkas;
                    $berkasDokumen = $pathBerkas . $this->berkas->data('file_name');
                    $catatanBerkas = $pathCatatan . $this->catatan->data('file_name');
                    if (!unlink($berkasDokumen) || !unlink($catatanBerkas)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload File Berkas atau Catatan Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'id' => $idKonsultasi,
                        'id_struktur' => $this->input->post('id'),
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                        'berkas_file' => $this->berkas->data('file_name'),
                        'catatan' => $this->catatan->data('file_name'),
                    ];
                    $this->Minspeksi->insertInspeksi($data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Berkas dan Catatan Berhasil Di Upload!',
                        'result' => $result
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                // echo "berkas terupload, catatan terupload, tapi justifikasi tidak di upload!";
            } else if (!$this->berkas->do_upload('berkas') && $this->catatan->do_upload('catatan') && $this->justifikasi->do_upload('justifikasi')) {
                if ($this->catatan->data('file_ext') != ".pdf") {
                    $pathCatatan = $this->pathCatatan;
                    $catatanBerkas = $pathCatatan . $this->catatan->data('file_name');
                    if (!unlink($catatanBerkas)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload File Catatan Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'id' => $idKonsultasi,
                        'id_struktur' => $this->input->post('id'),
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                        'catatan' => $this->catatan->data('file_name'),
                        'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                    ];
                    $this->Minspeksi->insertInspeksi($data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Catatan dan Justifikasi Berhasil Di Upload!',
                        'result' => $result
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                // echo "catatan terupload, justifikasi terupload, tapi berkas tidak di upload!";
            } else if ($this->berkas->do_upload('berkas') && !$this->catatan->do_upload('catatan') && $this->justifikasi->do_upload('justifikasi')) {
                if ($this->berkas->data('file_ext') != ".pdf") {
                    $pathBerkas = $this->pathBerkas;
                    $berkasDokumen = $pathBerkas . $this->berkas->data('file_name');
                    if (!unlink($berkasDokumen)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload File Berkas Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'id' => $idKonsultasi,
                        'id_struktur' => $this->input->post('id'),
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                        'berkas_file' => $this->berkas->data('file_name'),
                        'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                    ];
                    $this->Minspeksi->insertInspeksi($data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Catatan dan Justifikasi Berhasil Di Upload!',
                        'result' => $result
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                // echo "berkas terupload, justifikasi terupload, tapi catatan tidak di upload!";
            } else {
                if ($this->catatan->data('file_ext') != ".pdf" || $this->berkas->data('file_ext') != ".pdf") {
                    $pathCatatan = $this->pathCatatan;
                    $pathBerkas = $this->pathBerkas;
                    $berkasDokumen = $pathBerkas . $this->berkas->data('file_name');
                    $catatanBerkas = $pathCatatan . $this->catatan->data('file_name');
                    if (!unlink($berkasDokumen) || !unlink($catatanBerkas)) {
                    }
                    $output = [
                        'status' => false,
                        'type' => 'warning',
                        'message' => 'Silahkan Upload File Berkas atau Catatan Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'id' => $idKonsultasi,
                        'id_struktur' => $this->input->post('id'),
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $kesesuaian == true ? 1 : 0,
                        'berkas_file' => $this->berkas->data('file_name'),
                        'catatan' => $this->catatan->data('file_name'),
                        'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                    ];
                    $this->Minspeksi->insertInspeksi($data);
                    $row = $this->getRowInspeksi($idKonsultasi, $struktur)->row();
                    $result[] = [
                        'id_pemilik' => $idKonsultasi,
                        'pemeriksaan' => $row->nama_pemeriksaan,
                        'kesesuaian' => $row->kesesuaian,
                        'catatan' => $row->catatan == NULL ? false : $row->catatan,
                        'berkas_file' => $row->berkas_file == NULL ? false : $row->berkas_file,
                        'berkas_justifikasi' => $row->berkas_justifikasi == NULL ? false : $row->berkas_justifikasi,
                    ];
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi',
                        'uploaded' => 'Semua Dokumen Berhasil Di Upload!',
                        'result' => $result
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
                // echo "semua berkas terupload!";
            }
        }
    }


    private function getRowInspeksi($konsultasi, $struktur)
    {
        return $this->Minspeksi->getJenisInspeksi($konsultasi, $struktur);
    }

    
    public function simpan_inspeksiOld()
    {
        $idKonsultasi = $this->input->post('idKonsultasi', TRUE);
        $thisdir = getcwd();
        $dirPathCatatan = $thisdir . "/file/Konsultasi/$idKonsultasi/Inspeksi/Catatan/";
        $dirPathDokumen = $thisdir . "/file/Konsultasi/$idKonsultasi/Inspeksi/Dokumen/";
        $dirPathJustifikasi = $thisdir . "/file/Konsultasi/$idKonsultasi/Inspeksi/Justifikasi/";
        $confCatatan = [
            'upload_path' => $this->pathCatatan,
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $confJustifikasi = [
            'upload_path' => "{$dirPathJustifikasi}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $config = [
            'upload_path' => $this->pathBerkas,
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $this->load->library('upload', $config, 'berkas');
        $this->load->library('upload', $confJustifikasi, 'justifikasi');
        $this->load->library('upload', $confCatatan, 'catatan');
        $id_inspeksi = $this->input->post('id_inspeksi', TRUE);
        if ($id_inspeksi != '') {
            if (!$this->catatan->do_upload('catatan')) {
                if (!$this->justifikasi->do_upload('justifikasi')) {
                    $data = [
                        'id' => $idKonsultasi,
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $this->input->post('kesesuaian'),
                    ];
                    $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    $data = [
                        'id' => $idKonsultasi,
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $this->input->post('kesesuaian'),
                        'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                    ];
                    $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
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
                    $data = [
                        'id' => $idKonsultasi,
                        'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                        'kesesuaian' => $this->input->post('kesesuaian'),
                        'catatan' => $this->catatan->data('file_name'),
                    ];
                    $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Hasil Data Pemeriksaan Inspeksi'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                    if (!$this->berkas->do_upload('berkas')) {
                        if (!$this->justifikasi->do_upload('justifikasi')) {
                            $data = [
                                'id' => $idKonsultasi,
                                'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                'kesesuaian' => $this->input->post('kesesuaian'),
                                'catatan' => $this->catatan->data('file_name'),
                            ];
                            $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                            $output = [
                                'status' => true,
                                'type' => 'success',
                                'message' => 'Hasil Data Pemeriksaan Inspeksi'
                            ];
                            header('Content-Type: application/json');
                            echo json_encode($output);
                        } else {
                            $data = [
                                'id' => $idKonsultasi,
                                'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                'kesesuaian' => $this->input->post('kesesuaian'),
                                'catatan' => $this->catatan->data('file_name'),
                                'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                            ];
                            $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                            $output = [
                                'status' => true,
                                'type' => 'success',
                                'message' => 'Hasil Data Pemeriksaan Inspeksi'
                            ];
                            header('Content-Type: application/json');
                            echo json_encode($output);
                        }
                    } else {
                        if ($this->berkas->data('file_ext') != ".pdf") {
                            $path = FCPATH . "/{$this->pathBerkas}";
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
                            $data = [
                                'id' => $idKonsultasi,
                                'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                'kesesuaian' => $this->input->post('kesesuaian'),
                                'catatan' => $this->catatan->data('file_name'),
                                'berkas_file' => $this->berkas->data('file_name'),
                            ];
                            $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                            $output = [
                                'status' => true,
                                'type' => 'success',
                                'message' => 'Hasil Data Pemeriksaan Inspeksi'
                            ];
                            header('Content-Type: application/json');
                            echo json_encode($output);
                        }
                    }
                }
            }
        } else {
            if (!$this->catatan->do_upload('catatan')) {
                $output = [
                    'status' => false,
                    'type' => 'error',
                    'message' => 'Silahkan Upload File Catatan Terlebih Dahulu!',
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
                        'message' => 'Silahkan Upload File Catatan Menggunakan Format PDF!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    if (!$this->berkas->do_upload('berkas')) {
                        $output = [
                            'status' => false,
                            'type' => 'error',
                            'message' => 'Silahkan Upload Berkas Terlebih Dahulu!'
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    } else {
                        if ($this->berkas->data('file_ext') != ".pdf") {
                            $path = FCPATH . "/{$this->pathBerkas}";
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
                                    'id' => $idKonsultasi,
                                    'id_struktur' => $this->input->post('id'),
                                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                    'kesesuaian' => $this->input->post('kesesuaian'),
                                    'catatan' => $this->catatan->data('file_name'),
                                    'berkas_file' => $this->berkas->data('file_name')
                                ];
                                $this->Minspeksi->insertInspeksi($data);
                                $output = [
                                    'status' => true,
                                    'type' => 'success',
                                    'message' => 'Hasil Data Pemeriksaan Inspeksi'
                                ];
                                header('Content-Type: application/json');
                                echo json_encode($output);
                            } else {
                                $data = [
                                    'id' => $idKonsultasi,
                                    'id_struktur' => $this->input->post('id'),
                                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                    'kesesuaian' => $this->input->post('kesesuaian'),
                                    'catatan' => $this->catatan->data('file_name'),
                                    'berkas_file' => $this->berkas->data('file_name'),
                                    'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                                ];
                                $this->Minspeksi->insertInspeksi($data);
                                $output = [
                                    'status' => true,
                                    'type' => 'success',
                                    'message' => 'Hasil Data Pemeriksaan Inspeksi'
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

  

    public function simpan_inspeksi2()
    {
        $confJustifikasi = [
            'upload_path' => "./{$this->pathJustifikasi}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $confCatatan = [
            'upload_path' => "./{$this->pathCatatan}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $config = [
            'upload_path' => "./{$this->pathBerkas}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $config, 'berkas');
        $this->load->library('upload', $confJustifikasi, 'justifikasi');
        $this->load->library('upload', $confCatatan, 'catatan');
        $cekId = $this->input->post('id_bangunan');
        $id_inspeksi = $this->input->post('id_inspeksi', TRUE);
        if ($id_inspeksi != '') {
            if (!$this->catatan->do_upload('catatan')) {
                $data = [
                    'id' => $cekId,
                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                    'kesesuaian' => $this->input->post('kesesuaian'),
                ];
                $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
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
                            'id' => $cekId,
                            'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                            'kesesuaian' => $this->input->post('kesesuaian'),
                            'catatan' => $this->catatan->data('file_name'),
                        ];
                        $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                        $output = [
                            'status' => true,
                            'type' => 'success',
                            'message' => 'Hasil Data Penilaian'
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    } else {
                        if ($this->berkas->data('file_ext') != ".pdf") {
                            $path = FCPATH . "/{$this->pathBerkas}";
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
                                    'id' => $cekId,
                                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                    'kesesuaian' => $this->input->post('kesesuaian'),
                                    'catatan' => $this->catatan->data('file_name'),
                                    'berkas_file' => $this->berkas->data('file_name')
                                ];
                                $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
                                $output = [
                                    'status' => true,
                                    'type' => 'success',
                                    'message' => 'Hasil Data Penilaian'
                                ];
                                header('Content-Type: application/json');
                                echo json_encode($output);
                            } else {
                                $data = [
                                    'id' => $cekId,
                                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                    'kesesuaian' => $this->input->post('kesesuaian'),
                                    'catatan' => $this->catatan->data('file_name'),
                                    'berkas_file' => $this->berkas->data('file_name'),
                                    'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                                ];
                                $this->Minspeksi->updateInspeksi($id_inspeksi, $data);
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
                    'message' => $this->catatan->display_errors(),
                    // 'message' => 'Silahkan Upload Berkas Terlebih Dahulu!'
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
                            $path = FCPATH . "/{$this->pathBerkas}";
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
                                    'id' => $cekId,
                                    'id_struktur' => $this->input->post('id'),
                                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                    'kesesuaian' => $this->input->post('kesesuaian'),
                                    'catatan' => $this->catatan->data('file_name'),
                                    'berkas_file' => $this->berkas->data('file_name')
                                ];
                                $this->Minspeksi->insertInspeksi($data);
                                $output = [
                                    'status' => true,
                                    'type' => 'success',
                                    'message' => 'Hasil Data Penilaian'
                                ];
                                header('Content-Type: application/json');
                                echo json_encode($output);
                            } else {
                                $data = [
                                    'id' => $cekId,
                                    'id_struktur' => $this->input->post('id'),
                                    'nama_pemeriksaan' => $this->input->post('pemeriksaan'),
                                    'kesesuaian' => $this->input->post('kesesuaian'),
                                    'catatan' => $this->catatan->data('file_name'),
                                    'berkas_file' => $this->berkas->data('file_name'),
                                    'berkas_justifikasi' => $this->justifikasi->data('file_name'),
                                ];
                                $this->Minspeksi->insertInspeksi($data);
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
        $okupansi   = $this->input->post('okupansi', TRUE);
        
        $cekInspeksi = $this->Minspeksi->cekInspeksiBangunan($id);
        $cek = $this->Minspeksi->cekDataInspeksiBangunan($id);

        $ttd = $this->Minspeksi->getPejabatTtd($id);
        $nm_kadis = $ttd['kepala_dinas'];
		$nip_kadis = $ttd['nip_kepala_dinas'];
        $nm_dinas = $ttd['p_nama_dinas'];
        $sk_slf = $this->SK_SLF($id);
        $tgl_slf = date("Y-m-d");

        $thisdir = getcwd();
        $dirPath = $thisdir . "/object-storage/dekill/Inspection/berita_acara/";
        
        $confBerkas1 = [
            'upload_path' => "{$dirPath}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $confBerkas2 = [
            'upload_path' => "{$dirPath}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $confBerkas3 = [
            'upload_path' => "{$dirPath}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $this->load->library('upload', $confBerkas1, 'berkas1');
        $this->load->library('upload', $confBerkas2, 'berkas2');
        $this->load->library('upload', $confBerkas3, 'berkas3');
        if ($cekInspeksi->num_rows() > 0) {
        $row = $cekInspeksi->row();  
            if (!$this->berkas1->do_upload('berkas1')) {
                $output = [
                    'res' => false,
                    'type' => 'error',
                    'message' => $this->berkas1->display_errors()
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            } else {
                if (!$this->berkas2->do_upload('berkas2')) {
                    $output = [
                        'res' => false,
                        'type' => 'error',
                        'message' => $this->berkas2->display_errors()
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    if (!$this->berkas3->do_upload('berkas3')) {
                        $output = [
                            'res' => false,
                            'type' => 'error',
                            'message' => $this->berkas3->display_errors()
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    } else {
                        $datainspeksi = [
                            'id' => $id,
                            'no_berita_inspeksi' => $nomor_berita,
                            'tgl_berita_inspeksi' => $tgl_berita,
                            'berkas1' => $this->berkas1->data('file_name'),
                            'berkas2' => $this->berkas2->data('file_name'),
                            'berkas3' => $this->berkas3->data('file_name')
                        ];
                        $dataup = [
                            'status' => '19',
                        ];
						$datask =[
							'id' => $id,
                            'okupansi' => $okupansi,
							'no_slf' => $sk_slf,
                            'tgl_penerbitan_slf' => $tgl_slf,
							'nm_kadis_teknis' => $nm_kadis,
							'nip_kadis_teknis' => $nip_kadis,
							'nm_dinas' => $nm_dinas,
						];
                        $this->Minspeksi->insertSK($datask);
                        $this->Minspeksi->updateStatus($id, $dataup);
						$this->Minspeksi->updateDataInspeksi($id, $datainspeksi);
                        $output = [
                            'res' => true,
                            'message' => 'Data Inspeksi Berhasil Diperbaharui!'
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);

						$this->load->library('ciqrcode'); //pemanggilan library QR CODE
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
						$data['QR'] = $this->ciqrcode->generate($params);
                    }
                }
            }
        } else {
            if (!$this->berkas1->do_upload('berkas1')) {
                $output = [
                    'res' => false,
                    'type' => 'error',
                    'message' => $this->berkas1->display_errors()
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            } else {
                if (!$this->berkas2->do_upload('berkas2')) {
                    $output = [
                        'res' => false,
                        'type' => 'error',
                        'message' => $this->berkas2->display_errors()
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    if (!$this->berkas3->do_upload('berkas3')) {
                        $output = [
                            'res' => false,
                            'type' => 'error',
                            'message' => $this->berkas3->display_errors()
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    } else {
                        $datainspeksi = [
                            'id' => $id,
                            'no_berita_inspeksi' => $nomor_berita,
                            'tgl_berita_inspeksi' => $tgl_berita,
                            'berkas1' => $this->berkas1->data('file_name'),
                            'berkas2' => $this->berkas2->data('file_name'),
                            'berkas3' => $this->berkas3->data('file_name')
                        ];
						$dataup = [
                            'status' => '19',
                        ];
						
						$datask =[
							'id' => $id,
							'no_slf' => $sk_slf,
                            'tgl_penerbitan_slf' => $tgl_slf,
							'nm_kadis_teknis' => $nm_kadis,
							'nip_kadis_teknis' => $nip_kadis,
							'nm_dinas' => $nm_dinas,
						];
						$this->load->library('ciqrcode'); //pemanggilan library QR CODE
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
						$data['QR'] = $this->ciqrcode->generate($params);
						$this->Minspeksi->insertSK($datask);
						$this->Minspeksi->updateStatus($id, $dataup);
                        $this->Minspeksi->insertDataInspeksi($datainspeksi);
                        $output = [
                            'res' => true,
                            'message' => 'Data Inspeksi Berhasil Disimpan!'
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    }
                }
            }
        }
    }

    function SK_SLF($id=null)
	{
	    $que = $this->Minspeksi->get_id_kabkot($id);
		$lokasi = $que['id_kec_bgn'];
        $tgl_disetujui = date('d').date('m').date('Y');
		$mydata2 = $this->Minspeksi->getNoDrafSlf($lokasi,$tgl_disetujui);
	    if(count($mydata2)>0){
	        $no_baru = SUBSTR($mydata2['no_slf_baru'],-3)+1;
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

    public function hapus_inspeksi($id)
    {
        $this->Minspeksi->hapusInspeksi($id);
        $this->session->set_flashdata('message', 'Data Inspeksi Berhasil di Hapus.');
        $this->session->set_flashdata('status', 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function cek_step()
    {
        $id = $this->input->post('id', TRUE);
        $cek_step = $this->Minspeksi->cekStepInspeksi($id)->row();
        $cek = $cek_step->step_inspeksi;
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
            'step_inspeksi' => $step,
        ];
        $dataVal = $this->input->post('dataVal', TRUE);
        $this->Minspeksi->saveStep($dataVal, $data);
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
        $cekKonsultasi = $this->Mpemeriksaan->getIdKonsultasi($konsultasi)->row();
        $id = $cekKonsultasi->id;
        $config = [
            'upload_path' => "./{$this->pathPerbaikan}",
            'allowed_types' => 'pdf|PDF',
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
                $this->Mpemeriksaan->insertPerbaikan($data);
                $this->Mpemeriksaan->updateStatsPbg($id, $update);
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

    public function ValidasiForm()
    {
        $id = $this->input->post('id');
		$data['id'] = $id;
		if (trim($id) != '') {
			/*$tgl_log = date('Y-m-d');
			$keterangan = 'IMB Terverivikasi Kadis';
			$nama_fb = 'Hasil Sidang';
			$kode_feedback = '50';
			$data_log = array (
				'id' => $id,
				'tgl_log_permohonan' => $tgl_log,
				'keterangan' => $keterangan,
				'kode_proses' => 17,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);*/
			//$this->kirim_email_validasi($id);		
			$dataStatus = array(
				'status' => 20,
			);
			$this->Minspeksi->updateProgress($dataStatus,$id);
		}
		$this->session->set_flashdata('message','Dokumen SLF telah Divalidasi');
		$this->session->set_flashdata('status','success');
		redirect('Inspeksi/Validasi');
    }

    public function CetakDokumen($id = NULL)
    {
        $id = $this->uri->segment(3);
        $DataVal = $this->Minspeksi->getdataizin($id)->row_array();
        $id_izin = $DataVal['id_izin'];
		$data['pg'] = $this->Minspeksi->getdatapemilikDok($id);
		$data['bg'] = $this->Minspeksi->getdatabangunanDok($id);
        $datajns    = $this->Minspeksi->getDataVerifikasi($id);
        $fg_bg      = $datajns['id_fungsi_bg'];
        $jns_bg     = $datajns['id_jns_bg'];
        if($id_izin == '4' || $id_izin == '3'){
            //$data['fungsi'] = $this->Mpemeriksaan->getDataFungsi($fg_bg, $jns_bg);
        }else{
            $data['fungsi'] = $this->Minspeksi->getDataFungsi($fg_bg, $jns_bg);
        } 
        $this->load->view('Validasi/Dokumen', $data);
    }

    // fungsi baru simpan berkas inspkesi
    
    public function simpan_data_inspeksi()
    {
        $id = $this->input->post('id');
        $nomor_berita = $this->input->post('nomor_berita', TRUE);
        $tgl_berita = $this->input->post('tgl_berita', TRUE);
        $cekInspeksi = $this->Minspeksi->cekInspeksiBangunan($id);
        $thisdir = getcwd();
        $dirPath = $thisdir . "/file/konsultasi/$id/Inspeksi/Berkas/";
        if (!file_exists($dirPath)) {
            //mkdir($dirPath, 0755, true);
  //create directory if not exist
        }

        $confBerkas1 = [
            'upload_path' => "{$dirPath}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $confBerkas2 = [
            'upload_path' => "{$dirPath}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];

        $confBerkas3 = [
            'upload_path' => "{$dirPath}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];


        $this->load->library('upload', $confBerkas1, 'berkas1');
        $this->load->library('upload', $confBerkas2, 'berkas2');
        $this->load->library('upload', $confBerkas3, 'berkas3');
        if ($cekInspeksi->num_rows() > 0) {
            if (!$this->berkas1->do_upload('berkas1')) {
                $output = [
                    'res' => false,
                    'type' => 'error',
                    'message' => $this->berkas1->display_errors()
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            } else {
                if (!$this->berkas2->do_upload('berkas2')) {
                    $output = [
                        'res' => false,
                        'type' => 'error',
                        'message' => $this->berkas2->display_errors()
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    if (!$this->berkas3->do_upload('berkas3')) {
                        $output = [
                            'res' => false,
                            'type' => 'error',
                            'message' => $this->berkas3->display_errors()
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    } else {
                        $data = [
                            'no_berita_inspeksi' => $nomor_berita,
                            'tgl_berita_inspeksi' => $tgl_berita,
                            'berkas1' => $this->berkas1->data('file_name'),
                            'berkas2' => $this->berkas2->data('file_name'),
                            'berkas3' => $this->berkas3->data('file_name')
                        ];
                        $this->Minspeksi->updateDataInspeksi($id, $data);
                        $output = [
                            'res' => true,
                            'message' => 'Data Inspeksi Berhasil Diperbaharui!'
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    }
                }
            }
        } else {
            if (!$this->berkas1->do_upload('berkas1')) {
                $output = [
                    'res' => false,
                    'type' => 'error',
                    'message' => $this->berkas1->display_errors()
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            } else {
                if (!$this->berkas2->do_upload('berkas2')) {
                    $output = [
                        'res' => false,
                        'type' => 'error',
                        'message' => $this->berkas2->display_errors()
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                } else {
                    if (!$this->berkas3->do_upload('berkas3')) {
                        $output = [
                            'res' => false,
                            'type' => 'error',
                            'message' => $this->berkas3->display_errors()
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    } else {
                        $data = [
                            'no_berita_inspeksi' => $nomor_berita,
                            'tgl_berita_inspeksi' => $tgl_berita,
                            'berkas1' => $this->berkas1->data('file_name'),
                            'berkas2' => $this->berkas2->data('file_name'),
                            'berkas3' => $this->berkas3->data('file_name')
                        ];
                        $this->Minspeksi->insertDataInspeksi($data);
                        $output = [
                            'res' => true,
                            'message' => 'Data Inspeksi Berhasil Disimpan!'
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    }
                }
            }
        }
    }
}

/* End of file Inspeksi.php */
