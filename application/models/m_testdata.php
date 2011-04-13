<?php

/**
 * A model just for running sql from scripts without any check!!!
 * You must be logged in as admin to be able to run the sqls
 *
 * @author Kristian Erendi 2011
 */
class M_testdata extends CI_Model {
  const SUPER_ADM_LEVEL = 90;


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
    $this->auth(self::SUPER_ADM_LEVEL);
    $query = $this->db->query($sql);
    if ($this->db->affected_rows() == 1) {
      return $this->db->insert_id();
    } else {
      return 1;
    }
  }

}