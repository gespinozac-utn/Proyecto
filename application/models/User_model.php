<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
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

    public function total_clientes(){
        $users = $this->db->get_where('users',array('role'=>'Cliente'));
        return count($users->result());
    }

    public function user_by_username($user){
        $username = $user->username;
        $result = $this->db->get_where('users',array('username'=>$username));
        return $result->result();
    }

    public function addUser($user){
        return $this->db->insert('users',$user);
    }
}
