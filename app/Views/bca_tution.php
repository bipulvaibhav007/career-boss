<script src="https://www.google.com/recaptcha/api.js?render=<?=SITEKEY?>"></script>
<section class="panel-space bg-img get-in-touch-panel enq-panel" style="background-image: url(<?=base_url('public/assets/images/contact-form-bgs.png')?>);" alt="contact-form-bgs.png" title="contact-form-bgs.png">
        <div class="container mobile-reverce image-editing">
            <div class="row">
            <div class="col-md-5">
                    <div class="get-in-tuch bg-white">
                        <form action="<?=current_url()?>" method="post" class="" id="enquiry_form">
                                <?= csrf_field() ?>
                            <!-- <h4 class="text-blue mb-3">Get In Touch</h4> -->
                            <h4 class="text-blue mb-3">BCA TUITION FOR ALL SEMESTER</h4>
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
                                <input type="hidden" name="token" id="token" value="">
                                <input type="submit" class="link-btn text-uppercase lt-space blue-btn d-block" name="final_submit" value="submit">
                            </div>
                            
                            <!-- <input type="hidden" name="button_type" value="<?=(isset($button_type))?$button_type:set_value('button_type')?>"> -->
                            
                        </form>

                        <div class="courser-cnt d-md-block d-none">
                            <h3 class="text-white">BCA TUITION FOR ALL SEMESTER</h3>
                            <p class="text-white mb-3">Offline classes has started from semester 1 to 6.</p>
                            <p class="text-white free-fesh">Admission open</p>

                            <p class="text-white hindi-note mb-0">Hurry up to get discount upto 30%.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 px-0">
                    <figure class="pratibhakhoj">
                        <img src="<?=base_url('public/assets/images/bca.jpg')?>" alt="">
                    </figure>
                    
                </div>
               
            </div>
        </div>
    </section>
        
    <section class="What-learners-say-section">
        <div class="container">
           <div class="section-text text-center pb-3">
            <div class="border-line" style="margin: 0 auto;"></div>
            <h1>Discover Excellence in BCA Coaching at Career Boss Institute in Ara</h1>
           </div>
            <p>Embark on a successful journey in the field of computer applications with Career Boss Institute, Ara's premier destination for BCA coaching. We blend expert teaching, practical skills and real-world insights to prepare you for a thriving career in IT and software. Our dedicated and experienced faculty ensures personalized attention, fostering an environment where learning thrives. Our comprehensive BCA curriculum is tailored to meet industry standards and enhance your potential.</p>
        </div>
    </section>


    <section class="best-Online-courses panel-space" style="padding: 65px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 ">
                    <div class="online-courses-img">
                        <img src="<?=base_url('public/assets/images/tution-img-new.png')?>" width="100%" alt="tution-img-new.png" title="tution-img-new.png">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="online-courses">
                         <div class="border-line"></div>
                         <div class="section-text">
                            <h3>Our Approach</h3>
                         <p>We recognize the significance of high-quality education in molding the futures of students pursuing a Bachelor of Computer Applications degree. Our approach is focused on:</p>
                         </div>
                         <div class="course py-3" style="display: flex; gap: 25px;">
                            <div >
                                <img src="<?=base_url('public/assets/images/curriculum.png')?>" width="100%" alt="curriculum.png" title="curriculum.png">
                            </div>
                            <div class="course-text">
                                <h4>Comprehensive Curriculum Coverage:</h4>
                                <p>A comprehensive exploration of the BCA curriculum, with a strong focus on practical implementations and real-life situations.</p>
                                
                            </div>
                         </div>
                         <div class="course" style="display: flex; gap: 25px;">
                            <div >
                                <img src="<?=base_url('public/assets/images/course.png')?>" width="100%" alt="course.png" title="course.png">
                            </div>
                            <div class="course-text">
                                <h4>Experienced Faculty:</h4>
                                <p>Our group of expert and seasoned educators is focused on delivering superior advice and backing.</p>
                            </div>
                         </div>
                         <div class="course py-3" style="display: flex; gap: 25px;">
                            <div >
                                <img src="<?=base_url('public/assets/images/interactive.png')?>" width="100%" alt="interactive.png" title="interactive.png">
                            </div>
                            <div class="course-text">
                                <h4>Interactive Learning Environment:</h4>
                                <p>Focused attention through limited class sizes. Dynamic and participative instructional techniques.</p>
                                
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-lg-6">
                    <div class="online-courses">
                        <div class="section-text pb-3">
                            <div class="border-line"></div>
                             <h3>Courses Offered:</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                               <div class="crash-cors">
                                <h5>BCA Regular Course:</h5>
                                <ul>
                                    <li>Full coverage of the BCA syllabus.</li>
                                    <li>Regular assessments and progress tracking.</li>
                                </ul>
                               </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="crash-cors">
                                    <h5>Crash Courses:</h5>
                                <ul>
                                    <li>Intensive courses for exam preparation.</li>
                                    <li>Quick revision and targeted practice sessions.</li>
                                </ul>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="col-lg-6">
                    <img src="<?=base_url('public/assets/images/tution-img2.png')?>" width="100%" alt="tution-img2.png" title="tution-img2.png">
                </div>
            </div>
        </div>
    </section>

    <section class="What-learners-say">
        <div class="container">
           <div class="section-text text-center text-white">
            <div class="border-line" style="margin: 0 auto;"></div>
            <h3>Semester-wise study plan for BCA Tuition</h3>
            <p class="text-white">Embark on a successful journey in your Bachelor of Computer Applications (BCA) with Career Boss Institute's tailored semester-wise study plan. 
                Our expertly crafted curriculum is designed to provide comprehensive BCA tuition, aligning with your academic goals. You will delve into key subjects, 
                supported by practical assignments and industry-relevant projects, ensuring a deep understanding of computer applications. Our structured approach not 
                only prepares you academically but also equips you with essential skills for a thriving career in the IT sector from programming fundamentals to 
                advanced software development.</p>
        
           </div>
            <div class="row pt-5">
                <div class="col-lg-4 col-md-6 pb-4">
                    <div class="learners-say">
                        <h5>Semester 1</h5>
                        <ul>
                            <li>Fundamentals of Computer</li>
                            <li>PC Packages (Win8/XP,Word,Excel)</li>
                            <li>Programming Logic & Design Techniques</li>
                            <li>Programing in C</li>
                            <li>Communicative English</li>
                           
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-4">
                    <div class="learners-say">
                        <h5>Semester 2</h5>
                        <ul>
                            <li>Digital Computer Organisation</li>
                            <li>Advanced Programming in C</li>
                            <li>Fundamental Data structure</li>
                            <li>Application Programming in Foxpro</li>
                            <li>Financial Accounting</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-4">
                    <div class="learners-say">
                        <h5>Semester 3</h5>
                        <ul>
                            <li>Information Technology trend</li>
                            <li>GUI Programming in Visual Basic</li>
                            <li>Database Management Systema</li>
                            <li>Computer Networking & LAN</li>
                            <li>Management Skills</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-4">
                    <div class="learners-say">
                        <h5>Semester 4</h5>
                        <ul>
                            <li>Operating Systems</li>
                            <li>OOPS Programming in C++</li>
                            <li>Internet & E-Commerce</li>
                            <li>Linux Operating Systems</li>
                            <li>System Analysis & Data Processing</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-4">
                    <div class="learners-say">
                        <h5>Semester 5</h5>
                        <ul>
                            <li>Component Architecture and Programming (COM, DCOM)</li>
                            <li>Multimedia Tools & Applications</li>
                            <li>Programing in JAVA</li>
                            <li>Oracle RDBMS</li>
                            <li>Computer Centre Management</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-4">
                    <div class="learners-say">
                        <h5>Semester 6</h5>
                        <ul>
                            <li>Major Project</li>
                            <li>Internal Assessment & term work</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our-teachers" style="padding:45px 0;">
        <div class="container">
            <div class="section-text pt-4">
                <div class="border-line"></div>
                <h3>Why Choose Career Boss Institute for the Best BCA Tuition?</h3>
                <p>We understand the dynamic landscape of a Bachelor in Computer Applications (BCA) and offer specialized tuition that propels your success. Our institute stands out with experienced educators, personalized learning approaches, and an up-to-date curriculum aligned with the latest industry trends. We pride ourselves on small class sizes ensuring individual attention and our track record of producing top-performing BCA graduates speaks for itself.</p>
               </div>
            <div class="row pt-lg-5">
                <div class="col-lg-4 col-md-6 pb-4">
                    <div class="teachers">
                        <div class="teacher-image">
                            <img src="<?=base_url('public/assets/images/career1.png')?>" width="100%" alt="career1.png" title="career1.png">
                        </div>
                        <div class="teachers-text">
                            <h5>Personalized Learning Experience:</h5>
                            <p>We understand that every student is unique. Our personalized tuition plans cater to individual learning styles, ensuring that each student grasps complex computer science concepts with ease and confidence.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-4">
                    <div class="teachers">
                        <div class="teacher-image">
                            <img src="<?=base_url('public/assets/images/career2.png')?>" width="100%" alt="career2.png" title="career2.png">
                        </div>
                        <div class="teachers-text">
                            <h5>State-of-the-Art Resources:</h5>
                            <p>We provide access to the latest software, tools and research materials, keeping our students at the forefront of technological advancements. Our modern facilities and resources are designed to foster an environment of innovation and exploration.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-4">
                    <div class="teachers">
                        <div class="teacher-image">
                            <img src="<?=base_url('public/assets/images/career3.jpg')?>" width="100%" alt="career3.png" title="career3.png">
                        </div>
                        <div class="teachers-text">
                            <h5>Career Development Support:</h5>
                            <p>We offer career counseling and placement assistance to help our graduates secure promising positions in the tech industry. Our strong network with leading companies ensures that our students have ample opportunities to launch successful careers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section cba-tutions">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pb-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3599.4253636829926!2d84.66506357466763!3d25.557511417013764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398d5f9896e8e6cf%3A0x6b29c5b7602bfeed!2sCareer%20Boss%20Institute!5e0!3m2!1sen!2sin!4v1700119169198!5m2!1sen!2sin" width="100%" height="440" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6 pb-4">
                    <div class="contact-form get-in-tuch">
                        <h3>Contact Us</h3>
                        <div class="form-box pt-4">
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="yourname" aria-describedby="emailHelp" placeholder="Your Name">
                                  </div>
                                <!-- <div class="form-group">
                                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your email">
                                </div> -->
                                <div class="form-group">
                                    <input value-type="text" class="form-control" id="Phone" aria-describedby="emailHelp" placeholder="Phone">
                                  </div>
                                <div class="form-group">
                                    <input value-type="text" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Address">
                                  </div>
                                  <!-- <div class="form-group">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Message.."></textarea>
                                  </div> -->
                                <button type="submit" class="btn">Submit</button>
                              </form>
                        </div>
                        
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
        grecaptcha.ready(function() {
          grecaptcha.execute('<?=SITEKEY?>', {action: 'submit'}).then(function(token) {
                var response = document.getElementById("token");
                response.value = token;
          });
        });

    </script>