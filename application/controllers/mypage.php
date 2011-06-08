<?php
/**
 * Description of step
 *
 * @author make
 */
class Mypage extends CI_Controller{


  /**
   * Constructor
   * Don't even allow a user pass the constructor if she is not logged in
   */
	function __construct(){
		parent::__construct();
	}


  /**
   * This function checks wether a user is logged in or not, redirects to correct page.
   */
  function index(){
    if($this->m_user->isLoggedIn()){
      $this->_showMyPage($this->session->userdata('user_id'));
    } else {
      redirect('/start');
    }
  }


  /**
   * Show my page
   * @param <type> $user_id
   */
  function _showMyPage($user_id){
    $data['user'] = $this->m_user->getById($user_id);
    $data['title'] = 'mypage';
    $this->load->view('include/v_header', $data);
    $this->load->view('mypage/v_mypage');

    $data['contest'] = $this->m_user->getCurrentContestTeamKeyById($user_id);
    $this->load->view('mypage/v_map', $data);

    $toplist1['toplist'] = $this->m_step->getToplistDays($user_id, 6, 4);
    $toplist1['toplist_title'] = 'Top of the week';
    $toplist1['unique_id'] = "topweek";
    $this->load->view('snippets/v_toplist', $toplist1);
    $this->load->view('mypage/v_gift_area');
    $this->load->view('mypage/v_total_steps');

    $this->load->view('snippets/v_clear');
    $this->load->view('snippets/v_report_steps_icon');
    $this->load->view('mypage/v_route_icon');

    $this->load->view('mypage/v_detail_icon');
    $this->load->view('snippets/v_clear');

    $d = new JDate();
    $d->subDays(6);
    $data['label_steps'] = 'Dina steg';
    $data['label_average'] = 'Medel samtliga deltagare';
    $data['graph'] = $this->m_step->getStepSumPerDayByUserId($user_id, 'VALID', $d->getDate(), date('Y-m-d') );
    $data['average'] = $this->m_step->getAverageStepSumPerDay('VALID', $d->getDate(), date('Y-m-d') );
    $this->load->view('snippets/v_graph', $data);

    $this->load->view('mypage/v_the_wall');
    $this->load->view('snippets/v_clear');


    $toplist2['toplist'] = $this->m_step->getToplistDays($user_id, 1, 10);
    $toplist2['toplist_title'] = 'Top of the day';
    $toplist2['unique_id'] = "topday";
    $this->load->view('snippets/v_toplist', $toplist2);


    $this->load->view('snippets/v_clear');
    $this->load->view('include/v_footer');
    $this->_reportStepDialog();
  }



  /**
   * This function returns a snippet!
   * The "report steps data"- dialog view
   * with all the data prepared
   */
  function _reportStepDialog(){
    $wl_id = $this->session->userdata('wl_id');
    $data = $this->m_activities->getUnique($wl_id);
    $prep['activites_data'] = $this->_prepareStepList($data);
    $this->load->view('dialog/v_steps_dialog', $prep);
  }


  /**
   * Logs out the user.
   * There is an issue with destroying the session. It is fixed by doing a redirect
   */
  function logout(){
    $this->m_user->logout();
    redirect('/start');
  }


/*
  function steps(){
    $wl_id = $this->session->userdata('wl_id');
    $data = $this->m_activities->getUnique($wl_id);
    $prep['activites_data'] = $this->_prepareStepList($data);
    //print_r($prep); die();
    $this->load->view('v_steps', $prep);
  }
*/

  
  /**
   * Returns an array to match the dropdown helper
   *
   * <option label="Basket (min)" value="18">Basket (min)</option>
   * @param <type> $data
   * @return string
   */
  function _prepareStepList($data){
    $prepArray = array();
    foreach ($data as $key => $value) {
      if($value->unit != ''){
        $name = $value->name . ' (' . $value->unit . ')';
      } else{
        $name = $value->name;
      }
      $id = $value->id;
      $prepArray[$id] = $name;
    }
    return $prepArray;
  }







}