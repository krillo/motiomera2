<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class User extends CI_Controller {

  private static $wl_id = 0;
  private static $newPassCount = 5;
  private static $persistantFootPrint = '127.0.0.1Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16 GTB7.1 ( .NET CLR 3.5.30729; .NET4.0C)';

  function __construct() {
    parent::__construct();
    $this->load->model('m_municipal');
    $this->load->model('m_source');
    $this->load->model('m_trade');
    $this::$wl_id = WL_ID;
  }

  function index() {
    $this->all();
  }

  /**
   * Show all records - limit as 3rd segment, auto populated as first parameter
   */
  function all($limit = 20) {
    $data['records'] = $this->m_user->getAll($limit);
    $this->load->view('/include/v_header', $data);
    $this->load->view('admin/v_view', $data);
  }

  /**
   * this function does getById - id as segment 3
   */
  function get($id) {
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
  function refreshstepdata() {
    $user_id = $this->uri->segment(3);
    $data['records'] = $this->m_user->getById($user_id);
    $data['total_calories'] = $this->m_step->getCaloriesFromSteg($data['records'][0]->total_steps);
    if ($this->session->userdata('user_id') == $user_id) {
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
   * Create a forgot password page where the user can get a new password by mail.
   */
  function forgotpass() {
    $data['title'] = 'Forgot password';
    $this->load->view('/include/v_header', $data);
    $this->load->view('v_new_password', $data);
    $this->load->view('include/v_footer');
  }
  /**
   * This function checks if email exists and sends a new or displays error message
   * It stops robots from accessing the function more tahn five times in an hour.
   */
  function getnewpass() {
    //stop robots
    //$newPassCount
    $footprint = $this->input->ip_address() . $this->input->user_agent();
    
      



    //$this::$newPassCount =


    $email = $this->uri->segment(3);
    $email = urldecode($email);
    $success = $this->m_user->getNewPass($email);
    if($success == true){
      echo 'Your new password has been sent to you';
      echo $footprint;
    }else{
      echo 'There is no user with that email address';
      echo $footprint;
    }
  }

  /*
   * create receipt page
   */
  function receipt() {
    $data['title'] = 'Receipt';
    $this->load->view('/include/v_header', $data);
    $this->load->view('v_password_receipt');
    $this->load->view('include/v_footer');
  }

  function count() {
    $data['records'] = $this->m_user->count();
    $this->load->view('admin/v_default', $data);
  }

  /**
   * display the new form
   */
  function add() {
    $this->load->view('/include/v_header');
    $this->load->view('admin/v_add');
  }

  /**
   * Creates a new row
   */
  function create() {
    $this->m_user->create();
    $this->all();
  }

  /**
   * Edit row - id as segment 3
   */
  function edit() {
    $data['records'] = $this->m_user->getById($this->uri->segment(3));
    $this->load->view('admin/v_edit', $data);
  }

  /**
   * Update row - id as segment 3
   */
  function update() {
    $id = $this->uri->segment(3);
    $this->m_user->update($id);
    $this->all();
  }

  /**
   * Delete row - id as segment 3
   */
  function delete() {
    $id = $this->uri->segment(3);
    $data['records'] = $this->m_user->delete($id);
    $this->all(20);
  }

}