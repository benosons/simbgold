<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_bgh extends CI_Model {

    public function getklas($where = NULL){
        if ($where != NULL) {
            $this->db->where($where);
        }

        $query = $this->db->get('t_klas_bangunan');
        return $query;
    }
}
