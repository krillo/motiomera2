<?php

/**
 * The messages
 *
 * @author Kristian Erendi 2011
 */
class M_message extends CI_Model {
  private $table = 'messages';
  
  const ONE = 1;
  const TWO = 2;
  const THREE = 3;
  const FOURE = 4;
  const FIVE = 5;
  const TYPE_USER = 1;
  const TYPE_CRON = 2;
  const TYPE_ADMIN = 3;


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
    $sql = "SELECT * FROM messages WHERE id  = ?";
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
   * Get a message type 1
   * Message type 1 should should only be one per day and can have a smile
   * $user_id, $date, $type are primary key
   *
   * @param <type> $user_id
   * @param <type> $date
   * @param <type> $type
   * @return <type> return all data or an ompty object if no message exists in db
   */
  function getByUserIdDateType_1($user_id, $date, $type){
    $sql = "SELECT * FROM messages WHERE user_id  = ? AND date = ? AND type = ?";
    $query = $this->db->query($sql, array($user_id, $date, $type));
    if($query->num_rows() == 1 ){
      $row = $query->result();
      return $row[0];
    }else{
      $emptyObj = new stdClass;
      $emptyObj->id = -1;
      $emptyObj->user_id = $user_id;
      $emptyObj->date = $date;
      $emptyObj->message = '';
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
	function create($user_id, $message, $smiley, $date, $type){
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
    $data['user_id'] = $user_id;
    $data['message'] = $message;
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
   * @param <type> $message
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
