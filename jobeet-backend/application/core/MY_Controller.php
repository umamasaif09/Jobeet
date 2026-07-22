<?php

defined("BASEPATH") or exit("No direct script access allowed");

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setCors();
    }

    protected function requireLogin()
    {
        if(!$this->session->userdata("logged_in") ||
            !$this->session->userdata("admin_id")) {
                http_response_code(401);

                echo json_encode([
                    "message" => "Unauthorized"
                ]);

                exit;
            }
    }


    protected function setCors()
    {
        header("Access-Control-Allow-Origin: http://localhost:3000");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit;
    }
    }
}