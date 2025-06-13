
  <?php /*echo session('token'); exit;*/?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-lg-2 sidebar" >
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
            <h3 class="side-head pt-4">Dashboard</h3>
            <h5 class="">Welcome <?=(isset($stuDtls->name) && isset($stuDtls->mobile_number))?$stuDtls->name.' ('.$stuDtls->mobile_number.')':''?></h5>
            
            <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
              <div class="alert alert-danger">
                  <?php echo session()->getFlashdata('alert_error'); ?>
              </div>
            <?php } ?>
            <div class="row pt-2">
              <div class="col-md-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <?php //echo '<pre>'; print_r($news); exit;
                      if(isset($banner) && !empty($banner)){
                      foreach($banner as $k=>$list){ ?>
                    
                        <div class="carousel-item <?=($k < 1)?'active':''?>">
                          <img class="d-block w-100" src="<?=$list->banner_image?>" alt="First slide">
                        </div>
                      <?php } } ?>
                    <!-- <div class="carousel-item">
                      <img class="d-block w-100" src="http://43.225.53.245:5000/Images/bannerImage/1698385161535.jpg" alt="Second slide">
                    </div> -->
                    
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>
              
              <div class="row">
                <?php if(isset($news) && !empty($news)){ ?>
                <div class="col-md-12 pt-4">
                  <div class="alert alert-info p-3 rounded-3">
                    <?php $message = '';
                    foreach($news as $list){
                      $message .= $list->notice.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    } ?>
                    <marquee direction="left"><h3><?=$message;?></h3></marquee>
                  </div>
                </div>
                <?php } ?>
              </div>

              <!-- Live classes -->
              
              <!-- <div class="col-md-12 pt-4">
                <div class="card">
                  <div class="card-header">
                    <h3>Live Classes</h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                      
                        <?php if(isset($live_class) && !empty($live_class)){ ?>
                        <div class="card bg-primary text-light">
                            <div class="card-header">
                              <div class="d-flex justify-content-between">
                                <h3>Topic: <?=$live_class[0]->title?></h3>
                                <img src="<?=base_url('public/assets/images/live_icon.png')?>" alt="subject" class="live-icon">
                              </div>
                            </div>
                            <div class="card-body">
                              <p class="text-light"><i class="fa fa-calendar" style="font-size:24px"></i> <?=date('d M Y, H:i',strtotime($live_class[0]->date))?></p>
                              <p class="text-light"><i class="fa fa-users" aria-hidden="true"></i> <?=date('h:i A',strtotime($live_class[0]->time)).'-'.date('h:i A',strtotime($live_class[0]->time.' + 1 hour'))?></p>
                              <div class="d-flex justify-content-between">
                                <div class="">
                                  <a href="<?=base_url('/live-classes')?>" class="btn btn-warning">View Live Classes</a>
                                </div>
                                <img src="<?=base_url('public/assets/images/user-live-class.png')?>" alt="subject" class="user-live-class">
                              </div>
                            </div>
                        </div>
                        <?php }else{ ?>
                          <p class="text-danger text-center">No Live Class</p>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
              
            <div class="row">
              <div class="col-md-12 pt-4">
                <div class="card shadow-sm">
                  <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Live Classes</h3>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      
                      <?php if (isset($live_class) && !empty($live_class)) { ?>
                        <?php foreach ($live_class as $class) { ?>
                          <div class="col-md-6 col-lg-4">
                            <div class="card h-100 bg-light">
                              <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Topic: <?= htmlspecialchars($class->title) ?></h5>
                                <img src="<?= base_url('public/assets/images/live_icon.png') ?>" alt="Live" class="img-fluid" style="width: 30px;">
                              </div>
                              <div class="card-body">
                                <p class="mb-2">
                                  <i class="fa fa-calendar me-2"></i><?= date('d M Y, H:i', strtotime($class->date)) ?>
                                </p>
                                <p class="mb-4">
                                  <i class="fa fa-clock me-2"></i><?= date('h:i A', strtotime($class->time)) . ' - ' . date('h:i A', strtotime($class->time . ' + 1 hour')) ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                  <a href="<?= base_url('/live-classes') ?>" class="btn btn-primary btn-sm">View Live Classes</a>
                                  <img src="<?= base_url('public/assets/images/user-live-class.png') ?>" alt="User" class="img-fluid" style="width: 40px;">
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      <?php } else { ?>
                        <p class="text-center text-danger">No Live Classes Available</p>
                      <?php } ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>


              <!-- Videos -->
              <!-- <?php if(isset($videoes) && !empty($videoes)){ ?>
              <div class="col-md-12 pt-4">
                <div class="card">
                  <div class="card-header">
                    <h3>Latest Videos</h3>
                    <p><?=$videoes->message?></p>
                  </div>
                  <div class="card-body">
                    <div class="d-flex justify-content-start flex-wrap">
                      <?php if(!empty($videoes->data)){
                        foreach($videoes->data as $list){ ?>
                        <div class="mx-2 my-2">
                          <iframe width="200" height="200" src="https://www.youtube.com/embed/<?=$list->upload_video?>" title="<?=$list->topic_name?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                      <?php } } ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?> -->

              <div class="row">
              <?php if (isset($videoes) && !empty($videoes)) { ?>
                <div class="col-md-6 pt-4">
                  <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                      <h3 class="mb-1">Latest Videos</h3>
                      <p class="mb-0 text-white"><?= htmlspecialchars($videoes->message) ?></p>
                    </div>
                    <div class="card-body" style="height: 500px; overflow: scroll;">
                      <div class="row g-3">
                        <?php if (!empty($videoes->data)) { 
                          foreach ($videoes->data as $list) { ?>
                          <div class="col-md-6 col-lg-6">
                            <div class="video-card p-2 bg-light border rounded">
                              <?php /* <iframe class="w-100" height="200" src="https://www.youtube.com/embed/<?= htmlspecialchars($list->upload_video) ?>?&modestbranding=1&fs=0&rel=0" 
                                <?php /* title="<?= htmlspecialchars($list->topic_name) ?>" 
                                      frameborder="0" 
                                      controls = "0"
                                      allow="accelerometer; autoplay; modestbranding; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                      referrerpolicy="strict-origin-when-cross-origin" 
                                      
                                      allowfullscreen /?>
                                >
                              </iframe> */ ?>
                              <a href="javascript:void(0)" data-videoid="<?= htmlspecialchars($list->upload_video) ?>" data-title="<?= htmlspecialchars($list->topic_name) ?>" class="playVideo"><img src="<?=base_url('public/assets/images/cb_youtube_ico.jpg')?>" alt="cb_youtube_ico"></a>
                              <p class="mt-2 text-center text-truncate" title="<?= htmlspecialchars($list->topic_name) ?>">
                                <?= htmlspecialchars($list->topic_name) ?>
                              </p>
                            </div>
                          </div>
                        <?php } } else { ?>
                          <p class="text-danger text-center">No videos available</p>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>

              <?php if (isset($subjects) && !empty($subjects)) { ?>
                <div class="col-md-6 pt-4">
                  <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                      <h3 class="mb-1">Select by Subjects</h3>
                      <p class="mb-0 text-white">Read PDF & Video by chapters</p>
                    </div>
                    <div class="card-body" style="height: 500px; overflow: scroll;">
                      <div class="row g-3">
                        <?php foreach ($subjects as $k => $list) { ?>
                          <div class="col-md-4 col-lg-4">
                            <div class="subject-card text-center p-3 bg-light border rounded h-100">
                              <a href="<?= base_url('my-courses/' . $list->_id) ?>">
                                <img src="<?= base_url('public/assets/images/' . get_logo($list->_id)) ?>" 
                                    alt="<?= htmlspecialchars($list->name) ?>" 
                                    class="img-fluid mb-2" 
                                    style="max-width: 100px; height: auto;">
                              </a>
                              <p class="mt-2 text-truncate" title="<?= htmlspecialchars($list->name) ?>">
                                <?= htmlspecialchars($list->name) ?>
                              </p>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>

              </div>
              

              <!-- subjects -->
              <!-- <?php if(isset($subjects) && !empty($subjects)){ ?>
              <div class="col-md-12 pt-4">
                <div class="card">
                  <div class="card-header">
                    <h3>Select by Subjects</h3>
                    <p>Read PDF & Video by chapters</p>
                  </div>
                  <div class="card-body">
                    <div class="d-flex justify-content-start flex-wrap">
                      <?php 
                        foreach($subjects as $k=>$list){ ?>
                        <div class="mx-2 my-2">
                          <a href="<?=base_url('my-courses/'.$list->_id)?>"><img src="<?=base_url('public/assets/images/'.get_logo($list->_id))?>" alt="subject" class="sub-img"></a>
                          <p><?=$list->name?></p>
                        </div>
                      <?php  } ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?> -->

             


            <!-- </div> -->
          </div>
        </div>
      </div>
    </main>
  </div>
    <!-- </div>
  </div> -->

  <!-- Modal -->
<div class="modal fade" id="videosModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="videosModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="videosModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe id="videoframe" class="w-100" height="400" src="" 
          <?php /* title="<?= htmlspecialchars($list->topic_name) ?>" 
                frameborder="0" 
                controls = "0"
                allow="accelerometer; autoplay; modestbranding; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                referrerpolicy="strict-origin-when-cross-origin" 
                
                allowfullscreen */?>
          >
        </iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

  <style>
    .sub-img{
      width: 50px;
      height: 50px;
    }
    .live-icon{
      width: 50px;
      height: 40px;
    }
    .user-live-class{
      width: 100px;
      height: 100px;
    }
    
  </style>
  <script>
    $(".playVideo").click(function(){
      var videoId = $(this).data("videoid");
      var videoUrl  = "https://www.youtube.com/embed/"+videoId+"?&modestbranding=1&fs=0&rel=0";
      var title = $(this).data("title");
      $("#videosModalLabel").text(title);
      $("#videoframe").attr("src", videoUrl);
      $("#videosModal").modal("show");

      // alert(videoId);
    });
    $('#videosModal').on('hidden.bs.modal', function () {
        $("#videosModal iframe").attr("src", '');
    });
  </script>
   
  