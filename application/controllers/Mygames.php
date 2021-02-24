<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mygames extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		permission();
		$this->load->model("games_model");
		$this->load->model("category_model");
	
		$this->load->library('form_validation');
	
	}

	public function mygames()
	{
		$this->mygames_listar();
	}

	public function mygames_listar()
	{
		$this->load->library('pagination');
		$this->load->helper('form');

		$dados = array();
		$limit = 3;
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->games_model->get_total();

		if ($total_records > 0) {
			$dados["games"] = $this->games_model->mygames_index($limit, $start);

			$config['base_url'] = base_url() . 'mygames/mygames_listar';
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

			$number = $this->games_model->number_games_by_id();

			if ($number > 3) {
				$dados["links"] = $this->pagination->create_links();
			}
		}




		$dados["title"] = "My Games - CodeIgnite";
		$dados['number'] = $this->games_model->number_games_by_id();
		
		$this->load->view('pages/my-games', $dados);
		
	}
}
