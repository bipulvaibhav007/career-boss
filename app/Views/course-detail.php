
    <!-- <a href="#" class="enqure-now"><span><img src="<?=base_url('public/assets/images/icons/info.svg')?>" alt=""></span>Enquire Now</a> -->
    <script src="https://www.google.com/recaptcha/api.js?render=<?=SITEKEY?>"></script>
    <section class="banner video-cms-banner cms-banner position-relative bg-img d-flex  align-items-center"
        style="background-image: url(<?=base_url('public/assets/images/caree-detail-banner.jpg')?>);" title="caree-detail-banner.jpg">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-md-6">
                    <div class="banner-content">
                        <h1 class="khand lt-space text-uppercase"><?=strtoupper($cDtls->course_full_name)?></h1>
                        <p class="lt-space"><?=$cDtls->short_description?></p>
                        <a href="javascript:void(0);" class="link-btn khand text-uppercase lt-space get_a_call_back">Get a call back<span><img
                                    class="hvr-icon" src="<?=base_url('public/assets/images/icons/right-arrow.png')?>" alt=""></span> </a>
                        <a href="javascript:void(0);" class="link-btn blank-btn khand text-uppercase lt-space common_enquiry" data-type="Inquire Now | Course Detail Page" data-course_id="<?=$cDtls->course_id?>">Inquire now </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="px-4 py-4 bg-white rounded form-boxpanel ">
                        <h3 class="text-black mb-3">Have a <span class="text-red">question?</span> Contact us now!</h3>
                            <form action="<?=current_url(); ?>" method="post" id="">
                                <?=csrf_field(); ?>
                                <div class="form-group mb-md-4 mb-3">
                                    <!-- <label for="name">Name</label> -->
                                    <input type="text" class="form-control" name="name" value="<?=set_value('name')?>" placeholder="Full Name" required>
                                    <span class="text-danger" ><?=(isset($validation))?$validation->getError('name'):''?></span>
                                </div>
                                <div class="form-group mb-md-4 mb-3">
                                    <!-- <label for="email">Email</label> -->
                                    <input type="email" class="form-control" name="email" value="<?=set_value('email')?>" placeholder="Email" required>
                                    <span class="text-danger" ><?=(isset($validation))?$validation->getError('email'):''?></span>
                                </div>
                                <div class="form-group mb-md-4 mb-3">
                                    <!-- <label for="phone">Phone</label> -->
                                    <input type="tel" maxlength="10" class="form-control" name="phone" value="<?=set_value('phone')?>" placeholder="Phone" required>
                                    <span class="text-danger"><?=(isset($validation))?$validation->getError('phone'):''?></span>
                                </div>
                                <div class="form-group mb-md-4 mb-3">
                                    <!-- <label for="phone">Message</label> -->
                                    <textarea class="form-control" name="message" id="message" placeholder="Message"><?=set_value('message')?></textarea>
                                </div>
                                <input type="hidden" name="course_id" value="<?=$cDtls->course_id?>">
                                <input type="hidden" name="button_type" value="Enroll | Course Detail Page">
                                <input type="hidden" name="token" id="token" value="">
                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                <button type="submit" class="link-btn text-uppercase khand lt-space blue-btn d-block" >Enroll</button>
                            </form>
                    </div>
                    <?php /* <figure>
                        <?php if($youtube_vlink != ''){ ?>
                        <?php /* <a href="javascript:void(0);" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor"> *//* ?>
                            <img src="<?=base_url('public/assets/upload/images/'.$cDtls->youtube_vlink_image)?>" alt="">
                        <?php /* </a> */ ?>
                        <?php /* }else{ ?>
                            <img src="<?=base_url('public/assets/upload/images/'.$cDtls->youtube_vlink_image)?>" alt="">
                        <?php } */?>
                    <!-- </figure> -->
                </div>
            </div>
        </div>
    </section>

    <div class="industries-cnt py-3">
        <div class="container">
            <p class="m-0 text-center text-white">Enroll in the most in-demand course in the industry and unlock higher earning potential.</p>
        </div>
    </div>

    <section class="expert-learning panel-space py-md-5">
        <div class="container">
            <div class="panel-heding mb-4">
                <h3 class="text-black">
                    <?php if(isset($cDtls->custom_url) && $cDtls->custom_url != ''){ ?>
                        <a href="<?=$cDtls->custom_url?>"><span class="text-red"><?=$cDtls->course_full_name?></span></a> in Just <?=ucwords($cDtls->prg_duration_line1)?>
                    <?php }else{ ?>
                    <span class="text-red"><?=$cDtls->course_full_name?></span> in Just <?=ucwords($cDtls->prg_duration_line1)?>
                    <?php } ?>
                </h3>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="learning-box d-lg-flex">
                        <!-- <div class="flex-shrink-0 text-center">
                            <img src="images/icons/lurnign-1.png" alt="...">
                        </div> -->
                        <div class="flex-grow-1 ms-lg-3 text-center text-md-start">
                            <h5 class="lt-space">Next Batch Start:</h5>
                            <p class="mb-0 text-black"><span class="d-block"><?=ucfirst($cDtls->next_batch_line1)?></span>
                                <?=$cDtls->next_batch_line2?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="learning-box d-lg-flex">
                        <!-- <div class="flex-shrink-0 text-center">
                            <img src="images/icons/lurnign-2.png" alt="...">
                        </div> -->
                        <div class="flex-grow-1 ms-lg-3 text-center text-md-start">
                            <h5 class="lt-space">Program Duration:</h5>
                            <p class="mb-0 text-black"><span class="d-block"><?=ucwords($cDtls->prg_duration_line1)?></span>
                            <?=$cDtls->prg_duration_line2?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="learning-box d-lg-flex">
                        <!-- <div class="flex-shrink-0 text-center">
                            <img src="images/icons/lurnign-3.png" alt="...">
                        </div> -->
                        <div class="flex-grow-1 ms-lg-3 text-center text-md-start">
                            <h5 class="lt-space">Offline/Online Bootcamp:</h5>
                            <p class="mb-0 text-black"><span class="d-block"><?=ucfirst($cDtls->bootcamp_line1)?></span>
                            <?=$cDtls->bootcamp_line2?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="panel-space online-offline">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 d-flex flex-column">
                    <div class="online-offline-panel">
                        <h3 class="text-black text-center">Online</h3>
                        <?php if(isset($cDtls) && $cDtls->online != ''){
                            $onlineArr = json_decode($cDtls->online);
                            //print_r(explode(',',$syllabus[0]->syllabus));exit;
                        } ?>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/wifi.png')?>" alt="wifi.png" title="wifi.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="lt-space"><?=(isset($onlineArr[0]))?$onlineArr[0]->head:''; ?></h5>
                                <p class="mb-0 text-black"><?=(isset($onlineArr[0]))?sentenceCase($onlineArr[0]->dtls):''; ?></p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/play.png')?>" alt="play.png" title="play.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="lt-space"><?=(isset($onlineArr[1]))?$onlineArr[1]->head:''; ?></h5>
                                <p class="mb-0 text-black"><?=(isset($onlineArr[1]))?sentenceCase($onlineArr[1]->dtls):''; ?></p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/support.png')?>" alt="support.png" title="support.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="lt-space"><?=(isset($onlineArr[2]))?$onlineArr[2]->head:''; ?></h5>
                                <p class="mb-0 text-black"><?=(isset($onlineArr[2]))?sentenceCase($onlineArr[2]->dtls):''; ?></p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/live-project.png')?>" alt="live-project.png" title="live-project.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="lt-space"><?=(isset($onlineArr[3]))?$onlineArr[3]->head:''; ?></h5>
                                <p class="mb-0 text-black"><?=(isset($onlineArr[3]))?sentenceCase($onlineArr[3]->dtls):''; ?></p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/monitor.png')?>" alt="monitor.png" title="monitor.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="lt-space"><?=(isset($onlineArr[4]))?$onlineArr[4]->head:''; ?></h5>
                                <p class="mb-0 text-black"><?=(isset($onlineArr[4]))?sentenceCase($onlineArr[4]->dtls):''; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php /* <a href="#" class="price-btn">Price ₹<?=$cDtls->online_course_price?></a> */ ?>
                </div>
                <div class="col-lg-6 d-flex flex-column">
                    <div class="online-offline-panel">
                        <h3 class="text-black text-center">Offline</h3>
                        <?php if(isset($cDtls) && $cDtls->ofline != ''){
                            $oflineArr = json_decode($cDtls->ofline);
                        } ?>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/peson.png')?>" alt="peson.png" title="peson.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="lt-space"><?=(isset($oflineArr[0]))?$oflineArr[0]->head:''; ?></h5>
                                <p class="mb-0 text-black"><?=(isset($oflineArr[0]))?sentenceCase($oflineArr[0]->dtls):''; ?></p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/time.png')?>" alt="time.png" title="time.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="lt-space"><?=(isset($oflineArr[1]))?$oflineArr[1]->head:''; ?></h5>
                                <p class="mb-0 text-black"><?=(isset($oflineArr[1]))?sentenceCase($oflineArr[1]->dtls):''; ?></p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/system.png')?>" alt="system.png" title="system.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="lt-space"><?=(isset($oflineArr[2]))?$oflineArr[2]->head:''; ?></h5>
                                <p class="mb-0 text-black"><?=(isset($oflineArr[2]))?sentenceCase($oflineArr[2]->dtls):''; ?></p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/group-project.png')?>" alt="group-project.png" title="group-project.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="lt-space"><?=(isset($oflineArr[3]))?$oflineArr[3]->head:''; ?></h5>
                                <p class="mb-0 text-black"><?=(isset($oflineArr[3]))?sentenceCase($oflineArr[3]->dtls):''; ?></p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/meeting.png')?>" alt="meeting.png" title="meeting.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="lt-space"><?=(isset($oflineArr[4]))?$oflineArr[4]->head:''; ?></h5>
                                <p class="mb-0 text-black"><?=(isset($oflineArr[4]))?sentenceCase($oflineArr[4]->dtls):''; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php /* <a href="#" class="price-btn">Price ₹<?=$cDtls->ofline_course_price?></a> */ ?>
                </div>
            </div>
        </div>
    </section>

    <section class="program-panel panel-space bg-blue">
        <div class="container">
            <div class="panel-heding mb-4">
                <h3 class="text-black text-white">About the Program</h3>
                <?php if(isset($cDtls) && $cDtls->about_program != ''){
                    $about_programArr = json_decode($cDtls->about_program);
                }
                ?>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 d-flex">
                    <div class="program-iner-panel bg-white">
                        <h4 class="text-gradient">
                            <?php if(isset($about_programArr[0]->about_title) && isset($about_programArr[0]->url) && $about_programArr[0]->url != ''){
                                echo '<a href="'.$about_programArr[0]->url.'">'.$about_programArr[0]->about_title.'</a>';
                             }else{
                                echo $about_programArr[0]->about_title;
                             } ?>
                        </h4>
                        <?php if(isset($about_programArr[0])){ ?>
                        <figure class="mb-0">
                            <img src="<?=base_url('public/assets/upload/images/'.$about_programArr[0]->about_img)?>" alt="<?=$about_programArr[0]->about_img?>" title="<?=$about_programArr[0]->about_img?>">
                        </figure>
                        <?php } ?>
                        <p><?=(isset($about_programArr[0]))?sentenceCase($about_programArr[0]->about_desc):''; ?></p>
                    </div>
                </div>
                <div class="col-lg-4 d-flex">
                    <div class="program-iner-panel bg-white">
                        <h4 class="text-gradient">
                        <?php if(isset($about_programArr[1]->about_title) && isset($about_programArr[1]->url) && $about_programArr[1]->url != ''){
                            echo '<a href="'.$about_programArr[1]->url.'">'.$about_programArr[1]->about_title.'</a>';
                            }else{
                            echo $about_programArr[1]->about_title;
                            } ?>
                        </h4>
                        <?php if(isset($about_programArr[1])){ ?>
                        <figure class="mb-0">
                            <img src="<?=base_url('public/assets/upload/images/'.$about_programArr[1]->about_img)?>" alt="<?=$about_programArr[1]->about_img?>" title="<?=$about_programArr[1]->about_img?>">
                        </figure>
                        <?php } ?>
                        <p><?=(isset($about_programArr[1]))?sentenceCase($about_programArr[1]->about_desc):''; ?></p>
                    </div>
                </div>
                <div class="col-lg-4 d-flex">
                    <div class="program-iner-panel bg-white">
                        <h4 class="text-gradient">
                        <?php if(isset($about_programArr[2]->about_title) && isset($about_programArr[2]->url) && $about_programArr[2]->url != ''){
                            echo '<a href="'.$about_programArr[2]->url.'">'.$about_programArr[2]->about_title.'</a>';
                            }else{
                            echo $about_programArr[2]->about_title;
                            } ?>
                        </h4>
                        <?php if(isset($about_programArr[2])){ ?>
                        <figure class="mb-0">
                            <img src="<?=base_url('public/assets/upload/images/'.$about_programArr[2]->about_img)?>" alt="<?=$about_programArr[2]->about_img?>" title="<?=$about_programArr[2]->about_img?>">
                        </figure>
                        <?php } ?>
                        <p><?=(isset($about_programArr[2]))?sentenceCase($about_programArr[2]->about_desc):''; ?></p>
                    </div>
                </div>
            </div>
            <div class="full-stack">
                <div class="panel-heding mb-md-5 mb-3">
                    <h4 class="text-black text-white"><?=$cDtls->course_full_name?> Overview</h4>
                    <p class="text-white"><?=$cDtls->description?></p>
                </div>
                <div class="panel-heding mb-4">
                    <h4 class="text-white text-white">Key Features</h4>
                    <?php if(isset($cDtls) && $cDtls->key_features != ''){
                        $key_featureArr = json_decode($cDtls->key_features);
                    }
                    ?>
                </div>
                <div class="row g-md-4">
                    <div class="col-md-6">
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/key-icon.png')?>" alt="key-icon.png" title="key-icon.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 text-white"><?=(isset($key_featureArr[0]))?$key_featureArr[0]:''; ?></p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/key-icon.png')?>" alt="key-icon.png" title="key-icon.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 text-white"><?=(isset($key_featureArr[1]))?$key_featureArr[1]:''; ?></p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/key-icon.png')?>" alt="key-icon.png" title="key-icon.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 text-white"><?=(isset($key_featureArr[2]))?$key_featureArr[2]:''; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/key-icon.png')?>" alt="key-icon.png" title="key-icon.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 text-white"><?=(isset($key_featureArr[3]))?$key_featureArr[3]:''; ?></p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/key-icon.png')?>" alt="key-icon.png" title="key-icon.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 text-white"><?=(isset($key_featureArr[4]))?$key_featureArr[4]:''; ?></p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?=base_url('public/assets/images/key-icon.png')?>" alt="key-icon.png" title="key-icon.png">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 text-white"><?=(isset($key_featureArr[5]))?$key_featureArr[5]:''; ?></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <section class="course-breakdown panel-space">
        <div class="container">
            <div class="panel-heding pb-4">
                <h4 class="text-white text-white">Course Breakdown</h4>
                <p class="text-white"><?=$cDtls->course_breakdown_desc?></p>
            </div>
            <div class="breakdown-row g-4">
                <div class="items">
                    <figure>
                        <img src="<?=base_url('public/assets/images/calendar.png')?>" alt="calendar.png" title="calendar.png">
                    </figure>
                    <p class="text-white text-center mb-0"><?=$cDtls->prg_duration_line1?></p>
                </div>
                <div class="items ">
                    <figure>
                        <!-- <img src="<?php //base_url('public/assets/images/people.png')?>" alt="people.png" title="people.png"> -->
                        <img src="<?= base_url('public/assets/images/internship1.png')?>" alt="internship.png" title="internship.png">
                        <!-- <i class="fas fa-user-graduate text-white" style="font-size:45px; width:45px;"></i> -->
                    </figure>
                    <p class="text-white text-center mb-0"><?=$cDtls->live_class?></p>
                </div>
                <div class="items">
                    <figure>
                        <img src="<?=base_url('public/assets/images/Project.png')?>" alt="Project.png" title="Project.png">
                    </figure>
                    <p class="text-white text-center mb-0"><?=$cDtls->real_project?></p>
                </div>
                <div class="items">
                    <figure>
                        <!-- <img src="<?php //base_url('public/assets/images/Specialisations.png')?>" alt="Specialisations.png" title="Specialisations.png"> -->
                        <img src="<?=base_url('public/assets/images/people.png')?>" alt="people.png" title="people.png">
                    </figure>
                    <p class="text-white text-center mb-0"><?=$cDtls->specializations?></p>
                </div>

            </div>
            <div class="accordion panel-space pb-0" id="accordionExample">
                <?php if(isset($cDtls) && $cDtls->course_intro != ''){
                    $course_intro = json_decode($cDtls->course_intro);
                }
                if(isset($course_intro) && !empty($course_intro)){ 
                foreach($course_intro as $key=>$list){ 
                ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?=$key?>">
                        <button class="accordion-button <?=($key >= 1)?'collapsed':'';?>" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse<?=$key?>" aria-expanded="<?=($key >= 1)?'false':'true';?>" aria-controls="collapse<?=$key?>">
                            <?=$list->module_name?>
                            <?php /* <span><img src="<?=base_url('public/assets/images/timer.png')?>" alt=""> <?=$list->module_duration?></span> */ ?>
                        </button>
                    </h2>
                    <div id="collapse<?=$key?>" class="accordion-collapse <?=($key < 1)?'collapse show':'collapse';?>" aria-labelledby="heading<?=$key?>"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="doteded-listing p-0 m-0">
                                <?php foreach(explode(',', rtrim($list->module_syllabus, ",")) as $li){ ?>
                                <li><span></span><?=ucwords(trim($li))?></li>
                                <?php } ?>
                                <!-- <li><span></span>Introduction to JavaScript</li>
                                <li><span></span>Building static web pages</li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } } ?>
                <!-- <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h4>Introduction to Web Development</h4>
                            <span><img src="<?=base_url('public/assets/images/timer.png')?>" alt=""> 3 weeks</span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           <p class="mb-0 text-light-black"> <strong>This is the second item's accordion body.</strong> It is hidden by default, until
                            the collapse plugin adds the appropriate classes that we use to style each element. These
                            classes control the overall appearance, as well as the showing and hiding via CSS
                            transitions. You can modify any of this with custom CSS or overriding our default variables.
                            It's also worth noting that just about any HTML can go within the
                            <code>.accordion-body</code>, though the transition does limit overflow.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <h4>Introduction to Web Development</h4>
                            <span><img src="<?=base_url('public/assets/images/timer.png')?>" alt=""> 4 weeks</span>
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="mb-0 text-light-black"> <strong>This is the second item's accordion body.</strong> It is hidden by default, until
                                the collapse plugin adds the appropriate classes that we use to style each element. These
                                classes control the overall appearance, as well as the showing and hiding via CSS
                                transitions. You can modify any of this with custom CSS or overriding our default variables.
                                It's also worth noting that just about any HTML can go within the
                                <code>.accordion-body</code>, though the transition does limit overflow.</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <section class="asked-ques panel-space">
        <div class="container">
            <div class="panel-heding mb-md-4 mb-lg-5 text-center">
                <h3 class="text-black">Frequently Asked Question</h3>
                <?php if(isset($cDtls) && $cDtls->faq != ''){
                    $faq = json_decode($cDtls->faq);
                } ?>
            </div>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <?php if(isset($faq) && !empty($faq)){
                foreach($faq as $key=>$list){ ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading<?=$key?>">
                        <button class="accordion-button <?=($key >= 1)?'collapsed':''?>" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse<?=$key?>" aria-expanded="false" aria-controls="flush-collapse<?=$key?>">
                            <?=$list->faq_title?>
                        </button>
                    </h2>
                    <div id="flush-collapse<?=$key?>" class="accordion-collapse <?=($key < 1)?'collapse show':'collapse'?>" aria-labelledby="flush-heading<?=$key?>"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body"><p class="mb-0 text-light-black"><?=ucfirst($list->faq_desc)?></p></div>
                    </div>
                </div>
                <?php } } ?>

                <!-- <div class="accordion-item">
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
                </div> -->
                <!-- <div class="accordion-item">
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
                </div> -->
            </div>
        </div>
    </section>

    <!-- reserve your seat section -->
    <?php echo view('reserve-seat'); ?>

    <?php /* <section class="help-us panel-space pb-0">
        <div class="container">
            <div class="bg-img help-us-panel" style="background-image: url(<?=base_url('public/assets/images/help-banner.jpg')?>);">
                <h3 class="lt-space">We help you to get placed <br> in the right job</h3>
                <p>Get benefits of Personalized career advancement services including <br> job search support by the
                    right management.</p>
                <a href="#" class="link-btn text-uppercase lt-space blue-btn">Reserve your seat</a>
            </div>
            <div class="text-center">
                <a href="#" class="placement lt-space">Our Placement Partners</a>
            </div>
            <div class="logo-slider">
                <div class="item d-flex align-items-center justify-content-center">
                    <figure class="mb-0">
                        <img src="<?=base_url('public/assets/images/accenture.png')?>" alt="">
                    </figure>
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <figure class="mb-0">
                        <img src="<?=base_url('public/assets/images/algosoft.png')?>" alt="">
                    </figure>
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <figure class="mb-0">
                        <img src="<?=base_url('public/assets/images/GPE.png')?>" alt="">
                    </figure>
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <figure class="mb-0">
                        <img src="<?=base_url('public/assets/images/hcl.png')?>" alt="">
                    </figure>
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <figure class="mb-0">
                        <img src="<?=base_url('public/assets/images/tata.png')?>" alt="">
                    </figure>
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <figure class="mb-0">
                        <img src="<?=base_url('public/assets/images/wps.png')?>" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </section> */ ?>

    <?php /* <section class="video-panel panel-space">
        <div class="container">
            <div class="d-md-flex align-items-center mb-4 mb-md-5">
                <div class="flex-shrink-0 pe-4 video-banenr">
                    <h4>Student Stories</h4>
                </div>
                <div class="flex-grow-1 ms-md-4">
                    <p class="mb-0"><?=$cDtls->stu_stories_desc?></p>
                </div>
            </div>
            <div class="student-slider mb-3 mb-md-4">
                <?php if(isset($cDtls) && $cDtls->stu_stories != ''){
                        $stu_stories = json_decode($cDtls->stu_stories);
                    }
                    if(isset($stu_stories) && !empty($stu_stories)){
                        if(isset($youtube_vlink) && $youtube_vlink != ''){
                            $key = 2;
                        }else{
                            $key = 1;
                        }
                        foreach($stu_stories as $list){
                            
                        ?>
                            <div class="item">
                                <figure>
                                    <?php $parts = parse_url($list->v_link);
                                    if(isset($parts['host']) && $parts['host'] == 'www.youtube.com'){ ?>
                                        <img src="<?=base_url('public/assets/upload/images/'.$list->photo)?>" style="width:100%" onclick="openModal();currentSlide(<?=$key?>)" class="hover-shadow cursor">
                                    <?php $key++; }else{ ?>
                                        <img src="<?=base_url('public/assets/upload/images/'.$list->photo)?>" style="width:100%" >
                                    <?php } ?>
                                </figure>
                            </div>
                    <?php } } */ ?>
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
                </div> */ ?>
            <?php /* </div>

            <div class="text-center">
                <a href="#" class="link-btn text-uppercase lt-space blue-btn">Listen More Stories</a>
            </div>
        </div>
    </section> */ ?>

<section class="mobile-panel">
        <div class="container bg-img" style="background-image: url(<?=base_url('public/assets/images/mobile-banner.jpg')?>);">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="lt-space mb-3">Catch up in App if you missed a class</h3>
                    <p>Get conneted with new updates and course content, Dicuss with your teachers on <br> query.</p>

                    <div class="offset-lg-2 app-panel">
                        <img class="scaner" src="<?=base_url('public/assets/images/career-boss-QR.png')?>" alt="career-boss-QR.png" title="career-boss-QR.png">
                        <span class="d-inline-block"><strong>OR</strong></span>
                       <a href="https://play.google.com/store/apps/details?id=com.careerbosApp" target="_blank"> <img src="<?=base_url('public/assets/images/app.png')?>" alt="app.png" title="app.png"></a>
                    </div>
                </div>
                <div class="col-md-4 d-none d-md-block text-center">
                    <figure>
                        <img src="<?=base_url('public/assets/images/career-app.png')?>" alt="career-app.png" title="career-app.png">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><?=$cDtls->course_full_name?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?=current_url();?>" method="post" id="contact_us_form">
                <div class="modal-body get-in-tuch">
                    <div class="form-group mb-md-4 mb-3">
                        <!-- <label for="name">Name</label> -->
                        <input type="text" class="form-control" name="name" value="" placeholder="Full Name" >
                        <span class="text-danger" id="nameErr"></span>
                    </div>
                    <div class="form-group mb-md-4 mb-3">
                        <!-- <label for="email">Email</label> -->
                        <input type="email" class="form-control" name="email" value="" placeholder="Email" >
                        <span class="text-danger" id="emailErr"></span>
                    </div>
                    <div class="form-group mb-md-4 mb-3">
                        <!-- <label for="phone">Phone</label> -->
                        <input type="number" class="form-control" name="phone" value="" placeholder="Phone" >
                        <span class="text-danger" id="phoneErr"></span>
                    </div>
                    <div class="form-group mb-md-4 mb-3">
                        <!-- <label for="phone">Message</label> -->
                        <textarea class="textarea" name="message" id="message" placeholder="Message"></textarea>
                    </div>
                    <input type="hidden" name="course_id" value="<?=$cDtls->course_id?>">
                    <input type="hidden" name="button_type" value="Get a Call Back | Course Detail Page">
                    <input type="hidden" name="token" id="token2" value="">
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="button" class="link-btn text-uppercase lt-space blue-btn d-block" id="contact-submit-btn">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php function sentenceCase($sentences){

        if($sentences != ''){
            $arr = array();
            foreach(explode('.', $sentences) as $sent){
                $arr[] = ucfirst(ltrim($sent));
            }
            $sentences = implode('. ', $arr);
        }
        return $sentences;
    } ?>
    <script>
        $(".get_a_call_back").click(function(){
            $('#nameErr').html('');
            $('#emailErr').html('');
            $('#phoneErr').html('');
            var frm = $('#contact_us_form');
            frm[0].reset();
            $('#staticBackdrop').modal( 'show');
        });
        grecaptcha.ready(function() {
          grecaptcha.execute('<?=SITEKEY?>', {action: 'submit'}).then(function(token) {
                var response = document.getElementById("token");
                response.value = token;
          });
        });
        grecaptcha.ready(function() {
          grecaptcha.execute('<?=SITEKEY?>', {action: 'submit'}).then(function(token) {
                var response = document.getElementById("token2");
                response.value = token;
          });
        });
    </script>

    