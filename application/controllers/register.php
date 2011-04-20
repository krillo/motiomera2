<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller{

   private static $wl_id = 0;

	function __construct(){
		parent::__construct();
    $this->load->model('m_municipal');
    $this->load->model('m_source');
    $this->load->model('m_trade');
    $this::$wl_id = WL_ID;
	}

	function index(){
		$this->all();
	}
  /**
   * create a new user
   */
  function newuser() {
    $data['title'] = 'Register';
    $data['records'] = $this->m_municipal->getAll();
    $data['source'] = $this->m_source->getAll($this::$wl_id, 'PRIVATE');
    $this->load->view('/include/v_header', $data);
    $this->load->view('include/v_debug');
    $this->load->view('v_new_user');
    $this->load->view('include/v_footer');
  }

   /**
    * Creates useraddress
    */
  function useradress() {
    $data['title'] = 'User address';
    $this->load->view('/include/v_header', $data);
    $this->load->view('include/v_debug');
    $this->load->view('v_new_user_adress');
    $this->load->view('include/v_footer');
  }

  /**
   * Check if username exists
   * if it exists then it will return error message as a snippet
   * call this with ajax
   * parameter is passed as segment 3
   */
  function isduplicateusername(){
    $username = $this->uri->segment(3);
    $data['status'] = $this->m_user->isDuplicateUsername($username);
    $this->load->view('/snippets/v_status_error_msg', $data);
  }

  /**
   * check if email exists
   * if it exists then it will return error message as a snippet
   * call this with ajax
   * parameter is passed as segment 3 and is urlencoded
   */
  function isduplicateemail(){
    $email = $this->uri->segment(3);
    $email = urldecode($email);
    $data['status'] = $this->m_user->isDuplicateEmail($email);
    $this->load->view('/snippets/v_status_error_msg', $data);
  }

  /**
   * create new company
   */
  function newcompany() {
    $data['title'] = 'Register company';
    $data['trade'] = $this->m_trade->getAll();
    $data['source'] = $this->m_source->getAll($this::$wl_id, 'COMPANY');
    $this->load->view('/include/v_header', $data);
    $this->load->view('/include/v_debug');
    $this->load->view('v_new_company', $data);
    $this->load->view('include/v_footer');
  }
  /**
   * creates companyaddress
   */
  function companyadress() {
    $data['title'] = 'Company adress';
    $this->load->view('/include/v_header', $data);
    $this->load->view('v_new_companyadress');
    $this->load->view('include/v_footer');
  }
  /*
   * create receipt page
   */
  function receipt(){
    $data['title'] = 'Receipt';
    $this->load->view('/include/v_header', $data);
    $this->load->view('v_user_receipt');
    $this->load->view('include/v_footer');
  }
}