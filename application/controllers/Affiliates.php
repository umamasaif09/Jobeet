<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class affiliates extends CI_Controller 
{

    public function apply()
    {
        $this->lang->load('affiliates', 'english');
        $this->lang->load('common', 'english');
        $this->load->model("mdl_category");

        //pass categrories to view for user selection
        $data= [
            "title" => "Affiliate Application",
            "categories" => $this->mdl_category->getCategories(),
            "content" => "affiliates/apply",
            "showPageHeader" => true
        ];

        $this->load->view("templates/public_template", $data);
    }

    public function submitApplication () 
    {
        $this->lang->load('affiliates', 'english');
        $this->lang->load('common', 'english');

        $affiliateData= [
            "name"=> $this->input->post("name"),
            "email" => $this->input->post("email"),
            "site_url" => $this->input->post("url"),
            "is_active" => 0,
            "created_at" => date("Y-m-d H:i:s")
        ];

        $this->load->model("mdl_affiliate");
        $affiliateId= $this->mdl_affiliate->createAffiliate($affiliateData);

        //get selected categories
        $categories = $this->input->post("categories");

        //save selected categories
        $this->mdl_affiliate->saveCategories($affiliateId, $categories);

        //fetch the respective affiliate
        $affiliate= $this->mdl_affiliate->getAffiliateById($affiliateId);

        //pass required data to view
        $viewData = [
            "title" => "Affiliation Request Submitted",
            "affiliate"=>$affiliate,
            "content" => "affiliates/success",
            "showPageHeader" => true //back button
        ];

        $this->load->view("templates/public_template", $viewData);
    }
}