<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function bangunanbaru($kode = null)
    {
        if ($kode != null) {
            $data = array('page' => 'bangunanbaru', 'kode' => $kode);
        } else {
            $data = array('page' => 'bangunanbaru');
        }
        $this->db->select('t_permohonan_bgh.*, tmdatapemilik.nm_pemilik, tmdatapemilik.glr_depan, tmdatapemilik.glr_belakang, t_klas_bangunan.klas');
        $this->db->from('t_permohonan_bgh');
        $this->db->join('tmdatapemilik', 'tmdatapemilik.id = t_permohonan_bgh.id_pemilik', 'LEFT');
        $this->db->join('t_klas_bangunan', 't_permohonan_bgh.klas_bangunan = t_klas_bangunan.id', 'LEFT');
        $data['list'] = $this->db->get()->result();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/listbghbangunanbaru', $data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function detailbgh($kode)
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
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/detail', $data);
        $this->load->view('admin/includes/footer', $data);
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
}