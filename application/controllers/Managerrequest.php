<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managerrequest extends CI_Controller {
   function __construct() {
        parent::__construct();
        $this->load->model('managermodel','manager');
        date_default_timezone_set('Asia/Kolkata');
    }
    
    public function update_cashier(){
        $form=$this->input->post();
        if(count($form)==3){
            $data=array(
                $form['fname']=>$form['fvalue']
            );
            echo $this->manager->update_cashier($data,$form['id']);
        }
    }
    
    public function update_product(){
        $form=$this->input->post();
        if(count($form)==3){
            $data=array(
                $form['fname']=>$form['fvalue']
            );
            echo $this->manager->update_product($data,$form['id']);
        }
    }
    
    public function update_batch(){
        $form=$this->input->post();
        if(count($form)==3){
            $data=array(
                $form['fname']=>$form['fvalue']
            );
            echo $this->manager->update_batch($data,$form['id']);
        }
    }
    
    public function update_coupon(){
        $form=$this->input->post();
        if(count($form)==3){
            $data=array(
                $form['fname']=>$form['fvalue']
            );
            echo $this->manager->update_coupon($data,$form['id']);
        }
    }
    
    public function fetch_product(){
        if($this->session->userdata('manager_id')){
            if($data=$this->manager->fetch_product()){
                $response_string="Product Fetch Successfully";
                $error_code=1;
            }
            else{
                $data=array();
                $response_string="No Product Available";
                $error_code=0;
            }
        }
        else{
            $data=array();
            $response_string="You are Not Logged In";
            $error_code=0;
        }
        header('Content-Type: application/json');
        echo json_encode(['data'=>$data,'response_string'=>$response_string,"error_code"=>$error_code ]);
    }
    
    public function fetch_batch(){
        if($this->session->userdata('manager_id')){
            if($bid=$this->input->post('batch_id')){
            if($data=$this->manager->fetch_batch($bid)){
                $response_string="Data Fetched Successfully";
                $error_code=1;
            }
            else{
                $data=array();
                $response_string="Batch Data Not Found";
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
            $response_string="You are Not Logged In";
            $error_code=0;
        }
        header('Content-Type: application/json');
        echo json_encode(['data'=>$data,'response_string'=>$response_string,"error_code"=>$error_code ]);
    }
    
    public function check_unique_productid(){
        if($this->session->userdata('manager_id')){
            if($pid=$this->input->post('product_id')){
            if(!$this->manager->check_unique_productid($pid)){
                $response_string="Product ID Checked";
                $error_code=1;
            }
            else{
                $response_string="Product Id Already Exists";
                $error_code=0;
            }
            }
            else{
                $response_string="Required Parameter Missing";
                $error_code=0;
            }
        }
        else{
            $response_string="You are Not Logged In";
            $error_code=0;
        }
        header('Content-Type: application/json');
        echo json_encode(['response_string'=>$response_string,"error_code"=>$error_code ]);
    }
    
    public function check_unique_batchid(){
        if($this->session->userdata('manager_id')){
            if($bid=$this->input->post('batch_id')){
            if(!$this->manager->check_unique_batchid($bid)){
                $response_string="Batch ID Checked";
                $error_code=1;
            }
            else{
                $response_string="Batch Id Already Exists";
                $error_code=0;
            }
            }
            else{
                $response_string="Required Parameter Missing";
                $error_code=0;
            }
        }
        else{
            $response_string="You are Not Logged In";
            $error_code=0;
        }
        header('Content-Type: application/json');
        echo json_encode(['response_string'=>$response_string,"error_code"=>$error_code ]);
    }
    
    public function check_unique(){
        $data=$this->input->post();
        if(count($data)==2){
            if($this->manager->check_unique($data['fname'],$data['fvalue'])){
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
    
    public function get_statistics(){
        $data=$this->input->post();
        if(count($data)==2){
            $result['stats']=$this->manager->get_statistics($data['start_date'],$data['end_date']);
            $result['graphs']=$this->manager->get_graphs_data($data['start_date'],$data['end_date']);
            if($result){
                    $data=$result;
                    $error_code=1;
                    $response_string="Data fetched Successfully"; 
            }
            else{
                $data=array();
                $error_code=0;
                $response_string="Failed to fetch data"; 
            }
        }
        else{
                $data=array();
                $error_code=0;
                $response_string="Required Parameter Missing";
        }
        header('Content-Type: application/json');
        echo json_encode(['data'=>$data,'response_string'=>$response_string,"error_code"=>$error_code]);
    }
    
    public function updatePassword(){
        $data=$this->input->get();
        if(count($data)==2){
            if($id=$this->session->userdata('manager_id')){
            $array=array(
                'manager_id'=>$id,
                'new_password'=>$data['npassword'],
                'old_password'=>$data['opassword']
            );
            if($result=$this->manager->updatePassword($array)){
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
}
?>