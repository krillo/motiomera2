<?php

/**
 * The Keys
 *
 * @author Kristian Erendi 2011
 */
class M_key extends CI_Model {
  private $table = 'keys';


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


  function getTeamUsersByContestId_xxxxxxx($team_id) {
    $sql = "SELECT * users FROM `keys` WHERE team_id = ? ";
    $query = $this->db->query($sql, array($contest_id));
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $sql = "SELECT count(id) users FROM `keys` WHERE team_id = ? ";
        $query = $this->db->query($sql, array($contest_id));
        
        
        $data['total_users_no_team'] = $row->users;
      }
      return $data;
    } else {
      return -1;
    }
  }


  function getUsersByTeamId($team_id) {
    //$sql = "SELECT k.id key_id , u.id user_id, u.* FROM `keys` k,  users u WHERE team_id = ? AND k.id = u.id";
    $sql = "SELECT u.id user_id, nick, f_name, l_name FROM `keys` k,  users u WHERE team_id = ? AND k.id = u.id";
    $query = $this->db->query($sql, array($team_id));
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
        //$data['nick'] = $row->nick;
        //$data['f_name'] = $row->f_name;
        //$data['l_name'] = $row->l_name;
      }
      return $data;
    } else {
      return -1;
    }
  }

  /**
   * Collect some contest data:
   * 1. All competitors
   * 2. All registered users in the contest
   * 3. All users in the competition but not placed in any team
   *
   * @param <type> $contest_id
   * @return <type>
   */
  function getTeamDataByContestId($contest_id) {
    $sql = "SELECT count(id) total  FROM  `keys` WHERE contest_id = ?";
    $query = $this->db->query($sql, array($contest_id));
    if ($query->num_rows() == 1) {
      foreach ($query->result() as $row) {
        $data['total_keys'] = $row->total;
      }
      $sql = "SELECT count(id) users  FROM  `keys` WHERE contest_id = ? AND user_id IS NOT NULL";
      $query = $this->db->query($sql, array($contest_id));
      if ($query->num_rows() == 1) {
        foreach ($query->result() as $row) {
          $data['total_used_keys'] = $row->users;
        }
        $sql = "SELECT count(id) users FROM `keys` WHERE contest_id = ? AND user_id IS NOT NULL AND team_id IS NULL";
        $query = $this->db->query($sql, array($contest_id));
        if ($query->num_rows() == 1) {
          foreach ($query->result() as $row) {
            $data['total_users_no_team'] = $row->users;
          }
          return $data;
        } else {
          return -1;
        }
      } else {
        return -1;
      }
    } else {
      return -1;
    }
  }



  function getFreeKeysByContestId($contest_id) {
    $sql = "SELECT id, `key`  FROM  `keys` WHERE contest_id = ? AND user_id IS NULL";
    $query = $this->db->query($sql, array($contest_id));
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[$row->id] = $row->key;
      }
      return $data;
    } else {
      return -1;
    }
  }


  public function addKeys($contest_id, $keys, $team_id = null){
    foreach ($keys as $key) {
      $sql = "INSERT INTO `keys` (contest_id, `key`, team_id, created_at, updated_at) values(?, ?, ?, ?, ?)";
      $query = $this->db->query($sql, array($contest_id, $key, $team_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')));
    }
  }



  /**
   * Generates keys and places them into teams if parameter $skipteam is false or omitted
   * Returns array of the created keys
   *
   * @param <type> $count
   * @param <type> $order_id
   * @param <type> $skipteam
   * @return string
   */
  function generateKeys($count, $skipteam = false){
    $generatedKeys = array();
    $letters = "ACDEFGHJKLMNPQRSTUVWXY345679";
    for ($i = 0; $i < $count; $i++) {
      $key = "";
      for ($j = 0; $j < 8; $j++) {
        $key.= $letters[mt_rand(0, strlen($letters) - 1) ];
      }
      if ($this->isKeyAvalible($key)) {
        $generatedKeys[] = $key;
      } else {
        $i--;
      }
    }
    return $generatedKeys;
  }


  /**
   * Checks in the db if key is available
   *
   * @param <type> $key
   * @return bool true of false
   */
  function isKeyAvalible($key){
    $sql = "SELECT id FROM `keys` WHERE `key`  = ?";
    $query = $this->db->query($sql, array($key));
    if($query->num_rows() > 0 ){
      return false;
    } else {
      return true;
    }
  }


  /**
   * Writes a array of keys to the db.
   * @param <type> $contest_id
   * @param <type> $keys
   * @param <type> $team_id
   */
  public function addKeysToDb($contest_id, $keys, $team_id = null){
    foreach ($keys as $key) {
      $sql = "INSERT INTO `keys` (contest_id, `key`, team_id, created_at, updated_at) values(?, ?, ?, ?, ?)";
      $query = $this->db->query($sql, array($contest_id, $key, $team_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')));
    }
  }



/**
 * Remove team from db.
 * Return the number of nulled rows
 *
 * @param <type> $team_id
 * @return <type>
 */
  function removeTeam($team_id) {
    $sql = "SELECT count(id) FROM `keys` WHERE team_id  = ?";
    $query = $this->db->query($sql, array($team_id));
    if($query->num_rows() == 1 ){
      $count = $query->result();
    }
    $data = array(
        'team_id' => null,
        'updated_at' => date('Y-m-d H:i:s'),
    );
    $this->db->where('team_id', $team_id);
    $this->db->update('keys', $data);
    if ($this->db->affected_rows() == $count) {
      return $count;
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


