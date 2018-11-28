<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publico extends CI_Controller {

	function __construct(){
		parent::__construct();
		
	}
	
	public function index()
	{
		$data = array(
			'questions' => $this->publico_model->questions()
		);
		$this->template_model->template('login', $data);
	}

	public function save()
	{
		
		if ($this->input->is_ajax_request()) {

			//Variable to configure the array for the form_validation
			$config = array(
				//Name
				array(
					'field'  => 'name',
					'label'  => 'Name',
					'rules'  => 'trim|required|min_length[4]|max_length[20]',
					'errors' => array(
									'required' => 'You must provide a correct %s.'
								),
				),
				//Lastname
				array(
					'field'  => 'lastname',
					'label'  => 'Lastname',
					'rules'  => 'trim|required|min_length[4]|max_length[20]',
					'errors' => array(
									'required' => 'You must provide a correct %s.'
								),
				),
				//Email
				array(
					'field'  => 'email',
					'label'  => 'Email',
					'rules'  => 'trim|required|min_length[4]|max_length[50]|valid_email|is_unique[users.email]',
					'errors' => array(
									'required' => 'You must provide a correct %s.',
									'is_unique' => 'This %s already exist.'
								),
				),
				//User
				array(
					'field' => 'user',
					'label' => 'User',
					'rules' => 'trim|required|min_length[5]|max_length[50]|is_unique[users.user]',
					'errors' => array(
									'required' => 'You must provide a correct %s.',
									'is_unique' => 'The %s already exist.',
								),
				),
				//Password
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'callback_valid_password'
				),
				//Password confirmation
				array(
					'field' => 'passconf',
					'label' => 'Password Confirmation',
					'rules' => 'trim|required|matches[password]'
				),
				//First answer
				array(
					'field'  => 'firstA',
					'label'  => 'Fisrt Answer',
					'rules'  => 'callback_valid_answer'
					
				),
				//Second answer
				array(
					'field' => 'secondA',
					'label' => 'Second Answer',
					'rules' => 'callback_valid_answer'
				)
			);
			//Set rule for the form_validation
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run()) 
			{	
				$data = array(
					'name'      => $this->input->post('name'),
					'user'      => $this->input->post('user'),
					'lastname'  => $this->input->post('lastname'),
					'email'     => $this->input->post('email'),
					'password'  => do_hash($this->input->post('password'), 'sha256'),
					'level_id'  => 1
				);
				//Save data user and set user id 
				$user_id = $this->publico_model->saveUser($data);
				
				$ans1 = array(
					'answer' => do_hash($this->input->post('firstA', 'sha256'))
				);
				$ans2 = array(
					'answer' => do_hash($this->input->post('secondA', 'sha256'))
				);
				//Save and set answers id
				$ans1_id = $this->publico_model->saveAnswer($ans1);
				$ans2_id = $this->publico_model->saveAnswer($ans2);
				
				//Data for the password recovery
				$data_recovery = array(
					'user_id' => $user_id,
					'firstQ_id' => $this->input->post('firstQ'),
					'firstA_id' => $ans1_id,
					'secondQ_id' => $this->input->post('secondQ'),
					'secondA_id' => $ans2_id);
				$this->publico_model->createDataRecovery($data_recovery);
				
				echo json_encode(array(
					'success' => true,
					'message' => 'The user has been created')
				);
			}
			else
			{
				echo json_encode(array(
					'failed'  => true,
					'message' => validation_errors())
				);
				
			}
		} else {
			redirect('publico');
		}
		
	}

	//function to valid the first and second answer
	public function valid_answer($answer = '')
	{
		$answer = trim($answer);
		if (empty($answer))
		{
			$this->form_validation->set_message('valid_answer', 'The {field} field is required.');
			return FALSE;
		}
		if (strlen($answer)  < 10)
		{
			$this->form_validation->set_message('valid_answer', 'The {field} field must be at least 10 characters.');
			return FALSE;
		}
		return TRUE;
	}
	//Function to valid the password with a callback function
	public function valid_password($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        if (empty($password))
        {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            return FALSE;
        }
        if (strlen($password) < 10)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least 10 characters in length.');
            return FALSE;
        }
        return TRUE;
	}
	
	public function login() {

	}
}
