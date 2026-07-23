<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_category extends CI_Model 
{
    public function getCategories()
    {
        $query = $this->db->get("categories");
        return $query->result_array();
    }

    public function createCategory($data) {
        $this->db->insert("categories",$data);
        return $this->db->insert_id();

    }

    public function getCategoryById($id)
    {
        $this->db->where("id", $id);
        $categoryQuery= $this->db->get("categories");
        return $categoryQuery->row_array();
    }

    public function editCategory($id, $data) {
        $this->db->where("id", $id);
        //only update name, id remains same
        return $this->db->update("categories", [
            "name" => $data["name"]
            ]);
    }

    public function deleteCategory($id) {
        $this->db->where("id", $id);
        return $this->db->delete("categories");
    }

    public function getCategoriesCount() {
        return $this->db->count_all_results("categories");
    }
}