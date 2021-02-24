<?php

class Category_model extends CI_model
{
    public function index($limit, $start)
    {
        $this->db->limit($limit, $start);

        $query = $this->db->get("tb_category");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function store($category)
    {

        $this->db->insert("tb_category", $category);
    }
    public function show($id_category)
    {
        return $this->db->get_where("tb_category", array(
            "id_category" => $id_category
        ))->row_array();
    }
    public function update($id_category, $category)
    {
        $this->db->where("id_category", $id_category);
        $this->db->update("tb_category", $category);
    }

    // deletar a categoria selecionada
    public function delete($id)
    {
        $del = $this->db->where("id_category", $id)
            ->delete("tb_category");
    }

    //inserir categoria no jogo que esta sendo editado ou criado
    public function insert_category()
    {
        $query = $this->db->select('id_category')
            ->select('category')
            ->get('tb_category')
            ->result();
        $list = array();
        foreach ($query as $result) {
            $list[$result->id_category] = $result->category;
        }
        return $list;
    }

    //mostar visualmente ao usuario o nome da categoria
    public function get_category($id)
    {
        $query =  $this->db->query('SELECT category
                          FROM tb_category 
                          INNER JOIN tb_games 
                          ON id_category = ' . $id)->result();
        $category = NULL;
        foreach ($query as $category) {
            return $category->category;
        }
    }

    public function get_total()
    {

        return $this->db->count_all("tb_category");
    }

    public function check_category($id)
    {
        return $this->db->query("SELECT t1.id_category 
                                 FROM `Tb_category`t1 
                                 INNER JOIN `tb_games`t2 ON t1.id_category = t2.category_id
                                 WHERE t1.id_category = " . $id)->num_rows();
    }
}
