
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
              <h3 class="side-head pt-4">Check Answer</h3>
              <div class="">
              <a href="<?=base_url('/quiz-finish')?>" class="btn btn-danger">Close</a>
              </div>
            </div>
            <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
              <div class="alert alert-danger">
                  <?php echo session()->getFlashdata('alert_error'); ?>
              </div>
            <?php } //echo '<pre>'; print_r($store); exit;?>
            <div class="row pt-2">
                <div class="offset-md-2 col-md-8 pt-4">
                    <?php if(!empty($store)){
                    $n = 1;
                    foreach($store as $k=>$list){ ?>
                    <div class="card">
                        <div class="card-header">
                          <h3>Question: <?=$n.' :-'.$list->question?></h3>
                        </div>
                        <div class="card-body">
                        <?php if($list->remark){ ?>
                          <p>You have chosen and it is absolutely right answer.</p>
                          <ul class="list-group">
                            <li class="list-group-item">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="correct_ans<?=$k?>" id="correct_ans<?=$k?>" checked disabled>
                                <label class="form-check-label" for="correct_ans<?=$k?>">
                                  <?=$list->correct_opt?>
                                </label>
                              </div>
                            </li>
                          </ul>
                        <?php }else{ ?>
                          <p>Right Answer is</p>
                          <ul class="list-group">
                            <li class="list-group-item border border-success">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="correct_ans<?=$k?>" id="correct_ans<?=$k?>"  disabled>
                                <label class="form-check-label" for="correct_ans<?=$k?>">
                                  <?=$list->correct_opt?>
                                </label>
                              </div>
                            </li>
                          </ul>
                          <p>You have chosen</p>
                          <ul class="list-group">
                            <li class="list-group-item border border-danger">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="given_ans<?=$k?>" id="given_ans<?=$k?>" checked disabled>
                                <label class="form-check-label" for="given_ans<?=$k?>">
                                  <?=$list->givent_opt?>
                                </label>
                              </div>
                            </li>
                          </ul>
                          <?php } ?>
                        </div>
                    </div>
                    <?php $n++;} } ?>
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
  