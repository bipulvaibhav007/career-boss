<?php

namespace App\Controllers;

class Member extends BaseController
{
    public $commonmodel;
    public $session;
    public $membermodel;
    public $studentsfranchiseTbl;
    public $randomcodeTbl;
    public $coursefranchiseTbl;
    public function __construct()
    {
        date_default_timezone_set('Asia/Kolkata');
        $this->studentsfranchiseTbl = 'tbl_students_franchise';
        $this->randomcodeTbl = 'tbl_random_code';
        $this->coursefranchiseTbl = 'tbl_course_franchise';
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->membermodel = model('App\Models\Member_model', false);
    }
    /*******************************************************************************************
    -------------------------------------MEMBER AUTHENTICATION SECTION--------------------------
    ********************************************************************************************/
    public function login(){
        $data = array();
        if($this->request->getMethod() === 'post'){
            $validation = $this->validate([
                'phone'=>[
                    'rules'=>'required|is_not_unique[tbl_members.phone]',
                    'errors'=>['required'=>'Mobile is required',
                                'is_not_unique'=>'This Mobile No is not registered in our system']
                ],
                'password'=>[
                    'rules'=>'required|min_length[6]|max_length[16]',
                    'errors'=>['required'=>'Password is required',
                                'min_length'=>'Password must have atleast 6 character in length',
                                'max_length'=>'Password must not have characters more than 16 in length']
                ],
            ]);
            if(!$validation){
                $data['validation'] = $this->validator; 
            }else{
                $phone = $this->request->getPost('phone');
                $password = $this->request->getPost('password');
                $user_info = $this->membermodel->isvalidate($phone);
                if(empty($user_info)){
                    session()->setFlashdata('alert_error','Invalid User State.');
                    return redirect()->to(base_url('/login'))->withInput();
                }
                $check_password = password_verify($password, $user_info->password);
                if(!$check_password){
                    session()->setFlashdata('alert_error','Incorrect Password');
                    return redirect()->to(base_url('/login'))->withInput();
                }else{
                    session()->set(array(
                        'm_id' => $user_info->m_id,
                        'm_full_name' => $user_info->m_full_name,
                        'email' => $user_info->email,
                        //'image' => $user_info->image,
                        'phone' => $user_info->phone,
                        'MemberIsLoggedIn' => true,
                    ));
                    return redirect()->to(base_url('/member-dashboard'));
                }
            }
        }
        echo view('include/header',$data);
        echo view('member/login', $data);
        echo view('include/footer', $data);
    }
    public function register(){
        $data = array();
        if($this->request->getMethod() === 'post'){
            $rules = [
                /*'cust_group_id'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Customer Type is required']
                ], */
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
                    'rules'=>'required|is_unique[tbl_members.phone]|is_natural|min_length[10]|max_length[10]',
                    'errors'=>['required'=>'Mobile No is required',
                                'is_unique'=>'This mobile no is already registered in our system',
                                'is_natural'=>'The Mobile No must only contain digits.',
                                'min_length'=>'Mobile No must be 10 digit in length',
                                'max_length'=>'Mobile No must not have more than 10 digit in length']
                ],
                /*'referral_code'=>[
                    'rules'=>'is_not_unique[tbl_customer.cust_code]',
                    'errors'=>['is_not_unique'=>'This code is not registered in our system']
                ], */
                /*'password'=>[
                    'rules'=>'required|min_length[6]|max_length[16]',
                    'errors'=>['required'=>'Password is required',
                                'min_length'=>'Password must have atleast 6 character in length',
                                'max_length'=>'Password must not have characters more than 16 in length']
                ],
                'cpassword'=>[
                    'rules'=>'required|matches[password]',
                    'errors'=>['required'=>'Confirm Password is required',
                                'matches'=>'Confirm Password not matches to password']
                ], */
                //'g-recaptcha-response'=>['rules'=>'required','errors'=>['required'=>'recaptcha is required']]
            ];
            $rules['center_name'] = [
                'rules'=>'required',
                'errors'=>['required'=>'Center Name is required',]
            ];
            $rules['center_address'] = [
                'rules'=>'required',
                'errors'=>['required'=>'Center Address is required',]
            ];
            $validation = $this->validate($rules);
            if(!$validation){
                $data['validation'] = $this->validator; 
            }else{
                $token = $this->request->getPost('token');
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.SECRETKEY.'&response='.$token.'&remoteip='.$this->request->getIPAddress().'';
                $res = file_get_contents($url);
                $response = json_decode($res);

                if($response->success){
                    $post = array();
                    $post['m_full_name']    = trim($this->request->getPost('m_full_name'));
                    $post['address']        = trim($this->request->getPost('address'));
                    $post['phone']          = $this->request->getPost('phone');
                    $post['email']          = $this->request->getPost('email');
                    // $post['password']       = password_hash($this->request->getPost('cpassword'), PASSWORD_DEFAULT);
                    $post['center_name']          = $this->request->getPost('center_name');
                    $post['center_address']       = $this->request->getPost('center_address');
                    $post['member_type'] = 1;
                    $post['status']         = 0;
                    $insertId = $this->commonmodel->insertRecord('tbl_members', $post); 
                        if($insertId){
                            /*$setting = $this->commonmodel->get_setting(1);
                            /*$msg = '<h2>Contact us</h2>
                                <p><strong>Full Name: </strong>'.$this->request->getPost('name').'</p>
                                <p><strong>Email: </strong>'.$this->request->getPost('email').'</p>
                                <p><strong>Phone: </strong>'.$this->request->getPost('phone').'</p>
                                <p><strong>Message: </strong>'.$this->request->getPost('message').'</p>';*/
                            /*$msg = '<p>Thank you for contacting us!. We will be in touch with you shortly.</p>
                                    <p><strong>Regards</strong></p>
                                    <p><strong>Career-Boss</strong></p>';
                            $email = \Config\Services::email();
        
                            $email->setFrom($setting->email, 'Career-Boss');
                            $email->setTo($this->request->getPost('email'));
                            //$email->setTo('test136@yopmail.com');
                            
                            $email->setSubject('Enroll Course');
                            $email->setMessage($msg);
                            
                            $email->send();*/

                            //for notification 
                            $notifyData = array();
                            $notifyData['franchise_id'] = $insertId;
                            $notifyData['type'] = 1;
                            $notifyData['message'] = $post['m_full_name'].' has requested as a franchiese.';
                            $notifyData['added_at'] = date('Y-m-d H:i:s');
                            $this->commonmodel->insertRecord('tbl_notification', $notifyData);
                            $swalText = 'Your request for franchise has been sent successfully to the administrator. We will contact you soon!';
                            $swal_session = array(
                                'title'=>'Thank You!',
                                'text'=> $swalText,
                            );
                            session()->set('swal_session', $swal_session);
                            
                        }else{
                            $swal_session = array(
                                'title'=>'Oops!',
                                'text'=>'Something went wrong!.',
                                'icon'=>'error',
                            );
                            session()->set('swal_session', $swal_session);
                        }
                }else{
                    $swal_session = array(
                        'title' => 'Failed!',
                        'text' => 'Verification Failed by Google.',
                    );
                    session()->set('swal_session', $swal_session);

                }
                return redirect()->to(base_url('/login'));

            }
        }
        //$this->data['customerGroup'] = $this->commonfrontmodel->get_all_record('tbl_customer_group', ['status'=>1]);
        echo view('include/header',$data);
        echo view('member/franchise_register', $data);
        echo view('include/footer', $data);
    }
    public function referrer_register(){
        $data = array();
        // $is_referer = 1;
        
        if($this->request->getMethod() === 'post'){
            /*if($_POST['member_type'] == 'franchise'){
                $is_referer = 0;
            }*/
            $rules = [
                /*'cust_group_id'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Customer Type is required']
                ], */
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
                    'rules'=>'required|is_unique[tbl_members.phone]|is_natural|min_length[10]|max_length[10]',
                    'errors'=>['required'=>'Mobile No is required',
                                'is_unique'=>'This mobile no is already registered in our system',
                                'is_natural'=>'The Mobile No must only contain digits.',
                                'min_length'=>'Mobile No must be 10 digit in length',
                                'max_length'=>'Mobile No must not have more than 10 digit in length']
                ],
                /*'referral_code'=>[
                    'rules'=>'is_not_unique[tbl_customer.cust_code]',
                    'errors'=>['is_not_unique'=>'This code is not registered in our system']
                ], */
                /* 'password'=>[
                    'rules'=>'required|min_length[6]|max_length[16]',
                    'errors'=>['required'=>'Password is required',
                                'min_length'=>'Password must have atleast 6 character in length',
                                'max_length'=>'Password must not have characters more than 16 in length']
                ],
                'cpassword'=>[
                    'rules'=>'required|matches[password]',
                    'errors'=>['required'=>'Confirm Password is required',
                                'matches'=>'Confirm Password not matches to password']
                ], */
                //'g-recaptcha-response'=>['rules'=>'required','errors'=>['required'=>'recaptcha is required']]
            ];
            //if(!$is_referer){
                /*$rules['center_name'] = [
                    'rules'=>'required',
                    'errors'=>['required'=>'Center Name is required',]
                ];
                $rules['center_address'] = [
                    'rules'=>'required',
                    'errors'=>['required'=>'Center Address is required',]
                ];*/
            //}
            //if($is_referer){
                $rules['password'] = [
                                        'rules'=>'required|min_length[6]|max_length[16]',
                                        'errors'=>['required'=>'Password is required',
                                                    'min_length'=>'Password must have atleast 6 character in length',
                                                    'max_length'=>'Password must not have characters more than 16 in length']
                                    ];
                $rules['cpassword'] = [
                                        'rules'=>'required|matches[password]',
                                        'errors'=>['required'=>'Confirm Password is required',
                                                    'matches'=>'Confirm Password not matches to password']
                                    ];
            //}   

            $validation = $this->validate($rules);
            if(!$validation){
                $data['validation'] = $this->validator; 
            }else{
                $token = $this->request->getPost('token');
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.SECRETKEY.'&response='.$token.'&remoteip='.$this->request->getIPAddress().'';
                $res = file_get_contents($url);
                $response = json_decode($res);

                if($response->success){
                    $post = array();
                    $post['m_full_name']    = trim($this->request->getPost('m_full_name'));
                    $post['address']        = trim($this->request->getPost('address'));
                    $post['phone']          = $this->request->getPost('phone');
                    $post['email']          = $this->request->getPost('email');
                    //if($is_referer){
                        $post['password']       = password_hash($this->request->getPost('cpassword'), PASSWORD_DEFAULT);
                    //}
                    //if(!$is_referer){
                        // $post['center_name']          = $this->request->getPost('center_name');
                        // $post['center_address']       = $this->request->getPost('center_address');
                    //}

                    // $post['member_type'] = ($_POST['member_type'] == 'franchise')?1:0;
                    // $post['status']      = ($_POST['member_type'] == 'franchise')?0:1;
                    $post['member_type'] = 0;
                    $post['status']      = 1;
                    $insertId = $this->commonmodel->insertRecord('tbl_members', $post); 
                    if($insertId){
                        /*$setting = $this->commonmodel->get_setting(1);
                        /*$msg = '<h2>Contact us</h2>
                            <p><strong>Full Name: </strong>'.$this->request->getPost('name').'</p>
                            <p><strong>Email: </strong>'.$this->request->getPost('email').'</p>
                            <p><strong>Phone: </strong>'.$this->request->getPost('phone').'</p>
                            <p><strong>Message: </strong>'.$this->request->getPost('message').'</p>';*/
                        /*$msg = '<p>Thank you for contacting us!. We will be in touch with you shortly.</p>
                                <p><strong>Regards</strong></p>
                                <p><strong>Career-Boss</strong></p>';
                        $email = \Config\Services::email();
    
                        $email->setFrom($setting->email, 'Career-Boss');
                        $email->setTo($this->request->getPost('email'));
                        //$email->setTo('test136@yopmail.com');
                        
                        $email->setSubject('Enroll Course');
                        $email->setMessage($msg);
                        
                        $email->send();*/
                        $swalText = 'Thank you for register!. You can login in our system.';
                        // if(!$is_referer){
                            //for notification 
                            /*$notifyData = array();
                            $notifyData['franchise_id'] = $insertId;
                            $notifyData['type'] = 1;
                            $notifyData['message'] = $post['m_full_name'].' has requested as a referrer.';
                            $notifyData['added_at'] = date('Y-m-d H:i:s');
                            $this->commonmodel->insertRecord('tbl_notification', $notifyData);

                            $swalText = 'Your request for franchise has been sent successfully to the administrator. We will contact you soon!';*/
                        // }
                        $swal_session = array(
                            'title'=>'Thank You!',
                            'text'=> $swalText,
                        );
                        session()->set('swal_session', $swal_session);
                        
                    }else{
                        $swal_session = array(
                            'title'=>'Oops!',
                            'text'=>'Something went wrong!.',
                            'icon'=>'error',
                        );
                        session()->set('swal_session', $swal_session);
                    }
                }else{
                    $swal_session = array(
                        'title' => 'Failed!',
                        'text' => 'Verification Failed by Google.',
                    );
                    session()->set('swal_session', $swal_session);

                }
                return redirect()->to(base_url('/login'));
            }
        }
        //$this->data['customerGroup'] = $this->commonfrontmodel->get_all_record('tbl_customer_group', ['status'=>1]);
        
        // print_r($data); exit;
        echo view('include/header',$data);
        echo view('member/referal_register', $data);
        echo view('include/footer', $data);
    }
    public function member_dashboard(){
        $data['memberDtls'] = $this->commonmodel->getOneRecord('tbl_members', ['m_id'=>session('m_id')]);
        $data['counttotal'] = $this->membermodel->get_num_of_students_by_status();
        $data['countnew'] = $this->membermodel->get_num_of_students_by_status(1);
        $data['countud'] = $this->membermodel->get_num_of_students_by_status(2);
        $data['countadm'] = $this->membermodel->get_num_of_students_by_status(3);
        echo view('include/header',$data);
        echo view('member/member_dashboard', $data);
        echo view('include/footer', $data);
    }
    public function student_list(){
        $data['studentsList'] =  $this->membermodel->getAllStudentRecord();
        echo view('include/header',$data);
        echo view('member/student_list', $data);
        echo view('include/footer', $data);
    }
    public function student_cu($stu_id=null){
        $data = array();
        if($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'stu_name'=>[
                    'rules'=>'required|alpha_numeric_space',
                    'errors'=>['required'=>'Student\'s Full name is required',
                                'alpha_numeric_space'=>'Please enter valid name.']
                ],
                'phone'=>[
                    'rules'=>'required|is_natural|min_length[10]|max_length[10]',
                    'errors'=>['required'=>'Mobile No is required',
                                'is_natural'=>'The Mobile No must only contain digits.',
                                'min_length'=>'Mobile No must be 10 digit in length',
                                'max_length'=>'Mobile No must not have more than 10 digit in length']
                ],
                'course_id'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please select any course.']
                ],
            ]);
            if(!$validation){
                $data['validation'] = $this->validator; 
            }else{
                //print_r($_POST);exit;
                $post = array();
                $post['stu_name']       = trim($this->request->getPost('stu_name'));
                $post['address']        = trim($this->request->getPost('address'));
                $post['phone']          = $this->request->getPost('phone');
                $post['course_id']      = $this->request->getPost('course_id');
                $post['member_id']      = session('m_id');
                $post['status']         = $this->request->getPost('status');
                if(!$stu_id){
                    $post['added_at']   = date('Y-m-d H:i:s');
                    $insertId = $this->commonmodel->insertRecord('tbl_students_referal', $post); 
                }else{
                    $post['update_at']   = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_students_referal', $post, ['stu_id'=>$stu_id, 'member_id'=>session('m_id')]);
                }
                if(isset($insertId)){
                    session()->setFlashdata(['alert_message'=>'Student Added Successfully!', 'alert_type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['alert_message'=>'Student Updated Successfully!', 'alert_type'=>'success']);
                }else{
                    session()->setFlashdata(['alert_message'=>'Something went wrong!', 'alert_type'=>'danger']);
                }
                return redirect()->to(base_url('/student-list'));
            }
            
        }
        if($stu_id){
            $data['student'] = $this->commonmodel->getOneRecord('tbl_students_referal',['stu_id'=>$stu_id, 'member_id'=>session('m_id')]);
            if(empty($data['student'])){
                session()->setFlashdata(['alert_message'=>'Something went wrong!', 'alert_type'=>'danger']);
                return redirect()->to(base_url('/student-list'));
            }
        }
        $data['courses'] = $this->commonmodel->getAllRecord('tbl_courses');
        echo view('include/header',$data);
        echo view('member/student_cu', $data);
        echo view('include/footer', $data);
    }
    public function student_delete($stu_id){
        $deleted = $this->commonmodel->deleteRecord('tbl_students_referal',['stu_id'=>$stu_id, 'member_id'=>session('m_id')]);
        if($deleted){
            session()->setFlashdata(['alert_message'=>'Student Deleted Successfully!', 'alert_type'=>'success']);
        }else{
            session()->setFlashdata(['alert_message'=>'Something went wrong!', 'alert_type'=>'danger']);
        }
        return redirect()->to(base_url('/student-list'));
    }
    /*****************************franchise************************** */
    public function get_module_html(){
        if(isset($_POST['cid']) && $_POST['cid'] != ''){
            $cid = $_POST['cid'] ;
            $course = $this->commonmodel->getOneRecord($this->coursefranchiseTbl, ['cid'=>$cid]);
            $modules = $this->commonmodel->getAllRecordOrderByDesc('tbl_module', ['status'=>1,'cid'=>$cid],['id','ASC']);
            
                $html = '';
                if($course->course_cat == 'C' || $course->course_cat == 'T'){
                $html = '<thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Module Name</th>';
                                if($course->course_cat == 'C'){
                                    $html .= '<th scope="col">Full Marks</th>
                                    <th scope="col">Marks Obtained</th>';
                                } else{
                                    $html .= '<th scope="col">Speed (WPM)</th>';
                                }
                            $html .= '</tr>
                        </thead>
                        <tbody>';
                if(!empty($modules)){
                    $sn = 1;
                    foreach($modules as $i=>$list){
                        $html .= '<tr>
                                    <td>'.$sn++.'</td>
                                    <td>'.$list->module_name.'</td>';
                                    if($course->course_cat == 'C'){
                                        $html .= '<td>'.$list->full_marks.'</td>';
                                    }
                                    $html .= '<td>
                                            <div class="form-group">
                                                <input type="hidden" name="module_name['.$i.']" value="'.$list->module_name.'">
                                                <input type="hidden" name="fm['.$i.']" value="'.$list->full_marks.'">
                                                <input type="hidden" name="id['.$i.']" value="'.$list->id.'">
                                                <input type="text" name="mo['.$i.']" value="'.set_value('mo['.$i.']').'" id="mo'.$i.'" class="form-control">
                                            </div>
                                        </td>
                                </tr>';
                    }
                }else{
                    $html .= '<tr ><td colspan="4" class="text-danger text-center">Module not available. Please contact administrator.</td></tr>';
                }
                $html .= '</body>';
                }
                echo $html; exit;
        }
    }
    public function get_districts(){
        $output = '';
        if($this->request->getMethod() == 'post'){
            $stateId = $_POST['stateId'];
            $districts = $this->commonmodel->getAllRecordOrderByDesc('cities', ['state_id'=>$stateId],['city','ASC']);
            $output = '<option value="">Select One</option>';
            if(!empty($districts)){
                foreach($districts as $list){
                    $output .= '<option value="'.$list->id.'">'.$list->city.'</option>';
                }
            }
        }
        echo $output; exit;
    }
    /*****************************End Franchise************************** */
    public function bank_details(){
        $data['bankDtls'] = $this->commonmodel->getOneRecord('tbl_bank_details',['m_id'=>session('m_id')]);
        if($this->request->getMethod() == 'post'){
            //print_r($_POST);exit;
            $validation = $this->validate([
                'acc_holder_name'=>[
                    'rules'=>'required|alpha_numeric_space',
                    'errors'=>['required'=>'Account Holder\'s name is required',
                                'alpha_numeric_space'=>'Please enter valid name.']
                ],
                'bank_name'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Bank Name is required.']
                ],
                'acc_no'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please Enter Account Number.']
                ],
                'c_acc_no'=>[
                    'rules'=>'required|matches[acc_no]',
                    'errors'=>['required'=>'Confirm Account Number is required',
                                'matches'=>'Confirm Account Number not matches to Account Number']
                ],
                'ifsc_code'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please Enter IFSC Code.']
                ],
                'bank_address'=>[
                    'rules'=>'required',
                    'errors'=>['required'=>'Please Enter Bank Address.']
                ],
            ]);
            if(!$validation){
                $data['validation'] = $this->validator; 
            }else{
                //print_r($_POST);exit;
                $m_id = $this->request->getPost('m_id');
                $bnk_id = $this->request->getPost('bnk_id');
                $post = array();
                $post['m_id']               = session('m_id');
                $post['acc_holder_name']    = trim($this->request->getPost('acc_holder_name'));
                $post['bank_name']          = trim($this->request->getPost('bank_name'));
                $post['acc_no']             = $this->request->getPost('acc_no');
                $post['ifsc_code']          = $this->request->getPost('ifsc_code');
                $post['bank_address']       = $this->request->getPost('bank_address');
                $post['status']             = 0;
                if($m_id == '' && $bnk_id == ''){
                    $post['added_at']   = date('Y-m-d H:i:s');
                    $insertId = $this->commonmodel->insertRecord('tbl_bank_details', $post); 
                }else{
                    $post['update_at']   = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_bank_details', $post, ['m_id'=>$m_id, 'bnk_id'=>$bnk_id]);
                }
                if(isset($insertId)){
                    session()->setFlashdata(['alert_message'=>'Bank Details Added Successfully!', 'alert_type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['alert_message'=>'Bank Details Updated Successfully!', 'alert_type'=>'success']);
                }else{
                    session()->setFlashdata(['alert_message'=>'Something went wrong!', 'alert_type'=>'danger']);
                }
                return redirect()->to(base_url('/bank-details'));
            }
        }
        
        echo view('include/header',$data);
        echo view('member/bank_details', $data);
        echo view('include/footer', $data);
    }
    public function profile(){
        $m_id = session('m_id');
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
                /*'phone'=>[
                    'rules'=>'required|is_natural|min_length[10]|max_length[10]',
                    'errors'=>['required'=>'Mobile No is required',
                                'is_natural'=>'The Mobile No must only contain digits.',
                                'min_length'=>'Mobile No must be 10 digit in length',
                                'max_length'=>'Mobile No must not have more than 10 digit in length']
                ],*/
                
            ]);
            if(!$validation){
                $data['validation'] = $this->validator; 
            }else{
                $post = array();
                $post['m_full_name']    = trim($this->request->getPost('m_full_name'));
                $post['address']        = trim($this->request->getPost('address'));
                // $post['phone']          = $this->request->getPost('phone');
                $post['email']          = $this->request->getPost('email');
                $post['updated']        = date('Y-m-d H:i:s');
                $updated = $this->commonmodel->updateRecord('tbl_members', $post, ['m_id'=>$m_id]); 
                if($updated){
                    $sesRemoveItems = ['m_id','m_full_name','email','phone','MemberIsLoggedIn'];
                    session()->remove($sesRemoveItems);
                    $memberDtls = $this->commonmodel->getOneRecord('tbl_members',['m_id'=>$m_id]);
                    session()->set(array(
                        'm_id' => $memberDtls->m_id,
                        'm_full_name' => $memberDtls->m_full_name,
                        'email' => $memberDtls->email,
                        //'image' => $user_info->image,
                        'phone' => $memberDtls->phone,
                        'MemberIsLoggedIn' => true,
                    ));
                    session()->setFlashdata(['alert_message'=>'Profile updated successfully!', 'alert_type'=>'success']);
                }else{
                    session()->setFlashdata(['alert_message'=>'Something went wrong!', 'alert_type'=>'danger']);
                }
                return redirect()->to(base_url('/profile'));
            }
        }
        $data['memberDtls'] = $this->commonmodel->getOneRecord('tbl_members',['m_id'=>$m_id]);
        echo view('include/header',$data);
        echo view('member/profile', $data);
        echo view('include/footer', $data);
    }
    public function change_password(){
        $data = array();
        if($this->request->getMethod() == 'post'){
            
            $validation = $this->validate([
                
                'password'=>[
                    'rules'=>'required|min_length[6]|max_length[16]',
                    'errors'=>['required'=>'Password is required',
                                'min_length'=>'Password must have atleast 6 character in length',
                                'max_length'=>'Password must not have characters more than 16 in length']
                ],
                'cpassword'=>[
                    'rules'=>'required|matches[password]',
                    'errors'=>['required'=>'Confirm Password is required',
                                'matches'=>'Confirm Password not matches to password']
                ],
            ]);
            if(!$validation){
                $data['validation'] = $this->validator; 
            }else{
                $post = array();
                $post['password']       = password_hash($this->request->getPost('cpassword'), PASSWORD_DEFAULT);
                if($_POST['m_id'] == session('m_id')){
                    //print_r($_POST); exit;
                    $updated = $this->commonmodel->updateRecord('tbl_members', $post, ['m_id'=>session('m_id')]);
                    if(isset($updated)){
                        session()->setFlashdata(['alert_message'=>'Password has changed successfully!', 'alert_type'=>'success']);
                    }else{
                        session()->setFlashdata(['alert_message'=>'Something went wrong!', 'alert_type'=>'danger']);
                    }
                    return redirect()->to(base_url('/change-pass'));
                }
                
            }
        }
        
        echo view('include/header',$data);
        echo view('member/change_password', $data);
        echo view('include/footer', $data);
    }
    public function logout(){
        session()->destroy();
        return redirect()->to(base_url());
    }
/************************************Student Login-Dashboard**************************** */
    public function stu_login(){
        $data = array();
        if($this->request->getMethod() === 'post'){
            $validation = $this->validate([
                'email'=>[
                    'rules'=>'required|valid_email',
                    'errors'=>['required'=>'Email is required',
                                'valid_email'=>'Please enter valid email.']
                ],
                'password'=>[
                    'rules'=>'required|min_length[6]|max_length[16]',
                    'errors'=>['required'=>'Password is required',
                                'min_length'=>'Password must have atleast 6 character in length',
                                'max_length'=>'Password must not have characters more than 16 in length']
                ],
            ]);
            if(!$validation){
                $data['validation'] = $this->validator; 
            }else{
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $apiURL = API_BASE_URL.'api/login/password';
                $method = 'POST';
                $jsonData = json_encode(['email'=>$email,'password'=>$password]);
                $header = array(
                    'Content-Type: application/json'
                );
                $response = $this->executor($apiURL,$method,$jsonData,$header);
                $response = json_decode($response);
                $result = json_decode($response->result);
                if($response->http_code == 501 || $response->http_code == 401){
                    session()->setFlashdata('alert_error', $result->msg);
                    return redirect()->to(base_url('/student-login'))->withInput();
                }elseif($response->http_code == 200){
                    $token = $result->token;
                    $body = explode('.',$token)[1];
                    $body = json_decode(base64_decode($body));
                    session()->set(array(
                        'id' => $body->payload->user->_id,
                        'phone' => $body->payload->user->mobile_number,
                        'course_id' => $body->payload->user->course_id,
                        'batch_time' => $body->payload->user->batch_time,
                        'token' => $token,
                        'StudentIsLoggedIn' => true,
                    ));
                    $stuDtls = $this->student_details();
                    if(isset($stuDtls->name)){
                        session()->set(array(
                            'stu_name' => $stuDtls->name
                        ));
                    }
                    return redirect()->to(base_url('/student-dashboard'));
                }else{
                    session()->setFlashdata('alert_error','Something went wrong!');
                    return redirect()->to(base_url('/student-login'))->withInput();
                }
                
                exit;
            }
        }
        echo view('include/header',$data);
        echo view('member/stu_login', $data);
        echo view('include/footer', $data);
    }
    
    
    public function stu_dashboard(){
        $data = array();
        // echo session('token'); exit;
        $data['stuDtls'] = $this->student_details();
        //banner api
        $data['banner'] = $this->get_banner();
        //news api
        $data['news'] = $this->get_news();
        //live classes
        $data['live_class'] = $this->get_live_classes();
        // latest videoes
        $data['videoes'] = $this->get_latest_videos();
        //subjects
        $data['subjects'] = $this->get_subjects();
        // echo '<pre>';print_r($data['banner']); exit;
        
        /* //get student subject
        $apiURL = 'http://43.225.53.245:5000/api/student_subject';
        $method = 'GET';
        $header = array(
            'Content-Type: application/json',
            'Bearer: '.session('token')
        );
        $response = $this->executor($apiURL,$method,'',$header);
        $response = json_decode($response);
        $result = json_decode($response->result);
        if($response->http_code == 501 || $response->http_code == 401){
            session()->setFlashdata('alert_error', $result->msg);
            // return redirect()->to(base_url('/student-login'))->withInput();
        }elseif($response->http_code == 200){
            session()->set('course_id', $result->data[0]->course_id);
            // echo '<pre>'; print_r($data['d']); exit;
        } */ 
        
        echo view('include/header',$data);
        echo view('member/student/stu_dashboard', $data);
        echo view('include/footer', $data);
    }
    public function my_courses($module_id = null){
        $data = array();
        $subjects = $this->get_subjects();
        $data['subjects'] = $subjects;
        // echo '<pre>'; print_r($subjects); exit;
        if($module_id == null){
            $module_id = (isset($subjects[0]->_id))?$subjects[0]->_id:null;
        }
        if($module_id != null){
            $data['ch_topic'] = $this->chapter_topic($module_id);
            // echo $module_id.'<br>'.'<pre>'; print_r($data['ch_topic']); exit;
        }
        $data['module_id'] = $module_id;
        echo view('include/header',$data);
        echo view('member/student/my_courses', $data);
        echo view('include/footer', $data);
    }
    public function account_profile(){
        $data = array();
        $profile = $this->stu_profile();
        // echo '<pre>'; print_r($data['profile']); exit;
        if($this->request->getMethod() === 'post'){
            if($_FILES['student_photo']['name'] != ''){
                $stu = $profile->stu; 
                $cfile = new \CurlFile($_FILES['student_photo']['tmp_name'], $_FILES['student_photo']['type'], $_FILES['student_photo']['name']); 
                $form_data = array(
                    'student_photo' => $cfile,
                    '_id' => session('id'),
                    'name' => $stu->name,
                    'email' => $stu->email,
                    'father_name' => $stu->father_name,
                    'roll_no' => 0,
                    'date_of_admission' => date('Y-m-d',strtotime($stu->added_at))
                );
                $apiURL = API_BASE_URL.'api/student_update';
                $method = 'POST';
                $header = $this->_header(1);
                $response = $this->executor($apiURL,$method,$form_data,$header);
                $result = $this->get_result($response, 1);
                if(isset($result->success) && $result->success){
                    session()->setFlashdata('alert_success','Photo uploaded successfully.');
                }else{
                    session()->setFlashdata('alert_error','Something went wrong!');
                }
                // print_r($result); exit;
                return redirect()->to('/account-profile');
            }
        }
        $data['profile'] = $profile;
        echo view('include/header',$data);
        echo view('member/student/account_profile', $data);
        echo view('include/footer', $data);
    }
    public function account_payment(){
        $data = array();
        $data['payment'] = $this->stu_payment();
        $data['fee_data'] = $this->fee_list();
        // echo '<pre>'; print_r($data['payment']); exit;
        echo view('include/header',$data);
        echo view('member/student/account_payment', $data);
        echo view('include/footer', $data);
    }
    public function account_quiz(){
        $data = array();
        $quiz_score = $this->quiz_score();
        $totQuiz = 0;
        $custom_Quiz_score = [];
        if(!empty($quiz_score)){
            $totQuiz = count($quiz_score);
            $rec_limit = 10;
            $page_config = array(
                'tot_record' => $totQuiz,
                'rec_limit' => $rec_limit,
                'btn_limit' => 5,
                'current_page' => (isset($_GET['page']) && $_GET['page'] != '')?$_GET['page']:0,
                'url' => current_url(),
                'url_param' => 'page',
                'colspan' => 0,
            );
            $cp_data = custom_pagination($page_config);
            $limit = $cp_data['limit'];
            $offset = $cp_data['offset'];
            $data['pagination'] = $cp_data['pagination_html'];
            for($i=$offset; $i<($offset+$limit) && $i<$totQuiz ; $i++){
                $custom_Quiz_score[] = $quiz_score[$i];
            }

        }
        $data['totQuiz'] = $totQuiz;
        $data['quiz_score'] = $custom_Quiz_score;
        // echo count($data['quiz_score']).'<br>';
        // echo '<pre>'; print_r($data['quiz_score']); exit;
        echo view('include/header',$data);
        echo view('member/student/account_quiz', $data);
        echo view('include/footer', $data);
    }
    public function notification(){
        $data = array();
        $notify = $this->get_notification();
        $n = 0;
        $custom_notify_list = [];
        if(!empty($notify)){
            $notify_list = $notify->Notify;
            $a = array_column($notify_list, 'added_at');
            foreach($a as $d){
              if(date('Y-m-d') == date('Y-m-d',strtotime($d))){
                $n++;
              }
            }
            $rec_limit = 10;
            $totNoti = $notify->count;
            $page_config = array(
                'tot_record' => $totNoti,
                'rec_limit' => $rec_limit,
                'btn_limit' => 5,
                'current_page' => (isset($_GET['page']) && $_GET['page'] != '')?$_GET['page']:0,
                'url' => current_url(),
                'url_param' => 'page',
                'colspan' => 0,
            );
            $cp_data = custom_pagination($page_config);
            // print_r($cp_data); exit;
            $limit = $cp_data['limit'];
            $offset = $cp_data['offset'];
            $data['pagination'] = $cp_data['pagination_html'];
            // $data['blogs'] = $this->landing->get_blogs('', $limit, $offset);
            for($i=$offset; $i<($offset+$limit) && $i<$totNoti ; $i++){
                $custom_notify_list[] = $notify_list[$i];
            }
            
            // print_r($a); exit;
        }
        $data['notify_list'] = $custom_notify_list;
        $data['totNew'] = $n;
        // echo '<pre>'; print_r($data['notify_list']); exit;
        // echo '<pre>'; print_r($notify_list); exit;
        echo view('include/header',$data);
        echo view('member/student/notification', $data);
        echo view('include/footer', $data);
    }
    public function live_chat(){
        
        $data = array();
        // 672b08ce6338ab0d4ddd0043;
        // $data['notify'] = $this->get_notification();
        // echo '<pre>'; print_r($data['notify']);
        // echo session('id');
        // exit;
        
        echo view('include/header',$data);
        echo view('member/student/live_chat', $data);
        echo view('include/footer', $data);
    }
    public function save_chat(){
        if($this->request->getMethod() === 'post'){
            // print_r($_POST); exit;
            $message = $_POST['message'];
            $apiURL = API_BASE_URL.'api/chat/student';
            $method = 'POST';
            $jsonData = json_encode(['student_id'=>session('id'),'reply_to'=>'','message'=>$message]);
            $header = $this->_header();
            $response = $this->executor($apiURL,$method,$jsonData,$header);
            $result = $this->get_result($response, 1);
            echo 'success'; exit;
            
        }else{
            return redirect()->to('/live-chat');
        }
    }
    public function get_live_chat(){
        $html = 'No any message here!';
        $data = $this->get_chat_list();
        if(!empty($data)){
            $html = '';
            foreach($data as $list){
                if($list->isAdmin == true){
                    $html .= '<div class="col-md-8">'.
                                '<div class="alert alert-dark">'.
                                $list->message.
                                '</div>'.
                            '</div>';
                }elseif($list->isAdmin == false){
                    $html .= '<div class="offset-md-4 col-md-8">'.
                                '<div class="alert alert-primary text-sm-end">'.
                                $list->message.
                                '</div>'.
                            '</div>';
                }
            }
        }
        echo $html; exit;
    }
    public function live_classes(){
        $data['profile'] = $this->stu_profile()->stu;
        $data['live_class'] = $this->get_live_classes();
        // echo '<pre>'; print_r($data['live_class']); print_r($data['profile']); exit;
        echo view('include/header',$data);
        echo view('member/student/live_classes', $data);
        echo view('include/footer', $data);
    }
    public function sample_paper(){
        $data = array();
        $data['sample_paper'] = $this->get_sample_paper();
        // echo '<pre>'; print_r($data['sample_paper']); exit;
        echo view('include/header',$data);
        echo view('member/student/sample_paper', $data);
        echo view('include/footer', $data);
    }
    public function contact_us_api(){
        $data = array();
        $data['contactus'] = [];
        $contact_data = $this->get_contact_data();
        if(isset($contact_data->result) && !empty($contact_data->result)){
            $data['contactus'] = $contact_data->result;
        }
        // echo '<pre>'; print_r($data['contactus']); exit;
        echo view('include/header',$data);
        echo view('member/student/contact_us', $data);
        echo view('include/footer', $data);
    }
    public function quiz(){
        $data = array();
        $data['quiz'] = $this->get_quiz();
        //  echo '<pre>'; print_r($data['quiz']); exit;
        echo view('include/header',$data);
        echo view('member/student/quiz', $data);
        echo view('include/footer', $data);
    }
    public function quiz_list($param){
        $data = array();
        session()->set('ql_param', $param);
        return $this->get_quiz_list($param);
        // $data['quiz_list'] = $this->get_quiz_list($param);
        //  echo '<pre>'; print_r($data['quiz_list']); exit;
        // echo view('include/header',$data);
        // echo view('member/student/quiz_list', $data);
        // echo view('include/footer', $data);
    }
    public function quiz_start($param){
        // echo session('id').'<br>';
        // echo session('course_id').'<br>';
        // echo session('module_id'); exit;
        $data = array();
        $param = json_decode(base64url_decode($param));
        $id = $param->id;
        $data['time'] = $param->time;
        // $data['time'] = 2;
        $data['tot_sec'] = $param->time*60;
        $quiz_ques = $this->get_quiz_question($id);
        $data['quiz_ques'] = [];
        if(isset($quiz_ques->result->result)){
            $ques_list = $quiz_ques->result->result;
            $data['quiz_ques'] = $ques_list;
        }
        //  echo '<pre>'; print_r($data['quiz_ques']); exit;
        if($this->request->getMethod() === 'post'){
            $correct = $wrong = $skip = $total_ques = $percentage = 0; $grade = ''; $store = [];
            $set_id = $_POST['set_id'];
            $q_ids = $_POST['q_ids'];
            $correct_ans = $_POST['correct_ans'];
            if(isset($_POST['given_ans'])){
                $given_ans = $_POST['given_ans'];
            }
            foreach($q_ids as $k=>$q_id){
                if(isset($given_ans[$k])){
                    if($given_ans[$k] == $correct_ans[$k]){
                        $correct++;
                    }else{
                        $wrong++;
                    }
                }else{
                    $skip++;
                }
                $total_ques++;
                $store[$k]['question'] = $ques_list[$k]->question;
                $store[$k]['correct_opt'] = $ques_list[$k]->options[$correct_ans[$k]-1]->option;
                if(isset($given_ans[$k])){
                    $store[$k]['givent_opt'] = $ques_list[$k]->options[$given_ans[$k]-1]->option;
                    $store[$k]['remark'] = ($given_ans[$k] == $correct_ans[$k])?1:0;
                }else{
                    $store[$k]['givent_opt'] = '';
                    $store[$k]['remark'] = 0;
                }
                

            }
            session()->set('store', $store);
            $percentage = ($correct*100)/$total_ques;
            if($percentage < 35){
                $grade = 'Fails';
            } else if($percentage >= 35 && $percentage < 50){
                $grade = 'Good';
            }else if($percentage >= 50 && $percentage < 70){
                $grade = 'Better';
            }else if($percentage >= 70 && $percentage < 90){
                $grade = 'Best';
            }else if($percentage >= 90 && $percentage <= 100){
                $grade = 'Excellent';
            }
            $apiURL = API_BASE_URL.'api/quizresult/add';
            $method = 'POST';
            $jsonData = json_encode([
                'student_id'=>session('id'),
                'qset'=>$set_id,
                'course_id'=>session('course_id'),
                'module_id'=>session('module_id'),
                'total_question'=>$total_ques,
                'wrong'=>$wrong,
                'correct'=>$correct,
                'skip'=>$skip,
                'percentage'=>$percentage,
                'grade'=>$grade,
                'duration'=>$param->time,
                'status'=>"active",
            ]);
            
            $header = $this->_header();
            $response = $this->executor($apiURL,$method,$jsonData,$header);
            $result = $this->get_result($response, 1);
            if(isset($result->success) && $result->success == 1){
                session()->set('msg', $result->msg);
                return redirect()->to('/quiz-finish');
            }else{
                session()->setFlashdata('alert_error','Something went wrong!');
                return redirect()->to('/quiz');
            }
            // echo '<pre>';print_r($result); exit;
            
        }
        echo view('include/header',$data);
        echo view('member/student/quiz_start', $data);
        echo view('include/footer', $data);
    }
    public function quiz_finish(){
        $data = [];
        $data['msg'] = session('msg');
        echo view('include/header',$data);
        echo view('member/student/quiz_finish', $data);
        echo view('include/footer', $data);
    }
    public function check_ans(){
        $data = [];
        $data['store'] = json_decode(json_encode(session('store')));
        echo view('include/header',$data);
        echo view('member/student/check_ans', $data);
        echo view('include/footer', $data);
    }
    public function stu_logout(){
        $array_items = ['token', 'StudentIsLoggedIn'];
        session()->remove($array_items);
        return redirect()->to(base_url());
    }
    /**************************************************************************************** */
    public function get_live_classes(){
        $apiURL = API_BASE_URL.'api/meeting/list';
        $method = 'GET';
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response);
        return $result;
    }
    public function get_quiz_question($id){
        $apiURL = API_BASE_URL.'api/quiz/question/list';
        $method = 'POST';
        $jsonData = json_encode(['_id'=>$id]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,$jsonData,$header);
        $result = $this->get_result($response,1);
        return $result;
    }
    public function get_quiz_list($param){
        $param = json_decode(base64url_decode($param));
        $course_id = $param->course_id;
        $module_id = $param->module_id;
        session()->set(array(
            'module_id' => $module_id,
        ));
        $apiURL = API_BASE_URL.'api/questionset/list';
        $method = 'POST';
        $jsonData = json_encode(['course_id'=>$course_id,'module_id'=>$module_id]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,$jsonData,$header);
        $result = $this->get_result($response);
        return $result;
    }
    public function get_quiz(){
        $apiURL = API_BASE_URL.'api/student_subject';
        $method = 'GET';
        // $jsonData = json_encode(['_id'=>session('id')]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response);
        return $result;
    }
    public function get_contact_data(){
        $apiURL = API_BASE_URL.'api/contact_us';
        $method = 'GET';
        // $jsonData = json_encode(['_id'=>session('id')]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response, 1);
        return $result;
    }
    public function get_sample_paper(){
        $apiURL = API_BASE_URL.'api/samplepaper';
        $method = 'GET';
        // $jsonData = json_encode(['_id'=>session('id')]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response);
        return $result;
    }
    public function get_chat_list(){
        $apiURL = API_BASE_URL.'api/chat/list/'.session('id');
        $method = 'GET';
        // $jsonData = json_encode(['_id'=>session('id')]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response);
        return $result;
    }
    public function get_notification(){
        $apiURL = API_BASE_URL.'api/notification';
        $method = 'GET';
        // $jsonData = json_encode(['_id'=>session('id')]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response, 1);
        return $result;
    }
    public function quiz_score(){
        $apiURL = API_BASE_URL.'api/quiz/score/'.session('id');
        $method = 'GET';
        // $jsonData = json_encode(['_id'=>session('id')]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response);
        return $result;
    }
    public function fee_list(){
        $apiURL = API_BASE_URL.'api/fees/list';
        $method = 'GET';
        // $jsonData = json_encode(['_id'=>session('id')]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response);
        return $result;
    }
    public function stu_payment(){
        $apiURL = API_BASE_URL.'api/payment/history/'.session('id');
        $method = 'GET';
        // $jsonData = json_encode(['_id'=>session('id')]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response);
        return $result;
    }
    public function stu_profile(){
        $apiURL = API_BASE_URL.'api/student_objectid';
        $method = 'POST';
        $jsonData = json_encode(['_id'=>session('id')]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,$jsonData,$header);
        $result = $this->get_result($response, 1);
        return $result;
    }
    public function chapter_topic($module_id){
        $apiURL = API_BASE_URL.'api/chapter/topic';
        $method = 'POST';
        $jsonData = json_encode(['module_id'=>$module_id]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,$jsonData,$header);
        $result = $this->get_result($response);
        return $result;
    }
    public function student_details(){
        $apiURL = API_BASE_URL.'api/student/details/';
        $method = 'GET';
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response);
        return $result;
    }
    public function get_subjects(){
        $apiURL = API_BASE_URL.'api/student/subjects/'.session('course_id');
        $method = 'GET';
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response);
        return $result;
    }
    public function get_latest_videos(){
        $apiURL = API_BASE_URL.'api/watchlatest/list';
        $method = 'POST';
        $jsonData = json_encode(['course_id'=>session('course_id')]);
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,$jsonData,$header);
        $result = $this->get_result($response, 1);
        return $result;
    }
    public function get_news(){
        $apiURL = API_BASE_URL.'api/news';
        $method = 'GET';
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response);
        return $result;
    }
    public function get_banner(){
        $data = array();
        //banner api
        $apiURL = API_BASE_URL.'api/banner';
        $method = 'GET';
        $header = $this->_header();
        $response = $this->executor($apiURL,$method,'',$header);
        $result = $this->get_result($response);
        return $result;
    }

    public function get_result($response, $output=null){
        $response = json_decode($response);
        $result = json_decode($response->result);
        if($response->http_code == 200){
            if($output == 1){
                return $result;
            }else{
                return $result->data;
            }
        }elseif($response->http_code == 501 || $response->http_code == 401){
            return 0;
        }
    }
    function _header($fd=false){
        if($fd){
            $header = array(
                'Content-Type: multipart/form-data',
                'Bearer: '.session('token')
            );
        }else{
            $header = array(
                'Content-Type: application/json',
                'Bearer: '.session('token')
            );
        }
        return $header;
    }
    /**************************************************************************************** */
    public function executor($apiUrl,$method,$jsonData=null,$header=null){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if($method == 'POST'){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        }
        if($header != null){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // echo $httpCode; exit;

        curl_close($ch);
        return json_encode(array(
            'result' => $response,
            'http_code' => $httpCode
        ));
    }
    /***************************************************************************************** */
    /*public function sendmail(){
        $email = \Config\Services::email();
        $message = 'Hi this is test mail';
        $email->setFrom('rajgudduara18@gmail.com', 'Test Mail');
        $email->setTo('test61@yopmail.com');
        $email->setSubject('Test Mail | MyGateway');
        $email->setMessage($message);//your message here
        
        //$email->setCC('another@emailHere');//CC
        //$email->setBCC('thirdEmail@emialHere');// and BCC
        //$filename = '/img/yourPhoto.jpg'; //you can use the App patch 
        //$email->attach($filename);
            
        if($email->send()){
            echo 'mail sent';
        }else{
            echo 'not send';
        }
    }*/
}
