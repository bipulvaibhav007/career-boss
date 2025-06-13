
<?php /*echo session('token'); exit;*/?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2 col-md-3 sidebar" >
        <div class="side-navbar flex-wrap flex-column" id="sidebar">
          <!-- <nav class="navbar  navbar-field top-navbar hidbutton  ">
            <a class="btn border-1" id="open-menu-btn"><i class="fa-solid fa-xmark text-white"></i></a>
          </nav>
          <div class="logo-sidebar text-center pb-3">
            <a href="#" class="nav-links">
              <img alt="" src="<?=base_url('public/assets/images/side-bar-logo.png')?>">
            </a>
          </div> -->

          <?php echo view('member/student/stu_sidebar'); ?>

        </div>
      </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-11 rightPart ">
      <div class="main-boxx">
        <div class="p-1 my-container">
          <!-- Top Nav -->
          <nav class="navbar top-navbar navbar-light px-5">
            <a class="btn border-0" id="menu-btn"><i class="bx bx-menu"></i></a>
          </nav>
          <!--End Top Nav -->
          <div class="earn-boxxx">
            <h3 class="side-head pt-4">Contact us</h3>
            <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
              <div class="alert alert-danger">
                  <?php echo session()->getFlashdata('alert_error'); ?>
              </div>
            <?php } //echo '<pre>'; print_r($subjects); exit;?>
            <!-- <div class="row pt-2">
              <div class="col-md-6 pt-4">
                 <?php // if(!empty($contactus)){ ?>
                  <div class="card mb-2">
                      <div class="card-body d-flex">
                        <div class="">
                          <img src="<?=base_url('public/assets/images/phone-img.png')?>" alt="" class="ct-img">
                        </div>
                        <div class="">
                          <span class="px-4"><strong>Phone Number</strong><br><?='+91 '.$contactus->mobile_number?></span>
                        </div>
                      </div>
                  </div>
                  <div class="card mb-2">
                      <div class="card-body">
                        <img src="<?=base_url('public/assets/images/email-ico.png')?>" alt="" class="ct-img">

                        <span class="px-4"><strong>Email id</strong><br><?=$contactus->email?></span>
                      </div>
                  </div>
                  <div class="card mb-2">
                      <div class="card-body">
                        <img src="<?=base_url('public/assets/images/comment-ico.png')?>" alt="" class="ct-img">

                        <span class="px-4"><strong>Chat with us</strong><br>Live chat available for you</span>
                      </div>
                  </div>
                  <div class="card mb-2">
                      <div class="card-body">
                        <img src="<?=base_url('public/assets/images/location-ico.png')?>" alt="" class="ct-img">

                        <span class="px-4"><strong>Address</strong><br><?=$contactus->address?></span>
                      </div> 
                  </div>
                  <?php // }else{
                  //  echo '<p class="text-center text-danger">No Data Availabe!</p>';
                //  } ?>
              </div>
            </div> -->

            <?php if(!empty($contactus)){ ?>
            <div class="row">
            <div class="col-md-6 col-lg-3 p-2">
      <div class="card border-0 shadow-sm">
        <div class="card-body d-flex align-items-center">
          <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
            <img src="public/assets/images/phone-img.png" alt="Phone" style="width: 24px; height: 24px;">
          </div>
          <div class="ms-3">
            <h6 class="mb-1">Phone Number</h6>
            <p class="mb-0 text-muted"><?='+91 '.$contactus->mobile_number?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Email -->
    <div class="col-md-6 col-lg-3 p-2">
      <div class="card border-0 shadow-sm">
        <div class="card-body d-flex align-items-center">
          <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
            <img src="public/assets/images/email-ico.png" alt="Email" style="width: 24px; height: 24px;">
          </div>
          <div class="ms-3">
            <h6 class="mb-1">Email</h6>
            <p class="mb-0 text-muted"><?=$contactus->email?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Chat -->
    <div class="col-md-6 col-lg-3 p-2">
      <div class="card border-0 shadow-sm">
        <div class="card-body d-flex align-items-center">
          <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
            <img src="public/assets/images/comment-ico.png" alt="Chat" style="width: 24px; height: 24px;">
          </div>
          <div class="ms-3">
            <h6 class="mb-1">Chat with Us</h6>
            <p class="mb-0 text-muted">Live chat available for you</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Address -->
    <div class="col-md-6 col-lg-3 p-2">
      <div class="card border-0 shadow-sm">
        <div class="card-body d-flex align-items-center">
          <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
            <img src="public/assets/images/location-ico.png" alt="Location" style="width: 24px; height: 24px;">
          </div>
          <div class="ms-3">
            <h6 class="mb-1">Address</h6>
            <p class="mb-0 text-muted"><?=$contactus->address?></p>
          </div>
        </div>
      </div>
    </div>
            </div>
            <?php }else{
                    echo '<p class="text-center text-danger">No Data Availabe!</p>';
                  } ?>

          </div>
        </div>
      </div>
    </main>
  </div>
    <!-- </div>
  </div> -->

  
  <style>
    .ct-img{
      width: 20px;
      height: 20px;
    }
  </style>
  