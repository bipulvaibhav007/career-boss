<?php
namespace App\Models;
use CodeIgniter\Model;
class Home_model extends Model
{
    public $coursesTbl;
    public $blogTbl;
    public $testimonialTbl;
    public $cmsTbl;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->coursesTbl = 'tbl_courses';
        $this->blogTbl = 'tbl_blog';
        $this->testimonialTbl = 'tbl_testimonial';
        $this->cmsTbl = 'tbl_cms';
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
                $builder->whereNotIn('blg_id', $blg_idArr);
            $builder->groupEnd();
            if(isset($_GET['search']) && $_GET['search'] !== ''){
                $builder->groupStart();
                    $builder->like('blog_title', $_GET['search']);
                    $builder->orLike('blog_details', $_GET['search']);
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
}