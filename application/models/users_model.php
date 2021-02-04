<?php

	class Users_model extends CI_model
	{
		public function index()
		{
			if($_SESSION['logged_user']['nivel'] == 2)
			{	
				$this->index_administrador();
			}else{
				$this->index_usuarios();
			}	
		}

		public function index_administrador($limit, $start)
		{
			$this->db->order_by("name", "ASC");
			$this->db->limit($limit, $start);
			
			$query = $this->db->get("tb_users");

					if($query ->num_rows() > 0 )
					{
							foreach($query->result() as $row)
							{
								$data[] = $row;
							}
							return $data;
					}
					return false;

		}

		public function index_usuarios()
		{
			$this->db->where('id', $_SESSION['logged_user']['id']);
			return $this->db->get('tb_users')->result_array();
		}

		public function dashboard_index()
		{
			$this->db->order_by("id", "DESC");
			$this->db->limit(5);
			return $this->db->get("tb_users")->result_array();
		}

		public function store($user)
		{
			$this->db->insert("tb_users", $user);
		}

		public function show($id)
		{
			return $this->db->get_where("tb_users", array(
				"id" => $id
			))->row_array();
		}

		public function update($id, $game)
		{
			$this->db->where("id", $id);
			return $this->db->update("tb_users", $game);
		}
		public function get_total()
		{
			return $this->db->count_all('tb_users');
		}

		public function update_users($id, $user)
		{
			$this->db->where("id", $id);
			return $this->db->update("tb_users", $user);
		}
	
		

		public function update_user($id, $user)
		{
			$this->db->where("id", $id);
			return $this->db->update("tb_users", $user);
		}

		
	}
