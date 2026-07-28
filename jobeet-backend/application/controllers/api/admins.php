<?php

defined("BASEPATH") or exit("No direct script access allowed");

class admins extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("mdl_admin");
    }

    public function index()
    {
        $this->requireLogin();
        
        $admins = $this->mdl_admin->getAdmins();

        header("Content-Type: application/json");
        echo json_encode($admins, JSON_PRETTY_PRINT);
    }

    public function detail($id) {
      $this->requireLogin();

      $admin= $this->mdl_admin->getAdminById();

      header("Content-Type: application/json");
      echo json_encode($admin, JSON_PRETTY_PRINT);
    }

    public function create()
    {
        $this->requireLogin();

        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
        }

        $adminData = [
            "name" => $data["admin_name"],
            "email" => $data["admin_email"],
            "password" => password_hash($data["admin_password"], PASSWORD_DEFAULT)
        ];

        $adminId = $this->mdl_admin->registerAdmin($adminData);

        if(!$adminId) {
            http_response_code(500);
            echo json_encode([
                "message"=> "Unable to create admin"
            ]);

            return;
        }

        $admin = $this->mdl_admin->getAdminById($adminId);

        http_response_code(201);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Admin created successfully",
            "id" =>$adminId,
            "admin" => $admin
        ]);
    }

    public function update($adminId)
    {
        $this->requireLogin();
        
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
        }

        $adminData = [
            "name" => $data["admin_name"],
            "email" => $data["admin_email"]
        ];

        $admin = $this->mdl_admin->updateAdmin($adminId,$adminData);

        if(!$admin) {
            http_response_code(500);
            echo json_encode([
                "message"=> "Unable to update admin"
            ]);

            return;
        }

        $admin = $this->mdl_admin->getAdminById($adminId);

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Admin updated successfully",
            "id" =>$adminId,
            "admin" => $admin
        ]);

    }

    public function disable($adminId)
    {
        $this->requireLogin();
        
        $disabled = $this->mdl_admin->disable($adminId);

        if(!$disabled) {
            http_response_code(404);
            echo json_encode([
                "message" => "Admin not found"
            ]);
            return; 
        }

        $admin = $this->mdl_admin->getAdminById($adminId);

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Admin disabled successfully",
            "id" =>$adminId,
            "admin" => $admin
        ]);
    }

    public function activate($adminId)
    {
        $this->requireLogin();
        
        $activated = $this->mdl_admin->activate($adminId);
        if(!$activated) {
            http_response_code(404);
            echo json_encode([
                "message" => "Admin not found"
            ]);
            return; 
        }

        $admin = $this->mdl_admin->getAdminById($adminId);

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Admin activated successfully",
            "id" =>$adminId,
            "admin" => $admin
        ]);

    }

    public function delete($adminId)
    {
        $this->requireLogin();
        
        $deleted = $this->mdl_admin->deleteAdmin($adminId);

        if(!$deleted) {
            http_response_code(404);
            echo json_encode([
                "message" => "Admin not found"
            ]);
            return; 
        }

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Admin deleted successfully",
            "id" =>$adminId
        ]);

    }

    public function count()
    {
        $this->requireLogin();
        
        $count = $this->mdl_admin->getAdminsCount();

        header("Content-Type: application/json");
        echo json_encode($count, JSON_PRETTY_PRINT);
    }

    public function dashboard() {
      $this->requireLogin();

      $this->load->model("mdl_category");
      $categories = $this->mdl_category->getCategoriesCount();

      $this->load->model("mdl_job");
      $jobs = $this->mdl_job->getJobsCount();

      $this->load->model("mdl_affiliate");
      $affiliates = $this->mdl_affiliate->getAffiliatesCount();

      $admins = $this->mdl_admin->getAdminsCount();

      http_response_code(200);
      header("Content-Type: application/json");
      echo json_encode([
          "categories" => $categories,
          "jobs" => $jobs,
          "affiliates" => $affiliates,
          "admins" => $admins
      ]);
    }
}