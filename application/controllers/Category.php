<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

		if ($total_records > 0) 
        {
			$dados["category"] = $this->category_model->index($limit, $start);

			$config['base_url'] = base_url() . 'category/listar_category/';
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
	   
		$dados['title'] = "Categoria - Codeigniter"; 

		$this->load->view('templates/header', $dados);
        $this->load->view('templates/nav-top', $dados);
        $this->load->view('pages/category', $dados);
		$this->load->view('templates/footer', $dados);
        $this->load->view('templates/js', $dados);
        
    
    }

    public function new()
    {
        $dados["title"] = "New Category - CodeIgniter";


		//// Validação de formulario
		$this->form_validation->set_rules('category', 'Categoria', 'required|min_length[3]|max_length[60]|callback_text_check');
		
		if($this->form_validation->run() == FALSE){
			$value = $this->input->post();

			$this->load->view('templates/header', $dados);
			$this->load->view('templates/nav-top', $dados);
			$this->load->view('pages/form-category', $dados, $value);
			$this->load->view('templates/footer', $dados);
			$this->load->view('templates/js', $dados);
		
		}else{
            $category = array(
                "category" =>$_POST['category']
			);
			$category["user_id"] = $_SESSION["logged_user"]["id"];
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
		
		if($this->form_validation->run() == FALSE){
			$value = $this->input->post();

			$this->load->view('templates/header', $dados);
			$this->load->view('templates/nav-top', $dados);
			$this->load->view('pages/form-category', $dados, $value);
			$this->load->view('templates/footer', $dados);
			$this->load->view('templates/js', $dados);
		
		}else{
			$cat = $_POST;
			$this->category_model->update($id_category, $cat);
			redirect("category");
        }
	}
	
	public function update($id)
	{
		
		$cat = $_POST;
		$this->category_model->update($id_category, $category);
		redirect("games");
	}
    
    public function delete($id)
	{
		$this->category_model->delete($id);
		redirect("category");
    }
    
    public function text_check ($texto)
	{
		return strip_tags($texto, '<p><a>');
	}

}
