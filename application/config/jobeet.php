<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$config[''] = ;
$config["upload_path"] = "./uploads/";
$config["allowed_types"] = "jpg|jpeg|png|gif";
$config["encrypt_name"]=  TRUE;
$config["max_size"]= 2048;

$config['latest_jobs_limit'] = 10;
$config['jobs_per_page'] = 20;

$config['job_expiry'] = 30;