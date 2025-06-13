<section class="panel-space bg-img get-in-touch-panel enq-panel pratibha-result" style="background-image: url(<?=base_url('public/assets/images/contact-form-bgs.png')?>);">
        <div class="container mobile-reverce">
            <div class="row align-items-center">
                <!-- <div class="col-md-6">
                    <figure class="pratibhakhoj">
                        <img src="<?=base_url('public/assets/images/pratibhakhoj.jpg')?>" alt="">
                    </figure>
                </div> -->
                <div class="pratibha-resul-panel">
                <div class="pratibha-resul-box">
                    <?php if(session()->getFlashdata('message') !== NULL){ ?>
                        <div class="alert alert-danger text-center alert-<?=session()->getFlashdata('type')?>">
                            <?=session()->getFlashdata('message')?>
                        </div>
                        
                    <?php } ?>
                    <div class="get-in-tuch bg-white p-4">
                        <form action="<?=base_url('/pratibhakhoj')?>" method="post" class="" id="enquiry_form">
                                <?= csrf_field() ?>
                            <!-- <h4 class="text-blue mb-3">Get In Touch</h4> -->
                            <h4 class="text-blue mb-3">Pratibhakhoj Result</h4>
                            <h6 class="text-black mb-3">Search by Registration No and Mobile No.</h6>
                            <div class="form-group mb-md-4 mb-3">
                                <input type="text" class="form-control" name="stext" placeholder="Registration No or Mobile No.*" value="<?=set_value('stext')?>" >
                                <span class="text-danger" id="stext"><?= isset($validation) ? display_error($validation, 'stext') : '' ?></span>
                            </div>
                            <?php /* 
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
                            </div> --> */ ?>
                            <div class="text-center">
                                <!-- <a href="javascript:void(0)" id="enquiry-submit-btn" class="link-btn text-uppercase lt-space blue-btn d-block"> submit </a> -->
                                <input type="submit" class="link-btn text-uppercase lt-space blue-btn d-block" name="final_submit" value="submit">
                            </div>
                            
                            
                        </form>
                    </div>
                </div>
                </div>
                <?php if(isset($result)){ ?>
                <div class="col-md-12">
                   <div class="result-table table-responsive">
                   <h4 class="text-blue mb-3 text-center pb-3 border-bottom">Pratibhakhoj Scholarship Result</h4>
                   <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <td><?=$result->name?></td>
                                <th>Phone No</th>
                                <td><?=$result->phone?></td>
                            </tr>
                            <tr>
                                <th>Reg.No</th>
                                <td><?=$result->reg_no?></td>
                                <th>Roll No</th>
                                <td><?=$result->roll_no?></td>
                            </tr>
                            <tr>
                                <th>Marks Obtained (%)</th>
                                <td colspan="3" ><?=$result->result_percentage.'%'?></td>
                            </tr>
                            <tr>
                                <?php if($result->result_percentage >= 80){
                                    $discountPer = 50;
                                }else if($result->result_percentage >= 60){
                                    $discountPer = 30;
                                }else{
                                    $discountPer = 10;
                                } ?>
                                <th colspan="4" class="text-success text-center fs-4 pb-0">You can enroll in any course at <?=$discountPer?>% discount.</th>
                            </tr>
                        </thead>
                    </table>
                   </div>
                </div>
                <?php } ?>
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