<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Games extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		permission();
		$this->load->model("games_model");
		$this->load->model("category_model");
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper('form');
		
		
		
	}

	public function index()
	{
		//$query = $this->category_model->get_category(8);
		//echo $query;
	//	die(); 
		$this->listar();
	}
	
	public function listar()
	{
		$dados = array();
        $limit = 3;
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $this->games_model->get_total();

		if ($total_records > 0) 
        {
			$dados["games"] = $this->games_model->index($limit, $start);
		//	$dados["category"] = $this->category_model->get_category();	

			$config['base_url'] = base_url() . 'games/listar/';
			$config['total_rows'] = $total_records;
			$config['per_page'] = $limit;
			$config["uri_segment"] = 3;

		   /////////////////////////////
		   	$config['full_tag_open'] = '<div class="pagination justify-content-center">';
			$config['full_tag_close'] = '</div> ';
			$config['first_tag_open'] = ' <button class="btn btn-light" > ';
			$config['first_tag_close'] = '</button class="btn btn-light">  ';
			$config['prev_tag_open'] = '<button class="btn btn-light"> ';
			$config['prev_tag_close'] = '</button class="btn btn-light"> ';
			$config['next_tag_open'] = '<button class="btn btn-light"> ';
			$config['next_tag_close'] = '</button class="btn btn-light"> ';
			$config['last_tag_open'] = '<button class="btn btn-light"> ';
			$config['last_tag_close'] = '</button class="btn btn-light"> ';
			$config['cur_tag_open'] = '<button class="btn btn-light"  class="active">';
			$config['cur_tag_close'] = '</a></button class="btn btn-light"> ';
			$config['num_tag_open'] = '<button class="btn btn-light"> ';
			$config['num_tag_close'] = '</button class="btn btn-light"> ';
           /////////////////////
			
			$this->pagination->initialize($config);
			
			
			$dados["links"] = $this->pagination->create_links();
		
		}	
		
		
		
			
		$dados["title"] = "Games - CodeIgniter";
		$this->load->view('templates/header', $dados);
		$this->load->view('templates/nav-top', $dados);
		$this->load->view('pages/games', $dados);
		$this->load->view('templates/footer', $dados);
		$this->load->view('templates/js', $dados);
	}

	public function new()
	{	
		$dados["title"] = "New Game - CodeIgniter";
		$dados['category'] = $this->category_model->insert_category();


		//// Validação de formulario
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[60]|callback_text_check');
		$this->form_validation->set_rules('description', 'Description', 'required|min_length[3]|callback_text_check');
		$this->form_validation->set_rules('price','Price', 'required|numeric');
		$this->form_validation->set_rules('developer', 'Developer', 'required|min_length[4]|callback_text_check');

		if($this->form_validation->run() == FALSE){
			$value = $this->input->post();

			$this->load->view('templates/header', $dados);
			$this->load->view('templates/nav-top', $dados);
			$this->load->view('pages/form-games', $dados, $value);
			$this->load->view('templates/footer', $dados);
			$this->load->view('templates/js', $dados);
		
		}else{
			$game = $_POST;
			$game["user_id"] = $_SESSION["logged_user"]["id"];
			$this->games_model->store($game);
			redirect("games");
		}

		
	}
	

	public function edit($id)
	{	

		$dados["game"]  = $this->games_model->show($id);
		$dados['category'] = $this->category_model->insert_category();
		$dados["title"] = "Edit Game - CodeIgniter";
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[24]|callback_text_check');
		$this->form_validation->set_rules('description', 'Description', 'required|min_length[24]|callback_text_check');
		$this->form_validation->set_rules('price','Price', 'required|numeric');
		$this->form_validation->set_rules('developer', 'Developer', 'required|min_length[4]|callback_text_check');


		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header', $dados);
			$this->load->view('templates/nav-top', $dados);
			$this->load->view('pages/form-games', $dados);
			$this->load->view('templates/footer', $dados);
			$this->load->view('templates/js', $dados);
		}else{
			$game = $_POST;
			$this->games_model->update($id, $game);
			redirect("games");
		}
	}

	public function update($id)
	{
		
		$game = $_POST;
		$this->games_model->update($id, $game);
		redirect("games");
	}

	public function destroy($id)
	{
		$this->games_model->destroy($id);
		redirect("games");
	}

	
	public function text_check ($texto)
	{
		return strip_tags($texto, '<p><a>');
	}

}
