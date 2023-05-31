<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bgh extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		ini_set('memory_limit', "4096M");
	}

	public function index()
	{
		redirect('/bgh/dashboard');
	}
}
