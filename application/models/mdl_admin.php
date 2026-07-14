    <?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class mdl_admin extends CI_model
    {
        public function getAdminByEmail($email)
        {
            $this->db->where("email", $email);
            return $this->db->get("admins")->row_array();
        }
    }