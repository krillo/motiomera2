<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Krillo extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->load->view('addsteps_view');
	}

  function store(){
    //field name, error mesg, validation rule
    $this->form_validation->set_rules('steps', 'steg', 'trim|required|numeric|max_length[5]' );
    $this->form_validation->set_rules('email', 'epost', 'trim|required|valid_email');

    if ($this->form_validation->run() == FALSE){
			$this->load->view('addsteps_view');
		}else{
      echo 'store ok';
			//$this->load->view('formsuccess');
		}

  }

  function apa(){
    $data['key1'] = "value1";
    $data['key2'] = "value2";
    $data['todo'] = array("clean", "phone home", "sleep");
		$this->load->view('krillo_view', $data);
	}


  function getAll(){
    //echo "jepp";
    $this->load->model('m_activities');
    $data['records'] = $this->m_activities->getAll(10);
    $this->load->view('v_activities', $data);
  }

  function getById(){
    $this->load->model('m_activities');
    $data['records'] = $this->m_activities->getById();
    $this->load->view('v_activities', $data);
  }

}