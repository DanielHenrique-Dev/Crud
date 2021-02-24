<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function index()
	{
		$dados["title"] = "Login - CodeIgniter";

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_text_check');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[3]callback_text_check');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('pages/login', $dados);
		} else {
			$email    = $this->input->post("email");
			$password = md5($this->input->post("password"));
			$user     = $this->login_model->store($email, $password);

			if ($user['ativo'] == 1) {
				$this->session->set_userdata("logged_user", $user);
				redirect("dashboard");
			}
			if ($user['ativo'] == 0) {
				$this->session->set_flashdata(
					'error_msg',
					'O usuario foi desativado ou erro na digitação por favor verifique se e-mail ou senha estão corretos!'
				);
				redirect('login');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata("logged_user");
		redirect('login');
	}

	public function text_check($texto)
	{
		return strip_tags($texto, '<p><a>');
	}
}
