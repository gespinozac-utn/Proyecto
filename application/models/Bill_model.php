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

    private function getDetails($order){
        $id = $order->id;
        $result = $this->db->get_where('detail',array('idOrder'=>$id));
        if($details = $result->result()){
            return $details;
        }else{
            return null;
        }        
    }
}