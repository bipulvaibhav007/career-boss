<?php /*
<!DOCTYPE html>
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
      <div class="col-lg-2 col-md-3 sidebar" >
        <div class="side-navbar flex-wrap flex-column" id="sidebar">
          <nav class="navbar  navbar-field top-navbar hidbutton  ">
            <a class="btn border-1" id="open-menu-btn"><i class="fa-solid fa-xmark text-white"></i></a>
          </nav>
          <div class="logo-sidebar text-center pb-3">
            <!-- <a href="#" class="nav-links">
              <img alt="" src="<?=base_url('public/assets/images/side-bar-logo.png')?>">
            </a> -->
          </div>

          <?php echo view('member/sidebar'); ?>

        </div>
      </div>
    </div>


    <main class="col-md-9 ms-sm-auto col-lg-11 rightPart ">
      <div class="main-boxx">
        <div class="p-1 my-container">
          <!-- Top Nav -->
          <nav class="navbar top-navbar navbar-light  px-5">
            <a class="btn border-0" id="menu-btn"><i class="bx bx-menu"></i></a>
          </nav>
          <!--End Top Nav -->
          <div class="earn-boxxx">
            <h3 class="side-head pt-4">Dashboard</h3>
            <h5 class="">Welcome <?=ucwords(session('m_full_name'))?></h5>
            <div class="row pt-5">
              <div class="col-lg-6 pb-4">
                <div class="totel-e">
                  <span><img alt="" src="<?=base_url('public/assets/images/rupes-1.png')?>"> Total Earn</span>
                  <h4 class="px-2 pt-3 bg-green rupess"><?=$memberDtls->earn_amount?></h4>
                </div>
              </div>
              <div class="col-lg-6 pb-4">
                <div class="totel-e">
                  <span><img alt="" src="<?=base_url('public/assets/images/rupes-1.png')?>"> Received Amount by Career-Boss</span>
                  <h4 class="px-2 pt-3 bg-green rupess"><?=$memberDtls->credit_amount?></h4>
                </div>
              </div>
              <div class="col-lg-6 pb-4">
                <div class="totel-e">
                  <span><img alt="" src="<?=base_url('public/assets/images/rupes-1.png')?>"> Total Students</span>
                  <h4 class="px-2 pt-3 bg-green rupess"><?=$counttotal?></h4>
                </div>
              </div>
              <div class="col-lg-6 ">
                <div class="totel-e">
                  <span><img alt="" src="<?=base_url('public/assets/images/rupes-2.png')?>"> New</span>
                  <h4 class="px-2 pt-3 text-blue rupess"> <?=$countnew?> </h4>
                </div>
              </div>
              <div class="col-lg-6 ">
                <div class="totel-e">
                  <span><img alt="" src="<?=base_url('public/assets/images/rupes-2.png')?>"> Under Discussion</span>
                  <h4 class="px-2 pt-3 text-blue rupess"> <?=$countud?> </h4>
                </div>
              </div>
              <div class="col-lg-6 ">
                <div class="totel-e">
                  <span><img alt="" src="<?=base_url('public/assets/images/rupes-2.png')?>"> Admitted</span>
                  <h4 class="px-2 pt-3 text-blue rupess"> <?=$countadm?> </h4>
                </div>
              </div>
              <div class=" d-flex link-boxxx">
                  <span>Your Referral link | </span>
                  <span class="text-blue">http://www.carer-boss.com/dsgsdfg-dsgsd</span>
                  <span><i class="fa-regular fa-copy"></i></span>
              </div>
              <span class="pt-3 share-this">Share this referral link in your network & friends and earn flat ₹1000.</span>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
    <!-- </div>
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


</html> */ ?>