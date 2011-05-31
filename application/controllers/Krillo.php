<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Krillo extends CI_Controller {

  function __construct() {
    parent::__construct();
  }

  function index() {
    //echo 'LAST_REG_ADD_DAYS = ' . LAST_REG_ADD_DAYS;

    log_message('debug', 'Some variable did not contain a value.');
    show_error('krillo error message' ,200  );

    //show_404('krillo_page.php' , 'log_error');


    $this->load->model('m_settings');
    $this->m_settings->deleteByWlId(1);

    $this->m_settings->initialInsert(1);

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

    //echo date('Y-m-d H:i:s');

    //$this->load->model('m_testdata');
    //$data = array('Filippa', 'Mimmi', 'Tobbe', 'Carlfelix', 'Simpan', 'Mogge', 'janbanan', 'BigRred', 'bigbird', 'Bjork', 'johanna', 'jwalker','Lapen', 'greengreen', 'M', 'tomtekalendern', 'loffe', 'Klaas', 'Kaniin');
    //$this->m_testdata->creteUsers($data);

    //$this->testJDate();


echo "<table border=\"1\">";
echo "<tr><td>" .$_SERVER['argv'] ."</td><td>argv</td></tr>";
echo "<tr><td>" .$_SERVER['argc'] ."</td><td>argc</td></tr>";
echo "<tr><td>" .$_SERVER['GATEWAY_INTERFACE'] ."</td><td>GATEWAY_INTERFACE</td></tr>";
echo "<tr><td>" .$_SERVER['SERVER_ADDR'] ."</td><td>SERVER_ADDR</td></tr>";
echo "<tr><td>" .$_SERVER['SERVER_NAME'] ."</td><td>SERVER_NAME</td></tr>";
echo "<tr><td>" .$_SERVER['SERVER_SOFTWARE'] ."</td><td>SERVER_SOFTWARE</td></tr>";
echo "<tr><td>" .$_SERVER['SERVER_PROTOCOL'] ."</td><td>SERVER_PROTOCOL</td></tr>";
echo "<tr><td>" .$_SERVER['REQUEST_METHOD'] ."</td><td>REQUEST_METHOD</td></tr>";
echo "<tr><td>" .$_SERVER['REQUEST_TIME'] ."</td><td>REQUEST_TIME</td></tr>";
echo "<tr><td>" .$_SERVER['QUERY_STRING'] ."</td><td>QUERY_STRING</td></tr>";
echo "<tr><td>" .$_SERVER['DOCUMENT_ROOT'] ."</td><td>DOCUMENT_ROOT</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_ACCEPT'] ."</td><td>HTTP_ACCEPT</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_ACCEPT_CHARSET'] ."</td><td>HTTP_ACCEPT_CHARSET</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_ACCEPT_ENCODING'] ."</td><td>HTTP_ACCEPT_ENCODING</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_ACCEPT_LANGUAGE'] ."</td><td>HTTP_ACCEPT_LANGUAGE</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_CONNECTION'] ."</td><td>HTTP_CONNECTION</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_HOST'] ."</td><td>HTTP_HOST</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_REFERER'] ."</td><td>HTTP_REFERER</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_USER_AGENT'] ."</td><td>HTTP_USER_AGENT</td></tr>";
echo "<tr><td>" .$_SERVER['HTTPS'] ."</td><td>HTTPS</td></tr>";
echo "<tr><td>" .$_SERVER['REMOTE_ADDR'] ."</td><td>REMOTE_ADDR</td></tr>";
echo "<tr><td>" .$_SERVER['REMOTE_HOST'] ."</td><td>REMOTE_HOST</td></tr>";
echo "<tr><td>" .$_SERVER['REMOTE_PORT'] ."</td><td>REMOTE_PORT</td></tr>";
echo "<tr><td>" .$_SERVER['SCRIPT_FILENAME'] ."</td><td>SCRIPT_FILENAME</td></tr>";
echo "<tr><td>" .$_SERVER['SERVER_ADMIN'] ."</td><td>SERVER_ADMIN</td></tr>";
echo "<tr><td>" .$_SERVER['SERVER_PORT'] ."</td><td>SERVER_PORT</td></tr>";
echo "<tr><td>" .$_SERVER['SERVER_SIGNATURE'] ."</td><td>SERVER_SIGNATURE</td></tr>";
echo "<tr><td>" .$_SERVER['PATH_TRANSLATED'] ."</td><td>PATH_TRANSLATED</td></tr>";
echo "<tr><td>" .$_SERVER['SCRIPT_NAME'] ."</td><td>SCRIPT_NAME</td></tr>";
echo "<tr><td>" .$_SERVER['REQUEST_URI'] ."</td><td>REQUEST_URI</td></tr>";
echo "<tr><td>" .$_SERVER['PHP_AUTH_DIGEST'] ."</td><td>PHP_AUTH_DIGEST</td></tr>";
echo "<tr><td>" .$_SERVER['PHP_AUTH_USER'] ."</td><td>PHP_AUTH_USER</td></tr>";
echo "<tr><td>" .$_SERVER['PHP_AUTH_PW'] ."</td><td>PHP_AUTH_PW</td></tr>";
echo "<tr><td>" .$_SERVER['AUTH_TYPE'] ."</td><td>AUTH_TYPE</td></tr>";
echo "</table>";


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