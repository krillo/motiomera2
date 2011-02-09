<?php

/**
 * Description of activities
 *
 * @author kristian Erendi
 */
class M_activities extends CI_Model {

  private $table = 'activities';

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


  function getUnique(){
    $data = array();
    $query = $this->db->query('select distinct(name), id, multiplicity, severity, unit from activities group by name order by name asc');
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[] = $row;
      }      
    }
    return $data;
  }


  function getSameName(){
    $name =  $this->uri->segment(3);
    $data = array();
    $query = $this->db->query("select * from activities where name  = '$name'");
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[] = $row;
      }
    }
    return $data;
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
	function update($data){
    $data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->where('id', $this->uri->segment(3));
		$this->db->update($this->table, $data);
	}
  
	/**
   * delete row, id from segment 3
   */
	function delete(){
		$this->db->where('id', $this->uri->segment(3));
		$this->db->delete($this->table);
  }


  
}
