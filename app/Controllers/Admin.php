<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use Mpdf\Mpdf;

use App\Controllers\MpdfController;
class Admin extends BaseController
{
    public $data;
    public $commonmodel;
    public $adminmodel;
    public $session;
    public $membermodel;
    public $studentsFranchiseTbl;
    public $gradeTbl;
    public $moduleTbl;
    public $certlogTbl;
    public $randomcodeTbl;
    public $coursefranchiseTbl;
    public function __construct()
    {
        date_default_timezone_set('Asia/Kolkata');
        $this->studentsFranchiseTbl = 'tbl_students_franchise';
        $this->gradeTbl = 'tbl_grade';
        $this->moduleTbl = 'tbl_module';
        $this->certlogTbl = 'tbl_cert_log';
        $this->randomcodeTbl = 'tbl_random_code';
        $this->coursefranchiseTbl = 'tbl_course_franchise';
        $this->data['title'] = 'Admin-Users';
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->adminmodel = model('App\Models\Admin_model', false);
        $this->membermodel = model('App\Models\Member_model', false);
        // $this->mpdf = new Mpdf();
    }
    
    public function index()
    {
        // $data['clock'] = $this->commonmodel->getOneRecord('tbl_setting', ['id'=>1])->clock;
        // return view("admin/exam_hall", $data);
        // $n = 10;
        // function getRandomString($n) {
        //     $characters = 'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz';
        //     $randomString = '';

        //     for ($i = 0; $i < $n; $i++) {
        //         $index = random_int(0, strlen($characters) - 1);
        //         $randomString .= $characters[$index];
        //     }

        //     return $randomString;
        // }
        // echo getRandomString($n);
        // exit;
        $data = [];
        // $data['franchise'] = $this->commonmodel->getAllRecordCount('tbl_members');
        // $data['newStudents'] = $this->commonmodel->getAllRecordCount($this->studentsFranchiseTbl, ['status <'=>1]);
        // $data['apprStudents'] = $this->commonmodel->getAllRecordCount($this->studentsFranchiseTbl, ['status'=>6]);
        // $data['certStudents'] = $this->commonmodel->getAllRecordCount($this->studentsFranchiseTbl, ['status'=>3]);
        // $data['totStudents'] = $this->commonmodel->getAllRecordCount($this->studentsFranchiseTbl);
        return view("admin/dashboard",$data);
        
    }
    // for development testing exam portal
    public function watch_test(){
        if($this->request->getMethod() === 'post'){
            $h = $_POST['h'];
            $m = $_POST['m'];
            $s = $_POST['s'];
            $clock = date('h:i:s',strtotime($h.':'.$m.':'.$s));
            $this->commonmodel->updateRecord('tbl_setting', ['clock'=>$clock], ['id'=>1]);
            // $result = array(
            //     'h' => $h,
            //     'm' => $m,
            //     's' => $s,
            // );
            // return json_encode($result);
            exit;
        }
    }
    public function users()
    {
        $this->data['users'] = $this->adminmodel->getAllUsers();
        return view("admin/users/index",$this->data);
        
    }
    public function add_user(){
        if ($this->request->getMethod() === 'post'){
            $validation = $this->validate([
              'name'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Your Full name is required'
                  ]
                  ],
              'email' =>[
                  'rules'=>'required|valid_email|is_unique[tbl_admin.email]',
                  'errors'=>[
                      'required'=>'Email is required',
                      'valid_email'=>'You must enter a valid email',
                      'is_unique'=>'Email already taken'
                  ]
                  ],
              'password'=>[
                  //'rules'=>'required|min_length[5]|max_length[12]|regex_match[^[A-Z]+(?=.*?[a-z])(?=.*?[0-9])(?=.*?\W).*$]',
                  'rules'=>'required|min_length[5]|max_length[12]',
                  'errors'=>[
                      'required'=>'Password is required',
                      'min_length'=>'Password must have atleast 5 character in length',
                      'max_length'=>'Password must not have characters more than 12 in length',
                      'regex_match'=>'Password must start with capital letter, and containing at least 1 lowercase, 1 special character and 1 digit.',
                  ]
                  ],
              'cpassword'=>[
                  'rules'=>'required|min_length[5]|max_length[12]|matches[password]',
                  'errors'=>[
                      'required'=>'Confirm password is required',
                      'min_length'=>'Confirm Password must have atleast 5 character in length',
                      'max_length'=>'Confirm Password must not have characters more than 12 in length',
                      'matches'=>'Confirm Password not matches to password'
                  ]
                  ],
              'phone'=>[
                  'rules'=>'required|numeric|min_length[10]|max_length[10]',
                  'errors'=>[
                      'required'=>'Phone is required',
                      'numeric'=>'You must enter numeric value',
                      'min_length'=>'Phone Number must be 10 digit in length',
                      'max_length'=>'Phone Number must not have more than 10 digit in length'
                  ]
                  ],
              'address'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Address is required'
                  ]
                  ],
              'image' =>[
                  //'rules'=>'uploaded[image]|max_size[image,50]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                  'rules'=>'max_size[image,100]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                  'errors'=>[
                      //'uploaded'=>lang('User.validation.image.uploaded'),
                      'max_size'=>'Image should not greater than 100 KB of size.',
                      'ext_in'=>'Image must be extension with png,jpg,jpeg,bmp,gif.',
                  ]
              ],
              'privilege_id'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Privilege is required'
                  ]
                ], 
              'status'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Status must be select'
                  ]
              ]
          ]);
          if(!$validation){
              $this->data['validation'] = $this->validator;
              //return view('admin/users/add_user',$this->data);
          }else{
              if($_FILES['image']['name'] != ''){
                  if($img = $this->request->getFile('image')){ 
                      $imgname = $img->getName();
                      if($img->isValid() && !$img->hasMoved()){
                          $ext = explode('.',$imgname);
                          $ext = end($ext);
                          $newName = 'u_'.time().'.'.$ext;
                          $img->move('./public/assets/upload/users/',$newName);
                      }
                  }
                  $data['image'] = $newName;
              }
              $data['name'] = $_POST['name'];
              $data['email'] = $_POST['email'];
              $password = $_POST['cpassword'];
              $data['password'] = Hash::make($password);
              //$data['password'] = md5($_POST['password']);
              //$data['cpass'] = $_POST['password'];
              $data['ip_address'] = $this->request->getIPAddress();
              $data['phone'] = $_POST['phone'];
              $data['privilege_id'] = $this->request->getVar('privilege_id');
              $data['added_by'] = session('user_id');
              $data['address'] = $_POST['address'];
              $data['status'] = $_POST['status'];
  
              $inserted = $this->commonmodel->insertRecord('tbl_admin', $data);
              if($inserted){
                session()->setFlashdata(['message'=>'User Added Successfully','type'=>'success']);
                  //return redirect()->to(base_url('/admin/users'));
              }else{
                session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
                  
              }
              return redirect()->to(base_url('/admin/users'));
            } //request post close
        }
        $this->data['rolePrivilege'] = $this->commonmodel->getAllRecord('tbl_role_privilege', ['status'=>1, 'privilege_id !='=>1]);
        return view("admin/users/add_user",$this->data);
    }
    public function edit_user($id){
        if ($this->request->getMethod() === 'post'){
            $validation = \Config\Services::validation();

            $validation->setRule('name', 'Username', 'required',['required'=>'Your Full name is required']);
            $validation->setRule('phone','Phone','required|numeric|min_length[10]|max_length[10]',['required'=>'Phone is required','numeric'=>'You must enter numeric value','min_length'=>'Phone Number must be 10 digit in length','max_length'=>'Phone Number must not have more than 10 digit in length']);
            $validation->setRule('address', 'Address', 'required',['required'=>'Address is required']);
            if($id != 1){
                $validation->setRule('email','Email','required|valid_email',['required'=>'Email is required','valid_email'=>'You must enter a valid email']);
                $validation->setRule('privilege_id', 'Privilege', 'required',['required'=>'Privilege is required']);
                $validation->setRule('status', 'Status', 'required',['required'=>'Privilege is required']);
            }
           
          if(!$validation->withRequest($this->request)->run()){
              $this->data['validation'] = $validation->getErrors();
          }else{
              if($_FILES['image']['name'] != ''){
                  if($img = $this->request->getFile('image')){ 
                      $imgname = $img->getName();
                      if($img->isValid() && !$img->hasMoved()){
                          $ext = explode('.',$imgname);
                          $ext = end($ext);
                          $newName = 'u_'.time().'.'.$ext;
                          $img->move('./public/assets/upload/users/',$newName);
                      }
                  }
                  $data['image'] = $newName;
              }
              $data['name'] = $_POST['name'];
              $data['ip_address'] = $this->request->getIPAddress();
              $data['phone'] = $_POST['phone'];
              $data['update_by'] = session('user_id');
              $data['address'] = $_POST['address'];
              $data['updated'] = date('Y-m-d H:i:s');
              if($id != 1){
                $data['email'] = $_POST['email'];
                $data['privilege_id'] = $this->request->getVar('privilege_id');
                $data['status'] = $_POST['status'];
              }
  
              $updated = $this->commonmodel->updateRecord('tbl_admin', $data, ['user_id'=>$id]);
              if($updated){
                  session()->setFlashdata(['message'=>'User Updated Successfully','type'=>'success']);
                  //return redirect()->to(base_url('/admin/users'));
              }else{
                  session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
                  
              }
              return redirect()->to(base_url('/admin/users'));
            } //request post close
        }
        $this->data['rolePrivilege'] = $this->commonmodel->getAllRecord('tbl_role_privilege', ['status'=>1, 'privilege_id !='=>1]);
        $this->data['user'] = $this->commonmodel->getOneRecord('tbl_admin', ['user_id'=>$id]);
        return view("admin/users/edit_user",$this->data);
    }
    public function user_profile($id){
        $this->data['user'] = $this->adminmodel->getAllUsers($id);
        return view("admin/users/user_profile",$this->data);
    }
    public function user_delete($id){
        if($id==1){
            session()->setFlashdata(['message'=>'Admin can not delete','type'=>'danger']);
            return redirect()->to(base_url('/admin/users')); 
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_admin', ['user_id'=>$id]);
            if($deleted){
                session()->setFlashdata(['message'=>'User Deleted Successfully','type'=>'success']);
                //return redirect()->to(base_url('/admin/users'));
            }else{
                session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
                
            }
            return redirect()->to(base_url('/admin/users'));
        }
    }
    /*******************************************Users Group******************************************* */
    public function user_groups(){
        $this->data['usersgrouplist'] = $this->commonmodel->getAllRecord('tbl_role_privilege');
        return view("admin/users/usergroupindex",$this->data);
    }
    public function addgroup(){
        if($this->request->getMethod() === 'post'){
            $validation = \Config\Services::validation();

            $validation->setRule('post_name', 'Group Name', 'required',['required'=>'Group name is required']);
            $validation->setRule('status', 'Status', 'required',['required'=>'Status is required']);
            if($validation->withRequest($this->request)->run()){
                $post = $this->request->getPost();
                $data = array();
                $data['post_name'] = $this->request->getPost('post_name');
                $data['status'] = $this->request->getPost('status');
                $data['created_at'] = date('Y-m-d');
                $groupId = $this->commonmodel->insertRecord('tbl_role_privilege', $data);
                if(isset($post['menu_id']) && isset($post['crudid'])){
					foreach($post['menu_id'] as $key=>$menuid){
						$prvlgarr = array();
						$prvlgarr['privilege_id'] = $groupId;
						$prvlgarr['menu_id'] = $menuid;
						$prvlgarr['crud_ids'] = implode(',', $post['crudid'][$key]);
						$prvlgarr['added_at'] = date('Y-m-d');
						$this->commonmodel->insertRecord('tbl_privilege', $prvlgarr);
					}
					//echo '<pre>';print_r($post);exit;	
				}
                if($groupId){
                    session()->setFlashdata(['message'=>'User Group Added Successfully','type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/user_groups'));
            }else{
                $this->data['validation'] = $validation->getErrors();
            }
        }
        $this->data['menulist'] = $this->commonmodel->getAllRecord('tbl_menu_list', ['status'=>1]);
        return view('admin/users/add_group', $this->data);
    }
    public function editgroup($id){
        if($this->request->getMethod() === 'post'){
            $validation = \Config\Services::validation();

            $validation->setRule('post_name', 'Group Name', 'required',['required'=>'Group name is required']);
            $validation->setRule('status', 'Status', 'required',['required'=>'Status is required']);
            if($validation->withRequest($this->request)->run()){
                $post = $this->request->getPost();
                $id = $this->request->getPost('id');
                $data = array();
                $data['post_name'] = $this->request->getPost('post_name');
                $data['status'] = $this->request->getPost('status');
                $data['updated_at'] = date('Y-m-d');
                $updated = $this->commonmodel->updateRecord('tbl_role_privilege', $data,['privilege_id'=>$id]);
                $loginId = session('user_id');
                //echo $loginId; exit;
                if($loginId == 1){
                    $deleteAllPrivilege = $this->commonmodel->deleteRecord('tbl_privilege',['privilege_id'=>$id,'menu_id !='=>2]);
                }else{
                    $deleteAllPrivilege = $this->commonmodel->deleteRecord('tbl_privilege',['privilege_id'=>$id]);
                }
                if(isset($post['menu_id']) && isset($post['crudid'])){
					foreach($post['menu_id'] as $key=>$menuid){
						$prvlgarr = array();
						$prvlgarr['privilege_id'] = $id;
						$prvlgarr['menu_id'] = $menuid;
						$prvlgarr['crud_ids'] = implode(',', $post['crudid'][$key]);
						$prvlgarr['added_at'] = date('Y-m-d');
						$inserted = $this->commonmodel->insertRecord('tbl_privilege', $prvlgarr);
					}
					//echo '<pre>';print_r($post);exit;	
				}
                if($updated){
                    session()->setFlashdata(['message'=>'User Group Updated Successfully','type'=>'success']);
                }else if(isset($inserted) || $deleteAllPrivilege){
                    session()->setFlashdata(['message'=>'Privilege Updated Successfully','type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong.','type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/editgroup/'.$id));
            }else{
                $this->data['validation'] = $validation->getErrors();
            }
        }
        $this->data['prev_details'] = $this->commonmodel->getOneRecord('tbl_role_privilege', array('privilege_id'=>$id));
        $this->data['menulist'] = $this->commonmodel->getAllRecord('tbl_menu_list', ['status'=>1]);
        return view('admin/users/edit_group', $this->data);
    }
    public function deletegroup($id=false){
        if($id == 1){
            session()->setFlashdata(['message'=>'Admin Group can not delete!','type'=>'danger']);
            return redirect()->to('/admin/user_groups');
        }
        $deleteAllPrivilege = $this->commonmodel->deleteRecord('tbl_privilege',['privilege_id'=>$id]);
        $deleted = $this->commonmodel->deleteRecord('tbl_role_privilege', array('privilege_id'=>$id));
        if($deleted && $deleteAllPrivilege){
            session()->setFlashdata(['message'=>'Group deleted successfully','type'=>'success']);
        }else{
            session()->setFlashdata(['message'=>'Something went wrong.','type'=>'danger']);
        }
        return redirect()->to(base_url('/admin/user_groups'));
    }
    /*******************************************Domains************************************** */
    public function domains(){
        
        $data['domains'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_domain_holder','',['dh_id','desc']);
        return view('admin/users/domains', $data);
    }
    public function domain_cu($dh_id=''){
        $post = $data = array();
        if($this->request->getMethod() === 'post'){
            $rules = [
                'domain_name'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Domain name is required'
                    ]
                    ],
                'db_suffix' =>[
                    'rules'=>'required|is_unique[tbl_domain_holder.db_suffix]',
                    'errors'=>[
                        'required'=>'DB Suffix is required',
                        'is_unique'=>'This suffix already taken'
                    ]
                    ],
                'cert_prefix' =>[
                    'rules'=>'required|is_unique[tbl_domain_holder.cert_prefix]',
                    'errors'=>[
                        'required'=>'Cert prefix is required',
                        'is_unique'=>'This prefix already taken'
                    ]
                    ],
                
                'status'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Status must be select'
                    ]
                ]
            ];
            if($dh_id){
                $rules['db_suffix'] = [
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'DB Suffix is required',
                        ]
                ];
                $rules['cert_prefix'] = [
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'Cert Prefix is required',
                    ]
                ];
            }
            $validation = $this->validate($rules);
            if(!$validation){
                $data['validation'] = $this->validator;
                //return view('admin/users/add_user',$this->data);
            }else{
                
                $post['domain_name'] = $_POST['domain_name'];
                if(!$dh_id){
                    $post['db_suffix'] = $_POST['db_suffix'];
                }
                $post['cert_prefix'] = $_POST['cert_prefix'];
                $post['status'] = $_POST['status'];
    
                if(!$dh_id){
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_domain_holder', $post);
                    if($inserted){
                        session()->setFlashdata(['message'=>'Domain Added Successfully','type'=>'success']);
                        //create tables
                        $this->adminmodel->create_tbl_student_franchise($_POST['db_suffix']);
                        $this->adminmodel->create_tbl_random_code($_POST['db_suffix']);
                        $this->adminmodel->create_tbl_module($_POST['db_suffix']);
                        $this->adminmodel->create_tbl_grade($_POST['db_suffix']);
                        $this->adminmodel->create_tbl_cert_log($_POST['db_suffix']);
                        $this->adminmodel->create_tbl_course_franchise($_POST['db_suffix']);
                        $this->adminmodel->insert_into_tbl_setting($inserted);
                        $this->adminmodel->insert_into_tbl_home_section($inserted);
                        $this->adminmodel->insert_into_tbl_about_us($inserted);
                        $this->adminmodel->insert_into_tbl_frregister_page($inserted);
                        $this->adminmodel->insert_into_tbl_experts($inserted);
                        $this->adminmodel->insert_into_tbl_banner($inserted);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong. Please Try Again','type'=>'danger']);
                    }
                }else{
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_domain_holder', $post, ['dh_id'=>$dh_id]);
                    if($updated){
                        session()->setFlashdata(['message'=>'Domain Updated Successfully','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }
                return redirect()->to(base_url('/admin/domains'));
            }
        }
        if($dh_id){
            $data['domain'] = $this->commonmodel->getOneRecord('tbl_domain_holder', ['dh_id'=>$dh_id]);
        }
        return view('admin/users/domain_cu', $data);
    }
    public function domain_d($dh_id=''){
        if($dh_id){
            $domain = $this->commonmodel->getOneRecord('tbl_domain_holder', ['dh_id'=>$dh_id]); 
            if(!empty($domain)){
                $db_suffix = $domain->db_suffix;
                if($this->adminmodel->delete_domain_tables($db_suffix)){
                    if($this->commonmodel->deleteRecord('tbl_domain_holder', ['dh_id'=>$dh_id]) && $this->commonmodel->deleteRecord('tbl_setting', ['dh_id'=>$dh_id])){
                        $this->commonmodel->deleteRecord('tbl_about_us', ['dh_id'=>$dh_id]);
                        $this->commonmodel->deleteRecord('tbl_home_section', ['dh_id'=>$dh_id]);
                        $this->commonmodel->deleteRecord('tbl_frregister_page', ['dh_id'=>$dh_id]);
                        $this->commonmodel->deleteRecord('tbl_experts', ['dh_id'=>$dh_id]);
                        $this->commonmodel->deleteRecord('tbl_banner', ['dh_id'=>$dh_id]);
                        session()->setFlashdata(['message'=>'Domain Deleted Successfully','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }
            }
        }
        return redirect()->to(base_url('/admin/domains'));
    }
    /*******************************************Settings************************************** */
    public function setting()
    {
        if ($this->request->getMethod() === 'post' && $_POST['submit'] == 'gen_setting'){
            //print_r($_POST); exit;
            $data = array();
            $data = $_POST;
            unset($data['submit']);
            /*if(isset($_FILES['logo']['name']) && $_FILES['logo']['name'] != ''){
                if($img = $this->request->getFile('logo')){ 
                    $imgname = $img->getName();
                    if($img->isValid() && !$img->hasMoved()){
                        $ext = explode('.',$imgname);
                        $ext = end($ext);
                        $newName = 'logo'.time().'.'.$ext;
                        $img->move('./public/assets/upload/images/',$newName);
                    }
                }
                $data['logo'] = $newName;
            }*/
            $updated = $this->commonmodel->update_setting($data, 1);
            if($updated){
                $this->session->setFlashdata(['message'=>'Setting Update Successfully','type'=>'success']);
                return redirect()->to(base_url('/admin/setting'));
            }else{
                $this->session->setFlashdata(['message'=>'Something went wrong.','type'=>'danger']);
                return redirect()->to(base_url('/admin/setting'));
            }
        }else if(isset($_POST['submit']) && $_POST['submit'] == 'msg_setting'){
            print_r($_POST); exit;
        }else{
            $this->data['settings'] = $this->commonmodel->get_setting(1);
            return view("admin/setting/setting_edit",$this->data);
        }
        
    }
    /***************************************Enquiry******************************************* */
    public function enquiry()
	{
        $url = base_url('admin/enquiry_list?status=a');
        if($this->request->getMethod() == 'post'){
            $lsfromDate = (isset($_POST['lsfromDate']) && $_POST['lsfromDate'] != '')?date('Y-m-d',strtotime($_POST['lsfromDate'])):'';
            $lstoDate = (isset($_POST['lstoDate']) && $_POST['lstoDate'] != '')?date('Y-m-d',strtotime($_POST['lstoDate'])):'';
            $cafromDate = (isset($_POST['cafromDate']) && $_POST['cafromDate'] != '')?date('Y-m-d',strtotime($_POST['cafromDate'])):'';
            $catoDate = (isset($_POST['catoDate']) && $_POST['catoDate'] != '')?date('Y-m-d',strtotime($_POST['catoDate'])):'';

            $http_queryArr = array(
                'status' => 'a',
                'page' => 1,
            );
            if($lsfromDate != ''){
                $http_queryArr['lsfromDate'] = $lsfromDate;
            }
            if($lstoDate != ''){
                $http_queryArr['lstoDate'] = $lstoDate;
            }
            if($cafromDate != ''){
                $http_queryArr['cafromDate'] = $cafromDate;
            }
            if($catoDate != ''){
                $http_queryArr['catoDate'] = $catoDate;
            }

            if(!empty(array_filter($_POST['attribute']))){
                $attributeArr = $_POST['attribute'];
                foreach($attributeArr as $key=>$attrvalue){
                    if($attrvalue != ''){
                        $attribute[] = $attrvalue;
                        $amsign[] = $_POST['amsign'][$key];
                        if($attrvalue == 1){
                            $attrvalArr[] = $_POST['attrvalue1'][$key];
                        }elseif($attrvalue == 2){
                            $attrvalArr[] = $_POST['attrvalue2'][$key];
                        }elseif($attrvalue == 3){
                            $attrvalArr[] = $_POST['attrvalue3'][$key];
                        }
                        $condition[] = isset($_POST['condition'][$key])?$_POST['condition'][$key]:'';
                    }
                }
                $http_queryArr['attribute'] = $attribute;
                $http_queryArr['amsign'] = $amsign;
                $http_queryArr['attrvalArr'] = $attrvalArr;
                $http_queryArr['condition'] = $condition;
                // foreach($attribute as $key=>$value){
                //     echo $value.'->'.$amsign[$key].'->'.$attrvalArr[$key].'->'.$condition[$key].'<br>';
                    
                // }
                // print_r($value); echo '<br>';
                // print_r($amsign); echo '<br>';
                // print_r($attrvalArr); echo '<br>';
                // print_r($condition); echo '<br>';
                // // print_r($attributeArr);
                // exit;
            }

            $http_query = http_build_query($http_queryArr);
            $url = base_url('admin/enquiry_list?'.$http_query);
            $this->session->set('enqurl', $url, 300);

        }elseif(isset($_GET['status'])){
            $status = (isset($_GET['status']))?$_GET['status']:'';
            $search = (isset($_GET['search']))?$_GET['search']:'';
            $course_for = (isset($_GET['course_for']))?$_GET['course_for']:'';
            $page = (isset($_GET['page']))?$_GET['page']:1;

            $http_queryArr = array(
                'status' => $status,
                'search' => $search,
                'course_for' => $course_for,
                'page' => $page,
            );
            
            //$http_query = http_build_query(array('status'=>$status,'search'=>$search,'course_for'=>$course_for,'page'=>$page));
            $http_query = http_build_query($http_queryArr);
            $url = base_url('admin/enquiry_list?'.$http_query);
            $this->session->set('enqurl', $url, 300);
        }elseif($this->session->has('enqurl')){
			$url = $this->session->get('enqurl');
		}
        
        return redirect()->to($url);
	}
    public function reset_enqurl(){
        if($this->session->has('enqurl')){
			$this->session->remove('enqurl');
		}
        return redirect()->to(base_url('admin/enquiry?status=a&page=1'));
    }
    /*public function filter_contact(){
        if($this->request->getMethod() == 'post'){
            $lsfromDate = (isset($_POST['lsfromDate']) && $_POST['lsfromDate'] != '')?date('Y-m-d',strtotime($_POST['lsfromDate'])):'';
            $lstoDate = (isset($_POST['lstoDate']) && $_POST['lstoDate'] != '')?date('Y-m-d',strtotime($_POST['lstoDate'])):'';
            $http_query = http_build_query(array('status'=>'a','lsfromDate'=>$lsfromDate,'lstoDate'=>$lstoDate));
            $url = base_url('admin/enquiry?'.$http_query);
            return redirect()->to($url);
        }else{
            return redirect()->to(base_url('admin/enquiry?status=a&page=1'));
        }
    }*/
    public function enquiry_list()
	{
	    /*$rejectedenq = $this->commonmodel->getAllRecord('tbl_ins_enquiry', ['status'=>'5']);
        foreach($rejectedenq as $list){
            $this->commonmodel->updateRecord('tbl_ins_enquiry',['status'=>'7'], ['status'=>'5']);
        }
        $rejectedenq = $this->commonmodel->getAllRecord('tbl_ins_enquiry', ['status'=>'5']);
        echo '<pre>';print_r($rejectedenq); exit;*/
        // if($this->request->getMethod() == 'post'){
        //     $this->data['enquiry'] = $this->adminmodel->getAllEnquiryByFilter();
        // }else{
        //     $this->data['enquiry'] = $this->adminmodel->getAllEnquiry();

        // }
        $this->data['enquiry'] = $this->adminmodel->getAllEnquiry();
        $this->data['limit'] = $this->commonmodel->get_setting(1)->enqlist_limit;
        $this->data['countAll'] = $this->adminmodel->getCountEnquiry('a');
        $this->data['countNew'] = $this->adminmodel->getCountEnquiry(1);
        $this->data['countWhatsApp'] = $this->adminmodel->getCountEnquiry(2);
        $this->data['countNonWhatsApp'] = $this->adminmodel->getCountEnquiry(7);
        $this->data['countDiscussion'] = $this->adminmodel->getCountEnquiry(3);
        $this->data['countComp'] = $this->adminmodel->getCountEnquiry(4);
        $this->data['countReject'] = $this->adminmodel->getCountEnquiry(5);
        $this->data['countFollowup'] = $this->adminmodel->getCountEnquiry(6);
        $this->data['countDoOnline'] = $this->adminmodel->getCountEnquiry(8);

        $this->data['courses'] = $this->commonmodel->getAllRecord('tbl_courses');

        $status = (isset($_GET['status']))?$_GET['status']:'a';
        $this->data['count_current_enquiry'] = $this->adminmodel->getCountEnquiry($status);
        
        return view('admin/ins_manage/enquiry_index', $this->data);
	}
    public function enquiry_cu($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'c_name'=>'required',
                'phone1'=>'required',
                'status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
                //return view('admin/cms/add_edit_cms', $this->data);
            }else{
                
                $data['c_name'] = $_POST['c_name'];
                $data['phone1'] = $_POST['phone1'];
                $data['address'] = $_POST['address'];
                $data['course_for'] = $_POST['course_for'];
                $data['ref_by'] = $_POST['ref_by'];
                $data['refree_name'] = $_POST['refree_name'];
                $data['comment'] = $_POST['comment'];
                //$data['description5'] = $_POST['description5'];
                $data['status'] = $_POST['status'];
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_ins_enquiry', $data);
                    if(isset($_POST['comment']) && $_POST['comment'] != ''){
                        $logData['enq_id'] = $inserted;
                        $logData['comment'] = $_POST['comment'];
                        $logData['status'] = $_POST['status'];
                        $this->commonmodel->insertRecord('tbl_comment_log', $logData);
                    }
                    if($inserted){
                        session()->setFlashdata(['message'=>'Enquiry added successfuly','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }else{
                    $data['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_ins_enquiry', $data, ['enq_id'=>$id]);
                    if($updated){
                        session()->setFlashdata(['message'=>'Enquiry Updated Successfully','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }
                
                return redirect()->to(site_url('admin/enquiry'));
            }
            
        }
        if($id){
            $this->data['cms'] = $this->commonmodel->getOneRecord('tbl_ins_enquiry', ['enq_id'=>$id]);
        }
        $this->data['courses'] = $this->commonmodel->getAllRecord('tbl_courses');
        return view('admin/ins_manage/enquiry_cu', $this->data);
    }
    public function enquiry_view($id=false){
        if($this->request->getMethod() == 'post'){
            //print_r($_POST); exit;
            $id = $_POST['enq_id'];
            if(empty($_POST['status'])){
                session()->setFlashdata(['message'=>'Status Required!','type'=>'danger']);
                return redirect()->to(site_url('admin/enquiry_view/'.$id));
            }
            $enqData['status'] = implode(',', $_POST['status']);
            if($_POST['followup_date'] != ''){
                $enqData['followup_date'] = date('Y-m-d',strtotime($_POST['followup_date']));
            }
            if($_POST['comment'] != ''){
                $enqData['comment'] = $_POST['comment'];
                $logData['enq_id'] = $id;
                $logData['comment'] = $_POST['comment'];
                $logData['status'] = implode(',',$_POST['status']);
                $inserted = $this->commonmodel->insertRecord('tbl_comment_log', $logData);
            }
            $updated = $this->commonmodel->updateRecord('tbl_ins_enquiry', $enqData, ['enq_id'=>$id]);

            if($updated){
                session()->setFlashdata(['message'=>'Enquiry Updated Successfully','type'=>'success']);
            }else{
                session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
            }
            return redirect()->to(site_url('admin/enquiry_view/'.$id));
        }
        $this->data['cms'] = $this->adminmodel->getAllEnquiry($id);
        $this->data['commentlog'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_comment_log',['enq_id'=>$id],['log_id','desc']);
        $this->data['whatsappMessages'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_whatsapp_reply_log',['phone1'=>$this->data['cms']->phone1],['log_id','desc']);

        return view('admin/ins_manage/enquiry_view', $this->data);
    }
    public function delete_enquiry($id){
        if(!$id){
            return redirect()->to(site_url('admin/enquiry'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_ins_enquiry',['enq_id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Enquiry Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Enquiry Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/enquiry'));
        }
    }
    public function change_enquiry_status(){
        if($this->request->getMethod() == 'post'){
            //print_r($_POST); exit;
            $enq_id = $_POST['enq_id'];
            $status = (!empty($_POST['status']))?implode(',', $_POST['status']):'';
            $data = array('status'=>$status);
            $updated = $this->commonmodel->updateRecord('tbl_ins_enquiry', $data, ['enq_id'=>$enq_id]);
            if($updated){
                session()->setFlashdata(['message'=>'Enquiry Updated Successfully','type'=>'success']);
            }else{
                session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
            }
        }
        return redirect()->to(base_url('/admin/enquiry'));  
        
    }
    // public function enquiry_export_to_excel($status = null, $page=null){
    public function enquiry_export_to_excel(){
        //echo $status;
        // maping old excel files and delete
        helper('filesystem');
		$path = './public/assets/excel_file/';
		$map = directory_map($path);
        if(!empty($map)){
            foreach($map as $m){
                unlink('./public/assets/excel_file/'.$m); //delete
            }
        }
        //print_r($map); exit;
        $fileName = 'ENQUIRY_LIST'.time().'.xlsx';
        // $enqList = $this->adminmodel->getAllEnquiry('', $status, $page);
        $enqList = $this->adminmodel->getAllEnquiry();
        //echo '<pre>'; print_r($enqList);  exit;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $sheet->setCellValue('A1', 'S.No.');
		$sheet->setCellValue('B1', 'Student Name');
        $sheet->setCellValue('C1', 'Phone');
        $sheet->setCellValue('D1', 'Address');
        $sheet->setCellValue('E1', 'Course');
        
        $rows = 2;
        $page = (isset($_GET['page']))?$_GET['page']:1;
        $limit = $this->commonmodel->get_setting(1)->enqlist_limit;
        if($page == 1){
            $sn=1;
        }else{
            $sn = $limit * ($page-1) + 1;
        }
        foreach($enqList as $list){
            $sheet->setCellValue('A'.$rows, $sn);
            $sheet->setCellValue('B'.$rows, $list->c_name);
            $sheet->setCellValue('C'.$rows, $list->phone1);
            $sheet->setCellValue('D'.$rows, $list->address);
            $sheet->setCellValue('E'.$rows, $list->course_full_name);
            
            $rows++;
            $sn++;
        }

        $writer = new Xlsx($spreadsheet);
		$writer->save("public/assets/excel_file/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        return $this->response->download(ROOTPATH."/public/assets/excel_file/".$fileName, null);
        exit;
    }
    public function set_enq_whatsapp_number($id, $ch){
        //echo $id.' '.$ch; exit;
        $enqData = $this->adminmodel->getAllEnquiry($id);
        $statusArr = explode(',',$enqData->status);
        if($ch == 'y'){
            unset($statusArr[array_search(1, $statusArr)]);
            array_push($statusArr, 2);
            $status = implode(',', $statusArr);
            $update = $this->commonmodel->updateRecord('tbl_ins_enquiry',['status'=>$status], ['enq_id'=>$id]);
        }else{
            unset($statusArr[array_search(2, $statusArr)]);
            if(empty($statusArr)){
                array_push($statusArr, 1);
            }
            $status = implode(',', $statusArr);
            $update = $this->commonmodel->updateRecord('tbl_ins_enquiry',['status'=>$status], ['enq_id'=>$id]);
        }
        if(isset($update)){
            $this->session->setFlashdata(['message'=>'Set whatsapp mark Successfully', 'type'=>'success']);
        }else{
            $this->session->setFlashdata(['message'=>'Something went wrong...', 'type'=>'danger']);
        }
        return redirect()->to(base_url('/admin/enquiry'));
    }
    public function set_non_whatsapp_number($id){
        //echo $id.' '.$ch; exit;
        $enqData = $this->adminmodel->getAllEnquiry($id);
        $statusArr = explode(',',$enqData->status);
        unset($statusArr[array_search(1, $statusArr)]);
        if(empty($statusArr)){
            array_push($statusArr, 7);
        }
        $status = implode(',', $statusArr);
            $update = $this->commonmodel->updateRecord('tbl_ins_enquiry',['status'=>$status,'update_at'=>date('Y-m-d H:i:s')], ['enq_id'=>$id]);
        if(isset($update)){
            $this->session->setFlashdata(['message'=>'Set Non-Whatsapp mark Successfully', 'type'=>'success']);
        }else{
            $this->session->setFlashdata(['message'=>'Something went wrong...', 'type'=>'danger']);
        }
        return redirect()->to(base_url('/admin/enquiry'));
    }
    public function send_whatsapp_message_to_enquiry($page=null){
        
        $enq_list = $this->adminmodel->getAllEnquiry('', 2 ,$page);
        //print_r($enq_list); exit;
        $settings = $this->commonmodel->get_setting(1);
        $msg_not_accepted_status_list = array();
        if(!empty($enq_list)){
            foreach($enq_list as $list){
                $to_number = '+91'.$list->phone1;
                $messageBody = [
                    "messaging_product"=>"whatsapp",
                    //"recipient_type" => "individual",
                    "to" => "$to_number",
                    "type" => "template",
                    "template" => [
                        //"name" => "hello_world",
                        "name" => $settings->wh_template,
                        "language" => [
                            'code' => "en_US"
                        ],
                    ]
                ];

                $curl = curl_init();
                //$from_phone_number_id = 174421629079556;
                //$WHATSAPP_ACCESS_TOKEN = "EAADjTjNOf98BO1h2FuvkuoJnngDNSllJQEj9wU6QhOchnu6m5j7T9tQsbsXGH5m8cDB8e73FkyLT40sCxoElCMvr5F57J7SxGccGfrDb91x2cftMQcul14Rzd8zdQWQ923il97UeIkWMAxjsGrBghiZAzyMNUPCoin4xVWzZBNkhyFe75MbygQ7GjLbkJEnXAAtnoYi5Sf73oDDv5a";
                //$WHATSAPP_ACCESS_TOKEN = "EAADjTjNOf98BO7r8V1p0Rvi7bLK1vkmecZCzvesCUQIDm2vdreznMlLUCddo888SoyOKZBNUqYnFdATw3eEbLdlnG2ojn6KGU8DJoZBAtw23QvJXUxI1EXthx7ZCE5i4s3hMOg4dzcxuGa0ZCz3EXnwMfc5wLKWMkAW1W6qCYVdMIyt0eZATAyDiIgHZBJWFZAQJ0umdqwLMnE7qZCzjjsZCUZD";
                curl_setopt_array($curl, array(
                    //CURLOPT_URL => 'https://graph.facebook.com/v13.0/FROM_PHONE_NUMBER_ID/messages',
                    CURLOPT_URL => 'https://graph.facebook.com/v17.0/'.FROM_PHONE_NUMBER.'/messages',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($messageBody),
                    CURLOPT_HTTPHEADER => array(
                        "Authorization:Bearer ".WHATSAPP_ACCESS_TOKEN,
                        'Content-Type: application/json'
                    ),
                ));
                $response = json_decode(curl_exec($curl), true);
                $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
                if(!isset($response['messages'][0]['message_status']) || $response['messages'][0]['message_status'] != 'accepted'){
                    $msg_not_accepted_status_list[] = $list;
                }else{
                    $this->commonmodel->updateRecord('tbl_ins_enquiry',['wh_msg_send_date'=>date('Y-m-d H:i:s')], ['enq_id'=>$list->enq_id]);
                    sleep(5);
                }
                
            }
            if(empty($msg_not_accepted_status_list)){
                $this->session->setFlashdata(['message'=>'Message successfully send to all list', 'type'=>'success']);
            }else{
                //echo '<pre>'; print_r($msg_not_accepted_status_list);
                $this->data['enquiry'] = $msg_not_accepted_status_list;
                return view('admin/ins_manage/wh_messageNotSend_index', $this->data);
                exit;
            }
        }else{
            $this->session->setFlashdata(['message'=>'No any number on whatsapp...', 'type'=>'danger']);
        }
        $url = base_url('admin/enquiry_list?status=2');
        if($this->session->has('enqurl')){
			$url = $this->session->get('enqurl');
		}
        return redirect()->to($url);
    }
    public function download_ins_enquiry_format(){
        $fileName = 'enq_list_csv_format.xlsx';
        return $this->response->download(ROOTPATH."/public/assets/".$fileName, null);
        exit;

    }
    public function ins_enq_csv_file_upload(){
        if ($this->request->getMethod() == 'post') {
            $result = array();
            $validation = $this->validate([
                'csv_file' =>[
                        //'rules'=>'uploaded[image]|max_size[image,50]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                        'rules'=>'uploaded[csv_file]|ext_in[csv_file,csv]',
                        'errors'=>[
                            'uploaded'=>'Please upload .csv file!',
                            // 'max_size'=>'Image should not greater than 100 KB of size.',
                            'ext_in'=>'File must be extension with .csv',
                        ]
                    ],
            ]);
            if (!$validation) {
                $validator = $this->validator;
                $errors = array(
                    'csv_file' =>$validator->getError('csv_file'),
                );
                $result['error'] = $errors;
            } else {
                $recNo = 0;
                $csv = $_FILES['csv_file']['tmp_name'];
                $handle = fopen($csv,"r");
                while (($row = fgetcsv($handle, 10000, ",")) != FALSE)
                {
                    if($recNo >= 1){
                        $data = array();
                        echo '<pre>'; print_r($row);
                    }
                    $recNo++;
                }

            }
            echo json_encode($result); exit;
        }else{
            return redirect()->to(base_url('admin/enquiry'));
        }
        
    }
    /**************************************For Developer************************************************** */
    public function export(){
        $contactList = $this->commonmodel->getAllRecord('tbl_mdalam_students');
        foreach($contactList as $list){
            $data = array(
                'c_name' => $list->student_name,
                'phone1' => $list->contact_no,
                'address' => $list->address,
                //'course_for' => 2,
                'ref_by' => 'mdalam_students',
                'added_at' => date('Y-m-d H:i:s'),
            );
            //$data['course_for'] = $list->course_id;
            $data['status'] = 1;
            /*if($list->is_whatsapp){
                $data['status'] = 2;
            }
            if($list->bootcamp == 'IE'){
                $data['course_for'] = 7;
            }
            if($list->bootcamp == 'HC'){
                $data['course_for'] = 3;
            }*/
            $this->commonmodel->insertRecord('tbl_ins_enquiry', $data);
        }
        echo 'completed'; exit;
    }
    /**************************************CMS************************************************************ */
    public function cms()
	{
        $this->data['cms'] = $this->commonmodel->getAllRecord('tbl_cms');
        return view('admin/cms/cms_index', $this->data);
	}
    public function add_edit_cms($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'page'=>'required',
                'title'=>'required',
                'short_desc'=>'required',
                'cms_banner'=>[
                    //'rules'=>'uploaded[image]|max_size[image,50]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                    'rules'=>'max_size[cms_banner,524288000]|ext_in[cms_banner,png,jpg,jpeg,bmp,gif]',
                    'errors'=>[
                    //'uploaded'=>'Image is required.',
                    'max_size'=>'Image must not have size more than 500 MB in length.',
                    'ext_in'=>'File must have extension with png, gif, jpg, jpeg, bmp.',
                    ]
                ],
                //'description1'=>'required',
                'status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
                //return view('admin/cms/add_edit_cms', $this->data);
            }else{
                //$id = $this->request->getPost('id');
                if($_FILES['cms_banner']['name'] != ''){
                    if($img = $this->request->getFile('cms_banner')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'ban_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                            
                            $data['cms_banner'] = $newName;
                        }
                    }
                }
                $data['page'] = $_POST['page'];
                $data['title'] = $_POST['title'];
                $data['short_desc'] = $_POST['short_desc'];
                $data['description1'] = $_POST['description1'];
                //$data['description2'] = $_POST['description2'];
                //$data['description3'] = $_POST['description3'];
                //$data['description4'] = $_POST['description4'];
                //$data['description5'] = $_POST['description5'];
                $data['status'] = $_POST['status'];
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_cms', $data);
                    if($inserted){
                        session()->setFlashdata(['message'=>'CMS added successfuly','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }else{
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_cms', $data, ['id'=>$id]);
                    if($updated){
                        session()->setFlashdata(['message'=>'CMS Updated Successfully','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }
                
                return redirect()->to(site_url('admin/cms'));
            }
            
        }
        if($id){
            $this->data['cms'] = $this->commonmodel->getOneRecord('tbl_cms', ['id'=>$id]);
        }
        return view('admin/cms/add_edit_cms', $this->data);
    }
    public function delete_cms($id){
        if(!$id){
            return redirect()->to(site_url('admin/cms'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_cms',['id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'CMS Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'CMS Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/cms'));
        }
    }
    /******************************************Blogs*********************************** */
    public function blogs(){
        $this->data['blogs'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_blog','',['blg_id','desc']);
        return view('admin/blogs/index', $this->data);
	}
    public function add_edit_blog($id=''){
        date_default_timezone_set('Asia/Kolkata');
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'blog_title'=>'required',
                'blog_url'=>'required',
                'blog_details'=>'required',
                'meta_title'=>'required',
                'meta_description'=>'required',
                'meta_keyword'=>'required',
                'post_date'=>'required',
                'blog_added_by'=>'required',
                'blog_status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                if($_FILES['blog_image']['name'] != ''){
                    if($img = $this->request->getFile('blog_image')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $imgnameArr = explode('.',$imgname);
                            $ext = end($imgnameArr);
                            $blogImgName = str_replace(' ','',$imgnameArr[0]);
                            $newName = $blogImgName.'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $data['blog_image'] = $newName;
                }
                $data['blog_title'] = $_POST['blog_title'];
                $data['blog_url'] = $_POST['blog_url'];
                $data['blog_details'] = $_POST['blog_details'];
                $data['meta_title'] = $_POST['meta_title'];
                $data['meta_description'] = $_POST['meta_description'];
                $data['summary'] = $_POST['summary'];
                $data['meta_keyword'] = $_POST['meta_keyword'];
                $data['post_date'] = $_POST['post_date'];
                $data['blog_added_by'] = $_POST['blog_added_by'];
                $data['alt_text'] = $_POST['alt_text'];
                $data['title_text'] = $_POST['title_text'];
                $data['blog_status'] = $_POST['blog_status'];
                $data['added_at'] = date('Y-m-d H:i:s');
                if(!$id){
                    $inserted = $this->commonmodel->insertRecord('tbl_blog', $data);
                    if($inserted){
                        session()->setFlashdata(['message'=>'Blogs added successfuly', 'type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                    }
                }else{
                    $updated = $this->commonmodel->updateRecord('tbl_blog', $data, ['blg_id'=>$id]);
                    if($updated){
                        session()->setFlashdata(['message'=>'Blogs updated successfuly', 'type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                    }
                }
                
                return redirect()->to(site_url('admin/blogs'));
            }
        }
        if($id){
            $this->data['blog'] = $this->commonmodel->getOneRecord('tbl_blog', ['blg_id'=>$id]);
        }
        return view('admin/blogs/add_edit_blog', $this->data);
    }
    public function upload_blog_image_in_description(){
		if(isset($_FILES['upload']['name']))
		{
            //print_r($_FILES); exit;
			$file = $_FILES['upload']['tmp_name'];
			$file_name = $_FILES['upload']['name'];
			$file_name_array = explode(".", $file_name);
			$extension = end($file_name_array);
			$new_image_name = rand() . '.' . $extension;
			//chmod('upload', 0777);
			$allowed_extension = array("jpg", "gif", "png","PNG");
			if(in_array($extension, $allowed_extension))
			{
				move_uploaded_file($file, './public/assets/images/blog_desc_img/' . $new_image_name);
				$function_number = $_GET['CKEditorFuncNum'];
				$url = base_url('public/assets/images/blog_desc_img/'.$new_image_name);
				//$url = '/public/assets/images/blog_desc_img/' . $new_image_name;
				$message = '';
				echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('$function_number', '$url', '$message');</script>";
			}
		}
	}
    public function delete_blog($id){
        if(!$id){
            return redirect()->to(site_url('admin/blogs'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_blog',['blg_id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Blog Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Blog Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/blogs'));
        }
    }
    public function blog_faq($blg_id, $id=null){
        if(!$blg_id){
            return redirect()->to(site_url('admin/blogs'));
        }else{
            if($this->request->getMethod() == 'post'){
                //print_r($_POST); exit;
                if($this->request->getPost('type') == 'add_faq'){
                    $validation = $this->validate([
                        'faq_title'=>'required',
                        'faq_description'=>'required',
                    ]);
                    if(!$validation){
                        $this->data['validation'] = $this->validator;
                    }else{
                        //$id = '';
                        $data['blg_id'] = $_POST['blg_id'];
                        $data['faq_title'] = $_POST['faq_title'];
                        $data['faq_description'] = $_POST['faq_description'];
                        $data['status'] = $_POST['status'];
                        $data['added_at'] = date('Y-m-d H:i:s');
                        if(!$id){
                            $inserted = $this->commonmodel->insertRecord('tbl_blog_faq', $data);
                            if($inserted){
                                session()->setFlashdata(['message'=>'Blog Faq added successfuly', 'type'=>'success']);
                            }else{
                                session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                            }
                        }else{
                            $updated = $this->commonmodel->updateRecord('tbl_blog_faq', $data, ['id'=>$id]);
                            if($updated){
                                session()->setFlashdata(['message'=>'Blog Faq updated successfuly', 'type'=>'success']);
                            }else{
                                session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                            }
                        }
                        
                        return redirect()->to(site_url('admin/blog_faq/'.$blg_id));
                    }
                }
            }
            $this->data['blog'] = $this->commonmodel->getOneRecord('tbl_blog',['blg_id'=>$blg_id]);
            $this->data['blogFaqs'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_blog_faq',['blg_id'=>$blg_id],['id','desc']);
            if($id){
                $this->data['faq'] = $this->commonmodel->getOneRecord('tbl_blog_faq',['id'=>$id]);
            }
            if(empty($this->data['blog'])){
                return redirect()->to(base_url('/admin/blogs'));
            }
            return view('admin/blogs/blogFaqIndex', $this->data);
        }
    }
    public function delete_blog_faq($blg_id, $id=null){
        if(!$id){
            return redirect()->to(site_url('admin/blogs'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_blog_faq',['id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Blog Faq Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Blog Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/blog_faq/'.$blg_id));
        }
    }
    /******************************************Faq*********************************** */
    public function faq(){
        $this->data['faqs'] = $this->adminmodel->get_faqs();
        return view('admin/faq/index', $this->data);
	}
    public function add_edit_faq($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'faq_for'=>'required',
                'faq_title'=>'required',
                'faq_description'=>'required',
                //'faq_position'=>'required',
                'faq_status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                //$id = $this->request->getPost('faq_id');
                //if($_FILES['logo']['name'] != ''){
                //    if($img = $this->request->getFile('logo')){ 
                //        $imgname = $img->getName();
                //        if($img->isValid() && !$img->hasMoved()){
                //            $ext = explode('.',$imgname);
                //            $ext = end($ext);
                //            $newName = 't_'.time().'.'.$ext;
                //            $img->move('./public/assets/images/upload/testimonial/',$newName);
                //        }
                //    }
                //    $data['logo'] = $newName;
                //}else{
                //    if($id){
                //        $data['logo'] = $_POST['logo2'];
                //    }else{
                //        $data['logo'] = '';
                //    }
                //}
                $data['faq_for'] = $_POST['faq_for'];
                $data['faq_title'] = $_POST['faq_title'];
                $data['faq_description'] = $_POST['faq_description'];
                //$data['faq_position'] = $_POST['faq_position'];
                $data['faq_status'] = $_POST['faq_status'];
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_faqs', $data);
                }else{
                    $data['modified_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_faqs', $data, ['faq_id'=>$id]);
                }
                    
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Faq added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Faq updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/faq'));
            }

        }
        if($id){
            $this->data['faq'] = $this->commonmodel->getOneRecord('tbl_faqs', ['faq_id'=>$id]);
        }
        $this->data['pages'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_page', ['status'=>'1'], ['id','desc']);
        return view('admin/faq/add_edit_faq', $this->data);
    }
    public function delete_faq($id){
        if(!$id){
            return redirect()->to(site_url('admin/faq'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_faqs',['faq_id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'faq Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Faq Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/faq'));
        }
    }
    /***************************************Testimonial****************************** */
    public function testimonial()
	{
        $this->data['testimonial'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_testimonial','',['id','desc']);
        return view('admin/testimonial/index', $this->data);
	}
    public function add_edit_testimonial($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'type'=>'required',
                //'description'=>'required',
                //'post'=>'required',
                'status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                if($_FILES['logo']['name'] != ''){
                    if($img = $this->request->getFile('logo')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 't_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $data['logo'] = $newName;
                }
                $data['name'] = $_POST['name'];
                $data['description'] = $_POST['description'];
                $data['post'] = $_POST['post'];
                $data['type'] = $_POST['type'];
                $data['youtube_vlink'] = $_POST['youtube_vlink'];
                $data['status'] = $_POST['status'];

                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_testimonial', $data);
                }else{
                    $data['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_testimonial', $data, ['id'=>$id]);
                }
                    
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Record added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Record updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/testimonial'));
                
            }

        }
        if($id){
            $this->data['testimonial'] = $this->commonmodel->getOneRecord('tbl_testimonial', ['id'=>$id]);
        }
        return view('admin/testimonial/add_edit_testimonial', $this->data);
    }
    public function delete_testimonial($id){
        if(!$id){
            return redirect()->to(site_url('admin/testimonial'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_testimonial',['id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/testimonial'));
        }
    }
    /***********************************************Manage Banner************************************** */
    public function banner()
	{
        $this->data['banner'] = $this->commonmodel->get_banners();
        return view('admin/banner/index', $this->data);
	}
    public function add_edit_banner($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'page'=>'required',
                //'url'=>'required',
                'main_title'=>'required',
                'sub_title'=>'required',
                'status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                if($_FILES['brochure']['name'] != ''){
                    if($img = $this->request->getFile('brochure')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'ban_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $data['brochure'] = $newName;
                }
                // $data['dh_id'] = session('dh_id');
                $data['main_title'] = $_POST['main_title'];
                $data['sub_title'] = $_POST['sub_title'];
                $data['page'] = $_POST['page'];
                $data['url'] = $_POST['banner_url'];
                $data['button_title'] = $_POST['button_title'];
                $data['img_alt'] = $_POST['img_alt'];
                $data['img_title'] = $_POST['img_title'];
                $data['status'] = $_POST['status'];
                if(!$id){
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_banner', $data);
                }else{
                    $data['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_banner', $data, ['id'=>$id]);
                }
                    
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Record added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Record updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/banner'));
                
            }

        }
        if($id){
            $this->data['banner'] = $this->commonmodel->getOneRecord('tbl_banner', ['id'=>$id]);
        }
        $this->data['pages'] = $this->commonmodel->getAllRecord('tbl_page',['status'=>'1']);
        return view('admin/banner/add_edit_banner', $this->data);
    }
    public function delete_banner($id){
        if(!$id){
            return redirect()->to(site_url('admin/banner'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_banner',['id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/banner'));
        }
    }
    /****************************************COURSE MANAGEMENT******************************************* */
    public function courses(){
        $this->data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses','',['course_id','DESC']);
        return view('admin/course/courses_index', $this->data);
    }
    public function add_edit_course($id=false){
        if($this->request->getMethod() == 'post'){
            $id = (isset($_POST['course_id']) && $_POST['course_id'] != '')?$_POST['course_id']:0;
            if($id){
                $course_dtls = $this->commonmodel->getOneRecord('tbl_courses', ['course_id'=>$id]);
            }
            if($this->request->getPost('submit') == 'basic'){
                $tabname = 'Basic';
                $validation = $this->validate([
                    'course_full_name'=>'required',
                    'short_description'=>'required',
                    /*'description'=>[
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Course Overview is required',
                        ]
                    ],*/
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{
                    if($_FILES['image']['name'] != ''){
                        if($img = $this->request->getFile('image')){ 
                            $imgname = $img->getName();
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $newName = 'c_'.time().'.'.$ext;
                                $img->move('./public/assets/upload/images/',$newName);
                            }
                        }
                        $data['image'] = $newName;
                    }
                    if($_FILES['youtube_vlink_image']['name'] != ''){
                        if($img = $this->request->getFile('youtube_vlink_image')){ 
                            $imgname = $img->getName();
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $newName = 'yimg_'.time().'.'.$ext;
                                $img->move('./public/assets/upload/images/',$newName);
                            }
                        }
                        $data['youtube_vlink_image'] = $newName;
                    }
                    $data['course_full_name'] = $_POST['course_full_name'];
                    $data['url'] = $_POST['url'];
                    $data['short_description'] = $_POST['short_description'];
                    $data['img_alt'] = $_POST['img_alt'];
                    $data['img_title'] = $_POST['img_title'];
                    // $data['meta_description'] = $_POST['meta_description'];
                    $data['youtube_vlink'] = $_POST['youtube_vlink'];
                    $data['complete_tab'] = 1;
                   
                }
            }
            if($this->request->getPost('submit') == 'tnd'){
                //print_r($_POST);exit;
                $tabname = 'Time & Duration';
                $validation = $this->validate([
                    'next_batch_line1'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Line1 is required',
                        ]
                    ],
                    'next_batch_line2'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Line2 is required',
                        ]
                    ],
                    
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{
                    $data['next_batch_line1'] = date('Y-m-d',strtotime($_POST['next_batch_line1']));
                    $data['next_batch_line2'] = $_POST['next_batch_line2'];
                    $data['prg_duration_line1'] = $_POST['prg_duration_line1'];
                    $data['prg_duration_line2'] = $_POST['prg_duration_line2'];
                    $data['bootcamp_line1'] = $_POST['bootcamp_line1'];
                    $data['bootcamp_line2'] = $_POST['bootcamp_line2'];
                    $data['complete_tab'] = 2;
                }
            }
            if($this->request->getPost('submit') == 'online'){
                $tabname = 'Online';
                $validation = $this->validate([
                    'online_course_price'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Online Course Price is required',
                        ]
                    ],
                    
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{
                    $headarr = $_POST['head'];
                    $dtlsarr = $_POST['dtls'];
                    $onlinedata = array();
                    for($i=0; $i < count($headarr); $i++){
                        if($headarr[$i] != '' && $dtlsarr[$i] != ''){
                            $onlinedata[$i]['head'] = $headarr[$i];
                            $onlinedata[$i]['dtls'] = $dtlsarr[$i];
                        }
                    }
                    $jsononlinedata = json_encode($onlinedata);
                    if(!empty($onlinedata)){
                        $data['online'] = $jsononlinedata;
                        $data['online_course_price'] = $_POST['online_course_price'];
                        $data['complete_tab'] = 3;
                    }else{
                        session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                    }
                }
                //print_r($_POST); exit;
            }
            if($this->request->getPost('submit') == 'ofline'){
                $tabname = 'Ofline';
                $validation = $this->validate([
                    'ofline_course_price'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Ofline Course Price is required',
                        ]
                    ],
                    
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{
                    $headarr = $_POST['head'];
                    $dtlsarr = $_POST['dtls'];
                    $oflinedata = array();
                    for($i=0; $i < count($headarr); $i++){
                        if($headarr[$i] != '' && $dtlsarr[$i] != ''){
                            $oflinedata[$i]['head'] = $headarr[$i];
                            $oflinedata[$i]['dtls'] = $dtlsarr[$i];
                        }
                    }
                    $jsonoflinedata = json_encode($oflinedata);
                    if(!empty($oflinedata)){
                        $data['ofline'] = $jsonoflinedata;
                        $data['ofline_course_price'] = $_POST['ofline_course_price'];
                        $data['complete_tab'] = 4;
                    }else{
                        session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                    }
                }
                //print_r($_POST); exit;
            }
            // About the Program
            if($this->request->getPost('submit') == 'about'){
                $tabname = 'About the Program';
                $about_prg_Arr = array();
                $k = 0;
                for($n = 0; $n < 3; $n++){
                    $imgName = '';
                    if($_FILES['about_img']['name'][$n] != ''){
                        if($img = $this->request->getFile('about_img.'.$n)){ //main line 
                            $imgname = $img->getName();
                            
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $imgName = 'about_img_'.$n.time().'.'.$ext;
                                $img->move('./public/assets/upload/images/',$imgName);
                            }
                        }
                    }else if($_POST['old_about_img'][$n] != ''){
                        $imgName = $_POST['old_about_img'][$n];
                    }

                    if($_POST['about_title'][$n] != '' && $_POST['about_desc'][$n] != ''){
                        $about_prg_Arr[$k]['about_title'] = $_POST['about_title'][$n];
                        $about_prg_Arr[$k]['about_desc'] = $_POST['about_desc'][$n];
                        $about_prg_Arr[$k]['about_img'] = $imgName;
                        $k++;
                    }

                }
                if(!empty($about_prg_Arr)){
                    $data['about_program'] = json_encode($about_prg_Arr);
                    $data['description'] = $_POST['description'];
                    $data['complete_tab'] = 5;
                }else{
                    session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                }
                
            }
            if($this->request->getPost('submit') == 'key-feature'){
                $tabname = 'key-features';
                if(count(array_filter($_POST['key_feature'])) > 0){
                    $data['key_features'] = json_encode(array_filter($_POST['key_feature']));
                    $data['complete_tab'] = 6;
                }else{
                    session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                }

            }
            
            if($this->request->getPost('submit') == 'course-breakdown'){
                //print_r($_POST);exit;
                $tabname = 'Course Breakdown';
                $validation = $this->validate([
                    'course_breakdown_desc' => 'required',
                    'prg_duration_line1'=> 'required',
                    'live_class'=> 'required',
                    'real_project'=> 'required',
                    'specializations'=> 'required',
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{ 
                    $data['course_breakdown_desc'] = $_POST['course_breakdown_desc'];
                    $data['prg_duration_line1'] = $_POST['prg_duration_line1'];
                    $data['live_class'] = $_POST['live_class'];
                    $data['real_project'] = $_POST['real_project'];
                    $data['specializations'] = $_POST['specializations'];
                    $data['complete_tab'] = 7;
                }

            }
            if($this->request->getPost('submit') == 'course-intro'){
                $tabname = 'course Intro';
                $count = count($_POST['module_name']);
                $course_intro_data = array();
                for($c = 0; $c < $count; $c++){
                    if($_POST['module_name'][$c] !='' && $_POST['module_duration'][$c] !='' && $_POST['module_syllabus'][$c] !=''){
                        $course_intro_data[$c]['module_name'] = $_POST['module_name'][$c];
                        $course_intro_data[$c]['module_duration'] = $_POST['module_duration'][$c];
                        $course_intro_data[$c]['module_syllabus'] = $_POST['module_syllabus'][$c];
                    }
                }
                //print_r($course_intro_data); exit;
                if(!empty($course_intro_data)){
                    $data['course_intro'] = json_encode($course_intro_data);
                    $data['complete_tab'] = 8;
                }else{
                    session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                }
            }
            if($this->request->getPost('submit') == 'faq'){
                $tabname = 'FAQ';
                $count = count($_POST['faq_title']);
                $faq_data = array();
                for($c = 0; $c < $count; $c++){
                    if($_POST['faq_title'][$c] !='' && $_POST['faq_desc'][$c] !='' ){
                        $faq_data[$c]['faq_title'] = $_POST['faq_title'][$c];
                        $faq_data[$c]['faq_desc'] = $_POST['faq_desc'][$c];
                    }
                }
                //print_r($course_intro_data); exit;
                if(!empty($faq_data)){
                    $data['faq'] = json_encode($faq_data);
                    $data['complete_tab'] = 9;
                }else{
                    session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                }
            }
            if($this->request->getPost('submit') == 'stu-stories'){
                $tabname = 'Student Stories';
                if(isset($course_dtls) && $course_dtls->stu_stories != ''){
                    $db_stu_stories = json_decode($course_dtls->stu_stories);
                }
                $stu_stories = array();
                $k = 0;
                $count = count($_POST['v_link']);
                for($n = 0; $n < $count; $n++){
                    $imgName = '';
                    if($_FILES['photo']['name'][$n] != ''){
                        if($img = $this->request->getFile('photo.'.$n)){ //main line 
                            $imgname = $img->getName();
                            
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $imgName = 'stusto_img_'.$n.time().'.'.$ext;
                                $img->move('./public/assets/upload/images/',$imgName);
                            }
                        }
                    }
                    if($imgName == '' && isset($db_stu_stories) && isset($db_stu_stories[$n]->photo)){
                        $imgName = $db_stu_stories[$n]->photo;
                    }
                    //if($_POST['v_link'][$n] != '' && $imgName != ''){
                    if($imgName != ''){
                        $stu_stories[$k]['v_link'] = $_POST['v_link'][$n];
                        $stu_stories[$k]['photo'] = $imgName;
                        $k++;
                    }

                }
                if(!empty($stu_stories)){
                    $data['stu_stories_desc'] = $_POST['stu_stories_desc'];
                    $data['stu_stories'] = json_encode($stu_stories);
                    $data['complete_tab'] = 10;
                }else{
                    session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                }
                
            }
            if($this->request->getPost('submit') == 'publish'){
                //print_r($_POST);exit;
                $tabname = 'Publish';
                $data['is_popular'] = $_POST['is_popular'];
                $data['status'] = $_POST['status'];
                //$data['complete_tab'] = 6;

            }
            if($this->request->getPost('submit') == 'seo'){
                $tabname = 'SEO';
                $validation = $this->validate([
                    'og_title'=>'required',
                    'meta_title'=>'required',
                    /*'description'=>[
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Course Overview is required',
                        ]
                    ],*/
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{
                    if($_FILES['og_image']['name'] != ''){
                        if($img = $this->request->getFile('og_image')){ 
                            $imgname = $img->getName();
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $newName = 'ogimg_'.time().'.'.$ext;
                                $img->move('./public/assets/upload/images/',$newName);
                            }
                        }
                        $data['og_image'] = $newName;
                    }
                    
                    $data['og_type'] = $_POST['og_type'];
                    $data['og_url'] = $_POST['og_url'];
                    $data['og_title'] = $_POST['og_title'];
                    $data['og_site_name'] = $_POST['og_site_name'];
                    $data['og_description'] = $_POST['og_description'];
                    // $data['short_description'] = $_POST['short_description'];
                    $data['meta_title'] = $_POST['meta_title'];
                    $data['meta_keyword'] = $_POST['meta_keyword'];
                    $data['meta_description'] = $_POST['meta_description'];
                    // $data['youtube_vlink'] = $_POST['youtube_vlink'];
                    // $data['complete_tab'] = 1;
                   
                }
            }
            if(isset($data) && !empty($data)){
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_courses', $data);
                }else{
                    $data['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_courses', $data, ['course_id '=>$id]);
                }
                    
                if(isset($inserted)){
                    $id = $inserted;
                    session()->setFlashdata(['message'=>$tabname.' added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>$tabname.' updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                if($id){
                    return redirect()->to(site_url('admin/add_edit_course/'.$id));
                }else{
                    return redirect()->to(site_url('admin/courses'));
                }
            }
        }
        if($id){
            $this->data['course'] = $this->commonmodel->getOneRecord('tbl_courses', ['course_id'=>$id]);
        }
        //$this->data['course_category'] = $this->commonmodel->getAllRecord('tbl_course_category',['status'=>'1']);
        //$this->data['instructors'] = $this->commonmodel->getAllRecord('tbl_instructor',['status'=>1]);
        return view('admin/course/add_edit_course', $this->data);
    }
    public function delete_course($id){
        if(!$id){
            return redirect()->to(site_url('admin/courses'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_courses',['course_id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/courses'));
        }
    }
    /****************************************WEBSITE MANAGEMENT******************************************* */
    public function update_home_section(){
        if($this->request->getMethod() == 'post'){
            $tabname = '';
            $id = ($_POST['id'] != '')?$_POST['id']:'';
            $updateData = array();
            $updateData['dh_id'] = session('dh_id');
            if($this->request->getPost('submit') == 'sec1'){
                $tabname = 'Section-1';
                $updateData['is_show_sec1'] = (isset($_POST['is_show_sec1']))?$_POST['is_show_sec1']:0;
                $updateData['sec1_title'] = $_POST['sec1_title'];
                $updateData['col1_title'] = $_POST['col1_title'];
                $updateData['col1_desc'] = $_POST['col1_desc'];
                $updateData['col2_title'] = $_POST['col2_title'];
                $updateData['col2_desc'] = $_POST['col2_desc'];
                $updateData['col3_title'] = $_POST['col3_title'];
                $updateData['col3_desc'] = $_POST['col3_desc'];
            }
            if($this->request->getPost('submit') == 'sec2'){
                $tabname = 'Section-3';
                $updateData['is_show_sec2'] = (isset($_POST['is_show_sec2']))?$_POST['is_show_sec2']:0;
                if($_FILES['sec2_banner']['name'] != ''){
                    if($img = $this->request->getFile('sec2_banner')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 's2ban_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $updateData['sec2_banner'] = $newName;
                }
            }
            if($this->request->getPost('submit') == 'sec3'){
                $tabname = 'Section-2';
                $updateData['is_show_sec3'] = (isset($_POST['is_show_sec3']))?$_POST['is_show_sec3']:0;
                $updateData['sec3_content'] = $_POST['sec3_content'];
            }
            if($this->request->getPost('submit') == 'sec4'){
                $tabname = 'Section-4';
                $updateData['is_show_sec4'] = (isset($_POST['is_show_sec4']))?$_POST['is_show_sec4']:0;
                $slideImages = array();
                $count = count($_FILES['slideImages']['name']);
                for($n=0; $n<$count; $n++){
                    if($_FILES['slideImages']['name'][$n] != ''){
                        if($img = $this->request->getFile('slideImages.'.$n)){ //main line 
                            $imgname = $img->getName();
                            
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $newName = 'si_'.$n.time().'.'.$ext;
                                $img->move('./public/assets/upload/images/',$newName);

                                $slideImages[$n] = $newName;
                            }
                        }
                    }elseif($id && isset($_POST['slideImages2'][$n]) && $_POST['slideImages2'][$n] != ''){
                        $slideImages[$n] = $_POST['slideImages2'][$n];
                    }
                }
                if(!empty($slideImages)){
                    $updateData['images'] = implode(',', $slideImages);
                }
                //print_r($_POST);
                //exit;
            }
            if(!$id){
                $inserted = $this->commonmodel->insertRecord('tbl_home_section', $updateData);
            }else{
                $updateData['update_at'] = date('Y-m-d H:i:s');
                $updated = $this->commonmodel->updateRecord('tbl_home_section', $updateData, ['id '=>$id]);
            }
                
            if(isset($inserted)){
                session()->setFlashdata(['message'=>$tabname.' added successfuly', 'type'=>'success']);
            }else if(isset($updated)){
                session()->setFlashdata(['message'=>$tabname.' updated successfuly', 'type'=>'success']);
            }else{
                session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
            }
            return redirect()->to(site_url('admin/update_home_section'));
            
        }

        $data['sec1'] = $this->commonmodel->getOneRecord('tbl_home_section', ['dh_id'=>session('dh_id')]);
        return view('admin/home_section/home_page_section', $data);
    }
    public function update_about_us(){
        if($this->request->getMethod() == 'post'){
            $tabname = '';
            $id = ($_POST['id'] != '')?$_POST['id']:'';
            $updateData = array();
            $updateData['dh_id'] = session('dh_id');
            if($this->request->getPost('submit') == 'sec1'){
                $tabname = 'Section-1';
                $updateData['is_show_sec1'] = (isset($_POST['is_show_sec1']))?$_POST['is_show_sec1']:0;
                $updateData['vision_title'] = $_POST['vision_title'];
                $updateData['col1_t1'] = $_POST['col1_t1'];
                $updateData['col1_t2'] = $_POST['col1_t2'];
                $updateData['col2_t1'] = $_POST['col2_t1'];
                $updateData['col2_t2'] = $_POST['col2_t2'];
                $updateData['col3_t1'] = $_POST['col3_t1'];
                $updateData['col3_t2'] = $_POST['col3_t2'];
            }
            /*if($this->request->getPost('submit') == 'sec2'){
                $tabname = 'Section-3';
                $updateData['is_show_sec2'] = (isset($_POST['is_show_sec2']))?$_POST['is_show_sec2']:0;
                if($_FILES['sec2_banner']['name'] != ''){
                    if($img = $this->request->getFile('sec2_banner')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 's2ban_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $updateData['sec2_banner'] = $newName;
                }
            }*/
            if($this->request->getPost('submit') == 'sec2'){
                $tabname = 'Section-2';
                $updateData['is_show_sec2'] = (isset($_POST['is_show_sec2']))?$_POST['is_show_sec2']:0;
                $updateData['sec2_content'] = $_POST['sec2_content'];
            }
            if(!$id){
                $inserted = $this->commonmodel->insertRecord('tbl_about_us', $updateData);
            }else{
                $updateData['update_at'] = date('Y-m-d H:i:s');
                $updated = $this->commonmodel->updateRecord('tbl_about_us', $updateData, ['id '=>$id]);
            }
                
            if(isset($inserted)){
                session()->setFlashdata(['message'=>$tabname.' added successfuly', 'type'=>'success']);
            }else if(isset($updated)){
                session()->setFlashdata(['message'=>$tabname.' updated successfuly', 'type'=>'success']);
            }else{
                session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
            }
            return redirect()->to(site_url('admin/update_about_us'));
            
        }

        $data['sec1'] = $this->commonmodel->getOneRecord('tbl_about_us', ['dh_id'=>session('dh_id')]);
        return view('admin/about_us/about_us', $data);
    }
    public function update_fr_register_page(){
        if($this->request->getMethod() == 'post'){
            $tabname = '';
            $id = ($_POST['id'] != '')?$_POST['id']:'';
            $updateData = array();
            // $updateData['dh_id'] = session('dh_id');
            if($this->request->getPost('submit') == 'sec1'){
                $tabname = 'Section-1';
                // $updateData['is_show_sec1'] = (isset($_POST['is_show_sec1']))?$_POST['is_show_sec1']:0;
                $updateData['title_1'] = $_POST['title_1'];
                $updateData['title_2'] = $_POST['title_2'];
                $updateData['banner_content'] = $_POST['banner_content'];
                
                if($_FILES['banner_image']['name'] != ''){
                    if($img = $this->request->getFile('banner_image')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'ban_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $updateData['banner_image'] = $newName;
                }
            }
            if($this->request->getPost('submit') == 'sec2'){
                $tabname = 'Section-2';
                $updateData['is_show_sec2'] = (isset($_POST['is_show_sec2']))?$_POST['is_show_sec2']:0;
                if($_FILES['sec2_image']['name'] != ''){
                    if($img = $this->request->getFile('sec2_image')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 's2img_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $updateData['sec2_image'] = $newName;
                }
                $updateData['why_choose_us'] = $_POST['why_choose_us'];
                $updateData['comp_training'] = $_POST['comp_training'];
                $updateData['ongo_support'] = $_POST['ongo_support'];
                // $updateData['col3_t2'] = $_POST['col3_t2'];
            }
            if($this->request->getPost('submit') == 'sec3'){
                $tabname = 'Section-3';
                $updateData['is_show_sec3'] = (isset($_POST['is_show_sec3']))?$_POST['is_show_sec3']:0;
                if($_FILES['center_image']['name'] != ''){
                    if($img = $this->request->getFile('center_image')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'cimg_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $updateData['center_image'] = $newName;
                }
                $updateData['title1'] = $_POST['title1'];
                $updateData['text1'] = $_POST['text1'];
                $updateData['title2'] = $_POST['title2'];
                $updateData['text2'] = $_POST['text2'];
                $updateData['title3'] = $_POST['title3'];
                $updateData['text3'] = $_POST['text3'];
                $updateData['title4'] = $_POST['title4'];
                $updateData['text4'] = $_POST['text4'];
                $updateData['title5'] = $_POST['title5'];
                $updateData['text5'] = $_POST['text5'];
                $updateData['title6'] = $_POST['title6'];
                $updateData['text6'] = $_POST['text6'];
                $updateData['franchise'] = $_POST['franchise'];
                $updateData['yearsrd'] = $_POST['yearsrd'];
                $updateData['seminars'] = $_POST['seminars'];
                $updateData['audience'] = $_POST['audience'];
            }
            if($this->request->getPost('submit') == 'sec4'){
                $tabname = 'Section-4';
                $updateData['is_show_sec4'] = (isset($_POST['is_show_sec4']))?$_POST['is_show_sec4']:0;

                $updateData['f1dtl'] = $_POST['f1dtl'];
                if($_FILES['f1photo']['name'] != ''){
                    if($img = $this->request->getFile('f1photo')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'f1img_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $updateData['f1photo'] = $newName;
                }
                $updateData['f1name'] = $_POST['f1name'];
                $updateData['f1ocp'] = $_POST['f1ocp'];

                $updateData['f2dtl'] = $_POST['f2dtl'];
                if($_FILES['f2photo']['name'] != ''){
                    if($img = $this->request->getFile('f2photo')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'f2img_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $updateData['f2photo'] = $newName;
                }
                $updateData['f2name'] = $_POST['f2name'];
                $updateData['f2ocp'] = $_POST['f2ocp'];

                $updateData['f3dtl'] = $_POST['f3dtl'];
                if($_FILES['f3photo']['name'] != ''){
                    if($img = $this->request->getFile('f3photo')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'f3img_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $updateData['f3photo'] = $newName;
                }
                $updateData['f3name'] = $_POST['f3name'];
                $updateData['f3ocp'] = $_POST['f3ocp'];
            }
            if(!$id){
                $inserted = $this->commonmodel->insertRecord('tbl_frregister_page', $updateData);
            }else{
                $updateData['update_at'] = date('Y-m-d H:i:s');
                $updated = $this->commonmodel->updateRecord('tbl_frregister_page', $updateData, ['id '=>$id]);
            }
                
            if(isset($inserted)){
                session()->setFlashdata(['message'=>$tabname.' added successfuly', 'type'=>'success']);
            }else if(isset($updated)){
                session()->setFlashdata(['message'=>$tabname.' updated successfuly', 'type'=>'success']);
            }else{
                session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
            }
            return redirect()->to(site_url('admin/update_fr_register_page'));
            
        }

        $data['sec1'] = $this->commonmodel->getOneRecord('tbl_frregister_page', ['id'=>1]);
        return view('admin/front_franchise/update_fr_register_page', $data);
    }
    public function experts(){
        $this->data['experts'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_experts','',['exp_id','DESC']);
        return view('admin/ins_manage/experts_list', $this->data);
    }
    public function add_edit_experts($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'name'=>'required',
                //'url'=>'required',
                'short_desc'=>'required',
                //'sub_title'=>'required',
                'status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                if($_FILES['image']['name'] != ''){
                    if($img = $this->request->getFile('image')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'img_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $data['image'] = $newName;
                }
                $data['dh_id'] = session('dh_id');
                $data['name'] = $_POST['name'];
                //$data['url'] = $_POST['url'];
                $data['short_desc'] = $_POST['short_desc'];
                //$data['sub_title'] = $_POST['sub_title'];
                $data['status'] = $_POST['status'];
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_experts', $data);
                }else{
                    $data['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_experts', $data, ['exp_id'=>$id]);
                }
                    
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Record added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Record updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/experts'));
                
            }

        }
        if($id){
            $this->data['expert'] = $this->commonmodel->getOneRecord('tbl_experts', ['exp_id'=>$id]);
        }
        return view('admin/ins_manage/experts_cu', $this->data);
    }
    public function delete_expert($id){
        if(!$id){
            return redirect()->to(site_url('admin/experts'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_experts',['exp_id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/experts'));
        }
    }
    public function contact_us(){
        $url = base_url('admin/contact_us_listing?status=1');
        if(isset($_GET['status']) || isset($_GET['search'])){
            $status = (isset($_GET['status']))?$_GET['status']:'';
            $search = (isset($_GET['search']))?$_GET['search']:'';
            $http_query = http_build_query(array('status'=>$status,'search'=>$search));
            $url = base_url('admin/contact_us_listing?'.$http_query);
            $this->session->set('contactusurl', $url, 300);
        }elseif($this->session->has('contactusurl')){
			$url = $this->session->get('contactusurl');
		}
        
        return redirect()->to($url);
    }
    public function contact_us_listing(){
        // $contact = $this->commonmodel->getAllRecord('tbl_contact_us', ['status <='=>1]);
        // //print_r($contact); exit;

        // foreach($contact as $list){
        //     // $padded_id = str_pad($list->id,4,"0",STR_PAD_LEFT);
        //     // $reg_no = 'CBARATSE'.date('Y').date('m').$padded_id;
        //     // $no = 1100 + $list->id;
        //     // $roll_no = date('Y').date('m').$no;
        //     $data = array(
        //         'status' => 7,
        //     );
        //     $this->commonmodel->updateRecord('tbl_contact_us', $data, ['id'=>$list->id]);
        //     //echo $reg_no; exit;
        // }

        $this->data['contactuslist'] = $this->adminmodel->get_contact_us_list();
        $this->data['totcount'] = $this->adminmodel->get_totcount_contact_us_list();
        $this->data['newcount'] = $this->adminmodel->get_count_contact_us_list();
        $this->data['cnfcount'] = $this->adminmodel->get_count_contact_us_list(4);
        $this->data['cancount'] = $this->adminmodel->get_count_contact_us_list(3);
        $this->data['apdcount'] = $this->adminmodel->get_count_contact_us_list(5);
        $this->data['rescount'] = $this->adminmodel->get_count_contact_us_list(6);
        $this->data['bkpcount'] = $this->adminmodel->get_count_contact_us_list(7);
        return view('admin/ins_manage/contact_index', $this->data);
    }
    public function reset_contacturl(){
        if($this->session->has('contactusurl')){
			$this->session->remove('contactusurl');
		}
        return redirect()->to(base_url('admin/contact_us?status=1'));
    }

    public function change_status(){
        if($this->request->getMethod() == 'post'){
            $id = $_POST['contact_id'];
            $status = $_POST['status'];
            if($status == 4){
                $padded_id = str_pad($id,4,"0",STR_PAD_LEFT);
                $reg_no = 'CBARATSE'.date('Y').date('m').$padded_id;
                $no = 1100 + $id;
                $roll_no = date('Y').date('m').$no;
                $data = array(
                    'reg_no' => $reg_no,
                    'roll_no' => $roll_no,
                    'status' => $status,
                );
            }else{
                $data = array('status' => $status);
            }
            $updated = $this->commonmodel->updateRecord('tbl_contact_us', $data, ['id'=>$id]);
        
            if($updated){
                $this->session->setFlashdata(['message'=>'Record Updated Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Something went wrong...', 'type'=>'danger']);
            }
        }
        return redirect()->to(base_url('/admin/contact-us'));
    }
    public function export_to_excel($status=null){
        // maping old excel files and delete
        helper('filesystem');
		$path = './public/assets/excel_file/';
		$map = directory_map($path);
        if(!empty($map)){
            foreach($map as $m){
                unlink('./public/assets/excel_file/'.$m); //delete
            }
        }
        //print_r($map); exit;
        $fileName = 'CBARATSE_LIST'.time().'.xlsx';
        $confirmedList = $this->adminmodel->get_contact_us_list($status, 'ASC');
        //echo '<pre>'; print_r($confirmedList);  exit;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $sheet->setCellValue('A1', 'S.No.');
		$sheet->setCellValue('B1', 'Student Name');
        $sheet->setCellValue('C1', 'Phone');
        $sheet->setCellValue('D1', 'Reg. No');
        $sheet->setCellValue('E1', 'Roll No');
        $sheet->setCellValue('F1', 'Course');
        if($status == 6){
            $sheet->setCellValue('G1', 'Marks Obtained');
            $sheet->setCellValue('H1', 'Percentage');
        }
        $rows = 2;
        $sn = 1;
        foreach($confirmedList as $list){
            $sheet->setCellValue('A'.$rows, $sn);
            $sheet->setCellValue('B'.$rows, $list->name);
            $sheet->setCellValue('C'.$rows, $list->phone);
            $sheet->setCellValue('D'.$rows, $list->reg_no);
            $sheet->setCellValue('E'.$rows, $list->roll_no);
            $sheet->setCellValue('F'.$rows, $list->course_full_name);
            if($status == 6){
                $sheet->setCellValue('G'.$rows, $list->marks_obtained);
                $sheet->setCellValue('H'.$rows, $list->result_percentage);
            }
            $rows++;
            $sn++;
        }

        $writer = new Xlsx($spreadsheet);
		$writer->save("public/assets/excel_file/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        return $this->response->download(ROOTPATH."/public/assets/excel_file/".$fileName, null);
        exit;
    }
    public function delete_contact($id){
        if(!$id){
            return redirect()->to(site_url('admin/contact-us'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_contact_us',['id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/contact-us'));
        }
    }
    public function set_whatsapp_number($id, $ch){
        if($ch == 'y'){
            $update = $this->commonmodel->updateRecord('tbl_contact_us',['is_whatsapp'=>1], ['id'=>$id]);
        }else{
            $update = $this->commonmodel->updateRecord('tbl_contact_us',['is_whatsapp'=>0], ['id'=>$id]);
        }
        if(isset($update)){
            $this->session->setFlashdata(['message'=>'Set whatapp mark Successfully', 'type'=>'success']);
        }else{
            $this->session->setFlashdata(['message'=>'Something went wrong...', 'type'=>'danger']);
        }
        return redirect()->to(base_url('/admin/contact-us'));
    }
    public function subscriber(){
        $this->data['subscriber'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_subscriber','',['id','DESC']);
        return view('admin/ins_manage/subscriber_index', $this->data);
    }
    public function marks_update(){
        if($this->request->getMethod() == 'post'){
            $marks_obtained = $_POST['marks_obtained'];
            $con_id = $_POST['con_id'];

            if($marks_obtained > 45 || $marks_obtained < 0){
                $this->session->setFlashdata(['message'=>'Please enter correct marks!', 'type'=>'danger']); 
                return redirect()->to(base_url('/admin/contact-us'));
            }else{
                $result_percentage = ($marks_obtained * 100) / 45;
                $update_data = array(
                    'marks_obtained' => $marks_obtained,
                    'result_percentage' => $result_percentage,
                    'status' => 6,
                );
                $update = $this->commonmodel->updateRecord('tbl_contact_us',$update_data, ['id'=>$con_id]);
                if(isset($update)){
                    $this->session->setFlashdata(['message'=>'Marks uploaded Successfully', 'type'=>'success']);
                }else{
                    $this->session->setFlashdata(['message'=>'Something went wrong...', 'type'=>'danger']);
                }
                
                $url = base_url('admin/contact_us_listing?status=5&search=');
                return redirect()->to($url);
            }
        }
        return redirect()->to(base_url('/admin/contact-us'));
    }

    /**************************************Referral******************************************** */
    public function referral(){
        if($this->request->getMethod() == 'post'){
            if($this->request->getPost('submit') == 'changeStatus'){
                $m_id = $_POST['m_id'];
                $status = $_POST['status'];
                $comment = $_POST['comment'];
                $post = array();
                $post['comment'] = $comment;
                $post['status'] = $status;
                $post['updated'] = date('Y-m-d H:i:s');

                $updated = $this->commonmodel->updateRecord('tbl_members', $post, ['m_id'=>$m_id]);
                if(isset($updated)){
                    $member = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>$m_id]);
                    if($status){
                        $msg = '<p>You account has been <strong>activated</strong>. You can login to our system.</p>';
                    }else{
                        $msg = '<p>You account has been <strong>deactivated</strong>. If you wish to keep your account active, please contact administrator.</p>';
                    }
                    $emailData['name'] = $member->m_full_name;
                    $emailData['message'] = $msg;
                    $msg = view('email/emailer',$emailData);
                        
                    $email = \Config\Services::email();

                    $email->setFrom('info@career-boss.com', 'Career-Boss');
                    $email->setTo($member->email);
                    //$email->setTo('test136@yopmail.com');

                    $email->setSubject('Member Account');
                    $email->setMessage($msg);
                    $email->send();
                    session()->setFlashdata(['message'=>'Change Status successfully!', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/referral'));

            }
        }
        $this->data['referral'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_members',['member_type <'=>1],['m_id','DESC']);
        return view('admin/referral/referral_list', $this->data);
    }
    public function referral_view($id){
        if(!$id){
            return redirect()->to(site_url('admin/referral'));
        }else{
            if($this->request->getMethod() == 'post'){
                // print_r($_POST); exit;
                $stu_id = $_POST['stu_id'];
                $currentStatus = $_POST['status'];
                $description = $_POST['description'];
                if($currentStatus == 3){
                    $updateData = array(
                        'status' => $currentStatus,
                        'description' => $description,
                        'amount_status' => 1, // earn
                    );
                }else{
                    $updateData = array(
                        'status' => $currentStatus,
                        'description' => $description,
                    );
                }
                $update = $this->commonmodel->updateRecord('tbl_students_referal',$updateData, ['stu_id'=>$stu_id]);
                if($update){
                    if($currentStatus == 3){
                        $m_id = $this->commonmodel->getOneRecord('tbl_students_referal', ['stu_id'=>$stu_id])->member_id;
                        $memberDtls = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>$m_id]);
                        $memberUpdateData = array(
                            'earn_amount' => $memberDtls->earn_amount + REF_EARN_AMOUNT,
                        );
                        $this->commonmodel->updateRecord('tbl_members',$memberUpdateData, ['m_id'=>$m_id]);
                    }
                    $this->session->setFlashdata(['message'=>'Status Changed Successfully', 'type'=>'success']);
                }else{
                    $this->session->setFlashdata(['message'=>'Something went wrong...', 'type'=>'danger']);
                }
                
                $url = base_url('admin/referral_view/'.$id);
                return redirect()->to($url);
            }
            $this->data['referralDtls'] = $this->adminmodel->getMemberWithBankDtls($id);
            $this->data['stuData'] = $this->adminmodel->getReferralStudentListByRefId($id);
            return view('admin/referral/referral_view', $this->data);
        }
    }
    public function delete_referral($id){
        if(!$id){
            return redirect()->to(site_url('admin/referral'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_members',['m_id'=>$id]);
            if($deleted){
                $this->commonmodel->deleteRecord('tbl_students_referal',['member_id'=>$id]);
                $this->commonmodel->deleteRecord('tbl_bank_details',['m_id'=>$id]);
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/referral'));
        }
    }
    public function update_bank_details_status(){
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('/admin/referral');
        if($this->request->getMethod() == 'post'){
            //print_r($_POST);exit;
            $m_id = $this->request->getPost('m_id');
            $status = $this->request->getPost('status');
            $comment = $this->request->getPost('comment');
            $update = $this->commonmodel->updateRecord('tbl_bank_details',['status'=>$status,'comment'=>$comment,'update_at'=>date('Y-m-d H:i:s')], ['m_id'=>$m_id]);
            if($update){
                $this->session->setFlashdata(['message'=>'Bank Details Status Changed Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Something went wrong...', 'type'=>'danger']);
            }
            
            $url = base_url('admin/referral_view/'.$m_id);
            return redirect()->to($url);
        }else{
            return redirect()->to($referer);
        }
    }
    public function amount_paid_to_referral(){
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('/admin/referral');
        if($this->request->getMethod() == 'post'){
            //print_r($_POST);exit;
            $m_id = $this->request->getPost('m_id');
            $stu_id = $this->request->getPost('stu_id');
            $update = $this->commonmodel->updateRecord('tbl_students_referal',['amount_status'=>2,'paid_date'=>date('Y-m-d H:i:s')], ['stu_id'=>$stu_id]);
            if($update){
                $memberDtls = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>$m_id]);
                $memberUpdateData = array(
                    'credit_amount' => $memberDtls->credit_amount + REF_EARN_AMOUNT,
                );
                $this->commonmodel->updateRecord('tbl_members',$memberUpdateData, ['m_id'=>$m_id]);
                $this->session->setFlashdata(['message'=>'Record Updated Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Something went wrong...', 'type'=>'danger']);
            }
            
            $url = base_url('admin/referral_view/'.$m_id);
            return redirect()->to($url);
        }else{
            return redirect()->to($referer);
        }
    }

    /**************************************Franchise******************************************** */
    public function franchise(){
        if($this->request->getMethod() == 'post'){
            if($this->request->getPost('submit') == 'changeStatus'){
                $m_id = $_POST['m_id'];
                $status = $_POST['status'];
                $comment = $_POST['comment'];
                $post = array();
                $post['comment'] = $comment;
                $post['status'] = $status;
                $post['updated'] = date('Y-m-d H:i:s');

                $updated = $this->commonmodel->updateRecord('tbl_members', $post, ['m_id'=>$m_id]);
                if(isset($updated)){
                    $member = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>$m_id]);
                    if($status){
                        $msg = '<p>You account has been <strong>activated</strong>. You can login to our system.</p>';
                    }else{
                        $msg = '<p>You account has been <strong>deactivated</strong>. If you wish to keep your account active, please contact administrator.</p>';
                    }
                    $emailData['name'] = $member->m_full_name;
                    $emailData['message'] = $msg;
                    $msg = view('email/emailer',$emailData);
                        
                    $email = \Config\Services::email();

                    $email->setFrom('info@career-boss.com', 'Career-Boss');
                    $email->setTo($member->email);
                    //$email->setTo('test136@yopmail.com');

                    $email->setSubject('Member Account');
                    $email->setMessage($msg);
                    $email->send();
                    session()->setFlashdata(['message'=>'Change Status successfully!', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/franchise'));

            }
        }
        $this->data['franchises'] = $this->adminmodel->getAllFrachise();
        return view('admin/franchise/franchise_list', $this->data);
    }
    
    public function franchise_edit($id){
        if($this->request->getMethod() === 'post'){
            $validation = $this->validate([
                'm_full_name'=>[
                    'rules'=>'required|alpha_numeric_space',
                    'errors'=>['required'=>'Your Full name is required',
                                'alpha_numeric_space'=>'Please enter valid name.']
                ],
                'address'=>[
                    'rules'=>'required|alpha_numeric_space',
                    'errors'=>['required'=>'Your Address is required',
                                'alpha_numeric_space'=>'Please enter valid Address.']
                ],
                'email'=>[
                    'rules'=>'required|valid_email',
                    'errors'=>['required'=>'Email is required',
                                'valid_email'=>'You must enter a valid email',
                            ]
                ],
                'phone'=>[
                    'rules'=>'required|is_natural|min_length[10]|max_length[10]',
                    'errors'=>['required'=>'Mobile No is required',
                                'is_natural'=>'The Mobile No must only contain digits.',
                                'min_length'=>'Mobile No must be 10 digit in length',
                                'max_length'=>'Mobile No must not have more than 10 digit in length']
                ],
                'reg_fee'=>[
                    'rules'=>'required|is_natural',
                    'errors'=>['required'=>'Reg. fee is required',
                                'is_natural'=>'The Reg. fee must only contain digits.',
                            ]
                ],
                'status'=>[
                    'rules'=>'required',
                    'errors'=>'Status is required'
                ],
                
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator; 
            }else{
                $post = array();
                $post['m_full_name']    = trim($this->request->getPost('m_full_name'));
                $post['address']        = trim($this->request->getPost('address'));
                $post['phone']          = $this->request->getPost('phone');
                $post['email']          = $this->request->getPost('email');
                $post['center_name']    = $this->request->getPost('center_name');
                $post['center_address'] = $this->request->getPost('center_address');
                $post['reg_fee']        = $this->request->getPost('reg_fee');
                $post['status']         = $this->request->getPost('status');
                $post['updated']        = date('Y-m-d H:i:s');
                $updated = $this->commonmodel->updateRecord('tbl_members', $post, ['m_id'=>$id]); 
                if($updated){
                    
                    session()->setFlashdata(['message'=>'franchise updated successfully!', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/franchise'));
            }
        }
        $this->data['memberDtls'] = $this->commonmodel->getOneRecord('tbl_members',['m_id'=>$id,'member_type'=>1]);
        if(empty($this->data['memberDtls'])){
            session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
            return redirect()->to(base_url('/admin/franchise'));
        }
        return view('admin/franchise/franchise_edit', $this->data);
    }
    public function franchise_view($id=null){
        $search = '';
        if($this->request->getMethod() == 'post'){
            
            if($this->request->getPost('submit') == 'addAmount'){
                $m_id = $_POST['m_id'];
                $amount = $_POST['amount'];
                $memberDtls = $this->commonmodel->getOneRecord('tbl_members',['m_id'=>$m_id,'member_type'=>1]);
                if($memberDtls->reg_fee < 1){
                    session()->setFlashdata(['message'=>'Please update your reg fee first!', 'type'=>'danger']);
                    return redirect()->to(base_url('/admin/franchise_view/'.$m_id));
                    exit;
                }
                $updateData = array();
                $updateData['wa_amount'] = (int)$memberDtls->wa_amount + (int)$amount;
                $updated = $this->commonmodel->updateRecord('tbl_members', $updateData, ['m_id'=>$m_id]);

                $walletLogData = array();
                $walletLogData['m_id'] = $m_id;
                $walletLogData['amount'] = $amount;
                $walletLogData['amt_type'] = 'Cr';
                $walletLogData['added_at'] = date('Y-m-d H:i:s');
                $inserted = $this->commonmodel->insertRecord('tbl_wallet_log', $walletLogData);

                $this->update_wallet_n_student_reg_fee($m_id);

                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Wallet amount updated successfully!', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/franchise_view/'.$m_id));

                // print_r($memberDtls); exit;
            }
            if($this->request->getPost('submit') == 'changeStatus'){
                $frstIds = $_POST['frst_id'];
                $status = $_POST['status'];
                $reg_fee = $_POST['reg_fee'];
                $description = $_POST['description'];
                $frstIdsArr = explode(',', $frstIds);
                if(!empty($frstIdsArr)){
                    foreach($frstIdsArr as $frst_id){
                        $post = array();
                        $post['description'] = $description;
                        $post['status'] = $status;
                        if($status == 1){
                            $post['reg_fee'] = $reg_fee;
                        }
                        $post['update_at'] = date('Y-m-d H:i:s');
                        $updated = $this->commonmodel->updateRecord($this->studentsFranchiseTbl, $post, ['frst_id'=>$frst_id]);

                    }
                }
                if($status == 1){
                    $this->update_wallet_n_student_reg_fee($id, $description); 
                }
                if(isset($updated)){
                    session()->setFlashdata(['message'=>'Change Status successfully!', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/franchise_view/'.$id));

            }
            if($this->request->getPost('submit') == 'issueDate'){
                $frst_id = $_POST['frst_id'];
                $cert_issue_date = date('Y-m-d',strtotime($_POST['cert_issue_date']));
                $updated = $this->commonmodel->updateRecord($this->studentsFranchiseTbl, ['cert_issue_date'=>$cert_issue_date], ['frst_id'=>$frst_id]);
                if(isset($updated)){
                    session()->setFlashdata(['message'=>'Add Issue Date successfully!', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/franchise_view/'.$id));
            }
            if($this->request->getPost('submit') == 'certifiedStu'){
                if(isset($_POST['search']) && $_POST['search'] != ''){
                    $search = $_POST['search'];
                }
            }
            if($this->request->getPost('submit') == 'regchangeStatus'){
                $frst_id = $_POST['frst_id'];
                $reg_fee = $_POST['reg_fee'];
                $desc = $_POST['desc'];
                $status = $_POST['status'];
                $updateData = array();
                $updateData['status'] = $status;
                if($status == 6 || $status == 1){
                    $updateData['reg_fee'] = $reg_fee;
                }
                if($status == 1){
                    $updateData['is_cert'] = 'yes';
                }
                $updated = $this->commonmodel->updateRecord($this->studentsFranchiseTbl, $updateData, ['frst_id'=>$frst_id]);
                if($status == 6 || $status == 1){
                    $this->update_wallet_n_student_reg_fee($id, $desc);
                }
                if(isset($updated)){
                    session()->setFlashdata(['message'=>'Status Changed successfully!', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/franchise_view/'.$id));
            }
            if($this->request->getPost('submit') == 'unichangeStatus'){
                $frst_id = $_POST['frst_id'];
                // $reg_fee = $_POST['reg_fee'];
                // $desc = $_POST['desc'];
                $status = $_POST['status'];
                $updateData = array();
                $updateData['status'] = $status;
                
                $updated = $this->commonmodel->updateRecord($this->studentsFranchiseTbl, $updateData, ['frst_id'=>$frst_id]);
                
                if(isset($updated)){
                    session()->setFlashdata(['message'=>'Status Changed successfully!', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/franchise_view/'.$id));
            }
        }
        $this->commonmodel->updateRecord('tbl_notification', ['status'=>1], ['franchise_id'=>$id]);
        $this->data['franchiseDtls'] = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>$id]);
        if(empty($this->data['franchiseDtls'])){
            session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
            return redirect()->to(site_url('admin/franchise'));
        }
        $rec_limit = 5;
        $totRegStuData = $this->adminmodel->get_fr_stu_list_by_frId_by_type($id, $type='R', $count=1);
        $page_config = array(
            'tot_record' => $totRegStuData,
            'rec_limit' => $rec_limit,
            'btn_limit' => 5,
            'current_page' => (isset($_GET['rs-page']) && $_GET['rs-page'] != '')?$_GET['rs-page']:0,
            'url' => current_url(),
            'url_param' => 'rs-page',
            'colspan' => 13,
        );
        $cp_data = custom_pagination($page_config);
        // print_r($cp_data); exit;
        $limit = $cp_data['limit'];
        $offset = $cp_data['offset'];
        $this->data['rs_pagination'] = $cp_data['pagination_html'];
        $this->data['RegStuData'] = $this->adminmodel->get_fr_stu_list_by_frId_by_type($id, $type='R','',$limit,$offset);
        $this->data['stuData'] = $this->adminmodel->get_fr_stu_list_by_frId_by_type($id, $type='NR');
        
        $totCertStu = $this->adminmodel->getCountFranchiseStudentByRefId($id,['status'=>3]);
        $page_config = array(
            'tot_record' => $totCertStu,
            'rec_limit' => $rec_limit,
            'btn_limit' => 5,
            'current_page' => (isset($_GET['cs-page']) && $_GET['cs-page'] != '')?$_GET['cs-page']:0,
            'url' => current_url(),
            'url_param' => 'cs-page',
            'colspan' => 13,
        );
        $cp_data = custom_pagination($page_config);
        // print_r($cp_data); exit;
        $limit = $cp_data['limit'];
        $offset = $cp_data['offset'];
        $this->data['cs_pagination'] = $cp_data['pagination_html'];
        $this->data['certStuData'] = $this->adminmodel->getFranchiseStudentListByFrId($id,['sf.status'=>3],$search,$limit,$offset);
        $this->data['TotCertStu'] = $totCertStu;
        $this->data['totalRegDues'] = $this->adminmodel->get_total_dues($id);
        $this->data['limit'] = $limit;
        
        return view('admin/franchise/franchise_view', $this->data);
    }
    public function add_edit_universityinfo($m_id, $frst_id){
        $data = array();
        $uniDtls = $this->commonmodel->getOneRecord('tbl_fr_uni_student', ['franchise_id'=>$m_id,'frst_id'=>$frst_id]);
        $uni_id = $uniDtls->uni_id ?? 0;
        if($this->request->getMethod() == 'post'){
            $post = $studata = array();
            // print_r($_FILES); exit;
            if($_POST['submit'] == 'before_comp'){
                $validation = $this->validate([
                    'u_name'=>'required',
                    // 'u_regno'=>'required',
                    // 'u_rollno'=>'required',
                    'course_fee'=>'is_natural',
                    'paid_amount'=>'is_natural',
                    'receipt_no'=>'required',
                    'adm_date'=>'required',
                    'qly_doc'=>[
                        //'rules'=>'uploaded[image]|max_size[image,50]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                        'rules'=>'max_size[qly_doc,1048576]|ext_in[qly_doc,pdf]',
                        'errors'=>[
                        //'uploaded'=>'Image is required.',
                        'max_size'=>'File must not have size more than 10 MB in length.',
                        'ext_in'=>'File must have extension with pdf.',
                        ]
                    ],
                    
                    // 'status'=>'required'
                ]);
                if(!$validation){
                    $data['validation'] = $this->validator;
                    //return view('admin/cms/add_edit_cms', $this->data);
                }else{
                    
                    if($_FILES['qly_doc']['name'] != ''){
                        if($img = $this->request->getFile('qly_doc')){ 
                            $imgname = $img->getName();
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $newName = 'qlyd_'.time().'.'.$ext;
                                $img->move('./public/assets/pdf/',$newName);
                                
                                $post['qly_doc'] = $newName;
                            }
                        }
                    }
                    $post['franchise_id'] = $_POST['franchise_id'];
                    $post['frst_id'] = $_POST['frst_id'];
                    $post['u_name'] = $_POST['u_name'];
                    $post['session'] = $_POST['session'];
                    // $post['u_regno'] = $_POST['u_regno'];
                    // $post['u_rollno'] = $_POST['u_rollno'];
                    $post['course_fee'] = $_POST['course_fee'];
                    if($_POST['paid_amount'] != $_POST['paid_amount_o']){
                        $paid_amount = $uniDtls->paid_amount ?? 0;
                        $post['paid_amount'] = $paid_amount + $_POST['paid_amount'];
                        $post['dues_amount'] = (int)$_POST['course_fee'] - (int)$post['paid_amount'];
                        if($post['dues_amount'] < 1){
                            $studata['reg_fee_status'] = 'P';
                        }
                    }
                    $post['receipt_no'] = $_POST['receipt_no'];
                    $post['adm_date'] = date('Y-m-d',strtotime($_POST['adm_date']));
                    
                    if($_POST['paid_amount'] != $_POST['paid_amount_o']){
                        $feelog['uni_id'] = $inserted ?? $uni_id;
                        $feelog['franchise_id'] = $m_id;
                        $feelog['frst_id'] = $frst_id;
                        $feelog['paid_date'] = date('Y-m-d H:i:s');
                        $feelog['receipt_no'] = $_POST['receipt_no'];
                        $feelog['amount'] = $_POST['paid_amount'];
                        $feelog['added_at'] = date('Y-m-d H:i:s');
                        $this->commonmodel->insertRecord('tbl_frunistu_feelog', $feelog);
                    }
                }
            }
            if($_POST['submit'] == 'after_comp'){
                $validation = $this->validate([
                    'u_name'=>'required',
                    'u_regno'=>'required',
                    'u_rollno'=>'required',
                    'cert_no'=>'required',
                    'status'=>'required',
                    'uni_doc'=>[
                        //'rules'=>'uploaded[image]|max_size[image,50]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                        'rules'=>'max_size[uni_doc,1048576]|ext_in[uni_doc,pdf]',
                        'errors'=>[
                        //'uploaded'=>'Image is required.',
                        'max_size'=>'File must not have size more than 10 MB in length.',
                        'ext_in'=>'File must have extension with pdf.',
                        ]
                    ],
                    
                    // 'status'=>'required'
                ]);
                if(!$validation){
                    $data['validation'] = $this->validator;
                    //return view('admin/cms/add_edit_cms', $this->data);
                }else{
                    
                    if($_FILES['uni_doc']['name'] != ''){
                        if($img = $this->request->getFile('uni_doc')){ 
                            $imgname = $img->getName();
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $newName = $_POST['cert_no'].'.'.$ext;
                                $img->move('./public/assets/pdf/',$newName);
                                
                                $post['uni_doc'] = $newName;
                            }
                        }
                    }
                    $post['franchise_id'] = $_POST['franchise_id'];
                    $post['frst_id'] = $_POST['frst_id'];
                    $post['u_regno'] = $_POST['u_regno'];
                    $post['u_rollno'] = $_POST['u_rollno'];
                    $post['cert_no'] = $_POST['cert_no'];
                    
                    $studata['status'] = $_POST['status'];
                    $studata['cert_no'] = $_POST['cert_no'];
                }
            }
            if(!empty($post)){
                if(!$uni_id){
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_fr_uni_student', $post);
                    if($inserted){
                        session()->setFlashdata(['message'=>'University details added successfuly','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }else{
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_fr_uni_student', $post, ['uni_id'=>$uni_id]);
                    if($updated){
                        session()->setFlashdata(['message'=>'University details Updated Successfully','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }
                if(!empty($studata)){
                    $this->commonmodel->updateRecord('tbl_students_franchise',$studata, ['frst_id'=>$frst_id]);
                }
                return redirect()->to(base_url('admin/add_edit_universityinfo/'.$m_id.'/'.$frst_id));
            }
        }
        $data['uniDtls'] = $uniDtls;
        $data['student'] = $this->adminmodel->getStudentRecordOfFranchise($frst_id);
        // echo '<pre>';print_r($data['student']); exit;
        $data['frDtls'] = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>$m_id]);
        return view('admin/franchise/add_edit_universityinfo', $data);
    }
    public function view_stuuniversityinfo($m_id, $frst_id){
        $data = array();
        $data['student'] = $this->adminmodel->getStudentRecordOfFranchise($frst_id);
        $data['uniDtls'] = $this->commonmodel->getOneRecord('tbl_fr_uni_student', ['franchise_id'=>$m_id,'frst_id'=>$frst_id]);
        $data['feelog'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_frunistu_feelog', ['franchise_id'=>$m_id,'frst_id'=>$frst_id],['lg_id','DESC']);
        return view('admin/franchise/view_stuuniversityinfo', $data);
    }
    public function wallet_history($id){
        $data = array();
        $data['franchiseDtls'] = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>$id]);
        $data['walletHisDR'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_wallet_log', ['m_id'=>$id,'amt_type'=>'DR'],['id','DESC']);
        $data['walletHisCR'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_wallet_log', ['m_id'=>$id,'amt_type'=>'CR'],['id','DESC']);
        return view('admin/franchise/wallet_history', $data);

    }
    public function update_wallet_n_student_reg_fee($m_id, $desc=null){
        $memberDtls = $this->commonmodel->getOneRecord('tbl_members',['m_id'=>$m_id,'member_type'=>1]);
        $duesStudents = $this->adminmodel->get_fee_dues_student($m_id);
        // echo '<pre>'; print_r($duesStudents); exit;
        $wa_amount = $memberDtls->wa_amount;
        // $reg_fee = $memberDtls->reg_fee;

        if(!empty($duesStudents)){
            foreach($duesStudents as $list){
                $reg_fee = $list->reg_fee;
                if($reg_fee >= 1 && $wa_amount >= 1 && $wa_amount >= $reg_fee ){
                    $wa_amount -= $reg_fee;
                    $updateData['wa_amount'] = (int)$wa_amount;
                    $updateData['updated'] = date('Y-m-d H:i:s');
                    $this->commonmodel->updateRecord('tbl_members', $updateData, ['m_id'=>$m_id]);
                    $this->commonmodel->updateRecord($this->studentsFranchiseTbl, ['reg_fee_status'=>'P', 'update_at'=>date('Y-m-d H:i:s')], ['frst_id'=>$list->frst_id]);

                    $walletLogData = array();
                    $walletLogData['m_id'] = $m_id;
                    // $walletLogData['dh_id'] = session('dh_id');
                    $walletLogData['amount'] = $reg_fee;
                    $walletLogData['amt_type'] = 'Dr';
                    $walletLogData['stu_reg_no'] = $list->reg_no;
                    if($desc != null){
                        $walletLogData['description'] = $desc;
                    }
                    $walletLogData['added_at'] = date('Y-m-d H:i:s');
                    $this->commonmodel->insertRecord('tbl_wallet_log', $walletLogData);

                }else{
                    break;
                }
            }
        }
        // echo '<pre>'; print_r($duesStudents); exit;
    }
    public function reject_cert($frst_id, $m_id){
        if($frst_id){
            $data =  $this->adminmodel->getStudentRecordOfFranchise($frst_id);
            if(!empty($data)){
                $fileName = $data->cert_no.'.pdf';
                if(file_exists(ROOTPATH."public/assets/pdf/".$fileName)){
                    unlink(ROOTPATH."public/assets/pdf/".$fileName);
                }
                if($data->course_cat == 'C'){
                    $fileName = $data->cert_no.'M.pdf';
                    if(file_exists(ROOTPATH."public/assets/pdf/".$fileName)){
                        unlink(ROOTPATH."public/assets/pdf/".$fileName);
                    }
                }
                $updated = $this->commonmodel->updateRecord($this->studentsFranchiseTbl, ['status'=>4], ['frst_id'=>$frst_id]);
                if(isset($updated)){
                    session()->setFlashdata(['message'=>'Certificate Rejected successfully!', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                }
            }
        }
        return redirect()->to(site_url('admin/franchise_view/'.$m_id));
    }
    public function add_edit_franchise_student($m_id, $frst_id=null){
        // echo $m_id;

        $data = array();
        $cid = (isset($_POST['frcourse_id']) && $_POST['frcourse_id'] != '')?$_POST['frcourse_id']:null;
        $stu_type = (isset($_POST['stu_type']) && $_POST['stu_type'] != '')?$_POST['stu_type']:null;
        $is_cert = (isset($_POST['is_cert']) && $_POST['is_cert'] != '')?$_POST['is_cert']:null;
        $course = $this->commonmodel->getOneRecord($this->coursefranchiseTbl, ['cid'=>$cid]);
        if($cid){
            $modules = $this->membermodel->get_modules($cid);
            $data['modules'] = $modules;
            $data['course'] = $course;
        }
        if($this->request->getMethod() == 'post'){
            $rules = [
                'frcourse_id'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please select any course.',]
                ],
                /*'date_from'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please select Date From.',]
                ],*/
                'frstu_name'=>[
                    'rules'=>'required|alpha_numeric_space',
                    'errors'=>['required'=>'Student\'s Full name is required',
                                'alpha_numeric_space'=>'Please enter valid name.']
                ],
                
                'so_wo_do'=>[
                    'rules'=>'required|alpha_numeric_space',
                    'errors'=>['required'=>'SO/WO/DO is required',
                                'alpha_numeric_space'=>'Please enter valid name.']
                ],
                'mother_name'=>[
                    'rules'=>'required|alpha_numeric_space',
                    'errors'=>['required'=>'Mother\'s name is required',
                                'alpha_numeric_space'=>'Please enter valid name.']
                ],
                'gender'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please select one.']
                ],
                'dob'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please enter DOB.']
                ],
                /*'phone'=>[
                    'rules'=>'required|is_natural|min_length[10]|max_length[10]',
                    'errors'=>['required'=>'Mobile No is required',
                                'is_natural'=>'The Mobile No must only contain digits.',
                                'min_length'=>'Mobile No must be 10 digit in length',
                                'max_length'=>'Mobile No must not have more than 10 digit in length']
                ],
                'mo.0'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please enter marks obtained.']
                ],
                'cert_issue_date'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please provide certificate issue date.']
                ],
                /*'fm.0'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please enter full marks.']
                ],
                */
                /*'grade'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please select Grade.']
                ],*/
                /*'course_id'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please select any course.']
                ],*/
            ];
            if(!$frst_id){
                $rules['photo'] = [
                    'rules'=>'uploaded[photo]|max_size[photo,700]|ext_in[photo,png,jpg,jpeg,bmp,gif]',
                    // 'rules'=>'max_size[lsn_file,10240]|ext_in[lsn_file,pdf]',
                    'errors'=>[
                    'uploaded'=>'Photo is required.',
                    'max_size'=>'Image must not have size more than 700 KB in length.',
                    'ext_in'=>'Only Image file(png,jpg,jpeg,bmp,gif) upload!',
                    ]
                ];
            }else{
                $rules['photo'] = [
                    'rules'=>'max_size[photo,700]|ext_in[photo,png,jpg,jpeg,bmp,gif]',
                    // 'rules'=>'max_size[lsn_file,10240]|ext_in[lsn_file,pdf]',
                    'errors'=>[
                    'max_size'=>'Image must not have size more than 700 KB in length.',
                    'ext_in'=>'Only Image file(png,jpg,jpeg,bmp,gif) upload!',
                    ]
                ];
            }
            if($course->course_cat == 'C' || $course->course_cat == 'T'){
                if($stu_type == 'NR' || $is_cert == 'yes'){
                    $rules['mo.0'] = [
                        'rules'=>'required',
                        'errors'=>['required'=>'Please enter marks obtained.']
                    ];
                    $rules['cert_issue_date'] = [
                        'rules'=>'required',
                        'errors'=>['required'=>'Please provide certificate issue date.']
                    ];
                }
            }
            //$rules['module_name_s.0'] = ['rules'=>'required','errors'=>['required'=>'Please select module name.']];
            //$rules['fm.0'] = ['rules'=>'required','errors'=>['required'=>'Please enter full marks.']];
            //$rules['mo.0'] = ['rules'=>'required','errors'=>['required'=>'Please enter marks obtained.']];
            $validation = $this->validate($rules);
            if(!$validation){
                $data['validation'] = $this->validator; 
            }else{
                // echo '<pre>'; 
                // print_r($_POST);exit;
                $post = array();
                if($_FILES['photo']['name'] != ''){
                    if($img = $this->request->getFile('photo')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'fr_stu_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                            
                            $post['photo'] = $newName;
                        }
                    }
                }
                $post['franchise_id']      = $m_id;
                $post['stu_type']          = $_POST['stu_type'];
                
                $post['frcourse_id']       = $this->request->getPost('frcourse_id');
                $post['aadhar_no']         = $_POST['aadhar_no'];
                // $post['date_to']           = date('Y-m-d', strtotime($_POST['date_to']));
                $post['frstu_name']       = trim($this->request->getPost('frstu_name'));
                $post['so_wo_do']        = trim($this->request->getPost('so_wo_do'));
                $post['mother_name']        = trim($this->request->getPost('mother_name'));
                $post['gender']          = $this->request->getPost('gender');
                $post['marital_status']  = $this->request->getPost('marital_status');
                $post['dob']            = ($_POST['dob'] != '')?date('Y-m-d', strtotime($_POST['dob'])):'';
                $post['parents_occupation']        = trim($this->request->getPost('parents_occupation'));
                $post['candidates_exp']        = trim($this->request->getPost('candidates_exp'));
                $post['phone']          = $this->request->getPost('phone');
                $post['alt_phone']          = $this->request->getPost('alt_phone');
                $post['email']        = $this->request->getPost('email');
                $post['full_address']        = trim($this->request->getPost('full_address'));
                $post['state']      = $this->request->getPost('state');
                $post['district']      = $this->request->getPost('district');
                $post['pincode']      = $this->request->getPost('pincode');
                $post['cert_issue_date'] = ($_POST['cert_issue_date'] != '')?date('Y-m-d', strtotime($_POST['cert_issue_date'])):'';
                // $post['is_marksheet']      = $this->request->getPost('is_marksheet');
                /*if($_POST['is_marksheet'] == 'no'){
                    $post['grade']      = $this->request->getPost('grade');
                    $post['percentage']      = $this->request->getPost('percentage');
                }*/
                // $notifyData = array();
                if(!$frst_id){
                    if($_POST['stu_type'] == 'R'){
                        $post['is_cert'] = 'no';
                    }else{
                        $post['is_cert'] = 'yes';
                    }
                    do{
                        $No1 = mt_rand(10000, 99999);
                        $is_exist = $this->commonmodel->getAllRecordCount($this->randomcodeTbl,['code'=>$No1]);
                    } while($is_exist);
                    $memberDtls = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>$m_id]);
                    $member_code = ($memberDtls->member_code != '')?$memberDtls->member_code:'';
                    $regNo = $member_code.$No1;
                    $post['reg_no'] = $regNo;
                    if($stu_type == 'R'){
                        $post['status'] = 5;
                    }

                    $post['added_at']   = date('Y-m-d H:i:s');
                    $insertId = $this->commonmodel->insertRecord($this->studentsFranchiseTbl, $post);
                    $frst_id = $insertId;
                    /*$notifyData['frst_id'] = $insertId;
                    $notifyData['type'] = 2;
                    $notifyData['message'] = session('m_full_name').' has added "'.$post['frstu_name'].'" as a student.';*/
                    
                    
                }else{
                    // $post['status'] = 1;
                    $post['update_at']   = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord($this->studentsFranchiseTbl, $post, ['frst_id '=>$frst_id]);

                    /*$notifyData['frst_id'] = $frst_id;
                    $notifyData['type'] = 2;
                    $notifyData['message'] = session('m_full_name').' has edited of "'.$post['frstu_name'].'".';*/

                }
                //notification
                /*$notifyData['dh_id'] = session('dh_id');
                $notifyData['franchise_id'] = session('m_id');
                $notifyData['added_at'] = date('Y-m-d H:i:s');
                $this->commonmodel->insertRecord('tbl_notification', $notifyData);*/

                if($course->course_cat == 'C' || $course->course_cat == 'T'){
                if(isset($_POST['mo']) && !empty($_POST['mo']) && ($_POST['stu_type'] == 'NR' || $is_cert == 'yes')){
                    $tot_fm = 0;
                    $tot_mo = 0;
                    if(!empty($modules)){
                        $module_marks = array();
                        foreach($modules as $i=>$list){
                            if($_POST['mo'][$i] != ''){
                                $module_marks[] = array(
                                    'id' => $list->id,
                                    'module_name' => $list->module_name,
                                    'fm' => $list->full_marks,
                                    'mo' => $_POST['mo'][$i],
                                );
                                if($course->course_cat == 'C'){
                                    $tot_fm += $list->full_marks;
                                    $tot_mo += $_POST['mo'][$i];
                                }
                            }
                        }
                    }
                    
                    /*for($i=0; $i<10; $i++){

                        if($_POST['module_name_s'][$i] == 'Others'){
                            $moduleData = array();
                            $moduleData['module_name'] = $_POST['module_name'][$i];
                            $moduleData['added_by'] = session('m_id');
                            $moduleData['status'] = 0;
                            $moduleData['added_at'] = date('Y-m-d H:i:s');
                            $this->commonmodel->insertRecord('tbl_module', $moduleData);
                        }
                        if(($_POST['module_name_s'][$i] != '' || $_POST['module_name'][$i] != '') && $_POST['fm'][$i] != '' && $_POST['mo'][$i] != ''){
                            $marksData = array();
                            $marksData['franchise_id'] = session('m_id');
                            if(isset($insertId)){
                                $frst_id = $insertId;
                                $marksData['frst_id'] = $insertId;
                            }else{
                                $marksData['frst_id'] = $frst_id;
                            }
                            $marksData['module_name'] = ($_POST['module_name_s'][$i] == 'Others')?$_POST['module_name'][$i]:$_POST['module_name_s'][$i];
                            $marksData['full_marks'] = $_POST['fm'][$i];
                            $marksData['marks_obt'] = $_POST['mo'][$i];
                            if(!$_POST['mrk_id'][$i]){
                                $marksData['added_at'] = date('Y-m-d H:i:s');
                                $this->commonmodel->insertRecord('tbl_stu_marks', $marksData);
                            }else{
                                $marksData['update_at'] = date('Y-m-d H:i:s');
                                $this->commonmodel->updateRecord('tbl_stu_marks', $marksData, ['mrk_id '=>$_POST['mrk_id'][$i]]);
                            }
                            $tot_fm += $_POST['fm'][$i];
                            $tot_mo += $_POST['mo'][$i];
                        }

                    }*/
                    $stuUpdateData['module_marks'] = json_encode($module_marks);
                    if($course->course_cat == 'C' && ($_POST['stu_type'] == 'NR' || $is_cert == 'yes')){
                        $percentage = round(($tot_mo * 100) / $tot_fm, 2);
                        // echo $percentage;
                        $gradeData = $this->commonmodel->getOneRecord('tbl_grade',['marks_from <='=>$percentage, 'marks_to >='=>$percentage]);
                        $grade = $gradeData->grade;
                        // print_r($gradeData); exit;
                        $stuUpdateData['grade'] = $grade;
                        $stuUpdateData['percentage'] = $percentage;
                        $stuUpdateData['tot_fm'] = $tot_fm;
                        $stuUpdateData['tot_mo'] = $tot_mo;
                    }
                    $this->commonmodel->updateRecord($this->studentsFranchiseTbl, $stuUpdateData, ['frst_id '=>$frst_id]);
                }
                }
                if(isset($insertId)){
                    session()->setFlashdata(['message'=>'Student inserted Successfully!', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Student Updated Successfully!', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                }
                return redirect()->to(base_url('admin/franchise_view/'.$m_id));
            }
            
        }
        if($frst_id){
            // $data['student'] = $this->commonmodel->getOneRecord('tbl_students_franchise',['frst_id'=>$frst_id, 'franchise_id'=>session('m_id')]);
            $data['student'] = $this->adminmodel->getStudentRecordOfFranchise($frst_id);
            if(empty($data['student'])){
                session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                return redirect()->to(base_url('admin/franchise_view/'.$m_id));
            }
            //$data['stu_marks'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_stu_marks', ['franchise_id'=>session('m_id'),'frst_id'=>$frst_id],['mrk_id','ASC']);
            $data['modules'] = $this->membermodel->get_modules($data['student']->frcourse_id);
        }
        
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc($this->coursefranchiseTbl, ['status'=>1],['c_f_name','ASC']);
        $data['states'] = $this->commonmodel->getAllRecordOrderByDesc('states', '',['name','ASC']);
        $data['districts'] = $this->commonmodel->getAllRecordOrderByDesc('cities', '',['city','ASC']);
        $data['grades'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_grade', ['grade !='=>'','details !='=>''],['id','ASC']);
        $data['frDtls'] = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>$m_id]);
        return view('admin/franchise/add_edit_franchise_student', $data);
    }
    public function delete_franchise_student($m_id, $frst_id=null){
        if(!$frst_id){
            return redirect()->to(site_url('admin/franchise_view/'.$m_id));
        }else{
            $deleted = $this->commonmodel->deleteRecord($this->studentsFranchiseTbl,['frst_id'=>$frst_id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('admin/franchise_view/'.$m_id));
        }
    }
    public function generate_cert_by_ajax(){
        if($this->request->getMethod() == 'post'){
            $m_id = $_POST['m_id']; // reserve
            // $memberDtls = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>$m_id,'dh_id'=>session('dh_id')]);
            // $member_code = ($memberDtls->member_code != '')?$memberDtls->member_code:'';
            $frst_ids = $_POST['frst_ids'];
            $frst_ids = explode(',', $frst_ids);
            $result = array();
            if(!empty($frst_ids)){
                $mpdfController = new MpdfController();
                foreach($frst_ids as $frst_id){
                    $memberDtls = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>$m_id]);
                    $wa_amount = $memberDtls->wa_amount;
                    $reg_fee = $memberDtls->reg_fee;
                    
                    // $frStuDtls = $this->adminmodel->getStudentRecordOfFranchise($frst_id);
                    $certLog = $this->commonmodel->getOneRecord($this->certlogTbl,['frst_id'=>$frst_id]);
                    if(!empty($certLog) && $certLog->frst_id == $frst_id){
                        // $regNo = $certLog->reg_no;
                        $certNo = $certLog->cert_no;
                        $insertLogFlag = 0;
                    }else{
                        // $totalCert = count($this->commonmodel->getAllRecord('tbl_cert_log'));
                        /*do{
                            $No1 = mt_rand(10000, 99999);
                            $is_exist = $this->commonmodel->getAllRecordCount($this->randomcodeTbl,['code'=>$No1]);
                        } while($is_exist);
                        $this->commonmodel->insertRecord($this->randomcodeTbl,['code'=>$No1]);*/
                        do{
                            $No2 = mt_rand(10000, 99999);
                            $is_exist = $this->commonmodel->getAllRecordCount($this->randomcodeTbl,['code'=>$No2]);
                        } while($is_exist);
                        $this->commonmodel->insertRecord($this->randomcodeTbl,['code'=>$No2]);

                        // $regNo = session('cert_prefix').'R'.$member_code.$No1;
                        // $certNo = session('cert_prefix').'C'.$member_code.$No2;
                        // $regNo = $member_code.$No1;
                        $certNo = 'CBC'.$No2;
                        $insertLogFlag = 1;
                    }
                    $frStuDtls = $this->adminmodel->getStudentRecordOfFranchise($frst_id);
                    $stuFrData = array();
                    // $stuFrData['reg_no'] = $regNo;
                    $stuFrData['cert_no'] = $certNo;
                    if($frStuDtls->course_cat == 'P' || $frStuDtls->course_cat == 'F'){
                        $grade = $this->adminmodel->getLastGrade();
                        $stuFrData['grade'] = $grade;
                    }
                    $this->commonmodel->updateRecord($this->studentsFranchiseTbl, $stuFrData, ['frst_id'=>$frst_id]);
                    $frStuDtls = $this->adminmodel->getStudentRecordOfFranchise($frst_id);

                    //create pdf
                    if($frStuDtls->course_cat == 'C'){
                        $mpdfController->create_certificate_pdf($frStuDtls, $certNo);
                        //generate marksheet
                        $generated = $mpdfController->create_marksheet_pdf($frStuDtls, $certNo);
                    }elseif($frStuDtls->course_cat == 'T'){
                        $generated = $mpdfController->create_typing_certificate_pdf($frStuDtls, $certNo);
                    }elseif($frStuDtls->course_cat == 'P' || $frStuDtls->course_cat == 'F'){
                        $generated = $mpdfController->create_certificate_pdf($frStuDtls, $certNo);
                    }else{
                        $generated = 0;
                    }

                    if($generated){
                        $stuFrData = array();
                        $stuFrData['status'] = 3;
                        $updated = $this->commonmodel->updateRecord($this->studentsFranchiseTbl, $stuFrData, ['frst_id'=>$frst_id]);

                        $certLogData = array();
                        $certLogData['frst_id'] = $frStuDtls->frst_id;
                        $certLogData['reg_no'] = $frStuDtls->reg_no;
                        $certLogData['cert_no'] = $certNo;
                        $certLogData['down_time'] = 0;
                        $certLogData['cert_dtls'] = json_encode($frStuDtls);
                        if($insertLogFlag){
                            $certLogData['added_at'] = date('Y-m-d H:i:s');
                            $this->commonmodel->insertRecord($this->certlogTbl, $certLogData);
                        }else{
                            $certLogData['update_at'] = date('Y-m-d H:i:s');
                            $this->commonmodel->updateRecord($this->certlogTbl, $certLogData, ['frst_id'=>$frst_id]);
                        }
                        session()->setFlashdata(['message'=>'Certificate generated successfully!', 'type'=>'success']);
                        $result['res'] = true;
                    }else{
                        session()->setFlashdata(['message'=>'Certificate not generated', 'type'=>'danger']);
                        $result['res'] = false;
                    }
                }
            }else{
                session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                $result['res'] = false;
            }
            $result['url'] = base_url('admin/franchise_view/'.$m_id);
            echo json_encode($result); exit;
        }else{
            return redirect()->to(base_url());
        }
    }
    
    public function generate_cert(){
        /*$t = 0;
        do{
            $No = mt_rand(10000000, 99999999);
            $is_exist = $this->commonmodel->getAllRecordCount('tbl_random_code',['code'=>$No]);
            $t++;
        } while($is_exist);
        echo $t.' '.$No;
        exit;*/
       
        $mpdfController = new MpdfController();
        $frStuDtls = $this->adminmodel->getStudentRecordOfFranchise(5);
        // print_r($frStuDtls); exit;

        if($mpdfController->create_test_pdf($frStuDtls)){

            /*$html = $this->get_marksheet_html($frStuDtls);
            $name = 'testM'.time().'.pdf';
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
            $mpdf->AddPage('P');
            $mpdf->WriteHTML($html);
            // $pdfContent = $this->mpdf->Output('', 'S');
            $mpdf->Output('', 'I'); exit;

            $pdfPath = './public/assets/pdf/' . $name; 

            file_put_contents($pdfPath, $pdfContent);*/
            echo 'done';
        }else{
            echo 'Not Done';
        }
    }
    public function generate_marks(){
        $mpdfController = new MpdfController();
        $frStuDtls = $this->adminmodel->getStudentRecordOfFranchise(7);
        $mpdfController->create_marksheet_test_pdf($frStuDtls);
    }
    public function generate_tcert(){
        $mpdfController = new MpdfController();
        $frStuDtls = $this->adminmodel->getStudentRecordOfFranchise(6);
        $mpdfController->create_typing_test_pdf($frStuDtls);
    }
    public function delete_franchise($id){
        if(!$id){
            return redirect()->to(site_url('admin/franchise'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_members',['m_id'=>$id]);
            if($deleted){
                $this->commonmodel->deleteRecord($this->studentsFranchiseTbl,['franchise_id'=>$id]);
                // $this->commonmodel->deleteRecord('tbl_bank_details',['m_id'=>$id]);
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/franchise'));
        }
    }
    public function reset_password(){
        if($this->request->getMethod() === 'post'){
            $m_id = $_POST['m_id'];
            $password = $_POST['resetpassword'];
            $post = array();
            $post['password']      = password_hash($password, PASSWORD_DEFAULT);
            $updated = $this->commonmodel->updateRecord('tbl_members', $post, ['m_id'=>$m_id]); 
            if($updated){
                $currentMember = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>$m_id]);
                if($currentMember->member_code == '' && $currentMember->member_type == 1){
                    // $allActiveMemberWithCode = $this->commonmodel->getAllRecord('tbl_members', ['status'=>1, 'member_code !='=>'', 'member_type'=>1]);
                    do{
                        $No1 = mt_rand(10000, 10500);
                        $is_exist = $this->commonmodel->getAllRecordCount($this->randomcodeTbl,['code'=>$No1]);
                    } while($is_exist);
                    $this->commonmodel->insertRecord($this->randomcodeTbl,['code'=>$No1]);
                    // $member_code = 101 + count($allActiveMemberWithCode);
                    $member_code = $No1;
                    $this->commonmodel->updateRecord('tbl_members', ['member_code'=>$member_code], ['m_id'=>$m_id]);

                }
                $msg = '<p>Your password has been set/changed. you can login to our system by this account details.</p>
                        <p><strong>Phone Number: </strong>'.$currentMember->phone.'<br>
                        <strong>Password: </strong>'.$password.'</p>';
                        if(isset($member_code)){
                            $msg .= '<p></p><p>Your Member code is <strong>'.$member_code.'</strong></p>';
                        }
                $emailData['name'] = $currentMember->m_full_name;
                $emailData['message'] = $msg;
                $msg = view('email/emailer',$emailData);
                    
                $email = \Config\Services::email();

                $email->setFrom('info@career-boss.com', 'Career-Boss');
                $email->setTo($currentMember->email);
                //$email->setTo('test136@yopmail.com');

                $email->setSubject('Member Account');
                $email->setMessage($msg);
                $email->send();
                session()->setFlashdata(['message'=>'Password Reset successfully!', 'type'=>'success']);
            }else{
                session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
            }
        }
        return redirect()->to(base_url('/admin/franchise'));
    }
    public function view_franchise_student_by_ajax(){
        if($this->request->getMethod() === 'post'){
            $frst_id = $_POST['frst_id'];
            $student =  $this->adminmodel->getStudentRecordOfFranchise($frst_id);
            $output = '<span class="text-danger text-center">No details</span>';
            if(!empty($student)){
                $status = get_franchise_student_status_txt($student->status);
                $photo = base_url('public/assets/upload/images/'.$student->photo);
                
                $gp = '';
                if($student->course_cat == 'C' && $student->is_cert == 'yes'){
                    $gp = '<div class="col-md-2 my-2">
                        <strong>Grade:</strong>
                    </div>
                    <div class="col-md-4 my-2">
                        <span><strong>'.$student->grade.'</strong></span>
                    </div>
                    <div class="col-md-2 my-2">
                        <strong>Percentage:</strong>
                    </div>
                    <div class="col-md-4 my-2">
                        <span><strong>'.$student->percentage.'%</strong></span>
                    </div>';
                }
                $issueDate = 'N/A';
                if($student->cert_issue_date != '0000-00-00'){
                    $issueDate = date('d-M-Y',strtotime($student->cert_issue_date));
                }
                $isdt = '';
                if($student->status == 3){
                    $isdt = '<div class="col-md-2 my-2">
                        <strong>Issue Date:</strong>
                    </div>
                    <div class="col-md-4 my-2">
                        <span>'.$issueDate.'</span>
                    </div>';
                }
                $type = ($student->stu_type == 'NR')?'Non-Regular':'Regular';
                $marksDtls = '';
                if($student->is_cert == 'yes' && $student->module_marks != ''){
                    $stumarks = json_decode($student->module_marks);
                    $marksDtls = '<div class="col-md-12 my-2">
                        <p><strong>Marks Details:</strong></p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Module Name</th>';
                                    if($student->course_cat == 'C'){
                                        $marksDtls .= '<th scope="col">Full Marks</th>
                                                    <th scope="col">Marks Obtained</th>';
                                    }else{
                                        $marksDtls .= '<th scope="col">Speed (WPM)</th>';
                                    }
                $marksDtls .= '</tr>
                            </thead>
                            <tbody>';
                        if(!empty($stumarks)){ $sn=1;
                            foreach($stumarks as $list){
                            $marksDtls .='<tr>
                                <td>'.$sn++.'</td>
                                <td>'.$list->module_name.'</td>';
                                if($student->course_cat == 'C'){
                                    $marksDtls .= '<td>'.$list->fm.'</td>';
                                }
                $marksDtls .=   '<td>'.$list->mo.'</td>
                            </tr>';
                        } }
                        $marksDtls .= '</tbody>';
                                    if($student->course_cat == 'C'){
                        $marksDtls .=   '<tfoot>
                                            <tr>
                                                <th colspan="2">Total</th>
                                                <th>'.$student->tot_fm.'</th>
                                                <th>'.$student->tot_mo.'</th>
                                            </tr>
                                        </tfoot>'; }
                $marksDtls .= '</table>
                    </div>';
                }
                $output =    '<div class="row">
                        <div class="col-md-2 my-2">
                            <strong>Student\'s Name:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->frstu_name.'</span>
                        </div>
                        <div class="col-md-6 my-2">
                            <img src="'.$photo.'" alt="photo" width="60px" height="50px">
                        </div>
                       
                        <div class="col-md-2 my-2">
                            <strong>Course For:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->c_f_name.'</span>
                        </div>
                        
                        <div class="col-md-2 my-2">
                            <strong>Course Duration:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->course_duration.' Months</span>
                        </div>

                        <div class="col-md-2 my-2">
                            <strong>Type:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$type.'</span>
                        </div>
                        
                        <div class="col-md-2 my-2">
                            <strong>Reg.No:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->reg_no.'</span>
                        </div>
                        
                        <div class="col-md-2 my-2">
                            <strong>SO/WO/DO:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->so_wo_do.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Mother\'s Name:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->mother_name.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Gender:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.ucwords($student->gender).'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Aadhar No:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.ucwords($student->aadhar_no).'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Marital Status:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.ucwords($student->marital_status).'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>DOB:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.date('d-M-Y',strtotime($student->dob)).'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Parent Occupation:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->parents_occupation.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Experience (if any):</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->candidates_exp.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Mobile No:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->phone.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Alt Mobile No:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->alt_phone.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->email.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Address:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->full_address.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>State:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->statename.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>District:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->cityname.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Pincode:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->pincode.'</span>
                        </div>
                        
                        <div class="col-md-2 my-2">
                            <strong>Added Date:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.date('d-M-Y',strtotime($student->added_at)).'</span>
                        </div>
                        '.$isdt.$gp.'
                        <div class="col-md-2 my-2">
                            <strong>Status:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$status.'</span>
                        </div>
                        '.$marksDtls.'
                    </div>';
            }
            echo $output; exit;
        }
        return redirect()->to(base_url('/admin/franchise'));
    }
    public function grade_update(){
        if($this->request->getMethod() === 'post'){
            $total_record = count($_POST['id']);
            // echo $total_record; exit;
            for($i = 0; $i < $total_record; $i++){
                $updateData = array();
                $updateData['marks_from'] = $_POST['marks_from'][$i];
                $updateData['marks_to'] = $_POST['marks_to'][$i];
                $updateData['grade'] = $_POST['grade'][$i];
                $updateData['remarks'] = $_POST['remarks'][$i];
                $updated = $this->commonmodel->updateRecord($this->gradeTbl,$updateData,['id'=>$_POST['id'][$i]]);
            }
            if($updated){
                
                session()->setFlashdata(['message'=>'Record Update successfully!', 'type'=>'success']);
            }else{
                session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/grade_update'));

        }
        $data['grades'] = $this->commonmodel->getAllRecordOrderByDesc($this->gradeTbl,'',['id','ASC']);
        return view('admin/grade/undate_grade', $data);

    }
    public function change_notification_status($id){
        $url = base_url('admin');
        if($id){
            $this->commonmodel->updateRecord('tbl_notification',['status'=>1],['id'=>$id]);
            $notification = $this->commonmodel->getOneRecord('tbl_notification', ['id'=>$id]);
            if(!empty($notification)){
                if($notification->type == 1){
                    $url = base_url('admin/franchise');
                }elseif($notification->type == 2){
                    $url = base_url('admin/franchise_view/'.$notification->franchise_id);
                }
            }
        }
        return redirect()->to($url);
    }
    public function course_modules(){
        if($this->request->getMethod() == 'post'){
            if($this->request->getPost('submit') == 'changeStatus'){
                $Ids = $_POST['ids'];
                $status = $_POST['status'];
                // $description = $_POST['description'];
                $IdsArr = explode(',', $Ids);
                if(!empty($IdsArr)){
                    foreach($IdsArr as $id){
                        $post = array();
                        // $post['description'] = $description;
                        $post['status'] = $status;
                        $post['update_at'] = date('Y-m-d H:i:s');

                        $updated = $this->commonmodel->updateRecord($this->coursefranchiseTbl, $post, ['cid'=>$id]);
                        if($updated){
                            $curl_config = [
                                'url' => ERP_BASE_API.'update_status/'.$id,
                                'method' => 'POST',
                                'data' => $post
                            ];
                            $this->curl_executer($curl_config);
                        }
                    }
                }
                if(isset($updated)){
                    session()->setFlashdata(['message'=>'Change Status successfully!', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong!', 'type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/course_modules'));

            }
        }
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc($this->coursefranchiseTbl,'',['cid','DESC']);
        return view('admin/modules/course_index', $data);
    }
    public function course_cu($id=false){
        $data = [];
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'c_name'=>'required',
                'c_f_name'=>'required',
                'course_fee'=>'required|decimal',
                'course_duration'=>'required',
            ]);
            if(!$validation){
                $data['validation'] = $this->validator;
            }else{
                $post = [];
                $post['c_name'] = $_POST['c_name'];
                $post['c_f_name'] = $_POST['c_f_name'];
                $post['course_fee'] = $_POST['course_fee'];
                $post['course_duration'] = $_POST['course_duration'];
                $post['course_cat'] = $_POST['course_cat'];
                $post['status'] = $_POST['status'];
                if(!$id){
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord($this->coursefranchiseTbl, $post);
                    if($inserted){
                        $curl_config = [
							'url' => ERP_BASE_API.'course_cu',
							'method' => 'POST',
							'data' => $post
						];
						$this->curl_executer($curl_config);
                        session()->setFlashdata(['message'=>'Course added successfuly','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }else{
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord($this->coursefranchiseTbl, $post, ['cid'=>$id]);
                    if($updated){
                        $curl_config = [
							'url' => ERP_BASE_API.'course_cu/'.$id,
							'method' => 'POST',
							'data' => $post
						];
						$this->curl_executer($curl_config);
                        session()->setFlashdata(['message'=>'Course Updated Successfully','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }
                
                return redirect()->to(site_url('admin/course_modules'));
            }
            
        }
       
        if($id){
            $data['course'] = $this->commonmodel->getOneRecord($this->coursefranchiseTbl, ['cid'=>$id]);
        }
        return view('admin/modules/course_cu', $data);
    }
    public function modules($cid, $id=null){
        $data = array();
        $course = $this->commonmodel->getOneRecord($this->coursefranchiseTbl, ['cid'=>$cid]);
        if ($this->request->getMethod() == 'post'){
            $rules = [
                'module_name'=>['rules'=>'required'],
                // 'full_marks'=>'required',
            ];
            if($course->course_cat == 'C'){
                $rules['full_marks'] = ['rules'=>'required'];
            }
            $validation = $this->validate($rules);
            if(!$validation){
                $data['validation'] = $this->validator;
            }else{
                $data['cid'] = $cid;
                $data['module_name'] = $_POST['module_name'];
                if($course->course_cat == 'C'){
                    $data['full_marks'] = $_POST['full_marks'];
                }
                $data['status'] = $_POST['status'];
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord($this->moduleTbl, $data);
                    if($inserted){
                        session()->setFlashdata(['message'=>'Module added successfuly','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }else{
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord($this->moduleTbl, $data, ['id'=>$id]);
                    if($updated){
                        session()->setFlashdata(['message'=>'Module Updated Successfully','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }
                
                return redirect()->to(site_url('admin/modules/'.$cid));
            }
            // print_r($_POST); exit;
        }
        if($id){
            $data['singleModule'] = $this->commonmodel->getOneRecord($this->moduleTbl, ['id'=>$id]); 
        }
        $data['course'] = $course;
        $data['modules'] = $this->commonmodel->getAllRecord($this->moduleTbl, ['cid'=>$cid]);
        return view('admin/modules/modules', $data);

    }
    
    /******************************************************************************************* */

    public function whatsapp_replied(){
        $data['whatsappReplied'] = $this->adminmodel->getWhatsappRepliedMessageList();
        return view('admin/ins_manage/whatsapp_replied', $data);
    }
    public function readWhatsAppMessage($phone){
        if($this->request->getMethod() == 'post'){
            //print_r($_POST);exit;
            $phone = $_POST['phone'];
            $message = $_POST['message'];

            //sending message
            $messageBody = array();
            $messageBody = [
                "messaging_product"=>"whatsapp",
                "preview_url" => true,
                "recipient_type" => "individual",
                "to" => "$phone",
                "type" => "text",
                "text" => [
                    "body" => "$message",
                ],
            ];
            $curl = curl_init();
            curl_setopt_array($curl, array(
            //CURLOPT_URL => 'https://graph.facebook.com/v13.0/FROM_PHONE_NUMBER_ID/messages', 
                CURLOPT_URL => 'https://graph.facebook.com/v18.0/'.FROM_PHONE_NUMBER.'/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($messageBody),
                // CURLOPT_POSTFIELDS => $messageBody,
                CURLOPT_HTTPHEADER => array(
                    "Authorization:Bearer ".WHATSAPP_ACCESS_TOKEN,
                    'Content-Type: application/json',

                ),
            ));
            $response = json_decode(curl_exec($curl), true);
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            //echo '<pre>'; print_r($response);
            //print_r($status_code); exit;

            if($status_code == 200){
                $this->session->setFlashdata(['message'=>'Message Sent Successfully', 'type'=>'success']);
                $whatsAppdata = array(
                    'phone1' => $phone,
                    'message' => $message,
                    'status' => 5, //chating
                    'read_status' => 1,
                    'added_at' => date('Y-m-d H:i:s'),
                );
                $this->commonmodel->insertRecord('tbl_whatsapp_reply_log', $whatsAppdata);
            }else{
                $this->session->setFlashdata(['message'=>'Message Not Sent!', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/readWhatsAppMessage/'.$phone));

        }
        $data['whatsappReplied'] = $this->adminmodel->getWhatsappRepliedMessageList($phone);
        $this->commonmodel->updateRecord('tbl_whatsapp_reply_log',['read_status'=>1, 'read_date'=>date('Y-m-d')],['phone1'=>$phone]);
        return view('admin/ins_manage/read_whatsapp_message', $data);
    }
    public function delete_whatsAppReplyLog($id){
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('/admin/whatsapp_replied?status=unread');
        if(!$id){
            return redirect()->to($referer);
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_whatsapp_reply_log',['log_id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to($referer);
        }
    }
    public function delete_whatsAppReplyLog_ByAjax(){
        if($this->request->getMethod() == 'post'){
            $log_ids = $_POST['log_ids'];
            $log_idsArr = json_decode($log_ids);
            foreach($log_idsArr as $log_id){
                $deleted = $this->commonmodel->deleteRecord('tbl_whatsapp_reply_log',['log_id'=>$log_id]);
            }
            if($deleted){
                $this->session->setFlashdata(['message'=>'Records Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Records Not Delete. Please try again...', 'type'=>'danger']);
            }
            echo 'success';
            exit;
        }else{
            $this->session->setFlashdata(['message'=>'You can not direct access...', 'type'=>'danger']);
            $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('/admin/whatsapp_replied?status=unread');
            return redirect()->to($referer);
        }
    }

    /************************Whatsapp************************************************************** */
    public function contact(){
        return view('admin/whatsapp/contact');
    }
    public function broadcast(){
        return view('admin/whatsapp/broadcast');
    }
    public function live_chat(){
        return view('admin/whatsapp/live_chat');
    }
    public function chat_history(){
        return view('admin/whatsapp/chat_history');
    }

    /******************************************Examination****************************************** */
    public function question_bank(){
        $url = base_url('admin/question_listing');
		if(isset($_GET['c_ids'])){
			$c_ids = (isset($_GET['c_ids']))?$_GET['c_ids']:'';
            $http_query = http_build_query(array('c_ids'=>$c_ids));
            $url = base_url('admin/question_listing?'.$http_query);
			session()->set('quesurl', $url, 300);
		}elseif(session()->has('quesurl')){
			$url = session('quesurl');
		}
		return redirect()->to($url);
        
    }
    public function question_listing(){
        $search = [];
        if(isset($_GET['c_ids'])){
            $search['c_ids'] = $_GET['c_ids'];
        }
        $data['qlisting'] = $this->adminmodel->get_question_list($search);
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc($this->coursefranchiseTbl, ['status'=>1], ['c_name','ASC']);
        return view('admin/examination/question_bank', $data);
    }
    public function reset_ques_url(){
		if(session()->has('quesurl')){
			session()->remove('quesurl');
		}
		return redirect()->to(base_url('admin/question_bank'));
	}
    public function add_edit_question($id=null){
        $data = [];
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'course_ids.*'=>[
                    'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please select Course',
                    ]
                ],
                // 'q_title_en.0'=>'required',
                // 'q_title_hn.0'=>'required',
            ]);
            if(!$validation){
                $data['validation'] = $this->validator;
            }else{
                
                $course_ids = implode(',', $_POST['course_ids']);
                // $totItems = count($_POST['q_title_en']);
                // echo $totItems;  exit;
                $insert = $update = 0;
                foreach($_POST['q_title_en'] as $i=>$q_title_en){
                    if(($q_title_en != '' || $_POST['q_title_hn'][$i] != '') && $_POST['opt1'][$i] != '' && $_POST['opt2'][$i] != '' && $_POST['opt3'][$i] != '' && $_POST['opt4'][$i] != '' && $_POST['opt1'][$i] != '' && isset($_POST['c_ans'][$i]) && $_POST['c_ans'][$i] != ''){
                        $post = array();
                        // $post['dh_id'] = session('dh_id');
                        $post['course_ids'] = $course_ids;
                        if($_POST['q_title_en'][$i] != ''){
                            $post['q_title_en'] = $q_title_en;
                        }
                        if($_POST['q_title_hn'][$i] != ''){
                            $post['q_title_hn'] = $_POST['q_title_hn'][$i];
                        }
                        $post['opt1'] = $_POST['opt1'][$i];
                        $post['opt2'] = $_POST['opt2'][$i];
                        $post['opt3'] = $_POST['opt3'][$i];
                        $post['opt4'] = $_POST['opt4'][$i];
                        $post['c_ans'] = $_POST['c_ans'][$i];
                        $post['status'] = $_POST['status'];
                        $post['added_by'] = session('user_id');
                        if(!$id){
                            $post['added_at'] = date('Y-m-d H:i:s');
                            $inserted = $this->commonmodel->insertRecord('tbl_question_bank', $post);
                            if($inserted){
                                $insert++;
                            }
                        }else{
                            $post['update_at'] = date('Y-m-d H:i:s');
                            $updated = $this->commonmodel->updateRecord('tbl_question_bank', $post,['qno'=>$id]);
                        }
                        
                    }
                }
                
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>$insert.' Question added successfuly','type'=>'success']);
                }elseif($updated){
                    session()->setFlashdata(['message'=>'1 Question updated successfuly','type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'All fields are mandatory. Please fill at least one question','type'=>'danger']);
                    return redirect()->to(site_url('admin/add_edit_question'));
                }
                return redirect()->to(site_url('admin/question_bank'));
            }
            
        }
       
        if($id){
            $data['ques'] = $this->commonmodel->getOneRecord('tbl_question_bank', ['qno'=>$id]);
        }
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc($this->coursefranchiseTbl, ['status'=>1], ['c_name','ASC']);
        return view('admin/examination/add_edit_question', $data);
    }
    public function del_question($id){
        if(!$id){
            return redirect()->to(base_url('admin/question_bank'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_question_bank',['qno'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('admin/question_bank'));
        }
    }
    public function exam_schedule(){
        $data['exam_list'] = $this->adminmodel->get_examination_list();
        return view('admin/examination/exam_schedule', $data);
    }
    public function add_edit_schedule($id=null){
        $data = [];
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'exam_name'=>[
                    'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please provide examination name.',
                    ]
                ],
                'course_ids.*'=>[
                    'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please select course.',
                    ]
                ],
                'date'=>[
                    'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please provide examination Date.',
                    ]
                ],
                'time_from'=>[
                    'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please provide time from.',
                    ]
                ],
                'time_to'=>[
                    'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please provide time to.',
                    ]
                ],
                'tot_ques'=>[
                    'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please provide total question.',
                    ]
                ],
                'frst_ids.*'=>[
                    'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please select students.',
                    ]
                ],
                'status'=>'required',
                // 'q_title_hn.0'=>'required',
            ]);
            if(!$validation){
                $data['validation'] = $this->validator;
            }else{
                // print_r($_POST); exit;
                
                $post = array();
                // $post['dh_id'] = session('dh_id');
                $post['exam_name'] = $_POST['exam_name'];
                $post['course_ids'] = implode(',',$_POST['course_ids']);
                $post['frst_ids'] = implode(',',$_POST['frst_ids']);
                $post['date'] = date('Y-m-d',strtotime($_POST['date']));
                $post['time_from'] = date('H:i:s',strtotime($_POST['time_from']));
                $post['time_to'] = date('H:i:s',strtotime($_POST['time_to']));
                $dt1 = date_create(date('Y-m-d H:i:s',strtotime(date('Y-m-d'.' '.$post['time_from']))));
                $dt2 = date_create(date('Y-m-d H:i:s',strtotime(date('Y-m-d'.' '.$post['time_to']))));
                $interval = date_diff($dt2, $dt1);
                $duration = date('H:i:s',strtotime($interval->format('%h:%i:%s')));
                $post['duration'] = $duration;
                $post['tot_ques'] = $_POST['tot_ques'];
                $post['status'] = $_POST['status'];
                if(!$id){
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_exam_schedule', $post);
                    foreach($_POST['frst_ids'] as $frst_id){
                        $examinee = array();
                        $examinee['exsch_id'] = $inserted;
                        // $examinee['dh_id'] = session('dh_id');
                        $examinee['frst_id'] = $frst_id;
                        $examinee['duration'] = $duration;
                        $examinee['status'] = 0;
                        $examinee['added_at'] = date('Y-m-d H:i:s');
                        $this->commonmodel->insertRecord('tbl_examinee', $examinee);
                        $this->commonmodel->updateRecord($this->studentsFranchiseTbl,['is_examinee'=>1],['frst_id'=>$frst_id]);
                    }
                    $exam_url = base_url('pro-examination/'.base64url_encode($inserted.'-'.time()));
                    $this->commonmodel->updateRecord('tbl_exam_schedule',['exam_url'=>$exam_url],['id'=>$inserted]);

                }else{
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_exam_schedule', $post,['id'=>$id]);
                    $frst_ids = $_POST['frst_ids'];
                    $old_frst_ids = explode(',',$_POST['old_frst_ids']);
                    $ids_for_insert = array_diff($frst_ids,$old_frst_ids);
                    $ids_for_delete = array_diff($old_frst_ids,$frst_ids);
                    if(!empty($ids_for_insert)){
                        foreach($ids_for_insert as $frst_id){
                            $examinee = array();
                            $examinee['exsch_id'] = $id;
                            // $examinee['dh_id'] = session('dh_id');
                            $examinee['frst_id'] = $frst_id;
                            $examinee['duration'] = $duration;
                            $examinee['status'] = 0;
                            $examinee['added_at'] = date('Y-m-d H:i:s');
                            $this->commonmodel->insertRecord('tbl_examinee', $examinee);
                            $this->commonmodel->updateRecord($this->studentsFranchiseTbl,['is_examinee'=>1],['frst_id'=>$frst_id]);
                        }
                    }
                    if(!empty($ids_for_delete)){
                        foreach($ids_for_delete as $frst_id){
                            $this->commonmodel->deleteRecord('tbl_examinee', ['exsch_id'=>$id,'frst_id'=>$frst_id]);
                            $this->commonmodel->updateRecord($this->studentsFranchiseTbl,['is_examinee'=>0],['frst_id'=>$frst_id]);
                        }
                    }
                    if($_POST['duration'] != $duration){
                        $sch = $this->commonmodel->getOneRecord('tbl_exam_schedule', ['id'=>$id]);
                        if($sch->frst_ids != ''){
                            foreach(explode(',', $sch->frst_ids) as $frst_id){
                                $this->commonmodel->updateRecord('tbl_examinee', ['duration'=>$duration], ['exsch_id'=>$id,'frst_id'=>$frst_id]);
                            }
                        }
                    }
                    // echo '<pre>'; print_r($ids_for_insert);print_r($ids_for_delete); exit;
                }
                
                
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Exam schedule added successfuly','type'=>'success']);
                }elseif(isset($updated)){
                    session()->setFlashdata(['message'=>'Exam schedule updated successfuly','type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'something went wrong','type'=>'danger']);
                }
                return redirect()->to(site_url('admin/exam_schedule'));
            }
        }
       
        if($id){
            $data['sch'] = $this->commonmodel->getOneRecord('tbl_exam_schedule', ['id'=>$id]);
            $data['selected_stu'] = $this->adminmodel->get_selected_franchise_students_for_examination($data['sch']->frst_ids);
        }
        $data['students'] = $this->adminmodel->get_franchise_students_for_examination();
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc($this->coursefranchiseTbl, ['status'=>1], ['c_name','ASC']);
        return view('admin/examination/add_edit_schedule', $data);
    }
    
    public function del_schedule($id){
        if(!$id){
            return redirect()->to(base_url('admin/exam_schedule'));
        }else{
            $exam_sch = $this->commonmodel->getOneRecord('tbl_exam_schedule', ['id'=>$id]);
            $frst_idsArr = explode(',', $exam_sch->frst_ids);
            if(!empty($frst_idsArr)){
                foreach($frst_idsArr as $frst_id){
                    $this->commonmodel->updateRecord($this->studentsFranchiseTbl,['is_examinee'=>0],['frst_id'=>$frst_id]);
                }

            }
            $deleted = $this->commonmodel->deleteRecord('tbl_examinee',['exsch_id'=>$id]);
            $deleted = $this->commonmodel->deleteRecord('tbl_exam_schedule',['id'=>$id]);
            if($deleted = 1){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('admin/exam_schedule'));
        }
    }
    public function view_schedule($id){
        $data['sch'] = $this->commonmodel->getOneRecord('tbl_exam_schedule', ['id'=>$id]);
        return view('admin/examination/view_schedule', $data);
    }
    public function view_student_result_by_ajax(){
        if($this->request->getMethod() === 'post'){
            $id = $_POST['id'];
            $student =  $this->adminmodel->get_examinee_details($id);
            $output = '<span class="text-danger text-center">No details</span>';
            if(!empty($student)){
                $status = get_examinee_status_txt($student->status);
                $photo = base_url('public/assets/upload/images/'.$student->photo);
                
                /*$gp = '';
                if($student->course_cat == 'C' && $student->is_cert == 'yes'){
                    $gp = '<div class="col-md-2 my-2">
                        <strong>Grade:</strong>
                    </div>
                    <div class="col-md-4 my-2">
                        <span><strong>'.$student->grade.'</strong></span>
                    </div>
                    <div class="col-md-2 my-2">
                        <strong>Percentage:</strong>
                    </div>
                    <div class="col-md-4 my-2">
                        <span><strong>'.$student->percentage.'%</strong></span>
                    </div>';
                }
                $issueDate = 'N/A';
                if($student->cert_issue_date != '0000-00-00'){
                    $issueDate = date('d-M-Y',strtotime($student->cert_issue_date));
                }
                $isdt = '';
                if($student->status == 3){
                    $isdt = '<div class="col-md-2 my-2">
                        <strong>Issue Date:</strong>
                    </div>
                    <div class="col-md-4 my-2">
                        <span>'.$issueDate.'</span>
                    </div>';
                }
                $type = ($student->stu_type == 'NR')?'Non-Regular':'Regular';
                $marksDtls = '';
                if($student->is_cert == 'yes' && $student->module_marks != ''){
                    $stumarks = json_decode($student->module_marks);
                    $marksDtls = '<div class="col-md-12 my-2">
                        <p><strong>Marks Details:</strong></p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Module Name</th>';
                                    if($student->course_cat == 'C'){
                                        $marksDtls .= '<th scope="col">Full Marks</th>
                                                    <th scope="col">Marks Obtained</th>';
                                    }else{
                                        $marksDtls .= '<th scope="col">Speed (WPM)</th>';
                                    }
                $marksDtls .= '</tr>
                            </thead>
                            <tbody>';
                        if(!empty($stumarks)){ $sn=1;
                            foreach($stumarks as $list){
                            $marksDtls .='<tr>
                                <td>'.$sn++.'</td>
                                <td>'.$list->module_name.'</td>';
                                if($student->course_cat == 'C'){
                                    $marksDtls .= '<td>'.$list->fm.'</td>';
                                }
                $marksDtls .=   '<td>'.$list->mo.'</td>
                            </tr>';
                        } }
                        $marksDtls .= '</tbody>';
                                    if($student->course_cat == 'C'){
                        $marksDtls .=   '<tfoot>
                                            <tr>
                                                <th colspan="2">Total</th>
                                                <th>'.$student->tot_fm.'</th>
                                                <th>'.$student->tot_mo.'</th>
                                            </tr>
                                        </tfoot>'; }
                $marksDtls .= '</table>
                    </div>';
                }*/
                $tot_atmpt = $student->true_ans + $student->false_ans;
                $output =    '<div class="row">
                        <div class="col-md-2 my-2">
                            <strong>Student\'s Name:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->frstu_name.'</span>
                        </div>
                        <div class="col-md-6 my-2">
                            <img src="'.$photo.'" alt="photo" width="60px" height="50px">
                        </div>
                       
                        <div class="col-md-2 my-2">
                            <strong>Course For:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->c_f_name.'</span>
                        </div>
                        
                        <div class="col-md-2 my-2">
                            <strong>Exam Name:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->exam_name.'</span>
                        </div>

                        <div class="col-md-2 my-2">
                            <strong>Date:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.date('d-m-Y', strtotime($student->date)).'</span>
                        </div>
                        
                        <div class="col-md-2 my-2">
                            <strong>Time From:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.date('h:i:s A', strtotime($student->time_from)).'</span>
                        </div>
                        
                        <div class="col-md-2 my-2">
                            <strong>Time To:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.date('h:i:s A', strtotime($student->time_to)).'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Total Ques.:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->tot_ques.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Total Attempt:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$tot_atmpt.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>TRUE:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->true_ans.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>FALSE:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->false_ans.'</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Result:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$student->result.'%</span>
                        </div>
                        <div class="col-md-2 my-2">
                            <strong>Status:</strong>
                        </div>
                        <div class="col-md-4 my-2">
                            <span>'.$status.'</span>
                        </div>
                    </div>';
            }
            echo $output; exit;
        }
        return redirect()->to(base_url('/admin/exam_schedule'));
    }
    public function delete_image($config){
        $config = json_decode(base64_decode($config));
        // print_r($config); exit;
        if($config->id){
            $delete = $this->commonmodel->updateRecord($config->table,[$config->img_field=>''],[$config->where_field=>$config->id]);
            if($delete){
                $filename = './public/assets/upload/images/'.$config->image;
                unlink($filename);
                $this->session->setFlashdata(['message'=>'Image Removed Successfully', 'type'=>'success']);
                return redirect()->to($config->leave_url);
            }
        }else{
            return redirect()->to(base_url('admin/blogs'));
        }
    }
    function curl_executer($config){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $config['url'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $config['method'],
		  CURLOPT_POSTFIELDS => $config['data'],
		  CURLOPT_HTTPHEADER => array(
			'ERP-API-KEY: erp@#9_56$24',
			'Cookie: ci_session=13bd3fef47e1d5d0cdeddc6fc36989386898d9dc'
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		return $response;
	}
}
?>