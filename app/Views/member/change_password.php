     
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
                  <span> <h3 class="side-head px-3 ">Change Password</h3></span>
                </div>
                <?php if(session()->getFlashdata('alert_message') != NULL){
                    echo 
                    '<div class="alert alert-'.session()->getFlashdata('alert_type').'">
                    '.session()->getFlashdata('alert_message').'
                    </div>';
                } ?>
                <div class="form-profile pt-3">
                    <form action="<?=current_url(); ?>" method="post" class="" id="enquiry_form">
                    <?=csrf_field(); ?>
                    <?=form_hidden('m_id', session('m_id')); ?>
                    <div class="Register-Now">
                       <div class="get-in-tuch ">
                           <div class="row">
                                <p class="text-danger">*Fields are mandatory.</p>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">New Password:*</label>
                                       <input class="form-control" type="password" name="password" id="password" value="<?=set_value('password'); ?>">
                                        <span class="text-danger"><?=(isset($validation))?$validation->getError('password'):''?></span>
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                        <label class="mb-2">Confirm Password:</label>
                                        <input class="form-control" type="password" name="cpassword" id="cpassword" value="<?=set_value('cpassword'); ?>">
                                        <span class="text-danger"><?=(isset($validation))?$validation->getError('cpassword'):''?></span>
                                    </div>
                               </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="text-center px-3 pt-3">
                        <input type="submit" class="link-btn text-uppercase lt-space px-4 blue-btn d-block" name="final_submit" value="SAVE CHANGE">
                        <a href="<?=base_url('/member-dashboard')?>" class="link-btn text-uppercase lt-space px-4 blue-btn">Cancel</a>
                    </div>
                        
                    </form>
                </div>
                
            </div>
        </main>
    </div>


        