<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashier extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Cashiermodel','Cashier');
    }
    
	public function index()
	{   
        if($this->session->userdata('Cashier_id')){
            $id=$this->session->userdata('Cashier_id');
            $cashierinfo=$this->Cashier->getCashierData($id);
            $data=$this->Cashier->get_dashboard_data($id);
            $this->load->view('Cashier/home',compact('cashierinfo','data')); 
        }
        else{
            return redirect("Cashier/login");
        }
                
	}
    
   public function login(){
        if($this->session->userdata('Cashier_id')){
            return redirect('Cashier');
        }
        else{
            if($this->input->post('SignIn')){
                $email=$this->input->post('email');
                $password=$this->input->post('password');
                $result=$this->Cashier->login_valid($email,$password);
            if($result==1){
                $Cashier_id=$this->getCashierId($email);
                $this->session->set_userdata('Cashier_id',$Cashier_id);
                return redirect('Cashier');
            }
            else{
                if($result==0){
                    $this->setFlashMessage("alert-danger","Password is Not Correct");
                }
                else{
                    $this->setFlashMessage("alert-danger","Email is Not Correct");
                }
            return redirect('Cashier/login');
            }
            }
            else{
            $this->load->view("Cashier/login");
            }
        }
    }
    
    public function viewbill()
	{   
        if($this->session->userdata('Cashier_id')){
            $id=$this->session->userdata('Cashier_id');
            $cashierinfo=$this->Cashier->getCashierData($id);
            $data=$this->Cashier->getBills($id);
            $this->load->view('Cashier/bills',compact('cashierinfo','data')); 
        }
        else{
            return redirect("Cashier/login");
        }
                
	}
    
    public function generatebill()
	{   
        if($this->session->userdata('Cashier_id')){
            $id=$this->session->userdata('Cashier_id');
            $cashierinfo=$this->Cashier->getCashierData($id);
            $this->load->view('Cashier/generate-bill',compact('cashierinfo')); 
        }
        else{
            return redirect("Cashier/login");
        }
                
	}
    
    public function detailbill()
	{   
        if($this->session->userdata('Cashier_id')){
            $id=$this->session->userdata('Cashier_id');
            $cashierinfo=$this->Cashier->getCashierData($id);
            $bid=$this->uri->segment(3);
            $data=$this->Cashier->getBillData($bid);
            if($data){
                $this->load->view('Cashier/detail-bill',compact('cashierinfo','data')); 
            }
            else{
                $this->load->view('Cashier/bills',compact('cashierinfo')); 
            }
        }
        else{
            return redirect("Cashier/login");
        }
                
	}
    
    public function updatebill()
	{   
        if($this->session->userdata('Cashier_id')){
            $id=$this->session->userdata('Cashier_id');
            $cashierinfo=$this->Cashier->getCashierData($id);
            if($this->uri->segment(3) || $this->input->post('bill')){
                if($this->input->post('bill') !=null){
                    $bid=$this->input->post('bill');
                }
                else{
                    $bid=$this->uri->segment(3);
                }
                $data=$this->Cashier->getBillData($bid);
                if($data){
                    $this->load->view('Cashier/update-bill',compact('cashierinfo','data')); 
                    }
                else{
                    $this->load->view('Cashier/update-bill',compact('cashierinfo'));  
                }
                }
            else{
               $this->load->view('Cashier/update-bill',compact('cashierinfo')); 
           }
        }
        else{
            return redirect("Cashier/login");
        }
                
	}
    
    public function viewcustomer()
	{   
        if($this->session->userdata('Cashier_id')){
            $id=$this->session->userdata('Cashier_id');
            $cashierinfo=$this->Cashier->getCashierData($id);
            $data=$this->Cashier->getCustomer($id);
            $this->load->view('Cashier/view-customer',compact('cashierinfo','data')); 
        }
        else{
            return redirect("Cashier/login");
        }
                
	}
    
    public function updatecustomer()
	{   
        if($this->session->userdata('Cashier_id')){
            $id=$this->session->userdata('Cashier_id');
            $cashierinfo=$this->Cashier->getCashierData($id);
            //$data=$this->adminmodel->getDashboardData();
            $cid=$this->uri->segment(3);
            $data=$this->Cashier->getCustomerData($cid);
            if($data){
                $this->load->view('Cashier/update-customer',compact('cashierinfo','data')); 
            }
            else{
                return redirect('Cashier/viewcustomer');
            }
            
        }
        else{
            return redirect("Cashier/login");
        }
                
	}
    
    public function addcustomer()
	{   
        if($this->session->userdata('Cashier_id')){
            $id=$this->session->userdata('Cashier_id');
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
                return redirect('Cashier/addcustomer/');
            }
            else{
            $cashierinfo=$this->Cashier->getCashierData($id);
            $this->load->view('Cashier/add-customer',compact('cashierinfo'));
            }
        }
        else{
            return redirect("Cashier/login");
        }
                
	}
    
    
    
    public function viewcoupon()
	{   
        if($this->session->userdata('Cashier_id')){
            $id=$this->session->userdata('Cashier_id');
            $cashierinfo=$this->Cashier->getCashierData($id);
            $data=$this->Cashier->getCoupons();
            $this->load->view('Cashier/view-coupon',compact('cashierinfo','data')); 
        }
        else{
            return redirect("Cashier/login");
        }
                
	}
    
    public function generateInvoice($invoice_id)
	{   
        if($this->session->userdata('Cashier_id')){
            $this->load->library("Pdf");
            date_default_timezone_set('Asia/Kolkata');
            $data=$this->Cashier->getInvoiceData($invoice_id);
            if($data['info']->total_price>0){
            if($this->load->view('Cashier/generate-invoice',compact('data'))){
            $data=array(
                'status'=>1,
                'invoice'=>base_url('assets/invoices/'.$invoice_id.'.pdf')
            );
            $this->Cashier->updateOrder($data,$invoice_id);
            $this->setFlashMessage("alert-success","Invoice Generated Successfully");
            }
            }
            return redirect('Cashier/detailbill/'.$invoice_id);
            }
        else{
                return redirect("Cashier/login");
            }
                
	}
    
    public function profile()
	{   
        if($this->session->userdata('Cashier_id')){
            $id=$this->session->userdata('Cashier_id');
            $cashierinfo=$this->Cashier->getCashierData($id);
            $data=$this->Cashier->get_profile_data($id);
            $this->load->view('Cashier/profile',compact('cashierinfo','data')); 
        }
        else{
            return redirect("manager/login");
        }
                
	}
    
    public function logout(){
     $this->session->unset_userdata('Cashier_id');
     return redirect("Cashier");
 }
    
private function getCashierId($email){
        return $this->Cashier->getCashierId($email);
    }
    
  private function getCustomerId(){
      $id=$this->Cashier->getCustomerMaxId();
        $number = floor(substr($id,3))+1;
        $id=sprintf('%03d',$number);
       return "RSM".$id;
  }

  private function setFlashMessage($class,$message){
        $this->session->set_flashdata("feedback_message",$message);
        $this->session->set_flashdata("feedback_class",$class);
    }  

  private function getVendorId(){
        $id=$this->Cashier->getMaxId();
        $number = floor(substr($id,3))+1;
        $id=sprintf('%03d',$number);
       return "GAP".$id;
    }
    
}
?>