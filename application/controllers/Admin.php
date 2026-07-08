<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    public function dashboard()
    {
        $data["title"] = "Admin Dashboard";
        $data["active"] = "dashboard";

        $this->load->model("Category_model");
        $data ["totalCategories"] = $this->Category_model->getCategoriesCount();

        $this->load->model("Job_model");
        $data ["totalJobs"] = $this->Job_model->getJobsCount();

        $this->load->model("Affiliate_model");
        $data["totalAffiliates"] = $this->Affiliate_model->getAffiliatesCount();

        $this->load->view("admin/dashboard", $data);
    }

    public function categories()
    {
        $this->load->model("Category_model");
        
        $data["categories"] = $this->Category_model->getCategories();
        $data["title"] = "Manage Categories";
        $data["active"] ="categories";

        $this->load->view("admin/categories", $data);
    }

    public function createCategory() 
    {
        $data["name"] = $this->input->post("category_name");
        $this->load->model("Category_model");
        $this->Category_model->createCategory($data);

        redirect("admin/categories");
    }

    public function editCategory($id)
    {
        $this->load->model("Category_model");
        $data["category"]= $this->Category_model->getCategoryById($id);
        $data["title"]="Edit category";
        $this->load->view("admin/editCategory", $data);
    }

    public function updateCategory() 
    {
        $category["id"]=$this->input->post("id");
        $category["name"]=$this->input->post("category_name");

        $this->load->model("Category_model");
        $this->Category_model->editCategory($category);

        redirect("admin/categories");
        
    }

    public function deleteCategory($id)
    {
        $this->load->model("Category_model");
        $this->Category_model->deleteCategory($id);

        redirect("admin/categories");

    }

    public function jobs()
    {
        $this->load->model("Job_model");
        
        $data["jobs"] = $this->Job_model->getJobs();
        $data["title"] = "Manage Jobs";
        $data["active"] ="jobs";
        
        $this->load->model("Category_model");
        $data["categories"]= $this->Category_model->getCategories();

        //list jobs with category names

        $this->load->view("admin/jobs", $data);
    }

    public function editJob($id)
    {
        $this->load->model("Job_model");
        $job= $this->Job_model->getJobById($id);

        $category= $this->Job_model->getCategoryById($job["category_id"]);
        $daysRemaining = $this->Job_model->getRemainingDays($id);
        
       
        if($job == NULL) {
            show_404();
        }
        else {
            $data = [
            "title"=> "Edit Form",
            "job"=> $job,
            "category" => $category,
            "daysRemaining" =>$daysRemaining
            ];
            $this->load->view("jobs/editForm", $data);
        }
    }
    
    public function viewJob($id) 
    {
        $data["title"] ="Job";
        $this->load->model("Job_model");
        $data["job"]= $this->Job_model->getJobById($id);

        $this->load->view("jobs/job", $data);
    }

    public function deleteJob($id) 
    {
        $this->load->model("Job_model");
        $this->Job_model->deleteJob($id);

        redirect("admin/jobs");
    }

    public function affiliates()
    {
        $this->load->model("Affiliate_model");
        $this->load->model("Category_model");

        //get all affiliates
        $data["affiliates"] = $this->Affiliate_model->getAffiliates();
        $data["title"] = "Manage Affiliates";
        $data["active"] ="affiliates";
        //to display in view
        $data["categories"] = $this->Category_model->getCategories();

        $this->load->view("admin/affiliates", $data);
    }

    public function createAffiliate() 
    {
        

        $affiliate = [
            "name" => $this->input->post("name"),
            "email" => $this->input->post("email"),
            "site_url" =>$this->input->post("url")
        ];

        $categories= $this->input->post("categories");

        $this->load->model("Affiliate_model");
        $affiliateID = $this->Affiliate_model->createAffiliate($affiliate);

        //save selected categories
        if(!empty($categories)) {
            $this->Affiliate_model->saveCategories($affiliateID, $categories);
        }
        

        redirect("admin/affiliates");
    }

    public function editAffiliate($id)
    {
       $this->load->model("Affiliate_model");
       $this->load->model("Category_model");

       $data["categories"] = $this->Category_model->getCategories();
       //get affiliate that is needed to be edited
        $data["affiliate"]= $this->Affiliate_model->getAffiliateById($id);
        $data["title"]="Edit Affiliate";
        $categories= $this->input->post("categories");
        //save selected categories
        if(!empty($categories)) {
            $this->Affiliate_model->saveCategories($id, $categories);
        }
        $this->load->view("admin/editAffiliate", $data);
    }

    public function updateAffiliate() 
    {

        $affiliate["id"]=$this->input->post("id");
        $affiliate["name"]=$this->input->post("name");
        $affiliate["email"]=$this->input->post("email");
        $affiliate["url"]=$this->input->post("url");

        $this->load->model("Affiliate_model");
        //save the edit
        $this->Affiliate_model->editAffiliate($affiliate);

        redirect("admin/affiliates");
        
    }

    public function disableAffiliate($id) {
        $this->load->model("Affiliate_model");
        $this->Affiliate_model->disable($id);

        redirect("admin/affiliates");
    }

    public function activateAffiliate($id) {
        $token = bin2hex(random_bytes(16));

        $this->load->model("Affiliate_model");
        $this->Affiliate_model->activate($id, $token);

        $affiliate = $this->Affiliate_model->getAffiliateById($id);
        
        $this->load->library("email");

        $this->email->from("jobeetgmail@gmail.com", "Jobeet");
        $this->email->to($affiliate["email"]);
        $this->email->subject("Affiliate Account Activated");

        $this->email->message(
            "Hello ".$affiliate["name"]."\n\n". 
            "Your affiliate account has been activated. \n\n". 
            "Your API token is: ".$token."\n\n". 
            "You can use this token to access the Jobeet API via this link: \n". 
            "http://jobeet.test/index.php/api/jobs?token=".$token."&limit=&category="
        );

        if ($this->email->send()) {
            echo "Email sent successfully.";
        } else {
            echo $this->email->print_debugger();
        }

        redirect("admin/affiliates");
    }

    public function deleteAffiliate($id) 
    {
        $this->load->model("Affiliate_model");
        $this->Affiliate_model->delete($id);

        redirect("admin/affiliates");
    }
}