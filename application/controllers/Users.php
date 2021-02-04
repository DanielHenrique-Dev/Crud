<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

	//	$query = $this->db->get_where("tb_users", array('id' => 1));

//			foreach ($query->result_array() as $row)
//			{
//			        if($row['id'] == 1 )
//			        {
//			        	echo 'finalmente viado';
//			        }
			//}
		//$this->db->select('nivel');
		//$acesso = $this->db->get('tb_users')->row_array();
		//print_r($_SESSION);
		//die();

		$nivel = $_SESSION['logged_user']['nivel'];
				
		if($nivel == 1)
		{	
			$this->admin();
		}else{
			$this->usuarios();
		}	
	}

	public function edit($id)
	{
		$dados["user"]  = $this->users_model->show($id);
		$dados["title"] = "Edit - CodeIgniter";

		$this->load->view('templates/header', $dados);
		$this->load->view('templates/nav-top', $dados);
		$this->load->view('pages/form-users', $dados);
		$this->load->view('templates/footer', $dados);
		$this->load->view('templates/js', $dados);
	}

	public function update($id)
	{
		$this->load->model("users_model");
		$game = $_POST;
		$this->users_model->update($id, $game);
		redirect("dashboard");
	}

	public function admin()
	{
		$dados = array();
		$limit = 3;
		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->users_model->get_total();

		if ($total_records > 0)
		 {
			$dados["users"] = $this->users_model->index_administrador($limit, $start);

			//configuração da paginação
			$config['base_url'] = base_url() . 'users/admin/';
			$config['total_rows'] = $total_records;
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;

			//estilo da paginação
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


		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header', $dados);
			$this->load->view('templates/nav-top', $dados);
			$this->load->view('pages/edit-users', $dados);
			$this->load->view('templates/footer', $dados);
			$this->load->view('templates/js', $dados);
		}else{
			$user = array(
						"name" => $_POST["name"],
						"email" => $_POST["email"],
						"country" => $_POST["country"],						
						"password" => md5($_POST["password"]),
						"nivel" => $_POST["nivel"],
						"ativo" => $_POST["ativo"]
			);
			$this->users_model->update_user($id, $user);
			redirect("users");
		}
	}

		public function text_check ($texto)
		{
			return strip_tags($texto, '<p><a>');
		}

		
	


}
