       
    <section class="registration-section panel-space ">
        <div class="container pt-5">
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
                            <span><img alt="" src="images/youtube-icon.png"></span>
                            <span class="yout-text">Subscribe to our Youtube Channel </span>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="Register-Now pt-5">
                        <h3 class="r-three px-3">Welcome to<span class="text-red"> Career</span> <span class="text-blue">Boss</span></h3>
                        <span class="px-3">Enter your credentials to Student Login</span>
                        <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
                            <div class="alert alert-danger">
                                <?php echo session()->getFlashdata('alert_error'); ?>
                            </div>
                        <?php } ?>
                        <div class="get-in-tuch bg-white">
                            <form action="<?=current_url()?>" method="post" class="" id="enquiry_form">
                            <?= csrf_field() ?>
                            <!-- <h4 class="text-blue mb-3">Get In Touch</h4> -->

                                <div class="form-group mb-md-4 mb-3">
                                    <!-- <label class="mb-2">Phone Number*</label> -->
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email*" value="<?=set_value('email')?>" >
                                        <span class="text-danger" id=""><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                                    </div>
                                    <div class="form-group mb-md-4 mb-3">
                                        <!-- <label class="mb-2">Phone Number*</label> -->
                                            <input type="password" class="form-control " name="password" id="password" placeholder="Password*" value="<?=set_value('password')?>" >
                                            <span class="text-danger" id=""><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                                            <!-- <a href="#"> <span class="forget-pss " >Forget password?</span></a> -->
                                        </div>
                                        
                                <!-- <div class="form-group mb-md-4 mb-3">
                                    <textarea class="textarea" name="message" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
                                </div> -->
                                <div class="text-center pt-3">
                                    <!-- <a href="javascript:void(0)" id="enquiry-submit-btn" class="link-btn text-uppercase lt-space blue-btn d-block"> submit </a> -->
                                    <input type="submit" class="link-btn text-uppercase lt-space blue-btn d-block w-100" name="final_submit" value="Login">
                                </div>
                                
                                <!-- <input type="hidden" name="button_type" value=""> -->
                                
                            </form>
                            <?php /*<h5 class="text-refer text-center pt-4">Don’t have an account?<span class="text-blue"> <a href="<?=base_url('/register')?>">Create an account</a></span></h5> */ ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
