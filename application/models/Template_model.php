<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_model extends CI_Model {

	function __construct(){
		parent::__construct();
	
	}
	
	public function template($view, $data)
	{
        $this->load->view('templates/header');
        $this->load->view($view, $data);
        $this->load->view('templates/footer');
	}
}
