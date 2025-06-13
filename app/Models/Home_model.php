<?php
namespace App\Models;
use CodeIgniter\Model;
class Home_model extends Model
{
    public $coursesTbl;
    public $blogTbl;
    public $testimonialTbl;
    public $cmsTbl;
    public $contactusTbl;
    public $membersTbl;
    public $studentsfranchiseTbl;
    public $coursefranchiseTbl;
    public $admissionsTbl;
    public $admissioncoursefeeTbl;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->coursesTbl = 'tbl_courses';
        $this->blogTbl = 'tbl_blog';
        $this->testimonialTbl = 'tbl_testimonial';
        $this->cmsTbl = 'tbl_cms';
        $this->contactusTbl = 'tbl_contact_us';
        $this->membersTbl = 'tbl_members';
        $this->studentsfranchiseTbl = 'tbl_students_franchise';
        $this->coursefranchiseTbl = 'tbl_course_franchise';
        $this->admissionsTbl = 'tbl_admissions';
        $this->admissioncoursefeeTbl = 'tbl_admissions_coursefee';
    }
    public function get_popular_active_courses(){
        $builder = $this->db->table($this->coursesTbl);
        $builder->where('is_popular', '1');
        $builder->where('status', 1);
        $builder->orderBy('course_id', 'DESC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function get_one_course($url = null){
        if($url != null){
            $builder = $this->db->table($this->coursesTbl);
            $builder->where('url', $url);
            $query = $builder->get();
            $result = $query->getRow();
            return $result;
        }else{
            return 0;
        }
    }
    public function get_recent_blog(){
        $builder = $this->db->table($this->blogTbl);
        $builder->where('blog_status', '1');
        $builder->limit(3);
        $builder->orderBy('blg_id','DESC');
        $query = $builder->get();
        $result = $query->getResult();
        //echo '<pre>'; print_r($result); exit;
        return $result;
    }
    public function get_all_blogs(){
        $recent_blogs = $this->get_recent_blog();
        if(!empty($recent_blogs)){
            $blg_idArr = array_column($recent_blogs, 'blg_id');
            $builder = $this->db->table($this->blogTbl);
            $builder->groupStart();
                $builder->where('blog_status', '1');
            $builder->groupEnd();
            if(isset($_GET['search']) && $_GET['search'] !== ''){
                $builder->groupStart();
                    $builder->like('blog_title', $_GET['search']);
                    $builder->orLike('blog_details', $_GET['search']);
                $builder->groupEnd();
            }else{
            $builder->groupStart();
                $builder->whereNotIn('blg_id', $blg_idArr);
            $builder->groupEnd();
            }
            $builder->orderBy('blg_id','DESC');
            $query = $builder->get();
            $result = $query->getResult();
            //echo '<pre>'; print_r($result); exit;
            return $result;
        }else{
            return 0;
        }
    }
    public function get_blog_for_blog_detail($url){
        $builder = $this->db->table($this->blogTbl);
        $builder->where('blog_url !=', $url);
        $builder->where('blog_status', '1');
        $builder->orderBy('blg_id','DESC');
        $builder->limit(2);
        $query = $builder->get();
        $result = $query->getResult();
        //echo '<pre>'; print_r($result); exit;
        return $result;
    }
    public function get_testimonial_for_home($limit=null){
        $builder = $this->db->table($this->testimonialTbl);
        $builder->where('type', 'stu');
        $builder->where('status', '1');
        $builder->orderBy('id','DESC');
        if($limit != null){
            $builder->limit($limit);
        }
        $query = $builder->get();
        $result = $query->getResult();
        //echo '<pre>'; print_r($result); exit;
        return $result;
    }
    public function get_cms($page=null){
        $builder = $this->db->table($this->cmsTbl);
        $builder->where('page', $page);
        $builder->where('status', '1');
        $query = $builder->get();
        $result = $query->getRow();
        //echo '<pre>'; print_r($result); exit;
        return $result;
    }
    public function get_one_contact_us_data_for_result($stext){
        $builder = $this->db->table($this->contactusTbl);
        $builder->groupStart();
            $builder->where('status', 6); // result prepaired compulsary
        $builder->groupEnd();
        $builder->groupStart();
            $builder->where('reg_no', $stext); 
            // $builder->orWhere('roll_no', $stext); 
            $builder->orWhere('phone', $stext); 
        $builder->groupEnd();
        $query = $builder->get();
        $result = $query->getRow();
        //echo '<pre>'; print_r($result); exit;
        return $result;
    }
    public function get_searched_franchise(){
        $builder = $this->db->table($this->membersTbl);
        $builder->select('*');
        $builder->where('status', 1);
        if(isset($_GET['s']) && $_GET['s'] != ''){
            $s = $_GET['s'];
            $builder->groupStart();
                $builder->where('center_name', $s);
                $builder->orWhere('member_code', $s);
            $builder->groupEnd();
        }
        $query = $builder->get();
        $result = $query->getRow();
        // echo '<pre>'; print_r($result); exit;
        return $result;
    }
    public function get_searched_result(){
        $builder = $this->db->table($this->studentsfranchiseTbl.' s');
        $builder->select('s.*,c.c_name, c.course_duration,c.course_cat, c.c_f_name');
        $builder->join($this->coursefranchiseTbl.' c','s.frcourse_id=c.cid','left');
        $builder->where('s.status', 3);
        if(isset($_GET['cert_no']) && $_GET['cert_no'] != ''){
            $s = $_GET['cert_no'];
            $builder->groupStart();
                $builder->where('s.cert_no', $s);
            $builder->groupEnd();
        }
        $query = $builder->get();
        $result = $query->getRow();
        // echo '<pre>'; print_r($result); exit;
        return $result;
    }
    public function get_verified_student(){
        $builder = $this->db->table($this->studentsfranchiseTbl.' s');
        $builder->select('s.*,c.c_name, c.course_duration,c.course_cat, c.c_f_name,m.member_code,m.center_name,m.center_address');
        $builder->join($this->coursefranchiseTbl.' c','s.frcourse_id=c.cid','left');
        $builder->join($this->membersTbl.' m','s.franchise_id=m.m_id','left');
        $builder->groupStart();
            $builder->where('s.status', 3);
            $builder->orWhere('s.status', 6);
        $builder->groupEnd();
        if(isset($_GET['no']) && $_GET['no'] != ''){
            $s = $_GET['no'];
            $builder->groupStart();
                $builder->where('s.cert_no', $s);
                $builder->orWhere('s.reg_no', $s);
            $builder->groupEnd();
        }
        $query = $builder->get();
        $result = $query->getRow();
        // echo '<pre>'; print_r($result); exit;
        return $result;
    }
    public function get_cb_student_details(){
        $builder = $this->db->table($this->admissionsTbl.' a');
        $builder->select('a.*');
        $builder->join($this->admissioncoursefeeTbl.' ac','a.stu_id = ac.stu_id','left');
        $builder->groupStart();
            $builder->where('a.status !=', 0);
            $builder->orWhere('a.status !=', 3);
        $builder->groupEnd();
        if(isset($_GET['no']) && $_GET['no'] != ''){
            $s = $_GET['no'];
            $builder->groupStart();
                $builder->where('a.stu_reg_no', $s);
                $builder->orWhere('ac.cert_no', $s);
            $builder->groupEnd();
        }
        $query = $builder->get();
        $result = $query->getRow();
        // echo '<pre>'; print_r($result); exit;
        return $result;
    }
    public function get_cb_student_courses(){
        $builder = $this->db->table($this->admissioncoursefeeTbl.' ac');
        $builder->select('ac.*,co.course_duration,co.c_f_name');
        $builder->join($this->admissionsTbl.' a','ac.stu_id = a.stu_id','left');
        $builder->join($this->coursefranchiseTbl.' co','ac.course_id = co.cid','left');
        $builder->groupStart();
            $builder->where('a.status !=', 0);
            $builder->orWhere('a.status !=', 3);
        $builder->groupEnd();
        if(isset($_GET['no']) && $_GET['no'] != ''){
            $s = $_GET['no'];
            $builder->groupStart();
                $builder->where('a.stu_reg_no', $s);
                $builder->orWhere('ac.cert_no', $s);
            $builder->groupEnd();
        }
        $query = $builder->get();
        $result = $query->getResult();
        // echo '<pre>'; print_r($result); exit;
        return $result;
    }
    public function get_cb_student_cert_details(){
        $builder = $this->db->table($this->admissioncoursefeeTbl.' ac');
        $builder->select('ac.*,a.stu_reg_no,a.stu_name,a.f_name,a.m_name,co.course_cat,co.course_duration,co.c_f_name');
        $builder->join($this->admissionsTbl.' a','ac.stu_id = a.stu_id','left');
        $builder->join($this->coursefranchiseTbl.' co','ac.course_id = co.cid','left');

        $builder->groupStart();
            $builder->where('a.status !=', 0);
            $builder->orWhere('a.status !=', 3);
        $builder->groupEnd();
        if(isset($_GET['cert_no']) && $_GET['cert_no'] != ''){
            $s = $_GET['cert_no'];
            $builder->groupStart();
                $builder->where('ac.cert_no', $s);
            $builder->groupEnd();
        }
        $query = $builder->get();
        $result = $query->getRow();
        // echo '<pre>'; print_r($result); exit;
        return $result;
    }
}