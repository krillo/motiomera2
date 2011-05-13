<?php

/**
 * The Contests
 *
 * @author Kristian Erendi 2011
 */
class M_contest extends CI_Model {
  private $table = 'contests';


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
   * Get contest by contest_id
   * @param <type> $id
   * @return <type>
   */
  function getContestById($contest_id){
    $sql = "SELECT * FROM contests WHERE id  = ?";
    $query = $this->db->query($sql, array($contest_id));
    if($query->num_rows() == 1 ){
      $arr = $query->result_array();
      $data = $arr[0];
      return $data;
    }else{
      //todo error handling
      return -1;
    }
  }


  /**
   * Gets the contest that is in progress right now
   *
   * @param <type> $company_id
   * @return <type>
   */
  function getCurrentContest($company_id){
    $sql = "SELECT * FROM contests WHERE company_id = ?  AND (start <= ? AND stop >= ? )";
    $query = $this->db->query($sql, array($company_id, date('Y-m-d'), date('Y-m-d')));
    if($query->num_rows() == 1 ){
      $arr = $query->result_array();
      $data = $arr[0];
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

