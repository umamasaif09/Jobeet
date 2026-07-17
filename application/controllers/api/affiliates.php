<?php

defined("BASEPATH") or exit("No direct script access allowed");

class affiliates extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("mdl_affiliate");
    }

    public function index()
    {
        $affiliates = $this->mdl_affiliate->getAffiliates();

        header("Content-Type: application/json");
        echo json_encode($affiliates, JSON_PRETTY_PRINT);
    }

    public function apply()
    {
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
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
            http_response_code(500);
            echo json_encode([
                "message"=> "Unable to submit application"
            ]);

            return;
        }

        //get selected categories
        $categories = $data["categories"];

        if(empty($categories)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
        }

        //save selected categories
        $this->mdl_affiliate->saveCategories($affiliateId, $categories);

        //fetch the respective affiliate
        $affiliate= $this->mdl_affiliate->getAffiliateById($affiliateId);

        http_response_code(201);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Application submitted successfully",
            "id" =>$affiliateId,
            "affiliate" =>$affiliate
        ]);
    }

    public function create()
    {
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
        }

        $affiliateData = [
            "name" => $data["affiliate_name"],
            "email" => $data["affiliate_email"],
            "site_url" => $data["affiliate_url"],
            "created_at" => date("Y-m-d H:i:s")
        ];

        $affiliateId = $this->mdl_affiliate->createAffiliate($affiliateData);

        if(!$affiliateId) {
            http_response_code(500);
            echo json_encode([
                "message"=> "Unable to create affiliate"
            ]);

            return;
        }

        //get selected categories
        $categories = $data["categories"];

        if(empty($categories)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
        }

        //save selected categories
        $this->mdl_affiliate->saveCategories($affiliateId, $categories);

        $affiliate = $this->mdl_affiliate->getAffiliateById($affiliateId);

        http_response_code(201);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Affiliate created successfully",
            "id" =>$affiliateId,
            "affiliate" => $affiliate
        ]);
    }

    public function update($affiliateId)
    {
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
        }

        $affiliateData = [
            "name" => $data["affiliate_name"],
            "email" => $data["affiliate_email"],
            "site_url" => $data["affiliate_url"]
        ];

        $affiliate = $this->mdl_affiliate->editAffiliate($affiliateData);

        if(!$affiliate) {
            http_response_code(500);
            echo json_encode([
                "message"=> "Unable to update affiliate"
            ]);

            return;
        }

        $affiliate = $this->mdl_affiliate->getAffiliateById($affiliateId);

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Affiliate updated successfully",
            "id" =>$affiliateId,
            "affiliate" => $affiliate
        ]);

    }

    public function disable($affiliateId)
    {
        $disabled = $this->mdl_affiliate->disable($affiliateId);

        if(!$disabled) {
            http_response_code(404);
            echo json_encode([
                "message" => "Affiliate not found"
            ]);
            return; 
        }

        $affiliate = $this->mdl_affiliate->getAffiliateById($affiliateId);

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
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
        $token = bin2hex(random_bytes(16));

        $activated = $this->mdl_affiliate->activate($affiliateId, $token);
        if(!$activated) {
            http_response_code(404);
            echo json_encode([
                "message" => "Affiliate not found"
            ]);
            return; 
        }

        $affiliate = $this->mdl_affiliate->getAffiliateById($affiliateId);

        $emailSent = $this->sendActivationEmail($affiliate, $token);

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Affiliate activated successfully",
            "id" =>$affiliateId,
            "affiliate" => $affiliate,
            "token" => $token,
            "emailSent" => $emailSent
        ]);

    }

    public function delete($affiliateId)
    {
        $deleted = $this->mdl_affiliate->deleteAffiliate($affiliateId);

        if(!$deleted) {
            http_response_code(404);
            echo json_encode([
                "message" => "Affiliate not found"
            ]);
            return; 
        }

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "affiliate deleted successfully",
            "id" =>$affiliateId
        ]);

    }

    public function count()
    {
        $count = $this->mdl_affiliate->getAffiliatesCount();

        header("Content-Type: application/json");
        echo json_encode($count, JSON_PRETTY_PRINT);
    }
}