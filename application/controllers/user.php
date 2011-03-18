<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{

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
   * create a new user
   */
  function newuser() {
    $data['title'] = 'register';
    $this->load->view('/include/v_header', $data);
    $this->load->view('v_new_user');
  }

  function useradress() {
    $data['title'] = 'User adress';
    $this->load->view('/include/v_header', $data);
    $this->load->view('v_new_user_adress');
  }
  /**
   * create new company
   */
  function newcompany() {
    $data['title'] = 'register company';
    $this->load->view('/include/v_header', $data);
    $this->load->view('v_new_company');
  }

  function companyadress() {
    $data['title'] = ' Company adress ';
    $this->load->view('/include/v_header', $data);
    $this->load->view('v_new_companyadress');
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