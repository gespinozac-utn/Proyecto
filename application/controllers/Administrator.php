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
        $filter = null;
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load model
            $this->load->model('Product_model');
            $this->load->model('Category_model');
            // Load data
            if($this->input->get('search')) $filter = $this->input->get('search');
            $data['products'] = $this->Product_model->get_all_filter($filter);
            foreach($data['products'] as $prod){
                $prod->category = $this->Category_model->get_by_id((object)array('id'=>$prod->idCategory));
            }
            // Load administrator category section
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/product',$data);
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
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
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
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer'); 
    }

    public function addProduct(){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load model
            $this->load->model('Category_model');
            // Load data
            $data['categories'] = $this->Category_model->get_all();
            // Load administrator create product page
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/addProduct',$data);
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function newProduct(){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load model
            $this->load->model('Category_model');
            $this->load->model('Product_model');
            // Load data
            $data['categories'] = $this->Category_model->get_all();
            $newProduct = (object)array(
                'sku' => $this->input->post('sku'),
                'name' => $this->input->post('name'),
                'imageURL' => 'UPLOADS/' . ($this->upload_file()['file_name'] == NULL ? 'PLACEHOLDER.PNG' : $this->upload_file()['file_name']),
                'idCategory' => $this->input->post('category'),
                'stock' => $this->input->post('stock'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description')
            );
            // Add new product
            if($this->Product_model->add($newProduct)){
                redirect('/product','refresh');
            }else{
                $this->session->set_flashdata('message','Error while creating category. Try again.');
                redirect('/product','refresh');
            }
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function editProduct($id){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load Model
            $this->load->model('Product_model');
            $this->load->model('Category_model');
            // Load data
            $data['categories'] = $this->Category_model->get_all();
            $data['product'] = $this->Product_model->get_by_id($id);
            $data['product']->category = $this->Category_model->get_by_id((object)array('id'=>$data['product']->idCategory));
            // Load administrator create product page
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/editProduct',$data);
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function updateProduct(){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load Model
            $this->load->model('Product_model');
            $this->load->model('Category_model');
            // Load data
            $product = (object)array(
                'id' => $this->input->post('id'),
                'sku' => $this->input->post('sku'),
                'name' => $this->input->post('name'),
                'idCategory' => $this->input->post('category'),
                'stock' => $this->input->post('stock'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description')
            );
            if($file_data = $this->upload_file()){
                $product->imageURL = 'UPLOADS/'.$file_data['file_name'];
            }
            // update product
            if($this->Product_model->update($product)){
                redirect('/product','refresh');
            }else{
                $this->session->set_flashdata('message','Error while updating product. Try again.');
                redirect('/product','refresh');
            }
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function editCategory($id){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load model
            $this->load->model('Category_model');
            // Load data
            $data['categories'] = $this->Category_model->get_all();
            $data['category'] = $this->Category_model->get_by_id((object)array('id'=>$id));
            // Load administrator create product page
            $this->load->view('administrator/navbar');
            $this->load->view('administrator/editCategory',$data);
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function updateCategory(){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load model
            $this->load->model('Category_model');
            // Load data
            $category = (object)array(
                'id' => $this->input->post('id'),
                'name' => $this->input->post('name'),
                'parent' => $this->input->post('parent')
            );
            if($this->Category_model->update($category)){
                redirect('/category','refresh');
            }else{
                $this->session->set_flashdata('message','Error while updating category. Try again.');
                redirect('/category','refresh');
            }
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function deleteCategory($id){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load model
            $this->load->model('Category_model');
            // Delete category
            if($this->Category_model->has_childs($this->Category_model->get_by_id((object)array('id'=>$id)))){
                $this->session->set_flashdata('message','Error. Category with childs.');
                redirect('/category','refresh');
            }else{
                if($this->Category_model->delete((object)array('id'=>$id))){
                    redirect('/category','refresh');
                }else{
                    $this->session->set_flashdata('message','Error while deleting category. Try again.');
                    redirect('/category','refresh');
                }
            }
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    public function deleteProduct($id){
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if($userRole == $this->ADMIN_ROLE){
            // Load model
            $this->load->model('Product_model');
            // Delete product
            if($this->Product_model->delete((object)array('id'=>$id))){
                redirect('/product','refresh');
            }else{
                $this->session->set_flashdata('message','Error while deleting product. Try again.');
                redirect('/product','refresh');
            }
        }else{
            $this->load->view('errors/unauthorized_access');
        }
        $this->load->view('templates/footer');
    }

    private function get_user(){
        return $this->session->has_userdata('user') ? $this->session->user : null;
    }

    private function upload_file(){
        if($_FILES['imageURL'] === null) return null;
        // Set configuration
        $config['upload_path'] = 'uploads/'; 
        $config['allowed_types'] = 'jpg|jpeg|png'; 
        $config['file_name'] = $_FILES['imageURL']['name']; 

        // Load upload library 
        $this->load->library('upload',$config);
        
        if($this->upload->do_upload('imageURL')){
            return $this->upload->data();
        }
        return null;
    }
}
