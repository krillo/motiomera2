<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){
    $this->load->view('include/v_header');
		$this->load->view('admin/v_admin');
	}



}