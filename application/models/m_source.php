<?php

/**
 * The roles
 *
 * @author Kristian Erendi 2011
 */
class M_source extends CI_Model {
  private $table = 'sources';


  /**
   * Gets all the records, with wl_id 2 and type private.
   * @param <type> 
   * @return <type>
   */
  function getAll(){
    $sql = "SELECT * FROM sources WHERE wl_id=2 AND type='private' ORDER BY name COLLATE utf8_swedish_ci ASC ";
    $query = $this->db->query($sql);
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[] = $row;
      }
      return $this->_prepareSourceList($data);
    }
  }

  /**
   * Prepares the sourcelist-array to match the dropdown helper
   *
   * @param <type> $data
   * @return <type>
   */
  function _prepareSourceList($data) {
    $prepArray = array();
    $prepArray[0] = 'Choose...';
    foreach ($data as $key => $value) {
        $name = $value->name;
        $id = $value->id;
        $prepArray[$id] = $name;
    }
    return $prepArray;
  }



  /**
   * Get by user_id
   * @param <type> $id
   * @return <type>
   */
  function getById($id){
    $sql = "SELECT * FROM sources WHERE id  = ?";
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
