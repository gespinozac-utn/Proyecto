<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    private $ADMIN_ROLE = 'Administrador';

    public function index(){
        if($this->get_user()){
            $this->dashboard();
        }else{
            redirect('login','refresh');
        }
    }

    public function category(){
        $filter = null;
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load Model
            $this->load->model('Category_model');
            // Load data
            if($this->input->get('search')) $filter = $this->input->get('search');
            $data['categories'] = $this->Category_model->get_all($filter);
            // Load administrator category section
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/category',$data);
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer'); 
    }

    public function product(){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load administrator category section
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/product');
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer'); 
    }

    public function dashboard(){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // load models
            $this->load->model('Bill_model');
            $this->load->model('User_model');
            //load data
            $data['totalClientes'] = $this->User_model->total_clientes();
            $data['totalProductos'] = $this->Bill_model->totalProductos();
            $data['totalComprado'] = $this->Bill_model->totalComprado();
            // Load administrator dashboard
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/dashboard',$data);
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function addCategory(){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load model
            $this->load->model('Category_model');
            // Load Data
            $data['categories'] = $this->Category_model->get_all();
            // Load administrator create category page
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/addCategory', $data);
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function newCategory(){
        // Load model
        $this->load->model('Category_model');
        // Load data
        $newCategory = (object)array(
            'name' => $this->input->post('name'),
            'parent' => $this->input->post('parent')
        );
        // insert data
        if($this->Category_model->add($newCategory)){
            redirect('/category','refresh');
        }else{
            $this->session->set_flashdata('message','Error while creating category. Try again.');
        }
    }

    public function addProduct(){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load administrator create product page
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/addProduct');
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function editProduct(){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load administrator create product page
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/editProduct');
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function editCategory(){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
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
