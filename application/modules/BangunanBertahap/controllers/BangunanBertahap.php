<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BangunanBertahap extends CI_Controller
{
    protected $pathBerkas = 'dekill/Requirement/';
    protected $pathPerbaikan = 'dekill/Consultation/';
    protected $pathBerita = 'dekill/Consultation/';

    protected $pathInspeksi = 'public/uploads/inspeksi/pemeriksaan/';
    protected $pathBeritaInspeksi = 'public/uploads/inspeksi/berita_acara/';
    protected $pathJustifikasi = 'public/uploads/inspeksi/justifikasi/';
    protected $pathCatatan = 'public/uploads/inspeksi/catatan/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'MBangunanBertahap',
        ]);
        $this->load->library(['Simbg_lib', 'Oss_lib']);
        $this->simbg_lib->check_session_login();
    }

    public function Penugasan()
    {
        $Penugasan = $this->MBangunanBertahap->getListPenugasanDok()->result();
        $data = [
            'title' => '',
            'heading' => '',
            'Penugasan' => $Penugasan,
        ];
        $this->template->load('template/template_backend', 'BangunanBertahap/Penugasan/PenugasanList', $data);
    }

    public function FormPenugasan()
    {
        $id = $this->input->post('id', true);
        $cekDataBangunan = $this->MBangunanBertahap->cekDataBangunan($id);
        if ($cekDataBangunan->num_rows() > 0) {
            $row = $cekDataBangunan->row();
            $tgl_pernyataan = $row->tgl_pernyataan;

            $LuasBg = 0;
            $id_jenis_permohonan = $row->id_jenis_permohonan;
            if ($id_jenis_permohonan == 11) {
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

                if (!empty($lantai)) {
                    foreach ($lantai as $noo => $val) {
                        $bangunan_kolektif['lantai'][$noo] = $val != '' ? $val : '';
                    }
                }

                if (!empty($jumlah)) {
                    foreach ($jumlah as $noo => $val) {
                        $bangunan_kolektif['jumlah'][$noo] = $val != '' ? $val : '';
                    }
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
                        $luas_total_kolektif = $LuasBg;
                    }
                }
            } else {
                $hasil_kolektif = 0;
                $luas_total_kolektif = $LuasBg;
            }

            $date_plus = new DateTime($tgl_pernyataan);
            $lama_proses = intval($row->lama_proses);
            $date_plus->modify("+{$lama_proses} days");
            $hasil_tgl = $date_plus->format("d-m-Y");
            $tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
            $id_fbg = $row->id_fungsi_bg;
            $year = $year = date('Y');

            $get_data_penugasan = $this->MBangunanBertahap->getTimTpa(0, $year); //TPA

            $tim_petugas = [];
            foreach ($get_data_penugasan->result() as $p) {
                $gelar_depan = $p->glr_depan != '' && $p->glr_depan != null ? $p->glr_depan . ' ' : '';
                $gb = $p->glr_blkg;
                $gelar_belakang = $gb != '' && $gb != null ? $gb . ' ' : '';
                $nm = $p->nm_tpa;
                $nama_personal = $nm != '' && $nm != null ? $nm : '';
                $id_p = $p->id_tpanya;

                $nama_unsur = $id_fbg == 1 ? "{$p->nama_unsur} - {$p->nama_unsur_ahli}" : '<i>Belum Diisi!</i>';
                $nama_bidang = $id_fbg == 1 ? "{$p->nama_bidang}" : '<i>Belum Diisi!</i>';
                $nama_keahlian = $id_fbg == 1 ? $p->nama_keahlian : '<i>Belum Diisi!</i>';
                $tim_petugas[] = [
                    'id_personal' => $id_p,
                    'nama_peg' => $gelar_depan . $nama_personal . $gelar_belakang,
                    'nama_unsur' => $nama_unsur,
                    'nama_bidang' => $nama_bidang,
                    'nama_keahlian' => $nama_keahlian == null ? '-' : $nama_keahlian,
                ];
            }

            $data = [
                'id_pemilik' => $row->id_pemilik,
                'daftar_tim_penugasan' => 'Pilih Tim TPA',
                'no_konsultasi' => $row->no_konsultasi,
                'nm_pemilik' => $row->nm_pemilik,
                'fungsi_bg' => $row->fungsi_bg,
                'almt_bgn' => $row->almt_bgn,
                'nama_kec_bg' => $row->nama_kec_bg,
                'nama_kabkota_bg' => $row->nama_kabkota_bg,
                'nama_provinsi_bg' => $row->nama_provinsi_bg,
                'nm_konsultasi' => $row->nm_konsultasi,
                'alamat' => $row->alamat,
                'nama_kecamatan' => $row->nama_kecamatan,
                'nama_kabkota' => $row->nama_kabkota,
                'nama_prov_pemilik' => $row->nama_prov_pemilik,
                'almt_bgn' => $row->almt_bgn,
                'nama_kec_bg' => $row->nama_kec_bg,
                'nama_kabkota_bg' => $row->nama_kabkota_bg,
                'nama_provinsi_bg' => $row->nama_provinsi_bg,
                'fungsi_bg' => $row->fungsi_bg,
                'luas_bgn' => $row->luas_bgn,
                'tinggi_bgn' => $row->tinggi_bgn,
                'jml_lantai' => $row->jml_lantai,
                'jns_prasarana' => $row->jns_prasarana,
                'luas_bgp' => $row->luas_bgp,
                'tinggi_bgp' => $row->tinggi_bgp,
                'id_jenis_permohonan' => $id_jenis_permohonan,
                'hasil_kolektif' => $hasil_kolektif,
                'luas_total_kolektif' => $luas_total_kolektif,
                'tgl_pernyataan' => $tgl_pernyataan,
                'lama_proses' => $row->lama_proses == null ? 0 : $row->lama_proses,
                'hasil_tgl' => $hasil_tgl,
                'tim_petugas' => empty($tim_petugas) ? 0 : $tim_petugas,
                'res' => true,
            ];
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            $data = [
                'message' => 'Record Not Found!',
                'type' => 'error',
                'res' => false,
            ];
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }

    public function SimpanPenugasan()
    {
        $statsPenugasan = $this->input->post('statsPenugasan', true);
        $penugasan = $this->input->post('penugasan', true);
        $noKonsultasi = $this->input->post('noKonsultasi', true);
        $idPemilik = $this->input->post('idPemilik', true);
        $petugas = [];

        foreach ($penugasan as $r) {
            $petugas[] = [
                'id' => $r['id'],
                'id_pemilik' => $idPemilik,
            ];
        }
        $tanggal = date('Y-m-d');
        $data = [
            'status' => 5,
            'post_date' => $tanggal,
            'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps',
        ];
        $dataLog = [
            'tgl_status' => $tanggal,
            'status' => '5',
            'id' => $idPemilik,
            'modul' => 'Penugasan TPT/TPA',
        ];
        $this->MBangunanBertahap->insertBatch($petugas);
        $this->MBangunanBertahap->updateStatus($data, $idPemilik);
        $this->Mglobals->setDatakol('th_data_konsultasi', $dataLog);

        // $this->kirimemailstatus($idPemilik);
        // $this->kirimemailtotpa($idPemilik);
        $output = [
            'status' => true,
            'type' => 'success',
            'message' => 'Data Penugasan Berhasil Disimpan!',
            'no_konsultasi' => $noKonsultasi,
            'dataId' => $idPemilik,
            'typePenugasan' => $statsPenugasan,
        ];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function kirimemailstatus($id)
    {
        $email_pemohon = "";
        $no_konsultasi = "";
        $text_email = "";
        $this->load->library('PHPMailerAutoload');
        $mail = new PHPMailer();
        $mail->SMTPDebug = false;
        $mail->Debugoutput = 'html';
        // set smtp
        $mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->Port = '465';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Username = 'simbgcs.reset@gmail.com';
        $mail->Password = '@shinigami07';
        $mail->WordWrap = 50;

        if (!is_null($id) && (trim($id) != '') && (trim($id) != '0')) {
            $query = $this->MBangunanBertahap->getEmailPemohon($id);
            $mydata = $query->row_array();
            $baris = $query->num_rows();
            if ($baris >= 1) {
                $email_pemohon = $mydata['email'];
                $no_konsultasi = $mydata['no_konsultasi'];
            }
            $text_email .= "No Registrasi :" . $no_konsultasi . "<br>";
            $text_email .= "Telah Menetapkan Penugasan TPT Untuk No Registrasi $no_konsultasi<br>";
            $text_email .= "Sebagai TIM TPT untuk permohonan dengan No. Registrasi :" . $no_konsultasi . "<br>";
            $mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
            $mail->addAddress($email_pemohon);
            $mail->Subject = 'Penetapan TIM TPT | CS SIMBG';
            $mail->Body = $text_email;
            $mail->isHTML(true);
            $mail->send();
        }
    }

    public function kirimemailtotpa($id)
    {
        $email_pemohon = "";
        $no_konsultasi = "";
        $text_email = "";
        $this->load->library('PHPMailerAutoload');
        $mail = new PHPMailer();
        $mail->SMTPDebug = false;
        $mail->Debugoutput = 'html';
        // set smtp
        $mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->Port = '465';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Username = 'simbgcs.reset@gmail.com';
        $mail->Password = '@shinigami07';
        $mail->WordWrap = 50;

        if (!is_null($id) && (trim($id) != '') && (trim($id) != '0')) {
            $query = $this->MBangunanBertahap->getEmailPemohon($id);
            $mydata = $query->row_array();
            $baris = $query->num_rows();
            if ($baris >= 1) {
                $email_pemohon = $mydata['email'];
                $no_konsultasi = $mydata['no_konsultasi'];
            }
            $query = $this->MBangunanBertahap->getEmailTpa($id)->result();
            foreach ($query as $row) {
                $text_email .= "- " . $row->nm_tpa . "<br>";
                $mail->AddCC($row->email, $row->nm_tpa);
            }
            $text_email .= "Sebagai TIM TPA untuk permohonan dengan No. Registrasi :" . $no_konsultasi . "<br>";
            $mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
            //$mail->addAddress($email_pemohon);
            $mail->Subject = 'Penetapan TIM TPA | CS SIMBG';
            $mail->Body = $text_email;
            $mail->isHTML(true);
            $mail->send();
        }
    }

    public function Penjadwalan()
    {
        $penjadwalanList = $this->MBangunanBertahap->getListPenjadwlanDok()->result();
        $data = [
            'penjadwalan' => $penjadwalanList,
            'title' => 'Penjadwalan Konsultasi',
            'heading' => ''
        ];
        $this->template->load('template/template_backend', 'BangunanBertahap/Penjadwalan/PenjadwalanList', $data);
    }

    public function FormPenjadwalan()
    {
        $id = $this->Outh_model->Encryptor('decrypt', $this->input->post('id', TRUE));
        $getId = $this->MBangunanBertahap->cekDataBangunan($id);
        if ($getId->num_rows() > 0) {
            $row = $getId->row();
            $LuasBg = 0;
            $id_jenis_permohonan = $row->id_jenis_permohonan;
            if ($id_jenis_permohonan == 11) {
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
                if (!empty($lantai)) {
                    foreach ($lantai as $noo => $val) {
                        $bangunan_kolektif['lantai'][$noo] = $val != '' ? $val : '';
                    }
                }
                if (!empty($jumlah)) {
                    foreach ($jumlah as $noo => $val) {
                        $bangunan_kolektif['jumlah'][$noo] = $val != '' ? $val : '';
                    }
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

            $countJadwal = $this->MBangunanBertahap->getCountJadwal($row->id_pemilik)->num_rows();
            $nextKonsultasi = $countJadwal + 1;
            $getPenjadwalanList = $this->MBangunanBertahap->getPenjadwalanById($row->id_pemilik);
            $tgl_pernyataan = $row->tgl_pernyataan;
            $date_plus = new DateTime($tgl_pernyataan);
            $lama_proses = intval($row->lama_proses);
            $date_plus->modify("+{$lama_proses} days");
            $hasil_tgl = $date_plus->format("d-m-Y");
            $tgl_pernyataan = date("d-m-Y", strtotime($row->tgl_pernyataan));
            $id_fbg = $row->id_fungsi_bg;

            $rew =  $this->MBangunanBertahap->getByIdPtugasTPA($id);

            $penugasan = [];
            foreach ($rew->result() as $p) {
                $gelar_depan = $p->glr_depan != '' && $p->glr_depan != NULL ? $p->glr_depan . ' ' : '';
                $gb =  $p->glr_blkg;
                $gelar_belakang = $gb != '' && $gb != NULL ? $gb . ' ' : '';
                $nm =  $p->nm_tpa;

                $nama_personal = $nm != '' && $nm != NULL ? $nm : '';
                $id_p =  $p->id;
                $nama_unsur = $id_fbg == 1 ? "{$p->nama_unsur} - {$p->nama_unsur_ahli}" : '-';
                $nama_bidang = $id_fbg == 1 ? "{$p->nama_bidang}" : '-';
                $nama_keahlian = $id_fbg == 1 ? $p->nama_keahlian : '<i>Belum Diisi!</i>';
                $penugasan[] = [
                    'id_personal' => $id_p,
                    'nama_peg' => $gelar_depan . $nama_personal . $gelar_belakang,
                    'nama_unsur' => $nama_unsur,
                    'nama_bidang' => $nama_bidang,
                    'nama_keahlian' => $nama_keahlian
                ];
            }

            $csrf = $this->security->get_csrf_hash();
            $data = array(
                'csrf' => $csrf,
                'daftar_tim_penugasan' => $id_fbg == 1 ? 'Nama Tim TPT' : 'Nama Tim TPA',
                'nextKonsultasi' => $nextKonsultasi,
                'id' => $id,
                'id_konsultasi' => $row->id_pemilik,
                'no_konsultasi' => $row->no_konsultasi,
                'nm_pemilik' => $row->nm_pemilik,
                'alamat' => $row->alamat,
                'nama_kecamatan' => $row->nama_kecamatan,
                'nama_kabkota' => $row->nama_kabkota,
                'nama_prov_pemilik' => $row->nama_prov_pemilik,
                'nm_konsultasi' => $row->nm_konsultasi,
                'nama_kec_bg' => $row->nama_kec_bg,
                'nama_kabkota_bg' => $row->nama_kabkota_bg,
                'nama_provinsi_bg' => $row->nama_provinsi_bg,
                'fungsi_bg' => $row->fungsi_bg,
                'almt_bgn' => $row->almt_bgn,
                'tinggi_bgn' => $row->tinggi_bgn,
                'luas_bgn' => $row->luas_bgn,
                'jml_lantai' => $row->jml_lantai,
                'jns_prasarana' => $row->jns_prasarana,
                'luas_bgp' => $row->luas_bgp,
                'tinggi_bgp' => $row->tinggi_bgp,
                'email' => $row->email,
                'list_jadwal' => $getPenjadwalanList->result(),
                'id_provinsi' => $row->id_provinsi,
                'id_kabkota' => $row->id_kabkota,
                'id_kecamatan' => $row->id_kecamatan,
                'nm_bgn' => $row->nm_bgn,
                'id_prov_bgn' => $row->id_prov_bgn,
                'id_kabkot_bgn' => $row->id_kabkot_bgn,
                'id_kec_bgn' => $row->id_kec_bgn,
                'luas_basement' => $row->luas_basement,
                'lapis_basement' => $row->lapis_basement,
                'tgl_pernyataan' => $tgl_pernyataan,
                'id_jenis_permohonan' => $id_jenis_permohonan,
                'hasil_kolektif' => $hasil_kolektif,
                'luas_total_kolektif' => $luas_total_kolektif,
                'lama_proses' => $row->lama_proses == NULL ? 0 : $row->lama_proses,
                'hasil_tgl' => $hasil_tgl,
                'penugasan' => empty($penugasan) ? 0 : $penugasan,
                'id_jenis_bg' => $row->id_jenis_bg,
                'message' => 'Data Berhasil Ditampilkan!',
            );
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            $data = [
                'message' => 'Data Tidak Ada!'
            ];
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }

    public function SimpanPenjadwalan()
    {
        $tipe_konsultasi = $this->input->post('tipe_konsultasi', TRUE);
        $linkMeeting = $this->input->post('linkMeeting', TRUE);
        $passwordMeeting = $this->input->post('passwordMeeting', TRUE);
        $konsultasi_ke = explode('-', $this->input->post('konsultasi_ke', TRUE));
        $tanggal_konsultasi = $this->input->post('tanggal_konsultasi', TRUE);
        $jam_konsultasi = $this->input->post('jam_konsultasi', TRUE);
        $ketempat = $this->input->post('ketempat', TRUE);
        $email    =  $this->input->post('email', TRUE);
        $noreg = $this->input->post('noreg', TRUE);
        $primary = $this->input->post('id', TRUE);
        $tgl_skrg         = date('Y-m-d');

        $config['upload_path']         = 'dekill/Schedule/';
        $config['allowed_types']     = 'pdf|PDF';
        $config['max_size']            = '512000';
        $config['encrypt_name']        = TRUE;
        $config['remove_space']        = TRUE;
        $this->load->library('upload', $config, 'uploads');

        if (!$this->uploads->do_upload('berkas')) {
            $this->session->set_flashdata('message', 'Silahkan Upload File Undangan Konsultasi Terlebih Dahulu!.');
            $this->session->set_flashdata('status', 'danger');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        } else {
            if ($this->uploads->data('file_ext') == ".pdf") {
                $data = array(
                    'id' => $primary,
                    'konsultasi' => $konsultasi_ke[1],
                    'tgl_konsultasi' => $tanggal_konsultasi,
                    'jam_konsultasi' => $jam_konsultasi,
                    'ket_konsultasi' => $ketempat,
                    'dir_file_undangan' => $this->uploads->data('file_name'),
                    'tipe_konsultasi' => $tipe_konsultasi,
                    'link_meeting' => $linkMeeting,
                    'password_meeting' => $passwordMeeting
                );
                $status = array(
                    'status' => 6
                );
                $datalog    = array(
                    'id' => $primary,
                    'tgl_status' => $tgl_skrg,
                    'status' => '6',
                    'catatan' => $ketempat,
                    'dir_file' => $this->uploads->data('file_name'),
                    'modul' => 'Penjawalan Konsultasi'
                );
                $this->MBangunanBertahap->insertDataKonsultasi($data);
                $this->MBangunanBertahap->updateStatus($status, $primary);
                // $this->kirimJadwalKonsultasi($primary, $tanggal_konsultasi, $jam_konsultasi, $konsultasi_ke, $ketempat, $email, $noreg);
                //$this->kirimemailtotpa($primary);
                $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
                $this->session->set_flashdata('message', 'Konsultasi Berhasil Disimpan!');
                $this->session->set_flashdata('status', 'success');
                redirect($_SERVER['HTTP_REFERER'], 'refresh');
            } else if ($this->uploads->data('file_ext') == ".PDF") {
                $data = array(
                    'id' => $primary,
                    'konsultasi' => $konsultasi_ke[1],
                    'tgl_konsultasi' => $tanggal_konsultasi,
                    'jam_konsultasi' => $jam_konsultasi,
                    'ket_konsultasi' => $ketempat,
                    'dir_file_undangan' => $this->uploads->data('file_name'),
                    'tipe_konsultasi' => $tipe_konsultasi,
                    'link_meeting' => $linkMeeting,
                    'password_meeting' => $passwordMeeting
                );
                $status = array(
                    'status' => 6
                );
                $datalog    = array(
                    'id' => $primary,
                    'tgl_status' => $tgl_skrg,
                    'status' => '6',
                    'catatan' => $ketempat,
                    'dir_file' => $this->uploads->data('file_name'),
                    'modul' => 'Penjawalan Konsultasi'
                );
                $this->MBangunanBertahap->insertDataKonsultasi($data);
                $this->MBangunanBertahap->updateStatus($status, $primary);
                // $this->kirimJadwalKonsultasi($primary, $tanggal_konsultasi, $jam_konsultasi, $konsultasi_ke, $ketempat, $email, $noreg);
                //$this->kirimemailtotpa($primary);
                $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
                $this->session->set_flashdata('message', 'Konsultasi Berhasil Disimpan!');
                $this->session->set_flashdata('status', 'success');
                redirect($_SERVER['HTTP_REFERER'], 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
                $this->session->set_flashdata('status', 'warning');
                $path = FCPATH . "'dekill/Schedule/'";
                $berkas = $path . $this->uploads->data('file_name');
                if (!unlink($berkas)) {
                    $this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
                    $this->session->set_flashdata('status', 'warning');
                }
                redirect($_SERVER['HTTP_REFERER'], 'refresh');
            }
        }
    }

    function kirimJadwalKonsultasi($primary, $tanggal_konsultasi, $jam_konsultasi, $konsultasi_ke, $ketempat, $email, $noreg)
    {
        $email = $email;
        $text_email = "";
        $this->load->library('PHPMailerAutoload');
        $mail = new PHPMailer();
        $mail->SMTPDebug = false;
        $mail->Debugoutput = 'html';
        // set smtp
        $mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->Port = '465';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Username = 'simbg@pu.go.id';
        $mail->Password = 'SIMBG2020!!';
        $mail->WordWrap = 50;
        if (!is_null($primary) && (trim($primary) != '') && (trim($primary) != '0')) {
            $text_email .= "Undangan Konsultasi :<br>";
            $text_email .= "No Registrasi :" . $noreg . "<br>";
            $text_email .= "Tanggal :" . $tanggal_konsultasi . "<br>";
            $text_email .= "Jam :" . $jam_konsultasi . "<br>";
            $text_email .= "Keterangan :" . $ketempat . "<br>";
            $text_email .= "TIM TPT :<br>";
            $query = $this->MBangunanBertahap->getEmailTpt($primary)->result();;
            foreach ($query as $row) {
                $text_email .= "- " . $row->nama_personal . "<br>";
                $mail->AddCC($row->email, $row->nama_personal);
            }
            //if($dir_file_undangan != ''){
            // if (!is_null($lampiran_undangan) && (trim($lampiran_undangan) != '')) {

            //     //$dirPath = $thisdir . "/file/PBG/$noreg/konsultasi/undangan_konsultasi/";
            //     $file = realpath('./file/PBG/' . $noreg / 'konsultasi/undangan_konsultasi');
            //     $mail->AddAttachment($file, 'UndanganKonsultasi.pdf');
            // }
            $text_email .= "<br>";
            $text_email .= "Di Mohon Untuk Hadir Tepat Pada Waktunya<br>";
            $mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
            $mail->addAddress($email);
            $mail->Subject = 'Undangan Konsultasi PBG/SLF | CS SIMBG';
            $mail->Body = $text_email;
            $mail->isHTML(true);
            $mail->send();
            $this->session->set_flashdata('message', 'Penjadwalan Sidang Berhasil Disimpan !.');
            $this->session->set_flashdata('status', 'success');
        }
    }

    public function Pemeriksaan()
    {
        $data['konsultasi']     = $this->MBangunanBertahap->getListKonsultasi();
        $data['title']          =  '';
        $data['heading']        =  '';
        $this->template->load('template/template_backend', 'BangunanBertahap/HasilKonsultasi/ListPemeriksaan', $data);
    }

    public function FormPemeriksaan($id = NULL)
    {
        $getId = $this->MBangunanBertahap->getDataKonsultasi($this->secure->decrypt_url($id));
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
            $this->template->load('template/template_backend', 'BangunanBertahap/HasilKonsultasi/FormPemeriksaan', $data);
        } else {
            redirect('BangunanBertahap/Pemeriksaaniksaan');
        }
    }

    public function getRowPemeriksaan()
    {
        $id = $this->input->get('id', TRUE);
        $getId = $this->MBangunanBertahap->getDataKonsultasi($this->secure->decrypt_url($id));
        if ($getId->num_rows() > 0) {
            $row = $getId->row();
            $LuasBg = 0;
            $id_jenis_permohonan = $row->id_jenis_permohonan;
            if ($id_jenis_permohonan == 11) {
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
                if (!empty($lantai)) {
                    foreach ($lantai as $noo => $val) {
                        $bangunan_kolektif['lantai'][$noo] = $val != '' ? $val : '';
                    }
                }
                if (!empty($jumlah)) {
                    foreach ($jumlah as $noo => $val) {
                        $bangunan_kolektif['jumlah'][$noo] = $val != '' ? $val : '';
                    }
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
                'fungsi_bg' => $row->fungsi_bg,
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


    private function loadPersyaratan($group, $step, $jenis_permohonan, $id, $tahap)
    {
        $groupStep = [0, 1, 2, 3, 4];
        $group == NULL ? 1 : $group;

        if (in_array($step, $groupStep)) {

            if ($step == 0) {
                $tipePersyaratan = 2;
            } else if ($step == 1) {
                $tipePersyaratan = 3;
            } else if ($step == 2) {
                $tipePersyaratan = 4;
            } else if ($step == 3) {
                $tipePersyaratan = 6;
            } else {
                $tipePersyaratan = 6;
            }
            if ($step != 4 && $step != 5) {
                $type = 1;
                $getPersyaratan = $this->MBangunanBertahap->getSyaratList($jenis_permohonan, $tipePersyaratan, $tahap)->result();
                $result = [];
                foreach ($getPersyaratan as $g) {
                    $p = $this->MBangunanBertahap->getDataPemeriksaanKesesuaian($g->id_detail, $id)->row();
                    $kesesuaian = $p == NULL ? 0 : $p->kesesuaian;
                    $catatan = $p == NULL ? '' : $p->catatan;
                    $berkas = $p == NULL ? null : $p->dir_file;
                    $oldFIle = FCPATH . 'file/Konsultasi/' . $id . '/Dokumen/' . $berkas;
                    $dir = '';
                    if (file_exists($oldFIle)) {
                        $dir = 'file/Konsultasi/' . $id . '/Dokumen/' . $berkas;
                    } else {
                        $dir = 'dekill/Requirement/' . $berkas;
                    }
                    $result[] = [
                        'nm_dokumen' => $g->nm_dokumen,
                        'kesesuaian' => $kesesuaian,
                        'catatan' => $catatan == NULL ? '' : $catatan,
                        'dir_file' => $berkas == NULL ? false : $dir,
                        'id_detail' => $g->id_detail,
                        'id_detail_jenis_persyaratan' => $g->id_detail_jenis_persyaratan
                    ];
                }
            } else {
                $type = 2;
                if ($step == 4) {

                    $rowBangunan = $this->MBangunanBertahap->getDataKonsultasi($id)->row();
                    $result = [
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
        $getId = $this->MBangunanBertahap->getDataKonsultasi($id);
        if ($getId->num_rows() > 0) {
            $row = $getId->row();
            $group = $this->groupingData(intval($row->id_jenis_permohonan));
            $tahap = $row->tahap_pbg == '' || NULL ? 1 : $row->tahap_pbg;
            $persyaratan = $this->loadPersyaratan($group, $step, $row->id_jenis_permohonan, $id, $tahap);
            if ($group === 0) {
                $responses = [
                    'type' => $persyaratan['type'],
                    'id_detail_persyaratan' => $persyaratan['id_detail_persyaratan'],
                    'persyaratan' => $persyaratan['result'],
                    'tahap' => $tahap
                ];
            } else {
                $responses = [
                    'type' => $persyaratan['type'],
                    'id_detail_persyaratan' => $persyaratan['id_detail_persyaratan'],
                    'persyaratan' => $persyaratan['result'],
                    'tahap' => $tahap
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
                'name' => 1,
                'value' => 11
            ],
            // pengecekan dua kali
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
        $cekData =  $this->MBangunanBertahap->getDataKesuaian($dataKonsultasi, $dataId, $dataVal);
        if ($cekData->num_rows() > 0) {
            $update = [
                'kesesuaian' => $cek === true ? 1 : 0
            ];
            $this->MBangunanBertahap->updateDataKesesuaian($dataKonsultasi, $dataVal, $dataId, $update);
        } else {
            $insert = [
                'id' => $dataKonsultasi,
                'id_persyaratan' => $dataVal,
                'id_persyaratan_detail' => $dataId,
                'kesesuaian' => $cek === true ? 1 : 0,
            ];
            $this->MBangunanBertahap->insertDataKesesuaian($insert);
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
        $cekData =  $this->MBangunanBertahap->getDataKesuaian($dataKonsultasi, $dataId, $dataVal);
        if ($cekData->num_rows() > 0) {
            $update = [
                'catatan' => $syarat
            ];
            $this->MBangunanBertahap->updateDataCatatan($dataKonsultasi, $dataVal, $dataId, $update);
        } else {
            $insert = [
                'id' => $dataKonsultasi,
                'id_persyaratan' => $dataVal,
                'id_persyaratan_detail' => $dataId,
                'catatan' => $syarat,
            ];
            $this->MBangunanBertahap->insertDataCatatan($insert);
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
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $config);
        $cekData =  $this->MBangunanBertahap->getDataBerkas($dataKonsultasi, $dataVal, $dataId);
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
                        'dir_file' => $this->upload->data('file_name')
                    ];
                    $cekFile = $this->MBangunanBertahap->cekBerkas($dataKonsultasi, $dataVal, $dataId)->row()->dir_file;
                    if ($cekFile == NULL) {

                        $this->MBangunanBertahap->updateBerkas($dataKonsultasi, $dataVal, $dataId, $data);
                        $output = [
                            'status' => true,
                            'type' => 'success',
                            'message' => 'Data Berkas Berhasil Diupload!',
                            'result' => "dekill/Requirement/" . $this->upload->data('file_name')
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    } else {
                        $path = $this->pathBerkas;
                        $fileLama = $path . $cekFile;
                        $this->MBangunanBertahap->updateBerkas($dataKonsultasi, $dataVal, $dataId, $data);
                        $output = [
                            'status' => true,
                            'type' => 'success',
                            'message' => 'Data Berkas Berhasil Diupload!',
                            'result' => "dekill/Requirement/" . $this->upload->data('file_name')
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($output);
                    }
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
                    $this->MBangunanBertahap->insertBerkas($data);
                    $output = [
                        'status' => true,
                        'type' => 'success',
                        'message' => 'Data Berkas Berhasil Diupload!',
                        'result' => "dekill/Requirement/" . $this->upload->data('file_name')
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
        $tahap = $this->input->post('tahap', TRUE);

        $dataKonsultasi = $this->secure->decrypt_url($this->input->post('dataKonsultasi', TRUE));
        $pemeriksaan = $this->MBangunanBertahap->getSyaratListId($jenis, $syarat, $tahap);
        $cek = [];
        $not = 0;
        $done = 0;
        foreach ($pemeriksaan->result() as $r) {
            $p = $this->MBangunanBertahap->getDataPemeriksaanKesesuaian($r->id_detail, $dataKonsultasi)->row();
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
        $cek_step = $this->MBangunanBertahap->cekStep($this->secure->decrypt_url($id))->row();
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
        $this->MBangunanBertahap->saveStep($dataVal, $data);
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
        $cekKonsultasi = $this->MBangunanBertahap->getIdKonsultasi($konsultasi)->row();
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
                $this->MBangunanBertahap->insertPerbaikan($data);
                $this->MBangunanBertahap->updateStatsPbg($id, $update);
                $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
                $output = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Data Berkas Berhasil Diupload!',
                    'result' => $this->pathPerbaikan . $this->upload->data('file_name')
                ];
                header('Content-Type: application/json');
                echo json_encode($output);
                /*$path = FCPATH . "/{$this->pathPerbaikan}";
                $berkas = $path . $this->upload->data('file_name');
                if (!unlink($berkas)) {
                }
                $output = [
                    'status' => false,
                    'type' => 'warning',
                    'message' => 'Silahkan Upload Berkas Menggunakan Format PDF!'
                ];
                header('Content-Type: application/json');
                echo json_encode($output);*/
            } else {

                /*$data = [
                    'id' => $id,
                    'no_sk' => $no_skperbaikan,
                    'tgl_perbaikan' => $tgl_perbaikan,
                    'lampiran_perbaikan' => $this->upload->data('file_name')
                ];
                $update = [
                    'status' => 7
                ];
                $datalog	= [
					'id' => $id,
					'tgl_status' => $tgl_skrg,
					'status' => '7',
					'catatan' => "Dikembalikan ke Pemohon agar memperbaiki Dokumen Teknis",
					'dir_file' => $this->upload->data('file_name'),
					'modul' => 'Input Hasil Konsultasi'
                ];
                $this->MBangunanBertahap->insertPerbaikan($data);
                $this->MBangunanBertahap->updateStatsPbg($id, $update);
                $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
                $output = [
                    'status' => true,
                    'type' => 'success',
                    'message' => 'Data Berkas Berhasil Diupload!',
                    'result' => $this->pathPerbaikan . $this->upload->data('file_name')
                ];
                header('Content-Type: application/json');
                echo json_encode($output);*/

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

    public function tolakPermohonan()
    {
        $konsultasi = $this->secure->decrypt_url($this->input->post('konsultasi', TRUE));
        $getId = $this->MBangunanBertahap->getDataKonsultasi($konsultasi)->row()->id_pemilik;
        $tanggal  = $this->input->post('tanggal', TRUE);
        $catatan = $this->input->post('catatan', TRUE);

        $data = [
            'id' => $getId,
            'tgl_ditolak' => $tanggal,
            'catatan_ditolak' => $catatan
        ];

        $update = [
            'status' => 25
        ];
        $this->MBangunanBertahap->insertDataPenolakan($data);
        $this->MBangunanBertahap->updateStatsPbg($getId, $update);
        $this->session->set_flashdata('message', 'Penolakan Permohonan Berhasil Disimpan!');
        $this->session->set_flashdata('status', 'success');
        redirect('BangunanBertahap/Pemeriksaan', 'refresh');
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
            $this->MBangunanBertahap->removeDataJadwal($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Verifikasi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('BangunanBertahap/Pemeriksaan');
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
            $this->MBangunanBertahap->removeDataRetribusi($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Perhitungan Retribusi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('BangunanBertahap/Pemeriksaan');
    }

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
        $id_bgn            = $this->input->post('id_bgn');
        $id                = $this->input->post('id');
        $nama_bangunan                = $this->input->post('nama_bangunan');
        $nama_bangunan_kolektif        = $this->input->post('nama_bangunan_kolektif');
        if ($nama_bangunan) {
            $nama_bangunan        = $this->input->post('nama_bangunan');
        } else if ($nama_bangunan_kolektif) {
            $nama_bangunan        = $this->input->post('nama_bangunan_kolektif');
        } else {
            $nama_bangunan        = $this->input->post('nama_bangunan_prasarana');
        }

        $luas_bg        = $this->input->post('luas_bg');
        $tinggi_bg        = $this->input->post('tinggi_bg');
        $almt_bgn            = $this->input->post('almt_bgn');

        $nama_kecamatan        = $this->input->post('nama_kecamatan');
        $nama_kelurahan     = $this->input->post('nama_kelurahan');
        $lantai_bg            = $this->input->post('lantai_bg');
        $luas_basement        = $this->input->post('luas_basement');
        $lapis_basement        = $this->input->post('lapis_basement');
        $lantai_bg            = $this->input->post('lantai_bg');
        $id_jns_bg            = $this->input->post('id_jns_bg');
        $id_izin            = $this->input->post('id_izin');
        $id_kolektif        = $this->input->post('id_kolektif');
        $tipeA                = $this->input->post('tipeA');
        $jumlahA            = $this->input->post('jumlahA');
        $luasA                = $this->input->post('luasA');
        $tinggiA            = $this->input->post('tinggiA');
        $lantaiA            = $this->input->post('lantaiA');
        $id_prasarana_bg    = $this->input->post('id_prasarana_bg');
        $luas_bgp            = $this->input->post('luas_bgp');
        $tinggi_bgp            = $this->input->post('tinggi_bgp');
        $jual                = $this->input->post('jual');
        $imb                = $this->input->post('imb');
        $slf                = $this->input->post('slf');
        $id_prototype        = $this->input->post('id_prototype');
        $cetak                = $this->input->post('cetak');
        $id_doc_tek            = $this->input->post('id_doc_tek');


        // pemilik
        $nama_pemilik = $this->input->post('nama_pemilik');
        $alamat_pemilik = $this->input->post('alamat_pemilik');
        $provinsiPemilik = $this->input->post('provinsiPemilik');
        $kabkotaPemilik = $this->input->post('kabkotaPemilik');
        $kecamatanPemilik = $this->input->post('kecamatanPemilik');
        $kelurahanPemilik = $this->input->post('kelurahanPemilik');
        $jns_kepemilikan = $this->input->post('jns_kepemilikan');


        $data    = array(
            'id'                => $id,
            'id_kec_bgn'        => $nama_kecamatan,
            'id_kel_bgn'        => $nama_kelurahan,
            'almt_bgn'            => $almt_bgn,
            'id_izin'            => $id_izin,
            'id_jns_bg'            => $id_jns_bg,
            'nm_bgn'            => $nama_bangunan,
            'luas_bgn'            => $luas_bg,
            'tinggi_bgn'        => $tinggi_bg,
            'jml_lantai'        => $lantai_bg,
            'luas_basement'        => $luas_basement,
            'lapis_basement'    => $lapis_basement,
            'last_update'        => date("Y-m-d h:i:sa"),
            'id_kolektif'        => $id_kolektif,
            'tipeA'                => json_encode($tipeA),
            'jumlahA'            => json_encode($jumlahA),
            'luasA'                => json_encode($luasA),
            'tinggiA'            => json_encode($tinggiA),
            'lantaiA'            => json_encode($lantaiA),
            'id_prasarana_bg'    => $id_prasarana_bg,
            'luas_bgp'            => $luas_bgp,
            'tinggi_bgp'        => $tinggi_bgp,
            'id_doc_tek'        => $id_doc_tek,
            'id_prototype'        => $id_prototype,
            'imb'                => $imb,
            'slf'                => $slf
        );
        $dataPemilik = [
            'jns_pemilik' => $jns_kepemilikan,
            'nm_pemilik' => $nama_pemilik,
            'alamat' => $alamat_pemilik,
            'id_kecamatan' => $kecamatanPemilik,
            'id_kabkota' => $kabkotaPemilik,
            'id_provinsi' => $provinsiPemilik,
            'id_kelurahan' => $kelurahanPemilik,
            'id_provinsi' => $provinsiPemilik,
        ];
        if ($id_bgn != "") {
            $query        = $this->Mglobals->setData('tmdatabangunan', $data, 'id_bgn', $id_bgn);
            $query1 = $this->Mglobals->setData('tmdatapemilik', $dataPemilik, 'id', $id);
            $this->session->set_flashdata('message', 'Data Bangunan Berhasil di Simpan/Ubah.');
            $this->session->set_flashdata('status', 'success');
            $output = [
                'message' => 'Data Bangunan Berhasil Di Ubah!',
                'res' => true,
                'type' => 'success',
            ];
        } else {
            $query        = $this->Mglobals->setData('tmdatabangunan', $data, 'id_bgn', $id_bgn);
            $query1 = $this->Mglobals->setData('tmdatapemilik', $dataPemilik, 'id', $id);
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

    public function SavePenilaian()
    {
        $nomor_berita = $this->input->post('nomor_berita', TRUE);
        $tgl_berita = $this->input->post('tgl_berita', TRUE);
        $okupansi   = $this->input->post('okupansi', TRUE);
        $luas_dasar   = $this->input->post('luas_dasar', TRUE);
        $id = $this->secure->decrypt_url($this->input->post('id', TRUE));
        $imb = $this->input->post('imb', TRUE);
        $id_jenis_permohonan = $this->input->post('id_jenis_permohonan', TRUE);
        $email = $this->input->post('email', TRUE);
        $no_konsultasi = $this->input->post('no_konsultasi', TRUE);
        $tgl_skrg         = date('Y-m-d');
        $catatan = "";
        $sk_slf = "";
        if ($imb == '1') {
            $status = '10';
            $ket = "Akan Masuk Ketahap Validasi Kepala Dinas Teknis";
        } else {
            $status = '9';
            $ket = "Akan Masuk Ketahap Perhitungan Retribusi";
        }
        $config = [
            'upload_path' => "./{$this->pathBerita}",
            'allowed_types' => 'pdf|PDF',
            'max_size' => '50000',
            'max_width' => 5000,
            'max_height' => 5000,
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $ttd = $this->MBangunanBertahap->get_pejabat($id);
        $ttd_pejabat_sk = $ttd['kepala_dinas'];
        $nip_kadis_teknis = $ttd['nip_kepala_dinas'];
        $nm_dinas = $ttd['p_nama_dinas'];
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('berkas')) {
            $this->session->set_flashdata('message', $this->upload->display_errors());
            $this->session->set_flashdata('status', 'danger');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($this->upload->data('file_ext') == ".pdf" || $this->upload->data('file_ext') == ".PDF") {
                if ($id_jenis_permohonan == '14') { //Bangunan Eksisting Memiliki PBG/IMB
                    $sk_slf = $this->SK_SLF($id);
                    $tgl_sk_slf = date('Y-m-d');
                    $dataInSLF = array(
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
                    $data2 = [
                        'id' => $id,
                        'dir_file_konsultasi' =>  $this->upload->data('file_name'),
                        //'hsl_konsultasi' => 1,
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
                    $this->MBangunanBertahap->updateStatsPbg($id, $update);
                    $query = $this->MBangunanBertahap->updateHasilPenilaian($id, $data);
                    $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
                    $this->Mglobals->setDatakol('tmdatavaltek', $data);
                    $this->MBangunanBertahap->insertdataslf($dataInSLF);
                    $this->load->library('ciqrcode'); //pemanggilan library QR CODE
                    $config['imagedir']     = 'dekill/QR_Code/'; //direktori penyimpanan qr code
                    $config['quality']      = true; //boolean, the default is true
                    $config['size']         = '1024'; //interger, the default is 1024
                    $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
                    $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
                    $this->ciqrcode->initialize($config);
                    $image_name = $sk_slf . '.png'; //buat name dari qr code sesuai dengan nim
                    $params['data'] = 'http://simbg.pu.go.id/Main/Berkas/' . $sk_slf; //data yang akan di jadikan QR CODE
                    $params['level'] = 'H'; //H=High
                    $params['size'] = 10;
                    $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
                    $data['QR'] = $this->ciqrcode->generate($params);
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
                } else {
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
                    $this->MBangunanBertahap->updateStatsPbg($id, $update);
                    $query = $this->MBangunanBertahap->updateHasilPenilaian($id, $data);
                    $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
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
}
