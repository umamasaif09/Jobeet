<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends CI_Controller
{
    public function index() {
        
        $data ["title"] = "Latest Jobs";

        $this->load->model("mdl_job");
        $data["categories"]= $this->mdl_job->getLatestJobs();
        $data["content"] = "jobs/index";
        $data["showPageHeader"] = false;
    
        $this->load->view("templates/public_template", $data);
    }

    public function category($id, $page=1) 
    {
        
        $this->load->model("mdl_job");
        $data["title"] ="Category";
        $data["result"]= $this->mdl_job->getJobsByCategory($id, $page);
        $data["currentPage"]= $page;

        $data["content"] = "jobs/category";
        $data["showPageHeader"] = true;

        $this->load->view("templates/public_template", $data);

    }

    public function search() {
        $keyword= trim($this->input->get("keyword"));

        $data["title"] ="Search";
        $data["keyword"]= $keyword;
        $data["content"] ="jobs/search";
        $data["showPageHeader"]=true;

        $this->load->model("mdl_job");
        $data["jobs"]= $this->mdl_job->searchJobs($keyword);

        $this->load->view("templates/public_template", $data);
    }

    public function job($id) {
        $data["title"] ="Job";
        $this->load->model("mdl_job");
        $data["job"]= $this->mdl_job->getJobById($id);

        $data["content"] = "jobs/job";
        $data["showPageHeader"] = true;
        

        $this->load->view("templates/public_template", $data);
    }

    public function createJob()
    {
        $data["title"] = "Create Job";

        $this->load->model("mdl_job");
        $data["categories"]= $this->mdl_job->getJobCategories();

        $data["content"] = "jobs/createjob";
        $data["showPageHeader"] = true;

        $this->load->view("templates/public_template", $data);
    }

    public function preview()
    {

        if($this->input->method() !== "post") {
            redirect("jobs/createJob");
        } 

        
        $id= $this->input->post("category_id");
        $this->load->model("mdl_job");
        $category= $this->mdl_job->getCategoryById($id);

        //image upload configs - move to configs

        
        $config["upload_path"] = $this->config->item("upload_path");
        $config["allowed_types"] = $this->config->item("allowed_types");
        $config["encrypt_name"]=  $this->config->item("encrypt_name");
        $config["max_size"]= $this->config->item("max_size");

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


        $job = [
            "category_id" => $id,
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


        $data =[
            "title" => "Preview Job",   
            "category" => $category,
            "job" => $job,
            "content" => "jobs/preview",
            "showPageHeader" => true
        ];
        $this->load->view("templates/public_template", $data);
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

        $this->load->model("mdl_job");
        $jobId= $this->mdl_job->createJob($jobData);
        $job= $this->mdl_job->getJobById($jobId);
        $category= $this->mdl_job->getCategoryById($job["category_id"]);


        $viewData = [
            "title"=> "Job Created",
            "jobId" => $jobId,
            "token"=> $token,
            "job" => $job,
            "category" => $category,
            "content" => "jobs/success",
            "showPageHeader" => true
        ];

        $this->load->view("templates/public_template", $viewData);
       
    }

    public function edit($id, $token) 
    {
        $this->load->model("mdl_job");
        $job= $this->mdl_job->getJobForEdit($id, $token);
        $category= $this->mdl_job->getCategoryById($job["category_id"]);

        //get expiry 
        $daysRemaining= $this->mdl_job->getRemainingDays($id, $token);

        if($job == NULL) {
            show_404(); //404 error
        }
        else {
            $data = [
            "title"=> "Edit Form",
            "job"=> $job,
            "category" => $category,
            "categories" => $this->mdl_job->getJobCategories(),
            "daysRemaining" => $daysRemaining,
            "content" => "jobs/editForm",
            "showPageHeader" => true
            ];
            $this->load->view("templates/public_template", $data);
        }
    }

    public function updateJob() 
    {
        $id = $this->input->post("id");
        $token = $this->input->post("token");

        $this->load->config("jobeet");
        $this->load->library("upload");

        $this->upload->initialize([
            "upload_path" =>$this->config->item("upload_path"),
            "allowed_types" => $this->config->item("allowed_types"),
            "encrypt_name" => $this->config->item("encrypt_name"),
            "max_size" => $this->config->item("max_size")
        ]);

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
            "is_active" => 1
            
        ];

        if($this->upload->do_upload("logo")) //if user updates logo
            {
                $uploadData= $this->upload->data();
                $jobData["logo"] = $uploadData["file_name"];
            }
        else 
            { //otherwise save the previous
                $jobData["logo"]= $this->input->post("old_logo");
            }

        $this->load->model("mdl_job");
        $job= $this->mdl_job->updatejob($jobData, $id, $token);

        redirect("jobs/job/".$id);

    }

    public function extendJob($id, $token) {
        $this->load->model("mdl_job");
        $job= $this->mdl_job->getJobForEdit($id, $token);

        if($job == NULL) {
            show_404(); //404 error
        }
        

        $daysRemaining= $this->mdl_job->getRemainingDays($id); //job expiry

        if($daysRemaining >=5) {
            show_error("Job validity cannot be extended yet.");
        }

        $job= $this->mdl_job->extendjob($id);

        redirect("jobs/job/".$id);
        

    }

    
}