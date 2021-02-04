<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		$dados["title"] = "Login - CodeIgniter";
		$this->load->view('pages/login', $dados);
	}

	public function store()
	{
		
		$email    = $_POST["email"];
		$password = md5($_POST["password"]);
		$user     = $this->login_model->store($email, $password);

		if($user['ativo'] == 1){
			$this->session->set_userdata("logged_user", $user);
			redirect("dashboard");
		}elseif ($user['ativo'] == 0) {
			$this->session->set_flashdata('error_msg', 'O usuario foi desativado!');
			redirect('login');
		}else{
			$this->session->set_flashdata('error_msg', 'Erro ao tentar logar em sua conta, verifique se e-mail ou senha estão corretos!');
			redirect('login');

		}
	}

	public function logout()
	{
		$this->session->unset_userdata("logged_user");
		redirect('login');
	}
	
}