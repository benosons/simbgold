<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tpa extends CI_Controller
{
    public function index()
    {
        $data = array('page' => 'tpa');
        $this->db->select('t_tpa.*, tr_provinsi.nama_provinsi, tr_kabkot.nama_kabkota, tr_kecamatan.nama_kecamatan');
        $this->db->from('t_tpa');
        $this->db->join('tr_provinsi','tr_provinsi.id_provinsi = t_tpa.id_provinsi','LEFT');
        $this->db->join('tr_kabkot','tr_kabkot.id_kabkot = t_tpa.id_kabkot','LEFT');
        $this->db->join('tr_kecamatan','tr_kecamatan.id_kecamatan = t_tpa.id_kecamatan','LEFT');
        $data['tpa'] = $this->db->get()->result();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/tpa',$data);
        $this->load->view('admin/includes/footer', $data);
    }

    public function detail()
    {
        $id = $this->input->post('id');
        $this->db->select('t_tpa.*, tr_provinsi.nama_provinsi, tr_kabkot.nama_kabkota, tr_kecamatan.nama_kecamatan');
        $this->db->from('t_tpa');
        $this->db->join('tr_provinsi','tr_provinsi.id_provinsi = t_tpa.id_provinsi','LEFT');
        $this->db->join('tr_kabkot','tr_kabkot.id_kabkot = t_tpa.id_kabkot','LEFT');
        $this->db->join('tr_kecamatan','tr_kecamatan.id_kecamatan = t_tpa.id_kecamatan','LEFT');
        $this->db->where('id',$id);
        $this->db->order_by('id','DESC');
        $get = $this->db->get()->row();
        echo json_encode(array('code' => 1, 'data' => $get));
    }
}
