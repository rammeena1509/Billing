<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JSONRequest extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Cashiermodel','Cashier');
    }
    
    public function verifyUser(){
        $data=$this->input->get();
        if($data){
            $mobile=$data['mobile'];
            $total=$data['total'];
            $result=$this->Cashier->verifyUser($mobile);
            if(!$result){
                $stack=array();
               $response_string="User not Registered";
                $error_code=0; 
            }
            else{
            $stack[]=$result;
            $result=$this->Cashier->getCouponDiscount($total);
            $max_discount=0;
            $coupon="";
            $reward_discount=0;
            $reward_redeem=0;
            foreach($result as $row){
                if($this->Cashier->checkCouponValidity($row->coupon_id,$row->max_redemption,$stack[0]->customer_id)){
                    if($row->discount_type==0){
                        $discount=$row->coupon_discount*.01*$total;
                        if($discount>$row->max_discount){
                            $discount=$row->max_discount;
                        }
                    }
                    else{
                        $discount=$row->coupon_discount;
                    }
                    if($discount>$max_discount){
                        $max_discount=$discount;
                        $coupon=$row->coupon_id;
                    }
                }
            }
            if($stack[0]->reward_point>=200){
                $reward_discount=floor($stack[0]->reward_point/4);
                $reward_redeem=$stack[0]->reward_point-$stack[0]->reward_point%4;
            }
            $stack[]=array(
                "discount"=>$max_discount,
                "coupon"=>$coupon,
                'reward_discount'=>$reward_discount,
                'reward_redeem'=>$reward_redeem
            );
            $response_string="Data fetched successfully";
            $error_code=1;
            }
        }
        else{
            $stack=array();
            $response_string="Required Parameter Missing";
            $error_code=0;
        }
        header('Content-Type: application/json');
        echo json_encode(["data"=>$stack,'response_string'=>$response_string,"error_code"=>$error_code]);
    }
}