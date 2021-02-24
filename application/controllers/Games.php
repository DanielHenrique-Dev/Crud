<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Games extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		permission();
		$this->load->model("games_model");
		$this->load->model("category_model");
	}

	public function index()
	{

		$this->listar();
	}

	public function listar()
	{
		//
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper('form');
		//

		$dados = array();
		$limit = 3;
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->games_model->get_total();


		$dados["games"] = $this->games_model->index($limit, $start);

		$config['base_url'] = base_url() . 'games/listar/';
		$config['total_rows'] = $total_records;
		$config['per_page'] = $limit;
		$config["uri_segment"] = 3;

		/////////////////////////////
		$config['full_tag_open'] = '<ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = '&lsaquo; Primeira';
		$config['last_link'] = 'Última &rsaquo;';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(atual)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		/////////////////////

		$this->pagination->initialize($config);


		$number = $this->games_model->number_games();

		if ($number > $limit) {
			$dados["links"] = $this->pagination->create_links();
		}


		$dados["title"] = "Games - CodeIgniter";
		$dados['number'] = $this->games_model->number_games();

		$this->load->view('pages/games', $dados);
	}

	public function new()
	{
		//
		$this->load->library('form_validation');
		$this->load->helper('form');
		//
		$dados["title"] = "New Game - CodeIgniter";
		$dados['category'] = $this->category_model->insert_category();


		//// Validação de formulario
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[60]|callback_text_check');
		$this->form_validation->set_rules('description', 'Description', 'required|min_length[3]|max_length[255]|callback_text_check');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
		$this->form_validation->set_rules('developer', 'Developer', 'required|min_length[4]|callback_text_check');

		if ($this->form_validation->run() == FALSE) {
			$value = $this->input->post();


			$this->load->view('pages/form-games', $dados, $value);
		} else {
			$game = $_POST;
			$game["user_id"] = $this->session->logged_user['id'];
			$this->games_model->store($game);
			redirect("games");
		}
	}


	public function edit($id)
	{
		//
		$this->load->library('form_validation');
		$this->load->helper('form');
		//

		$dados["game"]  = $this->games_model->show($id);
		$dados['category'] = $this->category_model->insert_category();
		$dados["title"] = "Edit Game - CodeIgniter";
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[24]|callback_text_check');
		$this->form_validation->set_rules('description', 'Description', 'required|min_length[3]|max_length[255]|callback_text_check');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
		$this->form_validation->set_rules('developer', 'Developer', 'required|min_length[4]|callback_text_check');


		if ($this->form_validation->run() == FALSE) {

			$this->load->view('pages/form-games', $dados);
		} else {
			$game = $_POST;
			$this->games_model->update($id, $game);
			redirect("games");
		}
	}

	public function destroy($id)
	{
		$this->games_model->destroy($id);
		redirect("games");
	}


	public function text_check($texto)
	{
		return strip_tags($texto, '<p><a>');
	}
}
