<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function index(){
        if($this->get_user()){
            $this->dashboard();
        }else{
            $this->login();
        }
    }

    public function category(){
        $userRole = $this->get_user();
        $this->load->view('templates/header');
        if($userRole == 'admin'){
            // Load administrator category section
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/category');
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer'); 
    }

    public function product(){
        $userRole = $this->get_user();
        $this->load->view('templates/header');
        if($userRole == 'admin'){
            // Load administrator category section
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/product');
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer'); 
    }

    public function dashboard(){
        $userRole = $this->get_user();
        $this->load->view('templates/header');
        if($userRole == 'admin'){
            // Load administrator dashboard
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/dashboard');
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    function login(){
        $userRole = $this->get_user();
        $this->load->view('templates/header',['userRole'=>$userRole]);
        $this->load->view('client/login');
        $this->load->view('templates/footer');
    }

    public function addCategory(){
        $userRole = $this->get_user();
        $this->load->view('templates/header');
        if($userRole == 'admin'){
            // Load administrator create category page
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/addCategory');
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function addProduct(){
        $userRole = $this->get_user();
        $this->load->view('templates/header');
        if($userRole == 'admin'){
            // Load administrator create product page
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/addProduct');
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function editProduct(){
        $userRole = $this->get_user();
        $this->load->view('templates/header');
        if($userRole == 'admin'){
            // Load administrator create product page
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/editProduct');
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function editCategory(){
        $userRole = $this->get_user();
        $this->load->view('templates/header');
        if($userRole == 'admin'){
            // Load administrator create product page
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/editCategory');
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    private function get_user(){
        return $this->session->has_userdata('user') ? $this->session->user : null;
    }
}
