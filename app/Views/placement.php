
    <?php 
    $url = '';
    if(isset($banner) && $banner->brochure != ''){
        $url = base_url('public/assets/upload/images/'.$banner->brochure);
    } ?>
    <section class="banner cms-banner position-relative bg-img d-flex  align-items-center"
        style="background-image: url(<?=$url?>);" alt="<?=$banner->img_alt; ?>" title="<?=$banner->img_title; ?>">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner-content">
                        <h1 class="khand lt-space text-uppercase"><?=(isset($banner->main_title))?$banner->main_title:''?></h1>
                        <p class="lt-space"><?=(isset($banner->sub_title))?$banner->sub_title:''?></p>
                        <a href="#start-hiring-now" class="link-btn khand text-uppercase lt-space">Start hiring Now<span><img class="hvr-icon" src="<?=base_url('public/assets/images/icons/right-arrow.png')?>" alt="right-arrow.png" title="right-arrow.png"></span> </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- <figure>
                        <a href="#" style="width:100%" onclick="openModal();currentSlide(5)"
                            class="hover-shadow cursor">
                            <img src="images/Wev-dev-hero-image.png" alt="">
                        </a>
                    </figure> -->
                </div>
            </div>
        </div>
    </section>

    <section class="expert-learning panel-space py-md-5">
        <div class="container">
            <div class="panel-heding mb-4">
                <h3 class="text-black text-center">Companies <span class="text-red">Hiring Our Graduates</span> </h3>
            </div>
            <p class="text-center">Our accomplished students have attained positions at top-tier technology firms, showcasing the effectiveness of our 
                training tailored to the industry and the unwavering support of our mentors. Enroll with us and embark on your career journey with assurance 
                and proficiency.</p>
        </div>

        <div class="brand-logo-slider">
            <div class="item">
                <div class="figure">
                    <img src="<?=base_url('public/assets/images/logo-black.png')?>" alt="logo-black.png" title="logo-black.png">
                </div>
            </div>
            <div class="item">
                <div class="figure">
                    <img src="<?=base_url('public/assets/images/accenture2.png')?>" alt="accenture2.png" title="logo-black.png">
                </div>
            </div>
            <div class="item">
                <div class="figure">
                    <img src="<?=base_url('public/assets/images/hcl2.png')?>" alt="hcl2.png" title="hcl2.png">
                </div>
            </div>
            <div class="item">
                <div class="figure">
                    <img src="<?=base_url('public/assets/images/algosoft2.png')?>" alt="algosoft2.png" title="algosoft2.png">
                </div>
            </div>
            <div class="item">
                <div class="figure">
                    <img src="<?=base_url('public/assets/images/tcs2.png')?>" alt="tcs2.png" title="tcs2.png">
                </div>
            </div>
            <div class="item">
                <div class="figure">
                    <img src="<?=base_url('public/assets/images/globalphotoedit2.png')?>" alt="globalphotoedit2.png" title="globalphotoedit2.png">
                </div>
            </div>
        </div>
    </section>

    <section class="panel-space hiring-boss">
        <div class="container">
            <div class="panel-heding mb-md-5 mb-4">
                <h3 class="text-black"> Why hire from <span class="text-red">Career</span> <span
                        class="text-blue">Boss?</span></h3>
            </div>
            <div class="row g-md-5 g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/hire1.png')?>" alt="hire1.png" title="hire1.png">
                        </figure>
                        <p class="mb-0">Hands-On Project Experience</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/hire2.png')?>" alt="hire2.png" title="hire2.png">
                        </figure>
                        <p class="mb-0">Diverse Talent <br> Pool</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/hire3.png')?>" alt="hire3.png" title="hire3.png">
                        </figure>
                        <p class="mb-0">Professionalism <br> and Integrity</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/hire4.png')?>" alt="hire4.png" title="hire4.png">
                        </figure>
                        <p class="mb-0">Teamwork and Collaboration</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/hire5.png')?>" alt="hire5.png" title="hire5.png">
                        </figure>
                        <p class="mb-0">Multitasking and <br> Time Management</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/hire6.png')?>" alt="hire6.png" title="hire6.png">
                        </figure>
                        <p class="mb-0">Effective <br> Communication</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-blue panel-space success-stories overflow-hidden">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="panel-heding mb-4">
                    <h3 class="text-white"> Inspiring stories of success from our learners </h3>
                    <p class="text-white">The Career Boss Institute has emerged as the ultimate destination for individuals aiming to achieve their 
                        utmost capabilities. Offering a spectrum of networking avenues and expert career counsel, our esteemed graduates enjoy unfettered 
                        access to the tools imperative for their triumph.</p>

                    <a href="#start-hiring-now" class="link-btn khand text-uppercase lt-space">Start hiring Now<span><img class="hvr-icon" src="<?=base_url('public/assets/images/icons/right-arrow.png')?>" alt="right-arrow.png" title="right-arrow.png"></span> </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="success-stories-slider">
                    <?php if(!empty($testimonial)){
                    foreach($testimonial as $list){ ?>
                    <div class="item">
                        <div class="success-stories-panel bg-white">
                            <div class="success-stories-blog">
                                <figure>
                                    <img src="<?=base_url('public/assets/upload/images/'.$list->logo)?>" alt="<?=$list->logo?>" title="<?=$list->logo?>">
                                </figure>
                            </div>
                            <div class="p-3">
                               <div class="testimonial-pera">
                                        <?=$list->description?>
                               </div>
                                <h6><?=$list->name?></h6>
                                <span class="text-red"><?=$list->post?></span>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                   

                </div>
            </div>
        </div>
    </section>

    <section class="asked-ques panel-space mobile-panel" id="faqs">
        <div class="container">
            <div class="panel-heding mb-4 mb-lg-5 text-center">
                <h3 class="text-black">Frequently Asked Question</h3>
            </div>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <?php if(!empty($faqs)){
                foreach($faqs as $key=>$list){ ?>
                
             

                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading<?=$key?>">
                        <button class="accordion-button <?=($key >= 1)?'collapsed':''?>" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse<?=$key?>" aria-expanded="false" aria-controls="flush-collapse<?=$key?>">
                            <h4><?=$list->faq_title?></h4>
                        </button>
                    </h2>
                    <div id="flush-collapse<?=$key?>" class="accordion-collapse collapse <?=($key < 1)?'show':''?>" aria-labelledby="flush-heading<?=$key?>"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body"><p class="mb-0 text-light-black"><?=$list->faq_description?></p></div>
                    </div>
                </div>
                <?php }} ?>
                
            </div>
        </div>
    </section>


    <section class="contact-panel panel-space" style="background-image: url(<?=base_url('public/assets/images/ready-to-connect.png')?>);" id="start-hiring-now" alt="ready-to-connect.png" title="ready-to-connect.png">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="get-in-tuch bg-white shadow-none">
                        <form action="" method="post" id="contact_us_form">
                            <h4 class="text-blue mb-3">Contact Form</h4>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="text" class="form-control" name="name" value="" placeholder="Full Name*" required>
                                <span class="text-danger" id="nameErr"></span>
                            </div>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="email" class="form-control" name="email" value="" placeholder="Email*" required>
                                <span class="text-danger" id="emailErr"></span>
                            </div>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="tel" class="form-control" name="phone" value="" placeholder="Phone No.*" required>
                                <span class="text-danger" id="phoneErr"></span>
                            </div>
                            <?php /* 
                            <div class="form-group mb-md-4 mb-3">
                                <input type="tel" class="form-control" placeholder="Company Name" required>
                            </div>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="tel" class="form-control" placeholder="Hiring Position">
                            </div>
                            */ ?>
                            <div class="form-group mb-md-4 mb-3">
                                <textarea class="textarea" name="message" id="message" rows="3" placeholder="Message"></textarea>
                            </div>
                            <input type="hidden" name="course_id" value="xx">
                            <input type="hidden" name="button_type" value="Placement Page">
                            <input type="hidden" name="token" id="token" value="">
                            <div class="text-center">
                                <a href="javascript:void(0)" class="link-btn text-uppercase lt-space blue-btn d-block" id="contact-submit-btn"> submit </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex">
                        <h3> Ready to <br>
                            connect?</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://www.google.com/recaptcha/api.js?render=<?=SITEKEY?>"></script>
    <script>
        grecaptcha.ready(function() {
          grecaptcha.execute('<?=SITEKEY?>', {action: 'submit'}).then(function(token) {
                var response = document.getElementById("token");
                response.value = token;
          });
        });
    </script>

