<?php

/**
 * The Keys
 *
 * @author Kristian Erendi 2011
 */
class M_contest_dates extends CI_Model {
  private $table = 'contest_dates';

  const LAST_REG = 'LAST_REG';
  const SEND_RESULT_EMAIL = 'SEND_RESULT_EMAIL';
  const LAST_ADMIN_DAY = 'LAST_ADMIN_DAY';


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
        $nice_date = date('Y-m-d', strtotime($row->date));
        $data[$row->type] = $nice_date;
      }
      return $data;
    }else{
      //todo error handling
      return -1;
    }
  }



  /**
   * Count all records.
   * Returns count and which table their from
   * @return array
   */
	function count(){
		$query = $this->db->count_all($this->table);
    $data['table'] = $this->table;
    $data['count'] = $query;
    return $data;
	}

	// get persons with paging
	function getPagedList($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->table, $limit, $offset);
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



