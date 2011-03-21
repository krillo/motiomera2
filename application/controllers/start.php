<?php
/**
 * Description of step
 *
 * @author make
 */
class Start extends CI_Controller{


  function index(){
    $param = $this->uri->segment(2);

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
    if($this->m_user->authenticate($this->input->post('user'), $this->input->post('pwd'))){
      redirect('/mypage');
    } else {
      //todo: error wrong login credentials
      $this->_showHomePage();
    }
  }


  function logout(){
    $this->m_user->logout();
    //$this->session->sess_destroy();
    $this->_showHomePage();
  }


    /**
   * Show homePage
   */
  function _showHomePage() {
    $data['title'] = 'MotioMera';
    $this->load->view('/include/v_header', $data);
    $this->load->view('/include/v_debug');
    $this->load->view('v_startpage');
  }





}