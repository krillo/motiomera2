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
    } 
	}


	function index(){
    redirect('/start');
	}


/*********** COMPANYADMIN ****************/

  /**
   * Show settings admin page (White Label Admin page)
   * Always check that the user has enough priviledges
   */
  function companyadmin(){
    if($this->session->userdata('role_level') > self::COMP_ADM_LEVEL){
      $data['title'] = 'companyadmin';
      $this->load->view('include/v_header', $data);
      $this->load->view('admin/v_company_admin');
    } else {
      redirect('/start');
    }
  }


/*********** SUPPORT ****************/

  /**
   * Show support admin page
   * Always check that the user has enough priviledges
   */
  function support(){
    if($this->session->userdata('role_level') > self::SUPPORT_ADM_LEVEL){
      $data['title'] = 'support';
      $this->load->view('include/v_header', $data);
      $this->load->view('admin/v_support');
      $this->load->view('admin/v_list_users');
      //$this->load->view('admin/v_data_table_test');
      $this->load->view('admin/v_admin');
    } else {
      redirect('/start');
    }
  }

  /**
   * Wildcard search of users
   * Always check that the user has enough priviledges
   */
  function findusers() {
    if ($this->session->userdata('role_level') > self::SUPPORT_ADM_LEVEL) {
      //$search_word = $this->uri->segment(3);
      $search_word = $this->input->post('search');
      $data['records'] = $this->m_user->getByWildcard($search_word);
      $data['search_word'] = $search_word;
      //$this->load->view('/snippets/v_test_snippet', $data);
      $this->load->view('/snippets/v_users_search_result', $data);
    } else {
      redirect('/start');
    }
  }

  /**
   * This function puts all the relevant session parameters as if she were the user.
   * Then redirect to mypage.
   * Handle all the data here so that this the only way to simulate.
   * Always check that the user has enough priviledges
   */
  function simulate() {
    if ($this->session->userdata('role_level') > self::SUPPORT_ADM_LEVEL) {
      $real_nick = $this->session->userdata('user_nick');
      $real_user_id = $this->session->userdata('user_id');
      $simulate_id = $this->uri->segment(3);
      $data = $this->m_user->getById($simulate_id);
      $session_data = array(
          'user_id' => $data[0]->id,
          'user_mail' => $data[0]->email,
          'user_full_name' => $data[0]->f_name . " " . $data[0]->l_name,
          'user_nick' => $data[0]->nick,
          'user_logged_in' => TRUE,
          'total_steps' => $data[0]->total_steps,
          'total_logins' => $data[0]->total_logins,
          'total_regs' => $data[0]->total_regs,
          'total_calories' => $this->m_step->getCaloriesFromSteg($data[0]->total_steps),
          'simulation' => TRUE,
      );
      $this->session->set_userdata($session_data);
      $simulate_nick = $data[0]->nick;
      log_message('info', "$real_nick ($real_user_id) is simulating $simulate_nick ($simulate_id) ");
      redirect('/mypage');
    }
  }

  
  /**
   * This function restores all the administrators session parameters.
   * Then redirect to mypage.
   * Handle all the data here so that this the only way to simulate.
   * Always check that the user has enough priviledges
   */
  function stopsimulate(){
    if ($this->session->userdata('role_level') > self::SUPPORT_ADM_LEVEL) {
      $real_user_id = $this->session->userdata('real_user_id');
      $data = $this->m_user->getById($real_user_id);
      $session_data = array(
          'user_id' => $data[0]->id,
          'user_mail' => $data[0]->email,
          'user_full_name' => $data[0]->f_name . " " . $data[0]->l_name,
          'user_nick' => $data[0]->nick,
          'user_logged_in' => TRUE,
          'total_steps' => $data[0]->total_steps,
          'total_logins' => $data[0]->total_logins,
          'total_regs' => $data[0]->total_regs,
          'total_calories' => $this->m_step->getCaloriesFromSteg($data[0]->total_steps),
          'simulation' => FALSE,
      );
      $this->session->set_userdata($session_data);
      redirect('/mypage');    }
  }



/*********** WHITE LABEL ****************/

  /**
   * The White Label admin page
   * Show settings admin page
   * Always check that the user has enough priviledges
   */
  function settings(){
    if($this->session->userdata('role_level') > self::WL_ADM_LEVEL){
      $data['title'] = 'advanced settings';
      $this->load->view('include/v_header', $data);
      $this->load->view('admin/v_adv_settings');
    } else {
      redirect('/start');
    }
  }

  /**
   * List activites 
   */
  function activities($limit = 20){
    if($this->session->userdata('role_level') > self::WL_ADM_LEVEL){
      $wl_id = $this->session->userdata('wl_id');
      $data['records'] = $this->m_activities->getAll($wl_id, $limit);
      $this->load->view('admin/v_adv_settings_activities', $data);
    } else {
      redirect('/start');
    }
  }


  /**
   * create a new activity
   * all parameters via post
   */
  function create_activity() {
    if ($this->session->userdata('role_level') > self::WL_ADM_LEVEL) {
      $wl_id = $this->session->userdata('wl_id');
      $name = $this->input->post('name');
      $multiplicity = $this->input->post('multiplicity');
      $severity = $this->input->post('severity');
      $unit = $this->input->post('unit');
      $desc = $this->input->post('desc');
      $this->m_activities->create($wl_id, $name, $multiplicity, $severity, $unit, $desc);
      $this->activities();
    } else {
      redirect('/start');
    }
  }


	/**
   * Delete activity
   * activiy_id as segment 3
   * the user must have at least WL admin level
   */
	function delete_activity(){
    if($this->session->userdata('role_level') > self::WL_ADM_LEVEL){
      $activity_id = $this->uri->segment(3);
      $this->m_activities->delete($activity_id);
      $this->activities();
    } else {
      redirect('/start');
    }
  }





  /*********** SUPERADMIN ****************/

  /**
   * Show settings admin page (White Label Admin page)
   * Always check that the user has enough priviledges
   */
  function superadmin(){
    if($this->session->userdata('role_level') > self::SUPER_ADM_LEVEL){
      $data['title'] = 'superadmin';
      $this->load->view('include/v_header', $data);
      $this->load->view('admin/v_superadmin');
    } else {
      redirect('/start');
    }
  }


}

