<?php
namespace App\Models;
use CodeIgniter\Model;
class Member_model extends Model
{
    public $memberTbl;
    public $studentsTbl;
    public $coursesTbl;
    public $citiesTbl;
    public $statesTbl;
    public $studentsfranchiseTbl;
    public $coursefranchiseTbl;
    public $moduleTbl;
    public $walletlogTbl;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->memberTbl = 'tbl_members';
        $this->studentsTbl = 'tbl_students_referal';
        $this->coursesTbl = 'tbl_courses';
        $this->citiesTbl = 'cities';
        $this->statesTbl = 'states';
        $this->studentsfranchiseTbl = 'tbl_students_franchise';
        $this->coursefranchiseTbl = 'tbl_course_franchise';
        $this->moduleTbl = 'tbl_module';
        $this->walletlogTbl = 'tbl_wallet_log';

    }
    public function isvalidate($phone){
        $builder = $this->db->table($this->memberTbl);
        $builder->where('phone', $phone);
        $builder->where('status', 1);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function getAllStudentRecord(){
        $builder = $this->db->table($this->studentsTbl.' st');
        $builder->select('st.*, c.course_full_name');
        $builder->join($this->coursesTbl.' c', 'st.course_id = c.course_id', 'left');
        $builder->where('member_id', session('m_id'));
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function get_num_of_students_by_status($status=null){
        $builder = $this->db->table($this->studentsTbl);
        if($status != null){
            $builder->where('status', $status);
        }
        $builder->where('member_id', session('m_id'));
        $query = $builder->get();
        $result = $query->getNumRows();
        return $result;
    }
    public function get_modules($cid){
        $builder = $this->db->table($this->moduleTbl);
        $builder->select('*');
        $builder->groupStart();
            $builder->where('status', 1);
            $builder->where('cid', $cid);
        $builder->groupEnd();
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    /*public function is_exist_code($cust_code){
        $builder = $this->db->table($this->customerTbl);
        $builder->select('*');
        $builder->where('cust_code', $cust_code);
        $query = $builder->get();
        $result = $query->getRow();
        if(empty($result)){
            return $cust_code;
        }else{
            return 0;
        }
    }
    public function get_cities($state_id = false){
        $builder = $this->db->table($this->cityTbl);

        if($state_id){
            $builder->where('state_id',$state_id);
        }
        $builder->where('status','Active');
        $builder->orderBy('name', 'ASC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function get_countries(){
        $builder = $this->db->table($this->countryTbl);
        $builder->where('status', 1);
        $builder->orderBy('countries_name', 'ASC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function get_state(){
        $builder = $this->db->table($this->stateTbl);
        $builder->where('status', 'Active');
        $builder->orderBy('state_title', 'ASC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    /*public function get_address($cust_id)
    {
        $builder = $this->db->table($this->purchaselistTbl.' pl');
        $builder->select('pl.*');
        $builder->where('pl.user_id', $cust_id);
        $builder->where('pl.use_next_time', '1');
        $builder->orderBy('pl.pl_id', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }*/
    /*public function get_cart_data($whereArr){
        $builder = $this->db->table($this->cartTbl);
        $builder->where($whereArr);
        $query = $builder->get();
        $result = $query->getResult();
        return $result; 
    }
    public function get_shipping_address($cust_id){
        $builder = $this->db->table($this->addressTbl.' s');
        $builder->select('s.*, c.name cityname, st.state_title statename');
        $builder->join($this->cityTbl.' c','s.city = c.id','left');
        $builder->join($this->stateTbl.' st','s.state = st.state_id','left');
        // $builder->join($this->countryTbl.' cn','s.country = cn.countries_id','left');
        $builder->where('s.uid', $cust_id);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function get_order_list($cust_id){
        $builder = $this->db->table($this->productorderTbl.' po');
        $builder->select('po.*');
        //$builder->join($this->cityTbl.' c','s.city = c.id','left');
        //$builder->join($this->stateTbl.' st','s.state = st.state_id','left');
        //$builder->join($this->countryTbl.' cn','s.country = cn.countries_id','left');
        $builder->where('po.user_id', $cust_id);
        $builder->orderBy('po.po_id','DESC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function get_cart_items($cart_ids){
        $builder = $this->db->table($this->cartTbl);
        foreach(explode(',',$cart_ids) as $key=>$cart_id){
            if($key < 1)
                $builder->where('cart_id', $cart_id);
            else
                $builder->orWhere('cart_id', $cart_id);
        }
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function get_order_details($po_id){
        $builder = $this->db->table($this->productorderTbl.' po');
        $builder->select('po.*,pt.payment_type,shi.name,shi.email, shi.phone, shi.address delivery_add, c.name cityname');
        $builder->join($this->paymentTransactionTbl.' pt','po.po_id = pt.po_id','left');
        $builder->join($this->purchaselistTbl.' pl','po.order_id = pl.order_id','left');
        $builder->join($this->addressTbl.' shi','pl.shi_id = shi.ua_id','left');
        $builder->join($this->cityTbl.' c','shi.city = c.id','left');
        $builder->where('po.po_id', $po_id);
        $query = $builder->get();
        $result = $query->getRow();
        //print_r($result);exit;
        return $result;
    }
    public function get_purchase_item_from_cart($cart_ids){
        $cartIdsArr = explode(',', $cart_ids);
        if(!empty($cartIdsArr)){
            $builder = $this->db->table($this->cartTbl);
            $builder->select('*');
            foreach($cartIdsArr as $key=>$cart_id){
                if($key < 1){
                    $builder->where('cart_id', $cart_id);
                }else{
                    $builder->orWhere('cart_id', $cart_id);
                }
            }
            $query = $builder->get();
            $result = $query->getResult();
            return $result;
        }else{
            return FALSE;
        }
    }
    public function get_stock_details($cart_id){
        $builder = $this->db->table($this->cartTbl.' cart');
        $builder->select('cart.*,pcv.c_stock stock,pcv.id proattrcvid');
        $builder->join($this->productattrconfigvalueTbl.' pcv','cart.proattrconfigval_id=pcv.id','left');
        $builder->where('cart.cart_id', $cart_id);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function get_all_benefit($cust_id){
        $builder = $this->db->table($this->customerbenefitTbl.' cb');
        $builder->select('cb.*,po.order_id,po.order_date,cu.fname,cu.lname');
        $builder->join($this->productorderTbl.' po','cb.po_id=po.po_id','left');
        $builder->join($this->customerTbl.' cu','cb.benefit_from_cust_id=cu.cust_id','left');
        $builder->where('cb.user_id', $cust_id);
        $builder->orderBy('cb.id','desc');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }*/ 
}