<?php
class Managermodel extends CI_Model
{
    public function login_valid($email,$password)
    {
       $q=$this->db
                    ->where("im_email",$email)
                     ->get('inventory_manager');
      if($q->num_rows()==1){
           $pass=$q->row()->im_password;
           if (password_verify($password,$pass)) {
		   return 1;
		} 
	   else {
		  return 0;
		}
        }
        else{
            return 2;
        }     

    }
    
    public function getCashiers($id){
        $q=$this->db->select(['cashier_id','cashier_name','cashier_image','cashier_mobile','cashier_email'])
                      ->where('shop_id',$id)
                        ->get('cashier');
        if($q->num_rows()>0){
            return $q->result();
        }
    }
    
    public function getBills($sid){
        $q=$this->db->select(['cashier_id','order_id','customer_id','total_price','order_date'])
                      ->where("`cashier_id` IN (SELECT `cashier_id` FROM `cashier` WHERE `shop_id`='".$sid."')", NULL, FALSE)
                        ->where('status',1)
                            ->get('orders');
        if($q->num_rows()>0){
            return $q->result();
        }
    }
    
    public function getCustomers(){
        //->where("`customer_id` IN (SELECT `customer_id` FROM `orders` WHERE `cashier_id` IN (SELECT `cashier_id` FROM `cashier` WHERE `shop_id`='".$sid."'))", NULL, FALSE)
       $q=$this->db->select(['customer_name','customer_id','customer_mobile','customer_email','reward_point'])
                            ->from('customer')
                                ->get();
            if($q->num_rows()>0){
             return $q->result();
            } 
    }
    
    public function getCoupons(){
        date_default_timezone_set('Asia/Kolkata');
        $cdate=date('Y-m-d');
       $q=$this->db->from('coupon')
                        ->where('valid_from <=',$cdate)
                            ->where('valid_till >=',$cdate)
                                 ->get();
            if($q->num_rows()>0){
             return $q->result();
            } 
    }
    
    public function getCouponData($cid){
       $q=$this->db->from('coupon')
                        ->where('coupon_id',$cid)
                            ->get();
            if($q->num_rows()>0){
             return $q->row();
            } 
    }
    
    public function getProductData($pid){
       $q=$this->db->where('product_id',$pid)
                            ->get('product_info');
            if($q->num_rows()>0){
             return $q->row();
            } 
    }
    
    public function getInventory(){
        $q=$this->db->get('product_info');
            if($q->num_rows()>0){
             return $q->result();
            } 
    }
    
    public function fetch_product(){
       $q=$this->db->select(['product_id','product_name'])
                        ->get('product_info');
            if($q->num_rows()>0){
             return $q->result();
            } 
    }
    
    public function fetch_batch($bid){
       $q=$this->db->select(['manufacturing_date','expiry_date','remark','product_quantity'])
                        ->where('batch_id',$bid)
                            ->get('batch');
            if($q->num_rows()==1){
             return $q->row();
            } 
    }
    
    public function check_unique_productid($pid){
        return $this->db->where('product_id',$pid)
                            ->count_all_results('product_info');
    }
    
    public function check_unique_batchid($bid){
        return $this->db->where('batch_id',$bid)
                            ->count_all_results('batch');
    }
    
    public function add_cashier($data){
        $this->db->insert('cashier',$data); 
            return $this->db->affected_rows();
    }
    
    public function add_coupon($data){
        $this->db->insert('coupon',$data); 
            return $this->db->affected_rows();
    }
    
    public function add_product($data){
        $this->db->insert('product_info',$data); 
            return $this->db->affected_rows();
    }
    
    public function add_batch($data){
        $this->db->insert('batch',$data); 
            return $this->db->affected_rows();
    }
    
    public function check_unique_coupon($coupon){
        return $this->db->where('coupon_id',$coupon)
                            ->count_all_results('coupon');
    }
    
    public function checkUniqueCashier($mobile,$email){
        $q=$this->db->where('cashier_mobile',$mobile)
                        ->count_all_results('cashier');
        if($q>0){
            return "Mobile Number Already Exists";
        }
        else{
            $q=$this->db->where('cashier_email',$email)
                        ->count_all_results('cashier');
            if($q>0){
            return "Email Already Exists";
            }
            else{
                return 1;
            }
        }
    }
    
    public function getCashierMaxId($shop_id){
       $q=$this->db->query("SELECT max(cashier_id) as ID FROM `cashier` WHERE `shop_id`='$shop_id'");
        if($q->num_rows()>0){
            return $q->row()->ID;
        }
        else{
            return CASH00;
        }
    }
    
     public function getBatchId($pid){
        $q=$this->db->select('batch_id')    
                        ->where('product_id',$pid)
                            ->get('batch');
            if($q->num_rows()>0){
                return $q->result();
            } 
    }
    
    public function getCustomerData($cid){
       $q=$this->db->select(['customer_name','customer_id','customer_mobile','customer_email','reward_point'])
                            ->from('customer')
                                ->where('customer_id',$cid)
                                     ->get();
            if($q->num_rows()==1){
             return $q->row();
            } 
    }
    
    public function getCashierData($cid){
       $q=$this->db->select(['cashier_name','cashier_id','cashier_mobile','cashier_email'])
                            ->from('cashier')
                                ->where('cashier_id',$cid)
                                     ->get();
            if($q->num_rows()==1){
             return $q->row();
            } 
    }
    
    public function update_cashier($data,$cid){
       $this->db->where('cashier_id',$cid)
                        ->update('cashier',$data);
        return $this->db->affected_rows();
    }
    
    public function update_product($data,$pid){
       $this->db->where('product_id',$pid)
                        ->update('product_info',$data);
        return $this->db->affected_rows();
    }
    
    public function update_batch($data,$bid){
       $this->db->where('batch_id',$bid)
                        ->update('batch',$data);
        return $this->db->affected_rows();
    }
    
    public function update_coupon($data,$cid){
       $this->db->where('coupon_id',$cid)
                        ->update('coupon',$data);
        return $this->db->affected_rows();
    }
    
    public function get_statistics($sdate,$edate){
        $q=$this->db->select(['count(distinct customer_id) as customer','count(order_id) as bills','sum(total_price) as tamount','sum(discount) as discount','count(distinct cashier_id) as cashier'])
                        ->where('order_date>=',$sdate)
                                ->where('order_date<=',$edate)
                                    ->where('status',1)
                                        ->get('orders');
        if($q->num_rows()==1){
            $result=$this->get_orderdetail_stats($sdate,$edate);
            return $data=array(
                'bills'=>$q->row()->bills,
                'amount'=>$q->row()->tamount,
                'discount'=>$q->row()->discount,
                'tax'=>floor(.18*$q->row()->tamount),
                'income'=>$q->row()->tamount-$q->row()->discount+floor(.18*$q->row()->tamount),
                'quantity'=>$result->quantity,
                'products'=>$result->products,
                'users'=>$q->row()->customer,
                'cashiers'=>$q->row()->cashier
            );
        }
    }
    
    private function get_orderdetail_stats($sdate,$edate){
        $q=$this->db->select(['order_id'])
                        ->where('order_date>=',$sdate)
                                ->where('order_date<=',$edate)
                                    ->where('status',1)
                                        ->get('orders');
        if($q->num_rows()>0){
            foreach($q->result() as $row)
                    $ids[]=$row->order_id;
            $q=$this->db->select(['sum(quantity) as quantity','count(distinct product_id) as products'])
                        ->where_in('order_id',$ids)
                            ->get('orderdetail');
            if($q->num_rows()==1){
                return $q->row();
            }
        }
    }
    
    public function get_graphs_data($sdate,$edate){
        $q=$this->db->select(['order_id'])
                        ->where('order_date>=',$sdate)
                                ->where('order_date<=',$edate)
                                    ->where('status',1)
                                        ->get('orders');
        if($q->num_rows()>0){
            foreach($q->result() as $row)
                    $ids[]=$row->order_id;
            $q=$this->db->select(['sum(d.quantity) as quantity','p.product_name'])
                            ->from('orderdetail as d')
                                ->where_in('order_id',$ids)
                                    ->group_by('d.product_id')
                                        ->join('product_info as p','p.product_id=d.product_id')
                                            ->get();
            if($q->num_rows()>0){
                return $q->result();
            }
        }
    }
    
    public function get_dashboard_data(){
        $data=array(
            'bills'=>$this->count_bills(),
            'customers'=>$this->count_customers(),
            'cashiers'=>$this->count_cashiers()
        );
        return $data;
    }
    
    private function count_cashiers(){
        return $this->db->count_all_results('cashier');
    }
    
    private function count_bills(){
        return $this->db->where('status',1)
                                ->count_all_results('orders');
    }
    
    private function count_customers(){
        return $this->db->count_all_results('customer');
    }
    
    public function check_unique($fname,$fvalue){
        return $this->db->where($fname,$fvalue)
                        ->count_all_results('cashier');
    }
    
    public function getManagerId($email){
        $q=$this->db->select('im_id')
                      ->where('im_email',$email)
                        ->get('inventory_manager');
        if($q->num_rows()==1){
            return $q->row()->im_id;
        }
    }
    
    public function getShopId($id){
        $q=$this->db->select('shop_id')
                      ->where('im_id',$id)
                        ->get('inventory_manager');
        if($q->num_rows()==1){
            return $q->row()->shop_id;
        }
    }
    
    public function get_profile_data($id){
        $q=$this->db->select(['im_id','im_name','im_email','im_mobile'])
                      ->where('im_id',$id)
                        ->get('inventory_manager');
        if($q->num_rows()==1){
            return $q->row();
        }
    }
    
    public function updatePassword($data){
        $q=$this->db->select('im_password')
                    ->where('im_id',$data['manager_id'])
                        ->get('inventory_manager');
        if($q->num_rows()==1){
            if(password_verify($data['old_password'], $q->row()->im_password)){
                $password=password_hash($data['new_password'], PASSWORD_DEFAULT);
                $this->db->where('im_id',$data['manager_id'])
                            ->update('inventory_manager',array('im_password'=>$password));
                return $this->db->affected_rows();
            }
            else{
                return -1;
            }
        }
    }
    
     public function getManagerData($id){
    	$q=$this->db->select(['im_name as name','im_image as image'])
    			->where('im_id',$id)
    			 ->get('inventory_manager');
      if($q->num_rows()==1){
          return $q->row();
      }
    }
    
    
}
?>