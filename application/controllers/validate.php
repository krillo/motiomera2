<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Validate extends CI_Controller {

    private static $wl_id = 0;

	function __construct(){
		parent::__construct();
    $this->load->model('m_municipal');
    $this->load->model('m_source');
    $this->load->model('m_trade');
    $this::$wl_id = WL_ID;
	}


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
    $this->form_validation->set_rules('mobile', 'Mobile', 'numeric');
    $this->form_validation->set_rules('country', 'Country', 'required');


    if ($this->form_validation->run() == FALSE) {
      $this->load->view('/include/v_header');
      $this->load->view('/include/v_debug');
      $this->load->view('v_new_companyadress');
      $this->load->view('include/v_footer');
    } else {
      $this->load->view('v_new_companyadress');
    }
  }

/**
 * This function validates first step of a company registration.
 * On succcess it continues to the next registration page.
 * On fail it shows error page.
 */
  function companyreg() {
    $this->form_validation->set_rules('company', 'Company', 'required|min_length[0]|max_length[30]');
    $this->form_validation->set_rules('count1', 'count1', 'numeric');
    $this->form_validation->set_rules('count2', 'count2', 'numeric');
    $this->form_validation->set_rules('length', 'length');
    $this->form_validation->set_rules('start', 'Start');
    $this->form_validation->set_rules('trade', 'Trade', 'required');
    $this->form_validation->set_rules('source', 'Source', 'required');
    $this->form_validation->set_rules('agree', 'Agree', 'required');
    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'Register company';
      $data['trade'] = $this->m_trade->getAll();
      $data['source'] = $this->m_source->getAll($this::$wl_id, 'COMPANY');
      $this->load->view('/include/v_header');
      $this->load->view('include/v_debug');
      $this->load->view('v_new_company'); //reload same page
      $this->load->view('include/v_footer');     
    } else { //success
      $company = $this->input->post('company');
      $count1 = $this->input->post('count1');
      $count2 = $this->input->post('count2');
      $nof_weeks = $this->input->post('length');
      $start = $this->input->post('start');
      $trade = $this->input->post('trade');
      $source = $this->input->post('source');
      $user_id = $this->m_company->create($company, $count1, $count2, $nof_weeks, $start, $trade, $source);
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
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[20]|callback_username_exists');
    $this->form_validation->set_rules('firstname', 'Firstname', 'required|min_length[0]|max_length[30]|color(red)');
    $this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[0]|max_length[30]');
    $this->form_validation->set_rules('sex', 'Sex');
    $this->form_validation->set_rules('muni', 'Muni', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_exists');
    $this->form_validation->set_rules('email2', 'Email2', 'required|valid_email|matches[email]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[40]');
    $this->form_validation->set_rules('password2', 'Password2', 'required|matches[password]|min_length[6]|max_length[40]');
    $this->form_validation->set_rules('source', 'Source', 'required');
    $this->form_validation->set_rules('agree', 'Agree', 'required');

    if ($this->form_validation->run() == FALSE) {

      /* else
        {
        $this->load->view('v_new_user_adress');
        } */
      $dupUsername = $this->m_user->isDuplicateUsername($this->input->post('username'));
      if ($dupUsername) {
        $data['usernameError'] = 'Username already in use';
      }
      $dupEmail = $this->m_user->isDuplicateEmail($this->input->post('email'));
      if ($dupEmail) {
        $data['emailError'] = 'Email already in use';
      }
      //if ($this->form_validation->run() == FALSE OR $dupUsername OR $dupEmail) {
      $data['title'] = 'Register';
      $data['records'] = $this->m_municipal->getAll();
      $data['source'] = $this->m_source->getAll($this::$wl_id, 'PRIVATE');
      $this->load->view('/include/v_header', $data);
      $this->load->view('include/v_debug');
      $this->load->view('v_new_user');  //reload same page
      $this->load->view('include/v_footer');
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
      redirect('/user/useradress');
    }
    /* if($user_id > 0){
      redirect('/user/useradress');
      $this->load->view('v_new_user_adress');
      } else{
      redirect('/error/index/0');
      } */
  }

  /**
   * callback function with a message if username exists
   * @param <type> $username
   * @return <type>
   */
  function username_exists($username) {
    $this->form_validation->set_message('username_exists','The Username is already in use. Please try another Username.');
    if ($this->m_user->isDuplicateUsername($username)) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

  /**
   *  callback function with a message if email exists
   * @param <type> $email
   * @return <type>
   */
  function email_exists($email) {
    $this->form_validation->set_message('email_exists', 'The Email-address is already in use. Please try another Email.');
    if ($this->m_user->isDuplicateEmail($email)) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

  /**
   * This function validates the useraddress.
   * It updates post and redirect to receipt page.
   * On fail it shows error.
   */
  function useraddress() {
    $this->form_validation->set_rules('firstname', 'Firstname', 'required|min_length[0]|max_length[30]');
    $this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[0]|max_length[30]');
    $this->form_validation->set_rules('street', 'Street', 'required');
    $this->form_validation->set_rules('co', 'Co');
    $this->form_validation->set_rules('zip', 'Zip', 'required|numeric');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'numeric');
    $this->form_validation->set_rules('mobile', 'Mobile', 'numeric');
    $this->form_validation->set_rules('country', 'Country', 'required');
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('/include/v_header');
      $this->load->view('include/v_debug');
      $this->load->view('v_new_user_adress');  //reload same page
      $this->load->view('include/v_footer');
    } else { //validation is successful
      $id = $this->input->post('user_id');
      $f_name = $this->input->post('firstname');
      $l_name = $this->input->post('lastname');
      $address1 = $this->input->post('street');
      $co = $this->input->post('co');
      $zip = $this->input->post('zip');
      $city = $this->input->post('city');
      $phone = $this->input->post('phone');
      $mobile = $this->input->post('mobile');
      $country = $this->input->post('country');
      $user_id = $this->m_user->updateName($id, $f_name, $l_name);
      if($user_id > 0) {
        $type = 'PRIVATE';
        $company_id = NULL;
        $company_name = NULL;
        $ref_name = NULL;
        $address2 = NULL;
        $organisation_no = NULL;
        $tax_code = NULL;
        $email = NULL;
        $row_id = $this->m_address->create($company_id, $user_id, $type, $company_name, $ref_name, $address1, $address2, $co, $zip, $city, $email, $phone, $mobile, $country, $organisation_no, $tax_code);
        if($row_id > 0) {
          redirect('/user/receipt');
        } else {
          redirect('/error/index/0');
        }
    } else {
      redirect('/error/index/0');
    }
  }

   }
}