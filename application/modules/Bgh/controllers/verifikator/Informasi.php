<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
{
    public function index()
    {
        $data = array('page' => 'informasi');
        $data['informasi'] = $this->db->get('t_informasi_bgh')->result();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/informasi',$data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function forminformasi()
    {
        $config['upload_path']          = './assets/informasi';
        $config['allowed_types']        = 'pdf';
        $config['encrypt_name']         = true;
        $this->load->library('upload', $config);
        $params = (object)$this->input->post();
        if ($params->id == 0) {
            unset($params->id);
            if (!$this->upload->do_upload('file')) {
                $response = array(
                    'code' => 0,
                    'msg' => $this->upload->display_errors()
                );
            }else{
                $params->file = $this->upload->data('file_name');
                $insert = $this->db->insert('t_informasi_bgh', $params);
                if ($insert) {
                    $response = array(
                        'code' => 1,
                        'msg' => 'Tambah Data Berhasil !'
                    );
                }else{
                    $response = array(
                        'code' => 0,
                        'msg' => 'Tambah Data Gagal !'
                    );
                }
            }
        }else {
            if ($this->upload->do_upload('file')) {
                $params->file = $this->upload->data('file_name');
            }
            $where = array('id' => $params->id);
            unset($params->id);
            $this->db->where($where);
            $edit = $this->db->update('t_informasi_bgh', $params);
            if ($edit) {
                $response = array(
                    'code' => 1,
                    'msg' => 'Edit Data Berhasil !'
                );
            }else{
                $response = array(
                    'code' => 0,
                    'msg' => 'Edit Data Gagal !'
                );
            }
        }
        echo json_encode($response);
    }

    public function deleteinformasi()
    {
        $id = $this->input->post('id');
        $get = $this->db->get_where('t_informasi_bgh', array('id' => $id))->row();
        unlink('assets/informasi/'.$get->file);
        $this->db->where('id', $id);
        $del = $this->db->delete('t_informasi_bgh');
        if ($del) {
            $response = array(
                'code' => 1,
                'msg' => 'Delete Data Berhasil !'
            );
        }else{
            $response = array(
                'code' => 0,
                'msg' => 'Delete Data Gagal !'
            );
        }
        echo json_encode($response);
    }
    
    public function juknis()
    {
        $data = array('page' => 'juknis');
        $data['juknis'] = $this->db->get('t_juknis')->result();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/juknis', $data);
        $this->load->view('admin/includes/footer', $data);       
    }

    public function formjuknis()
    {
        $config['upload_path']          = './assets/juknis';
        $config['allowed_types']        = 'pdf';
        $config['encrypt_name']         = true;
        $this->load->library('upload', $config);
        $params = (object)$this->input->post();
        if ($params->id == 0) {
            unset($params->id);
            if (!$this->upload->do_upload('file')) {
                $response = array(
                    'code' => 0,
                    'msg' => $this->upload->display_errors()
                );
            }else{
                $params->file = $this->upload->data('file_name');
                $insert = $this->db->insert('t_juknis', $params);
                if ($insert) {
                    $response = array(
                        'code' => 1,
                        'msg' => 'Tambah Data Berhasil !'
                    );
                }else{
                    $response = array(
                        'code' => 0,
                        'msg' => 'Tambah Data Gagal !'
                    );
                }
            }
        }else {
            if ($this->upload->do_upload('file')) {
                $params->file = $this->upload->data('file_name');
            }
            $where = array('id' => $params->id);
            unset($params->id);
            $this->db->where($where);
            $edit = $this->db->update('t_juknis', $params);
            if ($edit) {
                $response = array(
                    'code' => 1,
                    'msg' => 'Edit Data Berhasil !'
                );
            }else{
                $response = array(
                    'code' => 0,
                    'msg' => 'Edit Data Gagal !'
                );
            }
        }
        echo json_encode($response);
    }

    public function deletejuknis()
    {
        $id = $this->input->post('id');
        $get = $this->db->get_where('t_juknis', array('id' => $id))->row();
        unlink('assets/juknis/'.$get->file);
        $this->db->where('id', $id);
        $del = $this->db->delete('t_juknis');
        if ($del) {
            $response = array(
                'code' => 1,
                'msg' => 'Delete Data Berhasil !'
            );
        }else{
            $response = array(
                'code' => 0,
                'msg' => 'Delete Data Gagal !'
            );
        }
        echo json_encode($response);
    }
}
