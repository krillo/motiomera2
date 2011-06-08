<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class User extends CI_Controller {
 
  function __construct() {
    parent::__construct();
    $this->load->model('m_municipal');
    $this->load->model('m_source');
    $this->load->model('m_trade');
    //$this::$wl_id = WL_ID;
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
   * A page where the user type their emailaddress to get it checked if exists.
   */
  function forgotpass() {
    $data['title'] = 'Forgot password';
    $this->load->view('/include/v_header', $data);
    $this->load->view('new_password/v_forgot_password');
    $this->load->view('include/v_footer');
  }
  
  /**
   * if email exists send an activationcode to the users email else displays error message.
   * It stops robots from accessing the function more than three times in an hour. Parameters from settings.
   */
  function getnewpasscode() {
    $email = urldecode($this->uri->segment(3));
    $footprint = $this->input->ip_address() . $this->input->user_agent();
    $isFraud = $this->m_user->isFraud($footprint, 'NEWPASSWORD');
    if ($isFraud == -1) {
      echo 'error';
    } else {
      if ($isFraud == 0) {
        echo 'capthca <img src="/img/icons/beer.jpg">';
      } else {
        if ($this->m_user->checkEmail($email)) {
          $code = $this->m_user->setPassCode($email);
          echo anchor("http://m2.dev/index.php/user/newpass/$code");
        } else {
          echo 'There is no user with that email address. Please try again.';
        }
      }
    }
  }

  /**
   * This function check if the activation code has expired.
   * If not, let the user type a new password and it gets validated, then update password in db.
   */
  function newpass() {
    $code = $this->uri->segment(3);
    $user_id = $this->m_user->newPassCode($code);
    if ($user_id > 0) {
      $data['title'] = 'Change password';
      $this->load->view('new_password/v_change_password');
    } else {
      redirect('user/codeerror');
    }
  }

  /*
   * create receipt page
   */
  function passchanged() {
    $data['title'] = 'Password success';
    $this->load->view('/include/v_header', $data);
    $this->load->view('new_password/v_success');
    $this->load->view('include/v_footer');
  }

  /**
   * If the activationcode has expired or the code was wrong.
   * Show this errror page.
   */
  function codeerror(){
    $data['title'] = 'Error';
    $this->load->view('/include/v_header', $data);
    $this->load->view('new_password/v_code_error');
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
   *
  function update() {
    $id = $this->uri->segment(3);
    $this->m_user->update($id);
    $this->all();
  }
*/

  /**
   * Delete row - id as segment 3
   */
  function delete() {
    $id = $this->uri->segment(3);
    $data['records'] = $this->m_user->delete($id);
    $this->all(20);
  }

}