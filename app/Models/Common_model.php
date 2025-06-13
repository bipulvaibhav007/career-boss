<?php
namespace App\Models;
use CodeIgniter\Model;
class Common_model extends Model
{
    public $usersTbl;
    public $privilegeTbl;
    public $privilegePathTbl;
    public $settingTbl;
    public $bannerTbl;
    public $pageTbl;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->usersTbl = 'tbl_users';
        $this->privilegeTbl = 'tbl_privilege';
        $this->privilegePathTbl = 'tbl_privilege_path';
        $this->settingTbl = 'tbl_setting';
        $this->bannerTbl = 'tbl_banner';
        $this->pageTbl = 'tbl_page';
    }
    public function getAllRecord($table, $whereArr = null){
        $builder = $this->db->table($table);
        if($whereArr != null){
            $builder->where($whereArr);
        }
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getAllRecordCount($table, $whereArr = null){
        $builder = $this->db->table($table);
        if($whereArr != null){
            $builder->where($whereArr);
        }
        $query = $builder->get();
        $result = $query->getNumRows();
        return $result;
    }
    public function getAllRecordOrderByDesc($table, $whereArr=null, $orderBy=null){
        $builder = $this->db->table($table);
        if($whereArr != null){
            $builder->where($whereArr);
        }
        if($orderBy != null){
           $builder->orderBy($orderBy[0],$orderBy[1]);
        }
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getOneRecord($table, $whereArr = null){
        $builder = $this->db->table($table);
        if($whereArr != null){
            $builder->where($whereArr);
        }
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function insertRecord($table, $data){
        $builder = $this->db->table($table);
        $builder->Insert($data);
        return $this->db->insertID();
    }
    public function updateRecord($table, $data, $whereArr){
        $builder = $this->db->table($table);
        $builder->where($whereArr);
        $result = $builder->update($data);
        return $result;
    }
    public function deleteRecord($table, $whereArr){
        $builder = $this->db->table($table);
        $builder->where($whereArr);
        $result = $builder->delete();
        return $result;
    }
    public function getAllRecordRowArray($table, $wherearr=null)
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        if($wherearr != null){
            $builder->where($wherearr);
        }
      
      $query = $builder->get();
      //echo $this->db->last_query(); exit;
      $result = $query->getRowArray();
      return $result;
    }
    public function get_setting($id=''){
        $builder = $this->db->table($this->settingTbl);
        $builder->where('id',$id);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function update_setting($data, $id){
        $builder = $this->db->table($this->settingTbl);
        $builder->where('id',$id);
        //$query = $builder->get();
        $result = $builder->update($data);
        return $result;
    }
    public function get_banners(){
        $builder = $this->db->table($this->bannerTbl.' b');
        $builder->select('b.*, p.page_name');
        $builder->join($this->pageTbl.' p', 'b.page = p.id');
        $builder->orderBy('b.page', 'ASC');
        $builder->orderBy('b.id', 'DESC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function get_one_banner($pageId){
        $builder = $this->db->table($this->bannerTbl.' b');
        $builder->select('b.*');
        $builder->where('page', $pageId);
        $builder->where('status', 1);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function getLastRecord($table, $orderBy){ //only for test, use in Test.php(Controller)
        $builder = $this->db->table($table);
        $builder->orderBy($orderBy, 'DESC');
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    /*public function getNewEnq(){
        $builder = $this->db->table('tbl_contact_us');
        $builder->where('status', 1);
        $query = $builder->get();
        $result = $query->getResult();
        return $result; 
    }*/
}