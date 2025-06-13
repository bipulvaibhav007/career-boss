<style>
img {
    max-width: 100%;
}
.courser-cnt ul {
    color: #fff;
    flex-wrap: wrap;
    display: flex;
    margin-top: 20px;
}
.courser-cnt ul li {
    width: 38%;
    list-style: disc;
    margin-left: 20px;
}
@media screen and ( max-width: 767px) {
    .get-in-touch-panel video {
        width: 100%;
    }
    .bca-banner {
        display: none;
    }
    .get-in-touch-panel.enq-panel {
        padding-left: 10px;
        padding-right: 10px;
    }
}
</style>

<section class="panel-space bg-img get-in-touch-panel enq-panel">
    <div class="container mobile-reverce rounded">
        <div class="row">
            <div class="col-md-8">
                <div class="get-in-tuch bg-white p-4">
                    <form action="<?=current_url()?>" method="post" class="" id="enquiry_form">
                            <?= csrf_field() ?>
                        <h4 class="text-blue mb-3">Registration Form</h4>
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
                                        if ($list->course_id == 10 || $list->course_id == 9 || $list->course_id == 6 || $list->course_id == 4 || $list->course_id == 1)
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
                    <div class="courser-cnt d-md-block d-none">
                            <h3 class="text-white">CAREER BOSS OFFER MULTIPLE COURSES FOR BCA STUDENTS</h3>
                            <ul>
                                <li>Website Development</li>
                                <li>Frontend Development</li>
                                <li>Backend Development</li>
                                <li>Mobile Application Development</li>
                                <li>Full Stack Development</li>
                                <li>Digital Marketing</li>
                            </ul>
                            
                            <p class="text-white mb-3">Location : <br>1st Floor, Rajendra Nagar, Behind Walia Complex, Near Moti Cinema, Ara Bihar, 802301</p>

                            <p class="text-white hindi-note mb-0">20% discount on all BCA courses</p>
                        </div>
                </div>
                
            </div>
            <div class="col-md-4 g-0">
                <video width="412" height="740" autoplay loop controls>
                    <source src="<?=base_url('public/assets/images/bca-free-trial.mp4')?>" type="video/mp4">
                </video>
            </div>
            
        </div>
    </div>
    <div class="container g-0 mt-5 rounded bca-banner">
        <figure class="">
            <img src="<?=base_url('public/assets/images/15-days-trail-for-bca-post-design-banner-size.png')?>" alt="">
        </figure>
    </div>
</section>
    
<section class="What-learners-say">
    <div class="container">
       <div class="section-text text-center text-white">
        <div class="border-line" style="margin: 0 auto;"></div>
        <h3>BCA Job Oriented Courses</h3>
        <p class="text-white">After completing your Bachelor of Computer Applications (BCA), you open the door to a multitude of exciting career pathways and further educational opportunities. Here are some of the diverse options available to you</p>

       </div>
        <div class="row pt-5">
            <div class="col-lg-4 col-md-6 pb-4">
                <div class="learners-say">
                    <h5>Website Development</h5>
                    <ul>
                        <li>Basics of Web Technologies</li>
                        <li>HTML/XHTML </li>
                        <li>JavaScript</li>
                        <li>OOPS programming in PHP </li>
                        <li>Codeigniter </li>
                    </ul>
                    <a href="https://career-boss.com/course-detail/professional-web-development-course" class="link-btn text-uppercase lt-space blue-btn d-block"> Learn More </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-4">
                <div class="learners-say">
                    <h5>Frontend Development</h5>
                    <ul>
                        <li>Introduction to Angular</li>
                        <li>TypeScript Fundamentals</li>
                        <li>Angular Modules and Lazy Loading</li>
                        <li>State Management with NgRx</li>
                        <li>Deploying Angular Applications</li>
                    </ul>
                    <a href="https://career-boss.com/course-detail/frontend-development-course" class="link-btn text-uppercase lt-space blue-btn d-block"> Learn More </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-4">
                <div class="learners-say">
                    <h5>Backend Development</h5>
                    <ul>
                        <li>Learning Node.js</li>
                        <li>Mastering the Express framework</li>
                        <li>Explore Mongo DB</li>
                        <li>AWS</li>
                        <li>Dedicated Server</li>
                    </ul>
                    <a href="https://career-boss.com/course-detail/fullstack-development-course" class="link-btn text-uppercase lt-space blue-btn d-block"> Learn More </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-4">
                <div class="learners-say">
                    <h5>Mobile Application</h5>
                    <ul>
                        <li>Overview on Mobile App</li>
                        <li>Explore API on Postman</li>
                        <li>Git and Jira</li>
                        <li>Ionic/angular/react and more</li>
                        <li>Work on live project</li>
                    </ul>
                    <a href="https://career-boss.com/course-detail/mobile-app-development-course" class="link-btn text-uppercase lt-space blue-btn d-block"> Learn More </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-4">
                <div class="learners-say">
                    <h5>Full Stack Development</h5>
                    <ul>
                        <li>Understanding Web Technologies</li>
                        <li>HTML / Javascript</li>
                        <li>Angular/React</li>
                        <li>Node js / mongo db</li>
                        <li>AWS Server</li>
                    </ul>
                    <a href="https://career-boss.com/course-detail/fullstack-development-course" class="link-btn text-uppercase lt-space blue-btn d-block"> Learn More </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-4">
                <div class="learners-say">
                    <h5>Digital Marketing</h5>
                    <ul>
                        <li>Website Analysis</li>
                        <li>Keyword & Hashtag</li>
                        <li>ON Page</li>
                        <li>OFF Page</li>
                        <li>SMM</li>
                    </ul>
                    <a href="https://career-boss.com/course-detail/professional-digital-marketing-course" class="link-btn text-uppercase lt-space blue-btn d-block"> Learn More </a>
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