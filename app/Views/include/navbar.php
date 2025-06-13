    <?php $segment1 = service('uri')->getSegment(1); ?>
    <header class="header fixed-header <?=($segment1 == 'enquiry' || $segment1 == 'pratibhakhoj' || $segment1 == 'page-not-found' || $segment1 == 'image-editing-bootcamp' || $segment1 == 'html-coding-bootcamp' || $segment1 == 'bca-tuition-for-all-semester')?'enquiry':''?>">
        <div class="container-fluid px-md-5">
            <div class="d-flex align-items-center justify-content-between">
                <div class="logo-section">
                    <a class="navbar-brand" href="<?=base_url(); ?>">
                        <img class="d-lg-block" src="<?=base_url('public/assets/images/career-logo.png')?>" alt="" title="">
                    </a>
                </div>

                <div class="menu-bar">
                    <nav class="navbar navbar-expand-lg navbar-dark p-0" aria-label="Fifth navbar example">

                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <!-- <span class="navbar-toggler-icon"></span> -->
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample05">
                            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                                <li class="nav-item">
                                    <a class="nav-link <?=($segment1 == 'about-us')?'active':''?>" aria-current="page" href="<?=base_url('about-us')?>">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?=($segment1 == 'bca-tuition-for-all-semester')?'active':''?>" aria-current="page" href="<?=base_url('bca-tuition-for-all-semester')?>">BCA Tuition</a>
                                </li>
                                <li class="nav-item nav-dropdown">
                                    <a class="nav-link <?=($segment1 == 'course-detail')?'active':''?>" href="#">Courses <span><i class="fa-solid fa-angle-down"></i></span></a>
                                    <?php 
                                        $commonmodel = model('App\Models\Common_model', false);
                                        $courses = $commonmodel->getAllRecord('tbl_courses',['status'=>1]);
                                    ?>
                                    <div class="drop-down">
                                        <ul class="drop-down-list">
                                            
                                            <?php if(!empty($courses)){
                                                foreach($courses as $list){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('course-detail/'.$list->url)?>"><?=$list->course_full_name?></a>
                                            </li>
                                            <?php } } ?>
                                            <?php /* <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="#">Email Marketing & Sales</a>
                                            </li>
                                            
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="#">For Beginners</a>
                                            </li> */ ?>
                                        </ul>
                                    </div>
                                </li>
                                
                                <?php /* <li class="nav-item">
                                    <a class="nav-link <?=($segment1 == 'referrer')?'active':''?>" aria-current="page" href="<?=base_url('referrer')?>">Referrer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?=($segment1 == 'franchise')?'active':''?>" aria-current="page" href="<?=base_url('franchise')?>">Franchise</a>
                                </li> */ ?>
                                <li class="nav-item  nav-dropdown">
                                    <a class="nav-link <?=($segment1 == 'referrer' || $segment1 == '/referrer-register')?'active':''?>" aria-current="page" href="<?=base_url('referrer')?>">Referrer <span><i class="fa-solid fa-angle-down"></i></span></a>
                                    <div class="drop-down">
                                        <ul class="drop-down-list">
                                            <?php if(!session()->has('MemberIsLoggedIn') && !session()->has('StudentIsLoggedIn')){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/login')?>">Referal Login</a>
                                            </li>
                                            <?php }elseif(session()->has('MemberIsLoggedIn')){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/member-dashboard')?>">Dashboard</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/member-logout')?>">Logout</a>
                                            </li>
                                            <?php } ?>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/referrer-register')?>">Referrer Register</a>
                                            </li>
                                            <?php /* <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('franchise-verification')?>">Franchise Verification</a>
                                            </li> */ ?>
                                           
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item  nav-dropdown">
                                    <a class="nav-link <?=($segment1 == 'franchise' || $segment1 == 'franchise-verification')?'active':''?>" aria-current="page" href="<?=base_url('franchise')?>">Franchise <span><i class="fa-solid fa-angle-down"></i></span></a>
                                    <div class="drop-down">
                                        <ul class="drop-down-list">
                                            <?php if(!session()->has('MemberIsLoggedIn') && !session()->has('StudentIsLoggedIn')){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/login')?>">Franchise Login</a>
                                            </li>
                                            <?php }elseif(session()->has('MemberIsLoggedIn')){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/member-dashboard')?>">Dashboard</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/member-logout')?>">Logout</a>
                                            </li>
                                            <?php } ?>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('franchise')?>">Franchise Register</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('franchise-verification')?>">Franchise Verification</a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item  nav-dropdown">
                                    <a class="nav-link <?=($segment1 == 'student-verification' || $segment1 == 'result-verification' || $segment1 == 'certificate-verification')?'active':''?>" aria-current="page" href="#">Student <span><i class="fa-solid fa-angle-down"></i></span></a>
                                    <div class="drop-down">
                                        <ul class="drop-down-list">
                                            <?php if(!session()->has('MemberIsLoggedIn') && !session()->has('StudentIsLoggedIn')){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/student-login')?>">Student Login</a>
                                            </li>
                                            <?php }elseif(session()->has('StudentIsLoggedIn')){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/student-dashboard')?>">Dashboard</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/student-logout')?>">Logout</a>
                                            </li>
                                            <?php } ?>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('student-verification')?>">Student Verification</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('result-verification')?>">Result Verification</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('certificate-verification')?>">Certificate Verification</a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </li>
                                
                                <?php /* 
                                <li class="nav-item  nav-dropdown">
                                    <a class="nav-link <?=($segment1 == 'bootcamp')?'active':''?>" aria-current="page" href="#">Bootcamp <span><i class="fa-solid fa-angle-down"></i></span></a>
                                    <div class="drop-down">
                                        <ul class="drop-down-list">
                                           
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('image-editing-bootcamp')?>">Image Editing Bootcamp</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('html-coding-bootcamp')?>">HTML Coding Bootcamp</a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </li>
                                */ ?>
                                
                                <?php /*<li class="nav-item">
                                    <a class="nav-link" href="<?=base_url('career')?>">Career</a>
                                </li> 
                                <li class="nav-item">
                                    <a class="nav-link <?=($segment1 == 'placement')?'active':''?>" href="<?=base_url('/placement')?>">Placement</a>
                                </li>*/ ?>
                                <li class="nav-item">
                                    <a class="nav-link <?=($segment1 == 'blogs')?'active':''?>" href="<?=base_url('/blogs')?>">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?=($segment1 == 'contact')?'active':''?>" href="<?=base_url('contact')?>">Contact</a>
                                </li>
                                <?php /* if(session()->has('MemberIsLoggedIn')){ ?>
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link" aria-current="page" href="<?=base_url('/member-dashboard')?>">Dashboard</a>-->
                                <!--</li>-->
                                <!--<li class="nav-item  nav-dropdown">-->
                                <!--    <a class="nav-link <?=($segment1 == 'member-dashboard')?'active':''?>" aria-current="page" href="#">My Account <span><i class="fa-solid fa-angle-down"></i></span></a>-->
                                <!--    <div class="drop-down">-->
                                <!--        <ul class="drop-down-list">-->
                                <!--            <li class="nav-item">-->
                                <!--                <a class="nav-link" aria-current="page" href="<?=base_url('/member-dashboard')?>">Dashboard</a>-->
                                <!--            </li>-->
                                <!--        </ul>-->
                                <!--    </div>-->
                                <!--</li>-->
                                <?php }else{ ?>
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link" aria-current="page" href="<?=base_url('login')?>">Login</a>-->
                                <!--</li>-->
                                <!--<li class="nav-item  nav-dropdown">-->
                                <!--    <a class="nav-link <?=($segment1 == 'login')?'active':''?>" aria-current="page" href="#">Login <span><i class="fa-solid fa-angle-down"></i></span></a>-->
                                <!--    <div class="drop-down">-->
                                <!--        <ul class="drop-down-list">-->
                                <!--            <li class="nav-item">-->
                                <!--                <a class="nav-link" aria-current="page" href="<?=base_url('login')?>">Login</a>-->
                                <!--            </li>-->
                                <!--        </ul>-->
                                <!--    </div>-->
                                <!--</li>-->
                                <?php } */ ?>

                                <?php /* <li class="nav-item  nav-dropdown">
                                    <a class="nav-link <?=($segment1 == 'student-login' || $segment1 == 'student-dashboard' || $segment1 == 'member-dashboard')?'active':''?>" aria-current="page" href="#">Login <span><i class="fa-solid fa-angle-down"></i></span></a>
                                    <div class="drop-down">
                                        <ul class="drop-down-list">
                                            
                                            <?php if(session()->has('MemberIsLoggedIn') || session()->has('StudentIsLoggedIn')){ ?>
                                                <?php if(session()->has('MemberIsLoggedIn')){ ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="<?=base_url('/member-dashboard')?>">Dashboard</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="<?=base_url('/member-logout')?>">Logout</a>
                                                </li>
                                                <?php }elseif(session()->has('StudentIsLoggedIn')){ ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="<?=base_url('/student-dashboard')?>">Dashboard</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="<?=base_url('/student-logout')?>">Logout</a>
                                                </li>
                                                <?php } ?>
                                            <?php }else{ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/student-login')?>">Student Login</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/login')?>">Franchise Login</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?=base_url('/login')?>">Referal Login</a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </li> */ ?>
                            </ul>
                        </div>
                    </nav>
                </div>
                <?php if(session()->has('MemberIsLoggedIn')){ ?>
                    <a href="<?=base_url('/member-dashboard')?>" class="admission-btn common_enquiry">Welcome <?=ucwords(session('m_full_name'))?>
                        <span class="position-absolute top-100 start-50 translate-middle">Dashboard</span>
                    </a>
                <?php }else if(session()->has('StudentIsLoggedIn')){ ?>
                    <a href="<?=base_url('/student-dashboard')?>" class="admission-btn common_enquiry">Welcome <?=(session()->has('stu_name'))?ucwords(session('stu_name')):'Student'?>
                        <span class="position-absolute top-100 start-50 translate-middle">Dashboard</span>
                    </a>
                <?php }else{ ?>
                    <a href="<?=base_url('login')?>" class="admission-btn common_enquiry">Franchise 
                        <span class="position-absolute top-100 start-50 translate-middle">Login</span>
                    </a>
                        
                <?php } ?>
                
                <!--<a href="javascript:void(0);" class="admission-btn common_enquiry" data-type="Admission open | Header">Admission <span-->
                <!--        class="position-absolute top-100 start-50 translate-middle">open</span></a>-->
                        
                        
            </div>
        </div>
    </header>