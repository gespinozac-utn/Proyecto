<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{

    private $CLIENT_ROLE = 'Cliente';

    public function index()
    {
        if ($this->get_user()) {
            $this->dashboard();
        } else {
            $this->login();
        }
    }

    public function register()
    {
        $this->load->view('templates/header');
        $this->load->view('client/register');
        $this->load->view('templates/footer');
    }

    public function login()
    {
        $userRole = $this->get_user();

        $this->load->view('templates/header', ['userRole' => $userRole]);
        $this->load->view('client/login');
        $this->load->view('templates/footer');
    }

    public function dashboard()
    {
        $user = $this->get_user();
        $userRole = $user ? $user->role : null;
        $this->load->view('templates/header');
        if ($userRole == $this->CLIENT_ROLE) {
            $this->load->model('Bill_model');
            $data['totalProductos'] = $this->Bill_model->totalProductos($user);
            $data['totalComprado'] = $this->Bill_model->totalComprado($user);
            // Load client dashboard
            $this->load->view('client/navbar');
            $this->load->view('client/dashboard',$data);
        } else {
            show_404();
        }
        $this->load->view('templates/footer');
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect('', 'refresh');
    }

    public function catalogue($opt = null,$filter = null)
    {
        $userRole = $this->get_user() ? $this->get_user()->role : null;
        $this->load->view('templates/header');
        if ($userRole == $this->CLIENT_ROLE) {
            // Load model
            $this->load->model('Product_model');
            $this->load->model('Category_model');
            // Load data
            $data['catalogue'] = $this->Product_model->get_all();
            $data['category'] = $this->Category_model->get_all();
            if($filter && $opt == 'preview'){$data['preview'] = $this->Product_model->get_by_id($filter);}
            if($opt == 'search'){
                $data['parent'] = $this->Category_model->get_by_id((object)array('id'=>$filter));
                $data['category'] = $this->Category_model->get_all($data['parent']->name);
                $data['catalogue'] = $this->Product_model->get_all($filter);
            }
            // Load client catalogue
            $this->load->view('client/navbar');
            $this->load->view('client/catalogue',$data);
        } else {
            show_404();
        }
        $this->load->view('templates/footer');
    }

    public function orders($viewOrder = null)
    {
        $user = $this->get_user();
        $userRole =  $user ? $user->role : null;
        $this->load->view('templates/header');
        if ($userRole == $this->CLIENT_ROLE) {
            // Load model
            $this->load->model('Bill_model');
            // Load data
            $data['orders'] = $this->Bill_model->get_orders($user);
            foreach($data['orders'] as $order){
                $order->details = $this->Bill_model->getDetails($order);
                foreach($order->details as $detail){
                    // Load model
                    $this->load->model('Product_model');
                    $product = $this->Product_model->get_by_id($detail->idProduct);
                    $detail->total = $detail->quantity * $product->price;
                }
            }
            if($viewOrder){
                $data['view'] = $this->Bill_model->getDetails((object)array('id'=>$viewOrder));
                foreach($data['view'] as $detail){
                    $detail->product = $this->Product_model->get_by_id($detail->idProduct);
                }
            }
            // Load client orders
            $this->load->view('client/navbar');
            $this->load->view('client/orders',$data);
        } else {
            show_404();
        }
        $this->load->view('templates/footer');
    }

    public function checkout()
    {
        $user = $this->get_user(); 
        $userRole = $user ? $user->role : null;
        $this->load->view('templates/header');
        if ($userRole == $this->CLIENT_ROLE) {
            // Load model
            $this->load->model('Bill_model');
            // Load data
            $order = $this->Bill_model->get_basket($user);
            $data['basket'] = $this->Bill_model->getDetails($order);
            if($details = $data['basket']){
                foreach($details as $detail){
                    $this->load->model('Product_model');
                    $detail->product = $this->Product_model->get_by_id($detail->idProduct);
                }
            }
            // Load client checkout
            $this->load->view('client/navbar');
            $this->load->view('client/checkout',$data);
        } else {
            show_404();
        }
        $this->load->view('templates/footer');
    }

    public function authenticate()
    {
        $this->load->model('User_model');
        $user = (object)array(
            'username' => $this->input->post('username'), 
            'password' => $this->input->post('password'),
            'role' => null
        );
        $user = $this->User_model->auth_user($user);
        if($user){
            $this->session->set_userdata('user',$user);
            if($user->role == 'Administrador'){
                redirect(site_url('admin/dashboard'));
            }else{
                redirect('/dashboard','refresh');
            }
        }else{
            $this->session->set_flashdata('message','User or password incorrect.');
            redirect(site_url('login'));
        }
    }

    private function get_user()
    {
        return $this->session->has_userdata('user') ? $this->session->userdata('user') : null;
    }

    public function addUser(){
        $newUser = (object)array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'role' => 'Cliente'
        );
        $newClient = (object)array(
            'idUser' => null,
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address')
        );
        $repeatPassword = $this->input->post('repeatPassword');

        if($newUser->password === $repeatPassword){
            $this->load->model('User_model');
            if(!$this->User_model->user_by_username($newUser)){
                if($this->User_model->addUser($newUser)){
                    $this->load->model('Client_model');
                    $newClient->idUser = $this->db->insert_id();
                    if($this->Client_model->addClient($newClient)){
                        $this->session->set_flashdata('message','User Created.');
                        redirect('login');
                    }else{
                        $this->session->set_flashdata('message', 'Unexpected error.');
                        redirect('/register','refresh'); 
                    }
                }else{
                    $this->session->set_flashdata('message', 'Unexpected error.');
                    redirect('/register','refresh'); 
                }
            }else{
                $this->session->set_flashdata('message', 'Username already exist.');
                redirect('/register','refresh');
            }
        }else{
            $this->session->set_flashdata('message', 'Passwords do not match.Try again.');
            redirect('/register','refresh');
        }
    }
}
