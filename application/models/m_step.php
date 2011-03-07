<?php

/**
 * Description of activities
 *
 * @author kristian Erendi
 */
class M_step extends CI_Model {

  private $table = 'steps';

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
   * Get row by id
   * @param <type> $id
   * @return <type>
   */
  function getById($id){
    $this->db->where('id = ', $id);
    $query = $this->db->get($this->table);
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[] = $row;
      }
      return $data;
    }
  }


  /**
   * Gets the steps for an user
   *
   * @param <type> $user_id
   * @param <type> $limit
   * @return <type>
   */
  function getByUserId($user_id, $status, $startdate, $stopdate,  $limit = 20){
    $sql = "SELECT * FROM steps s, activities a WHERE s.activity_id  = a.id AND s.user_id = ? AND s.status = ? AND s.date >= ? AND s.date <= ? LIMIT ?";
    $query = $this->db->query($sql, array($user_id, $status, $startdate, $stopdate, $limit));

    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[] = $row;
      }
      return $data;
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
   * Creates a new post.
   * The function calculates counted steps
   *
   * @param array $data the step data
   * @return <type>
   */
	function create($data){
    $calcSteps = $this->m_activities->calcSteps($data['activity_id'], $data['count']);
    $data['steps'] = $calcSteps;
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
    //print_r($data); die();
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	// update person by id
	function update($data, $id){
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
