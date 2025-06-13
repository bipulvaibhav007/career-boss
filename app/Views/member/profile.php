<?php /* <!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
<!-- BOX ICONS CSS-->
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
  <title>Document</title>

 
  
 
  <script>
   
  </script>
</head>
<style>

</style>


<body> */ ?>
  <div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 col-md-3     " >
          <div class="side-navbar   flex-wrap flex-column" id="sidebar">
            <nav class="navbar navbar-field top-navbar hidbutton  ">
              <a class="btn border-1" id="open-menu-btn"><i class="fa-solid fa-xmark text-white"></i></a>
            </nav>
           <div class="logo-sidebar text-center pb-3">
            <!-- <a href="#" class="nav-links">

              <img alt="" src="images/side-bar-logo.png">

            </a> -->
           </div>
           <?php echo view('member/sidebar'); ?>
          </div>
          </div>
          </div>


            <main class="col-md-9 ms-sm-auto col-lg-11  rightPart ">
              <div class="main-boxx">
                <nav class="navbar top-navbar navbar-light  px-5">
                  <a class="btn border-0" id="menu-btn"><i class="bx bx-menu"></i></a>
                </nav>
                <div class="edit-box d-flex justify-content-between pt-4">
                  <span> <h3 class="side-head px-3 ">My Profile</h3></span>
                  <!-- <a href="#">  <span class="edit-icon"><i class="fa-solid fa-pen"></i>  Edit Profile</span></a> -->
                </div>
                <?php if(session()->getFlashdata('alert_message') != NULL){
                    echo 
                    '<div class="alert alert-'.session()->getFlashdata('alert_type').'">
                    '.session()->getFlashdata('alert_message').'
                    </div>';
                } ?>
                <div class="form-profile pt-3">
                   <form action="<?=current_url()?>" method="post" class="" id="enquiry_form">
                    <?=csrf_field(); ?>
                   <div class="Register-Now">
                       <div class="get-in-tuch ">
                           <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group mb-md-4 mb-3">
                                    <label class="mb-2">Phone Number</label><br>
                                    <strong><?=isset($memberDtls)?$memberDtls->phone:''; ?></strong>
                                    <?php /* 
                                    <input  class="form-control" type="text" name="phone" id="phone" value="">
                                    <span class="text-danger"><?=(isset($validation))?$validation->getError('phone'):''?></span> */ ?>
                                  </div>
                                </div>
                               <div class="col-md-6">
                                  <div class="form-group mb-md-4 mb-3">
                                    <label class="mb-2">Full Name*</label>
                                    <input class="form-control" type="text" name="m_full_name" id="m_full_name" value="<?=set_value('m_full_name', (isset($memberDtls))?$memberDtls->m_full_name:''); ?>">
                                    <span class="text-danger"><?=(isset($validation))?$validation->getError('m_full_name'):''?></span>
                                  </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                        <label class="mb-2">Address:</label>
                                        <input  class="form-control" type="text" name="address" id="address" value="<?=set_value('address', (isset($memberDtls))?$memberDtls->address:''); ?>">
                                    </div>
                               </div>
                               
                               <div class="col-md-6">
                                  <div class="form-group mb-md-4 mb-3">
                                    <label class="mb-2">Email*</label>
                                    <input  class="form-control" type="text" name="email" id="email" value="<?=set_value('email', (isset($memberDtls))?$memberDtls->email:''); ?>">
                                    <span class="text-danger"><?=(isset($validation))?$validation->getError('email'):''?></span>
                                  </div>
                               </div>
                               
                            </div>
                            
                         </div>
                   </div>
                   <div class="text-center px-3 pt-3">
                       <!-- <a href="javascript:void(0)" id="enquiry-submit-btn" class="link-btn text-uppercase lt-space blue-btn d-block"> submit </a> -->
                       <input type="submit" class="link-btn text-uppercase lt-space px-4  blue-btn d-block" name="final_submit" value="SAVE">
                   </div>
                        
                  </form>
                </div>
                
                </div>
            </main>
            </div>
        </div>
    </div>
  </div>

  
<!-- <div class="poppep-box d-flex justify-content-center">
  Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
Launch demo modal
</button> -->

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<div class="poppep-image">
<img alt="" src="images/pooep-img.png">
</div>
<div> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
</div>
<h5 class="text-center">Are you sure you want to log out?</h5>
<div class="modal-footer">
<button type="button" class="btn btn-1" data-bs-dismiss="modal">No</button>
<button type="button" class="btn btn-2">Yes</button>
</div>
</div>
</div>
</div>
</div> -->
<?php /*     
  <script src="js/all.js"></script>
  <script src="js/all.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
   <script>
    var menu_btn = document.querySelector("#menu-btn");
  var sidebar = document.querySelector("#sidebar");
  var container = document.querySelector(".my-container");
  menu_btn.addEventListener("click", () => {
    sidebar.classList.toggle("active-nav");
    container.classList.toggle("active-cont");
  });
  
  var open_menu_btn = document.querySelector("#open-menu-btn");
  open_menu_btn.addEventListener("click", () => {
    sidebar.classList.toggle("active-nav");
    container.classList.toggle("active-cont");
  });
  
   </script>
</body>


</html>


*/ ?>

