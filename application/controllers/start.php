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
      $this->load->view('/include/v_header');
      $this->load->view('v_startpage');
    }
  }



  /**
   * login the user
   */
  function login(){
    if($this->m_user->authenticate($this->input->post('username'), $this->input->post('password'))){
      redirect('/mypage');
    } else {
      //todo: error wrong login credentials
      $this->load->view('/include/v_header');
      $this->load->view('v_startpage', $data);
      die();
    }
  }


  function logout(){
    $this->m_user->logout();
    redirect('/');
  }





}