<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{

	function __construct(){
		parent::__construct();
    $this->load->model('m_municipal');
    $this->load->model('m_source');
	}

	function index(){
		$this->all();
	}


  /**
   * Show all records - limit as 3rd segment, auto populated as first parameter
   */
  function all($limit = 20){
    $data['records'] = $this->m_user->getAll($limit);
    $this->load->view('/include/v_header', $data);
    $this->load->view('admin/v_view', $data);
  }

  /**
   * this function does getById - id as segment 3
   */
  function get($id){
    $data['records'] = $this->m_user->getById($id);
    $this->load->view('/include/v_header', $data);
    $this->load->view('admin/v_view');
  }


 /**
  * This function returns a snippet of stepdata
  * The user_id should be passed as 3 segment
  * If the user_id is the same as in the session, this function also updates the data in the session
  * Call it with ajax
  */
  function refreshstepdata(){
    $user_id = $this->uri->segment(3);
    $data['records'] = $this->m_user->getById($user_id);
    $data['total_calories'] = $this->m_step->getCaloriesFromSteg($data['records'][0]->total_steps);
    if($this->session->userdata('user_id') == $user_id){
        $session_data = array(
          'total_steps' => $data['records'][0]->total_steps,
          'total_regs' => $data['records'][0]->total_regs,
          'total_calories' => $this->m_step->getCaloriesFromSteg($data['records'][0]->total_steps)
        );
        $this->session->set_userdata($session_data);
    }    
    $this->load->view('/snippets/v_stepdata', $data);
  }

  /**
   * create a new user
   */
  function newuser() {
    $data['title'] = 'Register';
    $data['records'] = $this->m_municipal->getAll();
    $data['source'] = $this->m_source->getAll();
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
    $this->load->view('/include/v_header', $data);
    $this->load->view('v_new_company');
    $this->load->view('include/v_footer');
  }
  /**
   * creates companyaddress
   */
  function companyadress() {
    $data['title'] = 'Company adress ';
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

  /**
   * create new password to user
   */
  function forgotpass() {
    $data['title'] = 'Forgot password';
    $this->load->view('/include/v_header', $data);
    $this->load->view('v_new_password');
    $this->load->view('include/v_footer');
  }

  function count(){
    $data['records'] = $this->m_user->count();
    $this->load->view('admin/v_default', $data);
	}


  /**
   * display the new form
   */
  function add(){
    $this->load->view('/include/v_header');
    $this->load->view('admin/v_add');
  }

  /**
   * Creates a new row
   */
  function create(){
    $this->m_user->create();
    $this->all();
	}

  /**
   * Edit row - id as segment 3
   */
  function edit(){
    $data['records'] = $this->m_user->getById($this->uri->segment(3));
    $this->load->view('admin/v_edit', $data);
  }


	/**
   * Update row - id as segment 3
   */
	function update(){
    $id = $this->uri->segment(3);
    $this->m_user->update($id);
    $this->all();
	}

	/**
   * Delete row - id as segment 3
   */
	function delete(){
    $id = $this->uri->segment(3);
    $data['records'] = $this->m_user->delete($id);
    $this->all(20);
  }




}