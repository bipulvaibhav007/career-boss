    <script src="https://www.google.com/recaptcha/api.js?render=<?=SITEKEY?>"></script>
    <section class="panel-space bg-img get-in-touch-panel enq-panel" style="background-image: url(<?=base_url('public/assets/images/contact-form-bg.png')?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="get-in-tuch bg-white p-4">
                        <form action="<?=base_url('/enquiry')?>" method="post" class="" id="enquiry_form">
                                <?= csrf_field() ?>
                            <h4 class="text-blue mb-3">Get In Touch</h4>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Full Name*" value="<?=set_value('name')?>">
                                <span class="text-danger" id="nameErr"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                            </div>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email*" value="<?=set_value('email')?>">
                                <span class="text-danger" id="emailErr"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                            </div>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="tel" class="form-control" name="phone" placeholder="Phone No.*" value="<?=set_value('phone')?>">
                                <span class="text-danger" id="phoneErr"><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>
                            </div>
                            <?php if(isset($button_type) && ($button_type == 'Inquire Now | Course Detail Page' || $button_type == 'Contact for new batch')){ ?>
                                <input type="hidden" name="course_id" value="<?=(isset($course_id))?$course_id:set_value('course_id')?>">
                            <?php }else{ ?>
                            <div class="form-group mb-md-4 mb-3 select-box">
                                <select class="form-select" aria-label="Default select example" name="course_id">
                                    <option value="" selected>Course Interested </option>
                                    <?php if(!empty($courses)){
                                        foreach($courses as $list){
                                            echo '<option value="'.$list->course_id.'">'.$list->course_full_name.'</option>';
                                        }
                                    } ?>
                                    
                                </select>
                                <span class="text-danger" id="courseErr"></span>
                            </div>
                            <?php } ?>
                            <div class="form-group mb-md-4 mb-3">
                                <textarea class="textarea" name="message" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
                            </div>
                            <div class="text-center">
                                <a href="javascript:void(0)" id="enquiry-submit-btn" class="link-btn text-uppercase lt-space blue-btn d-block"> submit </a>
                            </div>
                            <input type="hidden" name="token" id="token" value="">
                            <input type="hidden" name="button_type" value="<?=(isset($button_type))?$button_type:set_value('button_type')?>">
                            
                            <input type="hidden" name="final_submit" value="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $("#enquiry-submit-btn").click(function(){
            $("#enquiry_form").submit();
        });
      
      grecaptcha.ready(function() {
        grecaptcha.execute('<?=SITEKEY?>', {action: 'submit'}).then(function(token) {
              var response = document.getElementById("token");
              response.value = token;
        });
      });
  </script>