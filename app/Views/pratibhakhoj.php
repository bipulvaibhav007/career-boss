    <section class="panel-space bg-img get-in-touch-panel enq-panel" style="background-image: url(<?=base_url('public/assets/images/contact-form-bgs.png')?>);">
        <div class="container mobile-reverce">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <figure class="pratibhakhoj">
                        <img src="<?=base_url('public/assets/images/pratibhakhoj.jpg')?>" alt="">
                    </figure>
                </div>
                <div class="col-md-6">
                    <div class="get-in-tuch bg-white p-4">
                        <form action="<?=base_url('/pratibhakhoj2')?>" method="post" class="" id="enquiry_form">
                                <?= csrf_field() ?>
                            <!-- <h4 class="text-blue mb-3">Get In Touch</h4> -->
                            <h4 class="text-blue mb-3">Pratibhakhoj</h4>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Full Name*" value="<?=set_value('name')?>" required>
                                <span class="text-danger" id="nameErr"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                            </div>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="number" class="form-control" name="phone" id="mobileNumber" placeholder="Phone No.*" maxlength = "10" value="<?=set_value('phone')?>" required>
                                <span class="text-danger" id="phoneErr"><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>
                            </div>
                            <?php if(isset($button_type) && ($button_type == 'Inquire Now | Course Detail Page' || $button_type == 'Contact for new batch')){ ?>
                                <input type="hidden" name="course_id" value="<?=(isset($course_id))?$course_id:set_value('course_id')?>">
                            <?php }else{ ?>
                            <div class="form-group mb-md-4 mb-3 select-box">
                                <select class="form-select" aria-label="Default select example" name="course_id" required>
                                    <option value="" selected>Course Interested*</option>
                                    <?php if(!empty($courses)){
                                        foreach($courses as $list){
                                            echo '<option value="'.$list->course_id.'">'.$list->course_full_name.'</option>';
                                        }
                                    } ?>
                                    
                                </select>
                                <span class="text-danger" id="courseErr"></span>
                            </div>
                            <?php } ?>
                            <!-- <div class="form-group mb-md-4 mb-3">
                                <textarea class="textarea" name="message" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
                            </div> -->
                            <div class="text-center">
                                <!-- <a href="javascript:void(0)" id="enquiry-submit-btn" class="link-btn text-uppercase lt-space blue-btn d-block"> submit </a> -->
                                <input type="submit" class="link-btn text-uppercase lt-space blue-btn d-block" name="final_submit" value="submit">
                            </div>
                            
                            <input type="hidden" name="button_type" value="<?=(isset($button_type))?$button_type:set_value('button_type')?>">
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#mobileNumber').on('keydown', function(e) {
                // Get the current input value
                var inputValue = $(this).val();
                
                // Check if the user is trying to input a zero at the beginning
                if (e.key === '0' && inputValue.length === 0) {
                // Prevent the zero from being added
                e.preventDefault();
                }
            });
        });

    </script>