
    <?php 
    //print_r($blog); exit;
    $url = '';
    if(isset($banner) && $banner->brochure != ''){
        $url = base_url('public/assets/upload/images/'.$banner->brochure);
    } ?>
    <section class="banner cms-banner position-relative bg-img d-flex  align-items-center blog-banner"
        style="background-image: url(<?=$url?>);" alt="<?=$banner->img_alt; ?>" title="<?=$banner->img_title; ?>">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner-content">
                        <h2 class="khand lt-space text-uppercase" style="font-size: 40px"><?=(isset($banner->main_title))?$banner->main_title:''?></h2>
                        <p class="lt-space"><?=(isset($banner->sub_title))?$banner->sub_title:''?></p>
                        
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="blog-panel panel-space blog-dtl">
        <div class="container">
            <div class="panel-heding mb-4">
                <h1 class="text-black" style="font-size:28px"><?=(isset($blog->blog_title))?$blog->blog_title:''?></h1>
            </div>
            <div class="row g-md-5 g-4">
                <div class="col-md-9">
                    <!-- <a href="#"> -->
                        <div class="blog-box">
                            <figure>
                                <img src="<?=(isset($blog->blog_image) && $blog->blog_image != '')?base_url('public/assets/upload/images/'.$blog->blog_image):''?>" alt="<?=$blog->alt_text?>" title="<?=$blog->title_text?>">
                            </figure>

                            <div class="blog-cnt">
                                 <?=(isset($blog->blog_details))?$blog->blog_details:''?>   
                                
                            </div>

                            <?php 
                            $commonmodel = model('App\Models\Common_model', false);
                            $blogFaqs = $commonmodel->getAllRecord('tbl_blog_faq',['blg_id'=>$blog->blg_id, 'status'=>1]);
                            if(!empty($blogFaqs)){ ?>
                            <div class="container">
                                <div class="panel-heding mb-md-4 mb-lg-5 text-center">
                                    <h3 class="text-black">Frequently Asked Question</h3>
                                </div>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <?php 
                                    foreach($blogFaqs as $key=>$list){ ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading<?=$key?>">
                                            <button class="accordion-button <?=($key >= 1)?'collapsed':''?>" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse<?=$key?>" aria-expanded="false" aria-controls="flush-collapse<?=$key?>">
                                                <h4><?=$list->faq_title?></h4>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse<?=$key?>" class="accordion-collapse <?=($key < 1)?'collapse show':'collapse'?>" aria-labelledby="flush-heading<?=$key?>"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body"><p class="mb-0 text-light-black"><?=$list->faq_description?></p></div>
                                        </div>
                                    </div>
                                    <?php }  ?>

                                    <?php /* <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                <h4>What technologies will I learn in the Full Stack course?</h4>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="mb-0 text-light-black">
                                                    Placeholder content for this accordion, which is intended to
                                                    demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion
                                                    body. Let's imagine this being filled with some actual content.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                                aria-controls="flush-collapseThree">
                                                <h4>What kind of projects will I work on during the Full Stack course?</h4>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="mb-0 text-light-black">Placeholder content for this accordion, which is intended to
                                                    demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                                                    body. Nothing more exciting happening here in terms of content, but just filling up the
                                                    space to make it look, at least at first glance, a bit more representative of how this would
                                                    look in a real-world application.</p>
                                            </div>
                                        </div>
                                    </div> */ ?>
                                </div>
                            </div> <!-- end container --> <?php } ?>
                        </div>
                    <!-- </a> -->
                </div>
                <div class="col-md-3">
                    <form action="<?=base_url('blogs')?>" method="get" id="">
                        <?php //csrf_field(); ?>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control lt-space"
                                placeholder="Search blog" value="" required>
                            <div class="input-group-append">
                                <button class="btn" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                    <?php if(!empty($blog2)){
                    foreach($blog2 as $list){ ?>
                    <div class="blog-right-box">
                        <a href="<?=base_url('/blog/'.$list->blog_url)?>">
                            <div class="d-md-flex">
                                <div class="flex-shrink-0">
                                    <figure>
                                        <img src="<?=base_url('public/assets/upload/images/'.$list->blog_image)?>" alt="<?=$list->alt_text?>" title="<?=$list->title_text?>">
                                    </figure>
                                </div>
                                <div class="flex-grow-1 ms-md-3">
                                    <div class="blog-cnt">
                                        <span class="text-black"><?=date('d M, Y', strtotime($list->post_date))?></span>
                                        <h6 class="text-black"><?=$list->blog_title?></h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } } ?>
                    <?php /* 
                    <div class="blog-right-box">
                        <a href="#">
                            <div class="d-block">
                                <div class="flex-shrink-0">
                                    <figure>
                                        <img src="<?=base_url('public/assets/images/blog.png')?>" alt="">
                                    </figure>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="blog-cnt">
                                        <span class="text-black">21 Jul 2023</span>
                                        <h6 class="text-black">Sit amet consectetur adipiscing </h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    */ ?>
                </div>
            </div>
        </div>
    </section>

    