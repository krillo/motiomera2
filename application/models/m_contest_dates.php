<?php

  //these keys are used in the db
  define("LAST_REG", 'LAST_REG');
  define("SEND_RESULT_EMAIL", 'SEND_RESULT_EMAIL');
  define("LAST_ADMIN_DAY", 'LAST_ADMIN_DAY');


/**
 * The Keys
 *
 * @author Kristian Erendi 2011
 */
class M_contest_dates extends CI_Model {
  private $table = 'contest_dates';

  /**
   * Gets all the records, defaults to limit the result to 20 rows
   * @param <type> $limit
   * @return <type>
   */
  function getAll($limit = 20){
    $query = $this->db->get($this->table, $limit);
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[] = $row;
      }
      return $data;
    }
  }


  /**
   * Get by user_id
   * @param <type> $id
   * @return <type>
   */
  function getById($id){
    $sql = "SELECT * FROM contest_dates WHERE id  = ?";
    $query = $this->db->query($sql, array($id));
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[] = $row;
      }
      return $data;
    }else{
      //todo error handling
      return -1;
    }
  }


  /**
   * Returns all dates for an contest
   * if type is submitted get only those
   *
   * Return an array with type as key and a nicely formatted date like so:
   *     [contest_dates] => Array
   *         [LAST_REG] => 2011-05-02
   *         [SEND_RESULT_EMAIL] => 2011-05-03
   *         [LAST_ADMIN_DAY] => 2011-05-08
   *
   * @param <type> $id
   * @param <type> $type
   * @return <type> 
   */
  function getDatesByContestId($id, $type = null){
    if($type == null){
      $sql = "SELECT type, date FROM contest_dates WHERE contest_id  = ?";
      $query = $this->db->query($sql, array($id));
    } else {
      $sql = "SELECT type, date FROM contest_dates WHERE contest_id  = ? AND type = ?";
      $query = $this->db->query($sql, array($id, $type));
    }
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[$row->type] = date('Y-m-d', strtotime($row->date));
        $data[$row->type . '_WEEKDAY'] = date('l', strtotime($row->date));
      }
      return $data;
    }else{
      //todo error handling
      return -1;
    }
  }


/**
 * Calculate all dates from contest stop date
 * Return the dates in an associative array with keyname as property name used in the db
 *
 * @param <type> $stop
 * @return array with all the dates
 */
private function calculateDatesFromStopDate($stop){
  $d = new JDate($stop);
  $d->addDays(LAST_REG_ADD_DAYS);
  $data[LAST_REG] = $d->getDate();

  $d = new JDate($stop);
  $d->addDays(SEND_RESULT_EMAIL_ADD_DAYS);
  $data[SEND_RESULT_EMAIL] = $d->getDate();

  $d = new JDate($stop);
  $d->addDays(LAST_ADMIN_DAY_ADD_DAYS);
  $data[LAST_ADMIN_DAY] = $d->getDate();
  return $data;
}


  /**
   * Update all contest dates for a competition
   * contest_id and stop date is needed for this
   * return true for success
   *
   * @param <type> $contest_id
   * @param <type> $stop
   * @return boolean
   */
  function updateContestDates($contest_id, $stop){
    $sql = "SELECT id FROM contests WHERE id = ?";
    $query = $this->db->query($sql, array($contest_id));
    if($query->num_rows() >= 1 ){
      $data = $this::calculateDatesFromStopDate($stop);
      foreach ($data as $key => $value) {
        $sql = "UPDATE contest_dates SET date = ?, updated_at = ? WHERE contest_id = ? AND type = ?";
        $query = $this->db->query($sql, array($value, date('Y-m-d H:i:s'), $contest_id, $key));
      }
      return TRUE;
    } else {
      return FALSE;
    }

  }



	/**
   * Creates a new post
   * @param <type> $data
   * @return <type>
   */
	function create($data){
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	// update person by id
	function update($id, $data){
    $data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}

	/**
   * delete row, id from segment 3
   */
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table);
  }




}



