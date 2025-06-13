
<?php /*echo session('token'); exit;*/
use App\Controllers\Member;
$member = new Member();
// $member->test();
?>
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
            <h3 class="side-head pt-4">Quiz Test</h3>
            <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
              <div class="alert alert-danger">
                  <?php echo session()->getFlashdata('alert_error'); ?>
              </div>
            <?php } //echo '<pre>'; print_r($subjects); exit;?>
            <div class="row pt-2">
                <div class="col-md-12 pt-4">
                    <div class="card">
                        <div class="card-header">
                          <h5>Select your subject</h5>
                        </div>
                        <div class="card-body">
                          <div class="accordion" id="accordionExample">
                            <?php if(!empty($quiz)){
                            foreach($quiz as $k=>$list){ 
                              $param = [
                                'course_id' => $list->course_id,
                                'module_id' => $list->module_id,
                              ];
                              $param = base64url_encode(json_encode($param));
                              $quiz_list = $member->quiz_list($param);
                              // echo '<pre>'; print_r($quiz_list); exit;
                            ?>
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button <?=($k < 1)?'':'collapsed'?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$k?>" aria-expanded="true" aria-controls="collapse<?=$k?>">
                                  <?=$list->module_name?>
                                </button>
                              </h2>
                              <div id="collapse<?=$k?>" class="accordion-collapse collapse <?=($k < 1)?'show':''?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="list-group">
                                      <?php if(!empty($quiz_list)){
                                      foreach($quiz_list as $list2){ 
                                        $param2 = [
                                          'id' => $list2->_id,
                                          'time' => $list2->qps_time,
                                        ];
                                        $param2 = base64url_encode(json_encode($param2));  
                                      ?>
                                        <a href="<?=base_url('quiz-start/'.$param2)?>" class="list-group-item list-group-item-action ">
                                          <?=$list2->qps_title ?>
                                        </a>
                                        <?php } }else{
                                          echo '<p class="text-danger text-center">No List Available</p>';
                                        } ?>
                                        <?php /* <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
                                        <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
                                        <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
                                        <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a> */ ?>
                                      </div>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                            <?php } } ?>
                          </div>
                        </div>
                        <?php /* <div class="card-body">
                            <div class="row">
                                <?php if(!empty($quiz)){
                                foreach($quiz as $list){ 
                                  $param = [
                                    'course_id' => $list->course_id,
                                    'module_id' => $list->module_id,
                                  ];
                                  $param = base64url_encode(json_encode($param));
                                ?>
                                <div class="col-md-3">
                                    <div class="card text-center py-4">
                                        <a href="<?=base_url('quiz-list/'.$param)?>"><img src="<?=base_url('public/assets/images/'.get_logo($list->module_id))?>" alt="subject" class="sub-img"></a>
                                        <p><?=$list->module_name?></p>
                                    </div>
                                </div>
                                <?php } }else{
                                    echo '<p class="text-danger text-center">No Subject Found!</p>';
                                } ?>
                            </div>
                        </div> */ ?>
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
  