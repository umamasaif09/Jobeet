<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class affiliates extends CI_Controller 
{
    public function apply()
    {
        $this->load->model("Category_model");

        //pass categrories to view for user selection
        $data= [
            "title" => "Affiliate Application",
            "categories" => $this->Category_model->getCategories(),
            "backUrl" => site_url("jobs/index")
        ];

        $this->load->view("affiliates/apply", $data);
    }

    public function submitApplication () 
    {
        $token= bin2hex(random_bytes(16));

        $affiliateData= [
            "name"=> $this->input->post("name"),
            "email" => $this->input->post("email"),
            "site_url" => $this->input->post("url"),
            "token" => $token,
            "is_active" => 0,
            "created_at" => date("Y-m-d H:i:s")
        ];

        $this->load->model("Affiliate_model");
        $affiliateId= $this->Affiliate_model->createAffiliate($affiliateData);

        //get selected categories
        $categories = $this->input->post("categories");

        //save selected categories
        $this->Affiliate_model->saveCategories($affiliateId, $categories);

        //fetch the respective affiliate
        $affiliate= $this->Affiliate_model->getAffiliateById($affiliateId);

        //pass required data to view
        $viewData = [
            "title" => "Affiliation Request Submitted",
            "backUrl" => site_url("affiliates/apply"),
            "affiliate"=>$affiliate
        ];

        $this->load->view("affiliates/success", $viewData);
    }
}