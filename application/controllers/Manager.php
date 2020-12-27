<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('managermodel','manager');
        $this->load->model('cashiermodel','Cashier');
    }
    
	public function index()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $managerinfo=$this->manager->getManagerData($id);
            $data=$this->manager->get_dashboard_data();
            $this->load->view('manager/home',compact('managerinfo','data')); 
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
   public function login(){
        if($this->session->userdata('manager_id')){
            return redirect('manager');
        }
        else{
            if($this->input->post('SignIn')){
                $email=$this->input->post('email');
                $password=$this->input->post('password');
                $result=$this->manager->login_valid($email,$password);
            if($result==1){
                $manager_id=$this->getManagerId($email);
                $this->session->set_userdata('manager_id',$manager_id);
                return redirect('manager');
            }
            else{
                if($result==0){
                    $this->setFlashMessage("alert-danger","Password is Not Correct");
                }
                else{
                    $this->setFlashMessage("alert-danger","Email is Not Correct");
                }
            return redirect('manager/login');
            }
            }
            else{
            $this->load->view("manager/login");
            }
        }
    }
    
    public function bills()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $sid=$this->getShopId($id);
            $managerinfo=$this->manager->getManagerData($id);
            $data=$this->manager->getBills($sid);
            $this->load->view('manager/bills',compact('managerinfo','data')); 
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function detailbill()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $managerinfo=$this->manager->getManagerData($id);
            $bid=$this->uri->segment(3);
            $this->load->model('cashiermodel','Cashier');
            $data=$this->Cashier->getBillData($bid);
            if($data){
                $this->load->view('manager/detail-bill',compact('managerinfo','data')); 
            }
            else{
                $this->load->view('manager/bills',compact('managerinfo')); 
            }
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
   public function viewinventory()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $managerinfo=$this->manager->getManagerData($id);
            $data=$this->manager->getInventory();
            $this->load->view('manager/view-inventory',compact('managerinfo','data')); 
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function addinventory()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            if($form=$this->input->post()){
                if($form['submit']=='product'){
                    $data=array(
                        'product_id'=>$form['pid'],
                        'product_name'=>$form['pname'],
                        'product_category'=>$form['category'],
                        'product_subcat'=>$form['subcat'],
                        'product_price'=>$form['price'],
                        'product_discount'=>$form['discount'],
                        'product_discription'=>$form['discription'],
                        'discount_type'=>$form['dtype'],
                        'max_discount'=>$form['mdiscount']
                    );
                    if($this->manager->add_product($data)){
                        $this->setFlashMessage("alert-success","Product Successfully Added");
                    }
                    else{
                        $this->setFlashMessage("alert-danger","Failed To Add Product");
                    }
                }
                else{
                    $data=array(
                        'product_id'=>$form['pid'],
                        'batch_id'=>$form['bid'],
                        'manufacturing_date'=>$form['mdate'],
                        'expiry_date'=>$form['edate'],
                        'remark'=>$form['remark'],
                        'product_quantity'=>$form['quantity'],
                        'shop_id'=>$this->getShopId($id),
                    );
                    if($this->manager->add_batch($data)){
                        $this->setFlashMessage("alert-success","Batch Successfully Added");
                    }
                    else{
                        $this->setFlashMessage("alert-danger","Failed To Add Batch");
                    }
                }
                return redirect('manager/addinventory/');
            }
            else{
                $managerinfo=$this->manager->getManagerData($id);
                $this->load->view('manager/add-inventory',compact('managerinfo'));
            }
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function updateinventory()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $managerinfo=$this->manager->getManagerData($id);
            $pid=$this->uri->segment(3);
            $data=$this->manager->getProductData($pid);
            if(count($data)){
                $batch=$this->manager->getBatchId($pid);
                $this->load->view('manager/update-inventory',compact('managerinfo','data','batch')); 
            }
            else{
                return redirect('viewinventory');
            }
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function viewcustomer()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $managerinfo=$this->manager->getManagerData($id);
            $data=$this->manager->getCustomers();
            $this->load->view('manager/view-customer',compact('managerinfo','data')); 
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function addcustomer()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            if($form=$this->input->post()){
                $unique=$this->Cashier->checkUnique($form['cmobile'],$form['cmail']);
                if($unique==1){
                $data=array(
                    'customer_id'=>$this->getCustomerId(),
                    'customer_name'=>$form['cname'],
                    'customer_mobile'=>$form['cmobile'],
                    'customer_email'=>$form['cmail']
                );
                if($this->Cashier->add_customer($data)){
                    $this->setFlashMessage("alert-success","Customer Successfully Registered");
                }
                else{
                    $this->setFlashMessage("alert-danger","Failed To Register Customer");
                }
                }
                else{
                    $this->setFlashMessage("alert-danger",$unique);
                }
                return redirect('manager/addcustomer/');
            }
            else{
                $managerinfo=$this->manager->getManagerData($id);
                $this->load->view('manager/add-customer',compact('managerinfo')); 
            }
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function updatecustomer()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $managerinfo=$this->manager->getManagerData($id);
            $cid=$this->uri->segment(3);
            $data=$this->manager->getCustomerData($cid);
            $this->load->view('manager/update-customer',compact('managerinfo','data')); 
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function viewcashier()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $shop_id=$this->getShopId($id);
            $managerinfo=$this->manager->getManagerData($id);
            $data=$this->manager->getCashiers($shop_id);
            $this->load->view('manager/view-cashier',compact('managerinfo','data')); 
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function addcashier()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            if($form=$this->input->post()){
                $unique=$this->manager->checkUniqueCashier($form['cmobile'],$form['cmail']);
                if($unique==1){
                $sid=$this->getShopId($id);
                $data=array(
                    'cashier_id'=>$this->getCashierId($sid),
                    'cashier_name'=>$form['cname'],
                    'cashier_mobile'=>$form['cmobile'],
                    'cashier_email'=>$form['cmail'],
                    'shop_id'=>$sid,
                    'cashier_image'=>'rammeena.png',
                    'cashier_password'=>'$2y$10$qvhyTaUmIBQjh3iX0z.05..1XZDCLrMB8mjEEKHLzJPInUUH7yidS'
                );
                if($this->manager->add_cashier($data)){
                    $this->setFlashMessage("alert-success","Cashier Successfully Registered");
                }
                else{
                    $this->setFlashMessage("alert-danger","Failed To Register Cashier");
                }
                }
                else{
                    $this->setFlashMessage("alert-danger",$unique);
                }
                return redirect('manager/addcashier/');
            }
            else{
                $managerinfo=$this->manager->getManagerData($id);
                $this->load->view('manager/add-cashier',compact('managerinfo')); 
            }
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function update_cashier()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $managerinfo=$this->manager->getManagerData($id);
            $cid=$this->uri->segment(3);
            $data=$this->manager->getcashierData($cid);
            $this->load->view('manager/update-cashier',compact('managerinfo','data')); 
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function viewcoupon()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $managerinfo=$this->manager->getManagerData($id);
            $data=$this->manager->getCoupons();
            $this->load->view('manager/view-coupon',compact('managerinfo','data')); 
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function addcoupon()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            if($form=$this->input->post()){
                $coupon=$this->generateCoupon(10);
                if($coupon){
                $sid=$this->getShopId($id);
                $data=array(
                    'coupon_id'=>$coupon,
                    'coupon_discount'=>$form['cdiscount'],
                    'discount_type'=>$form['discount_type'],
                    'max_redemption'=>$form['redemption'],
                    'max_discount'=>$form['mdiscount'],
                    'min_order_amount'=>$form['min_amount'],
                    'valid_from'=>$form['valid_from'],
                    'valid_till'=>$form['valid_upto']
                );
                if($this->manager->add_coupon($data)){
                    $this->setFlashMessage("alert-success","Coupon Successfully Added");
                }
                else{
                    $this->setFlashMessage("alert-danger","Failed To Add Coupon");
                }
                }
                else{
                    $this->setFlashMessage("alert-danger","Failed to Add Coupon");
                }
                return redirect('manager/addcoupon/');
            }
            else{
                $managerinfo=$this->manager->getManagerData($id);
                $this->load->view('manager/add-coupon',compact('managerinfo')); 
            }
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function updatecoupon()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $managerinfo=$this->manager->getManagerData($id);
            $cid=$this->uri->segment(3);
            $data=$this->manager->getCouponData($cid);
            $this->load->view('manager/update-coupon',compact('managerinfo','data')); 
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function profile()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $managerinfo=$this->manager->getManagerData($id);
            $data=$this->manager->get_profile_data($id);
            $this->load->view('manager/profile',compact('managerinfo','data')); 
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function statistics()
	{   
        if($this->session->userdata('manager_id')){
            $id=$this->session->userdata('manager_id');
            $managerinfo=$this->manager->getManagerData($id);
            $this->load->view('manager/statistics',compact('managerinfo')); 
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function logout(){
     $this->session->unset_userdata('manager_id');
     return redirect("manager");
 }
    
private function getManagerId($email){
        return $this->manager->getManagerId($email);
    }
    
private function getShopId($id){
        return $this->manager->getShopId($id);
    }
    
    private function getCustomerId(){
      $id=$this->Cashier->getCustomerMaxId();
        $number = floor(substr($id,3))+1;
        $id=sprintf('%03d',$number);
       return "RSM".$id;
  }
    
  private function getCashierId($sid){
       $id=$this->manager->getCashierMaxId($sid);
       $number = floor(substr($id,4))+1;
       $id=sprintf('%02d',$number);
       return "CASH".$id;
  }

  private function setFlashMessage($class,$message){
        $this->session->set_flashdata("feedback_message",$message);
        $this->session->set_flashdata("feedback_class",$class);
    }  

  private function getVendorId(){
        $id=$this->manager->getMaxId();
        $number = floor(substr($id,3))+1;
        $id=sprintf('%03d',$number);
       return "GAP".$id;
    }
    
    private function generateCoupon($length){
        $token = "";
	    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $codeAlphabet.= "0123456789";
	    $max = strlen($codeAlphabet); 
	
	    for ($i=0; $i < $length; $i++) {
	        $token .= $codeAlphabet[rand(0,35)];
	    }
	   $unique=$this->manager->check_unique_coupon($token);
       if($unique){
           return $this->generateCoupon(10);
       }
       else
	       return $token;
    }
    
}
?>