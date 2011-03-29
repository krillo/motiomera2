<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Validate extends CI_Controller {

  function index() {
  }


  
  /**
   *
   */
  function companyaddress() {
    $this->form_validation->set_rules('company', 'Company', 'required|min_length[0]|max_length[30]');
    $this->form_validation->set_rules('street', 'Street', 'required');
    $this->form_validation->set_rules('contactpers', 'Contactpers', 'required');
    $this->form_validation->set_rules('zip', 'Zip', 'required|numeric');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[6]|max_length[255]');
    $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
    $this->form_validation->set_rules('mobnumber', 'Mobnumber', 'numeric');
    $this->form_validation->set_rules('country', 'Country', 'required');


    if ($this->form_validation->run() == FALSE) {
      $this->load->view('v_new_companyadress');
    } else {
      $this->load->view('v_new_companyadress');
    }
  }




  function companyreg() {
    $this->form_validation->set_rules('company', 'Company', 'required|min_length[0]|max_length[30]');
    $this->form_validation->set_rules('count1', 'count1', 'numeric');
    $this->form_validation->set_rules('count2', 'count2', 'numeric');
    $this->form_validation->set_rules('bransch', 'Bransch', 'required');
    $this->form_validation->set_rules('source', 'Source', 'required');
    $this->form_validation->set_rules('agree', 'Agree', 'required');


    if ($this->form_validation->run() == FALSE) {
      $this->load->view('v_new_company'); //reload same page
    } else { //success
      $company = $this->input->post('company');
      $count1 = $this->input->post('count1');
      $count2 = $this->input->post('count2');
      //$bransch = $this->input->post('bransch');
      //$source = $this->input->post('source');
      $user_id = $this->m_user->create_x($company, $count1, $count2, $bransch, $source);
      if($user_id >0) {
        redirect('/user/companyadress');
        $this->load->view('v_new_companyadress');
        }  else {
           redirect('/error/index/0');
      }
    }
  }

  /**
   * This function validates first step of a user registration.
   * On success it continues to the next registration page
   * On fail it shows error page.
   */
   function userreg() {
    $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[20]');
    $this->form_validation->set_rules('firstname', 'Firstname', 'required|min_length[0]|max_length[30]');
    $this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[0]|max_length[30]');
    $this->form_validation->set_rules('sex', 'Sex');
    $this->form_validation->set_rules('muni', 'Muni', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('email2', 'Email2', 'required|valid_email|matches[email]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[40]');
    $this->form_validation->set_rules('password2', 'Password2', 'required|matches[password]|min_length[6]|max_length[40]');
    $this->form_validation->set_rules('source', 'Source', 'required');
    $this->form_validation->set_rules('agree', 'Agree', 'required');
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('v_new_user');  //reload same page
    } else { //success
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $f_name = $this->input->post('firstname');
      $l_name = $this->input->post('lastname');
      $nick = $this->input->post('username');
      $sex = $this->input->post('sex');
      $muni = $this->input->post('muni');
      $source = $this->input->post('source');
      $user_id = $this->m_user->create_x($email, $password, $f_name, $l_name, $nick, $sex, $source, $muni);
      if($user_id > 0){
        redirect('/user/useradress');
        $this->load->view('v_new_user_adress');
      } else{
        redirect('/error/index/0');
      }
    }
  }



  function useraddress() {
    $this->form_validation->set_rules('firstname', 'Firstname', 'required|min_length[0]|max_length[30]');
    $this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[0]|max_length[30]');
    $this->form_validation->set_rules('street', 'Street', 'required');
    $this->form_validation->set_rules('zip', 'Zip', 'required|numeric');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('phone', 'Phone', 'numeric');
    $this->form_validation->set_rules('mobnumber', 'Mobnumber', 'numeric');
    $this->form_validation->set_rules('country', 'Country', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('v_new_user_adress');  //reload same page
    } else { //success
      $f_name = $this->input->post('firstname');
      $l_name = $this->input->post('lastname');
      $street = $this->input->post('street');
      $zip = $this->input->post('zip');
      $city = $this->input->post('city');
      $email = $this->input->post('email');
      $phone = $this->input->post('phone');
      $mobnumber = $this->input->post('mobnumber');
      $country = $this->input->post('country');
      $user_id = $this->m_user->create_x($f_name, $l_name, $street, $zip, $city, $email, $phone, $mobnumber, $country);
      if($user_id > 0) {
        redirect('/user/useradress');
        $this->load->view('v_new_user_adress');
    } else {
      redirect('/error/index/0');
    }
  }
}

}