
<script src="https://www.google.com/recaptcha/api.js?render=<?=SITEKEY?>"></script>
    <?php $url = '';
if (isset($banner->brochure)) {
    $url = base_url('public/assets/upload/images/' . $banner->brochure);
}?>
    <section class="banner cms-banner position-relative bg-img d-flex  align-items-center"
        style="background-image: url(<?=$url?>);"  title="<?=$banner->img_title;?>">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner-content contact-us">
                        <h1 class="khand lt-space text-uppercase"><?=(isset($banner->main_title)) ? $banner->main_title : ''?></h1>
                        <p class="lt-space"><?=(isset($banner->sub_title)) ? $banner->sub_title : ''?></p>
                        <a href="https://api.whatsapp.com/send?phone=918809408811" target="blank" class="link-btn khand text-uppercase lt-space"><span><img src="<?=base_url('public/assets/images/icons/whatsapp.png')?>" alt=""></span>Let’s Chat </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php
$commonmodel = model('App\Models\Common_model', false);
//$courses = $commonmodel->getAllRecord('tbl_courses',['status'=>1]);
$settings = $commonmodel->get_setting(1);
$tel1 = str_replace('-', '', $settings->phone);
$tel2 = str_replace('-', '', $settings->phone2);
?>
    <section class="expert-learning panel-space py-md-5 contact-us-panel">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-4 text-center">
                    <figure>
                        <img src="<?=base_url('public/assets/images/icons/mobile.png')?>" alt="mobile.png" title="mobile.png">
                    </figure>
                    <h6>Call (10:00 AM to 7:00 PM)</h6>
                    <p class="mb-0 text-blue"><a class="text-blue" href="tel:<?=$tel1?>"><?=$settings->phone?>,</a>
                        <a class="text-blue" href="tel:<?=$tel2?>"><?=$settings->phone2?></a>
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <figure>
                        <img src="<?=base_url('public/assets/images/icons/career-mail.png')?>" alt="career-mail.png" title="career-mail.png">
                    </figure>
                    <h6>Mail</h6>
                    <p class="mb-0"><a class="text-blue" href="mailto:info@careerboss.com"><?=$settings->email?></a></p>
                </div>
                <div class="col-md-4 text-center">
                    <figure>
                        <img src="<?=base_url('public/assets/images/icons/location.png')?>" alt="location.png" title="location.png">
                    </figure>
                    <h6>Address</h6>
                    <p class="mb-0 text-blue"><?=$settings->address?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="panel-space bg-img get-in-touch-panel" style="background-image: url(<?=base_url('public/assets/images/contact-form-bg.png')?>);"  title="contact-form-bg.png">
        <div class="container">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="get-in-tuch bg-white">
                        <form action="<?=base_url('home/save_contact_us')?>" method="post" class="" id="contact_us_form">
                                <?=csrf_field()?>
                            <h4 class="text-blue mb-3">Get In Touch</h4>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Full Name*" required>
                                <span class="text-danger" id="nameErr"></span>
                            </div>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email*" required>
                                <span class="text-danger" id="emailErr"></span>
                            </div>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="tel" class="form-control" name="phone" placeholder="Phone No.*" required>
                                <span class="text-danger" id="phoneErr"></span>
                            </div>
                            <div class="form-group mb-md-4 mb-3 select-box">
                                <select class="form-select" aria-label="Default select example" name="course_id">
                                    <option value="" selected>Course Interested </option>
                                    <?php if (!empty($courses)) {
                                        foreach ($courses as $list) {
                                            echo '<option value="' . $list->course_id . '">' . $list->course_full_name . '</option>';
                                        }
                                    }?>

                                </select>
                                <span class="text-danger" id="courseErr"></span>
                            </div>
                            <div class="form-group mb-md-4 mb-3">
                                <textarea class="textarea" name="message" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
                            </div>
                            <input type="hidden" name="token" id="token" value="">
                            <div class="text-center">
                                <a href="javascript:void(0)" id="contact-submit-btn" class="link-btn text-uppercase lt-space blue-btn d-block" > submit </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
       <div class="full-width-map">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14397.70203358118!2d84.6676385!3d25.5575066!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398d5f9896e8e6cf%3A0x6b29c5b7602bfeed!2sCareer%20Boss%20Institute!5e0!3m2!1sen!2sin!4v1733479164437!5m2!1sen!2sin"
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
    <script>
      
        grecaptcha.ready(function() {
          grecaptcha.execute('<?=SITEKEY?>', {action: 'submit'}).then(function(token) {
                var response = document.getElementById("token");
                response.value = token;
          });
        });
    </script>