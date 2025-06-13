<?php

namespace App\Controllers;

class Bootcamp extends BaseController
{
    public $commonmodel;
    public $homemodel;
    public $session;
    public function __construct()
    {
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->homemodel = model('App\Models\Home_model', false);
    }
    public function image_editing_bootcamp(){
        $data['title'] = 'Career-Boss | Image Editing Bootcamp';
        // if(session()->has('button_type')){
        //     $data['button_type'] = session('button_type');
        //     unset($_SESSION['button_type']);
        // }
        // if(session()->has('course_id')){
        //     $data['course_id'] = session('course_id');
        //     unset($_SESSION['course_id']);
        // }
        if($this->request->getMethod() == 'post'){
            // if(isset($_POST['get_type']) && $_POST['get_type'] == 'submit'){
            //     $button_type = $_POST['button_type'];
            //     session()->set('button_type', $button_type);
            //     if($_POST['course_id'] != ''){
            //         session()->set('course_id', $_POST['course_id']);
            //     }
            //     return redirect()->to(base_url('/enquiry'));
            // }
            if(isset($_POST['final_submit']) && $_POST['final_submit'] == 'submit'){
                //print_r($_POST); exit;
                $validation = $this->validate([
                    'name'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'Your Full name is required'
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
                        ]
                ]);
                if(!$validation){
                    $data['validation'] = $this->validator;
                    //return view('admin/users/add_user',$this->data);
                }else{
                    
                    $contact_us_data = array();
                    // if($_POST['course_id'] != ''){
                    //     $contact_us_data['course_id'] = $_POST['course_id'];
                    // }
                    $contact_us_data['bootcamp'] = 'IE';
                    $contact_us_data['name'] = $_POST['name'];
                    $contact_us_data['phone'] = $_POST['phone'];
                    $contact_us_data['address'] = $_POST['address'];
                    $contact_us_data['ipaddress'] 	= $this->request->getIPAddress();
				    $contact_us_data['submit_from'] = 'Image Editing Bootcamp';
				    $contact_us_data['added_at'] 	= date('y-m-d H:i:s');
                    $contact_us_data['status']     = 1;
                    $insertId = $this->commonmodel->insertRecord('tbl_contact_us', $contact_us_data);
                    if($insertId){
                        // $setting = $this->commonmodel->get_setting(1);
                        // $msg = '<p>Thank you for contacting us!. We will be in touch with you shortly.</p>
                        //         <p><strong>Regards</strong></p>
                        //         <p><strong>Career-Boss</strong></p>';
                        // $email = \Config\Services::email();

                        // $email->setFrom($setting->email, 'Career-Boss');
                        // $email->setTo($this->request->getPost('email'));
                        // $email->setSubject('Enquiry');
                        // $email->setMessage($msg);
                        // $email->send();

                        $swal_session = array(
                            'title'=>'Thank You!',
                            'text'=>'Thank you for contacting us!. We will be in touch with you shortly.',
                        );
                        session()->set('swal_session', $swal_session);
                    }else{
                        $swal_session = array(
                            'title'=>'Oops!',
                            'text'=>'Something went wrong, Please try again!',
                            'icon'=>'error',
                        );
                        session()->set('swal_session', $swal_session);
                    }
                    return redirect()->to(base_url('/image-editing-bootcamp'));
                    //print_r($_POST);
                    //exit;
                }
            }

        }
        // $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses',['status'=>1], ['course_id','desc']);
        echo view('include/header', $data);
        echo view('ie_bootcamp');
        echo view('include/footer', $data);
    }
    public function bca_tuition_for_all_semester(){
        $data['title'] = 'Career-Boss | BCA Tution for all semester';
        // if(session()->has('button_type')){
        //     $data['button_type'] = session('button_type');
        //     unset($_SESSION['button_type']);
        // }
        // if(session()->has('course_id')){
        //     $data['course_id'] = session('course_id');
        //     unset($_SESSION['course_id']);
        // }
        if($this->request->getMethod() == 'post'){
            // if(isset($_POST['get_type']) && $_POST['get_type'] == 'submit'){
            //     $button_type = $_POST['button_type'];
            //     session()->set('button_type', $button_type);
            //     if($_POST['course_id'] != ''){
            //         session()->set('course_id', $_POST['course_id']);
            //     }
            //     return redirect()->to(base_url('/enquiry'));
            // }
            if(isset($_POST['final_submit']) && $_POST['final_submit'] == 'submit'){
                //print_r($_POST); exit;
                $validation = $this->validate([
                    'name'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'Your Full name is required'
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
                        ]
                ]);
                if(!$validation){
                    $data['validation'] = $this->validator;
                    //return view('admin/users/add_user',$this->data);
                }else{
                    $token = $this->request->getPost('token');
                    $gurl = 'https://www.google.com/recaptcha/api/siteverify?secret='.SECRETKEY.'&response='.$token.'&remoteip='.$this->request->getIPAddress().'';
                    $res = file_get_contents($gurl);
                    $response = json_decode($res);

                    if($response->success){

                        $contact_us_data = array();
                        // if($_POST['course_id'] != ''){
                        //     $contact_us_data['course_id'] = $_POST['course_id'];
                        // }
                        //$contact_us_data['bootcamp'] = 'IE';
                        $contact_us_data['name'] = $_POST['name'];
                        $contact_us_data['phone'] = $_POST['phone'];
                        $contact_us_data['address'] = $_POST['address'];
                        $contact_us_data['ipaddress'] 	= $this->request->getIPAddress();
                        $contact_us_data['submit_from'] = 'BCA Tution';
                        $contact_us_data['added_at'] 	= date('y-m-d H:i:s');
                        $contact_us_data['status']     = 1;
                        $insertId = $this->commonmodel->insertRecord('tbl_contact_us', $contact_us_data);

                        //insert tbl_ins_enquiry also
                        $enq_data = array(
                            'c_name' => $_POST['name'],
                            'phone1' => $_POST['phone'],
                            'address' => $_POST['address'],
                            //'course_for' => 'BCA Tution',
                            'ref_by' => 'From Website for BCA Tution',
                            'status' => 1,
                            'added_at' => date('Y-m-d H:i:s'),
                        );
                        $this->commonmodel->insertRecord('tbl_ins_enquiry', $enq_data);
                        if($insertId){
                            // $setting = $this->commonmodel->get_setting(1);
                            // $msg = '<p>Thank you for contacting us!. We will be in touch with you shortly.</p>
                            //         <p><strong>Regards</strong></p>
                            //         <p><strong>Career-Boss</strong></p>';
                            // $email = \Config\Services::email();

                            // $email->setFrom($setting->email, 'Career-Boss');
                            // $email->setTo($this->request->getPost('email'));
                            // $email->setSubject('Enquiry');
                            // $email->setMessage($msg);
                            // $email->send();

                            $swal_session = array(
                                'title'=>'Thank You!',
                                'text'=>'Thank you for contacting us!. We will be in touch with you shortly.',
                            );
                            session()->set('swal_session', $swal_session);
                        }else{
                            $swal_session = array(
                                'title'=>'Oops!',
                                'text'=>'Something went wrong, Please try again!',
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
                    return redirect()->to(base_url('/bca-tuition-for-all-semester'));
                    //print_r($_POST);
                    //exit;
                }
            }

        }
        // $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses',['status'=>1], ['course_id','desc']);
        echo view('include/header', $data);
        echo view('bca_tution');
        echo view('include/footer', $data);
    }
    public function html_coding_bootcamp(){
        $data['title'] = 'Career-Boss | HTML Coding Bootcamp';
        // if(session()->has('button_type')){
        //     $data['button_type'] = session('button_type');
        //     unset($_SESSION['button_type']);
        // }
        // if(session()->has('course_id')){
        //     $data['course_id'] = session('course_id');
        //     unset($_SESSION['course_id']);
        // }
        if($this->request->getMethod() == 'post'){
            // if(isset($_POST['get_type']) && $_POST['get_type'] == 'submit'){
            //     $button_type = $_POST['button_type'];
            //     session()->set('button_type', $button_type);
            //     if($_POST['course_id'] != ''){
            //         session()->set('course_id', $_POST['course_id']);
            //     }
            //     return redirect()->to(base_url('/enquiry'));
            // }
            if(isset($_POST['final_submit']) && $_POST['final_submit'] == 'submit'){
                //print_r($_POST); exit;
                $validation = $this->validate([
                    'name'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'Your Full name is required'
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
                        ]
                ]);
                if(!$validation){
                    $data['validation'] = $this->validator;
                    //return view('admin/users/add_user',$this->data);
                }else{
                    
                    $contact_us_data = array();
                    // if($_POST['course_id'] != ''){
                    //     $contact_us_data['course_id'] = $_POST['course_id'];
                    // }
                    $contact_us_data['bootcamp'] = 'HC';
                    $contact_us_data['name'] = $_POST['name'];
                    $contact_us_data['phone'] = $_POST['phone'];
                    $contact_us_data['address'] = $_POST['address'];
                    $contact_us_data['ipaddress'] 	= $this->request->getIPAddress();
				    $contact_us_data['submit_from'] = 'HTML Coding Bootcamp';
				    $contact_us_data['added_at'] 	= date('y-m-d H:i:s');
                    $contact_us_data['status']     = 1;
                    $insertId = $this->commonmodel->insertRecord('tbl_contact_us', $contact_us_data);
                    if($insertId){
                        // $setting = $this->commonmodel->get_setting(1);
                        // $msg = '<p>Thank you for contacting us!. We will be in touch with you shortly.</p>
                        //         <p><strong>Regards</strong></p>
                        //         <p><strong>Career-Boss</strong></p>';
                        // $email = \Config\Services::email();

                        // $email->setFrom($setting->email, 'Career-Boss');
                        // $email->setTo($this->request->getPost('email'));
                        // $email->setSubject('Enquiry');
                        // $email->setMessage($msg);
                        // $email->send();

                        $swal_session = array(
                            'title'=>'Thank You!',
                            'text'=>'Thank you for contacting us!. We will be in touch with you shortly.',
                        );
                        session()->set('swal_session', $swal_session);
                    }else{
                        $swal_session = array(
                            'title'=>'Oops!',
                            'text'=>'Something went wrong, Please try again!',
                            'icon'=>'error',
                        );
                        session()->set('swal_session', $swal_session);
                    }
                    return redirect()->to(base_url('/html-coding-bootcamp'));
                    //print_r($_POST);
                    //exit;
                }
            }

        }
        // $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses',['status'=>1], ['course_id','desc']);
        echo view('include/header', $data);
        echo view('hc_bootcamp');
        echo view('include/footer', $data);
    }
}