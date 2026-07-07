<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends CI_Model
{
    public function getLatestJobs()
    {
        $this->db->where("is_active", 1);
        $this->db->where("jobs.expires_at >", date("Y-m-d H:i:s"));
        $this->db->order_by("created_at", "DESC");
        $this->db->limit(10);
        $this->db->select("jobs.* , categories.name AS category_name");
        $this->db->from("jobs");
        $this->db->join("categories", "jobs.category_id = categories.id" );
        $jobsQuery = $this->db->get();
        $jobs= $jobsQuery->result_array();

        $groupedJobs= [];

        foreach($jobs as $job) {
            $category_id= $job["category_id"];
        
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
        
        $offset= ($page-1)*20;//model
        $this->db->limit(20, $offset);
        
        $jobsQuery= $this->db->get("jobs");
        $jobs= $jobsQuery->result_array();
        //calculate total pages if 20 are shown per page
        $totalPages= ceil($totalJobs/20);

        return [
            "category" => $category,
            "jobs" => $jobs,
            "totalJobs" => $totalJobs,
            "totalPages" => $totalPages
        ];
    }

    public function searchJobs($keyword) 
    {
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
            $this->db->where("category_id", $category);
        }

        if($limit) {
            $this->db->limit($limit);
        }
        return $this->db->get("jobs")->result_array();
    }

    public function extendJob($id) {
        $newDate= date(
            "Y-m-d H:i:s", strtotime("+30 days")
        );

        $this->db->where("id", $id);
        return $this->db->update("jobs", ["expires_at" =>$newDate]);

    }

    public function getJobsCount() {
        return $this->db->count_all_results("jobs");
    }

    public function getRemainingDays($id, $token) 
    {
        $this->db->where("id", $id);
        $this->db->where("token", $token);

        $job = $this->db->get("jobs")->row_array();

        $expires= strtotime($job["expires_at"]);
        $today= time();

        return ceil(($expires - $today)/(60*60*24));
    }
}