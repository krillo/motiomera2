<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class M_address extends CI_Model {

  private $table = 'addresses';

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
   * Get user by user_id
   * @param <type> $id
   * @return <type>
   */
  function getById($id){
    $sql = "SELECT * FROM addresses WHERE id  = ?";
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
   * This function creates a new post with address info.
   *
   * @param <string> $company_id
   * @param <string> $user_id
   * @param <string> $type
   * @param <string> $company_name
   * @param <string> $ref_name
   * @param <string> $address1
   * @param <string> $address2
   * @param <string> $co
   * @param <string> $zip
   * @param <string> $city
   * @param <string> $email
   * @param <string> $phone
   * @param <string> $mobile
   * @param <string> $country
   * @param <string> $organisation_no
   * @param <string> $tax_code
   * @return <int> on success the row id else -1
   */
  function create($company_id, $user_id, $type, $company_name, $ref_name, $address1, $address2, $co, $zip, $city, $email, $phone, $mobile, $country, $organisation_no, $tax_code) {
    $data = array(
        'company_id' => $company_id,
        'user_id' => $user_id,
        'type' => $type,
        'company_name' => $company_name,
        'ref_name' => $ref_name,
        'address1' => $address1,
        'address2' => $address2,
        'co' => $co,
        'zip' => $zip,
        'city' => $city,
        'email' => $email,
        'phone' => $phone,
        'mobile' => $mobile,
        'country' => $country,
        'organisation_no' => $organisation_no,
        'tax_code' => $tax_code,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    );
    $this->db->insert('addresses', $data);
    if ($this->db->affected_rows() == 1) {
     $row_id = $this->db->insert_id();
      $session_data = array(
          'user_mail' => $email
      );
      $this->session->set_userdata($session_data);
      return $this->db->insert_id();
    } else {
      return -1;
    }
  }

  /*
   * This function updates
   *
   * @param <string> $company_id
   * @param <string> $user_id
   * @param <string> $type
   * @param <string> $company_name
   * @param <string> $ref_name
   * @param <string> $address1
   * @param <string> $address2
   * @param <string> $co
   * @param <string> $zip
   * @param <string> $city
   * @param <string> $email
   * @param <string> $phone
   * @param <string> $mobile
   * @param <string> $country
   * @param <string> $organisation_no
   * @param <string> $tax_code
   * @return <int> on success the row id else -1
   */
  function update($company_id, $user_id, $type, $company_name, $ref_name, $address1, $address2, $co, $zip, $city, $email, $phone, $mobile, $country, $organisation_no, $tax_code) {
    $data = array(
        'company_id' => $company_id,
        'user_id' => $user_id,
        'type' => $type,
        'company_name' => $company_name,
        'ref_name' => $ref_name,
        'address1' => $address1,
        'address2' => $address2,
        'co' => $co,
        'zip' => $zip,
        'city' => $city,
        'email' => $email,
        'phone' => $phone,
        'mobile' => $mobile,
        'country' => $country,
        'organisation_no' => $organisation_no,
        'tax_code' => $tax_code,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    );
    $this->db->where('id', $id);
      $this->db->update('addresses', $data);
    if($this->db->affected_rows() == 1){
      return $id;
    } else {
      return -1;
    }

  }

  function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table);
  }
    /*
      function create_x($ref_name, $address1, $co, $zip, $city, $email, $phone, $mobile, $country) {
      $data = array(
      'ref_name' => $ref_name,
      'address1' => $address1,
      'co' => $co,
      'zip' => $zip,

      )
      }
     *
     *
     */
  }
