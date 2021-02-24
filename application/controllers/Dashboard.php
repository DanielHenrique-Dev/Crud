<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		permission();
		$this->load->model("games_model");
		$this->load->model("users_model");
		$this->load->model("category_model");
		$this->load->library('form_validation');
		$this->load->helper('form');

	}

	public function index()
	{
		$dados["games"]  = $this->games_model->dashboard_index();
		$dados["users"]  = $this->users_model->dashboard_index();
		$dados["title"] = "Dashboard - CodeIgniter";

		
		$this->load->view('pages/dashboard', $dados);
		
		

	}

	public function pesquisar()
	{
		$this->load->model("busca_model");

		$this->form_validation->set_rules('busca', 'Busca', 'callback_text_check');

		if($this->form_validation->run() == TRUE)
		{
			$dados["title"] = "Resultado da Pesquisa por *" . $this->input->post('busca') . "*";
			$dados["resultado"] = $this->busca_model->buscar_games($this->input->post('busca'));

			
			$this->load->view('pages/resultado', $dados);
		
		}
		
	}

	public function pesquisar_usuario()
	{
		$this->load->model("busca_model");

		$this->form_validation->set_rules('busca', 'Busca', 'callback_text_check');

		if($this->form_validation->run() == TRUE)
		{
			$dados["title"] = "Resultado da Pesquisa por *" . $this->input->post('busca') . "*";
			$dados["users"] = $this->busca_model->buscar_user($this->input->post('busca'));

			
			$this->load->view('pages/users', $dados);
		
		}
		
	}

	public function pesquisar_category()
	{
		$this->load->model("busca_model");

		$this->form_validation->set_rules('busca', 'Busca', 'callback_text_check');

		if($this->form_validation->run() == TRUE)
		{
			$dados["title"] = "Resultado da Pesquisa por *" . $this->input->post('busca') . "*";
			$dados["category"] = $this->busca_model->buscar_category($this->input->post('busca'));

		
			$this->load->view('pages/category', $dados);
		
		}
		
	}

	public function pesquisar_mygames()
	{
		$this->load->model("busca_model");

		$this->form_validation->set_rules('busca', 'Busca', 'callback_text_check');

		if($this->form_validation->run() == TRUE)
		{
			$dados["title"] = "Resultado da Pesquisa por *" . $this->input->post('busca') . "*";
			$dados["resultado"] = $this->busca_model->buscar_mygames($this->input->post('busca'));

			
			$this->load->view('pages/resultado', $dados);
			
		}
		
	}
	
	public function text_check ($texto)
	{
		return strip_tags($texto, '<p><a>');
	}

}
