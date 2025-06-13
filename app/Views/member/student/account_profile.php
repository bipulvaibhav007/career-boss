
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
            <h3 class="side-head pt-4">Account</h3>
            <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
              <div class="alert alert-danger">
                  <?php echo session()->getFlashdata('alert_error'); ?>
              </div>
            <?php } //echo '<pre>'; print_r($subjects); exit;?>
            <?php if(session()->getFlashdata('alert_success') !== NULL){ ?>
              <div class="alert alert-success">
                  <?php echo session()->getFlashdata('alert_success'); ?>
              </div>
            <?php } //echo '<pre>'; print_r($subjects); exit;?>
            <div class="row pt-2">
                <div class="col-md-12 pt-4">
                    <div class="card">
                        <div class="card-header">
                          <ul class="nav nav-pills">
                            
                            <li class="nav-item">
                              <a class="nav-link active"  href="<?=base_url('account-profile')?>">Profile</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link " href="<?=base_url('account-payment')?>">Payment</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?=base_url('account-quiz')?>">Quiz</a>
                            </li>
                            
                          </ul>
                        </div>
                        <div class="card-body">

                          <div class="h5">Update your profile</div>
                          <?php if(!empty($profile)){
                            $stu = $profile->stu; ?>
                          <form action="<?=current_url();?>" method="post" enctype="multipart/form-data">
                            <?=csrf_field(); ?>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mb-md-4 mb-3">
                                <label class="mb-2">Student Name*</label>
                                <input class="form-control" type="text" name="name" id="name" value="<?=$stu->name?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-md-4 mb-3">
                                <label class="mb-2">Email id*</label>
                                <input class="form-control" type="text" name="email" id="email" value="<?=$stu->email?>">
                              </div>
                            </div>
                            <div class="col-md-6 ">
                              <div class="form-group mb-md-4 mb-3">
                                <label class="mb-2">Father Name</label>
                                <input class="form-control" type="text" name="father_name" id="father_name" value="<?=$stu->father_name?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-md-4 mb-3">
                                <label class="mb-2">Mobile Number</label>
                                <input class="form-control" type="text" name="mobile_number" id="mobile_number" value="<?=$stu->mobile_number?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-md-4 mb-3">
                                <label class="mb-2">Reg Number</label>
                                <input class="form-control" type="text" name="reg_no" id="reg_no" value="<?=$stu->reg_no?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-md-4 mb-3">
                                <label class="mb-2">Date of joining</label>
                                <p><?=date('d-M-Y',strtotime($stu->added_at))?></p>
                              </div>
                            </div>
                            <?php if($stu->student_photo != ''){ ?>
                            <div class="col-md-6">
                              <div class="form-group mb-md-4 mb-3">
                                <img src="<?=$stu->student_photo?>" alt="img" width="100px" height="100px">
                              </div>
                            </div>
                            <?php }else{ ?>
                              <div class="col-md-6">
                                <div class="form-group mb-md-4 mb-3">
                                  <input type="file" name="student_photo" id="student_photo" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group mb-md-4 mb-3">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </div>
                            <?php } ?>
                          </div>
                          </form>
                          <?php }else{
                            echo '<p class="text-danger">No Data Found!</p>';
                          } ?>

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
  