<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
    public function get_all($filter = null){
        if(isset($filter)){
            $this->db->like('parent',$filter);
        }else{
            $this->db->where('parent', '---');
        }
        return $this->db->get('category')->result();       
    }

    public function get_by_id($category){
        $id = $category->id;
        $result = $this->db->get_where('category',array('id'=>$id));
        if($category = $result->result()){
            return $category[0];
        }
        return null;
    }
}