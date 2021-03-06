<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activities extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->load->view('v_activities');
	}

  function steps(){
    $data = $this->m_activities->getUnique();
    $prep['activites_data'] = $this->_prepareStepList($data);
    $this->load->view('v_steps', $prep);
  }

  /**
   *
   * <option label="Basket (min)" value="18">Basket (min)</option>
   * @param <type> $data
   * @return string
   */
  function _prepareStepList($data){
    $prepArray = array();
    foreach ($data as $key => $value) {
      $name = $value->name . ' (' . $value->unit . ')';
      $id = $value->id;
      $prepArray[$id] = $name;
    }
    return $prepArray;
  }



  /**
   * Show all records - limit as 3rd segment, auto populated as first parameter
   */
  function all($limit = 20){
    $data['records'] = $this->m_activities->getAll($limit);
    $this->load->view('admin/v_view', $data);
    //$this->output->enable_profiler(true);
  }



  /**
   * this function does getById - id as segment 3
   */
  function get(){
    $id = $this->uri->segment(3);
    $data['records'] = $this->m_activities->getById($id);
    $this->load->view('v_activities', $data);
  }


  /**
   * returns a list of unique (name) activities
   */
  function unique(){
    $data['records'] = $this->m_activities->getUnique();
    $this->load->view('admin/v_view', $data);
  }

  /**
   * Returns all activities with same name
   * 3rd segment takes an activity id
   */
  function same(){
    $activity_id =  $this->uri->segment(3);
    $wl_id = $this->session->userdata('wl_id');
    $data['severity_data'] = $this->m_activities->getSameName($activity_id, $wl_id, true);
    $this->load->view('include/v_severitydropdown', $data);
  }



	function count(){
    $data['records'] = $this->m_activities->count();
    $this->load->view('v_default', $data);
	}

  /**
   * Creates a new row
   */
  function create(){
    $data = array(
      'name' => $_POST['name'],
      'multiplicity' => $_POST['multiplicity'],
      'severity' => $this->input->post('severity'),
      'unit' => $_POST['unit']
    );
    //print_r($data); die();
    $this->m_activities->create($data);
    $this->all();
	}
  
  /**
   * Edit row - id as segment 3
   */
  function edit(){
    $data['records'] = $this->m_activities->getById($this->uri->segment(3));
    $this->load->view('admin/v_edit', $data);
  }


	/**
   * Update row - id as segment 3
   */
	function update(){
    $data = array(
      'name' => $_POST['name'],
      'multiplicity' => $_POST['multiplicity'],
      'severity' => $this->input->post('severity'),
      'unit' => $_POST['unit']
    );
    $this->m_activities->update($data);
    $data['records'] = $this->m_activities->getAll();
    $this->load->view('v_activities', $data);
	}

	/**
   * Delete activity
   * activiy_id as segment 3
   * the user must have at least WL admin level
   */
	function delete(){
    //if($this->session->userdata('role_level') > self::WL_ADM_LEVEL){
      $activity_id = $this->uri->segment(3);
      $data['records'] = $this->m_activities->delete($activity_id);
      $this->all(20);
    /*} else {
      redirect('/start');
    } 
    */

  }





}
