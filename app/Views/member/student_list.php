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
        <div class="col-lg-2 col-md-3     " >
          <div class="side-navbar   flex-wrap flex-column" id="sidebar">
            <nav class="navbar  navbar-field top-navbar hidbutton  ">
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
                  <span> <h3 class="side-head px-3 ">Student's List</h3></span>
                  <a href="<?=base_url('student-cu');?>"><span class="edit-icon"><i class="fa-solid fa-pen"></i> Add Students</span></a>
                </div>
                <?php if(session()->getFlashdata('alert_message') != NULL){
                    echo 
                    '<div class="alert alert-'.session()->getFlashdata('alert_type').'">
                    '.session()->getFlashdata('alert_message').'
                    </div>';
                } ?>
                <div class="table-list pt-5">
                   <table class="table">
                       <thead>
                         <tr class="border-ra">
                           <th scope="col">Sr No</th>
                           <th scope="col">Student's Name</th>
                           <th scope="col">Address</th>
                           <th scope="col">Mobile No</th>
                           <th scope="col">Course For</th>
                           <th scope="col">Status</th>
                           <th scope="col">Action</th>
                           
                         </tr>
                       </thead>
                       <tbody>
                          <?php if(!empty($studentsList)){
                              $sn = 1;
                              foreach($studentsList as $list){
                              if($list->status == 2){
                                  $status = '<span class="btn btn-warning btn-sm">Under Discussion</span>';
                              }else if($list->status == 3){
                                  $status = '<span class="btn btn-success btn-sm">Admitted</span>';
                              }else if($list->status == 4){
                                  $status = '<span class="btn btn-danger btn-sm" title="'.$list->description.'">Reject</span>';
                              }else{
                                  $status = '<span class="btn btn-info btn-sm">New</span>';
                              }
                          ?>
                         <tr>
                           <th scope="row"><?=$sn++; ?></th>
                           <td><?=$list->stu_name?></td>
                           <td ><?=$list->address?></td>
                           <td ><?=$list->phone?></td>
                           <td ><?=$list->course_full_name?></td>
                           <td><?=$status?></td>
                           <td>
                              <?php if($list->status != 3){ ?>
                              <a href="<?=base_url('student-cu/'.$list->stu_id);?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                              <?php if($list->status == 1){ ?>
                              <a href="<?=base_url('student-d/'.$list->stu_id);?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
                              <?php } ?>
                              <?php }else{
                                echo 'Completed';
                              } ?>
                            </td>
                         </tr>
                          <?php } }else{ ?>
                            <tr><td colspan="7"><span class="text-danger">No Data Available!</span></td></tr>
                          <?php } ?>
                         <?php /* <tr>
                           <th scope="row">2</th>
                           <td>Raj Raju</td>
                           <td class="light-yello">Rs 1000</td>
                           <td class="light-yello">Enrolled</td>
                           <td class="color-gray">Waiting for<br> Confirmation </td>
                         </tr>
                         <tr>
                           <th scope="row">3</th>
                           <td>Raj Raju</td>
                           <td class="light-red">Rs 1000</td>
                           <td class="light-red">Enrolled</td>
                           <td class="light-red">Pending</td>
                         </tr>
                         <tr>
                           <th scope="row">4</th>
                           <td>Raj Raju</td>
                           <td class="bg-green">Rs 1000</td>
                           <td class="bg-green">Enrolled</td>
                           <td class="bg-green">Pending</td>
                         </tr> */ ?>
                        
                       </tbody>
                     </table>
                </div>
            </main>
            </div>
        </div>
    </div>
  </div>
  
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

