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
        $data['title'] = 'Digital Marketing, Software Development, App Development course | Career Boss Institute';
        $data['description'] = 'Unlock your potential with our comprehensive courses in Digital Marketing, Software Development and App Development. Join us to gain the skills you need for success in the digital world.';
        $data['keywords'] = 'Digital Marketing Courses, Email Marketing Courses, HTML Development Courses, Web Development Courses, Fullstack Development Courses, Frontend Development Courses, Image and Video editing Courses, Mobile app Development Courses, UX and UI Designing Courses';
        $data['courses'] = $this->homemodel->get_popular_active_courses();
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['page'=>1,'status'=>1]);
        $data['testimonial'] = $this->homemodel->get_testimonial_for_home($limit = 4);
        //print_r($data['courses']); exit;
        echo view('include/header',$data);
        echo view('home', $data);
        echo view('include/footer', $data);
    }
    public function course_detail($url = null){
        $cDtls = $this->homemodel->get_one_course($url);
        if($url != null && !empty($cDtls)){
            $data['title'] = 'Career-Boss | Course-Details';
            $data['cDtls'] = $cDtls;
            $data['youtube_vlink'] = '';
            if($cDtls->youtube_vlink != ''){
                $parts = parse_url($cDtls->youtube_vlink);
                if(isset($parts['host']) && $parts['host'] == 'www.youtube.com'){
                    $data['youtube_vlink'] = $cDtls->youtube_vlink;
                }
            }
            echo view('include/header', $data);
            echo view('course-detail', $data);
            echo view('include/footer', $data);
        }else{
            return redirect()->to(base_url('page-not-found'));
        }
    }
    public function about_us(){
        $data['title'] = 'Career-Boss | About-us';
        $data['experts'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_experts',['status'=>1], ['exp_id','desc']);
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['page'=>4,'status'=>1]);
        echo view('include/header', $data);
        echo view('about-us', $data);
        echo view('include/footer', $data);
    }
    public function career(){
        $data['title'] = 'Career-Boss | career';
        echo view('include/header', $data);
        echo view('career', $data);
        echo view('include/footer', $data);
    }
    public function contact(){
        $data['title'] = 'Career-Boss | Contact-us';
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses',['status'=>1], ['course_id','desc']);
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['page'=>3,'status'=>1]);
        echo view('include/header', $data);
        echo view('contact-us', $data);
        echo view('include/footer', $data);
    }
    public function placement(){
        $data['title'] = 'Career-Boss | Placement';
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['page'=>7,'status'=>1]);
        $data['faqs'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_faqs',['faq_status'=>'1'], ['faq_id','desc']);
        $data['testimonial'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_testimonial',['type'=>'suc','status'=>'1'], ['id','desc']);
        echo view('include/header', $data);
        echo view('placement', $data);
        echo view('include/footer', $data);
    }
    public function blogs(){
        $data['title'] = 'Career-Boss | Blog';
        $data['recent_blog'] = $this->homemodel->get_recent_blog();
        $data['blogs'] = $this->homemodel->get_all_blogs(); // except recent blogs
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['page'=>5,'status'=>1]);
        echo view('include/header', $data);
        echo view('blog', $data);
        echo view('include/footer', $data);
    }
    public function blog_detail($url){
        $data['title'] = 'Career-Boss | '.str_replace('-',' ',$url);
        $data['blog'] = $this->commonmodel->getOneRecord('tbl_blog',['blog_url'=>$url]);
        $data['blog2'] = $this->homemodel->get_blog_for_blog_detail($url);
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['page'=>6,'status'=>1]);
        echo view('include/header', $data);
        echo view('blog-detail', $data);
        echo view('include/footer', $data);
    }
    public function listen_stories(){
        $data['title'] = 'Career-Boss | Listen Stories';
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['page'=>8,'status'=>1]);
        $data['testimonial'] = $this->homemodel->get_testimonial_for_home();
        echo view('include/header', $data);
        echo view('listen-stories', $data);
        echo view('include/footer', $data);
    }
    public function cms(){
        $page_title = service('uri')->getSegment(1);
        $page = ($page_title == 'privacy-policy')?'pp':'tc';
        $data['title'] = 'Career-Boss | '.$page_title;
        $data['cms'] = $this->homemodel->get_cms($page);
        //$data['testimonial'] = $this->homemodel->get_testimonial_for_home();
        echo view('include/header', $data);
        echo view('cms', $data);
        echo view('include/footer', $data);
    }

    public function save_contact_us(){ 
		if($this->request->getMethod() == 'post'){
			$result = array();
			$validation = $this->validate([
				'name'=>[
					'rules'=>'required',
					'errors'=>['required'=>'Your Name is required']
				],
				'email'=>[
					'rules'=>'required|valid_email',
					'errors'=>['required'=>'Email is required','valid_email'=>'Enter Valid Email']
				],
				'phone'=>[
					'rules'=>'required|is_natural|min_length[10]|max_length[10]',
					'errors'=>['required'=>'Phone Number is required','is_natural'=>'Enter Valid Phone Number','min_length'=>'Phone Number must be 10 digit in length','max_length'=>'Phone Number must not have more than 10 digit in length']
				],
                'course_id'=>[
					'rules'=>'required',
					'errors'=>['required'=>'Course is required']
				],
			]);
			if(!$validation){
				$validator = $this->validator;
				$errors = array(
					'name' => $validator->getError('name'),
					'email' => $validator->getError('email'),
					'phone' => $validator->getError('phone'),
					'course_id' => $validator->getError('course_id'),
				);
				$result['error'] = $errors;
			}else{
				$data = array();
                if(isset($_POST['course_id'])){
                    $data['course_id'] 		= $this->request->getPost('course_id');
                }
				$data['name'] 		= $this->request->getPost('name');
				$data['email'] 		= $this->request->getPost('email');
				$data['phone'] 		= $this->request->getPost('phone');
				$data['message'] 	= $this->request->getPost('message');
				$data['ipaddress'] 	= $this->request->getIPAddress();
				$data['submit_from'] = (isset($_POST['button_type']) && $_POST['button_type'] != '')?$_POST['button_type']:'Contact-us Page';
                $data['status']     = 1;
				$data['added_at'] 	= date('y-m-d H:i:s');
				$insertId = $this->commonmodel->insertRecord('tbl_contact_us', $data);
				if($insertId){
                    $setting = $this->commonmodel->get_setting(1);
                    /*$msg = '<h2>Contact us</h2>
                        <p><strong>Full Name: </strong>'.$this->request->getPost('name').'</p>
                        <p><strong>Email: </strong>'.$this->request->getPost('email').'</p>
                        <p><strong>Phone: </strong>'.$this->request->getPost('phone').'</p>
                        <p><strong>Message: </strong>'.$this->request->getPost('message').'</p>';*/
                    $msg = '<p>Thank you for contacting us!. We will be in touch with you shortly.</p>
                            <p><strong>Regards</strong></p>
                            <p><strong>Career-Boss</strong></p>';
                    $email = \Config\Services::email();

                    $email->setFrom($setting->email, 'Career-Boss');
                    $email->setTo($this->request->getPost('email'));
                    //$email->setTo('test136@yopmail.com');
                    
                    $email->setSubject('Contact us');
                    $email->setMessage($msg);
                    
                    $email->send();
                    $swal_session = array(
                        'title'=>'Thank You!',
                        'text'=>'Thank you for contacting us!. We will be in touch with you shortly.',
                    );
                    session()->set('swal_session', $swal_session);
					$result['msg'] 	= 'success';
				}else{
					$result['err'] = 'fail';
				}
			}
			
			echo json_encode($result); exit;
		}
	}
    public function enquiry(){
        $data['title'] = 'Career-Boss | Enquiry';
        if(session()->has('button_type')){
            $data['button_type'] = session('button_type');
            unset($_SESSION['button_type']);
        }
        if(session()->has('course_id')){
            $data['course_id'] = session('course_id');
            unset($_SESSION['course_id']);
        }
        if($this->request->getMethod() == 'post'){
            if(isset($_POST['get_type']) && $_POST['get_type'] == 'submit'){
                $button_type = $_POST['button_type'];
                session()->set('button_type', $button_type);
                if($_POST['course_id'] != ''){
                    session()->set('course_id', $_POST['course_id']);
                }
                return redirect()->to(base_url('/enquiry'));
            }
            if(isset($_POST['final_submit']) && $_POST['final_submit'] == 'submit'){
                //print_r($_POST); exit;
                $validation = $this->validate([
                    'name'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'Your Full name is required'
                        ]
                        ],
                    'email' =>[
                        'rules'=>'required|valid_email',
                        'errors'=>[
                            'required'=>'Email is required',
                            'valid_email'=>'You must enter a valid email',
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
                    if($_POST['course_id'] != ''){
                        $contact_us_data['course_id'] = $_POST['course_id'];
                    }
                    $contact_us_data['name'] = $_POST['name'];
                    $contact_us_data['email'] = $_POST['email'];
                    $contact_us_data['phone'] = $_POST['phone'];
                    $contact_us_data['message'] = $_POST['message'];
                    $contact_us_data['ipaddress'] 	= $this->request->getIPAddress();
				    $contact_us_data['submit_from'] 	= $_POST['button_type'];
				    $contact_us_data['added_at'] 	= date('y-m-d H:i:s');
                    $contact_us_data['status']     = 1;
                    $insertId = $this->commonmodel->insertRecord('tbl_contact_us', $contact_us_data);
                    if($insertId){
                        $setting = $this->commonmodel->get_setting(1);
                        $msg = '<p>Thank you for contacting us!. We will be in touch with you shortly.</p>
                                <p><strong>Regards</strong></p>
                                <p><strong>Career-Boss</strong></p>';
                        $email = \Config\Services::email();

                        $email->setFrom($setting->email, 'Career-Boss');
                        $email->setTo($this->request->getPost('email'));
                        $email->setSubject('Enquiry');
                        $email->setMessage($msg);
                        $email->send();

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
                    return redirect()->to(base_url('/enquiry'));
                    //print_r($_POST);
                    //exit;
                }
            }

        }
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses',['status'=>1], ['course_id','desc']);
        echo view('include/header', $data);
        echo view('enquiry', $data);
        echo view('include/footer', $data);
    }
    public function pratibhakhoj(){
        $data['title'] = 'Career-Boss | Pratibhakhoj';
        if(session()->has('button_type')){
            $data['button_type'] = session('button_type');
            unset($_SESSION['button_type']);
        }
        if(session()->has('course_id')){
            $data['course_id'] = session('course_id');
            unset($_SESSION['course_id']);
        }
        if($this->request->getMethod() == 'post'){
            if($_POST['phone'] == 8809408811){
                $swal_session = array(
                    'title'=>'Oops!',
                    'text'=>'Something went wrong, Please try again!',
                    'icon'=>'error',
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
                        'rules'=>'required|numeric|min_length[10]|max_length[10]|is_unique[tbl_contact_us.phone]',
                        'errors'=>[
                            'required'=>'Phone is required',
                            'numeric'=>'You must enter numeric value',
                            'min_length'=>'Phone Number must be 10 digit in length',
                            'max_length'=>'Phone Number must not have more than 10 digit in length',
                            'is_unique' => 'This number is already registered with us, please use another number'
                        ]
                        ]
                ]);
                if(!$validation){
                    $data['validation'] = $this->validator;
                    //return view('admin/users/add_user',$this->data);
                }else{
                    
                    $contact_us_data = array();
                    if($_POST['course_id'] != ''){
                        $contact_us_data['course_id'] = $_POST['course_id'];
                    }
                    $contact_us_data['name'] = $_POST['name'];
                    // $contact_us_data['email'] = $_POST['email'];
                    $contact_us_data['phone'] = $_POST['phone'];
                    // $contact_us_data['message'] = $_POST['message'];
                    $contact_us_data['ipaddress'] 	= $this->request->getIPAddress();
				    $contact_us_data['submit_from'] = 'Pratibhakhoj Page';
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
                    return redirect()->to(base_url('/pratibhakhoj'));
                    //print_r($_POST);
                    //exit;
                }
            }

        }
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses',['status'=>1], ['course_id','desc']);
        //echo view('include/header', $data);
        echo view('pratibhakhoj2', $data);
        //echo view('include/footer', $data);
    }
    public function pratibhakhoj2(){
        $data['title'] = 'Career-Boss | Pratibhakhoj';
        if(session()->has('button_type')){
            $data['button_type'] = session('button_type');
            unset($_SESSION['button_type']);
        }
        if(session()->has('course_id')){
            $data['course_id'] = session('course_id');
            unset($_SESSION['course_id']);
        }
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
                        'rules'=>'required|numeric|min_length[10]|max_length[10]|is_unique[tbl_contact_us.phone]',
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
                    if($_POST['course_id'] != ''){
                        $contact_us_data['course_id'] = $_POST['course_id'];
                    }
                    $contact_us_data['name'] = $_POST['name'];
                    // $contact_us_data['email'] = $_POST['email'];
                    $contact_us_data['phone'] = $_POST['phone'];
                    // $contact_us_data['message'] = $_POST['message'];
                    $contact_us_data['ipaddress'] 	= $this->request->getIPAddress();
				    $contact_us_data['submit_from'] = 'Pratibhakhoj Page';
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
                    return redirect()->to(base_url('/pratibhakhoj2'));
                    //print_r($_POST);
                    //exit;
                }
            }

        }
        $data['courses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_courses',['status'=>1], ['course_id','desc']);
        echo view('include/header', $data);
        echo view('pratibhakhoj');
        echo view('include/footer', $data);
    }
    public function save_subscriber(){
        if($this->request->getMethod() == 'post'){
			$result = array();
			$validation = $this->validate([
				'email'=>[
					'rules'=>'required|valid_email|is_unique[tbl_subscriber.email]',
					'errors'=>[
                        'required'=>'Email is required',
                        'valid_email'=>'Enter Valid Email',
                        'is_unique'=>'This Email has already subscribed'
                    ]
				],
			]);
			if(!$validation){
				$validator = $this->validator;
				$errors = array(
					'email' => $validator->getError('email'),
				);
				$result['error'] = $errors;
			}else{
				$data = array();
				$data['email'] 		= $this->request->getPost('email');
                $data['status']     = '1';
				$insertId = $this->commonmodel->insertRecord('tbl_subscriber', $data);
				if($insertId){
                    /*$swal_session = array(
                        'title'=>'Thank You!',
                        'text'=>'Thank you for contacting us!. We will be in touch with you shortly.',
                    );
                    session()->set('swal_session', $swal_session);*/
					$result['msg'] 	= 'success';
				}else{
					$result['err'] = 'fail';
				}
			}
			
			echo json_encode($result); exit;
		}
    }
    
}
