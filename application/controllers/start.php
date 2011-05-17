<?php
/**
 * Description of step
 *
 * @author make
 */
class Start extends CI_Controller{


  function index(){
    if($this->m_user->isLoggedIn()){
      redirect('/mypage');
    } else {
      $this->_showHomePage();
    }
  }


  /**
   * 
   */
  function promo(){
    $data['title'] = 'For companys';
    $this->load->view('include/v_header', $data);
    $this->load->view('promo/v_promo');
    $this->load->view('include/v_footer');
  }


  /**
   * login the user
   */
  function login(){
    $loginStatus = $this->m_user->authenticate($this->input->post('user'), $this->input->post('pwd'));
    if($loginStatus > 0){
      redirect('/mypage');
    } else {
      redirect("/error/index/$loginStatus");
    }
  }


  /**
   * Show homePage
   */
  function _showHomePage() {
    $data['title'] = 'MotioMera';
    $this->load->view('include/v_header', $data);

    $this->load->view('startpage/v_member_profile');
    $this->load->view('startpage/v_slideshow');

    $toplist1['toplist'] = $this->m_step->getToplistDays(0, 6, 10);
    $toplist1['toplist_title'] = 'Top of the week';
    $toplist1['unique_id'] = "topweek";
    $this->load->view('snippets/v_toplist', $toplist1);

    $this->load->view('startpage/v_rss');

    $toplist2['toplist'] = $this->m_step->getToplistDays(0, 30, 25);
    $toplist2['toplist_title'] = 'Top of the month';
    $toplist2['unique_id'] = "topmonth";
    $this->load->view('snippets/v_toplist', $toplist2);
    $this->load->view('startpage/v_puff');
    $this->load->view('include/v_footer');
  }



  /**
   * Show error message
   */
  function _showWrongLogin($errorCode) {
    $data['title'] = 'MotioMera';
    $data['errorCode'] = $errorCode;
    $this->load->view('include/v_header', $data);
    $this->load->view('include/v_debug');
    $this->load->view('v_errorpage');
    $this->load->view('include/v_footer');
  }




}