<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		permission();
		$this->load->model("games_model");
		$this->load->model("users_model");
		$this->load->model("category_model");
	}

	public function index()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$dados["games"]  = $this->games_model->dashboard_index();
		$dados["users"]  = $this->users_model->dashboard_index();
		$dados["title"] = "Dashboard - CodeIgniter";


		$this->load->view('pages/dashboard', $dados);
	}

	public function pesquisar()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->load->model("busca_model");

		$this->form_validation->set_rules('busca', 'Busca', 'required|callback_alpha_numeric_spaces');

		if ($this->form_validation->run() == FALSE) {
			
			$this->load->view('pages/erro-busca');
		} else {

			$dados["title"] = "Resultado da Pesquisa por *" . $this->input->post('busca') . "*";
			$dados["resultado"] = $this->busca_model->buscar_games($this->input->post('busca'));

			$this->load->view('pages/resultado', $dados);
		}
	}

	public function pesquisar_usuario()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->load->model("busca_model");

		$this->form_validation->set_rules('busca', 'Busca', 'callback_alpha_numeric_spaces');

		if ($this->form_validation->run() == FALSE) {
		
			$this->load->view('pages/erro-busca');
		}else{
			$dados["title"] = "Resultado da Pesquisa por *" . $this->input->post('busca') . "*";
			$dados["users"] = $this->busca_model->buscar_user($this->input->post('busca'));


			$this->load->view('pages/users', $dados);
		}
	}

	public function pesquisar_category()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->load->model("busca_model");

		$this->form_validation->set_rules('busca', 'Busca', 'callback_alpha_numeric_spaces');

		if ($this->form_validation->run() == TRUE) {
			
			$this->load->view('pages/erro-busca');
		}else{
			$dados["title"] = "Resultado da Pesquisa por *" . $this->input->post('busca') . "*";
			$dados["category"] = $this->busca_model->buscar_category($this->input->post('busca'));


			$this->load->view('pages/category', $dados);
		}
	}

	public function pesquisar_mygames()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->load->model("busca_model");

		$this->form_validation->set_rules('busca', 'Busca', 'callback_alpha_numeric_spaces');

		if ($this->form_validation->run() == TRUE) {
			
			$this->load->view('pages/erro-busca');
		}else{
			$dados["title"] = "Resultado da Pesquisa por *" . $this->input->post('busca') . "*";
			$dados["resultado"] = $this->busca_model->buscar_mygames($this->input->post('busca'));


			$this->load->view('pages/resultado', $dados);
		}
	}
	
	public function alpha_numeric_spaces($str) {
		return (bool) preg_match('/^[A-Z0-9-]+$/i', $str);
	}
}
