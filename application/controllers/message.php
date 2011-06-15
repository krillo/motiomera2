<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * The message controller class handles messages
 *
 * @author Kristian Erendi, Aller media 2011
 */
class Message extends CI_Controller {

  function __construct() {
    parent::__construct();
  }

  /**
   * Call this function from all functions in this class to prevent anybody but the logged in user run the function
   * else redirect to start page
   *
   * @param <type> $level
   * @return <type>
   */
  function auth($user_id) {
    if ($this->m_user->isLoggedIn() && $user_id == $this->session->userdata('user_id')) {
      return TRUE;
    } else {
      $data['message'] = "wrong user id";
      $this->load->view('v_message', $data);
      return FALSE;
    }
  }



  function index() {
    $this->all();
  }

  /**
   * Show all records - limit as 3rd segment, auto populated as first parameter
   */
  function all($limit = 20) {
    $limit = $this->uri->segment(3);
    $data['records'] = $this->m_message->getAll($limit);
    $this->load->view('admin/v_view', $data);
  }

  /**
   * this function does getById - id as segment 3
   */
  function get() {
    $id = $this->uri->segment(3);
    $data['records'] = $this->m_message->getById($id);
    $this->load->view('admin/v_view', $data);
  }



  /**
   * Shows nicely formatted html-snippet of steps for a user
   * Notice this is a copy from the Step class!
   * Not possible to run another controllers functions with paramters!
   */
  function _showStepsPreview($date){
    $user_id = $this->session->userdata('user_id');
    $data['records'] = $this->m_step->getByUserId($user_id, 'VALID', $date, $date, 200);
    $data['date'] = $date;
    $data['message'] = $this->m_message->getByUserIdDateType_1($user_id, $date, m_message::TYPE_USER);
    $this->load->view('include/v_preview-step-rows', $data);
  }

  
  /**
   * Creates a new row of message data
   * Parameter must be passed by a post
   * check that correct user does the update
   */
  function usercreate() {
    if ($this->auth($this->input->post('user_id'))) {
      $user_id = $this->input->post('user_id');
      $date = $this->input->post('date');
      $message = $this->input->post('message');
      $smiley = $this->input->post('smiley');
      $type = m_message::TYPE_USER;
      $message_id = $this->m_message->create($user_id, $message, $smiley, $date, $type);
      $this->_showStepsPreview($date);
    }
  }


  /**
   * Update row - id as segment 3
   * check that correct user does the update
   */
  function updatebyid() {
    if ($this->auth($this->input->post('user_id'))) {
      $data = array(
          'message' => $this->input->post('message'),
          'smiley' => $this->input->post('smiley')
      );
      $id = $this->uri->segment(3);
      $this->m_message->updateById($id, $data);
      $date = $this->input->post('date');
      $this->_showStepsPreview($date);
    }
  }

  /**
   * Delete a row
   * The user must be logged in, checked from session.
   * The row will be deleted with both row_id and user_id as key, i.e. no other than the logged in owner of the messages can delete the row
   *
   * segment 3 - row_id
   * segment 4 - view to be returned, if omitted, default will be displayed
   * segmant 5 - which date view should show
   */
  function delete() {
    if($this->m_user->isLoggedIn()) {
      $user_id = $this->session->userdata('user_id');
      $id = $this->uri->segment(3);
      $view = $this->uri->segment(4);
      $date = $this->uri->segment(5);
      $data['records'] = $this->m_message->deleteByIds($id, $user_id);
      if ($view == 'showmessagesPreview') {
        $this->_showmessagesPreview($date);
      } else {
        $this->all(20);
      }
    }
  }
}