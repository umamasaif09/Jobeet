<?php

defined("BASEPATH") or exit("No direct script access allowed");

class files extends api_controller
{
    public function upload()
    {
        $this->load->config("jobeet");

        $config["upload_path"] = $this->config->item("upload_path");
        $config["allowed_types"] = $this->config->item("allowed_types");
        $config["encrypt_name"]=  $this->config->item("encrypt_name");
        $config["max_size"]= $this->config->item("max_size");

        $this->load->library("upload", $config);

        if(!$this->upload->do_upload("logo")) {

            http_response_code(400);
            echo json_encode([
                "message" => $this->upload->display_errors("","")
            ]);
            return;
        }
           
        $uploadData = $this->upload->data();

        
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode([
            "filename" => $uploadData["file_name"],
            "url" => base_url("uploads/".$uploadData["file_name"])
        ]);
    }
}