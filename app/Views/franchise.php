<style>
  .franchise-section {
    padding-top: 200px;
    width: 100%;
    height: 500px;
    color: white;
    background-color: DodgerBlue;

    text-align: center;
  }
  .home-testimonial {
    background-color: #231834;
  }
  .home-testimonial-bottom {
    transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
    margin-top: 20px;
    margin-bottom: 0px;
    position: relative;
  }
  .home-testimonial h3 {
    color: var(--orange);
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
  }
  h2 {
    font-size: 28px;
    font-weight: 700;
  }
  .home-testimonial h2 {
    color: white;
  }
  .testimonial-inner {
    position: relative;
  }
  .testimonial-pos {
    position: relative;
    top: 24px;
  }
  .testimonial-inner .tour-desc {
    border-radius: 5px;
    padding: 40px;
  }
  .color-grey-3 {
    font-family: "Montserrat", Sans-serif;
    font-size: 14px;
    color: #6c83a2;
  }
  .testimonial-inner img.tm-people {
    width: 60px;
    height: 60px;
    -webkit-border-radius: 50%;
    border-radius: 50%;
    -o-object-fit: cover;
    object-fit: cover;
    max-width: none;
  }
  .link-name {
    font-size: 14px;
    color: #6c83a2;
  }
  .link-position {
    font-size: 12px;
    color: #6c83a2;
  }
  #partner .services-row-space {
    min-height: 230px;
  }
</style>
<?php $commonmodel = model('App\Models\Common_model', false);
$settings = $commonmodel->get_setting(session('dh_id')); ?>
<section class="bg-dark py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="frans-banner-left text-white">
          <h5><?=(isset($sections))?$sections->title_1:''?></h5>
          <h2><?=(isset($sections))?$sections->title_2:''?></h2>
          <p class="text-white"><?=(isset($sections))?$sections->banner_content:''?></p>
          <a href="<?=base_url('/register')?>" class="btn btn-success">Register Now</a>
        </div>
      </div>
      <div class="col-md-6 d-none d-md-block"><img class="img-fluid rounded" src="<?=(isset($sections->banner_image) && $sections->banner_image != '')?base_url('public/assets/upload/images/'.$sections->banner_image):''?>" alt="banner" title="banner"/></div>
    </div>
  </div>
</section>
<?php if(isset($sections) && $sections->is_show_sec2){ ?>
<section class="py-5 py-md-5">
  <div class="container">
    <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
      <div class="col-12 col-lg-6 col-xl-5">
        <img class="img-fluid rounded" loading="lazy" src="<?=(isset($sections->sec2_image) && $sections->sec2_image != '')?base_url('public/assets/upload/images/'.$sections->sec2_image):''?>" alt="image" title="image"/>
      </div>
      <div class="col-12 col-lg-6 col-xl-7">
        <div class="row justify-content-xl-center">
          <div class="col-12 col-xl-11">
            <h2 class="mb-3">Why Choose Us?</h2>
            <p class="mb-5"><?=$sections->why_choose_us?></p>
            <div class="row gy-4 gy-md-0 gx-xxl-5X">
              <div class="col-12 col-md-6">
                <div class="d-flex">
                  <div>
                    <h5 class="mb-3">Comprehensive Training</h5>
                    <p class="text-secondary mb-0"><?=$sections->comp_training?></p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="d-flex">
                  <div>
                    <h5 class="mb-3">Ongoing Support</h5>
                    <p class="text-secondary mb-0"><?=$sections->ongo_support?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>

<?php if(isset($sections) && $sections->is_show_sec3){ ?>
<section class="container-fluid py-5 bg-light">
  <div class="container" id="partner">
    <h2 class="text-center mb-4">Our Franchise Benefits</h2>
    <div class="row">
      <div class="col-md-4 left-column pt-5">
        <div class="services-row-space text-center text-md-end">
          <div>
            <img src="<?=base_url('public/assets/images/brand.png')?>" alt="icon" />
          </div>
          <h5 class="mt-2"><?=$sections->title1?></h5>
          <p class="right"><?=$sections->text1?></p>
        </div>

        <div class="services-row-space text-center text-md-end">
          <div>
            <img src="<?=base_url('public/assets/images/training.png')?>" alt="icon" />
          </div>
          <h5 class="mt-2"><?=$sections->title2?></h5>
          <p class="right"><?=$sections->text2?></p>
        </div>

        <div class="services-row-space text-center text-md-end">
          <div>
            <img src="<?=base_url('public/assets/images/crm.png')?>" alt="icon" />
          </div>
          <h5 class="mt-2"><?=$sections->title3?></h5>
          <p class="right"><?=$sections->text3?></p>
        </div>
      </div>

      <div class="col-md-4 common-res-bottom common-res-bottom-1 d-none d-md-block">
        <div class="center">
          <img src="<?=(isset($sections->center_image) && $sections->center_image != '')?base_url('public/assets/upload/images/'.$sections->center_image):''?>" alt="Institution app" title="Institution app" class="img-responsive image-center image-grow" />
        </div>
      </div>
      <div class="col-md-4 res-services-center pt-5">
        <div class="services-row-space text-center text-md-start">
          <div>
            <img src="<?=base_url('public/assets/images/model.png')?>" alt="icon" />
          </div>
          <h5 class="mt-2"><?=$sections->title4?></h5>
          <p class="left"><?=$sections->text4?></p>
        </div>

        <div class="services-row-space text-center text-md-start">
          <div>
            <img src="<?=base_url('public/assets/images/development.png')?>" alt="icon" />
          </div>
          <h5 class="mt-2"><?=$sections->title5?></h5>
          <p class="left"><?=$sections->text5?></p>
        </div>

        <div class="services-row-space text-center text-md-start">
          <div>
            <img src="<?=base_url('public/assets/images/innovative.png')?>" alt="icon" />
          </div>
          <h5 class="mt-2"><?=$sections->title6?></h5>
          <p class="left"><?=$sections->text6?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container-fluid py-5">
  <div class="container">
    <div class="row white-text">
      <div class="col-md-3 col-sm-3 col-xs-6 text-center">
        <div class="mb-3">
          <img src="<?=base_url('public/assets/images/franchise.png')?>" alt="icon" />
        </div>
        <h2 class="fw-bold"><?=$sections->franchise?></h2>
        <p class="counter-sub">+ FRANCHISEES</p>
      </div>

      <div class="col-md-3 col-sm-3 col-xs-6 text-center">
        <div class="mb-3">
          <img src="<?=base_url('public/assets/images/graph.png')?>" alt="icon" />
        </div>
        <h2 class="fw-bold"><?=$sections->yearsrd?></h2>
        <p class="counter-sub">YEARS R&amp;D</p>
      </div>

      <div class="col-md-3 col-sm-3 col-xs-6 text-center">
        <div class="mb-3">
          <img src="<?=base_url('public/assets/images/workshop.png')?>" alt="icon" />
        </div>
        <h2 class="fw-bold"><?=$sections->seminars?></h2>
        <p class="counter-sub">+ SEMINARS &amp; WORKSHOPS</p>
      </div>

      <div class="col-md-3 col-sm-3 col-xs-6 text-center">
        <div class="mb-3">
          <img src="<?=base_url('public/assets/images/training.png')?>" alt="icon" />
        </div>
        <h2 class="fw-bold"><?=$sections->audience?></h2>
        <p class="counter-sub">LAKHS+ AUDIENCE TRAINED</p>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?php if(isset($sections) && $sections->is_show_sec4){ ?>
<section class="home-testimonial py-5">
  <div class="container-fluid">
    <div class="row d-flex justify-content-testimonial-pos">
      <div class="col-md-12 d-flex justify-content-center">
        <h2>Explore the other franchise experience</h2>
      </div>
    </div>
    <section class="home-testimonial-bottom">
      <div class="container testimonial-inner">
        <div class="row d-flex justify-content-center">
          <div class="col-md-4 mb-4 mb-md-0">
            <div class="tour-item">
              <div class="tour-desc bg-white">
                <div class="tour-text color-grey-3 text-center"><?=$sections->f1dtl?></div>
                <div class="d-flex justify-content-center pt-2 pb-2"><img class="tm-people" src="<?=(isset($sections->f1photo) && $sections->f1photo != '')?base_url('public/assets/upload/images/'.$sections->f1photo):''?>" alt="franchise1 photo" title="franchise1 photo" /></div>
                <div class="link-name d-flex justify-content-center"><?=$sections->f1name?></div>
                <div class="link-position d-flex justify-content-center"><?=$sections->f1ocp?></div>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4 mb-md-0">
            <div class="tour-item">
              <div class="tour-desc bg-white">
                <div class="tour-text color-grey-3 text-center"><?=$sections->f2dtl?></div>
                <div class="d-flex justify-content-center pt-2 pb-2"><img class="tm-people" src="<?=(isset($sections->f2photo) && $sections->f2photo != '')?base_url('public/assets/upload/images/'.$sections->f2photo):''?>" alt="franchise2 photo" title="franchise2 photo" /></div>
                <div class="link-name d-flex justify-content-center"><?=$sections->f2name?></div>
                <div class="link-position d-flex justify-content-center"><?=$sections->f2ocp?></div>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4 mb-md-0">
            <div class="tour-item">
              <div class="tour-desc bg-white">
                <div class="tour-text color-grey-3 text-center"><?=$sections->f3dtl?></div>
                <div class="d-flex justify-content-center pt-2 pb-2"><img class="tm-people" src="<?=(isset($sections->f3photo) && $sections->f3photo != '')?base_url('public/assets/upload/images/'.$sections->f3photo):''?>" alt="franchise3 photo" title="franchise3 photo" /></div>
                <div class="link-name d-flex justify-content-center"><?=$sections->f3name?></div>
                <div class="link-position d-flex justify-content-center"><?=$sections->f3ocp?></div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </section>
  </div>
</section>
<?php } ?>

<section class="py-5">
  <div class="container">
    <div class="row d-flex justify-content-testimonial-pos">
      <div class="col-md-12 text-center">
        <h2>Ready to start your journey with Career Boss Institute?</h2>
        <h5 class="mb-3">Fill out the form below to get started!</h5>
        <a href="<?=base_url('/register')?>" class="btn btn-success">Register Now</a>
      </div>
    </div>
  </div>
</section>
