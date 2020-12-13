<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{

    public function add($category){
        return $this->db->insert('category',$category);
    }

    public function delete($category){
        return $this->db->delete('category',array('id'=>$category->id));
    }

    public function update($category){
        return $this->db->update('category',array('id'=>$category->id));
    }

    public function get_all($filter = null){
        if(isset($filter)){
            $this->db->like('parent',$filter);
            $this->db->or_like('name',$filter);
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