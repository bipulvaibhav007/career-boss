

    <div class="banner-slider-eee">
        <div class="item">
            <?php $url = (isset($banner->brochure) && $banner->brochure != '')?base_url('public/assets/upload/images/'.$banner->brochure):''; ?>

            <section class="banner homepage-banner position-relative bg-img d-flex align-items-center"
                style="background-image: url(<?=$url; ?>);"  title="<?=$banner->img_title; ?>">
                <div class="container-fluid px-md-5">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="banner-content">
                                <h1 class="khand lt-space text-uppercase"><?=(isset($banner->main_title))?$banner->main_title:''?></h1>
                                <p class="lt-space"><?=(isset($banner->sub_title))?$banner->sub_title:''?></p>
                                <?php if($banner->url != ''){ ?>
                                    <a href="<?=$banner->url; ?>" class="link-btn khand text-uppercase lt-space common_enquiry"><?=$banner->button_title?> <span><img class="hvr-icon" src="<?=base_url('public/assets/images/icons/right-arrow.png')?>" alt="right-arrow.png" title="right-arrow.png"></span> </a>
                                <?php }else{ ?>
                                <a href="javascript:void(0);" data-type="Register Now | Home Page" class="link-btn khand text-uppercase lt-space common_enquiry">Register Now <span><img class="hvr-icon" src="<?=base_url('public/assets/images/icons/right-arrow.png')?>" alt="right-arrow.png" title="right-arrow.png"></span> </a> 
                                <?php } ?>
                            </div>
                        </div>
                        <div class="banner-right-side">
                            <img class="w-100" src="<?=base_url('public/assets/images/banner-right-img.png')?>" alt="lurnign-1.png" title="lurnign-1.png">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <section class="expert-learning panel-space py-md-5">
        <div class="container">
            <div class="panel-heding mb-4">
                <h3 class="text-black">A whole new way of learning like never before!</h3>
            </div>
            <div class="row g-4">
                <div class="col-md-4 d-flex">
                    <div class="learning-box d-lg-flex">
                        <div class="flex-shrink-0 text-center">
                            <img src="<?=base_url('public/assets/images/icons/lurnign-1.png')?>" alt="lurnign-1.png" title="lurnign-1.png">
                        </div>
                        <div class="flex-grow-1 ms-lg-3 text-center text-md-start">
                            <h5 class="lt-space">Interactive Online Platform</h5>
                            <p class="mb-0 text-black">Explore an innovative online platform that redefines the learning experience. Our intuitive interface grants you access to captivating lessons, interactive quizzes, and educational videos anytime and from any location. Get Prepared to start an exciting learning journey from the comfort of your own home.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="learning-box d-lg-flex">
                        <div class="flex-shrink-0 text-center">
                            <img src="<?=base_url('public/assets/images/icons/lurnign-2.png')?>" alt="lurnign-2.png" title="lurnign-2.png">
                        </div>
                        <div class="flex-grow-1 ms-lg-3 text-center text-md-start">
                            <h5 class="lt-space">Expert-Led Masterclasses</h5>
                            <p class="mb-0 text-black">Gain firsthand wisdom from industry experts and esteemed scholars driven by their passion to impart knowledge. Engage in interactive masterclasses that offer unique insights and practical wisdom beyond the confines of textbooks. Connect with professionals in your field actively inquire and garner invaluable perspectives from those leading the way in their respective domains.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="learning-box d-lg-flex">
                        <div class="flex-shrink-0 text-center">
                            <img src="<?=base_url('public/assets/images/icons/lurnign-3.png')?>" alt="lurnign-3.png" title="lurnign-3.png">
                        </div>
                        <div class="flex-grow-1 ms-lg-3 text-center text-md-start">
                            <h5 class="lt-space">Personalized Learning Approach</h5>
                            <p class="mb-0 text-black">Express farewell to one-size-fits-all instruction. Our institute values your unique learning style and preferences. With personalized learning plans, you will receive tailored guidance and support. Ensuring you grasp concepts with ease and achieve your academic goals.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="panel-space" id="sec-2">
        <div class="container">
            <div class="panel-heding mb-4">
                <h3 class="text-black">Courses the Industry Wants Most</h3>
                <p>“Learn Industries demanded courses and get your job easily. Our experts guide you in building a project with hand-holding. You will be ready for the next level of job.” </p>
            </div>
            <div class="row row g-md-5 g-4">
                <?php if(!empty($courses)){
                foreach($courses as $list){ ?>
                <div class="col-lg-4 col-md-6">
                    <div class="industries-box">
                        <figure class="mb-0">
                            <img class="w-100" src="<?=base_url('public/assets/upload/images/'. $list->image)?>" alt="<?=$list->img_alt?>" title="<?=$list->img_title?>">
                        </figure>
                        <div class="py-4 text-center">
                            <a href="<?=base_url('course-detail/'.$list->url)?>" class="link-btn text-uppercase lt-space d-inline">View Course Content </a>
                        </div>
                        <a href="javascript:void(0)" class="contact-four d-flex align-items-center justify-content-center common_enquiry" data-type="Contact for new batch" data-course_id="<?=$list->course_id?>">
                            <figure class="mb-0 me-2">
                                <img src="<?=base_url('public/assets/images/icons/right-hand.png')?>" alt="">
                            </figure>

                            <p class="m-0 text-uppercase">Contact for new Batch</p>
                        </a>
                    </div>
                </div>
                <?php } } ?>
                <?php /* 
                <div class="col-lg-4 col-md-6">
                    <div class="industries-box">
                        <figure class="mb-0">
                            <img class="w-100" src="<?=base_url('public/assets/images/industries2.jpg')?>" alt="">
                        </figure>
                        <div class="py-4 text-center">
                            <a href="#" class="link-btn text-uppercase lt-space d-inline">View Course Content </a>
                        </div>
                        <a href="#" class="contact-four d-flex align-items-center justify-content-center">
                            <figure class="mb-0 me-2">
                                <img src="<?=base_url('public/assets/images/icons/right-hand.png')?>" alt="">
                            </figure>
                            <p class="m-0 text-uppercase">Contact for new Batch</p>

                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="industries-box">
                        <figure class="mb-0">
                            <img class="w-100" src="<?=base_url('public/assets/images/industries3.jpg')?>" alt="">
                        </figure>
                        <div class="py-4 text-center">
                            <a href="#" class="link-btn text-uppercase lt-space d-inline">View Course Content </a>
                        </div>
                        <a href="#" class="contact-four d-flex align-items-center justify-content-center">
                            <figure class="mb-0 me-2">
                                <img src="<?=base_url('public/assets/images/icons/right-hand.png')?>" alt="">
                            </figure>
                            <p class="m-0 text-uppercase">Contact for new Batch</p>

                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="industries-box">
                        <figure class="mb-0">
                            <img class="w-100" src="<?=base_url('public/assets/images/industries4.jpg')?>" alt="">
                        </figure>
                        <div class="py-4 text-center">
                            <a href="#" class="link-btn text-uppercase lt-space d-inline">View Course Content </a>
                        </div>
                        <a href="#" class="contact-four d-flex align-items-center justify-content-center">
                            <figure class="mb-0 me-2">
                                <img src="<?=base_url('public/assets/images/icons/right-hand.png')?>" alt="">
                            </figure>
                            <p class="m-0 text-uppercase">Contact for new Batch</p>

                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="industries-box">
                        <figure class="mb-0">
                            <img class="w-100" src="<?=base_url('public/assets/images/industries5.jpg')?>" alt="">
                        </figure>
                        <div class="py-4 text-center">
                            <a href="#" class="link-btn text-uppercase lt-space d-inline">View Course Content </a>
                        </div>
                        <a href="#" class="contact-four d-flex align-items-center justify-content-center">
                            <figure class="mb-0 me-2">
                                <img src="<?=base_url('public/assets/images/icons/right-hand.png')?>" alt="">
                            </figure>
                            <p class="m-0 text-uppercase">Contact for new Batch</p>

                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="industries-box">
                        <figure class="mb-0">
                            <img class="w-100" src="<?=base_url('public/assets/images/industries6.jpg')?>" alt="">
                        </figure>
                        <div class="py-4 text-center">
                            <a href="#" class="link-btn text-uppercase lt-space d-inline">View Course Content </a>
                        </div>
                        <a href="#" class="contact-four d-flex align-items-center justify-content-center">
                            <figure class="mb-0 me-2">
                                <img src="<?=base_url('public/assets/images/icons/right-hand.png')?>" alt="">
                            </figure>
                            <p class="m-0 text-uppercase">Contact for new Batch</p>

                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="industries-box">
                        <figure class="mb-0">
                            <img class="w-100" src="<?=base_url('public/assets/images/industries7.jpg')?>" alt="">
                        </figure>
                        <div class="py-4 text-center">
                            <a href="#" class="link-btn text-uppercase lt-space d-inline">View Course Content </a>
                        </div>
                        <a href="#" class="contact-four d-flex align-items-center justify-content-center">
                            <figure class="mb-0 me-2">
                                <img src="<?=base_url('public/assets/images/icons/right-hand.png')?>" alt="">
                            </figure>
                            <p class="m-0 text-uppercase">Contact for new Batch</p>

                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="industries-box">
                        <figure class="mb-0">
                            <img class="w-100" src="<?=base_url('public/assets/images/industries8.jpg')?>" alt="">
                        </figure>
                        <div class="py-4 text-center">
                            <a href="#" class="link-btn text-uppercase lt-space d-inline">View Course Content </a>
                        </div>
                        <a href="#" class="contact-four d-flex align-items-center justify-content-center">
                            <figure class="mb-0 me-2">
                                <img src="<?=base_url('public/assets/images/icons/right-hand.png')?>" alt="">
                            </figure>
                            <p class="m-0 text-uppercase">Contact for new Batch</p>

                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="industries-box">
                        <figure class="mb-0">
                            <img class="w-100" src="<?=base_url('public/assets/images/industries9.jpg')?>" alt="">
                        </figure>
                        <div class="py-4 text-center">
                            <a href="#" class="link-btn text-uppercase lt-space d-inline">View Course Content </a>
                        </div>
                        <a href="#" class="contact-four d-flex align-items-center justify-content-center">
                            <figure class="mb-0 me-2">
                                <img src="<?=base_url('public/assets/images/icons/right-hand.png')?>" alt="">
                            </figure>
                            <p class="m-0 text-uppercase">Contact for new Batch</p>

                        </a>
                    </div>
                </div>
                */ ?>
            </div>
        </div>
    </section>

    <section class="expert-learning-new panel-space py-md-5 contact-us-panel">
        <div class="container">
            <div class="row g-3 justify-content-center">
                <div class="col-md-3 text-center">
                    <figure>
                        <img src="<?php echo base_url(); ?>/public/assets/images/icons/Up-Gradation.png" 
                             alt="Up-Gradation of Courses" 
                             title="Up-Gradation of Courses">
                    </figure>
                    <h6>Up-Gradation of Courses</h6>
                </div>
                <div class="col-md-3 text-center">
                    <figure>
                        <img src="<?php echo base_url(); ?>/public/assets/images/icons/hundred-per.png" 
                             alt="100% Job Assistance" 
                             title="100% Job Assistance">
                    </figure>
                    <h6>100% Job Assistance</h6>
                </div>
                <div class="col-md-3 text-center">
                    <figure>
                        <img src="<?php echo base_url(); ?>/public/assets/images/icons/hundred-prac.png" 
                             alt="100% Practical Training" 
                             title="100% Practical Training">
                    </figure>
                    <h6>100% Practical Training</h6>
                </div>
                <div class="col-md-3 text-center">
                    <figure>
                        <img src="<?php echo base_url(); ?>/public/assets/images/icons/Small-Batches.png" 
                             alt="Small Batches for Personalised Attention" 
                             title="Small Batches for Personalised Attention">
                    </figure>
                    <h6>Small Batches for Personalised Attention</h6>
                </div>
            </div>
        </div>
    </section>

    <section class="asked-ques panel-space">
        <div class="container">
            <div class="panel-heding mb-md-4 mb-lg-5 text-center">
                <h3 class="text-black">Frequently Asked Question</h3>
                <?php /*if(isset($cDtls) && $cDtls->faq != ''){
                    $faq = json_decode($cDtls->faq);
                }*/ ?>
            </div>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <?php if(isset($faqs) && !empty($faqs)){
                foreach($faqs as $key=>$list){ ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading<?=$key?>">
                        <button class="accordion-button <?=($key >= 1)?'collapsed':''?>" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse<?=$key?>" aria-expanded="false" aria-controls="flush-collapse<?=$key?>">
                            <?=$list->faq_title?>
                        </button>
                    </h2>
                    <div id="flush-collapse<?=$key?>" class="accordion-collapse <?=($key < 1)?'collapse show':'collapse'?>" aria-labelledby="flush-heading<?=$key?>"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body"><p class="mb-0 text-light-black"><?=$list->faq_description?></p></div>
                    </div>
                </div>
                <?php } } ?>

                <?php /* <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            <h4>What technologies will I learn in the Full Stack course?</h4>
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <p class="mb-0 text-light-black">
                                Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion
                                body. Let's imagine this being filled with some actual content.
                            </p>
                            </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                            aria-controls="flush-collapseThree">
                            <h4>What kind of projects will I work on during the Full Stack course?</h4>
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <p class="mb-0 text-light-black">Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                                body. Nothing more exciting happening here in terms of content, but just filling up the
                                space to make it look, at least at first glance, a bit more representative of how this would
                                look in a real-world application.</p>
                        </div>
                    </div>
                </div> */ ?>
                
            </div>
        </div>
    </section>
    <!-- reserve your seat section -->
    <?php echo view('reserve-seat'); ?>

    <?php /* 
    <section class="video-panel panel-space" id="sec-4">
        <div class="container">
            <div class="d-md-flex align-items-center mb-4 mb-md-5">
                <div class="flex-shrink-0 pe-4 video-banenr">
                    <h4>Student Stories</h4>
                </div>
                <div class="flex-grow-1 ms-md-4">
                    <p class="mb-0">Learn Industries demanded courses and get your job easily. Our experts guide you in
                        building a project with hand holding. You will be
                        ready for the next lavel of job. </p>
                </div>
            </div>
            <div class="student-slider mb-3 mb-md-4">
                <?php if(!empty($testimonial)){
                foreach($testimonial as $key=>$list){ ?>
                
                <div class="item">
                    <figure>
                        <?php $parts = parse_url($list->youtube_vlink);
                        if(isset($parts['host']) && $parts['host'] == 'www.youtube.com'){ ?>
                            <img src="<?=base_url('public/assets/upload/images/'.$list->logo)?>" style="width:100%" onclick="openModal();currentSlide(<?=$key+1?>)" class="hover-shadow cursor">
                        <?php }else{ ?>
                            <img src="<?=base_url('public/assets/upload/images/'.$list->logo)?>" style="width:100%" >
                        <?php } ?>

                    </figure>
                </div>
                <?php } } ?>
                <?php /* <div class="item">
                    <figure>
                    <img src="<?=base_url('public/assets/images/stories2.jpg')?>" style="width:100%" onclick="openModal();currentSlide(2)"
                        class="hover-shadow cursor">
                        </figure>
                </div>
                <div class="item">
                    <figure>
                    <img src="<?=base_url('public/assets/images/stories3.jpg')?>" style="width:100%" onclick="openModal();currentSlide(3)"
                        class="hover-shadow cursor">
                        </figure>
                </div>
                <div class="item">
                    <figure>
                    <img src="<?=base_url('public/assets/images/stories4.jpg')?>" style="width:100%" onclick="openModal();currentSlide(4)"
                        class="hover-shadow cursor">
                        </figure>
                </div> */ /*
            
            </div>
            <?php if(count($testimonial) > 4){ ?>
            <div class="text-center">
                <a href="<?=base_url('listen-stories')?>" class="link-btn text-uppercase lt-space blue-btn">Listen More Stories</a>
            </div>
            <?php } ?>
        </div>
    </section> */ ?>

<section class="mobile-panel">
        <div class="container bg-img" style="background-image: url(<?=base_url('public/assets/images/mobile-banner.webp')?>);">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="lt-space mb-3">Catch up in App if you missed a class</h3>
                    <p>Get conneted with new updates and course content, Dicuss with your teachers on <br> query.</p>

                    <div class="offset-lg-2 app-panel">
                        <img class="scaner" src="<?=base_url('public/assets/images/career-boss-QR.png')?>" alt="carrer-qrcode" title="carrer-qrcode">
                        <span class="d-inline-block"><strong>OR</strong></span>
                       <a href="https://play.google.com/store/apps/details?id=com.careerbosApp" target="_blank"> <img src="<?=base_url('public/assets/images/app.png')?>" alt="carrer-app" title="career-app"></a>
                    </div>
                </div>
                <div class="col-md-4 d-none d-md-block text-center">
                    <figure>
                        <img src="<?=base_url('public/assets/images/career-app-2.webp')?>"  alt="career-app" title="career-app">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    