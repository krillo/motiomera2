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
   * @param <type> $id
   */
  function _showMyPage($id){
    $data = $this->m_user->getById($id);
    $data['title'] = 'mypage';
    $this->load->view('include/v_header', $data);
    $this->load->view('v_mypage');

    $toplist1['toplist'] = $this->m_step->getToplistDays(6, 5);
    $toplist1['toplist_title'] = 'Top of the week';
    $this->load->view('snippets/v_toplist', $toplist1);

    $toplist2['toplist'] = $this->m_step->getToplistDays(1, 10);
    $toplist2['toplist_title'] = 'Top of the day';
    $this->load->view('snippets/v_toplist', $toplist2);


    $toplist3['toplist'] = $this->m_step->getRankedToplistDays(10);
    $toplist3['toplist_title'] = 'Ranked list';
    $this->load->view('snippets/v_toplist', $toplist3);




    $this->load->view('include/v_debug');
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