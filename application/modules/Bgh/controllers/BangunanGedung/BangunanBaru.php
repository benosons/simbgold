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
        $session_login     = $this->session->userdata('loc_login');
        if ($session_login != TRUE) {
            redirect('Front');
        }
    }

    public function index()
    {
        $data['page'] = 'dashboard';
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
                'status' => 0,
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
            $id_permohonan = $this->bgbarumodel->updatepermohonan($databangunan, ['id' => $params->id_permohonan]);
        }

        if ($pemilik > 0 && $id_permohonan > 0) {
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
        foreach ($head as $h) {
            $x++;
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
                            $getambils = $this->checklist_model->getfile(array('id_permohonan' => $permohonan->id, 'id_sub_sub' => $ss->id))->num_rows();
                            if ($getambils > 0) {
                                $row3['ambil'] = 1;
                            }else{
                                $row3['ambil'] = 0;
                            }
                            $getdok = $this->checklist_model->getdok(array('id_sub_sub_dok' => $ss->id))->result();
                            if ((count($getdok) == $getambils) && (!empty($getdok))) {
                                $row3['poinambil'] = $ss->poin;
                                $row['poindiajukan'] += $ss->poin;
                            }else{
                                $row3['poinambil'] = 0;
                            }
                            $dok = array();
                            foreach ($getdok as $d) {
                                $row4 = array();
                                $row4['id'] = (!empty($d->id) ? $d->id : "");
                                $row4['nama'] = (!empty($d->nama) ? $d->nama : "");
                                $getfile = $this->checklist_model->getfile(array('id_dokumen'=>$d->id))->row();
                                if (!empty($getfile)) {
                                    $row4['isupload'] = 1;
                                }else{
                                    $row4['isupload'] = 0;
                                }

                                array_push($dok, $row4);
                            }
                            $row3['dok'] = $dok;

                            array_push($subsub, $row3);
                        }
                        $row2['subsub'] = $subsub;
                    } else {
                        $getambil = $this->checklist_model->getfile(array('id_permohonan' => $permohonan->id, 'id_sub' => $s->id))->num_rows();
                        if ($getambil > 0) {
                            $row2['ambil'] = 1;
                        }else{
                            $row2['ambil'] = 0;
                        }
                        $getdok = $this->checklist_model->getdok(array('id_sub_dok' => $s->id))->result();

                        if ((count($getdok) == $getambil) && (!empty($getdok))) {
                            $row2['poinambil'] = $s->poin;
                            $row['poindiajukan'] += $s->poin;
                        }else{
                            $row2['poinambil'] = 0;
                        }
                        $dok = array();
                        foreach ($getdok as $d) {
                            $row4 = array();
                            $row4['id'] = (!empty($d->id) ? $d->id : "");
                            $row4['nama'] = (!empty($d->nama) ? $d->nama : "");
                            $getfile = $this->checklist_model->getfile(array('id_permohonan'=> $permohonan->id,'id_dokumen'=>$d->id))->row();
                            if (!empty($getfile)) {
                                $row4['isupload'] = 1;
                            }else{
                                $row4['isupload'] = 0;
                            }
                            array_push($dok, $row4);
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
        // $data['head'] = ;
        $data['content'] = $this->load->view('bangunangedung/bangunanbaru/form', $data, TRUE);

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

            $data = array(
                'id_permohonan' => $params->id_permohonan,
                'id_sub' => $params->id_sub,
                'id_sub_sub' => $params->id_sub_sub,
                'id_dokumen' => $params->id_dokumen,
                'nama_file' => $filename,
                'path' => $destination,
                'create_by' => $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id')),
            );
            $saveupload = $this->bgbarumodel->savingupload($data);

            if ($saveupload) {
                $response = array(
                    'code' => 1,
                    'msg' => 'Upload File Berhasil'
                );
                echo json_encode($response);
            }else{
                $response = array(
                    'code' => 0,
                    'msg' => 'Gagal Menyimpan Data, Silahkan Coba Lagi Nanti'
                );
                echo json_encode($data);
            }
        } else {
            $response = array(
                'code' => 0,
                'msg' => 'Tidak Ada File yang diUpload'
            );
            echo json_encode($response);
        }
    }

    // public function coba()
    // {
    //     $permohonan = $this->bgbarumodel->get(array('t_permohonan_bgh.id' => 26))->row();
    //     echo $permohonan->id;
    //     $dok = $this->db->get_where('t_checklist_dokumen', array('id'=>5))->row();
    //     print_r($dok);
    //     $dataa = array(
    //         'id_permohonan' => 26,
    //         'id_sub' => 0,
    //         'id_sub_sub' => 1,
    //         'id_dokumen' => 5,
    //         'nama_file' => "43634634634.pdf",
    //         'path' => './assets/bgh/files/perencanaan/',
    //         'sesuai' => 0,
    //         'catatan' => "0",
    //         'poin_assesment' => 0,
    //         'assesment_by' => 0,
    //         'create_by' =>1,
    //     );
    //     echo $this->db->insert('t_checklist_file',$dataa);
    // }

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
