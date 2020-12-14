<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function add($product){
        return $this->db->insert('product',$product);
    }

    public function update($product){
        $prod = (object)array(
            'id' => $product->id,
            'sku' => $product->sku,
            'name' => $product->name,
            'idCategory' => $product->idCategory,
            'stock' => $product->stock,
            'price' => $product->price,
            'description' => $product->description
        );
        if(!empty($product->imageURL)) $prod->imageURL = $product->imageURL;
        $this->db->where('id',$product->id);
        return $this->db->update('product',$prod);
    }

    public function get_by_id($id){
        $result = $this->db->get_where('product',array('id'=>$id));
        if($product = $result->result()){
            return $product[0];
        }
        return null;
    }

    public function get_all_filter($filter = null){
        if($filter){
            $this->db->select('product.id');
            $this->db->select('product.name');
            $this->db->select('product.idCategory');
            $this->db->select('product.sku AS sku');
            $this->db->select('category.name as categoryName');

            $this->db->like('product.sku',$filter);
            $this->db->or_like('product.name',$filter);
            $this->db->join('category','category.id = product.idCategory');
            $this->db->or_like('category.name',$filter);
        }
        return $this->db->get_where('product')->result();
    }

    public function get_all_category($filter = null){
        if($filter){
            $query = "SELECT DISTINCT p.*
                    FROM product AS p
                        INNER JOIN category AS c ON (p.idCategory = c.id)
                        INNER JOIN category AS pa ON (p.idCategory = pa.id OR c.parent = pa.name) 
                    WHERE c.id = " . $filter . " OR pa.id = "  . $filter . "";
                    
             return ($this->db->query($query)->result());
        }
        return $this->db->get_where('product')->result();
    }

    public function get_all($filter = null){
        if($filter){
            $this->db->where('idCategory',$filter);
        }
        return $this->db->get_where('product',array('stock>'=>'0'))->result();
    }

    public function delete($product){
        return $this->db->delete('product',array('id'=>$product->id));
    }
}