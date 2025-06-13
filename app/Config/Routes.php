<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->match(['get', 'post'], '/course-detail/(:any)', 'Home::course_detail/$1');
$routes->get('/about-us', 'Home::about_us');
$routes->get('/career', 'Home::career');
$routes->get('/contact', 'Home::contact');
$routes->get('/placement', 'Home::placement');
$routes->get('/blogs', 'Home::blogs');
$routes->get('/blog/(:any)', 'Home::blog_detail/$1');
$routes->get('/listen-stories', 'Home::listen_stories');
$routes->match(['get', 'post'], 'home/save-contact-us', 'Home::save_contact_us');
$routes->match(['get', 'post'], '/enquiry', 'Home::enquiry');
$routes->match(['get', 'post'], 'home/save-subscriber', 'Home::save_subscriber');
$routes->get('/privacy-policy', 'Home::cms');
$routes->get('/terms-of-use', 'Home::cms');
$routes->match(['get','post'],'/account-deletion', 'Home::account_deletion');
$routes->get('/thank-you', 'Home::thank_you');

$routes->get('/testapi', 'InsManageControllers::testapi');

$routes->get('/authentication-failed', function () {
    return view('admin/auth-fail');
});
$routes->set404Override(function () {
    echo view('include/header');
    echo view('errors/html/error_404');
    echo view('include/footer');
});
$routes->get('404', function () {
    echo view('include/header');
    echo view('errors/html/error_404');
    echo view('include/footer');
});

$routes->match(['get', 'post'], '/pratibhakhoj', 'Home::pratibhakhoj3');
$routes->match(['get', 'post'], '/pratibhakhoj2', 'Home::pratibhakhoj2');
$routes->match(['get', 'post'], '/pratibhakhoj3', 'Home::pratibhakhoj');

/*****************************Bootcamp******************************** */
$routes->match(['get', 'post'], '/image-editing-bootcamp', 'Bootcamp::image_editing_bootcamp');
$routes->match(['get', 'post'], '/html-coding-bootcamp', 'Bootcamp::html_coding_bootcamp');
$routes->match(['get', 'post'], '/bca-tuition-for-all-semester', 'Bootcamp::bca_tuition_for_all_semester');

/******************************Api***************************************** */
//$routes->match(['get','post'],'/webhook/(:any)', 'Api::webhook/$1');
// $routes->match(['get','post'],'/webhook', 'Api::webhook');
$routes->get('/webhook', 'Api::webhook');
$routes->post('/webhook', 'Api::webhookpost');

/*******************************Referrer************************************* */
$routes->get('/referrer', 'Home::referrer');
/*******************************franchise************************************* */
$routes->get('/franchise', 'Home::franchise');
$routes->get('/franchise-verification', 'Home::franchise_verification');
$routes->get('/student-verification', 'Home::student_verification');
$routes->get('/result-verification', 'Home::result_verification');
$routes->get('/certificate-verification', 'Home::certificate_verification');

// $routes->match(['get','post'],'/pratibhakhoj', function(){
//     // echo 'under development';
//     // 'Home::enquiry'
// });
$routes->get('page-not-found', function () {
    echo view('include/header');
    // echo view('errors/html/page_not_found');
    echo view('errors/html/error_404');
    echo view('include/footer');
});
/*********************************Examination************************ */
$routes->match(['get','post'], 'pro-examination/(:any)', 'Examination::examination/$1');
$routes->match(['get','post'], 'pro-examination-begin/(:any)', 'Examination::examination_begin/$1');
$routes->match(['get','post'], 'pro-examination-exit/(:any)', 'Examination::examination_exit/$1');
$routes->match(['get','post'], 'examination/update_examinee_duration', 'Examination::update_examinee_duration');
$routes->match(['get','post'], 'examination/save_result', 'Examination::save_result');

$routes->group('', ['filter' => 'MemAlreadyLoggedIn'], function ($routes) {
    //All routes need protected by this filter
    $routes->match(['get', 'post'], '/login', 'Member::login');
    $routes->match(['get', 'post'], '/register', 'Member::register');
    $routes->match(['get','post'], '/referrer-register', 'Member::referrer_register');
    // $routes->match(['get','post'], '/auth-login2', 'Customer::login2');
    // $routes->match(['get','post'], '/send-otp', 'Customer::sendotp');
    // $routes->match(['get','post'], '/forgot-password', 'Customer::forgot_password');
    // $routes->match(['get','post'], '/reset-password', 'Customer::reset_password');
    // $routes->match(['get','post'], '/update-code', 'Customer::update_code'); // for developer use only

});
$routes->group('', ['filter' => 'MemAuthCheck'], function ($routes) {
    $routes->get('/member-dashboard', 'Member::member_dashboard');
    $routes->get('/student-list', 'Member::student_list');
    $routes->match(['get', 'post'], '/student-cu', 'Member::student_cu');
    $routes->match(['get', 'post'], '/student-cu/(:num)', 'Member::student_cu/$1');
    $routes->match(['get', 'post'], '/student-d/(:num)', 'Member::student_delete/$1');
    $routes->match(['get', 'post'], '/bank-details', 'Member::bank_details');
    $routes->match(['get', 'post'], '/profile', 'Member::profile');
    $routes->match(['get', 'post'], '/change-pass', 'Member::change_password');

    $routes->get('/member-logout', 'Member::logout');
});
$routes->group('',['filter'=>'StuAlreadyLoggedIn'], function($routes){
    //All routes need protected by this filter
    $routes->match(['get','post'], '/student-login', 'Member::stu_login');
});
$routes->group('',['filter'=>'StuAuthCheck'], function($routes){
    //All routes need protected by this filter
    $routes->match(['get','post'], '/student-dashboard', 'Member::stu_dashboard');
    $routes->match(['get','post'], '/my-courses', 'Member::my_courses');
    $routes->match(['get','post'], '/my-courses/(:any)', 'Member::my_courses/$1');
    $routes->match(['get','post'], '/live-classes', 'Member::live_classes');
    $routes->match(['get','post'], '/live-chat', 'Member::live_chat');
    $routes->match(['get','post'], '/save_chat', 'Member::save_chat'); //for ajax
    $routes->match(['get','post'], '/get-live-chat', 'Member::get_live_chat');
    $routes->match(['get','post'], '/notification', 'Member::notification');
    $routes->match(['get','post'], '/account-profile', 'Member::account_profile');
    $routes->match(['get','post'], '/account-payment', 'Member::account_payment');
    $routes->match(['get','post'], '/account-quiz', 'Member::account_quiz');
    $routes->match(['get','post'], '/sample-paper', 'Member::sample_paper');
    $routes->match(['get','post'], '/contact-us', 'Member::contact_us_api');
    $routes->match(['get','post'], '/quiz', 'Member::quiz');
    $routes->match(['get','post'], '/quiz-list/(:any)', 'Member::quiz_list/$1');
    $routes->match(['get','post'], '/quiz-start/(:any)', 'Member::quiz_start/$1');
    $routes->match(['get','post'], '/quiz-finish', 'Member::quiz_finish');
    $routes->match(['get','post'], '/check-ans', 'Member::check_ans');
    $routes->match(['get','post'], '/student-logout', 'Member::stu_logout');
});
// for ajax (admin & member)
$routes->match(['get','post'], '/get_districts', 'Member::get_districts');
$routes->match(['get','post'], '/get_module_html', 'Member::get_module_html');
//Filter on route group
$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
    //Add all routes need protected by this filter
    $routes->add('/logout', 'Auth::logout');
    $routes->add('/profile', 'Auth::edit_profile');
    $routes->add('/change-password', 'Auth::change_password');
    $routes->get('/admin', 'Admin::index');
    /******************************Users****************************** */
    $routes->get('/admin/users', 'Admin::users');
    $routes->match(['get', 'post'], '/admin/add_user', 'Admin::add_user');
    $routes->match(['get', 'post'], '/admin/edit_user/(:num)', 'Admin::edit_user/$1');
    $routes->match(['get', 'post'], '/admin/user_profile/(:num)', 'Admin::user_profile/$1');
    $routes->match(['get', 'post'], '/admin/user_delete/(:num)', 'Admin::user_delete/$1');
    /******************************Users Group****************************** */
    $routes->get('/admin/user_groups', 'Admin::user_groups');
    $routes->match(['get', 'post'], '/admin/addgroup', 'Admin::addgroup');
    $routes->match(['get', 'post'], '/admin/editgroup/(:num)', 'Admin::editgroup/$1');
    $routes->match(['get', 'post'], '/admin/deletegroup/(:num)', 'Admin::deletegroup/$1');
    /****************************setting************************************ */
    $routes->match(['get', 'post'], '/admin/setting', 'Admin::setting');
    /****************************CMS**************************************** */
    $routes->get('/admin/cms', 'Admin::cms');
    $routes->match(['get', 'post'], '/admin/add_edit_cms', 'Admin::add_edit_cms');
    $routes->match(['get', 'post'], '/admin/add_edit_cms/(:num)', 'Admin::add_edit_cms/$1');
    $routes->match(['get', 'post'], '/admin/delete_cms/(:num)', 'Admin::delete_cms/$1');
    /****************************Blogs**************************************** */
    $routes->get('/admin/blogs', 'Admin::blogs');
    $routes->match(['get', 'post'], '/admin/add_edit_blog', 'Admin::add_edit_blog');
    $routes->match(['get', 'post'], '/admin/add_edit_blog/(:num)', 'Admin::add_edit_blog/$1');
    $routes->match(['get', 'post'], '/admin/delete_blog/(:num)', 'Admin::delete_blog/$1');
    $routes->match(['get', 'post'], '/admin/blog_faq/(:num)', 'Admin::blog_faq/$1');
    $routes->match(['get', 'post'], '/admin/blog_faq/(:num)/(:num)', 'Admin::blog_faq/$1/$2');
    $routes->match(['get', 'post'], '/admin/delete_blog_faq/(:num)/(:num)', 'Admin::delete_blog_faq/$1/$2');

    /****************************Faq**************************************** */
    $routes->get('/admin/faq', 'Admin::faq');
    $routes->match(['get', 'post'], '/admin/add_edit_faq', 'Admin::add_edit_faq');
    $routes->match(['get', 'post'], '/admin/add_edit_faq/(:num)', 'Admin::add_edit_faq/$1');
    $routes->match(['get', 'post'], '/admin/delete_faq/(:num)', 'Admin::delete_faq/$1');
    /*********************************Testimonial********************************* */
    $routes->get('/admin/testimonial', 'Admin::testimonial');
    $routes->match(['get', 'post'], '/admin/add_edit_testimonial', 'Admin::add_edit_testimonial');
    $routes->match(['get', 'post'], '/admin/add_edit_testimonial/(:num)', 'Admin::add_edit_testimonial/$1');
    $routes->match(['get', 'post'], '/admin/delete_testimonial/(:num)', 'Admin::delete_testimonial/$1');
    /*********************************Manage Banner********************************* */
    $routes->get('/admin/banner', 'Admin::banner');
    $routes->match(['get', 'post'], '/admin/add_edit_banner', 'Admin::add_edit_banner');
    $routes->match(['get', 'post'], '/admin/add_edit_banner/(:num)', 'Admin::add_edit_banner/$1');
    $routes->match(['get', 'post'], '/admin/delete_banner/(:num)', 'Admin::delete_banner/$1');
    /**********************************Course Management******************************** */
    $routes->get('/admin/courses', 'Admin::courses');
    $routes->match(['get', 'post'], '/admin/add_edit_course', 'Admin::add_edit_course');
    $routes->match(['get', 'post'], '/admin/add_edit_course/(:num)', 'Admin::add_edit_course/$1');
    $routes->match(['get', 'post'], '/admin/delete_course/(:num)', 'Admin::delete_course/$1');
    /**********************************Institution Management******************************** */
    $routes->get('/admin/experts', 'Admin::experts');
    $routes->match(['get', 'post'], '/admin/experts_cu', 'Admin::add_edit_experts');
    $routes->match(['get', 'post'], '/admin/experts_cu/(:num)', 'Admin::add_edit_experts/$1');
    $routes->match(['get', 'post'], '/admin/delete_expert/(:num)', 'Admin::delete_expert/$1');

    $routes->get('/admin/contact-us', 'Admin::contact_us');
    $routes->match(['get', 'post'], '/admin/change-status', 'Admin::change_status'); //priv-2
    $routes->match(['get', 'post'], '/admin/export_to_excel/(:any)', 'Admin::export_to_excel/$1'); //priv-4
    $routes->match(['get', 'post'], '/admin/delete-contact/(:num)', 'Admin::delete_contact/$1'); //priv-5
    $routes->match(['get', 'post'], '/admin/set_whatsapp_number/(:any)/(:any)', 'Admin::set_whatsapp_number/$1/$2'); //priv-3

    $routes->get('/admin/subscriber', 'Admin::subscriber');
    /**************************************Enquiry******************************************** */
    $routes->get('/admin/enquiry', 'Admin::enquiry');
    $routes->match(['get', 'post'], '/admin/enquiry_list', 'Admin::enquiry_list');
    $routes->match(['get', 'post'], '/admin/enquiry_cu', 'Admin::enquiry_cu');
    $routes->match(['get', 'post'], '/admin/enquiry_cu/(:num)', 'Admin::enquiry_cu/$1');
    $routes->match(['get', 'post'], '/admin/enquiry_view/(:num)', 'Admin::enquiry_view/$1');
    $routes->match(['get', 'post'], '/admin/delete_enquiry/(:num)', 'Admin::delete_enquiry/$1');
    $routes->match(['get', 'post'], '/admin/enquiry_export_to_excel/(:any)/(:any)', 'Admin::enquiry_export_to_excel/$1/$2');
    $routes->match(['get', 'post'], '/admin/set_enq_whatsapp_number/(:any)/(:any)', 'Admin::set_enq_whatsapp_number/$1/$2');
    $routes->match(['get', 'post'], '/admin/set_non_whatsapp_number/(:num)', 'Admin::set_non_whatsapp_number/$1'); //priv-8

    /**************************************Whatsapp Reply************************************** */
    $routes->get('/admin/whatsapp_replied', 'Admin::whatsapp_replied');
    $routes->get('/admin/readWhatsAppMessage/(:num)', 'Admin::readWhatsAppMessage/$1');
    $routes->get('/admin/delete_whatsAppReplyLog/(:num)', 'Admin::delete_whatsAppReplyLog/$1');
    $routes->match(['get', 'post'], '/admin/delete_whatsAppReplyLog_ByAjax', 'Admin::delete_whatsAppReplyLog_ByAjax');

    /**************************************Referral******************************************** */
    $routes->get('/admin/referral', 'Admin::referral');
    $routes->match(['get', 'post'], '/admin/referral_view/(:num)', 'Admin::referral_view/$1');
    $routes->get('/admin/delete_referral/(:num)', 'Admin::delete_referral/$1');
    $routes->match(['get', 'post'], '/admin/update_bank_details_status', 'Admin::update_bank_details_status');
    $routes->match(['get', 'post'], '/admin/amount_paid_to_referral', 'Admin::amount_paid_to_referral');
    /*****************************************Modules******************************************* */
    $routes->get('/admin/course_modules', 'Admin::course_modules');
    $routes->match(['get','post'],'/admin/course_cu', 'Admin::course_cu');
    $routes->match(['get','post'],'/admin/course_cu/(:num)', 'Admin::course_cu/$1');
    $routes->match(['get','post'],'/admin/modules/(:num)', 'Admin::modules/$1');
    $routes->match(['get','post'],'/admin/modules/(:num)/(:num)', 'Admin::modules/$1/$2');
    /**************************************Franchise******************************************** */
    $routes->get('/admin/franchise', 'Admin::franchise');
    $routes->match(['get','post'],'/admin/franchise_CU/(:num)', 'Admin::franchise_edit/$1');
    $routes->match(['get','post'],'/admin/franchise_view/(:num)', 'Admin::franchise_view/$1');
    $routes->get('/admin/delete_franchise/(:num)', 'Admin::delete_franchise/$1');
    $routes->match(['get','post'],'/admin/reset_password', 'Admin::reset_password');
    $routes->match(['get','post'], '/admin/view_franchise_student_by_ajax', 'Admin::view_franchise_student_by_ajax');
    $routes->match(['get','post'], '/admin/generate_cert_by_ajax', 'Admin::generate_cert_by_ajax');
    $routes->match(['get','post'], '/admin/reject_cert/(:num)/(:num)', 'Admin::reject_cert/$1/$2');
    $routes->match(['get','post'], '/admin/add_edit_franchise_student/(:num)', 'Admin::add_edit_franchise_student/$1');
    $routes->match(['get','post'], '/admin/add_edit_franchise_student/(:num)/(:num)', 'Admin::add_edit_franchise_student/$1/$2');
    $routes->match(['get','post'], '/admin/delete_franchise_student/(:num)/(:num)', 'Admin::delete_franchise_student/$1/$2');

    $routes->match(['get','post'], '/admin/grade_update', 'Admin::grade_update');
    $routes->match(['get','post'],'/admin/change_notification_status/(:num)', 'Admin::change_notification_status/$1');

    $routes->match(['get','post'], '/admin/generate_cert', 'Admin::generate_cert');
    $routes->match(['get','post'], '/admin/add_edit_universityinfo/(:num)/(:num)', 'Admin::add_edit_universityinfo/$1/$2');
    $routes->match(['get','post'], '/admin/view_stuuniversityinfo/(:num)/(:num)', 'Admin::view_stuuniversityinfo/$1/$2');
    /********************************************Examination************************************* */
    $routes->match(['get','post'], '/admin/question_bank', 'Admin::question_bank');
    $routes->match(['get','post'], '/admin/add_edit_question', 'Admin::add_edit_question');
    $routes->match(['get','post'], '/admin/add_edit_question/(:num)', 'Admin::add_edit_question/$1');
    $routes->match(['get','post'], '/admin/del_question/(:num)', 'Admin::del_question/$1');
    $routes->get('/admin/reset_ques_url', 'Admin::reset_ques_url');

    $routes->get('/admin/exam_schedule', 'Admin::exam_schedule');
    $routes->match(['get','post'], '/admin/scheduleCU', 'Admin::add_edit_schedule');
    $routes->match(['get','post'], '/admin/scheduleCU/(:num)', 'Admin::add_edit_schedule/$1');
    $routes->match(['get','post'], '/admin/del_schedule/(:num)', 'Admin::del_schedule/$1');
    $routes->match(['get','post'], '/admin/view_schedule/(:num)', 'Admin::view_schedule/$1');
    $routes->match(['get','post'], '/admin/view_student_result_by_ajax', 'Admin::view_student_result_by_ajax');
    /*******************************Franchise Register Page******************************************** */
    $routes->match(['get','post'],'/admin/update_fr_register_page', 'Admin::update_fr_register_page');
    /*******************************InsManage**************************************************** */
    $routes->match(['get','post'],'/institute/batch', 'InsManageControllers::batch');
    $routes->match(['get','post'],'/institute/batch_cu', 'InsManageControllers::batch_cu');
    $routes->match(['get','post'],'/institute/batch_cu/(:num)', 'InsManageControllers::batch_cu/$1');
    $routes->match(['get','post'],'/institute/delete-batch/(:num)', 'InsManageControllers::delete_batch/$1');

    $routes->match(['get','post'],'/institute/students', 'InsManageControllers::students');
    $routes->match(['get','post'],'/institute/student_listing', 'InsManageControllers::student_listing');
    $routes->match(['get','post'],'/institute/search_reset', 'InsManageControllers::search_reset');
    $routes->match(['get','post'],'/institute/student_cu', 'InsManageControllers::student_cu');
    $routes->match(['get','post'],'/institute/student_cu/(:num)', 'InsManageControllers::student_cu/$1');
    $routes->match(['get','post'],'/institute/student_cu/(:num)/(:num)', 'InsManageControllers::student_cu/$1/$2');
    $routes->match(['get','post'],'/institute/get_course_details', 'InsManageControllers::get_course_details');
    $routes->match(['get','post'],'/institute/update_activetab', 'InsManageControllers::update_activetab');
    $routes->match(['get','post'],'/institute/student_view/(:num)', 'InsManageControllers::student_view/$1');
    $routes->match(['get','post'],'/institute/fee_deposite', 'InsManageControllers::fee_deposite');
    $routes->match(['get','post'],'/institute/resume_course/(:num)/(:num)', 'InsManageControllers::resume_course/$1/$2');
    $routes->match(['get','post'],'/institute/admission_cancelation_list', 'InsManageControllers::admission_cancelation_list');
    $routes->match(['get','post'],'/institute/cancel_admission/(:num)', 'InsManageControllers::cancel_admission/$1');
    $routes->match(['get','post'],'/institute/re_admission/(:num)', 'InsManageControllers::re_admission/$1');
    $routes->match(['get','post'],'/institute/cancel_admission_success', 'InsManageControllers::cancel_admission_success');
    $routes->match(['get','post'],'/institute/canceled_students_view/(:num)', 'InsManageControllers::canceled_students_view/$1');
    $routes->match(['get','post'],'/institute/payment_receipt', 'InsManageControllers::payment_receipt');
    $routes->match(['get','post'],'/institute/payment_receipt_listing', 'InsManageControllers::payment_receipt_listing');
    $routes->match(['get','post'],'/institute/reset_fee_collect_url', 'InsManageControllers::reset_fee_collect_url');
    $routes->match(['get','post'],'/institute/pending_amount', 'InsManageControllers::pending_amount');
    $routes->match(['get','post'],'/institute/pending_amount_listing', 'InsManageControllers::pending_amount_listing');
    $routes->match(['get','post'],'/institute/payment_report_export', 'InsManageControllers::payment_report_export');
    $routes->match(['get','post'],'/institute/reset_stu_pay_url', 'InsManageControllers::reset_stu_pay_url');
    $routes->match(['get','post'],'/institute/installment_payment/(:num)', 'InsManageControllers::installment_payment/$1');
    $routes->match(['get','post'],'/institute/whatsapp_mark_unmark/(:num)', 'InsManageControllers::whatsapp_mark_unmark/$1');
    $routes->match(['get','post'],'/institute/completed_students', 'InsManageControllers::completed_students');
    $routes->match(['get','post'],'/institute/marksheet_cu/(:num)', 'InsManageControllers::marksheet_cu/$1');
    $routes->match(['get','post'],'/institute/generate_certificate/', 'InsManageControllers::generate_certificate');
    $routes->match(['get','post'],'/institute/certified_students/', 'InsManageControllers::certified_students');
    $routes->match(['get','post'],'/institute/cancel_cert/(:num)', 'InsManageControllers::cancel_cert/$1');
    $routes->match(['get','post'],'/institute/student-i-card/(:any)', 'InsManageControllers::student_i_card/$1');
    $routes->match(['get','post'],'/institute/universityinfo_cu/(:num)', 'InsManageControllers::universityinfo_cu/$1');
    $routes->match(['get','post'],'/institute/update_uni_ajax', 'InsManageControllers::update_uni_ajax');
    
    
    $routes->match(['get','post'],'/testcbcert', 'InsManageControllers::testcbcert');
    $routes->match(['get','post'],'/testcbmarksheet', 'InsManageControllers::testcbmarksheet');
    $routes->match(['get','post'],'/testtypecert', 'InsManageControllers::testtypecert');

    /***************************************EndInsManage***************************************** */

    $routes->match(['get','post'],'/admin/delete_image/(:any)', 'Admin::delete_image/$1');

});
$routes->group('', ['filter' => 'AlreadyLoggedIn'], function ($routes) {
    //Add all routes need protected after logged in
    $routes->match(['get', 'post'], '/pineapple', 'Auth::login');
});
$routes->group('', ['filter' => 'NoAccessFilter'], function ($routes) {
    //Add all routes need protected from Direct Access
    $routes->get('/auth/login', 'Auth::login');
    $routes->get('/auth/logout', 'Auth::logout');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
