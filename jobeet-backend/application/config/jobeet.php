<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//configs fro uploaded images
$config["upload_path"] = "./uploads/"; 
$config["allowed_types"] ="jpg|jpeg|png|gif|webp|jfif";
$config["encrypt_name"]=  TRUE;
$config["max_size"]= 2048;

//config for limiting latest jobs on homepage
$config['latest_jobs_limit'] = 10;

//config for limiting jobs on category page
$config['jobs_per_page'] = 20;

//config for expiry limit for a job
$config['job_expiry'] = 30;