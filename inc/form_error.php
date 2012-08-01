<?php
//namespace cit;
require_once('database.php');

//use cit\database;

class form_error {
	private $form_error_id;
	private $form_error_message;
	
	function __construct() {
	
	}
	
	function __destruct() {
	
	}
	/**
	 * @return the $form_error_id
	 */
	public function getForm_error_id() {
		return $this->form_error_id;
	}

	/**
	 * @param field_type $form_error_id
	 */
	public function setForm_error_id($form_error_id) {
		$this->form_error_id = $form_error_id;
	}

	/**
	 * @return the $form_error_message
	 */
	public function getForm_error_message() {
		return $this->form_error_message;
	}

	/**
	 * @param field_type $form_error_message
	 */
	public function setForm_error_message($form_error_message) {
		$this->form_error_message = $form_error_message;
	}
	
	public function save()
	{
		$db = new database();
		$db->insert_form_error($this);
		unset($db);
	}

}

?>