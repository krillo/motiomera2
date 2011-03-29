<?php

/**
 * Description of activities
 *
 * @author kristian Erendi
 */
class M_activities extends CI_Model {

  private $table = 'activities';
  private $defaultActivityId = 1;



  /**
   * Returns the default activity id i.e. the id for steps
   */
  function getDefaultActivityId(){
    return $this->defaultActivityId;
  }


  /**
   * Gets all the records, defaults to limit the result to 20 rows
   * @param <type> $limit
   * @return <type>
   */
  function getAll($wl_id, $limit = 20){
    //$this->db->order_by("name", "asc");
    //$this->db->order_by("multiplicity", "asc");
    //$query = $this->db->get($this->table, $limit);
    $sql = 'select * from activities where wl_id = ? order by name asc, multiplicity asc limit ?';
    $query = $this->db->query($sql, array($wl_id, $limit));
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[] = $row;
      }
      return $data;
    }    
  }


  function getUnique($wl_id){
    $data = array();
    $sql = 'select distinct(name), id, multiplicity, severity, unit from activities where wl_id = ? group by name order by name asc';
    $query = $this->db->query($sql, array($wl_id));
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[] = $row;
      }      
    }
    return $data;
  }


  /**
   * This function returns all activities with the same name as the submitted activity_id
   * Only return rows corresponding to correct WL-id
   *
   * @param int $activity_id
   * @param int $wl_id White Label id
   * @param boolean $raw false - nicely formatted for dropdown helper
   * @return array
   */
  function getSameName($activity_id, $wl_id, $raw = false){
    $data = array();
    $sql = "select * from activities where name like (SELECT name FROM activities where id = ?) and wl_id = ? order by multiplicity";
    $query = $this->db->query($sql, array($activity_id, $wl_id));
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[] = $row;
      }
      if(!$raw){
        return $data;
      }else{ //return an array that suits the dropdown helper
        return $this->_prepareSeverityList($data);
      }
    } else {
      //todo error handling
      return -1;
    }
  }

  /**
   * Prepares the severitylist-array to match the dropdown helper
   *
   * @param <type> $data
   * @return <type>
   */
  function _prepareSeverityList($data) {
    $prepArray = array();
    foreach ($data as $key => $value) {
      if ($value->severity != '') {
        $name = $value->severity;
        $id = $value->id;
        $prepArray[$id] = $name;
      }
    }
    return $prepArray;
  }

  /**
   * Calculates actual steps from activity
   *
   * @param <type> $activity_id
   * @param <type> $count
   * @return <type>
   */
  function calcSteps($activity_id, $count){
    $sql = "SELECT (multiplicity * ?) calc_steps from activities where id = ?";
    $query = $this->db->query($sql, array($count, $activity_id));
    if($query->num_rows() == 1 ){
      return $query->row()->calc_steps;
    } else {
      //todo  error handling
      return -1;
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


	function getPagedList($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->table, $limit, $offset);
	}

	/**
   * Creates a new post
   * @param <type> $data
   * @return <type>
   */
	function create($wl_id, $name, $multiplicity, $severity, $unit, $desc){
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
    $data['name'] = $name;
    $data['multiplicity'] = $multiplicity;
    $data['severity'] = $severity;
    $data['unit'] = $unit;
    $data['desc'] = $desc;
    $data['wl_id'] = $wl_id;
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

  /**
   * Update a record
   *
   * @param int $id
   * @param int $wl_id
   * @param string $name
   * @param string $multiplicity
   * @param string $severity
   * @param string $unit
   * @param string $desc
   * @return int 1 for success and -1 for error
   */    
	function update($id, $wl_id, $name, $multiplicity, $severity, $unit, $desc){
    $data['updated_at'] = date('Y-m-d H:i:s');
    $data['name'] = $name;
    $data['multiplicity'] = $multiplicity;
    $data['severity'] = $severity;
    $data['unit'] = $unit;
    $data['desc'] = $desc;
    $data['wl_id'] = $wl_id;
		$this->db->where('id', $id);
		$this->db->update('activities', $data);
    if ($this->db->affected_rows() == 1) {
      return 1;
    }else{
      return -1;
    }
	}
  

  /**
   * Delete a row
   * 
   * @param <type> $activity_id
   * @return int 1 for success and -1 for error
   */
	function delete($activity_id){
		$this->db->where('id', $activity_id);
		$this->db->delete($this->table);
    if ($this->db->affected_rows() == 1) {
      return 1;
    }else{
      return -1;
    }
  }


  
}
