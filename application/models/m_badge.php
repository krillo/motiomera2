<?php

/**
 * The badges
 *
 * @author Kristian Erendi 2011
 */
class M_badge extends CI_Model {
  private $table = 'badges';



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
  function getByBadgeId($id){
    $sql = "SELECT * FROM badges WHERE id  = ?";
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
   * Get a badge type 1
   * badge type 1 should should only be one per day and can have a smile
   * $user_id, $date, $type are primary key
   *
   * @param <type> $user_id
   * @param <type> $date
   * @param <type> $type
   * @return <type> return all data or an ompty object if no badge exists in db
   */
  function getByUserIdDateType_1($user_id, $date, $type){
    $sql = "SELECT * FROM badges WHERE user_id  = ? AND date = ? AND type = ?";
    $query = $this->db->query($sql, array($user_id, $date, $type));
    if($query->num_rows() == 1 ){
      $row = $query->result();
      return $row[0];
    }else{
      $emptyObj = new stdClass;
      $emptyObj->id = -1;
      $emptyObj->user_id = $user_id;
      $emptyObj->date = $date;
      $emptyObj->badge = '';
      $emptyObj->type = -1;
      $emptyObj->smiley = -1;
      $emptyObj->badge_id = -1;
      $emptyObj->created_at = date('Y-m-d H:i:s');
      $emptyObj->updated_at = date('Y-m-d H:i:s');
      return $emptyObj;
    }
  }



	/**
   * Creates a new post
   * @param <type> $data
   * @return <type>
   */
	function create($user_id, $badge, $smiley, $date, $type){
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
    $data['user_id'] = $user_id;
    $data['badge'] = $badge;
    $data['smiley'] = $smiley;
    $data['date'] = $date;
    $data['type'] = $type;
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}


  /**
   * todo: do a select first so that you dont lose the null variables or check if submitted values
   *
   * @param <type> $id
   * @param <type> $user_id
   * @param <type> $badge
   * @param <type> $smiley
   */
	function updateById($id, $data){
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
