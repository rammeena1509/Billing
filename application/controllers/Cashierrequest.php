<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashierrequest extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Cashiermodel','Cashier');
        date_default_timezone_set('Asia/Kolkata');
    }
    
    public function getItem(){
        $id=$this->input->get('p_id');
        $pid=substr($id,0,6);
        $bid=substr($id,6,10);
        if($pid){
            $data=$this->Cashier->getItem($pid,$bid);
            if($data){
                if($data->total_quantity){
                $response_string="Data Fetched Successfully";
                $error_code=1;
                }
                else{
                    $response_string="Item is not Available in the Inventory";
                    $error_code=0; 
                }
            }
            else{
            $data=array();
            $response_string="No data found";
            $error_code=0;
            }
        }
        else{
            $data=array();
            $response_string="Required Parameter Missing";
            $error_code=0;
        }
        header('Content-Type: application/json');
        echo json_encode(['data'=>$data,'response_string'=>$response_string,"error_code"=>$error_code ]);
    }
    public function update_bill(){
        if($cid=$this->session->userdata('Cashier_id')){
        $data=$this->input->post('detail');
        if(count($data)==7){
            $quantity=$data['product_quantity'];
            $diff=$data['quantity_difference'];
            $pid=$data['product_id'];
            $bid=$data['batch_id'];
            $error_code=1;
            if($diff>0){
                $pquantity=$this->Cashier->getProductQuantity($pid,$bid);
                if($pquantity<$diff){
                    $response_string="Product is not Available in the Inventory";
                    $error_code=0;
                }
            }
            if($error_code){
                $array=array(
                    'quantity'=>$quantity
                );
                if($this->Cashier->update_order_detail($array,$pid,$bid,$data['order_id'])){
                    $array=array(
                        'total_price'=>$data['updated_price'],
                        'discount'=>$data['updated_discount']
                    );
                    if($this->Cashier->update_order($array,$data['order_id'])){
                        $old_quantity=$this->Cashier->count_batch_item($pid,$bid);
                        $array=array(
                            'product_quantity'=>$old_quantity-$diff
                        );
                        if($this->Cashier->updateInventory($array,$pid,$bid)){
                            $error_code=1;
                            $response_string="Quantity Updated Successfully";
                        }
                        else{
                            $error_code=1;
                            $response_string="Quantity Updated Successfully but failed to update inventory";
                        }
                    }
                    else{
                        $error_code=1;
                        $response_string="Quantity Updated Successfully but failed to update bill";
                    }
                }
                else{
                    $error_code=0;
                    $response_string="Failed to update Quantity";
                }
            }
        }
        else{
            $error_code=0;
            $response_string="Required Parameter Missing";
        }
        }
        else{
            $error_code=0;
            $response_string="You are not Loged In";
        }
        header('Content-Type: application/json');
        echo json_encode(['response_string'=>$response_string,"error_code"=>$error_code ]);
    }
    
    public function remove_bill_product(){
        if($cid=$this->session->userdata('Cashier_id')){
        $data=$this->input->post('detail');
        if(count($data)==6){
            $quantity=$data['product_quantity'];
            $pid=$data['product_id'];
            $bid=$data['batch_id'];
            if($this->Cashier->remove_order_product($pid,$bid,$data['order_id'])){
                    $count=$this->Cashier->count_order_item($data['order_id']);
                    if($count==0){
                        $array=array(
                        'total_price'=>0,
                        'discount'=>0,
                        'status'=>0
                    );
                    }
                    else{
                        $array=array(
                        'total_price'=>$data['updated_price'],
                        'discount'=>$data['updated_discount'],
                        'status'=>1
                    );
                    }
                    if($this->Cashier->update_order($array,$data['order_id'])){
                        $old_quantity=$this->Cashier->count_batch_item($pid,$bid);
                        $array=array(
                            'product_quantity'=>$quantity+$old_quantity
                        );
                        if($this->Cashier->updateInventory($array,$pid,$bid)){
                            $error_code=1;
                            $response_string="Product Removed Successfully";
                        }
                        else{
                            $error_code=1;
                            $response_string="Product Removed Successfully but failed to update inventory";
                        }
                    }
                    else{
                        $error_code=1;
                        $response_string="Product Removed Successfully but failed to update bill";
                    }
                }
                else{
                    $error_code=0;
                    $response_string="Failed to remove Product";
                }
        }
        else{
            $error_code=0;
            $response_string="Required Parameter Missing";
        }
        }
        else{
            $error_code=0;
            $response_string="You are not Loged In";
        }
        header('Content-Type: application/json');
        echo json_encode(['data'=>$count,'response_string'=>$response_string,"error_code"=>$error_code ]);
    }
    
    public function generateBill(){
        if($cid=$this->session->userdata('Cashier_id')){
        $obj=$this->input->post();
        $data=json_decode($obj['order']);
        if($data){
            $order_id=$this->getOrderId();
            $bill=$data[0];
            $customer=$data[1][0];
            $discount=$data[1][1];
            $sum=0;
            $odetail=array();
            $sum=0;
            $product_discount=0;
            foreach($bill as $row){
                $odetail[]=array(
                    'order_id'=>$order_id,
                    'product_id'=>$row->product_id,
                    'quantity'=>$row->quantity,
                    'batch_id'=>$row->batch_id
                );
                if($row->discount_type==0){
                   $pdiscount=($row->product_price*$row->quantity)*0.01*$row->product_discount;
                    if($pdiscount>$row->max_discount){
                        $pdiscount=$row->max_discount;
                    }
                }
                else{
                    $pdiscount=$row->max_discount;
                }
                $sum+=$row->product_price*$row->quantity;
                $product_discount+=$pdiscount;
            }
            $order=array(
                'order_id'=>$order_id,
                'customer_id'=>$customer->customer_id,
                'total_price'=>$sum,
                'cashier_id'=>$cid,
                'order_date'=>date('Y-m-d'),
                'coupon'=>$discount->coupon,
                'discount'=>$discount->discount+$product_discount+$discount->reward_discount,
                'discount_type'=>1,
                'payment_mode'=>'CASH',
                'order_time'=>date('h:i:s')
            );
            if($this->Cashier->insertOrder($order)){
                $j=0;
                foreach($odetail as $row){
                    $quantity=$this->Cashier->getProductQuantity($row['product_id'],$row['batch_id']);
                    if($row['quantity']<=$quantity){
                        $this->Cashier->insertOrderDetail($row);
                        $data1[]=array(
                            'product_quantity'=>$quantity-$row['quantity'],
                            'batch_id'=>$row['batch_id'],
                            'product_id'=>$row['product_id']
                        );
                        $j++;
                    }
                    else{
                        break;
                    }
                }
                if($j==count($odetail)){
                    foreach($data1 as $row){
                        $array=array(
                            'product_quantity'=>$row['product_quantity']
                        );
                        $this->Cashier->updateInventory($array,$row['product_id'],$row['batch_id']);
                    }
                    $data=array(
                        'redemption_date'=>date('Y-m-d'),
                        'redemption_time'=>date('h:i:s'),
                        'redemption_amount'=>$discount->reward_discount,
                        'customer_id'=>$customer->customer_id
                    );
                    $this->Cashier->addRedemption($data);
                    $per=$this->Cashier->getRewardCriteria($sum);
                    $rpoint=0;
                    if($per){
                        $rpoint=floor($sum/$per);
                    }
                    $data=array(
                        'reward_point'=>$customer->reward_point-$discount->reward_redeem+$rpoint
                    );
                    $this->Cashier->updateReward($customer->customer_id,$data);
                    $data=$order_id;
                    $response_string="Bill Generated Successfully";
                    $error_code=1;
                }
                else{
                    $response_string="Failed to Update bill Detail";
                    $error_code=0;
                }
            }
            else{
                $response_string="Failed to process bill";
                $error_code=0;
            }
            
        }
        else{
            $data=array();
            $response_string="Required Parameter Missing";
            $error_code=0;
        }
        }
        else{
            $data=array();
            $response_string="You Cannot generate this bill";
            $error_code=0;
        }
        header('Content-Type: application/json');
        echo json_encode(['data'=>$data,'response_string'=>$response_string,"error_code"=>$error_code ]);
    }
    
    public function registerUser(){
        $data=$this->input->get();
        if(count($data)==4){
            $unique=$this->Cashier->checkUnique($data['mobile'],$data['email']);
            if($unique==1){
            $cid=$this->getCustomerId();
            $total=$data['total'];
            $array=array(
                'customer_id'=>$cid,
                'customer_name'=>$data['name'],
                'customer_mobile'=>$data['mobile'],
                'customer_email'=>$data['email'],
                'reward_point'=>0
            );
            $result=$this->Cashier->registerUser($array);
            if($result){
                $stack[]=$array;
                $result=$this->Cashier->getCouponDiscount($total);
                $max_discount=0;
                $coupon="";
                $reward_discount=0;
                $reward_redeem=0;
                foreach($result as $row){
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
                $stack[]=array(
                    "discount"=>$max_discount,
                    "coupon"=>$coupon,
                    'reward_discount'=>0,
                    'reward_redeem'=>0
                );
                $response_string="Data fetched successfully";
                $error_code=1;
            }
            else{
            $stack=array();
            $response_string="No data found";
            $error_code=0;
            }
        }
        else{
            $stack=array();
            $response_string=$unique;
            $error_code=0;  
            }
        }
        else{
            $stack=array();
            $response_string="Required Parameter Missing";
            $error_code=0;
        }
        header('Content-Type: application/json');
        echo json_encode(['data'=>$stack,'response_string'=>$response_string,"error_code"=>$error_code ]);
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
                $discount=$total*0.2;
                if($reward_discount>$discount){
                    $reward_discount=$discount;
                    $reward_redeem=$discount*4;
                }
                else{
                $reward_redeem=$reward_discount*4;
                }
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
    
    public function updatecustomer(){
        $form=$this->input->post();
        if(count($form)==3){
            $data=array(
                $form['fname']=>$form['fvalue']
            );
            echo $this->Cashier->update_customer($data,$form['id']);
        }
    }
    
    public function updatePassword(){
        $data=$this->input->get();
        if(count($data)==2){
            if($id=$this->session->userdata('Cashier_id')){
            $array=array(
                'cashier_id'=>$id,
                'new_password'=>$data['npassword'],
                'old_password'=>$data['opassword']
            );
            if($result=$this->Cashier->updatePassword($array)){
                if($result==-1){
                    $error_code=0;
                    $response_string="Old Password is not correct"; 
                }
                else{
                    $error_code=1;
                    $response_string="Password Updated Successfully"; 
                }
            }
            else{
                $error_code=0;
                $response_string="Failed to Update Password"; 
            }
        }
        else{
                $error_code=0;
                $response_string="You Are Not Loged In";
        }
        }
        else{
                $error_code=0;
                $response_string="Required Parameter Missing";
        }
        header('Content-Type: application/json');
        echo json_encode(['response_string'=>$response_string,"error_code"=>$error_code]);
    }
    
    public function check_unique(){
        $data=$this->input->post();
        if(count($data)==2){
            if($this->Cashier->check_unique($data['fname'],$data['fvalue'])){
                    $error_code=0;
                    $response_string="Field Value Already Exist"; 
            }
            else{
                $error_code=1;
                $response_string="Field Successfully Checked"; 
            }
        }
        else{
                $error_code=0;
                $response_string="Required Parameter Missing";
        }
        header('Content-Type: application/json');
        echo json_encode(['response_string'=>$response_string,"error_code"=>$error_code]);
    }
    
    private function generateInvoice($array){
        $data = json_encode($array);
        $ch = curl_init('http://localhost/project/welcome/');  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                   
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        curl_setopt($ch, CURLOPT_POST, count($data));                                          
        curl_exec($ch);
    }
    
    private function getCustomerId(){
        $id=$this->Cashier->getCustomerMaxId();
        $number = floor(substr($id,3))+1;
        $id=sprintf('%03d',$number);
        return 'RSM'.$id;
    }
    
    private function getOrderId(){
        $id=$this->Cashier->getOrderMaxId();
        $number = floor(substr($id,6))+1;
        $id=sprintf('%04d',$number);
        return 'BSMRSM'.$id;
    }
    
}