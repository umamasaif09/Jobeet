<?php

defined("BASEPATH") or exit("No direct script access allowed");

class categories extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("mdl_category");
    }

    public function index()
    {
        $categories = $this->mdl_category->getCategories();

        header("Content-Type: application/json");
        echo json_encode($categories, JSON_PRETTY_PRINT);
    }

    public function create()
    {
        $this->requireLogin();
        
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
        }

        $categoryData = [
            "name" => $data["category_name"]
        ];

        $categoryId = $this->mdl_category->createCategory($categoryData);

        if(!$categoryId) {
            http_response_code(500);
            echo json_encode([
                "message"=> "Unable to create category"
            ]);

            return;
        }

        $category = $this->mdl_category->getCategoryById($categoryId);

        http_response_code(201);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Category created successfully",
            "id" =>$categoryId,
            "category" => $category
        ]);
    }

    public function update($categoryId)
    {
        $this->requireLogin();
        
        $json= file_get_contents("php://input");
        $data = json_decode($json, true);

        if(empty($data)){
            http_response_code(400);
            echo json_encode([
                "message" => "Invalid request"
            ]);
            return;
        }

        $categoryData = [
            "name" => $data["category_name"]
        ];

        $category = $this->mdl_category->editCategory($categoryData);

        if(!$category) {
            http_response_code(500);
            echo json_encode([
                "message"=> "Unable to update category"
            ]);

            return;
        }

        $category = $this->mdl_category->getCategoryById($categoryId);

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Category updated successfully",
            "id" =>$categoryId,
            "category" => $category
        ]);

    }

    public function delete($categoryId)
    {
        $this->requireLogin();
        
        $deleted = $this->mdl_category->deleteCategory($categoryId);

        if(!$deleted) {
            http_response_code(404);
            echo json_encode([
                "message" => "Category not found"
            ]);
            return; 
        }

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            "message" => "Category deleted successfully",
            "id" =>$categoryId
        ]);

    }

    public function count()
    {
        $this->requireLogin();
        
        $count = $this->mdl_category->getCategoriesCount();

        header("Content-Type: application/json");
        echo json_encode($count, JSON_PRETTY_PRINT);
    }
}