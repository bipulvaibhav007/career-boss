<section class="panel-space bg-img get-in-touch-panel enq-panel" style="background-image: url(<?=base_url('public/assets/images/contact-form-bgs.png')?>);">
        <div class="container mobile-reverce html-coding">
            <div class="row">
            <div class="col-md-5">
                    <div class="get-in-tuch bg-white">
                        <form action="<?=current_url()?>" method="post" class="" id="enquiry_form">
                                <?= csrf_field() ?>
                            <!-- <h4 class="text-blue mb-3">Get In Touch</h4> -->
                            <h4 class="text-blue mb-3">HTML Coding Bootcamp</h4>
                            <div class="form-group mb-md-4 mb-3">
                            <!-- <label class="mb-2">Full Name*</label> -->
                                <input type="text" class="form-control" name="name" placeholder="Full Name*" value="<?=set_value('name')?>" required>
                                <span class="text-danger" id="nameErr"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                            </div>
                            <div class="form-group mb-md-4 mb-3">
                            <!-- <label class="mb-2">Phone Number*</label> -->
                                <input type="tel" class="form-control" name="phone" id="mobileNumber" placeholder="Phone No.*" maxlength = "10" value="<?=set_value('phone')?>" required>
                                <span class="text-danger" id="phoneErr"><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>
                            </div>
                            <div class="form-group mb-md-4 mb-3">
                            <!-- <label class="mb-2">Address*</label> -->
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address.*" value="<?=set_value('address')?>" required>
                                <span class="text-danger" id="addErr"><?= isset($validation) ? display_error($validation, 'address') : '' ?></span>
                            </div>
                            <!-- <div class="form-group mb-md-4 mb-3">
                                <textarea class="textarea" name="message" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
                            </div> -->
                            <div class="text-center">
                                <!-- <a href="javascript:void(0)" id="enquiry-submit-btn" class="link-btn text-uppercase lt-space blue-btn d-block"> submit </a> -->
                                <input type="submit" class="link-btn text-uppercase lt-space blue-btn d-block" name="final_submit" value="submit">
                            </div>
                            
                            <!-- <input type="hidden" name="button_type" value="<?=(isset($button_type))?$button_type:set_value('button_type')?>"> -->
                            
                        </form>
                        <div class="courser-cnt d-md-block d-none">
                            <h3 class="text-white">HTML CODING BOOTCAMP</h3>
                            <p class="text-white mb-3">Course : HTML Coding Bootcamp <br>
                                Duration : 4 Weeks <br>
                                Admission open : 1 Nov 2023 to 10 Nov 2023 <br>
                                Seats : 50 seats ( first come first serve )
                            </p>
                            <p class="text-white free-fesh">Fee : 299 only</p>

                            <p class="text-white hindi-note mb-0">जल्दी करें सीटें 50 तक सीमित हैं और यह ऑफर 10 नवंबर 2023 को समाप्त हो जाएगा</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 px-0">
                    <figure class="pratibhakhoj">
                        <img src="<?=base_url('public/assets/images/final-image-editing.jpg')?>" alt="">
                    </figure>
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