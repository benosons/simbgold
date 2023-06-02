<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('Pengajuan_model');
    }

    public function bangunanbaru($kode = null)
    {
        if ($kode != null) {
            $data = array('page' => 'bangunanbaru', 'kode' => $kode);
        } else {
            $data = array('page' => 'bangunanbaru');
        }
        $list = $this->Pengajuan_model->get()->result();
        $data['list'] = $list;
        $data['page_content'] = $this->load->view('listbghbangunanbaru', $data, TRUE);

        $this->load->view('layout', $data);
    }
    public function h2m($kode = null)
    {
        if ($kode != null) {
            $data = array('page' => 'h2m', 'kode' => $kode);
        } else {
            $data = array('page' => 'h2m');
        }
        $list = $this->Pengajuan_model->get()->result();
        $data['list'] = $list;
        $data['page_content'] = $this->load->view('permohonanh2m', $data, TRUE);
        $this->load->view('layout', $data);
    }
    public function kawasanhijau($kode = null)
    {
        if ($kode != null) {
            $data = array('page' => 'kawasanhijau', 'kode' => $kode);
        } else {
            $data = array('page' => 'kawasanhijau');
        }
        $list = $this->Pengajuan_model->get()->result();
        $data['list'] = $list;
        $data['page_content'] = $this->load->view('permohonankawasanhijau', $data, TRUE);
        
        $this->load->view('layout', $data);
    }

    public function detailbgh($kode)
    {
        $permohonan = $this->db->get_where('t_permohonan_bgh', array('kode_bgh' => $kode))->row();
        $file = $this->db->get_where('t_data_file', array('id_permohonan_bgh' => $permohonan->id))->result();
        if ($permohonan->kategori == "recommended") {
            $getsyarat = $this->db->get('t_syarat_bgh')->result();
            $data = array(
                'page' => 'bangunanbaru',
                'permohonan' => $permohonan,
                'file' => $file,
                'syarat' => $getsyarat,
            );
        } else {
            $filears = $this->db->get_where('t_data_file_ars', array('id_permohonan_bgh' => $permohonan->id))->result();
            $filestruktur = $this->db->get_where('t_data_file_struktur', array('id_permohonan_bgh' => $permohonan->id))->result();
            $filemep = $this->db->get_where('t_data_file_mep', array('id_permohonan_bgh' => $permohonan->id))->result();
            $getsyarat = $this->db->get('t_syarat_bgh')->result();
            $sarsitektur = $this->db->get('t_syarat_arsitektur')->result();
            $sstruktur = $this->db->get('t_syarat_struktur')->result();
            $smep = $this->db->get('t_syarat_mep')->result();
            $pemilik = $this->db->get_where('tmdatapemilik', array('id' => $permohonan->id_pemilik))->row();
            $klas = $this->db->get_where('t_klas_bangunan', array('id' => $permohonan->klas_bangunan))->row();
            $data = array(
                'page' => 'bangunanbaru',
                'permohonan' => $permohonan,
                'file' => $file,
                'filears' => $filears,
                'filestruktur' => $filestruktur,
                'filemep' => $filemep,
                'syarat' => $getsyarat,
                'sarsitektur' => $sarsitektur,
                'sstruktur' => $sstruktur,
                'smep' => $smep,
                'pemilik' => $pemilik,
                'klas' => $klas
            );
        }
        $data['page_content'] = $this->load->view('detailbgh', $data, TRUE);

        $this->load->view('layout', $data);
    }

    public function detailbghverifikator($kode)
    {
        $permohonan = $this->db->get_where('t_permohonan_bgh', array('kode_bgh' => $kode))->row();
        $file = $this->db->get_where('t_data_file', array('id_permohonan_bgh' => $permohonan->id))->result();
        $vfile = $this->db->get_where('t_data_file', array('verifikasi !=' => 2, 'id_permohonan_bgh' => $permohonan->id))->num_rows();
        if ($permohonan->kategori == "recommended") {
            $getsyarat = $this->db->get('t_syarat_bgh')->result();
            $data = array(
                'page' => 'bangunanbaru',
                'permohonan' => $permohonan,
                'file' => $file,
                'vfile' => $vfile,
                'syarat' => $getsyarat
            );
        } else {
            $filears = $this->db->get_where('t_data_file_ars', array('id_permohonan_bgh' => $permohonan->id))->result();
            $vfilears = $this->db->get_where('t_data_file_ars', array('verifikasi !=' => 2, 'id_permohonan_bgh' => $permohonan->id))->num_rows();
            $filestruktur = $this->db->get_where('t_data_file_struktur', array('id_permohonan_bgh' => $permohonan->id))->result();
            $vfilestruktur = $this->db->get_where('t_data_file_struktur', array('verifikasi !=' => 2, 'id_permohonan_bgh' => $permohonan->id))->num_rows();
            $filemep = $this->db->get_where('t_data_file_mep', array('id_permohonan_bgh' => $permohonan->id))->result();
            $vfilemep = $this->db->get_where('t_data_file_mep', array('verifikasi !=' => 2, 'id_permohonan_bgh' => $permohonan->id))->num_rows();
            $getsyarat = $this->db->get('t_syarat_bgh')->result();
            $sarsitektur = $this->db->get('t_syarat_arsitektur')->result();
            $sstruktur = $this->db->get('t_syarat_struktur')->result();
            $smep = $this->db->get('t_syarat_mep')->result();
            $pemilik = $this->db->get_where('tmdatapemilik', array('id' => $permohonan->id_pemilik))->row();
            $klas = $this->db->get_where('t_klas_bangunan', array('id' => $permohonan->klas_bangunan))->row();
            $data = array(
                'page' => 'bangunanbaru',
                'permohonan' => $permohonan,
                'file' => $file,
                'vfile' => $vfile,
                'filears' => $filears,
                'vfilears' => $vfilears,
                'filestruktur' => $filestruktur,
                'vfilestruktur' => $vfilestruktur,
                'filemep' => $filemep,
                'vfilemep' => $vfilemep,
                'syarat' => $getsyarat,
                'sarsitektur' => $sarsitektur,
                'sstruktur' => $sstruktur,
                'smep' => $smep,
                'pemilik' => $pemilik,
                'klas' => $klas
            );
        }
        $data['page_content'] = $this->load->view('detail', $data, TRUE);

        $this->load->view('layout', $data);
    }

    public function mandatorybghbaru($kode = NULL)
    {
        $this->load->model('Syarat_bgh');
        $syarat = $this->Syarat_bgh->get()->result();
        $arsitektur = $this->db->get('t_syarat_arsitektur')->result();
        $struktur = $this->db->get('t_syarat_struktur')->result();
        $mep = $this->db->get('t_syarat_mep')->result();
        $provinsi = $this->db->get('tr_provinsi')->result();
        $klas = $this->db->get('t_klas_bangunan')->result();
        $data = array(
            'page' => 'bangunanbaru',
            'syarat' => $syarat,
            'arsitektur' => $arsitektur,
            'struktur' => $struktur,
            'mep' => $mep,
            'provinsi' => $provinsi,
            'klas' => $klas
        );
        if ($kode != NULL) {
            $permohonan = $this->Pengajuan_model->get(array('t_permohonan_bgh.kode_bgh' => $kode))->row();
            $data['pengajuan'] = $permohonan;
            $file_bgh = $this->Pengajuan_model->getfilebgh(['id_permohonan_bgh' => $permohonan->id])->result();
            $data['file_bgh'] = $file_bgh;
            $file_arsitektur = $this->Pengajuan_model->getfilearsitektur(['id_permohonan_bgh' => $permohonan->id])->result();
            $data['file_arsitektur'] = $file_arsitektur;
            $file_struktur = $this->Pengajuan_model->getfilestruktur(['id_permohonan_bgh' => $permohonan->id])->result();
            $data['file_struktur'] = $file_struktur;
            $file_mep = $this->Pengajuan_model->getfilemep(['id_permohonan_bgh' => $permohonan->id])->result();
            $data['file_mep'] = $file_mep;
        }
        $data['page_content'] = $this->load->view('mandatorybghbaru', $data, TRUE);

        $this->load->view('layout', $data);
    }

    public function recommendedbghbaru()
    {
        $this->load->model('Syarat_bgh');
        $syarat = $this->Syarat_bgh->get()->result();
        $data = array('page' => 'bangunanbaru', 'syarat' => $syarat);
        $data['page_content'] = $this->load->view('recommendedbghbaru', $data, TRUE);
        $this->load->view('layout', $data);
    }

    public function permohonanbgh()
    {
        $data = array(
            'page' => 'bangunanbaru',
            'kode' => 'PBG-1234-5678'
        );
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('pengajuanmandatory', $data);
        $this->load->view('includes/footer', $data);
    }

    public function uploadsuccess()
    {
        $data = array(
            'page' => 'bangunanbaru',
            'kode' => 'PBG-1234-5678'
        );
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('uploadsuccess', $data);
        $this->load->view('includes/footer', $data);
    }

    public function peringkatbgh()
    {
        $data = array(
            'page' => 'bangunanbaru',
            'kode' => 'PBG-1234-5678'
        );
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('peringkatbgh', $data);
        $this->load->view('includes/footer', $data);
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

    public function pengajuanmandatory()
    {
        $params = (object) $this->input->post();

        $datapemilik = array(
            'user_id' => $this->session->userdata('loc_user_id'),
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
            $pemilik = $this->Pengajuan_model->insertdatapemilik($datapemilik);
        }else{
            $pemilik = $this->Pengajuan_model->updatedatapemilik($datapemilik, ['id' => $params->id_pemilik]);
        }

        $rand1 = rand(0, 9999);
        $rand2 = rand(0, 9999);
        $kodebgh = 'BGH-' . $rand1 . '-' . $rand2;
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

        if ($params->id_permohonan == 0) {
            $id_permohonan = $this->Pengajuan_model->insertpermohonan($databangunan);
        }else{
            $id_permohonan = $this->Pengajuan_model->updatepermohonan($databangunan, ['id' => $params->id_permohonan]);
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

    public function updatestep()
    {
        $id_permohonan = $this->input->post('id_permohonan');
        $step = $this->input->post('step');

        $where = array('id' => $id_permohonan);
        $data = array('step' => $step);

        if ($step == 4) {
            $updatepermohonan = $this->Pengajuan_model->updatepermohonan(['status'=>1], ['id'=>$id_permohonan]);
        }
        
        $update = $this->Pengajuan_model->updatestep($data, $where);
        
        if ($update) {
            $response = array(
                'code' => 1,
                'msg' => 'berhasil'
            );
        }else{
            $response = array(
                'code' => 0,
                'msg' => 'gagal'
            );
        }

        echo json_encode($response);
    }

    public function saveformdokbgh()
    {
        $id_permohonan = $this->input->post('idpermohonan');
        if (!file_exists('assets/bgh/files/' . $id_permohonan)) {
            mkdir('assets/bgh/files/' . $id_permohonan, 0777, true);
        }
        if (!file_exists('assets/bgh/files/' . $id_permohonan . '/dokbgh')) {
            mkdir('assets/bgh/files/' . $id_permohonan . '/dokbgh', 0777, true);
        }

        $config['upload_path'] = './assets/bgh/files/' . $id_permohonan . '/dokbgh/';
        $config['allowed_types'] = 'pdf|xlsx';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        $jumlah_berkas = count($_FILES['dokbgh']['name']);
        $response = array();
        for ($i = 0; $i < $jumlah_berkas; $i++) {
            if (!empty($_FILES['dokbgh']['name'][$i])) {

                $_FILES['file']['name'] = $_FILES['dokbgh']['name'][$i];
                $_FILES['file']['type'] = $_FILES['dokbgh']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['dokbgh']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['dokbgh']['error'][$i];
                $_FILES['file']['size'] = $_FILES['dokbgh']['size'][$i];

                if ($i == 0 && $_FILES['file']['type'] != "application/pdf") {
                    $response = array('code' => 0, 'msg' => 'Perhatikan Ekstensi File Anda' . $_FILES['file']['type']);
                    break;
                } else if ($i > 0 && $_FILES['file']['type'] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
                    $response = array('code' => 0, 'msg' => 'Perhatikan Ekstensi File Anda' . $_FILES['file']['type']);
                    break;
                } else {
                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $name = $uploadData['file_name'];
                        $data2 = array(
                            'id_permohonan_bgh' => $id_permohonan,
                            'id_syarat_bgh' => ($i + 1),
                            'file' => $name,
                            'verifikasi' => 0,
                            'update_date' => date('Y-m-d H:i:s')
                        );
                        $insert = $this->Pengajuan_model->insertdokbgh($data2);
                    } else {
                        echo $this->upload->display_errors();
                    }
                }
            }
        }
        if (!empty($response)) {
            $updatestep = $this->Pengajuan_model->updatestep(['step' => 1], ['id' => $id_permohonan]);
            echo json_encode($response);
        } else {
            echo json_encode(array('code' => 1, 'permohonan' => $id_permohonan));
        }
    }

    public function savedokbgh()
    {
        $params = (object)$this->input->post();

        if (!file_exists('assets/bgh/files/' . $params->id_permohonan)) {
            mkdir('assets/bgh/files/' . $params->id_permohonan, 0777, true);
        }
        if (!file_exists('assets/bgh/files/' . $params->id_permohonan . '/dokbgh')) {
            mkdir('assets/bgh/files/' . $params->id_permohonan . '/dokbgh', 0777, true);
        }

        $config['upload_path'] = './assets/bgh/files/' . $params->id_permohonan . '/dokbgh/';
        $config['allowed_types'] = 'pdf|xlsx';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $get = $this->Pengajuan_model->getfilebgh(['id_permohonan_bgh' => $params->id_permohonan, 'id_syarat_bgh' => $params->id_syarat_bgh]);
            if ($get->num_rows() > 0) {
                $filebgh = $get->row();
                unlink('assets/bgh/files/'.$params->id_permohonan.'/dokbgh/'.$filebgh->file);
                $delete = $this->Pengajuan_model->deletefilebgh(['id_permohonan_bgh' => $params->id_permohonan, 'id_syarat_bgh' => $params->id_syarat_bgh]);
            }
            $uploadData = $this->upload->data();
            $name = $uploadData['file_name'];
            $data2 = array(
                'id_permohonan_bgh' => $params->id_permohonan,
                'id_syarat_bgh' => $params->id_syarat_bgh,
                'file' => $name,
                'verifikasi' => 0,
                'update_date' => date('Y-m-d H:i:s'),
                'nilai' => $params->nilai
            );
            $insert = $this->Pengajuan_model->insertdokbgh($data2);

            if ($insert) {
                $response = array(
                    'code' => 1,
                    'msg' => 'Berhasi;'
                );
            }
        } else {
            $response = array(
                'code' => 1,
                'msg' => $this->upload->display_errors()
            );
        }

        echo json_encode($response);
    }

    public function savedokars()
    {
        $params = (object)$this->input->post();

        if (!file_exists('assets/bgh/files/' . $params->id_permohonan)) {
            mkdir('assets/bgh/files/' . $params->id_permohonan, 0777, true);
        }
        if (!file_exists('assets/bgh/files/' . $params->id_permohonan . '/dokars')) {
            mkdir('assets/bgh/files/' . $params->id_permohonan . '/dokars', 0777, true);
        }

        $config['upload_path'] = './assets/bgh/files/' . $params->id_permohonan . '/dokars/';
        $config['allowed_types'] = 'pdf';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $get = $this->Pengajuan_model->getfilearsitektur(['id_permohonan_bgh' => $params->id_permohonan, 'id_syarat_bgh' => $params->id_syarat_bgh]);
            if ($get->num_rows() > 0) {
                $filebgh = $get->row();
                unlink('assets/bgh/files/'.$params->id_permohonan.'/dokars/'.$filebgh->file);
                $delete = $this->Pengajuan_model->deletefilears(['id_permohonan_bgh' => $params->id_permohonan, 'id_syarat_bgh' => $params->id_syarat_bgh]);
            }
            $uploadData = $this->upload->data();
            $name = $uploadData['file_name'];
            $data2 = array(
                'id_permohonan_bgh' => $params->id_permohonan,
                'id_syarat_bgh' => $params->id_syarat_bgh,
                'file' => $name,
                'verifikasi' => 0,
                'update_date' => date('Y-m-d H:i:s')
            );
            $insert = $this->Pengajuan_model->insertdokars($data2);

            if ($insert) {
                $response = array(
                    'code' => 1,
                    'msg' => 'Berhasil'
                );
            }
        } else {
            $response = array(
                'code' => 1,
                'msg' => $this->upload->display_errors()
            );
        }

        echo json_encode($response);
    }

    public function savedokstruktur()
    {
        $params = (object)$this->input->post();

        if (!file_exists('assets/bgh/files/' . $params->id_permohonan)) {
            mkdir('assets/bgh/files/' . $params->id_permohonan, 0777, true);
        }
        if (!file_exists('assets/bgh/files/' . $params->id_permohonan . '/dokstruktur')) {
            mkdir('assets/bgh/files/' . $params->id_permohonan . '/dokstruktur', 0777, true);
        }

        $config['upload_path'] = './assets/bgh/files/' . $params->id_permohonan . '/dokstruktur/';
        $config['allowed_types'] = 'pdf';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $get = $this->Pengajuan_model->getfilestruktur(['id_permohonan_bgh' => $params->id_permohonan, 'id_syarat_bgh' => $params->id_syarat_bgh]);
            if ($get->num_rows() > 0) {
                $filebgh = $get->row();
                unlink('assets/bgh/files/'.$params->id_permohonan.'/dokstruktur/'.$filebgh->file);
                $delete = $this->Pengajuan_model->deletefilestruktur(['id_permohonan_bgh' => $params->id_permohonan, 'id_syarat_bgh' => $params->id_syarat_bgh]);
            }
            $uploadData = $this->upload->data();
            $name = $uploadData['file_name'];
            $data2 = array(
                'id_permohonan_bgh' => $params->id_permohonan,
                'id_syarat_bgh' => $params->id_syarat_bgh,
                'file' => $name,
                'verifikasi' => 0,
                'update_date' => date('Y-m-d H:i:s')
            );
            $insert = $this->Pengajuan_model->insertdokstruktur($data2);

            if ($insert) {
                $response = array(
                    'code' => 1,
                    'msg' => 'Berhasil'
                );
            }
        } else {
            $response = array(
                'code' => 1,
                'msg' => $this->upload->display_errors()
            );
        }

        echo json_encode($response);
    }

    public function savedokmep()
    {
        $params = (object)$this->input->post();

        if (!file_exists('assets/bgh/files/' . $params->id_permohonan)) {
            mkdir('assets/bgh/files/' . $params->id_permohonan, 0777, true);
        }
        if (!file_exists('assets/bgh/files/' . $params->id_permohonan . '/dokmep')) {
            mkdir('assets/bgh/files/' . $params->id_permohonan . '/dokmep', 0777, true);
        }

        $config['upload_path'] = './assets/bgh/files/' . $params->id_permohonan . '/dokmep/';
        $config['allowed_types'] = 'pdf';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $get = $this->Pengajuan_model->getfilemep(['id_permohonan_bgh' => $params->id_permohonan, 'id_syarat_bgh' => $params->id_syarat_bgh]);
            if ($get->num_rows() > 0) {
                $filebgh = $get->row();
                unlink('assets/bgh/files/'.$params->id_permohonan.'/dokmep/'.$filebgh->file);
                $delete = $this->Pengajuan_model->deletefilemep(['id_permohonan_bgh' => $params->id_permohonan, 'id_syarat_bgh' => $params->id_syarat_bgh]);
            }
            $uploadData = $this->upload->data();
            $name = $uploadData['file_name'];
            $data2 = array(
                'id_permohonan_bgh' => $params->id_permohonan,
                'id_syarat_bgh' => $params->id_syarat_bgh,
                'file' => $name,
                'verifikasi' => 0,
                'update_date' => date('Y-m-d H:i:s')
            );
            $insert = $this->Pengajuan_model->insertdokmep($data2);

            if ($insert) {
                $response = array(
                    'code' => 1,
                    'msg' => 'Berhasil'
                );
            }
        } else {
            $response = array(
                'code' => 1,
                'msg' => $this->upload->display_errors()
            );
        }

        echo json_encode($response);
    }

    public function savepengajuan()
    {
        $permohonan = $this->input->post('kodepbg');
        $kategori = $this->input->post('kategori');
        if ($permohonan == "") {
            $permohonan = '-';
        }
        $rand1 = rand(0, 9999);
        $rand2 = rand(0, 9999);
        $data1 = array(
            'kode_bgh' => 'BGH-' . $rand1 . '-' . $rand2,
            'kode_pbg' => $permohonan,
            'kategori' => $kategori,
            'status' => 1
        );
        $this->db->insert('t_permohonan_bgh', $data1);
        $insert_id = $this->db->insert_id();
        $insert_id = $this->input->post('idpermohonan');
        if (!file_exists('assets/bgh/files/' . $insert_id)) {
            mkdir('assets/bgh/files/' . $insert_id, 0777, true);
        }
        if (!file_exists('assets/bgh/files/' . $insert_id . '/dokbgh')) {
            mkdir('assets/bgh/files/' . $insert_id . '/dokbgh', 0777, true);
        }

        $config['upload_path'] = './assets/bgh/files/' . $insert_id . '/dokbgh/';
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        $jumlah_berkas = count($_FILES['dokbgh']['name']);
        $response = array();
        for ($i = 0; $i < $jumlah_berkas; $i++) {
            if (!empty($_FILES['dokbgh']['name'][$i])) {

                $_FILES['file']['name'] = $_FILES['dokbgh']['name'][$i];
                $_FILES['file']['type'] = $_FILES['dokbgh']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['dokbgh']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['dokbgh']['error'][$i];
                $_FILES['file']['size'] = $_FILES['dokbgh']['size'][$i];

                if ($i == 0 && $_FILES['file']['type'] != "pdf") {
                    $response = array('code' => 0, 'msg' => 'Perhatikan Ekstensi File Anda');
                    break;
                } else if ($i > 0 && $_FILES['file']['type'] != "xlxs") {
                    $response = array('code' => 0, 'msg' => 'Perhatikan Ekstensi File Anda');
                    break;
                } else {
                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $name = $uploadData['file_name'];
                        $data2 = array(
                            'id_permohonan_bgh' => $insert_id,
                            'id_syarat_bgh' => ($i + 1),
                            'file' => $name,
                            'verifikasi' => 0,
                            'update_date' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('t_data_file', $data2);
                    } else {
                        echo $this->upload->display_errors();
                    }
                }
            }
        }
        if (!empty($response)) {
            echo json_encode($response);
        } else {
            echo json_encode(array('code' => 1, 'permohonan' => $insert_id));
        }
    }

    public function savearsitektur()
    {
        $permohonan = $this->input->post('idpermohonan');
        if (!file_exists('assets/bgh/files/' . $permohonan)) {
            mkdir('assets/bgh/files/' . $permohonan, 0777, true);
        }
        if (!file_exists('assets/bgh/files/' . $permohonan . '/dokarsitektur')) {
            mkdir('assets/bgh/files/' . $permohonan . '/dokarsitektur', 0777, true);
        }

        $config['upload_path'] = './assets/bgh/files/' . $permohonan . '/dokarsitektur/';
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        $jumlah_berkas = count($_FILES['dokars']['name']);
        for ($i = 0; $i < $jumlah_berkas; $i++) {
            if (!empty($_FILES['dokars']['name'][$i])) {

                $_FILES['file']['name'] = $_FILES['dokars']['name'][$i];
                $_FILES['file']['type'] = $_FILES['dokars']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['dokars']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['dokars']['error'][$i];
                $_FILES['file']['size'] = $_FILES['dokars']['size'][$i];

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $name = $uploadData['file_name'];
                    $data2 = array(
                        'id_permohonan_bgh' => $permohonan,
                        'id_syarat_bgh' => ($i + 1),
                        'file' => $name,
                        'verifikasi' => 0,
                        'update_date' => date('Y-m-d H:i:s')
                    );
                    $insert = $this->Pengajuan_model->insertdokars($data2);
                } else {
                    echo $this->upload->display_errors();
                }
            }
        }
        $this->db->where(array('id' => $id_permohonan));
        $this->db->update('t_permohonan_bgh', ['step' => 2]);
        echo json_encode(array('code' => 1));
    }

    public function savestruktur()
    {
        $permohonan = $this->input->post('idpermohonan');
        if (!file_exists('assets/bgh/files/' . $permohonan)) {
            mkdir('assets/bgh/files/' . $permohonan, 0777, true);
        }
        if (!file_exists('assets/bgh/files/' . $permohonan . '/dokstruktur')) {
            mkdir('assets/bgh/files/' . $permohonan . '/dokstruktur', 0777, true);
        }

        $config['upload_path'] = './assets/bgh/files/' . $permohonan . '/dokstruktur/';
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        $jumlah_berkas = count($_FILES['dokstruk']['name']);
        for ($i = 0; $i < $jumlah_berkas; $i++) {
            if (!empty($_FILES['dokstruk']['name'][$i])) {

                $_FILES['file']['name'] = $_FILES['dokstruk']['name'][$i];
                $_FILES['file']['type'] = $_FILES['dokstruk']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['dokstruk']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['dokstruk']['error'][$i];
                $_FILES['file']['size'] = $_FILES['dokstruk']['size'][$i];

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $name = $uploadData['file_name'];
                    $data2 = array(
                        'id_permohonan_bgh' => $permohonan,
                        'id_syarat_bgh' => ($i + 1),
                        'file' => $name,
                        'verifikasi' => 0,
                        'update_date' => date('Y-m-d H:i:s')
                    );
                    $insert = $this->Pengajuan_model->insertstruktur($data2);
                } else {
                    echo $this->upload->display_errors();
                }
            }
        }
        $this->db->where(array('id' => $id_permohonan));
        $this->db->update('t_permohonan_bgh', ['step' => 3]);
        echo json_encode(array('code' => 1));
    }
    public function savemep()
    {
        $permohonan = $this->input->post('idpermohonan');
        if (!file_exists('assets/bgh/files/' . $permohonan)) {
            mkdir('assets/bgh/files/' . $permohonan, 0777, true);
        }
        if (!file_exists('assets/bgh/files/' . $permohonan . '/dokmep')) {
            mkdir('assets/bgh/files/' . $permohonan . '/dokmep', 0777, true);
        }

        $config['upload_path'] = './assets/bgh/files/' . $permohonan . '/dokmep/';
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        $jumlah_berkas = count($_FILES['dokmep']['name']);
        for ($i = 0; $i < $jumlah_berkas; $i++) {
            if (!empty($_FILES['dokmep']['name'][$i])) {

                $_FILES['file']['name'] = $_FILES['dokmep']['name'][$i];
                $_FILES['file']['type'] = $_FILES['dokmep']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['dokmep']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['dokmep']['error'][$i];
                $_FILES['file']['size'] = $_FILES['dokmep']['size'][$i];

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $name = $uploadData['file_name'];
                    $data2 = array(
                        'id_permohonan_bgh' => $permohonan,
                        'id_syarat_bgh' => ($i + 1),
                        'file' => $name,
                        'verifikasi' => 0,
                        'update_date' => date('Y-m-d H:i:s')
                    );
                    $insert = $this->Pengajuan_model->insertdokmep($data2);
                } else {
                    echo $this->upload->display_errors();
                }
            }
        }
        $this->db->where(array('id' => $id_permohonan));
        $this->db->update('t_permohonan_bgh', ['step' => 4, 'status' => 1]);
        echo json_encode(array('code' => 1));
    }

    public function editpermohonan()
    {
        $kategori = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        $id_permohonan = $this->uri->segment(5);
        $kode_bgh = $this->uri->segment(6);
        if ($kategori == 1) {
            $folder = 'dokbgh';
        } else if ($kategori == 2) {
            $folder = 'dokarsitektur';
        } else if ($kategori == 3) {
            $folder = 'dokstruktur';
        } else if ($kategori == 4) {
            $folder = 'dokmep';
        }


        $config['upload_path'] = './assets/bgh/files/' . $id_permohonan . '/' . $folder . '/';
        $config['allowed_types'] = 'pdf|xlsx';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        $where = array('id' => $id);
        if ($kategori == 1) {
            $get = $this->db->get_where('t_data_file', $where)->row();
        } else if ($kategori == 2) {
            $get = $this->db->get_where('t_data_file_ars', $where)->row();
        } else if ($kategori == 3) {
            $get = $this->db->get_where('t_data_file_struktur', $where)->row();
        } else if ($kategori == 4) {
            $get = $this->db->get_where('t_data_file_mep', $where)->row();
        }

        if (file_exists('assets/images/' . $get->file)) {
            unlink('assets/images/' . $get->file);
        }

        if (!$this->upload->do_upload('file-edit')) {
            $response = array(
                'code' => 0,
                'msg' => $this->upload->display_errors()
            );
        } else {
            $upload = $this->upload->data();
            $namafile = $upload['file_name'];
            $data = array(
                'file' => $namafile,
                'update_date' => date('Y-m-d H:i:s'),
                'new' => 1
            );
            $this->db->where($where);
            if ($kategori == 1) {
                $update = $this->db->update('t_data_file', $data);
                $k = "home";
            } else if ($kategori == 2) {
                $update = $this->db->update('t_data_file_ars', $data);
                $k = "arsitektur";
            } else if ($kategori == 3) {
                $update = $this->db->update('t_data_file_struktur', $data);
                $k = "struktur";
            } else if ($kategori == 4) {
                $update = $this->db->update('t_data_file_mep', $data);
                $k = "mep";
            }

            if ($update) {
                if ($kategori == 1) {
                    $this->db->select('t_data_file.*, t_syarat_bgh.nama');
                    $this->db->from('t_data_file');
                    $this->db->join('t_syarat_bgh', 't_syarat_bgh.id = t_data_file.id_syarat_bgh', 'LEFT');
                    $get = $this->db->get()->row();
                } else if ($kategori == 2) {
                    $this->db->select('t_data_file_ars.*, t_syarat_arsitektur.nama');
                    $this->db->from('t_data_file_ars');
                    $this->db->join('t_syarat_arsitektur', 't_syarat_arsitektur.id = t_data_file_ars.id_syarat_bgh', 'LEFT');
                    $get = $this->db->get()->row();
                } else if ($kategori == 3) {
                    $this->db->select('t_data_file_struktur.*, t_syarat_struktur.nama');
                    $this->db->from('t_data_file_struktur');
                    $this->db->join('t_syarat_struktur', 't_syarat_struktur.id = t_data_file_struktur.id_syarat_bgh', 'LEFT');
                    $get = $this->db->get()->row();
                } else if ($kategori == 4) {
                    $this->db->select('t_data_file_mep.*, t_syarat_mep.nama');
                    $this->db->from('t_data_file_mep');
                    $this->db->join('t_syarat_mep', 't_syarat_mep.id = t_data_file_mep.id_syarat_bgh', 'LEFT');
                    $get = $this->db->get()->row();
                }
                $notif = array(
                    'jenis_notif' => 1,
                    'nama_jenis_notif' => 'Perbaikan Dokumen',
                    'kode_bgh' => $kode_bgh,
                    'tab_dok' => $k,
                    'label_dokumen' => $get->nama,
                    'sentto' => 'penilai',
                    'url' => 'verifikator/pengajuan/detailbgh/' . $kode_bgh . '?k=' . $k
                );
                $ins = $this->db->insert('t_notif', $notif);
                $response = array(
                    'code' => 1,
                    'msg' => 'Edit Data Berhasil !',
                    'url' => $kode_bgh . '?k=' . $k
                );
            }
        }

        echo json_encode($response);
    }

    public function update_status_notif()
    {
        $id = $this->input->post('id');
        $data = array('status' => 1);
        $this->db->where('id', $id);
        $update = $this->db->update('t_notif', $data);
        if ($update) {
            $res = array('msg' => 'Berhasil');
        } else {
            $res = array('msg' => 'Gagal !');
        }

        echo json_encode($res);
    }

    public function revisidokumen()
    {
        $kategori = $this->uri->segment(4);
        $id = $this->uri->segment(5);
        $id_permohonan = $this->uri->segment(6);
        $kode_bgh = $this->uri->segment(7);
        $dat = array('status' => 2);
        $this->db->where('id', $id_permohonan);
        $edits = $this->db->update('t_permohonan_bgh', $dat);

        $catatan = $this->input->post('catatan');

        $data = array('catatan' => $catatan, 'verifikasi' => 1, 'date_catatan' => date('Y-m-d H:i:s'), 'new' => 0);
        $where = array('id' => $id);
        $this->db->where($where);
        if ($kategori == 1) {
            $edit = $this->db->update('t_data_file', $data);
            $k = "home";
        } else if ($kategori == 2) {
            $edit = $this->db->update('t_data_file_ars', $data);
            $k = "arsitektur";
        } else if ($kategori == 3) {
            $edit = $this->db->update('t_data_file_struktur', $data);
            $k = "struktur";
        } else if ($kategori == 4) {
            $edit = $this->db->update('t_data_file_mep', $data);
            $k = "mep";
        }

        if ($edit) {
            if ($kategori == 1) {
                $this->db->select('t_data_file.*, t_syarat_bgh.nama');
                $this->db->from('t_data_file');
                $this->db->join('t_syarat_bgh', 't_syarat_bgh.id = t_data_file.id_syarat_bgh', 'LEFT');
                $get = $this->db->get()->row();
            } else if ($kategori == 2) {
                $this->db->select('t_data_file_ars.*, t_syarat_arsitektur.nama');
                $this->db->from('t_data_file_ars');
                $this->db->join('t_syarat_arsitektur', 't_syarat_arsitektur.id = t_data_file_ars.id_syarat_bgh', 'LEFT');
                $get = $this->db->get()->row();
            } else if ($kategori == 3) {
                $this->db->select('t_data_file_struktur.*, t_syarat_struktur.nama');
                $this->db->from('t_data_file_struktur');
                $this->db->join('t_syarat_struktur', 't_syarat_struktur.id = t_data_file_struktur.id_syarat_bgh', 'LEFT');
                $get = $this->db->get()->row();
            } else if ($kategori == 4) {
                $this->db->select('t_data_file_mep.*, t_syarat_mep.nama');
                $this->db->from('t_data_file_mep');
                $this->db->join('t_syarat_mep', 't_syarat_mep.id = t_data_file_mep.id_syarat_bgh', 'LEFT');
                $get = $this->db->get()->row();
            }
            $notif = array(
                'jenis_notif' => 1,
                'nama_jenis_notif' => 'Revisi Dokumen',
                'kode_bgh' => $kode_bgh,
                'tab_dok' => $k,
                'label_dokumen' => $get->nama,
                'sentto' => 'client',
                'url' => 'pengajuan/detailbgh/' . $kode_bgh . '?k=' . $k
            );
            $ins = $this->db->insert('t_notif', $notif);
            echo json_encode(array('code' => 1, 'url' => $kode_bgh . '?k=' . $k));
        } else {
            echo json_encode(array('code' => 0));
        }
    }

    public function verifikasidokumen()
    {
        $kategori = $this->uri->segment(4);
        $id = $this->uri->segment(5);
        $kode_bgh = $this->uri->segment(6);
        $verifikasi = $this->input->post('verifikasi');
        $where = array('id' => $id);
        $data = array('verifikasi' => $verifikasi, 'new' => 0);
        $this->db->where($where);
        if ($kategori == 1) {
            $edit = $this->db->update('t_data_file', $data);
            $k = 'home';
        } else if ($kategori == 2) {
            $edit = $this->db->update('t_data_file_ars', $data);
            $k = 'arsitektur';
        } else if ($kategori == 3) {
            $edit = $this->db->update('t_data_file_struktur', $data);
            $k = 'struktur';
        } else if ($kategori == 4) {
            $edit = $this->db->update('t_data_file_mep', $data);
            $k = 'mep';
        }

        if ($edit) {
            if ($kategori == 1) {
                $this->db->select('t_data_file.*, t_syarat_bgh.nama');
                $this->db->from('t_data_file');
                $this->db->join('t_syarat_bgh', 't_syarat_bgh.id = t_data_file.id_syarat_bgh', 'LEFT');
                $get = $this->db->get()->row();
            } else if ($kategori == 2) {
                $this->db->select('t_data_file_ars.*, t_syarat_arsitektur.nama');
                $this->db->from('t_data_file_ars');
                $this->db->join('t_syarat_arsitektur', 't_syarat_arsitektur.id = t_data_file_ars.id_syarat_bgh', 'LEFT');
                $get = $this->db->get()->row();
            } else if ($kategori == 3) {
                $this->db->select('t_data_file_struktur.*, t_syarat_struktur.nama');
                $this->db->from('t_data_file_struktur');
                $this->db->join('t_syarat_struktur', 't_syarat_struktur.id = t_data_file_struktur.id_syarat_bgh', 'LEFT');
                $get = $this->db->get()->row();
            } else if ($kategori == 4) {
                $this->db->select('t_data_file_mep.*, t_syarat_mep.nama');
                $this->db->from('t_data_file_mep');
                $this->db->join('t_syarat_mep', 't_syarat_mep.id = t_data_file_mep.id_syarat_bgh', 'LEFT');
                $get = $this->db->get()->row();
            }
            $notif = array(
                'jenis_notif' => 2,
                'nama_jenis_notif' => 'Verifikasi Dokumen',
                'kode_bgh' => $kode_bgh,
                'tab_dok' => $k,
                'label_dokumen' => $get->nama,
                'sentto' => 'client',
                'url' => 'pengajuan/detailbgh/' . $kode_bgh . '?k=' . $k
            );
            $ins = $this->db->insert('t_notif', $notif);
            $getbgh = $this->db->get_where('t_permohonan_bgh', array('kode_bgh' => $kode_bgh))->row();
            $checkstatus = $this->checkstatus($getbgh->id);
            if ($checkstatus == FALSE) {
                $this->db->where('id', $getbgh->id);
                $this->db->update('t_permohonan_bgh', array('status' => 1));
            }
            echo json_encode(array('code' => 1, 'url' => $kode_bgh . '?k=' . $k, 'stat' => $checkstatus));
        } else {
            echo json_encode(array('code' => 0));
        }
    }

    public function verifikasipermohonan()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $this->db->where('id', $id);
        $update = $this->db->update('t_permohonan_bgh', array('status' => $status));

        echo json_encode(array('code' => 1));
    }

    function checkstatus($id)
    {
        $revisi = false;

        $bgh = $this->db->get_where('t_data_file', array('id_permohonan_bgh' => $id, 'verifikasi' => 1))->num_rows();
        $ars = $this->db->get_where('t_data_file_ars', array('id_permohonan_bgh' => $id, 'verifikasi' => 1))->num_rows();
        $struktur = $this->db->get_where('t_data_file_struktur', array('id_permohonan_bgh' => $id, 'verifikasi' => 1))->num_rows();
        $mep = $this->db->get_where('t_data_file_mep', array('id_permohonan_bgh' => $id, 'verifikasi' => 1))->num_rows();

        if (($bgh > 0) || ($ars > 0) || ($struktur > 0) || ($mep > 0)) {
            $revisi = true;
        }

        return $revisi;
    }

    // H2M 
    public function kawasanhijau()
    {
        $list = $this->Pengajuan_model->geth2m()->result();
        $data['list'] = $list;
        $data['page_content'] = $this->load->view('listkawasan', $data, TRUE);

        $this->load->view('layout', $data);
    }

    public function formkawasanhijau()
    {
        $data['page_content'] = $this->load->view('formkawasan', $data, TRUE);

        $this->load->view('layout', $data);
    }

    // Kawasan hijau 
    public function h2m()
    {
        $list = $this->Pengajuan_model->geth2m()->result();
        $data['list'] = $list;
        $data['page_content'] = $this->load->view('listh2m', $data, TRUE);

        $this->load->view('layout', $data);
    }

    public function formh2m()
    {
        $data['page_content'] = $this->load->view('formh2m', $data, TRUE);

        $this->load->view('layout', $data);
    }

    function generatepdf()
    {
        $this->load->library('pdf');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_penjualan_toko_kita';
        // setting paper
        $paper = 'legal';
        //orientasi paper potrait / landscape
        $orientation = "landscape";
        $this->data['nomor_sertifikat'] = '12312312312312';
        $this->data['tanggal'] = '12312312312312';
        $this->data['nomor_induk_bangunan'] = '12312312312312';
        $this->data['milik'] = '12312312312312';
        $this->data['alamat'] = '12312312312312';
        $this->data['nama'] = '12312312312312';
        $this->data['nip'] = '12312312312312';
        
		$html = $this->load->view('sertif/sertifikat', $this->data, true);	    
        
        // run dompdf
        $this->pdf->generate($html, $file_pdf, $paper, $orientation);
    }

    public function sertifikat($kode = null)
    {
        $data['nomor_sertifikat'] = '12312312312312';
        $data['tanggal'] = '12312312312312';
        $data['nomor_induk_bangunan'] = '12312312312312';
        $data['milik'] = '12312312312312';
        $data['alamat'] = '12312312312312';
        $data['nama'] = '12312312312312';
        $data['nip'] = '12312312312312';
        $data['page_content'] = $this->load->view('sertif/sertifikat', $data , TRUE);

        $this->load->view('sertif/sertifikat', $data);
    }
}