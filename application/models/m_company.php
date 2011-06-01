<?php

/**
 * The Companys
 *
 * @author Kristian Erendi 2011
 */
class M_company extends CI_Model {
  private $table = 'companys';


  /**
   * Gets all the records, defaults to limit the result to 20 rows
   * @param <type> $limit
   * @return <type>
   */
  function getAll($limit = 20){
    //$query = $this->db->get($this->table, $limit);
    $sql = "SELECT * FROM companys ORDER BY id DESC LIMIT ?";
    $query = $this->db->query($sql, array($limit));
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $this->_moreInfo(&$row);
        $data[] = $row;
      }
      return $data;
    }
  }



  /**
   * Add some additional data to the row.
   * The parameter must be "pass by reference"
   *
   * 1. Administrators name
   * 2. White label name
   *
   * @param stdclass $row (pass by reference)
   */
  function _moreInfo($row){
    $sql = "SELECT * FROM users WHERE id  = ?";
    $query = $this->db->query($sql, array($row->user_id));
    if($query->num_rows() == 1 ){
      foreach ($query->result() as $userRow){
        $row->user_name = $userRow->f_name .' '. $userRow->l_name;
        $row->email = $userRow->email;
      }
    }else{
      $row->user_name = '-1';
    }

    $sql = "SELECT * FROM white_label WHERE id  = ?";
    $query = $this->db->query($sql, array($row->wl_id));
    if($query->num_rows() == 1 ){
      foreach ($query->result() as $wlRow){
        $row->wl_name = $wlRow->name;
      }
    }else{
      $row->wl_name = '-1';
    }
  }


  /**
   * Get by user_id
   * @param <type> $id
   * @return <type>
   */
  function getById($id){
    $sql = "SELECT * FROM companys WHERE id  = ?";
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
   * Get the company by company_id
   * @param <int> $user_id
   * @return <array>
   */
  function getByCompanyId($company_id){
    $sql = "SELECT * FROM companys WHERE id  = ?";
    $query = $this->db->query($sql, array($company_id));
    if($query->num_rows() == 1 ){
      $arr = $query->result_array();
      $data = $arr[0];
      return $data;
    }else{
      //todo: error handling
      return -1;
    }
  }



  /**
   * Get the company by (the administrators) user_id
   * @param <int> $user_id
   * @return <array>
   */
  function getCompanyByUserId($user_id){
    $sql = "SELECT * FROM companys WHERE user_id  = ?";
    $query = $this->db->query($sql, array($user_id));
    if($query->num_rows() == 1 ){
      $arr = $query->result_array();
      $data = $arr[0];
      return $data;
    }else{
      //todo: error handling
      return -1;
    }
  }


  /**
   * Get the company by contest id
   * @param <int> $contest_id
   * @return <array>
   */
  function getCompanyByContestId($contest_id){
    $sql = "SELECT c.* FROM companys c, contests t WHERE t.id  = ? AND c.id = t.company_id";
    $query = $this->db->query($sql, array($contest_id));
    if($query->num_rows() == 1 ){
      $arr = $query->result_array();
      $data = $arr[0];
      return $data;
    }else{
      //todo: error handling
      return -1;
    }
  }


  /**
   * Get the company by (the administrators) user_id
   * @param <int> $user_id
   * @return <array>
   */
  function getCompanyContestByUserId($user_id){
    $sql = "SELECT c.id company_id, c.*, t.id contest_id, t.*  FROM companys c, contests t WHERE c.user_id  = ? AND c.id = t.company_id";
    $query = $this->db->query($sql, array($user_id));
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[] = $row;
      }
      return $data;
    }else{
      //todo: error handling
      return -1;
    }
  }



  /**
   * This function does a wildcard search for companys.
   * It searches matches in name and the id
   * a match is returned with an array of user data otherwhise -1 is returned
   *
   * @param string $search
   * @return mix array of user data or -1 for nothing found
   */
  function getByWildcard($search) {
    $prep_search = '%' . $search . '%';   //prepare the text $search so it will be a wildcard param
    if (is_numeric($search)) {  //if $search is numeric also search the id field
      $sql = "SELECT distinct(c.id), c.* FROM companys c WHERE name LIKE ? OR id = ? ORDER BY id DESC LIMIT 20";
      $query = $this->db->query($sql, array($prep_search, $search));
    } else {
      $sql = "SELECT distinct(c.id), c.* FROM companys c WHERE name LIKE ? ORDER BY id DESC LIMIT 20";
      $query = $this->db->query($sql, array($prep_search));
    }
    //echo $this->db->last_query();
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $this->_moreInfo(&$row);
        $data[] = $row;
      }
      return $data;
    } else {
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
