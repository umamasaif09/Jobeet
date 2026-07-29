<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_affiliate extends CI_Model 
{
    public function createAffiliate($data) 
    {
        $this->db->insert("affiliates", $data);
        return $this->db->insert_id();
    }


    public function getAffiliateById($id) 
    {
        $this->db->where("id", $id);
        $query= $this->db->get("affiliates");
        return $query->row_array();
    }

    public function saveCategories($affiliateId, $categories) 
    {
        // to avoid duplicates
        $this->db->where("affiliate_id", $affiliateId);
        $this->db->delete("affiliate_categories");
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

    public function editAffiliate($id ,$data) {
        $this->db->where("id", $id);
        //update only the non default fields
        return $this->db->update("affiliates", [
            "name" => $data["name"],
            "email" => $data["email"],
            "site_url" => $data["site_url"]
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
        return $this->db->update("affiliates", ["is_active" => 0, "token" => NULL]);
    }

    public function deleteAffiliate($id) {
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

    public function getAffiliateCategoryIds($affiliateId)
    {
        $this->db->select("category_id");
        $this->db->from("affiliate_categories");
        $this->db->where("affiliate_id", $affiliateId);
        $query= $this->db->get()->result_array();

       
        return array_column($query, "category_id");
    }
}