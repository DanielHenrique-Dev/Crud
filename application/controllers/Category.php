<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("category_model");
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function index()
	{
		$this->listar_category();
	}

	public function listar_category()
	{
		$dados = array();
		$limit = 3;
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->category_model->get_total();

		if ($total_records > 0) {
			$dados["category"] = $this->category_model->index($limit, $start);

			$config['base_url'] = base_url() . 'category/listar_category/';
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


			$dados["links"] = $this->pagination->create_links();
		}

		$dados['title'] = "Categoria - Codeigniter";



		$this->load->view('pages/category', $dados);
	}

	public function new()
	{
		$dados["title"] = "New Category - CodeIgniter";


		//// Validação de formulario
		$this->form_validation->set_rules('category', 'Categoria', 'required|min_length[3]|max_length[60]|callback_text_check');

		if ($this->form_validation->run() == FALSE) {
			$value = $this->input->post();


			$this->load->view('pages/form-category', $dados, $value);
		} else {
			$category = array(
				"category" => $this->input->post('category')
			);
			$category["user_id"] = $this->session->logged_user["id"];
			$this->category_model->store($category);
			redirect("category");
		}
	}
	public function edit_category($id_category)
	{
		$dados["title"] = "New Game - CodeIgniter";
		$dados["cat"] = $this->category_model->show($id_category);


		//// Validação de formulario
		$this->form_validation->set_rules('category', 'Categoria', 'required|min_length[3]|max_length[60]|callback_text_check');

		if ($this->form_validation->run() == FALSE) {
			$value = $this->input->post();

			$this->load->view('pages/form-category', $dados, $value);
		} else {
			$cat = $_POST;
			$this->category_model->update($id_category, $cat);
			redirect("category");
		}
	}


	public function delete($id)
	{
		$this->category_model->delete($id);
		redirect("category");
	}

	public function text_check($texto)
	{
		return strip_tags($texto, '<p><a>');
	}
}
