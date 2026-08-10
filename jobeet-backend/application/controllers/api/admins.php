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

        $this->response($admins);

    }

    public function detail($id) {
      $this->requireLogin();

      $admin= $this->mdl_admin->getAdminById();

      $this->response($admin);
    }

    public function create()
    {
        $this->requireLogin();

        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
          return $this->response([
            "message" => "Invalid request"
            ],400);
        }

        $adminData = [
            "name" => $data["admin_name"],
            "email" => $data["admin_email"],
            "password" => password_hash($data["admin_password"], PASSWORD_DEFAULT)
        ];

        $adminId = $this->mdl_admin->registerAdmin($adminData);

        if(!$adminId) {
            return $this->response([
              "message"=> "Unable to create admin"
            ],500);
        }

        $admin = $this->mdl_admin->getAdminById($adminId);

        $this->response([
          "message" => "Admin created successfully",
          "id" =>$adminId,
          "admin" => $admin
        ], 201);
    }

    public function update($adminId)
    {
        $this->requireLogin();
        
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            return $this->response([
              "message" => "Invalid request"
            ],400);
        }

        $adminData = [
            "name" => $data["admin_name"],
            "email" => $data["admin_email"]
        ];

        $admin = $this->mdl_admin->updateAdmin($adminId,$adminData);

        if(!$admin) {
            return $this->response([
              "message"=> "Unable to update admin"
            ], 500);
        }

        $admin = $this->mdl_admin->getAdminById($adminId);

        $this->response([
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
            return $this->response([
              "message" => "Admin not found"
            ], 400); 
        }

        $admin = $this->mdl_admin->getAdminById($adminId);

        $this->response([
          "message" => "Admin disabled successfully",
          "id" =>$adminId,
          "admin" => $admin]);
    }

    public function activate($adminId)
    {
        $this->requireLogin();
        
        $activated = $this->mdl_admin->activate($adminId);
        if(!$activated) {
            return $this->response([
              "message" => "Admin not found"
            ],404); 
        }

        $admin = $this->mdl_admin->getAdminById($adminId);

        $this->response([
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
            return $this->resposne([
              "message" => "Admin not found"
            ], 404); 
        }

        $this->response([
          "message" => "Admin deleted successfully",
          "id" =>$adminId
        ]);
    }

    public function count()
    {
        $this->requireLogin();
        
        $count = $this->mdl_admin->getAdminsCount();

        $this->response($count);
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

      $this->response([
        "categories" => $categories,
        "jobs" => $jobs,
        "affiliates" => $affiliates,
        "admins" => $admins
      ]);
    }
}