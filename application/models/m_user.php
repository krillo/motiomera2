<?php

/**
 * Description of activities
 *
 * @author kristian Erendi
 */
class M_user extends CI_Model {

  private $table = 'users';






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
   * Get row by id
   * @param <type> $id
   * @return <type>
   */
  function getById($id){
    $sql = "SELECT * FROM users WHERE id  = ?";
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
	function create(){
    $data = array(
      'email' => $_POST['email'],
      'email_confirmed' => $_POST['email_confirmed'],
      'password' => $this->input->post('password'),
      'f_name' => $_POST['f_name'],
      'l_name' => $_POST['l_name'],
      'nick' => $_POST['nick'],
      'sex' => $_POST['sex'],
      'born' => $_POST['born'],
      'descr' => $_POST['descr'],
      'last_login' => $_POST['last_login'],
      'img_filename' => $_POST['img_filename'],
      'avatar_filename' => $_POST['avatar_filename'],
      'session_id' => $_POST['session_id'],
      'customer_id' => $_POST['customer_id'],
      'paid_until' => $_POST['paid_until'],
      'trophy_start' => $_POST['trophy_start'],
      'browser' => $_POST['browser'],
      'ip' => $_POST['ip'],
      'type' => $_POST['type'],
      'level' => $_POST['level'],
      'status' => $_POST['status'],
      'mAffCode' => $_POST['mAffCode'],
      'company_key_temp' => $_POST['company_key_temp']
    );
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	// update person by id
	function update($id){
    $data = array(
      'email' => $_POST['email'],
      'email_confirmed' => $_POST['email_confirmed'],
      'password' => $this->input->post('password'),
      'f_name' => $_POST['f_name'],
      'l_name' => $_POST['l_name'],
      'nick' => $_POST['nick'],
      'sex' => $_POST['sex'],
      'born' => $_POST['born'],
      'descr' => $_POST['descr'],
      'last_login' => $_POST['last_login'],
      'img_filename' => $_POST['img_filename'],
      'avatar_filename' => $_POST['avatar_filename'],
      'session_id' => $_POST['session_id'],
      'customer_id' => $_POST['customer_id'],
      'paid_until' => $_POST['paid_until'],
      'trophy_start' => $_POST['trophy_start'],
      'browser' => $_POST['browser'],
      'ip' => $_POST['ip'],
      'type' => $_POST['type'],
      'level' => $_POST['level'],
      'status' => $_POST['status'],
      'mAffCode' => $_POST['mAffCode'],
      'company_key_temp' => $_POST['company_key_temp']
    );
    //print_r($data); die();
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


  /**
   * Return true if user is logged in
   * @author Jonas Bjork <jonas.bjork@aller.se>
   */
  function isLoggedIn() {
    if ($this->session->userdata('user_logged_in') == TRUE) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  
  /**
   * Checking where user login creditials are correct. If correct log in and store some data.
   *
   * @param <type> $username
   * @param <type> $password
   * @return <type> boolean
   */
  function authenticate($username, $password) {
    $sql = "SELECT * FROM users WHERE (email = ? OR nick = ?) AND password = ? LIMIT 1";
    $query = $this->db->query($sql, array($username, $username, $password));
    if (!$query->num_rows) {
      //todo: return no match
      return FALSE;
    } else {
      $data = $query->result();
      if ($data[0]->paid_until < date('Y-m-d')) {
        //todo: return date is expired
        return FALSE;
      } else {
        $session_data = array(
            'user_id' => $data[0]->id,
            'user_mail' => $data[0]->email,
            'user_full_name' => $data[0]->f_name . "_" . $data[0]->l_name,
            'user_nick' => $data[0]->nick,
            'user_logged_in' => TRUE,
            'role_level' => $data[0]->level,
            'real_user_id' => $data[0]->id,
            'simulation' => FALSE,
        );
        $this->session->set_userdata($session_data);
        //update user in db
        $id = $data[0]->id;
        $update_data['last_login'] = date('Y-m-d H:i:s');
        $update_data['ip'] = $this->session->userdata('ip_address');
        $update_data['browser'] = $this->session->userdata('user_agent');
        $this->db->where('id', $id);
        $this->db->update('users', $update_data);
        return TRUE;
      }
    }
  }


  function logout(){
    $this->session->sess_destroy();
  }


}

