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

      <?php if(is_privilege(18)){
        $active = ''; 
        if($segment2 == 'referral' || $segment2 == 'referral_view'){
          $active = 'active'; 
        }
      ?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Referral
      </div>
      <li class="nav-item <?=$active?>">
        <a class="nav-link" href="<?=base_url('admin/referral')?>">
          <i class="fa fa-cog"></i>
          <?php $t_new = $adminmodel->getTotalNewReferralStudent(); ?>
          <span>Referral <span class="badge badge-primary"><?=$t_new?></span></span>
        </a>
      </li>
      <?php } ?>
      
      <?php if(is_privilege(12)){
        $active = ''; 
        if($segment2 == 'courses'){
          $active = 'active'; 
        }
      ?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Course Management
      </div>
      <li class="nav-item <?=$active?>">
        <a class="nav-link" href="<?=base_url('admin/courses')?>">
          <i class="fa fa-cog"></i>
          <span>Courses</span>
        </a>
      </li>
      <?php } ?>

      <?php if(is_privilege(16) || is_privilege(19) || is_privilege(20) || is_privilege(21) || is_privilege(22)){ ?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Whatsapp
      </div>
      <?php if(is_privilege(16)){ ?>
      <li class="nav-item <?=($segment2 == 'enquiry_list' || $segment2 == 'enquiry_cu' || $segment2 == 'enquiry_view')?'active':''?>">
        <a class="nav-link" href="<?=base_url('admin/enquiry?status=1')?>">
          <i class="fa fa-cog"></i>
          <span>Contact</span>
        </a>
      </li>
      <?php } ?>
      <?php if(is_privilege(19)){ ?>
      <li class="nav-item <?=($segment2 == 'contact' || $segment2 == 'contact')?'active':''?>">
        <a class="nav-link" href="<?=base_url('admin/contact')?>">
          <i class="fa fa-cog"></i>
          <span>Contact Design (temp)</span>
        </a>
      </li>
      <?php } ?>
      <?php if(is_privilege(20)){ ?>
      <li class="nav-item <?=($segment2 == 'broadcast' || $segment2 == 'broadcast')?'active':''?>">
        <a class="nav-link" href="<?=base_url('admin/broadcast')?>">
          <i class="fa fa-cog"></i>
          <span>Broadcast</span>
        </a>
      </li>
      <?php } ?>
      <?php if(is_privilege(21)){ ?>
      <li class="nav-item <?=($segment2 == 'live_chat' || $segment2 == 'live_chat')?'active':''?>">
        <a class="nav-link" href="<?=base_url('admin/live_chat')?>">
          <i class="fa fa-cog"></i>
          <span>Live Chat</span>
        </a>
      </li>
      <?php } ?>
      <?php if(is_privilege(22)){ ?>
      <li class="nav-item <?=($segment2 == 'chat_history' || $segment2 == 'chat_history' || $segment2 == 'chat_history')?'active':''?>">
        <a class="nav-link" href="<?=base_url('admin/chat_history')?>">
          <i class="fa fa-cog"></i>
          <span>Chat History</span>
        </a>
      </li>
      <?php } ?>
      
      <?php } ?>

      <?php if(is_privilege(13) || is_privilege(14) || is_privilege(15) || is_privilege(17)){ //|| is_privilege(16)?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Institution Management
      </div>
      <?php if(is_privilege(13)){ ?>
      <li class="nav-item <?=($segment2 == 'experts' || $segment2 == 'experts_cu')?'active':''?>">
        <a class="nav-link" href="<?=base_url('admin/experts')?>">
          <i class="fa fa-cog"></i>
          <span>Experts</span>
        </a>
      </li>
      <?php } ?>
      <?php if(is_privilege(14)){ ?>
      <li class="nav-item <?=($segment2 == 'contact_us_listing' || $segment2 == 'contact_us_listing')?'active':''?>">
        <a class="nav-link" href="<?=base_url('admin/contact-us')?>">
          <i class="fa fa-cog"></i>
          <span>Contact-us</span>
        </a>
      </li>
      <?php } ?>
      <?php if(is_privilege(15)){ ?>
      <li class="nav-item <?=($segment2 == 'subscriber' || $segment2 == 'subscriber')?'active':''?>">
        <a class="nav-link" href="<?=base_url('admin/subscriber')?>">
          <i class="fa fa-cog"></i>
          <span>Subscriber</span>
        </a>
      </li>
      <?php } ?>
      <?php /*if(is_privilege(16)){ ?>
      <li class="nav-item <?=($segment2 == 'enquiry_list' || $segment2 == 'enquiry_cu' || $segment2 == 'enquiry_view')?'active':''?>">
        <a class="nav-link" href="<?=base_url('admin/enquiry?status=1')?>">
          <i class="fa fa-cog"></i>
          <span>Enquiry</span>
        </a>
      </li>
      <?php }*/ ?>
      <?php if(is_privilege(17)){ ?>
      <li class="nav-item <?=($segment2 == 'whatsapp_replied' || $segment2 == 'readWhatsAppMessage')?'active':''?>">
        <a class="nav-link" href="<?=base_url('admin/whatsapp_replied?status=unread')?>">
          <i class="fa fa-cog"></i>
          <?php $countNewMessage = $adminmodel->getCountAllUnreadMessage(); ?>
          <span>Whatsapp Replied <span class="badge badge-primary"><?=$countNewMessage?></span></span>
        </a>
      </li>
      <?php } ?>
      <?php } ?>

      <?php if(is_privilege(7) || is_privilege(8) || is_privilege(9) || is_privilege(10)){
        $collapsed = 'collapsed'; $show = '';
        if($segment2 == 'cms' || $segment2 == 'add_edit_cms' || $segment2 == 'blogs' || $segment2 == 'add_edit_blog' || $segment2 == 'blog_faq' || $segment2 == 'faq' || $segment2 == 'add_edit_faq' || $segment2 == 'testimonial' || $segment2 == 'add_edit_testimonial'){
          $collapsed = ''; $show = 'show';
        }
      ?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Basic Element
      </div>
      <li class="nav-item">
        <a class="nav-link <?=$collapsed?>" href="#" data-toggle="collapse" data-target="#basicelement" aria-expanded="true" aria-controls="basicelement">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Basic Element</span>
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
          </div>
        </div>
      </li>
      <?php } ?>
      
      <?php if(is_privilege(11)){
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
      <?php } ?>

      <?php if(is_privilege(1) || is_privilege(2)){
        $collapsed = 'collapsed'; $show = '';
        if($segment2 == 'users' || $segment2 == 'user_groups'){
          $collapsed = ''; $show = 'show';
        }
      ?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Authentication
      </div>
      <li class="nav-item">
        <a class="nav-link <?=$collapsed?>" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
          aria-controls="collapseForm">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Users</span>
        </a>
        <div id="collapseForm" class="collapse <?=$show?>" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Users</h6> -->
            <?php if(is_privilege(1)){ ?>
            <a class="collapse-item <?=($segment2=='users')?'active':''?>" href="<?=base_url('admin/users')?>">Users</a>
            <?php } ?>
            <?php if(is_privilege(2)){ ?>
            <a class="collapse-item <?=($segment2=='user_groups')?'active':''?>" href="<?=base_url('admin/user_groups')?>">User Groups</a>
            <?php } ?>
          </div>
        </div>
      </li>
      <?php } ?>

      <?php if(is_privilege(6)){
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
      <?php } ?>

      <?php if(is_privilege(100)){ ?>
      <li class="nav-item">
        <a class="nav-link" href="ui-colors.html">
          <i class="fas fa-fw fa-palette"></i>
          <span>UI Colors</span>
        </a>
      </li>
      <?php } ?>
    </ul>
    <!-- Sidebar -->
