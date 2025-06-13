    <section class="registration-section panel-space ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="regis-tat " style="background-image: url(<?=base_url('public/assets/images/redis-img-1.png')?>);" alt="redis-img-1.png" title="redis-img-1.png">
                        <p class="text-white"><strong>Career Boss /</strong>  Refer and Earn</p>
                            <div class="regi-slider pb-5">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <h2 class="titlels-banners font-ss text-white">Earn ₹1000 Cash Rewards on every successful referral</h2>
                                </div>
                                <div class="item">
                                    <h2 class="titlels-banners font-ss text-white">Earn ₹1000 Cash Rewards on every successful referral</h2>
                                </div>
                                <div class="item">
                                    <h2 class="titlels-banners font-ss text-white">Earn ₹1000 Cash Rewards on every successful referral</h2>
                                </div>
                                <div class="item">
                                    <h2 class="titlels-banners font-ss text-white">Earn ₹1000 Cash Rewards on every successful referral</h2>
                                </div>
                                <div class="item">
                                    <h2 class="titlels-banners font-ss text-white">Earn ₹1000 Cash Rewards on every successful referral</h2>
                                </div>
                            </div>
                            </div>
                        <a href="#">
                        <div class="youtbe-su d-flex align-items-center p-2">
                            <span class="youtub-img"><img alt="" src="images/youtube-icon.png"></span>
                            <span class="yout-text">Subscribe to our Youtube Channel </span>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="Register-Now">
                        <h3 class="r-three px-3">Register Now</h3>
                        
                        <span class="e-y-account">Enter your credentials to create an account for referrer.</span>
                        <div class="get-in-tuch bg-white">
                            <form action="<?=current_url()?>" method="post" class="" id="enquiry_form">
                                <?= csrf_field() ?> 
                                <?php /*$is_referer = 1; $member_type = '';
                                if((isset($_GET['type']) && $_GET['type'] == 'franchise') || (isset($_POST['member_type']) && $_POST['member_type'] == 'franchise')){
                                    $is_referer = 0;
                                    $member_type = 'franchise';
                                } */
                                ?>
                                <?php /*if(!$is_referer){ ?>
                                    <div class="form-group mb-md-4 mb-3">
                                        <input type="text" class="form-control" name="center_name" placeholder="Center Name*" value="<?=set_value('center_name')?>" >
                                        <span class="text-danger" id=""><?= isset($validation) ? display_error($validation, 'center_name') : '' ?></span>
                                    </div>
                                    <div class="form-group mb-md-4 mb-3">
                                        <input type="text" class="form-control" name="center_address" placeholder="Center Address*" value="<?=set_value('center_address')?>" >
                                        <span class="text-danger" id=""><?= isset($validation) ? display_error($validation, 'center_address') : '' ?></span>
                                    </div>
                                <?php }*/ ?>
                                <div class="form-group mb-md-4 mb-3">
                                    <input type="text" class="form-control" name="m_full_name" placeholder="Full Name*" value="<?=set_value('m_full_name')?>" >
                                    <span class="text-danger" id=""><?= isset($validation) ? display_error($validation, 'm_full_name') : '' ?></span>
                                </div>
                                <div class="form-group mb-md-4 mb-3">
                                    <input type="text" class="form-control" name="address" placeholder="Address*" value="<?=set_value('address')?>" >
                                    <span class="text-danger" id=""><?= isset($validation) ? display_error($validation, 'address') : '' ?></span>
                                </div>
                                <div class="form-group mb-md-4 mb-3">
                                    <input type="tel" class="form-control" name="phone" placeholder="Mobile No*" value="<?=set_value('phone')?>" >
                                    <span class="text-danger" id=""><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>
                                </div>
                                <div class="form-group mb-md-4 mb-3">
                                    <input type="email" class="form-control" name="email"  placeholder="Email ID*" value="<?=set_value('email')?>" >
                                    <span class="text-danger" id=""><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                                </div>
                                <div class="form-group mb-md-4 mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password*" id="" value="<?=set_value('password')?>" >
                                    <span class="text-danger" id=""><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                                </div>
                                <div class="form-group mb-md-4 mb-3">
                                    <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password*" id="" value="<?=set_value('cpassword')?>" >
                                    <span class="text-danger" id="addErr"><?= isset($validation) ? display_error($validation, 'cpassword') : '' ?></span>
                                </div>
                                <input type="hidden" name="token" id="token" value="">
                                <!-- <div class="form-group mb-md-4 mb-3">
                                    <textarea class="textarea" name="message" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
                                </div> -->
                                <div class="text-center pt-3">
                                    <!-- <a href="javascript:void(0)" id="enquiry-submit-btn" class="link-btn text-uppercase lt-space blue-btn d-block"> submit </a> -->
                                    <input type="submit" class="link-btn text-uppercase lt-space blue-btn d-block w-100" name="final_submit" value="submit">
                                </div>
                                
                                <!-- <input type="hidden" name="button_type" value=""> -->
                                
                            </form>
                            <h5 class="text-refer text-center pt-4">Already have an account? <span class="text-blue"><a href="<?=base_url('/login')?>">Login</a></span></h5>
                        </div>
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


