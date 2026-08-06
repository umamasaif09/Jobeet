<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    

    public function dashboard()
    {
        $this->requireLogin();
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

        $this->load->model("mdl_admin");
        $data["totalAdmins"] = $this->mdl_admin->getAdminsCount();

        $this->load->view("templates/admin_template", $data);
    }

    public function categories()
    {   
        $this->requireLogin();
        $this->lang->load('admin', 'english');
        $this->lang->load('categories', 'english');
        $this->lang->load('common', 'english');
        $this->load->model("mdl_category");
        
        $data["categories"] = $this->mdl_category->getCategories();
        $data["title"] = "Manage Categories";
        $data["active"] ="categories";
        $data["content"] = "admin/categories";
        $data["showPageHeader"] = true;
        $data["pageAction"] = [
            "text" => "New Category",
            "id" => "openCategoryModal"
        ];

        $this->load->view("templates/admin_template", $data);
    }

    public function createCategory() 
    {
        $this->requireLogin();
        $data["name"] = $this->input->post("category_name");
        $this->load->model("mdl_category");
        $this->mdl_category->createCategory($data);
        

        redirect("admin/categories");
    }

    public function editCategory($id)
    {
        $this->requireLogin();
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
        $this->requireLogin();
        $category["id"]=$this->input->post("id");
        $category["name"]=$this->input->post("category_name");

        $this->load->model("mdl_category");
        $this->mdl_category->editCategory($category["id"],$category);

        redirect("admin/categories");
        
    }

    public function deleteCategory($id)
    {
        $this->requireLogin();
        $this->load->model("mdl_category");
        $this->mdl_category->deleteCategory($id);

        redirect("admin/categories");

    }

    public function jobs()
    {   
        $this->requireLogin();
        $this->lang->load('admin', 'english');
        $this->lang->load('jobs', 'english');
        $this->lang->load('common', 'english');
        $this->load->model("mdl_job");
        
        $data["jobs"] = $this->mdl_job->getJobs();
        $data["title"] = "Manage Jobs";
        $data["active"] ="jobs";
        $data["content"] = "admin/jobs";
        $data["showPageHeader"] = true;
        $data["pageAction"] = [
            "text" => "New Job",
            "url" => "admin/createJob"
        ];
        
        $this->load->model("mdl_category");
        $data["categories"]= $this->mdl_category->getCategories();

        //list jobs with category names

        $this->load->view("templates/admin_template", $data);
    }

    public function createJob() {
        $this->requireLogin();
        $this->lang->load('admin', 'english');
        $this->load->model("mdl_job");

        $data= [
            "title" => "Create Job",
            "categories" => $this->mdl_job->getJobCategories(),
            "content" => "jobs/createJob",
            "showPageHeader" => true,
            "showBackButton" => true,
            "formAction" => site_url("admin/createJobPost"),
            "submitButtonText" => "Create"
        ];

        $this->load->view("templates/admin_template", $data);
    }

     public function createJobPost() {
       
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
        
        $jobData =[
            
            "category_id" => $this->input->post("category_id"),
            "type" => $this->input->post("type"),
            "company" => $this->input->post("company"),
            "logo" => $logo,
            "url" => $this->input->post("url"),
            "position" => $this->input->post("position"),
            "location" => $this->input->post("location"),
            "email" => $this->input->post("email"),
            "description" => $this->input->post("description"),
            "how_to_apply" => $this->input->post("how_to_apply"),
            "is_public" => $this->input->post("is_public") ? 1 : 0,
            "created_at" => date("Y-m-d H:i:s"),
            "is_active" => 1,
            "expires_at" => date("Y-m-d H:i:s", strtotime("+30 days"))
        ];

        $this->load->model("mdl_job");
        $jobId= $this->mdl_job->createJob($jobData);
        redirect("admin/jobs");
       
    }

    public function editJob($id)
    {
        $this->requireLogin();
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
            "title"=> "Edit Job",
            "job"=> $job,
            "category" => $category,
            "daysRemaining" =>$daysRemaining,
            "categories" => $this->mdl_category->getCategories(),
            "content" => "jobs/editForm",
            "showPageHeader" => true,
            "showBackButton" => true,
            "is_admin" => true
            ];
            $this->load->view("templates/admin_template", $data);
        }
    }
    
    
    public function viewJob($id) 
    {
        $this->requireLogin();
        $this->lang->load('admin', 'english');
        $data["title"] ="Job Detail";
        $this->load->model("mdl_job");
        $data["job"]= $this->mdl_job->getJobById($id);

        $data["content"] = "jobs/job";
        $data["showPageHeader"] = true;
        $data["showBackButton"] = true;

        $this->load->view("templates/admin_template", $data);
    }

    public function deleteJob($id) 
    {
        $this->requireLogin();
        $this->load->model("mdl_job");
        $this->mdl_job->deleteJob($id);

        redirect("admin/jobs");
    }

    public function affiliates()
    {   
        $this->requireLogin();
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
        $data["pageAction"] = [
            "text" => "New Affiliate",
            "url" => "admin/addAffiliate"
        ];
        
        $data["active"] ="affiliates";
        //to display in view
        $data["categories"] = $this->mdl_category->getCategories();

        $this->load->view("templates/admin_template", $data);
    }

    public function addAffiliate() 
    {
        $this->requireLogin();
        $this->lang->load('admin', 'english');
        $this->lang->load('affiliates', 'english');
        $this->load->model("mdl_job");

        $data= [
            "title" => "Create Affiliate",
            "categories" => $this->mdl_job->getJobCategories(),
            "content" => "admin/createAffiliate",
            "showPageHeader" => true,
            "showBackButton" => true
        ];

        $this->load->view("templates/admin_template", $data);
    } 

    public function createAffiliate() 
    {
        $this->requireLogin();
        $affiliate = [
            "name" => $this->input->post("name"),
            "email" => $this->input->post("email"),
            "site_url" =>$this->input->post("site_url")
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
        $this->requireLogin();
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
        $data["showBackButton"] = true;

        $data["selectedCategories"] = $this->mdl_affiliate->getAffiliateCategoryIds($id);

        $categories= $this->input->post("categories");

        //save selected categories
        if(!empty($categories)) {
            $this->mdl_affiliate->saveCategories($id, $categories);
        }
        $this->load->view("templates/admin_template", $data);
    }

    public function updateAffiliate() 
    {
        $this->requireLogin();

        $affiliate["id"]=$this->input->post("id");
        $affiliate["name"]=$this->input->post("name");
        $affiliate["email"]=$this->input->post("email");
        $affiliate["site_url"]=$this->input->post("site_url");

        $this->load->model("mdl_affiliate");
        //save the edit
        $this->mdl_affiliate->editAffiliate($affiliate["id"],$affiliate);

        redirect("admin/affiliates");
        
    }

    public function disableAffiliate($id) {
        $this->requireLogin();
        $this->load->model("mdl_affiliate");
        $this->mdl_affiliate->disable($id);

        redirect("admin/affiliates");
    }

    public function activateAffiliate($id) {
        $this->requireLogin();
        $token = bin2hex(random_bytes(16));

        $this->load->model("mdl_affiliate");
        $this->mdl_affiliate->activate($id, $token);

        $affiliate = $this->mdl_affiliate->getAffiliateById($id);
        
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

        if ($this->email->send()) {
            echo "Email sent successfully.";
        } else {
            echo $this->email->print_debugger();
        }

        redirect("admin/affiliates");
    }

    public function deleteAffiliate($id) 
    {
        $this->requireLogin();
        $this->load->model("mdl_affiliate");
        $this->mdl_affiliate->deleteAffiliate($id);

        redirect("admin/affiliates");
    }



    private function loginValidationRules() 
    {
        return [
            ["field" => "email",
            "label" => "Email",
            "rules" => "required|valid_email"]
            ,
            ["field" => "password",
            "label" => "Password",
            "rules" => "required|min_length[8]"]
        ];
    }

    private function createSession($admin) 
    {
        $this->session->sess_regenerate(TRUE);

        $this->session->set_userdata([ //session details
            'admin_id' => $admin["id"],
            'admin_name' => $admin["name"],
            'admin_email' => $admin["email"],
            'logged_in' => TRUE
        ]);
    }

    public function login()
    {
        if($this->session->userdata('logged_in') && 
            $this->session->userdata('admin_id'))
            {
                redirect("admin/dashboard"); //if already logged in redirect
                return;
            }
        $this->load->library("form_validation");
        $this->form_validation->set_rules($this->loginValidationRules()); //set rules


        if($this->input->method() =="get" ){
            // $this->lang->load('admin', 'english');
            $data["content"] = "admin/login";
            $data["showPageHeader"]= false;
            $data["showAdminHeader"] =false;
            $data["title"] = "Administrator Login";

            $this->load->view("templates/admin_template", $data); //show login page

        } else if($this->input->method() == "post") {

            if($this->form_validation->run() === false) {
                $data["content"] = "admin/login";
                $data["showPageHeader"]= false;

                $this->load->view("templates/admin_template", $data);
                return;
            }

            $email= $this->input->post("email");
            $password=$this->input->post("password");

            
            $this->load->model("mdl_admin");
            $admin= $this->mdl_admin->getAdminByEmail($email);

            if(!$admin){ //invalid admin
                $this->session->set_flashdata("error", "Incorrect email or password.");
                redirect("admin/login");
                return;
            } else if(!password_verify($password, $admin["password"])) { //incorrect password
                $this->session->set_flashdata("error", "Incorrect email or password.");
                redirect("admin/login");
                return;
            } else if(!$admin["is_active"]) { //valid credentials but account not active
                    $this->session->set_flashdata("error", "Account disabled.");
                    redirect("admin/login");
                    return;
            }
            // all conditions fulfilled
            $this->createSession($admin);
            $this->session->set_flashdata("success", "Login successful.");
            redirect("admin/dashboard");
            return;
        }

    }

    private function requireLogin()
    {
        //if session expired
        if(!$this->session->userdata('logged_in') || 
            !$this->session->userdata('admin_id')    
        ) {
            redirect("admin/login");
            return;
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect("admin/login");
    }

    private function forgotPasswordValidationRules() 
    {
        return [
            ["field" => "email",
            "label" => "Email",
            "rules" => "required|valid_email"]
        ];
    }

    public function forgotPassword()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules($this->forgotPasswordValidationRules());

        $this->load->library("email");
        $this->load->config("email");

        if($this->input->method()=="get") {
            $data["content"] = "admin/forgotPassword";
            $data["showPageHeader"]= false;
            $data["showAdminHeader"] =false;
            $data["title"] = "Reset Password";

            $this->load->view("templates/admin_template", $data); //show forgot password page
        }
        else if($this->input->method()=="post") {
            if($this->form_validation->run() === false) {
                $data["content"] = "admin/forgotPassword";
                $data["showPageHeader"]= false;

                $this->load->view("templates/admin_template", $data);
                return;
            }
            $email= $this->input->post("email");

            $this->load->model("mdl_admin");
            $admin= $this->mdl_admin->getAdminByEmail($email);

            if(!$admin) {
                $this->session->set_flashdata("success",
                "If an account with this email exists, a password reset link has been sent.");

                redirect("admin/login");
                return;
            }
            $token= bin2hex(random_bytes(32));

            $this->mdl_admin->updateResetToken($admin["id"], $token);

            $resetLink = site_url("admin/resetPassword?token=".$token);

            log_message("debug", $resetLink); //temporarily

            $this->email->from("alaina83@ethereal.email", "Jobeet");
            $this->email->to($admin["email"]);
            $this->email->subject("Reset Password");

            $this->email->message("
                <h2>Password Reset</h2>
                <p>Click the link below to reset your password: </p>
                <p><a href='{$resetLink}'>{$resetLink}</a></p>
                
            ");

            if ($this->email->send()) {
                $this->session->set_flashdata("success", "Email sent!");
            } else {
                $this->session->set_flashdata("error", $this->email->print_debugger());
            }

             $this->session->set_flashdata("success",
                "If an account with this email exists, a password reset link has been sent.");

                redirect("admin/login");
        }
    }

   private function resetPasswordValidationRules() 
    {
        return [
            ["field" => "password",
            "label" => "Password",
            "rules" => "required|min_length[8]"]
            ,
            ["field" => "confirm_password",
            "label" => "Confirm Password",
            "rules" => "required|matches[password]"]
        ];
    }

    public function resetPassword()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules($this->resetPasswordValidationRules());

        $this->load->model("mdl_admin");
        

        if($this->input->method() == "get"){
            $token = $this->input->get("token");

            $admin= $this->mdl_admin->getAdminByResetToken($token);

            if(!$admin || $admin["reset_token_expires_at"] < date("Y-m-d H:i:s")) {
            $this->session->set_flashdata("error", "Invalid or expired reset link.");

            redirect("admin/login");
            return;
            }

            $data["content"] ="admin/resetPassword";
            $data["showPageHeader"]=false;
            $data["showAdminHeader"] =false;
            $data["title"] = "Reset Password";
            $data["token"] =$token;

            $this->load->view("templates/admin_template", $data); //show reset password form
        }
        else if($this->input->method()== "post") {
            $token= $this->input->post("token"); //check again

            if($this->form_validation->run() === false) {
                $data["content"] ="admin/resetPassword";
                $data["showPageHeader"]=false;
                $data["showAdminHeader"] =false;
                $data["title"] = "Reset Password";
                $data["token"] = $token;

                $this->load->view("templates/admin_template", $data);
                return;
            }

            $password=$this->input->post("password");
            

            $admin = $this->mdl_admin->getAdminByResetToken($token);

            if(!$admin || $admin["reset_token_expires_at"] < date("Y-m-d H:i:s")) {
                $this->session->set_flashdata("error", "Invalid or expired reset link.");

                redirect("admin/login");
                return;
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $this->mdl_admin->updatePassword($admin["id"], $passwordHash);

            $this->session->set_flashdata("success", "Password updated successfully.");
            redirect("admin/login");
        }
        
    }

    public function admins()
    {
        $this->requireLogin();
        $this->lang->load('admin', 'english');
        $this->lang->load('common', 'english');
        $this->load->model("mdl_admin");
        $admins = $this->mdl_admin->getAdmins();

        $data["admins"] = $admins;
        $data["active"] ="admins";
        $data["content"] = "admin/admins";
        $data["title"] = "Manage Admins";
        $data["showPageHeader"] = true;
        $data["ShowAdminHeader"] = true;
        $data["pageAction"] = [
            "text" => "New Admin",
            "url" => "admin/addAdmin"
        ];

        $this->load->view("templates/admin_template", $data);
    }

    private function registerAdminValidation()
    {
        return [
            ["field" => "name",
            "label" => "Name",
            "rules" => "required"]
            ,
            ["field" => "email",
            "label" => "Email",
            "rules" => "required|valid_email"]
            ,
            ["field" => "password",
            "label" => "Password",
            "rules" => "required|min_length[8]"]
            ,
            ["field" => "confirm_password",
            "label" => "Confirm Password",
            "rules" => "required|matches[password]"]
        ];
    }

    public function addAdmin() 
    {

        $this->requireLogin();
        $this->lang->load('admin', 'english');
        $this->load->model("mdl_admin");

        $this->load->library("form_validation");
        $this->form_validation->set_rules($this->registerAdminValidation());

        if($this->input->method()=="get"){
            $data= [
            "title" => "Register Admin",
            "content" => "admin/registerAdmin",
            "showPageHeader" => true,
            "showBackButton" => true,
            ];

            $this->load->view("templates/admin_template", $data);
        }
        else if($this->input->method()=="post") {


            if($this->form_validation->run() === false) {
                $data= [
                "title" => "Register Admin",
                "content" => "admin/registerAdmin",
                "showPageHeader" => true
                ];

                $this->load->view("templates/admin_template", $data);
                return;
            }

            $admin = [
                "name" => $this->input->post("name"),
                "email" => $this->input->post("email"),
                "password" => password_hash($this->input->post("password"), PASSWORD_DEFAULT)
            ];

            $this->mdl_admin->registerAdmin($admin);
            redirect("admin/admins");
        }  
    } 

    public function editAdmin()
    {
        $this->requireLogin();
        $this->lang->load('admin', 'english');
        $this->load->model("mdl_admin");

        if($this->input->method()=="get"){
            $id = $this->input->get("id");
        
            $data["admin"]= $this->mdl_admin->getAdminById($id);
            $data["title"]="Edit Admin";

            $data["content"] = "admin/editAdmin";
            $data["showPageHeader"] = true;
            $data["showBackButton"] = true;
            
            $this->load->view("templates/admin_template", $data);
        } else if($this->input->method()=="post") {
            $admin = [
                "id" => $this->input->post("id"),
                "name" => $this->input->post("name"),
                "email" => $this->input->post("email")
            ];

            $this->mdl_admin->updateAdmin($admin["id"] ,$admin);

            redirect("admin/admins");
        }

    }

    public function deleteAdmin()
    {
        $this->requireLogin();

        $id = $this->input->get("id");

        $this->load->model("mdl_admin");
        $this->mdl_admin->deleteAdmin($id);

        redirect("admin/admins");

    }

    public function disableAdmin() {
        $this->requireLogin();

        $id = $this->input->get("id");

        $this->load->model("mdl_admin");
        $this->mdl_admin->disable($id);

        redirect("admin/admins");
    }

    public function activateAdmin() {
        $this->requireLogin();

        $id = $this->input->get("id");

        $this->load->model("mdl_admin");
        $this->mdl_admin->activate($id);

        redirect("admin/admins");
    }
}