<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends CI_Controller
{
    public function index() {
        
        $data ["title"] = "Latest Jobs";

        $this->load->model("Job_model");
        $data["categories"]= $this->Job_model->getLatestJobs();
    
        $this->load->view("jobs/index", $data);
    }

    public function category($id, $page=1) 
    {
        $offset= ($page-1)*20;
        $this->load->model("Job_model");
        $data["result"]= $this->Job_model->getJobsByCategory($id, $offset);
        $data["currentPage"]= $page;
        $this->load->view("jobs/category", $data);

    }

    public function search() {
        $keyword= trim($this->input->get("keyword"));

        $data["title"] ="Search";
        $data["keyword"]= $keyword;

        $this->load->model("Job_model");
        $data["jobs"]= $this->Job_model->searchJobs($keyword);

        $this->load->view("jobs/search", $data);
    }

    public function job($id) {
        $data["title"] ="Job";
        $this->load->model("Job_model");
        $data["job"]= $this->Job_model->getJobById($id);

        $this->load->view("jobs/job", $data);
    }

    public function createJob()
    {
        $data["title"] = "Create Job";
        $this->load->model("Job_model");
        $data["categories"]= $this->Job_model->getJobCategories();
        $this->load->view("jobs/createJob.php", $data);
    }

    public function preview()
    {
        $id= $this->input->post("category_id");
        $this->load->model("Job_model");
        $category= $this->Job_model->getCategoryById($id);

        //image upload configs
        $config["upload_path"] = "./uploads/";
        $config["allowed_types"] = "jpg|jpeg|png|gif";
        $config["encrypt_name"]=  TRUE;
        $config["max_size"]= 2048;

        //location to save images
        $this->load->library("upload", $config);

        //if logo is added then save file name
        if($this->upload->do_upload("logo"))
            {
                $uploadData= $this->upload->data();
                $logo = $uploadData["file_name"];
            }
            else 
                {   //else keep empty
                    $logo="";
                }


        $data =[
            "title" => "Preview Job",
            "category_id" => $id,
            "category" => $category["name"],
            "type" => $this->input->post("type"),
            "company" => $this->input->post("company"),
            "logo" => $logo,
            "url" => $this->input->post("url"),
            "position" => $this->input->post("position"),
            "location" => $this->input->post("location"),
            "email" => $this->input->post("email"),
            "description" => $this->input->post("description"),
            "how_to_apply" => $this->input->post("how_to_apply"),
            "is_public" => $this->input->post("is_public")
        ];
        $this->load->view("jobs/preview", $data);
    }

    public function postJob() {
       
        $token= bin2hex(random_bytes(16)); //unique token for edit
        $jobData =[
            
            "category_id" => $this->input->post("category_id"),
            "type" => $this->input->post("type"),
            "company" => $this->input->post("company"),
            "logo" => $this->input->post("logo"),
            "url" => $this->input->post("url"),
            "position" => $this->input->post("position"),
            "location" => $this->input->post("location"),
            "email" => $this->input->post("email"),
            "description" => $this->input->post("description"),
            "how_to_apply" => $this->input->post("how_to_apply"),
            "is_public" => $this->input->post("is_public"),
            "created_at" => date("Y-m-d H:i:s"),
            "is_active" => 1,
            "expires_at" => date("Y-m-d H:i:s", strtotime("+30 days")),
            "token" => $token
        ];

        $this->load->model("Job_model");
        $jobId= $this->Job_model->createJob($jobData);
        $job= $this->Job_model->getJobById($jobId);
        $category= $this->Job_model->getCategoryById($job["category_id"]);

        $viewData = [
            "title"=> "Job Created",
            "jobId" => $jobId,
            "token"=> $token,
            "job" => $job,
            "category" => $category
        ];

        $this->load->view("jobs/success", $viewData);
       
    }

    public function edit($id, $token) 
    {
        $this->load->model("Job_model");
        $job= $this->Job_model->getJobForEdit($id, $token);

        //get expiry 
        $expires= strtotime($job["expires_at"]);
        $today= time();

        $daysRemaining= ceil(($expires - $today)/(60*60*24));

        if($job == NULL) {
            show_404(); //404 error
        }
        else {
            $data = [
            "title"=> "Edit Form",
            "job"=> $job,
            "categories" => $this->Job_model->getJobCategories(),
            "daysRemaining" => $daysRemaining
            ];
            $this->load->view("jobs/editForm", $data);
        }
    }

    public function updateJob() 
    {
        $id = $this->input->post("id");
        $token = $this->input->post("token");

        if($this->upload->do_upload("logo")) //if user updates logo
            {
                $uploadData= $this->upload->data();
                $jobData["logo"] = $uploadData["file_name"];
            }
        else 
            { //otherwise save the previous
                $jobData["logo"]= $this->input->post("old_logo");
            }

        $jobData =[
            
            "category_id" => $this->input->post("category_id"),
            "type" => $this->input->post("type"),
            "company" => $this->input->post("company"),
            "url" => $this->input->post("url"),
            "position" => $this->input->post("position"),
            "location" => $this->input->post("location"),
            "email" => $this->input->post("email"),
            "description" => $this->input->post("description"),
            "how_to_apply" => $this->input->post("how_to_apply"),
            "is_public" => $this->input->post("is_public"),
            //"created_at" => date("Y-m-d H:i:s"),
            "is_active" => 1,
            //"expires_at" => date("Y-m-d H:i:s", strtotime("+30 days")),
            
        ];

        $this->load->model("Job_model");
        $job= $this->Job_model->updatejob($jobData, $id, $token);

        redirect("jobs/job/".$id);

    }

    public function extendJob($id, $token) {
        $this->load->model("Job_model");
        $job= $this->Job_model->getJobForEdit($id, $token);

        if($job == NULL) {
            show_404(); //404 error
        }
        
        $expires= strtotime($job["expires_at"]);
        $today= time();

        $daysRemaining= ceil(($expires - $today)/(60*60*24));

        if($daysRemaining <=5) {
            show_error("Job validity cannot be extended yet.");
        }

        $job= $this->Job_model->extendjob($id);

        redirect("jobs/job/".$id);
        

    }

    
}