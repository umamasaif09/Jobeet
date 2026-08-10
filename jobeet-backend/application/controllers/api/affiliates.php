<?php

defined("BASEPATH") or exit("No direct script access allowed");

class affiliates extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("mdl_affiliate");
    }

    public function index()
    {
        $this->requireLogin(); 
        
        $affiliates = $this->mdl_affiliate->getAffiliates();

        $this->response($affiliates);
    }

    public function detail($id) {
      $this->requireLogin();

      $affiliate = $this->mdl_affiliate->getAffiliateById($id);
      $categories = $this->mdl_affiliate->getAffiliateCategoryIds($id);

      $affiliate["categories"] = $categories;

      $this->response($affiliate);
    }

    public function apply()
    {
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            return $this->response([
              "message" => "Invalid request"
            ], 400);
        }

        $affiliateData= [
            "name"=> $data["affiliate_name"],
            "email" => $data["affiliate_email"],
            "site_url" => $data["affiliate_url"],
            "is_active" => 0,
            "created_at" => date("Y-m-d H:i:s")
        ];

        $affiliateId= $this->mdl_affiliate->createAffiliate($affiliateData);

        if(!$affiliateId) {

            return $this->response([
              "message"=> "Unable to submit application"
            ],500);
        }

        //get selected categories
        $categories = $data["categories"];

        if(!empty($categories)){
           //save selected categories
            $this->mdl_affiliate->saveCategories($affiliateId, $categories);
        }

        

        //fetch the respective affiliate
        $affiliate= $this->mdl_affiliate->getAffiliateById($affiliateId);

        $this->response([
          "message" => "Application submitted successfully",
          "id" =>$affiliateId,
          "affiliate" =>$affiliate
        ], 201);
    }

    public function create()
    {
        $this->requireLogin(); 
        
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            return $this->resposne([
              "message" => "Invalid request"
            ], 400);
        }

        $affiliateData = [
            "name" => $data["affiliate_name"],
            "email" => $data["affiliate_email"],
            "site_url" => $data["affiliate_url"],
            "created_at" => date("Y-m-d H:i:s")
        ];

        $affiliateId = $this->mdl_affiliate->createAffiliate($affiliateData);

        if(!$affiliateId) {
            return $this->response([
              "message"=> "Unable to create affiliate"
            ], 500);
        }

        //get selected categories
        $categories = $data["categories"];

        if(empty($categories)){
            return $this->response([
              "message" => "Invalid request"
            ], 400);
        }

        //save selected categories
        $this->mdl_affiliate->saveCategories($affiliateId, $categories);

        $affiliate = $this->mdl_affiliate->getAffiliateById($affiliateId);

        $this->response([
          "message" => "Affiliate created successfully",
          "id" =>$affiliateId,
          "affiliate" => $affiliate
        ], 201);
    }

    public function update($affiliateId)
    {
        $this->requireLogin(); 
        
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            return $this->response([
              "message" => "Invalid request"
            ], 400);
        }

        $affiliateData = [
            "name" => $data["affiliate_name"],
            "email" => $data["affiliate_email"],
            "site_url" => $data["affiliate_url"],
            
        ];

        $categories = $data["categories"];
        $this->mdl_affiliate->saveCategories($affiliateId, $categories);

        $affiliate = $this->mdl_affiliate->editAffiliate($affiliateId ,$affiliateData);

        if(!$affiliate) {
            return $this->response([
              "message"=> "Unable to update affiliate"
            ], 500);
        }

        $affiliate = $this->mdl_affiliate->getAffiliateById($affiliateId);

        $this->response([
          "message" => "Affiliate updated successfully",
          "id" =>$affiliateId,
          "affiliate" => $affiliate
        ]);

    }

    public function disable($affiliateId)
    {
        $this->requireLogin(); 
        
        $disabled = $this->mdl_affiliate->disable($affiliateId);

        if(!$disabled) {
            return $this->response([
              "message" => "Affiliate not found"
            ],404); 
        }

        $affiliate = $this->mdl_affiliate->getAffiliateById($affiliateId);

        $this->response([
          "message" => "Affiliate disabled successfully",
          "id" =>$affiliateId,
          "affiliate" => $affiliate
        ]);
    }

    private function sendActivationEmail($affiliate, $token)
    {
        $this->load->library("email");

        $this->email->from("alaina83@ethereal.email", "Jobeet"); 
        $this->email->to($affiliate["email"]);
        $this->email->subject("Affiliate Account Activated");

        $this->email->message(
            "Hello ".$affiliate["name"]."\n\n". 
            "Your affiliate account has been activated. \n\n". 
            "Your API token is: ".$token."\n\n". 
            "You can use this token to access the Jobeet API via this link: \n". 
            "http://jobeet.test/index.php/job_api/jobs?token=".$token."&limit=&category="
        );

        return $this->email->send();
    }

    public function activate($affiliateId)
    {
        $this->requireLogin(); 
        
        $token = bin2hex(random_bytes(16));

        $activated = $this->mdl_affiliate->activate($affiliateId, $token);
        if(!$activated) {
            return $this->response([
              "message" => "Affiliate not found"
            ],404); 
        }

        $affiliate = $this->mdl_affiliate->getAffiliateById($affiliateId);

        $emailSent = $this->sendActivationEmail($affiliate, $token);

        $this->response([
          "message" => "Affiliate activated successfully",
          "id" =>$affiliateId,
          "affiliate" => $affiliate,
          "token" => $token,
          "emailSent" => $emailSent
        ]);
    }

    public function delete($affiliateId)
    {
        $this->requireLogin(); 
        
        $deleted = $this->mdl_affiliate->deleteAffiliate($affiliateId);

        if(!$deleted) {
            return $this->response([
              "message" => "Affiliate not found"
            ],404); 
        }

        $this->response([
          "message" => "affiliate deleted successfully",
          "id" =>$affiliateId
        ]);

    }

    public function count()
    {
        $this->requireLogin();
        
        $count = $this->mdl_affiliate->getAffiliatesCount();

        $this->response($count);
    }
}