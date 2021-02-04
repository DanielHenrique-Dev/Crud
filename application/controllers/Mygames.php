<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mygames extends CI_Controller {

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

	public function mygames()
	{
		$this->mygames_listar();
	}

	public function mygames_listar()
	{
		$dados = array();
        $limit = 3;
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $this->games_model->get_total();

		if ($total_records > 0) 
        {
			$dados["games"] = $this->games_model->mygames_index($limit, $start);
				
			$config['base_url'] = base_url() . 'mygames/mygames_listar';
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
		
		
		
			
		$dados["title"] = "My Games - CodeIgnite";
		$this->load->view('templates/header', $dados);
		$this->load->view('templates/nav-top', $dados);
		$this->load->view('pages/my-games', $dados);
		$this->load->view('templates/footer', $dados);
		$this->load->view('templates/js', $dados);
	}
	
}
