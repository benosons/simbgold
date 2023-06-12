<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BangunanBaru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->library('simbg_lib');
		$this->load->helper(array('form', 'url'));
		// $this->simbg_lib->check_session_login();
        $this->load->model('checklist_model');
        $session_login 	= $this->session->userdata('loc_login');
        if($session_login != TRUE)
        {
            redirect('Front');
        }
	}
    
    public function index()
    {
        $data['page'] = 'dashboard';
        $data['content'] = $this->load->view('bangunangedung/bangunanbaru/index', $data, TRUE);

        $this->load->view('layouts', $data);
        // $this->load->view('layouts');
    }

    public function permohonan()
    {
        $data['page'] = 'permohonan';
        $head = $this->checklist_model->gethead()->result();
        $checklist = array();
        foreach ($head as $h) {
            $x++;
            $row = array();
            $row['id'] = (!empty($h->id) ? $h->id : "");
            $row['kode'] = (!empty($h->kode) ? $h->kode : "");
            $row['nama'] = (!empty($h->nama) ? $h->nama : "");
            $row['poin'] = (!empty($h->poin) ? $h->poin : "");

            $getmain = $this->checklist_model->getmain(array('id_head' => $h->id))->result();
            $main = array();
            foreach($getmain as $m){
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
                    $row2['dokumen'] = (!empty($s->dokumen) ? $s->dokumen : "");

                    if ($s->dokumen == 0) {
                        $getsubsub = $this->checklist_model->getsubsub(array('id_sub' => $s->id))->result();
                        $subsub = array();
                        foreach ($getsubsub as $ss) {
                            $row3 = array();
                            $row3['id'] = (!empty($ss->id) ? $ss->id : "");
                            $row3['kode'] = (!empty($ss->kode) ? $ss->kode : "");
                            $row3['nama'] = (!empty($ss->nama) ? $ss->nama : "");
                            $row3['poin'] = (!empty($ss->poin) ? $ss->poin : "");

                            $getdok = $this->checklist_model->getdok(array('id_sub_sub_dok' => $ss->id))->result();
                            $dok = array();
                            foreach ($getdok as $d) {
                                $row4 = array();
                                $row4['id'] = (!empty($d->id) ? $d->id : "");
                                $row4['nama'] = (!empty($d->nama) ? $d->nama : "");

                                array_push($dok,$row4);
                            }
                            $row3['dok'] = $dok;

                            array_push($subsub,$row3);
                        }
                        $row2['subsub'] = $subsub;
                    }else{
                        $getdok = $this->checklist_model->getdok(array('id_sub' => $s->id))->result();
                        $dok = array();
                        foreach ($getdok as $d) {
                            $row4 = array();
                            $row4['id'] = (!empty($d->id) ? $d->id : "");
                            $row4['nama'] = (!empty($d->nama) ? $d->nama : "");

                            array_push($dok,$row4);
                        }
                        $row2['dok'] = $dok;
                    }

                    array_push($sub,$row2);
                }
                $row1['sub'] = $sub;

                array_push($main,$row1);
            }

            $row['main'] = $main;

            array_push($checklist, $row);
        }
        $data['checklist'] = $checklist;
        // $data['head'] = ;
        $data['content'] = $this->load->view('bangunangedung/bangunanbaru/form', $data, TRUE);

        $this->load->view('layouts', $data);
    }
}
