<?php

defined("BASEPATH") or exit("No direct script access allowed");

class affiliates extends CI_Controller
{
    public function apply()
    {
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            show_404();
        }

        $affiliateData= [
            "name"=> $data["name"],
            "email" => $data["email"],
            "site_url" => $data["url"],
            "is_active" => 0,
            "created_at" => date("Y-m-d H:i:s")
        ];

        $this->load->model("mdl_affiliate");
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
            show_404();
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
}