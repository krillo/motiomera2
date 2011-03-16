<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Game extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){
    $this->gift();
	}

  /**
   * Check whether a gift should be displayed
   *
   * nbr of logins
   * nbr of step registers
   * total steps
   * step count end at 235
   * random
   * a register over 23000 in one day
   *
   */
  function gift(){
    //todo: read filenames from disk or db
    $gifts = array(0 => 'port.jpg', 1 => 'beer.jpg', 2 => 'gt.jpg', 3 => 'coffee.jpg', 4 => 'cappuccino.jpg');
    $displayGift = $gifts[array_rand($gifts)];
    $data['gift'] = $displayGift;
    $this->load->view('/snippets/v_gift', $data);
  }

}