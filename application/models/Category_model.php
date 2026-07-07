<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model 
{
    public function getCategories()
    {
        $query = $this->db->get("categories");
        return $query->result_array();
    }

    public function createCategory($data) {
        return $this->db->insert("categories",$data);

    }

    public function getCategoryById($id)
    {
        $this->db->where("id", $id);
        $categoryQuery= $this->db->get("categories");
        return $categoryQuery->row_array();
    }

    public function editCategory($data) {
        $this->db->where("id", $data["id"]);
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