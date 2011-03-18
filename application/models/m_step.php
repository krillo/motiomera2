<?php

/**
 * The M_step model class handles steps
 *
 * @author Kristian Erendi, Aller media 2011
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
    $sql = "SELECT s.id step_id, a.id activity_id, s.*, a.* FROM steps s, activities a WHERE s.activity_id  = a.id AND s.user_id = ? AND s.status = ? AND s.date >= ? AND s.date <= ? LIMIT ?";
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
   * Creates a new row of steps.
   * The parameters dont contain actual steps, but activity_id and count.
   * Then the functions calculates actual steps
   *
   * A check is made that the id is the same as in the session
   *
   * @param array $data the step data
   * @return 
   */
	function create($user_id, $activity_id, $count, $date, $status) {
    if ($this->session->userdata('user_id') == $user_id) {
      $data = array(
          'user_id' => $user_id,
          'activity_id' => $activity_id,
          'count' => $count,
          'date' => $date,
          'status' => $status
      );
      $calcSteps = $this->m_activities->calcSteps($data['activity_id'], $data['count']);
      $data['steps'] = $calcSteps;
      $data['created_at'] = date('Y-m-d H:i:s');
      $data['updated_at'] = date('Y-m-d H:i:s');
      //print_r($data); die();
      $this->db->insert($this->table, $data);
      if ($this->db->affected_rows() == 1) {
        //update
        return $this->db->insert_id();
      } else {
        //todo: nice error handling, no rows inserted
        return -1;
      }
    } else {
      //todo: nice error handling, not same is in session as in the request
      return -1;
    }
  }


	/**
   * The function creates a new row of steps.
   * The parameters don't contain actual steps, but activity_id and count.
   * Then the functions calls a STORED PROCEDURE that:<br/>
   * 1. calculates steps <br/>
   * 2. inserts data to 'step'<br/>
   * 3. counts total steps and total nbr of inserts <br/>
   * 4. updates the user table with this data
   *
   * A check is made that the id is the same as in the session
   *
   * @param int $user_id
   * @param int $activity_id
   * @param int $count 
   * @param string $date
   * @return int Returns the id of just inserted step row
   * @author Kristian Erendi 2011-03-17
   */
  function create_x($user_id, $activity_id, $count, $date) {
    if ($this->session->userdata('user_id') == $user_id) {
      $sp =  "call insert_steps(?,?,?,?)";
      $result = $this->db->query($sp, array($user_id, $activity_id, $count, $date));
      $data = $result->result_object();
      return $data[0]->step_id;
    } else {
      //todo: nice error handling, not same is in session as in the request
      echo "user id ok, " . $user_id;
      return -1;
    }
  }


  function getCaloriesFromSteg($steg){
		return $steg * 0.05;
	}


  // update person by id
	function update($data, $id){
    $data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}

	/**
   * delete row
   */
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table);
  }

  
	/**
   * Delete row where both id and user_id must match
   * reurns true on success else false
   */
	function deleteByIds($id, $user_id){
    $sql = "DELETE FROM steps WHERE id = ? AND user_id = ?";
    $query = $this->db->query($sql, array($id, $user_id));
    $affected_rows = $this->db->affected_rows();
    if($affected_rows == 1){
      return TRUE;
    } else {
      return TRUE;
    }

    //todo don't know how to return success or fail?!?!?
  }

}
