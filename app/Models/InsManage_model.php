<?php
namespace App\Models;
use CodeIgniter\Model;
class InsManage_model extends Model
{
    public $admissionsTbl;
    public $qualificationTbl;
    public $admissionscoursefeeTbl;
    public $coursesTbl;
    public $insbatchTbl;
    public $randomcodeTbl;
    public $admissionslogTbl;
    public $admspaidinstTbl;
    public $admissionscanceledTbl;
    public $adminTbl;
    public $cbunistudentTbl;
    public function __construct()
    {
      $this->db = \Config\Database::connect();
      $this->admissionsTbl = 'tbl_admissions';
      $this->qualificationTbl = 'tbl_qualification';
      $this->admissionscoursefeeTbl = 'tbl_admissions_coursefee';
      $this->coursesTbl = 'tbl_course_franchise';
      $this->insbatchTbl = 'tbl_insbatch';
      $this->randomcodeTbl = 'tbl_random_code';
      $this->admissionslogTbl = 'tbl_admissions_log';
      $this->admspaidinstTbl = 'tbl_adms_paid_inst';
      $this->admissionscanceledTbl 	= 'tbl_admissions_canceled';
      $this->adminTbl = 'tbl_admin';
      $this->cbunistudentTbl = 'tbl_cb_uni_student';

    }
    public function getLastGrade(){
      $builder = $this->db->table('tbl_grade');
      $builder->select('*');
      $builder->where('marks_to', 100);
      $query = $builder->get();
      $result = $query->getRow();
      return $result->grade ?? 'N/A';
    }
    public function get_count_student_list(){
      $builder = $this->db->table($this->admissionsTbl);
      $query = $builder->get();
      $result = $query->getNumRows();
      //print_r($result);exit;
      return $result;
    }
    public function get_student_basic_details($idsArr=[]){
      $result = [];
      if(!empty($idsArr)){
        $builder = $this->db->table($this->admissionsTbl.' stu');
        $builder->select('stu.*,q.qualification qly_title');
        $builder->join($this->qualificationTbl.' q', 'stu.qualification = q.qly_id','left');
        $builder->groupStart();
        foreach($idsArr as $k=>$id){
          if($k<1){
            $builder->where('stu.stu_id', $id);
          }else{
            $builder->orWhere('stu.stu_id', $id);
          }
        }
        $builder->groupEnd();
        $query = $builder->get();
        $result = $query->getResult();
      }
      return $result;
    }
    public function get_students_list($id=false){ 
      $builder = $this->db->table($this->admissionsTbl.' stu');
      $builder->select('stu.*,q.qualification qly_title');
      $builder->join($this->qualificationTbl.' q', 'stu.qualification = q.qly_id','left');
      $builder->join($this->admissionscoursefeeTbl.' cf', 'stu.stu_id = cf.stu_id','left');
      // $this->db->join($this->insbatchTbl.' b', 'stu.batch_id = b.batch_id','left');
      if($id != false){
        $builder->where('stu.stu_id', $id);
      }
      if(isset($_GET['s']) && !empty($_GET['s'])){
          $builder->groupStart();
            $builder->like('stu.stu_name', $_GET['s']);
            $builder->orLike('stu.phone1', $_GET['s']);
            $builder->orLike('stu.phone2', $_GET['s']);
            $builder->orLike('stu.email', $_GET['s']);
          $builder->groupEnd();
      }
      if(isset($_GET['batch']) && !empty($_GET['batch'])){
          $builder->groupStart();
          foreach($_GET['batch'] as $key=>$batch_id){
            if($key == 0){
              $builder->where('cf.batch_id', $batch_id);
            }else{
              $builder->orWhere('cf.batch_id', $batch_id);
            }
          }
          $builder->groupEnd();
      }
      if(isset($_GET['course']) && !empty($_GET['course'])){
          $builder->groupStart();
          foreach($_GET['course'] as $key=>$course_id){
            if($key == 0){
              $builder->where('cf.course_id', $course_id);
            }else{
              $builder->orWhere('cf.course_id', $course_id);
            }
          }
          $builder->groupEnd();
      }
      $builder->orderBy('stu.stu_id','DESC');
      $builder->groupBy('stu.stu_id');
      $query = $builder->get();
      if($id != false){
        $result = $query->getRow();
      }else{
        $result = $query->getResult();
      }
      // echo $this->db->getLastQuery(); exit;
      return $result;
    }
    public function get_students_course_list($id=false){ 
      $builder = $this->db->table($this->admissionscoursefeeTbl.' acf');
      $builder->select('acf.*,c.course_cat,c.c_f_name,b.batch_name,b.time_from');
      $builder->join($this->coursesTbl.' c', 'acf.course_id = c.cid','left');
      $builder->join($this->insbatchTbl.' b', 'acf.batch_id = b.batch_id','left');
      // $this->db->join($this->qualificationTbl.' q', 'stu.qualification = q.qly_id','left');
      if($id != false){
        $builder->where('acf.stu_id', $id);
      }
      $builder->orderBy('acf.id','DESC');
      $query = $builder->get();
      $result = $query->getResult();
      //print_r($result);exit;
      return $result;
    }
    public function is_exist_code($code){
      $builder = $this->db->table($this->randomcodeTbl);
      $builder->select('*');
      $builder->where('code', $code);
      $query = $builder->get();
      $result = $query->getNumRows();
      //print_r($result);exit;
      return $result;
    }
    public function get_one_admissions_coursefee($id=false){ //modified
      $builder = $this->db->table($this->admissionscoursefeeTbl.' acf');
      $builder->select('acf.*,c.c_f_name,b.batch_name,b.time_from');
      $builder->join($this->coursesTbl.' c', 'acf.course_id = c.cid','left');
      $builder->join($this->insbatchTbl.' b', 'acf.batch_id = b.batch_id','left');
      // $this->db->join($this->qualificationTbl.' q', 'stu.qualification = q.qly_id','left');
      if($id != false){
        $builder->where('acf.id', $id);
      }
      $query = $builder->get();
      $result = $query->getRow();
      //print_r($result);exit;
      return $result;
  }
  public function get_paid_installment_log_details($id){ 
    $builder = $this->db->table($this->admissionslogTbl.' al');
    $builder->select('al.*,c.c_f_name,b.batch_name');
    $builder->join($this->coursesTbl.' c', 'al.course_id = c.cid','left');
    $builder->join($this->insbatchTbl.' b', 'al.batch_id = b.batch_id','left');
    $builder->where('al.course_fee_id', $id);
    $builder->orderBy('al.log_id', 'DESC');
    $query = $builder->get();
    $result = $query->getResult();
    // print_r($result);exit;
    return $result;
  }
  public function get_paid_ins_list_by_coursefee_id($id){
    $builder = $this->db->table($this->admspaidinstTbl.' pi');
    $builder->select('pi.*');
    $builder->where('pi.course_fee_id', $id);
    $builder->orderBy('pi.inst_id','DESC');
    $query = $builder->get();
    $result = $query->getResult();
    return $result;
  }
  public function get_cancel_students_list($id=false){ //modified
    $builder = $this->db->table($this->admissionscoursefeeTbl.' cf');
    $builder->select('cf.*,stu.stu_name,stu.f_name,stu.stu_image,stu.stu_reg_no,stu.stu_roll_no,stu.dob,stu.age,stu.phone1,stu.phone2,stu.email,stu.co_address,stu.p_address,stu.cancelation_date,c.c_f_name,b.batch_name,b.time_from,q.qualification qly_title');
    $builder->join($this->admissionsTbl.' stu', 'cf.stu_id = stu.stu_id','left');
    $builder->join($this->coursesTbl.' c', 'cf.course_id = c.cid','left');
    $builder->join($this->insbatchTbl.' b', 'cf.batch_id = b.batch_id','left');
    $builder->join($this->qualificationTbl.' q', 'stu.qualification = q.qly_id','left');
    $builder->groupStart();
      $builder->where('cf.status', '3');
    $builder->groupEnd();
    if($id != false){
      $builder->where('cf.id', $id);
    }
    /* if(isset($_GET['s']) && !empty($_GET['s'])){
        $this->db->group_start();
          $this->db->like('stu.stu_name', $_GET['s']);
          $this->db->or_like('stu.phone1', $_GET['s']);
          $this->db->or_like('stu.phone2', $_GET['s']);
          $this->db->or_like('stu.email', $_GET['s']);
        $this->db->group_end();
    }
    if(isset($_GET['batch']) && !empty($_GET['batch'])){
        $this->db->group_start();
        foreach($_GET['batch'] as $key=>$batch_id){
          if($key == 0){
            $this->db->where('stu.batch_id', $batch_id);
          }else{
            $this->db->or_where('stu.batch_id', $batch_id);
          }
        }
        $this->db->group_end();
    }
    if(isset($_GET['course']) && !empty($_GET['course'])){
        $this->db->group_start();
        foreach($_GET['course'] as $key=>$course_id){
          if($key == 0){
            $this->db->where('stu.course_id', $course_id);
          }else{
            $this->db->or_where('stu.course_id', $course_id);
          }
        }
        $this->db->group_end();
    }*/
    $builder->orderBy('cf.id','DESC');
    $query = $builder->get();
    if($id != false){
      $result = $query->getRow();
    }else{
      $result = $query->getResult();
    }
    //print_r($result);exit;
    return $result;
  }
  public function get_canceled_students_list($id=false){ // modified
    $builder = $this->db->table($this->admissionscanceledTbl.' ac');
    $builder->select('ac.*,stu.stu_name,stu.f_name,stu.stu_image,stu.stu_reg_no,stu.stu_roll_no,stu.dob,stu.age,stu.phone1,stu.phone2,stu.email,stu.co_address,stu.p_address,stu.beneficiary_name,stu.beneficiary_mob_no,stu.bank_name,stu.branch_name,stu.bank_ac_no,stu.ifsc_code,stu.cancelation_date,c.c_f_name,b.batch_name,b.time_from,q.qualification qly_title,u.name return_confirm_name');
    $builder->join($this->admissionsTbl.' stu', 'ac.stu_id = stu.stu_id','left');
    $builder->join($this->coursesTbl.' c', 'ac.course_id = c.cid','left');
    $builder->join($this->insbatchTbl.' b', 'ac.batch_id = b.batch_id','left');
    $builder->join($this->qualificationTbl.' q', 'stu.qualification = q.qly_id','left');
    $builder->join($this->adminTbl.' u', 'ac.return_confirm_by = u.user_id','left');
    if($id != false){
      $builder->where('ac.id', $id);
    }
    $builder->orderBy('ac.id','DESC');
    $query = $builder->get();
    if($id != false){
      $result = $query->getRow();
    }else{
      $result = $query->getResult();
    }
    //print_r($result);exit;
    return $result;
  }
  public function get_feereport_list(){
    $builder = $this->db->table($this->admspaidinstTbl.' pi');
    $builder->select('pi.*,cf.payment_type,cf.stu_id,stu.stu_name,stu_image,stu.phone1,stu.stu_roll_no,c.c_f_name,b.batch_name');
    $builder->join($this->admissionscoursefeeTbl.' cf','pi.course_fee_id = cf.id','left');
    $builder->join($this->admissionsTbl.' stu','cf.stu_id = stu.stu_id','left');
    $builder->join($this->coursesTbl.' c', 'cf.course_id = c.cid','left');
    $builder->join($this->insbatchTbl.' b', 'cf.batch_id = b.batch_id','left');
    if(isset($_GET['date']) && !empty($_GET['date'])){
      $builder->groupStart();
        $builder->where('DATE(pi.paid_date) >=', $_GET['date']);
      $builder->groupEnd();
    }
    if(isset($_GET['dateto']) && !empty($_GET['dateto'])){
      $builder->groupStart();
        $builder->where('DATE(pi.paid_date) <=', $_GET['dateto']);
      $builder->groupEnd();
    }
    if(isset($_GET['batch']) && !empty($_GET['batch'])){
      $builder->groupStart();
      foreach($_GET['batch'] as $key=>$batch_id){
        if($key == 0){
          $builder->where('cf.batch_id', $batch_id);
        }else{
          $builder->orWhere('cf.batch_id', $batch_id);
        }
      }
      $builder->groupEnd();
    }
    if(isset($_GET['course']) && !empty($_GET['course'])){
      $builder->groupStart();
        foreach($_GET['course'] as $key=>$course_id){
          if($key == 0){
            $builder->where('cf.course_id', $course_id);
          }else{
            $builder->orWhere('cf.course_id', $course_id);
          }
        }
        $builder->groupEnd();
    }
    // $this->db->group_start();
    //   $this->db->where('il.credit_status', '1');
    //   $this->db->or_where('il.credit_status', '2');
    // $this->db->group_end();
    $builder->orderBy('pi.inst_id','DESC');
    $builder->groupBy('pi.inst_id');
    $query = $builder->get();
    $result = $query->getResult();
    // echo '<pre>'; print_r($result); exit;
    return $result;
  }
  public function get_premium_student($date){
    $builder = $this->db->table($this->admissionscoursefeeTbl);
    $builder->groupStart();
      $builder->where('next_paid_date <=', $date);
      // $this->db->where('payable_amount >', 1);
      $builder->where('payment_type', 'installment');
      $builder->where('status', '1');
    $builder->groupEnd();
    $query = $builder->get();
    $result = $query->getResult();
    //print_r($result);exit;
    return $result;
  }
  public function get_count_stupayreport_list(){
    $builder = $this->db->table($this->admissionscoursefeeTbl);
    $builder->groupStart();
      $builder->where('status', 1);
      $builder->where('MONTH(next_paid_date) <=', date('m'));
      $builder->where('YEAR(next_paid_date)', date('Y'));
    $builder->groupEnd();
    $query = $builder->get();
    $result = $query->num_rows();
    //print_r($result);exit;
    return $result;
  }
  public function get_stupayreport_list(){
    $builder = $this->db->table($this->admissionscoursefeeTbl.' cf');
    $builder->select('cf.*,stu.stu_name,stu.stu_image,stu.phone1,stu.is_whatsapp_ph1,stu.stu_roll_no,c.c_f_name,b.batch_name');
    $builder->join($this->admissionsTbl.' stu','cf.stu_id = stu.stu_id','left');
    $builder->join($this->coursesTbl.' c', 'cf.course_id = c.cid','left');
    $builder->join($this->insbatchTbl.' b', 'cf.batch_id = b.batch_id','left');
    $builder->groupStart();
    $builder->where('cf.status', 1);
    $builder->where('stu.status', 1);
    $builder->groupEnd();
    $builder->groupStart();
      $builder->where('MONTH(cf.next_paid_date) <=', date('m'));
      $builder->where('YEAR(cf.next_paid_date) <=', date('Y'));
      $builder->where('cf.payable_amount >=', 1);
    $builder->groupEnd();
    if(isset($_GET['s']) && !empty($_GET['s'])){
      $builder->groupStart();
        $builder->like('stu.stu_name', $_GET['s']);
        $builder->orLike('stu.phone1', $_GET['s']);
        $builder->orLike('stu.phone2', $_GET['s']);
        //$this->db->or_like('stu.email', $_GET['s']);
      $builder->groupEnd();
    }
    if(isset($_GET['batch']) && !empty($_GET['batch'])){
      $builder->groupStart();
      foreach($_GET['batch'] as $key=>$batch_id){
        if($key == 0){
          $builder->where('cf.batch_id', $batch_id);
        }else{
          $builder->orWhere('cf.batch_id', $batch_id);
        }
      }
      $builder->groupEnd();
    }
    if(isset($_GET['course']) && !empty($_GET['course'])){
        $builder->groupStart();
        foreach($_GET['course'] as $key=>$course_id){
          if($key == 0){
            $builder->where('cf.course_id', $course_id);
          }else{
            $builder->orWhere('cf.course_id', $course_id);
          }
        }
        $builder->groupEnd();
    }
    $builder->orderBy('cf.id', 'DESC');
    $query = $builder->get();
    //echo $this->db->last_query(); exit;
    $result = $query->getResult();
    //echo '<pre>'; print_r($result); exit;
    return $result;
  }
  public function get_one_coursefee($id){
    $builder = $this->db->table($this->admissionscoursefeeTbl.' cf');
    $builder->select('cf.*,stu.stu_reg_no,stu.stu_roll_no,stu.stu_name,stu_image,stu.phone1,stu.phone2,c.c_f_name,b.batch_name');
    $builder->join($this->admissionsTbl.' stu','cf.stu_id = stu.stu_id','left');
    $builder->join($this->coursesTbl.' c', 'cf.course_id = c.cid','left');
    $builder->join($this->insbatchTbl.' b', 'cf.batch_id = b.batch_id','left');
    $builder->where('cf.id', $id);
    $query = $builder->get();
    $result = $query->getRow();
    //print_r($result);exit;
    return $result;
  }
  public function get_paid_installment($coursefee_id){
    $builder = $this->db->table($this->admspaidinstTbl);
    $builder->select('*');
    $builder->where('course_fee_id', $coursefee_id);
    $builder->orderBy('inst_id', 'DESC');
    $query = $builder->get();
    $result = $query->getResult();
    //print_r($result);exit;
    return $result;
  }
  public function get_completed_students_list($id=false, $status=null){ //modified
    $builder = $this->db->table($this->admissionscoursefeeTbl.' cf');
    $builder->select('cf.*,stu.stu_name,stu.f_name,stu.m_name,stu.stu_image,stu.stu_reg_no,stu.stu_roll_no,stu.dob,stu.age,stu.phone1,stu.phone2,stu.email,stu.co_address,stu.p_address,stu.cancelation_date,c.course_duration,c.c_f_name,c.course_cat,b.batch_name,b.time_from,q.qualification qly_title');
    $builder->join($this->admissionsTbl.' stu', 'cf.stu_id = stu.stu_id','left');
    $builder->join($this->coursesTbl.' c', 'cf.course_id = c.cid','left');
    $builder->join($this->insbatchTbl.' b', 'cf.batch_id = b.batch_id','left');
    $builder->join($this->qualificationTbl.' q', 'stu.qualification = q.qly_id','left');
    $builder->groupStart();
      if($status != null){
        $builder->where('cf.status', $status);
      }else{
        $builder->where('cf.status', 2);
      }
    $builder->groupEnd();
    if($id != false){
      $builder->where('cf.id', $id);
    }
    if(isset($_GET['s']) && !empty($_GET['s'])){
      $builder->groupStart();
        $builder->like('stu.stu_name', $_GET['s']);
        $builder->orLike('stu.phone1', $_GET['s']);
        $builder->orLike('stu.phone2', $_GET['s']);
        $builder->orLike('stu.email', $_GET['s']);
      $builder->groupEnd();
    }
    if(isset($_GET['batch']) && !empty($_GET['batch'])){
        $builder->groupStart();
        foreach($_GET['batch'] as $key=>$batch_id){
          if($key == 0){
            $builder->where('cf.batch_id', $batch_id);
          }else{
            $builder->orWhere('cf.batch_id', $batch_id);
          }
        }
        $builder->groupEnd();
    }
    if(isset($_GET['course']) && !empty($_GET['course'])){
        $builder->groupStart();
        foreach($_GET['course'] as $key=>$course_id){
          if($key == 0){
            $builder->where('cf.course_id', $course_id);
          }else{
            $builder->orWhere('cf.course_id', $course_id);
          }
        }
        $builder->groupEnd();
    }
    
    $builder->orderBy('cf.id','DESC');
    $query = $builder->get();
    if($id != false){
      $result = $query->getRow();
    }else{
      $result = $query->getResult();
    }
    //print_r($result);exit;
    return $result;
  }
}