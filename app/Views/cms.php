    <?php $url = '';
        if(isset($cms->cms_banner)){
            $url = base_url('public/assets/upload/images/'.$cms->cms_banner); 
        } ?>
    <section class="banner cms-banner position-relative bg-img d-flex  align-items-center"
        style="background-image: url(<?=$url?>);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner-content contact-us">
                        <h1 class="khand lt-space text-uppercase"><?=(isset($cms->title))?$cms->title:''?></h1>
                        <p class="lt-space"><?=(isset($cms->short_desc))?$cms->short_desc:''?></p>
                        <?php /* <a href="https://api.whatsapp.com/send?phone=919540166789" target="blank" class="link-btn khand text-uppercase lt-space"><span><img src="<?=base_url('public/assets/images/icons/whatsapp.png')?>" alt=""></span>Let’s Chat </a> */ ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="panel-space">
       <div class="container">
       <?=(isset($cms->description1))?$cms->description1:''?>
       </div>
    </section>