<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * The Step controller class handles steps
 *
 * @author Kristian Erendi, Aller media 2011
 */
class Step extends CI_Controller {

  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->all();
  }

  function submit() {
    $this->all();
  }



  /**
   * Show all records - limit as 3rd segment, auto populated as first parameter
   */
  function all($limit = 20) {
    $limit = $this->uri->segment(3);
    $data['records'] = $this->m_step->getAll($limit);
    $this->load->view('admin/v_view', $data);
  }

  /**
   * this function does getById - id as segment 3
   */
  function get() {
    $id = $this->uri->segment(3);
    $data['records'] = $this->m_step->getById($id);
    $this->load->view('admin/v_view', $data);
  }

  /**
   * this function does getByUserId -
   * user_id as segment 3
   * limit as segmant 4
   */
  function user() {
    $user_id = $this->uri->segment(3);
    $limit = $this->uri->segment(4);
    $data['records'] = $this->m_step->getByUserId($user_id, $limit);
    $this->load->view('admin/v_view', $data);
  }

  function count() {
    $data['records'] = $this->m_step->count();
    $this->load->view('admin/v_default', $data);
  }

  /**
   * display the new form
   */
  function add() {
    $this->load->view('admin/v_add');
  }

  /**
   * Creates a new row of step data
   * Parameter must be passed by a post
   */
  function create() {
    $user_id = $this->input->post('user_id');
    $count = $this->input->post('count');
    $date = $this->input->post('date');
    $status = $this->input->post('status');
    $view = $this->input->post('view');
    $activity_id = $this->input->post('activity_id');
    if($activity_id == 'undefined'){
      $activity_id = $this->m_activities->getDefaultActivityId();
    }
    $step_id = $this->m_step->create_x($user_id, $activity_id, $count, $date);
    if ($view == 'showStepsPreview') {
      $this->_showStepsPreview($date);
    } else {
      $this->all();
    }
  }



  /**
   * shows nicely formatted html-snippet of steps for a user
   * date as a post parameter
   */
  function showStepsPreview(){
    $date = $this->input->post('date');
    $this->_showStepsPreview($date);
  }


  /**
   * shows nicely formatted html-snippet of steps for a user 
   */
  function _showStepsPreview($date){
    $user_id = $this->session->userdata('user_id');
    $data['records'] = $this->m_step->getByUserId($user_id, 'VALID', $date, $date, 200);
    $data['date'] = $date;
    $data['message'] = $this->m_message->getByUserIdDateType_1($user_id, $date, m_message::TYPE_USER);
    $this->load->view('include/v_preview-step-rows', $data);
  }



  /**
   * Edit row - id as segment 3
   */
  function edit() {
    $data['records'] = $this->m_step->getById($this->uri->segment(3));
    $this->load->view('admin/v_edit', $data);
  }

  /**
   * Update row - id as segment 3
   */
  function update() {
    $data = array(
        'user_id' => $_POST['user_id'],
        'activity_id' => $_POST['activity_id'],
        'count' => $this->input->post('count'),
        'steps' => $_POST['steps'],
        'date' => $_POST['date']
    );
    $id = $this->uri->segment(3);
    $this->m_step->update($data, $id);
    $this->all();
  }

  /**
   * Delete a row
   * The user must be logged in, checked from session.
   * The row will be deleted with both row_id and user_id as key, i.e. no other than the logged in owner of the steps can delete the row
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
      $data['records'] = $this->m_step->deleteByIds($id, $user_id);
      if ($view == 'showStepsPreview') {
        $this->_showStepsPreview($date);
      } else {
        $this->all(20);
      }
    }
  }
}