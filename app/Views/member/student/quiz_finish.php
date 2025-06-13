
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
        <div class="p-1 container">
          <!-- Top Nav -->
          <nav class="navbar top-navbar navbar-light px-5">
            <a class="btn border-0" id="menu-btn"><i class="bx bx-menu"></i></a>
          </nav>
          <!--End Top Nav -->
          <div class="earn-boxxx">
            <div class="d-flex justify-content-between">
              <h3 class="side-head pt-4">Quiz Finished</h3>
              <div class="">
              <a href="<?=base_url('quiz')?>" class="btn btn-primary">Back</a>
              </div>
            </div>
            <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
              <div class="alert alert-danger">
                  <?php echo session()->getFlashdata('alert_error'); ?>
              </div>
            <?php } //echo '<pre>'; print_r($msg); exit;?>
            <div class="row pt-2">
                <div class="offset-md-4 col-md-4 pt-4">
                    <?php if(isset($msg->total_question)){ ?>
                    <div class="card">
                        <div class="text-center">
                          <span class="h2">Your Score</span><br><br>
                          <span class="h3 "><?=$msg->total_question?>/<?=$msg->correct?></span>
                        </div>
                        <div class="my-4">
                          <div class="px-2 d-flex justify-content-between">
                            <span><?=$msg->skip?><br>Skip Question</span>
                            <span><?=$msg->total_question?><br>Total Question</span>
                          </div>
                          <div class="px-2 py-4 d-flex justify-content-between">
                            <span><?=$msg->correct?><br>Correct</span>
                            <span><span class="text-danger"><?=$msg->wrong?></span><br>Wrong</span>
                          </div>
                        </div>
                      <div class="card-footer text-center">
                        <a href="<?=base_url('/check-ans')?>" class="btn btn-block btn-primary">Check Answer</a>
                      </div>
                    </div>
                    <?php } ?>
                  
                </div>
            </div>

          </div>
        </div>
      </div>
    </main>
  </div>
    <!-- </div>
  </div> -->

  
  <style>
    .sub-img{
      width: 50px;
      height: 50px;
    }
  </style>
  