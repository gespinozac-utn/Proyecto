<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{
    function index()
    {
        $this->load->view('templates/header');
        $this->load->view('login');
        $this->load->view('templates/footer');
    }

    function register(){
        $this->load->view('templates/header');
        $this->load->view('register');
        $this->load->view('templates/footer');
    }
}