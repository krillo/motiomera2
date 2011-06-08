<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{

  /**
   * Constructor
   * Don't even allow a user pass the constructor if she is not logged in or have at least COMP_ADM_LEVEL
   * For security reasons some models are not autoloaded but loaded here.
   *
   */
	function __construct(){
		parent::__construct();
    if(!$this->m_user->isLoggedIn() || $this->session->userdata('role_level') < COMP_ADM_LEVEL){
      $this->load->view('v_startpage');
    } else {
      $this->load->model('m_company');
      $this->load->model('m_settings');
      $this->load->model('m_white_label');
      $this->load->model('m_company_settings');
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
      return TRUE;
    } else {
      redirect('/start');
    }
  }




  /****************************** COMPANYADMIN **************************************/
  /****************************** COMPANYADMIN **************************************/

  /**
   * Show a companys admin page.
   * The company is selected by the user_id, the user that administrates the company.
   *
   * If the user has more priviledges than COMP_ADM_LEVEL, and sessionvariable
   * administer_company_id is set to a company_id then show that companys admin page
   *
   * Displays a full HTML page
   */
  function companyadmin($tab = 0) {
    $this->auth(COMP_ADM_LEVEL);    
    $company_id = $this->session->userdata('administer_company_id');
    if($this->session->userdata('role_level') > SUPPORT_ADM_LEVEL && $company_id != ''){
      $data = $this->_getCompanyDataByCompanyId($company_id);
    } else {
      $user_id = $this->session->userdata('user_id');
      $data = $this->_getCompanyDataByUserId($user_id);
    }
    $data['title'] = 'Company admin page';
    $data['tab'] = $tab;
    $this->load->view('include/v_header', $data);
    $this->load->view('admin/company_admin/v_main');
    $this->load->view('include/v_footer');
  }


  function _getCompanyDataByCompanyId($company_id){
    $this->auth(COMP_ADM_LEVEL);
    $data['company'] = $this->m_company->getByCompanyId($company_id);
    $company_id = $data['company']['id'];
    $data['contest'] = $this->m_contest->getCurrentContest($company_id);
    $contest_id = $data['contest']['id'];
    $data['contest_dates'] = $this->m_contest_dates->getDatesByContestId($contest_id);
    return $data;
  }

  /**
   * This function collects all important data for the company.
   *
   * @param <type> $user_id
   * @return <type>
   */
  function _getCompanyDataByUserId($user_id){
    $this->auth(COMP_ADM_LEVEL);
    $data['company'] = $this->m_company->getCompanyByUserId($user_id);
    $company_id = $data['company']['id'];
    $data['contest'] = $this->m_contest->getCurrentContest($company_id);
    $contest_id = $data['contest']['id'];
    $data['contest_dates'] = $this->m_contest_dates->getDatesByContestId($contest_id);
    return $data;
  }

  /**
   * This function collects all important data for that competition.
   *
   * @param <type> $customer_id
   * @return <type>
   */
  function _getCompanyDataByContestId($contest_id){
    $this->auth(COMP_ADM_LEVEL);
    $data['company'] = $this->m_company->getCompanyByContestId($contest_id);
    $data['contest'] = $this->m_contest->getContestById($contest_id);
    $data['contest_dates'] = $this->m_contest_dates->getDatesByContestId($contest_id);
    return $data;
  }



  /**
   * Show important dates tab.
   * If the user have more priviledges than COMP_ADM_LEVEL, then the dates will be editable on the page
   */
  function companydates(){
    $this->auth(COMP_ADM_LEVEL);
    $contest_id = $this->uri->segment(3);
    $data = $this->_getCompanyDataByContestId($contest_id);
    if($this->session->userdata('role_level') > SUPPORT_ADM_LEVEL){
      $data['editable'] = TRUE;
    } else {
      $data['editable'] = FALSE;
    }
    $this->load->view('admin/company_admin/v_dates', $data);
  }


  /**
   * Update contest dates.
   * only administrators with more privileges than SUPPORT_ADM_LEVEL are allow to do this
   */
  function companydatesupdate(){
    $this->auth(SUPPORT_ADM_LEVEL);
    $contest_id = $this->input->post('contest_id');
    $start = $this->input->post('start');
    $stop = $this->input->post('stop');
    if($this->m_contest->updateContestDates($contest_id, $start, $stop)){
      if($this->m_contest_dates->updateContestDates($contest_id, $stop)){
        $this->companyadmin();
      }
    }else{
      //todo not able to update, show error on admin page
      echo 'error';
    }
  }


  /**
   * Show the companystats tab
   * The 
   */
  function companystats() {
    $this->auth(COMP_ADM_LEVEL);
    $contest_id = $this->uri->segment(3);
    $data = $this->_getCompanyDataByContestId($contest_id);
    $d = new JDate($data['contest']['start']);
    $this->load->view('snippets/v_grid_start');
    $data['label_steps'] = 'Medel steg i ' . $data['company']['name'];
    $data['label_average'] = 'Medel samtliga deltagare';
    $data['graph'] = $this->m_step->getStepSumPerDayByContestId($contest_id, 'VALID', $d->getDate(), date('Y-m-d') );
    $data['average'] = $this->m_step->getAverageStepSumPerDay('VALID', $d->getDate(), date('Y-m-d') );
    $this->load->view('snippets/v_graph', $data);
    $this->load->view('snippets/v_grid_end');
  }


  /**
   * Show the teams page
   * The contest_id is passed as segment 3
   *
   * Displays a partial HTML page
   */
  function teams($contest_id = null) {
    $this->auth(COMP_ADM_LEVEL);
    if($contest_id == null){
      $contest_id = $this->uri->segment(3);
    }
    $data['competition_data'] = $this->m_key->getTeamDataByContestId($contest_id);
    $data['teams'] = $this->m_team->getAllByContestId($contest_id);
    $this->load->view('admin/company_admin/v_teams', $data);
  }



  /**
   * Show the page for editing a team
   * 
   * Displays a partial HTML page
   */
  function teamedit($team_id = null) {
    $this->auth(COMP_ADM_LEVEL);
    if($team_id == null){
      $team_id = $this->uri->segment(3);
    }
    $data['team'] = $this->m_team->getById($team_id);
    $data['users'] = $this->m_key->getUsersByTeamId($team_id);
    $this->load->view('admin/company_admin/v_teams_edit', $data);
  }


  /**
   * Renames a team and shows the same page as function temaedit()
   *
   * Displays a partial HTML page
   */
  function renameteam() {
    $this->auth(COMP_ADM_LEVEL);
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
    $this->auth(COMP_ADM_LEVEL);
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
    $this->auth(COMP_ADM_LEVEL);
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
    $this->auth(COMP_ADM_LEVEL);
    $company_id = $this->uri->segment(3);
    $contest_id = $this->uri->segment(4);
    $data['settings'] = $this->m_company_settings->getByCompanyId($company_id);
    $data['competitors'] = $this->m_user->getUsersByContestId($contest_id);
    $data['teams'] = $this->m_team->getActiveTeamsByContestId($contest_id);
    $data['competition_data'] = $this->m_key->getTeamDataByContestId($contest_id);
    $this->load->view('admin/company_admin/v_competitors', $data);
    $this->load->view('include/v_debug');
  }




   function additionalorders() {
    $this->auth(COMP_ADM_LEVEL);
    $this->load->view('admin/v_test');
  }

  /**
   * Show the keys page
   * If the user is a support admin, then add more views
   * The contest_id is passed as segment 3
   */
  function keys() {
    $this->auth(COMP_ADM_LEVEL);
    $contest_id = $this->uri->segment(3);
    $data['contest_id'] = $contest_id;
    if ($this->session->userdata('role_level') > SUPPORT_ADM_LEVEL) {
      $this->load->view('snippets/v_keys_add', $data);
    }
    $this->_showKeyList($contest_id);
    //$data['free_keys'] = $this->m_key->getFreeKeysByContestId($contest_id);
    //$this->load->view('admin/company_admin/v_keys', $data);
  }


  /**
   * Display the key list
   */
  function _showKeyList($contest_id){
    $this->auth(COMP_ADM_LEVEL);
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
    $this->auth(SUPPORT_ADM_LEVEL);
    $contest_id = $this->uri->segment(3);
    $nbr = $this->uri->segment(4);
    $keys = $this->m_key->generateKeys($nbr);
    $this->m_key->addKeysToDb($contest_id, $keys);
    $this->_showKeyList($contest_id);
    //$data['free_keys'] = $this->m_key->getFreeKeysByContestId($contest_id);
    //$this->load->view('snippets/v_keys_list', $data);
  }


  function reclamation() {
    $this->auth(COMP_ADM_LEVEL);
    $this->load->view('admin/v_test');
  }



  /**
   * List the company settings
   */
  function companysettings() {
    $this->auth(COMP_ADM_LEVEL);
    $company_id = $this->uri->segment(3);
    $data['company_id'] = $company_id;
    $data['records'] = $this->m_company_settings->getByCompanyId($company_id);
    $this->load->view('admin/company_admin/v_settings', $data);
  }


  /**
   * Update all settings
   * all parameters via post
   * return to settings panel (tab 2)
   */
  function company_settingsupdate() {
    $this->auth(COMP_ADM_LEVEL);
    $company_id = $this->uri->segment(3);
    foreach ($_POST as $key=>$value)  {
      if($key != 'save'){
        $data[$key] = $this->input->post($key);
      }
    }
    if($this->m_company_settings->update($company_id, $data)){
      $this->companyadmin(7);
    }else{
      echo 'error';
    }
  }




  /****************************** SUPPORT **************************************/
  /****************************** SUPPORT **************************************/

  /**
   * Show support admin page
   * Always check that the user has enough priviledges
   */
  function support() {
    $this->auth(SUPPORT_ADM_LEVEL);
    $data['title'] = 'support';
    $this->load->view('include/v_header', $data);
    $this->load->view('admin/support/v_main');
    $this->load->view('include/v_footer');
  }

  /**
   * List users
   * returns a search page and result snippet
   */
  function supportlegacy($limit = 20) {
    $this->auth(SUPPORT_ADM_LEVEL);
    $this->load->view('admin/v_data_table_test');
    $this->load->view('admin/v_admin');
  }

  /**
   * List users
   * returns a search page and result snippet
   */
  function users($limit = 20) {
    $this->auth(SUPPORT_ADM_LEVEL);
    $this->load->view('admin/support/v_list_users');
  }

  /**
   * Wildcard search of users
   * If -1 is submitted as search string then an initial search is done based on latest id 
   */
  function findusers() {
    $this->auth(SUPPORT_ADM_LEVEL);
    $search_word = $this->input->post('search');
    if($search_word == '-1'){  //initial listing
      $data['records'] = $this->m_user->getAll(40);
    } else {  //regular search
      $data['records'] = $this->m_user->getByWildcard($search_word);
    }
    $data['search_word'] = $search_word;
    $this->load->view('/admin/support/v_users_search_result', $data);
  }


  /**
   * List companys
   * returns a search page and result snippet
   */
  function companys() {
    $this->auth(SUPPORT_ADM_LEVEL);
    $this->load->view('admin/support/v_list_companys');
    $data['records'] = $this->m_company->getAll();
    $data['search_word'] = -1;
    //$this->load->view('/admin/support/v_companys_search_result', $data);
  }



  /**
   * This function does a wildcard search of companys.
   * If -1 is submitted as search string then an initial search is done based on latest id 
   */
  function findcompanys() {
    $this->auth(SUPPORT_ADM_LEVEL);
    $search_word = $this->input->post('search');
    if($search_word == '-1'){  //initial listing
      $data['records'] = $this->m_company->getAll(40);
    } else {  //regular search
      $data['records'] = $this->m_company->getByWildcard($search_word);
    }
    $data['search_word'] = $search_word;
    $this->load->view('/admin/support/v_companys_search_result', $data);
  }


  /**
   * Set session paramter "administer_company_id" and then show company admin page
   */
  function administercompany(){
    $this->auth(SUPPORT_ADM_LEVEL);
    $company_id = $this->uri->segment(3);
    if($company_id > 0){
      $session_data = array('administer_company_id' => $company_id);
      $this->session->set_userdata($session_data);
      $this->companyadmin();
    }else{
      //todo nice error
      echo "error, company id = $company_id";
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
    $this->auth(SUPPORT_ADM_LEVEL);
    $simulate_id = $this->uri->segment(3);
    $this->_simulate($simulate_id);
    redirect('/mypage');
  }


  /**
   * Just set the actual simulation parameters, no redirects
   * @param <type> $simulate_id
   */
  function _simulate($simulate_id) {
    $this->auth(SUPPORT_ADM_LEVEL);
    $real_nick = $this->session->userdata('user_nick');
    $real_user_id = $this->session->userdata('user_id');
    $data[0] = $this->m_user->getById($simulate_id);
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
    $this->auth(SUPPORT_ADM_LEVEL);
    $this->_stopsimulate();
    redirect('/mypage');
  }

  /**
   * Just reset the actual simulation parameters, no redirects
   */
  function _stopsimulate() {
    $this->auth(SUPPORT_ADM_LEVEL);
    $real_user_id = $this->session->userdata('real_user_id');
    $data[0] = $this->m_user->getById($real_user_id);
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
  function advsettings($tab = 0) {
    $this->auth(WL_ADM_LEVEL);
    $data['title'] = 'advanced settings';
    $data['tab'] = $tab;
    $wl_id = $this->session->userdata('wl_id');
    $data['wl'] = $this->m_white_label->getById($wl_id);
    $this->load->view('include/v_header', $data);
    $this->load->view('admin/adv_settings/v_main');
    $this->load->view('include/v_footer');
  }

  /**
   * List activites 
   */
  function activities($limit = 20) {
    $this->auth(WL_ADM_LEVEL);
    $wl_id = $this->session->userdata('wl_id');
    $data['records'] = $this->m_activities->getAll($wl_id, $limit);
    $this->load->view('admin/adv_settings/v_activities', $data);
  }

  /**
   * create a new activity
   * all parameters via post
   */
  function createactivity() {
    $this->auth(WL_ADM_LEVEL);
    $wl_id = $this->session->userdata('wl_id');
    $name = $this->input->post('name');
    $multiplicity = $this->input->post('multiplicity');
    $severity = $this->input->post('severity');
    $unit = $this->input->post('unit');
    $desc = $this->input->post('desc');
    $this->m_activities->create($wl_id, $name, $multiplicity, $severity, $unit, $desc);
    $this->activities();
  }

  /**
   * update an activity
   * all parameters via post
   */
  function updateactivity() {
    $this->auth(WL_ADM_LEVEL);
    $wl_id = $this->session->userdata('wl_id');
    $activity_id = $this->input->post('activityid');
    $name = $this->input->post('name');
    $multiplicity = $this->input->post('multiplicity');
    $severity = $this->input->post('severity');
    $unit = $this->input->post('unit');
    $desc = $this->input->post('desc');
    $status = $this->m_activities->update($activity_id, $wl_id, $name, $multiplicity, $severity, $unit, $desc);
    $this->activities();
  }

  /**
   * Delete activity
   * activiy_id as segment 3
   * the user must have at least WL admin level
   */
  function deleteactivity() {
    $this->auth(WL_ADM_LEVEL);
    $activity_id = $this->uri->segment(3);
    $this->m_activities->delete($activity_id);
    $this->activities();
  }




  /**
   * List settings
   */
  function settings() {
    $this->auth(WL_ADM_LEVEL);
    $wl_id = $this->session->userdata('wl_id');
    $data['records'] = $this->m_settings->getByWlId($wl_id);
    $this->load->view('admin/adv_settings/v_settings', $data);
  }


  /**
   * Update all settings
   * all parameters via post
   * return to settings panel (tab 2)
   */
  function settingsupdate() {
    $this->auth(WL_ADM_LEVEL);
    $wl_id = $this->session->userdata('wl_id');
    $wl_data = $this->m_white_label->getById($wl_id);
    foreach ($_POST as $key=>$value)  {
      if($key != 'save'){
        $data[$key] = $this->input->post($key);
      }
    }
    if($this->m_settings->update($wl_id, $data)){
      $this->m_settings->createSettingsFile($wl_id, $wl_data);
      $this->advsettings(2);   
    }else{
      echo 'error';
    }
  }








  /****************************** SUPERADMIN **************************************/
  /****************************** SUPERADMIN **************************************/

  /**
   * Show settings admin page (White Label Admin page)
   * Always check that the user has enough priviledges
   */
  function superadmin(){
    $this->auth(SUPER_ADM_LEVEL);
    $data['title'] = 'superadmin';
    $this->load->view('include/v_header', $data);
    $this->load->view('admin/superadmin/v_main');
    $this->load->view('include/v_footer');
  }

  function testdata(){
    $this->auth(SUPER_ADM_LEVEL);
    $this->load->view('admin/superadmin/v_testdata');
  }


  /**
   * It deletes all settings in the db and restores it with default values and generates a new settings file
   */
  function regeneratesettings(){
    $this->auth(SUPER_ADM_LEVEL);
    $this->m_settings->deleteByWlId(WL_ID);
    $this->m_settings->initialInsert(WL_ID);
    $wl_data = $this->m_white_label->getById(WL_ID);
    $file = $this->m_settings->createSettingsFile(WL_ID, $wl_data);
    echo $file;
  }



  /**
   * It deletes all company settings in the db and restores it with default values
   */
  function restorecompanysettings($company_id){
    $this->auth(SUPER_ADM_LEVEL);
    $this->m_company_settings->deleteByCompanyId($company_id);
    $this->m_company_settings->initialInsert($company_id);
  }

  /**
   * This function creates and loads testdata into the db <br/>
   * Use it only during development
   *

   * 1. it finds all users and inserts random steps for them, a month back <br/>
   * 2. it runs all inserts from the file /db/initial_data.sql <br/>
   */
  function deploytestdata() {
    $this->auth(SUPER_ADM_LEVEL);
    $this->load->model('m_testdata');
    if(!$this->m_step->isTestDataLoaded()){
      // inserts from file
      $docRoot = getenv("DOCUMENT_ROOT");
      $filename = $docRoot . '/db/initial_data.sql';
      $lines = file($filename);
      $row_id = 0;
      $success = TRUE;
      foreach ($lines as $line_num => $line) {
        if(!strstr($line, '--')){
          $row_id = $this->m_testdata->runSqlInsert($line);
        }
        if($row_id < 0){
          echo "problem with file $filename at row $line_num <br/> $line <br/>";
          $success = FALSE;
          break;
        }
      }
      //create some more users
      $data = array('Filippa', 'Mimmi', 'Tobbe', 'Carlfelix', 'Simpan', 'Mogge', 'janbanan', 'BigRred', 'bigbird', 'Bjork', 'johanna', 'jwalker','Lapen', 'greengreen', 'M', 'tomtekalendern', 'loffe', 'Klaas', 'Kaniin');
      $this->m_testdata->creteUsers($data);
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

      echo $success ? 'Success! hopefully ;)': '';
    } else {
      echo 'Testdata allready run';
    }
  }


  /**
   * Add some more steps to all users, three days back
   */
  function morestepdata() {
    $this->auth(SUPER_ADM_LEVEL);
    $this->load->model('m_testdata');
    $users = $this->m_user->getAll(400);
    // insert random steps
    // simulation of user is required to insert steps
    foreach ($users as $user) {
      $d = new JDate();
      $this->_simulate($user->id);
      for ($i = 0; $i < 3; $i++) {
        $this->m_step->create_x($user->id, 1, $this->_randomSteps(), $d->getDate());
        $d->subDays(1);
      }
      $this->_stopsimulate();
    }
    echo 'Success! hopefully ;)' ;
  }





  /**
   * Just return a random number between 3300 and 9900
   * Test purpose
   * @return string
   */
  function _randomSteps(){
    return rand(3000, 9000);
  }



}

