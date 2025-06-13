    <?php
        $commonmodel = model('App\Models\Common_model', false);
        $courses = $commonmodel->getAllRecord('tbl_courses',['status'=>1]);
        $settings = $commonmodel->get_setting(1);
        $tel1 = str_replace('-','',$settings->phone); 
        $tel2 = str_replace('-','',$settings->phone2);
    ?>
    <footer class="panel-space" id="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="row g-4">
                        <div class="col-md-6">
                        <div class="footer-link user-link">
                        <h6 class="text-white mb-3 text-uppercase">Job Oriented Courses</h6>
                        <ul class="m-0 p-0">
                            <?php if(!empty($courses)){
                                foreach($courses as $list){
                                    echo '<li><a href="'.base_url('course-detail/'.$list->url).'">- '.ucwords($list->course_full_name).'</a></li>';
                                }
                            } ?>
                            
                            <!-- <li><a href="#">- Email Marketing & Sales</a></li>
                            <li><a href="#">- Fullstack Development</a></li>
                            <li><a href="#">- Web Development</a></li>
                            <li><a href="#">- UI/UX Design</a></li>
                            <li><a href="#">- Mobile Apps Design</a></li>
                            <li><a href="#">- Image & Video Editing</a></li>  -->
                            <!-- <li><a href="#">- Beginners</a></li> -->
                            
                            <!-- <li><a href="#">- Career with us</a></li> -->
                        </ul>
                    </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="footer-link user-link">
                                <h6 class="text-white mb-3 text-uppercase">important link</h6>
                                <ul class="m-0 p-0">
                                    <li><a href="<?=base_url('about-us')?>">- About Career Boss</a></li>
                                    <li><a href="<?=base_url('contact')?>">- Contact us</a></li>
                                    <li><a href="<?=base_url()?>#sec-2">- Courses</a></li>
                                    <?php /* <li><a href="<?=base_url()?>#sec-4">- Student Stories</a></li> */ ?>
                                    <?php /* <li><a href="<?=base_url('about-us')?>#sec-4">- Our Faculty</a></li> */ ?>
                                    <li><a href="<?=base_url('placement')?>#faqs">- FAQ’s</a></li>
                                    <li><a href="<?=base_url('blogs')?>">- Blog</a></li>
                                    <li><a href="<?=base_url('placement')?>">- Placement</a></li>
                                    <li><a href="<?=base_url('bca-tuition-for-all-semester')?>">- BCA Tution</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="col-lg-5">
                    <div class="footer-address">
                        <form action="#" method="post" name="subscribeForm" id="subscribeForm">
                            <?=csrf_field(); ?>
                            <div class="input-group">
                                <input type="text" name="email" class="form-control lt-space" autocomplete="off" placeholder="Enter your email to get an updates" value="">
                                <div class="input-group-append">
                                    <button class="btn subscribeBtn" type="button">Subscribe</button>
                                </div>
                            </div>
                        </form>


                        <div class="row g-md-0 g-4">
                            <div class="col-md-9">
                                <div class="footer-link">
                                    <h6 class="text-white mb-3 text-uppercase">Contact Us</h6>
                                    <p class="text-white"><?=$settings->address?></p>
                                    <ul class="m-0 p-0 call-ifo">
                                        <li><span><img src="<?=base_url('public/assets/images/icons/call.png')?>" alt=""></span><a
                                                href="tel:<?=$tel1?>"> <?=$settings->phone?></a></li>
                                        <li><span><img src="<?=base_url('public/assets/images/icons/call.png')?>" alt=""></span><a
                                                href="tel:<?=$tel2?>"> <?=$settings->phone2?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="footer-link">
                                    <h6 class="text-white mb-3 text-uppercase">Follow Us</h6>
                                    <ul class="m-0 p-0">
                                        <li><span><i class="fa-brands fa-facebook-f"></i></span><a href="<?=($settings->facebook_link != '')?$settings->facebook_link:'javascript:void(0)'?>" target="blank">Facebook</a>
                                        </li>
                                        <li><span><i class="fa-brands fa-instagram"></i></span><a href="<?=($settings->instagram_link != '')?$settings->instagram_link:'javascript:void(0)'?>" target="blank">Instagram</a>
                                        </li>
                                        <li><span><i class="fa-brands fa-linkedin-in"></i></span><a
                                                href="<?=($settings->linkedin_link)?$settings->linkedin_link:'javascript:void(0)'?>" target="blank">Linkedin</a></li>
                                        <li><span><i class="fa-brands fa-youtube"></i></span><a href="<?=($settings->youtube_link != '')?$settings->youtube_link:'javascript:void(0)'?>" target="blank">YouTube</a>
                                        <li><span><i class="fa-brands fa-twitter"></i></span><a href="<?=($settings->twitter_link != '')?$settings->twitter_link:'javascript:void(0)'?>" target="blank">Twitter</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright-panel py-md-4 py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">
                        Copyright © <?=date('Y');?>. Career-Boss. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="<?=base_url('privacy-policy')?>">Privacy Policy </a> <span>|</span> <a href="<?=base_url('terms-of-use')?>">Terms of use</a>
                </div>
            </div>
        </div>
    </div>
    

    <!-- <div class="video-panel">
        <div id="myModal" class="modal">
            <span class="close cursor" onclick="closeModal()">&times;</span>
            <div class="modal-content">
                <?php 
                if(isset($youtube_vlink) && $youtube_vlink != ''){ // for course-details youtube video?>
                <div class="mySlides">
                    // <div class="numbertext">1 / 4</div>
                    <iframe id="course_dtls_vid" width="100%" height="500" src="<?=$youtube_vlink?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
                <?php }

                $uri = service('uri');
                $segment1 = $uri->getSegment(1);
                if($segment1 == 'course-detail' && $cDtls->stu_stories != ''){
                    $stu_stories = json_decode($cDtls->stu_stories);
                    foreach($stu_stories as $k=>$list){
                        
                        $parts = parse_url($list->v_link);
                        if(isset($parts['host']) && $parts['host'] == 'www.youtube.com'){ ?>
                            <div class="mySlides">
                                // <div class="numbertext">1 / 4</div>
                                <iframe id="course_dtls_vid<?=$k?>" width="100%" height="500" src="<?=$list->v_link?>"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        <?php } ?>
                <?php } } else if(($segment1 == '' || $segment1 == 'listen-stories' )&& !empty($testimonial)){ 
                foreach($testimonial as $k=>$testi){ 
                    $parts = parse_url($testi->youtube_vlink);
                    if(isset($parts['host']) && $parts['host'] == 'www.youtube.com'){
                ?>
                    <div class="mySlides">
                    //<div class="numbertext">1 / 4</div>
                        <iframe id="testimonial_vid<?=$k?>" width="100%" height="500" src="<?=$testi->youtube_vlink?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                    </div>
                <?php } } ?>
                <?php }else{ ?>

                <div class="mySlides">
                    <iframe id="other_vid1" width="100%" height="500" src="https://www.youtube.com/embed/TckGcxwknYU"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>

                <div class="mySlides">
                    <iframe id="other_vid2" width="100%" height="500" src="https://www.youtube.com/embed/Wx9v_J34Fyo"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>

                <div class="mySlides">
                    <iframe id="other_vid3" width="100%" height="500" src="https://www.youtube.com/embed/i0ZHTiDTS30"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
                <?php } ?>

                <div class="arrow">
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>

                <div class="caption-container">
                    <p id="caption"></p>
                </div>


            </div>
        </div>
    </div> -->
    <div style="display:none;">
        <form action="<?=base_url('enquiry'); ?>" method="post" name="common_enquiry_form" id="common_enquiry_form">
            <?=csrf_field();?>
            <input type="hidden" name="button_type" value="" id="button_type">
            <input type="hidden" name="course_id" value="" id="course_id">
            <input type="hidden" name="get_type" value="submit">
        </form>
    </div>
    <?php 
    $swal_session = array();
    $swalflag = 0;
    if(session()->has('swal_session')){
        $swal_session = session('swal_session');
        $swalflag = 1;
        unset($_SESSION['swal_session']);
    }?>
    
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
    <script src="<?=base_url('public/assets/js/custom.js')?>"></script>
    <script src="<?=base_url('public/assets/js/owl.carousel.js')?>"></script>
    <script defer src="<?=base_url('public/assets/js/sweetalert.min.js')?>"></script>

    <script>
        $(".common_enquiry").click(function(){
            var type = $(this).attr("data-type");
            var course_id = $(this).attr("data-course_id");
            $("#button_type").val(type);
            if(typeof course_id !== 'undefined' && course_id !== null){
                $("#course_id").val(course_id);
            }
            $("#common_enquiry_form").submit();
        });

        var swalflag = '<?=$swalflag?>';
        $(document).ready(function(){
            if(swalflag == '1'){
                swal({
                    title: "<?=(!empty($swal_session))?$swal_session['title']:''?>",
                    text: "<?=(!empty($swal_session))?$swal_session['text']:''?>",
                    icon: "<?=(!empty($swal_session) && isset($swal_session['icon']))?$swal_session['icon']:'success'?>",
                    button: "Close",
                });
                $(".swal-text, .swal-footer").addClass('text-center');
                $(".swal-button--confirm").addClass('btn-success');
            }
        });

        $('.subscribeBtn').click(function(){
            var formID = $(this).closest("form").attr("id");
            var frm = $('#'+formID);
            var formData = new FormData(frm[0]);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/save-subscriber') ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                cache: 'false',
                success: function(res){
                    console.log(res);
                    if(res.error != undefined){
                        
                        if(res.error.email != undefined && res.error.email != ''){
                            toastr.error(res.error.email);
                        }
                        
                    }else{
                        if(res.msg == 'success'){
                            //window.location.reload();
                            frm[0].reset();
                            toastr.success('You have successfully subscribed.');
                        }else if(res.err == 'fail'){
                            toastr.error('Something went wrong. Please try again!');
                        }
                    }
                }
            });
        });

        $('#contact-submit-btn').click(function(){
            $('#nameErr').html('');
            $('#emailErr').html('');
            $('#phoneErr').html('');
            $('#courseErr').html('');
            var frm = $('#contact_us_form');
            var formData = new FormData(frm[0]);
            var thankUrl = "<?=base_url('thank-you')?>";
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/save-contact-us') ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                cache: 'false',
                success: function(res){
                    console.log(res);
                    if(res.error != undefined){
                        if(res.error.name != undefined && res.error.name != ''){
                            $('#nameErr').html(res.error.name);
                        }
                        if(res.error.email != undefined && res.error.email != ''){
                            $('#emailErr').html(res.error.email);
                        }
                        if(res.error.phone != undefined && res.error.phone != ''){
                            $('#phoneErr').html(res.error.phone);
                        }
                        if(res.error.course_id != undefined && res.error.course_id != ''){
                            $('#courseErr').html(res.error.course_id);
                        }
                        if(res.error.captcha != undefined && res.error.captcha != ''){
                            $('#captchaErr').html(res.error.captcha);
                        }
                    }else{
                        if(res.msg == 'success'){
                            window.location.href = thankUrl;
                        }else if(res.err == 'fail'){
                            alert('Something went wrong. Please try again!');
                        }else if(res.err == 'gfail'){
                            alert('Verification Failed by Google.');
                        }
                    }
                }
            });
        });

        $('.logo-slider').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            dots: false,
            smartSpeed: 1000,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                768: {
                    items: 4
                },
                1200: {
                    items: 6
                }
            }
        });
        $('.student-slider').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            dots: false,
            smartSpeed: 1000,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                768: {
                    items: 4
                },
                1200: {
                    items: 4
                }
            }
        });

    </script>


    <script>
        // function openModal() {
        //     document.getElementById("myModal").style.display = "block";
        // }

        // function closeModal() {
        //     var iframeId = '';
        //     var src = '';
        //     $(".mySlides").each(function(){
        //         if($(this).attr("style") == 'display: block;'){
        //             src = $(this).find("iframe").attr('src');
        //             $(this).find("iframe").attr('src', '');
        //             $(this).find("iframe").attr('src', src);
        //         }
        //     });
        //     document.getElementById("myModal").style.display = "none";
        // }

        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }

            if(slides[slideIndex - 1]){
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
                captionText.innerHTML = dots[slideIndex - 1].alt;
            }
        }
    </script>
    <script>
        $('.brand-logo-slider').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            dots: false,
            smartSpeed: 5000,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2.3
                },
                600: {
                    items: 3
                },
                768: {
                    items: 4
                },
                1200: {
                    items: 5.5
                }
            }
        });
        $('.success-stories-slider').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: true,
            smartSpeed: 1000,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1200: {
                    items: 2.5
                }
            }
        });
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            dots:false,
            autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        });
    </script>


</body>

</html>