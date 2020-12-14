<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bill_model extends CI_Model
{
    public function totalProductos($user = null){
        $total = 0;
        $query = '';
        if($user){
            $idUser = $user->id;
            $query = "SELECT * FROM `order` WHERE `status`=1 AND `idUser`=$idUser;";
        }else{
            $query = "SELECT * FROM `order` WHERE `status`=1;";
        }

        $orders = $this->db->query($query)->result();
        if($orders){
            foreach($orders as $order){
                $details = $this->getDetails($order);
                foreach($details as $detail){
                    $total += $detail->quantity;
                }
            }
        }

        return $total;
    }

    public function totalComprado($user = null){
        $total = 0;
        $query = '';
        if($user){
            $idUser = $user->id;
            $query = "SELECT * FROM `order` WHERE `status`=1 AND `idUser`=$idUser;";
        }else{
            $query = "SELECT * FROM `order` WHERE `status`=1;";
        }

        $orders = $this->db->query($query)->result();
        if($orders){
            foreach($orders as $order){
                $details = $this->getDetails($order);
                foreach($details as $detail){
                    $this->load->model('Product_model');
                    $product = $this->Product_model->get_by_id($detail->idProduct);
                    $total += $product->price * $detail->quantity;
                }
            }
        }

        return $total;
    }

    public function getDetails($order){
        $id = $order->id;
        $result = $this->db->get_where('detail',array('idOrder'=>$id));
        if($details = $result->result()){
            return $details;
        }else{
            return null;
        }        
    }

    public function get_orders($user){
        return $this->db->get_where('order',array('idUser'=>$user->id, 'status'=>1))->result();
    }

    public function get_detail($detail){
        return $this->db->get_where('detail',array('idOrder'=>$detail->idOrder))->result()[0];
    }

    public function get_basket($user){
        $result = $this->db->get_where('order',array('idUser' =>$user->id,'status'=>0));
        if($order = $result->result()){
            return $order[0];
        }
        return null;
    }

    public function add_detail($detail){
        $temp = (object)array(
            'idOrder' => $detail->idOrder,
            'idProduct' => $detail->idProduct,
            'quantity' => $detail->quantity
        );
        return $this->db->insert('detail',$temp);
    }

    public function update($preOrder){
        $this->db->set('purchaseDate','NOW()', false);
        $this->db->set('status',$preOrder->status);
        $this->db->where('id',$preOrder->id);
        return $this->db->update('order');
    }

    public function remove_detail($detail){
        return $this->db->delete('detail',array('id'=>$detail->id));
    }

    public function create_basket($user){
         return $this->db->insert('order',array('idUser' => $user->id,'status' => 0)); 
    }
}