<?php

defined("BASEPATH") or exit("No direct script access allowed");

class auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("mdl_admin");
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
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
        }

        $email = $data["email"];
        $password  = $data["password"];

        $admin = $this->mdl_admin->getAdminByEmail($email);

        if(!$admin) {
            http_response_code(401);
            echo json_encode([
                "message" => "Incorrect email or password"
            ]);
            return;
        } else if(!password_verify($password, $admin["password"])) {
            http_response_code(401);
            echo json_encode([
                "message" => "Incorrect email or password"
            ]);
            return;
        } else if(!$admin["is_active"]) {
            http_response_code(403);
            echo json_encode([
                "message" => "Account disabled"
            ]);
            return;
        }

        $this->createSession($admin);
        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Login successful",
            "admin" => [
                "id" => $admin["id"],
                "email" => $admin["email"],
                "name" => $admin["name"]
            ]
        ]);
    }

    public function logout()
    {
        $this->requireLogin();
        
        $this->session->sess_destroy();
        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Logout successful"
        ]);

    }

    private function sendPasswordResetEmail($admin, $resetLink)
    {
        $this->load->library("email");
        $this->load->config("email");

        $this->email->from("alaina83@ethereal.email", "Jobeet");
            $this->email->to($admin["email"]);
            $this->email->subject("Reset Password");

            $this->email->message("
                <h2>Password Reset</h2>
                <p>Click the link below to reset your password: </p>
                <p><a href='{$resetLink}'>{$resetLink}</a></p>
                
            ");

            return $this->email->send();
    }

    public function forgotPassword() 
    {
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
        }

        $email = trim($data["email"]);

        $admin = $this->mdl_admin->getAdminByEmail($email);

        if(!$admin) {
            http_response_code(200);
            echo json_encode([
                "message" => "If an account with this email exists, a password reset link has been sent"
            ]);
            return;
        }

        $token = bin2hex(random_bytes(32));

        $this->mdl_admin->updateResetToken($admin["id"], $token);

        $resetLink = "http://localhost:3000/auth/reset-password?token=".$token; // needs to be updated after frontend is configured

        $emailSent = $this->sendPasswordResetEmail($admin, $resetLink);

        if(!$emailSent) {
            http_response_code(500);
            echo json_encode([
                "message" => "Unable to send email"
            ]);
            return;
        }

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "If an account with this email exists, a password reset link has been sent"
        ]);

    }

    public function resetPassword($token)
    {
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
        }

        $password = $data["password"];

        $admin = $this->mdl_admin->getAdminByResetToken($token);

        if(!$admin || $admin["reset_token_expires_at"] < date("Y-m-d H:i:s")) {
            http_response_code(403);
            echo json_encode([
                "message" => "Invalid or expired reset link"
            ]);
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $reset = $this->mdl_admin->updatePassword($admin["id"], $passwordHash);

        if(!$reset) {
            http_response_code(500);
            echo json_encode([
                "message" => "Unable to update password"
            ]);
            return; 
        }

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Password updated successfully"
        ]);

    }

    public function me()
    {
        $this->requireLogin();

        http_response_code(200);
        header("Content-Type: application/json");

        echo json_encode([
            "id" => $this->session->userdata("admin_id"),
            "name" => $this->session->userdata("admin_name"),
            "email" => $this->session->userdata("admin_email")
        ]);
    }
}