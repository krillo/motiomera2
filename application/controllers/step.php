<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Step extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->all();
	}


	function submit(){
		$this->all();
	}



  /**
  /**
   * Show all records - limit as 3rd segment, auto populated as first parameter
   */
  function all($limit = 20){
    $limit = $this->uri->segment(3);
    $data['records'] = $this->m_step->getAll($limit);
    $this->load->view('admin/v_view', $data);
  }

  /**
   * this function does getById - id as segment 3
   */
  function get(){
    $id = $this->uri->segment(3);
    $data['records'] = $this->m_step->getById($id);
    $this->load->view('admin/v_view', $data);
  }


  /**
   * this function does getByUserId -
   * user_id as segment 3
   * limit as segmant 4
   */
  function user(){
    $user_id = $this->uri->segment(3);
    $limit = $this->uri->segment(4);
    $data['records'] = $this->m_step->getByUserId($user_id, $limit);
    $this->load->view('admin/v_view', $data);
  }




	function count(){
    $data['records'] = $this->m_step->count();
    $this->load->view('admin/v_default', $data);
	}


  /**
   * display the new form
   */
  function add(){
    $this->load->view('admin/v_add');
  }

  /**
   * Creates a new row.
   * parameter must be passed by a post
   *
   */
  function create() {
    $user_id     = $this->input->post('user_id');
    $activity_id = $this->input->post('activity_id');
    $count       = $this->input->post('count');
    $date        = $this->input->post('date');
    $status      = $this->input->post('status');
    $view        = $this->input->post('view');
    $data = array(
        'user_id' => $user_id,
        'activity_id' => $activity_id,
        'count' => $count,
        'date' => $date,
        'status'=> $status
    );
    //print_r($data); die();
    $this->m_step->create($data);
    if($view == 'showStepsPreview'){
      $this->showStepsPreview();
    } else {
      $this->all();
    }    
  }





function showStepsPreview(){
    $user_id     = $this->input->post('user_id');
    $date        = $this->input->post('date');
    $data['records'] = $this->m_step->getByUserId($user_id, 'VALID', $date, $date, 200);
    $this->load->view('include/v_preview-step-rows', $data);
}





  /**
   * Edit row - id as segment 3
   */
  function edit(){
    $data['records'] = $this->m_step->getById($this->uri->segment(3));
    $this->load->view('admin/v_edit', $data);
  }


	/**
   * Update row - id as segment 3
   */
	function update(){
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
   * Delete row - id as segment 3
   */
	function delete(){
    $id = $this->uri->segment(3);
    $data['records'] = $this->m_step->delete($id);
    $this->all(20);
  }

}