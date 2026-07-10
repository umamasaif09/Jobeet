<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_job extends CI_Model
{
    public function getLatestJobs()
    {
        $this->db->where("is_active", 1);
        $this->db->where("jobs.expires_at >", date("Y-m-d H:i:s"));
        $this->db->order_by("created_at", "DESC");
        $this->db->limit($this->config->item('latest_jobs_limit'));
        $this->db->select("jobs.* , categories.name AS category_name");
        $this->db->from("jobs");
        $this->db->join("categories", "jobs.category_id = categories.id" ); //join johs table and category table
        $jobsQuery = $this->db->get();
        $jobs= $jobsQuery->result_array(); //latest jobs

        $groupedJobs= [];

        foreach($jobs as $job) {
            $category_id= $job["category_id"];
        
            // group latest jobs based on category
            if(!isset($groupedJobs[$category_id]))
            $groupedJobs [$category_id]= [
                "name" => $job["category_name"],
                "jobs" => []
            ];

            $groupedJobs[$category_id]["jobs"][]= $job;
           }

           
           return $groupedJobs;

    }

    public function getJobsByCategory($id, $page) {

        $this->db->where("id", $id);
        $categoryQuery= $this->db->get("categories");
        $category= $categoryQuery->row_array();
        
        $this->db->where("category_id", $id);
        $this->db->where("is_active",1);
        $this->db->where("jobs.expires_at >", date("Y-m-d H:i:s"));
        $totalJobs= $this->db->count_all_results("jobs");

        $this->db->where("category_id", $id);
        $this->db->where("is_active",1);
        $this->db->where("jobs.expires_at >", date("Y-m-d H:i:s"));
        $this->db->order_by("created_at","DESC");
        
        $limit = $this->config->item('jobs_per_page');
        $offset= ($page-1)*$limit;//model
        $this->db->limit($limit, $offset);
        
        $jobsQuery= $this->db->get("jobs");
        $jobs= $jobsQuery->result_array();
        //calculate total pages if 20 are shown per page
        $totalPages= ceil($totalJobs/$limit);

        return [
            "category" => $category,
            "jobs" => $jobs,
            "totalJobs" => $totalJobs,
            "totalPages" => $totalPages
        ];
    }

    public function searchJobs($keyword) 
    {
        $this->db->select("jobs.id,
            jobs.location,
            jobs.position,
            jobs.company,
            categories.name");

        $this->db->from("jobs");
        //join category and jobs table so we get the category name in results
        $this->db->join(
            "categories",
            "jobs.category_id = categories.id"
            );

        $this->db->where("jobs.is_active", 1);
        $this->db->where("jobs.expires_at >", date("Y-m-d H:i:s"));

        //group the codition
        $this->db->group_start();
        $this->db->like("jobs.company", $keyword);
        $this->db->or_like("jobs.position", $keyword);
        $this->db->or_like("jobs.location", $keyword);
        $this->db->or_like("categories.name", $keyword);
        $this->db->group_end();

        $this->db->order_by("jobs.created_at", "DESC");
        
        $searchQuery= $this->db->get();
        $jobs= $searchQuery->result_array();

        return $jobs;


    }

    public function getJobById($id)
    {
        $this->db->where("id", $id);
        $jobQuery= $this->db->get("jobs");
        $job= $jobQuery->row_array();
        return $job;
    }

    public function getCategoryById($id)
    {
        $this->db->where("id", $id);
        $categoryQuery= $this->db->get("categories");
        return $categoryQuery->row_array();
    }

    public function getJobCategories() 
    {
        $categoryQuery = $this->db->get("categories");
        return $categoryQuery->result_array();
    }

    public function createJob($data)
    {
        $this->db->insert("jobs",$data);
        return $this->db->insert_id();
    }

    public function getJobForEdit($id, $token)
    {
        $this->db->where("id", $id);
        $this->db->where("token", $token);
        
        return $this->db->get("jobs")->row_array();

    }

    public function updateJob($data, $id, $token) {
        $this->db->where("id", $id);
        $this->db->where("token", $token);
        $this->db->update("jobs", $data);

        return true;
    }

    public function getJobs()
    {
        $query = $this->db->get("jobs");
        return $query->result_array();
    }

    public function deleteJob($id) {
        $this->db->where("id", $id);
        return $this->db->delete("jobs");
    }

    public function getActiveJobs($limit = null, $category=null) {
        $this->db->where("is_active", 1);
        $this->db->where("jobs.expires_at >", date("Y-m-d H:i:s"));

        if($category) {
            $this->db->where("category_id", $category); //jobs of specific category
        }

        if($limit) {
            $this->db->limit($limit); //jobs limited to the given limit
        }
        return $this->db->get("jobs")->result_array();
    }

    public function extendJob($id) {
        $days = $this->Config->item('job_expiry');

        $newDate= date(
            "Y-m-d H:i:s", strtotime("+{$days} days") //udpate job expiry with 30 days
        );

        $this->db->where("id", $id);
        return $this->db->update("jobs", ["expires_at" =>$newDate]);

    }

    public function getJobsCount() {
        return $this->db->count_all_results("jobs");
    }

    public function getRemainingDays($id) 
    {
        $this->db->where("id", $id);

        $job = $this->db->get("jobs")->row_array();

        $expires= strtotime($job["expires_at"]);
        $today= time();

        return ceil(($expires - $today)/(60*60*24)); //remaining active time
    }
}