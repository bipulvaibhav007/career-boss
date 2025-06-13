     
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
                  <span> <h3 class="side-head px-3 ">Bank Details</h3></span>
                  <!-- <a href="#">  <span class="edit-icon"><i class="fa-solid fa-pen"></i>  Edit Profile</span></a> -->
                </div>
                <?php if(session()->getFlashdata('alert_message') != NULL){
                    echo 
                    '<div class="alert alert-'.session()->getFlashdata('alert_type').'">
                    '.session()->getFlashdata('alert_message').'
                    </div>';
                } ?>
                <?php $status = '<span class="btn btn-warning btn-sm">Pending</span>';
                    if(isset($bankDtls) && $bankDtls->status == 1){
                        $status = '<span class="btn btn-success btn-sm">Approved</span>';
                    }else if(isset($bankDtls) && $bankDtls->status == 2){
                        $status = '<span class="btn btn-danger btn-sm">Rejected</span>';
                    }
                ?>
                <?php if(empty($bankDtls) || $bankDtls->status == 2){ ?>
                <div class="form-profile pt-3">
                    <?php if(isset($bankDtls) && $bankDtls->status == 2){ ?>
                        <p><strong>Status:</strong> <?=$status; ?></p>
                        <p><strong>Comment:</strong> <i><?=($bankDtls->comment != '')?$bankDtls->comment:'N/A'; ?></i></p>
                    <?php } ?>
                    <form action="<?=current_url(); ?>" method="post" class="" id="enquiry_form">
                    <?=csrf_field(); ?>
                    <?=form_hidden('m_id', (isset($bankDtls))?$bankDtls->m_id:''); ?>
                    <?=form_hidden('bnk_id', (isset($bankDtls))?$bankDtls->bnk_id:''); ?>
                    <div class="Register-Now">
                       <div class="get-in-tuch ">
                           <div class="row">
                                <p class="text-danger">*Fields are mandatory.</p>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">Account Holder Name:*</label>
                                       <input class="form-control" type="text" name="acc_holder_name" id="acc_holder_name" value="<?=set_value('acc_holder_name', (isset($bankDtls))?$bankDtls->acc_holder_name:''); ?>">
                                        <span class="text-danger"><?=(isset($validation))?$validation->getError('acc_holder_name'):''?></span>
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                        <label class="mb-2">Bank Name:*</label>
                                        <input  class="form-control" type="text" name="bank_name" id="bank_name" value="<?=set_value('bank_name', (isset($bankDtls))?$bankDtls->bank_name:''); ?>">
                                        <span class="text-danger"><?=(isset($validation))?$validation->getError('bank_name'):''?></span>
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">Account No:*</label>
                                       <input  class="form-control" type="text" name="acc_no" id="acc_no" value="<?=set_value('acc_no', (isset($bankDtls))?$bankDtls->acc_no:''); ?>">
                                        <span class="text-danger"><?=(isset($validation))?$validation->getError('acc_no'):''?></span>
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">Confirm Account No:*</label>
                                       <input  class="form-control" type="text" name="c_acc_no" id="c_acc_no" value="<?=set_value('c_acc_no', (isset($bankDtls))?$bankDtls->acc_no:''); ?>">
                                        <span class="text-danger"><?=(isset($validation))?$validation->getError('c_acc_no'):''?></span>
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">IFSC Code:*</label>
                                       <input  class="form-control" type="text" name="ifsc_code" id="ifsc_code" value="<?=set_value('ifsc_code', (isset($bankDtls))?$bankDtls->ifsc_code:''); ?>">
                                        <span class="text-danger"><?=(isset($validation))?$validation->getError('ifsc_code'):''?></span>
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">Bank Address:*</label>
                                       <input  class="form-control" type="text" name="bank_address" id="bank_address" value="<?=set_value('bank_address', (isset($bankDtls))?$bankDtls->bank_address:''); ?>">
                                        <span class="text-danger"><?=(isset($validation))?$validation->getError('bank_address'):''?></span>
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
                <?php }else{ ?>
                <div class="form-profile pt-3">
                    <div class="Register-Now">
                       <div class="get-in-tuch ">
                           <div class="row">
                                <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">Account Holder Name:</label>
                                       <strong><?=(isset($bankDtls))?$bankDtls->acc_holder_name:''; ?></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">Bank Name:</label>
                                       <strong><?=(isset($bankDtls))?$bankDtls->bank_name:''; ?></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">Account No:</label>
                                       <strong><?=(isset($bankDtls))?$bankDtls->acc_no:''; ?></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">IFSC Code:</label>
                                       <strong><?=(isset($bankDtls))?$bankDtls->ifsc_code:''; ?></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">Bank Address:</label>
                                       <strong><?=(isset($bankDtls))?$bankDtls->bank_address:''; ?></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group mb-md-4 mb-3">
                                       <label class="mb-2">Status:</label>
                                       <?=$status; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </main>
    </div>


        