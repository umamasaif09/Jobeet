<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller 
{
    public function jobs()
    {
        $token = $this->input->get("token");
        $limit = $this->input->get("limit");
        $category= $this->input->get("category");
        $format= $this->input->get("format");

        $this->load->model("mdl_affiliate");
        $affiliate = $this->mdl_affiliate->getAffiliateByToken($token);

        if(!$affiliate) {
            show_error("Unauthorized", 401);
        }

        $this->load->model("mdl_job");
        $jobs= $this->mdl_job->getActiveJobs($limit, $category);

        if($format =="" || $format == "json"){
            header("Content-Type: application/json");
            echo json_encode($jobs, JSON_PRETTY_PRINT);
        } else {
            show_error("Unsuported Format", 400);
        }

        


    }
}