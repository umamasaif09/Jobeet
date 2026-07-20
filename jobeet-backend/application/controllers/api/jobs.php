<?php

defined("BASEPATH") or exit("No direct script access allowed");

class jobs extends MY_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("mdl_job");
    }

    public function index()
    {
        
        $jobs = $this->mdl_job->getJobs();

        header("Content-Type: application/json");
        echo json_encode($jobs, JSON_PRETTY_PRINT);
    }

    public function latest()
    {
        $categories = $this->mdl_job->getLatestJobs(); //category with 10 latest jobs each

        if(!$categories) {
           show_error("Does not Exist", 404);
        }

        header("Content-Type: application/json");
        echo json_encode($categories, JSON_PRETTY_PRINT);
    }

    public function category()
    {
        $categoryId = $this->input->get("category");
        $page = $this->input->get("page");

        $jobs= $this->mdl_job->getJobsByCategory($categoryId, $page);
        
        if(!$jobs) {
            show_error("Does not Exist", 404);
        }

        header("Content-Type: application/json");
        echo json_encode($jobs, JSON_PRETTY_PRINT);
    }

    public function search()
    {
        $keyword= trim($this->input->get("keyword"));

        $jobs = $this->mdl_job->searchJobs($keyword);

        if(!$jobs) {
            show_error("Does not Exist", 404);
        }

        header("Content-Type: application/json");
        echo json_encode($jobs, JSON_PRETTY_PRINT);
    }

    public function detail($jobId)
    {

        $job = $this->mdl_job->getJobById($jobId);

        if(!$job) {
            show_error("Does not Exist", 404);
        }

        header("Content-Type: application/json");
        echo json_encode($job, JSON_PRETTY_PRINT);
    }

    public function create()
    {

        //TODO: logo upload separate Api
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
        }

        $token= bin2hex(random_bytes(16));

        $jobData = [
            "category_id" => $data["category_id"],
            "type" => $data["type"],
            "company" => $data["company"],
            "url" => $data["url"],
            "logo" => $data["logo"],
            "position" => $data["position"],
            "location"=> $data["location"],
            "email" => $data["email"],
            "description" => $data["description"],
            "how_to_apply" => $data["how_to_apply"],
            "is_public" => $data["is_public"],
            "created_at" => date("Y-m-d H:i:s"),
            "is_active" => 1,
            "expires_at" => date("Y-m-d H:i:s", strtotime("+30 days")),
            "token" => $token
        ];

        $jobId= $this->mdl_job->createJob($jobData);

        if(!$jobId) {
            http_response_code(500);
            echo json_encode([
                "message"=> "Unable to create job"
            ]);

            return;
        }

        $job= $this->mdl_job->getJobById($jobId);
        $category= $this->mdl_job->getCategoryById($job["category_id"]);

        http_response_code(201);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Job created successfully",
            "job" => $job,
            "token" => $token
        ]);
    }

    public function update($jobId, $token)
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

        $jobData = [
            "category_id" => $data["category_id"],
            "type" => $data["type"],
            "company" => $data["company"],
            "url" => $data["url"],
            "logo" => $data["logo"],
            "position" => $data["position"],
            "location"=> $data["location"],
            "email" => $data["email"],
            "description" => $data["description"],
            "how_to_apply" => $data["how_to_apply"],
            "is_public" => $data["is_public"],
            "is_active" => 1
        ];

        $job = $this->mdl_job->updatejob($jobData, $jobId, $token);

        if(!$job) {
            http_response_code(500);
            echo json_encode([
                "message"=> "Unable to update job"
            ]);

            return;
        }

        $job = $this->mdl_job->getJobById($jobId);

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Job updated successfully",
            "job" => $job
        ]);
    }

    public function validity($id) 
    {
       
        $daysRemaining= $this->mdl_job->getRemainingDays($id); //job expiry

        if($daysRemaining >=5) {
            show_error("Job validity cannot be extended yet.");
        }

        $job= $this->mdl_job->extendjob($id);

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Validity extended successfully",
            "id" =>$id,
            "job" => $job
        ]);
    }

    public function delete($jobId)
    {
        $this->requireLogin();

        $deleted = $this->mdl_job->deleteJob($jobId);

        if(!$deleted) {
            http_response_code(404);
            echo json_encode([
                "message" => "Category not found"
            ]);
            return; 
        }

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Job deleted successfully",
            "id" =>$jobId
        ]);

    }

    public function count()
    {
        $this->requireLogin();
        
        $count = $this->mdl_job->getJobsCount();

        header("Content-Type: application/json");
        echo json_encode($count, JSON_PRETTY_PRINT);
    }
}