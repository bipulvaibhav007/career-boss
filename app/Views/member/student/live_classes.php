<style>
  .live-class {
    width: 100px;
    height: 100px;
  }

  #zmmtg-root {
    display: none;
    min-width: 0 !important;
  }

  .col-xs-1,
  .col-sm-1,
  .col-md-1,
  .col-lg-1,
  .col-xs-2,
  .col-sm-2,
  .col-md-2,
  .col-lg-2,
  .col-xs-3,
  .col-sm-3,
  .col-md-3,
  .col-lg-3,
  .col-xs-4,
  .col-sm-4,
  .col-md-4,
  .col-lg-4,
  .col-xs-5,
  .col-sm-5,
  .col-md-5,
  .col-lg-5,
  .col-xs-6,
  .col-sm-6,
  .col-md-6,
  .col-lg-6,
  .col-xs-7,
  .col-sm-7,
  .col-md-7,
  .col-lg-7,
  .col-xs-8,
  .col-sm-8,
  .col-md-8,
  .col-lg-8,
  .col-xs-9,
  .col-sm-9,
  .col-md-9,
  .col-lg-9,
  .col-xs-10,
  .col-sm-10,
  .col-md-10,
  .col-lg-10,
  .col-xs-11,
  .col-sm-11,
  .col-md-11,
  .col-lg-11,
  .col-xs-12,
  .col-sm-12,
  .col-md-12,
  .col-lg-12 {
    position: unset !important;
  }
  body {
    font-family: 'Poppins', sans-serif !important;
    padding-top: 90px !important;
    font-size: 14px !important;
}
.nav>li>a {
    position: relative;
    display: inline-block !important;
    padding: 0;
}

#zmmtg-root {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #000;
    z-index: 99999 !important;
}
</style>
<?php /*echo session('token'); exit;*/?>
<div class="online-class-panel">
  <div class="container-fluid ps-0">
    <div class="row">
      <div class="col-lg-2 col-md-3 sidebar">
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
      <main class="col-md-9 ms-sm-auto col-lg-11 rightPart ">
        <div class="main-boxx">
          <div class="p-1 my-container">
            <!-- Top Nav -->
            <nav class="navbar top-navbar navbar-light px-5">
              <a class="btn border-0" id="menu-btn"><i class="bx bx-menu"></i></a>
            </nav>
            <!--End Top Nav -->
            <div class="earn-boxxx">
              <h3 class="side-head pt-4">Live Classes</h3>
              <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
              <div class="alert alert-danger">
                <?php echo session()->getFlashdata('alert_error'); ?>
              </div>
              <?php } ?>
              <div class="row pt-2">
                <div class="col-md-12 pt-4">
                  <div class="card">
                    <div class="card-body">
                      <?php if(isset($live_class) && !empty($live_class)){ ?>
                      <div class="text-center ">
                        <img src="<?=base_url('public/assets/images/video-icon.png')?>" alt="subject"
                          class="live-class">
                        <h3>Join Live Class</h3>
                      </div>
                      <div class="row mt-4">
                        <?php foreach($live_class as $list){ ?>
                        <div class="col-md-6">
                          <div class="card">
                            <div class="card-header d-flex justify-content-between">
                              <h4><?=$list->title ?></h4>
                              <a href="javascript:void(0)"
                                onclick="ini_config('<?=$list->meeting_id?>','<?=$list->passcode?>','<?=$profile->name?>','<?=$profile->email?>','<?=csrf_token()?>','<?=csrf_hash()?>')"
                                class="btn btn-warning">Join Now</a>
                            </div>
                            <div class="card-body">
                              <p>Time:
                                <?=date('h:i A',strtotime($list->time))?>
                              </p>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                        <?php }else{ ?>
                        <p class="text-danger text-center">No Live Class</p>
                        <?php } ?>
                      </div>
                    </div> <!-- end card-body -->
                  </div>
                </div>
              </div>

              <!-- For Component View -->
              <?php /*<div id="meetingSDKElement">
                  <!-- Zoom Meeting SDK Rendered Here -->
                </div> */?>

            </div>
          </div>
        </div>
      </main>
    </div>



  </div>
</div>

<!-- </div>
  </div> -->

<!-- Dependencies for client view and component view -->
<script src="https://source.zoom.us/3.10.0/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/3.10.0/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/3.10.0/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/3.10.0/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/3.10.0/lib/vendor/lodash.min.js"></script>

<!-- For Client View -->
<script src="https://source.zoom.us/zoom-meeting-3.10.0.min.js"></script>
<script type="text/javascript" src="<?=base_url('public/assets/js/liveClass/client-view.js')?>"></script>

<!-- For Component View -->
<?php /* <script src="https://source.zoom.us/3.10.0/zoom-meeting-embedded-3.10.0.min.js"></script>
  <script type="text/javascript" src="<?=base_url('public/assets/js/liveClass/component-view.js')?>"></script> */ ?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

