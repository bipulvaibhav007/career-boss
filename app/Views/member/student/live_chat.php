
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
            <h3 class="side-head pt-4">Live Chat</h3>
            <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
              <div class="alert alert-danger">
                  <?php echo session()->getFlashdata('alert_error'); ?>
              </div>
            <?php } //echo '<pre>'; print_r($subjects); exit;?>
            <div class="row pt-2">
              <div class="col-md-12 pt-4">
                  <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-8">
                            <div class="row" id="messageRow">

                              

                            </div>
                          </div>
                        </div>
                      </div> <!-- end card-body -->
                      <div class="card-footer">
                        <form class="" action="<?=base_url('/save_chat')?>" method="post" id="chatForm">
                          
                          <div class="row">
                            <div class="col-md-8">
                              <input type="text" name="message" value="" id="message" class="form-control" placeholder="Enter any question here..." >
                              <span class="text-danger" id="msgErr"></span>
                            </div>
                            <div class="col-md-4">
                              <button type="button" class="btn btn-primary " id="savechat">Send</button>
                            </div>
                          </div>
                        </form>
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

  
  <script>
    $(document).ready(function(){
      flash_message();
      setInterval(flash_message,1000);
    });
    function flash_message(){
      $.ajax({
        type: "GET",
        url: "<?php echo base_url('/get-live-chat') ?>",
        // data: formData,
        // processData: false,
        // contentType: false,
        //data: {name :name,email : email},
        success: function(html_data){
          $("#messageRow").html(html_data);
        }
      });
    };

    $("#savechat").click(function(){
      $("#msgErr").html('');
      var message = $("#message").val();
      if(message == ''){
        $("#msgErr").html('Please write your message here!');
        return false;
      }else{
        var frm = $("#chatForm");
        var formData = new FormData(frm[0]);
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('/save_chat') ?>",
          data: formData,
          processData: false,
          contentType: false,
          //data: {name :name,email : email},
          success: function(data){
            if(data == 'success'){
              var message = $("#message").val('');
              flash_message();
            }
          }
        });
      }
    });
  </script>
  