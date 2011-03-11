<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{

  const USER_LEVEL = 10;
  const COMP_ADM_LEVEL = 40;
  const SUPPORT_ADM_LEVEL = 50;
  const WL_ADM_LEVEL = 70;
  const SUPER_ADM_LEVEL = 90;


  /**
   * Constructor
   * Don't even allow a user pass the constructor if she is not logged in or have at least COMP_ADM_LEVEL
   */
	function __construct(){
		parent::__construct();
    if(!$this->m_user->isLoggedIn() || $this->session->userdata('role_level') < self::COMP_ADM_LEVEL){
      $this->load->view('v_startpage');
    } else {
      $this->load->view('include/v_header');
    }
	}


	function index(){
    redirect('/start');
	}



  /**
   * Show settings admin page (White Label Admin page)
   * Always check that the user has enough priviledges
   */
  function companyadmin(){
    if($this->session->userdata('role_level') > self::COMP_ADM_LEVEL){
      $this->load->view('admin/v_company_admin');
    } else {
      redirect('/start');
    }
  }


  /**
   * Show support admin page
   * Always check that the user has enough priviledges
   */
  function support(){
    if($this->session->userdata('role_level') > self::SUPPORT_ADM_LEVEL){
      $this->load->view('admin/v_support');
      $this->load->view('admin/v_list_users');
      $this->load->view('admin/v_admin');
    } else {
      redirect('/start');
    }
  }


  /**
   * Show settings admin page (White Label Admin page)
   * Always check that the user has enough priviledges
   */
  function settings(){
    if($this->session->userdata('role_level') > self::WL_ADM_LEVEL){
      $this->load->view('admin/v_advanced_settings');
    } else {
      redirect('/start');
    }
  }


  /**
   * Show settings admin page (White Label Admin page)
   * Always check that the user has enough priviledges
   */
  function superadmin(){
    if($this->session->userdata('role_level') > self::SUPER_ADM_LEVEL){
      $this->load->view('admin/v_superadmin');
    } else {
      redirect('/start');
    }
  }


}

