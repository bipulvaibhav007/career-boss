<?php
namespace App\Models\Admin;
use CodeIgniter\Model;
use \AllowDynamicProperties;
class Auth_model extends Model
{
    public $adminTbl;
    public $privilegeTbl;
    public $privilegePathTbl;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->adminTbl = 'tbl_admin';
        $this->privilegeTbl = 'tbl_privilege';
        $this->privilegePathTbl = 'tbl_privilege_path';
    }
    public function isvalidate($email)
    {
        //$pass=md5($password);
        $builder = $this->db->table($this->adminTbl);
        $builder->where('email', $email);
        $builder->where('status', 1);
        $query = $builder->get();
        //print_r($query);exit;
        $result = $query->getRow();
        //print_r($result);exit;
        return $result;
    }
    public function get_profile_data(){
        $builder = $this->db->table($this->adminTbl);
        $builder->where('email', session('email'));
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function update_profile($data, $id){
        $builder = $this->db->table($this->adminTbl);
        $builder->where('user_id', $id);
        $result = $builder->update($data);
        return $result;
    }
    public function is_user_privilege($privilegeId, $menuId, $functionId = null){
        $builder = $this->db->table($this->privilegeTbl);
        $builder->where('privilege_id', $privilegeId);
        $builder->where('menu_id', $menuId);
        if($functionId == null){
            $functionId = 1;
        }
        $builder->where('FIND_IN_SET('.$functionId.', crud_ids)');
        $query = $builder->get();
        $value = $query->getRow();
        return $value;
    }
    public function getCurrentUrlPrivilege($customPath){
        $builder = $this->db->table($this->privilegePathTbl);
        $builder->where('custom_path', $customPath);
        $query = $builder->get();
        $value = $query->getRow();
        return $value;
    }
}