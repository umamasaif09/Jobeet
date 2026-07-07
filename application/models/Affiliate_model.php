<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliate_model extends CI_Model 
{
    public function createAffiliate($data) 
    {
        $this->db->insert("affiliates", $data);
        return $this->db->insert_id();
    }

    // public function getCategories() 
    // {
    //     $query= $this->db->get("categories");
    //     return $query->result_array();
    // }

    public function getAffiliateById($id) 
    {
        $this->db->where("id", $id);
        $query= $this->db->get("affiliates");
        return $query->row_array();
    }

    public function saveCategories($affiliateId, $categories) 
    {
        //save all categories selected by user with respective affiliate id
        foreach($categories as $categoryId) {

            $data = [
                "affiliate_id" => $affiliateId,
                "category_id" => $categoryId
            ];

            $this->db->insert("affiliate_categories", $data);
        }
    }

    public function getAffiliates()
    {
         $query = $this->db->get("affiliates");
        return $query->result_array();
    }

    public function editAffiliate($data) {
        $this->db->where("id", $data["id"]);
        //update only the non default fields
        return $this->db->update("affiliates", [
            "name" => $data["name"],
            "email" => $data["email"],
            "site_url" => $data["url"]
            ]);
    }

    public function activate($id, $token) 
    {
        $this->db->where("id",$id);
        return $this->db->update("affiliates", ["is_active" => 1, 
            "token" => $token]);
    }

    public function disable($id) 
    {
        $this->db->where("id",$id);
        return $this->db->update("affiliates", ["is_active" => 0]);
    }

    public function delete($id) {
        $this->db->where("id", $id);
        return $this->db->delete("affiliates");
    }

    public function getAffiliateByToken($token) 
    {
        $this->db->where("token", $token);
        //also check if affiliate is active
        $this->db->where("is_active", 1);
        $query = $this->db->get("affiliates");
        return $query->row_array();
    }

    public function getAffiliatesCount() {
        return $this->db->count_all_results("affiliates");
    }
}