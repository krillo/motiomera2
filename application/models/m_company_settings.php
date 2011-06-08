<?php


/**
 * The settings
 * @author Kristian Erendi 2011
 */
class M_company_settings extends CI_Model {
  private $table = 'company_settings';

  //All settings are defined here with a system deault value
  private $settingsArray = array(
    array(
       "key" => "ALLOW_SIMULATION",
       "value" => "0",
       "descr" => "Allow the administrator to simulate the users",
       "admin" => "1",
       "type" => "checkbox"),
    array(
       "key" => "COMPANY_LOGO",
       "value" => "default.png",
       "descr" => "Company logo",
       "admin" => "0",
       "type" => "text"),
     );


  /**
   * Get all settings by company_id
   * @param <type> $company_id
   * @return array of stdClass
   */
  function getByCompanyId($company_id){
    $sql = "SELECT * FROM company_settings WHERE company_id  = ?";
    $query = $this->db->query($sql, array($company_id));
    if($query->num_rows() > 0 ){
      foreach ($query->result() as $row){
        $data[$row->key] = $row;
      }
      return $data;
    }else{
      //todo error handling
      return -1;
    }
  }


  /**
   function getByWlId($wl_id){
    $sql = "SELECT * FROM settings WHERE wl_id  = ?";
    $query = $this->db->query($sql, array($wl_id));
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
 */


  /**
   * Update all settings for the company_id
   * return true for success
   *
   * @param <type> $company_id
   * @param <type> $data
   * @return boolean
   */
  function update($company_id, $data){
    $sql = "SELECT id FROM company_settings WHERE company_id = ?";
    $query = $this->db->query($sql, array($company_id));
    if($query->num_rows() >= 1 ){
      foreach ($data as $key => $value){
        $sql = "UPDATE company_settings SET value = ?,  updated_at = ? WHERE company_id = ? AND `key` = ?";
        $query = $this->db->query($sql, array($value, date('Y-m-d H:i:s'), $company_id, $key));
      }
      return TRUE;
    } else {
      return FALSE;
    }
  }


  /**
   * Create all the settings in the db with company_id and system default values
   * @param <type> $company_id
   */
  function initialInsert($company_id){
    foreach ($this->settingsArray as $id => $row) {
       $data = array(
        'company_id' => $company_id,
        'key' => $row['key'],
        'value' => $row['value'],
        'descr' => $row['descr'],
        'default_value' => $row['value'],
        'admin' => $row['admin'],
        'type' => $row['type'],
       );
       $this->create($data);
    }
  }


	/**
   * Creates a new row in the db
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
   * Delete all settings for a company_id
   * @param <type> $company_id
   */
	function deleteByCompanyId($company_id){
		$this->db->where('company_id', $company_id);
		$this->db->delete($this->table);
  }


}