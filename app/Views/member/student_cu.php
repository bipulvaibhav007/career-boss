     
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
                  <span> <h3 class="side-head px-3 "><?=(isset($student))?'Edit':'Add'?> Student</h3></span>
                  <!-- <a href="#">  <span class="edit-icon"><i class="fa-solid fa-pen"></i>  Edit Profile</span></a> -->
                </div>
                <!-- <h3 class="side-head pt-4"><?=(isset($student))?'Edit':'Add'?></h3> -->
                
                <div class="form-profile pt-3">
                    <form action="<?=current_url(); ?>" method="post" class="" id="enquiry_form">
                    <?=csrf_field(); ?>
                    <?=form_hidden('status', (isset($student))?$student->status:1); ?>
                    <div class="Register-Now">
                       <div class="get-in-tuch ">
                           <div class="row">
                                <p class="text-danger">*Fields are mandatory.</p>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">Student's Name:*</label>
                                       <input class="form-control" type="text" name="stu_name" id="stu_name" value="<?=set_value('stu_name', (isset($student))?$student->stu_name:''); ?>">
                                        <span class="text-danger"><?=(isset($validation))?$validation->getError('stu_name'):''?></span>
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                        <label class="mb-2">Address:</label>
                                        <input  class="form-control" type="text" name="address" id="address" value="<?=set_value('address', (isset($student))?$student->address:''); ?>">
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">Mobile No:*</label>
                                       <input  class="form-control" type="text" name="phone" id="phone" value="<?=set_value('phone', (isset($student))?$student->phone:''); ?>">
                                        <span class="text-danger"><?=(isset($validation))?$validation->getError('phone'):''?></span>
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                        <label class="mb-2">Course For:*</label>
                                        <select name="course_id" id="course_id" class="form-control">
                                            <option value="">Select One</option>
                                            <?php if(!empty($courses)){
                                                foreach($courses as $list){ 
                                                $true = ((isset($student) && $student->course_id == $list->course_id)?TRUE:'')        
                                            ?>
                                                <option value="<?=$list->course_id?>" <?=set_select('course_id', $list->course_id, $true)?>><?=$list->course_full_name?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <span class="text-danger"><?=(isset($validation))?$validation->getError('course_id'):''?></span>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center px-3 pt-3">
                        <input type="submit" class="link-btn text-uppercase lt-space px-4 blue-btn d-block" name="final_submit" value="SAVE CHANGE">
                        <a href="<?=base_url('/student-list')?>" class="link-btn text-uppercase lt-space px-4 blue-btn">Cancel</a>
                    </div>
                        
                    </form>
                </div>
                
            </div>
        </main>
    </div>


        