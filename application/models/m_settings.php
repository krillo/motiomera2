<?php


/**
 * The settings
 * @author Kristian Erendi 2011
 */
class M_settings extends CI_Model {
  private $table = 'settings';

  //All settings are defined here with a system deault value
  private $settingsArray = array(
    array(
       "key" => "LAST_REG_ADD_DAYS",
       "value" => "1",
       "descr" => "Allow registrations x days after closed competition"),
    array(
       "key" => "SEND_RESULT_EMAIL_ADD_DAYS",
       "value" => "2",
       "descr" => "Send result email X days after closed competition"),
    array(
       "key" => "LAST_ADMIN_DAY_ADD_DAYS",
       "value" => "14",
       "descr" => "Company administration page will be open X days after closed competition"),
    array(
       "key" => "MAX_NEW_PASS_ATTEMPTS",
       "value" => "3",
       "descr" => "How many 'forgot password' attempts before captcha"),
    array(
       "key" => "FRAUD_TIMESPAN_HOURS",
       "value" => "1",
       "descr" => "Timespan for 'forgot password' attempts, hours"),
    array(
       "key" => "NEW_PASS_LINK_VALID_HOURS",
       "value" => "6",
       "descr" => "Timespan for how long the new password link is valid, hours"),
     );

  


  /**
   * Create the settings file
   * 
   * @param <type> $wl_id
   * @param <type> $wl_data 
   */
  function createSettingsFile($wl_id, $wl_data){
    $this->load->helper('file');
    $data = $this->getByWlId($wl_id);
    $name = $wl_data->name;
    $generated = date('Y-m-d H:i:s');
    $settings = "<?php \n";
    $settings .= "/* \n * The settings file for white label: $name,  wl_id = $wl_id,  $generated \n * This file is automatically generated from the db table 'settings'. \n * Do not edit this file. Use the settings panel in the GUI \n */ \n\n";
    foreach ($data as $row) {
      $settings .= 'define("'. $row->key .'", '. $row->value .');' . "\n";
    }
    $settings .= "?>";
    $file = "./settings/settings_wl_id$wl_id.php";
    if (!write_file($file, $settings)){
     return -1;
    }else{
     return $file;
    }

  }


  /**
   * Get all settings by wl_id
   * @param <type> $wl_id
   * @return array of stdClass
   */
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


  /**
   * Update all settings for the wl_id
   * return true for success
   *
   * @param <type> $wl_id
   * @param <type> $data
   * @return boolean
   */
  function update($wl_id, $data){
    $sql = "SELECT id FROM settings WHERE wl_id = ?";
    $query = $this->db->query($sql, array($wl_id));
    if($query->num_rows() >= 1 ){
      foreach ($data as $key => $value){
        $sql = "UPDATE settings SET value = ?,  updated_at = ? WHERE wl_id = ? AND `key` = ?";
        $query = $this->db->query($sql, array($value, date('Y-m-d H:i:s'), $wl_id, $key));
      }
      return TRUE;
    } else {
      return FALSE;
    }
  }


  /**
   * Create all the settings in the db with wl_id and system default values
   *
   * @param <type> $wl_id
   */
  function initialInsert($wl_id){
    foreach ($this->settingsArray as $id => $row) {
       $data = array(
        'wl_id' => $wl_id,
        'key' => $row['key'],
        'value' => $row['value'],
        'descr' => $row['descr'],
        'default_value' => $row['value']
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
   * Delete all settings for a wl_id
   * 
   * @param <type> $wl_id
   */
	function deleteByWlId($wl_id){
		$this->db->where('wl_id', $wl_id);
		$this->db->delete($this->table);
  }




}