<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    

    public function dashboard()
    {
        $this->lang->load('admin', 'english');
        $this->lang->load('categories', 'english');
        $this->lang->load('affiliates', 'english');
        $this->lang->load('jobs', 'english');

        $data["title"] = "Admin Dashboard";
        $data["active"] = "dashboard";
        $data["content"] = "admin/dashboard";
        $data["showPageHeader"] = false;

        $this->load->model("mdl_category");
        $data ["totalCategories"] = $this->mdl_category->getCategoriesCount();

        $this->load->model("mdl_job");
        $data ["totalJobs"] = $this->mdl_job->getJobsCount();

        $this->load->model("mdl_affiliate");
        $data["totalAffiliates"] = $this->mdl_affiliate->getAffiliatesCount();

        $this->load->view("templates/admin_template", $data);
    }

    public function categories()
    {   
        $this->lang->load('admin', 'english');
        $this->lang->load('categories', 'english');
        $this->lang->load('common', 'english');
        $this->load->model("mdl_category");
        
        $data["categories"] = $this->mdl_category->getCategories();
        $data["title"] = "Manage Categories";
        $data["active"] ="categories";
        $data["content"] = "admin/categories";
        $data["showPageHeader"] = true; //back button

        $this->load->view("templates/admin_template", $data);
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
        $this->lang->load('admin', 'english');
        $this->lang->load('categories', 'english');
        $this->load->model("mdl_category");
        $data["category"]= $this->mdl_category->getCategoryById($id);
        $data["title"]="Edit category";

        $data["content"] = "admin/editCategory";
        $data["showPageHeader"] = true;
        
        $this->load->view("templates/admin_template", $data);
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
        $this->lang->load('admin', 'english');
        $this->lang->load('jobs', 'english');
        $this->lang->load('common', 'english');
        $this->load->model("mdl_job");
        
        $data["jobs"] = $this->mdl_job->getJobs();
        $data["title"] = "Manage Jobs";
        $data["active"] ="jobs";
        $data["content"] = "admin/jobs";
        $data["showPageHeader"] = true;
        
        $this->load->model("mdl_category");
        $data["categories"]= $this->mdl_category->getCategories();

        //list jobs with category names

        $this->load->view("templates/admin_template", $data);
    }

    public function createJob() {
        $this->lang->load('admin', 'english');
        $this->load->model("mdl_job");

        $data= [
            "title" => "Create Job",
            "categories" => $this->mdl_job->getJobCategories(),
            "content" => "jobs/createJob",
            "showPageHeader" => true
        ];

        $this->load->view("templates/admin_template", $data);
    }

    public function editJob($id)
    {
        $this->lang->load('admin', 'english');
        $this->load->model("mdl_job");
        $job= $this->mdl_job->getJobById($id);

        $category= $this->mdl_job->getCategoryById($job["category_id"]);
        $daysRemaining = $this->mdl_job->getRemainingDays($id); //get job expiry
        
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
            "categories" => $this->mdl_category->getCategories(),
            "content" => "jobs/editForm",
            "showPageHeader" => true
            ];
            $this->load->view("templates/admin_template", $data);
        }
    }
    
    public function viewJob($id) 
    {
        $this->lang->load('admin', 'english');
        $data["title"] ="Job";
        $this->load->model("mdl_job");
        $data["job"]= $this->mdl_job->getJobById($id);

        $data["content"] = "jobs/job";
        $data["showPageHeader"] = true;

        $this->load->view("templates/admin_template", $data);
    }

    public function deleteJob($id) 
    {
        $this->load->model("mdl_job");
        $this->mdl_job->deleteJob($id);

        redirect("admin/jobs");
    }

    public function affiliates()
    {   
        $this->lang->load('admin', 'english');
        $this->lang->load('affiliates', 'english');
        $this->lang->load('common', 'english');
        
        $this->load->model("mdl_affiliate");
        $this->load->model("mdl_category");

        //get all affiliates
        $data["affiliates"] = $this->mdl_affiliate->getAffiliates();
        $data["title"] = "Manage Affiliates";
        $data["content"] = "admin/affiliates";
        $data["showPageHeader"] = true;
        
        $data["active"] ="affiliates";
        //to display in view
        $data["categories"] = $this->mdl_category->getCategories();

        $this->load->view("templates/admin_template", $data);
    }

    public function addAffiliate() 
    {
        $this->lang->load('admin', 'english');
        $this->lang->load('affiliates', 'english');
        $this->load->model("mdl_job");

        $data= [
            "title" => "Create Affiliate",
            "categories" => $this->mdl_job->getJobCategories(),
            "content" => "admin/createAffiliate",
            "showPageHeader" => true
        ];

        $this->load->view("templates/admin_template", $data);
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
        $this->lang->load('admin', 'english');
        $this->lang->load('affiliates', 'english');

       $this->load->model("mdl_affiliate");
       $this->load->model("mdl_category");

       $data["categories"] = $this->mdl_category->getCategories();
       //get affiliate that is needed to be edited
        $data["affiliate"]= $this->mdl_affiliate->getAffiliateById($id);
        $data["title"]="Edit Affiliate";
        $data["content"] = "admin/editAffiliate";
        $data["showPageHeader"] = true;

        $categories= $this->input->post("categories");
        //save selected categories
        if(!empty($categories)) {
            $this->mdl_affiliate->saveCategories($id, $categories);
        }
        $this->load->view("templates/admin_template", $data);
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