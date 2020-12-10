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
        $userRole = $this->get_user()->role;
        $this->load->view('templates/header');
        if ($userRole == $this->CLIENT_ROLE) {
            // Load client dashboard
            $this->load->view('client/navbar');
            $this->load->view('client/dashboard');
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

    public function catalogue()
    {
        $userRole = $this->get_user()->role;
        $this->load->view('templates/header');
        if ($userRole == $this->CLIENT_ROLE) {
            // Load client catalogue
            $this->load->view('client/navbar');
            $this->load->view('client/catalogue');
        } else {
            show_404();
        }
        $this->load->view('templates/footer');
    }

    public function orders()
    {
        $userRole = $this->get_user()->role;
        $this->load->view('templates/header');
        if ($userRole == $this->CLIENT_ROLE) {
            // Load client orders
            $this->load->view('client/navbar');
            $this->load->view('client/orders');
        } else {
            show_404();
        }
        $this->load->view('templates/footer');
    }

    public function checkout()
    {
        $userRole = $this->get_user()->role;
        $this->load->view('templates/header');
        if ($userRole == $this->CLIENT_ROLE) {
            // Load client checkout
            $this->load->view('client/navbar');
            $this->load->view('client/checkout');
        } else {
            show_404();
        }
        $this->load->view('templates/footer');
    }

    public function authenticate()
    {
        $this->load->model('Client_model');
        $user = (object)array(
            'username' => $this->input->post('username'), 
            'password' => $this->input->post('password'),
            'role' => null
        );
        $user = $this->Client_model->auth_user($user);
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
}
