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
   * For security reasons some models are not autoloaded but loaded here.
   *
   */
	function __construct(){
		parent::__construct();
    if(!$this->m_user->isLoggedIn() || $this->session->userdata('role_level') < self::COMP_ADM_LEVEL){
      $this->load->view('v_startpage');
    } else {
      $this->load->model('m_company');
    }
	}


	function index(){
    redirect('/start');
	}

  /** 
   * Call this function from all functions in this class to prevent anybody with lower access to run the function
   * If the users level in the session object is is higher than required then proceede into tghe function else redirect to start page
   *   
   * @param <type> $level
   * @return <type> 
   */
  function auth($level){
    if($this->session->userdata('role_level') > $level){
      return;
    } else {
      redirect('/start');
    }
  }




  /****************************** COMPANYADMIN **************************************/
  /****************************** COMPANYADMIN **************************************/

  /**
   * Show the company admin page
   * Always check that the user has enough priviledges<br/>
   *
   * Displays a full HTML page
   */
  function companyadmin() {
    $this->auth(self::COMP_ADM_LEVEL);
    $data['title'] = 'Company admin page';
    $user_id = $this->session->userdata('user_id');
    $data['company'] = $this->m_company->getByUserId($user_id);
    $company_id = $data['company'][0]->id;
    $data['contest'] = $this->m_contest->getCurrentContest($company_id);
    $contest_id = $data['contest'][0]->id;
    $data['contest_dates'] = $this->m_contest_dates->getDatesByContestId($contest_id);

    $start = date('Y-m-d', strtotime($data['contest'][0]->start));
    $data['start'] = $start;
    $stop = date('Y-m-d', strtotime($data['contest'][0]->stop));
    $data['stop'] = $stop;

    $this->load->view('include/v_header', $data);
    $this->load->view('admin/v_company_admin');
    $this->load->view('include/v_footer');
  }


  function companysettings() {
    $this->auth(self::COMP_ADM_LEVEL);
    $this->load->view('admin/v_test');
  }


  /**
   * Show the teams page
   * The contest_id is passed as segment 3
   *
   * Displays a partial HTML page
   */
  function teams($contest_id = null) {
    $this->auth(self::COMP_ADM_LEVEL);
    if($contest_id == null){
      $contest_id = $this->uri->segment(3);
    }
    $data['competition_data'] = $this->m_key->getTeamDataByContestId($contest_id);
    $data['teams'] = $this->m_team->getAllByContestId($contest_id);
    $this->load->view('admin/v_company_admin_teams', $data);
  }



  /**
   * Show the page for editing a team
   * 
   * Displays a partial HTML page
   */
  function teamedit($team_id = null) {
    $this->auth(self::COMP_ADM_LEVEL);
    if($team_id == null){
      $team_id = $this->uri->segment(3);
    }
    $data['team'] = $this->m_team->getById($team_id);
    $data['users'] = $this->m_key->getUsersByTeamId($team_id);
    $this->load->view('admin/v_company_admin_teams_edit', $data);
  }


  /**
   * Renames a team and shows the same page as function temaedit()
   *
   * Displays a partial HTML page
   */
  function renameteam() {
    $this->auth(self::COMP_ADM_LEVEL);
    $team_id = $this->uri->segment(3);
    $new_name = urldecode($this->uri->segment(4));
    $data['team'] = $this->m_team->updateName($team_id, $new_name);
    $this->teamedit();
  }


  /**
   * Remove team from db, but first reset all key references to null
   * team_id as segment 3
   * 
   * Redirect and display the code from $this->teams
   */
  function teamdelete(){
    $this->auth(self::COMP_ADM_LEVEL);
    $team_id = $this->uri->segment(3);
    $contest_id = urldecode($this->uri->segment(4));
    $this->m_key->removeTeam($team_id);
    $this->m_team->delete($team_id, $contest_id);
    $this->teams($contest_id);
  }


  /**
   * Remove user from team i.e set the user_id reference to null
   * Redirect and display the code from $this->teamedit
   */
  function removeuserfromteam(){
    $this->auth(self::COMP_ADM_LEVEL);
    $key_id = $this->uri->segment(3);
    $team_id = $this->uri->segment(4);
    $contest_id = $this->uri->segment(5);
    $this->m_key->removeUserByKeyId($key_id);
    $this->teamedit($team_id);
  }



  /**
   * Show the competitors page
   * The contest_id is passed as segment 3
   *
   * Displays a partial HTML page
   */
  function competitors() {
    $this->auth(self::COMP_ADM_LEVEL);
    $contest_id = $this->uri->segment(3);
    $data['competitors'] = $this->m_user->getByContestId($contest_id);
    $data['teams'] = $this->m_team->getActiveTeamsByContestId($contest_id);
    $data['competition_data'] = $this->m_key->getTeamDataByContestId($contest_id);
    $this->load->view('admin/v_company_admin_competitors', $data);
    $this->load->view('include/v_debug');
  }




   function additionalorders() {
    $this->auth(self::COMP_ADM_LEVEL);
    $this->load->view('admin/v_test');
  }

  /**
   * Show the keys page
   * If the user is a support admin, then add more views
   * The contest_id is passed as segment 3
   */
  function keys() {
    $this->auth(self::COMP_ADM_LEVEL);
    $contest_id = $this->uri->segment(3);
    $data['contest_id'] = $contest_id;
    if ($this->session->userdata('role_level') > self::SUPPORT_ADM_LEVEL) {
      $this->load->view('snippets/v_keys_add', $data);
    }
    $this->_showKeyList($contest_id);
    //$data['free_keys'] = $this->m_key->getFreeKeysByContestId($contest_id);
    //$this->load->view('admin/v_company_admin_keys', $data);
  }


  /**
   * Display the key list
   */
  function _showKeyList($contest_id){
    $this->auth(self::COMP_ADM_LEVEL);
    $data['contest_id'] = $contest_id;
    $data['free_keys'] = $this->m_key->getFreeKeysByContestId($contest_id);
    $this->load->view('snippets/v_keys_list', $data);
  }

  /**
   * Add keys to the current contest
   * Call this from jquery
   * It returns a list of all available keys
   * Notice that you have to be at least SUPPORT_ADM_LEVEL to run this function
   *
   * The contest_id is passed as segment 3
   * The count is passed as segment 4
   */
  function addkeys() {
    $this->auth(self::SUPPORT_ADM_LEVEL);
    $contest_id = $this->uri->segment(3);
    $nbr = $this->uri->segment(4);
    $keys = $this->m_key->generateKeys($nbr);
    $this->m_key->addKeysToDb($contest_id, $keys);
    $this->_showKeyList($contest_id);
    //$data['free_keys'] = $this->m_key->getFreeKeysByContestId($contest_id);
    //$this->load->view('snippets/v_keys_list', $data);
  }


  function reclamation() {
    $this->auth(self::SUPPORT_ADM_LEVEL);
    $this->load->view('admin/v_test');
  }


  /****************************** SUPPORT **************************************/
  /****************************** SUPPORT **************************************/

  /**
   * Show support admin page
   * Always check that the user has enough priviledges
   */
  function support(){
    if($this->session->userdata('role_level') > self::SUPPORT_ADM_LEVEL){
      $data['title'] = 'support';
      $this->load->view('include/v_header', $data);
      $this->load->view('admin/v_support');
      $this->load->view('include/v_footer');
    } else {
      redirect('/start');
    }
  }

  /**
   * List users
   * returns a search page and result snippet
   */
  function supportlegacy($limit = 20){
    if($this->session->userdata('role_level') > self::SUPPORT_ADM_LEVEL){
      $this->load->view('admin/v_data_table_test');
      $this->load->view('admin/v_admin');
    } else {
      redirect('/start');
    }
  }



  /**
   * List users
   * returns a search page and result snippet
   */
  function users($limit = 20){
    if($this->session->userdata('role_level') > self::SUPPORT_ADM_LEVEL){
      $this->load->view('admin/v_list_users');
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
   *
   * Always check that the user has enough priviledges
   */
  function simulate() {
    $this->auth(self::SUPPORT_ADM_LEVEL);
    $simulate_id = $this->uri->segment(3);
    $this->_simulate($simulate_id);
    redirect('/mypage');
  }


  /**
   * Just set the actual simulation parameters, no redirects
   * @param <type> $simulate_id
   */
  function _simulate($simulate_id) {
    $this->auth(self::SUPPORT_ADM_LEVEL);
    $real_nick = $this->session->userdata('user_nick');
    $real_user_id = $this->session->userdata('user_id');
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
  }


  /**
   * This function restores all the administrators session parameters.
   * Then redirect to mypage.
   * Handle all the data here so that this the only way to simulate.
   * Always check that the user has enough priviledges
   */
  function stopsimulate() {
    $this->auth(self::SUPPORT_ADM_LEVEL);
    $this->_stopsimulate();
    redirect('/mypage');
  }

  /**
   * Just reset the actual simulation parameters, no redirects
   */
  function _stopsimulate() {
    $this->auth(self::SUPPORT_ADM_LEVEL);
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
  }



  /****************************** WHITE LABEL **************************************/
  /****************************** WHITE LABEL **************************************/

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
  function createactivity() {
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
   * update an activity
   * all parameters via post
   */
  function updateactivity() {
    if ($this->session->userdata('role_level') > self::WL_ADM_LEVEL) {
      $wl_id = $this->session->userdata('wl_id');
      $activity_id = $this->input->post('activityid');
      $name = $this->input->post('name');
      $multiplicity = $this->input->post('multiplicity');
      $severity = $this->input->post('severity');
      $unit = $this->input->post('unit');
      $desc = $this->input->post('desc');
      $status = $this->m_activities->update($activity_id, $wl_id, $name, $multiplicity, $severity, $unit, $desc);
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
	function deleteactivity(){
    if($this->session->userdata('role_level') > self::WL_ADM_LEVEL){
      $activity_id = $this->uri->segment(3);
      $this->m_activities->delete($activity_id);
      $this->activities();
    } else {
      redirect('/start');
    }
  }





  /****************************** SUPERADMIN **************************************/
  /****************************** SUPERADMIN **************************************/


  /**
   * Show settings admin page (White Label Admin page)
   * Always check that the user has enough priviledges
   */
  function superadmin(){
    $this->auth(self::SUPER_ADM_LEVEL);
    $data['title'] = 'superadmin';
    $this->load->view('include/v_header', $data);
    $this->load->view('admin/v_superadmin');
  }

  function testdata(){
    $this->auth(self::SUPER_ADM_LEVEL);
    $this->load->view('admin/v_superadmin_testdata');
  }





  /**
   * This function creates and loads testdata into the db <br/>
   * Use it only during development
   *
   * 1. it finds all users and inserts random steps for them, a month back <br/>
   * 2. it runs all inserts from the file /db/initial_data.sql <br/>
   */
  function deploytestdata() {
    $this->auth(self::SUPER_ADM_LEVEL);
    $this->load->model('m_testdata');
    if(!$this->m_step->isTestDataLoaded()){
      // insert random steps
      // simulation of user is required to insert steps
      $users = $this->m_user->getAll(400);
      foreach ($users as $user) {
        $d = new JDate();
        $this->_simulate($user->id);
        for($i = 0; $i < 31; $i++ ){
          $this->m_step->create_x($user->id, 1, $this->_randomSteps(), $d->getDate());
          $d->subDays(1);
        }
        $this->_stopsimulate();
      }
      // inserts from file
      $filename = '/Users/make/_proj/motiomera2/db/initial_data.sql';
      $lines = file($filename);
      $row_id = 0;
      foreach ($lines as $line_num => $line) {
        if(!strstr($line, '--')){
          $row_id = $this->m_testdata->runSqlInsert($line);
        }
        if($row_id < 0){
          echo "problem with file $filename at row $line_num <br/> $line";
          break;
        }
      }
      echo 'Success! hopefully ;)';
    } else {
      echo 'Testdata allready run';
    }
  }


  /**
   * Just return a random number between 3300 and 9900
   * Test purpose
   * @return string
   */
  function _randomSteps(){
    $steps = '';
    $nbrs = "3684596879";
    for($i = 0; $i < 2; $i++ ){
      $steps .= $nbrs[mt_rand(0, strlen($nbrs) - 1) ];
    }
    $steps .= '00';
    return $steps;
  }



}

