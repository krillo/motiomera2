<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Error extends CI_Controller {

  function __construct() {
    parent::__construct();
  }

  function index() {
    $errorid = $this->uri->segment(3);
    switch ($errorid) {
      case -1:
        $this->_showDefaultViews();
        $data['message'] = 'Du har uppgivit fel användarnamn eller lösenord';
        $this->load->view('v_message', $data);
        break;
      case -2:
        $this->_showDefaultViews();
        $data['message'] = 'Din tävlingsperiod har gått ut';
        $this->load->view('v_message', $data);
        //$this->load->view('v_priv_campaigns');
        break;

      default:
        break;
    }
  }

  function _showDefaultViews() {
    $data['title'] = 'MotioMera';
    $this->load->view('/include/v_header', $data);
    $this->load->view('/include/v_debug');
  }

}