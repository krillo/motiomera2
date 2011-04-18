<?php

/**
 * The roles
 *
 * @author Kristian Erendi 2011
 */
class M_trade extends CI_Model {
  private $table = 'trades';


  /**
   * Gets all the records, defaults to limit the result to 20 rows
   * @param <type> $limit
   * @return <type>
   */
  function getAll(){
    $sql = "SELECT * FROM trades where wl_id=1 ORDER BY name COLLATE utf8_swedish_ci ASC ";
    $query = $this->db->query($sql);

    //$query = $this->db->get($this->table);
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[] = $row;
      }
      return $this->_prepareTradeList($data);
    }
  }

  /**
   * Prepares the severitylist-array to match the dropdown helper
   *
   * @param <type> $data
   * @return <type>
   */
  function _prepareTradeList($data) {
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
    $sql = "SELECT * FROM trades WHERE id  = ?";
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

