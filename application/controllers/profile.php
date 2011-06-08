<?php
/**
 * Description of step
 *
 * @author make
 */
class Profile extends CI_Controller{


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
    $user_id = $this->uri->segment(3);
    $this->_showProfilePage($user_id);
  }


  /**
   * Show profile page
   * @param <type> $user_id
   */
  function _showProfilePage($user_id){
    $data['user'] = $this->m_user->getById($user_id);
    $data['contest'] = $this->m_user->getCurrentContestTeamKeyById($user_id);
    
    $data['title'] = 'profile page';
    $this->load->view('include/v_header', $data);
    $this->load->view('profile/v_main');

    $this->load->view('mypage/v_mypage');



    $this->load->view('mypage/v_map');

    $toplist1['toplist'] = $this->m_step->getToplistDays($user_id, 6, 4);
    $toplist1['toplist_title'] = 'Top of the week';
    $toplist1['unique_id'] = "topweek";
    $this->load->view('snippets/v_toplist', $toplist1);
    $this->load->view('mypage/v_gift_area');
    $this->load->view('mypage/v_total_steps');


    $this->load->view('include/v_footer');

/*
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
 * 
 */
  }

}
?>
