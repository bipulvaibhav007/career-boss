    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('admin'); ?>">
        <div class="sidebar-brand-icon">
          <img src="">
        </div>
        <div class="sidebar-brand-text mx-3">Career-Boss</div>
      </a>
      <hr class="sidebar-divider my-0">
      <?php 
        $request = \Config\Services::request();
        $uri = $request->getUri();
        $segment1 = $uri->getSegment(1);
        $segment2 = $uri->getSegment(2);
        if($segment1 == 'authentication-failed'){
          helper('custom');
        }
        $adminmodel = model('App\Models\Admin_model', false);
      ?>
      <li class="nav-item ">
        <a class="nav-link" href="<?=base_url('admin'); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <?php  if(is_privilege(18) || is_privilege(23) || is_privilege(24) || is_privilege(25) || is_privilege(26)){
        $collapsed = 'collapsed'; $show = '';
        if($segment2 == 'referral' || $segment2 == 'referral_view' || $segment2 == 'franchise' || $segment2 == 'franchise_view' || $segment2 == 'add_edit_franchise_student' || $segment2 == 'grade_update' || $segment2 == 'question_listing' || $segment2 == 'add_edit_question' || $segment2 == 'exam_schedule' || $segment2 == 'scheduleCU' || $segment2 == 'view_schedule' || $segment2 == 'view_stuuniversityinfo' || $segment2 == 'add_edit_universityinfo'){
          $collapsed = ''; $show = 'show';
        }
      ?>
      
      <li class="nav-item">
        <a class="nav-link <?=$collapsed?>" href="#" data-toggle="collapse" data-target="#Examination" aria-expanded="true"
          aria-controls="Examination">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Referral/ Franchise</span>
        </a>
        <div id="Examination" class="collapse <?=$show?>" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Users</h6> -->
            <?php if(is_privilege(18)){ 
              $t_new = $adminmodel->getTotalNewReferralStudent();  
            ?>
            <a class="collapse-item <?=($segment2=='referral' || $segment2 == 'referral_view')?'active':''?>" href="<?=base_url('admin/referral')?>">Referral <span class="badge badge-primary"><?=$t_new?></span></a>
            <?php } ?>
            <?php if(is_privilege(23)){ ?>
            <a class="collapse-item <?=($segment2=='franchise' || $segment2 == 'franchise_view' || $segment2 == 'add_edit_franchise_student' || $segment2 == 'view_stuuniversityinfo' || $segment2 == 'add_edit_universityinfo')?'active':''?>" href="<?=base_url('admin/franchise')?>">Franchise </a>
            <?php } ?>
            <?php if(is_privilege(24)){ ?>
            <a class="collapse-item <?=($segment2=='grade_update')?'active':''?>" href="<?=base_url('admin/grade_update')?>">Grade </a>
            <?php } ?>
            
            <?php if(is_privilege(26)){ ?>
            <a class="collapse-item <?=($segment2=='question_listing' || $segment2 == 'add_edit_question')?'active':''?>" href="<?=base_url('admin/question_bank')?>">Question Bank</a>
            <a class="collapse-item <?=($segment2=='exam_schedule' || $segment2 == 'scheduleCU' || $segment2 == 'view_schedule')?'active':''?>" href="<?=base_url('admin/exam_schedule')?>">Examination Schedule</a>
            <?php } ?>
            
          </div>
        </div>
      </li>
      <?php }  ?>

      <?php if(is_privilege(25) || is_privilege(28) || is_privilege(30) || is_privilege(31) || is_privilege(32) || is_privilege(33)){
        $collapsed = 'collapsed'; $show = '';
        if($segment2=='course_modules' || $segment2=='course_cu' || $segment2=='modules' || $segment2 == 'batch' || $segment2 == 'batch_cu' || $segment2 == 'students' || $segment2 == 'student_listing' || $segment2 == 'student_cu' || $segment2 == 'student_view' || $segment2 == 'admission_cancelation_list' || $segment2 == 'canceled_students_view' || $segment2 == 'payment_receipt' || $segment2 == 'payment_receipt_listing' || $segment2=='pending_amount_listing' || $segment2=='completed_students' || $segment2 == 'marksheet_cu' || $segment2=='certified_students' || $segment2=='student-i-card' || $segment2=='universityinfo_cu'){
          $collapsed = ''; $show = 'show';
        }
      ?>
      <!-- <hr class="sidebar-divider"> --> 
      <!-- <div class="sidebar-heading">
        Authentication
      </div> -->
      
      <li class="nav-item">
        <a class="nav-link <?=$collapsed?>" href="#" data-toggle="collapse" data-target="#InsManage" aria-expanded="true"
          aria-controls="Users">
          <i class="fa fa-institution"></i>
          <span>Institute Management</span>
        </a>
        <div id="InsManage" class="collapse <?=$show?>" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Users</h6> -->
            <?php if(is_privilege(28)){ ?>
            <a class="collapse-item <?=($segment2=='batch' || $segment2=='batch_cu')?'active':''?>" href="<?=base_url('/institute/batch')?>">Batch</a>
            <?php } ?>
            <?php if(is_privilege(25)){ ?>
            <a class="collapse-item <?=($segment2=='course_modules' || $segment2=='course_cu' || $segment2=='modules')?'active':''?>" href="<?=base_url('admin/course_modules')?>">Course & Modules </a>
            <?php } ?>
            <?php if(is_privilege(29)){ ?>
            <a class="collapse-item <?=($segment2=='students' || $segment2=='student_listing' || $segment2=='student_cu' || $segment2=='student_view' || $segment2 == 'admission_cancelation_list' || $segment2 == 'canceled_students_view' || $segment2 == 'student-i-card')?'active':''?>" href="<?=base_url('institute/students')?>">Students</a>
            <?php } ?>
            <?php if(is_privilege(30) ){ 
            $date = date('Y-m-1');
            $dateto = date('Y-m-d');
            $http_query = http_build_query(array('date'=>$date, 'dateto'=>$dateto));  
            ?>
            <a class="collapse-item <?=($segment2=='payment_receipt_listing')?'active':''?>" href="<?=base_url('/institute/payment_receipt?'.$http_query)?>">Payment Receipt</a>
            <?php } ?>
            <?php if(is_privilege(31)){ ?>
            <a class="collapse-item <?=($segment2=='pending_amount_listing' || $segment2=='pending_amount')?'active':''?>" href="<?=base_url('institute/pending_amount')?>">Pending Amount</a>
            <?php } ?>
            <hr class="sidebar-divider">
            <?php if(is_privilege(32)){ ?>
            <a class="collapse-item <?=($segment2=='completed_students' || $segment2 == 'marksheet_cu' || $segment2=='universityinfo_cu')?'active':''?>" href="<?=base_url('institute/completed_students')?>">Completed Students</a>
            <?php } ?>
            <?php if(is_privilege(33)){ ?>
            <a class="collapse-item <?=($segment2=='certified_students')?'active':''?>" href="<?=base_url('institute/certified_students')?>">Certified Students</a>
            <?php } ?>
          </div>
        </div>
      </li>
      <?php } ?>


      <?php if(is_privilege(19) || is_privilege(20) || is_privilege(21) || is_privilege(22)){ 
        $collapsed = 'collapsed'; $show = '';
        if($segment2 == 'contact' || $segment2 == 'broadcast' || $segment2 == 'live_chat' || $segment2 == 'chat_history'){
          $collapsed = ''; $show = 'show';
        }  
      ?>
        <li class="nav-item">
          <a class="nav-link <?=$collapsed?>" href="#" data-toggle="collapse" data-target="#whatsapp" aria-expanded="true" aria-controls="whatsapp">
            <i class="fab fa-whatsapp"></i>
            <span>Whatsapp (Only Design)</span>
          </a>
          <div id="whatsapp" class="collapse <?=$show?>" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <!-- <h6 class="collapse-header">Users</h6> -->
              <?php if(is_privilege(19)){ ?>
              <a class="collapse-item <?=($segment2=='contact')?'active':''?>" href="<?=base_url('admin/contact')?>">Contact Design (temp)</a>
              <?php } ?>
              <?php if(is_privilege(20)){ ?>
              <a class="collapse-item <?=($segment2=='broadcast')?'active':''?>" href="<?=base_url('admin/broadcast')?>">Broadcast</a>
              <?php } ?>
              <?php if(is_privilege(21)){ ?>
              <a class="collapse-item <?=($segment2=='live_chat')?'active':''?>" href="<?=base_url('admin/live_chat')?>">Live Chat</a>
              <?php } ?>
              <?php if(is_privilege(22)){ ?>
              <a class="collapse-item <?=($segment2=='chat_history' )?'active':''?>" href="<?=base_url('admin/chat_history')?>">Chat History</a>
              <?php } ?>
              
            </div>
          </div>
        </li>
      <?php } ?>


      <?php if(is_privilege(14) || is_privilege(15) || is_privilege(16) || is_privilege(17)){ 
        $collapsed = 'collapsed'; $show = '';
        if($segment2 == 'contact_us_listing' || $segment2 == 'subscriber' || $segment2 == 'enquiry_list' || $segment2 == 'enquiry_cu' || $segment2 == 'enquiry_view' || $segment2 == 'whatsapp_replied' || $segment2 == 'readWhatsAppMessage'){
          $collapsed = ''; $show = 'show';
        }  
      ?>
        <li class="nav-item">
          <a class="nav-link <?=$collapsed?>" href="#" data-toggle="collapse" data-target="#data" aria-expanded="true" aria-controls="basicelement">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Data</span>
          </a>
          <div id="data" class="collapse <?=$show?>" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <!-- <h6 class="collapse-header">Users</h6> -->
              <?php if(is_privilege(14)){ ?>
              <a class="collapse-item <?=($segment2=='contact_us_listing')?'active':''?>" href="<?=base_url('admin/contact-us')?>">Contact-us</a>
              <?php } ?>
              <?php if(is_privilege(15)){ ?>
              <a class="collapse-item <?=($segment2=='subscriber')?'active':''?>" href="<?=base_url('admin/subscriber')?>">Subscriber</a>
              <?php } ?>
              <?php if(is_privilege(16)){ ?>
              <a class="collapse-item <?=($segment2=='enquiry_list' || $segment2 == 'enquiry_cu' || $segment2 == 'enquiry_view')?'active':''?>" href="<?=base_url('admin/enquiry?status=1')?>">Contact</a>
              <?php } ?>
              <?php if(is_privilege(17)){ 
                $countNewMessage = $adminmodel->getCountAllUnreadMessage();
              ?>
              <a class="collapse-item <?=($segment2=='whatsapp_replied' || $segment2=='readWhatsAppMessage')?'active':''?>" href="<?=base_url('admin/whatsapp_replied?status=unread')?>">Whatsapp Replied <span class="badge badge-primary"><?=$countNewMessage?></span></a>
              <?php } ?>
              
            </div>
          </div>
        </li>
      <?php } ?>

      <?php if(is_privilege(7) || is_privilege(8) || is_privilege(9) || is_privilege(10) || is_privilege(11) || is_privilege(12) || is_privilege(13)){
        $collapsed = 'collapsed'; $show = '';
        if($segment2 == 'cms' || $segment2 == 'add_edit_cms' || $segment2 == 'blogs' || $segment2 == 'add_edit_blog' || $segment2 == 'blog_faq' || $segment2 == 'faq' || $segment2 == 'add_edit_faq' || $segment2 == 'testimonial' || $segment2 == 'add_edit_testimonial' || $segment2 == 'banner' || $segment2 == 'add_edit_banner' || $segment2 == 'courses' || $segment2 == 'add_edit_course' || $segment2 == 'experts' || $segment2 == 'experts_cu' || $segment2 == 'update_fr_register_page'){
          $collapsed = ''; $show = 'show';
        }
      ?>
      <!-- <hr class="sidebar-divider"> -->
      <!-- <div class="sidebar-heading">
        Basic Element
      </div> -->
      <li class="nav-item">
        <a class="nav-link <?=$collapsed?>" href="#" data-toggle="collapse" data-target="#basicelement" aria-expanded="true" aria-controls="basicelement">
          <i class="fas fa-fw fa-palette"></i>
          <span>Appearance</span>
        </a>
        <div id="basicelement" class="collapse <?=$show?>" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Users</h6> -->
            <?php if(is_privilege(7)){ ?>
            <a class="collapse-item <?=($segment2=='cms' || $segment2 == 'add_edit_cms')?'active':''?>" href="<?=base_url('admin/cms')?>">CMS</a>
            <?php } ?>
            <?php if(is_privilege(8)){ ?>
            <a class="collapse-item <?=($segment2=='blogs' || $segment2=='add_edit_blog' || $segment2=='blog_faq')?'active':''?>" href="<?=base_url('admin/blogs')?>">Blogs</a>
            <?php } ?>
            <?php if(is_privilege(9)){ ?>
            <a class="collapse-item <?=($segment2=='faq' || $segment2 == 'add_edit_faq')?'active':''?>" href="<?=base_url('admin/faq')?>">Faq</a>
            <?php } ?>
            <?php if(is_privilege(10)){ ?>
            <a class="collapse-item <?=($segment2=='testimonial' || $segment2=='add_edit_testimonial')?'active':''?>" href="<?=base_url('admin/testimonial')?>">Testimonial</a>
            <?php } ?>
            <?php if(is_privilege(11)){ ?>
            <a class="collapse-item <?=($segment2=='banner' || $segment2=='add_edit_banner')?'active':''?>" href="<?=base_url('admin/banner')?>">Manage Banner</a>
            <?php } ?>
            <?php if(is_privilege(12)){ ?>
            <a class="collapse-item <?=($segment2=='courses' || $segment2=='add_edit_course')?'active':''?>" href="<?=base_url('admin/courses')?>">Courses</a>
            <?php } ?>
            <?php if(is_privilege(13)){ ?>
            <a class="collapse-item <?=($segment2=='experts' || $segment2=='experts_cu')?'active':''?>" href="<?=base_url('admin/experts')?>">Experts</a>
            <?php } ?>
            <?php if(is_privilege(34)){ ?>
            <a class="collapse-item <?=($segment2=='update_fr_register_page')?'active':''?>" href="<?=base_url('admin/update_fr_register_page')?>">Franchise Register Page</a>
            <?php } ?>
          </div>
        </div>
      </li>
      <?php } ?>
      
      <?php /*if(is_privilege(11)){
        $active = ''; 
        if($segment2 == 'banner'){
          $active = 'active'; 
        }
      ?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Manage Banner
      </div>
      <li class="nav-item <?=$active?>">
        <a class="nav-link" href="<?=base_url('admin/banner')?>">
          <i class="fa fa-cog"></i>
          <span>Banner</span>
        </a>
      </li>
      <?php } */?>

      <?php if(is_privilege(1) || is_privilege(2) || is_privilege(6)){
        $collapsed = 'collapsed'; $show = '';
        if($segment2 == 'users' || $segment2 == 'user_groups' || $segment2 == 'setting'){
          $collapsed = ''; $show = 'show';
        }
      ?>
      <!-- <hr class="sidebar-divider"> -->
      <!-- <div class="sidebar-heading">
        Authentication
      </div> -->
      <li class="nav-item">
        <a class="nav-link <?=$collapsed?>" href="#" data-toggle="collapse" data-target="#Users" aria-expanded="true"
          aria-controls="Users">
          <i class="fa fa-cog"></i>
          <span>Authentication</span>
        </a>
        <div id="Users" class="collapse <?=$show?>" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Users</h6> -->
            <?php if(is_privilege(1)){ ?>
            <a class="collapse-item <?=($segment2=='users')?'active':''?>" href="<?=base_url('admin/users')?>">Users</a>
            <?php } ?>
            <?php if(is_privilege(2)){ ?>
            <a class="collapse-item <?=($segment2=='user_groups')?'active':''?>" href="<?=base_url('admin/user_groups')?>">User Groups</a>
            <?php } ?>
            <?php if(is_privilege(6)){ ?>
            <a class="collapse-item <?=($segment2=='setting')?'active':''?>" href="<?=base_url('admin/setting')?>">Setting</a>
            <?php } ?>
          </div>
        </div>
      </li>
      <?php } ?>

      <?php /*if(is_privilege(6)){
        $active = ''; 
        if($segment2 == 'setting'){
          $active = 'active'; 
        }
      ?>
      <li class="nav-item <?=$active?>">
        <a class="nav-link" href="<?=base_url('admin/setting')?>">
          <i class="fa fa-cog"></i>
          <span>Setting</span>
        </a>
      </li>
      <?php }*/ ?>

      <?php /*if(is_privilege(100)){ ?>
      <li class="nav-item">
        <a class="nav-link" href="ui-colors.html">
          <i class="fas fa-fw fa-palette"></i>
          <span>UI Colors</span>
        </a>
      </li>
      <?php }*/ ?>
    </ul>
    <!-- Sidebar -->
