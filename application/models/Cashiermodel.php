<?php
class Cashiermodel extends CI_Model
{
    public function login_valid($email,$password)
    {
       $q=$this->db
                    ->where("cashier_email",$email)
                     ->get('cashier');
      if($q->num_rows()==1){
           $pass=$q->row()->cashier_password;
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
    
    public function getBills($id){
       $q=$this->db->select(['order_id','customer_id','total_price','order_date'])
                            ->from('orders')
                                ->where('cashier_id',$id)
                                    ->where('status',1)
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
    
    public function getCustomerData($cid){
       $q=$this->db->select(['customer_name','customer_id','customer_mobile','customer_email','reward_point'])
                            ->from('customer')
                                ->where('customer_id',$cid)
                                     ->get();
            if($q->num_rows()==1){
             return $q->row();
            } 
    }
    
    public function getCustomer($id){
    //->where("`customer_id` IN (SELECT DISTINCT `customer_id` FROM `orders` WHERE `cashier_id`='".$id."')", NULL, FALSE)
       $q=$this->db->select(['customer_name','customer_id','customer_mobile','customer_email','reward_point'])
                            ->from('customer')
                                ->get();
            if($q->num_rows()>0){
             return $q->result();
            } 
    }
    
    public function getBillData($id){
        $q=$this->db->where('order_id',$id)
                        ->get('orders');
        if($q->num_rows()==1){
            $data=array($q->result());
            $q=$this->db->select(['d.order_id','d.product_id','d.batch_id','d.quantity','p.product_name','p.product_price','p.product_discount','p.discount_type','max_discount'])
                            ->from('orderdetail as d')
                                ->where('d.order_id',$id)
                                    ->join('product_info as p','p.product_id=d.product_id')
                                        ->get();
            if($q->num_rows()>0){
            array_push($data,$q->result());
            }
            return $data;
        }
    }
    
    public function getItem($pid,$bid){
       $q=$this->db->select(['p.product_id','p.product_name','p.product_price','p.product_discount','p.discount_type','p.max_discount','b.batch_id','b.product_quantity as total_quantity'])
                            ->from('product_info as p')
                                ->where('p.product_id',$pid)
                                    ->join('batch as b','b.product_id=p.product_id')
                                        ->where('b.batch_id',$bid)
                                            ->get();
            if($q->num_rows()==1){
                if($q->row()->product_id)
                    return $q->row();
                else
                    return 0;
            } 
    }
    
    public function getCashierId($email){
        $q=$this->db->select('cashier_id')
                      ->where('cashier_email',$email)
                        ->get('cashier');
        if($q->num_rows()==1){
            return $q->row()->cashier_id;
        }
    }
    
    
    
     public function getCashierData($id){
    	$q=$this->db->select(['cashier_name as name','cashier_image as image'])
    			->where('cashier_id',$id)
    			 ->get('cashier');
      if($q->num_rows()==1){
          return $q->row();
      }
    }
    
    public function verifyUser($mobile){
        $q=$this->db->where('customer_mobile',$mobile)
                            ->get('customer');
        if($q->num_rows()==1){
            return $q->row();
        }
    }
    
    public function getCouponDiscount($total){
        date_default_timezone_set('Asia/Kolkata');
        $cdate=date('Y-m-d');
        $q=$this->db->select(['coupon_id','coupon_discount','discount_type','max_redemption','max_discount'])
                        ->where('min_order_amount<=',$total)
                            ->where('valid_from<=',$cdate)
                                ->where('valid_till>=',$cdate)
                                    ->get('coupon');
        if($q->num_rows()>0){
            return $q->result();
        }
        else{
            return array();
        }
    }
    
    public function checkCouponValidity($id,$max,$cid){
        $q=$this->db->where('customer_id',$cid)
                        ->where('coupon',$id)
                            ->get('orders');
        if($q->num_rows()<$max){
            return 1;
        }
        else{
            return 0;
        }
    }
    
    public function registerUser($data){
        $this->db->insert('customer',$data); 
            return $this->db->affected_rows();
    }
    
    public function insertOrder($data){
        $this->db->insert('orders',$data); 
            return $this->db->affected_rows();
    }
    
    public function insertOrderDetail($data){
        $this->db->insert('orderdetail',$data); 
            return $this->db->affected_rows();
    }
    
    public function addRedemption($data){
        $this->db->insert('redemption',$data); 
            return $this->db->affected_rows();
    }
    
    public function getProductQuantity($pid,$bid){
       $q=$this->db->select("product_quantity")
                        ->where('batch_id',$bid)
                            ->where('product_id',$pid)
                                ->get('batch');
        if($q->num_rows()==1){
            return $q->row()->product_quantity;
        }
        else{
            return 0;
        }
    }
    
    public function getRewardCriteria($total){
       $q=$this->db->select("per_point_reward")
                        ->where('min_amount<',$total)
                            ->where('max_amount>=',$total)
                                ->get('rewards');
        if($q->num_rows()==1){
            return $q->row()->per_point_reward;
        }
        else{
            return 0;
        }
    }
    
    public function updateInventory($data,$pid,$bid){
       $this->db->where('batch_id',$bid)
                        ->where('product_id',$pid)
                            ->update('batch',$data);
        return $this->db->affected_rows();
    }
    
    public function update_order_detail($data,$pid,$bid,$oid){
       $this->db->where('batch_id',$bid)
                        ->where('product_id',$pid)
                            ->where('order_id',$oid)
                                ->update('orderdetail',$data);
        return $this->db->affected_rows();
    }
    
    public function update_order($data,$oid){
       $this->db->where('order_id',$oid)
                        ->update('orders',$data);
        return $this->db->affected_rows();
    }
    
    public function remove_order_product($pid,$bid,$oid){
       $this->db->where('batch_id',$bid)
                       ->where('product_id',$pid)
                            ->where('order_id',$oid)
                                ->delete('orderdetail');
        return $this->db->affected_rows();
    }
    
    public function count_order_item($oid){
       return $this->db->where('order_id',$oid)
                    ->count_all_results('orderdetail');
    }
    
    public function count_batch_item($pid,$bid){
        $q=$this->db->select('product_quantity')   
                    ->where('batch_id',$bid)
                       ->where('product_id',$pid)
                            ->get('batch');
        if($q->num_rows()==1){
            return $q->row()->product_quantity;
        }
    }
    
    public function updateOrder($data,$oid){
       $this->db->where('order_id',$oid)
                        ->update('orders',$data);
        return $this->db->affected_rows();
    }
    
    public function updateReward($cid,$data){
       $this->db->where('customer_id',$cid)
                        ->update('customer',$data);
        return $this->db->affected_rows();
    }
    
    public function update_customer($data,$cid){
       $this->db->where('customer_id',$cid)
                        ->update('customer',$data);
        return $this->db->affected_rows();
    }
    
    public function add_customer($data){
        $this->db->insert('customer',$data); 
            return $this->db->affected_rows();
    }
    
    public function checkUnique($mobile,$email){
        $q=$this->db->where('customer_mobile',$mobile)
                        ->count_all_results('customer');
        if($q>0){
            return "Mobile Number Already Exists";
        }
        else{
            $q=$this->db->where('customer_email',$email)
                        ->count_all_results('customer');
            if($q>0){
            return "Email Already Exists";
            }
            else{
                return 1;
            }
        }
    }
    
    public function check_unique($fname,$fvalue){
        return $this->db->where($fname,$fvalue)
                        ->count_all_results('customer');
    }
    
    public function get_profile_data($id){
        $q=$this->db->select(['cashier_id','cashier_name','cashier_email','cashier_mobile'])
                      ->where('cashier_id',$id)
                        ->get('cashier');
        if($q->num_rows()==1){
            return $q->row();
        }
    }
    
    public function updatePassword($data){
        $q=$this->db->select('cashier_password')
                    ->where('cashier_id',$data['cashier_id'])
                        ->get('cashier');
        if($q->num_rows()==1){
            if(password_verify($data['old_password'], $q->row()->cashier_password)){
                $password=password_hash($data['new_password'], PASSWORD_DEFAULT);
                $this->db->where('cashier_id',$data['cashier_id'])
                            ->update('cashier',array('cashier_password'=>$password));
                return $this->db->affected_rows();
            }
            else{
                return -1;
            }
        }
    }
    
    public function get_dashboard_data($id){
        $data=array(
            'bills'=>$this->count_bill($id),
            'users'=>$this->count_user($id),
            'sells'=>$this->count_total($id)
        );
        return $data;
    }
    
    private function count_total($id){
        $q=$this->db->select('SUM(total_price) as total')
                            ->where('cashier_id',$id)
                                ->where('status',1)
                                    ->get('orders');
        if($q->num_rows()==1){
            return $q->row()->total;
        }
        else 
            return 0;
    }
    
    private function count_bill($id){
        return $this->db->where('cashier_id',$id)
                            ->where('status',1)
                                ->count_all_results('orders');
    }
    
    private function count_user($id){
        return $this->db->select('customer_id')
                            ->distinct()
                                ->where('cashier_id',$id)
                                    ->where('status',1)
                                        ->count_all_results('orders');
    }
    
    public function getCustomerMaxId(){
       $q=$this->db->query("SELECT max(customer_id) as ID FROM `customer`");
        if($q->num_rows()>0){
            return $q->row()->ID;
        }
        else{
            return RSM000;
        }
    }
    
    public function getOrderMaxId(){
       $q=$this->db->query("SELECT max(order_id) as ID FROM `orders`");
        if($q->num_rows()>0){
            return $q->row()->ID;
        }
        else{
            return BMSRSM0000;
        }
    }
    
    public function getInvoiceData($invoice){
        $q=$this->db->select(['a.order_id','a.total_price','a.discount','a.payment_mode','a.order_time','a.order_date','b.customer_name','b.customer_mobile','b.customer_email','c.cashier_name','c.cashier_mobile','c.cashier_email'])
                              ->from('orders as a')
                                ->where('a.order_id',$invoice)
                                 ->join('customer as b','b.customer_id=a.customer_id')
                                  ->join('cashier as c','c.cashier_id=a.cashier_id')
                                    ->get();
        if($q->num_rows()>0){
            $data['info']=$q->row();
            $q=$this->db->select(['a.product_id','a.batch_id','a.quantity','b.product_name','b.product_price'])
                              ->from('orderdetail as a')
                                ->where('a.order_id',$invoice)
                                 ->join('product_info as b','b.product_id=a.product_id')
                                  ->get();
            if($q->num_rows()>0){
            $data['detail']=$q->result();
            }
        }
        return $data;
    }
    
    
}
?>