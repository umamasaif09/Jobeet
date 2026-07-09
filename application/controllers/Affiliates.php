<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class affiliates extends CI_Controller 
{

    public function __construct() {
        parent::__construct();

        
        $this->lang->load('affiliates', 'english');
        $this->lang->load('common', 'english');

    }

    public function apply()
    {
    
        $this->load->model("mdl_category");

        //pass categrories to view for user selection
        $data= [
            "title" => "Affiliate Application",
            "categories" => $this->mdl_category->getCategories(),
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
            "affiliate"=>$affiliate
        ];

        $this->load->view("affiliates/success", $viewData);
    }
}