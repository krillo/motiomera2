<?php

/**
 * The teams
 *
 * @author Kristian Erendi 2011
 */
class M_team extends CI_Model {
  private $table = 'teams';


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
    $sql = "SELECT * FROM teams WHERE id  = ?";
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
   * Get all teams by contest_id also calculate how many users there are in each team
   * 
   * @param <type> $id
   * @return <type>
   */
  function getAllByContestId($contest_id){
    $sql = "SELECT * FROM teams WHERE contest_id  = ? ORDER BY name ASC";
    $query = $this->db->query($sql, array($contest_id));
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $sql = "SELECT count(id) count FROM `keys` WHERE team_id  = " . $row->id;
        $query2 = $this->db->query($sql);
        $count = $query2->result();
        $row->nof_users = $count[0]->count;
        $data[] = $row;
      }
      return $data;
    }else{
      //todo error handling
      return -1;
    }
  }



  /**
   * Get all teams that have any coupled keys by contest id
   * @param <type> $contest_id
   * @return <type>
   */
  function getActiveTeamsByContestId($contest_id){
    $sql = "SELECT * FROM teams t WHERE id in (SELECT team_id FROM `keys` WHERE contest_id = ? )";
    $query = $this->db->query($sql, array($contest_id));
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[$row->id] = $row->name;
      }
      return $data;
    }else{
      //todo error handling
      return -1;
    }
  }





	function genereraTeams(){
		global $db;
		$lag = $this->listLag();
		foreach($lag as $thislag) {
			$thislag->delete();
		}
		$nycklar = $this->listNycklar();
		$antalAnstallda = count($nycklar);
		$medlemmar = array();
		foreach($nycklar as $nyckel) {
			$medlemmar[] = $nyckel["nyckel"];
		}
		$antalAnstallda = count($medlemmar);

		if ($antalAnstallda < 10) {
			$antalLag = 1;
		} else
		if ($antalAnstallda == 10) { // lite specialfall, det blir tv㟬ag med fem personer i varje vid tio anst㫬da

			$antalLag = 2;
		} else
		if ($antalAnstallda < 591) {
			$antalLag = ceil($antalAnstallda / 10);
		} else {
			$antalLag = 59;
		}
		$anstalldaPerLag = ($antalLag > 0) ? ($antalAnstallda / $antalLag) : 0;
		$lag = array();
		for ($i = 0; $i < $antalLag; $i++) {
			for ($j = ($i * floor($anstalldaPerLag)); $j < ($i * floor($anstalldaPerLag) + floor($anstalldaPerLag)); $j++) {
				$lag[$i][] = $medlemmar[$j];
			}
		}

		if ($antalLag > 0) {
			$rest = $antalAnstallda - (floor($anstalldaPerLag) * $antalLag);
			$j = 0;
			for ($i = (floor($anstalldaPerLag) * $antalLag); $i < $antalAnstallda; $i++) {
				$lag[$j][] = $medlemmar[$i];
				$j++;
			}
			$lagnamnList = LagNamn::listAll();
			$lagkeys = array_rand($lagnamnList, count($lag));

			if (count($lagkeys) == 1) {
				$lagkeys = array(
					$lagkeys
				);
			}
		}
		$i = 0;
		foreach($lag as $lagtemp) {
			$lagnamn = $lagnamnList[$lagkeys[$i]];
			$namn = $lagnamn->getNamn();
			$bild = $lagnamn->getImgO();
			$lag = $this->skapaLag($lagnamn->getNamn() , $bild);
			$id = $lag->getId();
			$sql = "UPDATE " . self::KEY_TABLE . " SET lag_id = $id WHERE nyckel in (";
			foreach($lagtemp as $nyckel) {
				$sql.= "'" . $nyckel . "',";
			}
			$sql = substr($sql, 0, -1);
			$sql.= ")";
			$db->nonquery($sql);
			$i++;
		}
	}

	public function slumpaLagnamn()
	{
		$letters = "abcdefghijklmnopqrstuvwxyz";
		$namn = "";
		for ($i = 0; $i < 10; $i++) {
			$namn.= $letters[mt_rand(0, strlen($letters) - 1) ];
		}
		return $namn;
	}

	public function skapaLag($namn, Bild $bild)
	{
		$lag = new Lag($this, $namn, $bild);
		$this->lag = null;
		return $lag;
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



  /**
   * Update the name
   * 
   * @param <type> $id
   * @param <type> $name
   * @return int id or -1 if the update fails
   */
  function updateName($id, $name) {
      $data = array(
        'name' => $name,
        'updated_at' => date('Y-m-d H:i:s'),
      );
      $this->db->where('id', $id);
      $this->db->update('teams', $data);
    if($this->db->affected_rows() == 1){
      return $id;
    } else {
      return -1;
    }

  }


	// update person by id
	function update($id, $data){
    $data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}

	/**
   * delete team
   */
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('teams');
  }




}




