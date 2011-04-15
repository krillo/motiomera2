<?php

/**
 * A model just for running sql from scripts without any check!!!
 * You must be logged in as admin to be able to run the sqls
 *
 * @author Kristian Erendi 2011
 */
class M_testdata extends CI_Model {

  /**
   * Call this function from all functions in this class to prevent anybody with lower access to run the function
   * If the users level in the session object is is higher than required then proceede into tghe function else redirect to start page
   *
   * @param <type> $level
   * @return <type>
   */
  function auth($level){
    if($this->session->userdata('role_level') > $level){
      return;
    } else {
      redirect('/start');
      die();
    }
  }


  /**
   * runs the inset-sql submitted.
   * returns the inserted row_id or -1 if the sql fails.
   *
   * @param <type> $sql
   * @return int  the row_id or -1 for error
   */
  function runSqlInsert($sql){
    $this->auth(SUPER_ADM_LEVEL);
    $query = $this->db->query($sql);
    if ($this->db->insert_id() > 0) {
      return $this->db->insert_id();
    } else {
      return -1;
    }
  }


  function creteUsers(){
    $this->auth(SUPER_ADM_LEVEL);
    $sql = "INSERT INTO `users`
            (`municipal_id`,`wl_id`,`level`,`email`,`email_confirmed`,`password`,`f_name`,`l_name`,`nick`,`sex`,`born`,`descr`,`last_login`,`img_filename`,`avatar_filename`,`customer_id`,`paid_until`,`trophy_start`,`status`,`company_key_temp`,`sources_id`,`total_steps`,`total_steps_current`,`total_logins`,`total_regs`,`created_at`,`updated_at`)
            VALUES(1,1,19,'muppe@boyhapp.se',1,'kapten','Mats','Jalkannen','Muppe','MALE','1978-04-02 00:00:00',NULL,NULL,NULL,'avatar2.gif',NULL,'2012-04-02 00:00:00','2011-04-02 00:00:00',NULL,NULL,1,0,NULL,NULL,0,'2011-04-02 00:00:00','2011-04-02 00:00:00')";
    $query = $this->db->query($sql);//, array($fromdate));
    if ($this->db->insert_id() > 0) {
      return $this->db->insert_id();
    } else {
      return -1;
    }


  }



}