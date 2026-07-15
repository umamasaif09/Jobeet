    <?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class mdl_admin extends CI_model
    {
        public function getAdminByEmail($email)
        {
            $this->db->where("email", $email);
            return $this->db->get("admins")->row_array();
        }

        public function updateResetToken($id, $token) 
        {
            $expiry= date("Y-m-d H:i:s", strtotime('+1 hour')); //1 hour expiry time
            $this->db->where("id", $id);
            return $this->db->update("admins", 
                    [
                        "reset_token" => $token,
                        "reset_token_expires_at" => $expiry
                    ]);
        }

        public function getAdminByResetToken($token)
        {
            $this->db->where("reset_token", $token);
            return $this->db->get("admins")->row_array();
        }

        public function updatePassword($id, $password)
        {
            $this->db->where("id", $id);
            return $this->db->update("admins", [
                "password" => $password,
                "reset_token" => NULL,
                "reset_token_expires_at" => NULL //clear token so link cannot be reused
            ]);
        }

        public function getAdmins()
        {
            return $this->db->get("admins")->result_array();
        }

        public function registerAdmin($admin)
        {
            return $this->db->insert("admins", $admin);
        }

        public function getAdminById($id) 
        {
            $this->db->where("id", $id);
            return $this->db->get("admins")->row_array();
        }

        public function updateAdmin($admin) 
        {
            $this->db->where("id", $admin["id"]);
            return $this->db->update("admins", [
                "name" => $admin["name"],
                "email" => $admin["email"]
            ]);
        }

        public function deleteAdmin($id) 
        {
            $this->db->where("id", $id);
            return $this->db->delete("admins");
        }

        public function activate($id) 
        {
            $this->db->where("id",$id);
            return $this->db->update("admins", ["is_active" => 1]);
        }

        public function disable($id) 
        {
            $this->db->where("id",$id);
            return $this->db->update("admins", ["is_active" => 0]);
        }
    }