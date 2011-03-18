<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Krillo extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		//$this->load->view('addsteps_view');
    //$calcSteps = $this->m_activities->calcSteps(2, 30);
    //echo $calcSteps;

    //$same = $this->m_activities->getSameName(2);
    //print_r($same);

    //$data['severity_data'] = $this->m_activities->getSameName(2, true);
    //print_r($data);
    //$this->load->view('include/v_severitydropdown', $data);

    //echo "apa";
    //$data['step_data'] = $this->m_step->getByUserId(3, 'TEMP', '2011-03-07', '2011-03-07', 20);
    //print_r($data);

    //$this->load->view('include/v_header');
    //$this->load->view('v_krillo');

    //$data['records'] = $this->m_user->getByWildcard('em');
    //print_r($data);

    $data = $this->m_step->create_x(3, 1, 1, '2011-03-03');
    print_r($data);

	}



  function apa(){
    $data['key1'] = "value1";
    $data['key2'] = "value2";
    $data['todo'] = array("clean", "phone home", "sleep");
		$this->load->view('krillo_view', $data);
	}




}