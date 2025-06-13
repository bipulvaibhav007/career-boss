
    <?php 
    $url = '';
    if(isset($banner) && $banner->brochure != ''){
        $url = base_url('public/assets/upload/images/'.$banner->brochure);
    } ?>
    <section class="banner cms-banner position-relative bg-img d-flex align-items-center blog-banner"
        style="background-image: url(<?=$url?>);" alt="<?=$banner->img_alt; ?>" title="<?=$banner->img_title; ?>">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="banner-content">
                        <h1 class="khand lt-space text-uppercase"><?=(isset($banner->main_title))?$banner->main_title:''?></h1>
                        <p class="lt-space"><?=(isset($banner->sub_title))?$banner->sub_title:''?></p>
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control lt-space" placeholder="Search blog" value="<?=(isset($_GET['search']) && $_GET['search'] != '')?$_GET['search']:''?>" required>
                                <div class="input-group-append">
                                    <button class="btn" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php if(!isset($_GET['search']) || $_GET['search'] == ''){ ?>
    <section class="blog-panel panel-space pb-0">
        <div class="container">
            <div class="panel-heding mb-4">
                <h3 class="text-black">Recent <span class="text-blue">Blog Post</span></h3>
            </div>
            <div class="row g-md-5 g-4">
                <div class="col-lg-6">
                    <a href="<?=(isset($recent_blog[0]) && $recent_blog[0]->blog_url != '')?base_url('/blog/'.$recent_blog[0]->blog_url):'#'?>">
                        <div class="blog-box">
                            <figure>
                                <?php $url = '';
                                if(isset($recent_blog[0]) && $recent_blog[0]->blog_image != ''){
                                    $url = base_url('public/assets/upload/images/'.$recent_blog[0]->blog_image);
                                } ?>
                                <img src="<?=$url?>" alt="<?=$recent_blog[0]->alt_text?>" title="<?=$recent_blog[0]->title_text?>">
                            </figure>

                            <div class="blog-cnt">
                                <span class="text-black"><?=(isset($recent_blog[0]))?date('d M, Y', strtotime($recent_blog[0]->post_date)):''?></span>
                                <h6 class="text-black"><?=(isset($recent_blog[0]))?$recent_blog[0]->blog_title:''?><span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt="rotet-arrow.png" title="rotet-arrow.png"></span></h6>
                                <p><?=(isset($recent_blog[0]))?$recent_blog[0]->summary:''?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6">
                    <?php if(isset($recent_blog[1])){ ?>
                    <div class="blog-right-box">
                        <a href="<?=(isset($recent_blog[1]) && $recent_blog[1]->blog_url != '')?base_url('/blog/'.$recent_blog[1]->blog_url):'#'?>">
                            <div class="d-md-flex">
                                <div class="flex-shrink-0">
                                    <figure>
                                        <?php $url = '';
                                        if(isset($recent_blog[1]) && $recent_blog[1]->blog_image != ''){
                                            $url = base_url('public/assets/upload/images/'.$recent_blog[1]->blog_image);
                                        } ?>
                                        <img src="<?=$url?>" alt="<?=$recent_blog[1]->alt_text?>" title="<?=$recent_blog[1]->title_text?>">
                                    </figure>
                                </div>
                                <div class="flex-grow-1 ms-md-3">
                                    <div class="blog-cnt">
                                        <span class="text-black"><?=(isset($recent_blog[1]))?date('d M, Y', strtotime($recent_blog[1]->post_date)):''?></span>
                                        <h6 class="text-black"><?=(isset($recent_blog[1]))?$recent_blog[1]->blog_title:''?></h6>
                                        <p><?=(isset($recent_blog[1]))?$recent_blog[1]->summary:''?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                    <?php if(isset($recent_blog[2])){ ?>
                    <div class="blog-right-box">
                        <a href="<?=(isset($recent_blog[2]) && $recent_blog[2]->blog_url != '')?base_url('/blog/'.$recent_blog[2]->blog_url):'#'?>">
                            <div class="d-md-flex">
                                <div class="flex-shrink-0">
                                    <figure>
                                        <?php $url = '';
                                        if(isset($recent_blog[2]) && $recent_blog[2]->blog_image != ''){
                                            $url = base_url('public/assets/upload/images/'.$recent_blog[2]->blog_image);
                                        } ?>
                                        <img src="<?=$url?>" alt="<?=$recent_blog[2]->alt_text?>" title="<?=$recent_blog[2]->title_text?>">
                                    </figure>
                                </div>
                                <div class="flex-grow-1 ms-md-3">
                                    <div class="blog-cnt">
                                        <span class="text-black"><?=(isset($recent_blog[2]))?date('d M, Y', strtotime($recent_blog[2]->post_date)):''?></span>
                                        <h6 class="text-black"><?=(isset($recent_blog[2]))?$recent_blog[2]->blog_title:''?></h6>
                                        <p><?=(isset($recent_blog[2]))?$recent_blog[2]->summary:''?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <section class="all-blog panel-space">
        <div class="container">
            <div class="panel-heding mb-4">
                <h3 class="text-black">All Blog Post</h3>
            </div>
            <div class="row g-4">
                <?php if(isset($blogs) && !empty($blogs)){
                foreach($blogs as $list){ ?>
                <div class="col-md-4">
                    <a href="<?=base_url('/blog/'.$list->blog_url)?>">
                        <div class="blog-post">
                            <figure>
                                <img src="<?=base_url('public/assets/upload/images/'.$list->blog_image)?>" alt="<?=$list->alt_text?>" title="<?=$list->title_text?>">
                            </figure>
                            <div class="blog-cnt">
                                <span class="text-black"><?=date('d M, Y', strtotime($list->post_date))?></span>
                                <h6 class="text-black"><?=substr($list->blog_title,0,80).'...'?><span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt="rotet-arrow.png" title="rotet-arrow.png"></span></h6>
                                <p><?=substr($list->summary,0,80).'...'?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php  } }else{
                    echo '<p class="text-danger">No Blog Found</p>';
                } ?>
                <?php /* <div class="col-md-4">
                    <a href="#">
                        <div class="blog-post">
                            <figure>
                                <img src="<?=base_url('public/assets/images/blog.png')?>" alt="">
                            </figure>
                            <div class="blog-cnt">
                                <span class="text-black">21 Jul 2023</span>
                                <h6 class="text-black">Sit amet consectetur adipiscing <span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt=""></span></h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="blog-post">
                            <figure>
                                <img src="<?=base_url('public/assets/images/blog.png')?>" alt="">
                            </figure>
                            <div class="blog-cnt">
                                <span class="text-black">21 Jul 2023</span>
                                <h6 class="text-black">Sit amet consectetur adipiscing <span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt=""></span></h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="blog-post">
                            <figure>
                                <img src="<?=base_url('public/assets/images/blog.png')?>" alt="">
                            </figure>
                            <div class="blog-cnt">
                                <span class="text-black">21 Jul 2023</span>
                                <h6 class="text-black">Sit amet consectetur adipiscing <span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt=""></span></h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="blog-post">
                            <figure>
                                <img src="<?=base_url('public/assets/images/blog.png')?>" alt="">
                            </figure>
                            <div class="blog-cnt">
                                <span class="text-black">21 Jul 2023</span>
                                <h6 class="text-black">Sit amet consectetur adipiscing <span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt=""></span></h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="blog-post">
                            <figure>
                                <img src="<?=base_url('public/assets/images/blog.png')?>" alt="">
                            </figure>
                            <div class="blog-cnt">
                                <span class="text-black">21 Jul 2023</span>
                                <h6 class="text-black">Sit amet consectetur adipiscing <span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt=""></span></h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="blog-post">
                            <figure>
                                <img src="<?=base_url('public/assets/images/blog.png')?>" alt="">
                            </figure>
                            <div class="blog-cnt">
                                <span class="text-black">21 Jul 2023</span>
                                <h6 class="text-black">Sit amet consectetur adipiscing <span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt=""></span></h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="blog-post">
                            <figure>
                                <img src="<?=base_url('public/assets/images/blog.png')?>" alt="">
                            </figure>
                            <div class="blog-cnt">
                                <span class="text-black">21 Jul 2023</span>
                                <h6 class="text-black">Sit amet consectetur adipiscing <span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt=""></span></h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="blog-post">
                            <figure>
                                <img src="<?=base_url('public/assets/images/blog.png')?>" alt="">
                            </figure>
                            <div class="blog-cnt">
                                <span class="text-black">21 Jul 2023</span>
                                <h6 class="text-black">Sit amet consectetur adipiscing <span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt=""></span></h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="blog-post">
                            <figure>
                                <img src="<?=base_url('public/assets/images/blog.png')?>" alt="">
                            </figure>
                            <div class="blog-cnt">
                                <span class="text-black">21 Jul 2023</span>
                                <h6 class="text-black">Sit amet consectetur adipiscing <span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt=""></span></h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="blog-post">
                            <figure>
                                <img src="<?=base_url('public/assets/images/blog.png')?>" alt="">
                            </figure>
                            <div class="blog-cnt">
                                <span class="text-black">21 Jul 2023</span>
                                <h6 class="text-black">Sit amet consectetur adipiscing <span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt=""></span></h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </a>
                </div>
              
                <div class="col-md-4">
                    <a href="#">
                        <div class="blog-post">
                            <figure>
                                <img src="<?=base_url('public/assets/images/blog.png')?>" alt="">
                            </figure>
                            <div class="blog-cnt">
                                <span class="text-black">21 Jul 2023</span>
                                <h6 class="text-black">Sit amet consectetur adipiscing <span class="float-end"><img
                                            src="<?=base_url('public/assets/images/icons/rotet-arrow.png')?>" alt=""></span></h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </a>
                </div> */ ?>
            </div>
        </div>
    </section>

    