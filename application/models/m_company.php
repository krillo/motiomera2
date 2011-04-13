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
   * Get the company by (the administrators) user_id
   * @param <int> $user_id
   * @return <array>
   */
  function getByUserId($user_id){
    $sql = "SELECT * FROM companys WHERE user_id  = ?";
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