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
  function getAll($limit = 20) {
    $sql = "SELECT * FROM users ORDER BY id DESC LIMIT ?";
    $query = $this->db->query($sql, array($limit));
    //$query = $this->db->get($this->table, $limit);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
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
  function getById($id) {
    $sql = "SELECT * FROM users WHERE id  = ?";
    $query = $this->db->query($sql, array($id));
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data[0];
    } else {
      //todo error handling
      return -1;
    }
  }

  function getUsersByContestId($contest_id) {
    $sql = "SELECT k.*,  u.nick, u.f_name, u.l_name, u.avatar_filename  FROM users u, `keys` k WHERE u.id = k.user_id AND k.contest_id = ? ORDER BY f_name ASC";
    $query = $this->db->query($sql, array($contest_id));
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    } else {
      //todo error handling
      return -1;
    }
  }

  /**
   *
   */
  function getCurrentContestTeamKeyById($user_id){
    $sql = "SELECT k.contest_id, k.user_id, team_id, `key`, company_id, start, stop, nof_weeks, route_xxx, t.name team_name, img_filename team_img_filename, total_steps team_total_steps, co.name company_name " .
           "FROM `keys` k, contests c, teams t, companys co WHERE k.user_id = ? AND k.contest_id = c.id AND CURDATE() > start AND CURDATE() < stop AND k.team_id = t.id AND c.company_id = co.id";
    $query = $this->db->query($sql, array($user_id));
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    } else {
      //todo error handling
      return -1;
    }
  }

  /**
   * Checks if the email-address exists, if exists return mail to user.
   * @param <type> $email
   */
  function checkEmail($email) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $query = $this->db->query($sql, array($email));
    if ($query->num_rows() == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * This function checks if the activation code has expired.
   * This function gets the users id from db if the newpasscode has one match.
   * On match it also loggs in the user
   *
   * @param <type> $code
   * @return <type>
   */
  function newPassCode($code) {
      $sql = "SELECT * FROM users WHERE new_pass_code = ? AND new_pass_datetime > DATE_SUB(NOW(), INTERVAL ? SECOND)";
      $query = $this->db->query($sql, array($code, 10));  // valid 6 hour, see settings file
    if ($query->num_rows() == 1) {
      $data = $query->result();
      $user_id = $data[0]->id;
      $this->_login($data);  //login user
      return $user_id;
    } else {
      return -1;
    }
  }

  /**
   * this method returns true if username exists else false
   * @param <type> $username
   * @return boolean
   */
  function isDuplicateUsername($username) {
    $sql = "SELECT id FROM users WHERE nick = ?";
    $query = $this->db->query($sql, array($username));
    if ($query->num_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * this method returns true if email exists else false
   * @param <type> $email
   * @return boolean
   */
  function isDuplicateEmail($email) {
    $sql = "SELECT id FROM users WHERE email = ?";
    $query = $this->db->query($sql, array($email));
    if ($query->num_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * It creates a new post with a footprint
   * Check for frauds (robots)
   * If footprint exists more then x-times in time-y in the db then true is return.
   * Else is this probably a legal request
   *
   * @param string $footprint
   * @param string $type
   * @return int -1 error, 0 attempts exceeded, else the count for how many tries
   */
  function isFraud($footprint, $type) {
    $now = date('Y-m-d H:i:s');
    $ip = $this->input->ip_address();
    $sql = "INSERT INTO frauds (type, ip, footprint, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";
    $query = $this->db->query($sql, array($type, $ip, $footprint, $now, $now));

    $sql = "SELECT COUNT(id) count FROM frauds WHERE footprint = ? AND created_at > DATE_SUB(NOW(), INTERVAL ? Hour)";
    $query = $this->db->query($sql, array($footprint, FRAUD_TIMESPAN_HOURS)); // within 1 hour
    //echo $this->db->last_query();
    if ($query->num_rows() > 0) {
      $data = $query->result();
      //print_r($data);
      if ($data[0]->count <= MAX_NEW_PASS_ATTEMPTS) { //max 3 attempts 
        return $data[0]->count;       //all ok
      } else {
        return 0;                  //attempts exceeded
      }
    } else {
      //todo: error handling
      return -1;                 //error
    }
  }
  
  /**
   * This function check if .
   * @param <type> $code
   * @return <type>
   */
  function checkNewPassTime ($code) {
    //$sql = "SELECT * FROM users WHERE new_pass_code = ? AND new_pass_datetime > DATE_SUB(NOW(), INTERVAL 30 SECOND) ";
    //$sql = "SELECT new_pass_datetime FROM users WHERE new_pass_code = ?";
    $query = $this->db->query($sql, array($code));
    //echo $this->db->last_query();
    if ($query->num_rows() == 1) {
      $data = $query->result();
      $start = $data[0]->new_pass_datetime;
        //login user
      /*
      foreach ($query->result() as $data) {
        $user_id = $data->id;
        $this->_login($data);  //login user
      }
       */
      return $start;
    } else {
      return -1;
    }
  }

  /**
   * Count all records.
   * Returns count and which table their from
   * @return array
   */
  function count() {
    $query = $this->db->count_all($this->table);
    $data['table'] = $this->table;
    $data['count'] = $query;
    return $data;
  }

  // get persons with paging
  function getPagedList($limit = 10, $offset = 0) {
    $this->db->order_by('id', 'asc');
    return $this->db->get($this->table, $limit, $offset);
  }

  /**
   * Creates a new post with the most basic parameters
   *
   * @param <string> $email
   * @param <string> $password
   * @param <string> $f_name
   * @param <string> $l_name
   * @param <string> $nick
   * @param <string> $sex
   * @param <string> $source
   * @param <string> $muni
   * @return <int> on success the row id else -1
   */
  function create($email, $password, $f_name, $l_name, $nick, $sex, $source, $muni) {
    $password = $this->_codePassword($password);
    $data = array(
        'email' => $email,
        'password' => $password,
        'f_name' => $f_name,
        'l_name' => $l_name,
        'nick' => $nick,
        'sex' => $sex,
        'municipal_id' => $muni,
        'sources_id' => $source,
        'new_pass_code' => $code,
        'new_pass_datetime' => $datetime,
        'status' => 1,
        'level' => 11,
        'email_confirmed' => 0,
        'wl_id' => 1, //$this->session->userdata('wl_id'),  //todo: get wl_id from config file
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    );
    $this->db->insert('users', $data);
    if ($this->db->affected_rows() == 1) {
      $user_id = $this->db->insert_id();
      $session_data = array(
          'user_id' => $user_id,
          'user_mail' => $email,
          'user_full_name' => $f_name . " " . $l_name,
          'user_nick' => $nick,
          'real_user_id' => $user_id,
          'simulation' => FALSE,
      );
      $this->session->set_userdata($session_data);
      return $this->db->insert_id();
    } else {
      return -1;
    }
  }

  /**
   * This function updates names
   *
   * @param <type> $id
   * @param <type> $f_name
   * @param <type> $l_name
   * @return <type>
   */
  function updateName($id, $f_name, $l_name) {
    $data = array(
        'f_name' => $f_name,
        'l_name' => $l_name,
        'updated_at' => date('Y-m-d H:i:s'),
    );
    $this->db->where('id', $id);
    $this->db->update('users', $data);
    if ($this->db->affected_rows() == 1) {
      return $id;
    } else {
      return -1;
    }
  }

  /**
   * This function set a new pass code and a datetime.
   * -1 is return on error
   * @param <type> $email
   * @return string the code
   */
  function setPassCode($email) {
    $updated_at = date('Y-m-d H:i:s');
    $code = sha1(time() . $email);
    $sql = "UPDATE users SET new_pass_code = ?, updated_at = ?, new_pass_datetime = ? WHERE email = ?";
    $query = $this->db->query($sql, array($code, $updated_at, $updated_at, $email));
    if ($this->db->affected_rows() == 1) {
      return $code;
    } else {
      return -1;
    }
  }

  /**
   *  This function updates the new password in db.
   * @param <type> $user_id
   * @param <type> $newpassword
   * @return <type>
   */
  function updatePassword($user_id, $newpassword) {
    $updated_at = date('Y-m-d H:i:s');
    $newpassword = $this->_codePassword($newpassword);
    $sql = "UPDATE users SET password = ?, updated_at = ? WHERE id = ?";
    $query = $this->db->query($sql, array($newpassword, $updated_at, $user_id));
    if ($this->db->affected_rows() == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * This function codes the password.
   * @param <type> $newpassword
   * @return <type>
   */
  function _codePassword($newpassword){
    //todo, create the coding algoritm.
    return $newpassword;
  }

  // update person by id
  function update($id) {
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
        'company_key_temp' => $_POST['company_key_temp'],
        'new_pass_code' => $_POST['new_pass_code'],
        'new_pass_datetime' => $_POST['new_pass_datetime']
    );
    //print_r($data); die();
    $data['updated_at'] = date('Y-m-d H:i:s');
    $this->db->where('id', $id);
    $this->db->update($this->table, $data);
  }

  /**
   * delete row, id from segment 3
   */
  function delete($id) {
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
    if ($username == '' OR $password == '') {
      return -1; //wrong user or pass
    }
    $sql = "SELECT * FROM users WHERE (email = ? OR nick = ?) AND password = ? LIMIT 1";
    $query = $this->db->query($sql, array($username, $username, $password));
    if (!$query->num_rows) {
      return -1;  //wrong user or pass
    } else {      //ok user and pass
      $data = $query->result();
      return $this->_login($data);
    }
  }

  /**
   * Logs in the user
   * @param <type> $user_id
   * @return <type>
   */
  /*
  function loginPasscodeOk($user_id){
    $sql = "SELECT * FROM users WHERE id = ? LIMIT 1";
    $query = $this->db->query($sql, array($user_id));
    if (!$query->num_rows) {
      return -1;  //wrong user_id
    } else {      //ok 
      $data = $query->result();
      return $this->_login($data);
    }
  }
*/


  /**
   * Logs in the user and sets all the variables.
   * This must only be used internally from the class.
   *
   * @param <type> $data a full data record i.e. "select * from user"
   * @return <type>
   */
  function _login($data){
      $session_data = array(
          'user_id' => $data[0]->id,
          'user_mail' => $data[0]->email,
          'user_full_name' => $data[0]->f_name . " " . $data[0]->l_name,
          'user_nick' => $data[0]->nick,
          'user_logged_in' => FALSE,
          'role_level' => $data[0]->level,
          'real_user_id' => $data[0]->id,
          'total_steps' => $data[0]->total_steps,
          'total_logins' => $data[0]->total_logins,
          'total_regs' => $data[0]->total_regs,
          'total_calories' => $this->m_step->getCaloriesFromSteg($data[0]->total_steps),
          'wl_id' => $data[0]->wl_id,
          'simulation' => FALSE,
      );
      $this->session->set_userdata($session_data);
      if ($data[0]->paid_until < date('Y-m-d')) {
        return -2;  //date is expired
      } else {
        //all ok - login the user
        $session_data = array(
            'user_logged_in' => TRUE,
        );
        $this->session->set_userdata($session_data);
        //update user in db
        $id = $data[0]->id;
        $update_data['last_login'] = date('Y-m-d H:i:s');
        $update_data['total_logins'] = $data[0]->total_logins + 1;
        $this->db->where('id', $id);
        $this->db->update('users', $update_data);
        return 1;
      }
    }




  /**
   * Loggs out the user by destroying the session
   */
  function logout() {
    $this->session->sess_destroy();
  }

  /**
   * This function does a wildcard search for users.
   * It searches matches in f_name, l_name, nick, email and the id
   * a match is returned with an array of user data otherwhise -1 is returned
   *
   * @param string $search
   * @return mix array of user data or -1 for nothing found
   */
  function getByWildcard($search) {
    $prep_search = '%' . $search . '%';   //prepare the text $search so it will be a wildcard param
    if (is_numeric($search)) {  //if $search is numeric also search the id field
      $sql = "SELECT distinct(u.id), u.* FROM users u WHERE f_name LIKE ? OR l_name LIKE ? OR nick LIKE ? OR email LIKE ? OR id = ? ORDER BY id DESC LIMIT 20";
      $query = $this->db->query($sql, array($prep_search, $prep_search, $prep_search, $prep_search, $search));
    } else {
      $sql = "SELECT distinct(u.id), u.* FROM users u WHERE f_name LIKE ? OR l_name LIKE ? OR nick LIKE ? OR email LIKE ? ORDER BY id DESC LIMIT 20";
      $query = $this->db->query($sql, array($prep_search, $prep_search, $prep_search, $prep_search));
    }
    //echo $this->db->last_query();
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    } else {
      return -1;
    }
  }

}