<?php

defined("BASEPATH") or exit("No direct script access allowed");

class MY_Controller extends CI_Controller
{
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
}