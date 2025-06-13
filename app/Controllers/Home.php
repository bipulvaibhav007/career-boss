<?php

namespace App\Controllers;

class Home extends BaseController
{
    public $commonmodel;
    public $homemodel;
    public $session;
    public function __construct()
    {
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->homemodel = model('App\Models\Home_model', false);
    }
    public function index()
    {
        $data['title'] = 'Career-Boss | Home';
        $data['courses'] = $this->homemodel->get_popular_active_courses();
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner', ['page' => 1, 'status' => 1]);
        $data['testimonial'] = $this->homemodel->get_testimonial_for_home($limit = 4);
        $data['faqs'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_faqs', ['faq_for'=>1,'faq_status'=>'1'], ['faq_id ','desc']);
        //print_r($data['courses']); exit;
        echo view('include/header', $data);
        echo view('home', $data);
        echo view('include/footer', $data);
    }

    public function course_detail($url = null)
    {
        $cDtls = $this->homemodel->get_one_course($url);
        if ($url != null && !empty($cDtls)) {
            if ($this->request->getMethod() == 'post') {

                if ($this->request->getVar('button_type') == 'Enroll | Course Detail Page') {
                    $validation = $this->validate([
                        'name' => [
                            'rules' => 'required',
                            'errors' => ['required' => 'Your Name is required'],
                        ],
                        'email' => [
                            'rules' => 'required|valid_email',
                            'errors' => ['required' => 'Email is required', 'valid_email' => 'Enter Valid Email'],
                        ],
                        'phone' => [
                            'rules' => 'required|is_natural|min_length[10]|max_length[10]',
                            'errors' => ['required' => 'Phone Number is required', 'is_natural' => 'Enter Valid Phone Number', 'min_length' => 'Phone Number must be 10 digit in length', 'max_length' => 'Phone Number must not have more than 10 digit in length'],
                        ],

                    ]);
                    if (!$validation) {
                        $data['validation'] = $this->validator;
                    } else {
                        $token = $this->request->getPost('token');
                        $gurl = 'https://www.google.com/recaptcha/api/siteverify?secret='.SECRETKEY.'&response='.$token.'&remoteip='.$this->request->getIPAddress().'';
                        $res = file_get_contents($gurl);
                        $response = json_decode($res);

                        if($response->success){
                            $post = array();
                            $post['course_id'] = $this->request->getPost('course_id');
                            $post['name'] = $this->request->getPost('name');
                            $post['email'] = $this->request->getPost('email');
                            $post['phone'] = $this->request->getPost('phone');
                            $post['message'] = $this->request->getPost('message');
                            $post['ipaddress'] = $this->request->getIPAddress();
                            $post['submit_from'] = 'Enroll | Course Detail Page';
                            $post['status'] = 1;
                            $post['added_at'] = date('y-m-d H:i:s');
                            $insertId = $this->commonmodel->insertRecord('tbl_contact_us', $post);
                            if ($insertId) {
                                $courseName = '';
                                $courseDtls = $this->commonmodel->getOneRecord('tbl_courses', ['course_id' => $_POST['course_id']]);
                                $courseName = $courseDtls->course_full_name ?? '';

                                $setting = $this->commonmodel->get_setting(1);
                                $msg = '<h1>Contact Us</h1>
                                <p>Dear Admin, <br>Here is the new contact details are given below.</p>
                                <p><strong>Full Name: </strong>'.$this->request->getPost('name').'</br>
                                <strong>Email: </strong>'.$this->request->getPost('email').'</br>
                                <strong>Phone: </strong>'.$this->request->getPost('phone').'</br>
                                <strong>Submit From: </strong>'.$post['submit_from'].'</br>
                                <strong>Message: </strong>'.$this->request->getPost('message');
                                if($courseName != ''){
                                    $msg .= '<strong>Course Name: </strong>'.$courseName;
                                }
                                $msg .= '</p><p>Thanks & Regards<br>Career Boss</p>';
                                // $mailData['name'] = $_POST['name'];
                                // $mailData['message'] = $msg;
                                // $msg = view('emailer/thanks', $mailData);
                                
                                $email = \Config\Services::email();
                                $email->setFrom($setting->email, 'Career Boss');
                                $email->setTo($setting->email);
                                $email->setSubject('Contact us');
                                $email->setMessage($msg);
                                $email->send();
                                
                                //2nd mail
                                $email->clear();
                                $msg = '<p>Thank you for contacting us!. We will be in touch with you shortly.</p>
                                <p><strong>Thanks & Regards</strong></p>
                                <p><strong>Career-Boss</strong></p>';
        
                                $email->setFrom($setting->email, 'Career-Boss');
                                $email->setTo($this->request->getPost('email'));
                                //$email->setTo('test136@yopmail.com');
        
                                $email->setSubject('Enroll Course');
                                $email->setMessage($msg);
        
                                $email->send();
                                $swal_session = array(
                                    'title' => 'Thank You!',
                                    'text' => 'Thank you for contacting us!. We will be in touch with you shortly.',
                                );
                                session()->set('swal_session', $swal_session);
        
                            } else {
                                $swal_session = array(
                                    'title' => 'Oops!',
                                    'text' => 'Something went wrong!.',
                                    'icon' => 'error',
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
                        return redirect()->to(base_url('/thank-you'));
                    }
                }
                
                //print_r($_POST); exit;

            }
            $data['title'] = 'Career-Boss | Course-Details';
            $data['cDtls'] = $cDtls;
            $data['youtube_vlink'] = '';
            if ($cDtls->youtube_vlink != '') {
                $parts = parse_url($cDtls->youtube_vlink);
                if (isset($parts['host']) && $parts['host'] == 'www.youtube.com') {
                    $data['youtube_vlink'] = $cDtls->youtube_vlink;
                }
            }
            echo view('include/header', $data);
            echo view('course-detail', $data);
            echo view('include/footer', $data);
        } else {
            return redirect()->to(base_url('page-not-found'));
        }
    }
    public function about_us()
    {
        $data['title'] = 'Career-Boss | About-us';
        $data['experts'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_experts', ['status' => 1], ['exp_id', 'desc']);
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner', ['page' => 4, 'status' => 1]);
        echo view('include/header', $data);
        echo view('about-us', $data);
        echo view('include/footer', $data);
    }
    public function career()
    {
        $data['title'] = 'Career-Boss | career';
        echo view('include/header', $data);
        echo view('career', $data);
        echo view('include/footer', $data);
    }
    public function contact()
    {
        $data['title'] = 'Career-Boss | Contact-us';
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses', ['status' => 1], ['course_id', 'desc']);
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner', ['page' => 3, 'status' => 1]);
        echo view('include/header', $data);
        echo view('contact-us', $data);
        echo view('include/footer', $data);
    }
    public function placement()
    {
        $data['title'] = 'Career-Boss | Placement';
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner', ['page' => 7, 'status' => 1]);
        $data['faqs'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_faqs', ['faq_for'=>7, 'faq_status' => '1'], ['faq_id', 'desc']);
        $data['testimonial'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_testimonial', ['type' => 'suc', 'status' => '1'], ['id', 'desc']);
        echo view('include/header', $data);
        echo view('placement', $data);
        echo view('include/footer', $data);
    }
    public function blogs()
    {
        $data['title'] = 'Career-Boss | Blog';
        $data['recent_blog'] = $this->homemodel->get_recent_blog();
        $data['blogs'] = $this->homemodel->get_all_blogs(); // except recent blogs

        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner', ['page' => 5, 'status' => 1]);
        echo view('include/header', $data);
        echo view('blog', $data);
        echo view('include/footer', $data);
    }
    public function blog_detail($url)
    {
        $data['title'] = 'Career-Boss | ' . str_replace('-', ' ', $url);
        $data['blog'] = $this->commonmodel->getOneRecord('tbl_blog', ['blog_url' => $url]);
        if (empty($data['blog'])) {
            return redirect()->to(base_url('/404'));
        }
        $data['blog2'] = $this->homemodel->get_blog_for_blog_detail($url);
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner', ['page' => 6, 'status' => 1]);
        echo view('include/header', $data);
        echo view('blog-detail', $data);
        echo view('include/footer', $data);
    }
    public function listen_stories()
    {
        $data['title'] = 'Career-Boss | Listen Stories';
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner', ['page' => 8, 'status' => 1]);
        $data['testimonial'] = $this->homemodel->get_testimonial_for_home();
        echo view('include/header', $data);
        echo view('listen-stories', $data);
        echo view('include/footer', $data);
    }
    public function cms()
    {
        $page_title = service('uri')->getSegment(1);
        $page = ($page_title == 'privacy-policy') ? 'pp' : 'tc';
        $data['title'] = 'Career-Boss | ' . $page_title;
        $data['cms'] = $this->homemodel->get_cms($page);
        //$data['testimonial'] = $this->homemodel->get_testimonial_for_home();
        echo view('include/header', $data);
        echo view('cms', $data);
        echo view('include/footer', $data);
    }

    public function save_contact_us()
    {
        if ($this->request->getMethod() == 'post') {

            $result = array();
            $validation = $this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Your Name is required'],
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => ['required' => 'Email is required', 'valid_email' => 'Enter Valid Email'],
                ],
                'phone' => [
                    'rules' => 'required|is_natural|min_length[10]|max_length[10]',
                    'errors' => ['required' => 'Phone Number is required', 'is_natural' => 'Enter Valid Phone Number', 'min_length' => 'Phone Number must be 10 digit in length', 'max_length' => 'Phone Number must not have more than 10 digit in length'],
                ],
                'course_id' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Course is required'],
                ],
                
            ]);
            
            if (!$validation) {
                $validator = $this->validator;
                $errors = array(
                    'name' => $validator->getError('name'),
                    'email' => $validator->getError('email'),
                    'phone' => $validator->getError('phone'),
                    'course_id' => $validator->getError('course_id'),
                    // 'captcha' => $validator->getError('g-recaptcha-response'),
                );
                $result['error'] = $errors;
            } else {
                $token = $this->request->getPost('token');
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.SECRETKEY.'&response='.$token.'&remoteip='.$this->request->getIPAddress().'';
                $res = file_get_contents($url);
                $response = json_decode($res);
    
                if($response->success){
                
                    $data = array();
                    $courseName = '';
                    if (isset($_POST['course_id'])) {
                        $data['course_id'] = $this->request->getPost('course_id');
                        $courseDtls = $this->commonmodel->getOneRecord('tbl_courses', ['course_id' => $_POST['course_id']]);
                        $courseName = $courseDtls->course_full_name ?? '';
                    }
                    $data['name'] = $this->request->getPost('name');
                    $data['email'] = $this->request->getPost('email');
                    $data['phone'] = $this->request->getPost('phone');
                    $data['message'] = $this->request->getPost('message');
                    $data['ipaddress'] = $this->request->getIPAddress();
                    $data['submit_from'] = (isset($_POST['button_type']) && $_POST['button_type'] != '') ? $_POST['button_type'] : 'Contact-us Page';
                    $data['status'] = 1;
                    $data['added_at'] = date('y-m-d H:i:s');
                    $insertId = $this->commonmodel->insertRecord('tbl_contact_us', $data);
                    if ($insertId) {
                        $setting = $this->commonmodel->get_setting(1);
                        $msg = '<h1>Contact Us</h1>
                        <p>Dear Admin, <br>Here is the new contact details are given below.</p>
                        <p><strong>Full Name: </strong>'.$this->request->getPost('name').'</br>
                        <strong>Email: </strong>'.$this->request->getPost('email').'</br>
                        <strong>Phone: </strong>'.$this->request->getPost('phone').'</br>
                        <strong>Submit From: </strong>'.$data['submit_from'].'</br>
                        <strong>Message: </strong>'.$this->request->getPost('message');
                        if($courseName != ''){
                            $msg .= '<strong>Course Name: </strong>'.$courseName;
                        }
                        $msg .= '</p><p>Thanks & Regards<br>Career Boss</p>';
                        // $mailData['name'] = $_POST['name'];
                        // $mailData['message'] = $msg;
                        // $msg = view('emailer/thanks', $mailData);
                        
                        $email = \Config\Services::email();
                        $email->setFrom($setting->email, 'Career Boss');
                        $email->setTo($setting->email);
                        $email->setSubject('Contact us');
                        $email->setMessage($msg);
                        $email->send();

                        //2nd mail
                        $email->clear();
                        
                        $msg = '<p>Thank you for contacting us!. We will be in touch with you shortly.</p>
                            <p><strong>Thanks & Regards</strong></p>
                            <p><strong>Career Boss</strong></p>';

                        $email->setFrom($setting->email, 'Career Boss');
                        $email->setTo($this->request->getPost('email'));
                        //$email->setTo('test136@yopmail.com');

                        $email->setSubject('Contact us');
                        $email->setMessage($msg);

                        $email->send();
                        /*$swal_session = array(
                            'title' => 'Thank You!',
                            'text' => 'Thank you for contacting us!. We will be in touch with you shortly.',
                        );
                        session()->set('swal_session', $swal_session);*/
                        $result['msg'] = 'success';
                    } else {
                        $result['err'] = 'fail';
                    }
                } else {
                    $swal_session = array(
                        'title' => 'Failed!',
                        'text' => 'Verification Failed by Google.',
                    );
                    session()->set('swal_session', $swal_session);
                    $result['err'] = 'gfail';
                }
            }
            
            echo json_encode($result);exit;
        }
    }
    public function enquiry()
    {
        $data['title'] = 'Career-Boss | Enquiry';
        if (session()->has('button_type')) {
            $data['button_type'] = session('button_type');
            unset($_SESSION['button_type']);
        }
        if (session()->has('course_id')) {
            $data['course_id'] = session('course_id');
            unset($_SESSION['course_id']);
        }
        if ($this->request->getMethod() == 'post') {
            if (isset($_POST['get_type']) && $_POST['get_type'] == 'submit') {
                $button_type = $_POST['button_type'];
                session()->set('button_type', $button_type);
                if ($_POST['course_id'] != '') {
                    session()->set('course_id', $_POST['course_id']);
                }
                return redirect()->to(base_url('/enquiry'));
            }
            if (isset($_POST['final_submit']) && $_POST['final_submit'] == 'submit') {
                //print_r($_POST); exit;
                $validation = $this->validate([
                    'name' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Your Full name is required',
                        ],
                    ],
                    'email' => [
                        'rules' => 'required|valid_email',
                        'errors' => [
                            'required' => 'Email is required',
                            'valid_email' => 'You must enter a valid email',
                        ],
                    ],
                    'phone' => [
                        'rules' => 'required|numeric|min_length[10]|max_length[10]',
                        'errors' => [
                            'required' => 'Phone is required',
                            'numeric' => 'You must enter numeric value',
                            'min_length' => 'Phone Number must be 10 digit in length',
                            'max_length' => 'Phone Number must not have more than 10 digit in length',
                        ],
                    ],
                ]);
                if (!$validation) {
                    $data['validation'] = $this->validator;
                    //return view('admin/users/add_user',$this->data);
                } else {
                    $token = $this->request->getPost('token');
                    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.SECRETKEY.'&response='.$token.'&remoteip='.$this->request->getIPAddress().'';
                    $res = file_get_contents($url);
                    $response = json_decode($res);
        
                    if($response->success){
                        $contact_us_data = array();
                        $courseName = '';
                        if ($_POST['course_id'] != '') {
                            $contact_us_data['course_id'] = $_POST['course_id'];
                            $courseDtls = $this->commonmodel->getOneRecord('tbl_courses', ['course_id' => $_POST['course_id']]);
                            $courseName = $courseDtls->course_full_name ?? '';
                        }
                        $contact_us_data['name'] = $_POST['name'];
                        $contact_us_data['email'] = $_POST['email'];
                        $contact_us_data['phone'] = $_POST['phone'];
                        $contact_us_data['message'] = $_POST['message'];
                        $contact_us_data['ipaddress'] = $this->request->getIPAddress();
                        $contact_us_data['submit_from'] = $_POST['button_type'];
                        $contact_us_data['added_at'] = date('y-m-d H:i:s');
                        $contact_us_data['status'] = 1;
                        $insertId = $this->commonmodel->insertRecord('tbl_contact_us', $contact_us_data);
                        if ($insertId) {
                            $setting = $this->commonmodel->get_setting(1);
                            $msg = '<h1>Contact Us</h1>
                            <p>Dear Admin, <br>Here is the new contact details are given below.</p>
                            <p><strong>Full Name: </strong>'.$this->request->getPost('name').'</br>
                            <strong>Email: </strong>'.$this->request->getPost('email').'</br>
                            <strong>Phone: </strong>'.$this->request->getPost('phone').'</br>
                            <strong>Submit From: </strong>'.$contact_us_data['submit_from'].'</br>
                            <strong>Message: </strong>'.$this->request->getPost('message');
                            if($courseName != ''){
                                $msg .= '<strong>Course Name: </strong>'.$courseName;
                            }
                            $msg .= '</p><p>Thanks & Regards<br>Career Boss</p>';
                            // $mailData['name'] = $_POST['name'];
                            // $mailData['message'] = $msg;
                            // $msg = view('emailer/thanks', $mailData);
                            
                            $email = \Config\Services::email();
                            $email->setFrom($setting->email, 'Career Boss');
                            $email->setTo($setting->email);
                            $email->setSubject('Contact us');
                            $email->setMessage($msg);
                            $email->send();

                            //2nd mail
                            $email->clear();
                            $msg = '<p>Thank you for contacting us!. We will be in touch with you shortly.</p>
                                    <p><strong>Regards</strong></p>
                                    <p><strong>Career Boss</strong></p>';

                            $email->setFrom($setting->email, 'Career Boss');
                            $email->setTo($this->request->getPost('email'));
                            $email->setSubject('Enquiry');
                            $email->setMessage($msg);
                            $email->send();

                            $swal_session = array(
                                'title' => 'Thank You!',
                                'text' => 'Thank you for contacting us!. We will be in touch with you shortly.',
                            );
                            session()->set('swal_session', $swal_session);
                        } else {
                            $swal_session = array(
                                'title' => 'Oops!',
                                'text' => 'Something went wrong, Please try again!',
                                'icon' => 'error',
                            );
                            session()->set('swal_session', $swal_session);
                        }
                    } else {
                        $swal_session = array(
                            'title' => 'Oops!',
                            'text' => 'Something went wrong, Please try again!',
                            'icon' => 'error',
                        );
                        session()->set('swal_session', $swal_session);
                    }
                    return redirect()->to(base_url('/thank-you'));
                    //print_r($_POST);
                    //exit;
                }
            }

        }
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses', ['status' => 1], ['course_id', 'desc']);
        echo view('include/header', $data);
        echo view('enquiry', $data);
        echo view('include/footer', $data);
    }
    public function pratibhakhoj()
    {
        $data['title'] = 'Career-Boss | Pratibhakhoj';
        if (session()->has('button_type')) {
            $data['button_type'] = session('button_type');
            unset($_SESSION['button_type']);
        }
        if (session()->has('course_id')) {
            $data['course_id'] = session('course_id');
            unset($_SESSION['course_id']);
        }
        if ($this->request->getMethod() == 'post') {
            if ($_POST['phone'] == 8809408811) {
                $swal_session = array(
                    'title' => 'Oops!',
                    'text' => 'Something went wrong, Please try again!',
                    'icon' => 'error',
                );
                session()->set('swal_session', $swal_session);
                return redirect()->to(base_url('/pratibhakhoj'));
            }
            // if(isset($_POST['get_type']) && $_POST['get_type'] == 'submit'){
            //     $button_type = $_POST['button_type'];
            //     session()->set('button_type', $button_type);
            //     if($_POST['course_id'] != ''){
            //         session()->set('course_id', $_POST['course_id']);
            //     }
            //     return redirect()->to(base_url('/enquiry'));
            // }
            if (isset($_POST['final_submit']) && $_POST['final_submit'] == 'submit') {
                //print_r($_POST); exit;
                $validation = $this->validate([
                    'name' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Your Full name is required',
                        ],
                    ],
                    'phone' => [
                        'rules' => 'required|numeric|min_length[10]|max_length[10]|is_unique[tbl_contact_us.phone]',
                        'errors' => [
                            'required' => 'Phone is required',
                            'numeric' => 'You must enter numeric value',
                            'min_length' => 'Phone Number must be 10 digit in length',
                            'max_length' => 'Phone Number must not have more than 10 digit in length',
                            'is_unique' => 'This number is already registered with us, please use another number',
                        ],
                    ],
                ]);
                if (!$validation) {
                    $data['validation'] = $this->validator;
                    //return view('admin/users/add_user',$this->data);
                } else {

                    $contact_us_data = array();
                    if ($_POST['course_id'] != '') {
                        $contact_us_data['course_id'] = $_POST['course_id'];
                    }
                    $contact_us_data['name'] = $_POST['name'];
                    // $contact_us_data['email'] = $_POST['email'];
                    $contact_us_data['phone'] = $_POST['phone'];
                    // $contact_us_data['message'] = $_POST['message'];
                    $contact_us_data['ipaddress'] = $this->request->getIPAddress();
                    $contact_us_data['submit_from'] = 'Pratibhakhoj Page';
                    $contact_us_data['added_at'] = date('y-m-d H:i:s');
                    $contact_us_data['status'] = 1;
                    $insertId = $this->commonmodel->insertRecord('tbl_contact_us', $contact_us_data);
                    if ($insertId) {
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
                            'title' => 'Thank You!',
                            'text' => 'Thank you for contacting us!. We will be in touch with you shortly.',
                        );
                        session()->set('swal_session', $swal_session);
                    } else {
                        $swal_session = array(
                            'title' => 'Oops!',
                            'text' => 'Something went wrong, Please try again!',
                            'icon' => 'error',
                        );
                        session()->set('swal_session', $swal_session);
                    }
                    return redirect()->to(base_url('/pratibhakhoj'));
                    //print_r($_POST);
                    //exit;
                }
            }

        }
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses', ['status' => 1], ['course_id', 'desc']);
        //echo view('include/header', $data);
        echo view('pratibhakhoj2', $data);
        //echo view('include/footer', $data);
    }
    public function pratibhakhoj2()
    {
        $data['title'] = 'Career-Boss | Pratibhakhoj';
        if (session()->has('button_type')) {
            $data['button_type'] = session('button_type');
            unset($_SESSION['button_type']);
        }
        if (session()->has('course_id')) {
            $data['course_id'] = session('course_id');
            unset($_SESSION['course_id']);
        }
        if ($this->request->getMethod() == 'post') {
            // if(isset($_POST['get_type']) && $_POST['get_type'] == 'submit'){
            //     $button_type = $_POST['button_type'];
            //     session()->set('button_type', $button_type);
            //     if($_POST['course_id'] != ''){
            //         session()->set('course_id', $_POST['course_id']);
            //     }
            //     return redirect()->to(base_url('/enquiry'));
            // }
            if (isset($_POST['final_submit']) && $_POST['final_submit'] == 'submit') {
                //print_r($_POST); exit;
                $validation = $this->validate([
                    'name' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Your Full name is required',
                        ],
                    ],
                    'phone' => [
                        'rules' => 'required|numeric|min_length[10]|max_length[10]|is_unique[tbl_contact_us.phone]',
                        'errors' => [
                            'required' => 'Phone is required',
                            'numeric' => 'You must enter numeric value',
                            'min_length' => 'Phone Number must be 10 digit in length',
                            'max_length' => 'Phone Number must not have more than 10 digit in length',
                        ],
                    ],
                ]);
                if (!$validation) {
                    $data['validation'] = $this->validator;
                    //return view('admin/users/add_user',$this->data);
                } else {

                    $contact_us_data = array();
                    if ($_POST['course_id'] != '') {
                        $contact_us_data['course_id'] = $_POST['course_id'];
                    }
                    $contact_us_data['name'] = $_POST['name'];
                    // $contact_us_data['email'] = $_POST['email'];
                    $contact_us_data['phone'] = $_POST['phone'];
                    // $contact_us_data['message'] = $_POST['message'];
                    $contact_us_data['ipaddress'] = $this->request->getIPAddress();
                    $contact_us_data['submit_from'] = 'Pratibhakhoj Page';
                    $contact_us_data['added_at'] = date('y-m-d H:i:s');
                    $contact_us_data['status'] = 1;
                    $insertId = $this->commonmodel->insertRecord('tbl_contact_us', $contact_us_data);
                    if ($insertId) {
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
                            'title' => 'Thank You!',
                            'text' => 'Thank you for contacting us!. We will be in touch with you shortly.',
                        );
                        session()->set('swal_session', $swal_session);
                    } else {
                        $swal_session = array(
                            'title' => 'Oops!',
                            'text' => 'Something went wrong, Please try again!',
                            'icon' => 'error',
                        );
                        session()->set('swal_session', $swal_session);
                    }
                    return redirect()->to(base_url('/pratibhakhoj2'));
                    //print_r($_POST);
                    //exit;
                }
            }

        }
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses', ['status' => 1], ['course_id', 'desc']);
        echo view('include/header', $data);
        echo view('pratibhakhoj');
        echo view('include/footer', $data);
    }
    public function pratibhakhoj3()
    {
        $data['title'] = 'Career-Boss | Pratibhakhoj';
        if (session()->has('button_type')) {
            $data['button_type'] = session('button_type');
            unset($_SESSION['button_type']);
        }
        if (session()->has('course_id')) {
            $data['course_id'] = session('course_id');
            unset($_SESSION['course_id']);
        }
        if ($this->request->getMethod() == 'post') {
            // if(isset($_POST['get_type']) && $_POST['get_type'] == 'submit'){
            //     $button_type = $_POST['button_type'];
            //     session()->set('button_type', $button_type);
            //     if($_POST['course_id'] != ''){
            //         session()->set('course_id', $_POST['course_id']);
            //     }
            //     return redirect()->to(base_url('/enquiry'));
            // }
            if (isset($_POST['final_submit']) && $_POST['final_submit'] == 'submit') {
                //print_r($_POST); exit;
                $validation = $this->validate([
                    'stext' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Please enter Registration no or Mobile no.',
                        ],
                    ],
                    // 'phone'=>[
                    //     'rules'=>'required|numeric|min_length[10]|max_length[10]|is_unique[tbl_contact_us.phone]',
                    //     'errors'=>[
                    //         'required'=>'Phone is required',
                    //         'numeric'=>'You must enter numeric value',
                    //         'min_length'=>'Phone Number must be 10 digit in length',
                    //         'max_length'=>'Phone Number must not have more than 10 digit in length'
                    //     ]
                    //     ]
                ]);
                if (!$validation) {
                    $data['validation'] = $this->validator;
                    //return view('admin/users/add_user',$this->data);
                } else {
                    $stext = $_POST['stext'];
                    $result_data = $this->homemodel->get_one_contact_us_data_for_result($stext);
                    if (!empty($result_data)) {
                        $data['result'] = $result_data;
                        echo view('include/header', $data);
                        echo view('pratibhakhoj_result');
                        echo view('include/footer', $data);
                        exit;
                    } else {
                        session()->setFlashdata(['message' => 'Data not exist!', 'type' => 'danger']);
                    }

                    /* $contact_us_data = array();
                    if($_POST['course_id'] != ''){
                    $contact_us_data['course_id'] = $_POST['course_id'];
                    }
                    $contact_us_data['name'] = $_POST['name'];
                    // $contact_us_data['email'] = $_POST['email'];
                    $contact_us_data['phone'] = $_POST['phone'];
                    // $contact_us_data['message'] = $_POST['message'];
                    $contact_us_data['ipaddress']     = $this->request->getIPAddress();
                    $contact_us_data['submit_from'] = 'Pratibhakhoj Page';
                    $contact_us_data['added_at']     = date('y-m-d H:i:s');
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
                    } */
                    return redirect()->to(base_url('/pratibhakhoj'));
                    //print_r($_POST);
                    //exit;
                }
            }

        }
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses', ['status' => 1], ['course_id', 'desc']);
        echo view('include/header', $data);
        echo view('pratibhakhoj_result');
        echo view('include/footer', $data);
    }
    public function save_subscriber()
    {
        if ($this->request->getMethod() == 'post') {
            $result = array();
            $validation = $this->validate([
                'email' => [
                    'rules' => 'required|valid_email|is_unique[tbl_subscriber.email]',
                    'errors' => [
                        'required' => 'Email is required',
                        'valid_email' => 'Enter Valid Email',
                        'is_unique' => 'This Email has already subscribed',
                    ],
                ],
            ]);
            if (!$validation) {
                $validator = $this->validator;
                $errors = array(
                    'email' => $validator->getError('email'),
                );
                $result['error'] = $errors;
            } else {
                $data = array();
                $data['email'] = $this->request->getPost('email');
                $data['status'] = '1';
                $insertId = $this->commonmodel->insertRecord('tbl_subscriber', $data);
                if ($insertId) {
                    /*$swal_session = array(
                    'title'=>'Thank You!',
                    'text'=>'Thank you for contacting us!. We will be in touch with you shortly.',
                    );
                    session()->set('swal_session', $swal_session);*/
                    $result['msg'] = 'success';
                } else {
                    $result['err'] = 'fail';
                }
            }

            echo json_encode($result);exit;
        }
    }

    public function referrer()
    {
        $data['title'] = 'Career-Boss | Referrer';
        echo view('include/header', $data);
        echo view('referrer');
        echo view('include/footer', $data);
    }
    public function franchise()
    {
        $data['sections'] = $this->commonmodel->getOneRecord('tbl_frregister_page');
        
        echo view('include/header', $data);
        echo view('franchise', $data);
        echo view('include/footer', $data);
    }
    public function franchise_verification()
    {
        $data['title'] = 'Career-Boss | Franchise-Verification';
        if(isset($_GET['s']) && $_GET['s'] != ''){
            $data['franchise'] = $this->homemodel->get_searched_franchise();
        }
        echo view('include/header', $data);
        echo view('franchise_verification', $data);
        echo view('include/footer', $data);
    }
    public function student_verification()
    {
        $data['title'] = 'Career-Boss | Student-Verification';
        if(isset($_GET['no']) && $_GET['no'] != ''){
            $data['results'] = $this->homemodel->get_verified_student();
            if(empty($data['results'])){
                $data['cbStudentsDtls']  = $this->homemodel->get_cb_student_details();
                $data['stuCourses'] = $this->homemodel->get_cb_student_courses();
                // print_r($stuCourses);exit;
            }
        }
        echo view('include/header', $data);
        echo view('stu_verification', $data);
        echo view('include/footer', $data);
    }
    public function result_verification()
    {
        $data['title'] = 'Career-Boss | Student Result Verification';
        if(isset($_GET['cert_no']) && $_GET['cert_no'] != ''){
            $data['results'] = $this->homemodel->get_searched_result();
            if(empty($data['results'])){
                $data['cbStudentsDtls']  = $this->homemodel->get_cb_student_cert_details();
                // echo '<pre>';print_r($data['cbStudentsDtls']);exit;
            }
        }
        echo view('include/header', $data);
        echo view('result_verification', $data);
        echo view('include/footer', $data);
    }
    public function certificate_verification()
    {
        $data['title'] = 'Career-Boss | Student Certificate Verification';
        if(isset($_GET['cert_no']) && $_GET['cert_no'] != ''){
            $data['results'] = $this->homemodel->get_searched_result();
            if(empty($data['results'])){
                $data['cbStudentsDtls']  = $this->homemodel->get_cb_student_cert_details();
                // echo '<pre>';print_r($data['cbStudentsDtls']);exit;
            }
        }
        echo view('include/header', $data);
        echo view('cert_verification', $data);
        echo view('include/footer', $data);
    }
    public function account_deletion(){
        if ($this->request->getMethod() == 'post') {
            $post = array();
            $post['name'] = $this->request->getPost('name');
            $post['email'] = $this->request->getPost('email');
            $post['reason'] = $_POST['reason'];
            $post['added_at'] = date('Y-m-d h:i:s');
            $insertId = $this->commonmodel->insertRecord('tbl_account_deletion', $post);
            if ($insertId) {
                $setting = $this->commonmodel->get_setting(1);
                $msg = "<h1>Dear Admin</h1>
                        <p>I have received a request from someone who wants to delete their account.</p>
                        <p><strong>Name: </strong>". $post['name']."<br>
                            <strong>Email: </strong>". $post['email']."<br>
                            <strong>Reason: </strong>". $post['reason']."</p>
                        <p><strong>Regards</strong></p>
                        <p><strong>Career-Boss</strong></p>";
                $email = \Config\Services::email();

                $email->setFrom($setting->email, 'Career-Boss');
                $email->setTo('careerbossinstitute@gmail.com');
                $email->setSubject('Account Deletion');
                $email->setMessage($msg);
                $email->send();
                
            }
            return redirect()->to(base_url('/thank-you'));
        }
        $data['title'] = 'Career-Boss | Account Deletion';
        echo view('include/header', $data);
        echo view('account_deletion', $data);
        echo view('include/footer', $data);
    }
    public function thank_you(){
        $data['title'] = 'Career-Boss | Thank You';
        echo view('include/header', $data);
        echo view('thank_you', $data);
        echo view('include/footer', $data);
    }
    

}
