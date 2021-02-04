<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->library("form_validation");
		$this->load->helper('form');
	}

	public function index()
	{		
		$dados["title"] = "Sign Up - CodeIgniter";

		$this->form_validation->set_rules('name' ,'Name', 'required|min_length[3]|max_length[60]|alpha|callback_text_check');
		$this->form_validation->set_rules('country' ,'Country', 'required|alpha|min_length[3]|callback_text_check');
		$this->form_validation->set_rules('email' ,'Email', 'required|valid_email|callback_text_check');
		$this->form_validation->set_rules('password' ,'Password', 'required|min_length[3]callback_text_check');
			if ($this->form_validation->run() == FALSE)
	        {
	            $this->load->view('pages/signup', $dados);
	        }
	        else
	        {
		            $this->load->model("users_model");
					$user = array(
						"name" => $_POST["name"],
						"country" => $_POST["country"],
						"email" => $_POST["email"],
						"password" => md5($_POST["password"])
				);

				$this->users_model->store($user);
				redirect("login");
	        }
	}

	public function text_check ($texto)
	{
		return strip_tags($texto, '<p><a>');
	}

}
