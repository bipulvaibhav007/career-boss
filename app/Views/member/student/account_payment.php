
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
            <div class="row pt-2">
                <div class="col-md-12 pt-4">
                    <div class="card">
                        <div class="card-header">
                          <ul class="nav nav-pills">
                            
                            <li class="nav-item">
                              <a class="nav-link "  href="<?=base_url('account-profile')?>">Profile</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link active" href="<?=base_url('account-payment')?>">Payment</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="<?=base_url('account-quiz')?>">Quiz</a>
                            </li>
                            
                          </ul>
                        </div>
                        <div class="card-body">
                          <div class="h5">Payment History</div>
                          <?php if(!empty($payment)){
                            echo '<div class="row">';
                            foreach($payment as $list){ ?>
                              <div class="col-md-6 my-2">
                                <div class="card">
                                  <table class="table">
                                    <tr>
                                      <td><?=date('d/m/Y',strtotime($list->payment_at))?></td>
                                      <td><?=$list->payment_type?></td>
                                    </tr>
                                    <tr>
                                      <td>Total Fee</td>
                                      <td>&#8377;&nbsp;<?=$fee_data->fees?></td>
                                    </tr>
                                    <tr>
                                      <td>Paid</td>
                                      <td class="text-success">&#8377;&nbsp;<?=$list->received_fee?></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-6"></div>
                          <?php } 
                           echo '</div>'  ;
                          }else{
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
  