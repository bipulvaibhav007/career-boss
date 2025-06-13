
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
            <h3 class="side-head pt-4">Select Quiz List</h3>
            <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
              <div class="alert alert-danger">
                  <?php echo session()->getFlashdata('alert_error'); ?>
              </div>
            <?php } //echo '<pre>'; print_r($subjects); exit;?>
            <div class="row pt-2">
                <div class="col-md-12 pt-4">
                    <div class="card">
                        <div class="card-body py-4">
                          <div class="list-group">
                            <?php if(!empty($quiz_list)){
                            foreach($quiz_list as $list){ 
                              $param = [
                                'id' => $list->_id,
                                'time' => $list->qps_time,
                              ];
                              $param = base64url_encode(json_encode($param));  
                            ?>
                            
                            <a href="<?=base_url('quiz-start/'.$param)?>" class="list-group-item list-group-item-action ">
                              <?=$list->qps_title ?>
                            </a>
                            
                            <?php }}else{
                              echo '<p class="text-danger text-center">No List Available</p>';
                            } ?>
                          </div>
                        </div>
                    </div>
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
  