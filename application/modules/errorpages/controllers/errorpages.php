<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * ***************************************************************
 * Script : 
 * Version : php v 5
 * Date : 22/03/2017
 * Author : Tantan Permana.
 * Description : Codeigniter 3.x + HMVC
 * ***************************************************************
 */

class errorpages extends CI_Controller {

	
	
	public function index(){
		
		$data['head_title'] = '.:: 404 NOT FOUND ::.';
		$this->load->view('index');
	}
	
	

}

