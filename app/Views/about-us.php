<?php /*<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title> Index </title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/media-query.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Khand:wght@300;400;500;600;700&display=swap" rel="stylesheet">




</head>

<body>

    <header class="header">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">
                <div class="logo-section">
                    <a class="navbar-brand" href="#">
                        <img class="d-lg-block" src="images/career-logo.jpg" alt="">
                    </a>
                </div>

                <a href="#" class="admission-btn">Admission <span
                        class="position-absolute top-100 start-50 translate-middle">open</span></a>

                <div class="menu-bar">
                    <nav class="navbar navbar-expand-lg navbar-dark p-0" aria-label="Fifth navbar example">

                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <!-- <span class="navbar-toggler-icon"></span> -->
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample05">
                            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link khand active" aria-current="page" href="#">About</a>
                                </li>
                                <li class="nav-item nav-dropdown">
                                    <a class="nav-link khand" href="#">Courses <span><i
                                                class="fa-solid fa-angle-down"></i></span></a>
                                    <div class="drop-down">
                                        <ul class="drop-down-list">
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="#">Digital
                                                    Marketing</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="#">Email Marketing &
                                                    Sales</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="#">HTML
                                                    Development</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="#">Fullstack
                                                    Development</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="#">Web
                                                    Development</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="#">UllUX
                                                    Designing</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="#">Mobile Apps
                                                    Development</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="#">Image & Video
                                                    Editing</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="#">For Beginners</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link khand" href="#">Career</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link khand" href="#">Placement</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link khand" href="#">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link khand" href="#">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header> */ ?>
    <?php $url = '';
        if(isset($banner->brochure)){
            $url = base_url('public/assets/upload/images/'.$banner->brochure); 
        } ?>
    <section class="banner cms-banner position-relative bg-img d-flex  align-items-center"
        style="background-image: url(<?=$url?>);" alt="<?=$banner->img_alt; ?>" title="<?=$banner->img_title; ?>">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="banner-content">
                        <h1 class="khand lt-space text-uppercase"><?=(isset($banner->main_title))?$banner->main_title:''?></h1>
                        <!-- <p class="lt-space">Career Boss an IT Professional Institute: Empowering Tomorrow's IT Experts with <span class="text-yellow">Web Panel Solutions</span></p> -->
                        <p class="lt-space"><?=(isset($banner->sub_title))?$banner->sub_title:''?></p>
                        <a href="<?=base_url('/contact')?>" class="link-btn khand text-uppercase lt-space">CONTACT US<span><img class="hvr-icon"
                                    src="<?=base_url('public/assets/images/icons/right-arrow.png')?>" alt="right-arrow.png" title="right-arrow.png"></span> </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- <figure>
                        <a href="#" style="width:100%" onclick="openModal();currentSlide(5)"
                            class="hover-shadow cursor">
                            <img src="images/Wev-dev-hero-image.png" alt="">
                        </a>
                    </figure> -->
                </div>
            </div>
        </div>
    </section>

    <section class="expert-learning panel-space py-md-5">
        <div class="container">
            <div class="panel-heding mb-4">
                <h3 class="text-black">Our Vision</h3>
                <p>The vision of Career Boss Institute is to equip individuals with state-of-the-art skills through a wide array of courses, encompassing digital 
                    marketing, web development, UX/UI design and beyond. This empowers them to thrive in the ever-changing landscape of today's professional world.</p>
            </div>
            <div class="row g-md-4 g-3">
                <div class="col-md-4 d-flex">
                    <div class="learning-box w-100 d-lg-flex">
                        <!-- <div class="flex-shrink-0 text-center">    
                            <img src="images/icons/lurnign-1.png" alt="...">
                        </div> -->
                        <div class="flex-grow-1 ms-lg-3 text-center text-md-start">
                            <h5 class="lt-space">Empowering Thousands</h5>
                            <p class="mb-0 text-black"><span class="d-block">1000+</span>
                                Empowering Career Growth.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="learning-box w-100 d-lg-flex">
                        <!-- <div class="flex-shrink-0 text-center">
                            <img src="images/icons/lurnign-2.png" alt="...">
                        </div> -->
                        <div class="flex-grow-1 ms-lg-3 text-center text-md-start">
                            <h5 class="lt-space">Expert Network</h5>
                            <p class="mb-0 text-black"><span class="d-block">500+</span>
                                Connect With Industry Experts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="learning-box w-100 d-lg-flex">
                        <!-- <div class="flex-shrink-0 text-center">
                            <img src="images/icons/lurnign-3.png" alt="...">
                        </div> -->
                        <div class="flex-grow-1 ms-lg-3 text-center text-md-start">
                            <h5 class="lt-space">Connect With Industry Experts.</h5>
                            <p class="mb-0 text-black"><span class="d-block">250+</span>
                                Career Impact Across Industries.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="panel-space overflow-hidden">
        <div class="container">
            <div class="panel-heding mb-4">
                <h3 class="text-black">Our Unique <span class="text-red">Advantages</span></h3>
                <p>Recognizing the significance of adaptability in the contemporary high-speed environment, we provide a range of learning avenues. Career Boss 
                    Institute empowers students to opt for either in-person instruction selecting the method that aligns most effectively with their requirements.</p>
            </div>
            <div class="row g-lg-5 g-3 justify-content-center">
                <div class="col-lg-3 col-md-4 col-6 d-flex">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/icons/unique1.png')?>" alt="unique1.png" title="unique1.png">
                        </figure>
                        <p class="mb-0">Comprehensive Curriculum</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 d-flex">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/icons/unique2.png')?>" alt="unique2.png" title="unique2.png">
                        </figure>
                        <p class="mb-0">Personalized Approach</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 d-flex">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/icons/unique3.png')?>" alt="unique3.png" title="unique3.png">
                        </figure>
                        <p class="mb-0">Experienced Instructors</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 d-flex">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/icons/unique4.png')?>" alt="unique4.png" title="unique4.png">
                        </figure>
                        <p class="mb-0">Practical Hands-On Training</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 d-flex">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/icons/unique5.png')?>" alt="unique5.png" title="unique5.png">
                        </figure>
                        <p class="mb-0">Industry-Relevant Skills</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 d-flex">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/icons/unique6.png')?>" alt="unique6.png" title="unique6.png">
                        </figure>
                        <p class="mb-0">Supportive Learning Environment</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 d-flex">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/icons/unique7.png')?>" alt="unique7.png" title="unique7.png">
                        </figure>
                        <p class="mb-0">Career Guidance</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 d-flex">
                    <div class="Unique-adva w-100">
                        <figure>
                            <img src="<?=base_url('public/assets/images/icons/unique8.png')?>" alt="unique8.png" title="unique8.png">
                        </figure>
                        <p class="mb-0">Ongoing Learning Opportunities</p>
                    </div>
                </div>

            </div>

            <div class="panel-space pb-0">
                <div class="panel-heding mb-4">
                    <h3 class="text-black">Our Commitment to <span class="text-red">Quality </span></h3>
                    <p>We infuse our services, encompassing Digital Marketing, Web Development, and beyond, with an enduring commitment to achieving excellence. 
                        Our dedication to superiority, alignment with industry trends and fostering student achievements distinguish us as a premier educational establishment in the field of IT</p>
                </div>
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-5">
                                <figure class="wonner">
                                    <img class="w-100" src="<?=base_url('public/assets/images/puran-chand.png')?>" alt="puran-chand.png" title="puran-chand.png">
                                </figure>
                            </div>
                            <div class="col-md-7">
                                <div class="wonner-dtl">
                                    <h4 class="mb-3"><strong>Puran Chand</strong></h4>
                                    <div class="position-relative p-4 wonner-cnt">
                                        <img class="position-absolute top-0 start-0" src="<?=base_url('public/assets/images/icons/c-comma.png')?>"
                                        alt="c-comma.png" title="c-comma.png">
                                        <p>We prioritize delivering excellence in education and training. Demonstrating a resolute dedication to delivering an exceptional learning journey, we guarantee that each student receives unparalleled education and assistance to accomplish their objectives.</p>
                                        <img class="position-absolute bottom-0 end-0" src="<?=base_url('public/assets/images/icons/cb-comma.png')?>"
                                        alt="cb-comma.png" title="cb-comma.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-5">
                                <figure class="wonner">
                                    <img class="w-100" src="<?=base_url('public/assets/images/basu-kumar.png')?>" alt="basu-kumar.png" title="basu-kumar.png">
                                </figure>
                            </div>
                            <div class="col-md-7">
                                <div class="wonner-dtl">
                                    <h4 class="mb-3"><strong>Basant Kumar</strong></h4>
                                    <div class="position-relative p-4 wonner-cnt">
                                        <img class="position-absolute top-0 start-0" src="<?=base_url('public/assets/images/icons/c-comma.png')?>"
                                            alt="c-comma.png" title="c-comma.png">
                                        <p>At Career Boss Institute, quality is the cornerstone of our approach. We are committed to providing top-tier education and training with a focus on excellence. Ensuring that each student receives the best possible learning experience and empowers individuals for success.</p>
                                        <img class="position-absolute bottom-0 end-0" src="<?=base_url('public/assets/images/icons/cb-comma.png')?>"
                                            alt="cb-comma.png" title="cb-comma.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="our-team panel-space pt-0 overflow-hidden" id="sec-4">
        <div class="container">
            <div class="panel-heding mb-4">
                <h3 class="text-black">Equipping IT Professionals with State-of-the-Art Tools at <span class="text-red">Career </span> <span class="text-blue">Boss</span> <span class="text-yellow">Institute</span></h3>
                
                <p>Equipping IT professionals with cutting-edge tools is the focus at Career Boss Institute. Demonstrating a steadfast dedication to remaining at the forefront of technology the institute guarantees students' access to cutting-edge resources. This equips them to thrive in their professions and fulfill the requirements of the constantly evolving field of information technology.</p>
            </div>
            <h3 class="text-blue mb-4">Meet Our Experts </h3>

            <div class="row g-md-5 g-3">
                <?php if(!empty($experts)){
                foreach($experts as $list){ ?>
                <div class="col-md-6 col-lg-4">
                    <div class="team-panel">
                        <figure class="mb-0">
                            <img src="<?=base_url('public/assets/upload/images/'.$list->image)?>" alt="<?=$list->image?>" title="<?=$list->image?>">
                        </figure>
                        <div class="team-overlay">
                            <h5><?=$list->name?></h5>
                            <p><?=$list->short_desc?></p>
                        </div>
                    </div>
                </div>
                <?php } } ?>
                <?php /*
                <div class="col-md-6 col-lg-4">
                    <div class="team-panel">
                        <figure class="mb-0">
                            <img src="<?=base_url('public/assets/images/team.png')?>" alt="">
                        </figure>
                        <div class="team-overlay">
                            <h5>Ranjeet</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, alias. Culpa quisquam fugiat dolores ea itaque tempora commodi est. </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="team-panel">
                        <figure class="mb-0">
                            <img src="<?=base_url('public/assets/images/team.png')?>" alt="">
                        </figure>
                        <div class="team-overlay">
                            <h5>Ranjeet</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, alias. Culpa quisquam fugiat dolores ea itaque tempora commodi est. </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="team-panel">
                        <figure class="mb-0">
                            <img src="<?=base_url('public/assets/images/team.png')?>" alt="">
                        </figure>
                        <div class="team-overlay">
                            <h5>Ranjeet</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, alias. Culpa quisquam fugiat dolores ea itaque tempora commodi est. </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="team-panel">
                        <figure class="mb-0">
                            <img src="<?=base_url('public/assets/images/team.png')?>" alt="">
                        </figure>
                        <div class="team-overlay">
                            <h5>Ranjeet</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, alias. Culpa quisquam fugiat dolores ea itaque tempora commodi est. </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="team-panel">
                        <figure class="mb-0">
                            <img src="<?=base_url('public/assets/images/team.png')?>" alt="">
                        </figure>
                        <div class="team-overlay">
                            <h5>Ranjeet</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, alias. Culpa quisquam fugiat dolores ea itaque tempora commodi est. </p>
                        </div>
                    </div>
                </div> */ ?>
            </div>
        </div>
    </section>

    <?php /* 
    <footer class="panel-space" id="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="footer-link user-link">
                        <h6 class="text-white mb-3 text-uppercase">Job Oriented Courses</h6>
                        <ul class="m-0 p-0">
                            <li><a href="#">- Digital Marketing</a></li>
                            <li><a href="#">- Email Marketing & Sales</a></li>
                            <li><a href="#">- Fullstack Development</a></li>
                            <li><a href="#">- Web Development</a></li>
                            <li><a href="#">- UI/UX Design</a></li>
                            <li><a href="#">- Mobile Apps Design</a></li>
                            <li><a href="#">- Image & Video Editing</a></li>
                            <li><a href="#">- Beginners</a></li>
                            <li><a href="#">- About Career Boss</a></li>
                            <li><a href="#">- Career with us</a></li>
                            <li><a href="#">- Courses</a></li>
                            <li><a href="#">- Placement</a></li>
                            <li><a href="#">- FAQ’s</a></li>
                            <li><a href="#">- Student Stories</a></li>
                            <li><a href="#">- Our Faculty</a></li>
                            <li><a href="#">- Blog</a></li>
                            <li><a href="#">- Contact us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="footer-address">
                        <form action="#" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control lt-space"
                                    placeholder="Enter your email to get an updates" value="">
                                <div class="input-group-append">
                                    <button class="btn" type="submit">Subscribe</button>
                                </div>
                            </div>
                        </form>


                        <div class="row g-md-0 g-4">
                            <div class="col-md-9">
                                <div class="footer-link">
                                    <h6 class="text-white mb-3 text-uppercase">Contact Us</h6>
                                    <p class="text-white">D-166, D Block, Sector 10, Noida, Uttar Pradesh 201301</p>
                                    <ul class="m-0 p-0 call-ifo">
                                        <li><span><img src="images/icons/call.png" alt=""></span><a
                                                href="tel:+91-954-016-6789"> +91-954-016-6789</a></li>
                                        <li><span><img src="images/icons/phone.png" alt=""></span><a
                                                href="tel:+91-120-429-0302"> +91-120-429-0302</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="footer-link">
                                    <h6 class="text-white mb-3 text-uppercase">Follow Us</h6>
                                    <ul class="m-0 p-0">
                                        <li><span><i class="fa-brands fa-facebook-f"></i></span><a href="#">Facebook</a>
                                        </li>
                                        <li><span><i class="fa-brands fa-instagram"></i></span><a href="#">Instagram</a>
                                        </li>
                                        <li><span><i class="fa-brands fa-linkedin-in"></i></span><a
                                                href="#">Linkedin</a></li>
                                        <li><span><i class="fa-brands fa-youtube"></i></span><a href="#">YouTube</a>
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
                        Copyright © 2023. Career-Boss. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#">Privacy Policy </a> <span>|</span> <a href="#">Terms of use</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
    <script src="js/owl.carousel.js"></script>

</body>

</html>
*/ ?>