    <?php 
    $url = '';
    if(isset($banner) && $banner->brochure != ''){
        $url = base_url('public/assets/upload/images/'.$banner->brochure);
    } ?>
    <section class="banner cms-banner position-relative bg-img d-flex  align-items-center"
        style="background-image: url(<?=$url?>);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner-content">
                        <h1 class="khand lt-space text-uppercase"><?=(isset($banner->main_title))?$banner->main_title:''?></h1>
                        <p class="lt-space"><?=(isset($banner->sub_title))?$banner->sub_title:''?></p>
                        <a href="<?=base_url('/contact')?>" class="link-btn khand text-uppercase lt-space">CONTACT US<span><img class="hvr-icon"
                                    src="<?=base_url('public/assets/images/icons/right-arrow.png')?>" alt=""></span> </a>
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
                        <?php /* <img src="<?=base_url('public/assets/upload/images/'.$list->logo)?>" style="width:100%" onclick="openModal();currentSlide(<?=$key+1?>)" class="hover-shadow cursor"> */ ?>
                    </figure>
                </div>
                <?php } } ?>
                
            </div>

            
        </div>
    </section>