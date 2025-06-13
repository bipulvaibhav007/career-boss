<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php $segment1 = service('uri')->getSegment(1);
    if($segment1 == ''){ ?>
        <title>Digital Marketing, Software Development, App Development course | Career Boss Institute</title>
    <?php }else if($segment1=="bca-tuition-for-all-semester"){ ?>
        <title>Best BCA Tuition and training institutes Near Me | Career Boss Institute</title>
    <?php }else if($segment1 == 'course-detail'){ ?>
        <title> <?=(isset($cDtls->meta_title))?$cDtls->meta_title:'Career-Boss'?> </title>
    <?php }else{ ?>
        <title> <?=(isset($blog->meta_title))?$blog->meta_title:'Career-Boss'?> </title>
    <?php } ?>

    <link rel="icon" type="image/x-icon" href="<?=base_url('public/assets/images/icons/LOGOS.png')?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/style.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/owl.carousel.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/media-query.css')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="canonical" href="https://career-boss.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Khand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" ></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <?php if($segment1 == ''){ ?>
        <meta name="description" content="Unlock your potential with our comprehensive courses in Digital Marketing, Software Development and App Development. Join us to gain the skills you need for success in the digital world.">
        <meta name="keywords" content="Digital Marketing Courses, Email Marketing Courses, HTML Development Courses, Web Development Courses, Fullstack Development Courses, Frontend Development Courses, Image and Video editing Courses, Mobile app Development Courses, UX and UI Designing Courses">
        <?php }else if($segment1=="bca-tuition-for-all-semester"){ ?>
            <meta name="description" content="Career Boss Institute has the best coaching and training institutes in Ara offering BCA Tuition courses and classes for better preparation.">
            <meta name="keywords" content="Top BCA institutes, Online BCA tuition, BCA entrance exam preparation, Best BCA Tuition Near Me">
    <?php }else if($segment1 == 'course-detail'){ ?> 
        <meta name="description" content="<?=(isset($cDtls->meta_description))?$cDtls->meta_description:''?>">
        <meta name="keywords" content="<?=(isset($cDtls->meta_keyword))?$cDtls->meta_keyword:''?>">
    <?php }else{ ?>
        <meta name="description" content="<?=(isset($blog->meta_description))?$blog->meta_description:''?>">
        <meta name="keywords" content="<?=(isset($blog->meta_keyword))?$blog->meta_keyword:''?>">
    <?php } ?>
    
    <meta name="author" content="Career Boss Institute">
    <meta name="Publisher" content="Career Boss Institute"/>
    <meta name="Robots" content="index,follow"/>
    <meta name="YahooSeeker" content="index,follow"/>
    <meta name="msnbot" content="index,follow"/>
    <meta name="googlebot" content="index,follow"/>
    <meta name="allow-search" content="yes"/>
    <meta name="Rating" content="General"/>
    <meta name="language" content="English">
    <meta name="geo.region" content="IN-BR" />
    <meta name="geo.placename" content="Ara" />
    <meta name="geo.position" content="25.55779;84.667768" />
    <meta name="ICBM" content="25.55779, 84.667768" />
    <meta name="og:type" content="<?=(isset($cDtls->og_type))?$cDtls->og_type:''?>">
    <meta name="og:url" content="<?=(isset($cDtls->og_url))?$cDtls->og_url:''?>">
    <meta name="og:title" content="<?=(isset($cDtls->og_title))?$cDtls->og_title:''?>">
    <meta name="og:image" content="<?=(isset($cDtls->og_image))?base_url('public/assets/upload/images/'.$cDtls->og_image):''?>">
    <meta name="og:site_name" content="<?=(isset($cDtls->og_site_name))?$cDtls->og_site_name:''?>">
    <meta name="og:description" content="<?=(isset($cDtls->og_description))?$cDtls->og_description:''?>">

    <meta name="google-site-verification" content="vQUjvhvxzVrbKD8mXcTDgNm6fJggyXz2DzY8JOrk06w" />
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0ZGV19JF73"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0ZGV19JF73');
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/652f83bdf2439e1631e5a1ae/1hd0pl78u';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Career Boss Institute",
  "image": "https://career-boss.com/public/assets/images/career-logo.png",
  "@id": "",
  "url": "https://career-boss.com/",
  "telephone": "+918809408811",
  "priceRange": "$$$$",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Career Boss, 1st Floor, Rajendra Nagar",
    "addressLocality": "Ara",
    "postalCode": "802301",
    "addressCountry": "IN"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 25.557712696445627,
    "longitude": 84.66787170768767
  },
"reviews-schema": {
        "@context": "http://schema.org",
        "@type": "Product",
        "name": "Career Boss Istitute",
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "5",
            "reviewCount": "1"
        }
    },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Monday"
    ],
    "opens": "10:00",
    "closes": "07:00"
  },
  "sameAs": [
    "https://www.facebook.com/careerbossinstitute",
    "https://twitter.com/careerbossinsti",
    "https://www.instagram.com/careerbossinstitute/",
    "https://www.youtube.com/@careerbossinstitute",
    "https://www.linkedin.com/company/career-boss-institute/",
    "https://career-boss.com/"
  ] 
}
</script>
</head>

<body>
    <?php $segment1 = service('uri')->getSegment(1); ?>
    <header class="header <?=($segment1 == 'enquiry' || $segment1 == 'pratibhakhoj' || $segment1 == 'page-not-found' || $segment1 == 'image-editing-bootcamp' || $segment1 == 'html-coding-bootcamp' || $segment1 == 'bca-tuition-for-all-semester' || $segment1 == 'login')?'enquiry':''?>">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">
                <div class="logo-section">
                    <a class="navbar-brand" href="<?=base_url(); ?>">
                        <img class="d-lg-block" src="<?=base_url('public/assets/images/career-logo.png')?>" alt="">
                    </a>
                </div>

                <a href="javascript:void(0);" class="admission-btn common_enquiry" data-type="Admission open | Header">Admission <span
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
                                <li class="nav-item nav-dropdown">
                                    <a class="nav-link khand <?=($segment1 == 'course-detail')?'active':''?>" href="#">Courses <span><i class="fa-solid fa-angle-down"></i></span></a>
                                    <?php 
                                        $commonmodel = model('App\Models\Common_model', false);
                                        $courses = $commonmodel->getAllRecord('tbl_courses',['status'=>1]);
                                    ?>
                                    <div class="drop-down">
                                        <ul class="drop-down-list">
                                            <li class="nav-item">
                                                <a class="nav-link khand " aria-current="page" href="<?=base_url('bca-tuition-for-all-semester')?>">BCA Tuition</a>
                                            </li>
                                            <?php if(!empty($courses)){
                                                foreach($courses as $list){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="<?=base_url('course-detail/'.$list->url)?>"><?=$list->course_full_name?></a>
                                            </li>
                                            <?php } } ?>
                                            <?php /* <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="#">Email Marketing & Sales</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="#">For Beginners</a>
                                            </li> */ ?>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link khand <?=($segment1 == 'about-us')?'active':''?>" aria-current="page" href="<?=base_url('about-us')?>">Referer</a>
                                </li>
                                <?php /* <li class="nav-item">
                                    <a class="nav-link khand <?=($segment1 == 'about-us')?'active':''?>" aria-current="page" href="<?=base_url('about-us')?>">About</a>
                                </li> */ ?>
                                <?php /* <li class="nav-item">
                                    <a class="nav-link khand <?=($segment1 == 'bca-tuition-for-all-semester')?'active':''?>" aria-current="page" href="<?=base_url('bca-tuition-for-all-semester')?>">BCA Tuition</a>
                                </li> */ ?>
                                <?php /* 
                                <li class="nav-item  nav-dropdown">
                                    <a class="nav-link khand <?=($segment1 == 'bootcamp')?'active':''?>" aria-current="page" href="#">Bootcamp <span><i class="fa-solid fa-angle-down"></i></span></a>
                                    <div class="drop-down">
                                        <ul class="drop-down-list">
                                           
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="<?=base_url('image-editing-bootcamp')?>">Image Editing Bootcamp</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="<?=base_url('html-coding-bootcamp')?>">HTML Coding Bootcamp</a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </li>
                                */ ?>
                                
                                <?php /*<li class="nav-item">
                                    <a class="nav-link khand" href="<?=base_url('career')?>">Career</a>
                                </li> */ ?>
                                <li class="nav-item">
                                    <a class="nav-link khand <?=($segment1 == 'placement')?'active':''?>" href="<?=base_url('/placement')?>">Placement</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link khand <?=($segment1 == 'blogs')?'active':''?>" href="<?=base_url('/blogs')?>">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link khand <?=($segment1 == 'contact')?'active':''?>" href="<?=base_url('contact')?>">Contact</a>
                                </li>
                                <?php if(session()->has('MemberIsLoggedIn')){ ?>
                                <li class="nav-item  nav-dropdown">
                                    <a class="nav-link khand <?=($segment1 == 'member-dashboard')?'active':''?>" aria-current="page" href="#">My Account <span><i class="fa-solid fa-angle-down"></i></span></a>
                                    <div class="drop-down">
                                        <ul class="drop-down-list">
                                        
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="<?=base_url('/member-dashboard')?>">Dashboard</a>
                                            </li>
                                            <?php /* <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="<?=base_url('html-coding-bootcamp')?>">HTML Coding Bootcamp</a>
                                            </li> */ ?>
                                        
                                        </ul>
                                    </div>
                                </li>
                                <?php }else{ ?>
                                <li class="nav-item  nav-dropdown">
                                    <a class="nav-link khand <?=($segment1 == 'login')?'active':''?>" aria-current="page" href="#">Login <span><i class="fa-solid fa-angle-down"></i></span></a>
                                    <div class="drop-down">
                                        <ul class="drop-down-list">
                                        
                                            <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="<?=base_url('login')?>">Login</a>
                                            </li>
                                            <?php /* <li class="nav-item">
                                                <a class="nav-link khand" aria-current="page" href="<?=base_url('html-coding-bootcamp')?>">HTML Coding Bootcamp</a>
                                            </li> */ ?>
                                        
                                        </ul>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    
    <?php if($segment1 != ''){ ?>
        <a href="javascript:void(0);" class="enqure-now common_enquiry" data-type="Enquire Now | Right Button"><span><img src="<?=base_url('public/assets/images/icons/info.svg')?>" alt=""></span>Enquire Now</a>
    <?php } ?>