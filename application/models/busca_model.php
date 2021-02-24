<?php
class Busca_model extends CI_Model
{
	public function buscar_games($busca)
	{
		if (empty($busca)) {
			return array();
		}

		$busca = $this->input->post('busca');
		$this->db->like('name', $busca);
		return $this->db->get("tb_games")->result_array();
	}

	public function buscar_user($busca)
	{
		if (empty($busca)) {
			return array();
		}

		$busca = $this->input->post('busca');
		$this->db->like('name', $busca);
		$this->db->or_like('country', $busca);
		return $this->db->get("tb_users")->result();
	}

	public function buscar_category($busca)
	{
		if (empty($busca)) {
			return array();
		}

		$busca = $this->input->post('busca');
		$this->db->like('category', $busca);
		return $this->db->get("tb_category")->result();
	}

	public function buscar_mygames($busca)
	{
		if (empty($busca)) {
			return array();
		}

		$busca = $this->input->post('busca');
		$id = $_SESSION['logged_user']['id'];
		$this->db->like('name', $busca);
		$this->db->where('user_id', $id);
		return $this->db->get("tb_games")->result_array();
	}
}
