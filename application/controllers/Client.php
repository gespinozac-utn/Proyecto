<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{
    function index()
    {
        $this->load->library('session');
        if(!$this->session->has_userdata('user')){
            $this->login();
        }
    }

    function register(){
        $this->load->view('templates/header');
        $this->load->view('client/register');
        $this->load->view('templates/footer');
    }

    function login(){
        $this->load->library('session');
        $userRole = $this->session->has_userdata('user') ? $this->session->user : '';
        
        $this->load->view('templates/header',['userRole'=>$userRole]);
        $this->load->view('client/login');
        $this->load->view('templates/footer');
    }
}