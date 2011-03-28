    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
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
      $this->load->view('v_new_company');
    } else {
      $this->load->view('v_new_companyadress');
    }
  }




   function userreg() {
    $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[20]');
    $this->form_validation->set_rules('firstname', 'Firstname', 'required|min_length[0]|max_length[30]');
    $this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[0]|max_length[30]');
    $this->form_validation->set_rules('muni', 'Muni', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('email2', 'Email2', 'required|valid_email|matches[email]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[40]');
    $this->form_validation->set_rules('password2', 'Password2', 'required|matches[password]|min_length[6]|max_length[40]');
    $this->form_validation->set_rules('source', 'Source', 'required');
    $this->form_validation->set_rules('agree', 'Agree', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('v_new_user');
    } else {
      $this->load->view('v_new_user_adress');
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
      $this->load->view('v_new_user_adress');
    } else {
      $this->load->view('v_new_user_adress');
    }
  }



}