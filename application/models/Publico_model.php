<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publico_model extends CI_Model {

	function __construct(){
		parent::__construct();
	
	}
	
	//Function to get answers
	public function questions()
	{
		$query = $this->db->get('questions');
		return $query->result();
	}
	//Function to save user
	public function saveUser($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	//function to save the answer and obtain the id
	public function saveAnswer($answer)
	{
		$this->db->insert('answer', $answer);
		return $this->db->insert_id();
	}

	//function to create data recovery
	public function createDataRecovery($data)
	{
		$this->db->insert('recovery', $data);
	}
}
