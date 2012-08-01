<?php
//namespace cit;
require_once ('config.php');
require_once ('form_error.php');
//use mysqli;
//use cit\form_error;
//use cit\download;
//use cit\gallery_image;
//use cit\image;
//use cit\media_type;
//use cit\license_type;

class database {
  private $connection = null;

  function __construct() {
    if(!$this->connection) {
      $this->connection = new mysqli(SC_DB_HOST, SC_DB_USER, SC_DB_PASSWORD, SC_DB_NAME, 3306);
      if($this->connection->connect_errno) {
        syslog(LOG_ALERT, 'Database Error: ' . $this->connection->connect_error());
        echo $this->connection->connect_errno;
      }
    }
  }

  function __destruct() {
    if($this->connection) {
      $this->connection->close();
    }
  }
  
  public function add_user($loginEmail,$loginPass) {
  		$query = sprintf("CALL InsertUploadedImage('%s', '%s', '%s', '%s', '%s', '%s')",$upload->getImage_name(), $upload->getFirst_name(), $upload->getLast_name(), $upload->getEmail(), $upload->getCompany(), $upload->getDescription());
  		//$binds = array($upload->getImage_name(), $upload->getFirst_name(), $upload->getLast_name(), $upload->getEmail(), $upload->getCompany());
  		//$this->parse_binds($query, $binds);
  		$result = $this->connection->query($query);
  		if(!$result) {
  			$error = $this->connection->error;
  			$fe = new form_error();
  			$fe->setForm_error_message('Database Error: InsertFormError(%s) method failed. Args: ' . json_encode($upload));
  			$fe->save();
  			return false;
  		}
  		return true;
  	}

  public function insert_form_error($form_error) {
    $query  = sprintf("CALL InsertFormError('%s')", $form_error->getForm_error_message());
    $result = $this->connection->query($query);
    if(!$result) {
      syslog(LOG_ERR, 'Database Error: database::InsertFormError method failed.');
      return false;
    }
    return true;
  }


  public function escape_fields($data) {
    if(is_object($data)) {
      foreach($data as $field => $val) {
        $data->$field = $this->connection->real_escape_string($val);
      }
    } elseif(is_array($data)) {
      foreach($data as $field => $val) {
        $data[$field] = $this->connection->real_escape_string($val);
      }
    } else {
      $data = $this->connection->real_escape_string($data);
    }
    return $data;
  }

  # This method uses recursion to dynamically replace each placeholder with each respective bind value
  # Additionally, it will wrap string values in singles quotes and leave integers unquoted
  private function parse_binds(&$query, $binds) {
    if(count($binds) == 0) {
      return $query;
    } else {
      preg_match_all('/\?/', $query, $matches, PREG_OFFSET_CAPTURE);
      $part = array_shift($matches[0]);
      $pos  = $part[1];
      $bind_val = trim($binds[0]);
      if(!is_int($bind_val) || !is_double($bind_val)) {
        $val = "'$bind_val'";
      } else {
        $val = $bind_val;
      }
      $query = substr_replace($query, $val, $pos, 1);
      array_shift($binds);
      $this->parse_binds($query, $binds);
    }
  }
  

  public function reset_connection()
  {
  	if($this->connection) {
  		$this->connection->close();
  	}
  	$this->connection = new mysqli(SC_DB_HOST, SC_DB_USER, SC_DB_PASSWORD, SC_DB_NAME, 3306);
  	if($this->connection->connect_errno) {
  		syslog(LOG_ALERT, 'Database Error: ' . $this->connection->connect_error());
  		echo $this->connection->connect_errno;
  	}
  	
  }
}

	
?>
