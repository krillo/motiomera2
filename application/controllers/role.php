<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Role extends CI_Controller{

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
    $data['records'] = $this->m_role->getAll($limit);
    $this->load->view('admin/v_view', $data);
  }

  /**
   * this function does getById - id as segment 3
   */
  function get($id){
    $data['records'] = $this->m_role->getById($id);
    $this->load->view('admin/v_view', $data);
  }



	function count(){
    $data['records'] = $this->m_role->count();
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
      'level' => $this->input->post('level'),
      'descr' => $this->input->post('descr'),
      'name' => $this->input->post('name'),
    );
    $this->m_role->create($data);
    $this->all();
	}

  /**
   * Edit row - id as segment 3
   */
  function edit(){
    $data['records'] = $this->m_role->getById($this->uri->segment(3));
    $this->load->view('admin/v_edit', $data);
  }


	/**
   * Update row - id as segment 3
   * level  	descr  	name
   */
	function update(){
    $id = $this->uri->segment(3);
    $data = array(
      'level' => $this->input->post('level'),
      'descr' => $this->input->post('descr'),
      'name' => $this->input->post('name'),
    );
    $this->m_role->update($id, $data);
    $this->all();
	}

	/**
   * Delete row - id as segment 3
   */
	function delete(){
    $id = $this->uri->segment(3);
    $data['records'] = $this->m_role->delete($id);
    $this->all(20);
  }


}