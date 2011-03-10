<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Temp extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->all();
	}


  /**
   * Show all records - limit as 3rd segment, auto populated as first parameter
   */
  function all($limit = 20){
    $data['records'] = $this->m_temp->getAll($limit);
    $this->load->view('admin/v_view', $data);
  }

  /**
   * this function does getById - id as segment 3
   */
  function get($id){
    $data['records'] = $this->m_temp->getById($id);
    $this->load->view('admin/v_view', $data);
  }



	function count(){
    $data['records'] = $this->m_temp->count();
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
      'name' => $this->input->post('name'),
      'descr' => $this->input->post('descr'),
    );
    $this->m_temp->create($data);
    $this->all();
	}

  /**
   * Edit row - id as segment 3
   */
  function edit(){
    $data['records'] = $this->m_temp->getById($this->uri->segment(3));
    $this->load->view('admin/v_edit', $data);
  }


	/**
   * Update row - id as segment 3
   */
	function update(){
    $id = $this->uri->segment(3);
    $data = array(
      'name' => $this->input->post('name'),
      'descr' => $this->input->post('descr'),
    );
    $this->m_temp->update($id, $data);
    $this->all();
	}

	/**
   * Delete row - id as segment 3
   */
	function delete(){
    $id = $this->uri->segment(3);
    $data['records'] = $this->m_temp->delete($id);
    $this->all(20);
  }


}