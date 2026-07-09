<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    public function __construct() {
        parent::__construct();

        $this->lang->load('admin', 'english');
        $this->lang->load('categories', 'english');
        $this->lang->load('affiliates', 'english');
        $this->lang->load('jobs', 'english');
        $this->lang->load('common', 'english');

    }

    public function dashboard()
    {
        $data["title"] = "Admin Dashboard";
        $data["active"] = "dashboard";

        $this->load->model("mdl_category");
        $data ["totalCategories"] = $this->mdl_category->getCategoriesCount();

        $this->load->model("mdl_job");
        $data ["totalJobs"] = $this->mdl_job->getJobsCount();

        $this->load->model("mdl_affiliate");
        $data["totalAffiliates"] = $this->mdl_affiliate->getAffiliatesCount();

        $this->load->view("admin/dashboard", $data);
    }

    public function categories()
    {
        $this->load->model("mdl_category");
        
        $data["categories"] = $this->mdl_category->getCategories();
        $data["title"] = "Manage Categories";
        $data["active"] ="categories";
        $data["backUrl"] = site_url("admin/dashboard");

        $this->load->view("admin/categories", $data);
    }

    public function createCategory() 
    {
        $data["name"] = $this->input->post("category_name");
        $this->load->model("mdl_category");
        $this->mdl_category->createCategory($data);
        

        redirect("admin/categories");
    }

    public function editCategory($id)
    {
        $this->load->model("mdl_category");
        $data["category"]= $this->mdl_category->getCategoryById($id);
        $data["title"]="Edit category";
        $data["backUrl"] = site_url("admin/categories");
        
        $this->load->view("admin/editCategory", $data);
    }

    public function updateCategory() 
    {
        $category["id"]=$this->input->post("id");
        $category["name"]=$this->input->post("category_name");

        $this->load->model("mdl_category");
        $this->mdl_category->editCategory($category);

        redirect("admin/categories");
        
    }

    public function deleteCategory($id)
    {
        $this->load->model("mdl_category");
        $this->mdl_category->deleteCategory($id);

        redirect("admin/categories");

    }

    public function jobs()
    {
        $this->load->model("mdl_job");
        
        $data["jobs"] = $this->mdl_job->getJobs();
        $data["title"] = "Manage Jobs";
        $data["active"] ="jobs";
        $data["backUrl"] = site_url("admin/dashboard");
        
        $this->load->model("mdl_category");
        $data["categories"]= $this->mdl_category->getCategories();

        //list jobs with category names

        $this->load->view("admin/jobs", $data);
    }

    public function createJob() {
        $this->load->model("mdl_job");

        $data= [
            "title" => "Create Job",
            "backUrl" => site_url("admin/jobs"),
            "categories" => $this->mdl_job->getJobCategories(),
            "is_admin" => true
        ];

        $this->load->view("jobs/createJob", $data);
    }

    public function editJob($id)
    {
        $this->load->model("mdl_job");
        $job= $this->mdl_job->getJobById($id);

        $category= $this->mdl_job->getCategoryById($job["category_id"]);
        $daysRemaining = $this->mdl_job->getRemainingDays($id);
        
        $this->load->model("mdl_category");

       
        if($job == NULL) {
            show_404();
        }
        else {
            $data = [
            "title"=> "Edit Form",
            "job"=> $job,
            "category" => $category,
            "daysRemaining" =>$daysRemaining,
            "backUrl" => site_url("admin/jobs"),
            "categories" => $this->mdl_category->getCategories()
            ];
            $this->load->view("jobs/editForm", $data);
        }
    }
    
    public function viewJob($id) 
    {
        $data["title"] ="Job";
        $this->load->model("mdl_job");
        $data["job"]= $this->mdl_job->getJobById($id);
        $data["backUrl"] = site_url("admin/jobs");

        $this->load->view("jobs/job", $data);
    }

    public function deleteJob($id) 
    {
        $this->load->model("mdl_job");
        $this->mdl_job->deleteJob($id);

        redirect("admin/jobs");
    }

    public function affiliates()
    {
        $this->load->model("mdl_affiliate");
        $this->load->model("mdl_category");
        $data["backUrl"] = site_url("admin/dashboard");

        //get all affiliates
        $data["affiliates"] = $this->mdl_affiliate->getAffiliates();
        $data["title"] = "Manage Affiliates";
        
        $data["active"] ="affiliates";
        //to display in view
        $data["categories"] = $this->mdl_category->getCategories();

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

        $this->load->model("mdl_affiliate");
        $affiliateID = $this->mdl_affiliate->createAffiliate($affiliate);

        //save selected categories
        if(!empty($categories)) {
            $this->mdl_affiliate->saveCategories($affiliateID, $categories);
        }
        

        redirect("admin/affiliates");
    }

    public function editAffiliate($id)
    {
       $this->load->model("mdl_affiliate");
       $this->load->model("mdl_category");

       $data["categories"] = $this->mdl_category->getCategories();
       //get affiliate that is needed to be edited
        $data["affiliate"]= $this->mdl_affiliate->getAffiliateById($id);
        $data["title"]="Edit Affiliate";
        $data["backUrl"] = site_url("admin/affiliates");
        $categories= $this->input->post("categories");
        //save selected categories
        if(!empty($categories)) {
            $this->mdl_affiliate->saveCategories($id, $categories);
        }
        $this->load->view("admin/editAffiliate", $data);
    }

    public function updateAffiliate() 
    {

        $affiliate["id"]=$this->input->post("id");
        $affiliate["name"]=$this->input->post("name");
        $affiliate["email"]=$this->input->post("email");
        $affiliate["url"]=$this->input->post("url");

        $this->load->model("mdl_affiliate");
        //save the edit
        $this->mdl_affiliate->editAffiliate($affiliate);

        redirect("admin/affiliates");
        
    }

    public function disableAffiliate($id) {
        $this->load->model("mdl_affiliate");
        $this->mdl_affiliate->disable($id);

        redirect("admin/affiliates");
    }

    public function activateAffiliate($id) {
        $token = bin2hex(random_bytes(16));

        $this->load->model("mdl_affiliate");
        $this->mdl_affiliate->activate($id, $token);

        $affiliate = $this->mdl_affiliate->getAffiliateById($id);
        
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
        $this->load->model("mdl_affiliate");
        $this->mdl_affiliate->delete($id);

        redirect("admin/affiliates");
    }
}