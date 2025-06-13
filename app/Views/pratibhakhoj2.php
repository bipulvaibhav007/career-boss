<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pratibhakhoj</title>
    <link rel="stylesheet" href="<?=base_url('public/assets/css/style.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/owl.carousel.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/media-query.css')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Khand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<body>

    <div class="logo-banenr text-center">
        <a href="<?=base_url(); ?>"> <img src="<?=base_url('public/assets/images/career-logo.png')?>" alt=""></a>
    </div>

    <section class="career-heropanel google-add panel-space ">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-md-7">
                    <div class="cmshero-infobox w-100">
                        <h1 class="bannr-title khand lt-space text-uppercase">Pratibha Khoj Scholarship</h1>

                        <p class="text-white lt-space mb-3">इंतजार खत्म हुआ, हमने प्रतिभा खोज स्कालर्शिप प्रवेश परीक्षा  की तारीख यानी <span class="fs-2 text-decoration-underline">29 अक्टूबर, 2023</span> घोषित कर दी है। अधिक विवरण नीचे हैं:</p>
                        <p class="text-white lt-space mb-3">
                           <strong> प्रश्न</strong> : मल्टीपल चॉइस प्रश्न <br>
                            <strong>प्रश्न संख्या</strong> : 45 <br>
                            <!-- समय : दोपहर 1:30 बजे से 2:15 बजे तक <br> -->
                           <strong> पता</strong>: कैरियर बॉस, पहली मंजिल, राजेंद्र नगर, यूनियन बैंक के पीछे, मोती सिनेमा हॉल के सामने
                            वाली गली में। <br></p>
                            <p class="text-white lt-space mb-3">
                            <strong>Google Map location</strong>: <a href="https://maps.app.goo.gl/Z22x81YuGYgudt7D7" target="_blank" class="text-white d-inline-block text-decoration-underline">https://maps.app.goo.gl/Z22x81YuGYgudt7D7</a>
                            <br>
                           </p>
                           <p class="text-white lt-space"> <strong>धन्यवाद</strong> <br>
                            <strong>करियर बॉस</strong> ( <a href="https://career-boss.com" class="text-white">https://career-boss.com</a> ) <br>
                            <a href="tel:+91-880-940-8811" class="text-white">+91-880-940-8811</a> <br>
                            <a href="tel:+91-6182-353339" class="text-white">+91-6182-353339</a></p>
                        <!-- <a href="<?=base_url('/contact')?>" class="submitBtn text-uppercase">Call Us now</a> -->
                    </div>
                </div>
                <div class="col-md-5 position-relative">
                    <div class="lets-work closed-form">
                        <!-- <div class="d-md-flex align-items-center mb-4 text-md-start text-center">
                            <div class="flex-shrink-0 mb-md-0 mb-3">
                                <img src="<?=base_url('public/assets/images/contac-find.png')?>" alt="...">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p>Let’s get your scholarship</p>
                                <h6>Contact us today</h6>
                            </div>
                        </div>
                        <div class="row">
                            <form action="<?=base_url('/pratibhakhoj2')?>" method="post" class="" id="enquiry_form">
                            <?= csrf_field() ?>

                            <div class="col-md-12 mb-4">
                                <div class="input-box">
                                    <span><img src="<?=base_url('public/assets/images/input-user.svg')?>" alt=""></span>
                                    <input type="text" name="name" placeholder="Name" value="<?=set_value('name')?>" required>
                                    <span class="text-danger" id="nameErr"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="input-box">
                                    <span><img src="<?=base_url('public/assets/images/innput-phone.svg')?>"
                                            alt=""></span>
                                    <input type="tel" name="phone" id="mobileNumber" placeholder="Phone No" maxlength = "10" value="<?=set_value('phone')?>" required>
                                    <span class="text-danger" id="phoneErr"><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="input-box">
                                    <span><img src="<?=base_url('public/assets/images/input-email.svg')?>"
                                            alt=""></span>
                                    <input type="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="#" class="submitBtn text-uppercase text-center w-100 mt-0">Send <span
                                        class="d-inline-block ms-2"><img
                                            src="<?=base_url('public/assets/images/toarrow.svg')?>" alt=""></span> </a>
                            </div>
                        </div> -->
                        <img src="<?=base_url('public/assets/images/closed.jpg')?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="panel-space scholarship-pro">
        <div class="container">
            <h2 class="scholarship-pro-title fs-4">चार प्रकार के स्कालर्शिप कार्यक्रम</h2>
            <p>प्रतिभा खोज में सभी छात्रों को विभिन्न प्रकार की स्कालर्शिप प्राप्त करने का मौका मिलेगा। प्रत्येक स्कालर्शिप का अपना लाभ होगा, विवरण नीचे है</p>
            <div class="top-sudent">
                <span class="line-panle d-block"></span>
                <span class="line-panle line-panle-two d-block"></span>
                <div class="top-student-banner">
                    <img class="free-percent" src="<?=base_url('public/assets/images/10Free.svg')?>" alt="">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="student-cont">
                                <h4 class="fs-3">टॉप 5 छात्रों को 100% स्कॉलरशिप मिलेगी</h4>
                                <p>इनमें से टॉप 5 छात्रों को करियर बॉस इंस्टीट्यूट में मुफ्त शिक्षा मिलेगा। हमारे संस्थान द्वारा कोई शुल्क नहीं लिया जाएगा। हमारा संस्थान ऐसे प्रतिभाशाली छात्रों की खोज कर रहा है जो सीखने के इच्छुक हैं लेकिन किसी कारणवश ऐसा नहीं कर पाते, इसलिए करियर बॉस इंस्टीट्यूट ने उन छात्रों को लाने का फैसला किया। </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <figure class="mb-0 student-with-bag">
                                <img src="<?=base_url('public/assets/images/wepik.png')?>" alt="">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="panel-space pt-0">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <figure class="mb-0">
                        <img class="w-100" src="<?=base_url('public/assets/images/40.png')?>" alt="">
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="mb-0">
                        <img class="w-100" src="<?=base_url('public/assets/images/60.png')?>" alt="">
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="mb-0">
                        <img class="w-100" src="<?=base_url('public/assets/images/80.png')?>" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="entrance-exam panel-space pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel-heding mb-4">
                        <h3 class="text-black text-uppercase mb-md-4">Entrance Exam</h3>
                        <p class="mb-3">निःशुल्क स्कॉलरशिप प्राप्त करने के लिए एक प्रवेश परीक्षा होगी जिसमें अंग्रेजी, गणित, विज्ञान और सामान्य ज्ञान से संबंधित सामान्य प्रश्न शामिल होंगे। इसमें समय सीमा के साथ मल्टीप्ल चॉइस  प्रश्न होंगे। परीक्षा के बाद हमारी संस्थान समिति टॉप 5 छात्रों को निःशुल्क शिक्षा के लिए चुनेगी।”
                        </p>
                       
                        <a href="<?=base_url('/contact')?>" class="submitBtn text-uppercase mb-4">Call Us now</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="exam-hal">
                        <img src="<?=base_url('public/assets/images/exam-hal.png')?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
    <script src="<?=base_url('public/assets/js/custom.js')?>"></script>
    <script src="<?=base_url('public/assets/js/owl.carousel.js')?>"></script>
    <script src="<?=base_url('public/assets/js/sweetalert.min.js')?>"></script>


</body>

</html>