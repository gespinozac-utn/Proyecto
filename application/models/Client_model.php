<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_model extends CI_Model
{

    public function auth_user($user)
    {
        $result = $this->db->get_where(
            'users',
            array(
                'username' => $user->username,
                'password' => $user->password
            )
        );
        
        if ($user = $result->result()) {
            return $user[0];
        }
        return null;
    }
}
