<?php
/**
 * Description of step
 *
 * @author make
 */
class Mypage extends CI_Controller{


  /**
   * This function checks wether a user is logged in or not, redirects to correct page.
   * If user has higher level than user, then display the admin-bar
   */
  function index(){    
    if($this->m_user->isLoggedIn()){
      $this->_showMyPage($this->session->userdata('user_id'));
    } else {
      $this->load->view('v_startpage');
    }
  }

  

  /**
   * Show my page
   * @param <type> $id
   */
  function _showMyPage($id){
    $data = $this->m_user->getById($id);
    $this->load->view('v_mypage', $data);
    $this->reportStepDialog();
  }


  /**
   * Display the "report steps data"- dialog view
   * with all the data prepared
   */
  function reportStepDialog(){
    $data = $this->m_activities->getUnique();
    $prep['activites_data'] = $this->_prepareStepList($data);
    $this->load->view('dialog/v_steps_dialog', $prep);
  }
  


  /**
   * login the user
   */
  function login(){
    if($this->m_user->authenticate($this->input->post('username'), $this->input->post('password'))){
      $this->_showMyPage($this->session->userdata('user_id'));
    } else {
      //todo error wrong login credentials
      $this->load->view('v_startpage', $data);
      die();
    }
  }

  /**
   * logs out the user
   */
  function logout(){
    $this->m_user->logout();
    $this->load->view('v_startpage');
  }


  function steps(){
    $data = $this->m_activities->getUnique();
    $prep['activites_data'] = $this->_prepareStepList($data);
    //print_r($prep); die();
    $this->load->view('v_steps', $prep);
  }

  /**
   * Returns an array to match the dropdown helper
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