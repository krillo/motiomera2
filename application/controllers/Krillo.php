<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Krillo extends CI_Controller {

  function __construct() {
    parent::__construct();
  }

  function index() {
    //$this->load->view('addsteps_view');
    //$calcSteps = $this->m_activities->calcSteps(2, 30);
    //echo $calcSteps;
    //$same = $this->m_activities->getSameName(2);
    //print_r($same);
    //$data['severity_data'] = $this->m_activities->getSameName(2, true);
    //print_r($data);
    //$this->load->view('include/v_severitydropdown', $data);
    //echo "apa";
    //$data['step_data'] = $this->m_step->getByUserId(3, 'TEMP', '2011-03-07', '2011-03-07', 20);
    //print_r($data);
    //$this->load->view('include/v_header');
    //$this->load->view('v_krillo');
    //$data['records'] = $this->m_user->getByWildcard('em');
    //print_r($data);
    //$data = $this->m_step->create_x(3, 1, 1, '2011-03-03');
    //print_r($data);

    echo date('Y-m-d H:i:s');

    //$this->load->model('m_testdata');
    //$data = array('Filippa', 'Mimmi', 'Tobbe', 'Carlfelix', 'Simpan', 'Mogge', 'janbanan', 'BigRred', 'bigbird', 'Bjork', 'johanna', 'jwalker','Lapen', 'greengreen', 'M', 'tomtekalendern', 'loffe', 'Klaas', 'Kaniin');
    //$this->m_testdata->creteUsers($data);

    //$this->testJDate();
  }

  function testJDate() {
     echo '<pre>';
// Just create the JDate object, using systems local time
    $d = new JDate();
    $this->_testit($d);
    unset($d);

// Set the date to 2011-01-31
    $d = new JDate("2011-01-31");
    $this->_testit($d);
    unset($d);

// Set the date to 2011-02-01 in unixtime format
    $d = new JDate(1296549671);
    $this->_testit($d);
    unset($d);

// Specify a week number, date always defaults to the monday in that week
    $d = new JDate();
    $d->setDateFromWeek(2011, 8);
    $this->_testit($d);
    unset($d);

  

// Specify a week number, date always defaults to the monday in that week
    echo PHP_EOL . "minus 7 days" . PHP_EOL;
    $d = new JDate();
    $d->subDays(6);

    print "The date: " . $d->getDateTimeZero() . PHP_EOL; // The date in 2011-01-31 format
    unset($d);
    echo '</pre>';
  }


// This function shows how the different methods can be used.
// Please see below function how we create the object and set date.
  function _testit($d) {


    print "The date: " . $d->getDate() . PHP_EOL; // The date in 2011-01-31 format
    print "The date in unixtime: " . $d->getDate(TRUE) . PHP_EOL; // The date in 1296428400 (unixtime) format
    print "Year: " . $d->getYear() . PHP_EOL;
    print "Month: " . $d->getMonth(true) . PHP_EOL; // true means that we don't want leading zero
    print "Day: " . $d->getDay() . PHP_EOL;
    print "Week: " . $d->getWeek(true) . PHP_EOL; // true means that we don't want leading zero
    print "Monday: " . $d->getMonday() . PHP_EOL;
    print "Tuesday: " . $d->getTuesday() . PHP_EOL;
    print "Wednesday: " . $d->getWednesday() . PHP_EOL;
    print "Thursday: " . $d->getThursday() . PHP_EOL;
    print "Friday: " . $d->getFriday() . PHP_EOL;
    print "Saturday: " . $d->getSaturday() . PHP_EOL;
    print "Sunday: " . $d->getSunday() . PHP_EOL;
    print "======" . PHP_EOL;
  }

  function apa() {
    $data['key1'] = "value1";
    $data['key2'] = "value2";
    $data['todo'] = array("clean", "phone home", "sleep");
    $this->load->view('krillo_view', $data);
  }

}