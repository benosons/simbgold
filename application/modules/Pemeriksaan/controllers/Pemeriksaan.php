<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pemeriksaan extends CI_Controller
{
    protected $pathBerkas = 'object-storage/dekill/Requirement/';
    protected $pathPerbaikan = 'object-storage/dekill/Consultation/';
    protected $pathBerita = 'object-storage/dekill/Consultation/';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utility');
        ini_set('memory_limit', "4096M");
        $this->load->model(array('Mpemeriksaan', 'mglobal'));
        $this->load->library('Simbg_lib');
		$this->load->library('Oss_lib');
        $this->load->model('Mglobal');
        $this->load->model('Mglobals');
        $this->simbg_lib->check_session_login();
    }
    //Begin Pemeriksaan Konsultasi
    public function Penilaian()
    {
        $data['konsultasi']     = $this->Mpemeriksaan->getListKonsultasi();
        $data['title']          =  '';
        $data['heading']        =  '';
        $this->template->load('template/template_backend', 'HasilKonsultasi/ListPemeriksaan', $data);
    }
    public function FormPemeriksaan($id = NULL)
    {
        $getId = $this->Mpemeriksaan->getDataKonsultasi($this->secure->decrypt_url($id));
        if ($getId->num_rows() > 0) {
            $row = $getId->row();
            $email = $row->email;
            $imb = $row->imb;
            $id_izin = $row->id_izin;
            $no_konsultasi = $row->no_konsultasi;
            $id_jenis_permohonan = $row->id_jenis_permohonan;
            $group = $this->groupingData(intval($row->id_jenis_permohonan));
            $data = [
                'id' => $id,
                'group' => $group,
                'email' => $email,
                'imb' => $imb,
                'id_izin' => $id_izin,
                'no_konsultasi' => $no_konsultasi,
                'id_jenis_permohonan' => $id_jenis_permohonan,
            ];
            $this->template->load('template/template_backend', 'Pemeriksaan/HasilKonsultasi/FormPemeriksaan', $data);
        } else {
            redirect('Pemeriksaan/Penilaian');
        }
    }

    public function getRowPemeriksaan()
    {
        $id = $this->input->get('id', TRUE);
        $getId = $this->Mpemeriksaan->getDataKonsultasi($this->secure->decrypt_url($id));
        if ($getId->num_rows() > 0) {
            $row = $getId->row();
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
                foreach ($lantai as $noo => $val) {
                    $bangunan_kolektif['lantai'][$noo] = $val != '' ? $val : '';
                }
                foreach ($jumlah as $noo => $val) {
                    $bangunan_kolektif['jumlah'][$noo] = $val != '' ? $val : '';
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

            $fungsi_bangunan = $id_jenis_permohonan == 12 ? 'Fungsi Prasarana' : $row->fungsi_bg;
            $responses = [
                'id' => $id,
                'no_konsultasi' => $row->no_konsultasi,
                'nm_pemilik' => $row->nm_pemilik,
                'alamat' => $row->alamat,
                'nama_kecamatan' => $row->nama_kecamatan,
                'nama_kabkota' => $row->nama_kabkota,
                'nm_konsultasi' => $row->nm_konsultasi,
                'nama_kec_bg' => $row->nama_kec_bg,
                'nama_kabkota_bg' => $row->nama_kabkota_bg,
                'nama_provinsi_bg' => $row->nama_provinsi_bg,
                'nama_prov_pemilik' => $row->nama_prov_pemilik,
                'fungsi_bg' => $fungsi_bangunan,
                'almt_bgn' => $row->almt_bgn,
                'tinggi_bgn' => $row->tinggi_bgn,
                'luas_bgn' => $row->luas_bgn,
                'jml_lantai' => $row->jml_lantai,
                'luas_bgp' => $row->luas_bgp,
                'tinggi_bgp' => $row->tinggi_bgp,
                'id_izin' => $row->id_izin,
                'status_imb' => $row->imb,
                'email' => $row->email,
                'tipeA' => $row->tipeA,
                'luasA' => $row->luasA,
                'lantaiA' => $row->lantaiA,
                'tinggiA' => $row->tinggiA,
                'jumlahA' => $row->jumlahA,
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
                'title' => 'Penilaian Sidang',
                'heading'  => '',
                'pathBerkas' => $this->pathBerkas,
                'jns_pemilik' => $row->jns_pemilik,
                'id_kelurahan' => $row->id_kelurahan,
                'id_kel_bgn' => $row->id_kel_bgn,
                'imb' => $row->imb,
                'id_jns_bg' => $row->id_jns_bg,
                'hasil_kolektif' => $hasil_kolektif,
                'luas_total_kolektif' => $luas_total_kolektif,
            ];
        } else {
            $responses = [
                'status' => false,
                'message' => 'Data Tidak Ditemukan!'
            ];
        }
        echo json_encode($responses);
    }

    private function loadPersyaratan($group, $step, $jenis_permohonan, $id)
    {
        $groupStep = [0, 1, 2, 3, 4];
        $group == NULL ? 1 : $group;
        if (in_array($step, $groupStep)) {
            if ($group == 0) {
                if ($step == 0) {
                    $tipePersyaratan = 2;
                }
                if ($step != 1 && $step != 2) {
                    $tipePersyaratan = 2;
                    $getPersyaratan = $this->Mpemeriksaan->getSyaratList($jenis_permohonan, $tipePersyaratan, null)->result();
                    $result = [];
                    $type = 1;
                    foreach ($getPersyaratan as $g) {
                        $p = $this->Mpemeriksaan->getDataPemeriksaanKesesuaian($g->id_detail, $id)->row();
                        $kesesuaian = $p == NULL ? 0 : $p->kesesuaian;
                        $catatan = $p == NULL ? '' : $p->catatan;
                        $berkas = $p == NULL ? null : $p->dir_file;
                        $oldFIle = FCPATH . 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $berkas;
                        $dir = '';
                        if ($jenis_permohonan == 3) {
                            $getPrototipe = $this->Mpemeriksaan->getDataPrototipe($id)->row();
                            $dir = 'object-storage/file/TypeProtype/' . $getPrototipe->dir_file;
                            $resultDirFile = $dir;
                        } else if ($jenis_permohonan == 21) {
                            $dir = 'object-storage/file/TypeProtype/LampKepmen05-2022.pdf';
                            $resultDirFile = $dir;
                        } else {
                            if (file_exists($oldFIle)) {
                                $dir = 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $berkas;
                            } else {
                                $dir = 'object-storage/dekill/Requirement/' . $berkas;
                            }
                            $resultDirFile = $berkas == NULL ? false : $dir;
                        }
                        $result[] = [
                            'nm_dokumen' => $g->nm_dokumen,
                            'kesesuaian' => $kesesuaian,
                            'catatan' => $catatan == NULL ? '' : $catatan,
                            'dir_file' => $resultDirFile,
                            'id_detail' => $g->id_detail,
                            'id_detail_jenis_persyaratan' => $g->id_detail_jenis_persyaratan
                        ];
                    }
                } else {
                    $tipePersyaratan = NULL;
                    $type = 2;
                    if ($step == 1) {
                        $rowBangunan = $this->Mpemeriksaan->getDataKonsultasi($id)->row();
                        $LuasBg = 0;
                        $id_jenis_permohonan = $rowBangunan->id_jenis_permohonan;
                        if ($id_jenis_permohonan == 11 || $id_jenis_permohonan == 29 || $id_jenis_permohonan == 30 || $id_jenis_permohonan == 31 || $id_jenis_permohonan == 32 || $id_jenis_permohonan == 33) {
                            $tipeA = $rowBangunan->tipeA;
                            $luasA = $rowBangunan->luasA;
                            $tinggiA = $rowBangunan->tinggiA;
                            $lantaiA = $rowBangunan->lantaiA;
                            $jumlahA = $rowBangunan->jumlahA;
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

                            foreach ($lantai as $noo => $val) {
                                $bangunan_kolektif['lantai'][$noo] = $val != '' ? $val : '';
                            }
                            foreach ($jumlah as $noo => $val) {
                                $bangunan_kolektif['jumlah'][$noo] = $val != '' ? $val : '';
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

                        $result = [
                            'hasil_kolektif' => $hasil_kolektif,
                            'luas_total_kolektif' => $luas_total_kolektif,
                            'data_bangunan' => $rowBangunan,
                            'jenis_permohonan' => $this->mglobals->getData('*', 'tm_jenis_permohonan')->result(),
                            'daftar_provinsi' => $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi')->result(),
                            'fungsi_bangunan' => $this->mglobals->getData('*', 'tr_fungsi_bg')->result(),
                        ];
                    } else {
                        $type = 3;
                        $result = [
                            'tahap 4' => 'tahap 4'
                        ];
                    }
                }
            } else {
                if ($step == 0) {
                    $tipePersyaratan = 2;
                } else if ($step == 1) {
                    $tipePersyaratan = 3;
                } else {
                    $tipePersyaratan = 4;
                }
                if ($step != 3 && $step != 4) {
                    $type = 1;
                    $getPersyaratan = $this->Mpemeriksaan->getSyaratList($jenis_permohonan, $tipePersyaratan, null)->result();
                    $result = [];
                    foreach ($getPersyaratan as $g) {
                        $p = $this->Mpemeriksaan->getDataPemeriksaanKesesuaian($g->id_detail, $id)->row();
                        $kesesuaian = $p == NULL ? 0 : $p->kesesuaian;
                        $catatan = $p == NULL ? '' : $p->catatan;
                        $berkas = $p == NULL ? null : $p->dir_file;
                        $oldFIle = FCPATH . 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $berkas;
                        $dir = '';
                        if (file_exists($oldFIle)) {
                            $dir = 'object-storage/file/Konsultasi/' . $id . '/Dokumen/' . $berkas;
                        } else {
                            $dir = 'object-storage/dekill/Requirement/' . $berkas;
                        }
                        $encryptedDir		= $this->Outh_model->Encryptor('encrypt', $dir);
                        $reader 	= 'Docreader/ReaderDok/'.$encryptedDir;

                        $result[] = [
                            'nm_dokumen' => $g->nm_dokumen,
                            'kesesuaian' => $kesesuaian,
                            'catatan' => $catatan == NULL ? '' : $catatan,
                            'dir_file' => $berkas == NULL ? false : $reader,
                            'id_detail' => $g->id_detail,
                            'id_detail_jenis_persyaratan' => $g->id_detail_jenis_persyaratan
                        ];
                    }
                } else {
                    $type = 2;
                    if ($step == 3) {

                        $rowBangunan = $this->Mpemeriksaan->getDataKonsultasi($id)->row();
                        $LuasBg = 0;
                        $id_jenis_permohonan = $rowBangunan->id_jenis_permohonan;
                        if ($id_jenis_permohonan == 11 || $id_jenis_permohonan == 29 || $id_jenis_permohonan == 30 || $id_jenis_permohonan == 31 || $id_jenis_permohonan == 32 || $id_jenis_permohonan == 33) {
                            $tipeA = $rowBangunan->tipeA;
                            $luasA = $rowBangunan->luasA;
                            $tinggiA = $rowBangunan->tinggiA;
                            $lantaiA = $rowBangunan->lantaiA;
                            $jumlahA = $rowBangunan->jumlahA;
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
                            foreach ($lantai as $noo => $val) {
                                $bangunan_kolektif['lantai'][$noo] = $val != '' ? $val : '';
                            }
                            foreach ($jumlah as $noo => $val) {
                                $bangunan_kolektif['jumlah'][$noo] = $val != '' ? $val : '';
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
                        $result = [
                            'hasil_kolektif' => $hasil_kolektif,
                            'luas_total_kolektif' => $luas_total_kolektif,
                            'data_bangunan' => $rowBangunan,
                            'jenis_permohonan' => $this->mglobals->getData('*', 'tm_jenis_permohonan')->result(),
                            'daftar_provinsi' => $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi')->result(),
                            'fungsi_bangunan' => $this->mglobals->getData('*', 'tr_fungsi_bg')->result(),
                        ];
                    } else {
                        $type = 3;
                        $result = [
                            'tahap 4' => 'tahap 4'
                        ];
                    }
                }
            }
        } else {
            $tipePersyaratan = NULL;
            $type = NULL;
            $result = [
                'status' => false,
                'msg' => 'persyaratan tidak ditemukan!'
            ];
        }
        $data = [
            'id_detail_persyaratan' => $tipePersyaratan,
            'result' => $result,
            'type' => $type,
        ];
        return $data;
    }

    public function getDataPersyaratan()
    {
        $id = $this->secure->decrypt_url($this->input->get('id'), TRUE);
        $step = $this->input->get('step', TRUE);
        $getId = $this->Mpemeriksaan->getDataKonsultasi($id);
        if ($getId->num_rows() > 0) {
            $row = $getId->row();
            $group = $this->groupingData(intval($row->id_jenis_permohonan));
            $persyaratan = $this->loadPersyaratan($group, $step, $row->id_jenis_permohonan, $id);
            if ($group === 0) {
                $responses = [
                    'type' => $persyaratan['type'],
                    'id_detail_persyaratan' => $persyaratan['id_detail_persyaratan'],
                    'persyaratan' => $persyaratan['result'],
                ];
            } else {
                $responses = [
                    'type' => $persyaratan['type'],
                    'id_detail_persyaratan' => $persyaratan['id_detail_persyaratan'],
                    'persyaratan' => $persyaratan['result'],
                ];
            }
        } else {
            $responses = [];
        }
        echo json_encode($responses);
    }


    public function groupingData($id = NULL)
    {
        $check = [
            [
                'name' => 0,
                'value' => 3
            ],
            [
                'name' => 0,
                'value' => 4
            ],
            [
                'name' => 0,
                'value' => 5
            ],
            [
                'name' => 0,
                'value' => 12
            ],
            [
                'name' => 0,
                'value' => 21
            ],
            [
                'name' => 0,
                'value' => 34
            ],
            [
                'name' => 0,
                'value' => 35
            ],
            [
                'name' => 0,
                'value' => 36
            ],
            // pengecekan dua kali
            [
                'name' => 1,
                'value' => 11
            ],
            [
                'name' => 1,
                'value' => 1
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
                'value' => 18
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
            [
                'name' => 1,
                'value' => 23
            ],
            [
                'name' => 1,
                'value' => 24
            ],
            [
                'name' => 1,
                'value' => 25
            ],
            [
                'name' => 1,
                'value' => 26
            ],
            [
                'name' => 1,
                'value' => 27
            ],
            [
                'name' => 1,
                'value' => 27
            ],
            [
                'name' => 1,
                'value' => 29
            ],
            [
                'name' => 1,
                'value' => 30
            ],
            [
                'name' => 1,
                'value' => 31
            ],
            [
                'name' => 1,
                'value' => 32
            ],
            [
                'name' => 1,
                'value' => 33
            ],
            // pengecekan tiga kali
            [
                'name' => 2,
                'value' => 8
            ],
            [
                'name' => 2,
                'value' => 9
            ],
            [
                'name' => 2,
                'value' => 13
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

    public function cekKesesuaian()
    {
        $dataKonsultasi = $this->secure->decrypt_url($this->input->post('dataKonsultasi', TRUE));
        $dataId = $this->input->post('dataId', TRUE);
        $dataVal = $this->input->post('dataVal', TRUE);
        $cek = filter_var($this->input->post('mode', TRUE), FILTER_VALIDATE_BOOLEAN);
        $cekData =  $this->Mpemeriksaan->getDataKesuaian($dataKonsultasi, $dataId, $dataVal);
        if ($cekData->num_rows() > 0) {
            $update = [
                'kesesuaian' => $cek === true ? 1 : 0
            ];
            $this->Mpemeriksaan->updateDataKesesuaian($dataKonsultasi, $dataVal, $dataId, $update);
        } else {
            $insert = [
                'id' => $dataKonsultasi,
                'id_persyaratan' => $dataVal,
                'id_persyaratan_detail' => $dataId,
                'kesesuaian' => $cek === true ? 1 : 0,
            ];
            $this->Mpemeriksaan->insertDataKesesuaian($insert);
        }
        $output = [
            'status' => $cek,
            'message' => 'Data Kesesuaian Berhasil Diubah!'
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function simpanCatatan()
    {
        $dataKonsultasi = $this->secure->decrypt_url($this->input->post('dataKonsultasi', TRUE));
        $syarat = $this->input->post('syarat', TRUE);
        $dataId = $this->input->post('dataId', TRUE);
        $dataVal = $this->input->post('dataVal', TRUE);
        $cekData =  $this->Mpemeriksaan->getDataKesuaian($dataKonsultasi, $dataId, $dataVal);
        if ($cekData->num_rows() > 0) {
            $update = [
                'catatan' => $syarat
            ];
            $this->Mpemeriksaan->updateDataCatatan($dataKonsultasi, $dataVal, $dataId, $update);
        } else {
            $insert = [
                'id' => $dataKonsultasi,
                'id_persyaratan' => $dataVal,
                'id_persyaratan_detail' => $dataId,
                'catatan' => $syarat,
            ];
            $this->Mpemeriksaan->insertDataCatatan($insert);
        }
        $output = [
            'status' => true,
            'message' => 'Catatan Berhasil Disimpan!'
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function simpanBerkas()
    {
        $dataKonsultasi = $this->secure->decrypt_url($this->input->post('dataKonsultasi', TRUE));
        $dataId = $this->input->post('dataId', TRUE);
        $dataVal = $this->input->post('dataVal', TRUE);
        $config = [
            'upload_path' =>  "./{$this->pathBerkas}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '150000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $config);
        $cekData =  $this->Mpemeriksaan->getDataBerkas($dataKonsultasi, $dataVal, $dataId);
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
                if ($this->upload->data('file_ext') == ".pdf" || $this->upload->data('file_ext') == ".PDF") {
                    $data = [
                        'dir_file' => $this->upload->data('file_name')
                    ];
                    $cekFile = $this->Mpemeriksaan->cekBerkas($dataKonsultasi, $dataVal, $dataId)->row()->dir_file;
                    $dokumenNew     = "object-storage/dekill/Requirement/" . $this->upload->data('file_name');
                    $encryptedDir	= $this->Outh_model->Encryptor('encrypt', $dokumenNew);
                    $readerNew 	    = 'Docreader/ReaderDok/'.$encryptedDir;
                    if ($cekFile == NULL) {
                        $this->Mpemeriksaan->updateBerkas($dataKonsultasi, $dataVal, $dataId, $data);
                        $output = [
                            'status' => true,
                            'type' => 'success',
                            'message' => 'Data Berkas Berhasil Diupload!',
                            'result' => $readerNew,
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    } else {
                        $path = $this->pathBerkas;
                        $fileLama = $path . $cekFile;
                        $this->Mpemeriksaan->updateBerkas($dataKonsultasi, $dataVal, $dataId, $data);
                        $dokumenNew     = "object-storage/dekill/Requirement/" . $this->upload->data('file_name');
                        $encryptedDir	= $this->Outh_model->Encryptor('encrypt', $dokumenNew);
                        $readerNew 	    = 'Docreader/ReaderDok/'.$encryptedDir;
                        $output = [
                            'status' => true,
                            'type' => 'success',
                            'message' => 'Data Berkas Berhasil Diupload!',
                            'result' => $readerNew,
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    }
                } else {
                    $path = $this->pathBerkas;
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
                    $path = $this->pathBerkas;
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
                    $this->Mpemeriksaan->insertBerkas($data);
                    $dokumenNew     = "object-storage/dekill/Requirement/" . $this->upload->data('file_name');
                    $encryptedDir	= $this->Outh_model->Encryptor('encrypt', $dokumenNew);
                    $readerNew 	    = 'Docreader/ReaderDok/'.$encryptedDir;
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Data Berkas Berhasil Diupload!',
                        'result' => $readerNew,
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($output);
                }
            }
        }
    }
    // new function simpan_penialaian
    public function simpanPenilaian()
    {
        $jenis = $this->input->post('jenis', TRUE);
        $syarat = $this->input->post('syarat', TRUE);
        $dataKonsultasi = $this->secure->decrypt_url($this->input->post('dataKonsultasi', TRUE));
        $pemeriksaan = $this->Mpemeriksaan->getSyaratListId($jenis, $syarat);
        $cek = [];
        $not = 0;
        $done = 0;
        foreach ($pemeriksaan->result() as $r) {
            $p = $this->Mpemeriksaan->getDataPemeriksaanKesesuaian($r->id_detail,$dataKonsultasi)->row();
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

    public function cekStep()
    {
        $id = $this->input->post('id', TRUE);
        $cek_step = $this->Mpemeriksaan->cekStep($this->secure->decrypt_url($id))->row();
        $cek = $cek_step->data_step;
        $res = $cek == NULL ? 0 : intval($cek);
        $output = [
            'result' => $res
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function saveStep()
    {
        $step = $this->input->post('step', TRUE);
        $data = [
            'data_step' => $step,
        ];
        $dataVal =  $this->secure->decrypt_url($this->input->post('dataVal', TRUE));
        $this->Mpemeriksaan->saveStep($dataVal, $data);
        $output = [
            'status' => true
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }
    public function kirimPerbaikan()
    {
        $no_skperbaikan = $this->input->post('no_skperbaikan', TRUE);
        $tgl_perbaikan = $this->input->post('tgl_perbaikan', TRUE);
        $konsultasi = $this->secure->decrypt_url($this->input->post('konsultasi', TRUE));
        $tgl_skrg         = date('Y-m-d');
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
                'message' => $this->upload->display_errors()
            ];
            header('Content-Type: application/json');
            echo json_encode($output);
        } else {
            if ($this->upload->data('file_ext') == ".pdf" || $this->upload->data('file_ext') == ".PDF") {
                $data = [
                    'id' => $id,
                    'no_sk' => $no_skperbaikan,
                    'tgl_perbaikan' => $tgl_perbaikan,
                    'lampiran_perbaikan' => $this->upload->data('file_name')
                ];
                $update = [
                    'status' => 7
                ];
                $datalog    = [
                    'id' => $id,
                    'tgl_status' => $tgl_skrg,
                    'status' => '7',
                    'catatan' => "Dikembalikan ke Pemohon agar memperbaiki Dokumen Teknis",
                    'dir_file' => $this->upload->data('file_name'),
                    'modul' => 'Input Hasil Konsultasi'
                ];
                $this->Mpemeriksaan->insertPerbaikan($data);
                $this->Mpemeriksaan->updateStatsPbg($id, $update);
                $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
                $output = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Data Berkas Berhasil Diupload!',
                    'result' => $this->pathPerbaikan . $this->upload->data('file_name')
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
            } else {
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
            }
        }
    }
    public function SavePenilaian()
    {
        $id_kabkot		        = $this->session->userdata('loc_id_kabkot');
        $nomor_berita           = $this->input->post('nomor_berita', TRUE);
        $tgl_berita             = $this->input->post('tgl_berita', TRUE);
        $okupansi               = $this->input->post('okupansi', TRUE);
        $luas_dasar             = $this->input->post('luas_dasar', TRUE);
        $id                     = $this->secure->decrypt_url($this->input->post('id', TRUE));
        $imb                    = $this->input->post('imb', TRUE);
        $id_jenis_permohonan    = $this->input->post('id_jenis_permohonan', TRUE);
        $email                  = $this->input->post('email', TRUE);
        $no_konsultasi          = $this->input->post('no_konsultasi', TRUE);
        $tgl_skrg               = date('Y-m-d');
        $catatan                = "";
        $sk_slf                 = "";
        if ($imb == '1') {
            $status = '10';
            $ket    = "Akan Masuk Ketahap Validasi Kepala Dinas Teknis";
        } else {
            $status = '9';
            $ket    = "Akan Masuk Ketahap Perhitungan Retribusi";
        }
        $config = [
            'upload_path'   => "./{$this->pathBerita}",
            'allowed_types' => 'pdf|PDF',
            'max_size'      => '150000',
            'max_width'     => 5000,
            'max_height'    => 5000,
            'encrypt_name'  =>  TRUE,
            'remove_space'  => TRUE,
        ];
        //$ttd                = $this->Mpemeriksaan->get_pejabat_sk($id_kabkot);
        $ttd                = $this->Mpemeriksaan->get_pejabat($id);
        $ttd_pejabat_sk     = $ttd['kepala_dinas'];
        $nip_kadis_teknis   = $ttd['nip_kepala_dinas'];
        $nm_dinas           = $ttd['p_nama_dinas'];

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('berkas')) {
            $this->session->set_flashdata('message', $this->upload->display_errors());
            $this->session->set_flashdata('status', 'danger');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($this->upload->data('file_ext') == ".pdf" || $this->upload->data('file_ext') == ".PDF") {
                if ($id_jenis_permohonan == '14' || $id_jenis_permohonan == '35' || $id_jenis_permohonan == '36') { //Bangunan Eksisting Memiliki PBG/IMB
                    $sk_slf     = $this->SK_SLF($id);
                    $tgl_sk_slf = date('Y-m-d');
                    $dataInSLF  = array(
                        'id' => $id,
                        'no_slf' => $sk_slf,
                        'tgl_penerbitan_slf' => $tgl_sk_slf,
                        'nm_kadis_teknis' => $ttd_pejabat_sk,
                        'nip_kadis_teknis' => $nip_kadis_teknis,
                        'nm_dinas' => $nm_dinas,
                        'okupansi' => $okupansi,
                        'luas_dasar' => $luas_dasar
                    );
                    $data = [
                        'dir_file_konsultasi' =>  $this->upload->data('file_name'),
                        'hsl_konsultasi' => 1,
                        'no_sk_tk' => $nomor_berita,
                        'date_sk_tk' => $tgl_berita,
                        'nm_kadis' => $ttd_pejabat_sk,
                        'nip_kadis' => $nip_kadis_teknis,
                    ];
                    $update = [
                        'status' => $status,
                    ];
                    $datalog    = [
                        'id' => $id,
                        'tgl_status' => $tgl_skrg,
                        'status' => $status,
                        'catatan' => $ket,
                        'dir_file' => $this->upload->data('file_name'),
                        'modul' => 'Input Hasil Konsultasi'
                    ];
                    $this->Mpemeriksaan->updateStatsPbg($id, $update);
                    $query = $this->Mpemeriksaan->updateHasilPenilaian($id, $data);
                    $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
                    $this->Mpemeriksaan->insertdataslf($dataInSLF);
                    $this->load->library('ciqrcode'); //pemanggilan library QR CODE
                    $config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
                    $config['quality']      = true; //boolean, the default is true
                    $config['size']         = '1024'; //interger, the default is 1024
                    $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
                    $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
                    $this->ciqrcode->initialize($config);
                    $image_name             = $sk_slf . '.png'; //buat name dari qr code sesuai dengan nim
                    $params['data']         = 'http://simbg.pu.go.id/Main/Berkas/' . $sk_slf; //data yang akan di jadikan QR CODE
                    $params['level']        = 'H'; //H=High
                    $params['size']         = 10;
                    $params['savename']     = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
                    $data['QR']             = $this->ciqrcode->generate($params);
                    if ($query) {
                        $email          = "$email";
                        $no_konsultasi  = "$no_konsultasi";
                        $catatan        = "$catatan";
                        $subject        = "Status Verifikasi $no_konsultasi";
                        $text           = "";
                        $text .= "Yth Bapak/Ibu,<br>";
                        $text .= "<br>";
                        $text .= "Dengan ini kami memberitahukan bahwa Permohonan dengan No.Registrasi $no_konsultasi <br>";
                        $text .= "Telah Selesai Konsultasi <br>";
                        $text .= "Dan Selanjutnya $ket";
                        $text .= "<br>";
                        $text .= "<br>";
                        $text .= "Hormat Kami <br>";
                        $text .= "Admin SIMBG ";
                        $this->simbg_lib->sendEmail($email, $subject, $text);
                        $this->session->set_flashdata('message', 'Data Berhasil Disimpan');
                        $this->session->set_flashdata('status', 'success');
                        redirect('Pemeriksaan/penilaian');
                    } else {
                        $this->session->set_flashdata('message', 'Data Gagal Disimpan');
                        $this->session->set_flashdata('status', 'danger');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                } else {
                    $data = [
                        'dir_file_konsultasi'   =>  $this->upload->data('file_name'),
                        'hsl_konsultasi'        => 1,
                        'no_sk_tk'              => $nomor_berita,
                        'date_sk_tk'            => $tgl_berita,
                        'nm_kadis'              => $ttd_pejabat_sk,
                        'nip_kadis'             => $nip_kadis_teknis,
                    ];
                    $update = [
                        'status' => $status,
                    ];
                    $datalog    = [
                        'id' => $id,
                        'tgl_status' => $tgl_skrg,
                        'status' => $status,
                        'catatan' => $ket,
                        'dir_file' => $this->upload->data('file_name'),
                        'modul' => 'Input Hasil Konsultasi'
                    ];
                    $this->Mpemeriksaan->updateStatsPbg($id, $update);
                    $query = $this->Mpemeriksaan->updateHasilPenilaian($id, $data);
                    $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
					
					$dataPemilik 	= $this->Mpemeriksaan->getDataVerifikator($id)->row();
                    if($dataPemilik->oss_id != '' || $dataPemilik->oss_id != null ){
                        $tgl_skrg 		= date('Y-m-d');
                        $kd_status 		= '12';
                        $tgl_status 	= $tgl_skrg;
                        $nama_status 	= 'Pemenuhan Komitmen';
                        $keterangan 	= 'Dokumen Telah Dicek Kelengkapan';
                        $this->oss_lib->receiveLicenseStatusNew($id,$kd_status,$tgl_status,$nama_status,$keterangan);
                    }
					
                    if ($query) {
                        $email = "$email";
                        $no_konsultasi = "$no_konsultasi";
                        $catatan = "$catatan";
                        $subject     = "Status Verifikasi $no_konsultasi";
                        $text         = "";
                        $text .= "Yth Bapak/Ibu,<br>";
                        $text .= "<br>";
                        $text .= "Dengan ini kami memberitahukan bahwa Permohonan dengan No.Registrasi $no_konsultasi <br>";
                        $text .= "Telah Selesai Konsultasi <br>";
                        $text .= "Dan Selanjutnya $ket";
                        $text .= "<br>";
                        $text .= "<br>";
                        $text .= "Hormat Kami <br>";
                        $text .= "Admin SIMBG ";
                        $this->simbg_lib->sendEmail($email, $subject, $text);
                        $this->session->set_flashdata('message', 'Data Berhasil Disimpan');
                        $this->session->set_flashdata('status', 'success');
                        redirect('Pemeriksaan/penilaian');
                    } else {
                        $this->session->set_flashdata('message', 'Data Gagal Disimpan');
                        $this->session->set_flashdata('status', 'danger');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }
            } else {
                $this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
                $this->session->set_flashdata('status', 'danger');
                $path = FCPATH . "/{$this->pathBerita}";
                $berkas = $path . $this->upload->data('file_name');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    // End Pemeriksaan Konsultasi
    // finalisasi data bangunan
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

    public function saveDataFinalisasi()
    {
        //bangunan
        $id_bgn                         = $this->input->post('id_bgn');
        $id                             = $this->input->post('id');
        $nama_bangunan                  = $this->input->post('nama_bangunan');
        $nama_bangunan_kolektif         = $this->input->post('nama_bangunan_kolektif');
        if ($nama_bangunan) {
            $nama_bangunan              = $this->input->post('nama_bangunan');
        } else if ($nama_bangunan_kolektif) {
            $nama_bangunan              = $this->input->post('nama_bangunan_kolektif');
        } else {
            $nama_bangunan              = $this->input->post('nama_bangunan_prasarana');
        }
        $luas_bg                        = $this->input->post('luas_bg');
        $tinggi_bg                      = $this->input->post('tinggi_bg');
        $almt_bgn                       = $this->input->post('almt_bgn');
        $nama_kecamatan                 = $this->input->post('nama_kecamatan');
        $nama_kelurahan                 = $this->input->post('nama_kelurahan');
        $lantai_bg                      = $this->input->post('lantai_bg');
        $luas_basement                  = $this->input->post('luas_basement');
        $lapis_basement                 = $this->input->post('lapis_basement');
        $lantai_bg                      = $this->input->post('lantai_bg');
        $id_jenis_permohonan           	= $this->input->post('id_jenis_permohonan');
        if($id_jenis_permohonan =='21' || $id_jenis_permohonan =='34' || $id_jenis_permohonan =='35' || $id_jenis_permohonan =='36'){
			$id_jns_bg     	            = '2';
		}else{
			$id_jns_bg                  = $this->input->post('id_jns_bg');
		}
        $id_izin                        = $this->input->post('id_izin');
        if ($id_jenis_permohonan =='21' || $id_jenis_permohonan =='34' || $id_jenis_permohonan =='35' || $id_jenis_permohonan =='36'){
			$id_jns_bg                  ='2';
			$luas_bgp                   = '10.01';
			$tinggi_bgp                 = '2.6';
		}else if($id_jenis_permohonan =='29' || $id_jenis_permohonan =='30' || $id_jenis_permohonan =='31' || $id_jenis_permohonan =='32' || $id_jenis_permohonan =='33'){
			$id_fungsi_bg              	='1';
			$id_jns_bg                  ='1';
		}
        $id_kolektif                    = $this->input->post('id_kolektif');
        $tipeA                          = $this->input->post('tipeA');
        $jumlahA                        = $this->input->post('jumlahA');
        $luasA                          = $this->input->post('luasA');
        $tinggiA                        = $this->input->post('tinggiA');
        $lantaiA                        = $this->input->post('lantaiA');
        $id_prasarana_bg                = $this->input->post('id_prasarana_bg');
        $luas_bgp                       = $this->input->post('luas_bgp');
        $tinggi_bgp                     = $this->input->post('tinggi_bgp');
        $jual                           = $this->input->post('jual');
        $imb                            = $this->input->post('checked_imb');
        $no_imb                         = $this->input->post('no_imb');
        $slf                            = $this->input->post('checked_slf');
        $no_slf                         = $this->input->post('no_slf');

        $id_prototype                   = $this->input->post('id_prototype');
        $cetak                          = $this->input->post('cetak');
        $id_doc_tek                     = $this->input->post('id_doc_tek');
        // pemilik
        $nama_pemilik                   = $this->input->post('nama_pemilik');
        $alamat_pemilik                 = $this->input->post('alamat_pemilik');
        $provinsiPemilik                = $this->input->post('provinsiPemilik');
        $kabkotaPemilik                 = $this->input->post('kabkotaPemilik');
        $kecamatanPemilik               = $this->input->post('kecamatanPemilik');
        $kelurahanPemilik               = $this->input->post('kelurahanPemilik');
        $jns_kepemilikan                = $this->input->post('jns_kepemilikan');
        $resiko = $this->input->post('resiko');
        $lokasi = $this->input->post('lokasi');
        $kelas = $this->input->post('kelas');

        
        $data    = array(
            'id'                    => $id,
            'id_kec_bgn'            => $nama_kecamatan,
            'id_kel_bgn'            => $nama_kelurahan,
            'almt_bgn'              => $almt_bgn,
            'id_izin'               => $id_izin,
            'id_jns_bg'             => $id_jns_bg,
            'nm_bgn'                => $nama_bangunan,
            'luas_bgn'              => $luas_bg,
            'tinggi_bgn'            => $tinggi_bg,
            'jml_lantai'            => $lantai_bg,
            'luas_basement'         => $luas_basement,
            'lapis_basement'        => $lapis_basement,
            'last_update'           => date("Y-m-d h:i:sa"),
            'id_kolektif'           => $id_kolektif,
            'tipeA'                 => json_encode($tipeA),
            'jumlahA'               => json_encode($jumlahA),
            'luasA'                 => json_encode($luasA),
            'tinggiA'               => json_encode($tinggiA),
            'lantaiA'               => json_encode($lantaiA),
            'id_prasarana_bg'       => $id_prasarana_bg,
            'luas_bgp'              => $luas_bgp,
            'tinggi_bgp'            => $tinggi_bgp,
            'id_doc_tek'            => $id_doc_tek,
            'id_prototype'          => $id_prototype,
            'imb'                   => $imb,
            'no_imb'                => $no_imb,
            'slf'                   => $slf,
            'no_slf'                => $no_slf,
            'id_resiko'            => $resiko,
            'id_lokasi'            => $lokasi,
            'id_kelas'                => $kelas,

        );
        $dataPemilik = [
            'jns_pemilik'       => $jns_kepemilikan,
            'nm_pemilik'        => $nama_pemilik,
            'alamat'            => $alamat_pemilik,
            'id_kecamatan'      => $kecamatanPemilik,
            'id_kabkota'        => $kabkotaPemilik,
            'id_provinsi'       => $provinsiPemilik,
            'id_kelurahan'      => $kelurahanPemilik,
            'id_provinsi'       => $provinsiPemilik,
        ];
        if ($id_bgn != "") {
            $query          = $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $query1         = $this->Mglobals->setData('tmdatapemilik', $dataPemilik, 'id', $id);
            $this->session->set_flashdata('message', 'Data Bangunan Berhasil di Simpan/Ubah.');
            $this->session->set_flashdata('status', 'success');
            $output = [
                'message' => 'Data Bangunan Berhasil Di Ubah!',
                'res' => true,
                'type' => 'success',
            ];
        } else {
            $query          = $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $query1         = $this->Mglobals->setData('tmdatapemilik', $dataPemilik, 'id', $id);
            if ($query  && $query1) {
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

    function SK_SLF($id = null)
    {
        $que = $this->Mpemeriksaan->get_id_kabkot($id);
        $lokasi = $que['id_kec_bgn'];
        $tgl_disetujui = date('d') . date('m') . date('Y');;
        $mydata2 = $this->Mpemeriksaan->getNoDrafSlf($lokasi, $tgl_disetujui);
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
    // tolak permohonan
    public function tolakPermohonan()
    {
        $konsultasi = $this->secure->decrypt_url($this->input->post('konsultasi', TRUE));
        $getId = $this->Mpemeriksaan->getDataKonsultasi($konsultasi)->row()->id_pemilik;
        $tanggal  = $this->input->post('tanggal', TRUE);
        $catatan = $this->input->post('catatan', TRUE);
        $data = [
            'id'                => $getId,
            'tgl_ditolak'       => $tanggal,
            'catatan_ditolak'   => $catatan
        ];
        $update = [
            'status' => 25
        ];
        $this->Mpemeriksaan->insertDataPenolakan($data);
        $this->Mpemeriksaan->updateStatsPbg($getId, $update);
        $this->session->set_flashdata('message', 'Penolakan Permohonan Berhasil Disimpan!');
        $this->session->set_flashdata('status', 'success');
        redirect('Pemeriksaan/Penilaian', 'refresh');
    }
    public function Rollback()
    {
        $id             = $this->uri->segment(3);
        $pernyataan     = '1';
        $tgl_skrg       = date('Y-m-d');
        if ($pernyataan == '1') {
            $data    = array(
                'status' => '5',
            );
            $datalog    = [
                'id'            => $id,
                'tgl_status'    => $tgl_skrg,
                'status'        => '5',
                'catatan'       => 'Kabid/Kasie melakukan Mengembalikan Permohonan  Ke Tahap Penjadwalan',
                'modul'         => 'Permohonan Dikembalikan ke Tahap Penjadwalan TPA/TPT'
            ];
            $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mpemeriksaan->removeDataJadwal($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Verifikasi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('Pemeriksaan/Penilaian');
    }
    public function RollbackKadis()
    {
        $id    = $this->uri->segment(3);
        $pernyataan = '1';
        $tgl_skrg     = date('Y-m-d');
        if ($pernyataan == '1') {
            $data    = array(
                'status' => '9',
            );
            $datalog    = [
                'id' => $id,
                'tgl_status' => $tgl_skrg,
                'status' => '5',
                'catatan' => 'Kabid/Kasie melakukan Mengembalikan Permohonan  Ke Tahap Perhitungan Retribusi',
                'modul' => 'Permohonan Dikembalikan ke Tahap Perhitungan Retribusi'
            ];
            $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mpemeriksaan->removeDataRetribusi($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Perhitungan Retribusi');
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
