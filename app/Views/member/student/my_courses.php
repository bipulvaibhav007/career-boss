
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
            <h3 class="side-head pt-4">My Courses</h3>
            <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
              <div class="alert alert-danger">
                  <?php echo session()->getFlashdata('alert_error'); ?>
              </div>
            <?php } //echo '<pre>'; print_r($subjects); exit;?>
            <div class="row pt-2">
                <div class="col-md-12 pt-4">
                    <div class="card">
                        <div class="card-header">
                          <ul class="nav nav-pills nav-fill">
                            <?php if(!empty($subjects)){
                            foreach($subjects as $list){ ?>
                            <li class="nav-item">
                              <a class="nav-link btn <?=($list->_id == $module_id)?'active':''?>"  href="<?=base_url('my-courses/'.$list->_id)?>"><?=$list->name?></a>
                            </li>
                            <?php } } ?>
                            <?php /* <li class="nav-item">
                              <a class="nav-link active" href="#">Much longer nav link</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link " href="#" >Disabled</a>
                            </li> */ ?>
                          </ul>
                        </div>
                        <div class="card-body">

                          <div class="accordion" id="accordionExample">
                            <?php if(!empty($ch_topic)){
                            foreach($ch_topic as $k=>$list){ ?>
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button <?=($k < 1)?'':'collapsed'?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$k?>" aria-expanded="true" aria-controls="collapse<?=$k?>">
                                  <?=$list->chapter->chapter_title?>
                                </button>
                              </h2>
                              
                              <div id="collapse<?=$k?>" class="accordion-collapse collapse <?=($k < 1)?'show':''?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body ">
                                  <?php if(!empty($list->topic)){
                                  foreach($list->topic as $list2){ 
                                    if($list2->upload_pdf != ''){
                                  ?>
                                    <div class="mb-2">
                                      <img src="<?=base_url('public/assets/images/pdf-ico.png')?>" alt="Pdf" width="20px" height="20px">
                                      <span class="mx-2" onclick="show_pdf('<?=$list2->upload_pdf?>','<?=$list2->topic_name?>')" style="cursor:pointer"><?=$list2->topic_name?></span>
                                    </div>
                                  <?php } if($list2->upload_video != ''){ ?>
                                    <div class="mb-2">
                                      <img src="<?=base_url('public/assets/images/video-ico.png')?>" alt="Video" width="20px" height="20px">
                                      <span class="mx-2" onclick="show_video('<?=$list2->upload_video?>','<?=$list2->topic_name?>')" style="cursor:pointer"><?=$list2->topic_name?></span>
                                    </div>
                                  <?php } } }?>
                                </div>
                              </div>
                            </div>
                            <?php } } ?>
                            <?php /* <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  Accordion Item #2
                                </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                              </div>
                            </div>
                             */ ?>
                          </div>

                        </div> <!-- end card-body -->
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

  <!-- show pdf modal -->
  <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pdfModalLabel">Title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height: 500px">
          <embed
              id="pdfbox"
              src=""
              type="application/pdf"
              frameBorder="0"
              scrolling="auto"
              height="100%"
              width="100%"
          ></embed>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary">Send message</button> -->
        </div>
      </div>
    </div>
  </div>
  <!-- show video modal -->
  <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="videoModalLabel">Title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height: 500px">
          <iframe 
            id="videobox"
            width="100%" 
            height="100%" 
            src="" 
            title="" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen>
          </iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary">Send message</button> -->
        </div>
      </div>
    </div>
  </div>
  
  <script>
    function show_pdf(url, title){
      // alert(url);
      $("#pdfModalLabel").html(title);
      $("#pdfbox").attr("src", url+"#toolbar=0");
      $("#pdfModal").modal("show");
    }
    function show_video(url, title){
      $("#videoModalLabel").html(title);
      $("#videobox").attr("src", "https://www.youtube.com/embed/"+url+"?controls=0&showinfo=0&rel=0&modestbranding=1");
      $("#videobox").attr("title", title);
      $("#videoModal").modal("show");
    }
  </script>
  