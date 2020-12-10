<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_model extends CI_Model
{
    function addClient($client){
        return $this->db->insert('clients', $client);
    }
}