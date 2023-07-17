<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BangunanBaru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utility');
        $this->load->library('mypagination');
        $this->load->library('simbg_lib');
        $this->load->helper(array('form', 'url'));
        // $this->simbg_lib->check_session_login();
        $this->load->model('checklist_model');
        $this->load->model('bgbarumodel');
        $session_login = $this->session->userdata('loc_login');
        if ($session_login != TRUE) {
            redirect('Front');
        }
        $data['role'] = $this->session->userdata('loc_role_id');
    }

    public function index()
    {
        $data['page'] = 'dashboard';
        $data['role'] = $this->session->userdata('loc_role_id');
        $provinsi = $this->db->get('tr_provinsi')->result();
        $data['provinsi'] = $provinsi;
        $data['content'] = $this->load->view('bangunangedung/bangunanbaru/index', $data, TRUE);

        $this->load->view('layouts', $data);
        // $this->load->view('layouts');
    }

    public function permohonan()
    {
        $data['page'] = 'permohonan';
        $no_permohonan = $this->uri->segment(5);
        if (isset($no_permohonan)) {
            $permohonan = $this->bgbarumodel->get(array('t_permohonan_bgh.kode_bgh' => $no_permohonan))->row();
            $data['permohonan'] = $permohonan;
        }
        $klas = $this->db->get('t_klas_bangunan')->result();
        $provinsi = $this->db->get('tr_provinsi')->result();
        $data['klas'] = $klas;
        $data['provinsi'] = $provinsi;
        // $data['head'] = ;
        $data['content'] = $this->load->view('bangunangedung/bangunanbaru/formbangunanpemilik', $data, TRUE);

        $this->load->view('layouts', $data);
    }

    public function savepermohonan()
    {
        $params = (object) $this->input->post();

        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                // $response = array(
                //     'code' => 0,
                //     'msg' => 'File upload failed with error code: ' . $file['error']
                // );
                // echo json_encode($response);
                // exit;
                $filename = "-";
                $destination = "-";
            } else {
                $fileName = $file['name'];
                $fileTmpPath = $file['tmp_name'];
                $fileSize = $file['size'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (!in_array($fileExtension, ['pdf'])) {
                    $response = array(
                        'code' => 0,
                        'msg' => 'Ekstensi File Tidak Sesuai: ' . $file['error']
                    );
                    echo json_encode($response);
                    exit;
                }
            }
        } else {
            $filename = "-";
            $destination = "-";
        }

        $datapemilik = array(
            'user_id' => $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id')),
            'jns_pemilik' => 2,
            'nm_pemilik' => $params->nm_pemilik,
            'glr_depan' => $params->glr_depan,
            'glr_belakang' => $params->glr_belakang,
            'jenis_id' => 1,
            'no_ktp' => $params->no_ktp,
            'no_kitas' => $params->no_kitas,
            'alamat' => $params->alamat,
            'id_kelurahan' => $params->id_kelurahan,
            'id_kecamatan' => $params->id_kecamatan,
            'id_kabkota' => $params->id_kabkot,
            'id_provinsi' => $params->id_provinsi,
            'no_hp' => $params->no_hp,
            'email' => $params->email,
            'post_date' => date('Y-m-d'),
            'post_by' => $this->session->userdata('loc_username'),
            'unit_organisasi' => $params->unit_organisasi,
            'oss_id' => "",
            'oss_id_izin' => "",
            'oss_id_proyek' => "",
            'oss_kd_izin' => ""
        );

        if ($params->id_pemilik == 0) {
            $pemilik = $this->bgbarumodel->insertdatapemilik($datapemilik);
        } else {
            $pemilik = $this->bgbarumodel->updatedatapemilik($datapemilik, ['id' => $params->id_pemilik]);
        }


        if ($params->id_permohonan == 0) {
            $rand1 = date('Ymd');
            $rand2 = rand(0, 999999);
            $kodebgh = 'BGHBGB-' . $rand1 . '-' . $rand2;
            $databangunan = array(
                'kode_bgh' => $kodebgh,
                'kode_pbg' => '-',
                'kategori' => "mandatory",
                'id_pemilik' => $pemilik,
                'nama_gedung' => $params->nama_gedung,
                'lantai' => $params->lantai,
                'luas_bangunan' => $params->luas_bangunan,
                'klas_bangunan' => $params->klas_bangunan,
                'status' => 2,
                'create_by' => $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'))
            );
            $id_permohonan = $this->bgbarumodel->insertpermohonan($databangunan);
        } else {
            $databangunan = array(
                'kode_pbg' => '-',
                'kategori' => "mandatory",
                'id_pemilik' => $pemilik,
                'nama_gedung' => $params->nama_gedung,
                'lantai' => $params->lantai,
                'luas_bangunan' => $params->luas_bangunan,
                'klas_bangunan' => $params->klas_bangunan,
            );
            $kodebgh = $params->kode_bgh;
            $id_permohonan = $this->bgbarumodel->updatepermohonan($databangunan, ['id' => $params->id_permohonan]);
        }

        if (isset($_FILES['file'])) {
            if ($file['error'] !== UPLOAD_ERR_OK) {
                // $response = array(
                //     'code' => 0,
                //     'msg' => 'File upload failed with error code: ' . $file['error']
                // );
                // echo json_encode($response);
                // exit;
                $filename = "-";
                $destination = "-";
            } else {
                if (!file_exists('assets/bgh/files/' . $id_permohonan . '/penyediajasa/')) {
                    mkdir('assets/bgh/files/' . $id_permohonan . '/penyediajasa/', 0777, true);
                }

                // Move the uploaded file to the desired location
                $filename = uniqid() . '.' . $fileExtension;
                $destination = './assets/bgh/files/' . $id_permohonan . '/penyediajasa/' . $filename;
                if (!move_uploaded_file($fileTmpPath, $destination)) {
                    $response = array(
                        'code' => 0,
                        'msg' => 'Gagal Memindahkan File : ' . $file['error']
                    );
                    echo json_encode($response);
                    exit;
                }
                if ($params->idfile != 0) {
                    $wherefile = array('id' => $params->idfile);
                    $getfile = $this->checklist_model->getfile($wherefile);
                    if ($getfile->num_rows() > 0) {
                        $item = $getfile->row();
                        if (file_exists('assets/bgh/files/' . $id_permohonan . '/penyediajasa/' . $item->nama_file)) {
                            unlink('assets/bgh/files/' . $id_permohonan . '/penyediajasa/' . $item->nama_file);
                        }
                    }
                }
            }
        }

        if ($params->idpenyedia == 0) {
            $datapenyedia = array(
                'id_permohonan' => $id_permohonan,
                'nama' => $params->nama_penyedia,
                'alamat' => $params->alamat_penyedia,
                'no_ktp' => $params->no_ktp_penyedia,
                'no_hp' => $params->no_hp_penyedia,
                'no_sertifikat' => $params->no_sertifikat,
                'nama_file' => $filename,
                'path' => $destination,
                'create_by' => $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'))
            );

            $penyedia = $this->bgbarumodel->savepenyedia($datapenyedia);
        } else {
            $datapenyedia = array(
                'id_permohonan' => $id_permohonan,
                'nama' => $params->nama_penyedia,
                'alamat' => $params->alamat_penyedia,
                'no_ktp' => $params->no_ktp_penyedia,
                'no_sertifikat' => $params->no_sertifikat,
                'no_hp' => $params->no_hp_penyedia,
                'update_by' => $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id')),
                'update_date' => date('Y-m-d')
            );

            if ($filename != "-" && $destination != "-") {
                $datapenyedia['nama_file'] = $filename;
                $datapenyedia['path'] = $destination;
            }
            $wherepenyedia = array('id' => $params->idpenyedia);

            $penyedia = $this->bgbarumodel->editpenyedia($datapenyedia, $wherepenyedia);
        }

        if ($pemilik > 0 && $id_permohonan > 0 && $penyedia) {
            $response = array(
                'code' => 1,
                'nomor_bgh' => $kodebgh
            );
        } else {
            $response = array(
                'code' => 0,
                'msg' => 'Input Gagal Silahkan coba kembali '
            );
        }

        echo json_encode($response);
    }

    public function updatestatuspermohonan()
    {
        $params = (object)$this->input->post();

        $where = array(
            'id' => $params->id_permohonan
        );

        $data = array(
            'poin_diajukan' => $params->poinhead,
            'status' => $params->status
        );

        $update = $this->bgbarumodel->updatestatuspermohonan($data, $where);
        if ($update) {
            $response = array(
                'code' => 1,
                'mgs' => "Berhasil"
            );
        } else {
            $response = array(
                'code' => 0,
                'msg' => 'Input Gagal Silahkan coba kembali '
            );
        }

        echo json_encode($response);
    }

    public function penilaian()
    {
        $no_permohonan = $this->uri->segment(5);
        if (isset($no_permohonan)) {
            $permohonan = $this->bgbarumodel->get(array('t_permohonan_bgh.kode_bgh' => $no_permohonan))->row();
            if (empty($permohonan)) {
                redirect('Bgh/BangunanGedung/BangunanBaru');
            } else {
                $data['permohonan'] = $permohonan;
            }
        } else {
            redirect('Bgh/BangunanGedung/BangunanBaru');
        }
        $data['page'] = 'permohonan';
        $klas = $this->db->get('t_klas_bangunan')->result();
        $data['klas'] = $klas;
        $head = $this->checklist_model->gethead()->result();
        $checklist = array();
        $data['tidak_sesuai'] = 0;
        $data['poin_maksimal'] = 0;
        $data['poinhead'] = 0;
        $data['poinall'] = 0;
        foreach ($head as $h) {
            $row = array();
            $row['id'] = (!empty($h->id) ? $h->id : "");
            $row['kode'] = (!empty($h->kode) ? $h->kode : "");
            $row['nama'] = (!empty($h->nama) ? $h->nama : "");
            $row['poin'] = (!empty($h->poin) ? $h->poin : "");
            $row['poindiajukan'] = 0;

            $getmain = $this->checklist_model->getmain(array('id_head' => $h->id))->result();
            $main = array();
            foreach ($getmain as $m) {
                $row1 = array();
                $row1['id'] = (!empty($m->id) ? $m->id : "");
                $row1['kode'] = (!empty($m->kode) ? $m->kode : "");
                $row1['nama'] = (!empty($m->nama) ? $m->nama : "");
                $row1['poin'] = (!empty($m->poin) ? $m->poin : "");
                $data['poin_maksimal'] += $m->poin;

                $getsub = $this->checklist_model->getsub(array('id_main' => $m->id))->result();
                $sub = array();

                foreach ($getsub as $s) {
                    $row2 = array();
                    $row2['id'] = (!empty($s->id) ? $s->id : "");
                    $row2['kode'] = (!empty($s->kode) ? $s->kode : "");
                    $row2['nama'] = (!empty($s->nama) ? $s->nama : "");
                    $row2['poin'] = (!empty($s->poin) ? $s->poin : "");
                    $row2['pilihan'] = (!empty($s->pilihan) ? $s->pilihan : "0");
                    $row2['dokumen'] = (!empty($s->dokumen) ? $s->dokumen : "0");
                    $row2['terpilih'] = 0;
                    if ($s->dokumen == 0) {
                        $getsubsub = $this->checklist_model->getsubsub(array('id_sub' => $s->id))->result();
                        $subsub = array();
                        foreach ($getsubsub as $ss) {

                            $row3 = array();
                            $row3['id'] = (!empty($ss->id) ? $ss->id : "");
                            $row3['kode'] = (!empty($ss->kode) ? $ss->kode : "");
                            $row3['nama'] = (!empty($ss->nama) ? $ss->nama : "");
                            $row3['pilihan'] = (!empty($ss->pilihan) ? $ss->pilihan : "0");
                            $row3['poin'] = (!empty($ss->poin) ? $ss->poin : "");
                            $row3['dokumen'] = (!empty($ss->dokumen) ? $ss->dokumen : "0");
                            $getambil = $this->bgbarumodel->getambil(array('id_permohonan_ambil' => $permohonan->id, 'id_sub_sub_ambil' => $ss->id));
                            if ($getambil->num_rows() > 0) {
                                $row3['ambil'] = 1;
                                $itemambil = $getambil->row();
                                $row3['poinambil'] = $itemambil->poin_diajukan;
                                $row2['terpilih'] = 1;
                            } else {
                                $row3['ambil'] = 0;
                                $row3['poinambil'] = 0;
                            }
                            // $getambils = $this->checklist_model->getfile(array('id_permohonan' => $permohonan->id, 'id_sub_sub' => $ss->id))->num_rows();
                            // if ($getambils > 0) {
                            //     $row3['ambil'] = 1;
                            //     $row2['terpilih'] = 1;
                            // }else{
                            //     $row3['ambil'] = 0;
                            // }
                            $getdok = $this->checklist_model->getdok(array('id_sub_sub_dok' => $ss->id))->result();

                            $dok = array();
                            $countupload = 0;
                            foreach ($getdok as $d) {
                                $row4 = array();
                                $row4['id'] = (!empty($d->id) ? $d->id : "");
                                $row4['nama'] = (!empty($d->nama) ? $d->nama : "");
                                $getfile = $this->checklist_model->getfile(array('id_permohonan' => $permohonan->id, 'id_dokumen' => $d->id))->row();
                                if (!empty($getfile)) {
                                    $row4['idfile'] = $getfile->id;
                                    $row4['sesuai'] = $getfile->sesuai;
                                    if ($getfile->sesuai == 2) {
                                        $data['tidak_sesuai'] += 1;
                                        // $counttidaksesuai += 1;
                                    }
                                    $row4['catatan'] = $getfile->catatan;
                                    $row4['isupload'] = 1;
                                    $countupload += 1;
                                } else {
                                    $row4['isupload'] = 0;
                                }

                                array_push($dok, $row4);
                            }

                            if (count($getdok) == $countupload && !empty($getdok)) {
                                $row3['isallfile'] = 1;
                                $row['poindiajukan'] += $ss->poin;
                                $data['poinall'] += $ss->poin;
                                $data['poinhead'] += $ss->poin;
                            } else {
                                $row3['isallfile'] = 0;
                            }

                            $row3['dok'] = $dok;

                            array_push($subsub, $row3);
                        }
                        $row2['subsub'] = $subsub;
                    } else {
                        $getambil = $this->bgbarumodel->getambil(array('id_permohonan_ambil' => $permohonan->id, 'id_sub_ambil' => $s->id));
                        if ($getambil->num_rows() > 0) {
                            $row2['ambil'] = 1;
                            $itemambil = $getambil->row();
                            $row2['poinambil'] = $itemambil->poin_diajukan;
                            $row2['terpilih'] = 1;
                        } else {
                            $row2['ambil'] = 0;
                            $row2['poinambil'] = 0;
                        }

                        $getdok = $this->checklist_model->getdok(array('id_sub_dok' => $s->id))->result();

                        $dok = array();
                        $countupload = 0;
                        foreach ($getdok as $d) {
                            $row4 = array();
                            $row4['id'] = (!empty($d->id) ? $d->id : "");
                            $row4['nama'] = (!empty($d->nama) ? $d->nama : "");
                            $getfile = $this->checklist_model->getfile(array('id_permohonan' => $permohonan->id, 'id_dokumen' => $d->id))->row();
                            if (!empty($getfile)) {
                                $row4['idfile'] = $getfile->id;
                                $row4['sesuai'] = $getfile->sesuai;
                                if ($getfile->sesuai == 2) {
                                    $data['tidak_sesuai'] += 1;
                                    // $counttidaksesuai += 1;
                                }
                                $row4['catatan'] = $getfile->catatan;
                                $row4['isupload'] = 1;
                                $countupload += 1;
                            } else {
                                $row4['isupload'] = 0;
                            }
                            array_push($dok, $row4);
                        }
                        if (count($getdok) == $countupload && !empty($getdok)) {
                            $row2['isallfile'] = 1;
                            $row['poindiajukan'] += $s->poin;
                            $data['poinall'] += $s->poin;
                            $data['poinhead'] += $s->poin;
                        } else {
                            $row2['isallfile'] = 0;
                        }
                        $row2['dok'] = $dok;
                    }

                    array_push($sub, $row2);
                }
                $row1['sub'] = $sub;

                array_push($main, $row1);
            }

            $row['main'] = $main;

            array_push($checklist, $row);
        }
        $data['checklist'] = $checklist;
        $hasil = (float) ($data['poinall'] * 100) / $data['poin_maksimal'];
        $data['hasil_assesment'] = number_format($hasil, 2);
        $data['checklist'] = $checklist;
        // $data['head'] = ;
        $data['content'] = $this->load->view('bangunangedung/bangunanbaru/form', $data, TRUE);

        $this->load->view('layouts', $data);
    }

    public function detailform()
    {
        $no_permohonan = $this->uri->segment(5);
        if (isset($no_permohonan)) {
            $permohonan = $this->bgbarumodel->get(array('t_permohonan_bgh.kode_bgh' => $no_permohonan))->row();
            if (empty($permohonan)) {
                redirect('Bgh/BangunanGedung/BangunanBaru');
            } else {
                $data['permohonan'] = $permohonan;
            }
        } else {
            redirect('Bgh/BangunanGedung/BangunanBaru');
        }
        $data['page'] = 'permohonan';
        $klas = $this->db->get('t_klas_bangunan')->result();
        $data['klas'] = $klas;
        $head = $this->checklist_model->gethead()->result();
        $checklist = array();
        $data['tidak_sesuai'] = 0;
        $data['poin_maksimal'] = 0;
        $data['poinhead'] = 0;
        $data['poinall'] = 0;
        foreach ($head as $h) {
            $row = array();
            $row['id'] = (!empty($h->id) ? $h->id : "");
            $row['kode'] = (!empty($h->kode) ? $h->kode : "");
            $row['nama'] = (!empty($h->nama) ? $h->nama : "");
            $row['poin'] = (!empty($h->poin) ? $h->poin : "");
            $row['poindiajukan'] = 0;

            $getmain = $this->checklist_model->getmain(array('id_head' => $h->id))->result();
            $main = array();
            foreach ($getmain as $m) {
                $row1 = array();
                $row1['id'] = (!empty($m->id) ? $m->id : "");
                $row1['kode'] = (!empty($m->kode) ? $m->kode : "");
                $row1['nama'] = (!empty($m->nama) ? $m->nama : "");
                $row1['poin'] = (!empty($m->poin) ? $m->poin : "");
                $data['poin_maksimal'] += $m->poin;

                $getsub = $this->checklist_model->getsub(array('id_main' => $m->id))->result();
                $sub = array();

                foreach ($getsub as $s) {
                    $row2 = array();
                    $row2['id'] = (!empty($s->id) ? $s->id : "");
                    $row2['kode'] = (!empty($s->kode) ? $s->kode : "");
                    $row2['nama'] = (!empty($s->nama) ? $s->nama : "");
                    $row2['poin'] = (!empty($s->poin) ? $s->poin : "");
                    $row2['pilihan'] = (!empty($s->pilihan) ? $s->pilihan : "0");
                    $row2['dokumen'] = (!empty($s->dokumen) ? $s->dokumen : "0");
                    $row2['terpilih'] = 0;
                    if ($s->dokumen == 0) {
                        $getsubsub = $this->checklist_model->getsubsub(array('id_sub' => $s->id))->result();
                        $subsub = array();
                        foreach ($getsubsub as $ss) {

                            $row3 = array();
                            $row3['id'] = (!empty($ss->id) ? $ss->id : "");
                            $row3['kode'] = (!empty($ss->kode) ? $ss->kode : "");
                            $row3['nama'] = (!empty($ss->nama) ? $ss->nama : "");
                            $row3['pilihan'] = (!empty($ss->pilihan) ? $ss->pilihan : "0");
                            $row3['poin'] = (!empty($ss->poin) ? $ss->poin : "");
                            $row3['dokumen'] = (!empty($ss->dokumen) ? $ss->dokumen : "0");
                            $getambil = $this->bgbarumodel->getambil(array('id_permohonan_ambil' => $permohonan->id, 'id_sub_sub_ambil' => $ss->id));
                            if ($getambil->num_rows() > 0) {
                                $row3['ambil'] = 1;
                                $itemambil = $getambil->row();
                                $row3['poinambil'] = $itemambil->poin_diajukan;
                                $row2['terpilih'] = 1;
                            } else {
                                $row3['ambil'] = 0;
                                $row3['poinambil'] = 0;
                            }
                            // $getambils = $this->checklist_model->getfile(array('id_permohonan' => $permohonan->id, 'id_sub_sub' => $ss->id))->num_rows();
                            // if ($getambils > 0) {
                            //     $row3['ambil'] = 1;
                            //     $row2['terpilih'] = 1;
                            // }else{
                            //     $row3['ambil'] = 0;
                            // }
                            $getdok = $this->checklist_model->getdok(array('id_sub_sub_dok' => $ss->id))->result();

                            $dok = array();
                            $countupload = 0;
                            foreach ($getdok as $d) {
                                $row4 = array();
                                $row4['id'] = (!empty($d->id) ? $d->id : "");
                                $row4['nama'] = (!empty($d->nama) ? $d->nama : "");
                                $getfile = $this->checklist_model->getfile(array('id_permohonan' => $permohonan->id, 'id_dokumen' => $d->id))->row();
                                if (!empty($getfile)) {
                                    $row4['idfile'] = $getfile->id;
                                    $row4['sesuai'] = $getfile->sesuai;
                                    if ($getfile->sesuai == 2) {
                                        $data['tidak_sesuai'] += 1;
                                        // $counttidaksesuai += 1;
                                    }
                                    $row4['catatan'] = $getfile->catatan;
                                    $row4['isupload'] = 1;
                                    $countupload += 1;
                                } else {
                                    $row4['isupload'] = 0;
                                }

                                array_push($dok, $row4);
                            }

                            if (count($getdok) == $countupload && !empty($getdok)) {
                                $row3['isallfile'] = 1;
                                $row['poindiajukan'] += $ss->poin;
                                $data['poinall'] += $ss->poin;
                                $data['poinhead'] += $ss->poin;
                            } else {
                                $row3['isallfile'] = 0;
                            }

                            $row3['dok'] = $dok;

                            array_push($subsub, $row3);
                        }
                        $row2['subsub'] = $subsub;
                    } else {
                        $getambil = $this->bgbarumodel->getambil(array('id_permohonan_ambil' => $permohonan->id, 'id_sub_ambil' => $s->id));
                        if ($getambil->num_rows() > 0) {
                            $row2['ambil'] = 1;
                            $itemambil = $getambil->row();
                            $row2['poinambil'] = $itemambil->poin_diajukan;
                            $row2['terpilih'] = 1;
                        } else {
                            $row2['ambil'] = 0;
                            $row2['poinambil'] = 0;
                        }

                        $getdok = $this->checklist_model->getdok(array('id_sub_dok' => $s->id))->result();

                        $dok = array();
                        $countupload = 0;
                        foreach ($getdok as $d) {
                            $row4 = array();
                            $row4['id'] = (!empty($d->id) ? $d->id : "");
                            $row4['nama'] = (!empty($d->nama) ? $d->nama : "");
                            $getfile = $this->checklist_model->getfile(array('id_permohonan' => $permohonan->id, 'id_dokumen' => $d->id))->row();
                            if (!empty($getfile)) {
                                $row4['idfile'] = $getfile->id;
                                $row4['sesuai'] = $getfile->sesuai;
                                if ($getfile->sesuai == 2) {
                                    $data['tidak_sesuai'] += 1;
                                    // $counttidaksesuai += 1;
                                }
                                $row4['catatan'] = $getfile->catatan;
                                $row4['isupload'] = 1;
                                $countupload += 1;
                            } else {
                                $row4['isupload'] = 0;
                            }
                            array_push($dok, $row4);
                        }
                        if (count($getdok) == $countupload && !empty($getdok)) {
                            $row2['isallfile'] = 1;
                            $row['poindiajukan'] += $s->poin;
                            $data['poinall'] += $s->poin;
                            $data['poinhead'] += $s->poin;
                        } else {
                            $row2['isallfile'] = 0;
                        }
                        $row2['dok'] = $dok;
                    }

                    array_push($sub, $row2);
                }
                $row1['sub'] = $sub;

                array_push($main, $row1);
            }

            $row['main'] = $main;

            array_push($checklist, $row);
        }
        $data['checklist'] = $checklist;
        $hasil = (float) ($data['poinall'] * 100) / $data['poin_maksimal'];
        $data['hasil_assesment'] = number_format($hasil, 2);
        $data['checklist'] = $checklist;
        // $data['head'] = ;
        $data['content'] = $this->load->view('bangunangedung/bangunanbaru/detailform', $data, TRUE);

        $this->load->view('layouts', $data);
    }

    public function assesment()
    {
        $no_permohonan = $this->uri->segment(5);
        if (isset($no_permohonan)) {
            $permohonan = $this->bgbarumodel->get(array('t_permohonan_bgh.kode_bgh' => $no_permohonan))->row();
            if (empty($permohonan)) {
                redirect('Bgh/BangunanGedung/BangunanBaru');
            } else {
                $data['permohonan'] = $permohonan;
            }
        } else {
            redirect('Bgh/BangunanGedung/BangunanBaru');
        }
        $data['page'] = 'permohonan';
        $data['tidak_sesuai'] = 0;
        $klas = $this->db->get('t_klas_bangunan')->result();
        $data['klas'] = $klas;
        $head = $this->checklist_model->gethead()->result();
        $checklist = array();
        $data['poin_maksimal'] = 0;
        $data['poinhead'] = 0;
        $data['poinallassesment'] = 0;
        foreach ($head as $h) {
            $row = array();
            $row['id'] = (!empty($h->id) ? $h->id : "");
            $row['kode'] = (!empty($h->kode) ? $h->kode : "");
            $row['nama'] = (!empty($h->nama) ? $h->nama : "");
            $row['poin'] = (!empty($h->poin) ? $h->poin : "");
            $row['poindiajukan'] = 0;

            $getmain = $this->checklist_model->getmain(array('id_head' => $h->id))->result();
            $main = array();
            foreach ($getmain as $m) {
                $row1 = array();
                $row1['id'] = (!empty($m->id) ? $m->id : "");
                $row1['kode'] = (!empty($m->kode) ? $m->kode : "");
                $row1['nama'] = (!empty($m->nama) ? $m->nama : "");
                $row1['poin'] = (!empty($m->poin) ? $m->poin : "");
                $data['poin_maksimal'] += $m->poin;

                $getsub = $this->checklist_model->getsub(array('id_main' => $m->id))->result();
                $sub = array();

                foreach ($getsub as $s) {
                    $row2 = array();
                    $row2['id'] = (!empty($s->id) ? $s->id : "");
                    $row2['kode'] = (!empty($s->kode) ? $s->kode : "");
                    $row2['nama'] = (!empty($s->nama) ? $s->nama : "");
                    $row2['poin'] = (!empty($s->poin) ? $s->poin : "");
                    $row2['pilihan'] = (!empty($s->pilihan) ? $s->pilihan : "0");
                    $row2['dokumen'] = (!empty($s->dokumen) ? $s->dokumen : "0");
                    $row2['terpilih'] = 0;
                    if ($s->dokumen == 0) {
                        $getsubsub = $this->checklist_model->getsubsub(array('id_sub' => $s->id))->result();
                        $subsub = array();
                        foreach ($getsubsub as $ss) {

                            $row3 = array();
                            $row3['id'] = (!empty($ss->id) ? $ss->id : "");
                            $row3['kode'] = (!empty($ss->kode) ? $ss->kode : "");
                            $row3['nama'] = (!empty($ss->nama) ? $ss->nama : "");
                            $row3['pilihan'] = (!empty($ss->pilihan) ? $ss->pilihan : "0");
                            $row3['poin'] = (!empty($ss->poin) ? $ss->poin : "");
                            $row3['dokumen'] = (!empty($ss->dokumen) ? $ss->dokumen : "0");
                            $getambil = $this->bgbarumodel->getambil(array('id_permohonan_ambil' => $permohonan->id, 'id_sub_sub_ambil' => $ss->id));
                            if ($getambil->num_rows() > 0) {
                                $data['poinhead'] += $ss->poin;
                                $row['poindiajukan'] += $ss->poin;

                                $itemambil = $getambil->row();
                                $row3['ambil'] = 1;
                                $row3['id_ambil'] = $itemambil->id;
                                $row3['poin_diajukan'] = $itemambil->poin_diajukan;
                                $row3['poin_assesment'] = $itemambil->poin_assesment;
                                $data['poinallassesment'] += $itemambil->poin_assesment;
                                $row3['assesment_by'] = $itemambil->assesment_by;
                            }

                            $getdok = $this->checklist_model->getdok(array('id_sub_sub_dok' => $ss->id))->result();

                            $dok = array();
                            $countdok = 0;
                            $counttidaksesuai = 0;
                            foreach ($getdok as $d) {
                                $row4 = array();
                                $row4['id'] = (!empty($d->id) ? $d->id : "");
                                $row4['nama'] = (!empty($d->nama) ? $d->nama : "");

                                $getfile = $this->checklist_model->getfile(array('id_permohonan' => $permohonan->id, 'id_dokumen' => $d->id))->row();

                                if (!empty($getfile)) {
                                    $row4['id_file'] = $getfile->id;
                                    $row4['sesuai'] = $getfile->sesuai;
                                    if ($getfile->sesuai == 2) {
                                        $data['tidak_sesuai'] += 1;
                                    } else if ($getfile->sesuai == 0) {
                                        $counttidaksesuai += 1;
                                    }
                                    $row4['catatan'] = $getfile->catatan;
                                    $row4['path'] = $getfile->path;
                                    $row4['extension'] = $getfile->extension;
                                    $row4['isupload'] = 1;
                                    // if ($getfile->sesuai == 1) {
                                    $countdok += 1;
                                    // }
                                } else {
                                    $row4['isupload'] = 0;
                                }

                                array_push($dok, $row4);
                            }
                            if (count($getdok) == $countdok) {
                                $row3['allassesment'] = 1;
                            } else {
                                $row3['allassesment'] = 0;
                            }
                            $row3['belumasses'] = $counttidaksesuai;
                            $row3['dok'] = $dok;

                            array_push($subsub, $row3);
                        }
                        $row2['subsub'] = $subsub;
                    } else {
                        $getambil = $this->bgbarumodel->getambil(array('id_permohonan_ambil' => $permohonan->id, 'id_sub_ambil' => $s->id));
                        if ($getambil->num_rows() > 0) {
                            $itemambil = $getambil->row();
                            $row2['ambil'] = 1;
                            $row2['id_ambil'] = $itemambil->id;
                            $row2['poin_diajukan'] = $itemambil->poin_diajukan;
                            $data['poinhead'] += $s->poin;
                            $row['poindiajukan'] += $s->poin;
                            $row2['poin_assesment'] = $itemambil->poin_assesment;
                            $data['poinallassesment'] += $itemambil->poin_assesment;
                            $row2['assesment_by'] = $itemambil->assesment_by;
                        } else {
                            $row2['ambil'] = 0;
                        }

                        $getdok = $this->checklist_model->getdok(array('id_sub_dok' => $s->id))->result();

                        $dok = array();
                        $countdok = 0;
                        $counttidaksesuai = 0;
                        foreach ($getdok as $d) {
                            $row4 = array();
                            $row4['id'] = (!empty($d->id) ? $d->id : "");
                            $row4['nama'] = (!empty($d->nama) ? $d->nama : "");

                            $getfile = $this->checklist_model->getfile(array('id_permohonan' => $permohonan->id, 'id_dokumen' => $d->id))->row();
                            if (!empty($getfile)) {
                                $row4['id_file'] = $getfile->id;
                                $row4['sesuai'] = $getfile->sesuai;
                                if ($getfile->sesuai == 2) {
                                    $data['tidak_sesuai'] += 1;
                                    $counttidaksesuai += 1;
                                } else if ($getfile->sesuai == 0) {
                                    $counttidaksesuai += 1;
                                }
                                $row4['catatan'] = $getfile->catatan;
                                $row4['path'] = $getfile->path;
                                $row4['extension'] = $getfile->extension;
                                $row4['isupload'] = 1;
                                // if ($getfile->sesuai == 1) {
                                $countdok += 1;
                                // }
                            } else {
                                $row4['isupload'] = 0;
                            }
                            array_push($dok, $row4);
                        }
                        if (count($getdok) == $countdok) {
                            $row2['allassesment'] = 1;
                        } else {
                            $row2['allassesment'] = 0;
                        }
                        $row2['belumasses'] = $counttidaksesuai;
                        $row2['dok'] = $dok;
                    }

                    array_push($sub, $row2);
                }
                $row1['sub'] = $sub;

                array_push($main, $row1);
            }

            $row['main'] = $main;

            array_push($checklist, $row);
        }
        $data['checklist'] = $checklist;
        $hasil = (float) ($data['poinallassesment'] * 100) / $data['poin_maksimal'];
        $data['hasil_assesment'] = number_format($hasil, 2);

        if ($hasil < 65 || $hasil <= 45) {
            if ($hasil == 0) {
                $ketentuan = '-';
            } else {
                $ketentuan = 'PRATAMA';
            }
        } else if ($hasil == 65 || $hasil < 80) {
            $ketentuan = "MADYA";
        } else if ($hasil == 80 || $hasil <= 100) {
            $ketentuan = "UTAMA";
        }
        $data['ketentuan'] = $ketentuan;
        $data['content'] = $this->load->view('bangunangedung/bangunanbaru/formassesment', $data, TRUE);

        $this->load->view('layouts', $data);
    }

    public function hasil()
    {
        $no_permohonan = $this->uri->segment(5);
        if (isset($no_permohonan)) {
            $permohonan = $this->bgbarumodel->get(array('t_permohonan_bgh.kode_bgh' => $no_permohonan))->row();
            if (empty($permohonan)) {
                redirect('Bgh/BangunanGedung/BangunanBaru');
            } else {
                $data['permohonan'] = $permohonan;
            }
        } else {
            redirect('Bgh/BangunanGedung/BangunanBaru');
        }
        $data['page'] = 'hasil assesment';
        $klas = $this->db->get('t_klas_bangunan')->result();
        $data['klas'] = $klas;
        $head = $this->checklist_model->gethead()->result();
        $checklist = array();
        $data['poin_maksimal'] = 0;
        $data['poinhead'] = 0;
        $data['poinallassesment'] = 0;
        foreach ($head as $h) {
            $row = array();
            $row['id'] = (!empty($h->id) ? $h->id : "");
            $row['kode'] = (!empty($h->kode) ? $h->kode : "");
            $row['nama'] = (!empty($h->nama) ? $h->nama : "");
            $row['poin'] = (!empty($h->poin) ? $h->poin : "");
            $row['poindiajukan'] = 0;

            $getmain = $this->checklist_model->getmain(array('id_head' => $h->id))->result();
            $main = array();
            foreach ($getmain as $m) {
                $row1 = array();
                $row1['id'] = (!empty($m->id) ? $m->id : "");
                $row1['kode'] = (!empty($m->kode) ? $m->kode : "");
                $row1['nama'] = (!empty($m->nama) ? $m->nama : "");
                $row1['poin'] = (!empty($m->poin) ? $m->poin : "");
                $data['poin_maksimal'] += $m->poin;

                $getsub = $this->checklist_model->getsub(array('id_main' => $m->id))->result();
                $sub = array();

                foreach ($getsub as $s) {
                    $row2 = array();
                    $row2['id'] = (!empty($s->id) ? $s->id : "");
                    $row2['kode'] = (!empty($s->kode) ? $s->kode : "");
                    $row2['nama'] = (!empty($s->nama) ? $s->nama : "");
                    $row2['poin'] = (!empty($s->poin) ? $s->poin : "");
                    $row2['pilihan'] = (!empty($s->pilihan) ? $s->pilihan : "0");
                    $row2['dokumen'] = (!empty($s->dokumen) ? $s->dokumen : "0");
                    $row2['terpilih'] = 0;
                    if ($s->dokumen == 0) {
                        $getsubsub = $this->checklist_model->getsubsub(array('id_sub' => $s->id))->result();
                        $subsub = array();
                        foreach ($getsubsub as $ss) {

                            $row3 = array();
                            $row3['id'] = (!empty($ss->id) ? $ss->id : "");
                            $row3['kode'] = (!empty($ss->kode) ? $ss->kode : "");
                            $row3['nama'] = (!empty($ss->nama) ? $ss->nama : "");
                            $row3['pilihan'] = (!empty($ss->pilihan) ? $ss->pilihan : "0");
                            $row3['poin'] = (!empty($ss->poin) ? $ss->poin : "");
                            $row3['dokumen'] = (!empty($ss->dokumen) ? $ss->dokumen : "0");
                            $getambil = $this->bgbarumodel->getambil(array('id_permohonan_ambil' => $permohonan->id, 'id_sub_sub_ambil' => $ss->id));
                            if ($getambil->num_rows() > 0) {
                                $data['poinhead'] += $ss->poin;
                                $row['poindiajukan'] += $ss->poin;

                                $itemambil = $getambil->row();
                                $row3['ambil'] = 1;
                                $row3['id_ambil'] = $itemambil->id;
                                $row3['poin_diajukan'] = $itemambil->poin_diajukan;
                                $row3['poin_assesment'] = $itemambil->poin_assesment;
                                $data['poinallassesment'] += $itemambil->poin_assesment;
                                $row3['assesment_by'] = $itemambil->assesment_by;
                            }

                            $getdok = $this->checklist_model->getdok(array('id_sub_sub_dok' => $ss->id))->result();

                            $dok = array();
                            $countdok = 0;
                            foreach ($getdok as $d) {
                                $row4 = array();
                                $row4['id'] = (!empty($d->id) ? $d->id : "");
                                $row4['nama'] = (!empty($d->nama) ? $d->nama : "");

                                $getfile = $this->checklist_model->getfile(array('id_permohonan' => $permohonan->id, 'id_dokumen' => $d->id))->row();

                                if (!empty($getfile)) {
                                    $row4['id_file'] = $getfile->id;
                                    $row4['sesuai'] = $getfile->sesuai;
                                    $row4['catatan'] = $getfile->catatan;
                                    $row4['path'] = $getfile->path;
                                    $row4['extension'] = $getfile->extension;
                                    $row4['isupload'] = 1;
                                    if ($getfile->sesuai == 1) {
                                        $countdok += 1;
                                    }
                                } else {
                                    $row4['isupload'] = 0;
                                }

                                array_push($dok, $row4);
                            }
                            if (count($getdok) == $countdok) {
                                $row3['allassesment'] = 1;
                            } else {
                                $row3['allassesment'] = 0;
                            }
                            $row3['dok'] = $dok;

                            array_push($subsub, $row3);
                        }
                        $row2['subsub'] = $subsub;
                    } else {
                        $getambil = $this->bgbarumodel->getambil(array('id_permohonan_ambil' => $permohonan->id, 'id_sub_ambil' => $s->id));
                        if ($getambil->num_rows() > 0) {
                            $itemambil = $getambil->row();
                            $row2['ambil'] = 1;
                            $row2['id_ambil'] = $itemambil->id;
                            $row2['poin_diajukan'] = $itemambil->poin_diajukan;
                            $data['poinhead'] += $s->poin;
                            $row['poindiajukan'] += $s->poin;
                            $row2['poin_assesment'] = $itemambil->poin_assesment;
                            $data['poinallassesment'] += $itemambil->poin_assesment;
                            $row2['assesment_by'] = $itemambil->assesment_by;
                        } else {
                            $row2['ambil'] = 0;
                        }

                        $getdok = $this->checklist_model->getdok(array('id_sub_dok' => $s->id))->result();

                        $dok = array();
                        $countdok = 0;
                        foreach ($getdok as $d) {
                            $row4 = array();
                            $row4['id'] = (!empty($d->id) ? $d->id : "");
                            $row4['nama'] = (!empty($d->nama) ? $d->nama : "");

                            $getfile = $this->checklist_model->getfile(array('id_permohonan' => $permohonan->id, 'id_dokumen' => $d->id))->row();
                            if (!empty($getfile)) {
                                $row4['id_file'] = $getfile->id;
                                $row4['sesuai'] = $getfile->sesuai;
                                $row4['catatan'] = $getfile->catatan;
                                $row4['path'] = $getfile->path;
                                $row4['extension'] = $getfile->extension;
                                $row4['isupload'] = 1;
                                if ($getfile->sesuai == 1) {
                                    $countdok += 1;
                                }
                            } else {
                                $row4['isupload'] = 0;
                            }
                            array_push($dok, $row4);
                        }
                        if (count($getdok) == $countdok) {
                            $row2['allassesment'] = 1;
                        } else {
                            $row2['allassesment'] = 0;
                        }
                        $row2['dok'] = $dok;
                    }

                    array_push($sub, $row2);
                }
                $row1['sub'] = $sub;

                array_push($main, $row1);
            }

            $row['main'] = $main;

            array_push($checklist, $row);
        }
        $data['checklist'] = $checklist;
        $hasil = (float) ($data['poinallassesment'] * 100) / $data['poin_maksimal'];
        $data['hasil_assesment'] = number_format($hasil, 2);

        if ($hasil < 65 || $hasil <= 45) {
            $ketentuan = 'PRATAMA';
        } else if ($hasil == 65 || $hasil < 80) {
            $ketentuan = "MADYA";
        } else if ($hasil == 80 || $hasil <= 100) {
            $ketentuan = "UTAMA";
        }
        $data['ketentuan'] = $ketentuan;
        $data['content'] = $this->load->view('bangunangedung/bangunanbaru/hasilassesment', $data, TRUE);

        $this->load->view('layouts', $data);
    }

    public function loadbangunanbaru()
    {
        try {

            $post = new stdClass();
            foreach ($this->input->post() as $key => $value) {
                $post->$key = $this->input->post($key, TRUE);
            }

            $search =  $post->search['value'];

            $result = $this->bgbarumodel->getdata($post->length, $post->start, $search);
            $totalall = $this->bgbarumodel->countall();

            if ($result) {
                $response = [
                    'status'   => 'sukses',
                    'code'     => '1',
                    'data'          => $result,
                    'recordsTotal' => $totalall,
                    'recordsFiltered' => $totalall,
                ];
            } else {
                $response = [
                    'status'   => 'gagal',
                    'code'     => '0',
                    'data'     => $result,
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ambilpoin()
    {
        $params = (object) $this->input->post();

        $permohonan = $this->bgbarumodel->get(array('t_permohonan_bgh.id' => $params->id_permohonan_ambil))->row();
        $sub = 0;
        $subsub = 0;
        if ($params->id_sub_ambil != 0) {
            $s = $this->checklist_model->getsub(array('id' => $params->id_sub_ambil))->row();
            $sub = $s->id;
        } else if ($params->id_sub_sub_ambil != 0) {
            $ss = $this->checklist_model->getsubsub(array('id' => $params->id_sub_sub_ambil))->row();
            $subsub = $ss->id;
        }

        $data = array(
            'id_permohonan_ambil' => $permohonan->id,
            'id_sub_ambil' => $sub,
            'id_sub_sub_ambil' => $subsub,
            'poin_diajukan' => $params->poin_diajukan,
            'poin_assesment' => 0,
            'assesment_by' => 0,
            'create_by' => $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'))
        );

        $insertambil = $this->bgbarumodel->insertambil($data);
        if ($insertambil) {
            $response = array(
                'code' => 1,
                'msg' => 'Poin Berhasil Diambil'
            );
        } else {
            $response = array(
                'code' => 0,
                'msg' => 'Poin Gagal Diambil'
            );
        }
        echo json_encode($response);
    }

    public function updateambil()
    {
        $params = (object) $this->input->post();
        $where = array('id' => $params->id_ambil);
        $data = array(
            'poin_assesment' => $params->poin,
            'assesment_by' => $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id')),
            'update_by' => $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id')),
            'update_date' => date('Y-m-d H:i:s')
        );

        $update = $this->bgbarumodel->updateambil($data, $where);

        if ($update) {
            $response = array(
                'code' => 1,
                'msg' => 'Berhasil'
            );
        } else {
            $response = array(
                'code' => 0,
                'msg' => 'Gagal'
            );
        }
        echo json_encode($response);
    }

    public function uploading()
    {
        $params = (object)$this->input->post();
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                $response = array(
                    'code' => 0,
                    'msg' => 'File upload failed with error code: ' . $file['error']
                );
                echo json_encode($response);
                exit;
            }

            $fileName = $file['name'];
            $fileTmpPath = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!in_array($fileExtension, ['pdf', 'xlx', 'xlsx', 'jpg', 'png'])) {
                $response = array(
                    'code' => 0,
                    'msg' => 'Ekstensi File Tidak Sesuai: ' . $file['error']
                );
                echo json_encode($response);
                exit;
            }

            if (!file_exists('assets/bgh/files/' . $params->id_permohonan . '/perencanaan/')) {
                mkdir('assets/bgh/files/' . $params->id_permohonan . '/perencanaan/', 0777, true);
            }

            // Move the uploaded file to the desired location
            $filename = uniqid() . '.' . $fileExtension;
            $destination = './assets/bgh/files/' . $params->id_permohonan . '/perencanaan/' . $filename;
            if (!move_uploaded_file($fileTmpPath, $destination)) {
                $response = array(
                    'code' => 0,
                    'msg' => 'Gagal Memindahkan File : ' . $file['error']
                );
                echo json_encode($response);
                exit;
            }

            if ($params->idfile != 0) {
                $wherefile = array('id' => $params->idfile);
                $getfile = $this->checklist_model->getfile($wherefile);
                if ($getfile->num_rows() > 0) {
                    $item = $getfile->row();
                    if (file_exists($item->path)) {
                        unlink($item->path);
                    }
                    $del = $this->checklist_model->deletefile(array('id' => $params->idfile));
                }
            }

            $data = array(
                'id_permohonan' => $params->id_permohonan,
                'id_sub' => $params->id_sub,
                'id_sub_sub' => $params->id_sub_sub,
                'id_dokumen' => $params->id_dokumen,
                'nama_file' => $filename,
                'path' => $destination,
                'extension' => $fileExtension,
                'create_by' => $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id')),
            );
            $saveupload = $this->bgbarumodel->savingupload($data);

            if ($saveupload) {
                $response = array(
                    'code' => 1,
                    'msg' => 'Upload File Berhasil',
                    'accord' => $params->head,
                    'elnow' => $params->elnow
                );
                echo json_encode($response);
            } else {
                $response = array(
                    'code' => 0,
                    'msg' => 'Gagal Menyimpan Data, Silahkan Coba Lagi Nanti'
                );
                echo json_encode($response);
            }
        } else {
            $response = array(
                'code' => 0,
                'msg' => 'Tidak Ada File yang diUpload'
            );
            echo json_encode($response);
        }
    }

    public function updatefile()
    {
        $params = (object)$this->input->post();

        $where = array('id' => $params->id_file);
        $data = array(
            'sesuai' => $params->sesuai,
            'catatan' => ""
        );

        $update = $this->bgbarumodel->updatefile($data, $where);
        if ($update) {
            $response = array(
                'code' => 1,
                'msg' => 'Berhasil'
            );
        } else {
            $response = array(
                'code' => 0,
                'msg' => 'Berhasil'
            );
        }
        echo json_encode($response);
    }

    public function savecatatan()
    {
        $params = (object)$this->input->post();

        $where = array('id' => $params->id_file);
        $data = array('catatan' => $params->catatan);

        $update = $this->bgbarumodel->updatefile($data, $where);
        if ($update) {
            $response = array(
                'code' => 1,
                'msg' => 'Berhasil'
            );
        } else {
            $response = array(
                'code' => 0,
                'msg' => 'Berhasil'
            );
        }
        echo json_encode($response);
    }

    public function selesaiassesment()
    {
        $params = (object) $this->input->post();

        $where = array(
            'id' => $params->id_permohonan
        );

        $data = array(
            'poin_assesment' => $params->poinassesment,
            'presentase_assesment' => $params->presentase,
            'status' => $params->status
        );

        $update = $this->bgbarumodel->updatepermohonan($data, $where);

        if ($update > 0) {
            $response = array(
                'code' => 1,
                'msg' => "Berhasil"
            );
        } else {
            $response = array(
                'code' => 0,
                'msg' => "Gagal"
            );
        }

        echo json_encode($response);
    }

    public function verifikasiassesment()
    {
        $params = (object) $this->input->post();

        $where = array(
            'id' => $params->id_permohonan
        );

        $data = array(
            'status' => $params->status
        );

        $update = $this->bgbarumodel->updatepermohonan($data, $where);

        if ($update > 0) {
            $response = array(
                'code' => 1,
                'msg' => "Berhasil"
            );
        } else {
            $response = array(
                'code' => 0,
                'msg' => "Gagal"
            );
        }

        echo json_encode($response);
    }

    public function viewPdf()
    {
        $pdfFile = base_url() . 'assets/bgh/files/27/perencanaan/649c086d3634c.pdf';
        $data['pdfFile'] = $pdfFile;

        $this->load->view('pdf_modal', $data);
    }

    public function gettpa()
    {
        $id_provinsi = $this->input->post('id_provinsi');
        $id_kabkota = $this->input->post('id_kabkota');

        $where = array(
            'id_kabkot' => $id_kabkota,
            'status' => 5
        );

        $get = $this->bgbarumodel->gettpa($where);

        if (empty($get)) {
            $where = array(
                'id_provinsi' => $id_provinsi,
                'status' => 5
            );
            $getprov = $this->bgbarumodel->gettpa($where);
            $response = array(
                'code' => 1,
                'data' => $getprov->result()
            );
        } else {
            $response = array(
                'code' => 1,
                'data' => $get->result()
            );
        }

        echo json_encode($response);
    }

    public function penugasantpa()
    {
        $pilihantpa = $this->input->post('pilihantpa');
        $id_permohonan = $this->input->post('id_permohonan');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');

        $tpa = json_encode($pilihantpa);

        $data = array(
            'id_tpa' => $tpa,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai
        );
        $where = array(
            'id' => $id_permohonan
        );

        $penugasan = $this->bgbarumodel->updatepermohonan($data, $where);

        if ($penugasan > 0) {
            $response = array(
                'code' => 1,
                'msg' => "Berhasil"
            );
        } else {
            $response = array(
                'code' => 0,
                'msg' => "Gagal"
            );
        }

        echo json_encode($response);
    }

    public function getkabkot()
    {
        $id_prov = $this->input->post('id_provinsi');
        $get = $this->db->get_where('tr_kabkot', array('id_provinsi' => $id_prov))->result();
        $response = array(
            'code' => 1,
            'data' => $get
        );
        echo json_encode($response);
    }

    public function getkecamatan()
    {
        $id_kabkot = $this->input->post('id_kabkot');
        $get = $this->db->get_where('tr_kecamatan', array('id_kabkot' => $id_kabkot))->result();
        $response = array(
            'code' => 1,
            'data' => $get
        );
        echo json_encode($response);
    }

    public function getkelurahan()
    {
        $id_kecamatan = $this->input->post('id_kecamatan');
        $get = $this->db->get_where('tr_kelurahan', array('id_kecamatan' => $id_kecamatan))->result();
        $response = array(
            'code' => 1,
            'data' => $get
        );
        echo json_encode($response);
    }
}
