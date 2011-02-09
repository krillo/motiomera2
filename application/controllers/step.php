<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Step extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->all();
	}




  /**
  /**
   * Show all records - limit as 3rd segment, auto populated as first parameter
   */
  function all($limit = 20){
    //$limit = $this->uri->segment(3);
    $data['records'] = $this->m_step->getAll($limit);
    $this->load->view('admin/v_view', $data);
    //$this->load->view('v_default', $data);
    //$this->output->enable_profiler(true);
  }

  /**
   * this function does getById - id as segment 3
   */
  function get(){
    $id = $this->uri->segment(3);
    $data['records'] = $this->m_step->getById($id);
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
   * Creates a new row
   */
  function create(){
    $data = array(
      'member_id' => $_POST['member_id'],
      'activity_id' => $_POST['activity_id'],
      'count' => $this->input->post('count'),
      'steps' => $_POST['steps'],
      'date' => $_POST['date']
    );
    //print_r($data); die();
    $this->m_step->create($data);
    $this->all();
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
      'member_id' => $_POST['member_id'],
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











/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of step
 *
 * @author make
 */
/*
class step extends CI_Controller{
  
  
  function index(){
    $this->load->view('v_mypage');
  }
  
  function getAll(){
    $this->load->model('step');
    $data['records'] = $this->step->getAll();
    $this->load->view('step_view', $data);
  }


  function store(){
    //field name, error mesg, validation rule
    $this->form_validation->set_rules('steps', 'steg', 'trim|required|numeric|max_length[5]' );

    if ($this->form_validation->run() == FALSE){
			$this->load->view('v_steps');
		}else{
      echo 'store ok';
			//$this->load->view('formsuccess');
		}

  }


  function krillo(){
    echo 'apa'; die();
    $a = new Activities();
    
    $a->steps();
  }
}
 */


}