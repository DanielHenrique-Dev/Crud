<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		permission();
		$this->load->model("users_model");
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function index()
	{

		$nivel = $this->session->logged_user['nivel'];

		if ($nivel == 1) {
			$this->admin();
		} else {
			$this->usuarios();
		}
	}

	public function admin()
	{
		$dados = array();
		$limit = 3;
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->users_model->get_total();

		if ($total_records > 0) {
			$dados["users"] = $this->users_model->index_administrador($limit, $start);

			//configuração da paginação
			$config['base_url'] = base_url() . 'users/admin/';
			$config['total_rows'] = $total_records;
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;

			//estilo da paginação
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
			//////////////////////////////////

			$this->pagination->initialize($config);

			$dados['links'] = $this->pagination->create_links();
		}


		$dados["title"] = "Users - CodeIgniter";

		$this->load->view('templates/header', $dados);
		$this->load->view('templates/nav-top');
		$this->load->view('pages/users', $dados);
		$this->load->view('templates/footer', $dados);
		$this->load->view('templates/js', $dados);
	}
	public function usuarios()
	{
		$dados['users'] = $this->users_model->index_usuarios();
		$dados['title'] = "Usuarios - codeIgniter";

		$this->load->view('templates/header', $dados);
		$this->load->view('templates/nav-top');
		$this->load->view('pages/users', $dados);
		$this->load->view('templates/footer', $dados);
		$this->load->view('templates/js', $dados);
	}

	public function edit_user($id)
	{

		$dados["user"]  = $this->users_model->show($id);
		$dados["title"] = "Edit User - CodeIgniter";

		$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[24]|callback_text_check');
		$this->form_validation->set_rules('email', 'E-mail', 'required|callback_text_check');
		$this->form_validation->set_rules('country', 'Country', 'required|min_length[3]|max_length[14]|callback_text_check');
		$this->form_validation->set_rules('password', 'Senha', 'required|callback_text_check');


		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $dados);
			$this->load->view('templates/nav-top', $dados);
			$this->load->view('pages/edit-users', $dados);
			$this->load->view('templates/footer', $dados);
			$this->load->view('templates/js', $dados);
		} else {
			$user = array(
				"name" => $this->input->post("name"),
				"email" => $this->input->post("email"),
				"country" => $this->input->post("country"),
				"password" => md5($this->input->post("password")),
				"nivel" => $this->input->post("nivel"),
				"ativo" => $this->input->post("ativo")
			);
			$this->users_model->update_user($id, $user);
			redirect("users");
		}
	}

	public function text_check($texto)
	{
		return strip_tags($texto, '<p><a>');
	}
}
