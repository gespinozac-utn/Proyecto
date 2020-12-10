<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{

    public function get_by_id($id){
        $result = $this->db->get_where('product',array('id'=>$id));
        if($product = $result->result()){
            return $product[0];
        }
        return null;
    }

    public function get_all($filter = null){
        if($filter){
            $this->db->where('idCategory',$filter);
        }
        return $this->db->get_where('product',array('stock>'=>'0'))->result();
    }
}