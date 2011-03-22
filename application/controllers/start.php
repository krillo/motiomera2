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
    $this->load->view('include/v_debug');
    $this->load->view('v_startpage');
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