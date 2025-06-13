<?php
namespace App\Models;
use CodeIgniter\Model;
class Examination_model extends Model
{
    public $examscheduleTbl;
    public $studentsFranchiseTbl;
    public $examineeTbl;
    public $questionbankTbl;

    // public $adminTbl;
    // public $rolePrivilegeTbl;
    // public $contactusTbl;
    // public $coursesTbl;
    // public $insenquiry;
    // public $whatsappreplylogTbl;
    // public $membersTbl;
    // public $bankdetailsTbl;
    // public $studentsreferalTbl;
    // public $blogfaqTbl;
    // public $courseFranchiseTbl;
    // public $citiesTbl;
    // public $statesTbl;
    
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        date_default_timezone_set('Asia/Kolkata');
        $this->examscheduleTbl = 'tbl_exam_schedule';
        $this->studentsFranchiseTbl = 'tbl_students_franchise';
        $this->examineeTbl = 'tbl_examinee';
        $this->questionbankTbl = 'tbl_question_bank';

        // $this->adminTbl = 'tbl_admin';
        // $this->rolePrivilegeTbl = 'tbl_role_privilege';
        // $this->contactusTbl = 'tbl_contact_us';
        // $this->coursesTbl = 'tbl_courses';
        // $this->insenquiry = 'tbl_ins_enquiry';
        // $this->whatsappreplylogTbl = 'tbl_whatsapp_reply_log';
        // $this->membersTbl = 'tbl_members';
        // $this->bankdetailsTbl = 'tbl_bank_details';
        // $this->studentsreferalTbl = 'tbl_students_referal';
        // $this->blogfaqTbl = 'tbl_blog_faq';

        // $this->courseFranchiseTbl = 'tbl_course_franchise_'.session('db_suffix');
        // $this->citiesTbl = 'cities';
        // $this->statesTbl = 'states';
    }
    
    public function get_exam_schedule($id=null){
        $builder = $this->db->table($this->examscheduleTbl);
        $builder->select('*');
        // $builder->join($this->rolePrivilegeTbl.' rp','u.privilege_id=rp.privilege_id','left');
        $builder->groupStart();
            $builder->where('id', $id);
            $builder->where('date >=', date('Y-m-d'));
            $builder->where('status', 1);
        $builder->groupEnd();
        $query = $builder->get();
        $result = $query->getRow();
        // print_r($result); exit;
        return $result;
    }
    public function get_examinee($exsch_id,$reg_no, $dob){
        $builder = $this->db->table($this->examineeTbl.' e');
        $builder->select('e.*');
        $builder->join($this->studentsFranchiseTbl.' sf','e.frst_id=sf.frst_id','left');
        $builder->groupStart();
            $builder->where('e.exsch_id', $exsch_id);
        $builder->groupEnd();
        $builder->groupStart();
            $builder->where('sf.is_examinee', 1);
            $builder->where('sf.reg_no', $reg_no);
            $builder->where('sf.dob', $dob);
        $builder->groupEnd();
        $query = $builder->get();
        $result = $query->getRow();
        
        return $result;
    }
    public function get_examinee_full_details($id, $exsch_id){
        $builder = $this->db->table($this->examineeTbl.' e');
        $builder->select('e.*,sf.frstu_name,sf.photo,sf.reg_no');
        $builder->join($this->studentsFranchiseTbl.' sf','e.frst_id=sf.frst_id','left');
        $builder->groupStart();
            $builder->where('e.exsch_id', $exsch_id);
            $builder->where('e.id', $id);
        $builder->groupEnd();
        $builder->groupStart();
            $builder->where('sf.is_examinee', 1);
        $builder->groupEnd();
        $query = $builder->get();
        $result = $query->getRow();
        
        return $result;
    }
    public function get_questions($course_ids=null, $limit=null, $existQues=null){
        $result = array();
        if($course_ids != null){
            $course_ids = explode(',',$course_ids);
            $builder = $this->db->table($this->questionbankTbl);
            $builder->select('*');
            $builder->groupStart();
            foreach($course_ids as $k=>$course_id){
                if($k < 1){
                    $builder->where('FIND_IN_SET('.$course_id.', course_ids)');
                }else{
                    $builder->orWhere('FIND_IN_SET('.$course_id.', course_ids)');
                }
            }
                $builder->groupStart();
                    $builder->where('status', 1);
                    
                $builder->groupEnd();
            $builder->groupEnd();
            if($existQues != null){
                $builder->groupStart();
                foreach(explode(',', $existQues) as $k=>$qno){
                    $builder->where('qno !=', $qno);
                }
                $builder->groupEnd();
            }
            $builder->orderBy('qno','RANDOM');
            $builder->limit($limit);
            $query = $builder->get();
            $result = $query->getResult();
        }
        return $result;
    }
}